<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationProgramController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/santri-ambassador', [\App\Http\Controllers\SantriAmbassadorController::class, 'index'])->name('santri-ambassador');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register/initiate-payment', [RegisterController::class, 'initiatePayment']);
Route::post('/register/check-payment', [RegisterController::class, 'checkPayment']);
Route::post('/register/complete', [RegisterController::class, 'completeRegistration']);
Route::get('/api/program/{id}/jurusan', [RegisterController::class, 'getMajorsByProgram']);
Route::get('/api/academic-year/{id}/batches', [RegisterController::class, 'getBatchesByAcademicYear']);
Route::post('/payment/callback', [RegisterController::class, 'handlePaymentCallback']);

// Protected Dashboard Routes
Route::middleware(['auth'])->group(function () {
    
    // Super Admin Prefix
    Route::prefix('super-admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'superAdminDashboard'])->name('super-admin.dashboard');
        
        // Pendaftaran Management Routes
        Route::get('/pendaftaran/administrasi', [DashboardController::class, 'administrasiIndex'])->name('super-admin.pendaftaran.administrasi');
        Route::get('/pendaftaran/wawancara', [DashboardController::class, 'wawancaraIndex'])->name('super-admin.pendaftaran.wawancara');
        Route::get('/pendaftaran/penerimaan', [DashboardController::class, 'penerimaanIndex'])->name('super-admin.pendaftaran.penerimaan');
        Route::post('/pendaftaran/{id}/update-status', [DashboardController::class, 'updateStatus'])->name('super-admin.pendaftaran.update-status');
        
        // Program Pendidikan CRUD Routes
        Route::get('/program-pendidikan', [EducationProgramController::class, 'index'])->name('super-admin.program-pendidikan');
        Route::post('/program-pendidikan', [EducationProgramController::class, 'store'])->name('super-admin.program-pendidikan.store');
        Route::put('/program-pendidikan/{id}', [EducationProgramController::class, 'update'])->name('super-admin.program-pendidikan.update');
        Route::delete('/program-pendidikan/{id}', [EducationProgramController::class, 'destroy'])->name('super-admin.program-pendidikan.destroy');

        // Jurusan CRUD Routes
        Route::get('/jurusan', [\App\Http\Controllers\MajorController::class, 'index'])->name('super-admin.jurusan');
        Route::post('/jurusan', [\App\Http\Controllers\MajorController::class, 'store'])->name('super-admin.jurusan.store');
        Route::put('/jurusan/{id}', [\App\Http\Controllers\MajorController::class, 'update'])->name('super-admin.jurusan.update');
        Route::delete('/jurusan/{id}', [\App\Http\Controllers\MajorController::class, 'destroy'])->name('super-admin.jurusan.destroy');

        // Academic Years & Batches CRUD Routes
        Route::get('/settings/academic-years-batches', [DashboardController::class, 'academicYearsBatchesIndex'])->name('super-admin.settings.academic-years-batches');
        Route::post('/settings/academic-years', [DashboardController::class, 'academicYearStore'])->name('super-admin.settings.academic-years.store');
        Route::put('/settings/academic-years/{id}', [DashboardController::class, 'academicYearUpdate'])->name('super-admin.settings.academic-years.update');
        Route::delete('/settings/academic-years/{id}', [DashboardController::class, 'academicYearDestroy'])->name('super-admin.settings.academic-years.destroy');

        Route::post('/settings/batches', [DashboardController::class, 'batchStore'])->name('super-admin.settings.batches.store');
        Route::put('/settings/batches/{id}', [DashboardController::class, 'batchUpdate'])->name('super-admin.settings.batches.update');
        Route::delete('/settings/batches/{id}', [DashboardController::class, 'batchDestroy'])->name('super-admin.settings.batches.destroy');

        // Classroom CRUD Routes
        Route::get('/settings/classrooms', [DashboardController::class, 'classroomsIndex'])->name('super-admin.settings.classrooms');
        Route::post('/settings/classrooms', [DashboardController::class, 'classroomStore'])->name('super-admin.settings.classrooms.store');
        Route::put('/settings/classrooms/{id}', [DashboardController::class, 'classroomUpdate'])->name('super-admin.settings.classrooms.update');
        Route::delete('/settings/classrooms/{id}', [DashboardController::class, 'classroomDestroy'])->name('super-admin.settings.classrooms.destroy');

        // Teacher CRUD Routes
        Route::get('/settings/teachers', [DashboardController::class, 'teachersIndex'])->name('super-admin.settings.teachers');
        Route::post('/settings/teachers', [DashboardController::class, 'teacherStore'])->name('super-admin.settings.teachers.store');
        Route::put('/settings/teachers/{id}', [DashboardController::class, 'teacherUpdate'])->name('super-admin.settings.teachers.update');
        Route::delete('/settings/teachers/{id}', [DashboardController::class, 'teacherDestroy'])->name('super-admin.settings.teachers.destroy');

        // Santri Account CRUD Routes
        Route::get('/settings/students', [DashboardController::class, 'studentsIndex'])->name('super-admin.settings.students');
        Route::post('/settings/students/{id}/reset-password', [DashboardController::class, 'studentResetPassword'])->name('super-admin.settings.students.reset-password');

        // Settings Routes
        Route::get('/settings', [DashboardController::class, 'settingsIndex'])->name('super-admin.settings');
        Route::post('/settings', [DashboardController::class, 'settingsUpdate'])->name('super-admin.settings.update');

        // Matriculation Routes
        Route::get('/matriculation/settings', [DashboardController::class, 'matriculationSettings'])->name('super-admin.matriculation.settings');
        Route::post('/matriculation/settings', [DashboardController::class, 'matriculationSettingsStore'])->name('super-admin.matriculation.settings.store');
        
        Route::get('/matriculation/classrooms', [DashboardController::class, 'matriculationClassrooms'])->name('super-admin.matriculation.classrooms');
        Route::post('/matriculation/classrooms/{id}/assign-teachers', [DashboardController::class, 'matriculationAssignTeachers'])->name('super-admin.matriculation.classrooms.assign-teachers');
        Route::post('/matriculation/classrooms/{id}/assign-skill', [DashboardController::class, 'matriculationAssignSkill'])->name('super-admin.matriculation.classrooms.assign-skill');
        Route::post('/matriculation/classrooms/assign-students', [DashboardController::class, 'matriculationAssignStudents'])->name('super-admin.matriculation.classrooms.assign-students');
        Route::post('/matriculation/classrooms/set-leader', [DashboardController::class, 'matriculationSetLeader'])->name('super-admin.matriculation.classrooms.set-leader');
        Route::delete('/matriculation/classrooms/remove-student/{id}', [DashboardController::class, 'matriculationRemoveStudent'])->name('super-admin.matriculation.classrooms.remove-student');
        Route::put('/matriculation/students/{id}/status', [DashboardController::class, 'matriculationUpdateStudentStatus'])->name('super-admin.matriculation.students.update-status');

        Route::get('/matriculation/daily-control', [DashboardController::class, 'matriculationDailyControl'])->name('super-admin.matriculation.daily-control');
        Route::post('/matriculation/daily-control/store', [DashboardController::class, 'matriculationDailyControlStore'])->name('super-admin.matriculation.daily-control.store');

        Route::get('/matriculation/rapor', [DashboardController::class, 'matriculationRapor'])->name('super-admin.matriculation.rapor');
        Route::post('/matriculation/rapor/process', [DashboardController::class, 'matriculationRaporProcess'])->name('super-admin.matriculation.rapor.process');

        // Education (Masa Pendidikan) Routes
        Route::get('/education/settings', [DashboardController::class, 'educationSettings'])->name('super-admin.education.settings');
        Route::post('/education/settings', [DashboardController::class, 'educationSettingsStore'])->name('super-admin.education.settings.store');

        Route::get('/education/classrooms', [DashboardController::class, 'educationClassrooms'])->name('super-admin.education.classrooms');
        Route::post('/education/classrooms/{id}/assign-teachers', [DashboardController::class, 'educationAssignTeachers'])->name('super-admin.education.classrooms.assign-teachers');
        Route::post('/education/classrooms/{id}/assign-skill', [DashboardController::class, 'educationAssignSkill'])->name('super-admin.education.classrooms.assign-skill');
        Route::post('/education/classrooms/assign-students', [DashboardController::class, 'educationAssignStudents'])->name('super-admin.education.classrooms.assign-students');
        Route::post('/education/classrooms/set-leader', [DashboardController::class, 'educationSetLeader'])->name('super-admin.education.classrooms.set-leader');
        Route::delete('/education/classrooms/remove-student/{id}', [DashboardController::class, 'educationRemoveStudent'])->name('super-admin.education.classrooms.remove-student');
        Route::put('/education/students/{id}/status', [DashboardController::class, 'educationUpdateStudentStatus'])->name('super-admin.education.students.update-status');

        Route::get('/education/daily-control', [DashboardController::class, 'educationDailyControl'])->name('super-admin.education.daily-control');
        Route::post('/education/daily-control/store', [DashboardController::class, 'educationDailyControlStore'])->name('super-admin.education.daily-control.store');

        Route::get('/education/rapor', [DashboardController::class, 'educationRapor'])->name('super-admin.education.rapor');
        Route::post('/education/rapor/process', [DashboardController::class, 'educationRaporProcess'])->name('super-admin.education.rapor.process');

        // Career (Masa Berkarya) Routes
        Route::get('/career/targets', [DashboardController::class, 'careerTargets'])->name('super-admin.career.targets');
        Route::post('/career/targets', [DashboardController::class, 'careerTargetsStore'])->name('super-admin.career.targets.store');
        Route::put('/career/targets/{id}', [DashboardController::class, 'careerTargetsUpdate'])->name('super-admin.career.targets.update');
        Route::delete('/career/targets/{id}', [DashboardController::class, 'careerTargetsDestroy'])->name('super-admin.career.targets.destroy');
        Route::post('/career/target-contexts', [DashboardController::class, 'careerTargetContextsStore'])->name('super-admin.career.target-contexts.store');
        Route::put('/career/target-contexts/{id}', [DashboardController::class, 'careerTargetContextsUpdate'])->name('super-admin.career.target-contexts.update');
        Route::delete('/career/target-contexts/{id}', [DashboardController::class, 'careerTargetContextsDestroy'])->name('super-admin.career.target-contexts.destroy');
        Route::get('/career/settings', [DashboardController::class, 'careerSettings'])->name('super-admin.career.settings');
        Route::post('/career/settings', [DashboardController::class, 'careerSettingsStore'])->name('super-admin.career.settings.store');
        Route::get('/career/placements', [DashboardController::class, 'careerPlacements'])->name('super-admin.career.placements');
        Route::post('/career/placements', [DashboardController::class, 'careerPlacementsStore'])->name('super-admin.career.placements.store');
        Route::put('/career/placements/{id}', [DashboardController::class, 'careerPlacementsUpdate'])->name('super-admin.career.placements.update');
        Route::delete('/career/placements/{id}', [DashboardController::class, 'careerPlacementsDestroy'])->name('super-admin.career.placements.destroy');
        Route::post('/career/placements/assign-student', [DashboardController::class, 'careerPlacementsAssignStudent'])->name('super-admin.career.placements.assign-student');
        Route::delete('/career/placements/remove-student/{id}', [DashboardController::class, 'careerPlacementsRemoveStudent'])->name('super-admin.career.placements.remove-student');
        Route::get('/career/reports', [DashboardController::class, 'careerReports'])->name('super-admin.career.reports');
        Route::get('/career/reports/{student_id}/management', [DashboardController::class, 'careerReportsManagement'])->name('super-admin.career.reports.management');
        Route::post('/career/reports/{id}/status', [DashboardController::class, 'careerReportsUpdateStatus'])->name('super-admin.career.reports.update-status');
        Route::post('/career/reports/submissions/{submission_id}/assess', [DashboardController::class, 'careerReportsAssessSubmission'])->name('super-admin.career.reports.submissions.assess');
        Route::post('/career/reports/{student_id}/submissions/{context_id}', [DashboardController::class, 'careerReportsSubmissionsStore'])->name('super-admin.career.reports.submissions.store');
        Route::put('/career/reports/submissions/{submission_id}', [DashboardController::class, 'careerReportsSubmissionsUpdate'])->name('super-admin.career.reports.submissions.update');
        Route::delete('/career/reports/submissions/{submission_id}', [DashboardController::class, 'careerReportsSubmissionsDestroy'])->name('super-admin.career.reports.submissions.destroy');
        Route::post('/career/reports/{student_id}/incomes', [DashboardController::class, 'careerReportsIncomesStore'])->name('super-admin.career.reports.incomes.store');
        Route::put('/career/reports/incomes/{id}', [DashboardController::class, 'careerReportsIncomesUpdate'])->name('super-admin.career.reports.incomes.update');
        Route::delete('/career/reports/incomes/{id}', [DashboardController::class, 'careerReportsIncomesDestroy'])->name('super-admin.career.reports.incomes.destroy');
        Route::post('/career/reports/incomes/{id}/approve', [DashboardController::class, 'careerReportsIncomesApprove'])->name('super-admin.career.reports.incomes.approve');

        // Billing Module
        Route::get('/billing/overview', [DashboardController::class, 'billingOverview'])->name('super-admin.billing.overview');
        Route::get('/billing/categories', [DashboardController::class, 'billingCategories'])->name('super-admin.billing.categories');
        Route::post('/billing/categories', [DashboardController::class, 'billingCategoriesStore'])->name('super-admin.billing.categories.store');
        Route::put('/billing/categories/{id}', [DashboardController::class, 'billingCategoriesUpdate'])->name('super-admin.billing.categories.update');
        Route::delete('/billing/categories/{id}', [DashboardController::class, 'billingCategoriesDestroy'])->name('super-admin.billing.categories.destroy');
        Route::get('/billing/categories/{id}/details', [DashboardController::class, 'billingCategoryDetails'])->name('super-admin.billing.categories.details');
        Route::post('/billing/payments/save', [DashboardController::class, 'billingPaymentsSave'])->name('super-admin.billing.payments.save');
        Route::get('/billing/registration/{id}/details', [DashboardController::class, 'billingRegistrationDetails'])->name('super-admin.billing.registration.details');
        Route::post('/billing/payments/toggle-billed', [DashboardController::class, 'billingToggleBilled'])->name('super-admin.billing.payments.toggle-billed');

        // Teacher KPI Module
        Route::get('/kpi', [DashboardController::class, 'kpiIndex'])->name('super-admin.kpi.index');
        Route::get('/kpi/periods', [DashboardController::class, 'kpiPeriodsIndex'])->name('super-admin.kpi.periods.index');
        Route::get('/kpi/items', [DashboardController::class, 'kpiItemsIndex'])->name('super-admin.kpi.items.index');
        Route::get('/kpi/manage/{teacher_id}', [DashboardController::class, 'kpiManage'])->name('super-admin.kpi.manage');
        Route::post('/kpi/periods', [DashboardController::class, 'kpiPeriodsStore'])->name('super-admin.kpi.periods.store');
        Route::put('/kpi/periods/{id}', [DashboardController::class, 'kpiPeriodsUpdate'])->name('super-admin.kpi.periods.update');
        Route::delete('/kpi/periods/{id}', [DashboardController::class, 'kpiPeriodsDestroy'])->name('super-admin.kpi.periods.destroy');
        
        Route::post('/kpi/items', [DashboardController::class, 'kpiItemsStore'])->name('super-admin.kpi.items.store');
        Route::put('/kpi/items/{id}', [DashboardController::class, 'kpiItemsUpdate'])->name('super-admin.kpi.items.update');
        Route::delete('/kpi/items/{id}', [DashboardController::class, 'kpiItemsDestroy'])->name('super-admin.kpi.items.destroy');

        Route::post('/kpi/jobdescs', [DashboardController::class, 'kpiJobdescsStore'])->name('super-admin.kpi.jobdescs.store');
        Route::put('/kpi/jobdescs/{id}', [DashboardController::class, 'kpiJobdescsUpdate'])->name('super-admin.kpi.jobdescs.update');
        Route::delete('/kpi/jobdescs/{id}', [DashboardController::class, 'kpiJobdescsDestroy'])->name('super-admin.kpi.jobdescs.destroy');
        
        Route::post('/kpi/settings/mass-save', [DashboardController::class, 'kpiSettingsMassSave'])->name('super-admin.kpi.settings.mass-save');
        Route::get('/kpi/settings/{teacher_id}', [DashboardController::class, 'kpiSettings'])->name('super-admin.kpi.settings');
        Route::post('/kpi/settings/{teacher_id}', [DashboardController::class, 'kpiSettingsSave'])->name('super-admin.kpi.settings.save');
        Route::get('/kpi/items/offdays/{item_id}', [DashboardController::class, 'kpiItemOffDaysShow'])->name('super-admin.kpi.items.offdays.show');
        Route::post('/kpi/items/offdays/{item_id}', [DashboardController::class, 'kpiItemOffDaysSave'])->name('super-admin.kpi.items.offdays.save');
        
        Route::post('/kpi/logs/save', [DashboardController::class, 'kpiLogsSave'])->name('super-admin.kpi.logs.save');
        Route::get('/kpi/report/{teacher_id}/{period_id}', [DashboardController::class, 'kpiReport'])->name('super-admin.kpi.report');
    });

    // Santri Prefix
    Route::prefix('santri')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'santriDashboard'])->name('santri.dashboard');
        
        // Matrikulasi
        Route::get('/matriculation/daily-control', [DashboardController::class, 'santriMatriculationDailyControl'])->name('santri.matriculation.daily-control');
        Route::get('/matriculation/rapor', [DashboardController::class, 'santriMatriculationRapor'])->name('santri.matriculation.rapor');
        
        // Pendidikan
        Route::get('/education/daily-control', [DashboardController::class, 'santriEducationDailyControl'])->name('santri.education.daily-control');
        Route::get('/education/rapor', [DashboardController::class, 'santriEducationRapor'])->name('santri.education.rapor');
        
        // 2. Proyek & Target Karya
        Route::get('/proyek', [DashboardController::class, 'santriProyekIndex'])->name('santri.proyek');
        Route::post('/proyek/logbook', [DashboardController::class, 'santriLogbookStore'])->name('santri.proyek.logbook.store');
        Route::post('/proyek/portfolio', [DashboardController::class, 'santriPortfolioStore'])->name('santri.proyek.portfolio.store');
        Route::post('/proyek/income', [DashboardController::class, 'santriIncomeStore'])->name('santri.proyek.income.store');
        Route::post('/proyek/submissions/{context_id}', [DashboardController::class, 'santriSubmissionStore'])->name('santri.proyek.submission.store');
        Route::put('/proyek/submissions/{submission_id}', [DashboardController::class, 'santriSubmissionUpdate'])->name('santri.proyek.submission.update');
        Route::delete('/proyek/submissions/{submission_id}', [DashboardController::class, 'santriSubmissionDestroy'])->name('santri.proyek.submission.destroy');
        Route::put('/proyek/income/{id}', [DashboardController::class, 'santriIncomeUpdate'])->name('santri.proyek.income.update');
        Route::delete('/proyek/income/{id}', [DashboardController::class, 'santriIncomeDestroy'])->name('santri.proyek.income.destroy');
        
        // 3. Tagihan & Keuangan
        Route::get('/tagihan', [DashboardController::class, 'santriTagihanIndex'])->name('santri.tagihan');
        Route::post('/tagihan/bayar', [DashboardController::class, 'santriTagihanBayar'])->name('santri.tagihan.bayar');
    });

    // Pengajar Prefix
    Route::prefix('pengajar')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'pengajarDashboard'])->name('pengajar.dashboard');
        
        // Matrikulasi
        Route::get('/matriculation/daily-control', [DashboardController::class, 'pengajarMatriculationDailyControlList'])->name('pengajar.matriculation.daily-control.list');
        Route::get('/matriculation/daily-control/{classroomId}', [DashboardController::class, 'teacherDailyControl'])->name('pengajar.daily-control');
        Route::post('/daily-control/store', [DashboardController::class, 'teacherDailyControlStore'])->name('pengajar.daily-control.store');
        Route::get('/matriculation/rapor', [DashboardController::class, 'pengajarMatriculationRaporList'])->name('pengajar.matriculation.rapor.list');
        Route::get('/matriculation/rapor/{id}', [DashboardController::class, 'pengajarMatriculationRaporShow'])->name('pengajar.matriculation.rapor.show');
        Route::post('/matriculation/rapor/process', [DashboardController::class, 'pengajarMatriculationRaporProcess'])->name('pengajar.matriculation.rapor.process');

        // Pendidikan
        Route::get('/education/daily-control', [DashboardController::class, 'pengajarEducationDailyControlList'])->name('pengajar.education.daily-control.list');
        Route::get('/education/daily-control/{classroomId}', [DashboardController::class, 'teacherEducationDailyControl'])->name('pengajar.education.daily-control');
        Route::post('/education/daily-control/store', [DashboardController::class, 'teacherEducationDailyControlStore'])->name('pengajar.education.daily-control.store');
        Route::get('/education/rapor', [DashboardController::class, 'pengajarEducationRaporList'])->name('pengajar.education.rapor.list');
        Route::get('/education/rapor/{id}', [DashboardController::class, 'pengajarEducationRaporShow'])->name('pengajar.education.rapor.show');
        Route::post('/education/rapor/process', [DashboardController::class, 'pengajarEducationRaporProcess'])->name('pengajar.education.rapor.process');

        // Masa Berkarya (Teacher Side)
        Route::get('/career/logbook', [DashboardController::class, 'teacherCareerLogbook'])->name('pengajar.career.logbook');
        Route::post('/career/logbook/{id}/approve', [DashboardController::class, 'teacherCareerLogbookApprove'])->name('pengajar.career.logbook.approve');
        Route::post('/career/logbook/{id}/reject', [DashboardController::class, 'teacherCareerLogbookReject'])->name('pengajar.career.logbook.reject');
        Route::get('/career/penilaian', [DashboardController::class, 'teacherCareerPenilaian'])->name('pengajar.career.penilaian');
        Route::get('/career/penilaian/divisi/{placementId}', [DashboardController::class, 'teacherCareerPenilaianDivisi'])->name('pengajar.career.penilaian.divisi');
        Route::post('/career/penilaian/store', [DashboardController::class, 'teacherCareerPenilaianStore'])->name('pengajar.career.penilaian.store');
        Route::get('/career/reports/{id}/management', [DashboardController::class, 'teacherCareerReportsManagement'])->name('pengajar.career.reports.management');
        Route::post('/career/reports/{id}/update-status', [DashboardController::class, 'teacherCareerUpdateStatus'])->name('pengajar.career.reports.update-status');
        Route::post('/career/reports/submissions/{submission_id}/assess', [DashboardController::class, 'teacherCareerReportsAssessSubmission'])->name('pengajar.career.reports.submissions.assess');
        Route::post('/career/reports/{student_id}/submissions/{context_id}', [DashboardController::class, 'teacherCareerReportsSubmissionsStore'])->name('pengajar.career.reports.submissions.store');
        Route::put('/career/reports/submissions/{submission_id}', [DashboardController::class, 'teacherCareerReportsSubmissionsUpdate'])->name('pengajar.career.reports.submissions.update');
        Route::delete('/career/reports/submissions/{submission_id}', [DashboardController::class, 'teacherCareerReportsSubmissionsDestroy'])->name('pengajar.career.reports.submissions.destroy');
        Route::post('/career/reports/{student_id}/incomes', [DashboardController::class, 'teacherCareerReportsIncomesStore'])->name('pengajar.career.reports.incomes.store');
        Route::put('/career/reports/incomes/{id}', [DashboardController::class, 'teacherCareerReportsIncomesUpdate'])->name('pengajar.career.reports.incomes.update');
        Route::delete('/career/reports/incomes/{id}', [DashboardController::class, 'teacherCareerReportsIncomesDestroy'])->name('pengajar.career.reports.incomes.destroy');
        Route::post('/career/reports/incomes/{id}/approve', [DashboardController::class, 'teacherCareerReportsIncomesApprove'])->name('pengajar.career.reports.incomes.approve');

        // KPI Pengajar Mandiri (Teacher Side)
        Route::get('/kpi/checklist', [DashboardController::class, 'teacherKpiChecklist'])->name('pengajar.kpi.checklist');
    });
});
