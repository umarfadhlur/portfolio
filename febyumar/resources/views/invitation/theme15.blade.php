<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->bride_name }} & {{ $setting->groom_name }}</title>

    {{-- AOS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        body {
            margin: 0;
            background: #7d8270;
            overflow-x: hidden;
            font-family: "Poppins", sans-serif;
        }

        .page-block img {
            width: 100%;
            height: auto;
            display: block;
        }

        .page-inner {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
        }

        /* ====================== */
        /* PRELOADER */
        /* ====================== */
        #preloader {
            position: fixed;
            inset: 0;
            background: #7d8270;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99999;
        }

        .loader {
            width: 45px;
            height: 45px;
            border: 4px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.8s infinite linear;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ====================== */
        /* POPUP COVER */
        /* ====================== */
        #popupCover {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .popup-box {
            background: #fefefe;
            width: 85%;
            max-width: 420px;
            border-radius: 16px;
            text-align: center;
            padding: 28px 20px;
        }

        .popup-btn {
            margin-top: 18px;
            background: #7d8270;
            border: none;
            color: white;
            padding: 12px 22px;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
        }

        /* ====================== */
        /* PRELOADER (dari sage-flower) */
        /* ====================== */
        .preloader-overlay {
            position: fixed;
            inset: 0;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 999999;
            transition: opacity .45s ease, visibility .45s ease;
        }

        .preloader-overlay.fade-out {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .preloader-bar {
            width: 60%;
            min-width: 200px;
            max-width: 420px;
            height: 12px;
            background: #eee;
            border-radius: 999px;
            overflow: hidden;
            margin-top: 18px;
        }

        .preloader-bar > i {
            display: block;
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #7d8270, #9a8f7e);
            transition: width .2s linear;
        }

        .preloader-percent {
            margin-top: 12px;
            color: #666;
            font-weight: 600;
        }

        @media (max-width: 520px) {
            .preloader-overlay {
                padding: 16px;
            }

            .preloader-bar {
                width: 80%;
                min-width: 160px;
            }
        }

        /* ====================== */
        /* POPUP (dari sage-flower) */
        /* ====================== */
        .popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            z-index: 99999;
            overflow: hidden;
        }

        #openingPopup {
            display: none;
        }

        .popup-box {
            background: transparent;
            width: min(92vw, 100%);
            max-width: 480px;
            border-radius: 16px;
            padding: 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            max-height: calc(100vh - 40px);
            margin: 0 auto;
        }

        .popup-img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: cover;
            vertical-align: middle;
            border-radius: 16px;
        }

        .popup-content {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 60px;
            padding: 12px 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to top, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.05) 100%);
            color: #fff;
        }

        .popup-greeting {
            font-size: 0.85rem;
            opacity: .9;
            margin: 0;
        }

        .popup-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
        }

        .popup-btn {
            background: #ffffff;
            color: #2F2E2C;
            width: calc(100% - 24px);
            max-width: 280px;
            padding: 10px 14px;
            border-radius: 999px;
            border: none;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(0,0,0,0.18);
        }

        @media (max-width: 520px) {
            .popup-box {
                max-height: calc(100vh - 40px);
                border-radius: 12px;
                width: 100%;
            }
            .popup-img { border-radius: 12px; }
            .popup-content { padding: 10px 12px; bottom: 50px; }
            .popup-name { font-size: 1.05rem; }
            .popup-btn { width: calc(100% - 20px); padding: 8px 12px; font-size: 0.9rem; }
        }

        /* ====================== */
        /* MUSIC CONTROL BUTTON */
        /* ====================== */
        #musicBtn {
            position: fixed;
            bottom: 24px;
            right: 22px;
            background: rgba(255,255,255,0.9);
            padding: 12px 14px;
            border-radius: 50%;
            box-shadow: 0 3px 10px rgba(0,0,0,.25);
            cursor: pointer;
            z-index: 8000;
            font-weight: bold;
            display: none;
        }
        /* ====================== */
        /* COUNTDOWN CARD */
        /* ====================== */
        .countdown-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            padding: 16px 20px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            min-width: 280px;
        }

        .countdown-header {
            font-size: 0.95rem;
            font-weight: 600;
            color: #333;
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .countdown-icon {
            position: absolute;
            top: 12px;
            right: 14px;
            font-size: 1.2rem;
            opacity: 0.6;
        }

        .countdown-display {
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.8rem;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }

        .digit-group {
            display: flex;
        }

        .digit {
            display: inline-block;
            min-width: 28px;
            text-align: center;
            color: #2C2C2C;
        }

        .separator {
            color: #999;
            margin: 0 4px;
        }

        .countdown-labels {
            display: flex;
            gap: 18px;
            font-size: 0.75rem;
            color: #666;
            text-transform: lowercase;
            font-weight: 500;
            width: 100%;
            justify-content: space-around;
        }

        @media (max-width: 480px) {
            .countdown-card {
                min-width: 240px;
                padding: 12px 16px;
            }

            .countdown-display {
                font-size: 1.5rem;
                gap: 4px;
            }

            .digit {
                min-width: 22px;
            }

            .countdown-labels {
                gap: 12px;
                font-size: 0.7rem;
            }
        }
    </style>
</head>

<body>
        {{-- ========================== --}}
        {{-- PRELOADER (dari sage-flower) --}}
        {{-- ========================== --}}
        <div id="preloader" class="preloader-overlay" aria-hidden="true">
            <img src="{{ asset('/images/flower/popup.webp') }}" alt=""
                style="width:140px;height:auto;opacity:.98;filter:grayscale(.05);">
            <div class="preloader-bar" aria-hidden="true"><i id="preloaderBar"></i></div>
            <div class="preloader-percent" id="preloaderPercent">0%</div>
        </div>

        {{-- ========================== --}}
        {{-- POPUP (dari sage-flower) --}}
        {{-- ========================== --}}
        <div id="openingPopup" class="popup-overlay">
            <div class="popup-box">
                <img src="{{ asset('/images/flower/popup.webp') }}" class="popup-img" alt="Popup Image">

                <div class="popup-content" aria-hidden="false">
                    <p class="popup-greeting">Kepada Yth.</p>
                    <p class="popup-name">{{ $guestName ?? 'Tamu Undangan' }}</p>
                    <button class="popup-btn" id="openInvitationBtn" aria-label="Buka Undangan">Buka Undangan</button>
                </div>
            </div>
        </div>

        {{-- ========================== --}}
        {{-- MUSIC --}}
        {{-- ========================== --}}
        <audio id="bgmusic" loop>
            <source src="{{ asset('audio/manual-song.mp3') }}" type="audio/mpeg">
        </audio>

        <div id="musicBtn">🔊</div>

    {{-- ========================== --}}
    {{-- BAGIAN UNDANGAN (Tema-15) --}}
    {{-- ========================== --}}

    {{-- 1 --}}
    <section class="page-block" data-aos="zoom-in">
        <div class="page-inner">
            <img src="{{ asset('images/flower/verse.webp') }}">
        </div>
    </section>

    {{-- 2 --}}
    <section class="page-block" data-aos="fade-right">
        <div class="page-inner">
            <img src="{{ asset('images/flower/bride.webp') }}">
        </div>
    </section>

    {{-- 3 --}}
    <section class="page-block" data-aos="fade-left">
        <div class="page-inner">
            <img src="{{ asset('images/flower/groom.webp') }}">
        </div>
    </section>

    {{-- 4 Countdown --}}
    <section class="page-block" data-aos="zoom-in">
        <div class="page-inner" style="position:relative;">
            <img src="{{ asset('images/flower/countdown.webp') }}">

            <!-- Countdown overlay card (seperti contoh gambar) -->
            <div class="countdown-card">
                <div class="countdown-header">Event</div>
                <div class="countdown-icon">⊙</div>

                <div class="countdown-display">
                    <div class="digit-group">
                        <span id="dd" class="digit">0</span>
                        <span class="digit">0</span>
                    </div>
                    <span class="separator">:</span>
                    <div class="digit-group">
                        <span id="hh" class="digit">0</span>
                        <span class="digit">0</span>
                    </div>
                    <span class="separator">:</span>
                    <div class="digit-group">
                        <span id="mm" class="digit">0</span>
                        <span class="digit">0</span>
                    </div>
                    <span class="separator">:</span>
                    <div class="digit-group">
                        <span id="ss" class="digit">0</span>
                        <span class="digit">0</span>
                    </div>
                </div>

                <div class="countdown-labels">
                    <span>days</span>
                    <span>hours</span>
                    <span>minutes</span>
                    <span>seconds</span>
                </div>
            </div>
         </div>
     </section>

    {{-- 5 --}}
    <section class="page-block" data-aos="fade-up">
        <div class="page-inner">
            <img src="{{ asset('images/flower/9.webp') }}">
        </div>
    </section>

    {{-- 6 --}}
    <section class="page-block" data-aos="fade-up">
        <div class="page-inner">
            <img src="{{ asset('images/flower/10.webp') }}">
        </div>
    </section>

    {{-- 7 --}}
    <section class="page-block" data-aos="fade-up">
        <div class="page-inner">
            <img src="{{ asset('images/flower/14.webp') }}">
        </div>
    </section>

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 900, easing: 'ease-out' });

        // ===== PRELOADER & POPUP =====
        document.body.style.overflow = "hidden";

        const openingPopup = document.getElementById('openingPopup');
        const openBtn = document.getElementById('openInvitationBtn');
        const preloader = document.getElementById('preloader');
        const preloaderBar = document.getElementById('preloaderBar');
        const preloaderPercent = document.getElementById('preloaderPercent');
        const bgmusic = document.getElementById('bgmusic');
        const musicBtn = document.getElementById('musicBtn');

        function showPreloader(duration = 2500) {
            preloader.style.display = 'flex';
            preloader.style.opacity = '1';

            preloaderBar.animate([{ width: '0%' }, { width: '100%' }], {
                duration: duration,
                easing: 'linear',
                fill: 'forwards'
            });

            let startTime = performance.now();

            function updatePercent() {
                const elapsed = performance.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                preloaderPercent.innerText = Math.round(progress * 100) + '%';

                if (progress < 1) {
                    requestAnimationFrame(updatePercent);
                }
            }
            requestAnimationFrame(updatePercent);

            setTimeout(() => {
                preloader.style.opacity = '0';

                if (openingPopup) {
                    openingPopup.style.display = 'flex';
                    openingPopup.style.opacity = '1';
                    openingPopup.style.pointerEvents = 'auto';
                }

                setTimeout(() => {
                    preloader.style.display = 'none';
                    AOS.refresh();
                }, 600);
            }, duration);
        }

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                if (openingPopup) {
                    openingPopup.style.opacity = "0";
                    openingPopup.style.pointerEvents = "none";
                }
                document.body.style.overflow = "auto";
                bgmusic.play().catch(err => console.log('Auto-play blocked'));
                musicBtn.style.display = "block";
            });
        }

        musicBtn.addEventListener('click', () => {
            if (bgmusic.paused) {
                bgmusic.play();
                musicBtn.textContent = "🔊";
            } else {
                bgmusic.pause();
                musicBtn.textContent = "🔈";
            }
        });

        document.addEventListener('visibilitychange', () => {
            if (document.hidden && bgmusic && !bgmusic.paused) {
                bgmusic.pause();
            }
        });

        window.addEventListener('load', () => {
            showPreloader(2500);
        });

        // ===== COUNTDOWN TIMER =====
        const target = new Date(`{{ \Carbon\Carbon::parse($setting->wedding_date)->format('Y-m-d') }} 08:00:00`).getTime();

        function updateTimer() {
            const now = Date.now();
            const diff = target - now;
            if (diff < 0) {
                document.getElementById('dd').textContent = '0';
                document.getElementById('hh').textContent = '0';
                document.getElementById('mm').textContent = '0';
                document.getElementById('ss').textContent = '0';
                return;
            }

            const days = Math.floor(diff / 86400000);
            const hours = Math.floor((diff % 86400000) / 3600000);
            const minutes = Math.floor((diff % 3600000) / 60000);
            const seconds = Math.floor((diff % 60000) / 1000);

            const ddStr = String(days).padStart(2, '0');
            const hhStr = String(hours).padStart(2, '0');
            const mmStr = String(minutes).padStart(2, '0');
            const ssStr = String(seconds).padStart(2, '0');

            document.getElementById('dd').textContent = ddStr[0];
            document.getElementById('dd').nextElementSibling.textContent = ddStr[1];

            document.getElementById('hh').textContent = hhStr[0];
            document.getElementById('hh').nextElementSibling.textContent = hhStr[1];

            document.getElementById('mm').textContent = mmStr[0];
            document.getElementById('mm').nextElementSibling.textContent = mmStr[1];

            document.getElementById('ss').textContent = ssStr[0];
            document.getElementById('ss').nextElementSibling.textContent = ssStr[1];
        }
        setInterval(updateTimer, 1000);
        updateTimer();
    </script>

    {{-- ========================== --}}
    {{-- POPUP + MUSIC + PRELOADER --}}
    {{-- ========================== --}}
    <script>
        // ===== POPUP & PRELOADER (dari sage-flower) =====
        document.body.style.overflow = "hidden";

        const openingPopup = document.getElementById('openingPopup');
        const openBtn = document.getElementById('openInvitationBtn');
        const popupBox = document.querySelector('.popup-box');

        if (popupBox) {
            popupBox.addEventListener('wheel', function(e) {
                const delta = e.deltaY;
                const atTop = this.scrollTop === 0 && delta < 0;
                const atBottom = Math.ceil(this.scrollTop + this.clientHeight) >= this.scrollHeight && delta > 0;
                if (atTop || atBottom) {
                    e.preventDefault();
                }
            }, {
                passive: false
            });
        }

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                if (openingPopup) {
                    openingPopup.style.opacity = "0";
                    openingPopup.style.pointerEvents = "none";
                }
                document.body.style.overflow = "auto";
            });
        }

        const preloader = document.getElementById('preloader');
        const preloaderBar = document.getElementById('preloaderBar');
        const preloaderPercent = document.getElementById('preloaderPercent');

        function showPreloader(duration = 2000) {
            preloader.style.display = 'flex';
            preloader.style.opacity = '1';

            preloaderBar.animate([{
                    width: '0%'
                },
                {
                    width: '100%'
                }
            ], {
                duration: duration,
                easing: 'linear',
                fill: 'forwards'
            });

            let startTime = performance.now();

            function updatePercent() {
                const elapsed = performance.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                preloaderPercent.innerText = Math.round(progress * 100) + '%';

                if (progress < 1) {
                    requestAnimationFrame(updatePercent);
                }
            }
            requestAnimationFrame(updatePercent);

            setTimeout(() => {
                preloader.style.opacity = '0';

                if (openingPopup) {
                    openingPopup.style.display = 'flex';
                    openingPopup.style.opacity = '1';
                    openingPopup.style.pointerEvents = 'auto';
                }
                document.body.style.overflow = 'hidden';

                setTimeout(() => {
                    preloader.style.display = 'none';
                    AOS.refresh();
                }, 600);
            }, duration);
        }

        window.addEventListener('load', () => {
            showPreloader(2500);
        });

        // ===== MUSIC CONTROL (dari old popup) =====
        const bgmusic = document.getElementById('bgmusic');
        const musicBtn = document.getElementById('musicBtn');

        if (musicBtn && bgmusic) {
            musicBtn.addEventListener('click', () => {
                if (bgmusic.paused) {
                    bgmusic.play();
                    musicBtn.textContent = "🔊";
                } else {
                    bgmusic.pause();
                    musicBtn.textContent = "🔈";
                }
            });
        }

        // Auto-play on first click (kalau user klik di mana saja)
        document.addEventListener('click', () => {
            if (bgmusic && bgmusic.paused) {
                bgmusic.play().catch(err => console.log('Auto-play blocked'));
                if (musicBtn) musicBtn.style.display = "block";
            }
        }, {
            once: true
        });

        // Pause when tab hidden
        document.addEventListener('visibilitychange', () => {
            if (document.hidden && bgmusic && !bgmusic.paused) {
                bgmusic.pause();
            }
        });
    </script>

</body>
</html>
