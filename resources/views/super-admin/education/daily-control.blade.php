<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Kontrol Harian - SIAPIT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        .grid-table th {
            font-size: 0.7rem;
            padding: 0.5rem 0.25rem;
            text-align: center;
            min-width: 65px;
        }
        .grid-table td {
            padding: 0.4rem 0.25rem;
            text-align: center;
            vertical-align: middle;
        }
        .day-header {
            font-weight: 800;
        }
        .day-header.saturday {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border-bottom: 2px solid #f59e0b;
        }
        .day-header.sunday {
            background: rgba(239, 68, 68, 0.05);
            color: #dc2626;
        }
        .cell-saturday {
            background: rgba(245, 158, 11, 0.02);
        }
        .cell-sunday {
            background: rgba(239, 68, 68, 0.01);
        }
    </style>
    <script>
        function updateSelectColor(select) {
            const val = parseInt(select.value);
            if (val === 1) {
                select.style.background = 'rgba(16, 185, 129, 0.15)';
                select.style.color = '#10b981';
            } else if (val === 2) {
                select.style.background = 'rgba(245, 158, 11, 0.15)';
                select.style.color = '#d97706';
            } else if (val === 3) {
                select.style.background = 'rgba(59, 130, 246, 0.15)';
                select.style.color = '#2563eb';
            } else if (val === 0) {
                select.style.background = 'rgba(239, 68, 68, 0.15)';
                select.style.color = '#ef4444';
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
                    <h1>Lembar Kontrol Harian</h1>
                    <p>Grid kalender satu bulan penuh untuk pengisian ceklis atau nilai harian.</p>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Filter Grid Spreadsheet -->
            <div class="dashboard-panel" style="width: 100%; margin-bottom: 1.5rem; padding: 1.25rem 1.5rem;">
                <form method="GET" action="{{ route('super-admin.education.daily-control') }}" style="display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: flex-end;">
                    <div style="flex: 1.2; min-width: 180px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Tahun Ajaran</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="academic_year_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($academicYears as $ay)
                                    <option value="{{ $ay->id }}" {{ $selectedAcademicYearId == $ay->id ? 'selected' : '' }}>{{ $ay->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="flex: 1.2; min-width: 180px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Gelombang / Batch</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="batch_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($batches as $b)
                                    <option value="{{ $b->id }}" {{ $selectedBatchId == $b->id ? 'selected' : '' }}>{{ $b->name }} ({{ $b->academicYear->name }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="flex: 1.5; min-width: 180px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Pilih Kelas</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="classroom_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($classrooms as $cls)
                                    <option value="{{ $cls->id }}" {{ $selectedClassroomId == $cls->id ? 'selected' : '' }}>{{ $cls->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if($activePeriod && $activePeriod->aspects->count() > 0)
                        <div style="flex: 1.8; min-width: 200px; display: flex; flex-direction: column; gap: 0.5rem;">
                            <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Aspek Penilaian</label>
                            <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                                <select name="education_aspect_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                    <optgroup label="Penilaian Karakter">
                                        @foreach($activePeriod->aspects->where('type', 'character') as $asp)
                                            <option value="{{ $asp->id }}" {{ $selectedAspectId == $asp->id ? 'selected' : '' }}>{{ $asp->name }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Penilaian Skill">
                                        @foreach($activePeriod->aspects->where('type', 'skill') as $asp)
                                            <option value="{{ $asp->id }}" {{ $selectedAspectId == $asp->id ? 'selected' : '' }}>{{ $asp->name }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div style="flex: 1.2; min-width: 150px; display: flex; flex-direction: column; gap: 0.5rem;">
                            <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Pilih Bulan</label>
                            <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                                <select name="month" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                    @foreach($months as $m)
                                        <option value="{{ $m['value'] }}" {{ $selectedMonth == $m['value'] ? 'selected' : '' }}>{{ $m['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </form>
            </div>

            @if(!$activePeriod || $classrooms->count() == 0 || !$selectedAspect)
                <div class="dashboard-panel" style="width: 100%; text-align: center; padding: 4rem 2rem; color: var(--text-secondary);">
                    Belum ada kelas, aspek penilaian, atau konfigurasi pendidikan aktif untuk periode yang dipilih.
                </div>
            @else
                @php
                    // Group dates into weeks
                    $weeks = [];
                    $currentWeek = [];
                    foreach ($dates as $date) {
                        $currentWeek[] = $date;
                        $carbon = \Carbon\Carbon::parse($date);
                        if ($carbon->dayOfWeek == \Carbon\Carbon::SUNDAY || $date === end($dates)) {
                            $weeks[] = $currentWeek;
                            $currentWeek = [];
                        }
                    }
                    if (!empty($currentWeek)) {
                        $weeks[] = $currentWeek;
                    }
                @endphp

                <!-- Diagram Chart Tren Kelas Harian -->
                @if($students->count() > 0)
                    <div class="dashboard-panel" style="width: 100%; margin-bottom: 1.5rem; padding: 1.5rem;">
                        <h3 class="panel-title" style="margin-bottom: 1rem;"><i class="fa-solid fa-chart-line" style="color: var(--accent-blue);"></i> Grafik Perkembangan Kelas Harian</h3>
                        <div style="height: 220px; width: 100%; position: relative;">
                            <canvas id="classTrendChart"></canvas>
                        </div>
                    </div>
                @endif

                <div class="dashboard-panel" style="width: 100%;">
                    <form id="daily-control-form" method="POST" action="{{ route('super-admin.education.daily-control.store') }}">
                        @csrf
                        <input type="hidden" name="classroom_id" value="{{ $selectedClassroomId }}">
                        <input type="hidden" name="education_aspect_id" value="{{ $selectedAspectId }}">
                        <input type="hidden" name="month" value="{{ $selectedMonth }}">

                        <!-- Panel Pengaturan Tipe Aspek & KKM -->
                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: center; max-width: 500px;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <span style="font-weight: 800; color: var(--text-primary); font-size: 0.85rem;"><i class="fa-solid fa-gears" style="color: var(--accent-blue);"></i> Tipe Input Aspek:</span>
                                <div class="input-wrapper" style="height: 36px; width: 150px; display: flex; align-items: center; border-radius: 8px;">
                                    <select name="input_type" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 0.5rem; height: 100%;">
                                        <option value="checklist" {{ $selectedAspect->input_type == 'checklist' ? 'selected' : '' }}>Ceklis (Ya/Tidak)</option>
                                        <option value="score" {{ $selectedAspect->input_type == 'score' ? 'selected' : '' }}>Nilai Angka</option>
                                        <option value="counter" {{ $selectedAspect->input_type == 'counter' ? 'selected' : '' }}>Target Kuantitas / Counter</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="kkm-setting-container" style="display: {{ ($selectedAspect->input_type == 'score' || $selectedAspect->input_type == 'counter') ? 'flex' : 'none' }}; align-items: center; gap: 0.5rem;">
                                <span style="font-weight: 800; color: var(--text-primary); font-size: 0.85rem;"><i class="fa-solid fa-bullseye" style="color: var(--accent-teal);"></i> <span id="kkm-label">{{ $selectedAspect->input_type == 'counter' ? 'Target Angka' : 'KKM' }}</span>:</span>
                                <div class="input-wrapper" style="height: 36px; width: 80px; display: flex; align-items: center; border-radius: 8px;">
                                    <input type="number" name="kkm" min="0" step="any" value="{{ (float)($selectedAspect->target_weekly ?? 80) }}" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--text-primary); text-align: center; padding: 0 0.5rem; height: 100%;">
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <div>
                                <h3 class="panel-title" style="margin-bottom: 0.25rem;"><i class="fa-solid fa-table-cells"></i> Grid Spreadsheet: {{ $selectedAspect->name }}</h3>
                                <span style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary);">
                                    Tipe Input Aktif: <strong style="color: var(--accent-blue);" id="active-type-label">
                                        @if($selectedAspect->input_type == 'checklist')
                                            Ceklis (Ya/Tidak)
                                        @elseif($selectedAspect->input_type == 'counter')
                                            Target Kuantitas / Counter
                                        @else
                                            Nilai Angka (0-100)
                                        @endif
                                    </strong>
                                </span>
                            </div>
                        </div>

                        <div class="table-container" style="overflow-x: auto; max-width: 100%; border-radius: 12px; box-shadow: var(--nm-inset-sm); margin-bottom: 1.5rem; background: var(--bg-primary);">
                            <table class="grid-table" style="min-width: 100%; border-collapse: collapse; white-space: nowrap;">
                                <thead>
                                    <tr style="border-bottom: 2px solid #d1d9e6; background: rgba(243, 244, 246, 0.4);">
                                        <th style="text-align: left; padding-left: 1rem; position: sticky; left: 0; background: var(--bg-primary); z-index: 10; border-right: 2px solid #d1d9e6; vertical-align: middle;">Nama Peserta</th>
                                        
                                        @foreach($weeks as $wIdx => $weekDates)
                                            @foreach($weekDates as $date)
                                                @php
                                                    $carbon = \Carbon\Carbon::parse($date);
                                                    $dayNames = [
                                                        0 => 'Ahad',
                                                        1 => 'Senin',
                                                        2 => 'Selasa',
                                                        3 => 'Rabu',
                                                        4 => 'Kamis',
                                                        5 => 'Jumat',
                                                        6 => 'Sabtu',
                                                    ];
                                                    $dayStr = $dayNames[$carbon->dayOfWeek];
                                                    $dayNum = $carbon->format('d');
                                                    $dayOfWeek = $carbon->dayOfWeek;
                                                    $headerClass = '';
                                                    if ($dayOfWeek == \Carbon\Carbon::SATURDAY) $headerClass = 'saturday';
                                                    elseif ($dayOfWeek == \Carbon\Carbon::SUNDAY) $headerClass = 'sunday';
                                                    
                                                    $isActiveDay = in_array($date, $selectedAspect->active_days ?? []);
                                                @endphp
                                                <th class="day-header {{ $headerClass }}" style="vertical-align: middle;">
                                                    <div style="margin-bottom: 0.25rem;">
                                                        <input type="checkbox" name="active_days[{{ $date }}]" value="1" {{ $isActiveDay ? 'checked' : '' }} class="header-active-day" data-week="{{ $wIdx }}" style="width: 14px; height: 14px; cursor: pointer; accent-color: var(--accent-teal);" title="Tandai hari aktif">
                                                    </div>
                                                    <div style="font-size: 0.65rem; text-transform: uppercase;">{{ $dayStr }}</div>
                                                    <div style="font-size: 0.85rem; font-weight: 800;">{{ $dayNum }}</div>
                                                </th>
                                            @endforeach
                                            <!-- Weekly summaries headers -->
                                            <th style="background: rgba(16, 185, 129, 0.05); color: #10b981; font-weight: 800; border-left: 1.5px solid #d1d9e6; vertical-align: middle;">Realisasi W{{ $wIdx + 1 }}</th>
                                            <th style="background: rgba(16, 185, 129, 0.05); color: #10b981; font-weight: 800; vertical-align: middle;">Target W{{ $wIdx + 1 }}</th>
                                            <th style="background: rgba(16, 185, 129, 0.05); color: #10b981; font-weight: 800; border-right: 1.5px solid #d1d9e6; vertical-align: middle; padding-right: 0.5rem;">% W{{ $wIdx + 1 }}</th>
                                        @endforeach

                                        <!-- Monthly summaries headers -->
                                        <th style="background: rgba(59, 130, 246, 0.05); color: var(--accent-blue); font-weight: 800; border-left: 2px solid var(--accent-blue); vertical-align: middle;">Realisasi Bulanan</th>
                                        <th style="background: rgba(59, 130, 246, 0.05); color: var(--accent-blue); font-weight: 800; vertical-align: middle;">Target Bulanan</th>
                                        <th style="background: rgba(59, 130, 246, 0.05); color: var(--accent-blue); font-weight: 800; border-right: 2px solid var(--accent-blue); vertical-align: middle; padding-right: 0.5rem;">% Bulanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $st)
                                        <tr style="border-bottom: 1px solid #e2e8f0;">
                                            <td style="text-align: left; padding-left: 1rem; position: sticky; left: 0; background: var(--bg-primary); z-index: 9; border-right: 2px solid #d1d9e6; font-weight: 700; color: var(--text-primary);">
                                                {{ $st->registration->name }}
                                                <div style="font-size: 0.7rem; color: var(--text-secondary); font-weight: 600;">{{ $st->registration->major->name }}</div>
                                            </td>
                                            
                                            @foreach($weeks as $wIdx => $weekDates)
                                                @foreach($weekDates as $date)
                                                    @php
                                                        $existingScore = $st->scores->where('evaluation_date', $date)->first();
                                                        $carbon = \Carbon\Carbon::parse($date);
                                                        $dayOfWeek = $carbon->dayOfWeek;
                                                        $cellClass = '';
                                                        if ($dayOfWeek == \Carbon\Carbon::SATURDAY) $cellClass = 'cell-saturday';
                                                        elseif ($dayOfWeek == \Carbon\Carbon::SUNDAY) $cellClass = 'cell-sunday';
                                                        
                                                        $isActiveDay = in_array($date, $selectedAspect->active_days ?? []);
                                                    @endphp
                                                    <td class="{{ $cellClass }}">
                                                        <!-- Checklist Input Container -->
                                                        <div class="checklist-input-container" style="display: {{ $selectedAspect->input_type == 'checklist' ? 'block' : 'none' }};">
                                                            @php
                                                                $currentScore = $existingScore ? (int)$existingScore->score : 0;
                                                                $selectBg = 'rgba(239, 68, 68, 0.15)';
                                                                $selectColor = '#ef4444';
                                                                if ($currentScore == 1) { $selectBg = 'rgba(16, 185, 129, 0.15)'; $selectColor = '#10b981'; }
                                                                elseif ($currentScore == 2) { $selectBg = 'rgba(245, 158, 11, 0.15)'; $selectColor = '#d97706'; }
                                                                elseif ($currentScore == 3) { $selectBg = 'rgba(59, 130, 246, 0.15)'; $selectColor = '#2563eb'; }
                                                            @endphp
                                                            <select name="scores[{{ $st->id }}][{{ $date }}]" class="checklist-el grid-cb" {{ ($selectedAspect->input_type == 'checklist' && $isActiveDay) ? '' : 'disabled' }} style="width: 50px; height: 30px; padding: 0.1rem 0.25rem; font-weight: 800; font-size: 0.75rem; border-radius: 6px; border: none; outline: none; background: {{ $selectBg }}; color: {{ $selectColor }}; box-shadow: var(--nm-inset-sm); cursor: pointer; text-align: center; opacity: {{ $isActiveDay ? '1' : '0.4' }};" onchange="updateSelectColor(this)">
                                                                <option value="0" {{ $currentScore == 0 ? 'selected' : '' }} style="color: #ef4444; font-weight: 800;">x</option>
                                                                <option value="1" {{ $currentScore == 1 ? 'selected' : '' }} style="color: #10b981; font-weight: 800;">✓</option>
                                                                <option value="2" {{ $currentScore == 2 ? 'selected' : '' }} style="color: #d97706; font-weight: 800;">S</option>
                                                                <option value="3" {{ $currentScore == 3 ? 'selected' : '' }} style="color: #2563eb; font-weight: 800;">I</option>
                                                            </select>
                                                        </div>

                                                        <!-- Score Input Container -->
                                                        <div class="score-input-container" style="display: {{ ($selectedAspect->input_type == 'score' || $selectedAspect->input_type == 'counter') ? 'block' : 'none' }};">
                                                            <div class="input-wrapper" style="max-width: 60px; margin: 0 auto;">
                                                                <input type="number" name="scores[{{ $st->id }}][{{ $date }}]" min="0" step="any" value="{{ $existingScore ? (float)$existingScore->score : '' }}" class="score-el grid-num" {{ (($selectedAspect->input_type == 'score' || $selectedAspect->input_type == 'counter') && $isActiveDay) ? '' : 'disabled' }} style="padding: 0.25rem; text-align: center; font-weight: 700; height: 30px; font-size: 0.75rem; border-radius: 6px; opacity: {{ $isActiveDay ? '1' : '0.4' }};">
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endforeach

                                                <!-- Weekly summaries calculation cells -->
                                                @php
                                                    $weekScores = $st->scores->whereIn('evaluation_date', $weekDates);
                                                    $weekActiveDays = array_intersect($weekDates, $selectedAspect->active_days ?? []);
                                                    
                                                    if ($selectedAspect->input_type === 'checklist') {
                                                        $weekRealisasi = 0;
                                                        $weekTarget = 0;
                                                        foreach ($weekActiveDays as $d) {
                                                            $scObj = $weekScores->where('evaluation_date', $d)->first();
                                                            $scVal = $scObj ? (int)$scObj->score : 0;
                                                            if ($scVal == 1) {
                                                                $weekRealisasi++;
                                                                $weekTarget++;
                                                            } elseif ($scVal == 0) {
                                                                $weekTarget++;
                                                            }
                                                        }
                                                        $weekPercentage = $weekTarget > 0 ? ($weekRealisasi / $weekTarget) * 100 : 0;
                                                        
                                                        $realDisp = $weekRealisasi . ' hr';
                                                        $targetDisp = $weekTarget . ' hr';
                                                    } elseif ($selectedAspect->input_type === 'counter') {
                                                        $activeScores = $weekScores->whereIn('evaluation_date', $weekActiveDays);
                                                        $weekRealisasi = $activeScores->sum('score') ?? 0;
                                                        $weekTarget = (float)($selectedAspect->target_weekly ?? 3);
                                                        $weekPercentage = $weekTarget > 0 ? ($weekRealisasi / $weekTarget) * 100 : 0;
                                                        
                                                        $realDisp = $weekRealisasi;
                                                        $targetDisp = $weekTarget;
                                                    } else {
                                                        $activeScores = $weekScores->whereIn('evaluation_date', $weekActiveDays);
                                                        $weekRealisasi = $activeScores->avg('score') ?? 0;
                                                        $weekTarget = (float)($selectedAspect->target_weekly ?? 80);
                                                        $weekPercentage = $weekTarget > 0 ? ($weekRealisasi / $weekTarget) * 100 : 0;
                                                        
                                                        $realDisp = number_format($weekRealisasi, 1);
                                                        $targetDisp = number_format($weekTarget, 0);
                                                    }
                                                @endphp
                                                <td style="font-weight: 800; border-left: 1.5px solid #d1d9e6; background: rgba(243, 244, 246, 0.4);" data-summary="real-w" data-student-id="{{ $st->id }}" data-week="{{ $wIdx }}">{{ $realDisp }}</td>
                                                <td style="font-weight: 700; color: var(--text-secondary); background: rgba(243, 244, 246, 0.4);" data-summary="target-w" data-student-id="{{ $st->id }}" data-week="{{ $wIdx }}">{{ $targetDisp }}</td>
                                                <td style="font-weight: 800; color: {{ $weekPercentage >= 100 ? '#10b981' : '#f59e0b' }}; background: rgba(243, 244, 246, 0.4); border-right: 1.5px solid #d1d9e6;" data-summary="percent-w" data-student-id="{{ $st->id }}" data-week="{{ $wIdx }}">{{ number_format($weekPercentage, 0) }}%</td>
                                            @endforeach

                                            <!-- Monthly summaries calculation cells -->
                                            @php
                                                $allActiveDays = array_intersect($dates, $selectedAspect->active_days ?? []);
                                                if ($selectedAspect->input_type === 'checklist') {
                                                    $monthlyRealisasi = 0;
                                                    $monthlyTarget = 0;
                                                    foreach ($allActiveDays as $d) {
                                                        $scObj = $st->scores->where('evaluation_date', $d)->first();
                                                        $scVal = $scObj ? (int)$scObj->score : 0;
                                                        if ($scVal == 1) {
                                                            $monthlyRealisasi++;
                                                            $monthlyTarget++;
                                                        } elseif ($scVal == 0) {
                                                            $monthlyTarget++;
                                                        }
                                                    }
                                                    $monthlyPercentage = $monthlyTarget > 0 ? ($monthlyRealisasi / $monthlyTarget) * 100 : 0;
                                                    
                                                    $mRealDisp = $monthlyRealisasi . ' hr';
                                                    $mTargetDisp = $monthlyTarget . ' hr';
                                                } elseif ($selectedAspect->input_type === 'counter') {
                                                    $activeScores = $st->scores->whereIn('evaluation_date', $dates)->whereIn('evaluation_date', $allActiveDays);
                                                    $monthlyRealisasi = $activeScores->sum('score') ?? 0;
                                                    $monthlyTarget = (float)($selectedAspect->target_weekly ?? 3);
                                                    $monthlyPercentage = $monthlyTarget > 0 ? ($monthlyRealisasi / $monthlyTarget) * 100 : 0;
                                                    
                                                    $mRealDisp = $monthlyRealisasi;
                                                    $mTargetDisp = $monthlyTarget;
                                                } else {
                                                    $activeScores = $st->scores->whereIn('evaluation_date', $dates)->whereIn('evaluation_date', $allActiveDays);
                                                    $monthlyRealisasi = $activeScores->avg('score') ?? 0;
                                                    $monthlyTarget = (float)($selectedAspect->target_weekly ?? 80);
                                                    $monthlyPercentage = $monthlyTarget > 0 ? ($monthlyRealisasi / $monthlyTarget) * 100 : 0;
                                                    
                                                    $mRealDisp = number_format($monthlyRealisasi, 1);
                                                    $mTargetDisp = number_format($monthlyTarget, 0);
                                                }
                                            @endphp
                                            <td style="font-weight: 800; border-left: 2px solid var(--accent-blue); background: rgba(59, 130, 246, 0.03); color: var(--accent-blue);" data-summary="real-m" data-student-id="{{ $st->id }}">{{ $mRealDisp }}</td>
                                            <td style="font-weight: 700; color: var(--text-secondary); background: rgba(59, 130, 246, 0.03);" data-summary="target-m" data-student-id="{{ $st->id }}">{{ $mTargetDisp }}</td>
                                            <td style="font-weight: 800; color: {{ $monthlyPercentage >= 100 ? '#10b981' : '#f59e0b' }}; background: rgba(59, 130, 246, 0.03); border-right: 2px solid var(--accent-blue);" data-summary="percent-m" data-student-id="{{ $st->id }}">{{ number_format($monthlyPercentage, 0) }}%</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($dates) + 2 }}" style="text-align: center; padding: 2rem; color: var(--text-secondary);">Kelas ini belum memiliki anggota.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                
                                <!-- Vertical Class/Team accumulation row at the bottom -->
                                @if($students->count() > 0)
                                    <tfoot>
                                        <tr style="background: rgba(243, 244, 246, 0.7); border-top: 2.5px solid #d1d9e6; border-bottom: 2px solid #d1d9e6;">
                                            <td style="text-align: left; padding-left: 1rem; position: sticky; left: 0; background: #eef2f6; z-index: 9; border-right: 2px solid #d1d9e6; font-weight: 800; color: var(--text-primary);">
                                                Rata-rata Kelas
                                            </td>
                                            
                                            @foreach($weeks as $wIdx => $weekDates)
                                                @foreach($weekDates as $date)
                                                    @php
                                                        // Calculate day average across all students
                                                        $dayScores = \App\Models\EducationScore::whereIn('education_student_id', $students->pluck('id'))
                                                            ->where('education_aspect_id', $selectedAspectId)
                                                            ->where('evaluation_date', $date)
                                                            ->get();
                                                        
                                                        if ($selectedAspect->input_type === 'checklist') {
                                                            $checkedCount = $dayScores->where('score', 1.00)->count();
                                                            $excusedCount = $dayScores->whereIn('score', [2.00, 3.00])->count();
                                                            $effectiveStudents = $students->count() - $excusedCount;
                                                            $dayAvgDisp = $effectiveStudents > 0 ? number_format(($checkedCount / $effectiveStudents) * 100, 0) . '%' : '-';
                                                        } else {
                                                            $avgVal = $dayScores->avg('score');
                                                            $dayAvgDisp = $avgVal !== null ? number_format($avgVal, 1) : '-';
                                                        }
                                                    @endphp
                                                    <td style="font-weight: 800; color: var(--text-primary);" data-footer="day-avg" data-date="{{ $date }}">{{ $dayAvgDisp }}</td>
                                                @endforeach

                                                <!-- Weekly Class Average -->
                                                @php
                                                    $weekStudentReals = [];
                                                    $weekStudentTargets = [];
                                                    $weekStudentPercentages = [];
                                                    foreach($students as $st) {
                                                        $stWeekScores = $st->scores->whereIn('evaluation_date', $weekDates);
                                                        $stWeekActiveDays = array_intersect($weekDates, $selectedAspect->active_days ?? []);
                                                        
                                                        if ($selectedAspect->input_type === 'checklist') {
                                                            $stReal = 0;
                                                            $stTarget = 0;
                                                            foreach ($stWeekActiveDays as $d) {
                                                                $scObj = $stWeekScores->where('evaluation_date', $d)->first();
                                                                $scVal = $scObj ? (int)$scObj->score : 0;
                                                                if ($scVal == 1) {
                                                                    $stReal++;
                                                                    $stTarget++;
                                                                } elseif ($scVal == 0) {
                                                                    $stTarget++;
                                                                }
                                                            }
                                                        } else {
                                                            $stActiveScores = $stWeekScores->whereIn('evaluation_date', $stWeekActiveDays);
                                                            $stReal = $stActiveScores->avg('score') ?? 0;
                                                            $stTarget = (float)($selectedAspect->target_weekly ?? 80);
                                                        }
                                                        $weekStudentReals[] = $stReal;
                                                        $weekStudentTargets[] = $stTarget;
                                                        $weekStudentPercentages[] = $stTarget > 0 ? ($stReal / $stTarget) * 100 : 0;
                                                    }
                                                    $avgWeekReal = count($weekStudentReals) > 0 ? array_sum($weekStudentReals) / count($weekStudentReals) : 0;
                                                    $avgWeekTarget = count($weekStudentTargets) > 0 ? array_sum($weekStudentTargets) / count($weekStudentTargets) : 0;
                                                    $avgWeekPercentage = count($weekStudentPercentages) > 0 ? array_sum($weekStudentPercentages) / count($weekStudentPercentages) : 0;
                                                    
                                                    if ($selectedAspect->input_type === 'checklist') {
                                                        $wRealStr = number_format($avgWeekReal, 1) . ' hr';
                                                        $wTargetStr = number_format($avgWeekTarget, 1) . ' hr';
                                                    } else {
                                                        $wRealStr = number_format($avgWeekReal, 1);
                                                        $wTargetStr = number_format($avgWeekTarget, 0);
                                                    }
                                                @endphp
                                                <td style="font-weight: 800; border-left: 1.5px solid #d1d9e6; background: rgba(16, 185, 129, 0.08); color: #10b981;" data-footer="real-w" data-week="{{ $wIdx }}">{{ $wRealStr }}</td>
                                                <td style="font-weight: 700; color: var(--text-secondary); background: rgba(16, 185, 129, 0.08);" data-footer="target-w" data-week="{{ $wIdx }}">{{ $wTargetStr }}</td>
                                                <td style="font-weight: 800; color: {{ $avgWeekPercentage >= 100 ? '#10b981' : '#f59e0b' }}; background: rgba(16, 185, 129, 0.08); border-right: 1.5px solid #d1d9e6;" data-footer="percent-w" data-week="{{ $wIdx }}">{{ number_format($avgWeekPercentage, 0) }}%</td>
                                            @endforeach

                                            <!-- Monthly Class Average -->
                                            @php
                                                $mStudentReals = [];
                                                $mStudentTargets = [];
                                                $mStudentPercentages = [];
                                                foreach($students as $st) {
                                                    $stAllActiveDays = array_intersect($dates, $selectedAspect->active_days ?? []);
                                                    if ($selectedAspect->input_type === 'checklist') {
                                                        $stReal = 0;
                                                        $stTarget = 0;
                                                        foreach ($stAllActiveDays as $d) {
                                                            $scObj = $st->scores->where('evaluation_date', $d)->first();
                                                            $scVal = $scObj ? (int)$scObj->score : 0;
                                                            if ($scVal == 1) {
                                                                $stReal++;
                                                                $stTarget++;
                                                            } elseif ($scVal == 0) {
                                                                $stTarget++;
                                                            }
                                                        }
                                                    } else {
                                                        $stActiveScores = $st->scores->whereIn('evaluation_date', $dates)->whereIn('evaluation_date', $stAllActiveDays);
                                                        $stReal = $stActiveScores->avg('score') ?? 0;
                                                        $stTarget = (float)($selectedAspect->target_weekly ?? 80);
                                                    }
                                                    $mStudentReals[] = $stReal;
                                                    $mStudentTargets[] = $stTarget;
                                                    $mStudentPercentages[] = $stTarget > 0 ? ($stReal / $stTarget) * 100 : 0;
                                                }
                                                $avgMReal = count($mStudentReals) > 0 ? array_sum($mStudentReals) / count($mStudentReals) : 0;
                                                $avgMTarget = count($mStudentTargets) > 0 ? array_sum($mStudentTargets) / count($mStudentTargets) : 0;
                                                $avgMPercentage = count($mStudentPercentages) > 0 ? array_sum($mStudentPercentages) / count($mStudentPercentages) : 0;
                                                
                                                if ($selectedAspect->input_type === 'checklist') {
                                                    $mRealStr = number_format($avgMReal, 1) . ' hr';
                                                    $mTargetStr = number_format($avgMTarget, 1) . ' hr';
                                                } else {
                                                    $mRealStr = number_format($avgMReal, 1);
                                                    $mTargetStr = number_format($avgMTarget, 0);
                                                }
                                            @endphp
                                            <td style="font-weight: 800; border-left: 2px solid var(--accent-blue); background: rgba(59, 130, 246, 0.08); color: var(--accent-blue);" data-footer="real-m">{{ $mRealStr }}</td>
                                            <td style="font-weight: 700; color: var(--text-secondary); background: rgba(59, 130, 246, 0.08);" data-footer="target-m">{{ $mTargetStr }}</td>
                                            <td style="font-weight: 800; color: {{ $avgMPercentage >= 100 ? '#10b981' : '#f59e0b' }}; background: rgba(59, 130, 246, 0.08); border-right: 2px solid var(--accent-blue);" data-footer="percent-m">{{ number_format($avgMPercentage, 0) }}%</td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>

                        @if($students->count() > 0)
                            <div style="display: flex; justify-content: flex-end; gap: 1rem; align-items: center; margin-top: 1rem;">
                                <span id="save-status" style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 0.5rem 1.25rem; border-radius: 10px; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;">
                                    <i class="fa-solid fa-cloud" style="color: var(--accent-blue);"></i> Semua perubahan disimpan otomatis
                                </span>
                            </div>
                        @endif
                    </form>
                </div>
            @endif
        </main>
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

            // Initialize Class Trend Chart
            let trendChart = null;
            function initChart() {
                const chartCanvas = document.getElementById('classTrendChart');
                if (!chartCanvas) return;
                const ctx = chartCanvas.getContext('2d');
                const headerCheckboxes = Array.from(document.querySelectorAll('.header-active-day'));
                const labels = headerCheckboxes.map(cb => {
                    const dateStr = cb.name.match(/active_days\[(.*?)\]/)[1];
                    const parts = dateStr.split('-');
                    return parseInt(parts[2]); // Just show day number (e.g. 1, 2, 3...)
                });

                // Create gradient background for line fill
                const gradient = ctx.createLinearGradient(0, 0, 0, 200);
                gradient.addColorStop(0, 'rgba(37, 99, 235, 0.25)');
                gradient.addColorStop(1, 'rgba(37, 99, 235, 0.00)');

                trendChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Perkembangan Rata-rata Kelas',
                            data: labels.map(() => 0),
                            borderColor: '#2563eb',
                            backgroundColor: gradient,
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#2563eb',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    title: function(context) {
                                        const day = context[0].label;
                                        return 'Tanggal ' + day;
                                    },
                                    label: function(context) {
                                        const isChecklist = document.querySelector('select[name="input_type"]').value === 'checklist';
                                        let val = context.parsed.y;
                                        if (val === null) return 'Tidak aktif / tidak ada data';
                                        return ' Rata-rata: ' + val.toFixed(1) + (isChecklist ? '%' : '');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                min: 0,
                                max: 100,
                                grid: { color: 'rgba(0, 0, 0, 0.05)' },
                                ticks: {
                                    font: { weight: 'bold' },
                                    callback: function(value) {
                                        const isChecklist = document.querySelector('select[name="input_type"]').value === 'checklist';
                                        return value + (isChecklist ? '%' : '');
                                    }
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { weight: 'bold' } }
                            }
                        }
                    }
                });
            }

            // Dynamic grid type toggler
            const inputTypeSelect = document.querySelector('select[name="input_type"]');
            if (inputTypeSelect) {
                inputTypeSelect.addEventListener('change', function() {
                    const selectedType = this.value;
                    
                    // Update label info
                    const activeTypeLabel = document.getElementById('active-type-label');
                    if (activeTypeLabel) {
                        if (selectedType === 'checklist') activeTypeLabel.innerText = 'Ceklis (Ya/Tidak)';
                        else if (selectedType === 'counter') activeTypeLabel.innerText = 'Target Kuantitas / Counter';
                        else activeTypeLabel.innerText = 'Nilai Angka (0-100)';
                    }
                    
                    // Show/hide KKM setting
                    const kkmContainer = document.getElementById('kkm-setting-container');
                    const kkmLabel = document.getElementById('kkm-label');
                    if (kkmContainer) {
                        kkmContainer.style.display = (selectedType === 'score' || selectedType === 'counter') ? 'flex' : 'none';
                    }
                    if (kkmLabel) {
                        kkmLabel.innerText = selectedType === 'counter' ? 'Target Angka' : 'KKM';
                    }
                    
                    // Show/hide input containers
                    document.querySelectorAll('.checklist-input-container').forEach(el => {
                        el.style.display = selectedType === 'checklist' ? 'block' : 'none';
                    });
                    document.querySelectorAll('.score-input-container').forEach(el => {
                        el.style.display = (selectedType === 'score' || selectedType === 'counter') ? 'block' : 'none';
                    });

                    recalculateGrid();
                    triggerAutoSave();
                });
            }

            // Bind listeners for dynamic calculations and autosave
            document.querySelectorAll('.header-active-day').forEach(cb => {
                cb.addEventListener('change', () => {
                    recalculateGrid();
                    triggerAutoSave();
                });
            });
            document.querySelectorAll('.grid-cb').forEach(select => {
                select.addEventListener('change', () => {
                    recalculateGrid();
                    triggerAutoSave();
                });
            });
            document.querySelectorAll('.grid-num').forEach(input => {
                input.addEventListener('input', () => {
                    recalculateGrid();
                    triggerAutoSave();
                });
            });
            const kkmInput = document.querySelector('input[name="kkm"]');
            if (kkmInput) {
                kkmInput.addEventListener('input', () => {
                    recalculateGrid();
                    triggerAutoSave();
                });
            }

            // Initialize Chart first
            initChart();

            // Initial calculation
            recalculateGrid();

            // Auto Save Function
            let saveTimeout = null;
            function triggerAutoSave() {
                const statusEl = document.getElementById('save-status');
                if (statusEl) {
                    statusEl.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="color: var(--accent-blue);"></i> Menyimpan perubahan...';
                    statusEl.style.color = 'var(--accent-blue)';
                }

                clearTimeout(saveTimeout);
                saveTimeout = setTimeout(() => {
                    const form = document.getElementById('daily-control-form');
                    if (!form) return;

                    const formData = new FormData(form);

                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (statusEl) {
                                statusEl.innerHTML = '<i class="fa-solid fa-cloud-arrow-up" style="color: #10b981;"></i> Perubahan berhasil disimpan';
                                statusEl.style.color = '#10b981';
                                setTimeout(() => {
                                    statusEl.innerHTML = '<i class="fa-solid fa-cloud" style="color: var(--accent-blue);"></i> Semua perubahan disimpan otomatis';
                                    statusEl.style.color = 'var(--text-secondary)';
                                }, 2000);
                            }
                        } else {
                            if (statusEl) {
                                statusEl.innerHTML = '<i class="fa-solid fa-circle-exclamation" style="color: #dc2626;"></i> Gagal menyimpan perubahan';
                                statusEl.style.color = '#dc2626';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error saving data:', error);
                        if (statusEl) {
                            statusEl.innerHTML = '<i class="fa-solid fa-circle-exclamation" style="color: #dc2626;"></i> Gagal menyimpan perubahan';
                            statusEl.style.color = '#dc2626';
                        }
                    });
                }, 1000); // 1 second debounce
            }

            function recalculateGrid() {
                const selectedType = document.querySelector('select[name="input_type"]').value;
                const isChecklist = selectedType === 'checklist';
                const isCounter = selectedType === 'counter';
                const headerCheckboxes = Array.from(document.querySelectorAll('.header-active-day'));
                const rows = document.querySelectorAll('tbody tr');
                const totalStudents = rows.length;
                const targetKkmVal = parseFloat(document.querySelector('input[name="kkm"]')?.value || 80.00);

                // Enable/disable column inputs based on header active day
                headerCheckboxes.forEach(cb => {
                    const date = cb.name.match(/active_days\[(.*?)\]/)[1];
                    const isActive = cb.checked;
                    
                    document.querySelectorAll(`[name$="[${date}]"]`).forEach(input => {
                        if (input.classList.contains('header-active-day')) return;
                        
                        const isInputChecklist = input.classList.contains('checklist-el');
                        const isInputScore = input.classList.contains('score-el');
                        
                        if (isActive) {
                            if (isChecklist) {
                                input.disabled = !isInputChecklist;
                            } else {
                                input.disabled = !isInputScore;
                            }
                            input.style.opacity = '1';
                        } else {
                            input.disabled = true;
                            input.style.opacity = '0.4';
                        }
                    });
                });

                // 1. Calculate each student row
                rows.forEach(row => {
                    const firstHiddenInput = row.querySelector('input[name^="scores"]');
                    if (!firstHiddenInput) return;
                    const studentIdMatch = firstHiddenInput.name.match(/scores\[(\d+)\]/);
                    if (!studentIdMatch) return;
                    const studentId = studentIdMatch[1];
                    
                    let monthlyRealisasiSum = 0;
                    let monthlyTargetSum = 0;
                    
                    let weeklyRealisasiSums = {};
                    let weeklyTargetSums = {};
                    
                    headerCheckboxes.forEach(cb => {
                        const w = cb.getAttribute('data-week');
                        weeklyRealisasiSums[w] = 0;
                        weeklyTargetSums[w] = 0;
                    });
                    
                    headerCheckboxes.forEach(cb => {
                        const date = cb.name.match(/active_days\[(.*?)\]/)[1];
                        const w = cb.getAttribute('data-week');
                        const isActive = cb.checked;
                        
                        if (isChecklist) {
                            const selectEl = row.querySelector(`select[name="scores[${studentId}][${date}]"]`);
                            const val = selectEl ? parseInt(selectEl.value) : 0;
                            
                            if (isActive) {
                                if (val === 1) {
                                    weeklyRealisasiSums[w]++;
                                    monthlyRealisasiSum++;
                                    weeklyTargetSums[w]++;
                                    monthlyTargetSum++;
                                } else if (val === 0) {
                                    weeklyTargetSums[w]++;
                                    monthlyTargetSum++;
                                }
                                // Excused for 2 (Sakit) and 3 (Izin) - target not increased
                            }
                        } else {
                            const numCell = row.querySelector(`input[type="number"][name="scores[${studentId}][${date}]"]`);
                            const val = numCell && numCell.value !== '' ? parseFloat(numCell.value) : null;
                            
                            if (isActive) {
                                weeklyTargetSums[w]++;
                                monthlyTargetSum++;
                                if (val !== null) {
                                    weeklyRealisasiSums[w] += val;
                                    monthlyRealisasiSum += val;
                                }
                            }
                        }
                    });
                    
                    // Update Weekly Summary elements
                    Object.keys(weeklyTargetSums).forEach(w => {
                        const targetDays = weeklyTargetSums[w];
                        const realSum = weeklyRealisasiSums[w];
                        
                        let realDisp = '';
                        let targetDisp = '';
                        let percent = 0;
                        
                        if (isChecklist) {
                            realDisp = realSum + ' hr';
                            targetDisp = targetDays + ' hr';
                            percent = targetDays > 0 ? (realSum / targetDays) * 100 : 0;
                        } else if (isCounter) {
                            let scoredSum = 0;
                            headerCheckboxes.forEach(cb => {
                                if (cb.getAttribute('data-week') == w && cb.checked) {
                                    const date = cb.name.match(/active_days\[(.*?)\]/)[1];
                                    const numCell = row.querySelector(`input[type="number"][name="scores[${studentId}][${date}]"]`);
                                    if (numCell && numCell.value !== '') {
                                        scoredSum += parseFloat(numCell.value);
                                    }
                                }
                            });
                            realDisp = scoredSum;
                            targetDisp = targetKkmVal;
                            percent = targetKkmVal > 0 ? (scoredSum / targetKkmVal) * 100 : 0;
                        } else {
                            let scoredDaysCount = 0;
                            let scoredSum = 0;
                            headerCheckboxes.forEach(cb => {
                                if (cb.getAttribute('data-week') == w && cb.checked) {
                                    const date = cb.name.match(/active_days\[(.*?)\]/)[1];
                                    const numCell = row.querySelector(`input[type="number"][name="scores[${studentId}][${date}]"]`);
                                    if (numCell && numCell.value !== '') {
                                        scoredDaysCount++;
                                        scoredSum += parseFloat(numCell.value);
                                    }
                                }
                            });
                            
                            const avgScore = scoredDaysCount > 0 ? scoredSum / scoredDaysCount : 0;
                            realDisp = avgScore.toFixed(1);
                            targetDisp = targetKkmVal.toFixed(0);
                            percent = targetKkmVal > 0 ? (avgScore / targetKkmVal) * 100 : 0;
                        }
                        
                        const realEl = row.querySelector(`td[data-summary="real-w"][data-student-id="${studentId}"][data-week="${w}"]`);
                        const targetEl = row.querySelector(`td[data-summary="target-w"][data-student-id="${studentId}"][data-week="${w}"]`);
                        const percentEl = row.querySelector(`td[data-summary="percent-w"][data-student-id="${studentId}"][data-week="${w}"]`);
                        
                        if (realEl) realEl.innerText = realDisp;
                        if (targetEl) targetEl.innerText = targetDisp;
                        if (percentEl) {
                            percentEl.innerText = Math.round(percent) + '%';
                            percentEl.style.color = percent >= 100 ? '#10b981' : '#f59e0b';
                        }
                    });
                    
                    // Update Monthly Summary elements
                    let mRealDisp = '';
                    let mTargetDisp = '';
                    let mPercent = 0;
                    
                    if (isChecklist) {
                        mRealDisp = monthlyRealisasiSum + ' hr';
                        mTargetDisp = monthlyTargetSum + ' hr';
                        mPercent = monthlyTargetSum > 0 ? (monthlyRealisasiSum / monthlyTargetSum) * 100 : 0;
                    } else if (isCounter) {
                        let scoredSum = 0;
                        headerCheckboxes.forEach(cb => {
                            if (cb.checked) {
                                const date = cb.name.match(/active_days\[(.*?)\]/)[1];
                                const numCell = row.querySelector(`input[type="number"][name="scores[${studentId}][${date}]"]`);
                                if (numCell && numCell.value !== '') {
                                    scoredSum += parseFloat(numCell.value);
                                }
                            }
                        });
                        mRealDisp = scoredSum;
                        mTargetDisp = targetKkmVal;
                        mPercent = targetKkmVal > 0 ? (scoredSum / targetKkmVal) * 100 : 0;
                    } else {
                        let scoredDaysCount = 0;
                        let scoredSum = 0;
                        headerCheckboxes.forEach(cb => {
                            if (cb.checked) {
                                const date = cb.name.match(/active_days\[(.*?)\]/)[1];
                                const numCell = row.querySelector(`input[type="number"][name="scores[${studentId}][${date}]"]`);
                                if (numCell && numCell.value !== '') {
                                    scoredDaysCount++;
                                    scoredSum += parseFloat(numCell.value);
                                }
                            }
                        });
                        const avgScore = scoredDaysCount > 0 ? scoredSum / scoredDaysCount : 0;
                        mRealDisp = avgScore.toFixed(1);
                        mTargetDisp = targetKkmVal.toFixed(0);
                        mPercent = targetKkmVal > 0 ? (avgScore / targetKkmVal) * 100 : 0;
                    }
                    
                    const mRealEl = row.querySelector(`td[data-summary="real-m"][data-student-id="${studentId}"]`);
                    const mTargetEl = row.querySelector(`td[data-summary="target-m"][data-student-id="${studentId}"]`);
                    const mPercentEl = row.querySelector(`td[data-summary="percent-m"][data-student-id="${studentId}"]`);
                    
                    if (mRealEl) mRealEl.innerText = mRealDisp;
                    if (mTargetEl) mTargetEl.innerText = mTargetDisp;
                    if (mPercentEl) {
                        mPercentEl.innerText = Math.round(mPercent) + '%';
                        mPercentEl.style.color = mPercent >= 100 ? '#10b981' : '#f59e0b';
                    }
                });

                // 2. Calculate Vertical Footer averages
                const footerRow = document.querySelector('tfoot tr');
                if (footerRow) {
                    headerCheckboxes.forEach(cb => {
                        const date = cb.name.match(/active_days\[(.*?)\]/)[1];
                        let sum = 0;
                        let count = 0;
                        
                        rows.forEach(row => {
                            const firstHiddenInput = row.querySelector('input[name^="scores"]');
                            if (!firstHiddenInput) return;
                            const studentId = firstHiddenInput.name.match(/scores\[(\d+)\]/)[1];
                            
                            if (isChecklist) {
                                const selectEl = row.querySelector(`select[name="scores[${studentId}][${date}]"]`);
                                const val = selectEl ? parseInt(selectEl.value) : 0;
                                if (val === 1 || val === 0) {
                                    sum += val;
                                    count++;
                                }
                            } else {
                                const numCell = row.querySelector(`input[type="number"][name="scores[${studentId}][${date}]"]`);
                                if (numCell && numCell.value !== '') {
                                    sum += parseFloat(numCell.value);
                                    count++;
                                }
                            }
                        });
                        
                        let dayAvgDisp = '-';
                        if (count > 0) {
                            if (isChecklist) {
                                dayAvgDisp = Math.round((sum / count) * 100) + '%';
                            } else {
                                dayAvgDisp = (sum / count).toFixed(1);
                            }
                        }
                        const footerCell = footerRow.querySelector(`td[data-footer="day-avg"][data-date="${date}"]`);
                        if (footerCell) footerCell.innerText = dayAvgDisp;
                    });
                    
                    if (totalStudents > 0) {
                        // Weekly summaries average
                        const weeksList = Array.from(new Set(headerCheckboxes.map(cb => cb.getAttribute('data-week'))));
                        weeksList.forEach(w => {
                            let realSum = 0;
                            let targetSum = 0;
                            let percentSum = 0;
                            
                            rows.forEach(row => {
                                const firstHiddenInput = row.querySelector('input[name^="scores"]');
                                if (!firstHiddenInput) return;
                                const studentId = firstHiddenInput.name.match(/scores\[(\d+)\]/)[1];
                                
                                const realEl = row.querySelector(`td[data-summary="real-w"][data-student-id="${studentId}"][data-week="${w}"]`);
                                const targetEl = row.querySelector(`td[data-summary="target-w"][data-student-id="${studentId}"][data-week="${w}"]`);
                                const percentEl = row.querySelector(`td[data-summary="percent-w"][data-student-id="${studentId}"][data-week="${w}"]`);
                                
                                if (realEl) realSum += parseFloat(realEl.innerText) || 0;
                                if (targetEl) targetSum += parseFloat(targetEl.innerText) || 0;
                                if (percentEl) percentSum += parseFloat(percentEl.innerText) || 0;
                            });
                            
                            const avgReal = realSum / totalStudents;
                            const avgTarget = targetSum / totalStudents;
                            const avgPercent = percentSum / totalStudents;
                            
                            const fRealEl = footerRow.querySelector(`td[data-footer="real-w"][data-week="${w}"]`);
                            const fTargetEl = footerRow.querySelector(`td[data-footer="target-w"][data-week="${w}"]`);
                            const fPercentEl = footerRow.querySelector(`td[data-footer="percent-w"][data-week="${w}"]`);
                            
                            if (fRealEl) fRealEl.innerText = isChecklist ? avgReal.toFixed(1) + ' hr' : avgReal.toFixed(1);
                            if (fTargetEl) fTargetEl.innerText = isChecklist ? avgTarget.toFixed(1) + ' hr' : avgTarget.toFixed(0);
                            if (fPercentEl) {
                                fPercentEl.innerText = Math.round(avgPercent) + '%';
                                fPercentEl.style.color = avgPercent >= 100 ? '#10b981' : '#f59e0b';
                            }
                        });
                        
                        // Monthly summaries average
                        let mRealSum = 0;
                        let mTargetSum = 0;
                        let mPercentSum = 0;
                        
                        rows.forEach(row => {
                            const firstHiddenInput = row.querySelector('input[name^="scores"]');
                            if (!firstHiddenInput) return;
                            const studentId = firstHiddenInput.name.match(/scores\[(\d+)\]/)[1];
                            
                            const realEl = row.querySelector(`td[data-summary="real-m"][data-student-id="${studentId}"]`);
                            const targetEl = row.querySelector(`td[data-summary="target-m"][data-student-id="${studentId}"]`);
                            const percentEl = row.querySelector(`td[data-summary="percent-m"][data-student-id="${studentId}"]`);
                            
                            if (realEl) mRealSum += parseFloat(realEl.innerText) || 0;
                            if (targetEl) mTargetSum += parseFloat(targetEl.innerText) || 0;
                            if (percentEl) mPercentSum += parseFloat(percentEl.innerText) || 0;
                        });
                        
                        const avgMReal = mRealSum / totalStudents;
                        const avgMTarget = mTargetSum / totalStudents;
                        const avgMPercent = mPercentSum / totalStudents;
                        
                        const fmRealEl = footerRow.querySelector(`td[data-footer="real-m"]`);
                        const fmTargetEl = footerRow.querySelector(`td[data-footer="target-m"]`);
                        const fmPercentEl = footerRow.querySelector(`td[data-footer="percent-m"]`);
                        
                        if (fmRealEl) fmRealEl.innerText = isChecklist ? avgMReal.toFixed(1) + ' hr' : avgMReal.toFixed(1);
                        if (fmTargetEl) fmTargetEl.innerText = isChecklist ? avgMTarget.toFixed(1) + ' hr' : avgMTarget.toFixed(0);
                        if (fmPercentEl) {
                            fmPercentEl.innerText = Math.round(avgMPercent) + '%';
                            fmPercentEl.style.color = avgMPercent >= 100 ? '#10b981' : '#f59e0b';
                        }
                    }
                }

                // 3. Update Chart Trend dynamically
                if (trendChart) {
                    const chartData = [];
                    headerCheckboxes.forEach(cb => {
                        const date = cb.name.match(/active_days\[(.*?)\]/)[1];
                        const footerCell = footerRow.querySelector(`td[data-footer="day-avg"][data-date="${date}"]`);
                        if (footerCell) {
                            const text = footerCell.innerText;
                            if (text === '-') {
                                chartData.push(null);
                            } else {
                                chartData.push(parseFloat(text));
                            }
                        } else {
                            chartData.push(null);
                        }
                    });
                    trendChart.data.datasets[0].data = chartData;
                    trendChart.data.datasets[0].label = isChecklist ? 'Persentase Hadir (%)' : 'Rata-rata Nilai';
                    trendChart.update();
                }
            }
        });
    </script>
</body>
</html>
