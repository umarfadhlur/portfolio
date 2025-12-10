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
        /* ===================================
           GLOBAL — MOBILE FIRST FIX
        ==================================== */
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
        }

        .section-spacer {
            height: 40px;
        }

        /* ===================================
           PRELOADER
        ==================================== */
        #preloader {
            position: fixed;
            inset: 0;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 999999;
            transition: 2.4s;
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
            display: block;
            width: 0%;
            height: 100%;
            background: #949a8f;
            transition: .2s linear;
        }

        .preloader-percent {
            margin-top: 10px;
            color: #949a8f;
            font-weight: 600;
        }

        /* ===================================
           POPUP
        ==================================== */
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
            left: 0;
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
            cursor: pointer;
            margin-top: 10px;
        }

        /* ===================================
           MUSIC BUTTON
        ==================================== */
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

        /* ===================================
           SECTIONS
        ==================================== */
        .verse-section,
        .bride-section,
        .groom-section {
            width: 100%;
            position: relative;
        }

        .verse-content,
        .bride-content,
        .groom-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;

            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
        }

        .bismillah-img {
            width: 70%;
            max-width: 300px;
            margin-bottom: 10%;
            opacity: 0;
        }

        .verse-img {
            width: 70%;
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
            flex-direction: column;
            padding-top: 25%;
        }

        [data-aos][data-aos].aos-animate {
            opacity: 1 !important;
        }
    </style>
</head>

<body>

    <!-- =========== PRELOADER =========== -->
    <div id="preloader">
        <img src="{{ asset('images/flower/popup.webp') }}" class="preloader-icon">
        <div class="preloader-bar"><span id="preloaderBar"></span></div>
        <div id="preloaderPercent" class="preloader-percent">0%</div>
    </div>

    <!-- =========== POPUP =========== -->
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

    <!-- =========== MUSIC BTN =========== -->
    <audio id="bgmusic" loop>
        <source src="{{ asset('audio/manual-song.mp3') }}" type="audio/mpeg">
    </audio>
    <div id="musicBtn">🔊</div>

    <!-- =========== CONTENT =========== -->
    <div class="page-wrapper">

        <div class="section-spacer"></div>

        <!-- VERSE -->
        <section class="verse-section">
            <img src="{{ asset('images/img/verse-1-bg.webp') }}">
            <div class="verse-content">
                <img src="{{ asset('images/img/verse-1.webp') }}" class="verse-img" data-aos="fade-up"
                    data-aos-duration="1500">
            </div>
        </section>

        <div class="section-spacer"></div>

        <!-- BRIDE -->
        <section class="bride-section">
            <img src="{{ asset('images/img/bride-bg.webp') }}">
            <div class="bride-content">
                <img src="{{ asset('images/img/bismillah.webp') }}" class="bismillah-img" data-aos="fade-right"
                    data-aos-duration="1800" data-aos-delay="200">

                <img src="{{ asset('images/img/bride.webp') }}" class="bride-img" data-aos="fade-right"
                    data-aos-duration="2000" data-aos-delay="900">
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

        <div class="section-spacer"></div>

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
            img.complete ? updateLoader() : img.addEventListener("load", updateLoader, {
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
    </script>

</body>

</html>
