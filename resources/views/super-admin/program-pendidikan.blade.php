<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Pendidikan - SIAPIT</title>
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
                    <h1>Program Pendidikan</h1>
                    <p>Kelola program keahlian IT yang diajarkan pada Pondok IT.</p>
                </div>
                
                <button class="btn-logout" id="open-add-modal" style="color: var(--accent-blue); padding: 0.85rem 1.5rem; display: flex; gap: 0.5rem; align-items: center; border-radius: 12px; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-plus"></i> Tambah Program
                </button>
            </header>
            
            <!-- Toast Container -->
            <div id="toast-container" style="position: fixed; bottom: 2rem; right: 2rem; display: flex; flex-direction: column; gap: 0.75rem; z-index: 9999; pointer-events: none;"></div>

            <!-- Content Panel -->
            <div class="card-nm" style="width: 100%;">
                <h3 class="panel-title"><i class="fa-solid fa-list"></i> Daftar Program Pendidikan</h3>
                <div class="table-container">
                    <table id="programs-table">
                        <thead>
                            <tr>
                                <th>Nama Program</th>
                                <th>Deskripsi</th>
                                <th style="width: 150px;">Durasi Pendidikan</th>
                                <th style="width: 180px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($programs as $program)
                                <tr id="program-row-{{ $program->id }}">
                                    <td><strong>{{ $program->name }}</strong></td>
                                    <td><span style="color: var(--text-secondary); font-size: 0.85rem;">{{ $program->description ?? '-' }}</span></td>
                                    <td>{{ $program->duration_years }} Tahun</td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; gap: 0.75rem; justify-content: center;">
                                            <button class="edit-btn" data-id="{{ $program->id }}" data-name="{{ $program->name }}" data-desc="{{ $program->description }}" data-duration="{{ $program->duration_years }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-blue); transition: var(--transition);">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button class="delete-btn" data-id="{{ $program->id }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); transition: var(--transition);">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-row">
                                    <td colspan="4" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada program pendidikan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Neumorphic Modal Backdrop & Box -->
    <div id="modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 500px; padding: 2.5rem; display: flex; flex-direction: column; gap: 1.5rem; position: relative;">
            <h3 id="modal-title" style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800;"><i class="fa-solid fa-graduation-cap"></i> Tambah Program</h3>
            
            <form id="program-form">
                <input type="hidden" id="program-id">
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem; text-align: left;">
                    <label for="form-name" style="font-size: 0.85rem; font-weight: 700; padding-left: 0.25rem;">Nama Program</label>
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                        <input type="text" id="form-name" required placeholder="Contoh: Mobile Developer" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem; text-align: left;">
                    <label for="form-desc" style="font-size: 0.85rem; font-weight: 700; padding-left: 0.25rem;">Deskripsi</label>
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                        <textarea id="form-desc" placeholder="Tuliskan deskripsi singkat program..." style="width: 100%; min-height: 100px; padding: 0.9rem 1.25rem; border-radius: 12px; border: none; background: transparent; color: var(--text-primary); font-family: var(--font-body); font-size: 0.95rem; font-weight: 600; outline: none; transition: var(--transition); resize: vertical;"></textarea>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.5rem; text-align: left;">
                    <label for="form-duration" style="font-size: 0.85rem; font-weight: 700; padding-left: 0.25rem;">Durasi Pendidikan (Tahun)</label>
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                        <input type="number" id="form-duration" required min="1" max="10" placeholder="3" style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem; width: 100%;">
                    <button type="button" id="close-modal-btn" class="btn-logout" style="color: var(--text-secondary); width: auto; padding: 0.75rem 1.5rem;">Batal</button>
                    <button type="submit" id="save-modal-btn" class="btn-logout" style="color: var(--accent-blue); width: auto; padding: 0.75rem 1.5rem;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom Neumorphic Delete Confirmation Modal -->
    <div id="confirm-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1001; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 400px; padding: 2.25rem; display: flex; flex-direction: column; gap: 1.5rem; text-align: center; position: relative;">
            <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: var(--accent-red); margin-bottom: 0.5rem;">
                <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.25rem;"></i> Konfirmasi Hapus
            </h3>
            <p style="font-size: 0.95rem; color: var(--text-secondary); font-weight: 600; line-height: 1.5; margin: 0;">
                Apakah Anda yakin ingin menghapus program pendidikan ini? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div style="display: flex; justify-content: center; gap: 1.25rem; width: 100%; margin-top: 0.5rem;">
                <button type="button" id="confirm-cancel-btn" class="btn-logout" style="color: var(--text-secondary); width: auto; padding: 0.75rem 1.75rem; border-radius: 12px; font-size: 0.9rem;">Batal</button>
                <button type="button" id="confirm-delete-btn" class="btn-logout" style="color: var(--accent-red); width: auto; padding: 0.75rem 1.75rem; border-radius: 12px; font-size: 0.9rem;">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar submenu toggles
            const triggers = document.querySelectorAll('.submenu-trigger');
            triggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const parent = trigger.parentElement;
                    parent.classList.toggle('open');
                });
            });

            // Toast Helper function
            const showToast = (message, type = 'success') => {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = 'card-nm';
                toast.style.pointerEvents = 'auto';
                toast.style.padding = '1rem 1.5rem';
                toast.style.display = 'flex';
                toast.style.alignItems = 'center';
                toast.style.gap = '0.75rem';
                toast.style.borderRadius = '12px';
                toast.style.boxShadow = 'var(--nm-flat-sm)';
                toast.style.fontSize = '0.9rem';
                toast.style.fontWeight = '700';
                toast.style.transition = 'all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                
                let icon = 'fa-circle-check';
                let color = 'var(--accent-teal)';
                if (type === 'error') {
                    icon = 'fa-circle-exclamation';
                    color = 'var(--accent-red)';
                }
                
                toast.innerHTML = `<i class="fa-solid ${icon}" style="color: ${color}; font-size: 1.1rem;"></i> <span style="color: var(--text-primary);">${message}</span>`;
                
                container.appendChild(toast);
                
                setTimeout(() => {
                    toast.style.opacity = '1';
                    toast.style.transform = 'translateY(0)';
                }, 50);
                
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(-20px)';
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            };

            // CRUD Modal & AJAX Logic
            const overlay = document.getElementById('modal-overlay');
            const openAddBtn = document.getElementById('open-add-modal');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const form = document.getElementById('program-form');
            
            const modalTitle = document.getElementById('modal-title');
            const programIdInput = document.getElementById('program-id');
            const nameInput = document.getElementById('form-name');
            const descInput = document.getElementById('form-desc');
            const durationInput = document.getElementById('form-duration');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const showModal = (editMode = false) => {
                overlay.style.display = 'flex';
                if (!editMode) {
                    modalTitle.innerHTML = '<i class="fa-solid fa-graduation-cap"></i> Tambah Program';
                    programIdInput.value = '';
                    nameInput.value = '';
                    descInput.value = '';
                    durationInput.value = '3';
                } else {
                    modalTitle.innerHTML = '<i class="fa-solid fa-pen"></i> Edit Program';
                }
            };

            const hideModal = () => {
                overlay.style.display = 'none';
            };

            openAddBtn.addEventListener('click', () => showModal(false));
            closeModalBtn.addEventListener('click', hideModal);
            
            // Edit Button Trigger
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const desc = this.getAttribute('data-desc');
                    const duration = this.getAttribute('data-duration');

                    programIdInput.value = id;
                    nameInput.value = name;
                    descInput.value = desc;
                    durationInput.value = duration;

                    showModal(true);
                });
            });

            // Save Program (Create/Update)
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const id = programIdInput.value;
                const name = nameInput.value;
                const description = descInput.value;
                const duration_years = durationInput.value;

                const url = id ? `/super-admin/program-pendidikan/${id}` : '/super-admin/program-pendidikan';
                const method = id ? 'PUT' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ name, description, duration_years })
                    });

                    const data = await response.json();
                    if (response.ok && data.success) {
                        showToast(data.message, 'success');
                        hideModal();
                        
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data.');
                    }
                } catch (error) {
                    showToast(error.message, 'error');
                }
            });

            // Delete Custom Modal Confirmation Logic
            const confirmOverlay = document.getElementById('confirm-modal-overlay');
            const confirmCancelBtn = document.getElementById('confirm-cancel-btn');
            const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
            let programIdToDelete = null;

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    programIdToDelete = this.getAttribute('data-id');
                    confirmOverlay.style.display = 'flex';
                });
            });

            confirmCancelBtn.addEventListener('click', () => {
                confirmOverlay.style.display = 'none';
                programIdToDelete = null;
            });

            confirmDeleteBtn.addEventListener('click', async () => {
                if (programIdToDelete) {
                    const id = programIdToDelete;
                    confirmOverlay.style.display = 'none';
                    
                    try {
                        const response = await fetch(`/super-admin/program-pendidikan/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();
                        if (response.ok && data.success) {
                            showToast(data.message, 'success');
                            document.getElementById(`program-row-${id}`).remove();
                        } else {
                            throw new Error(data.message || 'Gagal menghapus data.');
                        }
                    } catch (error) {
                        showToast(error.message, 'error');
                    } finally {
                        programIdToDelete = null;
                    }
                }
            });
        });
    </script>
</body>
</html>
