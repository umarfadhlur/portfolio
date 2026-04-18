<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Services\TranslationService;

class TranslationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TranslationService::class);
    }

    public function boot(): void
    {
        Blade::directive('translate', function ($expression) {
            preg_match("/^(.*),\\s*(['\"]{1}[^\\'\\\",]*['\"]{1})\\s*,\\s*(['\"]{1}[^\\'\\\",]*['\"]{1})$/s", $expression, $matches);

            if (count($matches) === 4) {
                $text  = trim($matches[1]);
                $group = trim($matches[2]);
                $key   = trim($matches[3]);
            } else {
                $parts = array_map('trim', explode(',', $expression, 3));
                $text  = $parts[0] ?? "''";
                $group = $parts[1] ?? "''";
                $key   = $parts[2] ?? "''";
            }

            return "<?php echo e(app(\\App\\Services\\TranslationService::class)"
                 . "->translate($text, app()->getLocale(), $group, $key)); ?>";
        });

        Blade::directive('translateHtml', function ($expression) {
            preg_match("/^(.*),\\s*(['\"]{1}[^\\'\\\",]*['\"]{1})\\s*,\\s*(['\"]{1}[^\\'\\\",]*['\"]{1})$/s", $expression, $matches);

            if (count($matches) === 4) {
                $text  = trim($matches[1]);
                $group = trim($matches[2]);
                $key   = trim($matches[3]);
            } else {
                $parts = array_map('trim', explode(',', $expression, 3));
                $text  = $parts[0] ?? "''";
                $group = $parts[1] ?? "''";
                $key   = $parts[2] ?? "''";
            }

            return "<?php echo app(\\App\\Services\\TranslationService::class)"
                 . "->translate($text, app()->getLocale(), $group, $key); ?>";
        });
    }
}
