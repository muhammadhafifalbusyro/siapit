<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Logbook Berkarya Santri - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>
        .submission-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1.5px solid rgba(255,255,255,0.4);
            transition: var(--transition);
        }
        .submission-card:hover {
            box-shadow: var(--nm-flat-hover);
        }
        .submission-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1.5px solid rgba(0,0,0,0.05);
            padding-bottom: 0.75rem;
            margin-bottom: 0.75rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .btn-action-sm {
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }
        .btn-action-sm:hover {
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
                {!! $sidebarMenu !!}
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
                <h1>Logbook Harian Masa Berkarya</h1>
                <p>Verifikasi laporan harian/mingguan santri asuhan di divisi yang Anda pimpin.</p>
            </header>

            <div class="dashboard-panel">
                <!-- Filter Row -->
                <form method="GET" action="{{ route('pengajar.career.logbook') }}" class="filter-row">
                    <div class="input-group" style="width: 250px;">
                        <label>Pilih Divisi Asuhan</label>
                        <div class="input-wrapper">
                            <select name="career_placement_id" onchange="this.form.submit()" style="width: 100%;">
                                @foreach($placements as $pl)
                                    <option value="{{ $pl->id }}" {{ $selectedPlacementId == $pl->id ? 'selected' : '' }}>{{ $pl->name }}</option>
                                @endforeach
                                @if($placements->count() == 0)
                                    <option value="">- Belum ada Divisi asuhan -</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </form>

                <h3 class="panel-title" style="margin-top: 2rem;"><i class="fa-solid fa-list"></i> Riwayat Logbook Santri</h3>
                
                <div style="margin-top: 1.5rem;">
                    @forelse($logs as $log)
                        <div class="submission-card">
                            <div class="submission-header">
                                <div>
                                    <h4 style="font-weight: 850; color: var(--accent-blue); font-size: 1.05rem;">{{ $log->student->registration->name }}</h4>
                                    <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 700;">Tanggal Laporan: {{ \Carbon\Carbon::parse($log->log_date)->format('d F Y') }}</span>
                                </div>
                                <div style="display: flex; gap: 0.5rem; align-items: center;">
                                    @if($log->status === 'pending')
                                        <form method="POST" action="{{ route('pengajar.career.logbook.approve', $log->id) }}" style="margin:0;">
                                            @csrf
                                            <button type="submit" class="btn-action-sm" style="color: var(--accent-green);" title="Approve">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('pengajar.career.logbook.reject', $log->id) }}" style="margin:0;">
                                            @csrf
                                            <button type="submit" class="btn-action-sm" style="color: var(--accent-red);" title="Tolak / Pending">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; padding: 0.2rem 0.6rem; border-radius: 6px; {{ $log->status === 'approved' ? 'background: rgba(16, 185, 129, 0.1); color: var(--accent-green);' : 'background: rgba(239, 68, 68, 0.1); color: var(--accent-red);' }}">
                                            {{ $log->status }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div style="font-size: 0.85rem; color: var(--text-primary); font-weight: 600; line-height: 1.5; margin-bottom: 0.5rem;">
                                <strong>Pekerjaan Hari Ini:</strong><br>
                                {{ $log->activity_details }}
                            </div>
                            
                            @if($log->issues)
                                <div style="font-size: 0.8rem; background: rgba(239,68,68,0.04); border-left: 3px solid var(--accent-red); padding: 0.5rem; border-radius: 4px; color: var(--accent-red); font-weight: 700; margin-top: 0.5rem;">
                                    <i class="fa-solid fa-triangle-exclamation"></i> Kendala/Hambatan: {{ $log->issues }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div style="text-align: center; color: var(--text-secondary); padding: 3rem 1rem;">
                            <i class="fa-solid fa-folder-open" style="font-size: 2.5rem; opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
                            Belum ada entri logbook harian dari santri untuk divisi ini.
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
