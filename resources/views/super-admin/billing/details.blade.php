<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Penagihan: {{ $category->name }} - SIAPIT</title>
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

        /* Dashboard Panel */
        .dashboard-panel {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        /* Filters Row */
        .filter-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            align-items: flex-end;
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
            padding: 0.25rem 0.5rem;
        }

        .input-wrapper select, .input-wrapper input {
            border: none;
            background: transparent;
            outline: none;
            padding: 0.5rem;
            font-size: 0.85rem;
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
            text-decoration: none;
        }

        .btn-action-sm:hover {
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

        /* Toast Styling */
        #toast-container {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .toast-nm {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            color: var(--text-primary);
            font-weight: 800;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid rgba(255,255,255,0.4);
            transform: translateX(120%);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .toast-nm.show {
            transform: translateX(0);
        }

        /* Details Grid inside Modal */
        .details-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 2rem;
            align-items: start;
        }

        .photo-sidebar {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .large-photo {
            width: 150px;
            height: 225px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: var(--nm-flat-sm);
        }

        .info-sections {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            max-height: 480px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        .info-group {
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 15px;
            padding: 1.25rem;
        }

        .info-group h4 {
            font-size: 0.95rem;
            font-weight: 900;
            color: var(--accent-blue);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            font-size: 0.85rem;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 700;
            color: var(--text-secondary);
        }

        .info-val {
            font-weight: 800;
            color: var(--text-primary);
        }

        .stage-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 800;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div id="toast-container"></div>

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
                <li class="has-submenu open">
                    <div class="submenu-trigger">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Tagihan
                        <i class="fa-solid fa-chevron-down arrow-icon"></i>
                    </div>
                    <ul class="submenu">
                        <li><a href="{{ route('super-admin.billing.overview') }}"><i class="fa-solid fa-chart-pie"></i> Overview</a></li>
                        <li class="active"><a href="{{ route('super-admin.billing.categories') }}"><i class="fa-solid fa-list"></i> List Tagihan</a></li>
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
                <h1>Detail Penagihan: {{ $category->name }}</h1>
                <p>Total Tagihan: <strong style="color: var(--accent-blue);">Rp {{ number_format($category->total_amount, 0, ',', '.') }}</strong> | Jumlah Termin Angsuran: {{ $category->installment_count }}x</p>
            </div>
            <a href="{{ route('super-admin.billing.categories') }}" class="btn-submit" style="background: var(--bg-primary); color: var(--text-secondary); box-shadow: var(--nm-flat-sm);">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </header>

        <div class="dashboard-panel">
            <!-- Filter Row -->
            <form method="GET" action="{{ route('super-admin.billing.categories.details', $category->id) }}" class="filter-row">
                <div class="input-group" style="width: 180px;">
                    <label>Program Pendidikan</label>
                    <div class="input-wrapper">
                        <select name="education_program_id" onchange="this.form.submit()">
                            <option value="all">Semua Program</option>
                            @foreach($programs as $p)
                                <option value="{{ $p->id }}" {{ $selectedProgramId == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="input-group" style="width: 180px;">
                    <label>Tahun Ajaran</label>
                    <div class="input-wrapper">
                        <select name="academic_year_id" onchange="this.form.submit()">
                            <option value="all">Semua Tahun</option>
                            @foreach($academicYears as $ay)
                                <option value="{{ $ay->id }}" {{ $selectedAcademicYearId == $ay->id ? 'selected' : '' }}>{{ $ay->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="input-group" style="width: 180px;">
                    <label>Gelombang / Batch</label>
                    <div class="input-wrapper">
                        <select name="batch_id" onchange="this.form.submit()">
                            <option value="all">Semua Batch</option>
                            @foreach($batches as $b)
                                <option value="{{ $b->id }}" {{ $selectedBatchId == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Santri</th>
                            <th>Data Santri</th>
                            
                            {{-- Dynamic installment columns headers --}}
                            @for($i = 1; $i <= $category->installment_count; $i++)
                                <th>Angsuran {{ $i }}</th>
                            @endfor

                            <th>Aktualisasi</th>
                            <th>Target</th>
                            <th>Persentase</th>
                            <th style="text-align: center;">Ditagih?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            @php
                                $studentPayments = $payments->get($student->id, collect());
                                $actualPaid = $studentPayments->sum('amount');
                                $billSetting = $studentBills->get($student->id);
                                $isBilled = $billSetting ? $billSetting->is_billed : false;
                                $percent = $isBilled ? ($category->total_amount > 0 ? ($actualPaid / $category->total_amount) * 100 : 0) : 0;
                            @endphp
                            <tr style="{{ !$isBilled ? 'opacity: 0.5;' : '' }}">
                                <td style="font-weight: 700;">{{ $student->name }}</td>
                                <td>
                                    <button class="btn-action-sm" style="color: var(--accent-blue);" onclick="viewStudentDetails({{ $student->id }})" title="Lihat Data Santri">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>

                                {{-- Dynamic installment input fields --}}
                                @for($i = 1; $i <= $category->installment_count; $i++)
                                    @php
                                        $pm = $studentPayments->firstWhere('installment_index', $i);
                                        $pmAmount = $pm ? $pm->amount : '';
                                    @endphp
                                    <td>
                                        <div class="input-wrapper" style="width: 110px; padding: 0.15rem 0.25rem;">
                                            <input type="text" 
                                                   class="installment-input"
                                                   value="{{ $pmAmount ? number_format($pmAmount, 0, ',', '.') : '' }}" 
                                                   placeholder="Rp 0" 
                                                   onblur="savePayment({{ $student->id }}, {{ $category->id }}, {{ $i }}, this.value)" 
                                                   {{ !$isBilled ? 'disabled' : '' }}
                                                   style="padding: 0.25rem; font-size: 0.8rem; font-weight: 700; width: 100%;">
                                        </div>
                                    </td>
                                @endfor

                                <td>
                                    <span id="actual-{{ $student->id }}" style="font-weight: 800; color: var(--accent-blue);">
                                        Rp {{ number_format($actualPaid, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="target-span" style="font-weight: 700; color: var(--text-secondary);">
                                        Rp {{ number_format($isBilled ? $category->total_amount : 0, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span id="percent-{{ $student->id }}" class="percent-span" style="font-weight: 800; color: {{ $percent >= 100 ? 'var(--accent-green)' : 'var(--text-secondary)' }};">
                                        {{ number_format($percent, 1) }}%
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; justify-content: center;">
                                        <input type="checkbox" 
                                               class="toggle-billed-checkbox" 
                                               data-student-id="{{ $student->id }}" 
                                               data-category-id="{{ $category->id }}"
                                               {{ $isBilled ? 'checked' : '' }} 
                                               style="width: 18px; height: 18px; cursor: pointer;">
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 6 + $category->installment_count }}" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Tidak ada data santri pada program/periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Custom Pagination -->
            @if($students && $students->total() > 0)
                <div class="pagination-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; width: 100%; border-top: 1px solid #d1d9e6; background: var(--bg-primary); margin-top: 1.5rem;">
                    {{-- Previous Page Link --}}
                    @if($students->onFirstPage())
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $students->appends(request()->query())->previousPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach($students->appends(request()->query())->getUrlRange(1, $students->lastPage()) as $page => $url)
                        @if($page == $students->currentPage())
                            <span class="pagination-btn active" style="box-shadow: var(--nm-inset-sm); color: var(--accent-blue); font-weight: 800; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 2.5px solid var(--accent-blue);">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); font-weight: 700; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($students->hasMorePages())
                        <a href="{{ $students->appends(request()->query())->nextPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
            @endif
        </div>
    </main>

    <!-- Detail Modal Overlay -->
    <div id="detail-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="dashboard-panel" style="width: 100%; max-width: 850px; padding: 2.5rem; display: flex; flex-direction: column; gap: 1.5rem; position: relative;">
            
            <button id="close-modal-btn" style="position: absolute; top: 1.5rem; right: 1.5rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 36px; height: 36px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onclick="closeModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;"><i class="fa-solid fa-user-check"></i> Detail Pendaftaran Santri</h3>
            
            <div class="details-grid">
                <!-- Left: Photo sidebar -->
                <div class="photo-sidebar">
                    <img id="detail-large-photo" src="" alt="Foto Formal 4x6" class="large-photo" style="display: none;">
                    <div id="detail-photo-placeholder" class="large-photo" style="display: flex; align-items: center; justify-content: center; color: var(--text-secondary); background: var(--bg-primary); box-shadow: var(--nm-inset-sm);">
                        <i class="fa-solid fa-user" style="font-size: 4rem;"></i>
                    </div>
                    <span id="detail-gender-badge" class="stage-badge" style="width: 100%; text-align: center;">-</span>
                </div>

                <!-- Right: Information sheets -->
                <div class="info-sections">
                    <div class="info-group">
                        <h4><i class="fa-solid fa-id-card"></i> Identitas Diri</h4>
                        <div class="info-row"><span class="info-label">Nama Lengkap</span><span class="info-val" id="detail-name">-</span></div>
                        <div class="info-row"><span class="info-label">Email</span><span class="info-val" id="detail-email">-</span></div>
                        <div class="info-row"><span class="info-label">No. WhatsApp</span><span class="info-val" id="detail-whatsapp">-</span></div>
                        <div class="info-row"><span class="info-label">Tempat Lahir</span><span class="info-val" id="detail-birthplace">-</span></div>
                        <div class="info-row"><span class="info-label">Tanggal Lahir</span><span class="info-val" id="detail-birthdate">-</span></div>
                        <div class="info-row"><span class="info-label">Usia</span><span class="info-val" id="detail-age">-</span></div>
                        <div class="info-row"><span class="info-label">Cita-cita</span><span class="info-val" id="detail-goals">-</span></div>
                        <div class="info-row"><span class="info-label">Hobi</span><span class="info-val" id="detail-hobbies">-</span></div>
                        <div class="info-row"><span class="info-label">Instagram</span><span class="info-val" id="detail-instagram">-</span></div>
                        <div class="info-row"><span class="info-label">Facebook</span><span class="info-val" id="detail-facebook">-</span></div>
                        <div class="info-row"><span class="info-label">Tokoh Idola</span><span class="info-val" id="detail-idol">-</span></div>
                        <div class="info-row"><span class="info-label">Provinsi Asal</span><span class="info-val" id="detail-region">-</span></div>
                        <div class="info-row"><span class="info-label">Alamat Lengkap</span><span class="info-val" id="detail-address">-</span></div>
                    </div>

                    <div class="info-group">
                        <h4><i class="fa-solid fa-graduation-cap"></i> Riwayat Pendidikan</h4>
                        <div class="info-row"><span class="info-label">Pendidikan Terakhir</span><span class="info-val" id="detail-education">-</span></div>
                        <div class="info-row"><span class="info-label">Sekolah Asal</span><span class="info-val" id="detail-school-name">-</span></div>
                        <div class="info-row"><span class="info-label">Jurusan Sekolah</span><span class="info-val" id="detail-school-major">-</span></div>
                        <div class="info-row"><span class="info-label">Pelajaran Disukai</span><span class="info-val" id="detail-favorite-subjects">-</span></div>
                        <div class="info-row"><span class="info-label">Prestasi</span><span class="info-val" id="detail-achievements">-</span></div>
                    </div>

                    <div class="info-group">
                        <h4><i class="fa-solid fa-users-rectangle"></i> Kondisi Keluarga & Ekonomi</h4>
                        <div class="info-row"><span class="info-label">Nama Wali</span><span class="info-val" id="detail-guardian-name">-</span></div>
                        <div class="info-row"><span class="info-label">Hubungan Keluarga</span><span class="info-val" id="detail-guardian-rel">-</span></div>
                        <div class="info-row"><span class="info-label">Pekerjaan Wali</span><span class="info-val" id="detail-guardian-occupation">-</span></div>
                        <div class="info-row"><span class="info-label">No. WhatsApp Wali</span><span class="info-val" id="detail-guardian-whatsapp">-</span></div>
                        <div class="info-row"><span class="info-label">Kondisi Orang Tua</span><span class="info-val" id="detail-parents-condition">-</span></div>
                        <div class="info-row"><span class="info-label">Gaji Orang Tua</span><span class="info-val" id="detail-parent-income">-</span></div>
                        <div class="info-row"><span class="info-label">Jumlah Saudara</span><span class="info-val" id="detail-sibling-count">-</span></div>
                    </div>

                    <div class="info-group">
                        <h4><i class="fa-solid fa-clipboard-question"></i> Kuesioner & Kesiapan Santri</h4>
                        <div class="info-row"><span class="info-label">Tahun Ajaran</span><span class="info-val" id="detail-academic-year">-</span></div>
                        <div class="info-row"><span class="info-label">Gelombang / Batch</span><span class="info-val" id="detail-batch">-</span></div>
                        <div class="info-row"><span class="info-label">Pilihan Program</span><span class="info-val" id="detail-program">-</span></div>
                        <div class="info-row"><span class="info-label">Pilihan Jurusan</span><span class="info-val" id="detail-major">-</span></div>
                        <div class="info-row"><span class="info-label">Kepemilikan Laptop</span><span class="info-val" id="detail-has-laptop">-</span></div>
                        <div class="info-row"><span class="info-label">Hafalan Al-Qur'an</span><span class="info-val" id="detail-quran-memorization">-</span></div>
                        <div class="info-row"><span class="info-label">3 Ustadz Favorit</span><span class="info-val" id="detail-favorite-ustadz">-</span></div>
                        <div class="info-row"><span class="info-label">Memiliki Pacar?</span><span class="info-val" id="detail-has-relationship">-</span></div>
                        <div class="info-row"><span class="info-label">Punya BPJS?</span><span class="info-val" id="detail-has-bpjs">-</span></div>
                        <div class="info-row"><span class="info-label">Apakah Merokok?</span><span class="info-val" id="detail-is-smoking">-</span></div>
                        <div class="info-row"><span class="info-label">Pernah Belajar IT?</span><span class="info-val" id="detail-learned-before">-</span></div>
                        <div class="info-row"><span class="info-label">Sumber Informasi</span><span class="info-val" id="detail-source-info">-</span></div>
                        <div class="info-row"><span class="info-label">Pengalaman Organisasi</span><span class="info-val" id="detail-organization">-</span></div>
                        <div class="info-row"><span class="info-label">Skill IT yang Dimiliki</span><span class="info-val" id="detail-it-skills">-</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Submenu toggling
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });

        // Toast Helper
        function showToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast-nm';
            toast.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--accent-green);"></i> <span>${message}</span>`;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }, 3000);
        }

        // Currency Formatter Helpers
        function formatCurrency(value) {
            let number = String(value).replace(/[^0-9]/g, '');
            if (number === '') return '';
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function parseCurrency(value) {
            return String(value).replace(/\./g, '');
        }

        // Apply formatting dynamically to all installment inputs
        document.querySelectorAll('.installment-input').forEach(input => {
            input.addEventListener('input', function() {
                this.value = formatCurrency(this.value);
            });
        });

        // AJAX toggle billed status
        document.querySelectorAll('.toggle-billed-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                const studentId = this.getAttribute('data-student-id');
                const categoryId = this.getAttribute('data-category-id');
                const isChecked = this.checked;

                fetch("{{ route('super-admin.billing.payments.toggle-billed') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        registration_id: studentId,
                        billing_category_id: categoryId,
                        is_billed: isChecked ? 1 : 0
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        
                        const row = this.closest('tr');
                        const inputs = row.querySelectorAll('.installment-input');
                        const targetSpan = row.querySelector('.target-span');
                        const percentSpan = row.querySelector('.percent-span');

                        if (isChecked) {
                            row.style.opacity = '1';
                            inputs.forEach(inp => inp.disabled = false);
                            
                            const actualPaid = parseFloat(parseCurrency(row.querySelector('[id^="actual-"]').innerText.replace('Rp', '').replace(/\s/g, '').trim()));
                            const categoryTotal = {{ $category->total_amount }};
                            const pct = categoryTotal > 0 ? (actualPaid / categoryTotal) * 100 : 0;
                            
                            targetSpan.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(categoryTotal);
                            percentSpan.innerText = pct.toFixed(1) + '%';
                            percentSpan.style.color = pct >= 100 ? 'var(--accent-green)' : 'var(--text-secondary)';
                        } else {
                            row.style.opacity = '0.5';
                            inputs.forEach(inp => inp.disabled = true);
                            targetSpan.innerText = 'Rp 0';
                            percentSpan.innerText = '0.0%';
                            percentSpan.style.color = 'var(--text-secondary)';
                        }
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Gagal memperbarui status tagihan.');
                });
            });
        });

        // AJAX save payment angsuran
        function savePayment(studentId, categoryId, index, amount) {
            // Clean value or set default to 0 using parseCurrency
            const cleanedAmount = amount === '' ? 0 : parseInt(parseCurrency(amount));

            fetch("{{ route('super-admin.billing.payments.save') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    registration_id: studentId,
                    billing_category_id: categoryId,
                    installment_index: index,
                    amount: cleanedAmount
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message);
                    
                    // Update Aktualisasi text
                    document.getElementById(`actual-${studentId}`).innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.total_paid);
                    
                    // Update Persentase text and color
                    const percentEl = document.getElementById(`percent-${studentId}`);
                    percentEl.innerText = data.percentage + '%';
                    if (parseFloat(data.percentage) >= 100) {
                        percentEl.style.color = 'var(--accent-green)';
                    } else {
                        percentEl.style.color = 'var(--text-secondary)';
                    }
                }
            })
            .catch(err => {
                console.error(err);
                alert('Gagal menyimpan nominal angsuran.');
            });
        }

        // Modal View Student Details via AJAX
        const modalOverlay = document.getElementById('detail-modal-overlay');
        
        function viewStudentDetails(studentId) {
            fetch(`/super-admin/billing/registration/${studentId}/details`)
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    const data = res.data;
                    
                    // Set Photo
                    const largePhoto = document.getElementById('detail-large-photo');
                    const photoPlaceholder = document.getElementById('detail-photo-placeholder');
                    if (data.photo) {
                        largePhoto.src = data.photo.startsWith('http') || data.photo.startsWith('/') ? data.photo : '/storage/' + data.photo;
                        largePhoto.style.display = 'block';
                        photoPlaceholder.style.display = 'none';
                    } else {
                        largePhoto.style.display = 'none';
                        photoPlaceholder.style.display = 'flex';
                    }

                    // Gender badge
                    const genderBadge = document.getElementById('detail-gender-badge');
                    if (data.gender === 'L' || data.gender === 'Laki-laki') {
                        genderBadge.textContent = 'Laki-laki';
                        genderBadge.style.background = '#dbeafe';
                        genderBadge.style.color = '#1e40af';
                    } else {
                        genderBadge.textContent = 'Perempuan';
                        genderBadge.style.background = '#fce7f3';
                        genderBadge.style.color = '#9d174d';
                    }

                    // Text inputs
                    document.getElementById('detail-name').textContent = data.name || '-';
                    document.getElementById('detail-email').textContent = data.email || '-';
                    document.getElementById('detail-whatsapp').textContent = data.whatsapp || '-';
                    document.getElementById('detail-birthplace').textContent = data.birthplace || '-';
                    document.getElementById('detail-birthdate').textContent = data.birthdate || '-';
                    document.getElementById('detail-age').textContent = (res.age ? res.age + ' Tahun' : '-');
                    document.getElementById('detail-goals').textContent = data.goals || '-';
                    document.getElementById('detail-hobbies').textContent = data.hobbies || '-';
                    document.getElementById('detail-instagram').textContent = data.instagram || '-';
                    document.getElementById('detail-facebook').textContent = data.facebook || '-';
                    document.getElementById('detail-idol').textContent = data.idol || '-';
                    document.getElementById('detail-region').textContent = data.region || '-';
                    document.getElementById('detail-address').textContent = data.address || '-';

                    document.getElementById('detail-education').textContent = data.last_education || '-';
                    document.getElementById('detail-school-name').textContent = data.school_name || '-';
                    document.getElementById('detail-school-major').textContent = data.school_major || '-';
                    document.getElementById('detail-favorite-subjects').textContent = data.favorite_subjects || '-';
                    document.getElementById('detail-achievements').textContent = data.achievements || '-';

                    document.getElementById('detail-guardian-name').textContent = data.guardian_name || '-';
                    document.getElementById('detail-guardian-rel').textContent = data.guardian_relationship || '-';
                    document.getElementById('detail-guardian-occupation').textContent = data.guardian_occupation || '-';
                    document.getElementById('detail-guardian-whatsapp').textContent = data.guardian_whatsapp || '-';
                    document.getElementById('detail-parents-condition').textContent = data.parents_condition || '-';
                    document.getElementById('detail-parent-income').textContent = data.parent_income || '-';
                    document.getElementById('detail-sibling-count').textContent = (data.sibling_count ? data.sibling_count + ' orang' : '-');

                    const ay = data.academic_year || data.academicYear;
                    document.getElementById('detail-academic-year').textContent = (ay ? ay.name : '-');
                    
                    const bt = data.batch;
                    document.getElementById('detail-batch').textContent = (bt ? bt.name : '-');
                    
                    const pr = data.education_program || data.educationProgram;
                    document.getElementById('detail-program').textContent = (pr ? pr.name : '-');
                    
                    const mj = data.major;
                    document.getElementById('detail-major').textContent = (mj ? mj.name : '-');
                    
                    document.getElementById('detail-has-laptop').textContent = data.has_laptop || '-';
                    document.getElementById('detail-quran-memorization').textContent = data.quran_memorization || '-';
                    document.getElementById('detail-favorite-ustadz').textContent = data.favorite_ustadz || '-';
                    document.getElementById('detail-has-relationship').textContent = data.has_relationship || '-';
                    document.getElementById('detail-has-bpjs').textContent = data.has_bpjs || '-';
                    document.getElementById('detail-is-smoking').textContent = data.is_smoking || '-';
                    document.getElementById('detail-learned-before').textContent = data.learned_before || '-';
                    document.getElementById('detail-source-info').textContent = data.source_info || '-';
                    document.getElementById('detail-organization').textContent = data.organization_experience || '-';
                    document.getElementById('detail-it-skills').textContent = data.it_skills || '-';

                    modalOverlay.style.display = 'flex';
                }
            });
        }

        function closeModal() {
            modalOverlay.style.display = 'none';
        }

        // Close on clicking overlay background
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) closeModal();
        });
    </script>
</body>
</html>
