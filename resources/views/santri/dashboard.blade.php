<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Santri - SIAPIT</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
    <style>

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

        /* Neumorphic Segmented Stage Track */
        .stage-track {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            padding: 1rem;
            border-radius: 24px;
            margin: 2rem 0;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
        }

        .stage-card {
            background: var(--bg-primary);
            border-radius: 18px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: var(--transition);
            position: relative;
            border: 1.5px solid rgba(255,255,255,0.3);
            min-height: 140px;
        }

        .stage-card.pending {
            box-shadow: none;
            opacity: 0.65;
            border-color: rgba(255,255,255,0.1);
        }

        .stage-card.completed {
            box-shadow: var(--nm-flat-sm);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.7), rgba(240, 244, 249, 0.4));
        }

        .stage-card.completed .stage-icon-box {
            background: var(--accent-green);
            color: #ffffff;
            box-shadow: 0px 4px 10px rgba(16, 185, 129, 0.2);
        }

        .stage-card.active {
            box-shadow: var(--nm-flat-sm);
            border-color: var(--accent-blue);
            transform: scale(1.02);
            background: var(--bg-primary);
        }

        .stage-card.active .stage-icon-box {
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            color: var(--accent-blue);
            border: 1.5px solid rgba(59, 130, 246, 0.4);
        }

        .stage-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            transition: var(--transition);
        }

        .stage-title {
            font-size: 0.95rem;
            font-weight: 850;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .stage-card.active .stage-title {
            color: var(--accent-blue);
        }

        .stage-status-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
        }

        .stage-card.completed .stage-status-label {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-green);
        }

        .stage-card.active .stage-status-label {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
        }

        .stage-card.pending .stage-status-label {
            background: rgba(100, 116, 139, 0.1);
            color: var(--text-secondary);
        }

        /* Neumorphic Modal Styles */
        .nm-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(224, 232, 246, 0.6);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .nm-modal-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        .nm-modal-content {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 24px;
            width: 90%;
            max-width: 500px;
            padding: 2.5rem;
            border: 1.5px solid rgba(255,255,255,0.4);
            transform: scale(0.9);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .nm-modal-overlay.show .nm-modal-content {
            transform: scale(1);
        }

        .nm-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .nm-modal-title {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nm-modal-close {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 1rem;
            transition: var(--transition);
        }

        .nm-modal-close:hover {
            box-shadow: var(--nm-flat-hover);
            color: var(--accent-red);
        }

        .nm-modal-body {
            max-height: 350px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        /* Custom Scrollbar */
        .nm-modal-body::-webkit-scrollbar {
            width: 6px;
        }
        .nm-modal-body::-webkit-scrollbar-track {
            background: transparent;
        }
        .nm-modal-body::-webkit-scrollbar-thumb {
            background: #beccd7;
            border-radius: 10px;
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
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout-icon" title="Keluar">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </header>

            <header class="main-header" style="margin-bottom: 2rem;">
                <div class="welcome-section">
                    <h1>Ahlan wa Sahlan, {{ explode(' ', $user->name)[0] }}!</h1>
                    <p>Semoga harimu dipenuhi keberkahan Al-Qur'an dan kemudahan dalam belajar.</p>
                </div>
            </header>

            <!-- Line Progress Tracker Fase Belajar -->
            <div class="dashboard-panel" style="padding: 2rem;">
                <h3 class="panel-title" style="margin-bottom: 1.5rem;"><i class="fa-solid fa-route" style="color: var(--accent-blue);"></i> Progress Fase Belajar Anda</h3>
                
                @php
                    $isMatriculation = ($activePhase === 'Masa Matrikulasi');
                    $isEducation = ($activePhase === 'Masa Pendidikan');
                    $isCareer = ($activePhase === 'Masa Berkarya');
                @endphp

                <!-- Neumorphic Segmented Track Layout -->
                <div class="stage-track">
                    <!-- Stage 1: Matrikulasi -->
                    <div class="stage-card {{ $isMatriculation ? 'active' : '' }} {{ ($isEducation || $isCareer) ? 'completed' : '' }}">
                        <div class="stage-icon-box">
                            @if($isEducation || $isCareer)
                                <i class="fa-solid fa-circle-check"></i>
                            @else
                                <i class="fa-solid fa-compass"></i>
                            @endif
                        </div>
                        <span class="stage-title">Matrikulasi</span>
                        <span class="stage-status-label">
                            @if($isEducation || $isCareer) Lulus @else Aktif @endif
                        </span>
                    </div>

                    <!-- Stage 2: Pendidikan -->
                    <div class="stage-card {{ $isEducation ? 'active' : '' }} {{ $isCareer ? 'completed' : '' }} {{ $isMatriculation ? 'pending' : '' }}">
                        <div class="stage-icon-box">
                            @if($isCareer)
                                <i class="fa-solid fa-circle-check"></i>
                            @else
                                <i class="fa-solid fa-book-open"></i>
                            @endif
                        </div>
                        <span class="stage-title">Pendidikan</span>
                        <span class="stage-status-label">
                            @if($isCareer) Lulus @elseif($isEducation) Aktif @else Belum @endif
                        </span>
                    </div>

                    <!-- Stage 3: Berkarya -->
                    <div class="stage-card {{ $isCareer ? 'active' : '' }} {{ ($isMatriculation || $isEducation) ? 'pending' : '' }}">
                        <div class="stage-icon-box">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <span class="stage-title">Masa Berkarya</span>
                        <span class="stage-status-label">
                            @if($isCareer) Aktif @else Belum @endif
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Detail Informasi Fase Belajar -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 1rem; margin-bottom: 2rem;">
                <!-- Masa Matrikulasi -->
                <div style="background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 20px; padding: 1.5rem; border: 1.5px solid rgba(255,255,255,0.3); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h4 style="font-weight: 900; font-size: 1.05rem; color: var(--accent-blue); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-compass"></i> Masa Matrikulasi
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                            <li style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-school" style="color: var(--accent-blue); width: 14px;"></i> 
                                <a href="javascript:void(0)" onclick="openClassModal('Matrikulasi', '{{ $matriculationStudent->classroom->name ?? 'Belum Ada Kelas' }}', '{{ $matriculationStudent->classroom->homeroomTeacher->name ?? 'Belum Ditentukan' }}', '{{ $matriculationStudent->classroom->assistantTeacher->name ?? 'Belum Ditentukan' }}', {{ json_encode($matriculationStudent->classroom->matriculationStudents ?? []) }}, 'matriculation')" style="color: inherit; text-decoration: none; border-bottom: 1px dashed var(--accent-blue); transition: var(--transition);">
                                    Kelas: {{ $matriculationStudent->classroom->name ?? 'Belum Ada Kelas' }}
                                </a>
                            </li>
                            <li style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-calendar-day" style="color: var(--accent-blue); width: 14px;"></i> 
                                <a href="{{ route('santri.matriculation.daily-control') }}" style="color: inherit; text-decoration: none; transition: var(--transition);" onmouseover="this.style.color='var(--accent-blue)'" onmouseout="this.style.color='inherit'">Kontrol Harian</a>
                            </li>
                            <li style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-file-invoice" style="color: var(--accent-blue); width: 14px;"></i> 
                                <a href="{{ route('santri.matriculation.rapor') }}" style="color: inherit; text-decoration: none; transition: var(--transition);" onmouseover="this.style.color='var(--accent-blue)'" onmouseout="this.style.color='inherit'">Rapor Saya</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Masa Pendidikan -->
                <div style="background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 20px; padding: 1.5rem; border: 1.5px solid rgba(255,255,255,0.3); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h4 style="font-weight: 900; font-size: 1.05rem; color: var(--accent-green); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-book-open"></i> Masa Pendidikan
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                            <li style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-school" style="color: var(--accent-green); width: 14px;"></i> 
                                <a href="javascript:void(0)" onclick="openClassModal('Pendidikan', '{{ $educationStudent->classroom->name ?? 'Belum Ada Kelas' }}', '{{ $educationStudent->classroom->homeroomTeacher->name ?? 'Belum Ditentukan' }}', '{{ $educationStudent->classroom->assistantTeacher->name ?? 'Belum Ditentukan' }}', {{ json_encode($educationClassmates ?? []) }}, 'education')" style="color: inherit; text-decoration: none; border-bottom: 1px dashed var(--accent-green); transition: var(--transition);">
                                    Kelas: {{ $educationStudent->classroom->name ?? 'Belum Ada Kelas' }}
                                </a>
                            </li>
                            <li style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-calendar-day" style="color: var(--accent-green); width: 14px;"></i> 
                                <a href="{{ route('santri.education.daily-control') }}" style="color: inherit; text-decoration: none; transition: var(--transition);" onmouseover="this.style.color='var(--accent-green)'" onmouseout="this.style.color='inherit'">Kontrol Harian</a>
                            </li>
                            <li style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-file-invoice" style="color: var(--accent-green); width: 14px;"></i> 
                                <a href="{{ route('santri.education.rapor') }}" style="color: inherit; text-decoration: none; transition: var(--transition);" onmouseover="this.style.color='var(--accent-green)'" onmouseout="this.style.color='inherit'">Rapor Saya</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Masa Berkarya -->
                <div style="background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 20px; padding: 1.5rem; border: 1.5px solid rgba(255,255,255,0.3); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h4 style="font-weight: 900; font-size: 1.05rem; color: var(--accent-orange); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-briefcase"></i> Masa Berkarya
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                            <li style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-laptop-code" style="color: var(--accent-orange); width: 14px;"></i> 
                                <a href="javascript:void(0)" onclick="openClassModal('Masa Berkarya', '{{ $careerStudent->placement->name ?? 'Belum Ditempatkan' }}', '{{ $careerStudent->placement->mentor_name ?? 'Belum Ditentukan' }}', '{{ $careerStudent->placement->mentor_contact ?? '-' }}', {{ json_encode($careerClassmates ?? []) }}, 'career')" style="color: inherit; text-decoration: none; border-bottom: 1px dashed var(--accent-orange); transition: var(--transition);">
                                    Divisi: {{ $careerStudent->placement->name ?? 'Belum Ditempatkan' }}
                                </a>
                            </li>
                            <li style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-folder-open" style="color: var(--accent-orange); width: 14px;"></i> 
                                <a href="{{ route('santri.proyek') }}" style="color: inherit; text-decoration: none; transition: var(--transition);" onmouseover="this.style.color='var(--accent-orange)'" onmouseout="this.style.color='inherit'">Proyek Berkarya</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1.5rem; border-radius: 15px; border: 1.5px solid rgba(255,255,255,0.4); text-align: center; color: var(--text-secondary); font-weight: 700; font-size: 0.85rem;">
                <i class="fa-solid fa-circle-info" style="color: var(--accent-blue);"></i> Anda saat ini berada pada <strong>{{ $activePhase }}</strong> ({{ $classroomName }}). Pantau progres harian Anda di menu navigasi sidebar.
            </div>
        </main>
    </div>

    <!-- Classroom Details Modal -->
    <div class="nm-modal-overlay" id="classModal">
        <div class="nm-modal-content">
            <div class="nm-modal-header">
                <h3 class="nm-modal-title" id="modalTitle"><i class="fa-solid fa-circle-info"></i> Info Kelas</h3>
                <button class="nm-modal-close" onclick="closeClassModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="nm-modal-body">
                <div id="homeroomBox" style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1.25rem; border-radius: 16px; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.3);">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 0.5rem;">Walikelas / Mentor</div>
                    <div style="font-size: 0.95rem; font-weight: 850; color: var(--text-primary);" id="homeroomText">-</div>
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); margin-top: 0.15rem;" id="assistantText">Asisten: -</div>
                </div>

                <div style="font-size: 0.8rem; font-weight: 850; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: space-between;">
                    <span id="studentsListTitle">Daftar Siswa Sekelas</span>
                    <span id="classmateCount" style="color: var(--accent-blue); background: rgba(59, 130, 246, 0.1); padding: 0.15rem 0.5rem; border-radius: 6px; font-size: 0.7rem;">0 Orang</span>
                </div>
                <div id="classmatesList" style="display: flex; flex-direction: column; gap: 0.6rem;">
                    <!-- Classmates items will be injected here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function openClassModal(phaseName, className, homeroomTeacher, assistantTeacher, students, type) {
            if (type === 'career') {
                document.getElementById('modalTitle').innerHTML = `<i class="fa-solid fa-briefcase"></i> Detail Divisi ${className}`;
                document.getElementById('homeroomBox').style.display = 'block'; 
                document.querySelector('#homeroomBox div').innerText = 'PJ Divisi / Mentor';
                document.getElementById('homeroomText').innerText = homeroomTeacher || '-';
                
                const assistDiv = document.getElementById('assistantText');
                assistDiv.style.display = 'block';
                assistDiv.innerText = 'Kontak: ' + (assistantTeacher || '-');
                document.getElementById('studentsListTitle').innerText = 'Anggota Divisi';
            } else {
                document.getElementById('modalTitle').innerHTML = `<i class="fa-solid fa-school"></i> Detail Kelas ${className}`;
                document.getElementById('homeroomBox').style.display = 'block'; 
                document.querySelector('#homeroomBox div').innerText = 'Walikelas / Mentor';
                document.getElementById('homeroomText').innerText = homeroomTeacher || '-';
                
                const assistDiv = document.getElementById('assistantText');
                assistDiv.style.display = 'block';
                assistDiv.innerText = 'Asisten: ' + (assistantTeacher || '-');
                document.getElementById('studentsListTitle').innerText = 'Daftar Siswa Sekelas';
            }

            const classmatesContainer = document.getElementById('classmatesList');
            classmatesContainer.innerHTML = '';
            
            let count = 0;
            if (students && students.length > 0) {
                students.forEach((student, index) => {
                    const regObj = student.registration;
                    if (regObj) {
                        count++;
                        const isSelf = regObj.email === "{{ $user->email }}";
                        const div = document.createElement('div');
                        div.style.background = isSelf ? 'rgba(59, 130, 246, 0.05)' : 'var(--bg-primary)';
                        div.style.boxShadow = isSelf ? 'var(--nm-inset-sm)' : 'var(--nm-flat-sm)';
                        div.style.borderRadius = '12px';
                        div.style.padding = '0.75rem 1rem';
                        div.style.display = 'flex';
                        div.style.justifyContent = 'space-between';
                        div.style.alignItems = 'center';
                        div.style.border = isSelf ? '1.5px solid rgba(59, 130, 246, 0.3)' : '1px solid rgba(255,255,255,0.3)';
                        
                        div.innerHTML = `
                            <div>
                                <span style="font-size: 0.85rem; font-weight: 800; color: var(--text-primary);">${regObj.name}</span>
                                <div style="font-size: 0.7rem; color: var(--text-secondary); font-weight: 600;">NIS: ${regObj.user ? regObj.user.username : '-'}</div>
                            </div>
                            ${isSelf ? '<span style="font-size: 0.65rem; font-weight: 900; color: var(--accent-blue); background: rgba(59, 130, 246, 0.15); padding: 0.15rem 0.4rem; border-radius: 4px;">Saya</span>' : ''}
                        `;
                        classmatesContainer.appendChild(div);
                    }
                });
            } else {
                classmatesContainer.innerHTML = '<div style="text-align: center; font-size: 0.8rem; color: var(--text-secondary); padding: 1.5rem; font-style: italic; font-weight: 700;">Belum ada anggota kelas.</div>';
            }

            document.getElementById('classmateCount').innerText = `${count} Orang`;
            document.getElementById('classModal').classList.add('show');
        }

        function closeClassModal() {
            document.getElementById('classModal').classList.remove('show');
        }

        // Close on overlay click
        document.getElementById('classModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeClassModal();
            }
        });
    </script>
</body>
</html>
