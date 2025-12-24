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
            overflow-x: hidden;
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

        /* ===================== SECTIONS BASE ===================== */
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

        .verse-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        /* base hijau + frame sama-sama memenuhi section */
        .verse-base,
        .verse-frame {
            width: 100%;
            height: auto;
            display: block;
        }

        /* frame ditumpuk di atas base */
        .verse-frame {
            position: absolute;
            inset: 0;
            object-fit: cover;
            /* jaga proporsi saat container beda ukuran */
            object-position: center;
            /* tetap center */
        }

        /* konten overlay paling atas */
        .verse-content {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        /* contoh ukuran & posisi (mobile-first) */
        .verse-ring,
        .verse-swan {
            position: absolute;
            width: 32%;
            height: auto;
        }

        .verse-ring {
            bottom: 16%;
            left: 10%;
        }

        .verse-swan {
            bottom: 12%;
            right: 10%;
        }

        .verse-text {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
            width: 75%;
            height: auto;
        }

        /* blink */
        .verse-blink {
            position: absolute;
            width: 6%;
            height: auto;
        }

        .verse-blink-1 {
            top: 28%;
            left: 8%;
        }

        .verse-blink-2 {
            top: 28%;
            right: 8%;
        }

        .verse-blink-3 {
            bottom: 24%;
            left: 50%;
            transform: translateX(-50%);
        }

        /* tablet/desktop adjustment */
        @media (min-width: 481px) {
            .verse-text {
                width: 55%;
            }

            .verse-ring,
            .verse-swan {
                width: 26%;
            }

            .verse-blink {
                width: 4%;
            }
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

        /* DATE SECTION */
        .date-content {
            padding-top: 28%;
            z-index: 5;
        }

        .date-img {
            width: 92%;
            max-width: 420px;
            margin-bottom: 10%;
        }

        .countdown-card {
            width: 95%;
            max-width: 340px;
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
        }

        .ctile-label {
            font-size: .7rem;
            color: #666;
        }

        /* DIRECTION SECTION */
        .direction-section {
            position: relative;
        }

        .direction-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
            padding-top: 4%;
            left: 10%;
        }

        .direction-title {
            width: 75%;
            max-width: 320px;
        }

        .direction-building {
            width: 50%;
            max-width: 320px;
            margin-bottom: 5%;
        }

        .direction-address {
            width: 80%;
            max-width: 360px;
        }

        /* VERSE 2 */
        .verse2-section {
            width: 100%;
            position: relative;
        }

        .verse2-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
            right: 25%;
        }

        .verse2-img {
            padding-top: 40%;
            width: 80%;
            opacity: 0;
        }

        /* RSVP SECTION (background bless-bg, content overlay) */
        .rsvp-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .rsvp-section>img {
            width: 100%;
            display: block;
        }

        .rsvp-inner {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 24px 16px 32px;
            pointer-events: none;
        }

        .rsvp-card {
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 18px;
            padding: 18px 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.9);
            pointer-events: auto;

            /* batasi tinggi supaya tidak terlalu panjang, isi bisa scroll */
            max-height: 420px;
            overflow-y: auto;
        }

        .rsvp-title {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 700;
            color: #2F2E2C;
            margin-bottom: 16px;
        }

        .rsvp-form .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #2F2E2C;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            background: #fafafa;
            transition: all 0.2s.ease;
            color: #2F2E2C;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 90px;
        }

        .btn-submit {
            width: 100%;
            background: #727d6c;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 999px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .alert {
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 12px;
            border-left: 4px solid;
            font-size: 0.85rem;
        }

        .alert-success {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        /* Messages section (background gift-bg, cards overlay) */
        .messages-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .messages-section>img {
            width: 100%;
            display: block;
        }

        .messages-inner {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 24px 16px 40px;
            pointer-events: none;
        }

        .messages-card {
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 18px;
            padding: 16px 14px 18px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.9);
            pointer-events: auto;

            /* batasi tinggi card ucapan */
            max-height: 360px;
            display: flex;
            flex-direction: column;
        }

        .messages-list {
            margin-top: 8px;
            display: flex;
            flex-direction: column;
            gap: 10px;

            /* area ucapan scroll di dalam card */
            overflow-y: auto;
            padding-right: 4px;
        }

        .message-item {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 14px;
            padding: 8px 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.8);
            font-size: 0.88rem;
        }

        .message-item .meta {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 4px;
            font-weight: 600;
            color: #2F2E2C;
        }

        .message-item .text {
            color: #444;
            line-height: 1.4;
            white-space: pre-wrap;
        }

        [data-aos].aos-animate {
            opacity: 1 !important;
        }
    </style>
</head>

<body>

    <!-- PRELOADER -->
    <div id="preloader">
        <img src="{{ asset('images/img/popup.webp') }}" class="preloader-icon">
        <div class="preloader-bar"><span id="preloaderBar"></span></div>
        <div id="preloaderPercent" class="preloader-percent">0%</div>
    </div>

    <!-- POPUP -->
    <div id="openingPopup">
        <div class="popup-box">
            <img src="{{ asset('images/img/popup.webp') }}">
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
        <!-- <section class="verse-section">
            <img src="{{ asset('images/img/verse-1-bg.webp') }}">
            <div class="verse-content">
                <img src="{{ asset('images/img/verse-1.webp') }}" class="verse-img" data-aos="zoom-in"
                    data-aos-duration="1000">
            </div>
        </section> -->

        <section class="verse-section">
            <!-- Base background hijau (TANPA animasi) -->
            <img src="{{ asset('images/img/empty.webp') }}" class="verse-base" alt="">

            <!-- Frame bunga kiri-kanan + burung (animasi) -->
            <img src="{{ asset('images/img/flowerbird.webp') }}" class="verse-frame" alt="" data-aos="fade"
                data-aos-duration="1200" data-aos-delay="0" data-aos-easing="ease-out-cubic">

            <!-- Layer isi -->
            <div class="verse-content">
                <!-- Cincin -->
                <img src="{{ asset('images/img/ring.webp') }}" class="verse-ring" alt="" data-aos="zoom-in"
                    data-aos-duration="1000" data-aos-delay="250" data-aos-easing="ease-out-back">

                <!-- Angsa -->
                <img src="{{ asset('images/img/swan.webp') }}" class="verse-swan" alt="" data-aos="zoom-in"
                    data-aos-duration="1000" data-aos-delay="450" data-aos-easing="ease-out-back">

                <!-- Blink (biar terasa hidup, beda-beda animasinya) -->
                <img src="{{ asset('images/img/blink.webp') }}" class="verse-blink verse-blink-1" alt=""
                    data-aos="fade-up" data-aos-duration="700" data-aos-delay="650" data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/blink.webp') }}" class="verse-blink verse-blink-2" alt=""
                    data-aos="fade-up" data-aos-duration="700" data-aos-delay="750" data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/blink.webp') }}" class="verse-blink verse-blink-3" alt=""
                    data-aos="fade-up" data-aos-duration="700" data-aos-delay="850" data-aos-easing="ease-out-cubic">

                <!-- Verse (PALING TERAKHIR) -->
                <img src="{{ asset('images/img/verse.webp') }}" class="verse-text" alt="" data-aos="fade-up"
                    data-aos-duration="1100" data-aos-delay="1200" data-aos-easing="ease-out-cubic">
            </div>
        </section>



        <!-- BRIDE -->
        <section class="bride-section">
            <img src="{{ asset('images/img/bride-bg.webp') }}">
            <div class="bride-content">
                <img src="{{ asset('images/img/bismillah.webp') }}" class="bismillah-img" data-aos="fade-right"
                    data-aos-duration="1500" data-aos-delay="200">
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

        <!-- DATE -->
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

        <!-- DIRECTION -->
        <section class="direction-section">
            <img src="{{ asset('images/img/venue-bg.webp') }}" alt="Venue Background">
            <div class="direction-content">

                <img src="{{ asset('images/img/direction.webp') }}" class="direction-title" alt="Direction to Venue"
                    data-aos="fade-down" data-aos-duration="1200">

                <img src="{{ asset('images/img/umn-bdg.webp') }}" class="direction-building"
                    alt="Multimedia Nusantara University" data-aos="zoom-in" data-aos-duration="1200"
                    data-aos-delay="150">

                <img src="{{ asset('images/img/umn-ads.webp') }}" class="direction-address"
                    alt="Alamat Multimedia Nusantara University" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="300">
            </div>
        </section>

        <!-- VERSE 2 -->
        <section class="verse2-section">
            <img src="{{ asset('images/img/verse-2-bg.webp') }}">
            <div class="verse2-content">
                <img src="{{ asset('images/img/verse-2.webp') }}" class="verse2-img" data-aos="zoom-in"
                    data-aos-duration="1000">
            </div>
        </section>

        <!-- RSVP (bless-bg as background) -->
        <section id="rsvp" class="rsvp-section">
            <img src="{{ asset('images/img/bless-bg.webp') }}" alt="Bless Background">
            <div class="rsvp-inner">
                <div class="rsvp-card" data-aos="fade-up" data-aos-duration="1200">
                    <form id="rsvpForm" class="rsvp-form">
                        @csrf
                        <div id="rsvpAlert"></div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" id="fm_name" value="{{ $guestName }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Kehadiran</label>
                            <select name="status" id="fm_status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="hadir">✓ Hadir</option>
                                <option value="tidak hadir">✗ Tidak Hadir</option>
                                <option value="tentatif">? Tentatif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ucapan & Doa</label>
                            <textarea name="message" id="fm_message" placeholder="Tulis doa dan ucapan untuk pengantin..." required></textarea>
                        </div>

                        <button type="submit" class="btn-submit">Kirim Konfirmasi</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Ucapan & Doa (gift-bg as background) -->
        <section id="messages" class="messages-section">
            <img src="{{ asset('images/img/gift-bg.webp') }}" alt="Gift Background">
            <div class="messages-inner">
                <div class="messages-card" data-aos="fade-up" data-aos-duration="1200">
                    <h2 class="rsvp-title">Ucapan & Doa</h2>
                    <div id="messagesList" class="messages-list">
                        <!-- pesan di‑inject JS -->
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <!-- LOGIC + RSVP -->
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
            img.complete ?
            updateLoader() :
            img.addEventListener("load", updateLoader, {
                once: true
            })
        );

        /* ========== OPEN INVITATION ========== */
        openBtn.addEventListener("click", () => {
            popup.classList.remove("active");
            musicBtn.style.display = "block";
            document.body.style.overflow = "auto";

            bgmusic.play().catch(() => {});

            // AOS INIT setelah popup ditutup
            setTimeout(() => {
                AOS.init({
                    once: false,
                    mirror: true,
                    duration: 1200,
                    easing: 'ease-out-quart',
                    offset: 80
                });
                AOS.refreshHard();
            }, 300);
        });

        /* ========== MUSIC BUTTON ========== */
        musicBtn.addEventListener("click", () => {
            if (bgmusic.paused) {
                bgmusic.play();
                musicBtn.textContent = "🔊";
            } else {
                bgmusic.pause();
                musicBtn.textContent = "🔈";
            }
        });

        /* ========== AUTO PAUSE SAAT PINDAH TAB ========== */
        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                bgmusic.pause();
            } else {
                bgmusic.play().catch(() => {});
            }
        });

        /* ========== COUNTDOWN ========== */
        const target = new Date(`{{ \Carbon\Carbon::parse($setting->wedding_date)->format('Y-m-d') }} 08:00:00`).getTime();

        const cDaysEl = document.getElementById('c_days');
        const cHoursEl = document.getElementById('c_hours');
        const cMinutesEl = document.getElementById('c_minutes');
        const cSecondsEl = document.getElementById('c_seconds');

        function updateTimer() {
            const now = Date.now();
            const diff = target - now;
            if (diff < 0) return;

            const d = Math.floor(diff / 86400000);
            const h = Math.floor((diff % 86400000) / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);

            cDaysEl.textContent = String(d).padStart(2, '0');
            cHoursEl.textContent = String(h).padStart(2, '0');
            cMinutesEl.textContent = String(m).padStart(2, '0');
            cSecondsEl.textContent = String(s).padStart(2, '0');
        }

        setInterval(updateTimer, 1000);
        updateTimer();

        /* ========== RSVP & MESSAGES ========== */
        const messagesIndexUrl = "{{ route('rsvp.messages') }}";
        const messagesStoreUrl = "{{ route('rsvp.store') }}";

        function escapeHtml(s) {
            return String(s || '').replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            } [c]));
        }

        async function fetchMessages() {
            try {
                const res = await fetch(messagesIndexUrl, {
                    headers: {
                        Accept: 'application/json'
                    }
                });

                const data = await res.json().catch(() => null);
                if (!res.ok) throw new Error('Fetch failed');

                let items = [];
                if (Array.isArray(data)) items = data;
                else if (data && Array.isArray(data.rows)) items = data.rows;
                else if (data && Array.isArray(data.data)) items = data.data;

                // sort terbaru dulu lalu ambil 5 terakhir
                items = items.filter(m => m);
                items.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                items = items.slice(0, 5);

                const container = document.getElementById('messagesList');
                if (!container) return;

                container.innerHTML = '';

                if (!items.length) {
                    container.innerHTML =
                        '<p style="opacity:.7">Belum ada ucapan. Jadilah yang pertama ✨</p>';
                    return;
                }

                items.forEach(msg => {
                    const el = document.createElement('div');
                    el.className = 'message-item';
                    const messageText =
                        (msg.message && String(msg.message).trim() !== '') ?
                        escapeHtml(msg.message) :
                        '— Belum menulis ucapan —';
                    el.innerHTML = `
                        <div class="meta">
                            <div>${escapeHtml(msg.name || 'Tamu')}</div>
                            <div style="opacity:.75;font-weight:600;font-size:.92rem">
                                ${escapeHtml(msg.status || '')}
                            </div>
                        </div>
                        <div class="text">${messageText}</div>
                        <div style="margin-top:8px;font-size:0.8rem;color:#777">
                            ${msg.created_at ? new Date(msg.created_at).toLocaleString() : ''}
                        </div>
                    `;
                    container.appendChild(el);
                });
            } catch (e) {
                console.error('fetchMessages error', e);
                const container = document.getElementById('messagesList');
                if (container) {
                    container.innerHTML =
                        '<p style="opacity:.7">Gagal memuat ucapan. Coba refresh lagi.</p>';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchMessages();

            const form = document.getElementById('rsvpForm');
            if (form) {
                form.addEventListener('submit', async (ev) => {
                    ev.preventDefault();
                    const name = document.getElementById('fm_name').value.trim();
                    const status = document.getElementById('fm_status').value;
                    const message = document.getElementById('fm_message').value.trim();
                    const alertBox = document.getElementById('rsvpAlert');
                    alertBox.innerHTML = '';

                    if (!name || !status || !message) {
                        alertBox.innerHTML =
                            '<div class="alert" style="background:#f8d7da;border-color:#f5c6cb;color:#721c24">Tolong isi semua field.</div>';
                        return;
                    }

                    try {
                        const token = document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content');

                        const res = await fetch(messagesStoreUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                name,
                                status,
                                message
                            })
                        });

                        if (!res.ok) throw new Error('Request failed');

                        await res.json();
                        form.reset();
                        alertBox.innerHTML =
                            '<div class="alert alert-success">✔ Ucapan berhasil dikirim.</div>';
                        fetchMessages();
                    } catch (err) {
                        console.error('submit error', err);
                        alertBox.innerHTML =
                            '<div class="alert" style="background:#f8d7da;border-color:#f5c6cb;color:#721c24">Terjadi kesalahan. Coba lagi.</div>';
                    }
                });
            }
        });

        // DISABLE RIGHT CLICK & multi-touch zoom
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            return false;
        }, false);

        document.addEventListener('touchmove', function(e) {
            if (e.touches.length > 1) {
                e.preventDefault();
            }
        }, {
            passive: false
        });
    </script>

</body>

</html>
