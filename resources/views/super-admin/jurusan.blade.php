<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jurusan - SIAPIT</title>
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
                    <h1>Daftar Jurusan</h1>
                    <p>Kelola klasifikasi jurusan atau program keahlian santri di Pondok IT.</p>
                </div>
                
                <button class="btn-logout" id="open-add-modal" style="color: var(--accent-blue); padding: 0.85rem 1.5rem; display: flex; gap: 0.5rem; align-items: center; border-radius: 12px; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-plus"></i> Tambah Jurusan
                </button>
            </header>
            
            <!-- Toast Container -->
            <div id="toast-container" style="position: fixed; bottom: 2rem; right: 2rem; display: flex; flex-direction: column; gap: 0.75rem; z-index: 9999; pointer-events: none;"></div>

            <!-- Content Panel -->
            <div class="card-nm" style="width: 100%;">
                <h3 class="panel-title"><i class="fa-solid fa-layer-group"></i> Daftar Jurusan Pondok IT</h3>
                <div class="table-container">
                    <table id="majors-table">
                        <thead>
                            <tr>
                                <th>Nama Jurusan</th>
                                <th>Program Pendidikan</th>
                                <th>Deskripsi</th>
                                <th style="width: 180px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($majors as $major)
                                <tr id="major-row-{{ $major->id }}">
                                    <td><strong>{{ $major->name }}</strong></td>
                                    <td>
                                        <span class="role-badge santri" style="font-size: 0.8rem; padding: 0.35rem 0.75rem;">
                                            {{ $major->educationProgram->name }}
                                        </span>
                                    </td>
                                    <td><span style="color: var(--text-secondary); font-size: 0.85rem;">{{ $major->description ?? '-' }}</span></td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; gap: 0.75rem; justify-content: center;">
                                            <button class="edit-btn" data-id="{{ $major->id }}" data-name="{{ $major->name }}" data-program="{{ $major->education_program_id }}" data-desc="{{ $major->description }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-blue); transition: var(--transition);">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button class="delete-btn" data-id="{{ $major->id }}" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-red); transition: var(--transition);">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-row">
                                    <td colspan="4" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada jurusan yang terdaftar.</td>
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
            <h3 id="modal-title" style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800;"><i class="fa-solid fa-layer-group"></i> Tambah Jurusan</h3>
            
            <form id="major-form">
                <input type="hidden" id="major-id">
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem; text-align: left;">
                    <label for="form-name" style="font-size: 0.85rem; font-weight: 700; padding-left: 0.25rem;">Nama Jurusan</label>
                    <div class="input-wrapper">
                        <input type="text" id="form-name" required placeholder="Contoh: Mobile Developer">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem; text-align: left;">
                    <label for="form-program" style="font-size: 0.85rem; font-weight: 700; padding-left: 0.25rem;">Program Pendidikan</label>
                    <div class="input-wrapper">
                        <select id="form-program" required>
                            <option value="" disabled selected>Pilih Program...</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->name }} ({{ $program->duration_years }} Tahun)</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.5rem; text-align: left;">
                    <label for="form-desc" style="font-size: 0.85rem; font-weight: 700; padding-left: 0.25rem;">Deskripsi</label>
                    <div class="input-wrapper">
                        <textarea id="form-desc" placeholder="Tuliskan deskripsi singkat jurusan..." style="width: 100%; min-height: 100px; padding: 0.9rem 1.25rem; border-radius: 12px; border: none; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); color: var(--text-primary); font-family: var(--font-body); font-size: 0.95rem; font-weight: 600; outline: none; transition: var(--transition); resize: vertical;"></textarea>
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
                Apakah Anda yakin ingin menghapus jurusan ini? Tindakan ini tidak dapat dibatalkan.
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
            const form = document.getElementById('major-form');
            
            const modalTitle = document.getElementById('modal-title');
            const majorIdInput = document.getElementById('major-id');
            const nameInput = document.getElementById('form-name');
            const programSelect = document.getElementById('form-program');
            const descInput = document.getElementById('form-desc');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const showModal = (editMode = false) => {
                overlay.style.display = 'flex';
                if (!editMode) {
                    modalTitle.innerHTML = '<i class="fa-solid fa-layer-group"></i> Tambah Jurusan';
                    majorIdInput.value = '';
                    nameInput.value = '';
                    programSelect.value = '';
                    descInput.value = '';
                } else {
                    modalTitle.innerHTML = '<i class="fa-solid fa-pen"></i> Edit Jurusan';
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
                    const programId = this.getAttribute('data-program');
                    const desc = this.getAttribute('data-desc');

                    majorIdInput.value = id;
                    nameInput.value = name;
                    programSelect.value = programId;
                    descInput.value = desc;

                    showModal(true);
                });
            });

            // Save Major (Create/Update)
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const id = majorIdInput.value;
                const name = nameInput.value;
                const education_program_id = programSelect.value;
                const description = descInput.value;

                const url = id ? `/super-admin/jurusan/${id}` : '/super-admin/jurusan';
                const method = id ? 'PUT' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ name, education_program_id, description })
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
            let majorIdToDelete = null;

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    majorIdToDelete = this.getAttribute('data-id');
                    confirmOverlay.style.display = 'flex';
                });
            });

            confirmCancelBtn.addEventListener('click', () => {
                confirmOverlay.style.display = 'none';
                majorIdToDelete = null;
            });

            confirmDeleteBtn.addEventListener('click', async () => {
                if (majorIdToDelete) {
                    const id = majorIdToDelete;
                    confirmOverlay.style.display = 'none';
                    
                    try {
                        const response = await fetch(`/super-admin/jurusan/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();
                        if (response.ok && data.success) {
                            showToast(data.message, 'success');
                            document.getElementById(`major-row-${id}`).remove();
                        } else {
                            throw new Error(data.message || 'Gagal menghapus data.');
                        }
                    } catch (error) {
                        showToast(error.message, 'error');
                    } finally {
                        majorIdToDelete = null;
                    }
                }
            });
        });
    </script>
</body>
</html>
