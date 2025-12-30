<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->bride_name }} & {{ $setting->groom_name }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #E8E6E1;
            color: #2A2A2A;
            font-family: 'Tenor Sans', sans-serif;
            overflow-x: hidden;
        }

        .title-hand {
            font-family: 'Tenor Sans', sans-serif;
            letter-spacing: 1px;
        }

        .center {
            text-align: center;
        }

        .full-screen {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 50px 20px 120px 20px;
        }

        .section-block {
            padding: 120px 20px;
            text-align: center;
        }

        .bg-red {
            background: #8A1C1A;
            color: white;
        }

        .img-fluid {
            width: 100%;
            max-width: 600px;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 8px;
        }

        .split-two {
            padding: 120px 20px;
            text-align: center;
        }

        .split-two img {
            width: 48%;
            max-width: 500px;
            height: auto;
            border-radius: 8px;
        }

        @media (max-width: 600px) {
            .split-two img {
                width: 100%;
                margin-bottom: 18px;
            }
        }

        .quote-text {
            max-width: 480px;
            margin: 25px auto 0 auto;
            line-height: 1.7;
        }

        .ref {
            display: block;
            margin-top: 10px;
            font-family: 'Tenor Sans', sans-serif;
            color: #8A1C1A;
        }

        .btn {
            margin-top: 40px;
            padding: 12px 40px;
            border-radius: 30px;
            background: #8A1C1A;
            color: white;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
        }

        #musicToggle {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 55px;
            height: 55px;
            background: #8A1C1A;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.3);
            z-index: 999;
        }

        #musicToggle svg {
            fill: white;
            width: 28px;
            height: 28px;
        }
    </style>
</head>

<body>

    <section class="full-screen bg-red" data-aos="fade-up" data-aos-anchor-placement="top-center">
        <h1 class="title-hand" style="font-size:3rem;">
            {{ $setting->bride_name }} <br>&<br> {{ $setting->groom_name }}
        </h1>
        <p style="margin-top:15px; font-size:1.1rem;">
            {{ \Carbon\Carbon::parse($setting->wedding_date)->translatedFormat('d F Y') }}
        </p>
    </section>

    <section class="section-block" data-aos="fade-up" data-aos-delay="200" data-aos-anchor-placement="top-center">
        <img src="{{ asset('/images/story/photo1.jpg') }}" class="img-fluid">
        <p class="quote-text">
            “Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan untukmu pasangan hidup...”
            <span class="ref">QS. Ar-Rum : 21</span>
        </p>
    </section>

    <section class="split-two" data-aos="fade-up" data-aos-delay="300" data-aos-anchor-placement="top-center">
        <img src="{{ asset('/images/story/photo2-left.jpg') }}">
        <img src="{{ asset('/images/story/photo2-right.jpg') }}">
        <p class="center" style="margin-top:25px;">
            THE DAY · {{ \Carbon\Carbon::parse($setting->wedding_date)->translatedFormat('d.m.y') }}
        </p>
    </section>

    <section class="section-block" data-aos="fade-right" data-aos-delay="300" data-aos-anchor-placement="top-center">
        <img src="{{ asset('/images/story/bride.jpg') }}" class="img-fluid">
        <h2 class="title-hand" style="font-size:2rem;">{{ $setting->bride_name }}</h2>
        <p>{{ $setting->bride_parent }}</p>
    </section>

    <section class="section-block" data-aos="fade-left" data-aos-delay="300" data-aos-anchor-placement="top-center">
        <img src="{{ asset('/images/story/groom.jpg') }}" class="img-fluid">
        <h2 class="title-hand" style="font-size:2rem;">{{ $setting->groom_name }}</h2>
        <p>{{ $setting->groom_parent }}</p>
    </section>

    <section class="center section-block" data-aos="fade-up" data-aos-delay="400"
        data-aos-anchor-placement="top-center">
        <h2 class="title-hand" style="font-size:2.6rem;">
            {{ \Carbon\Carbon::parse($setting->wedding_date)->translatedFormat('d F Y') }}
        </h2>
        <p>Akad Nikah: {{ $setting->akad_time }} WIB • Resepsi: {{ $setting->resepsi_time }} WIB</p>
        <a href="#rsvp" class="btn">Konfirmasi Kehadiran</a>
    </section>

    <section id="rsvp" class="center section-block" data-aos="fade-up" data-aos-delay="450"
        data-aos-anchor-placement="top-center">
        <h2 class="title-hand" style="font-size:2rem;">Konfirmasi Kehadiran</h2>
        <form method="POST" action="{{ route('rsvp.store') }}"
            style="margin-top:30px; max-width:450px; margin-inline:auto;">
            @csrf
            <input type="text" name="name" value="{{ $guestName }}" required
                style="padding:12px; width:100%; margin-bottom:12px;">
            <input type="tel" name="phone" placeholder="Nomor WhatsApp" required
                style="padding:12px; width:100%; margin-bottom:12px;">
            <select name="status" required style="padding:12px; width:100%; margin-bottom:12px;">
                <option value="">-- Pilih --</option>
                <option value="hadir">Hadir</option>
                <option value="tidak_hadir">Tidak Hadir</option>
            </select>
            <button class="btn">Kirim</button>
        </form>
    </section>

    @if ($setting->music_file)
        <button id="musicToggle"><svg viewBox="0 0 24 24">
                <path d="M12 3v10.55..." />
            </svg></button>
        <audio id="bgMusic" loop>
            <source src="{{ asset('storage/' . $setting->music_file) }}" type="audio/mpeg">
        </audio>
    @endif

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200,
            easing: 'ease-out-cubic',
            offset: 300, // ✅ Baru muncul ketika elemen sudah turun ke tengah layar
            once: false
        });

        const music = document.getElementById('bgMusic');
        document.addEventListener('click', () => music?.play().catch(() => {}), {
            once: true
        });
    </script>

</body>

</html>
