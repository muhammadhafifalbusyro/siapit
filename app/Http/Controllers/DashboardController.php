<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use App\Services\FonnteService;
use App\Models\Setting;
use App\Models\AcademicYear;
use App\Models\Batch;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\MatriculationPeriod;
use App\Models\MatriculationAspect;
use App\Models\MatriculationStudent;
use App\Models\MatriculationScore;
use App\Models\EducationPeriod;
use App\Models\EducationAspect;
use App\Models\EducationStudent;
use App\Models\EducationScore;
use App\Models\CareerPeriod;
use App\Models\CareerPlacement;
use App\Models\CareerStudent;
use App\Models\CareerLog;
use App\Models\CareerScore;
use App\Models\CareerPortfolio;

class DashboardController extends Controller
{
    public function superAdminDashboard(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        // Fetch lists for filter dropdowns
        $programs = \App\Models\EducationProgram::orderBy('name', 'asc')->get();
        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedProgramId = $request->input('education_program_id', 'all');
        $selectedAcademicYearId = $request->input('academic_year_id', 'all');
        $selectedBatchId = $request->input('batch_id', 'all');

        // Query Registrations matching filters
        $regQuery = Registration::query();
        if ($selectedProgramId !== 'all') {
            $regQuery->where('education_program_id', $selectedProgramId);
        }
        if ($selectedAcademicYearId !== 'all') {
            $regQuery->where('academic_year_id', $selectedAcademicYearId);
        }
        if ($selectedBatchId !== 'all') {
            $regQuery->where('batch_id', $selectedBatchId);
        }

        $filteredRegIds = $regQuery->pluck('id')->toArray();

        // ----------------- SECTION 1: DATA PENDAFTARAN -----------------
        $s1TotalPendaftar = (clone $regQuery)->count();
        $s1TotalWawancara = (clone $regQuery)->where('status', 'wawancara')->count();
        $s1TotalDiterimaIkhwan = (clone $regQuery)->where('status', 'penerimaan')
            ->where(function($q) {
                $q->where('gender', 'L')->orWhere('gender', 'Laki-laki');
            })->count();
        $s1TotalDiterimaAkhwat = (clone $regQuery)->where('status', 'penerimaan')
            ->where(function($q) {
                $q->where('gender', 'P')->orWhere('gender', 'Perempuan');
            })->count();
        $s1TotalDitolakIkhwan = (clone $regQuery)->where('status', 'ditolak')
            ->where(function($q) {
                $q->where('gender', 'L')->orWhere('gender', 'Laki-laki');
            })->count();
        $s1TotalDitolakAkhwat = (clone $regQuery)->where('status', 'ditolak')
            ->where(function($q) {
                $q->where('gender', 'P')->orWhere('gender', 'Perempuan');
            })->count();

        // ----------------- SECTION 2: DATA MATRIKULASI -----------------
        $matQuery = \App\Models\MatriculationStudent::whereIn('registration_id', $filteredRegIds);
        $s2TotalCalon = (clone $matQuery)->count();
        $s2TotalIkhwan = (clone $matQuery)->whereHas('registration', function($q) {
            $q->where('gender', 'L')->orWhere('gender', 'Laki-laki');
        })->count();
        $s2TotalAkhwat = (clone $matQuery)->whereHas('registration', function($q) {
            $q->where('gender', 'P')->orWhere('gender', 'Perempuan');
        })->count();
        $s2TotalAktif = (clone $matQuery)->where('status', 'active')->count();
        $s2TotalLulus = (clone $matQuery)->where('status', 'passed')->count();
        $s2TotalGugur = (clone $matQuery)->where('status', 'failed')->count();
        $s2TotalMundur = (clone $matQuery)->where('status', 'resigned')->count();

        // ----------------- SECTION 3: DATA MASA PENDIDIKAN -----------------
        $eduQuery = \App\Models\EducationStudent::whereIn('registration_id', $filteredRegIds);
        $s3TotalSantri = (clone $eduQuery)->count();
        $s3TotalIkhwan = (clone $eduQuery)->whereHas('registration', function($q) {
            $q->where('gender', 'L')->orWhere('gender', 'Laki-laki');
        })->count();
        $s3TotalAkhwat = (clone $eduQuery)->whereHas('registration', function($q) {
            $q->where('gender', 'P')->orWhere('gender', 'Perempuan');
        })->count();
        $s3TotalAktif = (clone $eduQuery)->where('status', 'active')->count();
        $s3TotalLulus = (clone $eduQuery)->where('status', 'passed')->count();
        $s3TotalGugur = (clone $eduQuery)->where('status', 'failed')->count();
        $s3TotalMundur = (clone $eduQuery)->where('status', 'resigned')->count();

        // ----------------- SECTION 4: DATA SANTRI BERKARYA -----------------
        $careerQuery = \App\Models\EducationStudent::whereIn('registration_id', $filteredRegIds)
            ->where('status', 'passed');
            
        $s4TotalBerkarya = (clone $careerQuery)
            ->whereNotNull('career_start_date')
            ->whereNotNull('career_end_date')
            ->count();

        $s4TotalAktif = (clone $careerQuery)
            ->where('career_status', 'active')
            ->whereNotNull('career_start_date')
            ->whereNotNull('career_end_date')
            ->count();
            
        $s4TotalLulus = (clone $careerQuery)->where('career_status', 'passed')->count();
        $s4TotalGugur = (clone $careerQuery)->where('career_status', 'failed')->count();
        $s4TotalMundur = (clone $careerQuery)->where('career_status', 'resigned')->count();

        $s4TotalDivisi = (clone $careerQuery)
            ->where('career_status', 'active')
            ->whereNotNull('career_start_date')
            ->whereNotNull('career_end_date')
            ->groupBy('career_placement_id')
            ->count('career_placement_id');

        // ----------------- SECTION 5: DATA TAGIHAN -----------------
        $totalCategories = \App\Models\BillingCategory::count();
        $categories = \App\Models\BillingCategory::all();
        
        $totalTarget = 0;
        $totalActual = \App\Models\BillingPayment::whereIn('registration_id', $filteredRegIds)->sum('amount');
        
        foreach ($categories as $cat) {
            $billedStudentsCount = \App\Models\BillingStudentBill::where('billing_category_id', $cat->id)
                ->where('is_billed', true)
                ->whereIn('registration_id', $filteredRegIds)
                ->whereHas('registration', function($q) {
                    $q->where('status', 'penerimaan');
                })
                ->count();
            $totalTarget += ($cat->total_amount * $billedStudentsCount);
        }

        $percentage = $totalTarget > 0 ? ($totalActual / $totalTarget) * 100 : 0;

        return view('super-admin.dashboard', compact(
            'user', 'programs', 'academicYears', 'batches',
            'selectedProgramId', 'selectedAcademicYearId', 'selectedBatchId',
            
            // Section 1
            's1TotalPendaftar', 's1TotalWawancara', 's1TotalDiterimaIkhwan', 's1TotalDiterimaAkhwat', 's1TotalDitolakIkhwan', 's1TotalDitolakAkhwat',
            
            // Section 2
            's2TotalCalon', 's2TotalIkhwan', 's2TotalAkhwat', 's2TotalAktif', 's2TotalLulus', 's2TotalGugur', 's2TotalMundur',
            
            // Section 3
            's3TotalSantri', 's3TotalIkhwan', 's3TotalAkhwat', 's3TotalAktif', 's3TotalLulus', 's3TotalGugur', 's3TotalMundur',
            
            // Section 4
            's4TotalBerkarya', 's4TotalAktif', 's4TotalLulus', 's4TotalGugur', 's4TotalMundur', 's4TotalDivisi',
            
            // Section 5
            'totalCategories', 'totalTarget', 'totalActual', 'percentage'
        ));
    }

    public function administrasiIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $programs = \App\Models\EducationProgram::orderBy('name', 'asc')->get();
        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedProgramId = $request->input('education_program_id', 'all');
        $selectedAcademicYearId = $request->input('academic_year_id', 'all');
        $selectedBatchId = $request->input('batch_id', 'all');

        $query = Registration::with(['educationProgram', 'major', 'academicYear', 'batch'])
            ->where('status', 'administrasi');

        if ($selectedProgramId !== 'all') {
            $query->where('education_program_id', $selectedProgramId);
        }
        if ($selectedAcademicYearId !== 'all') {
            $query->where('academic_year_id', $selectedAcademicYearId);
        }
        if ($selectedBatchId !== 'all') {
            $query->where('batch_id', $selectedBatchId);
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeTab = 'administrasi';
        return view('super-admin.pendaftaran.index', compact(
            'user', 'registrations', 'activeTab',
            'programs', 'academicYears', 'batches',
            'selectedProgramId', 'selectedAcademicYearId', 'selectedBatchId'
        ));
    }

    public function wawancaraIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $programs = \App\Models\EducationProgram::orderBy('name', 'asc')->get();
        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedProgramId = $request->input('education_program_id', 'all');
        $selectedAcademicYearId = $request->input('academic_year_id', 'all');
        $selectedBatchId = $request->input('batch_id', 'all');

        $query = Registration::with(['educationProgram', 'major', 'academicYear', 'batch'])
            ->where('status', 'wawancara');

        if ($selectedProgramId !== 'all') {
            $query->where('education_program_id', $selectedProgramId);
        }
        if ($selectedAcademicYearId !== 'all') {
            $query->where('academic_year_id', $selectedAcademicYearId);
        }
        if ($selectedBatchId !== 'all') {
            $query->where('batch_id', $selectedBatchId);
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeTab = 'wawancara';
        return view('super-admin.pendaftaran.index', compact(
            'user', 'registrations', 'activeTab',
            'programs', 'academicYears', 'batches',
            'selectedProgramId', 'selectedAcademicYearId', 'selectedBatchId'
        ));
    }

    public function penerimaanIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $programs = \App\Models\EducationProgram::orderBy('name', 'asc')->get();
        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedProgramId = $request->input('education_program_id', 'all');
        $selectedAcademicYearId = $request->input('academic_year_id', 'all');
        $selectedBatchId = $request->input('batch_id', 'all');

        $query = Registration::with(['educationProgram', 'major', 'academicYear', 'batch'])
            ->whereIn('status', ['penerimaan', 'ditolak']);

        if ($selectedProgramId !== 'all') {
            $query->where('education_program_id', $selectedProgramId);
        }
        if ($selectedAcademicYearId !== 'all') {
            $query->where('academic_year_id', $selectedAcademicYearId);
        }
        if ($selectedBatchId !== 'all') {
            $query->where('batch_id', $selectedBatchId);
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeTab = 'penerimaan';
        return view('super-admin.pendaftaran.index', compact(
            'user', 'registrations', 'activeTab',
            'programs', 'academicYears', 'batches',
            'selectedProgramId', 'selectedAcademicYearId', 'selectedBatchId'
        ));
    }

    public function updateStatus($id, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'required|in:administrasi,wawancara,penerimaan,ditolak'
        ]);

        $registration = Registration::findOrFail($id);
        $oldStatus = $registration->status;
        $registration->status = $request->status;
        $registration->save();

        // Send WhatsApp notification on status change
        try {
            $waMessage = "";
            if ($request->status === 'wawancara') {
                $waMessage = "Halo *" . $registration->name . "*,\n\nSelamat! Berkas pendaftaran Anda telah dinyatakan *LOLOS TAHAP ADMINISTRASI* di Pondok IT.\n\nTahap selanjutnya adalah *Tahap Wawancara*. Silakan tunggu informasi jadwal wawancara berikutnya melalui kontak ini.\n\nTerima kasih.";
            } elseif ($request->status === 'penerimaan') {
                $waMessage = "Halo *" . $registration->name . "*,\n\nSelamat! Anda dinyatakan *DITERIMA* sebagai Santri Baru di Pondok IT.\n\nSilakan persiapkan berkas fisik dan kebutuhan lainnya. Informasi daftar ulang akan kami sampaikan segera.\n\nBarakallahu fiik.";
            } elseif ($request->status === 'ditolak') {
                $waMessage = "Halo *" . $registration->name . "*,\n\nTerima kasih telah mendaftar di Pondok IT. Setelah melalui proses seleksi, dengan berat hati kami sampaikan bahwa saat ini Anda belum dapat bergabung dengan kami.\n\nTetap semangat belajar dan berkarya. Semoga sukses di langkah Anda selanjutnya.";
            }

            if (!empty($waMessage)) {
                FonnteService::sendWhatsApp($registration->whatsapp, $waMessage);
                
                // Also send to guardian
                if ($registration->guardian_whatsapp) {
                    $guardianWa = "";
                    if ($request->status === 'wawancara') {
                        $guardianWa = "Halo *" . $registration->guardian_name . "*,\n\nKami menginfokan bahwa putra/putri Anda yang bernama *" . $registration->name . "* dinyatakan *Lolos Tahap Administrasi* di Pondok IT dan akan masuk ke Tahap Wawancara.";
                    } elseif ($request->status === 'penerimaan') {
                        $guardianWa = "Halo *" . $registration->guardian_name . "*,\n\nSelamat! Putra/putri Anda yang bernama *" . $registration->name . "* dinyatakan *DITERIMA* sebagai Santri Baru di Pondok IT.";
                    }
                    if (!empty($guardianWa)) {
                        FonnteService::sendWhatsApp($registration->guardian_whatsapp, $guardianWa);
                    }
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim WhatsApp notifikasi perubahan status: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Status pendaftaran ' . $registration->name . ' berhasil diperbarui menjadi ' . ucfirst($registration->status) . '.'
        ]);
    }

    public function santriDashboard()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        // 1. Get student registration profile
        $registration = Registration::where('email', $user->email)->first();
        
        $activePhase = 'Administrasi';
        $classroomName = 'Belum Ada Kelas';
        $matriculationStudent = null;
        $educationStudent = null;
        $careerStudent = null;
        $unpaidBillsCount = 0;
        $totalSubmissions = 0;

        if ($registration) {
            // Check Matriculation (with classroom, homeroom teacher, and classmates)
            $matriculationStudent = \App\Models\MatriculationStudent::with([
                'classroom.homeroomTeacher',
                'classroom.assistantTeachers',
                'classroom.matriculationStudents.registration.user'
            ])->where('registration_id', $registration->id)->first();

            if ($matriculationStudent) {
                $activePhase = 'Matrikulasi';
                $classroomName = $matriculationStudent->classroom?->name ?? 'Kelas Matrikulasi';
            }

            // Check Education (override if active or passed) (with classroom, homeroom teacher, and classmates)
            $educationStudent = \App\Models\EducationStudent::with([
                'classroom.homeroomTeacher',
                'classroom.assistantTeachers',
                'registration.user'
            ])->where('registration_id', $registration->id)->first();

            // Ambil data siswa sekelas pendidikan secara manual jika terdaftar di kelas
            $educationClassmates = collect();
            if ($educationStudent && $educationStudent->classroom_id) {
                $educationClassmates = \App\Models\EducationStudent::with('registration.user')
                    ->where('classroom_id', $educationStudent->classroom_id)
                    ->get();
            }

            if ($educationStudent) {
                if ($educationStudent->status === 'active') {
                    $activePhase = 'Masa Pendidikan';
                    $classroomName = $educationStudent->classroom?->name ?? 'Kelas Pendidikan';
                } elseif ($educationStudent->status === 'passed') {
                    $activePhase = 'Masa Berkarya';
                    $classroomName = $educationStudent->careerPlacement?->name ?? 'Divisi Berkarya';
                }
            }

            // Check Career (override if active)
            $careerStudent = \App\Models\CareerStudent::with(['placement'])->where('registration_id', $registration->id)->first();
            
            // Ambil anggota divisi yang sama di masa berkarya
            $careerClassmates = collect();
            if ($careerStudent && $careerStudent->career_placement_id) {
                $careerClassmates = \App\Models\CareerStudent::with('registration.user')
                    ->where('career_placement_id', $careerStudent->career_placement_id)
                    ->get();
            }

            if ($careerStudent && $careerStudent->status === 'active') {
                $activePhase = 'Masa Berkarya';
                $classroomName = $careerStudent->placement?->name ?? 'Divisi Berkarya';
                
                $totalSubmissions = \App\Models\CareerTargetSubmission::where('education_student_id', $educationStudent?->id ?? $registration->id)->count();
            }

            // Unpaid bills count (Compare category total amount vs student payments sum)
            $studentBills = \App\Models\BillingStudentBill::where('registration_id', $registration->id)
                ->where('is_billed', true)
                ->get();

            foreach ($studentBills as $bill) {
                $category = $bill->billingCategory;
                if ($category) {
                    $paidAmount = \App\Models\BillingPayment::where('registration_id', $registration->id)
                        ->where('billing_category_id', $category->id)
                        ->sum('amount');
                    
                    if ($paidAmount < $category->total_amount) {
                        $unpaidBillsCount++;
                    }
                }
            }
        }

        return view('santri.dashboard', compact(
            'user',
            'registration',
            'activePhase',
            'classroomName',
            'unpaidBillsCount',
            'totalSubmissions',
            'careerStudent',
            'matriculationStudent',
            'educationStudent',
            'educationClassmates',
            'careerClassmates'
        ));
    }

    public function santriMatriculationDailyControl(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $registration = Registration::where('email', $user->email)->first();
        if (!$registration) {
            abort(404, 'Data Registrasi Santri tidak ditemukan.');
        }

        $matriculationStudent = \App\Models\MatriculationStudent::where('registration_id', $registration->id)->first();
        $activePeriod = null;
        $months = [];
        $selectedMonth = $request->input('month');
        $selectedAspectId = $request->input('matriculation_aspect_id');
        $selectedAspect = null;
        $dates = [];
        $scores = collect();

        if ($matriculationStudent) {
            $activePeriod = \App\Models\MatriculationPeriod::with('aspects')
                ->where('id', $matriculationStudent->matriculation_period_id)
                ->first();

            if ($activePeriod) {
                $start = \Carbon\Carbon::parse($activePeriod->start_date);
                $end = \Carbon\Carbon::parse($activePeriod->end_date);
                $curr = $start->copy()->startOfMonth();
                while ($curr->lte($end)) {
                    $months[] = [
                        'value' => $curr->format('Y-m'),
                        'label' => $curr->translatedFormat('F Y'),
                    ];
                    $curr->addMonth();
                }

                $monthExists = collect($months)->where('value', $selectedMonth)->first();
                if ((empty($selectedMonth) || !$monthExists) && count($months) > 0) {
                    $selectedMonth = $months[0]['value'];
                }

                if (!$selectedAspectId) {
                    $selectedAspectId = $activePeriod->aspects->first()?->id;
                }
                $selectedAspect = $activePeriod->aspects->where('id', $selectedAspectId)->first();

                if ($selectedMonth) {
                    $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
                    $daysInMonth = $monthCarbon->daysInMonth;
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
                        $dateCarbon = \Carbon\Carbon::parse($dateStr);
                        if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                            $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                            $dates[] = $dateStr;
                        }
                    }
                }

                if ($selectedAspect) {
                    $scores = \App\Models\MatriculationScore::where('matriculation_student_id', $matriculationStudent->id)
                        ->where('matriculation_aspect_id', $selectedAspect->id)
                        ->whereIn('evaluation_date', $dates)
                        ->get();
                }
            }
        }

        return view('santri.matriculation.daily-control', compact(
            'user', 'registration', 'matriculationStudent', 'activePeriod', 
            'months', 'selectedMonth', 'selectedAspectId', 'selectedAspect', 'dates', 'scores'
        ));
    }

    public function santriEducationDailyControl(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $registration = Registration::where('email', $user->email)->first();
        if (!$registration) {
            abort(404, 'Data Registrasi Santri tidak ditemukan.');
        }

        $educationStudent = \App\Models\EducationStudent::with('classroom')->where('registration_id', $registration->id)->first();
        $activePeriod = null;
        $months = [];
        $selectedMonth = $request->input('month');
        $selectedAspectId = $request->input('education_aspect_id');
        $selectedAspect = null;
        $dates = [];
        $scores = collect();

        if ($educationStudent) {
            $classroom = $educationStudent->classroom;
            $activePeriod = \App\Models\EducationPeriod::with('aspects')
                ->where('id', $educationStudent->education_period_id)
                ->first();

            if ($activePeriod) {
                $start = \Carbon\Carbon::parse($activePeriod->start_date);
                $end = \Carbon\Carbon::parse($activePeriod->end_date);
                $curr = $start->copy()->startOfMonth();
                while ($curr->lte($end)) {
                    $months[] = [
                        'value' => $curr->format('Y-m'),
                        'label' => $curr->translatedFormat('F Y'),
                    ];
                    $curr->addMonth();
                }

                $monthExists = collect($months)->where('value', $selectedMonth)->first();
                if ((empty($selectedMonth) || !$monthExists) && count($months) > 0) {
                    $selectedMonth = $months[0]['value'];
                }

                // Filter aspects
                $allowedAspects = $activePeriod->aspects()
                    ->where(function($q) use ($classroom) {
                        $q->where('type', 'character');
                        if ($classroom && $classroom->education_skill_id) {
                            $q->orWhere(function($q2) use ($classroom) {
                                $q2->where('type', 'skill')
                                   ->where('education_skill_id', $classroom->education_skill_id);
                            });
                        }
                    })->get();
                $activePeriod->setRelation('aspects', $allowedAspects);

                if (!$selectedAspectId || !$allowedAspects->where('id', $selectedAspectId)->first()) {
                    $selectedAspectId = $allowedAspects->first()?->id;
                }
                $selectedAspect = $allowedAspects->where('id', $selectedAspectId)->first();

                if ($selectedMonth) {
                    $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
                    $daysInMonth = $monthCarbon->daysInMonth;
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
                        $dateCarbon = \Carbon\Carbon::parse($dateStr);
                        if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                            $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                            $dates[] = $dateStr;
                        }
                    }
                }

                if ($selectedAspect) {
                    $scores = \App\Models\EducationScore::where('education_student_id', $educationStudent->id)
                        ->where('education_aspect_id', $selectedAspect->id)
                        ->whereIn('evaluation_date', $dates)
                        ->get();
                }
            }
        }

        return view('santri.education.daily-control', compact(
            'user', 'registration', 'educationStudent', 'activePeriod', 
            'months', 'selectedMonth', 'selectedAspectId', 'selectedAspect', 'dates', 'scores'
        ));
    }

    public function santriMatriculationRapor()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $registration = Registration::where('email', $user->email)->first();
        if (!$registration) {
            abort(404, 'Data Registrasi Santri tidak ditemukan.');
        }

        $matriculationStudent = \App\Models\MatriculationStudent::with(['scores', 'classroom.academicYear', 'classroom.batch'])
            ->where('registration_id', $registration->id)
            ->first();

        $activePeriod = null;
        $raporPayload = null;

        if ($matriculationStudent) {
            $activePeriod = \App\Models\MatriculationPeriod::with('aspects')
                ->where('id', $matriculationStudent->matriculation_period_id)
                ->first();

            if ($activePeriod) {
                $classroom = $matriculationStudent->classroom;
                $allowedAspects = $activePeriod->aspects()
                    ->where(function($q) use ($classroom) {
                        $q->where('type', 'character');
                        if ($classroom && $classroom->matriculation_skill_id) {
                            $q->orWhere(function($q2) use ($classroom) {
                                $q2->where('type', 'skill')
                                   ->where('matriculation_skill_id', $classroom->matriculation_skill_id);
                            });
                        }
                    })->get();
                $activePeriod->setRelation('aspects', $allowedAspects);
                // Generate period months
                $periodMonths = [];
                $start = \Carbon\Carbon::parse($activePeriod->start_date)->startOfMonth();
                $end = \Carbon\Carbon::parse($activePeriod->end_date)->startOfMonth();
                while ($start->lte($end)) {
                    $periodMonths[] = [
                        'label' => $start->locale('id')->translatedFormat('F Y'),
                        'value' => $start->format('Y-m'),
                        'year' => $start->year,
                        'month' => $start->month
                    ];
                    $start->addMonth();
                }

                // Monthly calculation
                $monthlyReportsPayload = [];
                foreach ($periodMonths as $pm) {
                    $charScoreM = 0; $charWeightSumM = 0; $skillScoreM = 0; $skillWeightSumM = 0;
                    $aspectCalculationsM = [];
                    $hasActiveDaysM = false;

                    foreach ($activePeriod->aspects as $aspect) {
                        $aspectActiveDays = is_string($aspect->active_days) ? json_decode($aspect->active_days, true) : ($aspect->active_days ?? []);
                        $monthActiveDays = array_filter($aspectActiveDays, function($day) use ($pm) {
                            $carbonDay = \Carbon\Carbon::parse($day);
                            return $carbonDay->year == $pm['year'] && $carbonDay->month == $pm['month'];
                        });

                        $isMonthActive = !empty($monthActiveDays);
                        $scoreValM = 0; $detailTextM = 'Materi belum dijadwalkan';

                        if ($isMonthActive) {
                            $hasActiveDaysM = true;
                            $stScores = $matriculationStudent->scores->where('matriculation_aspect_id', $aspect->id);
                            
                            if ($aspect->input_type === 'checklist') {
                                $realDays = 0; $targetDays = 0;
                                foreach ($monthActiveDays as $day) {
                                    $sc = $stScores->where('evaluation_date', $day)->first();
                                    $val = $sc ? (int)$sc->score : 0;
                                    if ($val === 1) { $realDays++; $targetDays++; } 
                                    elseif ($val === 0) { $targetDays++; }
                                }
                                $scoreValM = $targetDays > 0 ? ($realDays / $targetDays) * 100 : 0;
                                $detailTextM = $realDays . ' Hari Hadir dari ' . $targetDays . ' Hari Aktif';
                            } elseif ($aspect->input_type === 'counter') {
                                $activeScores = $stScores->whereIn('evaluation_date', $monthActiveDays);
                                $sumRawM = $activeScores->sum('score') ?? 0;
                                $kkmVal = (float)($aspect->target_weekly ?? 3);
                                $scoreValM = $kkmVal > 0 ? ($sumRawM / $kkmVal) * 100 : 0;
                                $detailTextM = $sumRawM . ' dari ' . (int)$kkmVal . ' target';
                            } else {
                                $activeScores = $stScores->whereIn('evaluation_date', $monthActiveDays);
                                $avgRawM = $activeScores->avg('score') ?? 0;
                                $kkmVal = (float)($aspect->target_weekly ?? 80);
                                $scoreValM = $kkmVal > 0 ? ($avgRawM / $kkmVal) * 100 : 0;
                                $detailTextM = 'Rata-rata: ' . number_format($avgRawM, 1) . ' (KKM: ' . number_format($kkmVal, 0) . ')';
                            }

                            $weightedContributionM = $scoreValM * ($aspect->weight_percentage / 100);

                            if ($aspect->type === 'character') { 
                                $charScoreM += $weightedContributionM; 
                                $charWeightSumM += $aspect->weight_percentage; 
                            } else { 
                                $skillScoreM += $weightedContributionM; 
                                $skillWeightSumM += $aspect->weight_percentage; 
                            }

                            $aspectCalculationsM[] = [
                                'name' => $aspect->name,
                                'type' => $aspect->type === 'character' ? 'Karakter' : 'Skill',
                                'input_type' => $aspect->input_type,
                                'weight' => $aspect->weight_percentage,
                                'score' => round($scoreValM, 1) . '%',
                                'weighted' => round($weightedContributionM, 1) . '%',
                                'detail' => $detailTextM
                            ];
                        }
                    }

                    $normalizedCharM = $charWeightSumM > 0 ? ($charScoreM * (100 / $charWeightSumM)) : 0;
                    $normalizedSkillM = $skillWeightSumM > 0 ? ($skillScoreM * (100 / $skillWeightSumM)) : 0;
                    $monthFinalScore = ($normalizedCharM * 0.5) + ($normalizedSkillM * 0.5);

                    if ($hasActiveDaysM) {
                        $monthlyReportsPayload[] = [
                            'label' => $pm['label'],
                            'char_avg' => round($normalizedCharM, 1),
                            'skill_avg' => round($normalizedSkillM, 1),
                            'final_score' => $monthFinalScore !== null ? round($monthFinalScore, 1) : '-',
                            'aspects' => $aspectCalculationsM
                        ];
                    }
                }

                // Cumulative calculations
                $activeCharAvgs = array_filter(array_column($monthlyReportsPayload, 'char_avg'), function($v) {
                    return $v !== null && $v !== '-';
                });
                $activeSkillAvgs = array_filter(array_column($monthlyReportsPayload, 'skill_avg'), function($v) {
                    return $v !== null && $v !== '-';
                });
                $activeMonthScores = array_filter(array_column($monthlyReportsPayload, 'final_score'), function($v) {
                    return $v !== null && $v !== '-';
                });

                $normalizedChar = count($activeCharAvgs) > 0 ? array_sum($activeCharAvgs) / count($activeCharAvgs) : 0;
                $normalizedSkill = count($activeSkillAvgs) > 0 ? array_sum($activeSkillAvgs) / count($activeSkillAvgs) : 0;
                $finalScore = count($activeMonthScores) > 0 ? array_sum($activeMonthScores) / count($activeMonthScores) : 0;

                // Cumulative Aspects list
                $aspectCalculations = [];
                foreach($activePeriod->aspects as $aspect) {
                    $aspectActiveDays = is_string($aspect->active_days) ? json_decode($aspect->active_days, true) : ($aspect->active_days ?? []);
                    $stScores = $matriculationStudent->scores->where('matriculation_aspect_id', $aspect->id);
                    $isAspectActive = !empty($aspectActiveDays);
                    
                    $scoreVal = 0; $detailText = 'Materi belum dijadwalkan';
                    $weightedContribution = 0;

                    if ($isAspectActive) {
                        if ($aspect->input_type === 'checklist') {
                            $realDays = 0; $targetDays = 0;
                            foreach ($aspectActiveDays as $day) {
                                $sc = $stScores->where('evaluation_date', $day)->first();
                                $val = $sc ? (int)$sc->score : 0;
                                if ($val === 1) { $realDays++; $targetDays++; } 
                                elseif ($val === 0) { $targetDays++; }
                            }
                            $scoreVal = $targetDays > 0 ? ($realDays / $targetDays) * 100 : 0;
                            $detailText = $realDays . ' Hari Hadir dari ' . $targetDays . ' Hari Aktif';
                        } elseif ($aspect->input_type === 'counter') {
                            $activeScores = $stScores->whereIn('evaluation_date', $aspectActiveDays);
                            $sumRaw = $activeScores->sum('score') ?? 0;
                            $kkmVal = (float)($aspect->target_weekly ?? 3);
                            $scoreVal = $kkmVal > 0 ? ($sumRaw / $kkmVal) * 100 : 0;
                            $detailText = $sumRaw . ' dari ' . (int)$kkmVal . ' target';
                        } else {
                            $activeScores = $stScores->whereIn('evaluation_date', $aspectActiveDays);
                            $rawAvg = $activeScores->avg('score') ?? 0;
                            $kkmVal = (float)($aspect->target_weekly ?? 80);
                            $scoreVal = $kkmVal > 0 ? ($rawAvg / $kkmVal) * 100 : 0;
                            $detailText = 'Rata-rata: ' . number_format($rawAvg, 1) . ' (KKM: ' . number_format($kkmVal, 0) . ')';
                        }
                        $weightedContribution = $scoreVal * ($aspect->weight_percentage / 100);
                    }

                    $aspectCalculations[] = [ 
                        'name' => $aspect->name, 
                        'type' => $aspect->type === 'character' ? 'Karakter' : 'Skill', 
                        'input_type' => $aspect->input_type, 
                        'weight' => $aspect->weight_percentage, 
                        'score' => $isAspectActive ? (round($scoreVal, 1) . '%') : '-', 
                        'weighted' => $isAspectActive ? (round($weightedContribution, 1) . '%') : '-', 
                        'detail' => $detailText 
                    ];
                }

                $raporPayload = [
                    'student_name' => $registration->name,
                    'student_photo' => $registration->photo ? asset('storage/' . $registration->photo) : null,
                    'major_name' => $registration->major->name ?? '-',
                    'classroom_name' => $matriculationStudent->classroom->name ?? '-',
                    'academic_year' => $matriculationStudent->classroom->academicYear->name ?? '-',
                    'batch' => $matriculationStudent->classroom->batch->name ?? '-',
                    'char_avg' => round($normalizedChar, 2),
                    'skill_avg' => round($normalizedSkill, 2),
                    'final_score' => round($finalScore, 2),
                    'status' => $matriculationStudent->status,
                    'aspects' => $aspectCalculations,
                    'monthly_reports' => $monthlyReportsPayload
                ];
            }
        }

        return view('santri.matriculation.rapor', compact('user', 'registration', 'matriculationStudent', 'activePeriod', 'raporPayload'));
    }

    public function santriEducationRapor()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $registration = Registration::where('email', $user->email)->first();
        if (!$registration) {
            abort(404, 'Data Registrasi Santri tidak ditemukan.');
        }

        $educationStudent = \App\Models\EducationStudent::with(['scores', 'classroom.academicYear', 'classroom.batch'])
            ->where('registration_id', $registration->id)
            ->first();

        $activePeriod = null;
        $raporPayload = null;

        if ($educationStudent) {
            $classroom = $educationStudent->classroom;
            $activePeriod = \App\Models\EducationPeriod::with('aspects')
                ->where('id', $educationStudent->education_period_id)
                ->first();

            if ($activePeriod) {
                // Filter aspects
                $allowedAspects = $activePeriod->aspects()
                    ->where(function($q) use ($classroom) {
                        $q->where('type', 'character');
                        if ($classroom && $classroom->education_skill_id) {
                            $q->orWhere(function($q2) use ($classroom) {
                                $q2->where('type', 'skill')
                                   ->where('education_skill_id', $classroom->education_skill_id);
                            });
                        }
                    })->get();
                $activePeriod->setRelation('aspects', $allowedAspects);
                // Generate period months
                $periodMonths = [];
                $start = \Carbon\Carbon::parse($activePeriod->start_date)->startOfMonth();
                $end = \Carbon\Carbon::parse($activePeriod->end_date)->startOfMonth();
                while ($start->lte($end)) {
                    $periodMonths[] = [
                        'label' => $start->locale('id')->translatedFormat('F Y'),
                        'value' => $start->format('Y-m'),
                        'year' => $start->year,
                        'month' => $start->month
                    ];
                    $start->addMonth();
                }

                // Monthly calculation
                $monthlyReportsPayload = [];
                foreach ($periodMonths as $pm) {
                    $charScoreM = 0; $charWeightSumM = 0; $skillScoreM = 0; $skillWeightSumM = 0;
                    $aspectCalculationsM = [];
                    $hasActiveDaysM = false;

                    foreach ($activePeriod->aspects as $aspect) {
                        $aspectActiveDays = is_string($aspect->active_days) ? json_decode($aspect->active_days, true) : ($aspect->active_days ?? []);
                        $monthActiveDays = array_filter($aspectActiveDays, function($day) use ($pm) {
                            $carbonDay = \Carbon\Carbon::parse($day);
                            return $carbonDay->year == $pm['year'] && $carbonDay->month == $pm['month'];
                        });

                        $isMonthActive = !empty($monthActiveDays);
                        $scoreValM = 0; $detailTextM = 'Materi belum dijadwalkan';

                        if ($isMonthActive) {
                            $hasActiveDaysM = true;
                            $stScores = $educationStudent->scores->where('education_aspect_id', $aspect->id);
                            
                            if ($aspect->input_type === 'checklist') {
                                $realDays = 0; $targetDays = 0;
                                foreach ($monthActiveDays as $day) {
                                    $sc = $stScores->where('evaluation_date', $day)->first();
                                    $val = $sc ? (int)$sc->score : 0;
                                    if ($val === 1) { $realDays++; $targetDays++; } 
                                    elseif ($val === 0) { $targetDays++; }
                                }
                                $scoreValM = $targetDays > 0 ? ($realDays / $targetDays) * 100 : 0;
                                $detailTextM = $realDays . ' Hari Hadir dari ' . $targetDays . ' Hari Aktif';
                            } elseif ($aspect->input_type === 'counter') {
                                $activeScores = $stScores->whereIn('education_date', $monthActiveDays);
                                $sumRawM = $activeScores->sum('score') ?? 0;
                                $kkmVal = (float)($aspect->target_weekly ?? 3);
                                $scoreValM = $kkmVal > 0 ? ($sumRawM / $kkmVal) * 100 : 0;
                                $detailTextM = $sumRawM . ' dari ' . (int)$kkmVal . ' target';
                            } else {
                                $activeScores = $stScores->whereIn('education_date', $monthActiveDays);
                                $avgRawM = $activeScores->avg('score') ?? 0;
                                $kkmVal = (float)($aspect->target_weekly ?? 80);
                                $scoreValM = $kkmVal > 0 ? ($avgRawM / $kkmVal) * 100 : 0;
                                $detailTextM = 'Rata-rata: ' . number_format($avgRawM, 1) . ' (KKM: ' . number_format($kkmVal, 0) . ')';
                            }

                            $weightedContributionM = $scoreValM * ($aspect->weight_percentage / 100);

                            if ($aspect->type === 'character') { 
                                $charScoreM += $weightedContributionM; 
                                $charWeightSumM += $aspect->weight_percentage; 
                            } else { 
                                $skillScoreM += $weightedContributionM; 
                                $skillWeightSumM += $aspect->weight_percentage; 
                            }

                            $aspectCalculationsM[] = [
                                'name' => $aspect->name,
                                'type' => $aspect->type === 'character' ? 'Karakter' : 'Skill',
                                'input_type' => $aspect->input_type,
                                'weight' => $aspect->weight_percentage,
                                'score' => round($scoreValM, 1) . '%',
                                'weighted' => round($weightedContributionM, 1) . '%',
                                'detail' => $detailTextM
                            ];
                        }
                    }

                    $normalizedCharM = $charWeightSumM > 0 ? ($charScoreM * (100 / $charWeightSumM)) : 0;
                    $normalizedSkillM = $skillWeightSumM > 0 ? ($skillScoreM * (100 / $skillWeightSumM)) : 0;
                    $monthFinalScore = ($normalizedCharM * 0.5) + ($normalizedSkillM * 0.5);

                    if ($hasActiveDaysM) {
                        $monthlyReportsPayload[] = [
                            'label' => $pm['label'],
                            'char_avg' => round($normalizedCharM, 1),
                            'skill_avg' => round($normalizedSkillM, 1),
                            'final_score' => $monthFinalScore !== null ? round($monthFinalScore, 1) : '-',
                            'aspects' => $aspectCalculationsM
                        ];
                    }
                }

                // Cumulative calculations
                $activeCharAvgs = array_filter(array_column($monthlyReportsPayload, 'char_avg'), function($v) {
                    return $v !== null && $v !== '-';
                });
                $activeSkillAvgs = array_filter(array_column($monthlyReportsPayload, 'skill_avg'), function($v) {
                    return $v !== null && $v !== '-';
                });
                $activeMonthScores = array_filter(array_column($monthlyReportsPayload, 'final_score'), function($v) {
                    return $v !== null && $v !== '-';
                });

                $normalizedChar = count($activeCharAvgs) > 0 ? array_sum($activeCharAvgs) / count($activeCharAvgs) : 0;
                $normalizedSkill = count($activeSkillAvgs) > 0 ? array_sum($activeSkillAvgs) / count($activeSkillAvgs) : 0;
                $finalScore = count($activeMonthScores) > 0 ? array_sum($activeMonthScores) / count($activeMonthScores) : 0;

                // Cumulative Aspects list
                $aspectCalculations = [];
                foreach($activePeriod->aspects as $aspect) {
                    $aspectActiveDays = is_string($aspect->active_days) ? json_decode($aspect->active_days, true) : ($aspect->active_days ?? []);
                    $stScores = $educationStudent->scores->where('education_aspect_id', $aspect->id);
                    $isAspectActive = !empty($aspectActiveDays);
                    
                    $scoreVal = 0; $detailText = 'Materi belum dijadwalkan';
                    $weightedContribution = 0;

                    if ($isAspectActive) {
                        if ($aspect->input_type === 'checklist') {
                            $realDays = 0; $targetDays = 0;
                            foreach ($aspectActiveDays as $day) {
                                $sc = $stScores->where('education_date', $day)->first();
                                $val = $sc ? (int)$sc->score : 0;
                                if ($val === 1) { $realDays++; $targetDays++; } 
                                elseif ($val === 0) { $targetDays++; }
                            }
                            $scoreVal = $targetDays > 0 ? ($realDays / $targetDays) * 100 : 0;
                            $detailText = $realDays . ' Hari Hadir dari ' . $targetDays . ' Hari Aktif';
                        } elseif ($aspect->input_type === 'counter') {
                            $activeScores = $stScores->whereIn('education_date', $aspectActiveDays);
                            $sumRaw = $activeScores->sum('score') ?? 0;
                            $kkmVal = (float)($aspect->target_weekly ?? 3);
                            $scoreVal = $kkmVal > 0 ? ($sumRaw / $kkmVal) * 100 : 0;
                            $detailText = $sumRaw . ' dari ' . (int)$kkmVal . ' target';
                        } else {
                            $activeScores = $stScores->whereIn('education_date', $aspectActiveDays);
                            $rawAvg = $activeScores->avg('score') ?? 0;
                            $kkmVal = (float)($aspect->target_weekly ?? 80);
                            $scoreVal = $kkmVal > 0 ? ($rawAvg / $kkmVal) * 100 : 0;
                            $detailText = 'Rata-rata: ' . number_format($rawAvg, 1) . ' (KKM: ' . number_format($kkmVal, 0) . ')';
                        }
                        $weightedContribution = $scoreVal * ($aspect->weight_percentage / 100);
                    }

                    $aspectCalculations[] = [ 
                        'name' => $aspect->name, 
                        'type' => $aspect->type === 'character' ? 'Karakter' : 'Skill', 
                        'input_type' => $aspect->input_type, 
                        'weight' => $aspect->weight_percentage, 
                        'score' => $isAspectActive ? (round($scoreVal, 1) . '%') : '-', 
                        'weighted' => $isAspectActive ? (round($weightedContribution, 1) . '%') : '-', 
                        'detail' => $detailText 
                    ];
                }

                $raporPayload = [
                    'student_name' => $registration->name,
                    'student_photo' => $registration->photo ? asset('storage/' . $registration->photo) : null,
                    'major_name' => $registration->major->name ?? '-',
                    'classroom_name' => $educationStudent->classroom->name ?? '-',
                    'academic_year' => $educationStudent->classroom->academicYear->name ?? '-',
                    'batch' => $educationStudent->classroom->batch->name ?? '-',
                    'char_avg' => round($normalizedChar, 2),
                    'skill_avg' => round($normalizedSkill, 2),
                    'final_score' => round($finalScore, 2),
                    'status' => $educationStudent->status,
                    'aspects' => $aspectCalculations,
                    'monthly_reports' => $monthlyReportsPayload
                ];
            }
        }

        return view('santri.education.rapor', compact('user', 'registration', 'educationStudent', 'activePeriod', 'raporPayload'));
    }

    public function santriProyekIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $registration = Registration::where('email', $user->email)->first();
        if (!$registration) {
            abort(404, 'Data Registrasi Santri tidak ditemukan.');
        }

        $educationStudent = \App\Models\EducationStudent::where('registration_id', $registration->id)->first();
        
        // Backend Strong Validation: Harus terdaftar di pendidikan, lulus (passed), dan diset tanggal mulai berkarya
        if (!$educationStudent || 
            $educationStudent->status !== 'passed' || 
            empty($educationStudent->career_start_date) || 
            empty($educationStudent->career_end_date)) {
            
            // Render view kosong / batasan akses langsung dari backend
            $careerStudent = null;
            return view('santri.proyek', compact('user', 'registration', 'careerStudent'));
        }

        $careerStudent = CareerStudent::with(['placement', 'portfolios'])->where('registration_id', $registration->id)->first();
        $activeTab = $request->input('tab', 'overview');
        $logs = [];
        $contexts = [];
        $submissions = [];
        $incomes = [];
        $summaries = [];
        $totalIncome = 0;

        if ($careerStudent) {
            // Get daily logs
            $logs = CareerLog::where('career_student_id', $careerStudent->id)
                ->orderBy('log_date', 'desc')
                ->get();

            // Get target contexts
            $contexts = \App\Models\CareerTargetContext::with('fields')->orderBy('name', 'asc')->get();

            // Get submissions
            $submissions = \App\Models\CareerTargetSubmission::with(['values.field', 'context'])
                ->where('education_student_id', $educationStudent->id)
                ->get();

            // Get incomes
            $incomes = \App\Models\CareerStudentIncome::where('education_student_id', $educationStudent->id)
                ->orderBy('date', 'desc')
                ->get();

            // Calculate total approved income
            $totalIncome = $incomes->where('is_approved', 1)->sum('amount');

            // Build contexts summaries
            foreach ($contexts as $ctx) {
                $subCount = $submissions->where('career_target_context_id', $ctx->id)->count();
                $summaries[] = [
                    'context' => $ctx,
                    'total_submissions' => $subCount
                ];
            }
        }

        return view('santri.proyek', compact(
            'user', 'registration', 'careerStudent', 'educationStudent', 
            'logs', 'contexts', 'submissions', 'incomes', 'activeTab', 'summaries', 'totalIncome'
        ));
    }

    public function santriLogbookStore(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $request->validate([
            'career_student_id' => 'required|exists:career_students,id',
            'log_date' => 'required|date',
            'activity_desc' => 'required|string',
            'progress_link' => 'nullable|url',
        ]);

        CareerLog::create($request->all() + ['status' => 'pending']);

        return redirect()->back()->with('success', 'Jurnal harian berhasil dikirim untuk diapprove.');
    }

    public function santriPortfolioStore(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $request->validate([
            'career_student_id' => 'required|exists:career_students,id',
            'title' => 'required|string',
            'project_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        CareerPortfolio::create($request->all());

        return redirect()->back()->with('success', 'Karya/Portofolio berhasil ditambahkan.');
    }

    public function santriIncomeStore(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $request->validate([
            'education_student_id' => 'required',
            'amount' => 'required',
            'source' => 'required|string',
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'proof_image' => 'nullable|image|max:2048',
        ]);

        $amount = (float) str_replace(['Rp', '.', ' ', ','], '', $request->amount);

        $proofPath = null;
        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/incomes'), $filename);
            $proofPath = '/uploads/incomes/' . $filename;
        }

        \App\Models\CareerStudentIncome::create([
            'education_student_id' => $request->education_student_id,
            'amount' => $amount,
            'source' => $request->source,
            'date' => $request->date,
            'notes' => $request->notes,
            'proof_image' => $proofPath,
            'is_approved' => false
        ]);

        return redirect()->back()->with('success', 'Pengajuan penghasilan berhasil diajukan.');
    }

    public function santriSubmissionStore(Request $request, $context_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') { return redirect('/login'); }
        $registration = Registration::where('email', $user->email)->first();
        $educationStudent = \App\Models\EducationStudent::where('registration_id', $registration->id)->first();
        if (!$educationStudent) { return redirect()->back()->with('error', 'Status pendidikan belum diset.'); }

        $context = \App\Models\CareerTargetContext::with('fields')->findOrFail($context_id);

        $submission = \App\Models\CareerTargetSubmission::create([
            'education_student_id' => $educationStudent->id,
            'career_target_context_id' => $context_id,
            'score' => 0,
            'notes' => null,
        ]);

        foreach ($context->fields as $f) {
            $value = '';
            if ($f->type === 'multiple_images') {
                if ($request->hasFile('field_' . $f->id)) {
                    $paths = [];
                    foreach ($request->file('field_' . $f->id) as $file) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/submissions'), $filename);
                        $paths[] = '/uploads/submissions/' . $filename;
                    }
                    $value = json_encode($paths);
                } else {
                    $value = json_encode([]);
                }
            } else {
                $value = $request->input('field_' . $f->id);
            }

            \App\Models\CareerTargetSubmissionValue::create([
                'career_target_submission_id' => $submission->id,
                'career_target_field_id' => $f->id,
                'value' => $value,
            ]);
        }

        return redirect()->back()->with('success', 'Data karya berhasil diajukan.');
    }

    public function santriSubmissionUpdate(Request $request, $submission_id)
    {
        $submission = \App\Models\CareerTargetSubmission::findOrFail($submission_id);
        $context = \App\Models\CareerTargetContext::with('fields')->findOrFail($submission->career_target_context_id);

        foreach ($context->fields as $f) {
            $value = '';
            if ($f->type === 'multiple_images') {
                if ($request->hasFile('field_' . $f->id)) {
                    $paths = [];
                    foreach ($request->file('field_' . $f->id) as $file) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/submissions'), $filename);
                        $paths[] = '/uploads/submissions/' . $filename;
                    }
                    $value = json_encode($paths);
                } else {
                    $oldVal = \App\Models\CareerTargetSubmissionValue::where('career_target_submission_id', $submission->id)
                        ->where('career_target_field_id', $f->id)
                        ->first();
                    $value = $oldVal ? $oldVal->value : json_encode([]);
                }
            } else {
                $value = $request->input('field_' . $f->id);
            }

            \App\Models\CareerTargetSubmissionValue::updateOrCreate(
                [
                    'career_target_submission_id' => $submission->id,
                    'career_target_field_id' => $f->id,
                ],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Data karya berhasil diperbarui.');
    }

    public function santriSubmissionDestroy($submission_id)
    {
        $submission = \App\Models\CareerTargetSubmission::findOrFail($submission_id);
        $submission->delete();
        return redirect()->back()->with('success', 'Data karya berhasil dihapus.');
    }

    public function santriIncomeUpdate(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required',
            'source' => 'required|string|max:255',
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'proof_image' => 'nullable|image|max:2048',
        ]);

        $income = \App\Models\CareerStudentIncome::findOrFail($id);
        $amount = (int) preg_replace('/[^0-9]/', '', $request->amount);

        $proofPath = $income->proof_image;
        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/incomes'), $filename);
            $proofPath = '/uploads/incomes/' . $filename;
        }

        $income->update([
            'amount' => $amount,
            'source' => $request->source,
            'date' => $request->date,
            'notes' => $request->notes,
            'proof_image' => $proofPath,
        ]);

        return redirect()->back()->with('success', 'Data penghasilan berhasil diperbarui.');
    }

    public function santriIncomeDestroy($id)
    {
        $income = \App\Models\CareerStudentIncome::findOrFail($id);
        $income->delete();
        return redirect()->back()->with('success', 'Data penghasilan berhasil dihapus.');
    }

    public function santriTagihanIndex()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $registration = Registration::where('email', $user->email)->first();
        if (!$registration) {
            abort(404, 'Data Registrasi Santri tidak ditemukan.');
        }

        // Get student bills
        $bills = \App\Models\BillingStudentBill::with('billingCategory')
            ->where('registration_id', $registration->id)
            ->where('is_billed', true)
            ->get();

        // Get payments history
        $payments = \App\Models\BillingPayment::with('billingCategory')
            ->where('registration_id', $registration->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('santri.tagihan', compact('user', 'registration', 'bills', 'payments'));
    }

    public function santriTagihanBayar(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'santri') {
            return redirect('/login');
        }

        $request->validate([
            'billing_category_id' => 'required|exists:billing_categories,id',
            'amount' => 'required',
            'proof_image' => 'required|image|max:2048',
        ]);

        $amount = (float) str_replace(['Rp', '.', ' ', ','], '', $request->amount);

        $proofPath = null;
        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/payments'), $filename);
            $proofPath = '/uploads/payments/' . $filename;
        }

        // Save a temporary payment request or store directly as payment (marked with path for validation)
        \App\Models\BillingPayment::create([
            'registration_id' => $request->input('registration_id'),
            'billing_category_id' => $request->billing_category_id,
            'installment_index' => 1, // Default single / first installment
            'amount' => $amount,
            'proof_image' => $proofPath, // Dynamic column to review
            'status' => 'pending' // pending verification by admin
        ]);

        return redirect()->back()->with('success', 'Konfirmasi bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function settingsIndex()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $feeSetting = Setting::where('key', 'registration_fee')->first();
        $registrationFee = $feeSetting ? (int) $feeSetting->value : 150000;

        $testingModeSetting = Setting::where('key', 'testing_mode')->first();
        $testingMode = $testingModeSetting ? (int) $testingModeSetting->value : 0;

        return view('super-admin.settings', compact('user', 'registrationFee', 'testingMode'));
    }

    public function settingsUpdate(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'registration_fee' => 'required|numeric|min:0',
            'testing_mode' => 'nullable|in:0,1'
        ]);

        Setting::updateOrCreate(
            ['key' => 'registration_fee'],
            ['value' => $request->registration_fee]
        );

        Setting::updateOrCreate(
            ['key' => 'testing_mode'],
            ['value' => $request->has('testing_mode') ? 1 : 0]
        );

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    public function academicYearsBatchesIndex()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::withCount('batches')->orderBy('name', 'desc')->get();
        $batches = Batch::with('academicYear')->orderBy('name', 'asc')->get();

        return view('super-admin.academic-years-batches', compact('user', 'academicYears', 'batches'));
    }

    public function academicYearStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean'
        ]);

        AcademicYear::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? (bool) $request->is_active : true
        ]);

        return redirect()->back()->with('success', 'Tahun Ajaran baru berhasil ditambahkan.');
    }

    public function academicYearUpdate($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean'
        ]);

        $academicYear = AcademicYear::findOrFail($id);
        $academicYear->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? (bool) $request->is_active : $academicYear->is_active
        ]);

        return redirect()->back()->with('success', 'Tahun Ajaran berhasil diperbarui.');
    }

    public function academicYearDestroy($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        $academicYear->delete();

        return redirect()->back()->with('success', 'Tahun Ajaran berhasil dihapus.');
    }

    public function batchStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'academic_year_id' => 'required|exists:academic_years,id',
            'is_active' => 'boolean'
        ]);

        Batch::create([
            'name' => $request->name,
            'academic_year_id' => $request->academic_year_id,
            'is_active' => $request->has('is_active') ? (bool) $request->is_active : true
        ]);

        return redirect()->back()->with('success', 'Gelombang/Batch baru berhasil ditambahkan.');
    }

    public function batchUpdate($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'academic_year_id' => 'required|exists:academic_years,id',
            'is_active' => 'boolean'
        ]);

        $batch = Batch::findOrFail($id);
        $batch->update([
            'name' => $request->name,
            'academic_year_id' => $request->academic_year_id,
            'is_active' => $request->has('is_active') ? (bool) $request->is_active : $batch->is_active
        ]);

        return redirect()->back()->with('success', 'Gelombang/Batch berhasil diperbarui.');
    }

    public function batchDestroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()->back()->with('success', 'Gelombang/Batch berhasil dihapus.');
    }

    public function classroomsIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $classrooms = Classroom::with(['academicYear', 'batch'])->orderBy('created_at', 'desc')->get();
        $academicYears = AcademicYear::all();
        $batches = Batch::with('academicYear')->get();

        return view('super-admin.classrooms', compact('user', 'classrooms', 'academicYears', 'batches'));
    }

    public function classroomStore(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'batch_id' => 'required|exists:batches,id',
            'name' => 'required|string|max:255',
        ]);

        Classroom::create($request->all());

        return redirect()->back()->with('success', 'Kelas baru berhasil ditambahkan.');
    }

    public function classroomUpdate($id, Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'batch_id' => 'required|exists:batches,id',
            'name' => 'required|string|max:255',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->all());

        return redirect()->back()->with('success', 'Kelas berhasil diperbarui.');
    }

    public function classroomDestroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
    }

    public function teachersIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $teachers = \App\Models\User::where('role', 'pengajar')->orderBy('created_at', 'desc')->get();

        return view('super-admin.teachers', compact('user', 'teachers'));
    }

    public function studentsIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        // Auto sync / generate accounts for accepted registrations
        $accepted = Registration::where('status', 'penerimaan')->get();
        foreach ($accepted as $reg) {
            $exists = \App\Models\User::where('email', $reg->email)->first();
            if (!$exists) {
                // Generate username: Year + 4 digit counter
                $year = date('Y');
                $lastSantri = \App\Models\User::where('role', 'santri')
                    ->where('username', 'LIKE', $year . '%')
                    ->orderBy('username', 'desc')
                    ->first();
                if ($lastSantri) {
                    $lastNum = (int) substr($lastSantri->username, 4);
                    $nextNum = str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $nextNum = '0001';
                }
                $username = $year . $nextNum;

                \App\Models\User::create([
                    'name' => $reg->name,
                    'username' => $username,
                    'email' => $reg->email,
                    'role' => 'santri',
                    'whatsapp' => $reg->whatsapp,
                    'password' => bcrypt('santri' . $username), // Default: santri20260001
                ]);
            }
        }

        $students = \App\Models\User::where('role', 'santri')->orderBy('username', 'asc')->get();

        return view('super-admin.students', compact('user', 'students'));
    }

    public function studentResetPassword($id, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $student = \App\Models\User::findOrFail($id);
        $defaultPassword = 'santri' . $student->username;
        $student->update([
            'password' => bcrypt($defaultPassword)
        ]);

        return redirect()->back()->with('success', 'Password akun ' . $student->name . ' berhasil direset ke default: ' . $defaultPassword);
    }

    public function teacherStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'whatsapp' => 'required|string|max:50',
            'teacher_type' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Generate NIP (Nomor Induk Pengajar / Username) automatically: PGR + Year + 3 Digits Counter
        $year = date('Y');
        $prefix = 'PGR' . $year;
        
        $lastTeacher = \App\Models\User::where('role', 'pengajar')
            ->where('username', 'LIKE', $prefix . '%')
            ->orderBy('username', 'desc')
            ->first();

        if ($lastTeacher) {
            $lastNum = (int) substr($lastTeacher->username, strlen($prefix));
            $nextNum = str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextNum = '001';
        }

        $generatedUsername = $prefix . $nextNum;

        // Normalize WhatsApp
        $wa = preg_replace('/\D/', '', $request->whatsapp);
        if (str_starts_with($wa, '0')) {
            $wa = '+62' . substr($wa, 1);
        } elseif (str_starts_with($wa, '62')) {
            $wa = '+62' . substr($wa, 2);
        } elseif (!empty($wa) && !str_starts_with($wa, '+62')) {
            $wa = '+62' . $wa;
        }

        \App\Models\User::create([
            'name' => $request->name,
            'username' => $generatedUsername,
            'email' => $request->email,
            'whatsapp' => $wa,
            'password' => bcrypt($request->password),
            'role' => 'pengajar',
            'teacher_type' => $request->teacher_type,
        ]);

        return redirect()->back()->with('success', 'Akun Pengajar baru berhasil dibuat dengan Nomor Induk: ' . $generatedUsername);
    }

    public function teacherUpdate($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'whatsapp' => 'required|string|max:50',
            'teacher_type' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        // Normalize WhatsApp
        $wa = preg_replace('/\D/', '', $request->whatsapp);
        if (str_starts_with($wa, '0')) {
            $wa = '+62' . substr($wa, 1);
        } elseif (str_starts_with($wa, '62')) {
            $wa = '+62' . substr($wa, 2);
        } elseif (!empty($wa) && !str_starts_with($wa, '+62')) {
            $wa = '+62' . $wa;
        }

        $teacher = \App\Models\User::findOrFail($id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp' => $wa,
            'teacher_type' => $request->teacher_type,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $teacher->update($data);

        return redirect()->back()->with('success', 'Akun Pengajar berhasil diperbarui.');
    }

    public function teacherDestroy($id)
    {
        $teacher = \App\Models\User::findOrFail($id);
        $teacher->delete();

        return redirect()->back()->with('success', 'Akun Pengajar berhasil dihapus.');
    }

    public function pengajarDashboard()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        // 1. Total classrooms managed by this teacher (as homeroom or assistant)
        $totalClassrooms = Classroom::where('homeroom_teacher_id', $user->id)
            ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id))
            ->count();

        // 2. Total active students under this teacher's classrooms (combining matriculation and education phases)
        $managedClassroomIds = Classroom::where('homeroom_teacher_id', $user->id)
            ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id))
            ->pluck('id')
            ->toArray();
        
        $totalMatriculationStudents = \App\Models\MatriculationStudent::whereIn('classroom_id', $managedClassroomIds)
            ->where('status', 'active')
            ->count();
        $totalEducationStudents = \App\Models\EducationStudent::whereIn('classroom_id', $managedClassroomIds)
            ->where('status', 'active')
            ->count();
        $totalStudents = $totalMatriculationStudents + $totalEducationStudents;

        // 3. Placements (Divisi Masa Berkarya) where this teacher is mentor
        $totalPlacements = CareerPlacement::where('mentor_name', $user->name)->count();

        // 4. KPI Checklist progress for today
        $today = date('Y-m-d');
        
        // Find if there is a KPI period active today
        $activePeriodToday = \App\Models\TeacherKpiPeriod::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        $totalAssignedKpi = 0;
        if ($activePeriodToday) {
            $totalAssignedKpi = \App\Models\TeacherKpiAssignment::where('user_id', $user->id)
                ->where('teacher_kpi_period_id', $activePeriodToday->id)
                ->count();
        }

        $completedKpiToday = \App\Models\TeacherKpiLog::where('user_id', $user->id)
            ->where('date', $today)
            ->where('is_checked', true)
            ->count();

        return view('teacher.dashboard', compact(
            'user', 
            'totalClassrooms', 
            'totalStudents', 
            'totalPlacements',
            'totalAssignedKpi', 
            'completedKpiToday'
        ));
    }

    public function matriculationSettings(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', $academicYears->first()?->id);
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);

        $period = MatriculationPeriod::with(['aspects', 'skills.aspects'])
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->first();

        return view('super-admin.matriculation.settings', compact('user', 'academicYears', 'batches', 'selectedAcademicYearId', 'selectedBatchId', 'period'));
    }

    public function matriculationSettingsStore(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'batch_id' => 'required|exists:batches,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'character_aspects' => 'nullable|array',
            'character_aspects.*.id' => 'nullable|exists:matriculation_aspects,id',
            'character_aspects.*.name' => 'required|string|max:255',
            'character_aspects.*.weight' => 'required|integer|min:1|max:100',
            'skills' => 'nullable|array',
            'skills.*.id' => 'nullable|exists:matriculation_skills,id',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.aspects' => 'required|array|min:1',
            'skills.*.aspects.*.id' => 'nullable|exists:matriculation_aspects,id',
            'skills.*.aspects.*.name' => 'required|string|max:255',
            'skills.*.aspects.*.weight' => 'required|integer|min:1|max:100',
        ]);

        if (empty($request->character_aspects) && empty($request->skills)) {
            $msg = 'Minimal harus menginputkan 1 aspek penilaian karakter atau skill.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return redirect()->back()->withErrors(['aspects' => $msg])->withInput();
        }

        if (!empty($request->character_aspects)) {
            $charWeight = array_sum(array_column($request->character_aspects, 'weight'));
            if ($charWeight !== 100) {
                $msg = 'Total bobot aspek Penilaian Karakter harus 100%. Saat ini: ' . $charWeight . '%';
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $msg], 422);
                }
                return redirect()->back()->withErrors(['char_weight' => $msg])->withInput();
            }
        }

        if (!empty($request->skills)) {
            foreach ($request->skills as $sIdx => $skillInput) {
                $skillWeight = array_sum(array_column($skillInput['aspects'] ?? [], 'weight'));
                if ($skillWeight !== 100) {
                    $msg = 'Total bobot aspek Penilaian Skill "' . $skillInput['name'] . '" harus 100%. Saat ini: ' . $skillWeight . '%';
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(['success' => false, 'message' => $msg], 422);
                    }
                    return redirect()->back()->withErrors([
                        'skill_weight_' . $sIdx => $msg
                    ])->withInput();
                }
            }
        }

        // Calculate duration dynamically from dates
        $start = \Carbon\Carbon::parse($request->start_date);
        $end = \Carbon\Carbon::parse($request->end_date);
        $duration_number = $start->diffInDays($end) + 1;
        $duration_unit = 'days';

        $period = MatriculationPeriod::updateOrCreate([
            'academic_year_id' => $request->academic_year_id,
            'batch_id' => $request->batch_id,
        ], [
            'duration_number' => $duration_number,
            'duration_unit' => $duration_unit,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Sync Skills and aspects
        $keepSkillIds = [];
        $keepAspectIds = [];

        // 1. Character aspects
        if (!empty($request->character_aspects)) {
            foreach ($request->character_aspects as $asp) {
                if (!empty($asp['id'])) {
                    $period->aspects()->where('id', $asp['id'])->update([
                        'name' => $asp['name'],
                        'weight_percentage' => $asp['weight'],
                    ]);
                    $keepAspectIds[] = $asp['id'];
                } else {
                    $newAsp = $period->aspects()->create([
                        'name' => $asp['name'],
                        'weight_percentage' => $asp['weight'],
                        'type' => 'character',
                        'input_type' => 'checklist',
                        'target_weekly' => 5,
                        'target_monthly' => 20,
                    ]);
                    $keepAspectIds[] = $newAsp->id;
                }
            }
        }

        // 2. Dynamic Skills
        if (!empty($request->skills)) {
            foreach ($request->skills as $skillInput) {
                if (!empty($skillInput['id'])) {
                    $skill = $period->skills()->findOrFail($skillInput['id']);
                    $skill->update([
                        'name' => $skillInput['name'],
                    ]);
                } else {
                    $skill = $period->skills()->create([
                        'name' => $skillInput['name'],
                    ]);
                }
                $keepSkillIds[] = $skill->id;

                // Sync aspects of this skill
                foreach ($skillInput['aspects'] ?? [] as $asp) {
                    if (!empty($asp['id'])) {
                        $period->aspects()->where('id', $asp['id'])->update([
                            'matriculation_skill_id' => $skill->id,
                            'name' => $asp['name'],
                            'weight_percentage' => $asp['weight'],
                        ]);
                        $keepAspectIds[] = $asp['id'];
                    } else {
                        $newAsp = $period->aspects()->create([
                            'matriculation_skill_id' => $skill->id,
                            'name' => $asp['name'],
                            'weight_percentage' => $asp['weight'],
                            'type' => 'skill',
                            'input_type' => 'score',
                            'target_weekly' => 80,
                            'target_monthly' => 80,
                        ]);
                        $keepAspectIds[] = $newAsp->id;
                    }
                }
            }
        }

        // Clean up deleted skills and aspects
        $period->aspects()->whereNotIn('id', $keepAspectIds)->delete();
        $period->skills()->whereNotIn('id', $keepSkillIds)->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengaturan Masa Matrikulasi & Aspek Penilaian berhasil disimpan.'
            ]);
        }

        return redirect()->back()->with('success', 'Pengaturan Masa Matrikulasi & Aspek Penilaian berhasil disimpan.');
    }

    public function matriculationClassrooms(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', $academicYears->first()?->id);
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);

        $activePeriod = MatriculationPeriod::with('skills')
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->first();

        // Sync accepted registrations to matriculation_students
        if ($activePeriod) {
            $acceptedRegistrations = Registration::where('academic_year_id', $selectedAcademicYearId)
                ->where('batch_id', $selectedBatchId)
                ->where('status', 'penerimaan')
                ->get();

            foreach ($acceptedRegistrations as $reg) {
                MatriculationStudent::firstOrCreate([
                    'registration_id' => $reg->id,
                    'matriculation_period_id' => $activePeriod->id,
                ]);
            }
        }

        $teachers = \App\Models\User::where('role', 'pengajar')->orderBy('name', 'asc')->get();

        $classrooms = Classroom::with(['homeroomTeacher', 'assistantTeachers', 'leaderRegistration', 'matriculationSkill'])
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->get();

        // Load matriculation students
        $allStudents = [];
        $unassignedStudents = [];

        if ($activePeriod) {
            $allStudents = MatriculationStudent::with(['registration', 'classroom'])
                ->where('matriculation_period_id', $activePeriod->id)
                ->get();

            $unassignedStudents = MatriculationStudent::with('registration')
                ->where('matriculation_period_id', $activePeriod->id)
                ->whereNull('classroom_id')
                ->get();
        }

        return view('super-admin.matriculation.classrooms', compact(
            'user', 'academicYears', 'batches', 'selectedAcademicYearId', 'selectedBatchId',
            'activePeriod', 'teachers', 'classrooms', 'allStudents', 'unassignedStudents'
        ));
    }

    public function matriculationAssignTeachers($id, Request $request)
    {
        $request->validate([
            'homeroom_teacher_id'    => 'nullable|exists:users,id',
            'assistant_teacher_ids'  => 'nullable|array',
            'assistant_teacher_ids.*'=> 'exists:users,id',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update([
            'homeroom_teacher_id' => $request->homeroom_teacher_id,
        ]);

        // Sync many-to-many assistant teachers
        $classroom->assistantTeachers()->sync($request->assistant_teacher_ids ?? []);

        return redirect()->back()->with('success', 'Pembimbing Wali & Wakil Wali kelas berhasil diperbarui.');
    }

    public function matriculationAssignSkill($id, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $request->validate([
            'matriculation_skill_id' => 'nullable|exists:matriculation_skills,id',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update([
            'matriculation_skill_id' => $request->matriculation_skill_id,
        ]);

        return redirect()->back()->with('success', 'Skill penilaian kelas berhasil diperbarui.');
    }

    public function matriculationAssignStudents(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:matriculation_students,id',
        ]);

        MatriculationStudent::whereIn('id', $request->student_ids)->update([
            'classroom_id' => $request->classroom_id
        ]);

        return redirect()->back()->with('success', 'Calon santri berhasil dimasukkan ke dalam kelas.');
    }

    public function matriculationSetLeader(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'leader_registration_id' => 'required|exists:registrations,id',
        ]);

        $classroom = Classroom::findOrFail($request->classroom_id);
        $classroom->update([
            'leader_registration_id' => $request->leader_registration_id
        ]);

        return redirect()->back()->with('success', 'Ketua Kelas berhasil ditetapkan.');
    }

    public function matriculationRemoveStudent($id)
    {
        $student = MatriculationStudent::findOrFail($id);
        
        // Remove from classroom (set classroom_id to null)
        $classroom = Classroom::where('leader_registration_id', $student->registration_id)->first();
        if ($classroom) {
            $classroom->update(['leader_registration_id' => null]);
        }

        $student->update(['classroom_id' => null]);

        return redirect()->back()->with('success', 'Calon santri berhasil dikeluarkan dari kelas.');
    }

    public function matriculationUpdateStudentStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,passed,failed,resigned'
        ]);

        $student = MatriculationStudent::findOrFail($id);
        $student->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status santri berhasil diperbarui.');
    }

    public function matriculationDailyControl(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', $academicYears->first()?->id);
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);

        $activePeriod = MatriculationPeriod::with('aspects')
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->first();

        $classrooms = Classroom::where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->get();

        $selectedClassroomId = $request->input('classroom_id', $classrooms->first()?->id);

        $classroom = $selectedClassroomId ? Classroom::with('matriculationSkill')->find($selectedClassroomId) : null;

        $selectedAspectId = $request->input('matriculation_aspect_id');
        $allowedAspects = collect();
        if ($activePeriod) {
            $allowedAspects = $activePeriod->aspects()
                ->where(function($q) use ($classroom) {
                    $q->where('type', 'character');
                    if ($classroom && $classroom->matriculation_skill_id) {
                        $q->orWhere(function($q2) use ($classroom) {
                            $q2->where('type', 'skill')
                               ->where('matriculation_skill_id', $classroom->matriculation_skill_id);
                        });
                    }
                })->get();
            $activePeriod->setRelation('aspects', $allowedAspects);

            $exists = $allowedAspects->where('id', $selectedAspectId)->first();
            if (!$exists) {
                $selectedAspectId = $allowedAspects->first()?->id;
            }
        }

        $selectedAspect = $activePeriod ? $allowedAspects->where('id', $selectedAspectId)->first() : null;

        // Generate dynamic months between start_date and end_date
        $months = [];
        $selectedMonth = $request->input('month');
        if ($activePeriod) {
            $start = \Carbon\Carbon::parse($activePeriod->start_date);
            $end = \Carbon\Carbon::parse($activePeriod->end_date);
            $curr = $start->copy()->startOfMonth();
            while ($curr->lte($end)) {
                $months[] = [
                    'value' => $curr->format('Y-m'),
                    'label' => $curr->translatedFormat('F Y'),
                ];
                $curr->addMonth();
            }
        }
        $monthExists = collect($months)->where('value', $selectedMonth)->first();
        if ((empty($selectedMonth) || !$monthExists) && count($months) > 0) {
            $selectedMonth = $months[0]['value'];
        }

        // Generate dates for selected month that fall within period
        $dates = [];
        if ($activePeriod && $selectedMonth) {
            $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
            $daysInMonth = $monthCarbon->daysInMonth;
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
                $dateCarbon = \Carbon\Carbon::parse($dateStr);
                if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                    $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                    $dates[] = $dateStr;
                }
            }
        }

        $students = [];
        if ($activePeriod && $selectedClassroomId && $selectedAspect) {
            $students = MatriculationStudent::with(['registration', 'scores' => function($q) use ($selectedAspectId, $dates) {
                $q->where('matriculation_aspect_id', $selectedAspectId)
                  ->whereIn('evaluation_date', $dates);
            }])
            ->where('matriculation_period_id', $activePeriod->id)
            ->where('classroom_id', $selectedClassroomId)
            ->get();
        }

        return view('super-admin.matriculation.daily-control', compact(
            'user', 'academicYears', 'batches', 'selectedAcademicYearId', 'selectedBatchId',
            'activePeriod', 'classrooms', 'selectedClassroomId', 'months', 'selectedMonth',
            'selectedAspectId', 'selectedAspect', 'dates', 'students'
        ));
    }

    public function matriculationDailyControlStore(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required',
            'matriculation_aspect_id' => 'required|exists:matriculation_aspects,id',
            'input_type' => 'required|in:checklist,score,counter',
            'kkm' => 'nullable|numeric|min:0',
            'month' => 'required|string',
            'active_days' => 'nullable|array',
            'scores' => 'nullable|array',
            'notes' => 'nullable|array',
        ]);

        $aspect = MatriculationAspect::findOrFail($request->matriculation_aspect_id);
        $activePeriod = MatriculationPeriod::findOrFail($aspect->matriculation_period_id);

        // Generate dates for current month
        $dates = [];
        $selectedMonth = $request->month;
        $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
        $daysInMonth = $monthCarbon->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
            $dateCarbon = \Carbon\Carbon::parse($dateStr);
            if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                $dates[] = $dateStr;
            }
        }

        // Get other months active days
        $existingActiveDays = $aspect->active_days ?? [];
        $otherMonthsActiveDays = array_filter($existingActiveDays, function($d) use ($dates) {
            return !in_array($d, $dates);
        });

        // Newly checked active days
        $newActiveDays = $request->has('active_days') ? array_keys($request->active_days) : [];
        $updatedActiveDays = array_values(array_unique(array_merge($otherMonthsActiveDays, $newActiveDays)));

        // Update the aspect configuration
        $aspect->update([
            'input_type' => $request->input_type,
            'target_weekly' => ($request->input_type === 'score' || $request->input_type === 'counter') ? ($request->kkm ?? 80.00) : 0.00,
            'active_days' => $updatedActiveDays,
        ]);

        if ($request->has('scores') && is_array($request->scores)) {
            foreach ($request->scores as $studentId => $dateScores) {
                foreach ($dateScores as $date => $score) {
                    $note = $request->input("notes.{$studentId}.{$date}") ?? null;
                    if ($score === null || $score === '') {
                        MatriculationScore::where([
                            'matriculation_student_id' => $studentId,
                            'matriculation_aspect_id' => $request->matriculation_aspect_id,
                            'evaluation_date' => $date,
                        ])->delete();
                    } else {
                        MatriculationScore::updateOrCreate([
                            'matriculation_student_id' => $studentId,
                            'matriculation_aspect_id' => $request->matriculation_aspect_id,
                            'evaluation_date' => $date,
                        ], [
                            'score' => $score,
                            'notes' => $note,
                        ]);
                    }
                }
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kontrol harian berhasil disimpan.'
            ]);
        }

        return redirect()->back()->with('success', 'Kontrol harian berhasil disimpan.');
    }
    public function matriculationRapor(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', $academicYears->first()?->id);
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);

        $activePeriod = MatriculationPeriod::with('aspects')
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->first();

        $classrooms = Classroom::where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->get();

        $selectedClassroomId = $request->input('classroom_id', $classrooms->first()?->id);

        $classroom = $selectedClassroomId ? Classroom::find($selectedClassroomId) : null;
        if ($activePeriod) {
            $allowedAspects = $activePeriod->aspects()
                ->where(function($q) use ($classroom) {
                    $q->where('type', 'character');
                    if ($classroom && $classroom->matriculation_skill_id) {
                        $q->orWhere(function($q2) use ($classroom) {
                            $q2->where('type', 'skill')
                               ->where('matriculation_skill_id', $classroom->matriculation_skill_id);
                        });
                    }
                })->get();
            $activePeriod->setRelation('aspects', $allowedAspects);
        }

        $students = [];
        if ($activePeriod && $selectedClassroomId) {
            $students = MatriculationStudent::with(['registration', 'classroom', 'scores'])
                ->where('matriculation_period_id', $activePeriod->id)
                ->where('classroom_id', $selectedClassroomId)
                ->get();
        }

        return view('super-admin.matriculation.rapor', compact(
            'user', 'academicYears', 'batches', 'selectedAcademicYearId', 'selectedBatchId',
            'activePeriod', 'classrooms', 'selectedClassroomId', 'students'
        ));
    }

    public function matriculationRaporProcess(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:matriculation_students,id',
            'status' => 'required|in:active,passed,failed,resigned'
        ]);

        $student = MatriculationStudent::findOrFail($request->student_id);
        $oldStatus = $student->status;
        $student->update(['status' => $request->status]);

        // Send WhatsApp notification for final graduation/status changes
        if ($oldStatus !== $request->status) {
            try {
                $registration = $student->registration;
                $waMessage = "";
                if ($request->status === 'passed') {
                    $waMessage = "Halo *" . $registration->name . "*,\n\nSelamat! Anda dinyatakan *LULUS MASA SELEKSI MATRIKULASI* dan resmi diterima menjadi Santri Utama di Pondok IT.\n\nSelamat berjuang menuntut ilmu, semoga dimindahkan segala urusannya. Info kelas utama akan dibagikan segera.";
                } elseif ($request->status === 'failed') {
                    $waMessage = "Halo *" . $registration->name . "*,\n\nTerima kasih telah berpartisipasi dan berjuang di Masa Matrikulasi Pondok IT. Setelah evaluasi mendalam, mohon maaf saat ini Anda belum dapat melanjutkan ke jenjang Santri Utama.\n\nTetap semangat belajar di mana pun Anda berada.";
                }

                if (!empty($waMessage)) {
                    FonnteService::sendWhatsApp($registration->whatsapp, $waMessage);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Fonnte error in graduation/rapor: ' . $e->getMessage());
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Keputusan hasil matrikulasi berhasil diproses.',
                'status' => $student->status
            ]);
        }

        return redirect()->back()->with('success', 'Keputusan hasil matrikulasi berhasil diproses.');
    }
    // Teacher side actions
    // --- Granular Teacher Routes ---
    public function pengajarMatriculationDailyControlList()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classrooms = Classroom::with(['academicYear', 'batch', 'leaderRegistration', 'assistantTeachers'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->get();

        return view('teacher.matriculation.daily-control-list', compact('user', 'classrooms'));
    }

    public function pengajarMatriculationRaporList()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classrooms = Classroom::with(['academicYear', 'batch', 'leaderRegistration', 'assistantTeachers'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->get();

        return view('teacher.matriculation.rapor-list', compact('user', 'classrooms'));
    }

    public function pengajarMatriculationRaporShow($id, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classroom = Classroom::with(['academicYear', 'batch', 'leaderRegistration', 'assistantTeachers'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->findOrFail($id);

        $activePeriod = MatriculationPeriod::with('aspects')
            ->where('academic_year_id', $classroom->academic_year_id)
            ->where('batch_id', $classroom->batch_id)
            ->first();

        if ($activePeriod) {
            $allowedAspects = $activePeriod->aspects()
                ->where(function($q) use ($classroom) {
                    $q->where('type', 'character');
                    if ($classroom->matriculation_skill_id) {
                        $q->orWhere(function($q2) use ($classroom) {
                            $q2->where('type', 'skill')
                               ->where('matriculation_skill_id', $classroom->matriculation_skill_id);
                        });
                    }
                })->get();
            $activePeriod->setRelation('aspects', $allowedAspects);
        }

        $students = [];
        $months = [];
        if ($activePeriod) {
            $students = MatriculationStudent::with(['registration', 'scores'])
                ->where('matriculation_period_id', $activePeriod->id)
                ->where('classroom_id', $classroom->id)
                ->get();

            // Build months list
            $start = \Carbon\Carbon::parse($activePeriod->start_date);
            $end = \Carbon\Carbon::parse($activePeriod->end_date);
            $months = [];
            while ($start->lte($end)) {
                $months[] = [
                    'value' => $start->format('Y-m'),
                    'label' => $start->translatedFormat('F Y')
                ];
                $start->addMonth();
            }
        }

        return view('teacher.matriculation.rapor-show', compact('user', 'classroom', 'activePeriod', 'students', 'months'));
    }

    public function pengajarMatriculationRaporProcess(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'student_id' => 'required|exists:matriculation_students,id',
            'status' => 'required|in:active,passed,failed,resigned'
        ]);

        $st = MatriculationStudent::whereHas('classroom', function($q) use ($user) {
            $q->where('homeroom_teacher_id', $user->id)
              ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
        })->findOrFail($request->student_id);

        $st->status = $request->status;
        $st->save();

        return response()->json(['success' => true]);
    }

    public function pengajarEducationDailyControlList()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classrooms = Classroom::with(['academicYear', 'batch', 'leaderRegistration', 'assistantTeachers'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->get();

        return view('teacher.education.daily-control-list', compact('user', 'classrooms'));
    }

    public function pengajarEducationRaporList()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classrooms = Classroom::with(['academicYear', 'batch', 'leaderRegistration', 'assistantTeachers'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->get();

        return view('teacher.education.rapor-list', compact('user', 'classrooms'));
    }

    public function pengajarEducationRaporShow($id, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classroom = Classroom::with(['academicYear', 'batch', 'leaderRegistration', 'assistantTeachers', 'educationSkill'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->findOrFail($id);

        $activePeriod = EducationPeriod::with('aspects')
            ->where('academic_year_id', $classroom->academic_year_id)
            ->where('batch_id', $classroom->batch_id)
            ->first();

        if ($activePeriod) {
            $allowedAspects = $activePeriod->aspects()
                ->where(function($q) use ($classroom) {
                    $q->where('type', 'character');
                    if ($classroom && $classroom->education_skill_id) {
                        $q->orWhere(function($q2) use ($classroom) {
                            $q2->where('type', 'skill')
                               ->where('education_skill_id', $classroom->education_skill_id);
                        });
                    }
                })->get();
            $activePeriod->setRelation('aspects', $allowedAspects);
        }

        $students = [];
        $months = [];
        if ($activePeriod) {
            $students = EducationStudent::with(['registration', 'scores'])
                ->where('education_period_id', $activePeriod->id)
                ->where('classroom_id', $classroom->id)
                ->get();

            // Build months list
            $start = \Carbon\Carbon::parse($activePeriod->start_date);
            $end = \Carbon\Carbon::parse($activePeriod->end_date);
            $months = [];
            while ($start->lte($end)) {
                $months[] = [
                    'value' => $start->format('Y-m'),
                    'label' => $start->translatedFormat('F Y')
                ];
                $start->addMonth();
            }
        }

        return view('teacher.education.rapor-show', compact('user', 'classroom', 'activePeriod', 'students', 'months'));
    }

    public function pengajarEducationRaporProcess(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'student_id' => 'required|exists:education_students,id',
            'status' => 'required|in:active,passed,failed,resigned'
        ]);

        $st = EducationStudent::whereHas('classroom', function($q) use ($user) {
            $q->where('homeroom_teacher_id', $user->id)
              ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
        })->findOrFail($request->student_id);

        $st->status = $request->status;
        $st->save();

        return response()->json(['success' => true]);
    }

    public function pengajarClassroomShow($id, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classroom = Classroom::with(['academicYear', 'batch', 'leaderRegistration', 'assistantTeachers'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->findOrFail($id);

        $phase = $request->input('phase', 'matriculation');

        $activePeriod = null;
        $students = [];

        if ($phase === 'education') {
            $activePeriod = EducationPeriod::with('aspects')
                ->where('academic_year_id', $classroom->academic_year_id)
                ->where('batch_id', $classroom->batch_id)
                ->first();

            if ($activePeriod) {
                $students = EducationStudent::with(['registration', 'scores'])
                    ->where('education_period_id', $activePeriod->id)
                    ->where('classroom_id', $classroom->id)
                    ->get();
            }
        } else {
            $activePeriod = MatriculationPeriod::with('aspects')
                ->where('academic_year_id', $classroom->academic_year_id)
                ->where('batch_id', $classroom->batch_id)
                ->first();

            if ($activePeriod) {
                $students = MatriculationStudent::with(['registration', 'scores'])
                    ->where('matriculation_period_id', $activePeriod->id)
                    ->where('classroom_id', $classroom->id)
                    ->get();
            }
        }

        return view('teacher.classroom-show', compact('user', 'classroom', 'activePeriod', 'students', 'phase'));
    }

    public function teacherDailyControl($classroomId, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classroom = Classroom::with(['academicYear', 'batch'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->findOrFail($classroomId);

        $activePeriod = MatriculationPeriod::with('aspects')
            ->where('academic_year_id', $classroom->academic_year_id)
            ->where('batch_id', $classroom->batch_id)
            ->first();

        // Generate dynamic months between start_date and end_date
        $months = [];
        $selectedMonth = $request->input('month');
        if ($activePeriod) {
            $start = \Carbon\Carbon::parse($activePeriod->start_date);
            $end = \Carbon\Carbon::parse($activePeriod->end_date);
            $curr = $start->copy()->startOfMonth();
            while ($curr->lte($end)) {
                $months[] = [
                    'value' => $curr->format('Y-m'),
                    'label' => $curr->translatedFormat('F Y'),
                ];
                $curr->addMonth();
            }
        }
        $monthExists = collect($months)->where('value', $selectedMonth)->first();
        if ((empty($selectedMonth) || !$monthExists) && count($months) > 0) {
            $selectedMonth = $months[0]['value'];
        }

        $selectedAspectId = $request->input('matriculation_aspect_id');
        $allowedAspects = collect();
        if ($activePeriod) {
            $allowedAspects = $activePeriod->aspects()
                ->where(function($q) use ($classroom) {
                    $q->where('type', 'character');
                    if ($classroom->matriculation_skill_id) {
                        $q->orWhere(function($q2) use ($classroom) {
                            $q2->where('type', 'skill')
                               ->where('matriculation_skill_id', $classroom->matriculation_skill_id);
                        });
                    }
                })->get();
            $activePeriod->setRelation('aspects', $allowedAspects);

            $exists = $allowedAspects->where('id', $selectedAspectId)->first();
            if (!$exists) {
                $selectedAspectId = $allowedAspects->first()?->id;
            }
        }

        $selectedAspect = $activePeriod ? $allowedAspects->where('id', $selectedAspectId)->first() : null;

        // Generate dates for selected month that fall within period
        $dates = [];
        if ($activePeriod && $selectedMonth) {
            $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
            $daysInMonth = $monthCarbon->daysInMonth;
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
                $dateCarbon = \Carbon\Carbon::parse($dateStr);
                if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                    $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                    $dates[] = $dateStr;
                }
            }
        }

        $students = [];
        if ($activePeriod && $selectedAspect) {
            $students = MatriculationStudent::with(['registration', 'scores' => function($q) use ($selectedAspectId, $dates) {
                $q->where('matriculation_aspect_id', $selectedAspectId)
                  ->whereIn('evaluation_date', $dates);
            }])
            ->where('matriculation_period_id', $activePeriod->id)
            ->where('classroom_id', $classroom->id)
            ->get();
        }

        return view('teacher.daily-control', compact(
            'user', 'classroom', 'activePeriod', 'months', 'selectedMonth',
            'selectedAspectId', 'selectedAspect', 'dates', 'students'
        ));
    }

    public function teacherDailyControlStore(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $request->validate([
            'classroom_id' => 'required',
            'matriculation_aspect_id' => 'required|exists:matriculation_aspects,id',
            'input_type' => 'required|in:checklist,score,counter',
            'kkm' => 'nullable|numeric|min:0',
            'month' => 'required|string',
            'active_days' => 'nullable|array',
            'scores' => 'nullable|array',
            'notes' => 'nullable|array',
        ]);

        $aspect = MatriculationAspect::findOrFail($request->matriculation_aspect_id);
        $activePeriod = MatriculationPeriod::findOrFail($aspect->matriculation_period_id);

        // Generate dates for current month
        $dates = [];
        $selectedMonth = $request->month;
        $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
        $daysInMonth = $monthCarbon->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
            $dateCarbon = \Carbon\Carbon::parse($dateStr);
            if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                $dates[] = $dateStr;
            }
        }

        // Get other months active days
        $existingActiveDays = $aspect->active_days ?? [];
        $otherMonthsActiveDays = array_filter($existingActiveDays, function($d) use ($dates) {
            return !in_array($d, $dates);
        });

        // Newly checked active days
        $newActiveDays = $request->has('active_days') ? array_keys($request->active_days) : [];
        $updatedActiveDays = array_values(array_unique(array_merge($otherMonthsActiveDays, $newActiveDays)));

        // Update the aspect configuration
        $aspect->update([
            'input_type' => $request->input_type,
            'target_weekly' => ($request->input_type === 'score' || $request->input_type === 'counter') ? ($request->kkm ?? 80.00) : 0.00,
            'active_days' => $updatedActiveDays,
        ]);

        if ($request->has('scores') && is_array($request->scores)) {
            foreach ($request->scores as $studentId => $dateScores) {
                foreach ($dateScores as $date => $score) {
                    $note = $request->input("notes.{$studentId}.{$date}") ?? null;
                    MatriculationScore::updateOrCreate([
                        'matriculation_student_id' => $studentId,
                        'matriculation_aspect_id' => $request->matriculation_aspect_id,
                        'evaluation_date' => $date,
                    ], [
                        'score' => $score,
                        'notes' => $note,
                    ]);
                }
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kontrol harian berhasil disimpan.'
            ]);
        }

        return redirect()->back()->with('success', 'Kontrol harian berhasil disimpan.');
    }

    // ==========================================
    // MASA PENDIDIKAN (EDUCATION PHASE) METHODS
    // ==========================================

    public function educationSettings(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', $academicYears->first()?->id);
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);

        $period = EducationPeriod::with(['aspects', 'skills.aspects'])
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->first();

        return view('super-admin.education.settings', compact('user', 'academicYears', 'batches', 'selectedAcademicYearId', 'selectedBatchId', 'period'));
    }

    public function educationSettingsStore(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'batch_id' => 'required|exists:batches,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'character_aspects' => 'nullable|array',
            'character_aspects.*.id' => 'nullable|exists:education_aspects,id',
            'character_aspects.*.name' => 'required|string|max:255',
            'character_aspects.*.weight' => 'required|integer|min:1|max:100',
            'skills' => 'nullable|array',
            'skills.*.id' => 'nullable|exists:education_skills,id',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.aspects' => 'required|array|min:1',
            'skills.*.aspects.*.id' => 'nullable|exists:education_aspects,id',
            'skills.*.aspects.*.name' => 'required|string|max:255',
            'skills.*.aspects.*.weight' => 'required|integer|min:1|max:100',
        ]);

        if (empty($request->character_aspects) && empty($request->skills)) {
            $msg = 'Minimal harus menginputkan 1 aspek penilaian karakter atau skill.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return redirect()->back()->withErrors(['aspects' => $msg])->withInput();
        }

        if (!empty($request->character_aspects)) {
            $charWeight = array_sum(array_column($request->character_aspects, 'weight'));
            if ($charWeight !== 100) {
                $msg = 'Total bobot aspek Penilaian Karakter harus 100%. Saat ini: ' . $charWeight . '%';
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $msg], 422);
                }
                return redirect()->back()->withErrors(['char_weight' => $msg])->withInput();
            }
        }

        if (!empty($request->skills)) {
            foreach ($request->skills as $sIdx => $skillInput) {
                $skillWeight = array_sum(array_column($skillInput['aspects'] ?? [], 'weight'));
                if ($skillWeight !== 100) {
                    $msg = 'Total bobot aspek Penilaian Skill "' . $skillInput['name'] . '" harus 100%. Saat ini: ' . $skillWeight . '%';
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(['success' => false, 'message' => $msg], 422);
                    }
                    return redirect()->back()->withErrors([
                        'skill_weight_' . $sIdx => $msg
                    ])->withInput();
                }
            }
        }

        $start = \Carbon\Carbon::parse($request->start_date);
        $end = \Carbon\Carbon::parse($request->end_date);
        $duration_number = $start->diffInDays($end) + 1;
        $duration_unit = 'days';

        $period = EducationPeriod::updateOrCreate([
            'academic_year_id' => $request->academic_year_id,
            'batch_id' => $request->batch_id,
        ], [
            'duration_number' => $duration_number,
            'duration_unit' => $duration_unit,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Sync Skills and aspects
        $keepSkillIds = [];
        $keepAspectIds = [];

        // 1. Character aspects
        if (!empty($request->character_aspects)) {
            foreach ($request->character_aspects as $asp) {
                if (!empty($asp['id'])) {
                    $period->aspects()->where('id', $asp['id'])->update([
                        'name' => $asp['name'],
                        'weight_percentage' => $asp['weight'],
                    ]);
                    $keepAspectIds[] = $asp['id'];
                } else {
                    $newAsp = $period->aspects()->create([
                        'name' => $asp['name'],
                        'weight_percentage' => $asp['weight'],
                        'type' => 'character',
                        'input_type' => 'checklist',
                        'target_weekly' => 5,
                        'target_monthly' => 20,
                    ]);
                    $keepAspectIds[] = $newAsp->id;
                }
            }
        }

        // 2. Dynamic Skills
        if (!empty($request->skills)) {
            foreach ($request->skills as $skillInput) {
                if (!empty($skillInput['id'])) {
                    $skill = $period->skills()->findOrFail($skillInput['id']);
                    $skill->update([
                        'name' => $skillInput['name'],
                    ]);
                } else {
                    $skill = $period->skills()->create([
                        'name' => $skillInput['name'],
                    ]);
                }
                $keepSkillIds[] = $skill->id;

                // Sync aspects of this skill
                foreach ($skillInput['aspects'] ?? [] as $asp) {
                    if (!empty($asp['id'])) {
                        $period->aspects()->where('id', $asp['id'])->update([
                            'education_skill_id' => $skill->id,
                            'name' => $asp['name'],
                            'weight_percentage' => $asp['weight'],
                        ]);
                        $keepAspectIds[] = $asp['id'];
                    } else {
                        $newAsp = $period->aspects()->create([
                            'education_skill_id' => $skill->id,
                            'name' => $asp['name'],
                            'weight_percentage' => $asp['weight'],
                            'type' => 'skill',
                            'input_type' => 'score',
                            'target_weekly' => 80,
                            'target_monthly' => 80,
                        ]);
                        $keepAspectIds[] = $newAsp->id;
                    }
                }
            }
        }

        // Clean up deleted skills and aspects
        $period->aspects()->whereNotIn('id', $keepAspectIds)->delete();
        $period->skills()->whereNotIn('id', $keepSkillIds)->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengaturan Masa Pendidikan & Aspek Penilaian berhasil disimpan.'
            ]);
        }

        return redirect()->back()->with('success', 'Pengaturan Masa Pendidikan & Aspek Penilaian berhasil disimpan.');
    }

    public function educationClassrooms(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', $academicYears->first()?->id);
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);

        $activePeriod = EducationPeriod::with('skills')
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->first();

        // Sync passed matriculation students to education_students
        if ($activePeriod) {
            $passedMatriculations = MatriculationStudent::where('status', 'passed')
                ->whereHas('period', function($q) use ($selectedAcademicYearId, $selectedBatchId) {
                    $q->where('academic_year_id', $selectedAcademicYearId)
                      ->where('batch_id', $selectedBatchId);
                })
                ->get();

            foreach ($passedMatriculations as $mStudent) {
                EducationStudent::firstOrCreate([
                    'registration_id' => $mStudent->registration_id,
                    'education_period_id' => $activePeriod->id,
                ]);
            }
        }

        $teachers = \App\Models\User::where('role', 'pengajar')->orderBy('name', 'asc')->get();

        $classrooms = Classroom::with(['homeroomTeacher', 'assistantTeachers', 'leaderRegistration', 'educationSkill'])
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->get();

        $allStudents = [];
        $unassignedStudents = [];

        if ($activePeriod) {
            $allStudents = EducationStudent::with(['registration', 'classroom'])
                ->where('education_period_id', $activePeriod->id)
                ->get();

            $unassignedStudents = EducationStudent::with('registration')
                ->where('education_period_id', $activePeriod->id)
                ->whereNull('classroom_id')
                ->get();
        }

        return view('super-admin.education.classrooms', compact(
            'user', 'academicYears', 'batches', 'selectedAcademicYearId', 'selectedBatchId',
            'activePeriod', 'teachers', 'classrooms', 'allStudents', 'unassignedStudents'
        ));
    }

    public function educationAssignTeachers($id, Request $request)
    {
        $request->validate([
            'homeroom_teacher_id'    => 'nullable|exists:users,id',
            'assistant_teacher_ids'  => 'nullable|array',
            'assistant_teacher_ids.*'=> 'exists:users,id',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update([
            'homeroom_teacher_id' => $request->homeroom_teacher_id,
        ]);

        // Sync many-to-many assistant teachers
        $classroom->assistantTeachers()->sync($request->assistant_teacher_ids ?? []);

        return redirect()->back()->with('success', 'Pembimbing Wali & Wakil Wali kelas berhasil diperbarui.');
    }

    public function educationAssignSkill($id, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $request->validate([
            'education_skill_id' => 'nullable|exists:education_skills,id',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update([
            'education_skill_id' => $request->education_skill_id,
        ]);

        return redirect()->back()->with('success', 'Skill penilaian kelas berhasil diperbarui.');
    }

    public function educationAssignStudents(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:education_students,id',
        ]);

        EducationStudent::whereIn('id', $request->student_ids)->update([
            'classroom_id' => $request->classroom_id
        ]);

        return redirect()->back()->with('success', 'Santri berhasil dimasukkan ke dalam kelas Masa Pendidikan.');
    }

    public function educationSetLeader(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'leader_registration_id' => 'required|exists:registrations,id',
        ]);

        $classroom = Classroom::findOrFail($request->classroom_id);
        $classroom->update([
            'leader_registration_id' => $request->leader_registration_id
        ]);

        return redirect()->back()->with('success', 'Ketua Kelas berhasil ditetapkan.');
    }

    public function educationRemoveStudent($id)
    {
        $student = EducationStudent::findOrFail($id);
        
        $classroom = Classroom::where('leader_registration_id', $student->registration_id)->first();
        if ($classroom) {
            $classroom->update(['leader_registration_id' => null]);
        }

        $student->update(['classroom_id' => null]);

        return redirect()->back()->with('success', 'Santri berhasil dikeluarkan dari kelas Masa Pendidikan.');
    }

    public function educationUpdateStudentStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,passed,failed,resigned'
        ]);

        $student = EducationStudent::findOrFail($id);
        $student->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status santri berhasil diperbarui.');
    }

    public function educationDailyControl(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', $academicYears->first()?->id);
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);

        $activePeriod = EducationPeriod::with('aspects')
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->first();

        $classrooms = Classroom::where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->get();

        $selectedClassroomId = $request->input('classroom_id', $classrooms->first()?->id);

        $classroom = $selectedClassroomId ? Classroom::with('educationSkill')->find($selectedClassroomId) : null;

        $months = [];
        $selectedMonth = $request->input('month');
        if ($activePeriod) {
            $start = \Carbon\Carbon::parse($activePeriod->start_date);
            $end = \Carbon\Carbon::parse($activePeriod->end_date);
            $curr = $start->copy()->startOfMonth();
            while ($curr->lte($end)) {
                $months[] = [
                    'value' => $curr->format('Y-m'),
                    'label' => $curr->translatedFormat('F Y'),
                ];
                $curr->addMonth();
            }
        }
        $monthExists = collect($months)->where('value', $selectedMonth)->first();
        if ((empty($selectedMonth) || !$monthExists) && count($months) > 0) {
            $selectedMonth = $months[0]['value'];
        }

        $selectedAspectId = $request->input('education_aspect_id');
        $allowedAspects = collect();
        if ($activePeriod) {
            $allowedAspects = $activePeriod->aspects()
                ->where(function($q) use ($classroom) {
                    $q->where('type', 'character');
                    if ($classroom && $classroom->education_skill_id) {
                        $q->orWhere(function($q2) use ($classroom) {
                            $q2->where('type', 'skill')
                               ->where('education_skill_id', $classroom->education_skill_id);
                        });
                    }
                })->get();
            $activePeriod->setRelation('aspects', $allowedAspects);

            $exists = $allowedAspects->where('id', $selectedAspectId)->first();
            if (!$exists) {
                $selectedAspectId = $allowedAspects->first()?->id;
            }
        }

        $selectedAspect = $activePeriod ? $allowedAspects->where('id', $selectedAspectId)->first() : null;

        $dates = [];
        if ($activePeriod && $selectedMonth) {
            $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
            $daysInMonth = $monthCarbon->daysInMonth;
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
                $dateCarbon = \Carbon\Carbon::parse($dateStr);
                if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                    $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                    $dates[] = $dateStr;
                }
            }
        }

        $students = [];
        if ($activePeriod && $selectedClassroomId && $selectedAspect) {
            $students = EducationStudent::with(['registration', 'scores' => function($q) use ($selectedAspectId, $dates) {
                $q->where('education_aspect_id', $selectedAspectId)
                  ->whereIn('evaluation_date', $dates);
            }])
            ->where('education_period_id', $activePeriod->id)
            ->where('classroom_id', $selectedClassroomId)
            ->get();
        }

        return view('super-admin.education.daily-control', compact(
            'user', 'academicYears', 'batches', 'selectedAcademicYearId', 'selectedBatchId',
            'activePeriod', 'classrooms', 'selectedClassroomId', 'months', 'selectedMonth',
            'selectedAspectId', 'selectedAspect', 'dates', 'students'
        ));
    }

    public function educationDailyControlStore(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required',
            'education_aspect_id' => 'required|exists:education_aspects,id',
            'input_type' => 'required|in:checklist,score,counter',
            'kkm' => 'nullable|numeric|min:0',
            'month' => 'required|string',
            'active_days' => 'nullable|array',
            'scores' => 'nullable|array',
            'notes' => 'nullable|array',
        ]);

        $aspect = EducationAspect::findOrFail($request->education_aspect_id);
        $activePeriod = EducationPeriod::findOrFail($aspect->education_period_id);

        $dates = [];
        $selectedMonth = $request->month;
        $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
        $daysInMonth = $monthCarbon->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
            $dateCarbon = \Carbon\Carbon::parse($dateStr);
            if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                $dates[] = $dateStr;
            }
        }

        $existingActiveDays = $aspect->active_days ?? [];
        $otherMonthsActiveDays = array_filter($existingActiveDays, function($d) use ($dates) {
            return !in_array($d, $dates);
        });

        $newActiveDays = $request->has('active_days') ? array_keys($request->active_days) : [];
        $updatedActiveDays = array_values(array_unique(array_merge($otherMonthsActiveDays, $newActiveDays)));

        $aspect->update([
            'input_type' => $request->input_type,
            'target_weekly' => ($request->input_type === 'score' || $request->input_type === 'counter') ? ($request->kkm ?? 80.00) : 0.00,
            'active_days' => $updatedActiveDays,
        ]);

        if ($request->has('scores') && is_array($request->scores)) {
            foreach ($request->scores as $studentId => $dateScores) {
                foreach ($dateScores as $date => $score) {
                    $note = $request->input("notes.{$studentId}.{$date}") ?? null;
                    EducationScore::updateOrCreate([
                        'education_student_id' => $studentId,
                        'education_aspect_id' => $request->education_aspect_id,
                        'evaluation_date' => $date,
                    ], [
                        'score' => $score,
                        'notes' => $note,
                    ]);
                }
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kontrol harian berhasil disimpan.'
            ]);
        }

        return redirect()->back()->with('success', 'Kontrol harian berhasil disimpan.');
    }

    public function educationRapor(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', $academicYears->first()?->id);
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);

        $activePeriod = EducationPeriod::with('aspects')
            ->where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->first();

        $classrooms = Classroom::where('academic_year_id', $selectedAcademicYearId)
            ->where('batch_id', $selectedBatchId)
            ->get();

        $selectedClassroomId = $request->input('classroom_id', $classrooms->first()?->id);

        $classroom = $selectedClassroomId ? Classroom::find($selectedClassroomId) : null;
        if ($activePeriod) {
            $allowedAspects = $activePeriod->aspects()
                ->where(function($q) use ($classroom) {
                    $q->where('type', 'character');
                    if ($classroom && $classroom->education_skill_id) {
                        $q->orWhere(function($q2) use ($classroom) {
                            $q2->where('type', 'skill')
                               ->where('education_skill_id', $classroom->education_skill_id);
                        });
                    }
                })->get();
            $activePeriod->setRelation('aspects', $allowedAspects);
        }

        $students = [];
        if ($activePeriod && $selectedClassroomId) {
            $students = EducationStudent::with(['registration', 'classroom', 'scores'])
                ->where('education_period_id', $activePeriod->id)
                ->where('classroom_id', $selectedClassroomId)
                ->get();
        }

        return view('super-admin.education.rapor', compact(
            'user', 'academicYears', 'batches', 'selectedAcademicYearId', 'selectedBatchId',
            'activePeriod', 'classrooms', 'selectedClassroomId', 'students'
        ));
    }

    public function educationRaporProcess(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:education_students,id',
            'status' => 'required|in:active,passed,failed,resigned'
        ]);

        $student = EducationStudent::findOrFail($request->student_id);
        $oldStatus = $student->status;
        $student->update(['status' => $request->status]);

        if ($oldStatus !== $request->status) {
            try {
                $registration = $student->registration;
                $waMessage = "";
                if ($request->status === 'passed') {
                    $waMessage = "Halo *" . $registration->name . "*,\n\nSelamat! Anda dinyatakan *LULUS MASA PENDIDIKAN* di Pondok IT.\n\nSelamat atas pencapaian Anda, semoga ilmu yang didapatkan berkah dan bermanfaat.";
                } elseif ($request->status === 'failed') {
                    $waMessage = "Halo *" . $registration->name . "*,\n\nKami mengapresiasi kebersamaan Anda selama Masa Pendidikan di Pondok IT. Mohon maaf saat ini Anda dinyatakan belum berhasil melewati masa pendidikan ini.\n\nTetap semangat berjuang menuntut ilmu.";
                }

                if (!empty($waMessage)) {
                    FonnteService::sendWhatsApp($registration->whatsapp, $waMessage);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Fonnte error in education graduation/rapor: ' . $e->getMessage());
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Keputusan hasil pendidikan berhasil diproses.',
                'status' => $student->status
            ]);
        }

        return redirect()->back()->with('success', 'Keputusan hasil pendidikan berhasil diproses.');
    }

    public function teacherEducationDailyControl($classroomId, Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $classroom = Classroom::with(['academicYear', 'batch', 'educationSkill'])
            ->where(function($q) use ($user) {
                $q->where('homeroom_teacher_id', $user->id)
                  ->orWhereHas('assistantTeachers', fn($q) => $q->where('users.id', $user->id));
            })
            ->findOrFail($classroomId);

        $activePeriod = EducationPeriod::with('aspects')
            ->where('academic_year_id', $classroom->academic_year_id)
            ->where('batch_id', $classroom->batch_id)
            ->first();

        $months = [];
        $selectedMonth = $request->input('month');
        if ($activePeriod) {
            $start = \Carbon\Carbon::parse($activePeriod->start_date);
            $end = \Carbon\Carbon::parse($activePeriod->end_date);
            $curr = $start->copy()->startOfMonth();
            while ($curr->lte($end)) {
                $months[] = [
                    'value' => $curr->format('Y-m'),
                    'label' => $curr->translatedFormat('F Y'),
                ];
                $curr->addMonth();
            }
        }
        $monthExists = collect($months)->where('value', $selectedMonth)->first();
        if ((empty($selectedMonth) || !$monthExists) && count($months) > 0) {
            $selectedMonth = $months[0]['value'];
        }

        $selectedAspectId = $request->input('education_aspect_id');
        $allowedAspects = collect();
        if ($activePeriod) {
            $allowedAspects = $activePeriod->aspects()
                ->where(function($q) use ($classroom) {
                    $q->where('type', 'character');
                    if ($classroom && $classroom->education_skill_id) {
                        $q->orWhere(function($q2) use ($classroom) {
                            $q2->where('type', 'skill')
                               ->where('education_skill_id', $classroom->education_skill_id);
                        });
                    }
                })->get();
            $activePeriod->setRelation('aspects', $allowedAspects);

            $exists = $allowedAspects->where('id', $selectedAspectId)->first();
            if (!$exists) {
                $selectedAspectId = $allowedAspects->first()?->id;
            }
        }

        $selectedAspect = $activePeriod ? $allowedAspects->where('id', $selectedAspectId)->first() : null;

        $dates = [];
        if ($activePeriod && $selectedMonth) {
            $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
            $daysInMonth = $monthCarbon->daysInMonth;
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
                $dateCarbon = \Carbon\Carbon::parse($dateStr);
                if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                    $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                    $dates[] = $dateStr;
                }
            }
        }

        $students = [];
        if ($activePeriod && $selectedAspect) {
            $students = EducationStudent::with(['registration', 'scores' => function($q) use ($selectedAspectId, $dates) {
                $q->where('education_aspect_id', $selectedAspectId)
                  ->whereIn('evaluation_date', $dates);
            }])
            ->where('education_period_id', $activePeriod->id)
            ->where('classroom_id', $classroom->id)
            ->get();
        }

        return view('teacher.education.daily-control', compact(
            'user', 'classroom', 'activePeriod', 'months', 'selectedMonth',
            'selectedAspectId', 'selectedAspect', 'dates', 'students'
        ));
    }

    public function teacherEducationDailyControlStore(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $request->validate([
            'classroom_id' => 'required',
            'education_aspect_id' => 'required|exists:education_aspects,id',
            'input_type' => 'required|in:checklist,score,counter',
            'kkm' => 'nullable|numeric|min:0',
            'month' => 'required|string',
            'active_days' => 'nullable|array',
            'scores' => 'nullable|array',
            'notes' => 'nullable|array',
        ]);

        $aspect = EducationAspect::findOrFail($request->education_aspect_id);
        $activePeriod = EducationPeriod::findOrFail($aspect->education_period_id);

        $dates = [];
        $selectedMonth = $request->month;
        $monthCarbon = \Carbon\Carbon::parse($selectedMonth . '-01');
        $daysInMonth = $monthCarbon->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateStr = $selectedMonth . '-' . sprintf('%02d', $day);
            $dateCarbon = \Carbon\Carbon::parse($dateStr);
            if ($dateCarbon->gte(\Carbon\Carbon::parse($activePeriod->start_date)) && 
                $dateCarbon->lte(\Carbon\Carbon::parse($activePeriod->end_date))) {
                $dates[] = $dateStr;
            }
        }

        $existingActiveDays = $aspect->active_days ?? [];
        $otherMonthsActiveDays = array_filter($existingActiveDays, function($d) use ($dates) {
            return !in_array($d, $dates);
        });

        $newActiveDays = $request->has('active_days') ? array_keys($request->active_days) : [];
        $updatedActiveDays = array_values(array_unique(array_merge($otherMonthsActiveDays, $newActiveDays)));

        $aspect->update([
            'input_type' => $request->input_type,
            'target_weekly' => ($request->input_type === 'score' || $request->input_type === 'counter') ? ($request->kkm ?? 80.00) : 0.00,
            'active_days' => $updatedActiveDays,
        ]);

        if ($request->has('scores') && is_array($request->scores)) {
            foreach ($request->scores as $studentId => $dateScores) {
                foreach ($dateScores as $date => $score) {
                    $note = $request->input("notes.{$studentId}.{$date}") ?? null;
                    EducationScore::updateOrCreate([
                        'education_student_id' => $studentId,
                        'education_aspect_id' => $request->education_aspect_id,
                        'evaluation_date' => $date,
                    ], [
                        'score' => $score,
                        'notes' => $note,
                    ]);
                }
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kontrol harian berhasil disimpan.'
            ]);
        }

        return redirect()->back()->with('success', 'Kontrol harian berhasil disimpan.');
    }

    // --- MASA BERKARYA ---
    public function careerTargets(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        // Get all Konteks Karya with their dynamic fields
        $contexts = \App\Models\CareerTargetContext::with('fields')->orderBy('name', 'asc')->get();

        return view('super-admin.career.targets', compact('user', 'contexts'));
    }

    public function careerTargetContextsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        \App\Models\CareerTargetContext::create($request->all());

        return redirect()->back()->with('success', 'Konteks Karya berhasil ditambahkan.');
    }

    public function careerTargetContextsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $context = \App\Models\CareerTargetContext::findOrFail($id);
        $context->update($request->all());

        return redirect()->back()->with('success', 'Konteks Karya berhasil diperbarui.');
    }

    public function careerTargetContextsDestroy($id)
    {
        $context = \App\Models\CareerTargetContext::findOrFail($id);
        $context->delete();

        return redirect()->back()->with('success', 'Konteks Karya berhasil dihapus.');
    }

    public function careerTargetsStore(Request $request)
    {
        $request->validate([
            'career_target_context_id' => 'required|exists:career_target_contexts,id',
            'label' => 'required|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'type' => 'required|in:text,link,multiple_images',
        ]);

        \App\Models\CareerTargetField::create($request->all());

        return redirect()->back()->with('success', 'Kolom Target Karya berhasil ditambahkan.');
    }

    public function careerTargetsUpdate(Request $request, $id)
    {
        $request->validate([
            'career_target_context_id' => 'required|exists:career_target_contexts,id',
            'label' => 'required|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'type' => 'required|in:text,link,multiple_images',
        ]);

        $field = \App\Models\CareerTargetField::findOrFail($id);
        $field->update($request->all());

        return redirect()->back()->with('success', 'Kolom Target Karya berhasil diperbarui.');
    }

    public function careerTargetsDestroy($id)
    {
        $field = \App\Models\CareerTargetField::findOrFail($id);
        $field->delete();

        return redirect()->back()->with('success', 'Kolom Target Karya berhasil dihapus.');
    }

    public function careerSettings(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();
        $programs = \App\Models\EducationProgram::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', 'all');
        $selectedBatchId = $request->input('batch_id', 'all');
        $selectedProgramId = $request->input('education_program_id', 'all');

        $query = EducationStudent::with([
            'registration.educationProgram',
            'registration.major',
            'period.academicYear',
            'period.batch'
        ])
        ->where('status', 'passed');

        if ($selectedAcademicYearId !== 'all') {
            $query->whereHas('period', function($q) use ($selectedAcademicYearId) {
                $q->where('academic_year_id', $selectedAcademicYearId);
            });
        }

        if ($selectedBatchId !== 'all') {
            $query->whereHas('period', function($q) use ($selectedBatchId) {
                $q->where('batch_id', $selectedBatchId);
            });
        }

        if ($selectedProgramId !== 'all') {
            $query->whereHas('registration', function($q) use ($selectedProgramId) {
                $q->where('education_program_id', $selectedProgramId);
            });
        }

        $passedStudents = $query->orderBy('id', 'desc')->paginate(10);

        return view('super-admin.career.settings', compact(
            'user', 'passedStudents', 'academicYears', 'batches', 'programs',
            'selectedAcademicYearId', 'selectedBatchId', 'selectedProgramId'
        ));
    }

    public function careerSettingsStore(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'student_id' => 'required|exists:education_students,id',
            'career_start_date' => 'nullable|date',
            'career_end_date' => 'nullable|date|after_or_equal:career_start_date',
        ]);

        $student = EducationStudent::findOrFail($request->student_id);
        $student->update([
            'career_start_date' => $request->career_start_date,
            'career_end_date' => $request->career_end_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Periode Masa Berkarya untuk ' . $student->registration->name . ' berhasil diperbarui.'
        ]);
    }

    public function careerPlacements(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        // Fetch all divisions
        $placements = CareerPlacement::with(['students.registration'])->orderBy('name', 'asc')->get();

        // Fetch all teachers for PJ Divisi searchable select
        $teachers = \App\Models\User::where('role', 'pengajar')->orderBy('name', 'asc')->get();

        // Fetch waiting list: education students who are passed (status = 'passed'), have their career period set, and have no placement (career_placement_id = null)
        $waitingStudents = EducationStudent::with(['registration', 'period.academicYear', 'period.batch'])
            ->where('status', 'passed')
            ->whereNotNull('career_start_date')
            ->whereNotNull('career_end_date')
            ->whereNull('career_placement_id')
            ->orderBy('id', 'desc')
            ->get();

        return view('super-admin.career.placements', compact('user', 'placements', 'teachers', 'waitingStudents'));
    }

    public function careerPlacementsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'mentor_name' => 'nullable|string',
            'mentor_contact' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        CareerPlacement::create($request->all());

        return redirect()->back()->with('success', 'Divisi Penempatan berhasil ditambahkan.');
    }

    public function careerPlacementsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'mentor_name' => 'nullable|string',
            'mentor_contact' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $placement = CareerPlacement::findOrFail($id);
        $placement->update($request->all());

        return redirect()->back()->with('success', 'Divisi Penempatan berhasil diperbarui.');
    }

    public function careerPlacementsDestroy($id)
    {
        $placement = CareerPlacement::findOrFail($id);
        $placement->delete();

        return redirect()->back()->with('success', 'Divisi Penempatan berhasil dihapus.');
    }

    public function careerPlacementsAssignStudent(Request $request)
    {
        $request->validate([
            'career_placement_id' => 'required|exists:career_placements,id',
            'student_ids' => 'required|array',
        ]);

        EducationStudent::whereIn('id', $request->student_ids)
            ->update(['career_placement_id' => $request->career_placement_id]);

        return redirect()->back()->with('success', 'Santri berhasil ditempatkan ke divisi.');
    }

    public function careerPlacementsRemoveStudent($id)
    {
        $student = EducationStudent::findOrFail($id);
        $student->update(['career_placement_id' => null]);

        return redirect()->back()->with('success', 'Santri berhasil dikeluarkan dari divisi penempatan.');
    }

    public function careerReports(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();
        $programs = \App\Models\EducationProgram::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', 'all');
        $selectedBatchId = $request->input('batch_id', 'all');
        $selectedProgramId = $request->input('education_program_id', 'all');

        $query = EducationStudent::with([
            'registration.educationProgram',
            'registration.major',
            'period.academicYear',
            'period.batch',
            'careerPlacement'
        ])->where('status', 'passed')->whereNotNull('career_start_date')->whereNotNull('career_end_date');

        if ($selectedAcademicYearId !== 'all') {
            $query->whereHas('period', function($q) use ($selectedAcademicYearId) {
                $q->where('academic_year_id', $selectedAcademicYearId);
            });
        }
        if ($selectedBatchId !== 'all') {
            $query->whereHas('period', function($q) use ($selectedBatchId) {
                $q->where('batch_id', $selectedBatchId);
            });
        }
        if ($selectedProgramId !== 'all') {
            $query->whereHas('registration', function($q) use ($selectedProgramId) {
                $q->where('education_program_id', $selectedProgramId);
            });
        }

        $passedStudents = $query->orderBy('id', 'desc')->paginate(10);

        return view('super-admin.career.rapor', compact(
            'user', 'academicYears', 'batches', 'programs',
            'selectedAcademicYearId', 'selectedBatchId', 'selectedProgramId',
            'passedStudents'
        ));
    }

    public function careerReportsManagement(Request $request, $student_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $student = EducationStudent::with(['registration.educationProgram', 'registration.major', 'period.academicYear', 'period.batch', 'careerPlacement'])->findOrFail($student_id);

        $contexts = \App\Models\CareerTargetContext::with('fields')->orderBy('name', 'asc')->get();

        $activeTab = $request->input('tab', 'overview');

        // Summarize context submissions
        $summaries = [];
        foreach ($contexts as $ctx) {
            $summaries[] = [
                'context' => $ctx,
                'total_submissions' => \App\Models\CareerTargetSubmission::where('education_student_id', $student_id)
                    ->where('career_target_context_id', $ctx->id)
                    ->count(),
                'average_score' => \App\Models\CareerTargetSubmission::where('education_student_id', $student_id)
                    ->where('career_target_context_id', $ctx->id)
                    ->avg('score'),
            ];
        }

        $activeContext = null;
        $submissions = collect();
        $incomes = collect();
        $totalIncome = \App\Models\CareerStudentIncome::where('education_student_id', $student_id)->where('is_approved', true)->sum('amount');

        if ($activeTab === 'income') {
            $incomes = \App\Models\CareerStudentIncome::where('education_student_id', $student_id)
                ->orderBy('date', 'desc')
                ->paginate(10);
        } elseif ($activeTab !== 'overview') {
            $contextId = str_replace('context_', '', $activeTab);
            $activeContext = \App\Models\CareerTargetContext::with('fields')->find($contextId);
            if ($activeContext) {
                $submissions = \App\Models\CareerTargetSubmission::with('values.field')
                    ->where('education_student_id', $student_id)
                    ->where('career_target_context_id', $activeContext->id)
                    ->orderBy('id', 'desc')
                    ->paginate(5);
            }
        }

        return view('super-admin.career.management', compact('user', 'student', 'contexts', 'activeTab', 'summaries', 'activeContext', 'submissions', 'incomes', 'totalIncome'));
    }

    public function careerReportsIncomesStore(Request $request, $student_id)
    {
        $request->validate([
            'amount' => 'required',
            'source' => 'required|string|max:255',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Clean currency formatting from amount
        $amount = (int) preg_replace('/[^0-9]/', '', $request->amount);

        \App\Models\CareerStudentIncome::create([
            'education_student_id' => $student_id,
            'amount' => $amount,
            'source' => $request->source,
            'date' => $request->date,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Data penghasilan berhasil ditambahkan.');
    }

    public function careerReportsIncomesUpdate(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required',
            'source' => 'required|string|max:255',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $income = \App\Models\CareerStudentIncome::findOrFail($id);
        
        $amount = (int) preg_replace('/[^0-9]/', '', $request->amount);

        $income->update([
            'amount' => $amount,
            'source' => $request->source,
            'date' => $request->date,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Data penghasilan berhasil diperbarui.');
    }

    public function careerReportsIncomesDestroy($id)
    {
        $income = \App\Models\CareerStudentIncome::findOrFail($id);
        $income->delete();

        return redirect()->back()->with('success', 'Data penghasilan berhasil dihapus.');
    }

    public function careerReportsIncomesApprove(Request $request, $id)
    {
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $income = \App\Models\CareerStudentIncome::findOrFail($id);
        $income->update([
            'is_approved' => (bool) $request->is_approved,
        ]);

        return redirect()->back()->with('success', 'Status approval penghasilan berhasil diperbarui.');
    }

    public function careerReportsUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'career_status' => 'required|in:active,passed,failed,resigned',
        ]);

        $student = EducationStudent::findOrFail($id);
        $student->update([
            'career_status' => $request->career_status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status Berkarya untuk ' . $student->registration->name . ' berhasil diperbarui.'
        ]);
    }

    public function careerReportsAssessSubmission(Request $request, $submission_id)
    {
        $request->validate([
            'score' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $submission = \App\Models\CareerTargetSubmission::findOrFail($submission_id);
        $submission->update([
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Penilaian karya berhasil disimpan.');
    }

    public function careerReportsSubmissionsStore(Request $request, $student_id, $context_id)
    {
        $context = \App\Models\CareerTargetContext::with('fields')->findOrFail($context_id);

        $submission = \App\Models\CareerTargetSubmission::create([
            'education_student_id' => $student_id,
            'career_target_context_id' => $context_id,
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        foreach ($context->fields as $f) {
            $value = '';
            if ($f->type === 'multiple_images') {
                if ($request->hasFile('field_' . $f->id)) {
                    $paths = [];
                    foreach ($request->file('field_' . $f->id) as $file) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/submissions'), $filename);
                        $paths[] = '/uploads/submissions/' . $filename;
                    }
                    $value = json_encode($paths);
                } else {
                    $value = json_encode([]);
                }
            } else {
                $value = $request->input('field_' . $f->id);
            }

            \App\Models\CareerTargetSubmissionValue::create([
                'career_target_submission_id' => $submission->id,
                'career_target_field_id' => $f->id,
                'value' => $value,
            ]);
        }

        return redirect()->back()->with('success', 'Data Karya berhasil ditambahkan.');
    }

    public function careerReportsSubmissionsUpdate(Request $request, $submission_id)
    {
        $submission = \App\Models\CareerTargetSubmission::findOrFail($submission_id);
        $context = \App\Models\CareerTargetContext::with('fields')->findOrFail($submission->career_target_context_id);

        $submission->update([
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        foreach ($context->fields as $f) {
            $value = '';
            if ($f->type === 'multiple_images') {
                if ($request->hasFile('field_' . $f->id)) {
                    $paths = [];
                    foreach ($request->file('field_' . $f->id) as $file) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/submissions'), $filename);
                        $paths[] = '/uploads/submissions/' . $filename;
                    }
                    $value = json_encode($paths);
                } else {
                    $oldVal = \App\Models\CareerTargetSubmissionValue::where('career_target_submission_id', $submission->id)
                        ->where('career_target_field_id', $f->id)
                        ->first();
                    $value = $oldVal ? $oldVal->value : json_encode([]);
                }
            } else {
                $value = $request->input('field_' . $f->id);
            }

            \App\Models\CareerTargetSubmissionValue::updateOrCreate(
                [
                    'career_target_submission_id' => $submission->id,
                    'career_target_field_id' => $f->id,
                ],
                [
                    'value' => $value,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data Karya berhasil diperbarui.');
    }

    public function careerReportsSubmissionsDestroy($submission_id)
    {
        $submission = \App\Models\CareerTargetSubmission::findOrFail($submission_id);
        $submission->delete();

        return redirect()->back()->with('success', 'Data Karya berhasil dihapus.');
    }

    // --- SANTRI CAREER ROUTES ---
    public function santriCareerLogbook(Request $request)
    {
        $user = Auth::user();
        $registration = Registration::where('email', $user->email)->first();
        if (!$registration) {
            return redirect('/login')->with('error', 'Registrasi tidak ditemukan.');
        }

        $careerStudent = CareerStudent::with(['period', 'placement', 'logs' => function($q) {
            $q->orderBy('log_date', 'desc');
        }])->where('registration_id', $registration->id)->first();

        return view('santri.career.logbook', compact('user', 'registration', 'careerStudent'));
    }

    public function santriCareerLogbookStore(Request $request)
    {
        $request->validate([
            'career_student_id' => 'required|exists:career_students,id',
            'log_date' => 'required|date',
            'task' => 'required|string',
            'progress' => 'nullable|string',
            'obstacles' => 'nullable|string',
        ]);

        CareerLog::create($request->all() + ['status' => 'pending']);

        return redirect()->back()->with('success', 'Jurnal harian berhasil dikirim untuk diapprove.');
    }

    public function santriCareerPortfolio(Request $request)
    {
        $user = Auth::user();
        $registration = Registration::where('email', $user->email)->first();
        if (!$registration) {
            return redirect('/login')->with('error', 'Registrasi tidak ditemukan.');
        }

        $careerStudent = CareerStudent::with(['period', 'placement', 'portfolios'])->where('registration_id', $registration->id)->first();

        return view('santri.career.portfolio', compact('user', 'registration', 'careerStudent'));
    }

    public function santriCareerPortfolioStore(Request $request)
    {
        $request->validate([
            'career_student_id' => 'required|exists:career_students,id',
            'title' => 'required|string',
            'project_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        CareerPortfolio::create($request->all());

        return redirect()->back()->with('success', 'Karya/Portofolio berhasil ditambahkan.');
    }

    // --- TEACHER (MENTOR) CAREER ROUTES ---
    public function teacherCareerLogbook(Request $request)
    {
        $user = Auth::user();
        // Get placements where this user is mentor (matching mentor_name with User.name)
        $placements = CareerPlacement::where('mentor_name', $user->name)->get();

        $selectedPlacementId = $request->input('career_placement_id', $placements->first()?->id);
        $logs = [];

        if ($selectedPlacementId && $placements->contains('id', $selectedPlacementId)) {
            $logs = CareerLog::with(['student.registration', 'student.placement'])
                ->whereHas('student', function($q) use ($selectedPlacementId) {
                    $q->where('career_placement_id', $selectedPlacementId);
                })
                ->orderBy('log_date', 'desc')
                ->get();
        }

        return view('teacher.career.logbook', compact('user', 'placements', 'selectedPlacementId', 'logs'));
    }

    public function teacherCareerLogbookApprove($id, Request $request)
    {
        $user = Auth::user();
        $log = CareerLog::findOrFail($id);
        
        // Safety check: ensure mentor owns this placement/student
        $studentPlacement = $log->student?->placement;
        if (!$studentPlacement || $studentPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $log->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Logbook berhasil disetujui.');
    }

    public function teacherCareerLogbookReject($id, Request $request)
    {
        $user = Auth::user();
        $log = CareerLog::findOrFail($id);
        
        // Safety check: ensure mentor owns this placement/student
        $studentPlacement = $log->student?->placement;
        if (!$studentPlacement || $studentPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $log->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Logbook berhasil ditolak.');
    }

    public function teacherCareerPenilaian(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        // Fetch placements where this user is mentor (Pj Divisi)
        $placements = CareerPlacement::withCount(['students' => function($q) {
            $q->where('status', 'passed');
        }])
        ->where('mentor_name', $user->name)
        ->get();

        return view('teacher.career.divisi-list', compact('user', 'placements'));
    }

    public function teacherCareerPenilaianDivisi(Request $request, $placementId)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $placements = CareerPlacement::where('mentor_name', $user->name)->get();
        $placement = CareerPlacement::findOrFail($placementId);
        
        // Safety check: ensure mentor owns this placement
        if ($placement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $selectedPlacementId = $placementId;

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();
        $programs = \App\Models\EducationProgram::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', 'all');
        $selectedBatchId = $request->input('batch_id', 'all');
        $selectedProgramId = $request->input('education_program_id', 'all');

        $month = $request->input('month', date('n'));
        $year = $request->input('year', date('Y'));
        
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $monthName = $months[$month];

        $query = EducationStudent::with([
            'registration.educationProgram',
            'registration.major',
            'period.academicYear',
            'period.batch',
            'careerPlacement'
        ])
        ->where('status', 'passed')
        ->whereNotNull('career_start_date')
        ->whereNotNull('career_end_date')
        ->where('career_placement_id', $selectedPlacementId);

        if ($selectedAcademicYearId !== 'all') {
            $query->whereHas('period', function($q) use ($selectedAcademicYearId) {
                $q->where('academic_year_id', $selectedAcademicYearId);
            });
        }
        if ($selectedBatchId !== 'all') {
            $query->whereHas('period', function($q) use ($selectedBatchId) {
                $q->where('batch_id', $selectedBatchId);
            });
        }
        if ($selectedProgramId !== 'all') {
            $query->whereHas('registration', function($q) use ($selectedProgramId) {
                $q->where('education_program_id', $selectedProgramId);
            });
        }

        $passedStudents = $query->orderBy('id', 'desc')->paginate(10);

        // Sync to CareerStudent to keep KPI Scores database consistency
        $eduStudents = EducationStudent::where('career_placement_id', $selectedPlacementId)
            ->where('status', 'passed')
            ->get();
        
        $activePeriod = \App\Models\CareerPeriod::where('status', 'active')->first();
        $periodId = $activePeriod?->id ?? \App\Models\CareerPeriod::first()?->id;

        if ($periodId) {
            foreach ($eduStudents as $edu) {
                CareerStudent::firstOrCreate([
                    'registration_id' => $edu->registration_id,
                    'career_period_id' => $periodId,
                ], [
                    'career_placement_id' => $selectedPlacementId,
                    'status' => 'active'
                ]);
            }
        }

        $students = CareerStudent::with(['registration', 'scores'])
            ->where('career_placement_id', $selectedPlacementId)
            ->get();
        
        $reports = \App\Models\CareerScore::whereIn('career_student_id', $students->pluck('id'))
            ->whereYear('evaluation_date', $year)
            ->whereMonth('evaluation_date', $month)
            ->get()
            ->groupBy('career_student_id')
            ->map(function($studentScores) {
                $comm = $studentScores->avg('soft_skill_communication') ?? 0;
                $team = $studentScores->avg('soft_skill_teamwork') ?? 0;
                $disc = $studentScores->avg('soft_skill_discipline') ?? 0;
                $qual = $studentScores->avg('hard_skill_quality') ?? 0;
                $spd  = $studentScores->avg('hard_skill_speed') ?? 0;
                $prob = $studentScores->avg('hard_skill_problem_solving') ?? 0;

                return (object)[
                    'soft_skill' => ($comm + $team + $disc) / 3,
                    'hard_skill' => ($qual + $spd + $prob) / 3,
                    'soft_comm' => $comm,
                    'soft_team' => $team,
                    'soft_disc' => $disc,
                    'hard_qual' => $qual,
                    'hard_spd' => $spd,
                    'hard_prob' => $prob,
                    'notes' => $studentScores->first()->notes ?? ''
                ];
            });

        return view('teacher.career.penilaian', compact(
            'user', 'placement', 'placements', 'selectedPlacementId', 'students', 'reports', 
            'month', 'year', 'monthName', 'months', 'passedStudents', 
            'academicYears', 'batches', 'programs',
            'selectedAcademicYearId', 'selectedBatchId', 'selectedProgramId'
        ));
    }

    public function teacherCareerPenilaianStore(Request $request)
    {
        $request->validate([
            'career_student_id' => 'required|exists:career_students,id',
            'evaluation_date' => 'required|date',
            'soft_skill_communication' => 'required|numeric|min:0|max:100',
            'soft_skill_teamwork' => 'required|numeric|min:0|max:100',
            'soft_skill_discipline' => 'required|numeric|min:0|max:100',
            'hard_skill_quality' => 'required|numeric|min:0|max:100',
            'hard_skill_speed' => 'required|numeric|min:0|max:100',
            'hard_skill_problem_solving' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        CareerScore::updateOrCreate([
            'career_student_id' => $request->career_student_id,
            'evaluator_id' => Auth::id(),
            'evaluation_date' => $request->evaluation_date,
        ], $request->all());

        return redirect()->back()->with('success', 'Penilaian kinerja KPI berhasil disimpan.');
    }

    public function teacherCareerReportsManagement(Request $request, $student_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        // Ensure teacher owns this placement/student
        $student = EducationStudent::with(['registration.educationProgram', 'registration.major', 'period.academicYear', 'period.batch', 'careerPlacement'])->findOrFail($student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $contexts = \App\Models\CareerTargetContext::with('fields')->orderBy('name', 'asc')->get();
        $activeTab = $request->input('tab', 'overview');

        // Summarize context submissions
        $summaries = [];
        foreach ($contexts as $ctx) {
            $summaries[] = [
                'context' => $ctx,
                'total_submissions' => \App\Models\CareerTargetSubmission::where('education_student_id', $student_id)
                    ->where('career_target_context_id', $ctx->id)
                    ->count(),
                'average_score' => \App\Models\CareerTargetSubmission::where('education_student_id', $student_id)
                    ->where('career_target_context_id', $ctx->id)
                    ->avg('score'),
            ];
        }

        $activeContext = null;
        $submissions = collect();
        $incomes = collect();
        $totalIncome = \App\Models\CareerStudentIncome::where('education_student_id', $student_id)->where('is_approved', true)->sum('amount');

        if ($activeTab === 'income') {
            $incomes = \App\Models\CareerStudentIncome::where('education_student_id', $student_id)
                ->orderBy('date', 'desc')
                ->paginate(10);
        } elseif ($activeTab !== 'overview') {
            $contextId = str_replace('context_', '', $activeTab);
            $activeContext = \App\Models\CareerTargetContext::with('fields')->find($contextId);
            if ($activeContext) {
                $submissions = \App\Models\CareerTargetSubmission::with('values.field')
                    ->where('education_student_id', $student_id)
                    ->where('career_target_context_id', $activeContext->id)
                    ->orderBy('id', 'desc')
                    ->paginate(5);
            }
        }

        return view('teacher.career.management', compact('user', 'student', 'contexts', 'activeTab', 'summaries', 'activeContext', 'submissions', 'incomes', 'totalIncome'));
    }

    public function teacherCareerUpdateStatus(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $student = EducationStudent::findOrFail($id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            return response()->json(['success' => false, 'message' => 'Unauthorized placement'], 403);
        }

        $student->update(['career_status' => $request->career_status]);

        return response()->json(['success' => true, 'message' => 'Status santri berhasil diperbarui']);
    }

    public function teacherCareerReportsIncomesStore(Request $request, $student_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $student = EducationStudent::findOrFail($student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'amount' => 'required',
            'source' => 'required|string|max:255',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $amount = (float) str_replace(['Rp', '.', ' ', ','], '', $request->amount);

        \App\Models\CareerStudentIncome::create([
            'education_student_id' => $student_id,
            'amount' => $amount,
            'source' => $request->source,
            'date' => $request->date,
            'notes' => $request->notes,
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'Laporan penghasilan berhasil diajukan.');
    }

    public function teacherCareerReportsIncomesUpdate(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $income = \App\Models\CareerStudentIncome::findOrFail($id);
        $student = EducationStudent::findOrFail($income->education_student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'amount' => 'required',
            'source' => 'required|string|max:255',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $amount = (float) str_replace(['Rp', '.', ' ', ','], '', $request->amount);

        $income->update([
            'amount' => $amount,
            'source' => $request->source,
            'date' => $request->date,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Data penghasilan berhasil diperbarui.');
    }

    public function teacherCareerReportsIncomesDestroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $income = \App\Models\CareerStudentIncome::findOrFail($id);
        $student = EducationStudent::findOrFail($income->education_student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $income->delete();

        return redirect()->back()->with('success', 'Data penghasilan berhasil dihapus.');
    }

    public function teacherCareerReportsIncomesApprove(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $income = \App\Models\CareerStudentIncome::findOrFail($id);
        $student = EducationStudent::findOrFail($income->education_student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $income->update([
            'is_approved' => (bool) $request->is_approved,
        ]);

        return redirect()->back()->with('success', 'Status approval penghasilan berhasil diperbarui.');
    }

    public function teacherCareerReportsAssessSubmission(Request $request, $submission_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $request->validate([
            'score' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $submission = \App\Models\CareerTargetSubmission::findOrFail($submission_id);
        $student = EducationStudent::findOrFail($submission->education_student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $submission->update([
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Penilaian karya berhasil disimpan.');
    }

    public function teacherCareerReportsSubmissionsStore(Request $request, $student_id, $context_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $student = EducationStudent::findOrFail($student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $context = \App\Models\CareerTargetContext::with('fields')->findOrFail($context_id);

        $submission = \App\Models\CareerTargetSubmission::create([
            'education_student_id' => $student_id,
            'career_target_context_id' => $context_id,
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        foreach ($context->fields as $f) {
            $value = '';
            if ($f->type === 'multiple_images') {
                if ($request->hasFile('field_' . $f->id)) {
                    $paths = [];
                    foreach ($request->file('field_' . $f->id) as $file) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/submissions'), $filename);
                        $paths[] = '/uploads/submissions/' . $filename;
                    }
                    $value = json_encode($paths);
                } else {
                    $value = json_encode([]);
                }
            } else {
                $value = $request->input('field_' . $f->id);
            }

            \App\Models\CareerTargetSubmissionValue::create([
                'career_target_submission_id' => $submission->id,
                'career_target_field_id' => $f->id,
                'value' => $value,
            ]);
        }

        return redirect()->back()->with('success', 'Data Karya berhasil ditambahkan.');
    }

    public function teacherCareerReportsSubmissionsUpdate(Request $request, $submission_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $submission = \App\Models\CareerTargetSubmission::findOrFail($submission_id);
        $student = EducationStudent::findOrFail($submission->education_student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $context = \App\Models\CareerTargetContext::with('fields')->findOrFail($submission->career_target_context_id);

        $submission->update([
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        foreach ($context->fields as $f) {
            $value = '';
            if ($f->type === 'multiple_images') {
                if ($request->hasFile('field_' . $f->id)) {
                    $paths = [];
                    foreach ($request->file('field_' . $f->id) as $file) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/submissions'), $filename);
                        $paths[] = '/uploads/submissions/' . $filename;
                    }
                    $value = json_encode($paths);
                } else {
                    $oldVal = \App\Models\CareerTargetSubmissionValue::where('career_target_submission_id', $submission->id)
                        ->where('career_target_field_id', $f->id)
                        ->first();
                    $value = $oldVal ? $oldVal->value : json_encode([]);
                }
            } else {
                $value = $request->input('field_' . $f->id);
            }

            \App\Models\CareerTargetSubmissionValue::updateOrCreate(
                [
                    'career_target_submission_id' => $submission->id,
                    'career_target_field_id' => $f->id,
                ],
                [
                    'value' => $value,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data Karya berhasil diperbarui.');
    }

    public function teacherCareerReportsSubmissionsDestroy($submission_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        $submission = \App\Models\CareerTargetSubmission::findOrFail($submission_id);
        $student = EducationStudent::findOrFail($submission->education_student_id);
        if (!$student->careerPlacement || $student->careerPlacement->mentor_name !== $user->name) {
            abort(403, 'Unauthorized action.');
        }

        $submission->delete();

        return redirect()->back()->with('success', 'Data Karya berhasil dihapus.');
    }

    public function teacherKpiChecklist(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'pengajar') {
            return redirect('/login');
        }

        // Active periods
        $periods = \App\Models\TeacherKpiPeriod::orderBy('name', 'desc')->get();
        $selectedPeriodId = $request->input('period_id', $periods->first()?->id);
        
        $selectedPeriod = null;
        if ($selectedPeriodId) {
            $selectedPeriod = \App\Models\TeacherKpiPeriod::find($selectedPeriodId);
        }

        // Default selectedDate is the start_date of the selected period, or today if it falls in the period
        $defaultDate = date('Y-m-d');
        if ($selectedPeriod) {
            if ($defaultDate < $selectedPeriod->start_date || $defaultDate > $selectedPeriod->end_date) {
                $defaultDate = $selectedPeriod->start_date;
            }
        }
        
        $selectedDate = $request->input('date', $defaultDate);

        // Ensure the selectedDate is strictly within the chosen period's range
        if ($selectedPeriod) {
            if ($selectedDate < $selectedPeriod->start_date) {
                $selectedDate = $selectedPeriod->start_date;
            } elseif ($selectedDate > $selectedPeriod->end_date) {
                $selectedDate = $selectedPeriod->end_date;
            }
        }

        // Load Assigned Items for this teacher in this period, and filter those that do NOT have selectedDate in their off_days
        $assignments = \App\Models\TeacherKpiAssignment::where('user_id', $user->id)
            ->where('teacher_kpi_period_id', $selectedPeriodId)
            ->get();
            
        $assignedItems = [];
        foreach ($assignments as $asg) {
            $offDays = is_array($asg->off_days) ? $asg->off_days : [];
            if (!in_array($selectedDate, $offDays)) {
                $assignedItems[] = $asg->teacher_kpi_item_id;
            }
        }

        $items = \App\Models\TeacherKpiItem::whereIn('id', $assignedItems)->get();

        // Get logs for selected date
        $logsRaw = \App\Models\TeacherKpiLog::where('user_id', $user->id)
            ->where('date', $selectedDate)
            ->get();
        
        $logs = [];
        foreach ($logsRaw as $lg) {
            $logs[$lg->teacher_kpi_item_id] = $lg->is_checked;
        }

        return view('teacher.kpi-checklist', compact('user', 'periods', 'selectedPeriodId', 'selectedPeriod', 'selectedDate', 'items', 'logs'));
    }

    public function careerRaporScoreStore(Request $request)
    {
        $request->validate([
            'career_student_id' => 'required|exists:career_students,id',
            'evaluation_date' => 'required|date',
            'soft_skill_communication' => 'required|numeric|min:0|max:100',
            'soft_skill_teamwork' => 'required|numeric|min:0|max:100',
            'soft_skill_discipline' => 'required|numeric|min:0|max:100',
            'hard_skill_quality' => 'required|numeric|min:0|max:100',
            'hard_skill_speed' => 'required|numeric|min:0|max:100',
            'hard_skill_problem_solving' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        CareerScore::updateOrCreate([
            'career_student_id' => $request->career_student_id,
            'evaluator_id' => Auth::id(),
        ], $request->all() + ['evaluation_date' => $request->evaluation_date]);

        return response()->json(['success' => true]);
    }

    public function billingOverview(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $totalCategories = \App\Models\BillingCategory::count();
        $categories = \App\Models\BillingCategory::all();
        
        $totalTarget = 0;
        $totalActual = \App\Models\BillingPayment::sum('amount');
        
        foreach ($categories as $cat) {
            $billedStudentsCount = \App\Models\BillingStudentBill::where('billing_category_id', $cat->id)
                ->where('is_billed', true)
                ->whereHas('registration', function($q) {
                    $q->where('status', 'penerimaan');
                })
                ->count();
            $totalTarget += ($cat->total_amount * $billedStudentsCount);
        }

        $percentage = $totalTarget > 0 ? ($totalActual / $totalTarget) * 100 : 0;

        $breakdown = [];
        foreach ($categories as $cat) {
            $catActual = \App\Models\BillingPayment::where('billing_category_id', $cat->id)->sum('amount');
            $billedStudentsCount = \App\Models\BillingStudentBill::where('billing_category_id', $cat->id)
                ->where('is_billed', true)
                ->whereHas('registration', function($q) {
                    $q->where('status', 'penerimaan');
                })
                ->count();
            $catTarget = $cat->total_amount * $billedStudentsCount;
            $catPercentage = $catTarget > 0 ? ($catActual / $catTarget) * 100 : 0;
            
            $breakdown[] = [
                'category' => $cat,
                'actual' => $catActual,
                'target' => $catTarget,
                'percentage' => $catPercentage,
            ];
        }

        return view('super-admin.billing.overview', compact('user', 'totalCategories', 'totalTarget', 'totalActual', 'percentage', 'breakdown'));
    }

    public function billingCategories(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $categories = \App\Models\BillingCategory::orderBy('name', 'asc')->paginate(10);
        return view('super-admin.billing.categories', compact('user', 'categories'));
    }

    public function billingCategoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_amount' => 'required|integer|min:0',
            'installment_count' => 'required|integer|min:1',
        ]);

        \App\Models\BillingCategory::create($request->all());

        return redirect()->back()->with('success', 'Kategori tagihan berhasil ditambahkan.');
    }

    public function billingCategoriesUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_amount' => 'required|integer|min:0',
            'installment_count' => 'required|integer|min:1',
        ]);

        $cat = \App\Models\BillingCategory::findOrFail($id);
        $oldInstallments = $cat->installment_count;
        $newInstallments = $request->installment_count;

        $cat->update($request->all());

        if ($newInstallments < $oldInstallments) {
            \App\Models\BillingPayment::where('billing_category_id', $id)
                ->where('installment_index', '>', $newInstallments)
                ->delete();
        }

        return redirect()->back()->with('success', 'Kategori tagihan berhasil diperbarui.');
    }

    public function billingCategoriesDestroy($id)
    {
        $cat = \App\Models\BillingCategory::findOrFail($id);
        $cat->delete();

        return redirect()->back()->with('success', 'Kategori tagihan berhasil dihapus.');
    }

    public function billingCategoryDetails(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $category = \App\Models\BillingCategory::findOrFail($id);

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $batches = Batch::orderBy('name', 'asc')->get();
        $programs = \App\Models\EducationProgram::orderBy('name', 'asc')->get();

        $selectedAcademicYearId = $request->input('academic_year_id', 'all');
        $selectedBatchId = $request->input('batch_id', 'all');
        $selectedProgramId = $request->input('education_program_id', 'all');

        $query = Registration::with(['educationProgram', 'major', 'academicYear', 'batch'])
            ->where('status', 'penerimaan');

        if ($selectedAcademicYearId !== 'all') {
            $query->where('academic_year_id', $selectedAcademicYearId);
        }
        if ($selectedBatchId !== 'all') {
            $query->where('batch_id', $selectedBatchId);
        }
        if ($selectedProgramId !== 'all') {
            $query->where('education_program_id', $selectedProgramId);
        }

        $students = $query->orderBy('name', 'asc')->paginate(10);

        $studentIds = $students->pluck('id')->toArray();
        $payments = \App\Models\BillingPayment::where('billing_category_id', $id)
            ->whereIn('registration_id', $studentIds)
            ->get()
            ->groupBy('registration_id');

        $studentBills = \App\Models\BillingStudentBill::where('billing_category_id', $id)
            ->whereIn('registration_id', $studentIds)
            ->get()
            ->keyBy('registration_id');

        return view('super-admin.billing.details', compact(
            'user', 'category', 'academicYears', 'batches', 'programs',
            'selectedAcademicYearId', 'selectedBatchId', 'selectedProgramId',
            'students', 'payments', 'studentBills'
        ));
    }

    public function billingPaymentsSave(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'billing_category_id' => 'required|exists:billing_categories,id',
            'installment_index' => 'required|integer|min:1',
            'amount' => 'required|integer|min:0',
        ]);

        $payment = \App\Models\BillingPayment::updateOrCreate(
            [
                'registration_id' => $request->registration_id,
                'billing_category_id' => $request->billing_category_id,
                'installment_index' => $request->installment_index,
            ],
            [
                'amount' => $request->amount,
            ]
        );

        $totalPaid = \App\Models\BillingPayment::where('registration_id', $request->registration_id)
            ->where('billing_category_id', $request->billing_category_id)
            ->sum('amount');

        $category = \App\Models\BillingCategory::find($request->billing_category_id);
        $percentage = $category->total_amount > 0 ? ($totalPaid / $category->total_amount) * 100 : 0;

        return response()->json([
            'success' => true,
            'message' => 'Angsuran berhasil diperbarui.',
            'total_paid' => $totalPaid,
            'percentage' => number_format($percentage, 1),
        ]);
    }

    public function billingRegistrationDetails($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $registration = Registration::with(['educationProgram', 'major', 'academicYear', 'batch'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $registration,
            'age' => $registration->birthdate ? \Carbon\Carbon::parse($registration->birthdate)->age : null
        ]);
    }

    public function billingToggleBilled(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'billing_category_id' => 'required|exists:billing_categories,id',
            'is_billed' => 'required|boolean',
        ]);

        \App\Models\BillingStudentBill::updateOrCreate(
            [
                'registration_id' => $request->registration_id,
                'billing_category_id' => $request->billing_category_id,
            ],
            [
                'is_billed' => $request->is_billed,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Status tagihan santri berhasil diperbarui.',
        ]);
    }

    // ==========================================
    // TEACHER KPI MODULE
    // ==========================================
    public function kpiIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $teachers = \App\Models\User::where('role', 'pengajar')->orderBy('name', 'asc')->paginate(100);
        $periods = \App\Models\TeacherKpiPeriod::orderBy('start_date', 'desc')->get();
        $jobdescs = \App\Models\TeacherKpiJobdesc::with('items')->orderBy('name', 'asc')->get();

        return view('super-admin.kpi.index', compact('user', 'teachers', 'periods', 'jobdescs'));
    }

    public function kpiSettingsMassSave(Request $request)
    {
        $request->validate([
            'teacher_ids'            => 'required|array',
            'teacher_ids.*'          => 'exists:users,id',
            'teacher_kpi_period_ids'  => 'required|array',
            'teacher_kpi_period_ids.*'=> 'exists:teacher_kpi_periods,id',
            'assigned_jobdesc_id'    => 'required|exists:teacher_kpi_jobdescs,id',
        ]);

        $teacherIds = $request->input('teacher_ids', []);
        $periodIds = $request->input('teacher_kpi_period_ids', []);
        $jobdescId = $request->assigned_jobdesc_id;
        $offDaysInput = $request->input('off_days', []); // off_days[period_id][item_id] = [date1, date2, ...]

        // Ambil semua poin KPI dari jobdesc yang dipilih
        $assignedItemIds = \App\Models\TeacherKpiItem::where('teacher_kpi_jobdesc_id', $jobdescId)
            ->pluck('id')
            ->toArray();

        foreach ($teacherIds as $teacherId) {
            // Hapus assignment pengajar ini hanya untuk periode yang dipilih agar tidak merusak data periode lain
            \App\Models\TeacherKpiAssignment::where('user_id', $teacherId)
                ->whereIn('teacher_kpi_period_id', $periodIds)
                ->delete();

            // Insert ulang konfigurasi beserta off-days
            foreach ($periodIds as $periodId) {
                foreach ($assignedItemIds as $itemId) {
                    $offDays = $offDaysInput[$periodId][$itemId] ?? [];
                    if (!is_array($offDays)) {
                        $offDays = [];
                    }

                    \App\Models\TeacherKpiAssignment::create([
                        'user_id' => $teacherId,
                        'teacher_kpi_period_id' => $periodId,
                        'teacher_kpi_item_id' => $itemId,
                        'off_days' => $offDays,
                    ]);
                }
            }
        }

        return redirect()->route('super-admin.kpi.index')->with('success', 'Pengaturan Jobdesc, Periode, & Off-Days secara massal berhasil diterapkan.');
    }


    public function kpiPeriodsIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $periods = \App\Models\TeacherKpiPeriod::orderBy('start_date', 'desc')->get();

        return view('super-admin.kpi.periods', compact('user', 'periods'));
    }

    public function kpiItemsIndex(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $jobdescs = \App\Models\TeacherKpiJobdesc::with('items')->orderBy('name', 'asc')->get();
        $items = \App\Models\TeacherKpiItem::with('jobdesc')->orderBy('name', 'asc')->get();

        return view('super-admin.kpi.items', compact('user', 'jobdescs', 'items'));
    }

    public function kpiManage(Request $request, $teacher_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $teacher = \App\Models\User::where('role', 'pengajar')->findOrFail($teacher_id);
        
        // Find which periods this teacher has assignments in
        $assignedPeriodIds = \App\Models\TeacherKpiAssignment::where('user_id', $teacher_id)
            ->pluck('teacher_kpi_period_id')
            ->unique()
            ->toArray();
        
        $periods = \App\Models\TeacherKpiPeriod::whereIn('id', $assignedPeriodIds)
            ->orderBy('start_date', 'desc')
            ->get();

        if ($request->has('get_periods_json')) {
            return response()->json([
                'success' => true,
                'periods' => $periods
            ]);
        }

        $selectedPeriodId = $request->input('period_id');
        $selectedPeriod = null;

        if ($selectedPeriodId) {
            $selectedPeriod = \App\Models\TeacherKpiPeriod::findOrFail($selectedPeriodId);
        } elseif ($periods->count() > 0) {
            $selectedPeriod = $periods->first();
            $selectedPeriodId = $selectedPeriod->id;
        }

        // Get logs for the selected date (default today)
        $selectedDate = $request->input('date', date('Y-m-d'));
        
        $items = [];
        $logs = [];
        if ($selectedPeriod) {
            // Fetch assignments to this teacher in this period, and filter those that do NOT have selectedDate in their off_days
            $assignments = \App\Models\TeacherKpiAssignment::where('user_id', $teacher_id)
                ->where('teacher_kpi_period_id', $selectedPeriodId)
                ->get();
                
            $assignedItemIds = [];
            foreach ($assignments as $asg) {
                $offDays = is_array($asg->off_days) ? $asg->off_days : [];
                if (!in_array($selectedDate, $offDays)) {
                    $assignedItemIds[] = $asg->teacher_kpi_item_id;
                }
            }
                
            $items = \App\Models\TeacherKpiItem::whereIn('id', $assignedItemIds)->get();
            
            // Check if selectedDate is within period range
            $start = \Carbon\Carbon::parse($selectedPeriod->start_date);
            $end = \Carbon\Carbon::parse($selectedPeriod->end_date);
            $target = \Carbon\Carbon::parse($selectedDate);
            
            if (!$target->between($start, $end)) {
                // If not in range, default to start date
                $selectedDate = $selectedPeriod->start_date;
            }

            // Fetch checked status for all items on this date for this specific teacher
            $itemIds = $items->pluck('id')->toArray();
            $logs = \App\Models\TeacherKpiLog::where('user_id', $teacher_id)
                ->whereIn('teacher_kpi_item_id', $itemIds)
                ->where('date', $selectedDate)
                ->get()
                ->pluck('is_checked', 'teacher_kpi_item_id')
                ->toArray();
        }

        return view('super-admin.kpi.manage', compact(
            'user', 'teacher', 'periods', 'selectedPeriodId', 
            'selectedPeriod', 'selectedDate', 'items', 'logs'
        ));
    }

    public function kpiPeriodsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'off_days' => 'nullable|array',
            'off_days.*' => 'date',
        ]);

        $data = $request->all();
        if (!isset($data['off_days'])) {
            $data['off_days'] = [];
        }

        \App\Models\TeacherKpiPeriod::create($data);

        return redirect()->back()->with('success', 'Periode KPI berhasil ditambahkan.');
    }

    public function kpiPeriodsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'off_days' => 'nullable|array',
            'off_days.*' => 'date',
        ]);

        $period = \App\Models\TeacherKpiPeriod::findOrFail($id);
        
        $data = $request->all();
        if (!isset($data['off_days'])) {
            $data['off_days'] = [];
        }
        
        $period->update($data);

        return redirect()->back()->with('success', 'Periode KPI berhasil diperbarui.');
    }

    public function kpiPeriodsDestroy($id)
    {
        $period = \App\Models\TeacherKpiPeriod::findOrFail($id);
        $period->delete();

        return redirect()->back()->with('success', 'Periode KPI berhasil dihapus.');
    }

    public function kpiJobdescsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        \App\Models\TeacherKpiJobdesc::create($request->all());

        return redirect()->back()->with('success', 'Job Description berhasil ditambahkan.');
    }

    public function kpiJobdescsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $jobdesc = \App\Models\TeacherKpiJobdesc::findOrFail($id);
        $jobdesc->update($request->all());

        return redirect()->back()->with('success', 'Job Description berhasil diperbarui.');
    }

    public function kpiJobdescsDestroy($id)
    {
        $jobdesc = \App\Models\TeacherKpiJobdesc::findOrFail($id);
        $jobdesc->delete();

        return redirect()->back()->with('success', 'Job Description berhasil dihapus.');
    }

    public function kpiItemsStore(Request $request)
    {
        $request->validate([
            'teacher_kpi_jobdesc_id' => 'required|exists:teacher_kpi_jobdescs,id',
            'name' => 'required|string|max:255',
            'weight' => 'required|integer|min:1|max:100',
        ]);

        \App\Models\TeacherKpiItem::create($request->all());

        return redirect()->back()->with('success', 'Item KPI Point berhasil ditambahkan.');
    }

    public function kpiItemsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|integer|min:1|max:100',
        ]);

        $item = \App\Models\TeacherKpiItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->back()->with('success', 'Item KPI Point berhasil diperbarui.');
    }

    public function kpiItemsDestroy($id)
    {
        $item = \App\Models\TeacherKpiItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item KPI Point berhasil dihapus.');
    }

    public function kpiSettings(Request $request, $teacher_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $teacher = \App\Models\User::where('role', 'pengajar')->findOrFail($teacher_id);
        $periods = \App\Models\TeacherKpiPeriod::orderBy('start_date', 'desc')->get();
        $jobdescs = \App\Models\TeacherKpiJobdesc::with('items')->orderBy('name', 'asc')->get();

        $assignedPeriodIds = \App\Models\TeacherKpiAssignment::where('user_id', $teacher_id)
            ->pluck('teacher_kpi_period_id')
            ->unique()
            ->toArray();

        // Get currently assigned item IDs
        $assignedItemIds = \App\Models\TeacherKpiAssignment::where('user_id', $teacher_id)
            ->pluck('teacher_kpi_item_id')
            ->unique()
            ->toArray();

        // Map which parent Jobdesc IDs are currently assigned
        $assignedJobdescIds = \App\Models\TeacherKpiItem::whereIn('id', $assignedItemIds)
            ->pluck('teacher_kpi_jobdesc_id')
            ->unique()
            ->toArray();

        // Load all assignments with off_days, keyed by [period_id][item_id]
        $assignmentsRaw = \App\Models\TeacherKpiAssignment::where('user_id', $teacher_id)->get();
        $assignmentOffDays = []; // [period_id][item_id] => [off_days array]
        foreach ($assignmentsRaw as $asg) {
            $assignmentOffDays[$asg->teacher_kpi_period_id][$asg->teacher_kpi_item_id] = is_array($asg->off_days) ? $asg->off_days : [];
        }

        return view('super-admin.kpi.settings', compact('user', 'teacher', 'periods', 'jobdescs', 'assignedPeriodIds', 'assignedJobdescIds', 'assignmentOffDays'));
    }

    public function kpiSettingsSave(Request $request, $teacher_id)
    {
        $request->validate([
            'teacher_kpi_period_ids' => 'required|array',
            'teacher_kpi_period_ids.*' => 'exists:teacher_kpi_periods,id',
            'assigned_jobdesc_id' => 'required|exists:teacher_kpi_jobdescs,id',
        ]);

        $periodIds = $request->input('teacher_kpi_period_ids', []);
        $jobdescId = $request->assigned_jobdesc_id;
        // off_days[period_id][item_id] = ['2025-06-01', '2025-06-02', ...]
        $offDaysInput = $request->input('off_days', []);

        // Get all KPI items that belong to the selected jobdesc ID
        $assignedItemIds = \App\Models\TeacherKpiItem::where('teacher_kpi_jobdesc_id', $jobdescId)
            ->pluck('id')
            ->toArray();

        // Rebuild assignments for this teacher
        \App\Models\TeacherKpiAssignment::where('user_id', $teacher_id)->delete();

        foreach ($periodIds as $periodId) {
            foreach ($assignedItemIds as $itemId) {
                $offDays = $offDaysInput[$periodId][$itemId] ?? [];
                // Ensure it's an array of date strings
                if (!is_array($offDays)) {
                    $offDays = [];
                }
                \App\Models\TeacherKpiAssignment::create([
                    'user_id' => $teacher_id,
                    'teacher_kpi_period_id' => $periodId,
                    'teacher_kpi_item_id' => $itemId,
                    'off_days' => $offDays,
                ]);
            }
        }

        return redirect()->route('super-admin.kpi.index')->with('success', 'Pengaturan Periode & Jobdesc pengajar berhasil disimpan.');
    }

    public function kpiLogsSave(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'checks' => 'nullable|array',
        ]);

        $date = $request->date;
        $teacherId = $request->teacher_id;
        $checks = $request->input('checks', []); // [item_id => is_checked]

        foreach ($checks as $itemId => $isChecked) {
            \App\Models\TeacherKpiLog::updateOrCreate(
                [
                    'user_id' => $teacherId,
                    'teacher_kpi_item_id' => $itemId,
                    'date' => $date
                ],
                [
                    'is_checked' => (bool)$isChecked
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Laporan harian KPI berhasil disimpan.'
        ]);
    }

    public function kpiReport($teacher_id, $period_id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super_admin') {
            return redirect('/login');
        }

        $teacher = \App\Models\User::where('role', 'pengajar')->findOrFail($teacher_id);
        $period = \App\Models\TeacherKpiPeriod::findOrFail($period_id);

        // Fetch assignments for this teacher in this period (with off_days per item)
        $assignments = \App\Models\TeacherKpiAssignment::where('user_id', $teacher_id)
            ->where('teacher_kpi_period_id', $period_id)
            ->get()
            ->keyBy('teacher_kpi_item_id'); // keyed by item_id

        $assignedItemIds = $assignments->keys()->toArray();

        $items = \App\Models\TeacherKpiItem::whereIn('id', $assignedItemIds)
            ->with(['logs' => function($query) use ($teacher_id) {
                $query->where('user_id', $teacher_id);
            }])
            ->get();

        // Calculate total days in period
        $start = \Carbon\Carbon::parse($period->start_date);
        $end = \Carbon\Carbon::parse($period->end_date);
        $totalDays = $start->diffInDays($end) + 1;

        $reportData = [];
        $totalWeightedScore = 0;
        $totalWeight = 0;

        foreach ($items as $item) {
            // Get off_days specific to this item's assignment
            $assignment = $assignments->get($item->id);
            $itemOffDays = ($assignment && is_array($assignment->off_days)) ? $assignment->off_days : [];

            // Effective days = total days minus this item's off days
            $itemEffectiveDays = $totalDays - count($itemOffDays);
            if ($itemEffectiveDays <= 0) {
                $itemEffectiveDays = 1;
            }

            // Count checked days (only those not in off_days)
            $checkedDays = $item->logs
                ->where('is_checked', true)
                ->filter(fn($log) => !in_array($log->date, $itemOffDays))
                ->count();

            // Percentage of completion, capped at 100%
            $percentage = ($checkedDays / $itemEffectiveDays) * 100;
            $percentage = min(100, $percentage);

            // Weighted score
            $weightedScore = ($percentage * $item->weight) / 100;

            $reportData[] = [
                'item'           => $item,
                'checked_days'   => $checkedDays,
                'effective_days' => $itemEffectiveDays,
                'off_days_count' => count($itemOffDays),
                'percentage'     => round($percentage, 2),
                'weighted_score' => round($weightedScore, 2),
            ];

            $totalWeightedScore += $weightedScore;
            $totalWeight += $item->weight;
        }

        // Calculate weekly summaries based on calendar weeks (Mon–Sun)
        $weeks = [];
        $currentDate = $start->copy();
        $weekNumber = 1;

        while ($currentDate->lte($end)) {
            $endOfWeek = $currentDate->copy()->endOfWeek(); // Sunday
            if ($endOfWeek->gt($end)) {
                $endOfWeek = $end->copy();
            }

            // Dates in this week
            $weekDates = [];
            $tempDate = $currentDate->copy();
            while ($tempDate->lte($endOfWeek)) {
                $weekDates[] = $tempDate->format('Y-m-d');
                $tempDate->addDay();
            }

            // Per-item weekly score (each item has its own off_days)
            $weekTotalWeightedScore = 0;

            foreach ($items as $item) {
                $assignment = $assignments->get($item->id);
                $itemOffDays = ($assignment && is_array($assignment->off_days)) ? $assignment->off_days : [];

                $weekActiveDates = array_diff($weekDates, $itemOffDays);
                $weekEffectiveDays = count($weekActiveDates);

                if ($weekEffectiveDays <= 0) continue;

                $checkedInWeek = $item->logs
                    ->where('is_checked', true)
                    ->whereIn('date', array_values($weekActiveDates))
                    ->count();

                $itemWeekPercentage = min(100, ($checkedInWeek / $weekEffectiveDays) * 100);
                $weekTotalWeightedScore += ($itemWeekPercentage * $item->weight) / 100;
            }

            $weeks[] = [
                'week_number'    => $weekNumber,
                'start_date'     => $currentDate->format('d M Y'),
                'end_date'       => $endOfWeek->format('d M Y'),
                'score'          => round($weekTotalWeightedScore, 2),
            ];

            $weekNumber++;
            $currentDate = $endOfWeek->copy()->addDay();
        }

        return response()->json([
            'success'              => true,
            'teacher'              => $teacher,
            'period'               => $period,
            'total_days'           => $totalDays,
            'report_data'          => $reportData,
            'total_weighted_score' => round($totalWeightedScore, 2),
            'total_weight'         => $totalWeight,
            'weeks'                => $weeks,
        ]);
    }
}
