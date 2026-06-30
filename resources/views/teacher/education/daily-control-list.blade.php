<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kontrol Harian Pendidikan - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                @include('teacher.sidebar')
            </div>
            
            <div class="sidebar-footer">
                <div class="user-profile-sm">
                    <div class="avatar-sm">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                    <div class="user-meta-sm">
                        <h4>{{ $user->name }}</h4>
                        <p>Pengajar / Mentor</p>
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
                <h1>Kontrol Harian Masa Pendidikan</h1>
                <p>Pilih kelas yang Anda bimbing untuk mengelola capaian harian santri selama Masa Pendidikan.</p>
            </header>

            <div class="dashboard-panel">
                <h3 class="panel-title"><i class="fa-solid fa-school"></i> Daftar Kelas Asuhan Pendidikan</h3>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                    @forelse($classrooms as $cls)
                        <div style="background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 20px; padding: 1.5rem; border: 1.5px solid rgba(255,255,255,0.4); display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 900; color: var(--text-primary); margin-bottom: 0.5rem;">{{ $cls->name }}</h3>
                                <p style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 700; margin-bottom: 1rem;">Batch: {{ $cls->batch->name ?? '-' }} | TA: {{ $cls->academicYear->name ?? '-' }}</p>
                                
                                <div style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.85rem; color: var(--text-secondary); font-weight: 600;">
                                    <div style="display: flex; justify-content: space-between;">
                                        <span>Wali Kelas:</span>
                                        <span style="font-weight: 800; color: var(--text-primary);">{{ $cls->homeroomTeacher->name ?? '-' }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span>Asisten:</span>
                                        <span style="font-weight: 800; color: var(--text-primary);">{{ $cls->assistantTeacher->name ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="margin-top: 1.5rem;">
                                <a href="{{ route('pengajar.education.daily-control', $cls->id) }}" style="text-decoration: none; display: flex; align-items: center; justify-content: center; height: 38px; border-radius: 10px; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-blue); font-weight: 800; font-size: 0.85rem; width: 100%; transition: var(--transition); gap: 0.35rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'" onmousedown="this.style.boxShadow='var(--nm-inset-sm)'" onmouseup="this.style.boxShadow='var(--nm-flat-hover)'">
                                    <i class="fa-solid fa-calendar-day"></i> Input Kontrol Harian
                                </a>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; color: var(--text-secondary); padding: 3rem 1rem;">
                            <i class="fa-solid fa-circle-exclamation" style="font-size: 2.5rem; opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
                            Anda belum ditugaskan di kelas pendidikan mana pun.
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', () => {
                const parent = trigger.parentElement;
                parent.classList.toggle('open');
            });
        });
    </script>
</body>
</html>
