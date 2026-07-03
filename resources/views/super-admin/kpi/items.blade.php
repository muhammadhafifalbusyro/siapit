<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Jobdesc & KPI - SIAPIT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
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

            <header class="main-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div class="welcome-section">
                    <h1>Manajemen Jobdesc & KPI</h1>
                    <p>Atur kategori Job Description global dan buat target poin KPI untuk masing-masing Jobdesc.</p>
                </div>
                <a href="{{ route('super-admin.kpi.index') }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); text-decoration: none; font-weight: 700; gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                    <i class="fa-solid fa-arrow-left"></i> Kembali Ke List Pengajar
                </a>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="dashboard-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: start;">
                
                <!-- LEFT COLUMN: CRUD Forms -->
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    
                    <!-- 1. CRUD Job Description (Parent) -->
                    <div class="dashboard-panel">
                        <h3 class="panel-title" id="jobdesc-form-title"><i class="fa-solid fa-briefcase"></i> Kelola Job Description (Kategori)</h3>
                        <form id="jobdesc-form" method="POST" action="{{ route('super-admin.kpi.jobdescs.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                            @csrf
                            <input type="hidden" name="_method" id="jobdesc-form-method" value="POST">
                            
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Nama Kategori Job Description</label>
                                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                    <input type="text" name="name" id="jobdesc-name" required placeholder="Contoh: Pengajar Divisi Backend / Piket Harian" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                </div>
                            </div>
                            
                            <div style="margin-top: 0.5rem; display: flex; gap: 0.5rem;">
                                <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); font-weight: 800; font-size: 0.85rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" id="jobdesc-submit-btn">
                                    <i class="fa-solid fa-plus"></i> Simpan Jobdesc
                                </button>
                                <button type="button" style="border: none; background: transparent; box-shadow: var(--nm-flat-sm); display: none; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); font-weight: 700; font-size: 0.85rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" id="jobdesc-cancel-btn" onclick="resetJobdescForm()">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- 2. CRUD KPI Point (Child) -->
                    <div class="dashboard-panel">
                        <h3 class="panel-title" id="item-form-title"><i class="fa-solid fa-list-check"></i> Kelola Poin target KPI</h3>
                        <form id="item-form" method="POST" action="{{ route('super-admin.kpi.items.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                            @csrf
                            <input type="hidden" name="_method" id="item-form-method" value="POST">
                            
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Pilih Kategori Job Description (Parent)</label>
                                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                    <select id="item-jobdesc-id" name="teacher_kpi_jobdesc_id" required style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                        <option value="">- Pilih Kategori Jobdesc -</option>
                                        @foreach($jobdescs as $jd)
                                            <option value="{{ $jd->id }}">{{ $jd->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Nama Poin KPI / Target Kegiatan</label>
                                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                    <input type="text" name="name" id="item-name" required placeholder="Contoh: Mengisi Jurnal Harian Santri" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                </div>
                            </div>
                            
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.8rem; font-weight: 800; color: var(--text-secondary);">Bobot Penilaian (%)</label>
                                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                    <input type="number" name="weight" id="item-weight" required min="1" max="100" placeholder="1 s/d 100" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                </div>
                            </div>
                            
                            <div style="margin-top: 0.5rem; display: flex; gap: 0.5rem;">
                                <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); font-weight: 800; font-size: 0.85rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" id="item-submit-btn">
                                    <i class="fa-solid fa-plus"></i> Simpan Poin KPI
                                </button>
                                <button type="button" style="border: none; background: transparent; box-shadow: var(--nm-flat-sm); display: none; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); font-weight: 700; font-size: 0.85rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" id="item-cancel-btn" onclick="resetItemForm()">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- RIGHT COLUMN: Nested List -->
                <div class="dashboard-panel">
                    <h3 class="panel-title"><i class="fa-solid fa-network-wired"></i> Hierarki Jobdesc & Target KPI</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-top: 1rem;">
                        @forelse($jobdescs as $jd)
                            <div style="background: var(--bg-primary); box-shadow: var(--nm-flat-sm); padding: 1.25rem; border-radius: 16px;">
                                <!-- Jobdesc Parent Header -->
                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; border-bottom: 1.5px solid #d1d9e6; padding-bottom: 0.75rem; margin-bottom: 0.75rem;">
                                    <h4 style="font-family: var(--font-heading); font-weight: 850; color: var(--text-primary); font-size: 1.05rem;">
                                        <i class="fa-solid fa-briefcase" style="color: var(--accent-blue);"></i> {{ $jd->name }}
                                    </h4>
                                    
                                    <div style="display: flex; gap: 0.35rem;">
                                        <button class="edit-jobdesc-btn" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 28px; height: 28px; border-radius: 6px; cursor: pointer; color: var(--accent-blue); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" data-id="{{ $jd->id }}" data-name="{{ $jd->name }}" title="Edit Kategori"><i class="fa-solid fa-pen"></i></button>
                                        <form method="POST" action="{{ route('super-admin.kpi.jobdescs.destroy', $jd->id) }}" onsubmit="return confirm('Hapus Kategori Jobdesc ini beserta seluruh poin KPI di dalamnya?')" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 28px; height: 28px; border-radius: 6px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Hapus Kategori"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>

                                <!-- KPI Points Table -->
                                <div class="table-container" style="box-shadow: none; border: 1px solid #d1d9e6; border-radius: 8px;">
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr style="background: var(--bg-secondary);">
                                                <th style="padding: 0.5rem 0.75rem; font-size: 0.75rem;">Poin Target KPI</th>
                                                <th style="width: 80px; text-align: center; padding: 0.5rem 0.75rem; font-size: 0.75rem;">Bobot</th>
                                                <th style="width: 80px; text-align: center; padding: 0.5rem 0.75rem; font-size: 0.75rem;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($jd->items as $itm)
                                                <tr>
                                                    <td style="font-weight: 700; font-size: 0.85rem; color: var(--text-primary); padding: 0.5rem 0.75rem;">{{ $itm->name }}</td>
                                                    <td style="text-align: center; font-weight: 800; color: var(--accent-blue); font-size: 0.85rem; padding: 0.5rem 0.75rem;">{{ $itm->weight }}%</td>
                                                    <td style="padding: 0.5rem 0.75rem;">
                                                        <div style="display: flex; gap: 0.35rem; justify-content: center;">
                                                            <button class="edit-item-btn" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 24px; height: 24px; border-radius: 5px; cursor: pointer; color: var(--accent-blue); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" data-id="{{ $itm->id }}" data-name="{{ $itm->name }}" data-weight="{{ $itm->weight }}" data-jobdesc-id="{{ $itm->teacher_kpi_jobdesc_id }}" title="Edit Poin"><i class="fa-solid fa-pen"></i></button>
                                                            <form method="POST" action="{{ route('super-admin.kpi.items.destroy', $itm->id) }}" onsubmit="return confirm('Hapus poin KPI ini?')" style="margin: 0;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 24px; height: 24px; border-radius: 5px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Hapus Poin"><i class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" style="text-align: center; color: var(--text-secondary); font-style: italic; font-size: 0.75rem; padding: 1rem 0;">Belum ada poin KPI untuk jobdesc ini.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 3rem 0; border: 1.5px dashed #d1d9e6; border-radius: 16px;">
                                Belum ada kategori Job Description. Silakan buat satu di sebelah kiri.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </main>
    </div>

    <script>
        // Jobdesc edit helper
        document.querySelectorAll('.edit-jobdesc-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                document.getElementById('jobdesc-form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Job Description';
                const form = document.getElementById('jobdesc-form');
                form.action = `/super-admin/kpi/jobdescs/${id}`;
                document.getElementById('jobdesc-form-method').value = 'PUT';
                document.getElementById('jobdesc-name').value = name;
                document.getElementById('jobdesc-submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
                document.getElementById('jobdesc-cancel-btn').style.display = 'inline-flex';
            });
        });

        function resetJobdescForm() {
            document.getElementById('jobdesc-form-title').innerHTML = '<i class="fa-solid fa-briefcase"></i> Kelola Job Description (Kategori)';
            const form = document.getElementById('jobdesc-form');
            form.action = "{{ route('super-admin.kpi.jobdescs.store') }}";
            document.getElementById('jobdesc-form-method').value = 'POST';
            document.getElementById('jobdesc-name').value = '';
            document.getElementById('jobdesc-submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Simpan Jobdesc';
            document.getElementById('jobdesc-cancel-btn').style.display = 'none';
        }

        // Item edit helper
        document.querySelectorAll('.edit-item-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const weight = this.getAttribute('data-weight');
                const jdId = this.getAttribute('data-jobdesc-id');
                
                document.getElementById('item-form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Poin KPI';
                const form = document.getElementById('item-form');
                form.action = `/super-admin/kpi/items/${id}`;
                document.getElementById('item-form-method').value = 'PUT';
                document.getElementById('item-name').value = name;
                document.getElementById('item-weight').value = weight;
                document.getElementById('item-jobdesc-id').value = jdId;
                
                document.getElementById('item-submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
                document.getElementById('item-cancel-btn').style.display = 'inline-flex';
            });
        });

        // Submenu toggling untuk sidebar
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });

        function resetItemForm() {
            document.getElementById('item-form-title').innerHTML = '<i class="fa-solid fa-list-check"></i> Kelola Poin target KPI';
            const form = document.getElementById('item-form');
            form.action = "{{ route('super-admin.kpi.items.store') }}";
            document.getElementById('item-form-method').value = 'POST';
            document.getElementById('item-name').value = '';
            document.getElementById('item-weight').value = '';
            document.getElementById('item-jobdesc-id').value = '';
            document.getElementById('item-submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Simpan Poin KPI';
            document.getElementById('item-cancel-btn').style.display = 'none';
        }
    </script>
</body>
</html>
