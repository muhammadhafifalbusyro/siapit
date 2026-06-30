<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Penilaian Rapor Karya - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            
            /* Neomorphism Shadows */
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
            margin-bottom: 2rem;
            border: 1.5px solid rgba(255,255,255,0.4);
        }

        .table-container {
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 16px;
            padding: 1rem;
            margin-top: 1.5rem;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            color: var(--text-secondary);
            font-weight: 800;
            border-bottom: 2.5px solid rgba(0,0,0,0.05);
        }

        td {
            padding: 1.25rem 1rem;
            font-size: 0.9rem;
            color: var(--text-primary);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 700;
        }

        .btn-action-sm {
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-action-sm:hover {
            box-shadow: var(--nm-flat-hover);
            transform: translateY(-1px);
        }

        .input-wrapper {
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.5);
            transition: var(--transition);
        }

        .modal-overlay {
            background: rgba(224, 232, 246, 0.7);
            backdrop-filter: blur(8px);
        }

        .modal-card {
            background: var(--bg-primary) !important;
            box-shadow: 20px 20px 60px #beccd7, -20px -20px 60px #ffffff !important;
            border-radius: 24px !important;
            border: 1.5px solid rgba(255,255,255,0.4);
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

            <header class="main-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1>Rapor Karya: {{ $placement->name }}</h1>
                    <p>PJ Divisi: <strong style="color: var(--accent-blue);">{{ $placement->mentor_name ?? '-' }}</strong></p>
                </div>
                <a href="{{ route('pengajar.career.penilaian') }}" class="btn-action-sm" style="width: auto; height: 42px; padding: 0 1.25rem; border-radius: 12px; font-weight: 850; color: var(--text-secondary); text-decoration: none; gap: 0.5rem;" title="Kembali ke Daftar Divisi">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </header>

            <div class="dashboard-panel">
                <h3 class="panel-title" style="margin-top: 0.5rem;"><i class="fa-solid fa-medal"></i> Daftar Rapor Karya Santri Asuhan</h3>

                <!-- Table -->
                <div class="table-container" style="margin-top: 1rem;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Program Pendidikan</th>
                                <th>Jurusan</th>
                                <th>Tahun Ajaran</th>
                                <th>Gelombang</th>
                                <th>Divisi</th>
                                <th>Periode Karya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($passedStudents as $ps)
                                @php
                                    // Find matching CareerStudent to get score data
                                    $careerStudent = $students->where('registration_id', $ps->registration_id)->first();
                                    $report = $careerStudent ? $reports->get($careerStudent->id) : null;
                                @endphp
                                <tr>
                                    <td style="font-weight: 700; color: var(--text-primary);">{{ $ps->registration->name }}</td>
                                    <td>{{ $ps->registration->educationProgram->name ?? '-' }}</td>
                                    <td>{{ $ps->registration->major->name ?? '-' }}</td>
                                    <td>{{ $ps->period->academicYear->name ?? '-' }}</td>
                                    <td>{{ $ps->period->batch->name ?? '-' }}</td>
                                    <td style="color: var(--accent-blue); font-weight: 700;">{{ $ps->careerPlacement->name ?? 'Belum Ditempatkan' }}</td>
                                    <td style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 700;">
                                        {{ $ps->career_start_date ? \Carbon\Carbon::parse($ps->career_start_date)->format('d/m/Y') : '-' }} s/d {{ $ps->career_end_date ? \Carbon\Carbon::parse($ps->career_end_date)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <!-- Detail target bimbingan / management -->
                                            <a href="{{ route('pengajar.career.reports.management', $ps->id) }}" class="btn-action-sm" style="color: var(--accent-blue); box-shadow: var(--nm-flat-sm);" title="Manajemen Target Karya & Log">
                                                <i class="fa-solid fa-list-check"></i>
                                            </a>

                                            <!-- Form input nilai bulanan -->
                                            @if($careerStudent)
                                                <button class="btn-action-sm" onclick="openPenilaianModal({{ $careerStudent->id }}, '{{ $ps->registration->name }}', {{ $report ? $report->soft_comm : 'null' }}, {{ $report ? $report->soft_team : 'null' }}, {{ $report ? $report->soft_disc : 'null' }}, {{ $report ? $report->hard_qual : 'null' }}, {{ $report ? $report->hard_spd : 'null' }}, {{ $report ? $report->hard_prob : 'null' }}, '{{ $report ? addslashes($report->notes) : '' }}')" style="color: var(--accent-green); box-shadow: var(--nm-flat-sm);" title="Input Nilai Bulanan">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            @endif
                                            
                                            <!-- Status select status magang -->
                                            <div class="input-wrapper" style="width: 105px; padding: 0.15rem 0.25rem; display: inline-block;">
                                                <select onchange="updateCareerStatus({{ $ps->id }}, this.value)" style="padding: 0.2rem; font-size: 0.75rem; font-weight: 700; height: 26px; width: 100%; border: none; background: transparent; outline: none; color: var(--text-primary); cursor: pointer;">
                                                    <option value="active" {{ $ps->career_status === 'active' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="passed" {{ $ps->career_status === 'passed' ? 'selected' : '' }}>Lulus</option>
                                                    <option value="failed" {{ $ps->career_status === 'failed' ? 'selected' : '' }}>Gugur</option>
                                                    <option value="resigned" {{ $ps->career_status === 'resigned' ? 'selected' : '' }}>Mundur</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada data santri berkarya di divisi asuhan Anda yang cocok dengan filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
                    {{ $passedStudents->links() }}
                </div>
            </div>
        </main>
    </div>

    <!-- Script for status updating -->
    <script>
        function updateCareerStatus(studentId, newStatus) {
            fetch(`/pengajar/career/reports/${studentId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ career_status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status santri berhasil diperbarui!');
                } else {
                    alert('Gagal memperbarui status: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan sistem.');
            });
        }
    </script>

    <!-- Modal Penilaian -->
    <div id="penilaianModal" class="modal-overlay" style="display: none;">
        <div class="modal-card" style="max-width: 550px; width: 90%;">
            <div class="modal-header">
                <h2>Form Penilaian Rapor Berkarya</h2>
                <button class="btn-close-modal" onclick="closePenilaianModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('pengajar.career.penilaian.store') }}" method="POST">
                @csrf
                <input type="hidden" id="modal_student_id" name="career_student_id">
                <input type="hidden" name="evaluation_date" value="{{ $year }}-{{ sprintf('%02d', $month) }}-25">

                <div class="modal-body">
                    <p style="margin-bottom: 1.5rem; font-weight: 600; color: var(--text-secondary);">
                        Santri: <span id="modal_student_name" style="color: var(--accent-blue); font-weight: 800; font-size: 1.1rem;"></span>
                    </p>

                    <h4 style="font-size: 0.95rem; font-weight: 800; color: var(--accent-red); margin-bottom: 0.75rem; border-bottom: 2px solid rgba(239, 68, 68, 0.2); padding-bottom: 0.25rem;"><i class="fa-solid fa-heart"></i> Aspek Soft Skill</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div class="input-group">
                            <label for="soft_comm" style="font-size: 0.75rem;">Komunikasi</label>
                            <div class="input-wrapper" style="height: 38px;">
                                <input type="number" step="any" min="0" max="100" id="soft_comm" name="soft_skill_communication" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; text-align: center; color: var(--text-primary);">
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="soft_team" style="font-size: 0.75rem;">Kerjasama</label>
                            <div class="input-wrapper" style="height: 38px;">
                                <input type="number" step="any" min="0" max="100" id="soft_team" name="soft_skill_teamwork" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; text-align: center; color: var(--text-primary);">
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="soft_disc" style="font-size: 0.75rem;">Disiplin</label>
                            <div class="input-wrapper" style="height: 38px;">
                                <input type="number" step="any" min="0" max="100" id="soft_disc" name="soft_skill_discipline" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; text-align: center; color: var(--text-primary);">
                            </div>
                        </div>
                    </div>

                    <h4 style="font-size: 0.95rem; font-weight: 800; color: var(--accent-blue); margin-bottom: 0.75rem; border-bottom: 2px solid rgba(59, 130, 246, 0.2); padding-bottom: 0.25rem;"><i class="fa-solid fa-brain"></i> Aspek Hard Skill</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div class="input-group">
                            <label for="hard_qual" style="font-size: 0.75rem;">Kualitas Kerja</label>
                            <div class="input-wrapper" style="height: 38px;">
                                <input type="number" step="any" min="0" max="100" id="hard_qual" name="hard_skill_quality" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; text-align: center; color: var(--text-primary);">
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="hard_spd" style="font-size: 0.75rem;">Kecepatan</label>
                            <div class="input-wrapper" style="height: 38px;">
                                <input type="number" step="any" min="0" max="100" id="hard_spd" name="hard_skill_speed" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; text-align: center; color: var(--text-primary);">
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="hard_prob" style="font-size: 0.75rem;">Problem Solving</label>
                            <div class="input-wrapper" style="height: 38px;">
                                <input type="number" step="any" min="0" max="100" id="hard_prob" name="hard_skill_problem_solving" required style="width: 100%; border: none; background: transparent; outline: none; font-weight: 700; text-align: center; color: var(--text-primary);">
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="notes" style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 0.35rem; display: block;">Catatan Evaluasi / Project Kerja</label>
                        <div class="input-wrapper">
                            <textarea id="notes" name="notes" rows="3" style="width: 100%; border: none; background: transparent; font-family: var(--font-body); font-size: 0.9rem; color: var(--text-primary); outline: none; resize: vertical; padding: 0.5rem;" placeholder="Tulis progress project atau catatan evaluasi untuk santri ini..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1.5rem;">
                    <button type="button" class="btn-cancel" onclick="closePenilaianModal()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); height: 38px; padding: 0 1.25rem; border-radius: 8px; font-weight: 700; color: var(--text-secondary); cursor: pointer;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">Batal</button>
                    <button type="submit" class="btn-confirm" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); height: 38px; padding: 0 1.25rem; border-radius: 8px; font-weight: 800; color: var(--accent-blue); cursor: pointer;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">Simpan Nilai</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.submenu-trigger').forEach(trigger => {
            trigger.addEventListener('click', () => {
                const parent = trigger.parentElement;
                parent.classList.toggle('open');
            });
        });

        function openPenilaianModal(studentId, studentName, softComm, softTeam, softDisc, hardQual, hardSpd, hardProb, notes) {
            document.getElementById('modal_student_id').value = studentId;
            document.getElementById('modal_student_name').innerText = studentName;
            
            document.getElementById('soft_comm').value = softComm !== null && softComm !== 0 ? softComm : '';
            document.getElementById('soft_team').value = softTeam !== null && softTeam !== 0 ? softTeam : '';
            document.getElementById('soft_disc').value = softDisc !== null && softDisc !== 0 ? softDisc : '';
            
            document.getElementById('hard_qual').value = hardQual !== null && hardQual !== 0 ? hardQual : '';
            document.getElementById('hard_spd').value = hardSpd !== null && hardSpd !== 0 ? hardSpd : '';
            document.getElementById('hard_prob').value = hardProb !== null && hardProb !== 0 ? hardProb : '';
            
            document.getElementById('notes').value = notes ? notes : '';
            
            document.getElementById('penilaianModal').style.display = 'flex';
        }

        function closePenilaianModal() {
            document.getElementById('penilaianModal').style.display = 'none';
        }
    </script>
</body>
</html>
