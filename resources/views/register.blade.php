<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Santri Baru - SIAPIT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/login.css', 'resources/js/app.js'])
    <!-- Midtrans Snap JS SDK -->
    <script 
        src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" 
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <style>
        .form-section-card {
            background: var(--bg-primary);
            box-shadow: var(--nm-flat-sm);
            border-radius: 24px;
            padding: 2.25rem;
            margin-bottom: 2rem;
            width: 100%;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.4);
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }
        .form-section-card:hover {
            box-shadow: var(--nm-flat);
        }
        .form-container-stacked {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .input-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }
        .badge-lunas {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            background: #d1fae5;
            color: #065f46;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.9rem;
            box-shadow: var(--nm-flat-sm);
            margin-bottom: 1.5rem;
        }
        @media (max-width: 600px) {
            .input-grid-2 {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .form-section-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-wrapper" style="padding: 2rem 1rem;">
        <div class="login-card wide" style="max-width: 850px;">
            <!-- Branding -->
            <div class="brand-section" style="display: flex; align-items: center; gap: 1rem; width: 100%; justify-content: flex-start; margin-bottom: 2.5rem; border-bottom: 2px solid #d1d9e6; padding-bottom: 1rem;">
                <img src="/Logo-Pondok-it.png" alt="Logo Pondok IT" style="height: 44px; width: auto; object-fit: contain;">
                <div style="text-align: left;">
                    <h1 style="font-family: var(--font-heading); font-size: 1.6rem; font-weight: 800; color: var(--accent-blue); line-height: 1.1; margin: 0;">SIAPIT Pendaftaran</h1>
                </div>
            </div>

            <!-- Stepper UI -->
            <div class="stepper-wrapper" style="{{ (isset($testingMode) && $testingMode == 1) ? 'display: none;' : 'display: flex;' }} align-items: center; justify-content: space-between; width: 100%; max-width: 500px; margin: 0 auto 3rem auto; position: relative;">
                <div class="stepper-line" style="position: absolute; top: 24px; left: 12%; right: 12%; height: 6px; background: #e2e8f0; z-index: 1; border-radius: 4px; box-shadow: var(--nm-inset-sm);">
                    <div id="stepper-progress" style="width: 0%; height: 100%; background: var(--accent-blue); transition: var(--transition); border-radius: 4px;"></div>
                </div>
                
                <!-- Step 1 -->
                <div class="step-item" id="step-1" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem; z-index: 2; width: 100px; text-align: center;">
                    <div class="step-icon" id="step-icon-1" style="width: 48px; height: 48px; border-radius: 50%; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem; color: var(--accent-blue); border: 2.5px solid var(--accent-blue); transition: var(--transition);">
                        <i id="step-icon-inner-1" class="fa-solid fa-credit-card"></i>
                    </div>
                    <span class="step-label" id="step-label-1" style="font-size: 0.85rem; font-weight: 800; color: var(--accent-blue); transition: var(--transition);">1. Pembayaran</span>
                </div>
                
                <!-- Step 2 -->
                <div class="step-item" id="step-2" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem; z-index: 2; width: 100px; text-align: center;">
                    <div class="step-icon" id="step-icon-2" style="width: 48px; height: 48px; border-radius: 50%; background: var(--bg-primary); box-shadow: var(--nm-flat-sm); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem; color: var(--text-secondary); border: 2.5px solid transparent; transition: var(--transition);">
                        <i id="step-icon-inner-2" class="fa-solid fa-file-signature"></i>
                    </div>
                    <span class="step-label" id="step-label-2" style="font-size: 0.85rem; font-weight: 800; color: var(--text-secondary); transition: var(--transition);">2. Formulir</span>
                </div>
            </div>
            
            <!-- Toast notification container -->
            <div id="toast-container" style="position: fixed; bottom: 2rem; right: 2rem; display: flex; flex-direction: column; gap: 0.75rem; z-index: 9999; pointer-events: none;"></div>

            <!-- STAGE 1: PEMBAYARAN BIAYA PENDAFTARAN -->
            <div id="payment-stage" style="width: 100%; max-width: 600px; margin: 0 auto; {{ (isset($testingMode) && $testingMode == 1) ? 'display: none;' : 'display: flex;' }} flex-direction: column; gap: 2rem;">
                
                <!-- Box A: Buat Pembayaran Baru -->
                <div class="form-section-card">
                    <h3 class="section-title" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-user-plus"></i> 1. Pendaftaran Calon Santri Baru</h3>
                    @if(isset($testingMode) && $testingMode == 1)
                        <p style="font-size: 0.85rem; color: #065f46; font-weight: 700; line-height: 1.5; background: #d1fae5; padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #a7f3d0; margin-bottom: 1rem;">
                            <i class="fa-solid fa-circle-check"></i> Mode Testing Aktif: Pembayaran administrasi pendaftaran dibypass secara otomatis. Silakan masukkan nama, email, dan WhatsApp Anda untuk langsung mengisi formulir pendaftaran.
                        </p>
                    @else
                        <p style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 600; line-height: 1.5;">
                            Untuk melanjutkan ke pengisian formulir pendaftaran calon santri baru Pondok IT, Anda diwajibkan melakukan pembayaran biaya administrasi pendaftaran sebesar <strong>Rp {{ number_format($registrationFee, 0, ',', '.') }}</strong>.
                        </p>
                    @endif
                    
                    <form id="initiate-payment-form" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="pay-name" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nama Lengkap Pendaftar</label>
                            <div class="input-wrapper">
                                <input type="text" id="pay-name" required placeholder="Contoh: Muhammad Faiz">
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="pay-email" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Email Aktif</label>
                            <div class="input-wrapper">
                                <input type="email" id="pay-email" required placeholder="faiz@example.com">
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="pay-whatsapp" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nomor WhatsApp</label>
                            <div class="input-wrapper" style="display: flex; align-items: center; gap: 0.5rem; padding-left: 1.25rem;">
                                <div style="display: flex; align-items: center; gap: 0.35rem; font-weight: 700; color: var(--text-secondary); font-size: 0.9rem; border-right: 1.5px solid #d1d9e6; padding-right: 0.75rem; height: 100%; user-select: none;">
                                    <span style="font-size: 1.1rem; line-height: 1;">🇮🇩</span>
                                    <span>+62</span>
                                </div>
                                <input type="text" id="pay-whatsapp" required placeholder="81234567890" style="box-shadow: none; background: transparent; padding-left: 0.25rem; width: 100%; border: none;">
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" style="width: 100%; margin-top: 0.5rem;">
                            <span>{{ (isset($testingMode) && $testingMode == 1) ? 'Mulai Mengisi Formulir' : 'Bayar Biaya Pendaftaran' }}</span>
                        </button>
                    </form>
                </div>

                <!-- Box B: Periksa Status Pembayaran / Cari Pembayaran -->
                <div class="form-section-card">
                    <h3 class="section-title" style="margin-bottom: 0.5rem; color: var(--text-primary);"><i class="fa-solid fa-magnifying-glass"></i> Periksa Status Pembayaran</h3>
                    <p style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 600; line-height: 1.5;">
                        Sudah melakukan pembayaran pendaftaran sebelumnya? Atau ingin melanjutkan pengisian formulir? Silakan masukkan Order ID transaksi (contoh: <code>APT-XXX-XXXX</code>) atau nomor WhatsApp pendaftaran Anda di bawah ini:
                    </p>

                    <form id="check-payment-form" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="check-query" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Order ID / WhatsApp / Email</label>
                            <div class="input-wrapper">
                                <input type="text" id="check-query" required placeholder="Contoh: APT-2-9021 atau 08123456789">
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" style="width: 100%; background: linear-gradient(145deg, #64748b, #475569); box-shadow: var(--nm-flat-sm); margin-top: 0.5rem;">
                            <span style="color: white;"><i class="fa-solid fa-magnifying-glass"></i> Periksa Status Pembayaran</span>
                        </button>
                    </form>
                </div>

            </div>

            <!-- STAGE 2: FORMULIR PENDAFTARAN LENGKAP -->
            <div id="form-stage" style="{{ (isset($testingMode) && $testingMode == 1) ? 'display: block;' : 'display: none;' }} width: 100%;">
                
                <!-- Lock Notification Header -->
                <div style="text-align: left; margin-bottom: 1.5rem;">
                    @if(isset($testingMode) && $testingMode == 1)
                        <div class="badge-lunas" style="background: #d1fae5; color: #065f46; border: 1.5px solid #a7f3d0; box-shadow: var(--nm-flat-sm);">
                            <i class="fa-solid fa-circle-check"></i> MODE TESTING AKTIF
                        </div>
                    @else
                        <div class="badge-lunas">
                            <i class="fa-solid fa-circle-check"></i> PEMBAYARAN LUNAS
                        </div>
                    @endif
                    <h1 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.25rem;">Formulir Pendaftaran Calon Santri</h1>
                </div>

                <form id="register-form" class="form-container-stacked">
                    <!-- Hidden field to hold registration database ID -->
                    <input type="hidden" id="reg-id">

                    <!-- SECTION 1: Data Diri Pelengkap -->
                    <div class="form-section-card">
                        <h3 class="section-title" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-id-card"></i> 1. Identitas Diri Pelengkap</h3>
                        
                        <!-- 4x6 Photo Upload Box -->
                        <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 1rem; width: 100%;">
                            <div id="photo-preview-container" class="card-nm" style="width: 120px; height: 180px; border-radius: 16px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; overflow: hidden; position: relative; transition: var(--transition); border: 2px dashed #cbd5e1; box-shadow: var(--nm-inset-sm); background: var(--bg-primary);">
                                <div id="placeholder-content" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem; color: var(--text-secondary); text-align: center; padding: 0.5rem;">
                                    <i class="fa-solid fa-camera" style="font-size: 1.8rem; color: var(--accent-blue);"></i>
                                    <span style="font-size: 0.75rem; font-weight: 700;">Foto Formal 4x6</span>
                                </div>
                                <img id="photo-preview" src="" alt="Preview Foto" style="width: 100%; height: 100%; object-fit: cover; display: none; position: absolute; top: 0; left: 0;">
                            </div>
                            <input type="file" id="reg-photo" required accept="image/*" style="display: none;">
                            <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 700; margin-top: 0.5rem;">Klik bingkai untuk memilih foto (Maks. 2MB)</span>
                        </div>

                        <!-- Locked Name, Email, and WA inputs -->
                        @if(isset($testingMode) && $testingMode == 1)
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left; margin-bottom: 0.5rem;">
                                <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nama Lengkap</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-name" required placeholder="Contoh: Muhammad Faiz">
                                </div>
                            </div>

                            <div class="input-grid-2" style="margin-bottom: 0.5rem;">
                                <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Alamat Email</label>
                                    <div class="input-wrapper">
                                        <input type="email" id="reg-email" required placeholder="faiz@example.com">
                                    </div>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nomor WhatsApp</label>
                                    <div class="input-wrapper" style="display: flex; align-items: center; gap: 0.5rem; padding-left: 1.25rem;">
                                        <div style="display: flex; align-items: center; gap: 0.35rem; font-weight: 700; color: var(--text-secondary); font-size: 0.9rem; border-right: 1.5px solid #d1d9e6; padding-right: 0.75rem; height: 100%; user-select: none;">
                                            <span style="font-size: 1.1rem; line-height: 1;">🇮🇩</span>
                                            <span>+62</span>
                                        </div>
                                        <input type="text" id="reg-whatsapp" required placeholder="81234567890" style="box-shadow: none; background: transparent; padding-left: 0.25rem; width: 100%; border: none;">
                                    </div>
                                </div>
                            </div>
                        @else
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left; margin-bottom: 0.5rem;">
                                <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nama Lengkap (Terverifikasi)</label>
                                <div class="input-wrapper" style="box-shadow: var(--nm-inset-sm); background: #e2e8f0; cursor: not-allowed; opacity: 0.85;">
                                    <input type="text" id="reg-name-display" disabled style="cursor: not-allowed; font-weight: 700; color: var(--text-primary);">
                                </div>
                            </div>

                            <div class="input-grid-2" style="margin-bottom: 0.5rem;">
                                <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Alamat Email</label>
                                    <div class="input-wrapper" style="box-shadow: var(--nm-inset-sm); background: #e2e8f0; cursor: not-allowed; opacity: 0.85;">
                                        <input type="email" id="reg-email-display" disabled style="cursor: not-allowed; font-weight: 700; color: var(--text-primary);">
                                    </div>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                    <label style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nomor WhatsApp</label>
                                    <div class="input-wrapper" style="box-shadow: var(--nm-inset-sm); background: #e2e8f0; cursor: not-allowed; opacity: 0.85;">
                                        <input type="text" id="reg-whatsapp-display" disabled style="cursor: not-allowed; font-weight: 700; color: var(--text-primary);">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-birthplace" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Tempat Lahir</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-birthplace" required placeholder="Yogyakarta">
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-birthdate" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Tanggal Lahir</label>
                                <div class="input-wrapper">
                                    <input type="date" id="reg-birthdate" required style="padding: 0.8rem 1.25rem;">
                                </div>
                            </div>
                        </div>

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-gender" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Jenis Kelamin</label>
                                <div class="input-wrapper">
                                    <select id="reg-gender" required>
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="Laki-laki">Laki-laki (Ikhwan)</option>
                                        <option value="Perempuan">Perempuan (Akhwat)</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-age" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Usia (Tahun)</label>
                                <div class="input-wrapper">
                                    <input type="number" id="reg-age" required min="5" max="60" placeholder="17">
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left; position: relative;">
                            <label for="reg-region-search" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Daerah Asal</label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-region-search" required autocomplete="off" placeholder="Ketik untuk mencari daerah...">
                                <input type="hidden" id="reg-region">
                            </div>
                            <div id="region-dropdown" class="card-nm" style="position: absolute; top: 100%; left: 0; width: 100%; max-height: 200px; overflow-y: auto; z-index: 10; display: none; margin-top: 0.25rem; padding: 0.5rem; background: var(--bg-primary); box-shadow: var(--nm-flat); border-radius: 12px; border: none;"></div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-address" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Alamat Lengkap</label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-address" required placeholder="Contoh: Jl. Kaliurang Km 10, Sleman">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: Sosial & Minat -->
                    <div class="form-section-card">
                        <h3 class="section-title" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-hashtag"></i> 2. Sosial & Minat</h3>

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-goals" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Cita-cita</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-goals" required placeholder="Contoh: Software Engineer">
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-hobbies" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Hobi</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-hobbies" required placeholder="Contoh: Membaca, Koding">
                                </div>
                            </div>
                        </div>

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-instagram" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Username Instagram</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-instagram" placeholder="Contoh: @username (opsional)">
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-facebook" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Username/Link Facebook</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-facebook" placeholder="Contoh: facebook.com/username (opsional)">
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-idol" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Tokoh Idola</label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-idol" required placeholder="Contoh: Rasulullah SAW, BJ Habibie">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: Riwayat Pendidikan -->
                    <div class="form-section-card">
                        <h3 class="section-title" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-graduation-cap"></i> 3. Riwayat Pendidikan</h3>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-education" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Pendidikan Terakhir</label>
                            <div class="input-wrapper">
                                <select id="reg-education" required>
                                    <option value="" disabled selected>Pilih Pendidikan...</option>
                                    <option value="SD">SD / Sederajat</option>
                                    <option value="SMP">SMP / Sederajat</option>
                                    <option value="SMA/SMK/MA">SMA / SMK / MA</option>
                                    <option value="Diploma">Diploma (D1/D2/D3/D4)</option>
                                    <option value="Sarjana">Sarjana (S1)</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-school-name" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nama Sekolah Asal</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-school-name" required placeholder="Contoh: SMAN 1 Yogyakarta">
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-school-major" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Jurusan Sekolah</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-school-major" required placeholder="Contoh: IPA / IPS / TKJ">
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-favorite-subjects" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Pelajaran yang Disukai</label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-favorite-subjects" required placeholder="Contoh: Matematika, Fisika, Agama">
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-achievements" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Prestasi yang Pernah Dicapai</label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-achievements" placeholder="Contoh: Juara 1 Lomba LKS Tingkat Provinsi (opsional)">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: Data Keluarga & Wali -->
                    <div class="form-section-card">
                        <h3 class="section-title" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-users"></i> 4. Orang Tua / Wali</h3>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-guardian-name" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nama Wali / Orang Tua</label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-guardian-name" required placeholder="Contoh: Heri Sulistyo">
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-guardian-rel" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Hubungan Keluarga</label>
                            <div class="input-wrapper">
                                <select id="reg-guardian-rel" required>
                                    <option value="" disabled selected>Pilih hubungan...</option>
                                    <option value="Ayah Kandung">Ayah Kandung</option>
                                    <option value="Ibu Kandung">Ibu Kandung</option>
                                    <option value="Wali / Keluarga">Wali / Keluarga</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-guardian-whatsapp" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Nomor WhatsApp Wali</label>
                            <div class="input-wrapper" style="display: flex; align-items: center; gap: 0.5rem; padding-left: 1.25rem;">
                                <div style="display: flex; align-items: center; gap: 0.35rem; font-weight: 700; color: var(--text-secondary); font-size: 0.9rem; border-right: 1.5px solid #d1d9e6; padding-right: 0.75rem; height: 100%; user-select: none;">
                                    <span style="font-size: 1.1rem; line-height: 1;">🇮🇩</span>
                                    <span>+62</span>
                                </div>
                                <input type="text" id="reg-guardian-whatsapp" required placeholder="89876543210" style="box-shadow: none; background: transparent; padding-left: 0.25rem; width: 100%; border: none;">
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-guardian-occupation" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Pekerjaan Wali</label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-guardian-occupation" required placeholder="Contoh: Wiraswasta, Guru, dll.">
                            </div>
                        </div>

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-parents-condition" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Kondisi Orang Tua</label>
                                <div class="input-wrapper">
                                    <select id="reg-parents-condition" required>
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="Lengkap">Lengkap</option>
                                        <option value="Yatim">Yatim</option>
                                        <option value="Piatu">Piatu</option>
                                        <option value="Yatim Piatu">Yatim Piatu</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-parent-income" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Gaji Orang Tua</label>
                                <div class="input-wrapper">
                                    <select id="reg-parent-income" required>
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="< Rp 1.000.000">&lt; Rp 1.000.000</option>
                                        <option value="Rp 1.000.000 - Rp 2.500.000">Rp 1.000.000 - Rp 2.500.000</option>
                                        <option value="Rp 2.500.000 - Rp 5.000.000">Rp 2.500.000 - Rp 5.000.000</option>
                                        <option value="> Rp 5.000.000">&gt; Rp 5.000.000</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-sibling-count" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Jumlah Saudara</label>
                            <div class="input-wrapper">
                                <input type="number" id="reg-sibling-count" required min="0" placeholder="Contoh: 2">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 5: Kuesioner & Kesiapan Santri -->
                    <div class="form-section-card">
                        <h3 class="section-title" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-circle-question"></i> 5. Kuesioner & Kesiapan</h3>

                        <div class="input-grid-2" style="margin-bottom: 0.5rem;">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-academic-year" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Tahun Ajaran</label>
                                <div class="input-wrapper">
                                    <select id="reg-academic-year" required>
                                        <option value="" disabled selected>Pilih Tahun Ajaran...</option>
                                        @foreach($academicYears as $year)
                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-batch" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Gelombang / Batch</label>
                                <div class="input-wrapper">
                                    <select id="reg-batch" required disabled>
                                        <option value="" disabled selected>Pilih Tahun Ajaran dahulu...</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-program" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Program Pendidikan Pilihan</label>
                            <div class="input-wrapper">
                                <select id="reg-program" required>
                                    <option value="" disabled selected>Pilih Program...</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->id }}">{{ $program->name }} ({{ $program->duration_years }} Tahun)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-major" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Jurusan Pilihan</label>
                            <div class="input-wrapper">
                                <select id="reg-major" required disabled>
                                    <option value="" disabled selected>Pilih Program dahulu...</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-has-laptop" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Apakah Memiliki Laptop?</label>
                            <div class="input-wrapper">
                                <select id="reg-has-laptop" required>
                                    <option value="" disabled selected>Pilih...</option>
                                    <option value="Punya">Punya</option>
                                    <option value="Belum">Belum</option>
                                    <option value="Sedang Saya Usahakan">Sedang Saya Usahakan</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-quran-memorization" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Hafalan Al-Qur'an (Berapa Juz?)</label>
                                <div class="input-wrapper">
                                    <input type="text" id="reg-quran-memorization" required placeholder="Contoh: 2 Juz / Juz 30">
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-has-relationship" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Memiliki Pacar?</label>
                                <div class="input-wrapper">
                                    <select id="reg-has-relationship" required>
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-favorite-ustadz" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">3 Ustadz Favorit Anda</label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-favorite-ustadz" required placeholder="Contoh: Ustadz Adi Hidayat, Abdul Somad, Hanan Attaki">
                            </div>
                        </div>

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-has-bpjs" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Punya BPJS?</label>
                                <div class="input-wrapper">
                                    <select id="reg-has-bpjs" required>
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="Punya">Punya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-is-smoking" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Apakah Masih Merokok?</label>
                                <div class="input-wrapper">
                                    <select id="reg-is-smoking" required>
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input-grid-2">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-source-info" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Mengetahui Pondok IT Dari</label>
                                <div class="input-wrapper">
                                    <select id="reg-source-info" required>
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="Orang Tua">Orang Tua</option>
                                        <option value="Guru/Ustadz">Guru/Ustadz</option>
                                        <option value="Saudara">Saudara</option>
                                        <option value="Teman">Teman</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Youtube">Youtube</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Pencarian Google">Pencarian Google</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                                <label for="reg-learned-before" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Pernah Belajar IT (Jurusan Dituju)?</label>
                                <div class="input-wrapper">
                                    <select id="reg-learned-before" required>
                                        <option value="" disabled selected>Pilih...</option>
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-organization" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Pengalaman Organisasi</label>
                            <div class="input-wrapper" style="height: auto;">
                                <textarea id="reg-organization" rows="3" placeholder="Contoh: OSIS - Ketua (2022-2023), Karang Taruna - Anggota (opsional)" style="width: 100%; border: none; background: transparent; font-family: var(--font-body); padding: 0.8rem 1.25rem; outline: none; color: var(--text-primary); font-weight: 600; resize: vertical; min-height: 80px;"></textarea>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.5rem; text-align: left;">
                            <label for="reg-it-skills" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); padding-left: 0.25rem;">Jelaskan Skill IT yang Sudah Dimiliki</label>
                            <div class="input-wrapper" style="height: auto;">
                                <textarea id="reg-it-skills" rows="3" placeholder="Contoh: Mengerti HTML dasar, CSS, dan sedikit JavaScript (opsional)" style="width: 100%; border: none; background: transparent; font-family: var(--font-body); padding: 0.8rem 1.25rem; outline: none; color: var(--text-primary); font-weight: 600; resize: vertical; min-height: 80px;"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 1.5rem; width: 100%;">
                        <button type="submit" class="btn-submit" style="max-width: 350px; width: 100%;">
                            <span>Kirim Pendaftaran Lengkap</span>
                        </button>
                    </div>

                </form>
            </div>
            
            <div style="display: flex; justify-content: center; margin-top: 2rem;">
                <a href="/"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Client-side image compression to 4x6 (300px x 450px), 75% quality
            const compressImage = (file, maxWidth, maxHeight, quality) => {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = (event) => {
                        const img = new Image();
                        img.src = event.target.result;
                        img.onload = () => {
                            const canvas = document.createElement('canvas');
                            let width = img.width;
                            let height = img.height;
                            
                            const targetRatio = 2 / 3;
                            const currentRatio = width / height;
                            
                            let sx = 0, sy = 0, sw = width, sh = height;
                            
                            if (currentRatio > targetRatio) {
                                sw = height * targetRatio;
                                sx = (width - sw) / 2;
                            } else if (currentRatio < targetRatio) {
                                sh = width / targetRatio;
                                sy = (height - sh) / 2;
                            }
                            
                            canvas.width = maxWidth;
                            canvas.height = maxHeight;
                            
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, sx, sy, sw, sh, 0, 0, maxWidth, maxHeight);
                            
                            canvas.toBlob((blob) => {
                                resolve(blob);
                            }, 'image/jpeg', quality);
                        };
                    };
                    reader.onerror = (error) => reject(error);
                });
            };

            const programSelect = document.getElementById('reg-program');
            const majorSelect = document.getElementById('reg-major');
            const academicYearSelect = document.getElementById('reg-academic-year');
            const batchSelect = document.getElementById('reg-batch');
            const initiatePaymentForm = document.getElementById('initiate-payment-form');
            const checkPaymentForm = document.getElementById('check-payment-form');
            const registerForm = document.getElementById('register-form');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const paymentStage = document.getElementById('payment-stage');
            const formStage = document.getElementById('form-stage');
            const regIdInput = document.getElementById('reg-id');

            // Regions autocomplete list
            const regions = [
                'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau', 
                'Jambi', 'Sumatera Selatan', 'Kepulauan Bangka Belitung', 'Bengkulu', 'Lampung', 
                'DKI Jakarta', 'Banten', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 
                'Jawa Timur', 'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 
                'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 
                'Kalimantan Utara', 'Sulawesi Utara', 'Gorontalo', 'Sulawesi Tengah', 
                'Sulawesi Barat', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Maluku', 
                'Maluku Utara', 'Papua Barat', 'Papua', 'Papua Tengah', 'Papua Pegunungan', 
                'Papua Selatan', 'Papua Barat Daya'
            ];

            const regionSearchInput = document.getElementById('reg-region-search');
            const regionHiddenInput = document.getElementById('reg-region');
            const regionDropdown = document.getElementById('region-dropdown');

            // Photo Upload Interaction & Live Preview
            const photoContainer = document.getElementById('photo-preview-container');
            const photoInput = document.getElementById('reg-photo');
            const photoPreview = document.getElementById('photo-preview');
            const placeholderContent = document.getElementById('placeholder-content');

            photoContainer.addEventListener('click', () => {
                photoInput.click();
            });

            photoInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        photoPreview.src = event.target.result;
                        photoPreview.style.display = 'block';
                        placeholderContent.style.display = 'none';
                        photoContainer.style.border = 'none';
                        photoContainer.style.boxShadow = 'var(--nm-flat-sm)';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Regions dropdown search
            regionSearchInput.addEventListener('input', () => {
                const query = regionSearchInput.value.toLowerCase().trim();
                regionDropdown.innerHTML = '';
                
                if (query.length === 0) {
                    regionDropdown.style.display = 'none';
                    return;
                }

                const filtered = regions.filter(r => r.toLowerCase().includes(query));
                
                if (filtered.length > 0) {
                    filtered.forEach(region => {
                        const item = document.createElement('div');
                        item.style.padding = '0.75rem 1rem';
                        item.style.cursor = 'pointer';
                        item.style.fontWeight = '600';
                        item.style.fontSize = '0.9rem';
                        item.style.borderRadius = '8px';
                        item.style.color = 'var(--text-primary)';
                        item.style.transition = 'var(--transition)';
                        item.textContent = region;
                        
                        item.addEventListener('mouseenter', () => {
                            item.style.backgroundColor = 'rgba(0, 132, 255, 0.1)';
                            item.style.color = 'var(--accent-blue)';
                        });
                        item.addEventListener('mouseleave', () => {
                            item.style.backgroundColor = 'transparent';
                            item.style.color = 'var(--text-primary)';
                        });

                        item.addEventListener('click', () => {
                            regionSearchInput.value = region;
                            regionHiddenInput.value = region;
                            regionDropdown.style.display = 'none';
                        });
                        regionDropdown.appendChild(item);
                    });
                    regionDropdown.style.display = 'block';
                } else {
                    regionDropdown.style.display = 'none';
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (e.target !== regionSearchInput && e.target !== regionDropdown) {
                    regionDropdown.style.display = 'none';
                }
            });

            // Academic Year to Batch relation load
            academicYearSelect.addEventListener('change', async () => {
                const yearId = academicYearSelect.value;
                batchSelect.disabled = true;
                batchSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';

                try {
                    const response = await fetch(`/api/academic-year/${yearId}/batches`);
                    const batches = await response.json();
                    
                    if (batches.length > 0) {
                        batchSelect.innerHTML = '<option value="" disabled selected>Pilih Gelombang...</option>';
                        batches.forEach(batch => {
                            const option = document.createElement('option');
                            option.value = batch.id;
                            option.textContent = batch.name;
                            batchSelect.appendChild(option);
                        });
                        batchSelect.disabled = false;
                    } else {
                        batchSelect.innerHTML = '<option value="" disabled selected>Tidak ada gelombang aktif.</option>';
                    }
                } catch (error) {
                    console.error('Error fetching batches:', error);
                    batchSelect.innerHTML = '<option value="" disabled selected>Gagal memuat gelombang.</option>';
                }
            });

            // Program to Major relation load
            programSelect.addEventListener('change', async () => {
                const programId = programSelect.value;
                majorSelect.disabled = true;
                majorSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';

                try {
                    const response = await fetch(`/api/program/${programId}/jurusan`);
                    const majors = await response.json();
                    
                    if (majors.length > 0) {
                        majorSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan...</option>';
                        majors.forEach(major => {
                            const option = document.createElement('option');
                            option.value = major.id;
                            option.textContent = major.name;
                            majorSelect.appendChild(option);
                        });
                        majorSelect.disabled = false;
                    } else {
                        majorSelect.innerHTML = '<option value="" disabled selected>Tidak ada jurusan tersedia.</option>';
                    }
                } catch (error) {
                    console.error('Error fetching majors:', error);
                    majorSelect.innerHTML = '<option value="" disabled selected>Gagal memuat jurusan.</option>';
                }
            });

            // Custom dynamic Toast Notification helper
            const container = document.getElementById('toast-container');
            const showToast = (message, type = 'success') => {
                const toast = document.createElement('div');
                toast.style.pointerEvents = 'auto';
                toast.style.display = 'flex';
                toast.style.alignItems = 'center';
                toast.style.gap = '0.75rem';
                toast.style.padding = '1rem 1.5rem';
                toast.style.borderRadius = '14px';
                toast.style.boxShadow = 'var(--nm-flat-sm)';
                toast.style.fontWeight = '700';
                toast.style.backgroundColor = '#ecf0f3';
                toast.style.transition = 'all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                
                let icon = 'fa-circle-check';
                let color = 'var(--accent-teal)';
                if (type === 'error') {
                    icon = 'fa-circle-exclamation';
                    color = 'var(--accent-red)';
                }
                
                toast.innerHTML = `<i class="fa-solid ${icon}" style="color: ${color}; font-size: 1.1rem;"></i> <span style="color: var(--text-primary); text-align: left;">${message}</span>`;
                
                container.appendChild(toast);
                
                setTimeout(() => {
                    toast.style.opacity = '1';
                    toast.style.transform = 'translateY(0)';
                }, 50);
                
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(-20px)';
                    setTimeout(() => toast.remove(), 300);
                }, 4000);
            };

            // Transition to registration form stage
            const openRegistrationForm = (regData) => {
                regIdInput.value = regData.id;
                
                // Populate locked fields
                document.getElementById('reg-name-display').value = regData.name;
                document.getElementById('reg-email-display').value = regData.email;
                document.getElementById('reg-whatsapp-display').value = regData.whatsapp;
                
                // Update Stepper UI Visuals to Step 2
                document.getElementById('stepper-progress').style.width = '100%';
                
                // Step 1 Success/Completed state (Green checkmark)
                const stepIcon1 = document.getElementById('step-icon-1');
                stepIcon1.style.borderColor = '#10b981';
                stepIcon1.style.color = '#10b981';
                document.getElementById('step-icon-inner-1').className = 'fa-solid fa-circle-check';
                document.getElementById('step-label-1').style.color = '#10b981';
                
                // Step 2 Active state (Blue focus)
                const stepIcon2 = document.getElementById('step-icon-2');
                stepIcon2.style.borderColor = 'var(--accent-blue)';
                stepIcon2.style.color = 'var(--accent-blue)';
                document.getElementById('step-label-2').style.color = 'var(--accent-blue)';

                // Show Form, Hide Payment Panel
                paymentStage.style.display = 'none';
                formStage.style.display = 'block';
                
                // Scroll to top smoothly
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                showToast("Silakan lengkapi formulir pendaftaran Anda.", "success");
            };

            // Stage 1: Initiate Payment Form Submit
            initiatePaymentForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = {
                    name: document.getElementById('pay-name').value,
                    email: document.getElementById('pay-email').value,
                    whatsapp: document.getElementById('pay-whatsapp').value,
                };

                try {
                    const response = await fetch('/register/initiate-payment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal memulai proses pembayaran.');
                    }

                    if (data.payment_status === 'paid') {
                        showToast("Mode Testing Aktif: Pembayaran sukses dibypass!", "success");
                        openRegistrationForm(data.registration);
                    } else if (data.snap_token) {
                        // Open Midtrans Snap Checkout
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                showToast("Pembayaran sukses! Memverifikasi status...", "success");
                                document.getElementById('check-query').value = data.order_id;
                                checkPaymentForm.dispatchEvent(new Event('submit'));
                            },
                            onPending: function(result) {
                                showToast("Silakan selesaikan pembayaran tagihan Anda.", "success");
                                // Fill manual query check with Order ID automatically for easy checking
                                document.getElementById('check-query').value = data.order_id;
                            },
                            onError: function(result) {
                                showToast("Terjadi kesalahan pada pembayaran.", "error");
                            }
                        });
                    }
                } catch (error) {
                    showToast(error.message, 'error');
                }
            });

            // Stage 1: Check Payment Status Form Submit
            checkPaymentForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const queryVal = document.getElementById('check-query').value;

                try {
                    const response = await fetch('/register/check-payment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ query: queryVal })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal mengecek status pembayaran.');
                    }

                    if (data.payment_status === 'paid') {
                        if (data.is_completed) {
                            showToast(data.message, 'success');
                            const searchCard = document.getElementById('payment-stage');
                            if (searchCard) {
                                searchCard.innerHTML = `
                                    <div class="form-section-card" style="text-align: center; padding: 3rem 2rem;">
                                        <div style="font-size: 3.5rem; color: #10b981; margin-bottom: 1.5rem;">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </div>
                                        <h3 class="section-title" style="margin-bottom: 1rem; color: var(--text-primary);">Pendaftaran Lengkap!</h3>
                                        <p style="font-size: 0.9rem; color: var(--text-secondary); font-weight: 600; line-height: 1.6; margin-bottom: 1.5rem;">
                                            Halo <strong>${data.name || ''}</strong>, formulir pendaftaran Anda sudah lengkap dan dikirimkan. Berkas Anda sedang dalam proses verifikasi administrasi oleh tim Pondok IT.
                                        </p>
                                        <button onclick="window.location.reload()" class="btn-submit" style="width: auto; padding: 0.75rem 2rem; margin: 0 auto;">
                                            Kembali ke Beranda
                                        </button>
                                    </div>
                                `;
                            }
                        } else {
                            showToast(data.message, 'success');
                            openRegistrationForm(data.registration);
                        }
                    } else {
                        // It is pending, reopen Snap popup if token is available
                        showToast("Transaksi Anda belum lunas (Pending). Membuka invoice...", "error");
                        if (data.snap_token) {
                            window.snap.pay(data.snap_token, {
                                onSuccess: function(result) {
                                    showToast("Pembayaran berhasil!", "success");
                                    // Re-check
                                    checkPaymentForm.dispatchEvent(new Event('submit'));
                                },
                                onPending: function(result) {
                                    showToast("Silakan selesaikan pembayaran tagihan Anda.", "success");
                                }
                            });
                        }
                    }
                } catch (error) {
                    showToast(error.message, 'error');
                }
            });

            // Stage 2: Submit Registration Form (Multipart for photo upload)
            registerForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const cleanPhone = (val) => {
                    let cleaned = val.replace(/\D/g, ''); 
                    if (cleaned.startsWith('0')) {
                        cleaned = cleaned.substring(1);
                    } else if (cleaned.startsWith('62')) {
                        cleaned = cleaned.substring(2);
                    }
                    return '+62' + cleaned;
                };

                const formData = new FormData();
                formData.append('registration_id', regIdInput.value);
                if (!regIdInput.value) {
                    formData.append('name', document.getElementById('reg-name').value);
                    formData.append('email', document.getElementById('reg-email').value);
                    formData.append('whatsapp', cleanPhone(document.getElementById('reg-whatsapp').value));
                }
                formData.append('birthplace', document.getElementById('reg-birthplace').value);
                formData.append('birthdate', document.getElementById('reg-birthdate').value);
                formData.append('gender', document.getElementById('reg-gender').value);
                formData.append('age', document.getElementById('reg-age').value);
                formData.append('region', document.getElementById('reg-region').value);
                formData.append('address', document.getElementById('reg-address').value);
                formData.append('last_education', document.getElementById('reg-education').value);
                
                // New Fields
                formData.append('goals', document.getElementById('reg-goals').value);
                formData.append('hobbies', document.getElementById('reg-hobbies').value);
                formData.append('instagram', document.getElementById('reg-instagram').value);
                formData.append('facebook', document.getElementById('reg-facebook').value);
                formData.append('organization_experience', document.getElementById('reg-organization').value);
                formData.append('school_name', document.getElementById('reg-school-name').value);
                formData.append('school_major', document.getElementById('reg-school-major').value);
                formData.append('achievements', document.getElementById('reg-achievements').value);
                formData.append('parents_condition', document.getElementById('reg-parents-condition').value);
                formData.append('parent_income', document.getElementById('reg-parent-income').value);
                formData.append('sibling_count', document.getElementById('reg-sibling-count').value);
                formData.append('has_laptop', document.getElementById('reg-has-laptop').value);
                formData.append('quran_memorization', document.getElementById('reg-quran-memorization').value);
                formData.append('favorite_ustadz', document.getElementById('reg-favorite-ustadz').value);
                formData.append('has_relationship', document.getElementById('reg-has-relationship').value);
                formData.append('source_info', document.getElementById('reg-source-info').value);
                formData.append('has_bpjs', document.getElementById('reg-has-bpjs').value);
                formData.append('idol', document.getElementById('reg-idol').value);
                formData.append('is_smoking', document.getElementById('reg-is-smoking').value);
                formData.append('learned_before', document.getElementById('reg-learned-before').value);
                formData.append('it_skills', document.getElementById('reg-it-skills').value);
                formData.append('favorite_subjects', document.getElementById('reg-favorite-subjects').value);
                
                const photoInput = document.getElementById('reg-photo');
                if (photoInput.files.length > 0) {
                    const originalFile = photoInput.files[0];
                    try {
                        const compressedBlob = await compressImage(originalFile, 300, 450, 0.75);
                        formData.append('photo', compressedBlob, 'photo.jpg');
                    } catch (err) {
                        console.error("Compression failed, using original file:", err);
                        formData.append('photo', originalFile);
                    }
                }
                
                formData.append('guardian_name', document.getElementById('reg-guardian-name').value);
                formData.append('guardian_relationship', document.getElementById('reg-guardian-rel').value);
                formData.append('guardian_whatsapp', cleanPhone(document.getElementById('reg-guardian-whatsapp').value));
                formData.append('guardian_occupation', document.getElementById('reg-guardian-occupation').value);

                formData.append('education_program_id', programSelect.value);
                formData.append('major_id', majorSelect.value);
                formData.append('academic_year_id', academicYearSelect.value);
                formData.append('batch_id', batchSelect.value);

                try {
                    const response = await fetch('/register/complete', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });

                    const responseText = await response.text();
                    let data;
                    try {
                        data = JSON.parse(responseText);
                    } catch (err) {
                        console.error("Server Response was not JSON:", responseText);
                        throw new Error("Terjadi kesalahan server (Response non-JSON).");
                    }

                    if (response.ok && data.success) {
                        showToast(data.message, 'success');
                        registerForm.reset();
                        
                        // Transition back to payment stage (successful registration reset)
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 3000);
                    } else {
                        let errMsg = data.message || 'Terjadi kesalahan saat menyimpan formulir.';
                        if (data.errors) {
                            const firstErrKey = Object.keys(data.errors)[0];
                            if (firstErrKey && data.errors[firstErrKey][0]) {
                                errMsg = data.errors[firstErrKey][0];
                            }
                        }
                        throw new Error(errMsg);
                    }
                } catch (error) {
                    showToast(error.message, 'error');
                }
            });
        });
    </script>
</body>
</html>
