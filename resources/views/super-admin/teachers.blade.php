<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengajar - SIAPIT</title>
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
                    <h1>Pengaturan Akun Pengajar</h1>
                    <p>Kelola data akun Ustadz / Mentor pembimbing matrikulasi dan kelas utama.</p>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="dashboard-panel" style="width: 100%;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 class="panel-title" style="margin-bottom: 0;"><i class="fa-solid fa-chalkboard-user"></i> Daftar Akun Pengajar</h3>
                    <button onclick="openTeacherModal()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.25rem; font-weight: 800; font-size: 0.85rem; cursor: pointer; transition: var(--transition); gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                        <i class="fa-solid fa-plus"></i> Tambah Pengajar
                    </button>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Username / No. Induk</th>
                                <th>Email</th>
                                <th>No. WhatsApp</th>
                                <th style="width: 120px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $tch)
                                <tr>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text-primary); margin-bottom: 0.25rem;">{{ $tch->name }}</div>
                                        <span style="font-size: 0.75rem; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 0.15rem 0.5rem; border-radius: 6px; font-weight: 700; color: var(--accent-blue);">{{ $tch->teacher_type ?? 'Ustadz' }}</span>
                                    </td>
                                    <td>
                                        <code style="font-size: 0.9rem; color: var(--accent-blue); font-weight: 700;">{{ $tch->username }}</code>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--text-secondary);">{{ $tch->email }}</div>
                                    </td>
                                    <td>
                                        @if($tch->whatsapp)
                                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $tch->whatsapp) }}" target="_blank" style="color: var(--accent-blue); font-weight: 700; display: inline-flex; align-items: center; gap: 0.35rem;">
                                                <i class="fa-brands fa-whatsapp" style="font-size: 1.1rem; color: #25d366;"></i> {{ $tch->whatsapp }}
                                            </a>
                                        @else
                                            <span style="color: var(--text-secondary); font-size: 0.9rem;">-</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                            <button onclick="openTeacherModal({{ $tch->id }}, '{{ $tch->name }}', '{{ $tch->username }}', '{{ $tch->email }}', '{{ $tch->whatsapp }}', '{{ $tch->teacher_type ?? 'Ustadz' }}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 34px; height: 34px; border-radius: 8px; cursor: pointer; color: var(--accent-blue); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <form action="{{ route('super-admin.settings.teachers.destroy', $tch->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pengajar ini?')" style="margin: 0; display: inline;">
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
                                    <td colspan="4" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada akun Pengajar terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL TEACHER -->
    <div id="teacher-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 450px; padding: 2rem; position: relative;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" onclick="closeTeacherModal()" type="button"><i class="fa-solid fa-xmark"></i></button>
            <h3 id="teacher-modal-title" style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem;">Tambah Akun Pengajar</h3>
            <form id="teacher-form" method="POST" action="{{ route('super-admin.settings.teachers.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem; text-align: left;">
                @csrf
                <input type="hidden" name="_method" id="teacher-form-method" value="POST">
                
                <!-- Nama -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="tch-name" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <input type="text" name="name" id="tch-name" required placeholder="Nama Lengkap Ustadz/Mentor">
                    </div>
                </div>

                <!-- Username (NIP) -->
                <div id="username-container" style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="tch-username" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Username / No. Induk <span style="font-weight: 500; font-size: 0.75rem; color: var(--text-secondary);">(Otomatis/Read-Only)</span></label>
                    <div class="input-wrapper" style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); opacity: 0.8;">
                        <input type="text" id="tch-username" readonly style="cursor: not-allowed; font-weight: 700; color: var(--accent-blue);">
                    </div>
                </div>

                <!-- Email -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="tch-email" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Email</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" id="tch-email" required placeholder="Contoh: ahmad@pondokit.com">
                    </div>
                </div>

                <!-- WhatsApp -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="tch-whatsapp" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">No. WhatsApp</label>
                    <div class="input-wrapper" style="display: flex; align-items: center; gap: 0.5rem; padding-left: 1.25rem;">
                        <div style="display: flex; align-items: center; gap: 0.35rem; font-weight: 700; color: var(--text-secondary); font-size: 0.9rem; border-right: 1.5px solid #d1d9e6; padding-right: 0.75rem; height: 100%; user-select: none;">
                            <span style="font-size: 1.1rem; line-height: 1;">🇮🇩</span>
                            <span>+62</span>
                        </div>
                        <input type="text" name="whatsapp" id="tch-whatsapp" required placeholder="81234567890" style="box-shadow: none; background: transparent; padding-left: 0.25rem; width: 100%; border: none;">
                    </div>
                </div>

                <!-- Role Mentor / Tipe Pengajar -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="tch-type" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Role Mentor / Tipe</label>
                    <div class="input-wrapper">
                        <input type="text" name="teacher_type" id="tch-type" required placeholder="Contoh: Ustadz, Mentor Karakter, Mentor IT">
                    </div>
                </div>

                <!-- Password -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="tch-password" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Password <span id="pwd-help" style="font-weight: 500; font-size: 0.75rem; color: var(--accent-blue); display: none;">(Kosongkan jika tidak diubah)</span></label>
                    <div class="input-wrapper" style="position: relative; display: flex; align-items: center;">
                        <input type="password" name="password" id="tch-password" placeholder="Minimal 6 karakter" style="width: 100%; padding-right: 3.5rem;">
                        <button type="button" id="toggle-pwd-btn" style="position: absolute; right: 1rem; background: none; border: none; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; z-index: 5;">
                            <i class="fa-solid fa-eye" id="pwd-eye-icon"></i>
                        </button>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1rem;">
                    <button type="button" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.5rem; font-weight: 700; font-size: 0.85rem; cursor: pointer; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'" onclick="closeTeacherModal()">Batal</button>
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

        const teacherOverlay = document.getElementById('teacher-modal-overlay');
        const teacherForm = document.getElementById('teacher-form');
        const teacherFormMethod = document.getElementById('teacher-form-method');
        const teacherModalTitle = document.getElementById('teacher-modal-title');
        const nameInput = document.getElementById('tch-name');
        const usernameInput = document.getElementById('tch-username');
        const emailInput = document.getElementById('tch-email');
        const whatsappInput = document.getElementById('tch-whatsapp');
        const typeSelect = document.getElementById('tch-type');
        const passwordInput = document.getElementById('tch-password');
        const pwdHelp = document.getElementById('pwd-help');

        // Toggle Password visibility
        const togglePwdBtn = document.getElementById('toggle-pwd-btn');
        const pwdEyeIcon = document.getElementById('pwd-eye-icon');
        togglePwdBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                pwdEyeIcon.className = 'fa-solid fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                pwdEyeIcon.className = 'fa-solid fa-eye';
            }
        });

        function openTeacherModal(id = null, name = '', username = '', email = '', whatsapp = '', type = '') {
            const usernameContainer = document.getElementById('username-container');
            // Reset password toggle view
            passwordInput.type = 'password';
            pwdEyeIcon.className = 'fa-solid fa-eye';

            if (id) {
                teacherModalTitle.textContent = 'Edit Akun Pengajar';
                teacherForm.action = `/super-admin/settings/teachers/${id}`;
                teacherFormMethod.value = 'PUT';
                nameInput.value = name;
                usernameInput.value = username;
                emailInput.value = email;
                
                // Strip prefix for the +62 layout
                let waSuffix = whatsapp;
                if (waSuffix.startsWith('+62')) {
                    waSuffix = waSuffix.substring(3);
                } else if (waSuffix.startsWith('62')) {
                    waSuffix = waSuffix.substring(2);
                } else if (waSuffix.startsWith('0')) {
                    waSuffix = waSuffix.substring(1);
                }
                whatsappInput.value = waSuffix;

                typeSelect.value = type;
                passwordInput.value = '';
                passwordInput.required = false;
                pwdHelp.style.display = 'inline';
                usernameContainer.style.display = 'flex';
            } else {
                teacherModalTitle.textContent = 'Tambah Akun Pengajar';
                teacherForm.action = "{{ route('super-admin.settings.teachers.store') }}";
                teacherFormMethod.value = 'POST';
                nameInput.value = '';
                usernameInput.value = '';
                emailInput.value = '';
                whatsappInput.value = '';
                typeSelect.value = '';
                passwordInput.value = '';
                passwordInput.required = true;
                pwdHelp.style.display = 'none';
                usernameContainer.style.display = 'none';
            }
            teacherOverlay.style.display = 'flex';
        }

        function closeTeacherModal() {
            teacherOverlay.style.display = 'none';
        }
    </script>
</body>
</html>
