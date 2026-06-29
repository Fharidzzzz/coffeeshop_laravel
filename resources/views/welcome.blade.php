<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The Monolith - Exclusive Platform</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- Kombinasi font mewah: Playfair Display (Serif) dan Inter (Sans) -->
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            :root {
                --monolith-black: #121212;
                --monolith-card: #1A1A1A;
                --monolith-border: #262626;
                --gold-premium: #D4AF37;
                --gold-dark: #AA771C;
                --text-cream: #F5F5F7;
                --text-gray: #A1A09A;
            }

            * { box-sizing: border-box; }

            body {
                margin: 0;
                font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
                background: var(--monolith-black);
                color: var(--text-cream);
                min-height: 100vh;
            }

            .display {
                font-family: 'Playfair Display', serif;
                font-weight: 700;
                letter-spacing: 0.02em;
            }

            /* ---------- Top nav ---------- */
            .nav {
                position: absolute;
                top: 0; left: 0; right: 0;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 28px 5vw;
                z-index: 10;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 10px;
                color: var(--text-cream);
                font-family: 'Playfair Display', serif;
                font-weight: 700;
                font-size: 22px;
                letter-spacing: 0.08em;
            }

            .brand span { color: var(--gold-premium); }

            .brand svg { width: 26px; height: 26px; flex-shrink: 0; color: var(--gold-premium); }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .nav-links a {
                color: var(--text-gray);
                text-decoration: none;
                font-size: 13px;
                font-weight: 500;
                padding: 10px 20px;
                border-radius: 999px;
                border: 1px solid var(--monolith-border);
                transition: all .3s ease;
                white-space: nowrap;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                display: inline-flex;
                align-items: center;
            }

            .nav-links a:hover {
                color: var(--text-cream);
                background: var(--monolith-card);
                border-color: var(--gold-premium);
            }

            .nav-links a.solid {
                background: linear-gradient(135deg, var(--gold-premium) 0%, var(--gold-dark) 100%);
                border-color: var(--gold-dark);
                color: #000000;
                font-weight: 600;
            }

            .nav-links a.solid:hover {
                background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold-premium) 100%);
                border-color: var(--gold-premium);
                box-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
            }

            /* Tombol logout dibuat senada dengan nav-links lain, bukan teks polos */
            .logout-form { margin: 0; display: inline-flex; }

            .logout-btn {
                font-family: 'Inter', sans-serif;
                color: var(--text-gray);
                text-decoration: none;
                font-size: 13px;
                font-weight: 500;
                padding: 10px 20px;
                border-radius: 999px;
                border: 1px solid var(--monolith-border);
                background: transparent;
                cursor: pointer;
                white-space: nowrap;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                transition: all .3s ease;
            }

            .logout-btn:hover {
                color: #ff6b6b;
                border-color: #ff6b6b;
                background: rgba(255, 107, 107, 0.08);
            }

            /* ---------- Hero ---------- */
            .hero {
                position: relative;
                min-height: 100vh;
                display: flex;
                align-items: center;
                overflow: hidden;
            }

            .hero-bg {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(180deg, rgba(18,18,18,0.6) 0%, rgba(18,18,18,0.85) 60%, rgba(18,18,18,0.98) 100%),
                    url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1600&q=80');
                background-size: cover;
                background-position: center;
                filter: grayscale(40%) contrast(110%);
            }

            .hero-content {
                position: relative;
                z-index: 2;
                max-width: 750px;
                padding: 0 5vw;
                color: var(--text-cream);
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-size: 11px;
                letter-spacing: 0.25em;
                text-transform: uppercase;
                color: var(--gold-premium);
                margin-bottom: 24px;
                font-weight: 600;
            }

            .eyebrow::before {
                content: '';
                width: 32px;
                height: 1px;
                background: var(--gold-premium);
            }

            h1.hero-title {
                font-size: clamp(2.8rem, 6.5vw, 4.8rem);
                line-height: 1.1;
                margin: 0 0 24px;
                color: var(--text-cream);
            }

            h1.hero-title em {
                font-style: italic;
                color: var(--gold-premium);
                font-weight: 500;
            }

            .hero-sub {
                font-size: 16px;
                line-height: 1.7;
                color: var(--text-gray);
                max-width: 540px;
                margin: 0 0 42px;
            }

            .hero-actions {
                display: flex;
                gap: 16px;
                flex-wrap: wrap;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 16px 36px;
                border-radius: 12px;
                font-size: 14px;
                font-weight: 600;
                text-decoration: none;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                transition: transform .25s ease, box-shadow .25s ease, background .25s ease, border-color .25s ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--gold-premium) 0%, var(--gold-dark) 100%);
                color: #000000;
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 30px rgba(212, 175, 55, 0.25);
            }

            .btn-ghost {
                background: transparent;
                color: var(--text-cream);
                border: 1px solid var(--monolith-border);
            }

            .btn-ghost:hover {
                border-color: var(--gold-premium);
                background: rgba(255,255,255,0.02);
                transform: translateY(-3px);
            }

            /* ---------- Steam signature element ---------- */
            .cup-mark {
                position: absolute;
                right: 8vw;
                bottom: 12vh;
                z-index: 2;
                opacity: 0.85;
            }

            @media (max-width: 760px){
                .cup-mark { display: none; }
            }

            .steam-path {
                stroke: var(--gold-premium);
                stroke-width: 1.8;
                fill: none;
                stroke-linecap: round;
                opacity: 0.6;
                transform-origin: center;
                animation: steam-rise 4s ease-in-out infinite;
            }
            .steam-path.s2 { animation-delay: .7s; opacity: 0.4; }
            .steam-path.s3 { animation-delay: 1.4s; opacity: 0.25; }

            @keyframes steam-rise {
                0%   { transform: translateY(8px) scaleY(0.85); opacity: 0; }
                25%  { opacity: 0.6; }
                70%  { opacity: 0.2; }
                100% { transform: translateY(-25px) scaleY(1.2); opacity: 0; }
            }

            @media (prefers-reduced-motion: reduce){
                .steam-path { animation: none; opacity: 0.4; }
            }

            /* ---------- Footer line ---------- */
            .hero-foot {
                position: absolute;
                bottom: 28px;
                left: 0; right: 0;
                z-index: 2;
                display: flex;
                justify-content: space-between;
                padding: 0 5vw;
                color: rgba(161, 160, 154, 0.4);
                font-size: 11px;
                letter-spacing: 0.08em;
                font-family: 'Inter', monospace;
            }

            @media (max-width: 640px){
                .nav { padding: 22px 6vw; flex-wrap: wrap; gap: 14px; }
                .nav-links { gap: 8px; flex-wrap: wrap; }
                .nav-links a, .logout-btn { padding: 9px 16px; font-size: 12px; }
                .hero-foot { display: none; }
            }
        </style>
    </head>
    <body>

        <nav class="nav">
            <div class="brand">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 9H18V14C18 17.3137 15.3137 20 12 20H10C6.68629 20 4 17.3137 4 14V9Z" stroke="currentColor" stroke-width="1.6"/>
                    <path d="M18 10H19.5C20.6046 10 21.5 10.8954 21.5 12C21.5 13.1046 20.6046 14 19.5 14H18" stroke="currentColor" stroke-width="1.6"/>
                    <path d="M8 4C8 4 7 5 8 6" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="M12 4C12 4 11 5 12 6" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
                THE <span>MONOLITH</span>
            </div>

            @if (Route::has('login'))
                <div class="nav-links">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/admin/dashboard') }}" class="solid">Dashboard</a>
                        @else
                            <a href="{{ url('/shop') }}" class="solid">Shop Catalog</a>
                        @endif

                        <form action="/logout" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ url('/register') }}" class="solid">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>

        <section class="hero">
            <div class="hero-bg"></div>

            <div class="hero-content">
                <span class="eyebrow">Curated Collection &middot; Architectural Precision</span>
                <h1 class="display hero-title">Your ritual<br>deserves a <em>monolith</em> standard.</h1>
                <p class="hero-sub">
                    Biji kopi single-origin pilihan, ekstraksi presisi tinggi, dan ruang kontemplasi yang sunyi.
                    Masuk ke katalog eksklusif kami dan nikmati simfoni rasa terbaik standar hidup Anda.
                </p>

                <div class="hero-actions">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                        @else
                            <a href="{{ url('/shop') }}" class="btn btn-primary">Browse Experience</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
                        @if (Route::has('register'))
                            <a href="{{ url('/register') }}" class="btn btn-ghost">Create Account</a>
                        @endif
                    @endauth
                </div>
            </div>

            <svg class="cup-mark" width="120" height="160" viewBox="0 0 120 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="steam-path s1" d="M48 70 C 44 60, 56 54, 52 44 C 49 37, 56 33, 54 26"/>
                <path class="steam-path s2" d="M62 70 C 58 60, 70 54, 66 44 C 63 37, 70 33, 68 26"/>
                <path class="steam-path s3" d="M76 70 C 72 60, 84 54, 80 44 C 77 37, 84 33, 82 26"/>
                <path d="M28 78H92L86 122C84.5 132 76 140 65 140H55C44 140 35.5 132 34 122L28 78Z" stroke="#D4AF37" stroke-width="2" fill="rgba(212,175,55,0.03)"/>
                <path d="M92 84H100C106 84 110 89 110 95C110 101 106 106 100 106H89" stroke="#D4AF37" stroke-width="2" fill="none"/>
                <line x1="24" y1="78" x2="96" y2="78" stroke="#D4AF37" stroke-width="2"/>
            </svg>

            <div class="hero-foot">
                <span>Platform: v{{ app()->version() }}</span>
                <span>&copy; {{ date('Y') }} THE MONOLITH. Internal Management System.</span>
            </div>
        </section>

    </body>
</html>
