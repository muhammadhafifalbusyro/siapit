<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas - SIAPIT</title>
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
                    <h1>Pengaturan Kelas</h1>
                    <p>Kelola data pembagian kelas berdasarkan Tahun Ajaran, Gelombang, dan Jurusan.</p>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="dashboard-panel" style="width: 100%;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 class="panel-title" style="margin-bottom: 0;"><i class="fa-solid fa-school"></i> Daftar Kelas</h3>
                    <button onclick="openClassroomModal()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.25rem; font-weight: 800; font-size: 0.85rem; cursor: pointer; transition: var(--transition); gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                        <i class="fa-solid fa-plus"></i> Tambah Kelas
                    </button>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Gelombang / Batch</th>
                                <th style="width: 120px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classrooms as $cls)
                                <tr>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text-primary);">{{ $cls->name }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--text-secondary);">{{ $cls->academicYear->name ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--text-secondary);">{{ $cls->batch->name ?? '-' }}</div>
                                    </td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                            <button onclick="openClassroomModal({{ $cls->id }}, '{{ $cls->name }}', {{ $cls->academic_year_id }}, {{ $cls->batch_id }})" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-blue); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <form action="{{ route('super-admin.settings.classrooms.destroy', $cls->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')" style="margin: 0; display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada data Kelas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL CLASSROOM -->
    <div id="classroom-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 450px; padding: 2rem; position: relative;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" onclick="closeClassroomModal()" type="button"><i class="fa-solid fa-xmark"></i></button>
            <h3 id="classroom-modal-title" style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem;">Tambah Kelas</h3>
            <form id="classroom-form" method="POST" action="{{ route('super-admin.settings.classrooms.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem; text-align: left;">
                @csrf
                <input type="hidden" name="_method" id="classroom-form-method" value="POST">
                
                <!-- 1. Tahun Ajaran -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="cls-year-id" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Tahun Ajaran</label>
                    <div class="input-wrapper" style="padding: 0; overflow: hidden;">
                        <select name="academic_year_id" id="cls-year-id" required style="width: 100%; height: 48px; border: none; background: transparent; outline: none; padding: 0 1.25rem; font-family: var(--font-body); color: var(--text-primary); font-weight: 700;">
                            <option value="" disabled selected>Pilih Tahun Ajaran...</option>
                            @foreach($academicYears as $y)
                                <option value="{{ $y->id }}">{{ $y->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 2. Gelombang -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="cls-batch-id" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Gelombang / Batch</label>
                    <div class="input-wrapper" style="padding: 0; overflow: hidden;">
                        <select name="batch_id" id="cls-batch-id" required disabled style="width: 100%; height: 48px; border: none; background: transparent; outline: none; padding: 0 1.25rem; font-family: var(--font-body); color: var(--text-primary); font-weight: 700;">
                            <option value="" disabled selected>Pilih Tahun Ajaran dahulu...</option>
                        </select>
                    </div>
                </div>



                <!-- 4. Nama Kelas -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="cls-name" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Nama Kelas</label>
                    <div class="input-wrapper">
                        <input type="text" name="name" id="cls-name" required placeholder="Contoh: Kelas A / Backend 1">
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1rem;">
                    <button type="button" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.5rem; font-weight: 700; font-size: 0.85rem; cursor: pointer; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" onclick="closeClassroomModal()">Batal</button>
                    <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.5rem; font-weight: 800; font-size: 0.85rem; cursor: pointer; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dropdown menu handles
            const submenuTriggers = document.querySelectorAll('.submenu-trigger');
            submenuTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const parent = trigger.parentElement;
                    parent.classList.toggle('open');
                });
            });
        });

        // Store all batches locally in JS for dynamic filtering
        const allBatches = @json($batches);

        const yearSelect = document.getElementById('cls-year-id');
        const batchSelect = document.getElementById('cls-batch-id');
        const classroomOverlay = document.getElementById('classroom-modal-overlay');
        const classroomForm = document.getElementById('classroom-form');
        const classroomFormMethod = document.getElementById('classroom-form-method');
        const classroomModalTitle = document.getElementById('classroom-modal-title');
        const classroomNameInput = document.getElementById('cls-name');

        // Dynamic Batch Loader
        yearSelect.addEventListener('change', () => {
            loadBatchesForYear(yearSelect.value);
        });

        function loadBatchesForYear(yearId, selectedBatchId = null) {
            batchSelect.innerHTML = '';
            const filtered = allBatches.filter(b => b.academic_year_id == yearId);
            
            if (filtered.length > 0) {
                const opt = document.createElement('option');
                opt.value = "";
                opt.textContent = "Pilih Gelombang...";
                opt.disabled = true;
                opt.selected = !selectedBatchId;
                batchSelect.appendChild(opt);

                filtered.forEach(b => {
                    const option = document.createElement('option');
                    option.value = b.id;
                    option.textContent = b.name;
                    if (selectedBatchId && b.id == selectedBatchId) {
                        option.selected = true;
                    }
                    batchSelect.appendChild(option);
                });
                batchSelect.disabled = false;
            } else {
                const opt = document.createElement('option');
                opt.value = "";
                opt.textContent = "Tidak ada Gelombang terdaftar.";
                opt.disabled = true;
                opt.selected = true;
                batchSelect.appendChild(opt);
                batchSelect.disabled = true;
            }
        }

        function openClassroomModal(id = null, name = '', yearId = '', batchId = '') {
            if (id) {
                classroomModalTitle.textContent = 'Edit Kelas';
                classroomForm.action = `/super-admin/settings/classrooms/${id}`;
                classroomFormMethod.value = 'PUT';
                classroomNameInput.value = name;
                yearSelect.value = yearId;
                
                // Pre-load batches for the selected year and select the active batch
                loadBatchesForYear(yearId, batchId);
            } else {
                classroomModalTitle.textContent = 'Tambah Kelas';
                classroomForm.action = "{{ route('super-admin.settings.classrooms.store') }}";
                classroomFormMethod.value = 'POST';
                classroomNameInput.value = '';
                yearSelect.value = '';
                batchSelect.innerHTML = '<option value="" disabled selected>Pilih Tahun Ajaran dahulu...</option>';
                batchSelect.disabled = true;
            }
            classroomOverlay.style.display = 'flex';
        }

        function closeClassroomModal() {
            classroomOverlay.style.display = 'none';
        }
    </script>
</body>
</html>
