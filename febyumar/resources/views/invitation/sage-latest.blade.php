<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Wedding of {{ $setting->bride_name }} & {{ $setting->groom_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Tenor+Sans&display=swap" rel="stylesheet">

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
            transform: translateX(-50%);
            width: 55%;
            height: auto;
        }

        /* blink */
        .verse-blink {
            position: absolute;
            width: 10%;
            height: auto;
        }

        .verse-blink-1 {
            top: 28%;
            left: 8%;
        }

        .verse-blink-2 {
            top: 40%;
            right: 18%;
        }

        .verse-blink-3 {
            bottom: 24%;
            left: 25%;
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

        .bride-section {
            position: relative;
            width: 100%;
            overflow: hidden;
            /* WAJIB: supaya bagian di luar frame kepotong */
        }

        /* base */
        .bride-base {
            width: 100%;
            height: auto;
            display: block;
        }

        /* bunga: tinggi FULL mengikuti section, jadi tidak ada yang hilang atas/bawah */
        .bride-flower {
            position: absolute;
            pointer-events: none;
            z-index: 1;

            top: 0;
            bottom: 0;
            height: 100%;

            /* Lebarkan supaya bisa “keluar” kiri/kanan lalu kepotong */
            width: 85%;
            max-width: 520px;

            /* penting: jangan cover, biar tidak crop vertikal */
            object-fit: contain;
            object-position: center;
        }

        /* kiri: geser ke kiri sedikit (crop kiri/kanan saja) */
        .bride-flower-left {
            left: -40%;
        }

        /* kanan: geser ke kanan sedikit (crop kiri/kanan saja) */
        .bride-flower-right {
            right: -40%;
        }

        /* opsional: kalau mau sedikit lebih “pojok” tanpa menghilangkan atas/bawah */
        .bride-flower-left,
        .bride-flower-right {
            transform: translateY(-2%);
        }

        /* konten di atas bunga */
        .bride-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
            padding-top: 14%;
        }

        /* bunga: tinggi full, tidak hilang atas/bawah */
        .groom-flower {
            position: absolute;
            top: 0;
            bottom: 0;
            height: 100%;
            width: 85%;
            max-width: 520px;

            object-fit: contain;
            /* biar tidak crop vertikal */
            object-position: center;

            pointer-events: none;
            z-index: 1;
        }

        .groom-flower-right {
            right: -22%;
        }

        /* konten di atas bunga */
        .groom-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
            padding-top: 14%;
        }

        /* DATE SECTION */
        .date-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .date-base {
            width: 100%;
            height: auto;
            display: block;
        }

        /* bunga: tinggi full, tidak hilang atas/bawah (crop cuma kiri/kanan) */
        .date-flower {
            position: absolute;
            top: 0;
            bottom: 0;
            height: 100%;
            width: 85%;
            max-width: 520px;

            object-fit: contain;
            object-position: center;

            pointer-events: none;
            z-index: 1;
        }

        .date-flower-left {
            left: -40%;
        }

        .date-flower-right {
            right: -40%;
        }

        /* overlay content */
        .date-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
            padding-top: 14%;
        }

        /* date image */
        .date-img {
            width: 85%;
            max-width: 380px;
            height: auto;
            margin-bottom: 6%;
        }

        /* countdown card (biar rapi di mobile) */
        .countdown-card {
            width: 90%;
            max-width: 420px;
            pointer-events: auto;
            /* kalau nanti ada tombol/klik, aman */
        }

        .countdown-tiles {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .ctile {
            text-align: center;
        }

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
            width: 100%;
            overflow: hidden;
        }

        .direction-base {
            width: 100%;
            height: auto;
            display: block;
        }

        /* ornamen: crop kiri/kanan saja (tidak hilang atas/bawah) */
        .direction-flower {
            position: absolute;
            top: 0;
            bottom: 0;
            height: 100%;
            width: 85%;
            max-width: 520px;

            object-fit: contain;
            /* biar aman atas/bawah */
            object-position: center;

            pointer-events: none;
            z-index: 1;
        }

        .direction-flower-left {
            left: -22%;
        }

        .direction-content {
            transform: translateX(5%);
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
            padding-top: 5%;

            padding-left: 18px;
            /* ruang aman */
            padding-right: 18px;
            /* ruang aman */
            box-sizing: border-box;
        }

        /* sizing konten */
        .direction-title {
            width: 60%;
            max-width: 320px;
            height: auto;
        }

        .direction-building {
            width: 45%;
            max-width: 320px;
            height: auto;
            margin-bottom: 3%;
        }

        .direction-address {
            width: 80%;
            max-width: 360px;
            height: auto;
        }


        .direction-maps-btn {
            margin-top: 14px;
            pointer-events: auto;
            /* penting: biar bisa diklik (karena parent pointer-events:none) */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            padding: 12px 16px;
            border-radius: 999px;
            background: #727d6c;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
            max-width: 100%;
        }

        .direction-maps-icon {
            width: 18px;
            height: 18px;
            object-fit: contain;
            display: block;
        }

        /* VERSE 2 */
        .verse2-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .verse2-base {
            width: 100%;
            height: auto;
            display: block;
        }

        /* ornamen: tinggi full, biar nggak kepotong atas/bawah */
        .verse2-flower {
            position: absolute;
            top: 0;
            bottom: 0;
            height: 100%;
            width: 85%;
            max-width: 520px;

            object-fit: contain;
            /* aman vertikal */
            object-position: center;

            pointer-events: none;
            z-index: 1;
        }

        .verse2-flower-left {
            left: -22%;
        }

        .verse2-flower-right {
            right: -32%;
        }

        /* overlay content */
        .verse2-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
            padding-top: 25%;
            right: 25%;
        }

        .verse2-img {
            width: 82%;
            max-width: 420px;
            height: auto;
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

        /* THANK YOU SECTION */
        .thanks-section {
            position: relative;
            width: 100%;
            overflow: hidden;
            background: #949a8f;
        }

        /* balikin base supaya section punya tinggi “default” */
        .thanks-base {
            width: 100%;
            height: auto;
            display: block;
        }

        /* BUNGA: cover + zoom-out dikit */
        .thanks-ornament {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;

            object-fit: cover;
            object-position: center;

            transform: scale(1.20);
            transform-origin: center;

            pointer-events: none;
            z-index: 1;
        }

        /* konten di atas bunga */
        .thanks-content {
            position: absolute;
            inset: 0;
            z-index: 5;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 18px;

            padding: 12% 16px;
            box-sizing: border-box;
            pointer-events: none;
        }

        .thanks-item {
            width: 78%;
            max-width: 420px;
            height: auto;
            display: block;
        }

        .thanks-1 {
            /* transform: translateX(-10%); */
            width: 60%;
            max-width: 320px;
        }

        .thanks-2 {
            width: 55%;
            max-width: 280px;
        }

        .thanks-3 {
            width: 40%;
            max-width: 240px;
        }

        /* ========== WEDDING WISH ========== */
        .wish-head-img {
            width: 88%;
            max-width: 420px;
            height: auto;
            display: block;
            margin: 4px auto 4px;
        }

        .wish-section {
            width: 100%;
            background: #949a8f;
            position: relative;
            overflow: hidden;
            /* kalau ada ornament absolut, biar gak keluar */
        }

        .wish-inner {
            max-width: 480px;
            margin: 0 auto;
            padding: 22px 18px 140px;
            /* ruang aman bawah (ornament + music btn) */
            box-sizing: border-box;

            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        /* header */
        .wish-head {
            text-align: center;
            color: #fff;
        }

        .wish-title {
            font-size: 34px;
            font-weight: 900;
            color: #e2ad78;
            line-height: 1.05;
        }

        .wish-sub {
            margin-top: 6px;
            font-size: 13px;
            font-weight: 700;
            opacity: .95;
        }

        .wish-comments {
            margin-top: 10px;
            font-size: 14px;
            font-weight: 900;
        }

        /* stats */
        .wish-stats {
            width: 100%;
            max-width: 420px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .wish-stat {
            border-radius: 12px;
            padding: 14px 10px;
            text-align: center;
            color: #222;
        }

        .wish-stat.present {
            background: rgba(198, 255, 205, .9);
        }

        .wish-stat.absent {
            background: rgba(255, 170, 170, .9);
        }

        .wish-stat .num {
            font-size: 22px;
            font-weight: 900;
        }

        .wish-stat .lbl {
            font-size: 12px;
            font-weight: 800;
            opacity: .8;
        }

        /* pane */
        .wish-formPane,
        .wish-listPane {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            flex: none;
            /* penting: jangan flex-grow kalau parent gak fixed height */
            min-height: auto;
            /* hapus konsep 50/50 yang bikin numpuk */
        }

        /* form */
        .wish-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .wish-form input,
        .wish-form textarea,
        .wish-form select {
            width: 100%;
            box-sizing: border-box;
            border: none;
            outline: none;
            padding: 12px 16px;
            background: rgba(255, 255, 255, .92);
            color: #2F2E2C;
        }

        .wish-form input,
        .wish-form select {
            border-radius: 999px;
        }

        .wish-form textarea {
            border-radius: 16px;
            min-height: 92px;
            resize: none;
        }

        .wish-send {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 12px 16px;
            background: #e2ad78;
            color: #2F2E2C;
            font-weight: 900;
            cursor: pointer;
        }

        /* list: scrollnya di sini, bukan di parent */
        .wish-list {
            width: 100%;
            margin-top: 8px;

            max-height: 360px;
            /* stabil di mobile; adjust 320-420 sesuai selera */
            overflow-y: auto;
            overflow-x: hidden;

            display: flex;
            flex-direction: column;
            gap: 14px;

            color: #fff;

            /* hide scrollbar but keep scroll */
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .wish-list::-webkit-scrollbar {
            display: none;
        }

        /* item */
        .wish-item {
            padding: 0;
        }

        .wish-item .meta {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-weight: 900;
        }

        .wish-item .text {
            margin-top: 4px;
            opacity: .95;
        }

        .wish-item .time {
            margin-top: 8px;
            font-size: 12px;
            opacity: .75;
        }

        html,
        body {
            font-family: 'Tenor Sans', sans-serif;
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
        <section class="verse-section" data-aos="fade" data-aos-duration="1200" data-aos-easing="ease-out-cubic">
            <img src="{{ asset('images/img/empty.webp') }}" class="verse-base" alt="">

            <!-- frame -->
            <img src="{{ asset('images/img/flowerbird.webp') }}" class="verse-frame" alt="" data-aos="fade"
                data-aos-duration="1400" data-aos-delay="150" data-aos-easing="ease-out-cubic">

            <div class="verse-content">
                <img src="{{ asset('images/img/ring.webp') }}" class="verse-ring" alt="" data-aos="zoom-in"
                    data-aos-duration="900" data-aos-delay="250" data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/swan.webp') }}" class="verse-swan" alt="" data-aos="zoom-in"
                    data-aos-duration="900" data-aos-delay="400" data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/blink.webp') }}" class="verse-blink verse-blink-1" alt=""
                    data-aos="fade-up" data-aos-duration="800" data-aos-delay="550" data-aos-easing="ease-out-cubic">
                <img src="{{ asset('images/img/blink.webp') }}" class="verse-blink verse-blink-2" alt=""
                    data-aos="fade-up" data-aos-duration="800" data-aos-delay="650" data-aos-easing="ease-out-cubic">
                <img src="{{ asset('images/img/blink.webp') }}" class="verse-blink verse-blink-3" alt=""
                    data-aos="fade-up" data-aos-duration="800" data-aos-delay="750" data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/verse.webp') }}" class="verse-text" alt="" data-aos="fade-up"
                    data-aos-duration="1100" data-aos-delay="900" data-aos-easing="ease-out-cubic">
            </div>
        </section>


        <!-- BRIDE -->
        <section class="bride-section" data-aos="fade" data-aos-duration="1200" data-aos-easing="ease-out-cubic">
            <img src="{{ asset('images/img/empty.webp') }}" class="bride-base" alt="">

            <img src="{{ asset('images/img/bride-bg-left.webp') }}" class="bride-flower bride-flower-left"
                alt="" data-aos="fade-right" data-aos-duration="1300" data-aos-delay="120"
                data-aos-easing="ease-out-cubic">

            <img src="{{ asset('images/img/bride-bg-right.webp') }}" class="bride-flower bride-flower-right"
                alt="" data-aos="fade-left" data-aos-duration="1300" data-aos-delay="120"
                data-aos-easing="ease-out-cubic">

            <div class="bride-content" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="300"
                data-aos-easing="ease-out-cubic">
                <img src="{{ asset('images/img/bismillah.webp') }}" class="bismillah-img" alt=""
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="350"
                    data-aos-easing="ease-out-cubic">
                <img src="{{ asset('images/img/bride.webp') }}" class="bride-img" alt="" data-aos="fade-up"
                    data-aos-duration="1200" data-aos-delay="500" data-aos-easing="ease-out-cubic">
            </div>
        </section>


        <!-- GROOM -->
        <section class="groom-section" data-aos="fade" data-aos-duration="1200" data-aos-easing="ease-out-cubic">
            <img src="{{ asset('images/img/empty.webp') }}" class="groom-base" alt="">

            <img src="{{ asset('images/img/groom-bg-right.webp') }}" class="groom-flower groom-flower-right"
                alt="" data-aos="fade-left" data-aos-duration="1300" data-aos-delay="120"
                data-aos-easing="ease-out-cubic">

            <div class="groom-content" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="320"
                data-aos-easing="ease-out-cubic">
                <img src="{{ asset('images/img/groom.webp') }}" class="groom-img" alt="" data-aos="fade-up"
                    data-aos-duration="1200" data-aos-delay="450" data-aos-easing="ease-out-cubic">
            </div>
        </section>


        <!-- DATE -->
        <section class="date-section" data-aos="fade" data-aos-duration="1200" data-aos-easing="ease-out-cubic">
            <img src="{{ asset('images/img/empty.webp') }}" class="date-base" alt="">

            <img src="{{ asset('images/img/date-bg-left.webp') }}" class="date-flower date-flower-left"
                alt="" data-aos="fade-right" data-aos-duration="1300" data-aos-delay="120"
                data-aos-easing="ease-out-cubic">

            <img src="{{ asset('images/img/date-bg-right.webp') }}" class="date-flower date-flower-right"
                alt="" data-aos="fade-left" data-aos-duration="1300" data-aos-delay="120"
                data-aos-easing="ease-out-cubic">

            <div class="date-content" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="320"
                data-aos-easing="ease-out-cubic">
                <img src="{{ asset('images/img/date.webp') }}" class="date-img" alt="" data-aos="fade-up"
                    data-aos-duration="1100" data-aos-delay="420" data-aos-easing="ease-out-cubic">

                <div class="countdown-card" data-aos="fade-up" data-aos-duration="1100" data-aos-delay="560"
                    data-aos-easing="ease-out-cubic">
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
        <section class="direction-section" data-aos="fade" data-aos-duration="1200"
            data-aos-easing="ease-out-cubic">
            <img src="{{ asset('images/img/empty.webp') }}" class="direction-base" alt="">

            <img src="{{ asset('images/img/direction-bg.webp') }}" class="direction-flower direction-flower-left"
                alt="" data-aos="fade-right" data-aos-duration="1300" data-aos-delay="120"
                data-aos-easing="ease-out-cubic">

            <div class="direction-content" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="320"
                data-aos-easing="ease-out-cubic">
                <img src="{{ asset('images/img/direction.webp') }}" class="direction-title" alt="Direction to Venue"
                    data-aos="fade-down" data-aos-duration="1100" data-aos-delay="350"
                    data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/umn-bdg.webp') }}" class="direction-building"
                    alt="Multimedia Nusantara University" data-aos="zoom-in" data-aos-duration="900"
                    data-aos-delay="520" data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/umn-ads.webp') }}" class="direction-address"
                    alt="Alamat Multimedia Nusantara University" data-aos="fade-up" data-aos-duration="1100"
                    data-aos-delay="650" data-aos-easing="ease-out-cubic">

                <a href="https://maps.app.goo.gl/2obsLsNPhKbUhJNZ7" class="direction-maps-btn" target="_blank"
                    rel="noopener noreferrer" data-aos="fade-up" data-aos-duration="1100" data-aos-delay="780"
                    data-aos-easing="ease-out-cubic">
                    <img src="{{ asset('images/img/location.webp') }}" class="direction-maps-icon" alt="">
                    <span>Open Maps Location</span>
                </a>
            </div>
        </section>


        <!-- VERSE 2 -->
        <section class="verse2-section" data-aos="fade" data-aos-duration="1200" data-aos-easing="ease-out-cubic">
            <img src="{{ asset('images/img/empty.webp') }}" class="verse2-base" alt="">

            <img src="{{ asset('images/img/verse-2-bg.webp') }}" class="verse2-flower verse2-flower-right"
                alt="" data-aos="fade-left" data-aos-duration="1300" data-aos-delay="120"
                data-aos-easing="ease-out-cubic">

            <div class="verse2-content" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="320"
                data-aos-easing="ease-out-cubic">
                <img src="{{ asset('images/img/verse-2.webp') }}" class="verse2-img" alt=""
                    data-aos="fade-up" data-aos-duration="1100" data-aos-delay="450"
                    data-aos-easing="ease-out-cubic">
            </div>
        </section>


        <!-- WEDDING WISH -->
        <section id="weddingWish" class="wish-section" data-aos="fade" data-aos-duration="1200"
            data-aos-easing="ease-out-cubic">
            <div class="wish-inner">
                <div class="wish-head">
                    <img src="{{ asset('images/img/share-bless.webp') }}" class="wish-head-img" alt="Wedding Wish"
                        data-aos="fade-down" data-aos-duration="1100" data-aos-delay="250"
                        data-aos-easing="ease-out-cubic" />

                    <div class="wish-comments" data-aos="fade-up" data-aos-duration="900" data-aos-delay="420"
                        data-aos-easing="ease-out-cubic">
                        <span id="wishCommentCount">0</span> Comments
                    </div>
                </div>

                <div class="wish-stats" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="520"
                    data-aos-easing="ease-out-cubic">
                    <div class="wish-stat present">
                        <div class="num" id="wishPresentCount">0</div>
                        <div class="lbl">Present</div>
                    </div>
                    <div class="wish-stat absent">
                        <div class="num" id="wishAbsentCount">0</div>
                        <div class="lbl">Absent</div>
                    </div>
                </div>

                <div class="wish-formPane" data-aos="fade-up" data-aos-duration="1050" data-aos-delay="620"
                    data-aos-easing="ease-out-cubic">
                    <form id="rsvpForm" class="wish-form">
                        @csrf
                        <div id="rsvpAlert"></div>

                        <input type="text" name="name" id="fm_name" value="{{ $guestName }}"
                            placeholder="Name" required>
                        <textarea name="message" id="fm_message" placeholder="Wish" required></textarea>

                        <select name="status" id="fm_status" required>
                            <option value="">Attendance Confirmation</option>
                            <option value="hadir">✓ Present</option>
                            <option value="tidak hadir">✗ Absent</option>
                            <option value="tentatif">? Tentative</option>
                        </select>

                        <button type="submit" class="wish-send" id="wishSendBtn">SEND</button>
                    </form>
                </div>

                <div class="wish-listPane" data-aos="fade-up" data-aos-duration="1050" data-aos-delay="720"
                    data-aos-easing="ease-out-cubic">
                    <div id="messagesList" class="wish-list"></div>
                </div>
            </div>
        </section>


        <!-- THANK YOU -->
        <section class="thanks-section" data-aos="fade" data-aos-duration="1200" data-aos-easing="ease-out-cubic">
            <img src="{{ asset('images/img/empty.webp') }}" class="thanks-base" alt="">

            <!-- background besar: fade (lebih smooth daripada zoom) -->
            <img src="{{ asset('images/img/thanks-bg.webp') }}" class="thanks-ornament" alt=""
                data-aos="fade" data-aos-duration="1600" data-aos-delay="150" data-aos-easing="ease-out-cubic">

            <div class="thanks-content">
                <img src="{{ asset('images/img/thanks-1.webp') }}" class="thanks-item thanks-1" alt=""
                    data-aos="fade-up" data-aos-duration="1100" data-aos-delay="350"
                    data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/thanks-2.webp') }}" class="thanks-item thanks-2" alt=""
                    data-aos="fade-up" data-aos-duration="1100" data-aos-delay="520"
                    data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/thanks-3.webp') }}" class="thanks-item thanks-3" alt=""
                    data-aos="fade-up" data-aos-duration="1100" data-aos-delay="690"
                    data-aos-easing="ease-out-cubic">
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
                    once: true,
                    mirror: false,
                    offset: 120,
                    duration: 2000, // lebih slow
                    easing: 'ease-in-out', // lebih lembut dari ease-out-quart/cubic
                    delay: 0,
                    debounceDelay: 50,
                    throttleDelay: 99
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

        /* ========== RSVP & MESSAGES (FIXED) ========== */
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

        function normalizeItems(data) {
            if (Array.isArray(data)) return data;
            if (data && Array.isArray(data.rows)) return data.rows;
            if (data && Array.isArray(data.data)) return data.data;
            return [];
        }

        function getStatusIcon(statusRaw) {
            const s = String(statusRaw || '').toLowerCase().trim();

            if (s === 'hadir') return "{{ asset('images/img/present.webp') }}";
            if (s === 'tidak hadir' || s === 'tidak hadir') return "{{ asset('images/img/absent.webp') }}";
            if (s === 'tentatif' || s === 'tentatif') return "{{ asset('images/img/tentative.webp') }}";

            return ""; // fallback: kosong
        }

        function renderMessageItem(msg) {
            const el = document.createElement('div');
            el.className = 'wish-item';

            const messageText =
                (msg.message && String(msg.message).trim() !== '') ?
                escapeHtml(msg.message) :
                '— Belum menulis ucapan —';

            const icon = getStatusIcon(msg.status);

            el.innerHTML = `
    <div class="meta">
      <div>${escapeHtml(msg.name || 'Tamu')}</div>

      <div style="display:flex;align-items:center;gap:8px;opacity:.85;font-weight:700;font-size:.92rem">
        ${icon ? `<img src="${icon}" alt="" style="width:18px;height:18px;object-fit:contain">` : ''}
      </div>
    </div>

    <div class="text">${messageText}</div>
    <div class="time">${msg.created_at ? new Date(msg.created_at).toLocaleString() : 'Baru saja'}</div>
  `;
            return el;
        }


        function updateCounters(items) {
            const all = (items || []).filter(Boolean);

            const present = all.filter(x => (x.status || '').toLowerCase() === 'hadir').length;
            const absent = all.filter(x => (x.status || '').toLowerCase() === 'tidak hadir').length;

            const cmtEl = document.getElementById('wishCommentCount');
            const pEl = document.getElementById('wishPresentCount');
            const aEl = document.getElementById('wishAbsentCount');

            if (cmtEl) cmtEl.textContent = String(all.length);
            if (pEl) pEl.textContent = String(present);
            if (aEl) aEl.textContent = String(absent);
        }

        async function fetchMessages() {
            const list = document.getElementById('messagesList');
            if (!list) return;

            try {
                const res = await fetch(messagesIndexUrl, {
                    headers: {
                        Accept: 'application/json'
                    }
                });
                const data = await res.json().catch(() => null);
                if (!res.ok) throw new Error('Fetch failed');

                let items = normalizeItems(data).filter(Boolean);
                items.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                updateCounters(items);

                list.innerHTML = '';
                const top = items.slice(0, 5);

                if (!top.length) {
                    list.innerHTML = '<p style="opacity:.7">Belum ada ucapan. Jadilah yang pertama ✨</p>';
                    return;
                }

                top.forEach(msg => list.appendChild(renderMessageItem(msg)));
            } catch (e) {
                console.error('fetchMessages error', e);
                list.innerHTML = '<p style="opacity:.7">Gagal memuat ucapan. Coba refresh lagi.</p>';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchMessages();

            const form = document.getElementById('rsvpForm');
            const btn = document.getElementById('wishSendBtn');

            if (!form) return;

            form.addEventListener('submit', async (ev) => {
                ev.preventDefault();

                const nameEl = document.getElementById('fm_name');
                const statusEl = document.getElementById('fm_status');
                const messageEl = document.getElementById('fm_message');

                const alertBox = document.getElementById('rsvpAlert');
                const list = document.getElementById('messagesList');

                if (alertBox) alertBox.innerHTML = '';

                // kalau element null => HTML id belum sesuai
                if (!nameEl || !statusEl || !messageEl) {
                    if (alertBox) {
                        alertBox.innerHTML =
                            '<div class="alert" style="background:#f8d7da;color:#721c24">ID input tidak ketemu. Pastikan pakai fm_name/fm_status/fm_message.</div>';
                    }
                    return;
                }

                const name = nameEl.value.trim();
                const status = statusEl.value;
                const message = messageEl.value.trim();

                if (!name || !status || !message) {
                    if (alertBox) {
                        alertBox.innerHTML =
                            '<div class="alert" style="background:#f8d7da;color:#721c24">Tolong isi semua field.</div>';
                    }
                    return;
                }

                try {
                    btn && (btn.disabled = true);

                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                        'content') || '';
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

                    const saved = await res.json().catch(() => ({}));
                    if (!res.ok) throw new Error(saved?.message || 'Request failed');

                    // langsung tampil (tanpa fetch ulang)
                    if (list) {
                        list.prepend(renderMessageItem({
                            name,
                            status,
                            message,
                            created_at: saved.created_at || new Date().toISOString()
                        }));
                    }

                    // update angka simple (tanpa hit server)
                    const cmtEl = document.getElementById('wishCommentCount');
                    if (cmtEl) cmtEl.textContent = String((parseInt(cmtEl.textContent || '0', 10) ||
                        0) + 1);

                    if (String(status).toLowerCase() === 'hadir') {
                        const pEl = document.getElementById('wishPresentCount');
                        if (pEl) pEl.textContent = String((parseInt(pEl.textContent || '0', 10) || 0) +
                            1);
                    }
                    if (String(status).toLowerCase() === 'tidak hadir') {
                        const aEl = document.getElementById('wishAbsentCount');
                        if (aEl) aEl.textContent = String((parseInt(aEl.textContent || '0', 10) || 0) +
                            1);
                    }

                    form.reset();

                    if (alertBox) {
                        alertBox.innerHTML =
                            '<div class="alert alert-success">✔ Ucapan berhasil dikirim.</div>';
                    }
                } catch (err) {
                    console.error('submit error', err);
                    if (alertBox) {
                        alertBox.innerHTML =
                            '<div class="alert" style="background:#f8d7da;color:#721c24">Terjadi kesalahan. Coba lagi.</div>';
                    }
                } finally {
                    btn && (btn.disabled = false);
                }
            });
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
