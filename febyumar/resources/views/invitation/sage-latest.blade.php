<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->bride_name }} & {{ $setting->groom_name }}</title>

    <!-- AOS Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        /* === GLOBAL RESET === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #e6e6e0;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
        }

        /* === PAGE WRAPPER: PC TETAP MOBILE LAYOUT === */
        .page-wrapper {
            width: 100%;
            max-width: 480px;
            /* PC tetap versi mobile */
            background: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }


        /* === VERSE 1 SECTION === */

        .verse-section {
            position: relative;
            width: 100%;
            height: auto;
            overflow: hidden;
        }

        /* Background */
        .verse-bg img {
            width: 100%;
            height: auto;
            display: block;
            user-select: none;
        }

        /* Verse text overlay */
        .verse-content {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            pointer-events: none;
            /* biar ga ganggu scroll */
        }

        .verse-img {
            width: 85%;
            max-width: 330px;
            height: auto;
            opacity: 0;
            /* supaya fade-up AOS mulus */
        }

        /* AOS fix */
        [data-aos][data-aos].aos-animate {
            opacity: 1 !important;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        {{-- ========================== --}}
        {{--        SECTION: VERSE 1   --}}
        {{-- ========================== --}}

        <section id="verse1" class="verse-section">

            {{-- Background Image --}}
            <div class="verse-bg">
                <img src="{{ asset('assets/images/img/verse-1-bg.webp') }}" alt="Verse Background">
            </div>

            {{-- Text Overlay --}}
            <div class="verse-content">
                <img src="{{ asset('assets/images/img/verse-1.webp') }}" class="verse-img" data-aos="fade-up"
                    data-aos-duration="1200" alt="Verse Text">
            </div>

        </section>

    </div>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init({
                once: true,
                offset: 120
            });
        });
    </script>

</body>

</html>
