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

                <!-- Top Filters & Actions -->
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                    <!-- Search Filter (Live Search) -->
                    <div class="search-input-wrapper" style="padding: 0 0.5rem; max-width: 380px; margin-bottom: 0; flex-grow: 1;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="search-teacher" placeholder="Cari nama pengajar..." style="width: 100%; border: none; outline: none; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 0.85rem 1rem 0.85rem 2.75rem; border-radius: 12px; font-family: var(--font-body); color: var(--text-primary); font-weight: 600;">
                    </div>

                    <!-- Mass Actions Button -->
                    <button type="button" id="btn-mass-assign" onclick="openMassAssignModal()" disabled style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.25rem; cursor: not-allowed; color: var(--text-secondary); opacity: 0.6; transition: var(--transition); font-weight: 800; font-size: 0.85rem; gap: 0.4rem;">
                        <i class="fa-solid fa-users-gear" style="color: var(--accent-blue);"></i> Atur Jobdesc Massal <span id="selected-count-badge" style="display:none; font-size: 0.72rem; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 0.15rem 0.45rem; border-radius: 6px; color: var(--accent-blue); font-weight: 800;">0</span>
                    </button>
                </div>

                <form id="mass-assign-form" method="POST" action="{{ route('super-admin.kpi.settings.mass-save') }}">
                    @csrf
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 50px; text-align: center;">
                                        <input type="checkbox" id="select-all-teachers" onchange="toggleSelectAllTeachers(this)" style="width: 17px; height: 17px; accent-color: var(--accent-blue); cursor: pointer;">
                                    </th>
                                    <th>Nama Lengkap</th>
                                    <th>Tipe Pengajar</th>
                                    <th>Email</th>
                                    <th>No. WhatsApp</th>
                                    <th style="width: 250px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teachers as $tch)
                                    <tr class="teacher-row" data-name="{{ strtolower($tch->name) }}">
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="teacher_ids[]" value="{{ $tch->id }}" class="teacher-checkbox" onchange="handleTeacherCheckboxChange()" style="width: 17px; height: 17px; accent-color: var(--accent-blue); cursor: pointer;">
                                        </td>
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
                                                <a href="{{ route('super-admin.kpi.settings', $tch->id) }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 32px; border-radius: 8px; padding: 0 0.75rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); text-decoration: none; font-weight: 800; font-size: 0.75rem; gap: 0.3rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Edit KPI Detail & Libur">
                                                    <i class="fa-solid fa-gear"></i>
                                                </a>
                                                <a href="{{ route('super-admin.kpi.manage', $tch->id) }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 32px; border-radius: 8px; padding: 0 0.75rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); text-decoration: none; font-weight: 800; font-size: 0.75rem; gap: 0.3rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Lembar Kontrol KPI">
                                                    <i class="fa-solid fa-list-check"></i>
                                                </a>
                                                <button type="button" onclick="openSelectPeriodModal({{ $tch->id }}, '{{ $tch->name }}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 32px; border-radius: 8px; padding: 0 0.75rem; cursor: pointer; color: var(--accent-green); transition: var(--transition); font-weight: 800; font-size: 0.75rem; gap: 0.3rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Cetak Rapor KPI">
                                                    <i class="fa-solid fa-file-invoice"></i>
                                                </button>
                                            </div>
                                         </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 3rem 0;">Belum ada akun pengajar. Buat akun pengajar terlebih dahulu di menu Pengaturan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>

                <!-- Pagination UI -->
                <div class="pagination-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; width: 100%; border-top: 1px solid #d1d9e6; background: var(--bg-primary); margin-top: 1rem; border-radius: 0 0 16px 16px;">
                    {{-- Previous Page Link --}}
                    @if($teachers->onFirstPage())
                        <span class="pagination-btn disabled" style="box-shadow: var(--nm-inset-sm); color: var(--text-secondary); opacity: 0.6; cursor: not-allowed; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $teachers->previousPageUrl() }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); cursor: pointer; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $currentPage = $teachers->currentPage();
                        $lastPage = $teachers->lastPage();
                        $sidePages = 2;
                    @endphp

                    @if($lastPage > 0)
                        @for ($page = 1; $page <= $lastPage; $page++)
                            @if ($page == 1 || $page == $lastPage || abs($page - $currentPage) <= $sidePages)
                                @if ($page == $currentPage)
                                    <span class="pagination-btn active" style="box-shadow: var(--nm-inset-sm); color: var(--accent-blue); font-weight: 800; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 2.5px solid var(--accent-blue);">{{ $page }}</span>
                                @else
                                    <a href="{{ $teachers->url($page) }}" class="pagination-btn" style="box-shadow: var(--nm-flat-sm); color: var(--text-primary); font-weight: 700; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: var(--transition);">{{ $page }}</a>
                                @endif
                            @elseif ($page == 2 || $page == $lastPage - 1)
                                <span class="pagination-dots" style="color: var(--text-secondary); width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: 800; user-select: none;">...</span>
                            @endif
                        @endfor
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
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
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

    <!-- MODAL 3: MASS ASSIGN PERIODS & JOBDESC -->
    <div id="mass-assign-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 650px; padding: 2rem; position: relative; max-height: 90vh; overflow-y: auto;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center;" onclick="closeMassAssignModal()" type="button"><i class="fa-solid fa-xmark"></i></button>
            
            <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 850; margin-bottom: 0.25rem;"><i class="fa-solid fa-users-gear" style="color: var(--accent-blue);"></i> Pengaturan KPI Massal</h3>
            <p style="font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 1.5rem;">Terapkan Job Description, Periode, dan Hari Libur ke <strong id="mass-count-label" style="color: var(--text-primary);">0</strong> pengajar terpilih.</p>
            
            <div style="display: flex; flex-direction: column; gap: 1.25rem; text-align: left;">
                <!-- Periods Checklist -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Pilih Periode Kerja Aktif (Bisa Lebih Dari Satu)</label>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem; max-height: 150px; overflow-y: auto; padding: 0.75rem; border-radius: 12px; background: var(--bg-primary); box-shadow: var(--nm-inset-sm);">
                        @foreach($periods as $p)
                            <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; cursor: pointer; padding: 0.25rem 0.5rem; border-radius: 6px; transition: var(--transition);" class="mass-period-checkbox-label">
                                <input type="checkbox" name="mass_period_ids[]" value="{{ $p->id }}" onchange="handleMassPeriodCheckboxChange()" style="cursor: pointer;">
                                <span style="font-weight: 700; color: var(--text-primary);">{{ $p->name }}</span>
                                <span style="font-size: 0.75rem; color: var(--text-secondary);">({{ $p->start_date }} s/d {{ $p->end_date }})</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Jobdesc Search-Select -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem; position: relative;">
                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Pilih Kategori Job Description</label>
                    <div class="custom-select-container" id="mass-jobdesc-select">
                        <div class="custom-select-trigger" onclick="toggleMassDropdown(event)">
                            <input type="text" id="mass-jobdesc-search-input" placeholder="Cari & pilih Job Description..." autocomplete="off" oninput="filterMassOptions(this.value)">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <input type="hidden" name="mass_jobdesc_id" id="mass-jobdesc-id-val">
                        <div class="custom-select-dropdown" id="mass-jobdesc-dropdown" style="top: 45px;">
                            <div class="custom-select-option" data-value="" onclick="selectMassOption(this, event)" style="color: var(--text-secondary); font-style: italic;">
                                - Pilih Job Description -
                            </div>
                            @foreach($jobdescs as $jd)
                                <div class="custom-select-option" data-value="{{ $jd->id }}" data-name="{{ strtolower($jd->name) }}" onclick="selectMassOption(this, event)">
                                    {{ $jd->name }} ({{ $jd->items->count() }} Poin KPI)
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- KPI Items & Off Days Settings Container (Dinamis via JS) -->
                <div id="mass-kpi-items-offdays-section" style="display: none; flex-direction: column; gap: 0.75rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary);"><i class="fa-solid fa-calendar-xmark" style="color: var(--accent-blue);"></i> Pengaturan Hari Libur (Off-Days) per Poin KPI</label>
                    <p style="font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Pilih tanggal libur di tiap item KPI untuk semua pengajar terpilih.</p>
                    
                    <div id="mass-kpi-items-offdays-container" style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <!-- Dinamis via JS -->
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 2rem;">
                <button type="button" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.25rem; font-weight: 700; cursor: pointer;" onclick="closeMassAssignModal()">Batal</button>
                <button type="button" onclick="submitMassAssign()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.25rem; font-weight: 800; cursor: pointer; gap: 0.3rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                    <i class="fa-solid fa-floppy-disk"></i> Terapkan
                </button>
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
                            <tr style="display: none;">
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
        /* Custom Search Select Neumorphic Styling */
        .custom-select-container {
            position: relative;
            width: 100%;
        }

        .custom-select-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 42px;
            padding: 0 1rem;
            border-radius: 12px;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            cursor: pointer;
            position: relative;
        }

        .custom-select-trigger input {
            width: 90%;
            border: none;
            background: transparent;
            outline: none;
            font-weight: 700;
            color: var(--text-primary);
            font-family: var(--font-body);
            font-size: 0.95rem;
            cursor: pointer;
        }

        .custom-select-trigger i {
            color: var(--text-secondary);
            transition: transform 0.3s ease;
        }

        .custom-select-container.open .custom-select-trigger i {
            transform: rotate(180deg);
        }

        .custom-select-dropdown {
            position: absolute;
            top: 48px;
            left: 0;
            right: 0;
            background: var(--bg-primary);
            box-shadow: 6px 6px 15px #beccd7, -6px -6px 15px #ffffff;
            border-radius: 12px;
            max-height: 220px;
            overflow-y: auto;
            z-index: 100;
            display: none;
            padding: 0.5rem;
        }

        .custom-select-dropdown.show {
            display: block;
        }

        .custom-select-option {
            padding: 0.75rem 1rem;
            font-weight: 700;
            color: var(--text-primary);
            font-size: 0.9rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .custom-select-option:hover {
            background: var(--bg-secondary);
            color: var(--accent-blue);
        }

        .custom-select-option.selected {
            background: var(--bg-secondary);
            color: var(--accent-blue);
            box-shadow: var(--nm-inset-sm);
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
                        document.getElementById('rep-effective-days').textContent = `-`;
                        document.getElementById('rep-sign-name').textContent = data.teacher.name;

                        document.getElementById('rep-total-weight').textContent = `${data.total_weight}%`;
                        document.getElementById('rep-total-score').textContent = `${data.total_weighted_score.toFixed(2)}%`;

                        const tbody = document.getElementById('report-items-body');
                        tbody.innerHTML = '';

                        data.report_data.forEach(row => {
                            const effectiveDays = row.effective_days ?? '-';
                            const checkedDays   = row.checked_days ?? 0;
                            const percentage    = (row.percentage != null) ? parseFloat(row.percentage).toFixed(1) : '0.0';
                            const weightedScore = (row.weighted_score != null) ? parseFloat(row.weighted_score).toFixed(2) : '0.00';
                            const weight        = row.item ? row.item.weight : '-';
                            const itemName      = row.item ? row.item.name : '-';

                            tbody.innerHTML += `
                                <tr>
                                    <td style="padding: 0.75rem 1rem;">
                                        <div style="font-weight: 700; color: var(--text-primary);">${itemName}</div>
                                    </td>
                                    <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">${weight}%</td>
                                    <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">${checkedDays} / ${effectiveDays} Hari (${percentage}%)</td>
                                    <td style="text-align: right; font-weight: 800; color: var(--text-primary);">${weightedScore}%</td>
                                </tr>
                            `;
                        });

                        // Populate Weekly Summary
                        const weeksBody = document.getElementById('report-weeks-body');
                        weeksBody.innerHTML = '';
                        if (data.weeks && data.weeks.length > 0) {
                            data.weeks.forEach(wk => {
                                const score = (wk.score != null) ? parseFloat(wk.score).toFixed(2) : '0.00';
                                weeksBody.innerHTML += `
                                    <tr>
                                        <td style="padding: 0.75rem 1rem; font-weight: 700; color: var(--text-primary);">Pekan ${wk.week_number}</td>
                                        <td style="padding: 0.75rem 1rem; font-weight: 600; color: var(--text-secondary);">${wk.start_date} s/d ${wk.end_date}</td>
                                        <td style="text-align: right; font-weight: 800; color: var(--accent-blue);">${score}%</td>
                                    </tr>
                                `;
                            });
                        } else {
                            weeksBody.innerHTML = '<tr><td colspan="3" style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 1rem 0;">Tidak ada data pekan.</td></tr>';
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

        // ---- Mass Assign JS Actions ----
        const allJobdescs = @json($jobdescs);
        const allPeriods = @json($periods);
        const calendarState = {}; // calKey => { year, month }

        const selectAllCheckbox = document.getElementById('select-all-teachers');
        const teacherCheckboxes = document.querySelectorAll('.teacher-checkbox');
        const btnMassAssign = document.getElementById('btn-mass-assign');
        const badgeCount = document.getElementById('selected-count-badge');
        const massModal = document.getElementById('mass-assign-modal-overlay');
        const massCountLabel = document.getElementById('mass-count-label');
        const massForm = document.getElementById('mass-assign-form');

        function toggleSelectAllTeachers(master) {
            teacherCheckboxes.forEach(cb => {
                // Only toggle if row is visible
                const row = cb.closest('.teacher-row');
                if (row && row.style.display !== 'none') {
                    cb.checked = master.checked;
                }
            });
            handleTeacherCheckboxChange();
        }

        function handleTeacherCheckboxChange() {
            const checkedCount = Array.from(teacherCheckboxes).filter(cb => cb.checked).length;
            if (checkedCount > 0) {
                btnMassAssign.disabled = false;
                btnMassAssign.style.cursor = 'pointer';
                btnMassAssign.style.opacity = '1';
                btnMassAssign.style.boxShadow = 'var(--nm-flat-sm)';
                badgeCount.textContent = checkedCount;
                badgeCount.style.display = 'inline-block';
            } else {
                btnMassAssign.disabled = true;
                btnMassAssign.style.cursor = 'not-allowed';
                btnMassAssign.style.opacity = '0.6';
                btnMassAssign.style.boxShadow = 'var(--nm-flat-sm)';
                badgeCount.style.display = 'none';
            }
        }

        function openMassAssignModal() {
            const checkedCount = Array.from(teacherCheckboxes).filter(cb => cb.checked).length;
            massCountLabel.textContent = checkedCount;

            // Clear previous mass selections inside modal
            document.querySelectorAll('input[name="mass_period_ids[]"]').forEach(cb => cb.checked = false);
            document.getElementById('mass-jobdesc-id-val').value = '';
            document.getElementById('mass-jobdesc-search-input').value = '';
            document.getElementById('mass-kpi-items-offdays-section').style.display = 'none';
            document.getElementById('mass-kpi-items-offdays-container').innerHTML = '';

            massModal.style.display = 'flex';
        }

        function closeMassAssignModal() {
            massModal.style.display = 'none';
        }

        // Mass Jobdesc Dropdown handler
        const massSelectContainer = document.getElementById('mass-jobdesc-select');
        const massSelectDropdown = document.getElementById('mass-jobdesc-dropdown');
        const massSearchInput = document.getElementById('mass-jobdesc-search-input');
        const massHiddenInput = document.getElementById('mass-jobdesc-id-val');

        function toggleMassDropdown(event) {
            event.stopPropagation();
            massSelectDropdown.classList.toggle('show');
        }

        function filterMassOptions(query) {
            massSelectDropdown.classList.add('show');
            const lowerQuery = query.toLowerCase().trim();
            massSelectDropdown.querySelectorAll('.custom-select-option').forEach(opt => {
                const optName = opt.getAttribute('data-name');
                if (!optName) return;
                opt.style.display = optName.includes(lowerQuery) ? 'block' : 'none';
            });
        }

        function selectMassOption(element, event) {
            event.stopPropagation();
            const value = element.getAttribute('data-value');
            const text = element.textContent.trim();

            massHiddenInput.value = value;
            massSearchInput.value = value === '' ? '' : text;

            massSelectDropdown.querySelectorAll('.custom-select-option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
            massSelectDropdown.classList.remove('show');

            renderMassOffDaysSection(value ? parseInt(value) : null);
        }

        document.addEventListener('click', function(e) {
            if (massSelectContainer && !massSelectContainer.contains(e.target)) {
                massSelectDropdown.classList.remove('show');
            }
        });

        // Trigger render calendar when period changes
        function handleMassPeriodCheckboxChange() {
            const jobdescId = massHiddenInput.value ? parseInt(massHiddenInput.value) : null;
            renderMassOffDaysSection(jobdescId);
        }

        function getSelectedMassPeriodIds() {
            return Array.from(document.querySelectorAll('input[name="mass_period_ids[]"]:checked')).map(cb => parseInt(cb.value));
        }

        // Render Off-Days Section for Mass Modal
        function renderMassOffDaysSection(jobdescId) {
            const section = document.getElementById('mass-kpi-items-offdays-section');
            const container = document.getElementById('mass-kpi-items-offdays-container');
            container.innerHTML = '';

            const selectedPeriodIds = getSelectedMassPeriodIds();

            if (!jobdescId || selectedPeriodIds.length === 0) {
                section.style.display = 'none';
                return;
            }

            section.style.display = 'flex';

            const jobdesc = allJobdescs.find(jd => jd.id === jobdescId);
            if (!jobdesc || !jobdesc.items || jobdesc.items.length === 0) {
                container.innerHTML = '<div style="color: var(--text-secondary); font-style: italic; font-size: 0.85rem; padding: 1rem 0;">Kategori ini belum memiliki poin KPI. Tambah poin KPI terlebih dahulu di menu Manajemen Jobdesc.</div>';
                return;
            }

            jobdesc.items.forEach(item => {
                const itemCard = document.createElement('div');
                itemCard.className = 'card-nm';
                itemCard.style.cssText = 'padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem;';
                itemCard.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1.5px solid #d1d9e6; padding-bottom: 0.5rem;">
                        <span style="font-weight: 850; color: var(--text-primary); font-size: 0.95rem;">${item.name}</span>
                        <span style="font-size: 0.75rem; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 0.2rem 0.5rem; border-radius: 5px; font-weight: 700; color: var(--text-secondary);">Bobot: ${item.weight}%</span>
                    </div>
                `;

                selectedPeriodIds.forEach(periodId => {
                    const period = allPeriods.find(p => p.id === periodId);
                    if (!period) return;

                    const calKey = `${periodId}_${item.id}`;
                    if (!calendarState[calKey]) {
                        const startD = new Date(period.start_date);
                        calendarState[calKey] = {
                            year: startD.getFullYear(),
                            month: startD.getMonth()
                        };
                    }

                    const periodWrap = document.createElement('div');
                    periodWrap.style.cssText = 'background: var(--bg-secondary); border-radius: 10px; padding: 0.75rem; display: flex; flex-direction: column; gap: 0.5rem;';
                    periodWrap.innerHTML = `<div style="font-size: 0.78rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 0.25rem;"><i class="fa-solid fa-calendar-days"></i> ${period.name} <span style="font-weight: 500;">(${period.start_date} s/d ${period.end_date})</span></div>`;

                    const calDiv = document.createElement('div');
                    calDiv.className = 'offday-calendar';
                    calDiv.setAttribute('data-cal-key', calKey);
                    renderCalendar(calDiv, calKey, item.id, periodId, period.start_date, period.end_date, []);
                    periodWrap.appendChild(calDiv);

                    itemCard.appendChild(periodWrap);
                });

                container.appendChild(itemCard);
            });
        }

        // Render mini calendar inside modal
        function renderCalendar(container, calKey, itemId, periodId, startDate, endDate, currentOffDays) {
            container.innerHTML = '';
            const state = calendarState[calKey];
            const year = state.year;
            const month = state.month;

            const periodStart = new Date(startDate + 'T00:00:00');
            const periodEnd = new Date(endDate + 'T00:00:00');

            const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            const navHeader = document.createElement('div');
            navHeader.style.cssText = 'display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.35rem;';
            navHeader.innerHTML = `
                <button type="button" onclick="prevMonth('${calKey}', ${itemId}, ${periodId}, '${startDate}', '${endDate}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 6px; width: 24px; height: 24px; cursor: pointer; color: var(--text-secondary); font-size: 0.7rem; display:flex; align-items:center; justify-content:center;">&lt;</button>
                <span style="font-size: 0.78rem; font-weight: 800; color: var(--text-primary);">${monthNames[month]} ${year}</span>
                <button type="button" onclick="nextMonth('${calKey}', ${itemId}, ${periodId}, '${startDate}', '${endDate}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 6px; width: 24px; height: 24px; cursor: pointer; color: var(--text-secondary); font-size: 0.7rem; display:flex; align-items:center; justify-content:center;">&gt;</button>
            `;
            container.appendChild(navHeader);

            const dayNames = ['M','S','R','K','J','S','A'];
            const dayGrid = document.createElement('div');
            dayGrid.style.cssText = 'display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px;';
            dayNames.forEach(d => {
                const lbl = document.createElement('div');
                lbl.style.cssText = 'text-align: center; font-size: 0.65rem; font-weight: 700; color: var(--text-secondary); padding: 2px 0;';
                lbl.textContent = d;
                dayGrid.appendChild(lbl);
            });

            const firstDay = new Date(year, month, 1).getDay();
            const startOffset = (firstDay === 0) ? 6 : firstDay - 1;
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            for (let i = 0; i < startOffset; i++) {
                const blank = document.createElement('div');
                dayGrid.appendChild(blank);
            }

            for (let d = 1; d <= daysInMonth; d++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                const dateObj = new Date(dateStr + 'T00:00:00');
                const inPeriod = dateObj >= periodStart && dateObj <= periodEnd;
                const isChecked = currentOffDays.includes(dateStr);

                if (!inPeriod) {
                    const cell = document.createElement('div');
                    cell.style.cssText = 'text-align: center; font-size: 0.7rem; padding: 3px 0; color: var(--text-secondary); opacity: 0.3;';
                    cell.textContent = d;
                    dayGrid.appendChild(cell);
                } else {
                    const label = document.createElement('label');
                    label.style.cssText = `display: flex; align-items: center; justify-content: center; border-radius: 5px; cursor: pointer; font-size: 0.7rem; font-weight: 700; padding: 3px 0; transition: background 0.15s; background: ${isChecked ? 'var(--accent-blue)' : 'transparent'}; color: ${isChecked ? '#fff' : 'var(--text-primary)'};`;
                    label.title = dateStr;

                    const cb = document.createElement('input');
                    cb.type = 'checkbox';
                    cb.name = `off_days[${periodId}][${itemId}][]`;
                    cb.value = dateStr;
                    cb.checked = isChecked;
                    cb.style.display = 'none';
                    cb.addEventListener('change', function() {
                        if (this.checked) {
                            label.style.background = 'var(--accent-blue)';
                            label.style.color = '#fff';
                        } else {
                            label.style.background = 'transparent';
                            label.style.color = 'var(--text-primary)';
                        }
                    });

                    label.appendChild(cb);
                    label.appendChild(document.createTextNode(d));
                    dayGrid.appendChild(label);
                }
            }

            container.appendChild(dayGrid);
        }

        window.prevMonth = function(calKey, itemId, periodId, startDate, endDate) {
            const state = calendarState[calKey];
            if (state.month === 0) { state.month = 11; state.year--; }
            else { state.month--; }
            refreshCalendar(calKey, itemId, periodId, startDate, endDate);
        };

        window.nextMonth = function(calKey, itemId, periodId, startDate, endDate) {
            const state = calendarState[calKey];
            if (state.month === 11) { state.month = 0; state.year++; }
            else { state.month++; }
            refreshCalendar(calKey, itemId, periodId, startDate, endDate);
        };

        function refreshCalendar(calKey, itemId, periodId, startDate, endDate) {
            const calContainer = document.querySelector(`.offday-calendar[data-cal-key="${calKey}"]`);
            if (!calContainer) return;
            const currentOffDays = Array.from(calContainer.querySelectorAll('input[type=checkbox]:checked')).map(cb => cb.value);
            renderCalendar(calContainer, calKey, itemId, periodId, startDate, endDate, currentOffDays);
        }

        // Submit Mass Assignments
        function submitMassAssign() {
            const selectedPeriods = getSelectedMassPeriodIds();
            if (selectedPeriods.length === 0) {
                alert('Silakan pilih minimal satu periode.');
                return;
            }

            if (!massHiddenInput.value) {
                alert('Silakan pilih Job Description.');
                return;
            }

            if (!confirm('Terapkan Job Description, Periode, & Hari Libur ini ke pengajar terpilih secara massal?')) {
                return;
            }

            const existingDynamics = massForm.querySelectorAll('.dynamic-mass-input');
            existingDynamics.forEach(el => el.remove());

            // Add selected periods as inputs
            selectedPeriods.forEach(pId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'teacher_kpi_period_ids[]';
                input.value = pId;
                input.className = 'dynamic-mass-input';
                massForm.appendChild(input);
            });

            // Add assigned jobdesc ID as input
            const jobdescInput = document.createElement('input');
            jobdescInput.type = 'hidden';
            jobdescInput.name = 'assigned_jobdesc_id';
            jobdescInput.value = massHiddenInput.value;
            jobdescInput.className = 'dynamic-mass-input';
            massForm.appendChild(jobdescInput);

            // Move all generated off-days checkbox elements from mass-modal container into massForm dynamically
            const offDaysContainer = document.getElementById('mass-kpi-items-offdays-container');
            const checkBoxes = offDaysContainer.querySelectorAll('input[type="checkbox"]:checked');
            checkBoxes.forEach(cb => {
                const clonedInput = document.createElement('input');
                clonedInput.type = 'hidden';
                clonedInput.name = cb.name;
                clonedInput.value = cb.value;
                clonedInput.className = 'dynamic-mass-input';
                massForm.appendChild(clonedInput);
            });

            // Submit form
            massForm.submit();
        }
    </script>
</body>
</html>
