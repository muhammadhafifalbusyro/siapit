<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelas & Peserta - SIAPIT</title>
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
                    <h1>Pembagian Kelas & Peserta Pendidikan</h1>
                    <p>Kelompokkan calon santri ke dalam grup bimbingan pendidikan beserta penetapan wali kelas.</p>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--nm-flat-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Filter Period -->
            <div class="dashboard-panel" style="width: 100%; margin-bottom: 1.5rem; padding: 1.25rem 1.5rem;">
                <form method="GET" action="{{ route('super-admin.education.classrooms') }}" style="display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: flex-end;">
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

            @if(!$activePeriod)
                <div class="dashboard-panel" style="width: 100%; text-align: center; padding: 4rem 2rem;">
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset); width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; color: var(--accent-red);">
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem;"></i>
                    </div>
                    <h2 style="font-family: var(--font-heading); font-size: 1.4rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.5rem;">Masa Pendidikan Belum Dikonfigurasi</h2>
                    <p style="color: var(--text-secondary); max-width: 450px; margin: 0 auto 1.5rem; line-height: 1.6; font-weight: 500;">
                        Silakan atur periode aktif dan aspek bobot penilaian terlebih dahulu pada menu Pengaturan Periode.
                    </p>
                    <a href="{{ route('super-admin.education.settings') }}" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); padding: 0.75rem 2rem; border-radius: 10px; font-weight: 800; font-size: 0.9rem; transition: var(--transition);" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                        Ke Pengaturan Periode
                    </a>
                </div>
            @else
                <div style="display: grid; grid-template-columns: 1.7fr 1.3fr; gap: 1.5rem; align-items: flex-start; width: 100%;">
                    <!-- Left Side: Classroom List Cards -->
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; color: var(--text-primary); margin: 0;"><i class="fa-solid fa-school"></i> Kelas Terdaftar ({{ $classrooms->count() }})</h3>
                        
                        @forelse($classrooms as $cls)
                            @php
                                $classStudents = $allStudents->where('classroom_id', $cls->id);
                                $assistantIds = $cls->assistantTeachers->pluck('id')->toJson();
                            @endphp
                            <div class="card-nm" style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1.5px solid #d1d9e6; padding-bottom: 0.75rem;">
                                    <div>
                                        <h4 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; color: var(--text-primary); margin: 0;">{{ $cls->name }}</h4>
                                        <span style="font-size: 0.75rem; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 0.2rem 0.5rem; border-radius: 5px; font-weight: 700; color: var(--text-secondary);">Kuota: {{ $classStudents->count() }} Santri</span>
                                    </div>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button onclick="openAssignTeachersModal({{ $cls->id }}, '{{ $cls->homeroom_teacher_id }}', {{ $assistantIds }})" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); padding: 0 0.75rem; height: 32px; border-radius: 8px; font-weight: 800; font-size: 0.75rem; color: var(--accent-blue); cursor: pointer; display: flex; align-items: center; gap: 0.25rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" title="Atur Pembimbing">
                                            <i class="fa-solid fa-user-tie"></i> Atur Wali
                                        </button>
                                        <button onclick="openAssignSkillModal({{ $cls->id }}, '{{ $cls->education_skill_id }}')" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); padding: 0 0.75rem; height: 32px; border-radius: 8px; font-weight: 800; font-size: 0.75rem; color: var(--accent-green, #10b981); cursor: pointer; display: flex; align-items: center; gap: 0.25rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" title="Pilih Skill">
                                            <i class="fa-solid fa-brain"></i> Pilih Skill
                                        </button>
                                        <button data-id="{{ $cls->id }}" data-name="{{ $cls->name }}" data-leader="{{ $cls->leader_registration_id }}" data-students="{{ json_encode($classStudents->map(fn($s) => ['id' => $s->id, 'reg_id' => $s->registration->id, 'name' => $s->registration->name, 'status' => $s->status])->values()) }}" onclick="openClassroomStudentsModalFromButton(this)" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); padding: 0 0.75rem; height: 32px; border-radius: 8px; font-weight: 800; font-size: 0.75rem; color: var(--text-primary); cursor: pointer; display: flex; align-items: center; gap: 0.25rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                                            <i class="fa-solid fa-users"></i> Anggota
                                        </button>
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; font-size: 0.85rem;">
                                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                        <span style="font-weight: 700; color: var(--text-secondary);">Wali Kelas:</span>
                                        <span style="font-weight: 700; color: var(--text-primary);">{{ $cls->homeroomTeacher->name ?? '-' }}</span>
                                        @if($cls->homeroomTeacher)
                                            <span style="font-size: 0.7rem; color: var(--accent-blue); font-weight: 700;">({{ $cls->homeroomTeacher->teacher_type }})</span>
                                        @endif
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                        <span style="font-weight: 700; color: var(--text-secondary);">Wakil Wali Kelas:</span>
                                        @forelse($cls->assistantTeachers as $ast)
                                            <span style="font-weight: 700; color: var(--text-primary);">{{ $ast->name }}</span>
                                            <span style="font-size: 0.7rem; color: var(--accent-blue); font-weight: 700;">({{ $ast->teacher_type }})</span>
                                        @empty
                                            <span style="font-weight: 700; color: var(--text-primary);">-</span>
                                        @endforelse
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                        <span style="font-weight: 700; color: var(--text-secondary);">Ketua Kelas:</span>
                                        <span style="font-weight: 800; color: var(--accent-blue);">{{ $cls->leaderRegistration->name ?? '-' }}</span>
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                        <span style="font-weight: 700; color: var(--text-secondary);">Skill Penilaian:</span>
                                        <span style="font-weight: 800; color: var(--accent-green, #10b981);">{{ $cls->educationSkill->name ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="dashboard-panel" style="text-align: center; padding: 2rem; color: var(--text-secondary);">Belum ada kelas untuk periode ini. Buat kelas utama terlebih dahulu di menu Manajemen Kelas.</div>
                        @endforelse
                    </div>

                    <!-- Right Side: Unassigned/Pending Students Pool -->
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; color: var(--text-primary); margin: 0;"><i class="fa-solid fa-users-viewfinder"></i> Belum Terbagi Kelas ({{ $unassignedStudents->count() }})</h3>
                        
                        <div class="dashboard-panel" style="max-height: 500px; overflow-y: auto; padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem;">
                            @forelse($unassignedStudents as $us)
                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.85rem 1rem; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 10px;">
                                    <div>
                                        <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">{{ $us->registration->name }}</h5>
                                        <span style="font-size: 0.75rem; font-weight: 600; color: var(--text-secondary);">{{ $us->registration->major->name }}</span>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('super-admin.education.classrooms.assign-students') }}" style="margin: 0;">
                                        @csrf
                                        <input type="hidden" name="student_ids[]" value="{{ $us->id }}">
                                        <div class="select-wrapper" style="width: 110px; height: 32px; font-size: 0.75rem; border-radius: 8px;">
                                            <select name="classroom_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; color: var(--accent-blue); padding: 0 0.5rem; height: 100%;">
                                                <option value="" selected disabled>+ Kelas</option>
                                                @foreach($classrooms as $cls)
                                                    <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            @empty
                                <div style="text-align: center; padding: 2rem 0; color: var(--text-secondary); font-size: 0.85rem; font-weight: 600;">Semua calon santri yang diterima telah dimasukkan ke kelas.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>

    <!-- MODAL ASSIGN TEACHERS -->
    <div id="teachers-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 480px; padding: 2rem; position: relative; max-height: 90vh; overflow-y: auto;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center;" onclick="closeAssignTeachersModal()" type="button"><i class="fa-solid fa-xmark"></i></button>
            <h3 style="font-family: var(--font-heading); font-size: 1.2rem; font-weight: 800; margin-bottom: 1.5rem;"><i class="fa-solid fa-user-tie" style="color: var(--accent-blue);"></i> Atur Pembimbing Kelas</h3>
            <form id="assign-teachers-form" method="POST" style="display: flex; flex-direction: column; gap: 1.25rem; text-align: left;">
                @csrf

                <!-- Wali Kelas (single dropdown) -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem; position: relative;">
                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Wali Kelas</label>
                    <div class="select-wrapper" style="position: relative; overflow: visible;">
                        <input type="hidden" name="homeroom_teacher_id" id="homeroom-select">
                        <input type="text" id="homeroom-search" placeholder="Cari Wali Kelas..." autocomplete="off" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0.5rem 1rem; height: 100%;" onfocus="showDropdown('homeroom')" oninput="filterDropdown('homeroom')">
                        <div id="homeroom-dropdown" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 10px; max-height: 200px; overflow-y: auto; z-index: 1010; padding: 0.5rem 0;">
                            <div style="padding: 0.5rem 1rem; cursor: pointer; font-weight: 700; color: var(--text-secondary);" onclick="selectOption('homeroom', '', '- Belum Ditentukan -')">- Belum Ditentukan -</div>
                            @foreach($teachers as $t)
                                <div class="dropdown-item" data-value="{{ $t->id }}" data-search="{{ strtolower($t->name) }}" style="padding: 0.5rem 1rem; cursor: pointer; font-weight: 600; color: var(--text-primary);" onclick="selectOption('homeroom', '{{ $t->id }}', '{{ $t->name }} ({{ $t->teacher_type }})')">{{ $t->name }} ({{ $t->teacher_type }})</div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Wakil Wali Kelas (multi-checkbox) -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Wakil Wali Kelas <span style="font-weight: 500; font-size: 0.78rem;">(bisa lebih dari satu)</span></label>
                    <div style="box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.5rem; max-height: 220px; overflow-y: auto; display: flex; flex-direction: column; gap: 0.25rem;">
                        <input type="text" id="assistant-filter" placeholder="Cari pengajar..." oninput="filterAssistantCheckboxes(this.value)" style="border: none; background: transparent; outline: none; font-size: 0.82rem; font-weight: 600; color: var(--text-primary); padding: 0.4rem 0.75rem; width: 100%; border-bottom: 1px solid #d1d9e6; margin-bottom: 0.25rem;">
                        @foreach($teachers as $t)
                            <label class="assistant-checkbox-item" data-search="{{ strtolower($t->name) }}" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.45rem 0.75rem; border-radius: 8px; cursor: pointer; font-size: 0.85rem; font-weight: 600; color: var(--text-primary); transition: background 0.15s;" onmouseover="this.style.background='var(--bg-secondary)'" onmouseout="this.style.background='transparent'">
                                <input type="checkbox" name="assistant_teacher_ids[]" value="{{ $t->id }}" id="asst_{{ $t->id }}" style="width: 15px; height: 15px; accent-color: var(--accent-blue); cursor: pointer;">
                                <span>{{ $t->name }}</span>
                                <span style="font-size: 0.72rem; color: var(--text-secondary); margin-left: auto;">{{ $t->teacher_type }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 0.5rem;">
                    <button type="button" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.5rem; font-weight: 700; cursor: pointer;" onclick="closeAssignTeachersModal()">Batal</button>
                    <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.5rem; font-weight: 800; cursor: pointer; gap: 0.4rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL CLASSROOM STUDENTS & CHOOSE LEADER -->
    <div id="students-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 500px; padding: 2rem; position: relative; max-height: 90vh; display: flex; flex-direction: column;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; z-index: 5;" onclick="closeClassroomStudentsModal()" type="button"><i class="fa-solid fa-xmark"></i></button>
            <h3 id="class-students-title" style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; margin-bottom: 1rem;">Anggota Kelas</h3>
            
            <div style="flex: 1; overflow-y: auto; margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 1rem; padding-right: 0.5rem;" id="students-list-container">
                <!-- Dynamic List -->
            </div>

            <!-- Choose Leader Form -->
            <form id="choose-leader-form" method="POST" action="{{ route('super-admin.education.classrooms.set-leader') }}" style="border-top: 1.5px solid #d1d9e6; padding-top: 1rem; display: flex; flex-direction: column; gap: 0.75rem;">
                @csrf
                <input type="hidden" name="classroom_id" id="leader-classroom-id">
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Pilih Ketua Kelas</label>
                    <div class="select-wrapper">
                        <select name="leader_registration_id" id="leader-select" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                            <option value="">- Pilih Ketua -</option>
                        </select>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.25rem; font-weight: 700; cursor: pointer;" onclick="closeClassroomStudentsModal()">Tutup</button>
                    <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); display: inline-flex; align-items: center; justify-content: center; height: 36px; border-radius: 8px; padding: 0 1.25rem; font-weight: 800; cursor: pointer;">Tetapkan Ketua</button>
                </div>
            </form>
        </div>
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
        });

        // Teachers Modal
        const teachersOverlay = document.getElementById('teachers-modal-overlay');
        const assignTeachersForm = document.getElementById('assign-teachers-form');
        const homeroomSelect = document.getElementById('homeroom-select');

        const teacherNames = {
            @foreach($teachers as $t)
                '{{ $t->id }}': '{{ $t->name }} ({{ $t->teacher_type }})',
            @endforeach
        };

        // assistantIds is now an array of IDs
        function openAssignTeachersModal(classId, homeroomId, assistantIds) {
            assignTeachersForm.action = `/super-admin/education/classrooms/${classId}/assign-teachers`;

            // Homeroom
            document.getElementById('homeroom-select').value = homeroomId || '';
            document.getElementById('homeroom-search').value = homeroomId ? (teacherNames[homeroomId] || '') : '- Belum Ditentukan -';

            // Uncheck all assistant checkboxes first, then check the pre-selected ones
            document.querySelectorAll('input[name="assistant_teacher_ids[]"]').forEach(cb => {
                cb.checked = Array.isArray(assistantIds) && assistantIds.map(String).includes(String(cb.value));
            });

            // Clear assistant filter
            const filterEl = document.getElementById('assistant-filter');
            if (filterEl) { filterEl.value = ''; filterAssistantCheckboxes(''); }

            teachersOverlay.style.display = 'flex';
        }

        function closeAssignTeachersModal() {
            teachersOverlay.style.display = 'none';
        }

        function filterAssistantCheckboxes(query) {
            const lq = query.toLowerCase();
            document.querySelectorAll('.assistant-checkbox-item').forEach(item => {
                const name = item.getAttribute('data-search') || '';
                item.style.display = name.includes(lq) ? 'flex' : 'none';
            });
        }

        function showDropdown(type) {
            document.getElementById(`${type}-dropdown`).style.display = 'block';
            const items = document.querySelectorAll(`#${type}-dropdown .dropdown-item`);
            items.forEach(item => item.style.display = 'block');
        }

        function filterDropdown(type) {
            const query = document.getElementById(`${type}-search`).value.toLowerCase();
            const items = document.querySelectorAll(`#${type}-dropdown .dropdown-item`);
            items.forEach(item => {
                const searchVal = item.getAttribute('data-search');
                item.style.display = searchVal.includes(query) ? 'block' : 'none';
            });
        }

        function selectOption(type, value, text) {
            document.getElementById(`${type}-select`).value = value;
            document.getElementById(`${type}-search`).value = text;
            document.getElementById(`${type}-dropdown`).style.display = 'none';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (document.getElementById('homeroom-dropdown')) {
                if (!e.target.closest('#homeroom-search') && !e.target.closest('#homeroom-dropdown')) {
                    document.getElementById('homeroom-dropdown').style.display = 'none';
                }
            }
        });

        // Classroom Students Modal
        const studentsOverlay = document.getElementById('students-modal-overlay');
        const classStudentsTitle = document.getElementById('class-students-title');
        const studentsListContainer = document.getElementById('students-list-container');
        const leaderSelect = document.getElementById('leader-select');
        const leaderClassroomId = document.getElementById('leader-classroom-id');

        function openClassroomStudentsModal(classId, className, students, leaderRegId) {
            classStudentsTitle.textContent = `Anggota Kelas: ${className}`;
            leaderClassroomId.value = classId;
            studentsListContainer.innerHTML = '';
            
            // Reset & fill leader options
            leaderSelect.innerHTML = '<option value="">- Pilih Ketua -</option>';

            if (students.length === 0) {
                studentsListContainer.innerHTML = '<div style="text-align: center; color: var(--text-secondary); padding: 1rem; font-size: 0.9rem;">Kelas ini belum memiliki anggota.</div>';
                studentsOverlay.style.display = 'flex';
                return;
            }

            students.forEach(student => {
                // Add to list
                const row = document.createElement('div');
                row.style.display = 'flex';
                row.style.justifyContent = 'space-between';
                row.style.alignItems = 'center';
                row.style.padding = '0.75rem 1rem';
                row.style.background = 'var(--bg-primary)';
                row.style.boxShadow = 'var(--nm-flat-sm)';
                row.style.borderRadius = '8px';

                const isLeader = String(student.reg_id) === String(leaderRegId);

                let statusLabel = student.status;
                if (student.status === 'active') statusLabel = 'Aktif';
                else if (student.status === 'passed') statusLabel = 'Lulus';
                else if (student.status === 'failed') statusLabel = 'Gugur';
                else if (student.status === 'resigned') statusLabel = 'Mundur';

                const removeActionHtml = student.status === 'passed' 
                    ? `<span style="font-size: 0.85rem; color: #10b981; margin-right: 0.5rem; display: inline-flex; align-items: center; gap: 0.25rem; font-weight: 800;" title="Proses Kelas Terkunci"><i class="fa-solid fa-lock" style="font-size: 0.75rem;"></i> Terkunci</span>`
                    : `<form method="POST" action="/super-admin/education/classrooms/remove-student/${student.id}" style="margin: 0;" onsubmit="return confirm('Keluarkan santri ini dari kelas?')">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 28px; height: 28px; border-radius: 6px; cursor: pointer; color: var(--accent-red); display: flex; align-items: center; justify-content: center;" title="Keluarkan">
                            <i class="fa-solid fa-user-minus" style="font-size: 0.8rem;"></i>
                        </button>
                    </form>`;

                row.innerHTML = `
                    <div>
                        <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">
                            ${student.name}
                            ${isLeader ? ' <span style="font-size: 0.7rem; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 0.15rem 0.4rem; border-radius: 4px; color: var(--accent-blue); font-weight: 800; margin-left: 0.35rem;"><i class="fa-solid fa-crown"></i> Ketua</span>' : ''}
                        </h5>
                        <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 600;">Status: <strong style="color: ${student.status === 'passed' ? '#10b981' : (student.status === 'failed' ? '#ef4444' : '#2563eb')}">${statusLabel}</strong></span>
                    </div>
                    ${removeActionHtml}
                `;
                studentsListContainer.appendChild(row);

                // Add to leader select
                const option = document.createElement('option');
                option.value = student.reg_id;
                option.textContent = student.name;
                if (isLeader) {
                    option.selected = true;
                }
                leaderSelect.appendChild(option);
            });

            studentsOverlay.style.display = 'flex';
        }

        function openClassroomStudentsModalFromButton(button) {
            const classId = button.getAttribute('data-id');
            const className = button.getAttribute('data-name');
            const leaderRegId = button.getAttribute('data-leader');
            const students = JSON.parse(button.getAttribute('data-students'));
            openClassroomStudentsModal(classId, className, students, leaderRegId);
        }

        function closeClassroomStudentsModal() {
            studentsOverlay.style.display = 'none';
        }

        // Skill Modal
        function openAssignSkillModal(classId, selectedSkillId) {
            const skillOverlay = document.getElementById('skill-modal-overlay');
            const assignSkillForm = document.getElementById('assign-skill-form');
            const skillSelect = document.getElementById('skill-select');

            if (assignSkillForm) assignSkillForm.action = `/super-admin/education/classrooms/${classId}/assign-skill`;
            if (skillSelect) skillSelect.value = selectedSkillId || '';
            if (skillOverlay) skillOverlay.style.display = 'flex';
        }

        function closeAssignSkillModal() {
            const skillOverlay = document.getElementById('skill-modal-overlay');
            if (skillOverlay) skillOverlay.style.display = 'none';
        }
    </script>

    <!-- MODAL ASSIGN SKILL -->
    <div id="skill-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 1.5rem;">
        <div class="card-nm" style="width: 100%; max-width: 480px; padding: 2rem; position: relative;">
            <button style="position: absolute; top: 1rem; right: 1rem; border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; justify-content: center;" onclick="closeAssignSkillModal()" type="button"><i class="fa-solid fa-xmark"></i></button>
            <h3 style="font-family: var(--font-heading); font-size: 1.2rem; font-weight: 800; margin-bottom: 1.5rem;"><i class="fa-solid fa-brain" style="color: var(--accent-green);"></i> Pilih Skill Penilaian Kelas</h3>
            <form id="assign-skill-form" method="POST" style="display: flex; flex-direction: column; gap: 1.25rem; text-align: left;">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Pilih Skill Utama</label>
                    <div class="select-wrapper">
                        <select name="education_skill_id" id="skill-select" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                            <option value="">- Belum Ditentukan / Tidak Ada -</option>
                            @if($activePeriod && $activePeriod->skills)
                                @foreach($activePeriod->skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 0.5rem;">
                    <button type="button" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-secondary); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.5rem; font-weight: 700; cursor: pointer;" onclick="closeAssignSkillModal()">Batal</button>
                    <button type="submit" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-green); display: inline-flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; padding: 0 1.5rem; font-weight: 800; cursor: pointer; gap: 0.4rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
