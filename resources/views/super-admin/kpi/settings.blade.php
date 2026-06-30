<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan KPI Pengajar - SIAPIT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        .profile-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 20px;
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
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
                    <h1>Pengaturan Periode & Jobdesc Pengajar</h1>
                    <p>Pilih beberapa periode kerja aktif dan kaitkan satu Job Description (Kategori) untuk pengajar terpilih.</p>
                </div>
                <a href="{{ route('super-admin.kpi.index') }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); text-decoration: none; font-weight: 700; gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </header>

            <!-- PROFILE CARD -->
            <div class="profile-card">
                <div class="profile-avatar">
                    {{ strtoupper(substr($teacher->name, 0, 2)) }}
                </div>
                <div>
                    <h2 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 850; margin: 0; color: var(--text-primary);">{{ $teacher->name }}</h2>
                    <p style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 700; margin: 0.15rem 0 0;">
                        Tipe Pengajar: {{ $teacher->teacher_type ? ucwords(str_replace('_', ' ', $teacher->teacher_type)) : 'Matrikulasi & Pendidikan' }}
                    </p>
                </div>
            </div>

            <!-- SETTINGS FORM -->
            <div class="dashboard-panel" style="max-width: 700px; margin: 0 auto; min-height: 450px;">
                <h3 class="panel-title"><i class="fa-solid fa-sliders"></i> Konfigurasi Evaluasi Kinerja</h3>
                
                <form method="POST" action="{{ route('super-admin.kpi.settings.save', $teacher->id) }}" style="display: flex; flex-direction: column; gap: 2rem;">
                    @csrf
                    
                    <!-- Periods Multiselect (Checklist) -->
                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Pilih Periode Kerja Aktif (Bisa Lebih Dari Satu)</label>
                        <p style="font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.75rem;">Centang satu atau lebih periode penilaian di bawah ini.</p>
                        
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; max-height: 180px; overflow-y: auto; padding: 0.75rem; border-radius: 12px; background: var(--bg-primary); box-shadow: var(--nm-inset-sm);">
                            @foreach($periods as $p)
                                @php $isPeriodChecked = in_array($p->id, $assignedPeriodIds); @endphp
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; cursor: pointer; padding: 0.25rem 0.5rem; border-radius: 6px; transition: var(--transition);" class="period-checkbox-label">
                                    <input type="checkbox" name="teacher_kpi_period_ids[]" value="{{ $p->id }}" {{ $isPeriodChecked ? 'checked' : '' }} style="cursor: pointer;">
                                    <span style="font-weight: 700; color: var(--text-primary);">{{ $p->name }}</span>
                                    <span style="font-size: 0.75rem; color: var(--text-secondary);">({{ $p->start_date }} s/d {{ $p->end_date }})</span>
                                </label>
                            @endforeach
                            @if($periods->count() == 0)
                                <div style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 1rem 0;">Belum ada periode evaluasi kerja.</div>
                            @endif
                        </div>
                    </div>

                    <!-- Jobdesc Searchable Select Dropdown (Custom UI Single Search-Select) -->
                    <div class="input-group" style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left; position: relative;">
                        <label style="font-size: 0.85rem; font-weight: 700; padding-left: 0.25rem;">Pilih Kategori Job Description Pengajar</label>
                        <p style="font-size: 0.75rem; color: var(--text-secondary); margin: 0 0 0.5rem 0;">Menghubungkan pengajar dengan seluruh target KPI di bawah Jobdesc ini secara otomatis.</p>
                        
                        <!-- Hidden input to post the actual selected ID -->
                        <input type="hidden" name="assigned_jobdesc_id" id="assigned-jobdesc-id-val" value="{{ count($assignedJobdescIds) > 0 ? $assignedJobdescIds[0] : '' }}" required>

                        <!-- Custom Searchable Select Component -->
                        <div class="custom-select-container" id="custom-jobdesc-select">
                            <!-- Trigger / Visible Text Input -->
                            <div class="custom-select-trigger" onclick="toggleDropdown(event)">
                                @php
                                    $defaultText = '';
                                    if(count($assignedJobdescIds) > 0) {
                                        $selectedJd = $jobdescs->firstWhere('id', $assignedJobdescIds[0]);
                                        if($selectedJd) {
                                            $defaultText = $selectedJd->name . ' (' . $selectedJd->items->count() . ' Poin KPI)';
                                        }
                                    }
                                @endphp
                                <input type="text" id="jobdesc-search-input" placeholder="Cari & pilih Job Description..." value="{{ $defaultText }}" autocomplete="off" oninput="filterOptions(this.value)">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>

                            <!-- Options Dropdown Box -->
                            <div class="custom-select-dropdown" id="custom-jobdesc-dropdown">
                                <div class="custom-select-option" data-value="" onclick="selectOption(this, event)" style="color: var(--text-secondary); font-style: italic;">
                                    - Pilih Job Description -
                                </div>
                                @foreach($jobdescs as $jd)
                                    @php $isSelected = in_array($jd->id, $assignedJobdescIds); @endphp
                                    <div class="custom-select-option {{ $isSelected ? 'selected' : '' }}" 
                                         data-value="{{ $jd->id }}" 
                                         data-name="{{ strtolower($jd->name) }}" 
                                         onclick="selectOption(this, event)">
                                        {{ $jd->name }} ({{ $jd->items->count() }} Poin KPI)
                                    </div>
                                @endforeach
                        </div>
                    </div>

                    <!-- KPI Items & Off Days Settings Container (Dinamis via JS) -->
                    <div id="kpi-items-offdays-section" style="display: none; flex-direction: column; gap: 0.75rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary);"><i class="fa-solid fa-calendar-xmark" style="color: var(--accent-blue);"></i> Pengaturan Hari Libur (Off-Days) per Poin KPI</label>
                        <p style="font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Pilih tanggal di mana poin KPI tersebut <b>tidak aktif</b> (libur) untuk pengajar ini. Gunakan tombol bulan untuk navigasi kalender di tiap item.</p>
                        
                        <div id="kpi-items-offdays-container" style="display: flex; flex-direction: column; gap: 1.5rem;">
                            <!-- Dinamis via JS -->
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div style="display: flex; justify-content: flex-end; margin-top: 2rem; margin-bottom:2rem">
                        <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 42px; border-radius: 10px; padding: 0 2rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); font-weight: 850; font-size: 0.9rem; gap: 0.5rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <script>
        // Data from PHP
        const allJobdescs = @json($jobdescs);
        const allPeriods = @json($periods);
        const savedOffDays = @json($assignmentOffDays); // [period_id][item_id] => ['Y-m-d', ...]
        const assignedPeriodIds = @json($assignedPeriodIds);

        // Track currently selected period IDs (from checkboxes)
        function getSelectedPeriodIds() {
            return Array.from(document.querySelectorAll('input[name="teacher_kpi_period_ids[]"]:checked')).map(cb => parseInt(cb.value));
        }

        // Calendar state per item
        const calendarState = {}; // item_id => { year, month }

        // ---- Custom Jobdesc Select Dropdown ----
        const selectContainer = document.getElementById('custom-jobdesc-select');
        const selectDropdown = document.getElementById('custom-jobdesc-dropdown');
        const searchInput = document.getElementById('jobdesc-search-input');
        const hiddenInput = document.getElementById('assigned-jobdesc-id-val');

        function toggleDropdown(event) {
            event.stopPropagation();
            const isOpen = selectContainer.classList.contains('open');
            if (isOpen) closeDropdown();
            else openDropdown();
        }

        function openDropdown() {
            selectContainer.classList.add('open');
            selectDropdown.classList.add('show');
            searchInput.focus();
        }

        function closeDropdown() {
            selectContainer.classList.remove('open');
            selectDropdown.classList.remove('show');
        }

        function filterOptions(query) {
            openDropdown();
            const lowerQuery = query.toLowerCase().trim();
            selectDropdown.querySelectorAll('.custom-select-option').forEach(opt => {
                const optName = opt.getAttribute('data-name');
                if (!optName) return;
                opt.style.display = optName.includes(lowerQuery) ? 'block' : 'none';
            });
        }

        function selectOption(element, event) {
            event.stopPropagation();
            const value = element.getAttribute('data-value');
            const text = element.textContent.trim();

            hiddenInput.value = value;
            searchInput.value = value === '' ? '' : text;

            selectDropdown.querySelectorAll('.custom-select-option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');

            closeDropdown();
            renderOffDaysSection(value ? parseInt(value) : null);
        }

        document.addEventListener('click', function(e) {
            if (!selectContainer.contains(e.target)) closeDropdown();
        });

        // ---- Period checkboxes: re-render when changed ----
        document.querySelectorAll('input[name="teacher_kpi_period_ids[]"]').forEach(cb => {
            cb.addEventListener('change', () => {
                const jobdescId = hiddenInput.value ? parseInt(hiddenInput.value) : null;
                renderOffDaysSection(jobdescId);
            });
        });

        // ---- Render Off-Days Section ----
        function renderOffDaysSection(jobdescId) {
            const section = document.getElementById('kpi-items-offdays-section');
            const container = document.getElementById('kpi-items-offdays-container');
            container.innerHTML = '';

            if (!jobdescId) {
                section.style.display = 'none';
                return;
            }

            const jd = allJobdescs.find(j => j.id === jobdescId);
            if (!jd || !jd.items || jd.items.length === 0) {
                section.style.display = 'none';
                return;
            }

            const selectedPeriodIds = getSelectedPeriodIds();
            if (selectedPeriodIds.length === 0) {
                section.style.display = 'none';
                return;
            }

            section.style.display = 'flex';

            jd.items.forEach(item => {
                const itemCard = document.createElement('div');
                itemCard.style.cssText = 'background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 14px; padding: 1.25rem; display: flex; flex-direction: column; gap: 0.75rem;';

                // Item header
                const header = document.createElement('div');
                header.style.cssText = 'display: flex; align-items: center; gap: 0.5rem;';
                header.innerHTML = `<span style="font-weight: 800; font-size: 0.9rem; color: var(--text-primary);"><i class="fa-solid fa-check-square" style="color: var(--accent-blue);"></i> ${item.name}</span><span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 700; margin-left: auto;">Bobot: ${item.weight}%</span>`;
                itemCard.appendChild(header);

                // Per period calendars
                selectedPeriodIds.forEach(periodId => {
                    const period = allPeriods.find(p => p.id === periodId);
                    if (!period) return;

                    const calKey = `${periodId}_${item.id}`;
                    if (!calendarState[calKey]) {
                        const start = new Date(period.start_date + 'T00:00:00');
                        calendarState[calKey] = { year: start.getFullYear(), month: start.getMonth() };
                    }

                    const existingOffDays = (savedOffDays[periodId] && savedOffDays[periodId][item.id]) ? savedOffDays[periodId][item.id] : [];

                    const periodWrap = document.createElement('div');
                    periodWrap.setAttribute('data-cal-key', calKey);
                    periodWrap.setAttribute('data-period-id', periodId);
                    periodWrap.setAttribute('data-item-id', item.id);
                    periodWrap.setAttribute('data-period-start', period.start_date);
                    periodWrap.setAttribute('data-period-end', period.end_date);
                    periodWrap.style.cssText = 'background: var(--bg-secondary); border-radius: 10px; padding: 0.75rem; display: flex; flex-direction: column; gap: 0.5rem;';
                    periodWrap.innerHTML = `<div style="font-size: 0.78rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 0.25rem;"><i class="fa-solid fa-calendar-days"></i> ${period.name} <span style="font-weight: 500;">(${period.start_date} s/d ${period.end_date})</span></div>`;

                    const calDiv = document.createElement('div');
                    calDiv.className = 'offday-calendar';
                    calDiv.setAttribute('data-cal-key', calKey);
                    renderCalendar(calDiv, calKey, item.id, periodId, period.start_date, period.end_date, existingOffDays);
                    periodWrap.appendChild(calDiv);

                    itemCard.appendChild(periodWrap);
                });

                container.appendChild(itemCard);
            });
        }

        // ---- Render mini calendar for a specific period + item ----
        function renderCalendar(container, calKey, itemId, periodId, startDate, endDate, currentOffDays) {
            container.innerHTML = '';
            const state = calendarState[calKey];
            const year = state.year;
            const month = state.month;

            const periodStart = new Date(startDate + 'T00:00:00');
            const periodEnd = new Date(endDate + 'T00:00:00');

            // Month nav header
            const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            const navHeader = document.createElement('div');
            navHeader.style.cssText = 'display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.35rem;';
            navHeader.innerHTML = `
                <button type="button" onclick="prevMonth('${calKey}', ${itemId}, ${periodId}, '${startDate}', '${endDate}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 6px; width: 24px; height: 24px; cursor: pointer; color: var(--text-secondary); font-size: 0.7rem; display:flex; align-items:center; justify-content:center;">&lt;</button>
                <span style="font-size: 0.78rem; font-weight: 800; color: var(--text-primary);">${monthNames[month]} ${year}</span>
                <button type="button" onclick="nextMonth('${calKey}', ${itemId}, ${periodId}, '${startDate}', '${endDate}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 6px; width: 24px; height: 24px; cursor: pointer; color: var(--text-secondary); font-size: 0.7rem; display:flex; align-items:center; justify-content:center;">&gt;</button>
            `;
            container.appendChild(navHeader);

            // Day labels
            const dayNames = ['M','S','R','K','J','S','A'];
            const dayGrid = document.createElement('div');
            dayGrid.style.cssText = 'display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px;';
            dayNames.forEach(d => {
                const lbl = document.createElement('div');
                lbl.style.cssText = 'text-align: center; font-size: 0.65rem; font-weight: 700; color: var(--text-secondary); padding: 2px 0;';
                lbl.textContent = d;
                dayGrid.appendChild(lbl);
            });

            // First day offset (0=Sun, shift to Mon=0)
            const firstDay = new Date(year, month, 1).getDay(); // 0=Sun
            const startOffset = (firstDay === 0) ? 6 : firstDay - 1; // Mon=0..Sun=6
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Blanks before first
            for (let i = 0; i < startOffset; i++) {
                const blank = document.createElement('div');
                dayGrid.appendChild(blank);
            }

            // Day cells
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

        function prevMonth(calKey, itemId, periodId, startDate, endDate) {
            const state = calendarState[calKey];
            if (state.month === 0) { state.month = 11; state.year--; }
            else { state.month--; }
            refreshCalendar(calKey, itemId, periodId, startDate, endDate);
        }

        function nextMonth(calKey, itemId, periodId, startDate, endDate) {
            const state = calendarState[calKey];
            if (state.month === 11) { state.month = 0; state.year++; }
            else { state.month++; }
            refreshCalendar(calKey, itemId, periodId, startDate, endDate);
        }

        function refreshCalendar(calKey, itemId, periodId, startDate, endDate) {
            // Collect current checked off days before re-render
            const calContainer = document.querySelector(`.offday-calendar[data-cal-key="${calKey}"]`);
            if (!calContainer) return;
            const currentOffDays = Array.from(calContainer.querySelectorAll('input[type=checkbox]:checked')).map(cb => cb.value);
            renderCalendar(calContainer, calKey, itemId, periodId, startDate, endDate, currentOffDays);
        }

        // ---- Init on page load ----
        window.addEventListener('DOMContentLoaded', () => {
            const initJobdescId = hiddenInput.value ? parseInt(hiddenInput.value) : null;
            if (initJobdescId) renderOffDaysSection(initJobdescId);
        });
    </script>
</body>
</html>
