<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hafalan & Kontrol Akademik - SIAPIT</title>
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

        .dashboard-panel {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            border: 1.5px solid rgba(255,255,255,0.4);
        }

        .panel-title {
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 15px;
            padding: 0.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
            border-bottom: 1.5px solid rgba(255,255,255,0.4);
        }

        th {
            font-weight: 800;
            color: var(--text-secondary);
            border-bottom: 2px solid #cbd5e1;
        }

        .badge {
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 800;
        }

        .badge.success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-green);
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
                
                @include('santri.sidebar')
            </div>
            
            <div class="sidebar-footer">
                <div class="user-profile-sm">
                    <div class="avatar-sm">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                    <div class="user-meta-sm">
                        <h4>{{ $user->name }}</h4>
                        <p>Santri</p>
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
            </header>

             <header class="main-header">
                <div class="welcome-section">
                    <h1>{{ request()->get('phase') === 'education' ? 'Masa Pendidikan' : 'Masa Matrikulasi' }}</h1>
                    <p>{{ request()->get('type') === 'rapor' ? 'Rekapitulasi nilai dan status kelulusan Anda di akhir periode.' : 'Pantau rekapitulasi setoran materi dan laporan checklist harian Anda.' }}</p>
                </div>
            </header>

            @if(request()->get('phase') === 'education')
                @if($educationStudent)
                    @if(request()->get('type') === 'rapor')
                        <!-- Rapor Saya Pendidikan -->
                        <div class="dashboard-panel">
                            <h2 class="panel-title"><i class="fa-solid fa-file-invoice"></i> Rapor Saya (Pendidikan)</h2>
                            <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 16px; padding: 2rem; border: 1px solid rgba(255,255,255,0.4); text-align: center; margin-bottom: 2rem;">
                                <h3 style="font-size: 1.15rem; font-weight: 850; color: var(--text-primary); margin-bottom: 0.5rem;">Status Akademik</h3>
                                <span class="badge {{ $educationStudent->status === 'passed' ? 'approved' : 'pending' }}" style="font-size: 0.95rem; padding: 0.5rem 1rem;">
                                    {{ $educationStudent->status === 'passed' ? 'LULUS MASA PENDIDIKAN' : 'AKTIF / DALAM BELAJAR' }}
                                </span>
                            </div>
                        </div>
                    @else
                        <!-- Kontrol Harian Pendidikan -->
                        <div class="dashboard-panel">
                            <h2 class="panel-title"><i class="fa-solid fa-book-open"></i> Kontrol Harian Pendidikan</h2>
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Aspek Penilaian</th>
                                            <th>Nilai / Skor</th>
                                            <th>Catatan Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($educationScores as $score)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($score->evaluation_date)->translatedFormat('d F Y') }}</td>
                                                <td>{{ $score->aspect->name ?? '-' }}</td>
                                                <td><span class="badge success">{{ $score->score }}</span></td>
                                                <td>{{ $score->notes ?? 'Tidak ada catatan' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada data setoran pendidikan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="dashboard-panel" style="text-align: center; padding: 4rem 2rem;">
                        <i class="fa-solid fa-circle-info" style="font-size: 2.5rem; color: var(--text-secondary); margin-bottom: 1rem;"></i>
                        <h3 style="font-weight: 850;">Tidak Terdaftar</h3>
                        <p style="color: var(--text-secondary); font-weight: 600; margin-top: 0.25rem;">Anda belum memasuki atau tidak terdaftar di kelas Masa Pendidikan.</p>
                    </div>
                @endif
            @else
                @if($matriculationStudent)
                    @if(request()->get('type') === 'rapor')
                        <!-- Rapor Saya Matrikulasi -->
                        <div class="dashboard-panel">
                            <h2 class="panel-title"><i class="fa-solid fa-file-invoice"></i> Rapor Saya (Matrikulasi)</h2>
                            <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 16px; padding: 2rem; border: 1px solid rgba(255,255,255,0.4); text-align: center; margin-bottom: 2rem;">
                                <h3 style="font-size: 1.15rem; font-weight: 850; color: var(--text-primary); margin-bottom: 0.5rem;">Status Akademik</h3>
                                <span class="badge {{ $matriculationStudent->status === 'passed' ? 'approved' : 'pending' }}" style="font-size: 0.95rem; padding: 0.5rem 1rem;">
                                    {{ $matriculationStudent->status === 'passed' ? 'LULUS MATRIKULASI' : 'AKTIF / DALAM BELAJAR' }}
                                </span>
                            </div>
                        </div>
                    @else
                        <!-- Kontrol Harian Matrikulasi -->
                        <div class="dashboard-panel">
                            <h2 class="panel-title"><i class="fa-solid fa-graduation-cap"></i> Kontrol Harian Matrikulasi</h2>
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Aspek Penilaian</th>
                                            <th>Nilai / Skor</th>
                                            <th>Catatan Mentor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($matriculationScores as $score)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($score->evaluation_date)->translatedFormat('d F Y') }}</td>
                                                <td>{{ $score->aspect->name ?? '-' }}</td>
                                                <td><span class="badge success">{{ $score->score }}</span></td>
                                                <td>{{ $score->notes ?? 'Tidak ada catatan' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada data setoran matrikulasi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="dashboard-panel" style="text-align: center; padding: 4rem 2rem;">
                        <i class="fa-solid fa-circle-info" style="font-size: 2.5rem; color: var(--text-secondary); margin-bottom: 1rem;"></i>
                        <h3 style="font-weight: 850;">Tidak Terdaftar</h3>
                        <p style="color: var(--text-secondary); font-weight: 600; margin-top: 0.25rem;">Anda tidak terdaftar di kelas Masa Matrikulasi.</p>
                    </div>
                @endif
            @endif
        </main>
    </div>

</body>
</html>
