<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan {{ $setting->bride_name }} & {{ $setting->groom_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        :root {
            --sage: {{ $setting->primary_color ?? '#C7D3C0' }};
            --gold: {{ $setting->accent_color ?? '#C6A34F' }};
            --dark-sage: #2F2E2C;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark-sage);
            background-color: #fafbf9;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            color: var(--dark-sage);
        }

        .sage-bg {
            background-color: var(--sage);
        }

        .gold-text {
            color: var(--gold);
        }

        .gold-border {
            border-color: var(--gold);
        }

        .gold-bg {
            background-color: var(--gold);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            background: linear-gradient(135deg, rgba(199, 211, 192, 0.4) 0%, rgba(198, 163, 79, 0.1) 100%),
                        url('{{ asset("storage/" . $setting->hero_image) }}') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-sage);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(199, 211, 192, 0.2), rgba(47, 46, 44, 0.3));
            z-index: 1;
        }

        .hero-content {
            text-align: center;
            z-index: 2;
            padding: 20px;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            letter-spacing: 2px;
        }

        .hero-content .subtitle {
            font-size: 1.5rem;
            margin-bottom: 40px;
            color: var(--gold);
            font-weight: 300;
        }

        .hero-btn {
            display: inline-block;
            padding: 14px 40px;
            background-color: var(--gold);
            color: var(--dark-sage);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(198, 163, 79, 0.2);
        }

        .hero-btn:hover {
            background-color: var(--dark-sage);
            color: var(--gold);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(198, 163, 79, 0.3);
        }

        /* Countdown Section */
        .countdown-section {
            background: linear-gradient(to bottom, #fafbf9, var(--sage));
            padding: 80px 20px;
            text-align: center;
        }

        .countdown-section h2 {
            font-size: 3rem;
            margin-bottom: 50px;
            color: var(--dark-sage);
        }

        .countdown-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .countdown-item {
            background: white;
            padding: 30px 20px;
            border-radius: 10px;
            border: 2px solid var(--gold);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .countdown-item .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gold);
            font-family: 'Playfair Display', serif;
        }

        .countdown-item .label {
            font-size: 0.9rem;
            color: var(--dark-sage);
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Event Section */
        .event-section {
            padding: 80px 20px;
            background-color: white;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 50px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .event-card {
            text-align: center;
            padding: 40px 30px;
            background: linear-gradient(135deg, rgba(199, 211, 192, 0.1) 0%, rgba(198, 163, 79, 0.05) 100%);
            border: 1px solid var(--sage);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(199, 211, 192, 0.2);
        }

        .event-card h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--gold);
        }

        .event-card p {
            font-size: 1.1rem;
            margin: 15px 0;
            line-height: 1.8;
            color: var(--dark-sage);
        }

        .event-card a {
            display: inline-block;
            margin-top: 20px;
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
            border-bottom: 2px solid var(--gold);
            transition: all 0.3s ease;
        }

        .event-card a:hover {
            padding-bottom: 5px;
        }

        /* Gallery Section */
        .gallery-section {
            padding: 80px 20px;
            background: linear-gradient(135deg, rgba(199, 211, 192, 0.08) 0%, rgba(199, 211, 192, 0.04) 100%);
        }

        .gallery-section h2 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 50px;
            color: var(--dark-sage);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            aspect-ratio: 1;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* RSVP Section */
        .rsvp-section {
            padding: 80px 20px;
            background: white;
        }

        .rsvp-container {
            max-width: 600px;
            margin: 0 auto;
            background: linear-gradient(135deg, rgba(199, 211, 192, 0.1) 0%, rgba(198, 163, 79, 0.05) 100%);
            padding: 50px;
            border-radius: 15px;
            border: 2px solid var(--sage);
        }

        .rsvp-container h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: var(--dark-sage);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-sage);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--sage);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: white;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--gold);
            background-color: rgba(198, 163, 79, 0.05);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .radio-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .radio-item {
            display: flex;
            align-items: center;
        }

        .radio-item input[type="radio"] {
            width: auto;
            margin-right: 10px;
            accent-color: var(--gold);
            cursor: pointer;
        }

        .radio-item label {
            margin: 0;
            font-weight: 400;
            cursor: pointer;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: var(--gold);
            color: var(--dark-sage);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background-color: var(--dark-sage);
            color: var(--gold);
            transform: translateY(-3px);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Gift Section */
        .gift-section {
            padding: 80px 20px;
            background: linear-gradient(135deg, rgba(199, 211, 192, 0.08) 0%, rgba(199, 211, 192, 0.04) 100%);
        }

        .gift-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .gift-container h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: var(--dark-sage);
        }

        .gift-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            border: 2px solid var(--gold);
            box-shadow: 0 10px 30px rgba(198, 163, 79, 0.15);
        }

        .gift-option {
            margin-bottom: 30px;
        }

        .gift-option h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--gold);
        }

        .qris-image {
            max-width: 300px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .bank-details {
            background: var(--sage);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .bank-details p {
            margin: 10px 0;
            font-size: 1.05rem;
        }

        .bank-account-number {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--gold);
            font-family: 'Courier New', monospace;
        }

        /* Music Button */
        .music-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: var(--gold);
            color: var(--dark-sage);
            border: none;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(198, 163, 79, 0.3);
            transition: all 0.3s ease;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .music-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 15px 40px rgba(198, 163, 79, 0.4);
        }

        .music-btn.playing {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 10px 30px rgba(198, 163, 79, 0.3);
            }
            50% {
                box-shadow: 0 10px 50px rgba(198, 163, 79, 0.6);
            }
        }

        /* Footer */
        .footer {
            background-color: var(--dark-sage);
            color: var(--sage);
            padding: 40px 20px;
            text-align: center;
            font-weight: 300;
            font-size: 0.95rem;
        }

        .footer p {
            margin: 10px 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content .subtitle {
                font-size: 1.2rem;
            }

            .countdown-section h2,
            .gallery-section h2,
            .rsvp-container h2,
            .gift-container h2 {
                font-size: 2rem;
            }

            .rsvp-container {
                padding: 30px 20px;
            }

            .music-btn {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 30px;
            right: 30px;
            padding: 16px 24px;
            background-color: var(--gold);
            color: var(--dark-sage);
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(0, 0, 0, 0.1);
            border-top: 3px solid var(--dark-sage);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Audio Element -->
    <audio id="backgroundMusic" loop>
        @if($setting->music_file)
            <source src="{{ asset('storage/' . $setting->music_file) }}" type="audio/mpeg">
        @endif
    </audio>

    <!-- Music Control Button -->
    <button class="music-btn" id="musicBtn">
        <i class="fas fa-volume-up"></i>
    </button>

    <!-- Hero Section -->
    <section class="hero" data-aos="fade">
        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
            <h1>{{ $setting->bride_name }} & {{ $setting->groom_name }}</h1>
            <p class="subtitle">Undangan Pernikahan</p>
            <a href="#event" class="hero-btn">Lihat Detail</a>
        </div>
    </section>

    <!-- Guest Name Display -->
    <div style="text-align: center; padding: 20px; background: var(--sage); color: var(--dark-sage); font-size: 1.1rem;">
        <span>Kepada: <strong>{{ $guestName }}</strong></span>
    </div>

    <!-- Countdown Section -->
    <section class="countdown-section" data-aos="fade-up">
        <h2>Acara Berlangsung Dalam</h2>
        <div class="countdown-container" id="countdown">
            <div class="countdown-item" data-aos="fade-up" data-aos-delay="100">
                <div class="number" id="days">0</div>
                <div class="label">Hari</div>
            </div>
            <div class="countdown-item" data-aos="fade-up" data-aos-delay="200">
                <div class="number" id="hours">0</div>
                <div class="label">Jam</div>
            </div>
            <div class="countdown-item" data-aos="fade-up" data-aos-delay="300">
                <div class="number" id="minutes">0</div>
                <div class="label">Menit</div>
            </div>
            <div class="countdown-item" data-aos="fade-up" data-aos-delay="400">
                <div class="number" id="seconds">0</div>
                <div class="label">Detik</div>
            </div>
        </div>
    </section>

    <!-- Event Section -->
    <section class="event-section" id="event" data-aos="fade-up">
        <div class="event-grid">
            <div class="event-card" data-aos="fade-up" data-aos-delay="100">
                <h3>Akad Nikah</h3>
                <p>{{ \Carbon\Carbon::parse($setting->event_date)->translatedFormat('l, d F Y') }}</p>
                <p>{{ $setting->event_time }}</p>
                <p>{{ $setting->ceremony_location }}</p>
                <p style="font-size: 0.95rem; color: #888;">{{ $setting->ceremony_address }}</p>
                @if($setting->map_link)
                    <a href="{{ $setting->map_link }}" target="_blank">
                        <i class="fas fa-map-marker-alt"></i> Lihat Lokasi
                    </a>
                @endif
            </div>
            <div class="event-card" data-aos="fade-up" data-aos-delay="200">
                <h3>Resepsi</h3>
                <p>{{ \Carbon\Carbon::parse($setting->event_date)->translatedFormat('l, d F Y') }}</p>
                <p>{{ $setting->event_time }}</p>
                <p>{{ $setting->reception_location }}</p>
                <p style="font-size: 0.95rem; color: #888;">{{ $setting->reception_address }}</p>
                @if($setting->map_link)
                    <a href="{{ $setting->map_link }}" target="_blank">
                        <i class="fas fa-map-marker-alt"></i> Lihat Lokasi
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    @if($setting->hero_image)
    <section class="gallery-section" data-aos="fade-up">
        <h2>Galeri Foto</h2>
        <div class="gallery-grid">
            <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('storage/' . $setting->hero_image) }}" alt="Foto Prewedding">
            </div>
            <div class="gallery-item" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('storage/' . $setting->hero_image) }}" alt="Foto Prewedding">
            </div>
            <div class="gallery-item" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $setting->hero_image) }}" alt="Foto Prewedding">
            </div>
        </div>
    </section>
    @endif

    <!-- RSVP Section -->
    <section class="rsvp-section" data-aos="fade-up">
        <div class="rsvp-container">
            <h2>Konfirmasi Kehadiran</h2>
            <form id="rsvpForm">
                @csrf
                <input type="hidden" name="guest_id" value="{{ $guest->id }}">

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ $guestName }}" readonly>
                </div>

                <div class="form-group">
                    <label>Status Kehadiran</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="hadir" name="status" value="hadir" required>
                            <label for="hadir">Hadir</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="tidak_hadir" name="status" value="tidak_hadir">
                            <label for="tidak_hadir">Tidak Hadir</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="belum_tahu" name="status" value="belum_tahu">
                            <label for="belum_tahu">Belum Tahu</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="number_of_guests">Jumlah Tamu</label>
                    <select id="number_of_guests" name="number_of_guests" required>
                        <option value="">-- Pilih Jumlah --</option>
                        <option value="1">1 Orang</option>
                        <option value="2">2 Orang</option>
                        <option value="3">3 Orang</option>
                        <option value="4">4 Orang</option>
                        <option value="5">5 Orang</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Ucapan & Doa</label>
                    <textarea id="message" name="message" placeholder="Tulis ucapan atau doa untuk pengantin..."></textarea>
                </div>

                <div class="form-group">
                    <label for="dietary_restriction">Pantangan Makanan (Opsional)</label>
                    <input type="text" id="dietary_restriction" name="dietary_restriction" placeholder="Contoh: Vegetarian, Alergi seafood">
                </div>

                <button type="submit" class="submit-btn">
                    <span class="loading" id="loading"></span>
                    Kirim RSVP
                </button>
            </form>
        </div>
    </section>

    <!-- Gift Section -->
    <section class="gift-section" data-aos="fade-up">
        <div class="gift-container">
            <h2>Hadiah & Amplop</h2>
            <div class="gift-content">
                @if($setting->qris_image)
                <div class="gift-option">
                    <h4>QRIS</h4>
                    <img src="{{ asset('storage/' . $setting->qris_image) }}" alt="QRIS Code" class="qris-image">
                </div>
                @endif

                @if($setting->bank_account && $setting->bank_name)
                <div class="gift-option">
                    <h4>{{ $setting->bank_name }}</h4>
                    <div class="bank-details">
                        <p>Atas Nama:</p>
                        <p class="bank-account-number">{{ $setting->bank_account }}</p>
                        @if($setting->bank_details)
                            <p style="margin-top: 15px; font-size: 0.95rem;">{{ $setting->bank_details }}</p>
                        @endif
                    </div>
                </div>
                @endif

                <p style="margin-top: 30px; font-size: 0.95rem; color: #888;">
                    <em>Mohon maaf tidak bisa menerima hadiah fisik, ucapan dan doa dari Anda sudah cukup membahagiakan hati kami.</em>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" data-aos="fade-up">
        <p>{{ $setting->bride_name }} & {{ $setting->groom_name }}</p>
        <p>{{ \Carbon\Carbon::parse($setting->event_date)->translatedFormat('d F Y') }}</p>
        <p style="margin-top: 20px; font-size: 0.85rem; opacity: 0.8;">Terima kasih telah menjadi bagian dari kebahagiaan kami</p>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: false,
            offset: 100,
        });

        // Countdown Timer
        function updateCountdown() {
            const eventDate = new Date('{{ $setting->event_date->format("Y-m-d") }}').getTime();
            const now = new Date().getTime();
            const distance = eventDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

            if (distance < 0) {
                document.getElementById('countdown').innerHTML = '<p style="font-size: 2rem; color: var(--gold);">Terima kasih telah hadir!</p>';
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        // Music Control
        const audio = document.getElementById('backgroundMusic');
        const musicBtn = document.getElementById('musicBtn');
        let isPlaying = false;

        musicBtn.addEventListener('click', () => {
            if (isPlaying) {
                audio.pause();
                musicBtn.classList.remove('playing');
                isPlaying = false;
            } else {
                audio.play();
                musicBtn.classList.add('playing');
                isPlaying = true;
            }
        });

        // RSVP Form Submit
        document.getElementById('rsvpForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.querySelector('.submit-btn');
            const loading = document.getElementById('loading');
            submitBtn.disabled = true;
            loading.style.display = 'inline-block';

            try {
                const response = await fetch('{{ route("rsvp.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                    },
                    body: JSON.stringify(new FormData(e.target)),
                });

                const data = await response.json();

                if (data.success) {
                    showToast(data.message, 'success');
                    document.getElementById('rsvpForm').reset();
                } else {
                    showToast('Terjadi kesalahan, silakan coba lagi', 'error');
                }
            } catch (error) {
                showToast('Terjadi kesalahan jaringan', 'error');
            } finally {
                submitBtn.disabled = false;
                loading.style.display = 'none';
            }
        });

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Auto-play with user interaction first
        document.addEventListener('click', () => {
            if (!isPlaying && audio.paused) {
                audio.play();
                musicBtn.classList.add('playing');
                isPlaying = true;
            }
        }, { once: true });
    </script>
</body>
</html>
