<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->bride_name }} & {{ $setting->groom_name }}</title>

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        body {
            margin: 0;
            overflow-x: hidden;
            background: #949a8f;
            font-family: "Poppins", sans-serif;
        }

        .page-wrapper {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
        }

        /* ================= PRELOADER ================= */
        #preloader {
            position: fixed;
            inset: 0;
            background: #7d8270;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 999999;
            transition: opacity .4s ease, visibility .4s ease;
        }

        .preloader-icon {
            width: 120px;
            opacity: .95;
        }

        .preloader-bar {
            width: 70%;
            max-width: 300px;
            height: 10px;
            background: #ddd;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 18px;
        }

        .preloader-bar span {
            display: block;
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #7d8270, #9a8f7e);
            transition: width .2s linear;
        }

        .preloader-percent {
            margin-top: 10px;
            color: #fff;
            font-weight: 600;
        }

        /* ================= POPUP ================= */
        #openingPopup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .55);
            backdrop-filter: blur(4px);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            /* penting buat mobile */
            opacity: 0;
            visibility: hidden;
            transition: opacity .4s;
            overflow-y: auto;
            /* kalau masih kepanjangan bisa discroll */
        }

        #openingPopup.active {
            opacity: 1;
            visibility: visible;
        }

        .popup-box {
            width: min(92vw, 420px);
            max-height: calc(100vh - 32px);
            /* selalu muat di tinggi layar */
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            margin: auto;
        }

        .popup-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* biar mengecil, bukan kepotong */
            display: block;
        }

        .popup-content {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 10%;
            text-align: center;
            color: #fff;
            padding: 12px 16px;
            background: linear-gradient(to top, rgba(0, 0, 0, .35), rgba(0, 0, 0, 0));
        }

        .popup-btn {
            background: #ffffff;
            color: #2F2E2C;
            padding: 10px 14px;
            border-radius: 999px;
            border: none;
            font-weight: 700;
            width: 70%;
            max-width: 260px;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        @media (max-width: 480px) {
            .popup-box {
                border-radius: 18px;
            }

            .popup-content {
                bottom: 7%;
                padding: 10px 12px;
            }

            .popup-btn {
                width: 80%;
                font-size: 0.9rem;
                padding: 8px 12px;
            }
        }

        @media (max-height: 640px) {
            .popup-content {
                bottom: 5%;
            }
        }

        /* ================= MUSIC BUTTON ================= */
        #musicBtn {
            position: fixed;
            right: 20px;
            bottom: 24px;
            background: rgba(255, 255, 255, 0.9);
            padding: 14px;
            border-radius: 50%;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .3);
            font-size: 18px;
            cursor: pointer;
            z-index: 8000;
            display: none;
        }

        /* ================= VERSE / BRIDE / GROOM ================= */
        .section-spacer {
            height: 40px;
        }

        .verse-section,
        .bride-section,
        .groom-section {
            position: relative;
            width: 100%;
        }

        .verse-bg img,
        .bride-bg img,
        .groom-bg img {
            width: 100%;
            display: block;
            height: auto;
        }

        .verse-content,
        .bride-content,
        .groom-content {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
        }

        .verse-img {
            width: 70%;
            max-width: 250px;
            opacity: 0;
        }

        .bismillah-img {
            width: 70%;
            max-width: 300px;
            margin-bottom: 10%;
            opacity: 0;
        }

        .bride-img,
        .groom-img {
            width: 90%;
            max-width: 400px;
            opacity: 0;
        }

        .bride-content {
            flex-direction: column;
            padding-top: 25%;
        }

        .groom-content {}

        [data-aos][data-aos].aos-animate {
            opacity: 1 !important;
        }
    </style>
</head>

<body>

    <!-- ================= PRELOADER ================= -->
    <div id="preloader">
        <img src="{{ asset('images/flower/popup.webp') }}" class="preloader-icon">
        <div class="preloader-bar"><span id="preloaderBar"></span></div>
        <div id="preloaderPercent" class="preloader-percent">0%</div>
    </div>

    <!-- ================= POPUP ================= -->
    <div id="openingPopup">
        <div class="popup-box">
            <img src="{{ asset('images/flower/popup.webp') }}" alt="Opening Card">
            <div class="popup-content">
                <p>Kepada Yth.</p>
                <p class="popup-name">{{ $guestName ?? 'Tamu Undangan' }}</p>
                <button id="openInvitationBtn" class="popup-btn">Buka Undangan</button>
            </div>
        </div>
    </div>

    <!-- ================= MUSIC ================= -->
    <audio id="bgmusic" loop>
        <source src="{{ asset('audio/manual-song.mp3') }}" type="audio/mpeg">
    </audio>
    <div id="musicBtn">🔊</div>

    <div class="page-wrapper">

        <div class="section-spacer"></div>

        <!-- VERSE -->
        <section class="verse-section">
            <div class="verse-bg">
                <img src="{{ asset('images/img/verse-1-bg.webp') }}" alt="">
            </div>
            <div class="verse-content">
                <img src="{{ asset('images/img/verse-1.webp') }}" class="verse-img" data-aos="fade-up"
                    data-aos-duration="1500">
            </div>
        </section>

        <div class="section-spacer"></div>

        <!-- BRIDE -->
        <section class="bride-section">
            <div class="bride-bg">
                <img src="{{ asset('images/img/bride-bg.webp') }}" alt="">
            </div>

            <div class="bride-content">
                <img src="{{ asset('images/img/bismillah.webp') }}" class="bismillah-img" data-aos="fade-right"
                    data-aos-duration="1800" data-aos-delay="200">

                <img src="{{ asset('images/img/bride.webp') }}" class="bride-img" data-aos="fade-right"
                    data-aos-duration="2000" data-aos-delay="900">
            </div>
        </section>

        <!-- GROOM -->
        <section class="groom-section">
            <div class="groom-bg">
                <img src="{{ asset('images/img/groom-bg.webp') }}" alt="">
            </div>

            <div class="groom-content">
                <img src="{{ asset('images/img/groom.webp') }}" class="groom-img" data-aos="fade-left"
                    data-aos-duration="2000" data-aos-delay="200">
            </div>
        </section>

        <div class="section-spacer"></div>
    </div>

    <!-- ================= AOS ================= -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            once: false,
            duration: 900,
            easing: "ease-out",
        });
    </script>

    <script>
        /* ============== PRELOADER ============== */
        document.body.style.overflow = "hidden";

        const preloader = document.getElementById("preloader");
        const preloaderBar = document.getElementById("preloaderBar");
        const preloaderPercent = document.getElementById("preloaderPercent");
        const popup = document.getElementById("openingPopup");
        const openBtn = document.getElementById("openInvitationBtn");
        const bgmusic = document.getElementById("bgmusic");
        const musicBtn = document.getElementById("musicBtn");

        let loaded = 0;
        const imgs = document.images;
        const total = imgs.length || 1;

        function updateLoader() {
            loaded++;
            const percent = Math.min(100, Math.floor((loaded / total) * 100));
            preloaderBar.style.width = percent + "%";
            preloaderPercent.textContent = percent + "%";

            if (percent >= 100) {
                setTimeout(() => {
                    preloader.style.opacity = "0";
                    preloader.style.visibility = "hidden";
                    popup.classList.add("active");
                }, 400);
            }
        }

        [...imgs].forEach(img => {
            if (img.complete) updateLoader();
            else img.addEventListener("load", updateLoader, {
                once: true
            });
        });

        /* ============== POPUP OPEN ============== */
        openBtn.addEventListener("click", () => {
            popup.classList.remove("active");
            document.body.style.overflow = "auto";

            musicBtn.style.display = "block";
            bgmusic.play().catch(() => {});
        });

        /* ============== MUSIC CONTROL ============== */
        musicBtn.addEventListener("click", () => {
            if (bgmusic.paused) {
                bgmusic.play();
                musicBtn.textContent = "🔊";
            } else {
                bgmusic.pause();
                musicBtn.textContent = "🔈";
            }
        });

        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                if (!bgmusic.paused) {
                    bgmusic.pause();
                    musicBtn.dataset.wasPlaying = "true";
                }
            } else {
                if (musicBtn.dataset.wasPlaying === "true") {
                    bgmusic.play().catch(() => {});
                    musicBtn.textContent = "🔊";
                    musicBtn.dataset.wasPlaying = "false";
                }
            }
        });
    </script>

</body>

</html>
