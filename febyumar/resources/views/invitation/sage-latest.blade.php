<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->bride_name }} & {{ $setting->groom_name }}</title>

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #949a8f;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
        }

        /* PAGE WRAPPER (PC tetap mobile layout) */
        .page-wrapper {
            width: 100%;
            max-width: 480px;
            background: #949a8f;
            overflow-x: hidden;
        }

        .section-spacer {
            height: 40px;
        }

        /* ============================= */
        /* ====== VERSE SECTION ======== */
        /* ============================= */
        .verse-section {
            position: relative;
            width: 100%;
        }

        .verse-bg img {
            width: 100%;
            height: auto;
            display: block;
        }

        .verse-content {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .verse-img {
            width: 70%;
            max-width: 250px;
            opacity: 0;
        }


        /* ============================= */
        /* ====== BRIDE SECTION ======== */
        /* ============================= */
        .bride-section {
            position: relative;
            width: 100%;
        }

        .bride-bg img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* overlay mengikuti proporsi background */
        .bride-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;

            /* padding-top pakai persentase agar adaptif */
            padding-top: 18%;
            pointer-events: none;
        }

        .bismillah-img {
            width: 70%;
            max-width: 300px;
            margin-bottom: 10%;
            opacity: 0;
        }

        .bride-img {
            width: 90%;
            max-width: 400px;
            opacity: 0;
        }


        /* ============================= */
        /* ====== GROOM SECTION ======== */
        /* ============================= */
        .groom-section {
            position: relative;
            width: 100%;
        }

        .groom-bg img {
            width: 100%;
            height: auto;
            display: block;
        }

        .groom-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;

            padding-top: 20%;
            pointer-events: none;
        }

        .groom-img {
            width: 90%;
            max-width: 400px;
            opacity: 0;
        }

        /* AOS fix */
        [data-aos][data-aos].aos-animate {
            opacity: 1 !important;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        <div class="section-spacer"></div>

        <!-- ======================= -->
        <!-- ===== VERSE =========== -->
        <!-- ======================= -->
        <section class="verse-section">
            <div class="verse-bg">
                <img src="{{ asset('images/img/verse-1-bg.webp') }}" alt="Verse Background">
            </div>

            <div class="verse-content">
                <img src="{{ asset('images/img/verse-1.webp') }}" class="verse-img" data-aos="fade-up"
                    data-aos-duration="1800" data-aos-easing="ease-out-cubic" alt="Verse Text">
            </div>
        </section>

        <div class="section-spacer"></div>

        <!-- ======================= -->
        <!-- ===== BRIDE =========== -->
        <!-- ======================= -->
        <section class="bride-section">

            <div class="bride-bg">
                <img src="{{ asset('images/img/bride-bg.webp') }}" alt="Bride Background">
            </div>

            <div class="bride-content">

                <img src="{{ asset('images/img/bismillah.webp') }}" class="bismillah-img" data-aos="fade-up"
                    data-aos-duration="2000" data-aos-delay="200" data-aos-easing="ease-out-cubic">

                <img src="{{ asset('images/img/bride.webp') }}" class="bride-img" data-aos="fade-up"
                    data-aos-duration="2200" data-aos-delay="900" data-aos-easing="ease-out-cubic">
            </div>
        </section>

        <div class="section-spacer"></div>

        <!-- ======================= -->
        <!-- ===== GROOM =========== -->
        <!-- ======================= -->
        <section class="groom-section">

            <div class="groom-bg">
                <img src="{{ asset('images/img/groom-bg.webp') }}" alt="Groom Background">
            </div>

            <div class="groom-content">

                <img src="{{ asset('images/img/groom.webp') }}" class="groom-img" data-aos="fade-up"
                    data-aos-duration="2200" data-aos-delay="200" data-aos-easing="ease-out-cubic">

            </div>
        </section>

        <div class="section-spacer"></div>

    </div>


    <!-- AOS INIT -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init({
                once: true,
                offset: 120,
                duration: 1600,
                easing: 'ease-in-out',
            });
        });
    </script>

</body>

</html>
