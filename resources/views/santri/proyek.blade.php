<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Proyek & Target Karya - SIAPIT</title>
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

        /* Sub Sidebar Nav */
        .management-grid {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 2rem;
            align-items: start;
        }

        .sub-sidebar {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            padding: 1.5rem 1rem;
            border-radius: 20px;
        }

        .sub-sidebar-title {
            font-size: 0.8rem;
            font-weight: 900;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            padding-left: 0.5rem;
        }

        .sub-tab-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-secondary);
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            border-radius: 10px;
            transition: var(--transition);
        }

        .sub-tab-btn:hover, .sub-tab-btn.active {
            color: var(--accent-blue);
            box-shadow: var(--nm-inset-sm);
        }

        /* Content Panel */
        .content-panel {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-md);
            border-radius: 20px;
            padding: 2rem;
        }

        /* Forms styling */
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .input-group label {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--text-secondary);
        }

        .input-wrapper {
            background: var(--bg-primary);
            box-shadow: var(--nm-inset-sm);
            border-radius: 10px;
            padding: 0.25rem 0.5rem;
        }

        .input-wrapper input, .input-wrapper select, .input-wrapper textarea {
            width: 100%;
            border: none;
            background: transparent;
            outline: none;
            padding: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .btn-submit {
            border: none;
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            color: var(--accent-blue);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-submit:hover {
            box-shadow: var(--nm-flat-hover);
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

        .submission-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1.5px solid rgba(255,255,255,0.5);
        }

        .submission-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1.5px solid rgba(255,255,255,0.4);
        }

        .submission-header h4 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--accent-blue);
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
                    <h1>Proyek & Target Karya</h1>
                    <p>Divisi Penempatan: <strong style="color: var(--accent-blue);">{{ $careerStudent->placement->name ?? 'Belum Ditempatkan' }}</strong></p>
                </div>
            </header>

            @if(session('success'))
                <div class="dashboard-panel" style="padding: 1rem; color: var(--accent-green); font-weight: 800; margin-bottom: 1.5rem; box-shadow: var(--nm-inset-sm);">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @if(!$careerStudent)
                <div class="dashboard-panel" style="text-align: center; padding: 4rem 2rem;">
                    <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: var(--text-secondary);">
                        <i class="fa-solid fa-circle-info" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 style="font-weight: 850; color: var(--text-primary);">Akses Terbatas</h3>
                    <p style="color: var(--text-secondary); max-width: 400px; margin: 0.5rem auto 0; font-weight: 600;">Modul ini hanya tersedia bagi santri yang telah memasuki Masa Berkarya.</p>
                </div>
            @else
                <div class="management-grid">
                    <!-- Left local tab-menu -->
                    <div class="sub-sidebar">
                        <span class="sub-sidebar-title">Menu Navigasi</span>
                        <a href="?tab=overview" class="sub-tab-btn {{ $activeTab === 'overview' ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-pie" style="width: 18px;"></i> Overview
                        </a>
                        
                        <span class="sub-sidebar-title" style="margin-top: 1rem;">Konteks Karya</span>
                        @foreach($contexts as $ctx)
                            <a href="?tab=context_{{ $ctx->id }}" class="sub-tab-btn {{ $activeTab === 'context_' . $ctx->id ? 'active' : '' }}">
                                <i class="fa-solid fa-folder" style="width: 18px;"></i> {{ $ctx->name }}
                            </a>
                        @endforeach

                        <span class="sub-sidebar-title" style="margin-top: 1rem;">Konteks Penghasilan</span>
                        <a href="?tab=income" class="sub-tab-btn {{ $activeTab === 'income' ? 'active' : '' }}">
                            <i class="fa-solid fa-money-bill-wave" style="width: 18px;"></i> Penghasilan
                        </a>
                    </div>

                    <!-- Right dynamic content panel -->
                    <div class="content-panel">
                        @if($activeTab === 'overview')
                            <h3 class="panel-title"><i class="fa-solid fa-chart-pie"></i> Ringkasan Karya & Penilaian</h3>
                            <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                                @forelse($summaries as $sum)
                                    <div style="background: var(--bg-secondary); box-shadow: var(--nm-inset-sm); padding: 1.5rem; border-radius: 15px; border: 1.5px solid rgba(255,255,255,0.4); display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <h4 style="font-weight: 900; font-size: 1.1rem; color: var(--accent-blue); margin-bottom: 0.25rem;">{{ $sum['context']->name }}</h4>
                                            <p style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 700;">Total Karya: {{ $sum['total_submissions'] }} item</p>
                                        </div>
                                        <a href="?tab=context_{{ $sum['context']->id }}" class="btn-submit" style="padding: 0.5rem 1rem; font-size: 0.75rem;">
                                            Buka Detail <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                @empty
                                    <div style="text-align: center; color: var(--text-secondary); padding: 2rem; font-weight: 700;">Belum ada Konteks Karya yang dikonfigurasi.</div>
                                @endforelse
                            </div>

                            <h3 class="panel-title" style="margin-top: 2rem;"><i class="fa-solid fa-money-bill-wave"></i> Ringkasan Penghasilan</h3>
                            <div style="background: var(--bg-secondary); box-shadow: var(--nm-flat-sm); padding: 1.5rem; border-radius: 15px; border: 1.5px solid rgba(255,255,255,0.4); display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h4 style="font-weight: 900; font-size: 1.1rem; color: var(--accent-green); margin-bottom: 0.25rem;">Total Penghasilan Anda</h4>
                                    <p style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 700;">Akumulasi pendapatan ter-approve selama Masa Berkarya</p>
                                </div>
                                <div style="font-size: 1.5rem; font-weight: 900; color: var(--accent-green);">
                                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                                </div>
                            </div>

                        @elseif($activeTab === 'income')
                            <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 2rem; align-items: start;">
                                <!-- List dynamic income submissions -->
                                <div>
                                    <div style="background: var(--bg-secondary); box-shadow: var(--nm-flat-sm); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; border: 1.5px solid rgba(255,255,255,0.4);">
                                        <span style="font-weight: 800; color: var(--text-secondary); font-size: 0.85rem;">TOTAL PENGHASILAN DISAPROVE</span>
                                        <span style="font-weight: 900; color: var(--accent-green); font-size: 1.25rem;">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
                                    </div>

                                    <h3 class="panel-title"><i class="fa-solid fa-list"></i> Daftar Laporan Penghasilan</h3>
                                    
                                    @forelse($incomes as $inc)
                                        <div class="submission-card">
                                            <div class="submission-header">
                                                <h4 style="color: var(--accent-blue); font-weight: 800; font-size: 1rem;">{{ $inc->source }}</h4>
                                                <div style="display: flex; gap: 0.5rem; align-items: center;">
                                                    @if($inc->is_approved)
                                                        <span class="badge approved" style="background: rgba(16, 185, 129, 0.1); color: var(--accent-green); padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem; font-weight: 800;"><i class="fa-solid fa-circle-check"></i> Approved</span>
                                                    @else
                                                        <span class="badge pending" style="background: rgba(245, 158, 11, 0.1); color: var(--accent-orange); padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem; font-weight: 800;"><i class="fa-solid fa-clock"></i> Pending</span>
                                                        <button class="btn-action-sm" style="color: var(--accent-blue);" onclick="editIncome({{ $inc->id }}, '{{ $inc->amount }}', '{{ $inc->source }}', '{{ $inc->date }}', '{{ $inc->notes }}')" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                                        <form method="POST" action="{{ route('santri.proyek.income.destroy', $inc->id) }}" onsubmit="return confirm('Hapus pengajuan penghasilan ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-action-sm" style="color: var(--accent-red);" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>

                                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 0.5rem;">
                                                <div>
                                                    <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 800;">Nominal</span>
                                                    <div style="font-size: 0.95rem; font-weight: 800; color: var(--accent-green);">
                                                        Rp {{ number_format($inc->amount, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                                <div>
                                                    <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 800;">Tanggal</span>
                                                    <div style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">
                                                        {{ \Carbon\Carbon::parse($inc->date)->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </div>

                                            @if($inc->notes)
                                                <div style="border-top: 1px solid rgba(255,255,255,0.3); padding-top: 0.5rem; margin-top: 0.5rem;">
                                                    <span style="font-size: 0.72rem; color: var(--text-secondary); font-weight: 800;">Catatan / Keterangan</span>
                                                    <p style="font-size: 0.8rem; font-weight: 600; color: var(--text-secondary); margin-top: 0.15rem;">{{ $inc->notes }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div style="text-align: center; color: var(--text-secondary); padding: 2.5rem; font-style: italic; font-weight: 700; box-shadow: var(--nm-inset-sm); border-radius: 12px;">Belum mengajukan laporan penghasilan.</div>
                                    @endforelse
                                </div>

                                <!-- Form Submit/Edit Income -->
                                <div class="dashboard-panel" style="padding: 1.5rem; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); border-radius: 20px;">
                                    <h3 class="panel-title" id="income-form-title"><i class="fa-solid fa-plus"></i> Lapor Penghasilan</h3>
                                    <form id="income-form" method="POST" action="{{ route('santri.proyek.income.store') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                                        @csrf
                                        <input type="hidden" name="_method" id="income-form-method" value="POST">
                                        <input type="hidden" name="education_student_id" value="{{ $educationStudent->id }}">

                                        <div class="input-group">
                                            <label>Sumber / Deskripsi Pekerjaan</label>
                                            <div class="input-wrapper">
                                                <input type="text" name="source" id="income_source" placeholder="Contoh: Freelance Landing Page, Project Mobile App" required>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <label>Nominal Pendapatan (Rp)</label>
                                            <div class="input-wrapper">
                                                <input type="text" name="amount" id="income_amount" placeholder="Rp 0" onkeyup="formatCurrencyInput(this)" required>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <label>Tanggal Diterima</label>
                                            <div class="input-wrapper">
                                                <input type="date" name="date" id="income_date" value="{{ date('Y-m-d') }}" required>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <label>Keterangan Tambahan</label>
                                            <div class="input-wrapper">
                                                <textarea name="notes" id="income_notes" rows="3" placeholder="Opsional" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn-submit" id="income-submit-btn" style="width: 100%; justify-content: center;">
                                                <i class="fa-solid fa-plus"></i> Kirim Laporan
                                            </button>
                                            <button type="button" class="btn-submit" id="income-cancel-btn" style="width: 100%; justify-content: center; margin-top: 0.5rem; display: none; background: transparent; box-shadow: var(--nm-flat-sm); color: var(--text-secondary);" onclick="resetIncomeForm()">
                                                Batal Edit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @else
                            @php
                                $ctxId = str_replace('context_', '', $activeTab);
                                $activeContext = $contexts->where('id', $ctxId)->first();
                                $activeSubmissions = $submissions->where('career_target_context_id', $ctxId);
                            @endphp
                            
                            @if($activeContext)
                                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 2rem; align-items: start;">
                                    <!-- List of submissions -->
                                    <div>
                                        <h3 class="panel-title"><i class="fa-solid fa-list-check"></i> Daftar Submisi Target Karya</h3>
                                        
                                        @forelse($activeSubmissions as $sub)
                                            <div class="submission-card">
                                                <div class="submission-header">
                                                    <h4>Submisi #{{ $loop->iteration }}</h4>
                                                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                                                        @if($sub->score == 1)
                                                            <span class="badge approved" style="background: rgba(16, 185, 129, 0.1); color: var(--accent-green); padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem; font-weight: 800;"><i class="fa-solid fa-circle-check"></i> Approved</span>
                                                        @else
                                                            <span class="badge pending" style="background: rgba(245, 158, 11, 0.1); color: var(--accent-orange); padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem; font-weight: 800;"><i class="fa-solid fa-circle-info"></i> Menunggu Penilaian</span>
                                                            <button class="btn-action-sm" style="color: var(--accent-blue);" onclick="editSubmission({{ $sub->id }}, {{ json_encode($sub->values) }})" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                                            <form method="POST" action="{{ route('santri.proyek.submission.destroy', $sub->id) }}" onsubmit="return confirm('Hapus submisi karya ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn-action-sm" style="color: var(--accent-red);" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                                    @foreach($sub->values as $val)
                                                        <div>
                                                            <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 800;">{{ $val->field->label }}</span>
                                                            <div style="font-size: 0.85rem; font-weight: 700; margin-top: 0.15rem; color: var(--text-primary);">
                                                                @if($val->field->type === 'link' && $val->value)
                                                                    <a href="{{ $val->value }}" target="_blank" style="color: var(--accent-blue); text-decoration: none;"><i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Link</a>
                                                                @elseif($val->field->type === 'multiple_images' && $val->value)
                                                                    @php $imgs = json_decode($val->value, true); @endphp
                                                                    @if(is_array($imgs) && count($imgs) > 0)
                                                                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.25rem;">
                                                                            @foreach($imgs as $img)
                                                                                <img src="{{ $img }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; box-shadow: var(--nm-flat-sm);">
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <span style="color: var(--text-secondary); font-style: italic;">Tidak ada gambar</span>
                                                                    @endif
                                                                @else
                                                                    {{ $val->value ?? '-' }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @if($sub->notes)
                                                    <div style="border-top: 1.5px solid rgba(255,255,255,0.4); padding-top: 1rem; margin-top: 1rem;">
                                                        <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 800;">Catatan / Feedback Mentor</span>
                                                        <p style="font-size: 0.8rem; font-weight: 600; color: var(--text-secondary); margin-top: 0.15rem;">{{ $sub->notes }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @empty
                                            <div style="text-align: center; color: var(--text-secondary); padding: 2rem; font-style: italic; font-weight: 700; box-shadow: var(--nm-inset-sm); border-radius: 12px;">Belum mengajukan karya target di konteks ini.</div>
                                        @endforelse
                                    </div>

                                    <!-- Form dynamic submission creation -->
                                    <div class="dashboard-panel" style="padding: 1.5rem;">
                                        <h3 class="panel-title" id="form-title"><i class="fa-solid fa-plus"></i> Input Karya Baru</h3>
                                        <form id="submission-form" method="POST" action="{{ route('santri.proyek.submission.store', $activeContext->id) }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
                                            @csrf
                                            <input type="hidden" name="_method" id="form-method" value="POST">

                                            @foreach($activeContext->fields as $f)
                                                <div class="input-group">
                                                    <label>{{ $f->label }}</label>
                                                    <div class="input-wrapper">
                                                        @if($f->type === 'multiple_images')
                                                            <input type="file" name="field_{{ $f->id }}[]" multiple accept="image/*" id="input_field_{{ $f->id }}">
                                                            <div style="font-size: 0.7rem; color: var(--text-secondary); padding: 0.25rem 0.5rem; font-weight: 700;"><i class="fa-solid fa-circle-info"></i> Anda dapat memilih beberapa file gambar sekaligus.</div>
                                                        @else
                                                            <input type="text" name="field_{{ $f->id }}" id="input_field_{{ $f->id }}" placeholder="{{ $f->placeholder }}" required>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div>
                                                <button type="submit" class="btn-submit" id="submit-btn" style="width: 100%; justify-content: center;">
                                                    <i class="fa-solid fa-plus"></i> Ajukan Karya
                                                </button>
                                                <button type="button" class="btn-submit" id="cancel-btn" style="width: 100%; justify-content: center; margin-top: 0.5rem; display: none; background: transparent; box-shadow: var(--nm-flat-sm); color: var(--text-secondary);" onclick="resetForm()">
                                                    Batal Edit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        </main>
    </div>

    <script>
        // Dynamic submission edit
        function editSubmission(id, values) {
            document.getElementById('form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Karya';
            const form = document.getElementById('submission-form');
            form.action = `/santri/proyek/submissions/${id}`;
            document.getElementById('form-method').value = 'PUT';

            values.forEach(v => {
                const el = document.getElementById(`input_field_${v.career_target_field_id}`);
                if (el && el.type !== 'file') {
                    el.value = v.value || '';
                }
            });

            document.getElementById('submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
            document.getElementById('cancel-btn').style.display = 'block';
        }

        function resetForm() {
            document.getElementById('form-title').innerHTML = '<i class="fa-solid fa-plus"></i> Input Karya Baru';
            const form = document.getElementById('submission-form');
            form.action = "{{ isset($activeContext) ? route('santri.proyek.submission.store', $activeContext->id) : '#' }}";
            document.getElementById('form-method').value = 'POST';
            form.reset();
            document.getElementById('cancel-btn').style.display = 'none';
            document.getElementById('submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Ajukan Karya';
        }

        // Dynamic income edit
        function editIncome(id, amount, source, date, notes) {
            document.getElementById('income-form-title').innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Laporan';
            const form = document.getElementById('income-form');
            form.action = `/santri/proyek/income/${id}`;
            document.getElementById('income-form-method').value = 'PUT';

            document.getElementById('income_source').value = source;
            document.getElementById('income_amount').value = formatRupiah(amount);
            document.getElementById('income_date').value = date;
            document.getElementById('income_notes').value = notes === 'null' ? '' : notes;

            document.getElementById('income-submit-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';
            document.getElementById('income-cancel-btn').style.display = 'block';
        }

        function resetIncomeForm() {
            document.getElementById('income-form-title').innerHTML = '<i class="fa-solid fa-plus"></i> Lapor Penghasilan';
            const form = document.getElementById('income-form');
            form.action = "{{ route('santri.proyek.income.store') }}";
            document.getElementById('income-form-method').value = 'POST';
            form.reset();
            document.getElementById('income-cancel-btn').style.display = 'none';
            document.getElementById('income-submit-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Kirim Laporan';
        }

        // Currency formatters
        function formatCurrencyInput(input) {
            input.value = formatRupiah(input.value);
        }

        function formatRupiah(number) {
            let number_string = number.toString().replace(/[^0-9]/g, '');
            let split = number_string.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah ? 'Rp ' + rupiah : '';
        }
    </script>
</body>
</html>
