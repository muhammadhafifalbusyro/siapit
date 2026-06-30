<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Target Karya - SIAPIT</title>
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
            grid-template-columns: 1.1fr 1.4fr;
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

        /* Context Card block */
        .context-block {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1.5px solid rgba(255,255,255,0.5);
        }

        .context-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1.5px solid rgba(255,255,255,0.4);
        }

        .context-header h3 {
            font-size: 1.15rem;
            font-weight: 900;
            color: var(--accent-blue);
        }

        .field-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.65rem 1rem;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 10px;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            font-weight: 700;
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
            <h1>Target Karya</h1>
            <p>Manajemen pengelompokan konteks karya dan kolom form target karya dinamis untuk diisi oleh santri.</p>
        </header>

        @if(session('success'))
            <div class="dashboard-panel" style="padding: 1rem; color: var(--accent-green); font-weight: 800; margin-bottom: 1.5rem; box-shadow: var(--nm-inset-sm);">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="dashboard-grid">
            <!-- Left Side: CRUD Contexts and Fields -->
            <div>
                <!-- Form 1: Konteks Karya -->
                <div class="dashboard-panel" style="margin-bottom: 2rem;">
                    <h3 class="panel-title" id="context-form-title"><i class="fa-solid fa-folder-plus"></i> Tambah Konteks Karya</h3>
                    <form id="context-form" method="POST" action="{{ route('super-admin.career.target-contexts.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        <input type="hidden" name="_method" id="context-form-method" value="POST">
                        
                        <div class="input-group">
                            <label>Nama Konteks Karya</label>
                            <div class="input-wrapper">
                                <input type="text" name="name" id="context-name" required placeholder="Misal: PROYEK PERUSAHAAN / PROYEK MANDIRI">
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Keterangan / Kriteria</label>
                            <div class="input-wrapper">
                                <input type="text" name="description" id="context-description" placeholder="Keterangan singkat konteks karya">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn-submit" id="context-submit-btn">
                                <i class="fa-solid fa-plus"></i> Simpan Konteks
                            </button>
                            <button type="button" class="btn-submit" id="context-cancel-btn" style="display: none; background: transparent; box-shadow: var(--nm-flat-sm); color: var(--text-secondary); margin-left: 0.5rem;" onclick="resetContextForm()">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Form 2: Kolom Form Target Karya -->
                <div class="dashboard-panel">
                    <h3 class="panel-title" id="field-form-title"><i class="fa-solid fa-plus"></i> Tambah Kolom Form Target</h3>
                    <form id="field-form" method="POST" action="{{ route('super-admin.career.targets.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        <input type="hidden" name="_method" id="field-form-method" value="POST">
                        
                        <div class="input-group">
                            <label>Pilih Konteks Karya</label>
                            <div class="input-wrapper">
                                <select name="career_target_context_id" id="field-context-id" required>
                                    <option value="">-- Pilih Konteks --</option>
                                    @foreach($contexts as $ctx)
                                        <option value="{{ $ctx->id }}">{{ $ctx->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Nama Label Kolom</label>
                            <div class="input-wrapper">
                                <input type="text" name="label" id="field-label" required placeholder="Misal: Nama Proyek / Link GitHub">
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Placeholder</label>
                            <div class="input-wrapper">
                                <input type="text" name="placeholder" id="field-placeholder" placeholder="Misal: Tulis nama proyek yang Anda kerjakan">
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Tipe Inputan</label>
                            <div class="input-wrapper">
                                <select name="type" id="field-type" required>
                                    <option value="text">Text Biasa</option>
                                    <option value="link">Link URL</option>
                                    <option value="multiple_images">Upload Multiple Image</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn-submit" id="field-submit-btn">
                                <i class="fa-solid fa-plus"></i> Tambah Kolom
                            </button>
                            <button type="button" class="btn-submit" id="field-cancel-btn" style="display: none; background: transparent; box-shadow: var(--nm-flat-sm); color: var(--text-secondary); margin-left: 0.5rem;" onclick="resetFieldForm()">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side: Contexts and Fields List -->
            <div>
                @forelse($contexts as $ctx)
                    <div class="context-block">
                        <div class="context-header">
                            <div>
                                <h3>{{ $ctx->name }}</h3>
                                <p style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 700; margin-top: 0.15rem;">{{ $ctx->description ?? 'Tidak ada keterangan.' }}</p>
                            </div>
                             <div style="display: flex; gap: 0.5rem;">
                                <button class="btn-action-sm edit-context-btn" style="color: var(--accent-blue); width: 28px; height: 28px;" data-id="{{ $ctx->id }}" data-name="{{ $ctx->name }}" data-description="{{ $ctx->description }}" title="Edit Konteks"><i class="fa-solid fa-pen-to-square"></i></button>
                                <form method="POST" action="{{ route('super-admin.career.target-contexts.destroy', $ctx->id) }}" onsubmit="return confirm('Hapus Konteks ini? Semua field didalamnya juga akan terhapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-sm" style="color: var(--accent-red); width: 28px; height: 28px;" title="Hapus Konteks"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.75rem;">
                            @forelse($ctx->fields as $f)
                                <div class="field-row">
                                    <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                                        <span style="color: var(--text-primary); font-weight: 800;">{{ $f->label }}</span>
                                        <span style="font-size: 0.75rem; color: var(--text-secondary); font-style: italic;">Placeholder: "{{ $f->placeholder ?? '-' }}"</span>
                                        
                                        @if($f->type === 'text')
                                            <span style="font-size: 0.7rem; font-weight: 800; padding: 0.15rem 0.4rem; border-radius: 6px; background: #e0f2fe; color: #075985;"><i class="fa-solid fa-align-left"></i> Text</span>
                                        @elseif($f->type === 'link')
                                            <span style="font-size: 0.7rem; font-weight: 800; padding: 0.15rem 0.4rem; border-radius: 6px; background: #fef3c7; color: #92400e;"><i class="fa-solid fa-link"></i> Link URL</span>
                                        @else
                                            <span style="font-size: 0.7rem; font-weight: 800; padding: 0.15rem 0.4rem; border-radius: 6px; background: #d1fae5; color: #065f46;"><i class="fa-solid fa-images"></i> Images</span>
                                        @endif
                                    </div>
                                    <div style="display: flex; gap: 0.4rem;">
                                        <button class="btn-action-sm edit-field-btn" style="color: var(--accent-blue); width: 24px; height: 24px;" data-id="{{ $f->id }}" data-context-id="{{ $ctx->id }}" data-label="{{ $f->label }}" data-placeholder="{{ $f->placeholder }}" data-type="{{ $f->type }}" title="Edit Kolom"><i class="fa-solid fa-pen"></i></button>
                                        <form method="POST" action="{{ route('super-admin.career.targets.destroy', $f->id) }}" onsubmit="return confirm('Hapus kolom form ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-sm" style="color: var(--accent-red); width: 24px; height: 24px;" title="Hapus Kolom"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div style="text-align: center; font-size: 0.8rem; color: var(--text-secondary); font-style: italic; padding: 0.5rem 0;">Belum ada kolom form. Silakan buat form target untuk konteks ini.</div>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <div class="dashboard-panel" style="text-align: center; color: var(--text-secondary); padding: 3rem; font-weight: 700;">Belum ada Konteks Karya yang dibuat. Silakan tambahkan konteks di sebelah kiri.</div>
                @endforelse
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

        // Bind Edit Context Buttons
        document.querySelectorAll('.edit-context-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');
                editContext(id, name, description);
            });
        });

        // Bind Edit Field Buttons
        document.querySelectorAll('.edit-field-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const contextId = this.getAttribute('data-context-id');
                const label = this.getAttribute('data-label');
                const placeholder = this.getAttribute('data-placeholder');
                const type = this.getAttribute('data-type');
                editField(id, contextId, label, placeholder, type);
            });
        });

        // Context Form Edit Helper
        function editContext(id, name, description) {
            document.getElementById('context-form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Konteks Karya';
            const form = document.getElementById('context-form');
            form.action = `/super-admin/career/target-contexts/${id}`;
            document.getElementById('context-form-method').value = 'PUT';
            document.getElementById('context-name').value = name;
            document.getElementById('context-description').value = description === 'null' ? '' : description;
            document.getElementById('context-submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
            document.getElementById('context-cancel-btn').style.display = 'inline-flex';
        }

        function resetContextForm() {
            document.getElementById('context-form-title').innerHTML = '<i class="fa-solid fa-folder-plus"></i> Tambah Konteks Karya';
            const form = document.getElementById('context-form');
            form.action = "{{ route('super-admin.career.target-contexts.store') }}";
            document.getElementById('context-form-method').value = 'POST';
            document.getElementById('context-name').value = '';
            document.getElementById('context-description').value = '';
            document.getElementById('context-submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Simpan Konteks';
            document.getElementById('context-cancel-btn').style.display = 'none';
        }

        // Field Form Edit Helper
        function editField(id, contextId, label, placeholder, type) {
            document.getElementById('field-form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Kolom Form Target';
            const form = document.getElementById('field-form');
            form.action = `/super-admin/career/targets/${id}`;
            document.getElementById('field-form-method').value = 'PUT';
            document.getElementById('field-context-id').value = contextId;
            document.getElementById('field-label').value = label;
            document.getElementById('field-placeholder').value = placeholder === 'null' ? '' : placeholder;
            document.getElementById('field-type').value = type;
            document.getElementById('field-submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
            document.getElementById('field-cancel-btn').style.display = 'inline-flex';
        }

        function resetFieldForm() {
            document.getElementById('field-form-title').innerHTML = '<i class="fa-solid fa-plus"></i> Tambah Kolom Form Target';
            const form = document.getElementById('field-form');
            form.action = "{{ route('super-admin.career.targets.store') }}";
            document.getElementById('field-form-method').value = 'POST';
            document.getElementById('field-context-id').value = '';
            document.getElementById('field-label').value = '';
            document.getElementById('field-placeholder').value = '';
            document.getElementById('field-type').value = 'text';
            document.getElementById('field-submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Tambah Kolom';
            document.getElementById('field-cancel-btn').style.display = 'none';
        }
    </script>
</body>
</html>
