<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan & Konfirmasi Pembayaran - SIAPIT</title>
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

        /* Forms styling */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group label {
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

        .input-wrapper input, .input-wrapper textarea, .input-wrapper select {
            width: 100%;
            border: none;
            background: transparent;
            outline: none;
            padding: 0.5rem;
            font-size: 0.85rem;
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
            height: 42px;
            width: 100%;
        }

        .btn-submit:hover {
            box-shadow: var(--nm-flat-hover);
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

        .badge.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--accent-orange);
        }

        .badge.approved {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-green);
        }

        .grid-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
        }

        @media (max-width: 992px) {
            .grid-layout {
                grid-template-columns: 1fr;
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
                    <h1>Tagihan & Bukti Pembayaran</h1>
                    <p>Lihat detail status tagihan bulanan SPP, uang makan, serta upload konfirmasi bukti pembayaran.</p>
                </div>
            </header>

            <div class="grid-layout">
                <!-- LEFT COLUMN: Input Payment Confirmation -->
                <div>
                    <div class="dashboard-panel">
                        <h3 class="panel-title"><i class="fa-solid fa-file-invoice-dollar" style="color: var(--accent-orange);"></i> Konfirmasi Pembayaran</h3>
                        <form action="{{ route('santri.tagihan.bayar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="registration_id" value="{{ $registration->id }}">
                            
                            <div class="form-group">
                                <label>Pilih Kategori Tagihan</label>
                                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                    <select name="billing_category_id" required style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                        @foreach($bills as $bill)
                                            <option value="{{ $bill->billingCategory->id }}">
                                                {{ $bill->billingCategory->name }} (Rp {{ number_format($bill->billingCategory->total_amount, 0, ',', '.') }})
                                            </option>
                                        @endforeach
                                        @if($bills->count() == 0)
                                            <option value="">- Tidak ada tagihan aktif -</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nominal Pembayaran</label>
                                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                    <input type="text" name="amount" placeholder="Rp 1.500.000" id="payment-amount" required style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; font-weight: 700; color: var(--text-primary); width: 100%;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Upload Foto Bukti Transfer</label>
                                <div style="background: var(--bg-primary); box-shadow: var(--nm-inset-sm); border-radius: 10px; padding: 0.15rem 0.25rem;">
                                    <input type="file" name="proof_image" accept="image/*" required style="border: none; background: transparent; outline: none; padding: 0.5rem; font-size: 0.85rem; width: 100%;">
                                </div>
                            </div>

                            <button type="submit" class="btn-submit" style="color: var(--accent-orange);">Kirim Konfirmasi Bayar</button>
                        </form>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Billing Lists and Payment History -->
                <div>
                    <!-- Active Bills -->
                    <div class="dashboard-panel">
                        <h3 class="panel-title"><i class="fa-solid fa-list" style="color: var(--accent-blue);"></i> Daftar Tagihan Wajib</h3>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nama Kategori</th>
                                        <th>Total Wajib</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bills as $bill)
                                        <tr>
                                            <td style="font-weight: 700;">{{ $bill->billingCategory->name }}</td>
                                            <td style="font-weight: 700; color: var(--accent-blue);">Rp {{ number_format($bill->billingCategory->total_amount, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center; color: var(--text-secondary); padding: 1.5rem;">Tidak ada tagihan aktif untuk Anda.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Payment History Logs -->
                    <div class="dashboard-panel">
                        <h3 class="panel-title"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pembayaran</h3>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Nominal Bayar</th>
                                        <th>Bukti / Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($payments as $pmt)
                                        <tr>
                                            <td>
                                                <strong>{{ $pmt->billingCategory->name ?? 'Tagihan' }}</strong><br>
                                                <span style="font-size: 0.75rem; color: var(--text-secondary);">{{ $pmt->created_at->translatedFormat('d M Y') }}</span>
                                            </td>
                                            <td style="color: var(--accent-green); font-weight: 700;">Rp {{ number_format($pmt->amount, 0, ',', '.') }}</td>
                                            <td>
                                                @if($pmt->proof_image)
                                                    <a href="{{ $pmt->proof_image }}" target="_blank" style="font-size: 0.75rem; display: block; color: var(--accent-blue); margin-bottom: 0.25rem;">Foto Bukti</a>
                                                @endif
                                                @if($pmt->status === 'pending')
                                                    <span class="badge pending">Menunggu Verifikasi</span>
                                                @else
                                                    <span class="badge approved">Diterima</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" style="text-align: center; color: var(--text-secondary); padding: 1.5rem;">Belum ada riwayat pembayaran terekam.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Format rupiah input
        const payAmount = document.getElementById('payment-amount');
        if(payAmount) {
            payAmount.addEventListener('keyup', function(e){
                let number_string = this.value.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa  = split[0].length % 3,
                    rupiah  = split[0].substr(0, sisa),
                    ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
                
                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                this.value = 'Rp ' + rupiah;
            });
        }
    </script>
</body>
</html>
