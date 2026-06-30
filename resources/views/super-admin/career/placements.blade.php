<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Divisi Penempatan - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #e0e8f6;
            --bg-secondary: #f0f4f9;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --accent-blue: #3b82f6;
            --accent-red: #ef4444;
            --accent-green: #10b981;
            --font-main: 'Outfit', sans-serif;
            
            /* Neomorphism Shadows */
            --nm-flat-sm: 4px 4px 8px #beccd7, -4px -4px 8px #ffffff;
            --nm-flat-md: 8px 8px 16px #beccd7, -8px -8px 16px #ffffff;
            --nm-inset-sm: inset 4px 4px 8px #beccd7, inset -4px -4px 8px #ffffff;
            --nm-flat-hover: 5px 5px 10px #beccd7, -5px -5px 10px #ffffff;
            
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-main);
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

        /* Dashboard Grid Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 2rem;
            align-items: start;
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
            margin-bottom: 1.25rem;
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
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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

        /* Grid Cards */
        .grid-cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 15px;
            padding: 1.5rem;
            border: 1.5px solid rgba(255,255,255,0.5);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-primary);
        }

        /* Member List */
        .member-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .member-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0.75rem;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        /* Waiting list elements */
        .waiting-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 10px;
            margin-bottom: 0.75rem;
            font-weight: 700;
            font-size: 0.85rem;
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
            <h1>Penempatan Divisi Berkarya</h1>
            <p>Kelola divisi berkarya pengabdian santri, tentukan Penanggung Jawab (PJ) pengajar, dan tempatkan santri dari waiting list.</p>
        </header>

        @if(session('success'))
            <div class="dashboard-panel" style="padding: 1rem; color: var(--accent-green); font-weight: 800; margin-bottom: 1.5rem; box-shadow: var(--nm-inset-sm);">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="dashboard-grid">
            <!-- Left Side: Placements CRUD & Divisions Grid -->
            <div>
                <!-- Add Placement Form -->
                <div class="dashboard-panel" style="margin-bottom: 2rem;">
                    <h3 class="panel-title"><i class="fa-solid fa-plus"></i> Tambah Divisi Penempatan</h3>
                    <form method="POST" action="{{ route('super-admin.career.placements.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        <div class="input-group">
                            <label>Nama Divisi / Project</label>
                            <div class="input-wrapper">
                                <input type="text" name="name" required placeholder="Misal: Divisi Web Development / SIAPIT Project">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div class="input-group" style="position: relative; overflow: visible;">
                                <label>Penanggung Jawab (PJ)</label>
                                <div class="input-wrapper" style="position: relative;">
                                    <input type="hidden" name="mentor_name" id="form-mentor-name">
                                    <input type="text" id="mentor-search" placeholder="Cari PJ Pengajar..." autocomplete="off" onfocus="showMentorDropdown()" oninput="filterMentorDropdown()">
                                    <div id="mentor-dropdown" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 10px; max-height: 180px; overflow-y: auto; z-index: 1000; padding: 0.5rem 0;">
                                        @foreach($teachers as $t)
                                            <div class="dropdown-item" data-value="{{ $t->name }}" data-contact="{{ $t->whatsapp }}" data-search="{{ strtolower($t->name) }}" style="padding: 0.5rem 1rem; cursor: pointer; font-weight: 600; color: var(--text-primary);" onclick="selectMentor('{{ $t->name }}', '{{ $t->whatsapp }}')">{{ $t->name }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>No. WhatsApp Kontak</label>
                                <div class="input-wrapper">
                                    <input type="text" name="mentor_contact" id="form-mentor-contact" readonly placeholder="Terisi otomatis" style="background: rgba(0,0,0,0.02); cursor: not-allowed;">
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Deskripsi Divisi</label>
                            <div class="input-wrapper">
                                <textarea name="description" rows="2" placeholder="Tulis rincian tugas atau info divisi..."></textarea>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-plus"></i> Tambah Divisi
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Divisions Grid -->
                <div class="dashboard-panel">
                    <h3 class="panel-title"><i class="fa-solid fa-network-wired"></i> Daftar Divisi & Anggota</h3>
                    <div class="grid-cards">
                        @forelse($placements as $pl)
                            <div class="card">
                                <div class="card-header" style="margin-bottom: 0.5rem;">
                                    <h3>{{ $pl->name }}</h3>
                                    <form method="POST" action="{{ route('super-admin.career.placements.destroy', $pl->id) }}" onsubmit="return confirm('Hapus divisi ini? Semua anggota akan dikeluarkan kembali ke waiting list.')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-sm" style="color: var(--accent-red); width: 28px; height: 28px;" title="Hapus Divisi"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>

                                <div style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); display: flex; flex-direction: column; gap: 0.2rem; margin-bottom: 0.75rem; padding-bottom: 0.5rem; border-bottom: 1.5px solid rgba(255,255,255,0.4);">
                                    <span><i class="fa-solid fa-user-tie" style="color: var(--accent-blue); width: 18px;"></i> PJ: {{ $pl->mentor_name ?? '-' }}</span>
                                    <span><i class="fa-solid fa-phone" style="color: var(--accent-green); width: 18px;"></i> Kontak: {{ $pl->mentor_contact ?? '-' }}</span>
                                </div>

                                <ul class="member-list">
                                    @forelse($pl->students as $stud)
                                        <li class="member-item">
                                            <span>{{ $stud->registration->name }}</span>
                                            <form method="POST" action="{{ route('super-admin.career.placements.remove-student', $stud->id) }}" onsubmit="return confirm('Keluarkan dari divisi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-sm" style="color: var(--accent-red); width: 24px; height: 24px; box-shadow: var(--nm-flat-sm);" title="Keluarkan">
                                                    <i class="fa-solid fa-user-minus"></i>
                                                </button>
                                            </form>
                                        </li>
                                    @empty
                                        <li style="color: var(--text-secondary); font-size: 0.8rem; font-style: italic; text-align: center; padding: 0.5rem 0;">Belum ada anggota.</li>
                                    @endforelse
                                </ul>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 2rem; color: var(--text-secondary); font-weight: 600;">Belum ada divisi yang terdaftar.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Side: Waiting List & Assignment Action -->
            <div class="dashboard-panel" style="position: sticky; top: 2.5rem;">
                <h3 class="panel-title"><i class="fa-solid fa-clock-rotate-left"></i> Waiting List Santri</h3>
                <p style="font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 1rem; font-weight: 700;">Berikut adalah santri lulusan pendidikan utama yang belum ditempatkan ke divisi manapun.</p>

                <form method="POST" action="{{ route('super-admin.career.placements.assign-student') }}">
                    @csrf
                    <div style="max-height: 400px; overflow-y: auto; margin-bottom: 1.5rem; padding-right: 0.25rem;">
                        @forelse($waitingStudents as $ws)
                            <div class="waiting-item">
                                <input type="checkbox" name="student_ids[]" value="{{ $ws->id }}" id="wait_stud_{{ $ws->id }}" style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--accent-blue);">
                                <label for="wait_stud_{{ $ws->id }}" style="cursor: pointer; flex-grow: 1; display: flex; flex-direction: column;">
                                    <span>{{ $ws->registration->name }}</span>
                                    <span style="font-size: 0.75rem; color: var(--text-secondary);">Batch: {{ $ws->period->batch->name ?? '-' }}</span>
                                </label>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 2rem; color: var(--text-secondary); font-style: italic; font-weight: 600; box-shadow: var(--nm-inset-sm); border-radius: 12px;">Seluruh santri telah ditempatkan.</div>
                        @endforelse
                    </div>

                    @if($waitingStudents->count() > 0)
                        <div class="input-group" style="margin-bottom: 1rem;">
                            <label>Tujuan Divisi Penempatan</label>
                            <div class="input-wrapper">
                                <select name="career_placement_id" required>
                                    <option value="">-- Pilih Divisi --</option>
                                    @foreach($placements as $pl)
                                        <option value="{{ $pl->id }}">{{ $pl->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" style="width: 100%; justify-content: center; height: 42px;">
                            <i class="fa-solid fa-circle-arrow-right"></i> Tempatkan Santri Terpilih
                        </button>
                    @endif
                </form>
            </div>
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

        // Searchable Select Mentor PJ
        function showMentorDropdown() {
            document.getElementById('mentor-dropdown').style.display = 'block';
            const items = document.querySelectorAll('#mentor-dropdown .dropdown-item');
            items.forEach(i => i.style.display = 'block');
        }

        function filterMentorDropdown() {
            const query = document.getElementById('mentor-search').value.toLowerCase();
            const items = document.querySelectorAll('#mentor-dropdown .dropdown-item');
            items.forEach(item => {
                const val = item.getAttribute('data-search');
                if (val.includes(query)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function selectMentor(name, whatsapp) {
            document.getElementById('form-mentor-name').value = name;
            document.getElementById('mentor-search').value = name;
            document.getElementById('form-mentor-contact').value = whatsapp || '-';
            document.getElementById('mentor-dropdown').style.display = 'none';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#mentor-search') && !e.target.closest('#mentor-dropdown')) {
                const dropdown = document.getElementById('mentor-dropdown');
                if (dropdown) dropdown.style.display = 'none';
            }
        });
    </script>
</body>
</html>
