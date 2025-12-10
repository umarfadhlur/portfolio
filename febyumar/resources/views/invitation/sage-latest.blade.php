<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sage Wedding Theme</title>

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        /* GLOBAL RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #949a8f;
            /* MATCH sage color */
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
        }

        /* PAGE WRAPPER – PC tetap mobile layout */
        .page-wrapper {
            width: 100%;
            max-width: 480px;
            background: #949a8f;
            overflow-x: hidden;
            position: relative;
        }

        /* ==== SPACING BETWEEN SECTIONS ==== */
        .section-spacer {
            height: 40px;
            width: 100%;
        }

        /* ==== VERSE SECTION ==== */
        .verse-section {
            position: relative;
            width: 100%;
            overflow: hidden;
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
            padding: 20px;
            pointer-events: none;
        }

        .verse-img {
            width: 70%;
            max-width: 250px;
            opacity: 0;
        }

        /* ==== BRIDE SECTION ==== */
        .bride-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .bride-bg img {
            width: 100%;
            height: auto;
            display: block;
            user-select: none;
        }

        .bride-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 35px;
            pointer-events: none;
        }

        .bismillah-img {
            width: 70%;
            max-width: 290px;
            margin-top: 120px;
            margin-bottom: 100px;
            opacity: 0;
        }

        .bride-img {
            width: 90%;
            max-width: 400px;
            opacity: 0;
        }

        /* ==== GROOM SECTION ==== */
        .groom-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .groom-bg img {
            width: 100%;
            height: auto;
            display: block;
            user-select: none;
        }

        .groom-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 35px;
            pointer-events: none;
        }

        .groom-img {
            width: 90%;
            max-width: 400px;
            opacity: 0;
        }

        /* AOS visibility fix */
        [data-aos][data-aos].aos-animate {
            opacity: 1 !important;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">
        <!-- ====================== -->
        <!-- ===== VERSE SECTION ===== -->
        <!-- ====================== -->
        <section id="verse1" class="verse-section">
            <div class="verse-bg">
                <img src="{{ asset('images/img/verse-1-bg.webp') }}" alt="Verse Background">
            </div>

            <div class="verse-content">
                <img src="{{ asset('images/img/verse-1.webp') }}" class="verse-img" data-aos="fade-up"
                    data-aos-duration="1800" data-aos-easing="ease-out-cubic" alt="Verse Text">
            </div>
        </section>

        <!-- SPACING -->
        <div class="section-spacer"></div>

        <!-- ======================= -->
        <!-- ===== BRIDE SECTION ==== -->
        <!-- ======================= -->
        <section id="bride" class="bride-section">

            <div class="bride-bg">
                <img src="{{ asset('images/img/bride-bg.webp') }}" alt="Bride Background">
            </div>

            <div class="bride-content">

                <img src="{{ asset('images/img/bismillah.webp') }}" class="bismillah-img" data-aos="fade-up"
                    data-aos-duration="1800" data-aos-easing="ease-out-cubic" alt="Bismillah">

                <img src="{{ asset('images/img/bride.webp') }}" class="bride-img" data-aos="fade-up"
                    data-aos-delay="300" data-aos-duration="2000" data-aos-easing="ease-out-cubic" alt="Bride">

            </div>
        </section>

        <!-- ======================= -->
        <!-- ===== GROOM SECTION ==== -->
        <!-- ======================= -->
        <section id="groom" class="groom-section">

            <div class="groom-bg">
                <img src="{{ asset('images/img/groom-bg.webp') }}" alt="Groom Background">
            </div>

            <div class="groom-content">

                <img src="{{ asset('images/img/groom.webp') }}" class="groom-img" data-aos="fade-up"
                    data-aos-delay="300" data-aos-duration="2000" data-aos-easing="ease-out-cubic" alt="Groom">

            </div>
        </section>

        <!-- SPACING -->
        <div class="section-spacer"></div>

    </div>


    <!-- ====================== -->
    <!-- ===== AOS INIT ===== -->
    <!-- ====================== -->
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
