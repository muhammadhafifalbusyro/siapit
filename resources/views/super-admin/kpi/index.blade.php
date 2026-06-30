<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPI Pengajar - SIAPIT</title>
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

            <header class="main-header">
                <div class="welcome-section">
                    <h1>KPI Pengajar</h1>
                    <p>Kelola Key Performance Indicators (KPI), target pekerjaan harian/mingguan, serta evaluasi raport kerja Pengajar / Ustadz.</p>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="dashboard-panel" style="width: 100%;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; border-bottom: 1.5px solid #d1d9e6; padding-bottom: 1rem;">
                    <h3 class="panel-title" style="margin: 0;"><i class="fa-solid fa-chalkboard-user"></i> Daftar Akun Pengajar</h3>
                    <div style="display: flex; gap: 0.75rem;">
                        <a href="{{ route('super-admin.kpi.periods.index') }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.15rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); text-decoration: none; font-weight: 800; font-size: 0.8rem; gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                            <i class="fa-solid fa-calendar-days"></i> Atur Periode KPI
                        </a>
                        <a href="{{ route('super-admin.kpi.items.index') }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.15rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); text-decoration: none; font-weight: 800; font-size: 0.8rem; gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                            <i class="fa-solid fa-list-check"></i> Atur Jobdesc KPI
                        </a>
                    </div>
                </div>

                <!-- Search Filter (Live Search) -->
                <div class="search-input-wrapper" style="padding: 0 0.5rem; max-width: 400px; margin-bottom: 1.5rem;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="search-teacher" class="search-input-nm" placeholder="Cari nama pengajar...">
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Tipe Pengajar</th>
                                <th>Email</th>
                                <th>No. WhatsApp</th>
                                <th style="width: 320px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $tch)
                                <tr class="teacher-row" data-name="{{ strtolower($tch->name) }}">
                                    <td>
                                        <div style="font-weight: 800; color: var(--text-primary);">{{ $tch->name }}</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary);">Induk: {{ $tch->username }}</div>
                                    </td>
                                    <td>
                                        <span style="font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.5rem; border-radius: 6px; background: #e0f2fe; color: #0369a1;">
                                            {{ $tch->teacher_type ? ucwords(str_replace('_', ' ', $tch->teacher_type)) : 'Matrikulasi & Pendidikan' }}
                                        </span>
                                    </td>
                                    <td>{{ $tch->email }}</td>
                                    <td>{{ $tch->whatsapp ?? '-' }}</td>
                                     <td>
                                         <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                            <a href="{{ route('super-admin.kpi.settings', $tch->id) }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 32px; border-radius: 8px; padding: 0 0.75rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); text-decoration: none; font-weight: 800; font-size: 0.75rem; gap: 0.3rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                                                <i class="fa-solid fa-gear"></i>
                                            </a>
                                            <a href="{{ route('super-admin.kpi.manage', $tch->id) }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 32px; border-radius: 8px; padding: 0 0.75rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); text-decoration: none; font-weight: 800; font-size: 0.75rem; gap: 0.3rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                                                <i class="fa-solid fa-list-check"></i>
                                            </a>
                                            <button onclick="openSelectPeriodModal({{ $tch->id }}, '{{ $tch->name }}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 32px; border-radius: 8px; padding: 0 0.75rem; cursor: pointer; color: var(--accent-green); transition: var(--transition); font-weight: 800; font-size: 0.75rem; gap: 0.3rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                                                <i class="fa-solid fa-file-invoice"></i>
                                            </button>
                                        </div>
                                     </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 3rem 0;">Belum ada akun pengajar. Buat akun pengajar terlebih dahulu di menu Pengaturan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination UI -->
                <div class="pagination-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; width: 100%; border-top: 1px solid #d1d9e6; background: var(--bg-primary); margin-top: 1rem; border-radius: 0 0 16px 16px;">
                    {{-- Previous Page Link --}}
                    @if($teachers->onFirstPage())
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $teachers->previousPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    {{-- Pagination Elements --}}
                    @if($teachers->lastPage() > 0)
                        @foreach($teachers->getUrlRange(1, $teachers->lastPage()) as $page => $url)
                            @if($page == $teachers->currentPage())
                                <span class="pagination-btn active" style="box-shadow: var(--nm-inset-sm); color: var(--accent-blue); font-weight: 800; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 2.5px solid var(--accent-blue);">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); font-weight: 700; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);">{{ $page }}</a>
                            @endif
                        @endforeach
                    @else
                        <span class="pagination-btn active" style="box-shadow: var(--nm-inset-sm); color: var(--accent-blue); font-weight: 800; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 2.5px solid var(--accent-blue);">1</span>
                    @endif

                    {{-- Next Page Link --}}
                    @if($teachers->hasMorePages())
                        <a href="{{ $teachers->nextPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL 1: SELECT PERIOD FOR REPORT -->
    <div id="select-period-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 450px; padding: 2rem; position: relative;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center;" onclick="closeSelectPeriodModal()"><i class="fa-solid fa-xmark"></i></button>
            
            <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; margin-bottom: 0.25rem;" id="select-modal-title">Pilih Periode Laporan</h3>
            <p style="font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 1.5rem;" id="select-modal-subtitle">Pilih periode penilaian KPI pengajar untuk dicetak.</p>
            
            <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="input-group">
                    <label>Periode Penilaian</label>
                    <div class="select-wrapper">
                        <select id="report-period-select" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                            <option value="">- Pilih Periode -</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="button" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.25rem; font-weight: 700; cursor: pointer;" onclick="closeSelectPeriodModal()">Batal</button>
                <button type="button" onclick="loadKpiReport()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-green); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.25rem; font-weight: 800; cursor: pointer;">Lihat Rapor</button>
            </div>
        </div>
    </div>

    <!-- MODAL 2: REPORT DETAILS & PRINT -->
    <div id="report-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1001; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 800px; padding: 2rem; position: relative; max-height: 90vh; display: flex; flex-direction: column;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center;" onclick="closeReportModal()"><i class="fa-solid fa-xmark"></i></button>
            
            <!-- Report Printable Area -->
            <div id="print-area" style="flex: 1; overflow-y: auto; padding-right: 0.5rem; margin-bottom: 1.5rem;">
                <div style="text-align: center; margin-bottom: 2rem; border-bottom: 2px solid #d1d9e6; padding-bottom: 1.5rem;">
                    <img src="/Logo-Pondok-it.png" alt="Logo Pondok IT" style="height: 60px; margin-bottom: 0.5rem;">
                    <h2 style="font-family: var(--font-heading); font-weight: 800; font-size: 1.5rem; margin: 0; color: var(--text-primary);">RAPOR KINERJA (KPI) PENGAJAR</h2>
                    <p style="font-size: 0.85rem; color: var(--text-secondary); margin: 0.25rem 0 0 0; font-weight: 700;">Lembaga Pendidikan Pondok IT Yogyakarta</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
                    <div>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 0.25rem 0; color: var(--text-secondary); font-weight: 700; width: 120px;">Nama Pengajar</td>
                                <td style="padding: 0.25rem 0; font-weight: 800; color: var(--text-primary);" id="rep-name">-</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.25rem 0; color: var(--text-secondary); font-weight: 700;">Email Akun</td>
                                <td style="padding: 0.25rem 0; font-weight: 600; color: var(--text-primary);" id="rep-email">-</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 0.25rem 0; color: var(--text-secondary); font-weight: 700; width: 120px;">Nama Periode</td>
                                <td style="padding: 0.25rem 0; font-weight: 800; color: var(--text-primary);" id="rep-period-name">-</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.25rem 0; color: var(--text-secondary); font-weight: 700;">Rentang Waktu</td>
                                <td style="padding: 0.25rem 0; font-weight: 600; color: var(--text-primary);" id="rep-period-range">-</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.25rem 0; color: var(--text-secondary); font-weight: 700;">Hari Efektif</td>
                                <td style="padding: 0.25rem 0; font-weight: 800; color: var(--accent-blue);" id="rep-effective-days">-</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="table-container" style="box-shadow: none; border: 1.5px solid #d1d9e6; margin-bottom: 1.5rem;">
                    <table style="width: 100%;">
                        <thead>
                            <tr style="background: var(--bg-primary);">
                                <th style="padding: 0.75rem 1rem;">Target Pekerjaan / Job Description</th>
                                <th style="width: 120px; text-align: center; padding: 0.75rem 1rem;">Bobot (%)</th>
                                <th style="width: 150px; text-align: center; padding: 0.75rem 1rem;">Capaian Harian</th>
                                <th style="width: 120px; text-align: right; padding: 0.75rem 1rem;">Nilai Bobot</th>
                            </tr>
                        </thead>
                        <tbody id="report-items-body">
                            <!-- Dynamic report rows -->
                        </tbody>
                        <tfoot>
                            <tr style="background: var(--bg-primary); border-top: 2px solid #d1d9e6; font-weight: 800;">
                                <td style="padding: 1rem; color: var(--text-primary);">Total Nilai Kinerja Pengajar (Weighted Score)</td>
                                <td style="text-align: center; padding: 1rem;" id="rep-total-weight">-</td>
                                <td></td>
                                <td style="text-align: right; padding: 1rem; color: var(--accent-blue); font-size: 1.1rem;" id="rep-total-score">-</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Weekly Summary Section -->
                <h4 style="font-family: var(--font-heading); font-weight: 800; color: var(--text-primary); font-size: 1.1rem; margin: 2rem 0 0.75rem 0; text-align: left;">Ringkasan Kinerja Per Pekan</h4>
                <div class="table-container" style="box-shadow: none; border: 1.5px solid #d1d9e6; margin-bottom: 2rem;">
                    <table style="width: 100%;">
                        <thead>
                            <tr style="background: var(--bg-primary);">
                                <th style="padding: 0.75rem 1rem; text-align: left;">Pekan Ke-</th>
                                <th style="padding: 0.75rem 1rem; text-align: left;">Rentang Tanggal</th>
                                <th style="width: 120px; text-align: center; padding: 0.75rem 1rem;">Hari Efektif</th>
                                <th style="width: 120px; text-align: center; padding: 0.75rem 1rem;">Hari Libur</th>
                                <th style="width: 120px; text-align: right; padding: 0.75rem 1rem;">Nilai Pekan</th>
                            </tr>
                        </thead>
                        <tbody id="report-weeks-body">
                            <!-- Dynamic weekly rows -->
                        </tbody>
                    </table>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; text-align: center; margin-top: 3rem; font-size: 0.85rem;">
                    <div>
                        <p style="margin-bottom: 4rem; color: var(--text-secondary); font-weight: 700;">Mengetahui,<br>Kepala Divisi Pendidikan</p>
                        <p style="font-weight: 800; text-decoration: underline; color: var(--text-primary);">__________________________</p>
                    </div>
                    <div>
                        <p style="margin-bottom: 4rem; color: var(--text-secondary); font-weight: 700;">Yogyakarta, {{ date('d F Y') }}<br>Pengajar Bersangkutan</p>
                        <p style="font-weight: 800; text-decoration: underline; color: var(--text-primary);" id="rep-sign-name">-</p>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="button" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.25rem; font-weight: 700; cursor: pointer;" onclick="closeReportModal()">Tutup</button>
                <button type="button" onclick="printReport()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.25rem; font-weight: 800; cursor: pointer;">
                    <i class="fa-solid fa-print"></i> Cetak Rapor KPI
                </button>
            </div>
        </div>
    </div>

    <!-- Print styling -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #print-area, #print-area * {
                visibility: visible;
            }
            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                overflow: visible !important;
                height: auto !important;
            }
            #report-modal-overlay {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                height: auto !important;
                overflow: visible !important;
                background: none !important;
                backdrop-filter: none !important;
            }
        }

        /* Neumorphic Toast */
        .nm-toast {
            background: var(--bg-primary);
            box-shadow: 6px 6px 12px #beccd7, -6px -6px 12px #ffffff;
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
        }
        .nm-toast.show {
            transform: translateY(0);
            opacity: 1;
        }
        .nm-toast.error {
            color: var(--accent-red);
        }

        /* Search panel styling */
        .search-input-wrapper {
            position: relative;
            max-width: 400px;
            margin-bottom: 1.5rem;
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
    </style>

    <script>
        // Submenu toggling
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });

        let currentTeacherIdForReport = null;

        // Modal 1 Select Period
        function openSelectPeriodModal(teacherId, name) {
            currentTeacherIdForReport = teacherId;
            document.getElementById('select-modal-title').textContent = `Pilih Periode: ${name}`;
            const select = document.getElementById('report-period-select');
            select.innerHTML = '<option value="">- Memuat Periode... -</option>';
            
            // Fetch periods for this teacher
            fetch(`/super-admin/kpi/manage/${teacherId}?get_periods_json=1`)
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.periods.length > 0) {
                        select.innerHTML = '<option value="">- Pilih Periode -</option>';
                        data.periods.forEach(p => {
                            select.innerHTML += `<option value="${p.id}">${p.name} (${p.start_date} s/d ${p.end_date})</option>`;
                        });
                    } else {
                        select.innerHTML = '<option value="">- Tidak ada periode KPI -</option>';
                    }
                })
                .catch(err => {
                    console.error(err);
                    select.innerHTML = '<option value="">- Gagal memuat periode -</option>';
                });

            document.getElementById('select-period-modal-overlay').style.display = 'flex';
        }

        function closeSelectPeriodModal() {
            document.getElementById('select-period-modal-overlay').style.display = 'none';
        }

        // Modal 2 Report
        function loadKpiReport() {
            const periodId = document.getElementById('report-period-select').value;
            if (!periodId) {
                alert('Silakan pilih periode terlebih dahulu.');
                return;
            }

            closeSelectPeriodModal();

            // Fetch report details
            fetch(`/super-admin/kpi/report/${currentTeacherIdForReport}/${periodId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('rep-name').textContent = data.teacher.name;
                        document.getElementById('rep-email').textContent = data.teacher.email;
                        document.getElementById('rep-period-name').textContent = data.period.name;
                        document.getElementById('rep-period-range').textContent = `${data.period.start_date} s/d ${data.period.end_date} (${data.total_days} Hari)`;
                        document.getElementById('rep-effective-days').textContent = `${data.effective_days} Hari Aktif (${data.period.off_days ? data.period.off_days.length : 0} Hari Libur)`;
                        document.getElementById('rep-sign-name').textContent = data.teacher.name;

                        document.getElementById('rep-total-weight').textContent = `${data.total_weight}%`;
                        document.getElementById('rep-total-score').textContent = `${data.total_weighted_score.toFixed(2)}%`;

                        const tbody = document.getElementById('report-items-body');
                        tbody.innerHTML = '';

                         data.report_data.forEach(row => {
                            tbody.innerHTML += `
                                <tr>
                                    <td style="padding: 0.75rem 1rem;">
                                        <div style="font-weight: 700; color: var(--text-primary);">${row.item.name}</div>
                                    </td>
                                    <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">${row.item.weight}%</td>
                                    <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">${row.checked_days} / ${data.effective_days} Hari (${row.percentage.toFixed(1)}%)</td>
                                    <td style="text-align: right; font-weight: 800; color: var(--text-primary);">${row.weighted_score.toFixed(2)}%</td>
                                </tr>
                            `;
                        });

                        // Populate Weekly Summary
                        const weeksBody = document.getElementById('report-weeks-body');
                        weeksBody.innerHTML = '';
                        if (data.weeks && data.weeks.length > 0) {
                            data.weeks.forEach(wk => {
                                weeksBody.innerHTML += `
                                    <tr>
                                        <td style="padding: 0.75rem 1rem; font-weight: 700; color: var(--text-primary);">Pekan ${wk.week_number}</td>
                                        <td style="padding: 0.75rem 1rem; font-weight: 600; color: var(--text-secondary);">${wk.start_date} s/d ${wk.end_date}</td>
                                        <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">${wk.effective_days} Hari</td>
                                        <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">${wk.off_days} Hari</td>
                                        <td style="text-align: right; font-weight: 800; color: var(--accent-blue);">${wk.score.toFixed(2)}%</td>
                                    </tr>
                                `;
                            });
                        } else {
                            weeksBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 1rem 0;">Tidak ada data pekan.</td></tr>';
                        }

                        document.getElementById('report-modal-overlay').style.display = 'flex';
                    } else {
                        alert('Gagal memuat rapor KPI.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Terjadi kesalahan jaringan saat memuat rapor.');
                });
        }

        function closeReportModal() {
            document.getElementById('report-modal-overlay').style.display = 'none';
        }

        function printReport() {
            window.print();
        }

        // Live search teachers client-side
        const searchInput = document.getElementById('search-teacher');
        const rows = document.querySelectorAll('.teacher-row');

        if (searchInput) {
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase().trim();
                rows.forEach(row => {
                    const name = row.getAttribute('data-name');
                    if (name.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    </script>
</body>
</html>
