<?php

namespace App\Services;

use App\Models\Translation;
use DeepL\Translator;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    /**
     * Bahasa yang didukung.
     * Key  = kode locale app
     * Value = kode DeepL target language
     */
    const SUPPORTED_LOCALES = [
        'en' => 'EN-US',
        'ja' => 'JA',
        'ko' => 'KO',
        'zh' => 'ZH',
        'ar' => 'AR',
    ];

    /**
     * Locale sumber (konten asli website dalam Bahasa Indonesia atau Inggris).
     * Ganti ke 'ID' jika konten asli dalam Bahasa Indonesia.
     */
    const SOURCE_LOCALE = 'EN';

    private ?Translator $deepl = null;

    public function __construct()
    {
        $apiKey = config('services.deepl.api_key');

        if ($apiKey) {
            $this->deepl = new Translator($apiKey);
        }
    }

    /**
     * Terjemahkan teks ke locale tertentu.
     * Cek cache DB dulu — jika belum ada, panggil DeepL lalu simpan.
     *
     * @param string $text   Teks asli (sumber)
     * @param string $locale Target locale (en, ja, ko, zh, ar)
     * @param string $group  Grup untuk pengelompokan (products, pages, ui)
     * @param string $key    Key unik untuk teks ini
     * @return string        Teks terjemahan (atau teks asli jika gagal)
     */
    public function translate(?string $text, string $locale, string $group, string $key): string
    {

        if ($text === null || $text === '') {
            return '';
        }

        // Jika locale = sumber atau teks kosong, kembalikan asli
        if (empty($text) || $locale === 'en') {
            return $text;
        }

        // 1. Cek cache database
        $cached = Translation::get($locale, $group, $key);
        if ($cached !== null) {
            return $cached;
        }

        // 2. Terjemahkan via DeepL
        $translated = $this->callDeepL($text, $locale);

        // 3. Simpan ke database cache
        if ($translated !== null) {
            Translation::store($locale, $group, $key, $translated);
            return $translated;
        }

        // 4. Fallback: kembalikan teks asli
        return $text;
    }

    /**
     * Terjemahkan banyak teks sekaligus (batch) — lebih hemat API call.
     *
     * @param array  $texts  ['key1' => 'text1', 'key2' => 'text2', ...]
     * @param string $locale Target locale
     * @param string $group  Grup
     * @return array         ['key1' => 'translated1', ...]
     */
    public function translateBatch(array $texts, string $locale, string $group): array
    {
        if ($locale === 'en') {
            return $texts;
        }

        $results    = [];
        $toTranslate = [];

        // Pisahkan mana yang sudah ada di cache
        foreach ($texts as $key => $text) {
            $cached = Translation::get($locale, $group, $key);
            if ($cached !== null) {
                $results[$key] = $cached;
            } else {
                $toTranslate[$key] = $text;
            }
        }

        if (empty($toTranslate)) {
            return $results;
        }

        // Kirim batch ke DeepL
        $targetLang = self::SUPPORTED_LOCALES[$locale] ?? 'EN-US';

        try {
            if (!$this->deepl) {
                throw new \Exception('DeepL not configured');
            }

            $translated = $this->deepl->translateText(
                array_values($toTranslate),
                self::SOURCE_LOCALE,
                $targetLang,
                ['tag_handling' => 'html'] // preserve HTML tags
            );

            $keys = array_keys($toTranslate);
            foreach ($translated as $i => $result) {
                $key   = $keys[$i];
                $value = $result->text;

                Translation::store($locale, $group, $key, $value);
                $results[$key] = $value;
            }

        } catch (\Throwable $e) {
            Log::error('DeepL batch translation failed: ' . $e->getMessage());
            // Fallback ke teks asli
            foreach ($toTranslate as $key => $text) {
                $results[$key] = $text;
            }
        }

        return $results;
    }

    /**
     * Hapus cache terjemahan untuk key tertentu
     * (berguna saat konten diupdate di CMS/Filament).
     */
    public function clearCache(string $group, string $key): void
    {
        Translation::where('group', $group)
            ->where('key', $key)
            ->delete();
    }

    /**
     * Hapus semua cache untuk satu locale.
     */
    public function clearLocale(string $locale): void
    {
        Translation::where('locale', $locale)->delete();
    }

    /**
     * Pre-generate semua terjemahan untuk satu produk
     * (panggil ini dari observer/event saat produk disimpan).
     */
    public function warmProductCache(\App\Models\Product $product): void
    {
        $specs = $product->specifications ?? [];

        $fields = [
            "product.{$product->id}.name"              => $product->name,
            "product.{$product->id}.short_description" => $product->short_description ?? '',
            "product.{$product->id}.description"       => $product->description ?? '',
        ];

        foreach (array_keys(self::SUPPORTED_LOCALES) as $locale) {
            if ($locale === 'en') continue;
            $this->translateBatch($fields, $locale, 'products');
        }
    }

    // ── Private ──────────────────────────────────────────

    private function callDeepL(string $text, string $locale): ?string
    {
        $targetLang = self::SUPPORTED_LOCALES[$locale] ?? null;
        if (!$targetLang || !$this->deepl) {
            return null;
        }

        try {
            $result = $this->deepl->translateText(
                $text,
                self::SOURCE_LOCALE,
                $targetLang,
                ['tag_handling' => 'html']
            );
            return $result->text;

        } catch (\Throwable $e) {
            Log::error("DeepL translation failed [{$locale}]: " . $e->getMessage());
            return null;
        }
    }
}
