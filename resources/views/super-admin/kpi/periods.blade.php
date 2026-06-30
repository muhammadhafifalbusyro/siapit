<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Periode KPI - SIAPIT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
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
                    <h1>Manajemen Periode KPI</h1>
                    <p>Atur periode evaluasi penilaian kinerja mentor/pengajar beserta hari libur resminya.</p>
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

            <div class="dashboard-grid">
                <!-- Left: Form CRUD Period -->
                <div class="dashboard-panel">
                    <h3 class="panel-title" id="period-form-title"><i class="fa-solid fa-calendar-plus"></i> Tambah Periode KPI</h3>
                    <form id="period-form" method="POST" action="{{ route('super-admin.kpi.periods.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        <input type="hidden" name="_method" id="period-form-method" value="POST">
                        
                        <div class="input-group">
                            <label>Nama Periode</label>
                            <div class="input-wrapper">
                                <input type="text" name="name" id="period-name" required placeholder="Contoh: Juli 2026 / Triwulan I">
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="input-group">
                                <label>Tanggal Mulai</label>
                                <div class="input-wrapper">
                                    <input type="date" name="start_date" id="period-start-date" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Tanggal Selesai</label>
                                <div class="input-wrapper">
                                    <input type="date" name="end_date" id="period-end-date" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group" style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label>Pilih Hari Libur / Off Day (Tanggal Merah & Akhir Pekan)</label>
                            <div id="off-days-checklist-container" style="max-height: 200px; overflow-y: auto; padding: 0.75rem; border-radius: 12px; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); display: flex; flex-direction: column; gap: 0.5rem;">
                                <span style="font-size: 0.8rem; color: var(--text-secondary); font-style: italic;">Pilih tanggal mulai & selesai terlebih dahulu...</span>
                            </div>
                        </div>
                        
                        <div style="margin-top: 0.5rem; display: flex; gap: 0.5rem; margin-bottom: 20px">
                            <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--accent-blue); transition: var(--transition); font-weight: 800; font-size: 0.85rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" id="period-submit-btn">
                                <i class="fa-solid fa-plus"></i> Simpan Periode
                            </button>
                            <button type="button" style="border: none; background: transparent; box-shadow: var(--nm-flat-sm); display: none; align-items: center; justify-content: center; height: 38px; border-radius: 8px; padding: 0 1.25rem; cursor: pointer; color: var(--text-secondary); transition: var(--transition); font-weight: 700; font-size: 0.85rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" id="period-cancel-btn" onclick="resetPeriodForm()">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right: Periods List -->
                <div class="dashboard-panel">
                    <h3 class="panel-title"><i class="fa-solid fa-calendar-days"></i> Daftar Periode Penilaian</h3>
                    
                    <div class="table-container" style="box-shadow: none; border: 1.5px solid #d1d9e6;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Periode</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th style="width: 80px; text-align: center;">Libur</th>
                                    <th style="width: 90px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($periods as $p)
                                    <tr>
                                        <td style="font-weight: 700; color: var(--text-primary);">{{ $p->name }}</td>
                                        <td>{{ $p->start_date }}</td>
                                        <td>{{ $p->end_date }}</td>
                                        <td style="text-align: center; font-weight: 700; color: var(--accent-red);">{{ is_array($p->off_days) ? count($p->off_days) : 0 }} Hari</td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                                <button class="edit-period-btn" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 28px; height: 28px; border-radius: 6px; cursor: pointer; color: var(--accent-blue); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-start-date="{{ $p->start_date }}" data-end-date="{{ $p->end_date }}" data-off-days="{{ json_encode($p->off_days ?? []) }}" title="Edit Periode"><i class="fa-solid fa-pen"></i></button>
                                                <form method="POST" action="{{ route('super-admin.kpi.periods.destroy', $p->id) }}" onsubmit="return confirm('Hapus Periode KPI ini? Semua data jobdesc dan laporan didalamnya akan terhapus permanen.')" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 28px; height: 28px; border-radius: 6px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Hapus Periode"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 1.5rem 0;">Belum ada data periode. Buat periode baru di sebelah kiri.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        // off-days checklist generator
        const startDateInput = document.getElementById('period-start-date');
        const endDateInput = document.getElementById('period-end-date');
        const checklistContainer = document.getElementById('off-days-checklist-container');

        function generateOffDaysChecklist(selectedDates = []) {
            if (!startDateInput || !endDateInput || !checklistContainer) return;
            const startVal = startDateInput.value;
            const endVal = endDateInput.value;
            
            if (!startVal || !endVal) {
                checklistContainer.innerHTML = '<span style="font-size: 0.8rem; color: var(--text-secondary); font-style: italic;">Pilih tanggal mulai & selesai terlebih dahulu...</span>';
                return;
            }

            const start = new Date(startVal);
            const end = new Date(endVal);

            if (start > end) {
                checklistContainer.innerHTML = '<span style="font-size: 0.8rem; color: var(--accent-red); font-style: italic;">Tanggal selesai harus setelah atau sama dengan tanggal mulai!</span>';
                return;
            }

            checklistContainer.innerHTML = '';
            const dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            
            let current = new Date(start);
            let limit = 0;
            while (current <= end && limit < 366) {
                limit++;
                const dateString = current.toISOString().split('T')[0];
                const dayIndex = current.getDay();
                const dayName = dayNames[dayIndex];
                
                const isWeekend = dayIndex === 0 || dayIndex === 6;
                const isChecked = selectedDates.length > 0 ? selectedDates.includes(dateString) : isWeekend;

                const label = document.createElement('label');
                label.style.display = 'flex';
                label.style.alignItems = 'center';
                label.style.gap = '0.5rem';
                label.style.fontSize = '0.85rem';
                label.style.cursor = 'pointer';
                label.style.padding = '0.35rem 0.5rem';
                label.style.borderRadius = '6px';
                label.style.transition = 'var(--transition)';
                label.onmouseover = function() { this.style.background = 'var(--bg-secondary)'; };
                label.onmouseout = function() { this.style.background = 'transparent'; };

                const isWeekendColor = isWeekend ? 'color: var(--accent-red); font-weight: 700;' : 'color: var(--text-primary);';

                label.innerHTML = `
                    <input type="checkbox" name="off_days[]" value="${dateString}" ${isChecked ? 'checked' : ''} style="cursor: pointer;">
                    <span style="${isWeekendColor}">${dateString} (${dayName})</span>
                `;
                checklistContainer.appendChild(label);

                current.setDate(current.getDate() + 1);
            }
        }

        if (startDateInput && endDateInput) {
            startDateInput.addEventListener('change', () => generateOffDaysChecklist());
            endDateInput.addEventListener('change', () => generateOffDaysChecklist());
        }

        // Period edit helper
        document.querySelectorAll('.edit-period-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const startDate = this.getAttribute('data-start-date');
                const endDate = this.getAttribute('data-end-date');
                let offDays = [];
                try {
                    offDays = JSON.parse(this.getAttribute('data-off-days') || '[]');
                } catch(e) {
                    offDays = [];
                }
                
                document.getElementById('period-form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Periode KPI';
                const form = document.getElementById('period-form');
                form.action = `/super-admin/kpi/periods/${id}`;
                document.getElementById('period-form-method').value = 'PUT';
                document.getElementById('period-name').value = name;
                document.getElementById('period-start-date').value = startDate;
                document.getElementById('period-end-date').value = endDate;
                
                generateOffDaysChecklist(offDays);

                document.getElementById('period-submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
                document.getElementById('period-cancel-btn').style.display = 'inline-flex';
            });
        });

        function resetPeriodForm() {
            document.getElementById('period-form-title').innerHTML = '<i class="fa-solid fa-calendar-plus"></i> Tambah Periode KPI';
            const form = document.getElementById('period-form');
            form.action = "{{ route('super-admin.kpi.periods.store') }}";
            document.getElementById('period-form-method').value = 'POST';
            document.getElementById('period-name').value = '';
            document.getElementById('period-start-date').value = '';
            document.getElementById('period-end-date').value = '';
            
            if (checklistContainer) {
                checklistContainer.innerHTML = '<span style="font-size: 0.8rem; color: var(--text-secondary); font-style: italic;">Pilih tanggal mulai & selesai terlebih dahulu...</span>';
            }

            document.getElementById('period-submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Simpan Periode';
            document.getElementById('period-cancel-btn').style.display = 'none';
        }
    </script>
</body>
</html>
