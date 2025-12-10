<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->bride_name }} & {{ $setting->groom_name }}</title>

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        /* ===================== GLOBAL ===================== */
        html,
        body {
            margin: 0;
            padding: 0;
            background: #949a8f;
            font-family: "Poppins", sans-serif;
            overflow-x: hidden;
            width: 100%;
        }

        img {
            width: 100%;
            height: auto;
            display: block;
        }

        .page-wrapper {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            position: relative;
            /* padding-bottom: 80px; */
        }

        /* ===================== PRELOADER ===================== */
        #preloader {
            position: fixed;
            inset: 0;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 999999;
            transition: .8s ease;
        }

        .preloader-icon {
            width: 120px;
        }

        .preloader-bar {
            width: 70%;
            max-width: 300px;
            height: 10px;
            background: #ddd;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 12px;
        }

        .preloader-bar span {
            width: 0%;
            height: 100%;
            display: block;
            background: #949a8f;
            transition: .2s linear;
        }

        .preloader-percent {
            margin-top: 10px;
            color: #949a8f;
            font-weight: 600;
        }

        /* ===================== POPUP ===================== */
        #openingPopup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transition: .4s ease;
        }

        #openingPopup.active {
            opacity: 1;
            visibility: visible;
        }

        .popup-box {
            width: 100%;
            max-width: 420px;
            border-radius: 22px;
            overflow: hidden;
            position: relative;
        }

        .popup-content {
            position: absolute;
            bottom: 10%;
            width: 100%;
            text-align: center;
            color: #fff;
        }

        .popup-btn {
            background: #fff;
            color: #2F2E2C;
            padding: 10px 14px;
            border-radius: 999px;
            border: none;
            font-weight: 700;
            width: 75%;
            max-width: 260px;
            margin-top: 10px;
            cursor: pointer;
        }

        /* ===================== MUSIC BUTTON ===================== */
        #musicBtn {
            position: fixed;
            right: 20px;
            bottom: 24px;
            background: rgba(255, 255, 255, .95);
            padding: 14px;
            border-radius: 50%;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .3);
            cursor: pointer;
            font-size: 18px;
            z-index: 5000;
            display: none;
        }

        /* ===================== GENERAL SECTIONS ===================== */
        .verse-section,
        .bride-section,
        .groom-section,
        .date-section {
            width: 100%;
            position: relative;
        }

        .verse-content,
        .bride-content,
        .groom-content,
        .date-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
        }

        .bismillah-img {
            width: 70%;
            max-width: 300px;
            margin-bottom: 10%;
            margin-top: 10%;
            opacity: 0;
        }

        .verse-img {
            padding-top: 40%;
            width: 50%;
            max-width: 350px;
            opacity: 0;
        }

        .bride-img,
        .groom-img {
            width: 85%;
            max-width: 380px;
            opacity: 0;
        }

        .bride-content {
            padding-top: 25%;
        }

        /* ===================== DATE SECTION ===================== */
        .date-section {
            position: relative;
            width: 100%;
        }


        .date-content {
            padding-top: 28%;
            z-index: 5;
        }

        .date-img {
            width: 92%;
            max-width: 420px;
            margin-bottom: 10%;
            opacity: 1 !important;
            z-index: 10;
        }

        /* COUNTDOWN TILES */
        .countdown-card {
            background: transparent;
            width: 95%;
            max-width: 340px;
            pointer-events: auto;
        }

        .countdown-tiles {
            display: flex;
            justify-content: space-between;
            gap: 6px;
        }

        .ctile {
            background: rgba(255, 255, 255, .9);
            width: 25%;
            padding: 10px 0;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .12);
        }

        .ctile-number {
            font-size: 1.4rem;
            font-weight: 700;
            color: #333;
        }

        .ctile-label {
            font-size: .7rem;
            color: #666;
        }

        /* =======================================
        DIRECTION SECTION
        ======================================= */
        .direction-section {
            position: relative;
            width: 100%;
        }

        /* FIX PALING PENTING: kontainer absolut harus full width */
        .direction-content {
            position: absolute;
            inset: 0;
            width: 100%;
            /* ← kuncinya */
            display: flex;
            flex-direction: column;
            align-items: center;
            /* biar stay center */
            padding-top: 18%;
            /* biar posisi turun */
            pointer-events: none;
        }

        /* TITLE BESAR */
        .direction-title {
            width: 70%;
            max-width: 320px;
            margin-bottom: 10px;
            opacity: 0;
        }

        /* GEDUNG 1 */
        .umn-bdg-img {
            width: 40%;
            max-width: 180px;
            margin-top: 14px;
            opacity: 0;
        }

        /* GEDUNG 2 */
        .umn-ads-img {
            width: 40%;
            max-width: 180px;
            margin-top: 10px;
            opacity: 0;
        }

        /* BUTTON */
        .map-btn {
            margin-top: 22px;
            background: #2F2E2C;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 12px 22px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            pointer-events: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .25);
        }

        .map-btn img {
            width: 20px;
            height: 20px;
        }


        [data-aos].aos-animate {
            opacity: 1 !important;
        }
    </style>
</head>

<body>

    <!-- PRELOADER -->
    <div id="preloader">
        <img src="{{ asset('images/flower/popup.webp') }}" class="preloader-icon">
        <div class="preloader-bar"><span id="preloaderBar"></span></div>
        <div id="preloaderPercent" class="preloader-percent">0%</div>
    </div>

    <!-- POPUP -->
    <div id="openingPopup">
        <div class="popup-box">
            <img src="{{ asset('images/flower/popup.webp') }}">
            <div class="popup-content">
                <p>Kepada Yth.</p>
                <p class="popup-name">{{ $guestName ?? 'Tamu Undangan' }}</p>
                <button id="openInvitationBtn" class="popup-btn">Buka Undangan</button>
            </div>
        </div>
    </div>

    <!-- MUSIC -->
    <audio id="bgmusic" loop>
        <source src="{{ asset('audio/manual-song.mp3') }}" type="audio/mpeg">
    </audio>
    <div id="musicBtn">🔊</div>

    <!-- CONTENT -->
    <div class="page-wrapper">

        <!-- VERSE -->
        <section class="verse-section">
            <img src="{{ asset('images/img/verse-1-bg.webp') }}">
            <div class="verse-content">
                <img src="{{ asset('images/img/verse-1.webp') }}" class="verse-img" data-aos="fade-up"
                    data-aos-duration="1000">
            </div>
        </section>

        <!-- BRIDE -->
        <section class="bride-section">
            <img src="{{ asset('images/img/bride-bg.webp') }}">
            <div class="bride-content">
                <img src="{{ asset('images/img/bismillah.webp') }}" class="bismillah-img" data-aos="fade-right"
                    data-aos-duration="500" data-aos-delay="200">

                <img src="{{ asset('images/img/bride.webp') }}" class="bride-img" data-aos="fade-right"
                    data-aos-duration="1000" data-aos-delay="900">
            </div>
        </section>

        <!-- GROOM -->
        <section class="groom-section">
            <img src="{{ asset('images/img/groom-bg.webp') }}">
            <div class="groom-content">
                <img src="{{ asset('images/img/groom.webp') }}" class="groom-img" data-aos="fade-left"
                    data-aos-duration="2000" data-aos-delay="200">
            </div>
        </section>

        <!-- DATE SECTION -->
        <section class="date-section">
            <img src="{{ asset('images/img/date-bg.webp') }}">
            <div class="date-content" data-aos="zoom-in" data-aos-duration="1500">

                <img src="{{ asset('images/img/date.webp') }}" class="date-img">

                <div class="countdown-card">
                    <div class="countdown-tiles">
                        <div class="ctile">
                            <div class="ctile-number" id="c_days">00</div>
                            <div class="ctile-label">Days</div>
                        </div>

                        <div class="ctile">
                            <div class="ctile-number" id="c_hours">00</div>
                            <div class="ctile-label">Hours</div>
                        </div>

                        <div class="ctile">
                            <div class="ctile-number" id="c_minutes">00</div>
                            <div class="ctile-label">Minutes</div>
                        </div>

                        <div class="ctile">
                            <div class="ctile-number" id="c_seconds">00</div>
                            <div class="ctile-label">Seconds</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ===== DIRECTION SECTION ===== -->
        <section class="direction-section">
            <img src="{{ asset('images/img/venue-bg.webp') }}">

            <div class="direction-content" data-aos="fade-up" data-aos-duration="1600">

                <!-- TITLE -->
                <img src="{{ asset('images/img/direction.webp') }}" class="direction-title" data-aos="zoom-in"
                    data-aos-duration="1800">

                <!-- UMN BUILDINGS -->
                <img src="{{ asset('images/img/umn-bdg.webp') }}" class="umn-bdg-img" data-aos="zoom-in"
                    data-aos-delay="300">

                <img src="{{ asset('images/img/umn-ads.webp') }}" class="umn-ads-img" data-aos="zoom-in"
                    data-aos-delay="600">

                <!-- BUTTON -->
                <a href="https://maps.app.goo.gl/943R7EmQ2ZJnic4x6" target="_blank">
                    <button class="map-btn" data-aos="zoom-in" data-aos-delay="900">
                        <img src="{{ asset('images/img/location.webp') }}">
                        Open Map Location
                    </button>
                </a>

            </div>
        </section>

    </div>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- LOGIC -->
    <script>
        document.body.style.overflow = "hidden";

        const preloader = document.getElementById("preloader");
        const preloaderBar = document.getElementById("preloaderBar");
        const preloaderPercent = document.getElementById("preloaderPercent");
        const popup = document.getElementById("openingPopup");
        const musicBtn = document.getElementById("musicBtn");
        const bgmusic = document.getElementById("bgmusic");
        const openBtn = document.getElementById("openInvitationBtn");

        let loaded = 0;
        const imgs = document.images;
        const total = imgs.length;

        function updateLoader() {
            loaded++;
            const percent = Math.min(100, Math.floor((loaded / total) * 100));
            preloaderBar.style.width = percent + "%";
            preloaderPercent.textContent = percent + "%";

            if (percent === 100) {
                setTimeout(() => {
                    preloader.style.opacity = "0";
                    preloader.style.visibility = "hidden";
                    popup.classList.add("active");
                }, 300);
            }
        }

        [...imgs].forEach(img =>
            img.complete ? updateLoader() :
            img.addEventListener("load", updateLoader, {
                once: true
            })
        );

        openBtn.addEventListener("click", () => {
            popup.classList.remove("active");
            musicBtn.style.display = "block";
            document.body.style.overflow = "auto";
            bgmusic.play().catch(() => {});
        });

        musicBtn.addEventListener("click", () => {
            if (bgmusic.paused) {
                bgmusic.play();
                musicBtn.textContent = "🔊";
            } else {
                bgmusic.pause();
                musicBtn.textContent = "🔈";
            }
        });

        /* COUNTDOWN */
        const target = new Date(`{{ \Carbon\Carbon::parse($setting->wedding_date)->format('Y-m-d') }} 08:00:00`).getTime();

        function updateTimer() {
            const now = Date.now();
            const diff = target - now;
            if (diff < 0) return;

            const d = Math.floor(diff / 86400000);
            const h = Math.floor((diff % 86400000) / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);

            c_days.textContent = String(d).padStart(2, '0');
            c_hours.textContent = String(h).padStart(2, '0');
            c_minutes.textContent = String(m).padStart(2, '0');
            c_seconds.textContent = String(s).padStart(2, '0');
        }

        setInterval(updateTimer, 1000);
        updateTimer();
    </script>

</body>

</html>
