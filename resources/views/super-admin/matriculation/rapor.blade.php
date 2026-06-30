<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Matrikulasi - SIAPIT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        /* Neumorphic Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(240, 244, 248, 0.7);
            backdrop-filter: blur(8px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }
        .modal-card {
            background: var(--bg-primary);
            box-shadow: 20px 20px 60px #d1d9e6, -20px -20px 60px #ffffff;
            border-radius: 20px;
            width: 95%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2.5rem;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            position: relative;
        }
        .modal-overlay.show .modal-card {
            transform: scale(1);
        }
        .rapor-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px dashed #d1d9e6;
            padding-bottom: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .rapor-title {
            font-family: var(--font-heading);
            font-weight: 800;
            color: var(--text-primary);
            font-size: 1.4rem;
            margin-bottom: 0.25rem;
        }
        .rapor-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
            background: rgba(243, 244, 246, 0.4);
            padding: 1rem;
            border-radius: 12px;
            box-shadow: var(--nm-inset-sm);
        }
        .rapor-meta-item {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 600;
        }
        .rapor-meta-item strong {
            color: var(--text-primary);
        }
        .table-rapor {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        .table-rapor th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            color: var(--text-secondary);
            border-bottom: 2px solid #d1d9e6;
            font-weight: 800;
        }
        .table-rapor td {
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            color: var(--text-primary);
            border-bottom: 1px solid #e2e8f0;
            font-weight: 700;
        }
        .close-modal-btn {
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: var(--transition);
        }
        .close-modal-btn:hover {
            box-shadow: var(--nm-flat-hover);
            color: var(--accent-red);
        }
        
        /* Print Pagination Styles */
        .print-page {
            border-bottom: 2px dashed #cbd5e1;
            padding-bottom: 2.5rem;
            margin-bottom: 2.5rem;
        }
        .print-page:last-of-type {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }
        
        @media print {
            body * {
                visibility: hidden;
            }
            #rapor-modal, #rapor-modal *, .modal-card, .modal-card * {
                visibility: visible !important;
            }
            #rapor-modal {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                height: auto !important;
                overflow: visible !important;
                background: none !important;
                backdrop-filter: none !important;
                display: block !important;
            }
            .modal-card {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                box-shadow: none !important;
                background: white !important;
                padding: 0 !important;
                max-height: none !important;
                overflow: visible !important;
            }
            .close-modal-btn, .modal-footer-btns {
                display: none !important;
            }
            .print-page {
                page-break-after: always !important;
                break-after: page !important;
                border-bottom: none !important;
                padding-bottom: 0 !important;
                margin-bottom: 0 !important;
                height: auto !important;
                display: block !important;
            }
            .print-page:last-of-type {
                page-break-after: avoid !important;
                break-after: avoid !important;
            }
        }
    </style>
    <script>
        function updateDecisionColor(select) {
            const val = select.value;
            if (val === 'passed') {
                select.style.background = 'rgba(16, 185, 129, 0.15)';
                select.style.color = '#10b981';
            } else if (val === 'failed') {
                select.style.background = 'rgba(239, 68, 68, 0.15)';
                select.style.color = '#ef4444';
            } else if (val === 'resigned') {
                select.style.background = 'rgba(245, 158, 11, 0.15)';
                select.style.color = '#d97706';
            } else if (val === 'active') {
                select.style.background = 'rgba(59, 130, 246, 0.15)';
                select.style.color = '#2563eb';
            } else {
                select.style.background = 'var(--bg-primary)';
                select.style.color = 'var(--text-primary)';
            }
        }
    </script>
</head>
<body>

    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-top">
                <div class="sidebar-brand">
                    <img src="/Logo-Pondok-it.png" alt="Logo Pondok IT" class="brand-logo">
                    <span>SIAPIT</span>
                </div>
                
                <ul class="sidebar-menu">
                    <li class="{{ Request::routeIs('super-admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.dashboard') }}">
                            <i class="fa-solid fa-chart-line"></i> Dashboard
                        </a>
                    </li>
                    <li class="has-submenu {{ Request::routeIs('super-admin.pendaftaran.*') ? 'open' : '' }}">
                        <div class="submenu-trigger">
                            <i class="fa-solid fa-user-plus"></i> Pendaftaran
                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </div>
                        <ul class="submenu">
                            <li class="{{ Request::routeIs('super-admin.pendaftaran.administrasi') ? 'active' : '' }}"><a href="{{ route('super-admin.pendaftaran.administrasi') }}"><i class="fa-solid fa-file-invoice"></i> Tahap Administrasi</a></li>
                            <li class="{{ Request::routeIs('super-admin.pendaftaran.wawancara') ? 'active' : '' }}"><a href="{{ route('super-admin.pendaftaran.wawancara') }}"><i class="fa-solid fa-comments"></i> Tahap Wawancara</a></li>
                            <li class="{{ Request::routeIs('super-admin.pendaftaran.penerimaan') ? 'active' : '' }}"><a href="{{ route('super-admin.pendaftaran.penerimaan') }}"><i class="fa-solid fa-user-check"></i> Tahap Penerimaan</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::routeIs('super-admin.matriculation.*') ? 'open' : '' }}">
                        <div class="submenu-trigger">
                            <i class="fa-solid fa-graduation-cap"></i> Matrikulasi
                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </div>
                        <ul class="submenu">
                            <li class="{{ Request::routeIs('super-admin.matriculation.settings') ? 'active' : '' }}"><a href="{{ route('super-admin.matriculation.settings') }}"><i class="fa-solid fa-sliders"></i> Pengaturan Periode</a></li>
                            <li class="{{ Request::routeIs('super-admin.matriculation.classrooms') ? 'active' : '' }}"><a href="{{ route('super-admin.matriculation.classrooms') }}"><i class="fa-solid fa-school"></i> Kelas & Peserta</a></li>
                            <li class="{{ Request::routeIs('super-admin.matriculation.daily-control') ? 'active' : '' }}"><a href="{{ route('super-admin.matriculation.daily-control') }}"><i class="fa-solid fa-calendar-day"></i> Kontrol Harian</a></li>
                            <li class="{{ Request::routeIs('super-admin.matriculation.rapor') ? 'active' : '' }}"><a href="{{ route('super-admin.matriculation.rapor') }}"><i class="fa-solid fa-file-invoice"></i> Rapor</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::routeIs('super-admin.education.*') ? 'open' : '' }}">
                        <div class="submenu-trigger">
                            <i class="fa-solid fa-book-open"></i> Masa Pendidikan
                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </div>
                        <ul class="submenu">
                            <li class="{{ Request::routeIs('super-admin.education.settings') ? 'active' : '' }}"><a href="{{ route('super-admin.education.settings') }}"><i class="fa-solid fa-sliders"></i> Pengaturan Periode</a></li>
                            <li class="{{ Request::routeIs('super-admin.education.classrooms') ? 'active' : '' }}"><a href="{{ route('super-admin.education.classrooms') }}"><i class="fa-solid fa-school"></i> Kelas & Peserta</a></li>
                            <li class="{{ Request::routeIs('super-admin.education.daily-control') ? 'active' : '' }}"><a href="{{ route('super-admin.education.daily-control') }}"><i class="fa-solid fa-calendar-day"></i> Kontrol Harian</a></li>
                            <li class="{{ Request::routeIs('super-admin.education.rapor') ? 'active' : '' }}"><a href="{{ route('super-admin.education.rapor') }}"><i class="fa-solid fa-file-invoice"></i> Rapor</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::routeIs('super-admin.career.*') ? 'open' : '' }}">
                        <div class="submenu-trigger">
                            <i class="fa-solid fa-briefcase"></i> Masa Berkarya
                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </div>
                        <ul class="submenu">
                            <li class="{{ Request::routeIs('super-admin.career.targets') ? 'active' : '' }}"><a href="{{ route('super-admin.career.targets') }}"><i class="fa-solid fa-bullseye"></i> Target Karya</a></li>
                            <li class="{{ Request::routeIs('super-admin.career.settings') ? 'active' : '' }}"><a href="{{ route('super-admin.career.settings') }}"><i class="fa-solid fa-sliders"></i> Pengaturan Periode</a></li>
                            <li class="{{ Request::routeIs('super-admin.career.placements') ? 'active' : '' }}"><a href="{{ route('super-admin.career.placements') }}"><i class="fa-solid fa-building"></i> Penempatan Divisi</a></li>
                            <li class="{{ Request::routeIs('super-admin.career.reports') ? 'active' : '' }}"><a href="{{ route('super-admin.career.reports') }}"><i class="fa-solid fa-medal"></i> Rapor Karya</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::routeIs('super-admin.billing.*') ? 'open' : '' }}">
                        <div class="submenu-trigger">
                            <i class="fa-solid fa-file-invoice-dollar"></i> Tagihan
                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </div>
                        <ul class="submenu">
                            <li class="{{ Request::routeIs('super-admin.billing.overview') ? 'active' : '' }}"><a href="{{ route('super-admin.billing.overview') }}"><i class="fa-solid fa-chart-pie"></i> Overview</a></li>
                            <li class="{{ Request::routeIs('super-admin.billing.categories') || Request::routeIs('super-admin.billing.categories.details') ? 'active' : '' }}"><a href="{{ route('super-admin.billing.categories') }}"><i class="fa-solid fa-list"></i> List Tagihan</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::routeIs('super-admin.kpi.*') ? 'open' : '' }}">
                        <div class="submenu-trigger">
                            <i class="fa-solid fa-gauge-high"></i> KPI Pengajar
                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </div>
                        <ul class="submenu">
                            <li class="{{ Request::routeIs('super-admin.kpi.periods.index') ? 'active' : '' }}"><a href="{{ route('super-admin.kpi.periods.index') }}"><i class="fa-solid fa-calendar-days"></i> Manajemen Periode</a></li>
                            <li class="{{ Request::routeIs('super-admin.kpi.items.index') ? 'active' : '' }}"><a href="{{ route('super-admin.kpi.items.index') }}"><i class="fa-solid fa-list-check"></i> Manajemen Jobdesc</a></li>
                            <li class="{{ Request::routeIs('super-admin.kpi.index') ? 'active' : '' }}"><a href="{{ route('super-admin.kpi.index') }}"><i class="fa-solid fa-users"></i> List Pengajar</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::routeIs('super-admin.program-pendidikan') || Request::routeIs('super-admin.jurusan') || Request::routeIs('super-admin.settings.*') || Request::routeIs('super-admin.settings') ? 'open' : '' }}">
                        <div class="submenu-trigger">
                            <i class="fa-solid fa-sliders"></i> Pengaturan
                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </div>
                        <ul class="submenu">
                            <li class="{{ Request::routeIs('super-admin.program-pendidikan') ? 'active' : '' }}"><a href="{{ route('super-admin.program-pendidikan') }}"><i class="fa-solid fa-graduation-cap"></i> Program Pendidikan</a></li>
                            <li class="{{ Request::routeIs('super-admin.jurusan') ? 'active' : '' }}"><a href="{{ route('super-admin.jurusan') }}"><i class="fa-solid fa-layer-group"></i> Jurusan</a></li>
                            <li class="{{ Request::routeIs('super-admin.settings.academic-years-batches') ? 'active' : '' }}"><a href="{{ route('super-admin.settings.academic-years-batches') }}"><i class="fa-solid fa-calendar-days"></i> Tahun Ajaran & Batch</a></li>
                            <li class="{{ Request::routeIs('super-admin.settings.classrooms') ? 'active' : '' }}"><a href="{{ route('super-admin.settings.classrooms') }}"><i class="fa-solid fa-school"></i> Manajemen Kelas</a></li>
                            <li class="{{ Request::routeIs('super-admin.settings.teachers') ? 'active' : '' }}"><a href="{{ route('super-admin.settings.teachers') }}"><i class="fa-solid fa-chalkboard-user"></i> Manajemen Akun Pengajar</a></li>
                            <li class="{{ Request::routeIs('super-admin.settings.students') ? 'active' : '' }}"><a href="{{ route('super-admin.settings.students') }}"><i class="fa-solid fa-users-gear"></i> Manajemen Akun Santri</a></li>
                            <li class="{{ Request::routeIs('super-admin.settings') ? 'active' : '' }}"><a href="{{ route('super-admin.settings') }}"><i class="fa-solid fa-gear"></i> Pengaturan Umum</a></li>
                        </ul>
                    </li>
                </ul></div>
            
            <div class="sidebar-footer">
                <div class="user-profile-sm">
                    <div class="avatar-sm">SA</div>
                    <div class="user-meta-sm">
                        <h4>{{ $user->name }}</h4>
                        <p>{{ $user->role }}</p>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Mobile Topbar -->
            <header class="mobile-topbar">
                <div class="mobile-brand">
                    <img src="/Logo-Pondok-it.png" alt="Logo Pondok IT" class="brand-logo">
                    <span>SIAPIT</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout-icon" title="Keluar">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </header>

            <header class="main-header">
                <div class="welcome-section">
                    <h1>Rapor Hasil Matrikulasi</h1>
                    <p>Pantau rekapitulasi penilaian per kelas dan tentukan hasil seleksi akhir santri matrikulasi.</p>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Filter Period & Class -->
            <div class="dashboard-panel" style="width: 100%; margin-bottom: 1.5rem; padding: 1.25rem 1.5rem;">
                <form method="GET" action="{{ route('super-admin.matriculation.rapor') }}" style="display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: flex-end;">
                    <div style="flex: 1; min-width: 180px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Tahun Ajaran</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="academic_year_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($academicYears as $ay)
                                    <option value="{{ $ay->id }}" {{ $selectedAcademicYearId == $ay->id ? 'selected' : '' }}>{{ $ay->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="flex: 1; min-width: 180px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Gelombang / Batch</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="batch_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($batches as $b)
                                    <option value="{{ $b->id }}" {{ $selectedBatchId == $b->id ? 'selected' : '' }}>{{ $b->name }} ({{ $b->academicYear->name }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="flex: 1.5; min-width: 200px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Pilih Kelas</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="classroom_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($classrooms as $cls)
                                    <option value="{{ $cls->id }}" {{ $selectedClassroomId == $cls->id ? 'selected' : '' }}>{{ $cls->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            @if(!$activePeriod)
                <div class="dashboard-panel" style="width: 100%; text-align: center; padding: 4rem 2rem; color: var(--text-secondary);">
                    Belum ada konfigurasi matrikulasi aktif untuk periode yang dipilih.
                </div>
            @elseif($classrooms->count() == 0)
                <div class="dashboard-panel" style="width: 100%; text-align: center; padding: 4rem 2rem; color: var(--text-secondary);">
                    Belum ada kelas yang terdaftar pada periode matrikulasi ini.
                </div>
            @else
                @php
                    $charAspects = $activePeriod->aspects->where('type', 'character');
                    $skillAspects = $activePeriod->aspects->where('type', 'skill');

                    // Generate months in period setup dynamically
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
                @endphp
                <div class="dashboard-panel" style="width: 100%;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h3 class="panel-title" style="margin: 0;"><i class="fa-solid fa-file-invoice"></i> Rekapitulasi Rapor Kelas: {{ $classrooms->where('id', $selectedClassroomId)->first()?->name }}</h3>
                        <span id="decision-save-status" style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); transition: all 0.3s ease;">
                            <i class="fa-solid fa-cloud" style="color: var(--accent-blue);"></i> Status keputusan tersimpan otomatis
                        </span>
                    </div>
                    
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Peserta</th>
                                    <th style="text-align: center; width: 180px;">Nilai Akhir (Kumulatif)</th>
                                    <th style="text-align: center; width: 180px;">Status Kelulusan</th>
                                    <th style="text-align: center; width: 220px;">Aksi Keputusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $st)
                                    @php
                                         // 1. Dynamic Monthly Calculation
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
                                                 $weightedContributionM = 0;

                                                 if ($isMonthActive) {
                                                     $hasActiveDaysM = true;
                                                     $stScores = $st->scores->where('matriculation_aspect_id', $aspect->id);
                                                     
                                                      if ($aspect->input_type === 'checklist') {
                                                          $realDays = 0; $targetDays = 0;
                                                          foreach ($monthActiveDays as $day) {
                                                              $sc = $stScores->where('evaluation_date', $day)->first();
                                                              $val = $sc ? (int)$sc->score : 0;
                                                              if ($val === 1) { $realDays++; $targetDays++; } elseif ($val === 0) { $targetDays++; }
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
                                                 }

                                                 $aspectCalculationsM[] = [
                                                     'name' => $aspect->name,
                                                     'type' => $aspect->type === 'character' ? 'Karakter' : 'Skill',
                                                     'input_type' => $aspect->input_type,
                                                     'weight' => $aspect->weight_percentage,
                                                     'score' => $isMonthActive ? (round($scoreValM, 1) . '%') : '-',
                                                     'weighted' => $isMonthActive ? (round($weightedContributionM, 1) . '%') : '-',
                                                     'detail' => $detailTextM
                                                 ];
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

                                         // 2. Cumulative Averages from Monthly Averages
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

                                         // 3. Populate Cumulative Aspects list for display (transparency)
                                         $aspectCalculations = [];
                                         foreach($activePeriod->aspects as $aspect) {
                                             $aspectActiveDays = is_string($aspect->active_days) ? json_decode($aspect->active_days, true) : ($aspect->active_days ?? []);
                                             $stScores = $st->scores->where('matriculation_aspect_id', $aspect->id);
                                             $isAspectActive = !empty($aspectActiveDays);
                                             
                                             $scoreVal = 0; $detailText = 'Materi belum dijadwalkan';
                                             $weightedContribution = 0;

                                             if ($isAspectActive) {
                                                  if ($aspect->input_type === 'checklist') {
                                                      $realDays = 0; $targetDays = 0;
                                                      foreach ($aspectActiveDays as $day) {
                                                          $sc = $stScores->where('evaluation_date', $day)->first();
                                                          $val = $sc ? (int)$sc->score : 0;
                                                          if ($val === 1) { $realDays++; $targetDays++; } elseif ($val === 0) { $targetDays++; }
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

                                        // Package JSON payload for modal
                                        $raporPayload = [
                                            'student_name' => $st->registration->name,
                                            'student_photo' => $st->registration->photo ? asset('storage/' . $st->registration->photo) : null,
                                            'major_name' => $st->registration->major->name,
                                            'classroom_name' => $st->classroom->name ?? '-',
                                            'academic_year' => $st->classroom->academicYear->name ?? '-',
                                            'batch' => $st->classroom->batch->name ?? '-',
                                            'char_avg' => round($normalizedChar, 2),
                                            'skill_avg' => round($normalizedSkill, 2),
                                            'final_score' => round($finalScore, 2),
                                            'status' => $st->status,
                                            'aspects' => $aspectCalculations,
                                            'monthly_reports' => $monthlyReportsPayload
                                        ];
                                    @endphp
                                    <tr>
                                        <td>
                                            <div style="font-weight: 700; color: var(--text-primary);">{{ $st->registration->name }}</div>
                                            <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 600;">{{ $st->registration->major->name }}</span>
                                        </td>
                                        
                                        <td style="text-align: center;">
                                            <span style="font-weight: 900; font-size: 1.1rem; color: {{ $finalScore >= 75 ? '#10b981' : '#f59e0b' }};">
                                                {{ number_format($finalScore, 2) }}
                                            </span>
                                        </td>
                                        
                                        <td style="text-align: center;" id="status-badge-{{ $st->id }}">
                                            @if($st->status === 'passed')
                                                <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;"><i class="fa-solid fa-circle-check"></i> Lulus</span>
                                            @elseif($st->status === 'failed')
                                                <span style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;"><i class="fa-solid fa-circle-xmark"></i> Gugur</span>
                                            @elseif($st->status === 'resigned')
                                                <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;"><i class="fa-solid fa-person-walking-arrow-right"></i> Mundur</span>
                                            @else
                                                <span style="background: #e0f2fe; color: #075985; padding: 0.25rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;"><i class="fa-solid fa-clock"></i> Aktif</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                                <button type="button" class="btn-view-rapor" data-rapor="{{ json_encode($raporPayload) }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); padding: 0 0.75rem; height: 32px; border-radius: 8px; font-weight: 800; font-size: 0.75rem; color: var(--accent-blue); cursor: pointer; display: inline-flex; align-items: center; gap: 0.25rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                                    <i class="fa-solid fa-file-invoice"></i> Rapor
                                                </button>
                                                
                                                <div style="height: 20px; width: 1px; background: #d1d9e6; margin: 0 0.25rem;"></div>
                                                
                                                <div class="input-wrapper" style="height: 32px; width: 130px; display: inline-flex; align-items: center; border-radius: 8px; box-shadow: var(--nm-inset-sm); background: var(--bg-primary);">
                                                    @php
                                                        $selectBg = 'rgba(59, 130, 246, 0.15)';
                                                        $selectColor = '#2563eb';
                                                        if ($st->status === 'passed') { $selectBg = 'rgba(16, 185, 129, 0.15)'; $selectColor = '#10b981'; }
                                                        elseif ($st->status === 'failed') { $selectBg = 'rgba(239, 68, 68, 0.15)'; $selectColor = '#ef4444'; }
                                                        elseif ($st->status === 'resigned') { $selectBg = 'rgba(245, 158, 11, 0.15)'; $selectColor = '#d97706'; }
                                                    @endphp
                                                    <select name="decision_status" data-student-id="{{ $st->id }}" class="decision-select" style="width: 100%; border: none; background: {{ $selectBg }}; color: {{ $selectColor }}; outline: none; font-weight: 800; font-size: 0.75rem; padding: 0 0.5rem; height: 100%; cursor: {{ $st->status === 'passed' ? 'not-allowed' : 'pointer' }}; transition: all 0.3s ease; border-radius: 8px;" onchange="updateDecisionColor(this); saveDecision(this);" {{ $st->status === 'passed' ? 'disabled' : '' }}>
                                                        <option value="active" {{ $st->status === 'active' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="passed" {{ $st->status === 'passed' ? 'selected' : '' }}>Lulus</option>
                                                        <option value="failed" {{ $st->status === 'failed' ? 'selected' : '' }}>Gugur</option>
                                                        <option value="resigned" {{ $st->status === 'resigned' ? 'selected' : '' }}>Mundur</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 2.5rem; color: var(--text-secondary); font-weight: 600;">Belum ada peserta matrikulasi aktif untuk kelas ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </main>
    </div>

    <!-- Modal Pop-up Rapor Santri -->
    <div id="rapor-modal" class="modal-overlay">
        <div class="modal-card" id="modal-card-print-container">
            <!-- Dynamic printed pages will be injected here by JS -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const submenuTriggers = document.querySelectorAll('.submenu-trigger');
            submenuTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const parent = trigger.parentElement;
                    parent.classList.toggle('open');
                });
            });

            document.querySelectorAll('.btn-view-rapor').forEach(btn => {
                btn.addEventListener('click', () => {
                    const data = JSON.parse(btn.getAttribute('data-rapor'));
                    openRaporModal(data);
                });
            });
        });

        function updateDecisionColor(select) {
            const val = select.value;
            if (val === 'passed') {
                select.style.background = 'rgba(16, 185, 129, 0.15)';
                select.style.color = '#10b981';
            } else if (val === 'failed') {
                select.style.background = 'rgba(239, 68, 68, 0.15)';
                select.style.color = '#ef4444';
            } else if (val === 'resigned') {
                select.style.background = 'rgba(245, 158, 11, 0.15)';
                select.style.color = '#d97706';
            } else if (val === 'active') {
                select.style.background = 'rgba(59, 130, 246, 0.15)';
                select.style.color = '#2563eb';
            } else {
                select.style.background = 'var(--bg-primary)';
                select.style.color = 'var(--text-primary)';
            }
        }

        function saveDecision(select) {
            const studentId = select.getAttribute('data-student-id');
            const status = select.value;
            const statusSaveEl = document.getElementById('decision-save-status');

            if (statusSaveEl) {
                statusSaveEl.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="color: var(--accent-blue);"></i> Memproses keputusan...';
                statusSaveEl.style.color = 'var(--accent-blue)';
            }

            const formData = new FormData();
            formData.append('student_id', studentId);
            formData.append('status', status);

            fetch("{{ route('super-admin.matriculation.rapor.process') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (statusSaveEl) {
                        statusSaveEl.innerHTML = '<i class="fa-solid fa-cloud-arrow-up" style="color: #10b981;"></i> Keputusan berhasil disimpan';
                        statusSaveEl.style.color = '#10b981';
                        setTimeout(() => {
                            statusSaveEl.innerHTML = '<i class="fa-solid fa-cloud" style="color: var(--accent-blue);"></i> Status keputusan tersimpan otomatis';
                            statusSaveEl.style.color = 'var(--text-secondary)';
                        }, 2000);
                    }

                    const badgeContainer = document.getElementById('status-badge-' + studentId);
                    if (badgeContainer) {
                        let html = '';
                        if (status === 'passed') {
                            html = '<span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;"><i class="fa-solid fa-circle-check"></i> Lulus</span>';
                        } else if (status === 'failed') {
                            html = '<span style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;"><i class="fa-solid fa-circle-xmark"></i> Gugur</span>';
                        } else if (status === 'resigned') {
                            html = '<span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;"><i class="fa-solid fa-person-walking-arrow-right"></i> Mundur</span>';
                        } else {
                            html = '<span style="background: #e0f2fe; color: #075985; padding: 0.25rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;"><i class="fa-solid fa-clock"></i> Aktif</span>';
                        }
                        badgeContainer.innerHTML = html;
                    }
                } else {
                    if (statusSaveEl) {
                        statusSaveEl.innerHTML = '<i class="fa-solid fa-circle-exclamation" style="color: #dc2626;"></i> Gagal memproses keputusan';
                        statusSaveEl.style.color = '#dc2626';
                    }
                }
            })
            .catch(error => {
                console.error('Error saving decision status:', error);
                if (statusSaveEl) {
                    statusSaveEl.innerHTML = '<i class="fa-solid fa-circle-exclamation" style="color: #dc2626;"></i> Gagal memproses keputusan';
                    statusSaveEl.style.color = '#dc2626';
                }
            });
        }

        function openRaporModal(data) {
            const container = document.getElementById('modal-card-print-container');
            container.innerHTML = '';

            let pagesHtml = '';

            // 1. PAGE 1: COVER & FINAL CUMULATIVE SUMMARY (KESIMPULAN AKHIR)
            let statusText = 'Aktif';
            let statusColor = '#075985';
            let statusBadgeClass = 'rgba(59,130,246,0.1)';
            if (data.status === 'passed') { statusText = 'LULUS UTAMA'; statusColor = '#065f46'; statusBadgeClass = '#d1fae5'; }
            else if (data.status === 'failed') { statusText = 'GUGUR / TIDAK LULUS'; statusColor = '#991b1b'; statusBadgeClass = '#fee2e2'; }
            else if (data.status === 'resigned') { statusText = 'MUNDUR'; statusColor = '#92400e'; statusBadgeClass = '#fef3c7'; }

            let monthlySummaryRows = '';
            data.monthly_reports.forEach(m => {
                monthlySummaryRows += `
                    <tr>
                        <td><strong style="color: var(--text-primary); font-size: 0.9rem;">${m.label}</strong></td>
                        <td style="text-align: center; font-weight: 800; font-size: 0.9rem;">${m.char_avg.toFixed(1)}%</td>
                        <td style="text-align: center; font-weight: 800; font-size: 0.9rem;">${m.skill_avg.toFixed(1)}%</td>
                        <td style="text-align: center;">
                            <span style="font-weight: 900; font-size: 1.05rem; color: ${m.final_score !== '-' && m.final_score >= 75 ? '#10b981' : '#f59e0b'};">
                                ${m.final_score}
                            </span>
                        </td>
                    </tr>
                `;
            });

            pagesHtml += `
                <div class="print-page">
                    <div class="rapor-header">
                        <div>
                            <h2 class="rapor-title" style="font-size: 1.6rem; letter-spacing: -0.5px;">RAPOR HASIL SELEKSI MATRIKULASI</h2>
                            <p style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 700; text-transform: uppercase;">Pondok IT Yogyakarta</p>
                        </div>
                        <button type="button" class="close-modal-btn" onclick="closeRaporModal()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="rapor-grid" style="display: grid; grid-template-columns: 80px 1fr 1fr; gap: 1.25rem; background: rgba(243, 244, 246, 0.6); padding: 1.25rem; align-items: center; border-radius: 12px;">
                        <!-- Student Photo -->
                        <div style="width: 80px; height: 105px; border-radius: 6px; overflow: hidden; background: #e0e5ec; box-shadow: var(--nm-inset-sm); display: flex; align-items: center; justify-content: center; border: 1.5px solid #cbd5e1;">
                            ${data.student_photo ? `<img src="${data.student_photo}" alt="Foto Santri" style="width: 100%; height: 100%; object-fit: cover;">` : `<i class="fa-solid fa-user" style="font-size: 2.2rem; color: #a3b1c6;"></i>`}
                        </div>
                        <!-- Meta Details -->
                        <div style="display: flex; flex-direction: column; gap: 0.35rem;">
                            <div class="rapor-meta-item">Nama Santri: <strong style="font-size: 0.95rem;">${data.student_name}</strong></div>
                            <div class="rapor-meta-item">Kelas: <strong>${data.classroom_name}</strong></div>
                            <div class="rapor-meta-item">Jurusan: <strong>${data.major_name}</strong></div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 0.35rem; border-left: 2px dashed #cbd5e1; padding-left: 1.25rem; height: 100%; justify-content: center;">
                            <div class="rapor-meta-item">Tahun Ajaran: <strong>${data.academic_year}</strong></div>
                            <div class="rapor-meta-item">Gelombang/Batch: <strong>${data.batch}</strong></div>
                        </div>
                    </div>

                    <h3 style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.75rem; border-bottom: 2px solid var(--accent-blue); padding-bottom: 0.4rem; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-chart-pie" style="color: var(--accent-blue);"></i> Kesimpulan Rapor Akhir</h3>
                    
                    <table class="table-rapor" style="margin-bottom: 1.75rem; box-shadow: var(--nm-inset-sm); border-radius: 12px; overflow: hidden;">
                        <thead>
                            <tr style="background: rgba(59, 130, 246, 0.05);">
                                <th>Bulan Bimbingan</th>
                                <th style="text-align: center;">Persentase Karakter</th>
                                <th style="text-align: center;">Persentase Skill</th>
                                <th style="text-align: center; width: 160px;">Nilai Gabungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${monthlySummaryRows || '<tr><td colspan="4" style="text-align:center;">Belum ada data bulanan</td></tr>'}
                        </tbody>
                    </table>

                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1.5rem; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border: 1px solid rgba(226, 232, 240, 0.8);">
                        <div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px;">Hasil Keputusan Kelulusan</span>
                            <div style="font-size: 1.4rem; font-weight: 900; color: ${statusColor}; margin-top: 0.25rem; letter-spacing: 0.5px;">${statusText}</div>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px;">Nilai Akhir Kumulatif</span>
                            <div style="font-size: 2rem; font-weight: 900; color: ${data.final_score >= 75 ? '#10b981' : '#f59e0b'}; margin-top: 0.15rem;">${data.final_score.toFixed(2)}</div>
                        </div>
                    </div>

                    <!-- Signatures Grid -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-top: 2.5rem; text-align: center; font-size: 0.8rem; font-weight: 700; color: var(--text-primary);">
                        <div>
                            <p style="margin-bottom: 4.5rem; color: var(--text-secondary);">Wali Kelas (Homeroom Teacher)</p>
                            <div style="border-bottom: 1.5px solid #cbd5e1; width: 75%; margin: 0 auto; padding-bottom: 0.25rem;"></div>
                            <p style="font-size: 0.7rem; color: var(--text-secondary); margin-top: 0.35rem;">Staf Pengajar Pondok IT</p>
                        </div>
                        <div>
                            <p style="margin-bottom: 4.5rem; color: var(--text-secondary);">Kepala Pendidikan Karakter</p>
                            <div style="border-bottom: 1.5px solid #cbd5e1; width: 75%; margin: 0 auto; padding-bottom: 0.25rem;"></div>
                            <p style="font-size: 0.7rem; color: var(--text-secondary); margin-top: 0.35rem;">Divisi Karakter Pondok IT</p>
                        </div>
                        <div>
                            <p style="margin-bottom: 4.5rem; color: var(--text-secondary);">Kepala Pendidikan Skill</p>
                            <div style="border-bottom: 1.5px solid #cbd5e1; width: 75%; margin: 0 auto; padding-bottom: 0.25rem;"></div>
                            <p style="font-size: 0.7rem; color: var(--text-secondary); margin-top: 0.35rem;">Divisi Akademik Pondok IT</p>
                        </div>
                    </div>
                </div>
            `;

            // 2. DETAILED MONTHLY PAGES (AS ANNEXES / LAMPIRAN)
            data.monthly_reports.forEach(month => {
                let charRows = '';
                let skillRows = '';

                month.aspects.forEach(asp => {
                    const rowHtml = `
                        <tr>
                            <td>
                                <div style="font-weight: 800; color: var(--text-primary);">${asp.name}</div>
                                <div style="font-size: 0.7rem; color: var(--text-secondary); font-weight: 600;">${asp.detail}</div>
                            </td>
                            <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">${asp.weight}%</td>
                            <td style="text-align: center; font-weight: 800; color: var(--text-primary);">${asp.score}</td>
                            <td style="text-align: center; font-weight: 800; color: var(--accent-blue);">${asp.weighted}</td>
                        </tr>
                    `;
                    if (asp.type === 'Karakter') {
                        charRows += rowHtml;
                    } else {
                        skillRows += rowHtml;
                    }
                });

                pagesHtml += `
                    <div class="print-page">
                        <div class="rapor-header">
                            <div>
                                <h2 class="rapor-title" style="font-size: 1.3rem;">LAMPIRAN RINCIAN DETAIL BULANAN</h2>
                                <p style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 700;">Periode Bimbingan: ${month.label} </p>
                            </div>
                            <span style="font-size: 1rem; font-weight: 900; color: var(--accent-blue); padding: 0.25rem 0.65rem; background: rgba(59,130,246,0.1); border-radius: 8px;">Skor Bulan: ${month.final_score}%</span>
                        </div>

                        <div class="rapor-grid" style="padding: 0.75rem 1rem; margin-bottom: 1.25rem;">
                            <div class="rapor-meta-item">Nama Santri: <strong>${data.student_name}</strong></div>
                            <div class="rapor-meta-item">Kelas: <strong>${data.classroom_name}</strong></div>
                        </div>

                        <!-- SECTION 1: KARAKTER -->
                        <h4 style="font-size: 0.95rem; font-weight: 800; color: var(--accent-red); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem;"><i class="fa-solid fa-heart"></i> Penilaian Karakter</h4>
                        <table class="table-rapor" style="margin-bottom: 1.5rem;">
                            <thead>
                                <tr>
                                    <th>Kriteria Aspek</th>
                                    <th style="text-align: center; width: 80px;">Bobot</th>
                                    <th style="text-align: center; width: 120px;">Pencapaian</th>
                                    <th style="text-align: center; width: 120px;">Kontribusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${charRows || '<tr><td colspan="4" style="text-align:center; color: var(--text-secondary);">Tidak ada penilaian karakter aktif</td></tr>'}
                            </tbody>
                        </table>

                        <!-- SECTION 2: SKILL -->
                        <h4 style="font-size: 0.95rem; font-weight: 800; color: var(--accent-blue); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem;"><i class="fa-solid fa-brain"></i> Penilaian Skill</h4>
                        <table class="table-rapor" style="margin-bottom: 1.5rem;">
                            <thead>
                                <tr>
                                    <th>Kriteria Aspek</th>
                                    <th style="text-align: center; width: 80px;">Bobot</th>
                                    <th style="text-align: center; width: 120px;">Pencapaian</th>
                                    <th style="text-align: center; width: 120px;">Kontribusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${skillRows || '<tr><td colspan="4" style="text-align:center; color: var(--text-secondary);">Tidak ada penilaian skill aktif</td></tr>'}
                            </tbody>
                        </table>
                        
                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1rem; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                            <div>
                                <div style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary);">Persentase Karakter: <strong>${month.char_avg.toFixed(1)}%</strong></div>
                                <div style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); margin-top: 0.25rem;">Persentase Skill: <strong>${month.skill_avg.toFixed(1)}%</strong></div>
                            </div>
                            <div style="text-align: right;">
                                <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary);">Rata-rata Gabungan Bulan ini</span>
                                <div style="font-size: 1.4rem; font-weight: 900; color: var(--accent-blue);">${month.final_score}%</div>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Add action buttons to the end of the final page
            pagesHtml += `
                <div class="modal-footer-btns" style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                    <button type="button" onclick="window.print()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-primary); font-weight: 800; font-size: 0.8rem; height: 38px; padding: 0 1.25rem; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                        <i class="fa-solid fa-print"></i> Cetak Rapor Lengkap
                    </button>
                    <button type="button" onclick="closeRaporModal()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-red); font-weight: 800; font-size: 0.8rem; height: 38px; padding: 0 1.25rem; border-radius: 8px; cursor: pointer;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                        Tutup
                    </button>
                </div>
            `;

            container.innerHTML = pagesHtml;

            const modal = document.getElementById('rapor-modal');
            modal.classList.add('show');
        }

        function closeRaporModal() {
            const modal = document.getElementById('rapor-modal');
            modal.classList.remove('show');
        }
    </script>
</body>
</html>
