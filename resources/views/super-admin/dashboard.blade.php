<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        /* Filters Row */
        .filter-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            align-items: flex-end;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat);
            border: 1.5px solid rgba(255,255,255,0.4);
            padding: 1.5rem;
            border-radius: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .input-group label {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--text-secondary);
        }

        .input-wrapper {
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 10px;
            padding: 0.15rem 0.25rem;
        }

        .input-wrapper select {
            border: none;
            background: transparent;
            outline: none;
            padding: 0.5rem;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-primary);
            width: 180px;
        }

        /* Sections dashboard */
        .dashboard-section {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2.5rem;
            border: 1.5px solid rgba(255,255,255,0.4);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 2px solid rgba(255,255,255,0.4);
            padding-bottom: 0.5rem;
        }

        .section-title i {
            color: var(--accent-blue);
        }

        /* Stats Grid variants */
        .grid-4 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .grid-7 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1.25rem;
        }

        .stat-card-premium {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 16px;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            transition: var(--transition);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .stat-card-premium:hover {
            box-shadow: var(--nm-flat-hover);
        }

        .stat-card-premium .label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card-premium .value {
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--text-primary);
        }

        .stat-card-premium.accent-blue .value { color: var(--accent-blue); }
        .stat-card-premium.accent-green .value { color: var(--accent-green); }
        .stat-card-premium.accent-red .value { color: var(--accent-red); }
        .stat-card-premium.accent-orange .value { color: var(--accent-orange); }

        /* Career Flex layout */
        .career-layout {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 2rem;
            align-items: start;
        }

        /* Table */
        .table-container {
            width: 100%;
            overflow-x: auto;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 15px;
            padding: 0.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 0.85rem 1rem;
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
                <li class="active">
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
                        <li><a href="{{ route('super-admin.billing.overview') }}"><i class="fa-solid fa-chart-pie"></i> Overview</a></li>
                        <li><a href="{{ route('super-admin.billing.categories') }}"><i class="fa-solid fa-list"></i> List Tagihan</a></li>
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
            </ul>
        </div>
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
            <div>
                <h1>Dashboard Utama</h1>
                <p>Ringkasan analitik dan perkembangan santri di semua tahapan.</p>
            </div>
        </header>

        <!-- Filters Row -->
        <form method="GET" action="{{ route('super-admin.dashboard') }}" style="display: flex; gap: 1.5rem; flex-wrap: wrap; align-items: flex-end; margin-bottom: 2.5rem; padding: 1.5rem; border-radius: 20px; box-shadow: var(--nm-flat); border: 1.5px solid rgba(255,255,255,0.4); background: var(--bg-primary);">
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Program Pendidikan</label>
                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                    <select name="education_program_id" onchange="this.form.submit()" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 180px;">
                        <option value="all">Semua Program</option>
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" {{ $selectedProgramId == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Tahun Ajaran</label>
                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                    <select name="academic_year_id" onchange="this.form.submit()" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 180px;">
                        <option value="all">Semua Tahun</option>
                        @foreach($academicYears as $ay)
                            <option value="{{ $ay->id }}" {{ $selectedAcademicYearId == $ay->id ? 'selected' : '' }}>{{ $ay->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Gelombang / Batch</label>
                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                    <select name="batch_id" onchange="this.form.submit()" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 180px;">
                        <option value="all">Semua Batch</option>
                        @foreach($batches as $b)
                            <option value="{{ $b->id }}" {{ $selectedBatchId == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <!-- SECTION 1: DATA PENDAFTARAN -->
        <section class="dashboard-section">
            <h3 class="section-title"><i class="fa-solid fa-user-plus"></i> Analisis Penerimaan & Pendaftaran</h3>
            <div class="grid-7">
                <div class="stat-card-premium">
                    <span class="label">Total Pendaftar</span>
                    <span class="value">{{ $s1TotalPendaftar }}</span>
                </div>
                <div class="stat-card-premium accent-orange">
                    <span class="label">Total Wawancara</span>
                    <span class="value">{{ $s1TotalWawancara }}</span>
                </div>
                <div class="stat-card-premium accent-blue">
                    <span class="label">Diterima (Ikhwan)</span>
                    <span class="value">{{ $s1TotalDiterimaIkhwan }}</span>
                </div>
                <div class="stat-card-premium accent-green">
                    <span class="label">Diterima (Akhwat)</span>
                    <span class="value">{{ $s1TotalDiterimaAkhwat }}</span>
                </div>
                <div class="stat-card-premium accent-red">
                    <span class="label">Ditolak (Ikhwan)</span>
                    <span class="value">{{ $s1TotalDitolakIkhwan }}</span>
                </div>
                <div class="stat-card-premium accent-red">
                    <span class="label">Ditolak (Akhwat)</span>
                    <span class="value">{{ $s1TotalDitolakAkhwat }}</span>
                </div>
            </div>
        </section>

        <!-- SECTION 2: DATA MATRIKULASI -->
        <section class="dashboard-section">
            <h3 class="section-title"><i class="fa-solid fa-graduation-cap"></i> Perkembangan Tahap Matrikulasi</h3>
            <div class="grid-7">
                <div class="stat-card-premium">
                    <span class="label">Calon Santri</span>
                    <span class="value">{{ $s2TotalCalon }}</span>
                </div>
                <div class="stat-card-premium accent-blue">
                    <span class="label">Ikhwan</span>
                    <span class="value">{{ $s2TotalIkhwan }}</span>
                </div>
                <div class="stat-card-premium accent-green">
                    <span class="label">Akhwat</span>
                    <span class="value">{{ $s2TotalAkhwat }}</span>
                </div>
                <div class="stat-card-premium accent-blue">
                    <span class="label">Aktif</span>
                    <span class="value">{{ $s2TotalAktif }}</span>
                </div>
                <div class="stat-card-premium accent-green">
                    <span class="label">Lulus</span>
                    <span class="value">{{ $s2TotalLulus }}</span>
                </div>
                <div class="stat-card-premium accent-red">
                    <span class="label">Gugur</span>
                    <span class="value">{{ $s2TotalGugur }}</span>
                </div>
                <div class="stat-card-premium accent-orange">
                    <span class="label">Mundur</span>
                    <span class="value">{{ $s2TotalMundur }}</span>
                </div>
            </div>
        </section>

        <!-- SECTION 3: DATA MASA PENDIDIKAN -->
        <section class="dashboard-section">
            <h3 class="section-title"><i class="fa-solid fa-book-open"></i> Status Akademik Masa Pendidikan</h3>
            <div class="grid-7">
                <div class="stat-card-premium">
                    <span class="label">Total Santri</span>
                    <span class="value">{{ $s3TotalSantri }}</span>
                </div>
                <div class="stat-card-premium accent-blue">
                    <span class="label">Ikhwan</span>
                    <span class="value">{{ $s3TotalIkhwan }}</span>
                </div>
                <div class="stat-card-premium accent-green">
                    <span class="label">Akhwat</span>
                    <span class="value">{{ $s3TotalAkhwat }}</span>
                </div>
                <div class="stat-card-premium accent-blue">
                    <span class="label">Aktif</span>
                    <span class="value">{{ $s3TotalAktif }}</span>
                </div>
                <div class="stat-card-premium accent-green">
                    <span class="label">Lulus</span>
                    <span class="value">{{ $s3TotalLulus }}</span>
                </div>
                <div class="stat-card-premium accent-red">
                    <span class="label">Gugur</span>
                    <span class="value">{{ $s3TotalGugur }}</span>
                </div>
                <div class="stat-card-premium accent-orange">
                    <span class="label">Mundur</span>
                    <span class="value">{{ $s3TotalMundur }}</span>
                </div>
            </div>
        </section>

        <!-- SECTION 4: DATA SANTRI BERKARYA -->
        <section class="dashboard-section">
            <h3 class="section-title"><i class="fa-solid fa-briefcase"></i> Distribusi & Kinerja Santri Berkarya</h3>
            <div class="grid-7">
                <div class="stat-card-premium accent-blue">
                    <span class="label">Total Berkarya</span>
                    <span class="value">{{ $s4TotalBerkarya }}</span>
                </div>
               
                <div class="stat-card-premium">
                    <span class="label">Total Divisi Karya</span>
                    <span class="value">{{ $s4TotalDivisi }}</span>
                </div>
                 <div class="stat-card-premium accent-blue">
                    <span class="label">Aktif</span>
                    <span class="value">{{ $s4TotalAktif }}</span>
                </div>
                <div class="stat-card-premium accent-green">
                    <span class="label">Lulus</span>
                    <span class="value">{{ $s4TotalLulus }}</span>
                </div>
                <div class="stat-card-premium accent-red">
                    <span class="label">Gugur</span>
                    <span class="value">{{ $s4TotalGugur }}</span>
                </div>
                <div class="stat-card-premium accent-orange">
                    <span class="label">Mundur</span>
                    <span class="value">{{ $s4TotalMundur }}</span>
                </div>
            </div>
        </section>

        <!-- SECTION 5: KOTAK OVERVIEW TAGIHAN -->
        <section class="dashboard-section">
            <h3 class="section-title"><i class="fa-solid fa-file-invoice-dollar"></i> Ikhtisar Keuangan & Pelunasan Tagihan</h3>
            <div class="grid-4">
                <div class="stat-card-premium">
                    <span class="label">Kategori Tagihan</span>
                    <span class="value">{{ $totalCategories }}</span>
                </div>
                <div class="stat-card-premium accent-blue">
                    <span class="label">Target Penagihan</span>
                    <span class="value" style="font-size: 1.35rem; line-height: 2.15rem;">Rp {{ number_format($totalTarget, 0, ',', '.') }}</span>
                </div>
                <div class="stat-card-premium accent-green">
                    <span class="label">Aktual Terbayar</span>
                    <span class="value" style="font-size: 1.35rem; line-height: 2.15rem;">Rp {{ number_format($totalActual, 0, ',', '.') }}</span>
                </div>
                <div class="stat-card-premium accent-green">
                    <span class="label">Pelunasan</span>
                    <span class="value">{{ number_format($percentage, 1) }}%</span>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Submenu toggling
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });
    </script>
</body>
</html>
