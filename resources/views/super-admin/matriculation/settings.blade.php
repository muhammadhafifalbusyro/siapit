<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Masa Matrikulasi - SIAPIT</title>
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
                    <h1>Pengaturan Periode Matrikulasi</h1>
                    <p>Atur rentang tanggal masa bimbingan seleksi matrikulasi santri Pondok IT.</p>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; box-shadow: var(--nm-flat-sm);">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Selection Filter -->
            <div class="dashboard-panel" style="width: 100%; margin-bottom: 1.5rem; padding: 1.25rem 1.5rem;">
                <form method="GET" action="{{ route('super-admin.matriculation.settings') }}" style="display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: flex-end;">
                    <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Tahun Ajaran</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="academic_year_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($academicYears as $ay)
                                    <option value="{{ $ay->id }}" {{ $selectedAcademicYearId == $ay->id ? 'selected' : '' }}>{{ $ay->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Gelombang / Batch</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="batch_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($batches as $b)
                                    <option value="{{ $b->id }}" {{ $selectedBatchId == $b->id ? 'selected' : '' }}>{{ $b->name }} ({{ $b->academicYear->name }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Configuration Form -->
            <div class="dashboard-panel" style="width: 100%;">
                <form id="settings-form" method="POST" action="{{ route('super-admin.matriculation.settings.store') }}" style="display: flex; flex-direction: column; gap: 2rem;">
                    @csrf
                    <input type="hidden" name="academic_year_id" value="{{ $selectedAcademicYearId }}">
                    <input type="hidden" name="batch_id" value="{{ $selectedBatchId }}">

                    <!-- Periode & Tanggal -->
                    <div>
                        <h3 class="panel-title"><i class="fa-solid fa-calendar-range"></i> Masa Pembelajaran Seleksi</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 1.5rem;">
                            <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Tanggal Mulai</label>
                                <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                                    <input type="date" name="start_date" required value="{{ $period->start_date ?? '' }}" style="width: 100%; height: 100%; padding: 0 1rem;">
                                </div>
                            </div>
                            <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Tanggal Selesai</label>
                                <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                                    <input type="date" name="end_date" required value="{{ $period->end_date ?? '' }}" style="width: 100%; height: 100%; padding: 0 1rem;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aspek Kriteria Penilaian -->
                    <div>
                        <h3 class="panel-title"><i class="fa-solid fa-list-check"></i> Aspek Penilaian Matrikulasi</h3>
                        <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 1.5rem; font-weight: 600;">Definisikan kriteria untuk masing-masing kelompok penilaian. Total bobot kriteria dalam masing-masing kelompok wajib bernilai tepat 100%.</p>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                            
                            <!-- Penilaian Karakter -->
                            <div class="card-nm" style="padding: 1.5rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1.5px solid #d1d9e6; padding-bottom: 0.75rem;">
                                    <h4 style="font-family: var(--font-heading); font-size: 1.05rem; font-weight: 800; color: var(--text-primary); margin: 0;"><i class="fa-solid fa-heart" style="color: var(--accent-red);"></i> Penilaian Karakter</h4>
                                    <button type="button" onclick="addAspectRow('character')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 30px; border-radius: 6px; padding: 0 0.75rem; font-weight: 800; font-size: 0.75rem; cursor: pointer; transition: var(--transition); gap: 0.25rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                        <i class="fa-solid fa-plus"></i> Tambah
                                    </button>
                                </div>

                                <div id="character-aspects-container" style="display: flex; flex-direction: column; gap: 1rem;">
                                    @php $charIdx = 0; @endphp
                                    @if(isset($period) && $period->aspects->where('type', 'character')->count() > 0)
                                        @foreach($period->aspects->where('type', 'character') as $aspect)
                                            <div class="aspect-row character-row" style="display: flex; gap: 0.75rem; align-items: center; width: 100%;">
                                                <input type="hidden" name="character_aspects[{{ $charIdx }}][id]" value="{{ $aspect->id }}">
                                                <div class="input-wrapper" style="flex: 3; height: 38px;">
                                                    <input type="text" name="character_aspects[{{ $charIdx }}][name]" required placeholder="Nama Kriteria (misal: Sholat Tepat Waktu)" value="{{ $aspect->name }}" style="height: 100%;">
                                                </div>
                                                <div class="input-wrapper" style="flex: 1.2; display: flex; align-items: center; gap: 0.25rem; padding-right: 0.5rem; height: 38px; border-radius: 8px;">
                                                    <input type="number" name="character_aspects[{{ $charIdx }}][weight]" min="1" max="100" required placeholder="Bobot" value="{{ $aspect->weight_percentage }}" style="box-shadow: none; border: none; background: transparent; width: 100%; text-align: center; font-weight: 700; height: 100%;">
                                                    <span style="font-weight: 700; color: var(--text-secondary);">%</span>
                                                </div>
                                                <button type="button" onclick="removeAspectRow(this, 'character')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                                    <i class="fa-solid fa-trash" style="font-size: 0.8rem;"></i>
                                                </button>
                                            </div>
                                            @php $charIdx++; @endphp
                                        @endforeach
                                    @else
                                        <!-- Default Character aspects -->
                                        <div class="aspect-row character-row" style="display: flex; gap: 0.75rem; align-items: center; width: 100%;">
                                            <div class="input-wrapper" style="flex: 3; height: 38px;">
                                                <input type="text" name="character_aspects[0][name]" required placeholder="Nama Kriteria" value="Sholat Tepat Waktu" style="height: 100%;">
                                            </div>
                                            <div class="input-wrapper" style="flex: 1.2; display: flex; align-items: center; gap: 0.25rem; padding-right: 0.5rem; height: 38px; border-radius: 8px;">
                                                <input type="number" name="character_aspects[0][weight]" min="1" max="100" required placeholder="Bobot" value="50" style="box-shadow: none; border: none; background: transparent; width: 100%; text-align: center; font-weight: 700; height: 100%;">
                                                <span style="font-weight: 700; color: var(--text-secondary);">%</span>
                                            </div>
                                            <button type="button" onclick="removeAspectRow(this, 'character')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                                <i class="fa-solid fa-trash" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </div>
                                        <div class="aspect-row character-row" style="display: flex; gap: 0.75rem; align-items: center; width: 100%;">
                                            <div class="input-wrapper" style="flex: 3; height: 38px;">
                                                <input type="text" name="character_aspects[1][name]" required placeholder="Nama Kriteria" value="Tahajud" style="height: 100%;">
                                            </div>
                                            <div class="input-wrapper" style="flex: 1.2; display: flex; align-items: center; gap: 0.25rem; padding-right: 0.5rem; height: 38px; border-radius: 8px;">
                                                <input type="number" name="character_aspects[1][weight]" min="1" max="100" required placeholder="Bobot" value="50" style="box-shadow: none; border: none; background: transparent; width: 100%; text-align: center; font-weight: 700; height: 100%;">
                                                <span style="font-weight: 700; color: var(--text-secondary);">%</span>
                                            </div>
                                            <button type="button" onclick="removeAspectRow(this, 'character')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                                <i class="fa-solid fa-trash" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </div>
                                        @php $charIdx = 2; @endphp
                                    @endif
                                </div>
                                
                                <div style="margin-top: 1.5rem; text-align: right; font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); border-top: 1px dashed #d1d9e6; padding-top: 0.75rem;">
                                    Subtotal Bobot Karakter: <span id="char-weight-total" style="color: var(--accent-blue);">100%</span>
                                </div>
                            </div>

                            <!-- Penilaian Skill -->
                            <div class="card-nm" style="padding: 1.5rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1.5px solid #d1d9e6; padding-bottom: 0.75rem;">
                                    <h4 style="font-family: var(--font-heading); font-size: 1.05rem; font-weight: 800; color: var(--text-primary); margin: 0;"><i class="fa-solid fa-brain" style="color: var(--accent-blue);"></i> Penilaian Skill</h4>
                                    <button type="button" onclick="addAspectRow('skill')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 30px; border-radius: 6px; padding: 0 0.75rem; font-weight: 800; font-size: 0.75rem; cursor: pointer; transition: var(--transition); gap: 0.25rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                        <i class="fa-solid fa-plus"></i> Tambah
                                    </button>
                                </div>

                                <div id="skill-aspects-container" style="display: flex; flex-direction: column; gap: 1rem;">
                                    @php $skillIdx = 0; @endphp
                                    @if(isset($period) && $period->aspects->where('type', 'skill')->count() > 0)
                                        @foreach($period->aspects->where('type', 'skill') as $aspect)
                                            <div class="aspect-row skill-row" style="display: flex; gap: 0.75rem; align-items: center; width: 100%;">
                                                <input type="hidden" name="skill_aspects[{{ $skillIdx }}][id]" value="{{ $aspect->id }}">
                                                <div class="input-wrapper" style="flex: 3; height: 38px;">
                                                    <input type="text" name="skill_aspects[{{ $skillIdx }}][name]" required placeholder="Nama Kriteria (misal: Tugas Harian)" value="{{ $aspect->name }}" style="height: 100%;">
                                                </div>
                                                <div class="input-wrapper" style="flex: 1.2; display: flex; align-items: center; gap: 0.25rem; padding-right: 0.5rem; height: 38px; border-radius: 8px;">
                                                    <input type="number" name="skill_aspects[{{ $skillIdx }}][weight]" min="1" max="100" required placeholder="Bobot" value="{{ $aspect->weight_percentage }}" style="box-shadow: none; border: none; background: transparent; width: 100%; text-align: center; font-weight: 700; height: 100%;">
                                                    <span style="font-weight: 700; color: var(--text-secondary);">%</span>
                                                </div>
                                                <button type="button" onclick="removeAspectRow(this, 'skill')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                                    <i class="fa-solid fa-trash" style="font-size: 0.8rem;"></i>
                                                </button>
                                            </div>
                                            @php $skillIdx++; @endphp
                                        @endforeach
                                    @else
                                        <!-- Default Skill aspects -->
                                        <div class="aspect-row skill-row" style="display: flex; gap: 0.75rem; align-items: center; width: 100%;">
                                            <div class="input-wrapper" style="flex: 3; height: 38px;">
                                                <input type="text" name="skill_aspects[0][name]" required placeholder="Nama Kriteria" value="Tugas Harian" style="height: 100%;">
                                            </div>
                                            <div class="input-wrapper" style="flex: 1.2; display: flex; align-items: center; gap: 0.25rem; padding-right: 0.5rem; height: 38px; border-radius: 8px;">
                                                <input type="number" name="skill_aspects[0][weight]" min="1" max="100" required placeholder="Bobot" value="100" style="box-shadow: none; border: none; background: transparent; width: 100%; text-align: center; font-weight: 700; height: 100%;">
                                                <span style="font-weight: 700; color: var(--text-secondary);">%</span>
                                            </div>
                                            <button type="button" onclick="removeAspectRow(this, 'skill')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                                <i class="fa-solid fa-trash" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </div>
                                        @php $skillIdx = 1; @endphp
                                    @endif
                                </div>
                                
                                <div style="margin-top: 1.5rem; text-align: right; font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); border-top: 1px dashed #d1d9e6; padding-top: 0.75rem;">
                                    Subtotal Bobot Skill: <span id="skill-weight-total" style="color: var(--accent-blue);">100%</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Info Formula Kelulusan -->
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1.25rem 1.5rem; border-radius: 12px; font-size: 0.85rem; color: var(--text-secondary); line-height: 1.6; font-weight: 600;">
                        <i class="fa-solid fa-calculator" style="color: var(--accent-blue); margin-right: 0.25rem;"></i> <strong>Formula Nilai Akhir Gabungan:</strong><br>
                        Nilai Akhir = (Rata-rata Nilai Karakter Tertimbang &times; 50%) + (Rata-rata Nilai Skill Tertimbang &times; 50%). Masing-masing kelompok (Karakter & Skill) wajib bernilai akumulasi subtotal 100%.
                    </div>
                    <!-- Save Status & Submit Button -->
                    <div style="display: flex; justify-content: flex-end; align-items: center; gap: 1rem; margin-top: 1rem;">
                        <span id="save-status" style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 0.5rem 1.25rem; border-radius: 10px; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;">
                            <i class="fa-solid fa-cloud" style="color: var(--accent-blue);"></i> Pengaturan disimpan otomatis
                        </span>
                        <button type="submit" style="display: none;"></button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const submenuTriggers = document.querySelectorAll('.submenu-trigger');
            submenuTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const parent = trigger.parentElement;
                    parent.classList.toggle('open');
                });
            });

            // Calculate weight initially
            calculateTotalWeight();

            // Bind listeners for dynamic weights
            document.getElementById('character-aspects-container').addEventListener('input', () => {
                calculateTotalWeight();
                checkAndAutoSave();
            });
            document.getElementById('skill-aspects-container').addEventListener('input', () => {
                calculateTotalWeight();
                checkAndAutoSave();
            });

            // Bind change listeners to dates
            document.querySelector('input[name="start_date"]').addEventListener('change', checkAndAutoSave);
            document.querySelector('input[name="end_date"]').addEventListener('change', checkAndAutoSave);
        });

        let charCounter = {{ $charIdx }};
        let skillCounter = {{ $skillIdx }};

        function addAspectRow(type) {
            const container = document.getElementById(type + '-aspects-container');
            const row = document.createElement('div');
            row.className = 'aspect-row ' + type + '-row';
            row.style.display = 'flex';
            row.style.gap = '0.75rem';
            row.style.alignItems = 'center';
            row.style.width = '100%';

            const counter = type === 'character' ? charCounter : skillCounter;

            row.innerHTML = `
                <div class="input-wrapper" style="flex: 3; height: 38px;">
                    <input type="text" name="${type}_aspects[${counter}][name]" required placeholder="Nama Kriteria" style="height: 100%;">
                </div>
                <div class="input-wrapper" style="flex: 1.2; display: flex; align-items: center; gap: 0.25rem; padding-right: 0.5rem; height: 38px; border-radius: 8px;">
                    <input type="number" name="${type}_aspects[${counter}][weight]" min="1" max="100" required placeholder="Bobot" value="0" style="box-shadow: none; border: none; background: transparent; width: 100%; text-align: center; font-weight: 700; height: 100%;">
                    <span style="font-weight: 700; color: var(--text-secondary);">%</span>
                </div>
                <button type="button" onclick="removeAspectRow(this, '${type}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                    <i class="fa-solid fa-trash" style="font-size: 0.8rem;"></i>
                </button>
            `;

            container.appendChild(row);
            if (type === 'character') {
                charCounter++;
            } else {
                skillCounter++;
            }
            calculateTotalWeight();
            checkAndAutoSave();
        }

        let pendingDeleteRow = null;
        let pendingDeleteType = null;

        function removeAspectRow(button, type) {
            const rows = document.querySelectorAll('.' + type + '-row');
            if (rows.length <= 1) {
                alert('Minimal harus terdapat 1 aspek penilaian dalam kategori ini.');
                return;
            }

            const row = button.closest('.aspect-row');
            const hasIdInput = row.querySelector('input[name$="[id]"]');

            if (hasIdInput && hasIdInput.value !== '') {
                // Show custom neomorphism modal for deleting database aspects
                pendingDeleteRow = row;
                pendingDeleteType = type;
                const modal = document.getElementById('confirm-delete-modal');
                if (modal) {
                    modal.style.display = 'flex';
                }
            } else {
                // For new aspects not yet saved to the DB, delete immediately
                row.remove();
                calculateTotalWeight();
                checkAndAutoSave();
            }
        }

        function calculateTotalWeight() {
            let charWeightTotal = 0;
            const charInputs = document.querySelectorAll('input[name^="character_aspects"][name$="[weight]"]');
            charInputs.forEach(input => {
                charWeightTotal += parseInt(input.value) || 0;
            });
            document.getElementById('char-weight-total').innerText = charWeightTotal + '%';

            let skillWeightTotal = 0;
            const skillInputs = document.querySelectorAll('input[name^="skill_aspects"][name$="[weight]"]');
            skillInputs.forEach(input => {
                skillWeightTotal += parseInt(input.value) || 0;
            });
            document.getElementById('skill-weight-total').innerText = skillWeightTotal + '%';
        }

        // Auto Save Logic with Validation Check
        let saveTimeout = null;

        function checkAndAutoSave() {
            let charWeightTotal = 0;
            const charInputs = document.querySelectorAll('input[name^="character_aspects"][name$="[weight]"]');
            charInputs.forEach(input => {
                charWeightTotal += parseInt(input.value) || 0;
            });

            let skillWeightTotal = 0;
            const skillInputs = document.querySelectorAll('input[name^="skill_aspects"][name$="[weight]"]');
            skillInputs.forEach(input => {
                skillWeightTotal += parseInt(input.value) || 0;
            });

            const startDate = document.querySelector('input[name="start_date"]').value;
            const endDate = document.querySelector('input[name="end_date"]').value;

            const statusEl = document.getElementById('save-status');

            if (!startDate || !endDate) {
                if (statusEl) {
                    statusEl.innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="color: #f59e0b;"></i> Tanggal mulai & selesai harus diisi';
                    statusEl.style.color = '#f59e0b';
                }
                return;
            }

            // Verify that all weights are at least 1%
            let allWeightsValid = true;
            document.querySelectorAll('input[name$="[weight]"]').forEach(input => {
                const w = parseInt(input.value) || 0;
                if (w < 1) {
                    allWeightsValid = false;
                }
            });

            if (!allWeightsValid) {
                if (statusEl) {
                    statusEl.innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="color: #f59e0b;"></i> Bobot setiap aspek harus minimal 1%';
                    statusEl.style.color = '#f59e0b';
                }
                return;
            }

            if (charInputs.length > 0 && charWeightTotal !== 100) {
                if (statusEl) {
                    statusEl.innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="color: #f59e0b;"></i> Bobot karakter harus 100% (saat ini: ' + charWeightTotal + '%)';
                    statusEl.style.color = '#f59e0b';
                }
                return;
            }

            if (skillInputs.length > 0 && skillWeightTotal !== 100) {
                if (statusEl) {
                    statusEl.innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="color: #f59e0b;"></i> Bobot skill harus 100% (saat ini: ' + skillWeightTotal + '%)';
                    statusEl.style.color = '#f59e0b';
                }
                return;
            }

            // Check if all names are non-empty
            let allNamesFilled = true;
            document.querySelectorAll('input[name$="[name]"]').forEach(input => {
                if (!input.value.trim()) {
                    allNamesFilled = false;
                }
            });

            if (!allNamesFilled) {
                if (statusEl) {
                    statusEl.innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="color: #f59e0b;"></i> Semua nama kriteria harus diisi';
                    statusEl.style.color = '#f59e0b';
                }
                return;
            }

            triggerAutoSave();
        }

        function triggerAutoSave() {
            const statusEl = document.getElementById('save-status');
            if (statusEl) {
                statusEl.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="color: var(--accent-blue);"></i> Menyimpan perubahan...';
                statusEl.style.color = 'var(--accent-blue)';
            }

            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(() => {
                const form = document.getElementById('settings-form');
                if (!form) return;

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (statusEl) {
                            statusEl.innerHTML = '<i class="fa-solid fa-cloud-arrow-up" style="color: #10b981;"></i> Perubahan disimpan';
                            statusEl.style.color = '#10b981';
                            setTimeout(() => {
                                statusEl.innerHTML = '<i class="fa-solid fa-cloud" style="color: var(--accent-blue);"></i> Pengaturan disimpan otomatis';
                                statusEl.style.color = 'var(--text-secondary)';
                            }, 2000);
                        }
                    } else {
                        if (statusEl) {
                            statusEl.innerHTML = '<i class="fa-solid fa-circle-exclamation" style="color: #dc2626;"></i> Gagal menyimpan perubahan';
                            statusEl.style.color = '#dc2626';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error saving settings:', error);
                    if (statusEl) {
                        statusEl.innerHTML = '<i class="fa-solid fa-circle-exclamation" style="color: #dc2626;"></i> Gagal menyimpan perubahan';
                        statusEl.style.color = '#dc2626';
                    }
                });
            }, 1000); // 1s debounce
        }

        // Handle custom confirmation modal cancel and confirm events
        document.addEventListener('DOMContentLoaded', () => {
            const cancelBtn = document.getElementById('btn-cancel-delete');
            const confirmBtn = document.getElementById('btn-confirm-delete');
            const modal = document.getElementById('confirm-delete-modal');

            if (cancelBtn) {
                cancelBtn.addEventListener('click', () => {
                    if (modal) modal.style.display = 'none';
                    pendingDeleteRow = null;
                    pendingDeleteType = null;
                });
            }

            if (confirmBtn) {
                confirmBtn.addEventListener('click', () => {
                    if (pendingDeleteRow) {
                        pendingDeleteRow.remove();
                        calculateTotalWeight();
                        checkAndAutoSave();
                    }
                    if (modal) modal.style.display = 'none';
                    pendingDeleteRow = null;
                    pendingDeleteType = null;
                });
            }
        });
    </script>

    <!-- Neomorphism Confirmation Modal -->
    <div id="confirm-delete-modal" style="display: none; position: fixed; inset: 0; background: rgba(224, 229, 236, 0.7); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; transition: all 0.3s ease;">
        <div style="background: #e0e5ec; box-shadow: 9px 9px 16px rgba(163,177,198, 0.6), -9px -9px 16px rgba(255,255,255, 0.8); border-radius: 20px; padding: 2rem; max-width: 450px; width: 90%; text-align: center; border: 1px solid rgba(255,255,255,0.2);">
            <div style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; background: #e0e5ec; box-shadow: inset 4px 4px 8px #a3b1c6, inset -4px -4px 8px #ffffff;">
                <i class="fa-solid fa-trash-can" style="color: #dc2626; font-size: 1.8rem;"></i>
            </div>
            <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; color: #2d3748; margin-bottom: 0.75rem;">Hapus Kriteria Penilaian?</h3>
            <p style="font-size: 0.9rem; color: #4a5568; line-height: 1.6; margin-bottom: 1.5rem; font-weight: 600;">
                Menghapus kriteria penilaian ini akan menghapus semua nilai santri yang terkait secara permanen pada Kontrol Harian & Rapor. Apakah Anda yakin?
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <button type="button" id="btn-cancel-delete" style="border: none; background: #e0e5ec; box-shadow: 4px 4px 8px #a3b1c6, -4px -4px 8px #ffffff; color: #4a5568; font-weight: 800; font-size: 0.85rem; padding: 0.75rem 1.5rem; border-radius: 12px; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.boxShadow='inset 2px 2px 5px #a3b1c6, inset -2px -2px 5px #ffffff'" onmouseout="this.style.boxShadow='4px 4px 8px #a3b1c6, -4px -4px 8px #ffffff'">
                    Batal
                </button>
                <button type="button" id="btn-confirm-delete" style="border: none; background: #dc2626; box-shadow: 4px 4px 8px rgba(220, 38, 38, 0.4), -4px -4px 8px #ffffff; color: #ffffff; font-weight: 800; font-size: 0.85rem; padding: 0.75rem 1.5rem; border-radius: 12px; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</body>
</html>
