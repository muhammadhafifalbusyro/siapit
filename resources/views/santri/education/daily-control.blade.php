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
    <style>
        .grid-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        .grid-table th {
            position: sticky;
            top: 0;
            background: var(--bg-primary);
            z-index: 10;
            border-bottom: 2px solid #cbd5e1;
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
            min-width: 65px;
        }
        .grid-table td {
            padding: 0.6rem 0.25rem;
            text-align: center;
            vertical-align: middle;
            font-size: 0.8rem;
            font-weight: 700;
        }
        .day-header {
            font-weight: 800;
        }
        .day-header.saturday {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border-bottom: 2px solid #f59e0b;
        }
        .day-header.sunday {
            background: rgba(239, 68, 68, 0.05);
            color: #dc2626;
        }
        .cell-saturday {
            background: rgba(245, 158, 11, 0.02);
        }
        .cell-sunday {
            background: rgba(239, 68, 68, 0.02);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-weight: 800;
        }
        .status-badge.present {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }
        .status-badge.absent {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }
        .status-badge.sick {
            background: rgba(245, 158, 11, 0.15);
            color: #d97706;
        }
        .status-badge.permit {
            background: rgba(59, 130, 246, 0.15);
            color: #2563eb;
        }
        .status-badge.empty {
            background: rgba(100, 116, 139, 0.1);
            color: #64748b;
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
            <header class="main-header">
                <div class="welcome-section">
                    <h1>Kontrol Nilai Harian Pendidikan</h1>
                    <p>Grid kalender satu bulan penuh rekapitulasi penilaian harian (read-only) Anda.</p>
                </div>
            </header>

            <!-- Filter Bulan -->
            @if(!$educationStudent)
                <div class="dashboard-panel" style="text-align: center; padding: 4rem 2rem;">
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: var(--text-secondary);">
                        <i class="fa-solid fa-circle-info" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 style="font-weight: 850; color: var(--text-primary);">Akses Terbatas</h3>
                    <p style="color: var(--text-secondary); max-width: 400px; margin: 0.5rem auto 0; font-weight: 600;">Modul ini hanya tersedia bagi santri yang telah memasuki Masa Pendidikan.</p>
                </div>
            @else
                <div class="dashboard-panel" style="width: 100%; margin-bottom: 1.5rem; padding: 1.25rem 1.5rem;">
                    <form method="GET" action="{{ route('santri.education.daily-control') }}" style="display: flex; gap: 1.5rem; align-items: flex-end;">
                        <div style="flex: 1; max-width: 250px; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Pilih Bulan</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center;">
                            <select name="month" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @foreach($months as $m)
                                    <option value="{{ $m['value'] }}" {{ $selectedMonth == $m['value'] ? 'selected' : '' }}>{{ $m['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="flex: 2; display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary);">Aspek Penilaian</label>
                        <div class="input-wrapper" style="height: 42px; display: flex; align-items: center; max-width: 350px;">
                            <select name="education_aspect_id" onchange="this.form.submit()" style="width: 100%; border: none; background: transparent; outline: none; font-weight: 600; color: var(--text-primary); padding: 0 1rem; height: 100%;">
                                @if($activePeriod)
                                    <optgroup label="Penilaian Karakter">
                                        @foreach($activePeriod->aspects->where('type', 'character') as $asp)
                                            <option value="{{ $asp->id }}" {{ $selectedAspectId == $asp->id ? 'selected' : '' }}>{{ $asp->name }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Penilaian Skill">
                                        @foreach($activePeriod->aspects->where('type', 'skill') as $asp)
                                            <option value="{{ $asp->id }}" {{ $selectedAspectId == $asp->id ? 'selected' : '' }}>{{ $asp->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            @if(!$activePeriod || !$selectedAspect)
                <div class="dashboard-panel" style="width: 100%; text-align: center; padding: 4rem 2rem; color: var(--text-secondary);">
                    Belum ada masa pendidikan aktif atau aspek penilaian untuk periode ini.
                </div>
            @else
                @php
                    $weeks = [];
                    $currentWeek = [];
                    foreach ($dates as $date) {
                        $currentWeek[] = $date;
                        $carbon = \Carbon\Carbon::parse($date);
                        if ($carbon->dayOfWeek == \Carbon\Carbon::SUNDAY || $date === end($dates)) {
                            $weeks[] = $currentWeek;
                            $currentWeek = [];
                        }
                    }
                    if (!empty($currentWeek)) {
                        $weeks[] = $currentWeek;
                    }
                @endphp

                <div class="dashboard-panel" style="width: 100%;">
                    <h3 class="panel-title" style="margin-bottom: 0.25rem;"><i class="fa-solid fa-table-cells"></i> Grid Nilai Harian Anda: {{ $selectedAspect->name }}</h3>
                    <span style="font-size: 0.8 /rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 1.5rem; display: block;">
                        Tipe Input: <strong style="color: var(--accent-blue);">
                            @if($selectedAspect->input_type == 'checklist') Ceklis (Ya/Tidak) @elseif($selectedAspect->input_type == 'counter') Target Angka / Counter @else Nilai Angka (0-100) @endif
                        </strong>
                    </span>

                    <div class="table-container" style="overflow-x: auto; max-width: 100%; border-radius: 12px; box-shadow: var(--nm-inset-sm); background: var(--bg-primary);">
                        <table class="grid-table" style="min-width: 100%; border-collapse: collapse; white-space: nowrap;">
                            <thead>
                                <tr style="border-bottom: 2px solid #d1d9e6; background: rgba(243, 244, 246, 0.4);">
                                    <th style="text-align: left; padding-left: 1rem; position: sticky; left: 0; background: var(--bg-primary); z-index: 10; border-right: 2px solid #d1d9e6; vertical-align: middle;">Nama Santri</th>
                                    @foreach($weeks as $wIdx => $weekDates)
                                        @foreach($weekDates as $date)
                                            @php
                                                $carbon = \Carbon\Carbon::parse($date);
                                                $dayNames = [0 => 'Ahad', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
                                                $dayStr = $dayNames[$carbon->dayOfWeek];
                                                $dayNum = $carbon->format('d');
                                                $headerClass = $carbon->dayOfWeek == 6 ? 'saturday' : ($carbon->dayOfWeek == 0 ? 'sunday' : '');
                                            @endphp
                                            <th class="day-header {{ $headerClass }}" style="vertical-align: middle;">
                                                <div style="font-size: 0.65rem; text-transform: uppercase;">{{ $dayStr }}</div>
                                                <div style="font-size: 0.85rem; font-weight: 800;">{{ $dayNum }}</div>
                                            </th>
                                        @endforeach
                                        <th style="background: rgba(16, 185, 129, 0.05); color: #10b981; font-weight: 800; border-left: 1.5px solid #d1d9e6; vertical-align: middle;">Realisasi W{{ $wIdx + 1 }}</th>
                                        <th style="background: rgba(16, 185, 129, 0.05); color: #10b981; font-weight: 800; vertical-align: middle;">Target W{{ $wIdx + 1 }}</th>
                                        <th style="background: rgba(16, 185, 129, 0.05); color: #10b981; font-weight: 800; border-right: 1.5px solid #d1d9e6; vertical-align: middle; padding-right: 0.5rem;">% W{{ $wIdx + 1 }}</th>
                                    @endforeach
                                    <th style="background: rgba(59, 130, 246, 0.05); color: var(--accent-blue); font-weight: 800; border-left: 2px solid var(--accent-blue); vertical-align: middle;">Realisasi Bulan</th>
                                    <th style="background: rgba(59, 130, 246, 0.05); color: var(--accent-blue); font-weight: 800; vertical-align: middle;">Target Bulan</th>
                                    <th style="background: rgba(59, 130, 246, 0.05); color: var(--accent-blue); font-weight: 800; border-right: 2px solid var(--accent-blue); vertical-align: middle; padding-right: 0.5rem;">% Bulan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="text-align: left; padding-left: 1rem; position: sticky; left: 0; background: var(--bg-primary); z-index: 9; border-right: 2px solid #d1d9e6; font-weight: 700; color: var(--text-primary);">
                                        {{ $registration->name }}
                                        <div style="font-size: 0.7rem; color: var(--text-secondary); font-weight: 600;">{{ $registration->major->name }}</div>
                                    </td>
                                    @php
                                        $overallRealisasi = 0; $overallTarget = 0;
                                        $allActiveDays = array_intersect($dates, $selectedAspect->active_days ?? []);
                                    @endphp
                                    @foreach($weeks as $wIdx => $weekDates)
                                        @php
                                            $weekActiveDays = array_intersect($weekDates, $selectedAspect->active_days ?? []);
                                            $weekRealisasi = 0; $weekTarget = 0;
                                        @endphp
                                        @foreach($weekDates as $date)
                                            @php
                                                $scoreObj = $scores->where('evaluation_date', $date)->first();
                                                $val = $scoreObj ? (float)$scoreObj->score : null;
                                                $isActiveDay = in_array($date, $selectedAspect->active_days ?? []);
                                            @endphp
                                            <td>
                                                @if($isActiveDay)
                                                    @if($selectedAspect->input_type == 'checklist')
                                                        @if($val === 1.0)
                                                            @php $weekRealisasi++; $weekTarget++; $overallRealisasi++; $overallTarget++; @endphp
                                                            <span class="status-badge present">✓</span>
                                                        @elseif($val === 0.0)
                                                            @php $weekTarget++; $overallTarget++; @endphp
                                                            <span class="status-badge absent">x</span>
                                                        @elseif($val === 2.0)
                                                            <span class="status-badge sick">S</span>
                                                        @elseif($val === 3.0)
                                                            <span class="status-badge permit">I</span>
                                                        @else
                                                            <span class="status-badge empty">-</span>
                                                        @endif
                                                    @else
                                                        @if(!is_null($val))
                                                            @if($selectedAspect->input_type == 'counter')
                                                                @php $weekRealisasi += $val; @endphp
                                                            @else
                                                                @php $weekRealisasi += $val; $weekTarget++; @endphp
                                                            @endif
                                                            <span style="font-weight: 800; color: var(--text-primary);">{{ (float)$val }}</span>
                                                        @else
                                                            <span style="color: var(--text-secondary); opacity: 0.5;">-</span>
                                                        @endif
                                                    @endif
                                                @else
                                                    <span style="color: var(--text-secondary); opacity: 0.2;">-</span>
                                                @endif
                                            </td>
                                        @endforeach
                                        
                                        @php
                                            if ($selectedAspect->input_type === 'checklist') {
                                                $weekPercentage = $weekTarget > 0 ? ($weekRealisasi / $weekTarget) * 100 : 0;
                                                $realDisp = $weekRealisasi . ' hr';
                                                $targetDisp = $weekTarget . ' hr';
                                            } elseif ($selectedAspect->input_type === 'counter') {
                                                $weekTarget = (float)($selectedAspect->target_weekly ?? 3);
                                                $weekPercentage = $weekTarget > 0 ? ($weekRealisasi / $weekTarget) * 100 : 0;
                                                $realDisp = $weekRealisasi;
                                                $targetDisp = $weekTarget;
                                                $overallRealisasi += $weekRealisasi;
                                            } else {
                                                $avgVal = $weekTarget > 0 ? $weekRealisasi / $weekTarget : 0;
                                                $weekTargetVal = (float)($selectedAspect->target_weekly ?? 80);
                                                $weekPercentage = $weekTargetVal > 0 ? ($avgVal / $weekTargetVal) * 100 : 0;
                                                $realDisp = number_format($avgVal, 1);
                                                $targetDisp = number_format($weekTargetVal, 0);
                                                if($weekTarget > 0) { $overallRealisasi += $avgVal; $overallTarget++; }
                                            }
                                        @endphp
                                        <td style="font-weight: 800; border-left: 1.5px solid #d1d9e6; background: rgba(243, 244, 246, 0.4);">{{ $realDisp }}</td>
                                        <td style="font-weight: 700; color: var(--text-secondary); background: rgba(243, 244, 246, 0.4);">{{ $targetDisp }}</td>
                                        <td style="font-weight: 800; color: {{ $weekPercentage >= 100 ? '#10b981' : '#f59e0b' }}; background: rgba(243, 244, 246, 0.4); border-right: 1.5px solid #d1d9e6;">{{ number_format($weekPercentage, 0) }}%</td>
                                    @endforeach

                                    @php
                                        if ($selectedAspect->input_type === 'checklist') {
                                            $monthlyPercentage = $overallTarget > 0 ? ($overallRealisasi / $overallTarget) * 100 : 0;
                                            $mRealDisp = $overallRealisasi . ' hr';
                                            $mTargetDisp = $overallTarget . ' hr';
                                        } elseif ($selectedAspect->input_type === 'counter') {
                                            $monthlyTarget = (float)($selectedAspect->target_weekly ?? 3);
                                            $monthlyPercentage = $monthlyTarget > 0 ? ($overallRealisasi / $monthlyTarget) * 100 : 0;
                                            $mRealDisp = $overallRealisasi;
                                            $mTargetDisp = $monthlyTarget;
                                        } else {
                                            $mAvgVal = $overallTarget > 0 ? $overallRealisasi / $overallTarget : 0;
                                            $monthlyTargetVal = (float)($selectedAspect->target_weekly ?? 80);
                                            $monthlyPercentage = $monthlyTargetVal > 0 ? ($mAvgVal / $monthlyTargetVal) * 100 : 0;
                                            $mRealDisp = number_format($mAvgVal, 1);
                                            $mTargetDisp = number_format($monthlyTargetVal, 0);
                                        }
                                    @endphp
                                    <td style="font-weight: 800; border-left: 2px solid var(--accent-blue); background: rgba(59, 130, 246, 0.05); color: var(--accent-blue);">{{ $mRealDisp }}</td>
                                    <td style="font-weight: 700; color: var(--text-secondary); background: rgba(59, 130, 246, 0.05);">{{ $mTargetDisp }}</td>
                                    <td style="font-weight: 800; color: {{ $monthlyPercentage >= 100 ? '#10b981' : '#f59e0b' }}; background: rgba(59, 130, 246, 0.05); border-right: 2px solid var(--accent-blue); padding-right: 0.5rem;">{{ number_format($monthlyPercentage, 0) }}%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @endif
        </main>
    </div>
</body>
</html>
