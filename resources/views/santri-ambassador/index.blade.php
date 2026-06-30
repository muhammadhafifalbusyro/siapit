<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santri Ambassador — Pondok IT Yogyakarta</title>
    <meta name="description" content="Showcase profil santri-santri terbaik Pondok IT Yogyakarta yang sedang masa berkarya. Lihat portofolio, karya, dan pencapaian mereka.">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ========================================
           LIGHT GLASS & TECH CARD SYSTEM
        ======================================== */
        :root {
            --bg-gradient: linear-gradient(135deg, #f0f4fa 0%, #e2ebf7 50%, #d4e2f4 100%);
            --text-dark: #1e293b;
            --text-muted: #64748b;
            
            /* SIAPIT Colors: Blue (#3b82f6) and Purple (#8b5cf6) */
            --accent-blue: #3b82f6;
            --accent-blue-glow: rgba(59, 130, 246, 0.15);
            --accent-purple: #8b5cf6;
            --accent-purple-glow: rgba(139, 92, 246, 0.15);
            
            --accent-orange: #f97316;
            --accent-green: #10b981;
            
            --font: 'Outfit', sans-serif;
            --transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font);
            background: var(--bg-gradient);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Tech Wave Background & Grid Patterns */
        .bg-pattern {
            position: absolute;
            inset: 0;
            z-index: -2;
            pointer-events: none;
            opacity: 0.4;
            background-image: 
                radial-gradient(rgba(59, 130, 246, 0.08) 1.5px, transparent 1.5px), 
                radial-gradient(rgba(139, 92, 246, 0.08) 1.5px, transparent 1.5px);
            background-size: 24px 24px;
            background-position: 0 0, 12px 12px;
        }

        .bg-gradient-shapes {
            position: absolute;
            inset: 0;
            z-index: -3;
            pointer-events: none;
            overflow: hidden;
        }

        /* Abstract glowing floating shapes for a modern tech vibe */
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.6;
        }
        .shape-1 {
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(139, 92, 246, 0.05) 100%);
        }
        .shape-2 {
            bottom: -20%;
            right: -10%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, rgba(59, 130, 246, 0.05) 100%);
        }
        .shape-3 {
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, rgba(59, 130, 246, 0.02) 100%);
        }

        /* Diagonal lines overlay to make it look active */
        .tech-lines {
            position: absolute;
            inset: 0;
            z-index: -1;
            opacity: 0.08;
            pointer-events: none;
            background: 
                linear-gradient(217deg, rgba(255,255,255,0), rgba(255,255,255,0) 70%, rgba(59, 130, 246, 0.1) 70%, rgba(59, 130, 246, 0.1) 100%),
                linear-gradient(127deg, rgba(255,255,255,0), rgba(255,255,255,0) 60%, rgba(139, 92, 246, 0.1) 60%, rgba(139, 92, 246, 0.1) 100%);
        }

        /* Header */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 4rem;
            position: relative;
            z-index: 10;
            max-width: 1200px;
            margin: 0 auto;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 0 0 24px 24px;
            box-shadow: 0 10px 30px rgba(31, 38, 135, 0.02);
            margin-bottom: 3rem;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        header .logo-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.78rem;
            color: var(--accent-blue);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        header h1 {
            font-size: 1.8rem;
            font-weight: 900;
            letter-spacing: -0.5px;
        }

        header h1 span {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        header p {
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 520px;
            margin: 0 auto;
            font-weight: 500;
        }

        /* Grid */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem 4rem;
            position: relative;
            z-index: 10;
        }

        .ambassador-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 2rem;
            justify-content: center;
        }

        /* ========================================
           STUDENT ID-CARD (REFERENCE INSPIRED)
        ======================================== */
        .id-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(31, 38, 135, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.7);
            aspect-ratio: 1 / 1.6;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: var(--transition);
            padding: 2.25rem 1.25rem 0;
        }

        .id-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.3);
            background: rgba(255, 255, 255, 0.95);
        }

        /* Top Corner Decorative Arc (Blue color) */
        .id-card-arc {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 15px solid var(--accent-blue);
            opacity: 0.85;
            pointer-events: none;
            z-index: 1;
        }

        /* Brand Header */
        .card-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.35rem;
            margin-bottom: 1.5rem;
            z-index: 2;
        }

        .card-brand img {
            height: 24px;
            object-fit: contain;
        }

        .card-brand span {
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 2px;
            color: var(--text-dark);
            text-transform: uppercase;
        }

        /* Circular Portrait Ring (SIAPIT Blue-Purple Gradient) */
        .portrait-ring {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 3.5px solid var(--accent-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f8fafc;
            position: relative;
            z-index: 2;
            box-shadow: 0 6px 18px rgba(0,0,0,0.04);
            margin-bottom: 1.75rem;
            transition: var(--transition);
        }

        .portrait-ring img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .portrait-placeholder {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--accent-blue);
        }

        .id-card:hover .portrait-ring {
            transform: scale(1.05);
            border-color: var(--accent-purple);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.2);
        }

        /* Student Identity Info */
        .identity-info {
            text-align: center;
            flex-grow: 1;
            z-index: 2;
            width: 100%;
        }

        .identity-info h3 {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--accent-blue);
            margin-bottom: 0.35rem;
            line-height: 1.2;
            padding: 0 0.5rem;
        }

        .identity-info p {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        /* Bottom Stripe Barcode block */
        .stripe-block {
            width: 100%;
            margin-top: auto;
            position: relative;
            z-index: 2;
        }

        /* Black Stripe with Student ID Text */
        .stripe-black {
            background: #1e293b;
            color: #ffffff;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-align: center;
            padding: 0.65rem 0.5rem;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 15% 100%);
            margin-left: 20px;
        }

        /* Blue/Purple Gradient Barcode Box */
        .barcode-box {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            padding: 0.85rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        /* Barcode Line Generator */
        .barcode-graphic {
            width: 100%;
            height: 24px;
            background: repeating-linear-gradient(
                90deg,
                #1e293b,
                #1e293b 2px,
                transparent 2px,
                transparent 5px,
                #1e293b 5px,
                #1e293b 8px,
                transparent 8px,
                transparent 10px
            );
            margin-bottom: 0.35rem;
            opacity: 0.9;
        }

        /* Danger/Warning Stripes at very bottom */
        .warning-stripes {
            width: 100%;
            height: 8px;
            background: repeating-linear-gradient(
                -45deg,
                #1e293b,
                #1e293b 6px,
                #ffffff 6px,
                #ffffff 12px
            );
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            margin-top: -4px;
        }

        /* ========================================
           FULL SCREEN EXPANSION (ZOOM VIEW)
        ======================================== */
        .zoom-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .zoom-overlay.active {
            display: flex;
            opacity: 1;
        }

        /* Expanded Panel styled EXACTLY like the ID Card but wider (Refraction glass) */
        .expanded-panel {
            width: 100vw;
            height: 100vh;
            max-width: 100%;
            max-height: 100vh;
            background: #ffffff; /* White background like ID card */
            border: none;
            box-shadow: none;
            border-radius: 0px;
            padding: 1.5rem 4rem 0;
            position: relative;
            animation: panelScaleUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden; /* Prevent modal itself from scrolling, only the column details scroll */
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        @keyframes panelScaleUp {
            from { transform: scale(0.92); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* Close Button */
        .close-btn {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--text-dark);
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 1100;
        }

        .close-btn:hover {
            background: rgba(0, 0, 0, 0.1);
            color: #ef4444;
            transform: rotate(90deg);
        }

        /* Flex Layout Inside Expansion */
        .expansion-layout {
            display: grid;
            grid-template-columns: 360px 1fr 340px;
            gap: 2rem;
            align-items: start;
        }

        /* Left Column: Stats & Performance with 2 columns Grid */
        .left-col {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.85rem;
            max-height: calc(100vh - 180px);
            overflow-y: auto;
            padding-right: 0.25rem;
        }

        .left-col::-webkit-scrollbar {
            width: 4px;
        }

        .left-col::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 2px;
        }

        .stat-card-small {
            background: rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            padding: 1.2rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            cursor: pointer;
            transition: var(--transition);
        }

        .stat-card-small:hover {
            border-color: var(--accent-blue);
            background: rgba(59, 130, 246, 0.04);
            transform: translateY(-2px);
        }

        .stat-card-small.active {
            border-color: var(--accent-blue);
            background: rgba(59, 130, 246, 0.08);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.1);
        }

        .panel-heading-title {
            grid-column: span 2;
            font-size: 1.4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.25rem;
            color: var(--accent-blue);
        }

        .stat-card-small {
            background: rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            padding: 1.2rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .stat-card-small .sc-val {
            font-size: 1.8rem;
            font-weight: 900;
            margin-bottom: 0.2rem;
        }

        .stat-card-small .sc-lbl {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Center Column: Profile Image & Identity */
        .center-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Big photo frame: A circular ring growing into a vertical rectangle with rounded corners */
        .large-photo-frame {
            width: 250px;
            height: 310px;
            border-radius: 24px;
            border: 4px solid var(--accent-blue);
            background: #f8fafc;
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.15);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--accent-blue);
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .large-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .expanded-name {
            font-size: 1.8rem;
            font-weight: 900;
            margin-bottom: 0.35rem;
            color: var(--accent-blue);
        }

        .expanded-title-sub {
            color: var(--text-dark);
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .expanded-desc {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Right Column: Details & Items Lists */
        .right-col {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .list-section-box {
            background: rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            padding: 1.25rem;
        }

        .list-section-header {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--accent-blue);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.75rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding-bottom: 0.4rem;
        }

        .list-section-header.blue { color: var(--accent-blue); }
        .list-section-header.green { color: var(--accent-green); }
        .list-section-header.purple { color: var(--accent-purple); }

        .items-vertical-list {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            max-height: 180px;
            overflow-y: auto;
            padding-right: 0.25rem;
        }

        .items-vertical-list::-webkit-scrollbar {
            width: 4px;
        }

        .items-vertical-list::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 2px;
        }

        .list-item-entry {
            font-size: 0.8rem;
            line-height: 1.4;
            color: var(--text-dark);
            display: flex;
            gap: 0.5rem;
            font-weight: 600;
        }

        .list-item-entry span {
            color: var(--accent-blue);
            font-weight: 800;
        }

        .list-item-entry a {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .expansion-layout {
                grid-template-columns: 1fr;
            }
            .left-col, .right-col {
                width: 100%;
            }
            .center-col {
                order: -1;
                margin-bottom: 1rem;
            }
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body>

    <!-- Background Elements (Dot Pattern, Lines, & Abstract Orbs) -->
    <div class="bg-pattern"></div>
    <div class="bg-gradient-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    <div class="tech-lines"></div>

    <header>
        <div class="header-left">
            <div class="logo-badge" style="background: transparent; border: none; box-shadow: none; padding: 0;">
                <img src="/Logo-Pondok-it.png" alt="Logo" style="height: 38px; object-fit: contain;">
            </div>
            <h1>Santri <span>Ambassador</span></h1>
        </div>
    </header>

    <!-- Filter Form (Moved Below Header) -->
    <div style="max-width: 1200px; margin: 0 auto 3rem; padding: 0 4rem; display: flex; justify-content: center;">
        <form action="" method="GET" id="filterForm" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; background: rgba(255, 255, 255, 0.45); border: 1px solid rgba(255, 255, 255, 0.6); padding: 1rem 1.75rem; border-radius: 24px; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); box-shadow: 0 10px 35px rgba(31, 38, 135, 0.04);">
            <!-- Cari Nama -->
            <div style="background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 14px; display: inline-flex; align-items: center; padding: 0.5rem 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                <i class="fa-solid fa-magnifying-glass" style="color: var(--text-muted); font-size: 0.9rem; margin-right: 0.5rem;"></i>
                <input type="text" name="search" id="searchInput" value="{{ $search }}" placeholder="Cari nama santri..." oninput="debounceSearch()" style="border: none; background: transparent; outline: none; font-size: 0.9rem; font-family: var(--font); font-weight: 600; color: var(--text-dark); width: 180px;">
            </div>

            <!-- Tahun Ajaran -->
            <div style="background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 14px; padding: 0.5rem 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.02); display: inline-flex; align-items: center;">
                <select name="academic_year_id" onchange="document.getElementById('filterForm').submit()" style="border: none; background: transparent; outline: none; font-size: 0.9rem; font-family: var(--font); font-weight: 700; color: var(--text-dark); cursor: pointer; padding-right: 0.5rem;">
                    <option value="all" {{ $academicYearId == 'all' ? 'selected' : '' }}>Semua Tahun Ajaran</option>
                    @foreach($academicYears as $ay)
                        <option value="{{ $ay->id }}" {{ $academicYearId == $ay->id ? 'selected' : '' }}>Tahun Ajaran {{ $ay->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gelombang -->
            <div style="background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 14px; padding: 0.5rem 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.02); display: inline-flex; align-items: center;">
                <select name="batch_id" onchange="document.getElementById('filterForm').submit()" style="border: none; background: transparent; outline: none; font-size: 0.9rem; font-family: var(--font); font-weight: 700; color: var(--text-dark); cursor: pointer; padding-right: 0.5rem;">
                    <option value="all" {{ $batchId == 'all' ? 'selected' : '' }}>Semua Gelombang</option>
                    @foreach($batches as $b)
                        <option value="{{ $b->id }}" {{ $batchId == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jenis Kelamin (Default: Laki-laki / Ikhwan) -->
            <div style="background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 14px; padding: 0.5rem 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.02); display: inline-flex; align-items: center;">
                <select name="gender" onchange="document.getElementById('filterForm').submit()" style="border: none; background: transparent; outline: none; font-size: 0.9rem; font-family: var(--font); font-weight: 700; color: var(--text-dark); cursor: pointer; padding-right: 0.5rem;">
                    <option value="all" {{ $gender === 'all' ? 'selected' : '' }}>Semua Gender</option>
                    <option value="Laki-laki" {{ $gender === 'Laki-laki' ? 'selected' : '' }}>Ikhwan</option>
                    <option value="Perempuan" {{ $gender === 'Perempuan' ? 'selected' : '' }}>Akhwat</option>
                </select>
            </div>

            <!-- Submit button for text search input -->
            <button type="submit" style="display: none;"></button>
        </form>
    </div>

    <div class="container">
        @if($students->count() > 0)
            <div class="ambassador-grid">
                @foreach($students as $idx => $s)
                    <div class="id-card" onclick="zoomInCard({{ $idx }})">
                        <!-- Upper Arc Decor (Blue color) -->
                        <div class="id-card-arc"></div>

                        <!-- Brand Header -->
                        <div class="card-brand">
                            <img src="/Logo-Pondok-it.png" alt="Logo">
                            <span>Ambassador</span>
                        </div>

                        <!-- Circular Portrait Ring -->
                        <div class="portrait-ring">
                            @if($s->photo)
                                <img src="{{ asset('storage/' . $s->photo) }}" alt="{{ $s->name }}">
                            @else
                                <span class="portrait-placeholder">{{ strtoupper(substr($s->name, 0, 2)) }}</span>
                            @endif
                        </div>

                        <!-- Identity Info -->
                        <div class="identity-info">
                            <h3>{{ $s->name }}</h3>
                            <p>{{ $s->major }}</p>
                        </div>

                        <!-- Stripe Block -->
                        <div class="stripe-block">
                            <div class="stripe-black">NIS {{ $s->nis }}</div>
                            <div class="barcode-box">
                                <div class="barcode-graphic"></div>
                            </div>
                            <div class="warning-stripes"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Section (Always visible) -->
            <div style="margin-top: 3rem; display: flex; justify-content: center; align-items: center; gap: 0.5rem;">
                {{-- Previous Page Link --}}
                @if($students->onFirstPage())
                    <span style="background: rgba(255, 255, 255, 0.4); border: 1px solid rgba(255, 255, 255, 0.5); color: var(--text-muted); cursor: not-allowed; width: 42px; height: 42px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $students->previousPageUrl() }}" style="background: #ffffff; border: 1px solid rgba(0, 0, 0, 0.05); color: var(--accent-blue); width: 42px; height: 42px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem; text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: var(--transition);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                    @if($page == $students->currentPage())
                        <span style="background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple)); border: none; color: #ffffff; width: 42px; height: 42px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 700; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" style="background: #ffffff; border: 1px solid rgba(0, 0, 0, 0.05); color: var(--text-dark); width: 42px; height: 42px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 600; text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: var(--transition);" onmouseover="this.style.transform='translateY(-2px)'; this.style.color='var(--accent-blue)'" onmouseout="this.style.transform='none'; this.style.color='var(--text-dark)'">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($students->hasMorePages())
                    <a href="{{ $students->nextPageUrl() }}" style="background: #ffffff; border: 1px solid rgba(0, 0, 0, 0.05); color: var(--accent-blue); width: 42px; height: 42px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem; text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: var(--transition);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                @else
                    <span style="background: rgba(255, 255, 255, 0.4); border: 1px solid rgba(255, 255, 255, 0.5); color: var(--text-muted); cursor: not-allowed; width: 42px; height: 42px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        @else
            <div class="empty-state" style="text-align: center; padding: 4rem 2rem; color: var(--text-muted);">
                <i class="fa-solid fa-user-graduate" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <p>Belum ada data santri yang sedang berkarya.</p>
            </div>
        @endif
    </div>

    <!-- Zoom Overlay -->
    <div class="zoom-overlay" id="zoomOverlay" onclick="closeZoom(event)">
        <div class="expanded-panel" id="expandedPanel" style="padding-bottom: 0px; display: flex; flex-direction: column;">
            <!-- Upper Arc Decor (Blue color) -->
            <div class="id-card-arc" style="top: -20px; right: -20px; width: 100px; height: 100px; border-width: 18px;"></div>

            <!-- Brand Header inside expanded ID Card -->
            <div class="card-brand" style="margin-bottom: 2rem;">
                <img src="/Logo-Pondok-it.png" alt="Logo" style="height: 32px;">
                <span style="font-size: 0.75rem; letter-spacing: 3px;">Ambassador</span>
            </div>

            <button class="close-btn" onclick="closeZoom(event)"><i class="fa-solid fa-xmark"></i></button>
            
            <div class="expansion-layout" style="flex-grow: 1; margin-bottom: 1rem; overflow: hidden;">
                <!-- Left Side: Dynamic Context Work Counters (e.g. PROYEK 2) -->
                <div class="left-col" id="expKaryaSummaryList">
                    <!-- Populated dynamically via JS -->
                </div>

                <!-- Center: High-Quality Profile Frame (Grows to a BIG circular portrait ring) -->
                <div class="center-col">
                    <div class="large-photo-frame" id="expPhotoFrame" style="width: 200px; height: 200px; border-radius: 50%; border: 6px solid var(--accent-blue); box-shadow: 0 15px 35px rgba(59, 130, 246, 0.2); margin-bottom: 1rem;"></div>
                    <div class="expanded-name" id="expName" style="color: var(--accent-blue); font-weight: 800; font-size: 1.8rem; margin-top: 0.5rem;">Name</div>
                    <div class="expanded-title-sub" id="expTitleSub" style="font-weight: 700; color: var(--text-dark); font-size: 1.05rem; margin-top: 0.25rem;">Major</div>
                </div>

                <!-- Right Side: Details panel of active target context -->
                <div class="right-col" id="expDetailsContainer">
                    <!-- Populated dynamically via JS when left-side target is clicked -->
                </div>
            </div>

            <!-- Stripe Block at the very bottom of Expanded ID Card (Full Screen version) -->
            <div class="stripe-block" style="width: calc(100% + 8rem); margin-left: -4rem; margin-right: -4rem; margin-top: auto; box-sizing: border-box;">
                <div class="stripe-black" id="expNisText" style="margin-left: 50px;">NIS 20260001</div>
                <div class="barcode-box" style="box-sizing: border-box;">
                    <div class="barcode-graphic" style="height: 24px;"></div>
                </div>
                <div class="warning-stripes" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; height: 6px;"></div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Pondok IT Yogyakarta. Semua hak dilindungi.</p>
    </footer>

    <script>
        const students = @json($students->values());

        function zoomInCard(idx) {
            const s = students[idx];
            if (!s) return;

            // Fill Identity
            document.getElementById('expName').textContent = s.name;
            document.getElementById('expTitleSub').textContent = s.major;

            // Fill Photo
            const photoFrame = document.getElementById('expPhotoFrame');
            if (s.photo) {
                photoFrame.innerHTML = `<img src="/storage/${s.photo}" alt="${s.name}">`;
            } else {
                photoFrame.innerHTML = s.name.substring(0, 2).toUpperCase();
            }

            // Fill NIS
            document.getElementById('expNisText').textContent = 'NIS ' + s.nis;

            // Fill Karya Summary dynamically in Left Column (e.g. PROYEK 2)
            const summaryList = document.getElementById('expKaryaSummaryList');
            summaryList.innerHTML = '<div class="panel-heading-title">Total Pencapaian<br>Santri Pondok IT</div>';
            
            let firstActiveTarget = null;
            let totalBoxesCount = 0;

            if (s.karya_summaries && s.karya_summaries.length > 0) {
                s.karya_summaries.forEach((ks, idx) => {
                    if (ks.approved_items > 0) {
                        totalBoxesCount++;
                        if (!firstActiveTarget) {
                            firstActiveTarget = { type: 'karya', data: ks };
                        }
                        const card = document.createElement('div');
                        card.className = `stat-card-small target-card-item-${idx}`;
                        card.setAttribute('onclick', `selectLeftTab('karya', ${idx}, ${idx})`);
                        card.innerHTML = `
                            <div class="sc-val" style="color: var(--accent-blue);">${ks.approved_items}</div>
                            <div class="sc-lbl">${ks.name.toUpperCase()}</div>
                        `;
                        summaryList.appendChild(card);
                    }
                });
            }

            // Always add total income at the end of the left column (9th box)
            const incomeCard = document.createElement('div');
            incomeCard.className = 'stat-card-small target-card-income';
            incomeCard.setAttribute('onclick', `selectLeftTab('income', null, 'income')`);
            if (totalBoxesCount % 2 === 0) {
                incomeCard.style.gridColumn = 'span 2';
            }
            incomeCard.innerHTML = `
                <div class="sc-val" style="color: var(--accent-green);">Rp ${new Intl.NumberFormat('id-ID').format(s.total_income)}</div>
                <div class="sc-lbl">PENDAPATAN</div>
            `;
            summaryList.appendChild(incomeCard);

            if (!firstActiveTarget) {
                firstActiveTarget = { type: 'income', data: null };
            }

            // Build all details dynamically into the right panel at once


            // Build all details dynamically into the right panel at once
            const detailsContainer = document.getElementById('expDetailsContainer');
            detailsContainer.innerHTML = '';
            
            // Set style scrollable for detailsContainer (fit window height)
            detailsContainer.style.maxHeight = 'calc(100vh - 180px)';
            detailsContainer.style.overflowY = 'auto';
            detailsContainer.style.scrollBehavior = 'smooth';
            detailsContainer.style.paddingRight = '0.5rem';

            // 1. Render all Approved Karya contexts
            if (s.karya_summaries && s.karya_summaries.length > 0) {
                s.karya_summaries.forEach((ks, idx) => {
                    if (ks.approved_items > 0) {
                        const box = document.createElement('div');
                        box.className = 'list-section-box';
                        box.id = `detail-karya-${idx}`;
                        box.style.marginBottom = '1.5rem';
                        box.innerHTML = `<div class="list-section-header purple">${ks.name.toUpperCase()} (${ks.approved_items})</div>`;
                        
                        const list = document.createElement('div');
                        list.className = 'items-vertical-list';
                        list.style.maxHeight = 'none'; // let the main container scroll

                        if (ks.submissions && ks.submissions.length > 0) {
                            const approvedSubmissions = ks.submissions.filter(sub => sub.score == 1);
                            approvedSubmissions.forEach(sub => {
                                const entry = document.createElement('div');
                                entry.className = 'list-item-entry';
                                entry.style.flexDirection = 'column';
                                entry.style.background = 'rgba(0,0,0,0.02)';
                                entry.style.padding = '0.75rem';
                                entry.style.borderRadius = '10px';
                                entry.style.border = '1px solid rgba(0,0,0,0.04)';
                                entry.style.marginBottom = '0.5rem';

                                let innerContent = '';
                                if (sub.values && sub.values.length > 0) {
                                    sub.values.forEach(val => {
                                        if (val.value) {
                                            if (val.value.startsWith('http')) {
                                                innerContent += `<div style="margin-top:0.25rem;"><a href="${val.value}" target="_blank" style="word-break:break-all;"><i class="fa-solid fa-link"></i> ${val.field.label}</a></div>`;
                                            } else {
                                                innerContent += `<div style="margin-top:0.25rem; font-size:0.8rem; color:var(--text-dark); font-weight:700;">${val.field.label}: <span style="font-weight:600; color:var(--text-secondary);">${val.value}</span></div>`;
                                            }
                                        }
                                    });
                                }
                                entry.innerHTML = `${innerContent}`;
                                list.appendChild(entry);
                            });
                        }
                        box.appendChild(list);
                        detailsContainer.appendChild(box);
                    }
                });
            }

            // Handler function to scroll right details panel to specific item anchor smoothly
            window.selectLeftTab = function(type, contextIdx, cardId) {
                // Clear active class from all stat cards
                document.querySelectorAll('.stat-card-small').forEach(el => el.classList.remove('active'));
                
                // Add active class to clicked card
                let activeEl = null;
                let targetId = '';
                if (cardId === 'income') {
                    activeEl = document.querySelector('.target-card-income');
                    // Income detail is disabled on right panel, we can fallback or do nothing
                    return;
                } else {
                    activeEl = document.querySelector(`.target-card-item-${cardId}`);
                    targetId = `detail-karya-${contextIdx}`;
                }
                if (activeEl) activeEl.classList.add('active');

                const targetEl = document.getElementById(targetId);
                if (targetEl) {
                    detailsContainer.scrollTo({
                        top: targetEl.offsetTop - detailsContainer.offsetTop,
                        behavior: 'smooth'
                    });
                }
            };

            // Select default first tab
            if (firstActiveTarget) {
                if (firstActiveTarget.type === 'karya') {
                    const actualIdx = s.karya_summaries.indexOf(firstActiveTarget.data);
                    selectLeftTab('karya', actualIdx, actualIdx);
                }
            }

            // Show Overlay
            const overlay = document.getElementById('zoomOverlay');
            overlay.style.display = 'flex';
            setTimeout(() => {
                overlay.classList.add('active');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeZoom(e) {
            if (e && e.target && e.target !== document.getElementById('zoomOverlay') && !e.target.closest('.close-btn')) {
                return;
            }
            const overlay = document.getElementById('zoomOverlay');
            overlay.classList.remove('active');
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 500);
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeZoom();
        });

        // Debounce search function to submit form automatically after user stops typing
        let searchTimeout = null;
        function debounceSearch() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500); // Wait 500ms before submitting
        }

        // Put cursor at the end of the text input after page load
        window.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            if (searchInput && searchInput.value !== '') {
                searchInput.focus();
                // Set cursor position at the end
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }
        });
    </script>
</body>
</html>
