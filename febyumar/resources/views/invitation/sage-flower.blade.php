<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->bride_name }} & {{ $setting->groom_name }}</title>

    {{-- AOS Library --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sage: {{ $setting->theme_primary_color ?? '#C7D3C0' }};
            --silver: {{ $setting->theme_secondary_color ?? '#C0C0C0' }};
            --dark: #2F2E2C;
            --light: #D7E3D0;
            --cream: #F4EFE4;
            --text-soft: rgba(47, 46, 44, 0.8);
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 40px;
        }

        body {
            font-family: 'Tenor Sans', sans-serif;
            color: var(--dark);
            background: var(--light);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3 {
            font-family: 'Tenor Sans', sans-serif;
        }

        /* ANIMATIONS (custom, tidak niban AOS) */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.92);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* pakai prefix fx- biar gak tabrakan sama AOS */
        .fx-fade-up {
            animation: fadeUp 1.25s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .fx-zoom-in {
            animation: zoomIn 1.25s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .delay-1 {
            animation-delay: .15s;
        }

        .delay-2 {
            animation-delay: .3s;
        }

        .delay-3 {
            animation-delay: .45s;
        }

        .delay-4 {
            animation-delay: .6s;
        }

        /* DEFAULT HERO lama (kalau nanti mau dipakai lagi) */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(47, 46, 44, 0.4), rgba(47, 46, 44, 0.4)),
                url('{{ asset($setting->hero_image ?? '/images/default.jpg') }}') center/cover;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero h1 {
            font-size: 4.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            line-height: 1.1;
        }

        .hero .subtitle {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            opacity: 0.95;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .hero .divider {
            width: 60px;
            height: 2px;
            background: var(--silver);
            margin: 1.5rem auto;
            box-shadow: 0 0 10px rgba(192, 192, 192, 0.5);
        }

        .hero .guest {
            font-size: 1.5rem;
            color: var(--light);
            margin-bottom: 2rem;
            font-weight: 400;
        }

        .btn {
            background: linear-gradient(135deg, var(--silver), #d4d4d4);
            color: var(--dark);
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
            color: white;
            opacity: 0.7;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* CONTAINER & SECTION */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        section {
            padding: 80px 0;
            position: relative;
        }

        .title {
            text-align: center;
            font-size: 2.8rem;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 20px;
        }

        .title::after {
            content: '';
            width: 50px;
            height: 2px;
            background: var(--sage);
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-soft);
            font-size: 1.05rem;
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        /* COUPLE */
        .couple {
            background: white;
        }

        .couple-content {
            text-align: center;
            margin-bottom: 3rem;
        }

        .couple-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .couple-card {
            background: linear-gradient(135deg, var(--light), white);
            padding: 40px;
            border-radius: 15px;
            border: 2px solid var(--sage);
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .couple-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(199, 211, 192, 0.3);
            border-color: #a0b89b;
        }

        .couple-card .label {
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-soft);
            margin-bottom: 15px;
        }

        .couple-card h3 {
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        /* COUNTDOWN */
        .countdown {
            background: linear-gradient(135deg, white, var(--light));
        }

        .countdown-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 20px;
        }

        .countdown-item {
            background: linear-gradient(135deg, var(--sage), rgba(199, 211, 192, 0.8));
            padding: 35px 20px;
            border-radius: 15px;
            border: 2px solid var(--silver);
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        .countdown-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(199, 211, 192, 0.4);
            border-color: #95a88f;
        }

        .countdown-item .number {
            font-size: 3.2rem;
            font-weight: bold;
            color: var(--dark);
            line-height: 1;
        }

        .countdown-item .label {
            font-size: 0.9rem;
            margin-top: 12px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--dark);
        }

        /* EVENT */
        .event {
            background: white;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .event-card {
            background: linear-gradient(135deg, var(--light), white);
            padding: 45px 35px;
            border-radius: 15px;
            border: 2px solid #e0e0e0;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--sage), var(--silver));
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .event-card:hover::before {
            transform: scaleX(1);
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(199, 211, 192, 0.2);
        }

        .event-card .icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .event-card h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .event-card .date {
            font-size: 1rem;
            color: var(--text-soft);
            margin-bottom: 10px;
        }

        .event-card .time {
            font-size: 1.4rem;
            margin: 12px 0;
            font-weight: 700;
            color: var(--dark);
        }

        .event-card .location {
            font-size: 1rem;
            color: var(--text-soft);
            margin: 12px 0;
        }

        .map-link {
            display: inline-block;
            margin-top: 20px;
            color: white;
            text-decoration: none;
            background: var(--sage);
            padding: 12px 30px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .map-link:hover {
            background: #95a88f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(199, 211, 192, 0.4);
        }

        /* GALLERY */
        .gallery {
            background: linear-gradient(135deg, var(--light), white);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .gallery-item img {
            display: block;
            width: 100%;
            height: auto;
        }

        .gallery-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.12);
        }

        /* Messages list */
        .messages-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: stretch;
        }

        .message-item {
            background: white;
            padding: 16px 18px;
            border-radius: 12px;
            border: 1px solid #e9e9e9;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .message-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .message-item .meta {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: baseline;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .message-item .text {
            color: var(--dark);
            line-height: 1.5;
            white-space: pre-wrap;
            font-size: 0.98rem;
        }

        /* RSVP */
        .rsvp {
            background: linear-gradient(135deg, var(--light), var(--sage));
        }

        .rsvp-form {
            background: white;
            padding: 50px;
            border-radius: 20px;
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #e0e0e0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            background: #fafafa;
            transition: all 0.3s ease;
            color: var(--dark);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--sage);
            background: white;
            box-shadow: 0 0 0 3px rgba(199, 211, 192, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--sage), #95a88f);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(199, 211, 192, 0.3);
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        /* GIFT */
        .gift {
            background: white;
        }

        .gift-box {
            background: linear-gradient(135deg, var(--light), white);
            padding: 50px;
            border-radius: 20px;
            border: 2px solid #e0e0e0;
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .gift-box img {
            max-width: 250px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            user-select: none;
        }

        .bank-info {
            background: linear-gradient(135deg, var(--sage), rgba(199, 211, 192, 0.7));
            padding: 25px;
            border-radius: 15px;
            margin-top: 25px;
            border: 2px solid var(--silver);
            transition: all 0.3s ease;
        }

        .bank-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(199, 211, 192, 0.3);
        }

        .bank-info p {
            margin: 10px 0;
            font-weight: 600;
            color: var(--dark);
        }

        /* FOOTER */
        footer {
            background: var(--sage);
            padding: 30px 0;
            text-align: center;
            color: var(--dark);
        }

        /* MUSIC BUTTON */
        .music-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: var(--silver);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .music-toggle:hover {
            transform: scale(1.15);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .music-toggle svg {
            width: 28px;
            height: 28px;
            fill: var(--dark);
        }

        /* DOT NAVIGATION */
        .dot-nav {
            position: fixed;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 40;
            display: none;
            flex-direction: column;
            gap: 12px;
        }

        @media (min-width: 1024px) {
            .dot-nav {
                display: flex;
            }
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid var(--dark);
            opacity: 0.4;
            transition: all 0.3s ease;
            cursor: pointer;
            display: block;
        }

        .dot:hover {
            opacity: 0.7;
        }

        .dot.active {
            background: var(--sage);
            opacity: 1;
            transform: scale(1.3);
        }

        /* STORY / IMAGE */
        .story-image-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 12px;
            box-sizing: border-box;
        }

        .story-image {
            width: 100%;
            max-width: 1240px;
            height: auto;
            display: block;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 768px) {
            .story-image-wrap {
                padding: 30px 0;
            }

            .story-image {
                max-width: 100%;
                border-radius: 0;
            }
        }

        /* HERO CUSTOM (bukan full-screen) */
        #hero {
            padding: 48px 0;
            min-height: auto;
            position: relative;
            background: #949A8F;
            color: #ffffff;
            text-align: center;
        }

        /* Hero wrapper: responsive */
        .hero-wrap {
            width: 100%;
            max-width: 1240px;
            margin: 28px auto;
            display: block;
            will-change: transform, opacity;
            padding: 0 12px;
            box-sizing: border-box;
        }

        /* Hero images responsive */
        #hero .hero-img {
            display: block;
            width: 100%;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            border-radius: 0;
            box-shadow: none;
            background: transparent;
            border: none;
            overflow: visible;
        }

        @media (max-width: 768px) {
            .hero-wrap {
                width: 100%;
                max-width: none;
                margin: 18px 0;
                padding: 0;
            }

            #hero {
                padding: 18px 0;
            }

            #hero .hero-img {
                max-width: 100%;
            }
        }

        /* DEFAULT HERO lama (kalau nanti mau dipakai lagi) */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(47, 46, 44, 0.4), rgba(47, 46, 44, 0.4)),
                url('{{ asset($setting->hero_image ?? '/images/default.jpg') }}') center/cover;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero h1 {
            font-size: 4.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            line-height: 1.1;
        }

        .hero .subtitle {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            opacity: 0.95;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .hero .divider {
            width: 60px;
            height: 2px;
            background: var(--silver);
            margin: 1.5rem auto;
            box-shadow: 0 0 10px rgba(192, 192, 192, 0.5);
        }

        .hero .guest {
            font-size: 1.5rem;
            color: var(--light);
            margin-bottom: 2rem;
            font-weight: 400;
        }

        .btn {
            background: linear-gradient(135deg, var(--silver), #d4d4d4);
            color: var(--dark);
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
            color: white;
            opacity: 0.7;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* CONTAINER & SECTION */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        section {
            padding: 80px 0;
            position: relative;
        }

        .title {
            text-align: center;
            font-size: 2.8rem;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 20px;
        }

        .title::after {
            content: '';
            width: 50px;
            height: 2px;
            background: var(--sage);
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-soft);
            font-size: 1.05rem;
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        /* COUPLE */
        .couple {
            background: white;
        }

        .couple-content {
            text-align: center;
            margin-bottom: 3rem;
        }

        .couple-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .couple-card {
            background: linear-gradient(135deg, var(--light), white);
            padding: 40px;
            border-radius: 15px;
            border: 2px solid var(--sage);
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .couple-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(199, 211, 192, 0.3);
            border-color: #a0b89b;
        }

        .couple-card .label {
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-soft);
            margin-bottom: 15px;
        }

        .couple-card h3 {
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        /* COUNTDOWN */
        .countdown {
            background: linear-gradient(135deg, white, var(--light));
        }

        .countdown-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 20px;
        }

        .countdown-item {
            background: linear-gradient(135deg, var(--sage), rgba(199, 211, 192, 0.8));
            padding: 35px 20px;
            border-radius: 15px;
            border: 2px solid var(--silver);
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        .countdown-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(199, 211, 192, 0.4);
            border-color: #95a88f;
        }

        .countdown-item .number {
            font-size: 3.2rem;
            font-weight: bold;
            color: var(--dark);
            line-height: 1;
        }

        .countdown-item .label {
            font-size: 0.9rem;
            margin-top: 12px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--dark);
        }

        /* EVENT */
        .event {
            background: white;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .event-card {
            background: linear-gradient(135deg, var(--light), white);
            padding: 45px 35px;
            border-radius: 15px;
            border: 2px solid #e0e0e0;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--sage), var(--silver));
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .event-card:hover::before {
            transform: scaleX(1);
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(199, 211, 192, 0.2);
        }

        .event-card .icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .event-card h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .event-card .date {
            font-size: 1rem;
            color: var(--text-soft);
            margin-bottom: 10px;
        }

        .event-card .time {
            font-size: 1.4rem;
            margin: 12px 0;
            font-weight: 700;
            color: var(--dark);
        }

        .event-card .location {
            font-size: 1rem;
            color: var(--text-soft);
            margin: 12px 0;
        }

        .map-link {
            display: inline-block;
            margin-top: 20px;
            color: white;
            text-decoration: none;
            background: var(--sage);
            padding: 12px 30px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .map-link:hover {
            background: #95a88f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(199, 211, 192, 0.4);
        }

        /* GALLERY */
        .gallery {
            background: linear-gradient(135deg, var(--light), white);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .gallery-item img {
            display: block;
            width: 100%;
            height: auto;
        }

        .gallery-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.12);
        }

        /* Messages list */
        .messages-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: stretch;
        }

        .message-item {
            background: white;
            padding: 16px 18px;
            border-radius: 12px;
            border: 1px solid #e9e9e9;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .message-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .message-item .meta {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: baseline;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .message-item .text {
            color: var(--dark);
            line-height: 1.5;
            white-space: pre-wrap;
            font-size: 0.98rem;
        }

        /* RSVP */
        .rsvp {
            background: linear-gradient(135deg, var(--light), var(--sage));
        }

        .rsvp-form {
            background: white;
            padding: 50px;
            border-radius: 20px;
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #e0e0e0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            background: #fafafa;
            transition: all 0.3s ease;
            color: var(--dark);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--sage);
            background: white;
            box-shadow: 0 0 0 3px rgba(199, 211, 192, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--sage), #95a88f);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(199, 211, 192, 0.3);
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        /* GIFT */
        .gift {
            background: white;
        }

        .gift-box {
            background: linear-gradient(135deg, var(--light), white);
            padding: 50px;
            border-radius: 20px;
            border: 2px solid #e0e0e0;
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .gift-box img {
            max-width: 250px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            user-select: none;
        }

        .bank-info {
            background: linear-gradient(135deg, var(--sage), rgba(199, 211, 192, 0.7));
            padding: 25px;
            border-radius: 15px;
            margin-top: 25px;
            border: 2px solid var(--silver);
            transition: all 0.3s ease;
        }

        .bank-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(199, 211, 192, 0.3);
        }

        .bank-info p {
            margin: 10px 0;
            font-weight: 600;
            color: var(--dark);
        }

        /* FOOTER */
        footer {
            background: var(--sage);
            padding: 30px 0;
            text-align: center;
            color: var(--dark);
        }

        /* MUSIC BUTTON */
        .music-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: var(--silver);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .music-toggle:hover {
            transform: scale(1.15);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .music-toggle svg {
            width: 28px;
            height: 28px;
            fill: var(--dark);
        }

        /* DOT NAVIGATION */
        .dot-nav {
            position: fixed;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 40;
            display: none;
            flex-direction: column;
            gap: 12px;
        }

        @media (min-width: 1024px) {
            .dot-nav {
                display: flex;
            }
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid var(--dark);
            opacity: 0.4;
            transition: all 0.3s ease;
            cursor: pointer;
            display: block;
        }

        .dot:hover {
            opacity: 0.7;
        }

        .dot.active {
            background: var(--sage);
            opacity: 1;
            transform: scale(1.3);
        }

        /* STORY / IMAGE */
        .story-image-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 12px;
            box-sizing: border-box;
        }

        .story-image {
            width: 100%;
            max-width: 1240px;
            height: auto;
            display: block;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 768px) {
            .story-image-wrap {
                padding: 30px 0;
            }

            .story-image {
                max-width: 100%;
                border-radius: 0;
            }
        }

        /* HERO CUSTOM (bukan full-screen) */
        #hero {
            padding: 48px 0;
            min-height: auto;
            position: relative;
            background: #949A8F;
            color: #ffffff;
            text-align: center;
        }

        /* Hero wrapper: responsive */
        .hero-wrap {
            width: 100%;
            max-width: 1240px;
            margin: 28px auto;
            display: block;
            will-change: transform, opacity;
            padding: 0 12px;
            box-sizing: border-box;
        }

        /* Hero images responsive */
        #hero .hero-img {
            display: block;
            width: 100%;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            border-radius: 0;
            box-shadow: none;
            background: transparent;
            border: none;
            overflow: visible;
        }

        @media (max-width: 768px) {
            .hero-wrap {
                width: 100%;
                max-width: none;
                margin: 18px 0;
                padding: 0;
            }

            #hero {
                padding: 18px 0;
            }

            #hero .hero-img {
                max-width: 100%;
            }
        }

        /* Countdown section */
        #countdown {
            padding: 60px 0;
        }

        /* Wrapper: responsive container seperti hero-wrap */
        .countdown-wrapper {
            width: 100%;
            max-width: 1240px;
            margin: 40px auto;
            position: relative;
            display: block;
            border-radius: 12px;
            overflow: hidden;
            padding: 0 12px;
            box-sizing: border-box;
        }

        /* Gambar countdown full dalam wrapper */
        .countdown-img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: contain;
            border-radius: 12px;
        }

        /* Overlay: transparent canvas yang menutupi gambar */
        .countdown-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            pointer-events: none;
        }

        /* Card: flex layout untuk digit boxes */
        .countdown-card {
            display: flex;
            gap: 20px;
            align-items: center;
            justify-content: center;
            background: transparent;
            padding: 0;
        }

        /* Unit: grup (label + digits) */
        .countdown-card .unit {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        /* Label teks kecil */
        .unit-label {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
            text-transform: lowercase;
            font-weight: 500;
        }

        /* Container digit boxes */
        .digits {
            display: flex;
            gap: 6px;
        }

        /* Setiap digit box (putih, rounded) */
        .digit-box {
            min-width: 40px;
            height: 50px;
            background: rgba(255, 255, 255, 0.95);
            color: #2F2E2C;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .countdown-wrapper {
                width: 100%;
                max-width: none;
                margin: 30px auto;
                padding: 0;
                border-radius: 0;
            }

            .countdown-img {
                border-radius: 0;
            }

            .digit-box {
                min-width: 32px;
                height: 40px;
                font-size: 0.95rem;
            }

            .countdown-card {
                gap: 12px;
            }

            .unit-label {
                font-size: 0.7rem;
            }
        }

        /* POPUP */
        .popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            z-index: 99999;
            overflow: hidden;
        }

        .popup-box {
            background: transparent;
            width: min(92vw, 100%);
            max-width: 480px;
            border-radius: 16px;
            padding: 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            max-height: calc(100vh - 40px);
            margin: 0 auto;
        }

        .popup-img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: cover;
            vertical-align: middle;
            border-radius: 16px;
        }

        /* overlay content positioned on top of image */
        .popup-content {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 60px;
            padding: 12px 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.05) 100%);
            color: #fff;
        }

        .popup-greeting {
            font-size: 0.85rem;
            opacity: .9;
            margin: 0;
        }

        .popup-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
        }

        .popup-btn {
            background: #ffffff;
            color: #2F2E2C;
            width: calc(100% - 24px);
            max-width: 280px;
            padding: 10px 14px;
            border-radius: 999px;
            border: none;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.18);
        }

        @media (max-width: 520px) {
            .popup-box {
                max-height: calc(100vh - 40px);
                border-radius: 12px;
                width: 100%;
            }

            .popup-img {
                border-radius: 12px;
            }

            .popup-content {
                padding: 10px 12px;
                bottom: 50px;
            }

            .popup-name {
                font-size: 1.05rem;
            }

            .popup-btn {
                width: calc(100% - 20px);
                padding: 8px 12px;
                font-size: 0.9rem;
            }
        }

        /* PRELOADER */
        .preloader-overlay {
            position: fixed;
            inset: 0;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 999999;
            transition: opacity .45s ease, visibility .45s ease;
        }

        .preloader-overlay.fade-out {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .preloader-bar {
            width: 60%;
            min-width: 200px;
            max-width: 420px;
            height: 12px;
            background: #eee;
            border-radius: 999px;
            overflow: hidden;
            margin-top: 18px;
        }

        .preloader-bar>i {
            display: block;
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #949A8F, #C7D3C0);
            transition: width .2s linear;
        }

        .preloader-percent {
            margin-top: 12px;
            color: #666;
            font-weight: 600;
        }

        @media (max-width: 520px) {
            .preloader-overlay {
                padding: 16px;
            }

            .preloader-bar {
                width: 80%;
                min-width: 160px;
            }
        }
    </style>
</head>

<body>

    <!-- POPUP OPENING -->
    <div id="openingPopup" class="popup-overlay" style="display:none;">
        <div class="popup-box">
            <img src="{{ asset('/images/flower/popup.webp') }}" class="popup-img" alt="Popup Image">

            <div class="popup-content" aria-hidden="false">
                <p class="popup-greeting">Kepada Yth.</p>
                <p class="popup-name">{{ $guestName }}</p>
                <button class="popup-btn" id="openInvitationBtn" aria-label="Buka Undangan">Buka Undangan</button>
            </div>
        </div>
    </div>

    <!-- PRELOADER -->
    <div id="preloader" class="preloader-overlay" aria-hidden="true">
        <img src="{{ asset('/images/flower/popup.webp') }}" alt=""
            style="width:140px;height:auto;opacity:.98;filter:grayscale(.05);">
        <div class="preloader-bar" aria-hidden="true"><i id="preloaderBar"></i></div>
        <div class="preloader-percent" id="preloaderPercent">0%</div>
    </div>

    {{-- Dot Navigation --}}
    <nav class="dot-nav">
        <a href="#couple" class="dot active" data-section="couple"></a>
        <a href="#hero" class="dot" data-section="hero"></a>
        <a href="#events" class="dot" data-section="events"></a>
        <a href="#countdown" class="dot" data-section="countdown"></a>
        <a href="#gallery" class="dot" data-section="gallery"></a>
        <a href="#rsvp" class="dot" data-section="rsvp"></a>
        @if ($setting->qris_image || $setting->bank_name)
            <a href="#gift" class="dot" data-section="gift"></a>
        @endif
    </nav>

    {{-- COUPLE --}}
    <section id="couple" class="couple">
        <div class="container">
            <div class="story-image-wrap" data-aos="fade-up">
                <img src="{{ asset('images/flower/verse.webp') }}" alt="Verse" loading="lazy" class="hero-img">
            </div>
        </div>
    </section>

    {{-- HERO --}}
    <section id="hero">
        <div class="hero-wrap" data-aos="fade-right" data-aos-delay="200">
            <img src="{{ asset('images/flower/bride.webp') }}" alt="Bride" loading="lazy" class="hero-img">
        </div>

        <div class="hero-wrap" data-aos="fade-left" data-aos-delay="700">
            <img src="{{ asset('images/flower/groom.webp') }}" alt="Groom" loading="lazy" class="hero-img">
        </div>
    </section>

    {{-- COUNTDOWN --}}
    <section id="countdown" class="countdown">

        <!-- Countdown wrapper: gambar + overlay digit boxes -->
        <div class="countdown-wrapper" data-aos="zoom-in" data-aos-delay="120">
            <!-- Background image (countdown.webp) -->
            <img src="{{ asset('images/flower/countdown.webp') }}" alt="Countdown background" class="countdown-img"
                loading="lazy" />

            <!-- Overlay: digit boxes positioned on top of image (menutupi countdown statis di gambar) -->
            <div class="countdown-overlay">
                <div class="countdown-card" id="countdownCard" role="group" aria-label="Countdown">
                    <div class="unit" data-unit="days">
                        <div class="unit-label">days</div>
                        <div class="digits" id="overlay_days"></div>
                    </div>
                    <div class="unit" data-unit="hours">
                        <div class="unit-label">hours</div>
                        <div class="digits" id="overlay_hours"></div>
                    </div>
                    <div class="unit" data-unit="minutes">
                        <div class="unit-label">minutes</div>
                        <div class="digits" id="overlay_minutes"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- EVENTS --}}
    <section id="events" class="event">
        <div class="container">
            <h2 class="title" data-aos="fade-up">Acara Pernikahan</h2>

            <div class="event-grid">

                <!-- AKAD -->
                <div class="event-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon">💍</div>
                    <h3>Akad Nikah</h3>

                    <p class="date">
                        {{ \Carbon\Carbon::parse($setting->wedding_date)->translatedFormat('l, d F Y') }}
                    </p>

                    <p class="time">08.00 – 10.00 WIB</p>

                    <p class="location">
                        <strong>{{ $setting->akad_location ?? 'Lokasi belum diisi' }}</strong>
                    </p>

                    <p class="location">{{ $setting->akad_address ?? '' }}</p>

                    @if ($setting->akad_map_link)
                        <a href="{{ $setting->akad_map_link }}" target="_blank" class="map-link">📍 Buka Lokasi</a>
                    @endif
                </div>

                <!-- RESEPSI -->
                <div class="event-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon">🎉</div>
                    <h3>Resepsi</h3>

                    <p class="date">
                        {{ \Carbon\Carbon::parse($setting->wedding_date)->translatedFormat('l, d F Y') }}
                    </p>

                    <p class="time">11.00 – 13.00 WIB</p>

                    <p class="location">
                        <strong>{{ $setting->resepsi_location ?? 'Lokasi belum diisi' }}</strong>
                    </p>

                    <p class="location">{{ $setting->resepsi_address ?? '' }}</p>

                    @if ($setting->resepsi_map_link)
                        <a href="{{ $setting->resepsi_map_link }}" target="_blank" class="map-link">📍 Buka
                            Lokasi</a>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section id="gallery" class="gallery">
        <div class="container">
            <h2 class="title" data-aos="fade-up">Galeri</h2>
            <div class="gallery-grid">
                <div class="gallery-item fx-zoom-in" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://via.placeholder.com/400x300/C7D3C0/2F2E2C?text=Foto+1" alt="Galeri 1"
                        loading="lazy">
                </div>
                <div class="gallery-item fx-zoom-in" data-aos="fade-up" data-aos-delay="150">
                    <img src="https://via.placeholder.com/400x300/C0C0C0/2F2E2C?text=Foto+2" alt="Galeri 2"
                        loading="lazy">
                </div>
                <div class="gallery-item fx-zoom-in" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://via.placeholder.com/400x300/C7D3C0/2F2E2C?text=Foto+3" alt="Galeri 3"
                        loading="lazy">
                </div>
                <div class="gallery-item fx-zoom-in" data-aos="fade-up" data-aos-delay="250">
                    <img src="https://via.placeholder.com/400x300/C0C0C0/2F2E2C?text=Foto+4" alt="Galeri 4"
                        loading="lazy">
                </div>
            </div>
        </div>
    </section>

    {{-- RSVP --}}
    <section id="rsvp" class="rsvp">
        <div class="container">
            <h2 class="title" data-aos="fade-up">Konfirmasi Kehadiran</h2>

            <form id="rsvpForm" class="rsvp-form" data-aos="fade-up" data-aos-delay="100">
                @csrf
                <div id="rsvpAlert"></div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="fm_name" value="{{ $guestName }}" required>
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
    </section>

    {{-- SECTION: Ucapan & Doa (AJAX loaded) --}}
    <section id="messages" class="couple">
        <div class="container">
            <h2 class="title" data-aos="fade-up">Ucapan & Doa</h2>
            <div id="messagesList" class="messages-list" data-aos="fade-up">
                <!-- pesan akan di-inject lewat JS -->
            </div>
        </div>
    </section>

    {{-- GIFT --}}
    @if ($setting->qris_image || $setting->bank_name)
        <section id="gift" class="gift">
            <div class="container">
                <h2 class="title" data-aos="fade-up">Amplop Digital</h2>
                <div class="gift-box" data-aos="fade-up" data-aos-delay="100">
                    @if ($setting->qris_image)
                        <img src="{{ asset('storage/' . $setting->qris_image) }}" alt="QRIS">
                    @endif

                    @if ($setting->bank_name)
                        <div class="bank-info">
                            <p style="font-size: 0.9rem; color: var(--dark); font-weight: normal;">Rekening Bank</p>
                            <p style="font-size: 1.2rem; margin-top: 8px;">{{ $setting->bank_name }}</p>
                            <p style="font-size: 1.1rem; letter-spacing: 0.05em; margin-top: 10px;">
                                {{ $setting->bank_account_number }}</p>
                            <p style="font-size: 0.95rem; margin-top: 8px;">a.n. {{ $setting->bank_account_name }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <p>© 2025 {{ $setting->bride_name }} & {{ $setting->groom_name }}</p>
            <p style="margin-top: 8px; font-size: 0.9rem; opacity: 0.8;">Terima kasih atas doa dan restunya</p>
        </div>
    </footer>

    {{-- MUSIC BUTTON --}}
    <!-- Manual music: letakkan file di public/audio/manual-song.mp3 -->
    <button id="musicToggle" class="music-toggle" title="Putar Musik">
        <svg viewBox="0 0 24 24">
            <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z" />
        </svg>
    </button>
    <audio id="bgMusic" preload="auto" loop>
        <source src="{{ asset('audio/manual-song.mp3') }}" type="audio/mpeg">
        <!-- fallback text -->
        Your browser does not support the audio element.
    </audio>

    {{-- AOS Library --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    @php
        $date = $setting->wedding_date ? \Carbon\Carbon::parse($setting->wedding_date)->format('Y-m-d') : null;
        $time = $setting->resepsi_time ?? ($setting->akad_time ?? '00:00:00');
        $targetTimestamp = null;

        if ($date) {
            $targetTimestamp =
                \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', "$date $time", 'Asia/Jakarta')->timestamp * 1000;
        }
    @endphp

    <script>
        // ===== AJAX: load & submit ucapan/doa =====
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
                if (!res.ok) {
                    throw new Error('Fetch failed');
                }

                let items = [];
                if (Array.isArray(data)) {
                    items = data;
                } else if (data && Array.isArray(data.rows)) {
                    items = data.rows;
                } else if (data && Array.isArray(data.data)) {
                    items = data.data;
                }

                items = items.filter(m => m).slice(0, 10);

                const container = document.getElementById('messagesList');
                if (!container) return;

                container.innerHTML = '';

                if (!items.length) {
                    container.innerHTML = '<p style="opacity:.7">Belum ada ucapan. Jadilah yang pertama ✨</p>';
                    return;
                }

                items.forEach(msg => {
                    const el = document.createElement('div');
                    el.className = 'message-item';
                    const messageText = (msg.message && String(msg.message).trim() !== '') ?
                        escapeHtml(msg.message) :
                        '— Belum menulis ucapan —';
                    el.innerHTML = `
                        <div class="meta">
                            <div>${escapeHtml(msg.name || 'Tamu')}</div>
                            <div style="opacity:.75;font-weight:600;font-size:.92rem">${escapeHtml(msg.status || '')}</div>
                        </div>
                        <div class="text">${messageText}</div>
                        <div style="margin-top:10px;font-size:0.82rem;color:#777">
                            ${msg.created_at ? new Date(msg.created_at).toLocaleString() : ''}
                        </div>
                    `;
                    container.appendChild(el);
                });
            } catch (e) {
                console.error('fetchMessages error', e);
                const container = document.getElementById('messagesList');
                if (container) {
                    container.innerHTML = '<p style="opacity:.7">Gagal memuat ucapan. Coba refresh lagi.</p>';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // AOS init
            AOS.init({
                once: false,
                duration: 1400,
                offset: 80,
                easing: 'ease-out-cubic',
                delay: 100
            });

            // load ucapan
            fetchMessages();

            // handle submit RSVP
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
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');
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

                        if (!res.ok) {
                            throw new Error('Request failed');
                        }

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

        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('contextmenu', (e) => e.preventDefault());
            img.style.userSelect = 'none';
            img.style.webkitUserSelect = 'none';
        });

        // DOT NAVIGATION (pakai data-section supaya gak mismatch)
        const dots = document.querySelectorAll('.dot-nav .dot');
        const dotSections = Array.from(dots).map(dot => dot.dataset.section);

        function setActiveDot() {
            let top = window.scrollY + window.innerHeight * 0.35;
            let activeIndex = 0;

            dotSections.forEach((id, i) => {
                const el = document.getElementById(id);
                if (el && el.offsetTop <= top) {
                    activeIndex = i;
                }
            });

            dots.forEach((d, i) => {
                d.classList.toggle('active', i === activeIndex);
            });
        }

        window.addEventListener('scroll', setActiveDot);
        setActiveDot();

        dots.forEach((dot, index) => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                const sectionId = dot.dataset.section;
                const section = document.getElementById(sectionId);
                if (section) {
                    section.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // COUNTDOWN
        const weddingTimestamp = {{ $targetTimestamp ?? 'null' }};

        function updateCountdown() {
            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');

            if (!weddingTimestamp || isNaN(weddingTimestamp)) {
                [daysEl, hoursEl, minutesEl, secondsEl].forEach(el => el && (el.innerText = '--'));
                return;
            }

            const now = Date.now();
            const distance = weddingTimestamp - now;

            if (distance <= 0) {
                [daysEl, hoursEl, minutesEl, secondsEl].forEach(el => el && (el.innerText = '00'));
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (daysEl) daysEl.innerText = String(days).padStart(2, '0');
            if (hoursEl) hoursEl.innerText = String(hours).padStart(2, '0');
            if (minutesEl) minutesEl.innerText = String(minutes).padStart(2, '0');
            if (secondsEl) secondsEl.innerText = String(seconds).padStart(2, '0');
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        // MUSIC CONTROL
        const bgMusic = document.getElementById('bgMusic');
        const musicToggle = document.getElementById('musicToggle');

        if (bgMusic && musicToggle) {
            musicToggle.addEventListener('click', () => {
                if (bgMusic.paused) {
                    bgMusic.play().catch(err => console.log('Play error:', err));
                } else {
                    bgMusic.pause();
                }
            });

            document.addEventListener('click', () => {
                if (bgMusic.paused) {
                    bgMusic.play().catch(err => console.log('Auto-play error:', err));
                }
            }, {
                once: true
            });
        }

        // SMOOTH SCROLL untuk anchor biasa
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const href = a.getAttribute('href');
                if (href !== '#' && document.querySelector(href)) {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // POPUP & PRELOADER
        document.body.style.overflow = "hidden";

        const openingPopup = document.getElementById('openingPopup');
        const openBtn = document.getElementById('openInvitationBtn');
        const popupBox = document.querySelector('.popup-box');

        if (popupBox) {
            popupBox.addEventListener('wheel', function(e) {
                const delta = e.deltaY;
                const atTop = this.scrollTop === 0 && delta < 0;
                const atBottom = Math.ceil(this.scrollTop + this.clientHeight) >= this.scrollHeight && delta > 0;
                if (atTop || atBottom) {
                    e.preventDefault();
                }
            }, {
                passive: false
            });
        }

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                if (openingPopup) {
                    openingPopup.style.opacity = "0";
                    openingPopup.style.pointerEvents = "none";
                }
                document.body.style.overflow = "auto";
            });
        }

        const preloader = document.getElementById('preloader');
        const preloaderBar = document.getElementById('preloaderBar');
        const preloaderPercent = document.getElementById('preloaderPercent');

        function showPreloader(duration = 2000) {
            preloader.style.display = 'flex';
            preloader.style.opacity = '1';

            preloaderBar.animate([{
                    width: '0%'
                },
                {
                    width: '100%'
                }
            ], {
                duration: duration,
                easing: 'linear',
                fill: 'forwards'
            });

            let startTime = performance.now();

            function updatePercent() {
                const elapsed = performance.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                preloaderPercent.innerText = Math.round(progress * 100) + '%';

                if (progress < 1) {
                    requestAnimationFrame(updatePercent);
                }
            }
            requestAnimationFrame(updatePercent);

            setTimeout(() => {
                preloader.style.opacity = '0';

                if (openingPopup) {
                    openingPopup.style.display = 'flex';
                    openingPopup.style.opacity = '1';
                    openingPopup.style.pointerEvents = 'auto';
                }
                document.body.style.overflow = 'hidden';

                setTimeout(() => {
                    preloader.style.display = 'none';
                    // penting: refresh AOS setelah layout stabil
                    AOS.refresh();
                }, 600);
            }, duration);
        }

        window.addEventListener('load', () => {
            showPreloader(2500);
        });

        // Improved auto-pause / auto-resume on tab visibility change (best-effort — browsers may block resume)
        (function() {
            const bgMusic = document.getElementById('bgMusic');
            const musicToggle = document.getElementById('musicToggle');
            if (!bgMusic || !musicToggle) return;

            let wasPlayingBeforeHide = false; // remember if music was playing when tab hidden

            function updateToggleUI(isPlaying) {
                musicToggle.classList.toggle('is-playing', !!isPlaying);
                musicToggle.title = isPlaying ? 'Pause Musik' : 'Putar Musik';
            }

            // click toggles play/pause
            musicToggle.addEventListener('click', async () => {
                try {
                    if (bgMusic.paused) {
                        await bgMusic.play();
                        updateToggleUI(true);
                    } else {
                        bgMusic.pause();
                        updateToggleUI(false);
                    }
                } catch (err) {
                    console.warn('Audio play prevented:', err);
                }
            });

            // pause when tab hidden, remember state
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    wasPlayingBeforeHide = !bgMusic.paused;
                    if (!bgMusic.paused) {
                        try {
                            bgMusic.pause();
                        } catch (e) {
                            /*ignore*/ }
                        updateToggleUI(false);
                    }
                } else {
                    // when tab becomes visible again — try to resume if it was playing before
                    if (wasPlayingBeforeHide) {
                        bgMusic.play().then(() => {
                            updateToggleUI(true);
                        }).catch(err => {
                            // resume blocked by browser autoplay policy — keep UI consistent
                            console.warn('Resume play blocked:', err);
                            updateToggleUI(false);
                        });
                    }
                    wasPlayingBeforeHide = false;
                }
            });

            // also pause on pagehide/unload
            window.addEventListener('pagehide', () => {
                if (!bgMusic.paused) {
                    try {
                        bgMusic.pause();
                    } catch (e) {}
                    updateToggleUI(false);
                }
            });

            // initial UI state
            updateToggleUI(!bgMusic.paused);
        })();
    </script>

</body>

</html>
