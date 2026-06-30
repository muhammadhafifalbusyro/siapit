<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationStudent;
use App\Models\CareerTargetContext;
use App\Models\CareerTargetSubmission;
use App\Models\CareerStudentIncome;
use App\Models\CareerStudent;
use App\Models\AcademicYear;
use App\Models\Batch;
use App\Models\Major;

class SantriAmbassadorController extends Controller
{
    public function index(Request $request)
    {
        // 1. Get filter variables from query string
        $search = $request->input('search');
        $academicYearId = $request->input('academic_year_id');
        $batchId = $request->input('batch_id');
        $majorId = $request->input('major_id');
        $gender = $request->input('gender', 'all'); // Default to all (Semua Gender)

        // 2. Fetch options for dropdowns
        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();
        $majors = Major::orderBy('name', 'asc')->get();

        // 3. Build EducationStudent query with active/career phase
        $query = EducationStudent::with([
                'registration.educationProgram', 
                'registration.major', 
                'registration.academicYear',
                'registration.batch',
                'careerPlacement'
            ])
            ->where('status', 'passed')
            ->whereNotNull('career_start_date');

        // Apply filters on the query relationships
        $query->whereHas('registration', function($q) use ($search, $academicYearId, $batchId, $majorId, $gender) {
            if ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            }
            if ($academicYearId && $academicYearId !== 'all') {
                $q->where('academic_year_id', $academicYearId);
            }
            if ($batchId && $batchId !== 'all') {
                $q->where('batch_id', $batchId);
            }
            if ($majorId && $majorId !== 'all') {
                $q->where('major_id', $majorId);
            }
            if ($gender && $gender !== 'all') {
                $q->where('gender', $gender);
            }
        });

        // Execute query
        $educationStudentsRaw = $query->get();
        $contexts = CareerTargetContext::orderBy('name', 'asc')->get();

        $studentsMapped = $educationStudentsRaw->map(function ($student) use ($contexts) {
            // Fetch Incomes (Only approved incomes are displayed and calculated)
            $incomes = CareerStudentIncome::where('education_student_id', $student->id)->where('is_approved', true)->orderBy('date', 'desc')->get();
            $totalIncome = $incomes->sum('amount');

            // Fetch Karya Summaries per Context
            $karyaSummaries = [];
            $totalKarya = 0;
            $totalApproved = 0;
            
            foreach ($contexts as $ctx) {
                $submissions = CareerTargetSubmission::where('education_student_id', $student->id)
                    ->where('career_target_context_id', $ctx->id)
                    ->with(['values.field'])
                    ->orderBy('created_at', 'desc')
                    ->get();

                $approved = $submissions->where('score', 1)->count();
                $totalKarya += $submissions->count();
                $totalApproved += $approved;

                if ($submissions->count() > 0) {
                    $karyaSummaries[] = (object) [
                        'context_id' => $ctx->id,
                        'name' => $ctx->name,
                        'total_items' => $submissions->count(),
                        'approved_items' => $approved,
                        'submissions' => $submissions,
                    ];
                }
            }

            // Fetch Scores (soft + hard skills)
            $careerStudent = CareerStudent::where('registration_id', $student->registration_id)
                ->with('scores')
                ->first();
            
            $avgScores = null;
            if ($careerStudent && $careerStudent->scores->count() > 0) {
                $scores = $careerStudent->scores;
                $avgScores = (object) [
                    'communication' => round($scores->avg('soft_skill_communication'), 1),
                    'teamwork' => round($scores->avg('soft_skill_teamwork'), 1),
                    'discipline' => round($scores->avg('soft_skill_discipline'), 1),
                    'quality' => round($scores->avg('hard_skill_quality'), 1),
                    'speed' => round($scores->avg('hard_skill_speed'), 1),
                    'problem_solving' => round($scores->avg('hard_skill_problem_solving'), 1),
                ];
            }

            // Fetch Portfolios
            $portfolios = $careerStudent ? ($careerStudent->portfolios ?? collect()) : collect();

            // Real NIS
            $userAccount = \App\Models\User::where('email', $student->registration->email)->first();
            $nis = $userAccount ? $userAccount->username : ('2026' . str_pad($student->registration_id, 4, '0', STR_PAD_LEFT));

            return (object) [
                'id' => $student->id,
                'name' => $student->registration->name ?? 'Santri',
                'nis' => $nis,
                'photo' => $student->registration->photo ?? null,
                'email' => $student->registration->email ?? null,
                'program' => $student->registration->educationProgram->name ?? '-',
                'major' => $student->registration->major->name ?? '-',
                'placement' => $student->careerPlacement->name ?? null,
                'career_start_date' => $student->career_start_date,
                'career_end_date' => $student->career_end_date,
                'career_status' => $student->career_status ?? 'active',
                'total_income' => $totalIncome,
                'incomes' => $incomes,
                'total_karya' => $totalKarya,
                'total_approved' => $totalApproved,
                'karya_summaries' => $karyaSummaries,
                'avg_scores' => $avgScores,
                'portfolios' => $portfolios,
            ];
        });

        // Dynamic Context Stats for dynamic header counters
        $dynamicContextStats = [];
        foreach ($contexts as $ctx) {
            $totalSubmissionsForContext = \App\Models\CareerTargetSubmission::whereIn('education_student_id', $educationStudentsRaw->pluck('id'))
                ->where('career_target_context_id', $ctx->id)
                ->count();
            
            $dynamicContextStats[] = (object) [
                'name' => $ctx->name,
                'total' => $totalSubmissionsForContext
            ];
        }

        // Global statistics (calculated before paginating the collection)
        $globalStats = (object) [
            'total_students' => $studentsMapped->count(),
            'total_karya' => $studentsMapped->sum('total_karya'),
            'total_income' => $studentsMapped->sum('total_income'),
            'total_approved' => $studentsMapped->sum('total_approved'),
            'context_stats' => $dynamicContextStats,
        ];

        // Paginate the mapped collection manually (12 per page)
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
        $perPage = 12;
        $currentPageSearchResults = $studentsMapped->slice(($currentPage - 1) * $perPage, $perPage)->all();
        
        $students = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageSearchResults, 
            $studentsMapped->count(), 
            $perPage, 
            $currentPage, 
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('santri-ambassador.index', compact(
            'students', 
            'globalStats', 
            'contexts', 
            'academicYears', 
            'batches', 
            'majors', 
            'search',
            'academicYearId',
            'batchId',
            'majorId',
            'gender'
        ));
    }
}
