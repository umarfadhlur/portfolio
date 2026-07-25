<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Locale yang diizinkan.
     */
    const ALLOWED_LOCALES = ['en', 'ja', 'ko', 'zh', 'ar'];

    public function handle(Request $request, Closure $next)
    {
        // Skip session write untuk Livewire AJAX requests
        if ($request->hasHeader('X-Livewire')) {
            // Tetap set locale dari session yang sudah ada
            $locale = Session::get('locale', 'en');
            App::setLocale($locale);

            return $next($request);
        }

        // 1. Ambil locale dari: session → URL param → browser → default 'en'
        $locale = $this->resolveLocale($request);

        // 2. Simpan ke session
        Session::put('locale', $locale);

        // 3. Set ke Laravel App
        App::setLocale($locale);

        return $next($request);
    }

    private function resolveLocale(Request $request): string
    {
        // Prioritas 1: URL query param ?lang=ja
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (in_array($lang, self::ALLOWED_LOCALES)) {
                return $lang;
            }
        }

        // Prioritas 2: Session yang sudah tersimpan
        if (Session::has('locale')) {
            $sessionLocale = Session::get('locale');
            if (in_array($sessionLocale, self::ALLOWED_LOCALES)) {
                return $sessionLocale;
            }
        }

        // Prioritas 3: Browser Accept-Language header
        $browserLocale = substr($request->getPreferredLanguage(self::ALLOWED_LOCALES) ?? 'en', 0, 2);
        if (in_array($browserLocale, self::ALLOWED_LOCALES)) {
            return $browserLocale;
        }

        // Default
        return 'en';
    }
}
