<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divisi Asuhan Berkarya - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-body);
        }

        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .class-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2rem;
            border: 1.5px solid rgba(255,255,255,0.4);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .class-card:hover {
            box-shadow: var(--nm-flat-hover);
        }

        .class-info h3 {
            font-size: 1.25rem;
            font-weight: 850;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .class-meta {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 700;
            margin-bottom: 1.25rem;
        }

        .class-details {
            border-top: 1.5px solid rgba(0,0,0,0.05);
            padding-top: 1rem;
            margin-bottom: 1.5rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .detail-label {
            color: var(--text-secondary);
        }

        .detail-val {
            color: var(--text-primary);
        }

        .btn-enter-class {
            width: 100%;
            height: 46px;
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
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-enter-class:hover {
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
                        <p>{{ ucwords(str_replace('_', ' ', $user->role)) }}</p>
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
                <h1>Rapor Karya Masa Berkarya</h1>
                <p>Pilih divisi asuhan yang Anda pimpin untuk mengelola rapor karya dan status lulusan santri.</p>
            </header>

            <div class="class-grid">
                @forelse($placements as $pl)
                    <div class="class-card">
                        <div class="class-info">
                            <h3>{{ $pl->name }}</h3>
                            <div class="class-meta">PJ Divisi: {{ $pl->mentor_name ?? '-' }}</div>
                            
                            <div class="class-details">
                                <div class="detail-row">
                                    <span class="detail-label">Jumlah Santri Magang</span>
                                    <span class="detail-val">{{ $pl->students_count }} Santri</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Kontak PJ</span>
                                    <span class="detail-val">{{ $pl->mentor_contact ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('pengajar.career.penilaian.divisi', $pl->id) }}" class="btn-enter-class">
                            <i class="fa-solid fa-briefcase"></i> Kelola Rapor Divisi
                        </a>
                    </div>
                @empty
                    <div style="grid-column: 1/-1; background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 20px; padding: 3rem; text-align: center; color: var(--text-secondary); font-weight: 700; border: 1.5px solid rgba(255,255,255,0.4);">
                        <i class="fa-solid fa-building-circle-exclamation" style="font-size: 2.5rem; color: var(--text-secondary); margin-bottom: 1rem; display: block;"></i>
                        Anda belum ditugaskan sebagai PJ Divisi untuk unit magang berkarya manapun.
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <script>
        // Submenu toggling untuk sidebar
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });
    </script>
</body>
</html>
