<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola KPI Pengajar - SIAPIT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        /* Profile card styling */
        .profile-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 20px;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .profile-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--accent-blue);
            border: 3px solid var(--bg-primary);
        }

        /* Neumorphic switch style */
        .kpi-switch-label {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .kpi-switch-label input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .kpi-slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            transition: .4s;
            border-radius: 34px;
        }

        .kpi-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: var(--text-secondary);
            transition: .4s;
            border-radius: 50%;
            box-shadow: var(--nm-flat-sm);
        }

        input:checked + .kpi-slider {
            background-color: var(--bg-primary);
        }

        input:checked + .kpi-slider:before {
            transform: translateX(24px);
            background-color: var(--accent-blue);
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
                    <h1>Ceklis KPI Pengajar</h1>
                    <p>Centang capaian target harian untuk ustadz pembimbing pada periode aktif.</p>
                </div>
                <a href="{{ route('super-admin.kpi.index') }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); text-decoration: none; font-weight: 700; gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </header>

            <!-- PROFILE HEADER CARD -->
            <div class="profile-card">
                <div class="profile-info">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($teacher->name, 0, 2)) }}
                    </div>
                    <div>
                        <h2 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 850; margin: 0; color: var(--text-primary);">{{ $teacher->name }}</h2>
                        <p style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 700; margin: 0.15rem 0 0.5rem 0;">
                            Tipe: {{ $teacher->teacher_type ? ucwords(str_replace('_', ' ', $teacher->teacher_type)) : 'Matrikulasi & Pendidikan' }}
                        </p>
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap; font-size: 0.8rem; color: var(--text-secondary);">
                            <span><i class="fa-solid fa-envelope"></i> {{ $teacher->email }}</span>
                            @if($teacher->whatsapp)
                                <span><i class="fa-brands fa-whatsapp"></i> {{ $teacher->whatsapp }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Active Period Selector -->
                <div style="display: flex; flex-direction: column; gap: 0.35rem;">
                    <span style="font-size: 0.75rem; font-weight: 800; color: var(--text-secondary); padding-left: 0.25rem;">Pilih Periode KPI</span>
                    <div class="select-wrapper" style="width: 250px; height: 42px;">
                        <select id="switch-period" onchange="switchPeriod(this.value)" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                            @foreach($periods as $p)
                                <option value="{{ $p->id }}" {{ $selectedPeriodId == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                            @if($periods->count() == 0)
                                <option value="">- Belum ada Periode -</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <!-- MAIN CHECKLIST AREA -->
            <div id="tab-daily" class="tab-content active">
                @if($selectedPeriod && $items->count() > 0)
                    <div class="dashboard-panel" style="max-width: 700px; margin: 0 auto;">
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem; border-bottom: 2px solid #d1d9e6; padding-bottom: 1rem;">
                            <div>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <h3 class="panel-title" style="margin: 0;"><i class="fa-solid fa-calendar-check"></i> Ceklis Kerja Harian</h3>
                                    <span id="autosave-status" style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 800; display: inline-flex; align-items: center; gap: 0.2rem; transition: opacity 0.3s;">
                                        <i class="fa-solid fa-circle-check" style="color: var(--accent-green);"></i> Tersimpan otomatis
                                    </span>
                                </div>
                                <p style="font-size: 0.8rem; color: var(--text-secondary); margin: 0.15rem 0 0 0;">Perubahan pada switch/toggle di bawah akan disimpan secara otomatis.</p>
                            </div>
                            <div class="input-wrapper" style="width: 180px; height: 38px;">
                                <input type="date" id="check-date" value="{{ $selectedDate }}" min="{{ $selectedPeriod->start_date }}" max="{{ $selectedPeriod->end_date }}" onchange="switchDate(this.value)">
                            </div>
                        </div>

                        @php
                            $isOffDay = false;
                        @endphp

                        <form id="daily-check-form" style="display: flex; flex-direction: column; gap: 1.25rem;">
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                @foreach($items as $itm)
                                    <label for="check-{{ $itm->id }}" style="display: flex; align-items: center; justify-content: space-between; padding: 1.15rem 1.5rem; border-radius: 16px; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); gap: 1.5rem; cursor: pointer; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                        <div style="display: flex; flex-direction: column; text-align: left;">
                                            <span style="font-weight: 850; color: var(--text-primary); font-size: 0.95rem;">{{ $itm->name }}</span>
                                            <span style="font-size: 0.75rem; color: var(--accent-blue); font-weight: 700; margin-top: 0.15rem;">Bobot Penilaian: {{ $itm->weight }}%</span>
                                        </div>
                                        
                                        <!-- Neumorphic Toggle Switch Component -->
                                        <span class="kpi-switch-label">
                                            <input type="checkbox" name="checks[{{ $itm->id }}]" id="check-{{ $itm->id }}" class="kpi-checkbox" value="1" {{ isset($logs[$itm->id]) && $logs[$itm->id] ? 'checked' : '' }}>
                                            <span class="kpi-slider"></span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </form>
                    </div>
                @else
                    <div class="dashboard-panel" style="text-align: center; color: var(--text-secondary); padding: 4rem 2rem;">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 2.5rem; color: var(--text-secondary); opacity: 0.7; margin-bottom: 1rem;"></i>
                        <h3 style="font-family: var(--font-heading); font-weight: 800; font-size: 1.15rem; margin: 0 0 0.5rem 0;">Belum Ada Target / Jobdesc</h3>
                        <p style="font-size: 0.85rem; max-width: 450px; margin: 0 auto;">Silakan buat periode evaluasi dan tambahkan target pekerjaan di menu **"Manajemen Jobdesc"** terlebih dahulu sebelum melakukan input ceklis harian.</p>
                    </div>
                @endif
            </div>

        </main>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" style="position: fixed; top: 2rem; right: 2rem; z-index: 9999; display: flex; flex-direction: column; gap: 1rem; pointer-events: none;"></div>

    <script>
        // Sidebar Submenu Trigger
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', () => {
                const parent = trigger.parentElement;
                parent.classList.toggle('open');
            });
        });

        // Switch period select
        function switchPeriod(val) {
            if (!val) return;
            window.location.href = `?period_id=${val}`;
        }

        // Switch date select
        function switchDate(dateVal) {
            const periodId = document.getElementById('switch-period').value;
            window.location.href = `?period_id=${periodId}&date=${dateVal}`;
        }

        // Auto Save on Checkbox Toggle
        const checkboxes = document.querySelectorAll('.kpi-checkbox');
        checkboxes.forEach(cb => {
            cb.addEventListener('change', async function() {
                const statusIndicator = document.getElementById('autosave-status');
                statusIndicator.style.opacity = '0.5';
                statusIndicator.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="color: var(--accent-blue);"></i> Menyimpan...';

                const date = document.getElementById('check-date').value;
                const itemId = this.name.replace('checks[', '').replace(']', '');
                
                const formData = new FormData();
                formData.append('teacher_id', '{{ $teacher->id }}');
                formData.append('date', date);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append(`checks[${itemId}]`, this.checked ? 1 : 0);

                try {
                    const response = await fetch("{{ route('super-admin.kpi.logs.save') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    
                    const data = await response.json();
                    if (response.ok && data.success) {
                        statusIndicator.style.opacity = '1';
                        statusIndicator.innerHTML = '<i class="fa-solid fa-circle-check" style="color: var(--accent-green);"></i> Tersimpan otomatis';
                    } else {
                        statusIndicator.style.opacity = '1';
                        statusIndicator.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color: var(--accent-red);"></i> Gagal menyimpan';
                        showToast(data.message || "Gagal menyimpan laporan.", true);
                    }
                } catch (error) {
                    console.error(error);
                    statusIndicator.style.opacity = '1';
                    statusIndicator.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color: var(--accent-red);"></i> Masalah koneksi';
                    showToast("Terjadi kesalahan jaringan.", true);
                }
            });
        });

        // Toast Helper
        function showToast(message, isError = false) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `nm-toast ${isError ? 'error' : ''}`;
            toast.innerHTML = `
                <i class="fa-solid ${isError ? 'fa-circle-xmark' : 'fa-circle-check'}"></i>
                <span>${message}</span>
            `;
            container.appendChild(toast);
            
            setTimeout(() => toast.classList.add('show'), 50);
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }
    </script>
</body>
</html>
