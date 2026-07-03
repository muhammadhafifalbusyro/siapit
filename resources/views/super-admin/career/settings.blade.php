<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masa Berkarya - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-body);
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 0 30px 30px 0;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            height: 100vh;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2.5rem;
            padding-left: 0.5rem;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .sidebar-brand span {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--accent-blue);
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex-grow: 1;
        }

        .sidebar-menu li a, .submenu-trigger {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 1.25rem;
            color: var(--text-secondary);
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
        }

        .sidebar-menu li a:hover, .submenu-trigger:hover {
            color: var(--accent-blue);
            box-shadow: var(--nm-inset-sm);
        }

        .sidebar-menu li.active > a, .sidebar-menu li.active > .submenu-trigger {
            color: var(--accent-blue);
            box-shadow: var(--nm-inset-sm);
        }

        .has-submenu {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .submenu-trigger {
            justify-content: space-between;
        }

        .arrow-icon {
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .has-submenu.open .arrow-icon {
            transform: rotate(180deg);
        }

        .submenu {
            list-style: none;
            padding-left: 1.5rem;
            display: none;
            flex-direction: column;
            gap: 0.5rem;
        }

        .has-submenu.open .submenu {
            display: flex;
        }

        .submenu li a {
            padding: 0.65rem 1rem;
            font-size: 0.85rem;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1.5px solid rgba(255,255,255,0.4);
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .user-profile-sm {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--accent-blue);
        }

        .user-meta-sm h4 {
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--text-primary);
        }

        .user-meta-sm p {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: capitalize;
        }

        .btn-logout {
            width: 100%;
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            color: var(--accent-red);
            padding: 0.85rem;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: var(--transition);
        }

        .btn-logout:hover {
            box-shadow: var(--nm-flat-hover);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex-grow: 1;
            padding: 2.5rem;
            max-width: 1200px;
        }

        .main-header {
            margin-bottom: 2.5rem;
        }

        .main-header h1 {
            font-size: 2rem;
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .main-header p {
            color: var(--text-secondary);
            font-weight: 600;
        }

        /* Dashboard Panel */
        .dashboard-panel {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .panel-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Forms styling */
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .input-group label {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--text-secondary);
        }

        .input-wrapper {
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 10px;
            padding: 0.25rem 0.5rem;
        }

        .input-wrapper input, .input-wrapper select, .input-wrapper textarea {
            width: 100%;
            border: none;
            background: transparent;
            outline: none;
            padding: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .btn-submit {
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            color: var(--accent-blue);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.8rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-submit:hover {
            box-shadow: var(--nm-flat-hover);
        }

        /* Table Styling */
        .table-container {
            width: 100%;
            overflow-x: auto;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 15px;
            padding: 0.5rem;
            margin-top: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
            border-bottom: 1.5px solid rgba(255,255,255,0.4);
        }

        th {
            font-weight: 800;
            color: var(--text-secondary);
            border-bottom: 2px solid #cbd5e1;
        }

        /* Pagination Neumorphic */
        .pagination-container {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }
        .pagination-container .pagination {
            display: inline-flex;
            gap: 0.5rem;
            list-style: none;
        }
        .pagination-container .page-item .page-link, .pagination-container .page-item span {
            display: inline-flex;
            width: 36px;
            height: 36px;
            align-items: center;
            justify-content: center;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            color: var(--text-primary);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: var(--transition);
        }
        .pagination-container .page-item.active span {
            box-shadow: var(--nm-inset-sm);
            color: var(--accent-blue);
        }
        .pagination-container .page-item.disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Neumorphic Toast */
        .nm-toast {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--accent-green);
            pointer-events: auto;
            min-width: 300px;
            transform: translateY(-20px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 6px 6px 12px #beccd7, -6px -6px 12px #ffffff;
        }
        .nm-toast.show {
            transform: translateY(0);
            opacity: 1;
        }
        .nm-toast.error {
            color: var(--accent-red);
        }
    </style>
</head>
<body>
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
        <header class="main-header">
            <h1>Masa Berkarya</h1>
            <p>Konfigurasi rentang tanggal periode Masa Berkarya secara spesifik untuk masing-masing santri yang telah lulus Masa Pendidikan.</p>
        </header>

        <!-- Filter Grid -->
        <div class="dashboard-panel" style="padding: 1.5rem; margin-bottom: 2rem;">
            <form method="GET" action="{{ route('super-admin.career.settings') }}" style="display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: flex-end; width: 100%;">
                <div style="flex: 1; min-width: 180px; display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Program Pendidikan</label>
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                        <select name="education_program_id" onchange="this.form.submit()" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                            <option value="all" {{ $selectedProgramId == 'all' ? 'selected' : '' }}>Semua Program</option>
                            @foreach($programs as $prog)
                                <option value="{{ $prog->id }}" {{ $selectedProgramId == $prog->id ? 'selected' : '' }}>{{ $prog->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div style="flex: 1; min-width: 180px; display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Tahun Ajaran</label>
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                        <select name="academic_year_id" onchange="this.form.submit()" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                            <option value="all" {{ $selectedAcademicYearId == 'all' ? 'selected' : '' }}>Semua Tahun Ajaran</option>
                            @foreach($academicYears as $ay)
                                <option value="{{ $ay->id }}" {{ $selectedAcademicYearId == $ay->id ? 'selected' : '' }}>{{ $ay->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div style="flex: 1; min-width: 180px; display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Gelombang / Batch</label>
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                        <select name="batch_id" onchange="this.form.submit()" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                            <option value="all" {{ $selectedBatchId == 'all' ? 'selected' : '' }}>Semua Gelombang</option>
                            @foreach($batches as $b)
                                <option value="{{ $b->id }}" {{ $selectedBatchId == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Passed Students Table -->
        <div class="dashboard-panel">
            <h3 class="panel-title"><i class="fa-solid fa-user-graduate"></i> Pengaturan Tanggal Berkarya Santri</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Program Pendidikan</th>
                            <th>Jurusan</th>
                            <th>Tahun Ajaran</th>
                            <th>Gelombang</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($passedStudents as $ps)
                            <tr>
                                <td style="font-weight: 700;">{{ $ps->registration->name }}</td>
                                <td>{{ $ps->registration->educationProgram->name ?? '-' }}</td>
                                <td>{{ $ps->registration->major->name ?? '-' }}</td>
                                <td>{{ $ps->period->academicYear->name ?? '-' }}</td>
                                <td>{{ $ps->period->batch->name ?? '-' }}</td>
                                <td>
                                    <div class="input-wrapper" style="width: 150px;">
                                        <input type="date" id="start_date_{{ $ps->id }}" value="{{ $ps->career_start_date }}" style="font-size: 0.8rem; padding: 0.25rem;">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-wrapper" style="width: 150px;">
                                        <input type="date" id="end_date_{{ $ps->id }}" value="{{ $ps->career_end_date }}" style="font-size: 0.8rem; padding: 0.25rem;">
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn-submit" onclick="saveCareerPeriod({{ $ps->id }})" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">
                                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada data santri yang berstatus Lulus di Masa Pendidikan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($passedStudents && $passedStudents->total() > 0)
                <!-- Pagination UI -->
                <div class="pagination-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; width: 100%; border-top: 1px solid #d1d9e6; background: var(--bg-primary); margin-top: 1.5rem;">
                    {{-- Previous Page Link --}}
                    @if($passedStudents->onFirstPage())
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $passedStudents->appends(request()->query())->previousPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $currentPage = $passedStudents->currentPage();
                        $lastPage = $passedStudents->lastPage();
                        $sidePages = 2;
                    @endphp

                    @for ($page = 1; $page <= $lastPage; $page++)
                        @if ($page == 1 || $page == $lastPage || abs($page - $currentPage) <= $sidePages)
                            @if ($page == $currentPage)
                                <span class="pagination-btn active" style="box-shadow: var(--nm-inset-sm); color: var(--accent-blue); font-weight: 800; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 2.5px solid var(--accent-blue);">{{ $page }}</span>
                            @else
                                <a href="{{ $passedStudents->appends(request()->query())->url($page) }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); font-weight: 700; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);">{{ $page }}</a>
                            @endif
                        @elseif ($page == 2 || $page == $lastPage - 1)
                            <span class="pagination-dots" style="color: var(--text-secondary); width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: 800; user-select: none;">...</span>
                        @endif
                    @endfor

                    {{-- Next Page Link --}}
                    @if($passedStudents->hasMorePages())
                        <a href="{{ $passedStudents->appends(request()->query())->nextPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
            @endif
        </div>
    </main>

    <script>
        // Submenu toggling
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });

        function saveCareerPeriod(studentId) {
            const startDate = document.getElementById(`start_date_${studentId}`).value;
            const endDate = document.getElementById(`end_date_${studentId}`).value;
            const token = document.querySelector('meta[name="csrf-token"]').content;

            fetch("{{ route('super-admin.career.settings.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({
                    student_id: studentId,
                    career_start_date: startDate,
                    career_end_date: endDate
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message);
                } else {
                    showToast(data.message || "Gagal menyimpan periode.", true);
                }
            })
            .catch(err => {
                console.error(err);
                showToast("Terjadi kesalahan jaringan.", true);
            });
        }

        function showToast(message, isError = false) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `nm-toast ${isError ? 'error' : ''}`;
            toast.innerHTML = `
                <i class="fa-solid ${isError ? 'fa-circle-xmark' : 'fa-circle-check'}"></i>
                <span>${message}</span>
            `;
            container.appendChild(toast);
            
            // animate in
            setTimeout(() => toast.classList.add('show'), 50);
            
            // remove after 3.5s
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }
    </script>
    <!-- Toast Container -->
    <div id="toast-container" style="position: fixed; top: 2rem; right: 2rem; z-index: 9999; display: flex; flex-direction: column; gap: 1rem; pointer-events: none;"></div>
</body>
</html>
