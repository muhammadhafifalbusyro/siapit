<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Pendidikan Saya - SIAPIT</title>
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

        /* Neumorphic Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(224, 232, 246, 0.7);
            backdrop-filter: blur(8px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }
        .modal-card {
            background: var(--bg-primary);
            box-shadow: 20px 20px 60px #beccd7, -20px -20px 60px #ffffff;
            border-radius: 20px;
            width: 95%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2.5rem;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            position: relative;
        }
        .modal-overlay.show .modal-card {
            transform: scale(1);
        }
        .rapor-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px dashed #cbd5e1;
            padding-bottom: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .rapor-title {
            font-weight: 850;
            color: var(--text-primary);
            font-size: 1.4rem;
            margin-bottom: 0.25rem;
        }
        .rapor-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
            background: rgba(243, 244, 246, 0.4);
            padding: 1rem;
            border-radius: 12px;
            box-shadow: var(--nm-inset-sm);
        }
        .rapor-meta-item {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 600;
        }
        .rapor-meta-item strong {
            color: var(--text-primary);
        }
        .table-rapor {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        .table-rapor th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            color: var(--text-secondary);
            border-bottom: 2px solid #cbd5e1;
            font-weight: 800;
        }
        .table-rapor td {
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            color: var(--text-primary);
            border-bottom: 1px solid #cbd5e1;
            font-weight: 700;
        }
        .close-modal-btn {
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: var(--transition);
        }
        .close-modal-btn:hover {
            box-shadow: var(--nm-flat-hover);
            color: var(--accent-red);
        }
        
        .print-page {
            border-bottom: 2px dashed #cbd5e1;
            padding-bottom: 2.5rem;
            margin-bottom: 2.5rem;
        }
        .print-page:last-of-type {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }
        
        @media print {
            body * {
                visibility: hidden;
            }
            #rapor-modal, #rapor-modal *, .modal-card, .modal-card * {
                visibility: visible !important;
            }
            #rapor-modal {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                height: auto !important;
                overflow: visible !important;
                background: none !important;
                backdrop-filter: none !important;
                display: block !important;
            }
            .modal-card {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                box-shadow: none !important;
                background: white !important;
                padding: 0 !important;
                max-height: none !important;
                overflow: visible !important;
            }
            .modal-footer-btns, .close-modal-btn {
                display: none !important;
            }
            .print-page {
                page-break-after: always;
                border-bottom: none !important;
                padding-bottom: 0 !important;
                margin-bottom: 0 !important;
            }
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
                    <h1>Rapor Saya Pendidikan</h1>
                    <p>Tinjauan akumulasi realisasi pencapaian target bulanan dan nilai gabungan Anda.</p>
                </div>
            </header>

            @if($educationStudent && $activePeriod)
                <div class="dashboard-panel">
                    <h2 class="panel-title"><i class="fa-solid fa-file-invoice"></i> Rapor Kumulatif Pendidikan</h2>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1.5rem; border-radius: 12px; text-align: center;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">Status Kelulusan</span>
                            <div style="font-size: 1.25rem; font-weight: 900; margin-top: 0.5rem; color: {{ $educationStudent->status === 'passed' ? '#10b981' : '#f59e0b' }};">
                                {{ $educationStudent->status === 'passed' ? 'LULUS MASA PENDIDIKAN' : 'AKTIF / PROSES SELEKSI' }}
                            </div>
                        </div>
                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1.5rem; border-radius: 12px; text-align: center;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">Nilai Akhir Kumulatif</span>
                            <div style="font-size: 1.75rem; font-weight: 900; margin-top: 0.25rem; color: {{ $raporPayload['final_score'] >= 75 ? '#10b981' : '#f59e0b' }};">
                                {{ number_format($raporPayload['final_score'], 2) }}%
                            </div>
                        </div>
                    </div>

                    <div style="text-align: center; margin-top: 2rem;">
                        <button type="button" class="btn-view-rapor" id="btn-show-preview" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); padding: 0.75rem 2rem; border-radius: 10px; font-weight: 800; font-size: 0.9rem; color: var(--accent-blue); cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                            <i class="fa-solid fa-file-pdf"></i> Buka Preview & Lembar Rapor Lengkap
                        </button>
                    </div>
                </div>
            @else
                <div class="dashboard-panel" style="text-align: center; padding: 4rem 2rem;">
                    <i class="fa-solid fa-circle-info" style="font-size: 2.5rem; color: var(--text-secondary); margin-bottom: 1rem;"></i>
                    <h3 style="font-weight: 850;">Tidak Terdaftar</h3>
                    <p style="color: var(--text-secondary); font-weight: 600; margin-top: 0.25rem;">Anda tidak terdaftar di kelas Masa Pendidikan.</p>
                </div>
            @endif
        </main>
    </div>

    <!-- Modal Pop-up Rapor Santri -->
    <div id="rapor-modal" class="modal-overlay">
        <div class="modal-card" id="modal-card-print-container">
            <!-- Dynamic pages injected here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('btn-show-preview');
            if (btn) {
                btn.addEventListener('click', () => {
                    const data = @json($raporPayload);
                    openRaporModal(data);
                });
            }
        });

        function openRaporModal(data) {
            const container = document.getElementById('modal-card-print-container');
            container.innerHTML = '';
            let pagesHtml = '';

            let statusText = 'Aktif';
            let statusColor = '#075985';
            if (data.status === 'passed') { statusText = 'LULUS UTAMA'; statusColor = '#065f46'; }
            else if (data.status === 'failed') { statusText = 'GUGUR / TIDAK LULUS'; statusColor = '#991b1b'; }
            else if (data.status === 'resigned') { statusText = 'MUNDUR'; statusColor = '#92400e'; }

            let monthlySummaryRows = '';
            data.monthly_reports.forEach(m => {
                monthlySummaryRows += `
                    <tr>
                        <td><strong style="color: var(--text-primary); font-size: 0.9rem;">${m.label}</strong></td>
                        <td style="text-align: center; font-weight: 800; font-size: 0.9rem;">${m.char_avg.toFixed(1)}%</td>
                        <td style="text-align: center; font-weight: 800; font-size: 0.9rem;">${m.skill_avg.toFixed(1)}%</td>
                        <td style="text-align: center;">
                            <span style="font-weight: 900; font-size: 1.05rem; color: ${m.final_score !== '-' && m.final_score >= 75 ? '#10b981' : '#f59e0b'};">
                                ${m.final_score}%
                            </span>
                        </td>
                    </tr>
                `;
            });

            pagesHtml += `
                <div class="print-page">
                    <div class="rapor-header">
                        <div>
                            <h2 class="rapor-title" style="font-size: 1.6rem; letter-spacing: -0.5px;">RAPOR HASIL SELEKSI MASA PENDIDIKAN</h2>
                            <p style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 700; text-transform: uppercase;">Pondok IT Yogyakarta</p>
                        </div>
                        <button type="button" class="close-modal-btn" onclick="closeRaporModal()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="rapor-grid" style="display: grid; grid-template-columns: 80px 1fr 1fr; gap: 1.25rem; background: rgba(243, 244, 246, 0.6); padding: 1.25rem; align-items: center; border-radius: 12px; margin-bottom: 1.5rem;">
                        <div style="width: 80px; height: 105px; border-radius: 6px; overflow: hidden; background: #e0e5ec; box-shadow: var(--nm-inset-sm); display: flex; align-items: center; justify-content: center; border: 1.5px solid #cbd5e1;">
                            ${data.student_photo ? `<img src="${data.student_photo}" alt="Foto Santri" style="width: 100%; height: 100%; object-fit: cover;">` : `<i class="fa-solid fa-user" style="font-size: 2.2rem; color: #a3b1c6;"></i>`}
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 0.35rem;">
                            <div class="rapor-meta-item">Nama Santri: <strong style="font-size: 0.95rem;">${data.student_name}</strong></div>
                            <div class="rapor-meta-item">Kelas: <strong>${data.classroom_name}</strong></div>
                            <div class="rapor-meta-item">Jurusan: <strong>${data.major_name}</strong></div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 0.35rem; border-left: 2px dashed #cbd5e1; padding-left: 1.25rem; height: 100%; justify-content: center;">
                            <div class="rapor-meta-item">Tahun Ajaran: <strong>${data.academic_year}</strong></div>
                            <div class="rapor-meta-item">Gelombang/Batch: <strong>${data.batch}</strong></div>
                        </div>
                    </div>

                    <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.75rem; border-bottom: 2px solid var(--accent-blue); padding-bottom: 0.4rem;"><i class="fa-solid fa-chart-pie" style="color: var(--accent-blue);"></i> Kesimpulan Rapor Akhir</h3>
                    
                    <table class="table-rapor" style="margin-bottom: 1.75rem;">
                        <thead>
                            <tr style="background: rgba(59, 130, 246, 0.05);">
                                <th>Bulan Bimbingan</th>
                                <th style="text-align: center;">Persentase Karakter</th>
                                <th style="text-align: center;">Persentase Skill</th>
                                <th style="text-align: center; width: 160px;">Nilai Gabungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${monthlySummaryRows || '<tr><td colspan="4" style="text-align:center;">Belum ada data bulanan</td></tr>'}
                        </tbody>
                    </table>

                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1.5rem; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border: 1px solid rgba(226, 232, 240, 0.8);">
                        <div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">Hasil Keputusan Kelulusan</span>
                            <div style="font-size: 1.4rem; font-weight: 900; color: ${statusColor}; margin-top: 0.25rem;">${statusText}</div>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">Nilai Akhir Kumulatif</span>
                            <div style="font-size: 2rem; font-weight: 900; color: ${data.final_score >= 75 ? '#10b981' : '#f59e0b'}; margin-top: 0.15rem;">${data.final_score.toFixed(2)}%</div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-top: 2.5rem; text-align: center; font-size: 0.8rem; font-weight: 700; color: var(--text-primary);">
                        <div>
                            <p style="margin-bottom: 4.5rem; color: var(--text-secondary);">Wali Kelas (Homeroom Teacher)</p>
                            <div style="border-bottom: 1.5px solid #cbd5e1; width: 75%; margin: 0 auto;"></div>
                        </div>
                        <div>
                            <p style="margin-bottom: 4.5rem; color: var(--text-secondary);">Kepala Pendidikan Karakter</p>
                            <div style="border-bottom: 1.5px solid #cbd5e1; width: 75%; margin: 0 auto;"></div>
                        </div>
                        <div>
                            <p style="margin-bottom: 4.5rem; color: var(--text-secondary);">Kepala Pendidikan Skill</p>
                            <div style="border-bottom: 1.5px solid #cbd5e1; width: 75%; margin: 0 auto;"></div>
                        </div>
                    </div>
                </div>
            `;

            data.monthly_reports.forEach(month => {
                let charRows = '';
                let skillRows = '';

                month.aspects.forEach(asp => {
                    const rowHtml = `
                        <tr>
                            <td>
                                <div style="font-weight: 800; color: var(--text-primary);">${asp.name}</div>
                                <div style="font-size: 0.7rem; color: var(--text-secondary); font-weight: 600;">${asp.detail}</div>
                            </td>
                            <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">${asp.weight}%</td>
                            <td style="text-align: center; font-weight: 800; color: var(--text-primary);">${asp.score}</td>
                            <td style="text-align: center; font-weight: 800; color: var(--accent-blue);">${asp.weighted}</td>
                        </tr>
                    `;
                    if (asp.type === 'Karakter') { charRows += rowHtml; } else { skillRows += rowHtml; }
                });

                pagesHtml += `
                    <div class="print-page">
                        <div class="rapor-header">
                            <div>
                                <h2 class="rapor-title" style="font-size: 1.3rem;">LAMPIRAN RINCIAN DETAIL BULANAN</h2>
                                <p style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 700;">Periode Bimbingan: ${month.label} </p>
                            </div>
                            <span style="font-size: 1rem; font-weight: 900; color: var(--accent-blue); padding: 0.25rem 0.65rem; background: rgba(59,130,246,0.1); border-radius: 8px;">Skor Bulan: ${month.final_score}%</span>
                        </div>

                        <div class="rapor-grid" style="padding: 0.75rem 1rem; margin-bottom: 1.25rem;">
                            <div class="rapor-meta-item">Nama Santri: <strong>${data.student_name}</strong></div>
                            <div class="rapor-meta-item">Kelas: <strong>${data.classroom_name}</strong></div>
                        </div>

                        <h4 style="font-size: 0.95rem; font-weight: 800; color: var(--accent-red); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem;"><i class="fa-solid fa-heart"></i> Penilaian Karakter</h4>
                        <table class="table-rapor" style="margin-bottom: 1.5rem;">
                            <thead>
                                <tr>
                                    <th>Kriteria Aspek</th>
                                    <th style="text-align: center; width: 80px;">Bobot</th>
                                    <th style="text-align: center; width: 120px;">Pencapaian</th>
                                    <th style="text-align: center; width: 120px;">Kontribusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${charRows || '<tr><td colspan="4" style="text-align:center; color: var(--text-secondary);">Tidak ada penilaian karakter aktif</td></tr>'}
                            </tbody>
                        </table>

                        <h4 style="font-size: 0.95rem; font-weight: 800; color: var(--accent-blue); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem;"><i class="fa-solid fa-brain"></i> Penilaian Skill</h4>
                        <table class="table-rapor" style="margin-bottom: 1.5rem;">
                            <thead>
                                <tr>
                                    <th>Kriteria Aspek</th>
                                    <th style="text-align: center; width: 80px;">Bobot</th>
                                    <th style="text-align: center; width: 120px;">Pencapaian</th>
                                    <th style="text-align: center; width: 120px;">Kontribusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${skillRows || '<tr><td colspan="4" style="text-align:center; color: var(--text-secondary);">Tidak ada penilaian skill aktif</td></tr>'}
                            </tbody>
                        </table>
                        
                        <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); padding: 1rem; border-radius: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <div style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary);">Persentase Karakter: <strong>${month.char_avg.toFixed(1)}%</strong></div>
                                <div style="font-size: 0.8rem; font-weight: 700; color: var(--text-secondary); margin-top: 0.25rem;">Persentase Skill: <strong>${month.skill_avg.toFixed(1)}%</strong></div>
                            </div>
                            <div style="text-align: right;">
                                <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary);">Rata-rata Gabungan Bulan ini</span>
                                <div style="font-size: 1.4rem; font-weight: 900; color: var(--accent-blue);">${month.final_score}%</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            });

            pagesHtml += `
                <div class="modal-footer-btns" style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                    <button type="button" onclick="window.print()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--text-primary); font-weight: 800; font-size: 0.8rem; height: 38px; padding: 0 1.25rem; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                        <i class="fa-solid fa-print"></i> Cetak Rapor Lengkap
                    </button>
                    <button type="button" onclick="closeRaporModal()" style="border: none; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); color: var(--accent-red); font-weight: 800; font-size: 0.8rem; height: 38px; padding: 0 1.25rem; border-radius: 8px; cursor: pointer;" onmouseover="this.style.boxShadow='var(--nm-flat-hover)'" onmouseout="this.style.boxShadow='var(--nm-flat-sm)'">
                        Tutup
                    </button>
                </div>
            `;

            container.innerHTML = pagesHtml;
            document.getElementById('rapor-modal').classList.add('show');
        }

        function closeRaporModal() {
            document.getElementById('rapor-modal').classList.remove('remove');
            document.getElementById('rapor-modal').classList.remove('show');
        }
    </script>
</body>
</html>
