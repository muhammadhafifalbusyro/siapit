<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik - Pondok IT</title>
    <meta name="description" content="Portal Sistem Informasi Akademik Pondok IT - Wadah mencetak Huffazh Programmer masa depan yang beradab dan profesional.">
    @vite(['resources/css/landing.css', 'resources/js/app.js'])
</head>
<body>

    <div class="screen-container">
        <!-- Left Section -->
        <div class="left-section">
            <div class="brand">
                <img src="/Logo-Pondok-it.png" alt="Logo Pondok IT" class="brand-logo">
                <span>SIAPIT</span>
            </div>
            
            <div class="hero-content">
                <h1>Mencetak Pejuang Al Quran yang<br><span class="highlight">Amanah dan Kuat</span></h1>
                <p>
                   Sistem Informasi Akademik Pondok IT (SIAPIT) adalah sistem informasi akademik yang digunakan untuk mencetak pejuang Al Quran yang amanah dan kuat di lingkungan belajar Pondok IT.
                </p>
                
                <div class="action-buttons">
                    <a href="/register" class="btn-nm btn-primary">
                        Daftar Santri Baru
                    </a>
                    <a href="/login" class="btn-nm btn-secondary">
                        Masuk ke Portal
                    </a>
                </div>
            </div>
            
            <div class="footer-simple">
                &copy; {{ date('Y') }} Pondok IT. All rights reserved.
            </div>
        </div>
        
        <!-- Right Section / Banner -->
        <div class="right-section">
            <!-- Organic S-curve wave divider -->
            <div class="wave-divider-container">
                <svg class="wave-svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <!-- Layer 1: Left Background overlap -->
                    <path d="M 0,0 C 35,25 35,75 0,100 L 0,100 L 0,0 Z" fill="var(--bg-primary)" />
                    <!-- Layer 2: Purple Wave (Secondary) -->
                    <path d="M 0,0 C 38,25 38,75 0,100" fill="none" stroke="var(--accent-purple)" stroke-width="4" />
                    <!-- Layer 3: Blue Wave (Primary) -->
                    <path d="M 0,0 C 42,25 42,75 0,100" fill="none" stroke="var(--accent-blue)" stroke-width="6" />
                </svg>
            </div>
            
            <!-- Banner Background Image -->
            <div class="banner-image-bg" style="background-image: url('{{ asset('student_banner.png') }}');"></div>
            
            <!-- Floating graphic overlays -->
            <div class="banner-overlay-graphics">
                <div class="dots-grid dots-1"></div>
                <div class="dots-grid dots-2"></div>
                <div class="plus-icon plus-1">+</div>
                <div class="plus-icon plus-2">+</div>
                <div class="sine-wave-container">
                    <svg class="sine-wave" viewBox="0 0 100 20">
                        <path d="M 0,10 Q 12.5,0 25,10 T 50,10 T 75,10 T 100,10" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
