<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview Tagihan - SIAPIT</title>
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

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            padding: 1.5rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--accent-blue);
        }

        .stat-info h3 {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--text-primary);
        }

        .stat-info p {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            font-size: 1.2rem;
            font-weight: 850;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Category Cards List */
        .category-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .category-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 15px;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1.5px solid rgba(255,255,255,0.4);
            transition: var(--transition);
        }

        .category-card:hover {
            box-shadow: var(--nm-flat-hover);
        }

        .category-info h4 {
            font-size: 1.1rem;
            font-weight: 850;
            color: var(--accent-blue);
            margin-bottom: 0.25rem;
        }

        .category-info p {
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 700;
        }

        .progress-bar-container {
            width: 250px;
            height: 10px;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 5px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .progress-bar-fill {
            height: 100%;
            background: var(--accent-green);
            border-radius: 5px;
            transition: width 0.5s ease-in-out;
        }

        .btn-action {
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            color: var(--accent-blue);
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.8rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-action:hover {
            box-shadow: var(--nm-flat-hover);
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
                <li class="has-submenu open">
                    <div class="submenu-trigger">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Tagihan
                        <i class="fa-solid fa-chevron-down arrow-icon"></i>
                    </div>
                    <ul class="submenu">
                        <li class="active"><a href="{{ route('super-admin.billing.overview') }}"><i class="fa-solid fa-chart-pie"></i> Overview</a></li>
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
            <h1>Overview Keuangan & Tagihan</h1>
            <p>Ringkasan realisasi penagihan dan pembayaran angsuran dari seluruh santri diterima.</p>
        </header>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-tags"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalCategories }}</h3>
                    <p>Kategori Tagihan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--accent-blue);"><i class="fa-solid fa-wallet"></i></div>
                <div class="stat-info">
                    <h3>Rp {{ number_format($totalTarget, 0, ',', '.') }}</h3>
                    <p>Total Target Penagihan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--accent-green);"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                <div class="stat-info">
                    <h3>Rp {{ number_format($totalActual, 0, ',', '.') }}</h3>
                    <p>Total Aktual Terbayar</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--accent-green);"><i class="fa-solid fa-percent"></i></div>
                <div class="stat-info">
                    <h3>{{ number_format($percentage, 1) }}%</h3>
                    <p>Persentase Pelunasan</p>
                </div>
            </div>
        </div>

        <div class="dashboard-panel">
            <h3 class="panel-title"><i class="fa-solid fa-receipt"></i> Rincian per Kategori Tagihan</h3>
            
            <div class="category-list">
                @forelse($breakdown as $item)
                    <div class="category-card">
                        <div>
                            <h4>{{ $item['category']->name }}</h4>
                            <p style="margin-bottom: 0.5rem; font-weight: 700; color: var(--text-secondary);">
                                Target: Rp {{ number_format($item['target'], 0, ',', '.') }} | 
                                Terbayar: <span style="color: var(--accent-green);">Rp {{ number_format($item['actual'], 0, ',', '.') }}</span>
                            </p>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="progress-bar-container">
                                    <div class="progress-bar-fill" style="width: {{ min($item['percentage'], 100) }}%;"></div>
                                </div>
                                <span style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">{{ number_format($item['percentage'], 1) }}%</span>
                            </div>
                        </div>
                        <a href="{{ route('super-admin.billing.categories.details', $item['category']->id) }}" class="btn-action">
                            Buka Detail Penagihan <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                @empty
                    <div style="text-align: center; color: var(--text-secondary); padding: 2rem; font-weight: 700;">Belum ada kategori tagihan yang dibuat.</div>
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
    </script>
</body>
</html>
