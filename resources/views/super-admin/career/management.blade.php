<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Karya {{ $student->registration->name }} - SIAPIT</title>
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

        /* Main Content Layout */
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
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .main-header p {
            color: var(--text-secondary);
            font-weight: 600;
        }

        /* Management Panel Layout */
        .management-grid {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 2rem;
            align-items: start;
        }

        /* Sub Sidebar Tabs */
        .sub-sidebar {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            padding: 1.5rem 1rem;
            border-radius: 20px;
        }

        .sub-sidebar-title {
            font-size: 0.8rem;
            font-weight: 900;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            padding-left: 0.5rem;
        }

        .sub-tab-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-secondary);
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            border-radius: 10px;
            transition: var(--transition);
        }

        .sub-tab-btn:hover, .sub-tab-btn.active {
            color: var(--accent-blue);
            box-shadow: var(--nm-inset-sm);
        }

        /* Content Panel */
        .content-panel {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2rem;
        }

        /* Forms styling */
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
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
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-submit:hover {
            box-shadow: var(--nm-flat-hover);
        }

        .btn-action-sm {
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-action-sm:hover {
            box-shadow: var(--nm-flat-hover);
        }

        /* Work submission card layout */
        .submission-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1.5px solid rgba(255,255,255,0.5);
        }

        .submission-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1.5px solid rgba(255,255,255,0.4);
        }

        .submission-header h4 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--accent-blue);
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
                <li class="has-submenu open">
                    <div class="submenu-trigger">
                        <i class="fa-solid fa-briefcase"></i> Masa Berkarya
                        <i class="fa-solid fa-chevron-down arrow-icon"></i>
                    </div>
                    <ul class="submenu">
                        <li class="{{ Request::routeIs('super-admin.career.targets') ? 'active' : '' }}"><a href="{{ route('super-admin.career.targets') }}"><i class="fa-solid fa-bullseye"></i> Target Karya</a></li>
                        <li class="{{ Request::routeIs('super-admin.career.settings') ? 'active' : '' }}"><a href="{{ route('super-admin.career.settings') }}"><i class="fa-solid fa-sliders"></i> Pengaturan Periode</a></li>
                        <li class="{{ Request::routeIs('super-admin.career.placements') ? 'active' : '' }}"><a href="{{ route('super-admin.career.placements') }}"><i class="fa-solid fa-building"></i> Penempatan Divisi</a></li>
                        <li class="active"><a href="{{ route('super-admin.career.reports') }}"><i class="fa-solid fa-medal"></i> Rapor Karya</a></li>
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
                <h1>Manajemen Karya: {{ $student->registration->name }}</h1>
                <p>Divisi: <strong style="color: var(--accent-blue);">{{ $student->careerPlacement->name ?? 'Belum Ditempatkan' }}</strong> | Program: {{ $student->registration->educationProgram->name ?? '-' }}</p>
            </div>
            <a href="{{ route('super-admin.career.reports') }}" class="btn-submit" style="box-shadow: var(--nm-flat-sm); background: var(--bg-primary); color: var(--text-secondary);">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Rapor
            </a>
        </header>

        @if(session('success'))
            <div class="dashboard-panel" style="padding: 1rem; color: var(--accent-green); font-weight: 800; margin-bottom: 1.5rem; box-shadow: var(--nm-inset-sm);">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="management-grid">
            <!-- Left Side Sub-Sidebar (Local tabs menu) -->
            <div class="sub-sidebar">
                <span class="sub-sidebar-title">Menu Navigasi</span>
                <a href="?tab=overview" class="sub-tab-btn {{ $activeTab === 'overview' ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie" style="width: 18px;"></i> Overview
                </a>
                
                <span class="sub-sidebar-title" style="margin-top: 1rem;">Konteks Karya</span>
                @foreach($contexts as $ctx)
                    <a href="?tab=context_{{ $ctx->id }}" class="sub-tab-btn {{ $activeTab === 'context_' . $ctx->id ? 'active' : '' }}">
                        <i class="fa-solid fa-folder" style="width: 18px;"></i> {{ $ctx->name }}
                    </a>
                @endforeach

                <span class="sub-sidebar-title" style="margin-top: 1rem;">Konteks Penghasilan</span>
                <a href="?tab=income" class="sub-tab-btn {{ $activeTab === 'income' ? 'active' : '' }}">
                    <i class="fa-solid fa-money-bill-wave" style="width: 18px;"></i> Penghasilan
                </a>
            </div>

            <!-- Right Side Content Panel -->
            <div class="content-panel">
                @if($activeTab === 'overview')
                    <h3 class="panel-title"><i class="fa-solid fa-chart-pie"></i> Ringkasan Karya & Penilaian</h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                        @forelse($summaries as $sum)
                            <div style="background: var(--bg-secondary); box-shadow: var(--nm-inset-sm); padding: 1.5rem; border-radius: 15px; border: 1.5px solid rgba(255,255,255,0.4); display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h4 style="font-weight: 900; font-size: 1.1rem; color: var(--accent-blue); margin-bottom: 0.25rem;">{{ $sum['context']->name }}</h4>
                                    <p style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 700;">Total Karya: {{ $sum['total_submissions'] }} item</p>
                                </div>
                                <a href="?tab=context_{{ $sum['context']->id }}" class="btn-submit" style="padding: 0.5rem 1rem; font-size: 0.75rem;">
                                    Buka Detail <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        @empty
                            <div style="text-align: center; color: var(--text-secondary); padding: 2rem; font-weight: 700;">Belum ada Konteks Karya yang dikonfigurasi.</div>
                        @endforelse
                    </div>

                    <h3 class="panel-title" style="margin-top: 2rem;"><i class="fa-solid fa-money-bill-wave"></i> Ringkasan Penghasilan</h3>
                    <div style="background: var(--bg-secondary); box-shadow: var(--nm-flat-sm); padding: 1.5rem; border-radius: 15px; border: 1.5px solid rgba(255,255,255,0.4); display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4 style="font-weight: 900; font-size: 1.1rem; color: var(--accent-green); margin-bottom: 0.25rem;">Total Penghasilan Santri</h4>
                            <p style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 700;">Akumulasi pendapatan selama Masa Berkarya</p>
                        </div>
                        <div style="font-size: 1.5rem; font-weight: 900; color: var(--accent-green);">
                            Rp {{ number_format($totalIncome, 0, ',', '.') }}
                        </div>
                    </div>

                @else
                    @if($activeTab === 'income')
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 2rem; align-items: start;">
                            <!-- List of incomes -->
                            <div>
                                <div style="background: var(--bg-secondary); box-shadow: var(--nm-flat-sm); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; border: 1.5px solid rgba(255,255,255,0.4);">
                                    <span style="font-weight: 800; color: var(--text-secondary); font-size: 0.85rem;">TOTAL PENGHASILAN</span>
                                    <span style="font-weight: 900; color: var(--accent-green); font-size: 1.25rem;">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
                                </div>

                                <h3 class="panel-title"><i class="fa-solid fa-list"></i> Daftar Penghasilan Santri</h3>
                                
                                @forelse($incomes as $inc)
                                    <div class="submission-card">
                                        <div class="submission-header">
                                            <h4 style="color: var(--accent-blue); font-weight: 800; font-size: 1rem;">{{ $inc->source }}</h4>
                                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                                <!-- Approval Checkbox/Form Toggle -->
                                                <form method="POST" action="{{ route('super-admin.career.reports.incomes.approve', $inc->id) }}" style="margin: 0; display: inline-flex; align-items: center;">
                                                    @csrf
                                                    <input type="hidden" name="is_approved" value="{{ $inc->is_approved ? '0' : '1' }}">
                                                    <button type="submit" class="btn-action-sm" style="color: {{ $inc->is_approved ? 'var(--accent-green)' : 'var(--text-secondary)' }}; margin-right: 0.5rem; font-size: 1.1rem;" title="{{ $inc->is_approved ? 'Batalkan Approval' : 'Approve Penghasilan' }}">
                                                        @if($inc->is_approved)
                                                            <i class="fa-solid fa-circle-check"></i>
                                                        @else
                                                            <i class="fa-regular fa-circle"></i>
                                                        @endif
                                                    </button>
                                                </form>

                                                <button class="btn-action-sm" style="color: var(--accent-blue);" onclick="editIncome({{ $inc->id }}, '{{ $inc->amount }}', '{{ $inc->source }}', '{{ $inc->date }}', '{{ $inc->notes }}')" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                                <form method="POST" action="{{ route('super-admin.career.reports.incomes.destroy', $inc->id) }}" onsubmit="return confirm('Hapus data penghasilan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action-sm" style="color: var(--accent-red);" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>

                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 0.5rem;">
                                            <div>
                                                <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 800;">Nominal</span>
                                                <div style="font-size: 0.95rem; font-weight: 800; color: var(--accent-green);">
                                                    Rp {{ number_format($inc->amount, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div>
                                                <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 800;">Tanggal</span>
                                                <div style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">
                                                    {{ \Carbon\Carbon::parse($inc->date)->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        </div>

                                        @if($inc->notes)
                                            <div style="border-top: 1px solid rgba(255,255,255,0.3); padding-top: 0.5rem; margin-top: 0.5rem;">
                                                <span style="font-size: 0.72rem; color: var(--text-secondary); font-weight: 800;">Catatan / Keterangan</span>
                                                <p style="font-size: 0.8rem; font-weight: 600; color: var(--text-secondary); margin-top: 0.15rem;">{{ $inc->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div style="text-align: center; color: var(--text-secondary); padding: 2.5rem; font-style: italic; font-weight: 700; box-shadow: var(--nm-inset-sm); border-radius: 12px;">Belum ada catatan penghasilan.</div>
                                @endforelse

                                {{-- Pagination --}}
                                @if($incomes && $incomes->total() > 0)
                                    <div class="pagination-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 1rem 0;">
                                        @if($incomes->onFirstPage())
                                            <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: not-allowed; opacity: 0.6;"><i class="fa-solid fa-chevron-left"></i></span>
                                        @else
                                            <a href="{{ $incomes->appends(request()->query())->previousPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; text-decoration: none;"><i class="fa-solid fa-chevron-left"></i></a>
                                        @endif

                                        @foreach($incomes->appends(request()->query())->getUrlRange(1, $incomes->lastPage()) as $page => $url)
                                            @if($page == $incomes->currentPage())
                                                <span class="pagination-btn active" style="box-shadow: var(--nm-inset-sm); color: var(--accent-blue); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; border: 2px solid var(--accent-blue);">{{ $page }}</span>
                                            @else
                                                <a href="{{ $url }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; text-decoration: none; font-weight: 700;">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        @if($incomes->hasMorePages())
                                            <a href="{{ $incomes->appends(request()->query())->nextPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; text-decoration: none;"><i class="fa-solid fa-chevron-right"></i></a>
                                        @else
                                            <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: not-allowed; opacity: 0.6;"><i class="fa-solid fa-chevron-right"></i></span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Right form to Add/Edit income -->
                            <div class="dashboard-panel" style="padding: 1.5rem; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 20px;">
                                <h3 class="panel-title" id="income-form-title"><i class="fa-solid fa-plus"></i> Input Penghasilan</h3>
                                <form id="income-form" method="POST" action="{{ route('super-admin.career.reports.incomes.store', $student->id) }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                                    @csrf
                                    <input type="hidden" name="_method" id="income-form-method" value="POST">

                                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Sumber Penghasilan</label>
                                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                            <input type="text" name="source" id="income_source" placeholder="Contoh: Gaji Magang PT. XYZ, Freelance Web" required style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                        </div>
                                    </div>

                                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Nominal (Rp)</label>
                                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                            <input type="text" name="amount" id="income_amount" placeholder="Rp 0" onkeyup="formatCurrencyInput(this)" required style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                        </div>
                                    </div>

                                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Tanggal Diterima</label>
                                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                            <input type="date" name="date" id="income_date" value="{{ date('Y-m-d') }}" required style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                        </div>
                                    </div>

                                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Keterangan / Catatan</label>
                                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                            <textarea name="notes" id="income_notes" rows="3" placeholder="Opsional" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%; resize: vertical;"></textarea>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn-submit" id="income-submit-btn" style="width: 100%; justify-content: center;">
                                            <i class="fa-solid fa-plus"></i> Simpan Data
                                        </button>
                                        <button type="button" class="btn-submit" id="income-cancel-btn" style="width: 100%; justify-content: center; margin-top: 0.5rem; display: none; background: transparent; box-shadow: var(--nm-flat-sm); color: var(--text-secondary);" onclick="resetIncomeForm()">
                                            Batal Edit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Dynamic Context Active Tab -->
                        @if($activeContext)
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 2rem; align-items: start;">
                            <!-- List of entries -->
                            <div>
                                <h3 class="panel-title"><i class="fa-solid fa-list-check"></i> Daftar Submisi Target Karya</h3>
                                
                                @forelse($submissions as $sub)
                                    <div class="submission-card">
                                        <div class="submission-header">
                                            <h4>Submisi #{{ $loop->iteration + (($submissions->currentPage() - 1) * $submissions->perPage()) }}</h4>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn-action-sm" style="color: var(--accent-blue);" onclick="editSubmission({{ $sub->id }}, {{ json_encode($sub->values) }}, '{{ $sub->score }}', '{{ $sub->notes }}')" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                                <form method="POST" action="{{ route('super-admin.career.reports.submissions.destroy', $sub->id) }}" onsubmit="return confirm('Hapus submisi karya ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action-sm" style="color: var(--accent-red);" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>

                                        <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1.25rem;">
                                            @foreach($sub->values as $val)
                                                <div>
                                                    <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 800;">{{ $val->field->label }}</span>
                                                    <div style="font-size: 0.85rem; font-weight: 700; margin-top: 0.15rem; color: var(--text-primary);">
                                                        @if($val->field->type === 'link' && $val->value)
                                                            <a href="{{ $val->value }}" target="_blank" style="color: var(--accent-blue); text-decoration: none;"><i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Link</a>
                                                        @elseif($val->field->type === 'multiple_images' && $val->value)
                                                            @php $imgs = json_decode($val->value, true); @endphp
                                                            @if(is_array($imgs) && count($imgs) > 0)
                                                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.25rem;">
                                                                    @foreach($imgs as $img)
                                                                        <img src="{{ $img }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; box-shadow: var(--nm-flat-sm);">
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <span style="color: var(--text-secondary); font-style: italic;">Tidak ada gambar</span>
                                                            @endif
                                                        @else
                                                            {{ $val->value ?? '-' }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Grading card form -->
                                        <form method="POST" action="{{ route('super-admin.career.reports.submissions.assess', $sub->id) }}" style="border-top: 1.5px solid rgba(255,255,255,0.4); padding-top: 1rem; display: grid; grid-template-columns: 120px 1fr 100px; gap: 1rem; align-items: flex-end;">
                                            @csrf
                                            <input type="hidden" name="score" value="0">
                                            <div class="input-group" style="margin-bottom: 0; flex-direction: row; align-items: center; gap: 0.5rem; height: 38px;">
                                                <input type="checkbox" name="score" value="1" id="approve_sub_{{ $sub->id }}" {{ $sub->score == 1 ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--accent-blue);">
                                                <label for="approve_sub_{{ $sub->id }}" style="cursor: pointer; margin-bottom: 0; font-size: 0.8rem; font-weight: 800;">Approved</label>
                                            </div>
                                            <div class="input-group" style="margin-bottom: 0;">
                                                <label>Feedback</label>
                                                <div class="input-wrapper" style="padding: 0.1rem 0.25rem;">
                                                    <input type="text" name="notes" value="{{ $sub->notes }}" placeholder="Tulis catatan..." style="padding: 0.25rem; font-size: 0.8rem;">
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn-submit" style="padding: 0.5rem; font-size: 0.7rem; height: 34px; width: 100%; justify-content: center;">
                                                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @empty
                                    <div style="text-align: center; color: var(--text-secondary); padding: 2rem; font-style: italic; font-weight: 700; box-shadow: var(--nm-inset-sm); border-radius: 12px;">Belum ada submisi karya pada konteks ini.</div>
                                @endforelse

                                <!-- Custom Pagination -->
                                @if($submissions && $submissions->total() > 0)
                                    <div class="pagination-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 1rem 0;">
                                        {{-- Previous Page Link --}}
                                        @if($submissions->onFirstPage())
                                            <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: not-allowed; opacity: 0.6;"><i class="fa-solid fa-chevron-left"></i></span>
                                        @else
                                            <a href="{{ $submissions->appends(request()->query())->previousPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; text-decoration: none;"><i class="fa-solid fa-chevron-left"></i></a>
                                        @endif

                                        {{-- Page list --}}
                                        @foreach($submissions->appends(request()->query())->getUrlRange(1, $submissions->lastPage()) as $page => $url)
                                            @if($page == $submissions->currentPage())
                                                <span class="pagination-btn active" style="box-shadow: var(--nm-inset-sm); color: var(--accent-blue); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; border: 2px solid var(--accent-blue);">{{ $page }}</span>
                                            @else
                                                <a href="{{ $url }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; text-decoration: none; font-weight: 700;">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if($submissions->hasMorePages())
                                            <a href="{{ $submissions->appends(request()->query())->nextPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; text-decoration: none;"><i class="fa-solid fa-chevron-right"></i></a>
                                        @else
                                            <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: not-allowed; opacity: 0.6;"><i class="fa-solid fa-chevron-right"></i></span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Right form to Add/Edit dynamic submission -->
                            <div class="dashboard-panel" style="padding: 1.5rem;">
                                <h3 class="panel-title" id="form-title"><i class="fa-solid fa-plus"></i> Input Karya Baru</h3>
                                <form id="submission-form" method="POST" action="{{ route('super-admin.career.reports.submissions.store', [$student->id, $activeContext->id]) }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
                                    @csrf
                                    <input type="hidden" name="_method" id="form-method" value="POST">

                                    @foreach($activeContext->fields as $f)
                                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                            <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">{{ $f->label }}</label>
                                            <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                                @if($f->type === 'multiple_images')
                                                    <input type="file" name="field_{{ $f->id }}[]" multiple accept="image/*" id="input_field_{{ $f->id }}" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; width: 100%;">
                                                    <div style="font-size: 0.7rem; color: var(--text-secondary); padding: 0.25rem 0.5rem; font-weight: 700;"><i class="fa-solid fa-circle-info"></i> Anda dapat memilih beberapa file gambar sekaligus.</div>
                                                @else
                                                    <input type="text" name="field_{{ $f->id }}" id="input_field_{{ $f->id }}" placeholder="{{ $f->placeholder }}" required style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Approval / Notes at submission creation -->
                                    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 1rem; align-items: center;">
                                        <input type="hidden" name="score" value="0">
                                        <div class="input-group" style="flex-direction: row; align-items: center; gap: 0.5rem; height: 38px; margin-top: 1rem;">
                                            <input type="checkbox" name="score" value="1" id="input_score" style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--accent-blue);">
                                            <label for="input_score" style="cursor: pointer; margin-bottom: 0; font-size: 0.8rem; font-weight: 800;">Approved</label>
                                        </div>
                                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                            <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Catatan Feedback</label>
                                            <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                                <input type="text" name="notes" id="input_notes" placeholder="Opsional" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn-submit" id="submit-btn" style="width: 100%; justify-content: center;">
                                            <i class="fa-solid fa-plus"></i> Simpan Karya
                                        </button>
                                        <button type="button" class="btn-submit" id="cancel-btn" style="width: 100%; justify-content: center; margin-top: 0.5rem; display: none; background: transparent; box-shadow: var(--nm-flat-sm); color: var(--text-secondary);" onclick="resetForm()">
                                            Batal Edit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </main>

    <script>
        // Edit Helper for dynamic submission form
        function editSubmission(id, values, score, notes) {
            document.getElementById('form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Karya';
            const form = document.getElementById('submission-form');
            form.action = `/super-admin/career/reports/submissions/${id}`;
            document.getElementById('form-method').value = 'PUT';

            // Fill basic score and notes
            document.getElementById('input_score').checked = score == 1;
            document.getElementById('input_notes').value = notes === 'null' ? '' : notes;

            // Fill each dynamic field value
            values.forEach(v => {
                const el = document.getElementById(`input_field_${v.career_target_field_id}`);
                if (el) {
                    if (el.type !== 'file') {
                        el.value = v.value || '';
                    }
                }
            });

            document.getElementById('submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
            document.getElementById('cancel-btn').style.display = 'block';
        }

        function resetForm() {
            document.getElementById('form-title').innerHTML = '<i class="fa-solid fa-plus"></i> Input Karya Baru';
            const form = document.getElementById('submission-form');
            form.action = "{{ route('super-admin.career.reports.submissions.store', [$student->id, $activeContext ? $activeContext->id : 0]) }}";
            document.getElementById('form-method').value = 'POST';

            document.getElementById('input_score').checked = false;
            document.getElementById('input_notes').value = '';

            // Reset dynamic inputs
            @if($activeContext)
                @foreach($activeContext->fields as $f)
                    const el_{{ $f->id }} = document.getElementById('input_field_{{ $f->id }}');
                    if (el_{{ $f->id }} && el_{{ $f->id }}.type !== 'file') {
                        el_{{ $f->id }}.value = '';
                    }
                @endforeach
            @endif

            document.getElementById('submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Simpan Karya';
            document.getElementById('cancel-btn').style.display = 'none';
        }

        // Intercept form submit to compress image files
        const submissionForm = document.getElementById('submission-form');
        if (submissionForm) {
            submissionForm.addEventListener('submit', async function(e) {
                // Prevent duplicate submit trigger
                if (submissionForm.dataset.submitting === 'true') return;
                e.preventDefault();
                
                const submitBtn = document.getElementById('submit-btn');
                const originalBtnHtml = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengompres Gambar...';
                
                const fileInputs = submissionForm.querySelectorAll('input[type="file"]');
                for (let input of fileInputs) {
                    if (input.files && input.files.length > 0) {
                        const dataTransfer = new DataTransfer();
                        for (let file of input.files) {
                            if (file.type.startsWith('image/')) {
                                const compressed = await compressImage(file);
                                dataTransfer.items.add(compressed);
                            } else {
                                dataTransfer.items.add(file);
                            }
                        }
                        // Assign compressed files back to input
                        input.files = dataTransfer.files;
                    }
                }
                
                submissionForm.dataset.submitting = 'true';
                submissionForm.submit();
            });
        }

        async function compressImage(file) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        let width = img.width;
                        let height = img.height;
                        
                        const MAX_WIDTH = 1000;
                        const MAX_HEIGHT = 1000;
                        
                        if (width > height) {
                            if (width > MAX_WIDTH) {
                                height *= MAX_WIDTH / width;
                                width = MAX_WIDTH;
                            }
                        } else {
                            if (height > MAX_HEIGHT) {
                                width *= MAX_HEIGHT / height;
                                height = MAX_HEIGHT;
                            }
                        }
                        
                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);
                        
                        canvas.toBlob((blob) => {
                            const compressedFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".jpg", {
                                type: 'image/jpeg',
                                lastModified: Date.now()
                            });
                            resolve(compressedFile);
                        }, 'image/jpeg', 0.7);
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        }

        // Submenu toggling
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });

        function editIncome(id, amount, source, date, notes) {
            document.getElementById('income-form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Penghasilan';
            const form = document.getElementById('income-form');
            form.action = `/super-admin/career/reports/incomes/${id}`;
            document.getElementById('income-form-method').value = 'PUT';

            document.getElementById('income_source').value = source;
            document.getElementById('income_amount').value = formatRupiah(amount);
            document.getElementById('income_date').value = date;
            document.getElementById('income_notes').value = notes === 'null' ? '' : notes;

            document.getElementById('income-submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
            document.getElementById('income-cancel-btn').style.display = 'block';
        }

        function resetIncomeForm() {
            document.getElementById('income-form-title').innerHTML = '<i class="fa-solid fa-plus"></i> Input Penghasilan';
            const form = document.getElementById('income-form');
            form.action = "{{ route('super-admin.career.reports.incomes.store', $student->id) }}";
            document.getElementById('income-form-method').value = 'POST';

            document.getElementById('income_source').value = '';
            document.getElementById('income_amount').value = '';
            document.getElementById('income_date').value = "{{ date('Y-m-d') }}";
            document.getElementById('income_notes').value = '';

            document.getElementById('income-submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Simpan Data';
            document.getElementById('income-cancel-btn').style.display = 'none';
        }

        function formatCurrencyInput(input) {
            let value = input.value.replace(/[^\d]/g, '');
            input.value = formatRupiah(value);
        }

        function formatRupiah(number) {
            if (!number) return '';
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number).replace('IDR', 'Rp').trim();
        }
    </script>
</body>
</html>
