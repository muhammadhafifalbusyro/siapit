<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pendaftaran - SIAPIT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        .stage-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            box-shadow: var(--nm-inset-sm);
        }
        .stage-administrasi {
            color: var(--accent-blue);
        }
        .stage-wawancara {
            color: var(--accent-purple);
        }
        .stage-penerimaan {
            color: var(--accent-teal);
        }
        .stage-ditolak {
            color: var(--accent-red);
        }
        .avatar-frame {
            width: 45px;
            height: 67px;
            border-radius: 6px;
            object-fit: cover;
            box-shadow: var(--nm-flat-sm);
            border: 2px solid var(--bg-primary);
        }
        .avatar-placeholder {
            width: 45px;
            height: 67px;
            border-radius: 6px;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 1.2rem;
        }
        /* Details Grid inside Modal */
        .details-grid {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 2rem;
        }
        @media (max-width: 768px) {
            .details-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
        .photo-sidebar {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        .large-photo {
            width: 150px;
            height: 225px; /* 4x6 Aspect Ratio */
            object-fit: cover;
            border-radius: 12px;
            box-shadow: var(--nm-flat);
            border: 4px solid var(--bg-primary);
        }
        .info-sections {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            max-height: 60vh;
            overflow-y: auto;
            padding-right: 0.75rem;
        }
        /* Custom scrollbar for info sections */
        .info-sections::-webkit-scrollbar {
            width: 6px;
        }
        .info-sections::-webkit-scrollbar-track {
            background: var(--bg-primary);
            border-radius: 10px;
            box-shadow: var(--nm-inset-sm);
        }
        .info-sections::-webkit-scrollbar-thumb {
            background: var(--text-secondary);
            border-radius: 10px;
        }
        .info-group {
            margin-bottom: 0.5rem;
        }
        .info-group h4 {
            font-family: var(--font-heading);
            font-size: 1rem;
            font-weight: 800;
            color: var(--accent-blue);
            margin-bottom: 0.75rem;
            border-bottom: 2px solid var(--bg-primary);
            padding-bottom: 0.25rem;
        }
        .info-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 1rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        .info-label {
            color: var(--text-secondary);
            font-weight: 600;
        }
        .info-val {
            color: var(--text-primary);
            font-weight: 700;
            word-break: break-word;
        }
        /* Action buttons with Neumorphism */
        .action-button-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 0.5rem;
            width: 100%;
        }
        .btn-nm {
            border: none;
            background: var(--bg-primary);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--nm-flat-sm);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-nm:hover {
            box-shadow: var(--nm-flat-hover);
        }
        .btn-nm:active {
            box-shadow: var(--nm-inset-sm);
        }
        .btn-nm-success {
            color: var(--accent-teal);
        }
        .btn-nm-danger {
            color: var(--accent-red);
        }
        .btn-nm-secondary {
            color: var(--text-secondary);
        }
        .btn-nm-primary {
            color: var(--accent-blue);
        }
        /* Search and Filter panel */
        .filter-panel {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: center;
            width: 100%;
        }
        .search-input-wrapper {
            position: relative;
            flex-grow: 1;
        }
        .search-input-wrapper i {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }
        .search-input-nm {
            width: 100%;
            border: none;
            outline: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            padding: 0.85rem 1rem 0.85rem 2.75rem;
            border-radius: 12px;
            font-family: var(--font-body);
            color: var(--text-primary);
            font-weight: 600;
            transition: var(--transition);
        }
        .search-input-nm:focus {
            box-shadow: var(--nm-flat-sm);
        }
        .wa-link {
            color: #25D366;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            box-shadow: var(--nm-flat-sm);
            transition: var(--transition);
        }
        .wa-link:hover {
            box-shadow: var(--nm-flat-hover);
            transform: translateY(-1px);
        }
        .wa-link:active {
            box-shadow: var(--nm-inset-sm);
        }
    </style>
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
                    <h1>
                        @if($activeTab == 'administrasi')
                            Tahap Administrasi
                        @elseif($activeTab == 'wawancara')
                            Tahap Wawancara
                        @else
                            Tahap Penerimaan & Seleksi
                        @endif
                    </h1>
                    <p>
                        @if($activeTab == 'administrasi')
                            Daftar santri yang baru mendaftar dan menunggu verifikasi berkas administrasi.
                        @elseif($activeTab == 'wawancara')
                            Daftar santri yang lolos administrasi dan sedang dalam proses wawancara.
                        @else
                            Hasil seleksi akhir penerimaan santri baru Pondok IT.
                        @endif
                    </p>
                </div>
            </header>
            
            <!-- Toast Container -->
            <div id="toast-container" style="position: fixed; bottom: 2rem; right: 2rem; display: flex; flex-direction: column; gap: 0.75rem; z-index: 9999; pointer-events: none;"></div>

            <!-- Filters Row -->
            <form method="GET" action="{{ route(Route::currentRouteName()) }}" style="display: flex; gap: 1.5rem; flex-wrap: wrap; align-items: flex-end; margin-bottom: 2rem; padding: 1.5rem; border-radius: 20px; box-shadow: var(--nm-flat); border: 1.5px solid rgba(255,255,255,0.4); background: var(--bg-primary);">
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

            <!-- Search & Filter -->
            <div class="filter-panel">
                <div class="search-input-wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="search-santri" class="search-input-nm" placeholder="Cari nama santri, daerah asal, program...">
                </div>
            </div>

            <!-- Content Panel -->
            <div class="card-nm" style="width: 100%;">
                <h3 class="panel-title">
                    <i class="fa-solid fa-list-check"></i> 
                    Daftar Calon Santri ({{ count($registrations) }})
                </h3>
                
                <div class="table-container">
                    <table id="registrations-table">
                        <thead>
                            <tr>
                                <th style="width: 70px; text-align: center;">Foto 4x6</th>
                                <th>Nama Lengkap</th>
                                <th>Program / Jurusan</th>
                                <th>Daerah Asal</th>
                                <th>No. WhatsApp</th>
                                <th>Pembayaran</th>
                                @if($activeTab == 'penerimaan')
                                    <th>Status Akhir</th>
                                @endif
                                <th style="width: 120px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registrations as $reg)
                                <tr id="reg-row-{{ $reg->id }}" class="registration-row" data-name="{{ strtolower($reg->name) }}" data-region="{{ strtolower($reg->region) }}" data-program="{{ strtolower($reg->educationProgram->name ?? '') }} {{ strtolower($reg->major->name ?? '') }}">
                                    <td style="text-align: center;">
                                        @if($reg->photo)
                                            <img src="{{ asset('storage/' . $reg->photo) }}" alt="Foto 4x6" class="avatar-frame">
                                        @else
                                            <div class="avatar-placeholder">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text-primary);">{{ $reg->name }}</div>
                                        <div style="font-size: 0.8rem; color: var(--text-secondary);">
                                            {{ $reg->gender == 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}, {{ $reg->age }} Tahun
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text-primary);">{{ $reg->educationProgram->name ?? '-' }}</div>
                                        <div style="font-size: 0.8rem; color: var(--accent-blue); font-weight: 600;">{{ $reg->major->name ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--text-primary);">{{ $reg->region ?? '-' }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $cleanWa = preg_replace('/[^0-9]/', '', $reg->whatsapp);
                                            if (str_starts_with($cleanWa, '0')) {
                                                $cleanWa = '62' . substr($cleanWa, 1);
                                            }
                                        @endphp
                                        <a href="https://wa.me/{{ $cleanWa }}?text=Halo%20{{ urlencode($reg->name) }}%2C%20kami%20dari%20Pondok%20IT..." target="_blank" class="wa-link">
                                            <i class="fa-brands fa-whatsapp"></i> +{{ $cleanWa }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($reg->payment_status == 'paid')
                                            <span class="stage-badge stage-penerimaan" style="background: #d1fae5; color: #065f46;"><i class="fa-solid fa-circle-check"></i> Lunas</span>
                                        @else
                                            <span class="stage-badge stage-ditolak" style="background: #fee2e2; color: #991b1b;"><i class="fa-solid fa-clock"></i> Pending</span>
                                        @endif
                                    </td>
                                    @if($activeTab == 'penerimaan')
                                        <td>
                                            <span class="stage-badge stage-{{ $reg->status }}">
                                                {{ $reg->status == 'penerimaan' ? 'Diterima' : 'Ditolak' }}
                                            </span>
                                        </td>
                                    @endif
                                    <td style="text-align: center;">
                                        <button class="btn-nm btn-nm-primary detail-btn" 
                                                data-id="{{ $reg->id }}"
                                                data-payment-status="{{ $reg->payment_status }}"
                                                data-academic-year="{{ $reg->academicYear->name ?? '-' }}"
                                                data-batch="{{ $reg->batch->name ?? '-' }}"
                                                data-name="{{ $reg->name }}"
                                                data-email="{{ $reg->email }}"
                                                data-whatsapp="+{{ $cleanWa }}"
                                                data-birthplace="{{ $reg->birthplace }}"
                                                data-birthdate="{{ $reg->birthdate ? date('d F Y', strtotime($reg->birthdate)) : '-' }}"
                                                data-gender="{{ $reg->gender }}"
                                                data-age="{{ $reg->age }}"
                                                data-region="{{ $reg->region }}"
                                                data-address="{{ $reg->address }}"
                                                data-education="{{ $reg->last_education }}"
                                                data-program="{{ $reg->educationProgram->name ?? '-' }}"
                                                data-major="{{ $reg->major->name ?? '-' }}"
                                                data-guardian-name="{{ $reg->guardian_name }}"
                                                data-guardian-rel="{{ $reg->guardian_relationship }}"
                                                data-guardian-whatsapp="{{ $reg->guardian_whatsapp }}"
                                                data-guardian-occupation="{{ $reg->guardian_occupation }}"
                                                data-photo="{{ $reg->photo ? asset('storage/' . $reg->photo) : '' }}"
                                                data-status="{{ $reg->status }}"
                                                
                                                data-goals="{{ $reg->goals }}"
                                                data-hobbies="{{ $reg->hobbies }}"
                                                data-instagram="{{ $reg->instagram }}"
                                                data-facebook="{{ $reg->facebook }}"
                                                data-organization="{{ $reg->organization_experience }}"
                                                data-school-name="{{ $reg->school_name }}"
                                                data-school-major="{{ $reg->school_major }}"
                                                data-achievements="{{ $reg->achievements }}"
                                                data-parents-condition="{{ $reg->parents_condition }}"
                                                data-parent-income="{{ $reg->parent_income }}"
                                                data-sibling-count="{{ $reg->sibling_count }}"
                                                data-has-laptop="{{ $reg->has_laptop }}"
                                                data-quran-memorization="{{ $reg->quran_memorization }}"
                                                data-favorite-ustadz="{{ $reg->favorite_ustadz }}"
                                                data-has-relationship="{{ $reg->has_relationship }}"
                                                data-source-info="{{ $reg->source_info }}"
                                                data-has-bpjs="{{ $reg->has_bpjs }}"
                                                data-idol="{{ $reg->idol }}"
                                                data-is-smoking="{{ $reg->is_smoking }}"
                                                data-learned-before="{{ $reg->learned_before }}"
                                                data-it-skills="{{ $reg->it_skills }}"
                                                data-favorite-subjects="{{ $reg->favorite_subjects }}">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-row">
                                    <td colspan="{{ $activeTab == 'penerimaan' ? 8 : 7 }}" style="text-align: center; color: var(--text-secondary); padding: 3rem;">
                                        <i class="fa-solid fa-folder-open" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; color: var(--text-secondary);"></i>
                                        Tidak ada calon santri pada tahap ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination UI -->
                <div class="pagination-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; width: 100%; border-top: 1px solid #d1d9e6; background: var(--bg-primary);">
                    {{-- Previous Page Link --}}
                    @if($registrations->onFirstPage())
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $registrations->previousPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach($registrations->getUrlRange(1, $registrations->lastPage()) as $page => $url)
                        @if($page == $registrations->currentPage())
                            <span class="pagination-btn active" style="box-shadow: var(--nm-inset-sm); color: var(--accent-blue); font-weight: 800; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 2.5px solid var(--accent-blue);">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); font-weight: 700; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($registrations->hasMorePages())
                        <a href="{{ $registrations->nextPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Detail Modal Overlay -->
    <div id="detail-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 850px; padding: 2.5rem; display: flex; flex-direction: column; gap: 1.5rem; position: relative;">
            
            <button id="close-modal-btn" style="position: absolute; top: 1.5rem; right: 1.5rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 36px; height: 36px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; transition: var(--transition);">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h3 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;"><i class="fa-solid fa-user-check"></i> Detail Pendaftaran Santri</h3>
            
            <div class="details-grid">
                <!-- Left: 4x6 photo frame -->
                <div class="photo-sidebar">
                    <img id="detail-large-photo" src="" alt="Foto Formal 4x6" class="large-photo" style="display: none;">
                    <div id="detail-photo-placeholder" class="large-photo" style="display: flex; align-items: center; justify-content: center; color: var(--text-secondary); background: var(--bg-primary); box-shadow: var(--nm-inset);">
                        <i class="fa-solid fa-user" style="font-size: 4rem;"></i>
                    </div>
                    <span id="detail-gender-badge" class="stage-badge" style="width: 100%; text-align: center;">-</span>
                </div>

                <!-- Right: Comprehensive Data Sheets -->
                <div class="info-sections">
                    <!-- Identitas Diri & Sosial -->
                    <div class="info-group">
                        <h4><i class="fa-solid fa-id-card"></i> Identitas Diri & Sosial</h4>
                        <div class="info-row">
                            <span class="info-label">Nama Lengkap</span>
                            <span class="info-val" id="detail-name">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-val" id="detail-email">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">No. WhatsApp</span>
                            <span class="info-val" id="detail-whatsapp">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status Pembayaran</span>
                            <span class="info-val" id="detail-payment-status">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tempat Lahir</span>
                            <span class="info-val" id="detail-birthplace">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tanggal Lahir</span>
                            <span class="info-val" id="detail-birthdate">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Usia</span>
                            <span class="info-val" id="detail-age">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Cita-cita</span>
                            <span class="info-val" id="detail-goals">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Hobi</span>
                            <span class="info-val" id="detail-hobbies">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Instagram</span>
                            <span class="info-val" id="detail-instagram">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Facebook</span>
                            <span class="info-val" id="detail-facebook">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tokoh Idola</span>
                            <span class="info-val" id="detail-idol">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Provinsi Asal</span>
                            <span class="info-val" id="detail-region">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Alamat Lengkap</span>
                            <span class="info-val" id="detail-address">-</span>
                        </div>
                    </div>

                    <!-- Riwayat Pendidikan -->
                    <div class="info-group">
                        <h4><i class="fa-solid fa-graduation-cap"></i> Riwayat Pendidikan</h4>
                        <div class="info-row">
                            <span class="info-label">Pendidikan Terakhir</span>
                            <span class="info-val" id="detail-education">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Sekolah Asal</span>
                            <span class="info-val" id="detail-school-name">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Jurusan Sekolah</span>
                            <span class="info-val" id="detail-school-major">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pelajaran Disukai</span>
                            <span class="info-val" id="detail-favorite-subjects">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Prestasi</span>
                            <span class="info-val" id="detail-achievements">-</span>
                        </div>
                    </div>

                    <!-- Keluarga & Ekonomi -->
                    <div class="info-group">
                        <h4><i class="fa-solid fa-users-rectangle"></i> Kondisi Keluarga & Ekonomi</h4>
                        <div class="info-row">
                            <span class="info-label">Nama Wali</span>
                            <span class="info-val" id="detail-guardian-name">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Hubungan</span>
                            <span class="info-val" id="detail-guardian-rel">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">WhatsApp Wali</span>
                            <span class="info-val" id="detail-guardian-whatsapp">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pekerjaan Wali</span>
                            <span class="info-val" id="detail-guardian-occupation">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Kondisi Orang Tua</span>
                            <span class="info-val" id="detail-parents-condition">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Gaji Orang Tua</span>
                            <span class="info-val" id="detail-parent-income">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Jumlah Saudara</span>
                            <span class="info-val" id="detail-sibling-count">-</span>
                        </div>
                    </div>

                    <!-- Kuesioner & Kesiapan Santri -->
                    <div class="info-group">
                        <h4><i class="fa-solid fa-clipboard-question"></i> Kuesioner & Kesiapan Santri</h4>
                        <div class="info-row">
                            <span class="info-label">Tahun Ajaran</span>
                            <span class="info-val" id="detail-academic-year">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Gelombang / Batch</span>
                            <span class="info-val" id="detail-batch">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pilihan Program</span>
                            <span class="info-val" id="detail-program">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pilihan Jurusan</span>
                            <span class="info-val" id="detail-major">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Kepemilikan Laptop</span>
                            <span class="info-val" id="detail-has-laptop">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Hafalan Al-Qur'an</span>
                            <span class="info-val" id="detail-quran-memorization">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">3 Ustadz Favorit</span>
                            <span class="info-val" id="detail-favorite-ustadz">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Memiliki Pacar?</span>
                            <span class="info-val" id="detail-has-relationship">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Punya BPJS?</span>
                            <span class="info-val" id="detail-has-bpjs">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Apakah Merokok?</span>
                            <span class="info-val" id="detail-is-smoking">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pernah Belajar IT?</span>
                            <span class="info-val" id="detail-learned-before">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Sumber Informasi</span>
                            <span class="info-val" id="detail-source-info">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pengalaman Organisasi</span>
                            <span class="info-val" id="detail-organization">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Skill IT yang Dimiliki</span>
                            <span class="info-val" id="detail-it-skills">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Buttons Footer -->
            <div class="action-button-group" id="modal-actions-container">
                <!-- Dynamically populated buttons based on current stage -->
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Submenu Toggle logic
            const triggers = document.querySelectorAll('.submenu-trigger');
            triggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const parent = trigger.parentElement;
                    parent.classList.toggle('open');
                });
            });

            // Live search
            const searchInput = document.getElementById('search-santri');
            const rows = document.querySelectorAll('.registration-row');
            
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;
                
                rows.forEach(row => {
                    const name = row.getAttribute('data-name');
                    const region = row.getAttribute('data-region');
                    const program = row.getAttribute('data-program');
                    
                    if (name.includes(query) || region.includes(query) || program.includes(query)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Handle empty table row logic dynamically
                let emptyRow = document.getElementById('empty-row');
                if (visibleCount === 0) {
                    if (!emptyRow) {
                        const tbody = document.querySelector('#registrations-table tbody');
                        const colSpan = {{ $activeTab == 'penerimaan' ? 7 : 6 }};
                        emptyRow = document.createElement('tr');
                        emptyRow.id = 'empty-row';
                        emptyRow.innerHTML = `<td colspan="${colSpan}" style="text-align: center; color: var(--text-secondary); padding: 3rem;"><i class="fa-solid fa-folder-open" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; color: var(--text-secondary);"></i>Hasil pencarian tidak ditemukan.</td>`;
                        tbody.appendChild(emptyRow);
                    } else {
                        emptyRow.style.display = '';
                    }
                } else {
                    if (emptyRow) {
                        emptyRow.style.display = 'none';
                    }
                }
            });

            // Toast helper
            const toastContainer = document.getElementById('toast-container');
            const showToast = (message, type = 'success') => {
                const toast = document.createElement('div');
                toast.style.pointerEvents = 'auto';
                toast.style.minWidth = '300px';
                toast.style.background = 'var(--bg-primary)';
                toast.style.boxShadow = 'var(--nm-flat-sm)';
                toast.style.padding = '1rem 1.5rem';
                toast.style.borderRadius = '12px';
                toast.style.display = 'flex';
                toast.style.alignItems = 'center';
                toast.style.gap = '0.75rem';
                toast.style.fontWeight = '700';
                toast.style.fontSize = '0.9rem';
                toast.style.borderLeft = `5px solid ${type === 'success' ? 'var(--accent-teal)' : 'var(--accent-red)'}`;
                toast.style.color = type === 'success' ? 'var(--accent-teal)' : 'var(--accent-red)';
                toast.style.transition = 'all 0.3s ease';
                toast.style.transform = 'translateY(20px)';
                toast.style.opacity = '0';
                
                toast.innerHTML = `
                    <i class="fa-solid ${type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'}"></i>
                    <span style="flex-grow: 1; color: var(--text-primary);">${message}</span>
                `;
                
                toastContainer.appendChild(toast);
                setTimeout(() => {
                    toast.style.transform = 'translateY(0)';
                    toast.style.opacity = '1';
                }, 10);
                
                setTimeout(() => {
                    toast.style.transform = 'translateY(20px)';
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            };

            // Modal elements
            const overlay = document.getElementById('detail-modal-overlay');
            const closeBtn = document.getElementById('close-modal-btn');
            
            const detailLargePhoto = document.getElementById('detail-large-photo');
            const detailPhotoPlaceholder = document.getElementById('detail-photo-placeholder');
            const detailGenderBadge = document.getElementById('detail-gender-badge');
            
            const detailName = document.getElementById('detail-name');
            const detailEmail = document.getElementById('detail-email');
            const detailWhatsapp = document.getElementById('detail-whatsapp');
            const detailBirthplace = document.getElementById('detail-birthplace');
            const detailBirthdate = document.getElementById('detail-birthdate');
            const detailAge = document.getElementById('detail-age');
            const detailEducation = document.getElementById('detail-education');
            const detailRegion = document.getElementById('detail-region');
            const detailAddress = document.getElementById('detail-address');
            
            // New Detail Fields
            const detailGoals = document.getElementById('detail-goals');
            const detailHobbies = document.getElementById('detail-hobbies');
            const detailInstagram = document.getElementById('detail-instagram');
            const detailFacebook = document.getElementById('detail-facebook');
            const detailOrganization = document.getElementById('detail-organization');
            const detailSchoolName = document.getElementById('detail-school-name');
            const detailSchoolMajor = document.getElementById('detail-school-major');
            const detailAchievements = document.getElementById('detail-achievements');
            const detailParentsCondition = document.getElementById('detail-parents-condition');
            const detailParentIncome = document.getElementById('detail-parent-income');
            const detailSiblingCount = document.getElementById('detail-sibling-count');
            const detailHasLaptop = document.getElementById('detail-has-laptop');
            const detailQuranMemorization = document.getElementById('detail-quran-memorization');
            const detailFavoriteUstadz = document.getElementById('detail-favorite-ustadz');
            const detailHasRelationship = document.getElementById('detail-has-relationship');
            const detailSourceInfo = document.getElementById('detail-source-info');
            const detailHasBpjs = document.getElementById('detail-has-bpjs');
            const detailIdol = document.getElementById('detail-idol');
            const detailIsSmoking = document.getElementById('detail-is-smoking');
            const detailLearnedBefore = document.getElementById('detail-learned-before');
            const detailItSkills = document.getElementById('detail-it-skills');
            const detailFavoriteSubjects = document.getElementById('detail-favorite-subjects');

            const detailPaymentStatus = document.getElementById('detail-payment-status');
            const detailAcademicYear = document.getElementById('detail-academic-year');
            const detailBatch = document.getElementById('detail-batch');
            const detailProgram = document.getElementById('detail-program');
            const detailMajor = document.getElementById('detail-major');
            
            const detailGuardianName = document.getElementById('detail-guardian-name');
            const detailGuardianRel = document.getElementById('detail-guardian-rel');
            const detailGuardianWhatsapp = document.getElementById('detail-guardian-whatsapp');
            const detailGuardianOccupation = document.getElementById('detail-guardian-occupation');
            const actionsContainer = document.getElementById('modal-actions-container');

            let currentRegId = null;

            // Open Modal Handler
            document.querySelectorAll('.detail-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    currentRegId = this.getAttribute('data-id');
                    
                    // Fill text data
                    detailName.textContent = this.getAttribute('data-name');
                    detailEmail.textContent = this.getAttribute('data-email');
                    detailWhatsapp.textContent = this.getAttribute('data-whatsapp');
                    
                    const payStatus = this.getAttribute('data-payment-status');
                    if (payStatus === 'paid') {
                        detailPaymentStatus.innerHTML = '<span class="stage-badge stage-penerimaan" style="background: #d1fae5; color: #065f46;"><i class="fa-solid fa-circle-check"></i> Lunas</span>';
                    } else {
                        detailPaymentStatus.innerHTML = '<span class="stage-badge stage-ditolak" style="background: #fee2e2; color: #991b1b;"><i class="fa-solid fa-clock"></i> Pending</span>';
                    }
                    detailBirthplace.textContent = this.getAttribute('data-birthplace') || '-';
                    detailBirthdate.textContent = this.getAttribute('data-birthdate') || '-';
                    detailAge.textContent = this.getAttribute('data-age') + ' Tahun';
                    detailEducation.textContent = this.getAttribute('data-education') || '-';
                    detailRegion.textContent = this.getAttribute('data-region') || '-';
                    detailAddress.textContent = this.getAttribute('data-address') || '-';
                    
                    // New Fields Fill
                    detailGoals.textContent = this.getAttribute('data-goals') || '-';
                    detailHobbies.textContent = this.getAttribute('data-hobbies') || '-';
                    detailInstagram.textContent = this.getAttribute('data-instagram') || '-';
                    detailFacebook.textContent = this.getAttribute('data-facebook') || '-';
                    detailOrganization.textContent = this.getAttribute('data-organization') || '-';
                    detailSchoolName.textContent = this.getAttribute('data-school-name') || '-';
                    detailSchoolMajor.textContent = this.getAttribute('data-school-major') || '-';
                    detailAchievements.textContent = this.getAttribute('data-achievements') || '-';
                    detailParentsCondition.textContent = this.getAttribute('data-parents-condition') || '-';
                    detailParentIncome.textContent = this.getAttribute('data-parent-income') || '-';
                    detailSiblingCount.textContent = this.getAttribute('data-sibling-count') + ' orang' || '-';
                    detailHasLaptop.textContent = this.getAttribute('data-has-laptop') || '-';
                    detailQuranMemorization.textContent = this.getAttribute('data-quran-memorization') || '-';
                    detailFavoriteUstadz.textContent = this.getAttribute('data-favorite-ustadz') || '-';
                    detailHasRelationship.textContent = this.getAttribute('data-has-relationship') || '-';
                    detailSourceInfo.textContent = this.getAttribute('data-source-info') || '-';
                    detailHasBpjs.textContent = this.getAttribute('data-has-bpjs') || '-';
                    detailIdol.textContent = this.getAttribute('data-idol') || '-';
                    detailIsSmoking.textContent = this.getAttribute('data-is-smoking') || '-';
                    detailLearnedBefore.textContent = this.getAttribute('data-learned-before') || '-';
                    detailItSkills.textContent = this.getAttribute('data-it-skills') || '-';
                    detailFavoriteSubjects.textContent = this.getAttribute('data-favorite-subjects') || '-';

                    detailAcademicYear.textContent = this.getAttribute('data-academic-year') || '-';
                    detailBatch.textContent = this.getAttribute('data-batch') || '-';
                    detailProgram.textContent = this.getAttribute('data-program');
                    detailMajor.textContent = this.getAttribute('data-major');
                    
                    detailGuardianName.textContent = this.getAttribute('data-guardian-name') || '-';
                    detailGuardianRel.textContent = this.getAttribute('data-guardian-rel') || '-';
                    detailGuardianWhatsapp.textContent = this.getAttribute('data-guardian-whatsapp') || '-';
                    detailGuardianOccupation.textContent = this.getAttribute('data-guardian-occupation') || '-';
                    
                    // Photo handling
                    const photoSrc = this.getAttribute('data-photo');
                    if (photoSrc) {
                        detailLargePhoto.src = photoSrc;
                        detailLargePhoto.style.display = 'block';
                        detailPhotoPlaceholder.style.display = 'none';
                    } else {
                        detailLargePhoto.style.display = 'none';
                        detailPhotoPlaceholder.style.display = 'flex';
                    }

                    // Gender badge setting
                    const rawGender = this.getAttribute('data-gender');
                    detailGenderBadge.textContent = rawGender;
                    detailGenderBadge.className = 'stage-badge ' + (rawGender === 'Laki-laki' ? 'stage-administrasi' : 'stage-wawancara');

                    // Set up action buttons dynamically based on current status
                    const currentStatus = this.getAttribute('data-status');
                    actionsContainer.innerHTML = '';

                    if (currentStatus === 'administrasi') {
                        actionsContainer.innerHTML = `
                            <button class="btn-nm btn-nm-danger action-btn" data-target-status="ditolak"><i class="fa-solid fa-user-xmark"></i> Tolak Administrasi</button>
                            <button class="btn-nm btn-nm-success action-btn" data-target-status="wawancara"><i class="fa-solid fa-circle-check"></i> Lolos Administrasi</button>
                        `;
                    } else if (currentStatus === 'wawancara') {
                        actionsContainer.innerHTML = `
                            <button class="btn-nm btn-nm-danger action-btn" data-target-status="ditolak"><i class="fa-solid fa-user-xmark"></i> Tolak Wawancara</button>
                            <button class="btn-nm btn-nm-success action-btn" data-target-status="penerimaan"><i class="fa-solid fa-check-double"></i> Terima Jadi Santri</button>
                        `;
                    } else if (currentStatus === 'penerimaan') {
                        actionsContainer.innerHTML = `
                            <span style="font-weight: 800; color: #10b981; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(16, 185, 129, 0.05); padding: 0.5rem 1rem; border-radius: 8px; box-shadow: var(--nm-inset-sm);">
                                <i class="fa-solid fa-circle-check"></i> Santri Telah Diterima
                            </span>
                        `;
                    } else if (currentStatus === 'ditolak') {
                        actionsContainer.innerHTML = `
                            <button class="btn-nm btn-nm-primary action-btn" data-target-status="administrasi"><i class="fa-solid fa-file-invoice"></i> Loloskan ke Administrasi</button>
                            <button class="btn-nm btn-nm-success action-btn" data-target-status="wawancara"><i class="fa-solid fa-circle-check"></i> Loloskan ke Wawancara</button>
                        `;
                    }

                    // Attach event listeners to newly generated buttons
                    actionsContainer.querySelectorAll('.action-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const targetStatus = this.getAttribute('data-target-status');
                            updateRegistrationStatus(currentRegId, targetStatus);
                        });
                    });

                    overlay.style.display = 'flex';
                });
            });

            // Close Modal logic
            const closeModal = () => {
                overlay.style.display = 'none';
                currentRegId = null;
            };
            closeBtn.addEventListener('click', closeModal);
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) closeModal();
            });

            // Update status AJAX call
            async function updateRegistrationStatus(id, newStatus) {
                try {
                    const response = await fetch(`/super-admin/pendaftaran/${id}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ status: newStatus })
                    });

                    const data = await response.json();
                    if (response.ok && data.success) {
                        showToast(data.message, 'success');
                        closeModal();
                        
                        // Animate & remove the row from current table view
                        const row = document.getElementById(`reg-row-${id}`);
                        if (row) {
                            row.style.transition = 'all 0.4s ease';
                            row.style.opacity = '0';
                            row.style.transform = 'translateX(50px)';
                            setTimeout(() => {
                                row.remove();
                                
                                // Update row counter
                                const countHeader = document.querySelector('.panel-title');
                                const remainingRows = document.querySelectorAll('.registration-row').length;
                                countHeader.innerHTML = `<i class="fa-solid fa-list-check"></i> Daftar Calon Santri (${remainingRows})`;
                                
                                // Show empty state if no rows left
                                if (remainingRows === 0) {
                                    const tbody = document.querySelector('#registrations-table tbody');
                                    const colSpan = {{ $activeTab == 'penerimaan' ? 7 : 6 }};
                                    const emptyState = document.createElement('tr');
                                    emptyState.id = 'empty-row';
                                    emptyState.innerHTML = `<td colspan="${colSpan}" style="text-align: center; color: var(--text-secondary); padding: 3rem;"><i class="fa-solid fa-folder-open" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; color: var(--text-secondary);"></i>Tidak ada calon santri pada tahap ini.</td>`;
                                    tbody.appendChild(emptyState);
                                }
                            }, 400);
                        }
                    } else {
                        throw new Error(data.message || 'Gagal mengubah status pendaftaran.');
                    }
                } catch (error) {
                    showToast(error.message, 'error');
                }
            }

        });
    </script>
</body>
</html>
