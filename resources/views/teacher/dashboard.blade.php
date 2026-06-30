<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengajar - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg-primary: #e0e8f6;
            --bg-secondary: #f0f4f9;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --accent-blue: #3b82f6;
            --accent-red: #ef4444;
            --accent-green: #10b981;
            --accent-orange: #f59e0b;
            --font-main: 'Outfit', sans-serif;
            
            --nm-flat-sm: 4px 4px 8px #beccd7, -4px -4px 8px #ffffff;
            --nm-flat-md: 8px 8px 16px #beccd7, -8px -8px 16px #ffffff;
            --nm-inset-sm: inset 4px 4px 8px #beccd7, inset -4px -4px 8px #ffffff;
            --nm-flat-hover: 5px 5px 10px #beccd7, -5px -5px 10px #ffffff;
            
            --transition: all 0.3s ease;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        /* Dashboard Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2rem;
            border: 1.5px solid rgba(255,255,255,0.4);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: var(--transition);
        }

        .stat-card:hover {
            box-shadow: var(--nm-flat-hover);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: var(--nm-inset-sm);
        }

        .stat-icon.blue { color: var(--accent-blue); }
        .stat-icon.green { color: var(--accent-green); }
        .stat-icon.orange { color: var(--accent-orange); }
        .stat-icon.red { color: var(--accent-red); }

        .stat-info h3 {
            font-size: 2rem;
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 0.15rem;
        }

        .stat-info p {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-secondary);
        }

        /* Quick Links Card */
        .quick-actions {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }

        .action-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2.5rem;
            border: 1.5px solid rgba(255,255,255,0.4);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: var(--transition);
        }

        .action-card:hover {
            box-shadow: var(--nm-flat-hover);
        }

        .action-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .action-header i {
            font-size: 1.8rem;
            color: var(--accent-blue);
        }

        .action-header h2 {
            font-size: 1.25rem;
            font-weight: 950;
            color: var(--text-primary);
        }

        .action-card p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-action-go {
            width: 100%;
            height: 48px;
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 12px;
            font-weight: 850;
            color: var(--accent-blue);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-action-go:hover {
            box-shadow: var(--nm-flat-hover);
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
                <div class="welcome-section">
                    <h1>Selamat Datang, {{ $user->name }}!</h1>
                    <p>Kelola bimbingan akademis santri & penuhi laporan checklist KPI harian Anda dengan antarmuka yang modern.</p>
                </div>
            </header>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalClassrooms }}</h3>
                        <p>Kelas Asuhan</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalStudents }}</h3>
                        <p>Santri Bimbingan</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalPlacements }}</h3>
                        <p>Divisi Berkarya</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $completedKpiToday }}/{{ $totalAssignedKpi }}</h3>
                        <p>KPI Harian Hari Ini</p>
                    </div>
                </div>
            </div>

            <!-- Quick Action Cards -->
            <div class="quick-actions">
                <div class="action-card">
                    <div>
                        <div class="action-header">
                            <i class="fa-solid fa-graduation-cap" style="color: var(--accent-blue);"></i>
                            <h2>Kontrol Harian Matrikulasi</h2>
                        </div>
                        <p>Pantau checklist harian setoran santri di masa matrikulasi kelas asuhan Anda dengan cepat.</p>
                    </div>
                    <a href="{{ route('pengajar.matriculation.daily-control.list') }}" class="btn-action-go" style="color: var(--accent-blue);">
                        Kelola Kontrol Harian <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </div>

                <div class="action-card">
                    <div>
                        <div class="action-header">
                            <i class="fa-solid fa-calendar-day" style="color: var(--accent-green);"></i>
                            <h2>Kontrol Harian Pendidikan</h2>
                        </div>
                        <p>Pantau checklist harian setoran santri di masa pendidikan kelas asuhan Anda dengan cepat.</p>
                    </div>
                    <a href="{{ route('pengajar.education.daily-control.list') }}" class="btn-action-go" style="color: var(--accent-green);">
                        Kelola Kontrol Harian <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </div>

                <div class="action-card">
                    <div>
                        <div class="action-header">
                            <i class="fa-solid fa-medal" style="color: var(--accent-orange);"></i>
                            <h2>Rapor Karya (Masa Berkarya)</h2>
                        </div>
                        <p>Evaluasi capaian proyek magang berkarya, verifikasi penghasilan, dan approve target karya santri bimbingan Anda.</p>
                    </div>
                    <a href="{{ route('pengajar.career.penilaian') }}" class="btn-action-go" style="color: var(--accent-orange);">
                        Kelola Rapor Karya <i class="fa-solid fa-chevron-right"></i>
                    </a>
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
