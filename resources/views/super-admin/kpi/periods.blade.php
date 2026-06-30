<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Periode KPI - SIAPIT</title>
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
                    <h1>Manajemen Periode KPI</h1>
                    <p>Kelola periode penilaian kinerja harian pengajar.</p>
                </div>
                <a href="{{ route('super-admin.kpi.index') }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); text-decoration: none; font-weight: 700; gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul style="margin: 0.5rem 0 0 1rem; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem; align-items: start;">

                <!-- FORM TAMBAH PERIODE -->
                <div class="dashboard-panel" style="background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 20px; padding: 1.75rem;">
                    <h3 class="panel-title" style="font-family: var(--font-heading); font-weight: 800; font-size: 1.15rem; color: var(--text-primary); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-plus" style="color: var(--accent-blue);"></i> Tambah Periode Baru</h3>
                    <form method="POST" action="{{ route('super-admin.kpi.periods.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        <div class="input-group" style="display: flex; flex-direction: column; gap: 0.35rem;">
                            <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nama Periode</label>
                            <div style="box-shadow: var(--nm-inset-sm); border-radius: 10px; background: var(--bg-primary); height: 42px; display: flex; align-items: center; padding: 0 0.5rem;">
                                <input type="text" name="name" placeholder="cth: Semester Ganjil 2025" value="{{ old('name') }}" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--text-primary); font-family: var(--font-body); font-size: 0.9rem; padding: 0 0.5rem;">
                            </div>
                        </div>
                        <div class="input-group" style="display: flex; flex-direction: column; gap: 0.35rem;">
                            <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Tanggal Mulai</label>
                            <div style="box-shadow: var(--nm-inset-sm); border-radius: 10px; background: var(--bg-primary); height: 42px; display: flex; align-items: center; padding: 0 0.5rem;">
                                <input type="date" name="start_date" value="{{ old('start_date') }}" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--text-primary); font-family: var(--font-body); font-size: 0.9rem; padding: 0 0.5rem;">
                            </div>
                        </div>
                        <div class="input-group" style="display: flex; flex-direction: column; gap: 0.35rem;">
                            <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Tanggal Selesai</label>
                            <div style="box-shadow: var(--nm-inset-sm); border-radius: 10px; background: var(--bg-primary); height: 42px; display: flex; align-items: center; padding: 0 0.5rem;">
                                <input type="date" name="end_date" value="{{ old('end_date') }}" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--text-primary); font-family: var(--font-body); font-size: 0.9rem; padding: 0 0.5rem;">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: flex-end; margin-top: 0.5rem;">
                            <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 40px; border-radius: 10px; padding: 0 1.5rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); font-weight: 850; font-size: 0.85rem; gap: 0.5rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- DAFTAR PERIODE -->
                <div class="dashboard-panel" style="background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 20px; padding: 1.75rem;">
                    <h3 class="panel-title" style="font-family: var(--font-heading); font-weight: 800; font-size: 1.15rem; color: var(--text-primary); margin-bottom: 1.25rem;"><i class="fa-solid fa-calendar-days" style="color: var(--accent-blue);"></i> Daftar Periode KPI</h3>

                    @if($periods->count() === 0)
                        <div style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 3rem 0;">
                            <i class="fa-solid fa-calendar-xmark" style="font-size: 2.25rem; margin-bottom: 0.75rem; display: block; opacity: 0.4; color: var(--text-secondary);"></i>
                            Belum ada periode KPI. Tambahkan periode baru di sebelah kiri.
                        </div>
                    @else
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @foreach($periods as $p)
                                <div style="background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 14px; padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                                    <div>
                                        <div style="font-weight: 850; font-size: 1rem; color: var(--text-primary);">{{ $p->name }}</div>
                                        <div style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 700; margin-top: 0.35rem; display: flex; align-items: center; gap: 0.35rem;">
                                            <i class="fa-solid fa-calendar-day" style="color: var(--accent-blue);"></i>
                                            {{ \Carbon\Carbon::parse($p->start_date)->format('d M Y') }} &mdash; {{ \Carbon\Carbon::parse($p->end_date)->format('d M Y') }}
                                        </div>
                                        @php
                                            $start = \Carbon\Carbon::parse($p->start_date);
                                            $end = \Carbon\Carbon::parse($p->end_date);
                                            $totalDays = $start->diffInDays($end) + 1;
                                        @endphp
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 700; margin-top: 0.25rem; display: flex; align-items: center; gap: 0.35rem;">
                                            <i class="fa-solid fa-clock" style="color: var(--accent-green);"></i>
                                            <span>{{ $totalDays }} Hari Total</span>
                                        </div>
                                    </div>
                                    <div style="display: flex; gap: 0.65rem;">
                                        <button onclick="openEditModal({{ $p->id }}, '{{ addslashes($p->name) }}', '{{ $p->start_date }}', '{{ $p->end_date }}')" 
                                            style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 36px; width: 36px; border-radius: 10px; cursor: pointer; color: var(--accent-blue); transition: var(--transition);"
                                            onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Edit Periode">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <form method="POST" action="{{ route('super-admin.kpi.periods.destroy', $p->id) }}" onsubmit="return confirm('Hapus periode \'{{ addslashes($p->name) }}\'? Ini akan menghapus semua assignment KPI terkait.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 36px; width: 36px; border-radius: 10px; cursor: pointer; color: var(--accent-red, #e53e3e); transition: var(--transition);"
                                                onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Hapus Periode">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL EDIT PERIODE -->
    <div id="edit-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 480px; padding: 2rem; position: relative; background: var(--bg-primary); box-shadow: 10px 10px 30px rgba(0,0,0,0.1), -10px -10px 30px rgba(255,255,255,0.9); border-radius: 24px;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center;" onclick="closeEditModal()"><i class="fa-solid fa-xmark"></i></button>
            
            <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 850; margin-bottom: 1.5rem; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-pen" style="color: var(--accent-blue);"></i> Edit Periode KPI</h3>
            
            <form id="edit-form" method="POST" action="" style="display: flex; flex-direction: column; gap: 1.25rem;">
                @csrf
                @method('PUT')
                <div class="input-group" style="display: flex; flex-direction: column; gap: 0.35rem;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nama Periode</label>
                    <div style="box-shadow: var(--nm-inset-sm); border-radius: 10px; background: var(--bg-primary); height: 42px; display: flex; align-items: center; padding: 0 0.5rem;">
                        <input type="text" id="edit-name" name="name" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--text-primary); font-family: var(--font-body); font-size: 0.9rem; padding: 0 0.5rem;">
                    </div>
                </div>
                <div class="input-group" style="display: flex; flex-direction: column; gap: 0.35rem;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Tanggal Mulai</label>
                    <div style="box-shadow: var(--nm-inset-sm); border-radius: 10px; background: var(--bg-primary); height: 42px; display: flex; align-items: center; padding: 0 0.5rem;">
                        <input type="date" id="edit-start" name="start_date" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--text-primary); font-family: var(--font-body); font-size: 0.9rem; padding: 0 0.5rem;">
                    </div>
                </div>
                <div class="input-group" style="display: flex; flex-direction: column; gap: 0.35rem;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Tanggal Selesai</label>
                    <div style="box-shadow: var(--nm-inset-sm); border-radius: 10px; background: var(--bg-primary); height: 42px; display: flex; align-items: center; padding: 0 0.5rem;">
                        <input type="date" id="edit-end" name="end_date" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--text-primary); font-family: var(--font-body); font-size: 0.9rem; padding: 0 0.5rem;">
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 0.5rem;">
                    <button type="button" onclick="closeEditModal()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; font-weight: 750; cursor: pointer; font-size: 0.85rem;">Batal</button>
                    <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.5rem; font-weight: 850; cursor: pointer; gap: 0.4rem; font-size: 0.85rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>
            </form>
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

        function openEditModal(id, name, startDate, endDate) {
            document.getElementById('edit-name').value  = name;
            document.getElementById('edit-start').value = startDate;
            document.getElementById('edit-end').value   = endDate;
            document.getElementById('edit-form').action = `/super-admin/kpi/periods/${id}`;
            document.getElementById('edit-modal-overlay').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('edit-modal-overlay').style.display = 'none';
        }

        // Close modal on overlay click
        document.getElementById('edit-modal-overlay').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });
    </script>
</body>
</html>
