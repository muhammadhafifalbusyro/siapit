<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Portal - SIAPIT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/login.css', 'resources/js/app.js'])
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Brand header -->
            <div class="brand">
                <img src="/Logo-Pondok-it.png" alt="Logo Pondok IT" class="brand-logo">
                <span>SIAPIT</span>
            </div>
            
            <h2>Masuk ke Portal</h2>
            <p class="subtitle">Sistem Informasi Akademik Pondok IT</p>
            
            <div id="error-alert" class="alert-box error" style="display: none;"></div>

            <form id="login-form">
                <div class="form-group">
                    <label for="username">Nomor Induk (NIP / NIS)</label>
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" placeholder="Masukkan NIP atau NIS" required autocomplete="username">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                    </div>
                </div>

                <div class="form-footer">
                    <label class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="custom-checkbox"></span>
                        Ingat Saya
                    </label>
                </div>

                <button type="submit" class="btn-submit" id="submit-btn">
                    <span>Masuk</span>
                </button>
            </form>
            
            <div class="back-link">
                <a href="/"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('login-form');
            const errorAlert = document.getElementById('error-alert');
            const submitBtn = document.getElementById('submit-btn');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                errorAlert.style.display = 'none';
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<span>Memproses...</span>';

                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const remember = document.getElementById('remember').checked;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch('/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ username, password, remember })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        window.location.href = data.redirect;
                    } else {
                        throw new Error(data.message || 'Login gagal. Periksa kembali email dan password Anda.');
                    }
                } catch (error) {
                    errorAlert.innerText = error.message;
                    errorAlert.style.display = 'block';
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('loading');
                    submitBtn.innerHTML = '<span>Masuk</span>';
                }
            });
        });
    </script>
</body>
</html>
