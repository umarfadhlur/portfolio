@php
    $currentLocale = app()->getLocale();

    $languages = [
        'en' => ['label' => 'English', 'native' => 'English', 'flag' => 'https://flagcdn.com/24x18/gb.png'],
        'ja' => ['label' => 'Japanese', 'native' => '日本語', 'flag' => 'https://flagcdn.com/24x18/jp.png'],
        'ko' => ['label' => 'Korean', 'native' => '한국어', 'flag' => 'https://flagcdn.com/24x18/kr.png'],
        'zh' => ['label' => 'Chinese', 'native' => '中文', 'flag' => 'https://flagcdn.com/24x18/cn.png'],
        'ar' => ['label' => 'Arabic', 'native' => 'العربية', 'flag' => 'https://flagcdn.com/24x18/sa.png'],
    ];

    $current = $languages[$currentLocale] ?? $languages['en'];
@endphp

<div class="language-switcher dropdown" style="position: relative; display: inline-block;">

    <button id="langToggle" class="lang-toggle" aria-haspopup="true" aria-expanded="false" aria-label="Select language"
        style="
            display: flex; align-items: center; gap: 6px;
            background: none; border: 1px solid color-mix(in srgb, var(--default-color), transparent 80%);
            border-radius: 6px; padding: 5px 10px;
            font-size: 13px; font-weight: 600;
            color: var(--nav-color); cursor: pointer;
            transition: all 0.2s;">
        <img src="{{ $current['flag'] }}" alt="{{ $current['label'] }}" width="24" height="18"
            style="border-radius: 2px; object-fit: cover; flex-shrink: 0;" loading="eager">
        <span>{{ strtoupper($currentLocale) }}</span>
        <i class="bi bi-chevron-down" style="font-size: 10px; transition: transform 0.2s;" id="langChevron"></i>
    </button>

    <ul id="langMenu" role="menu"
        style="
            display: none;
            position: absolute; top: calc(100% + 8px); right: 0;
            min-width: 170px;
            background: var(--surface-color);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 88%);
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            padding: 6px;
            list-style: none; margin: 0;
            z-index: 9999;">

        @foreach ($languages as $code => $lang)
            <li role="none">
                <a href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}" role="menuitem"
                    style="
                        display: flex; align-items: center; gap: 10px;
                        padding: 8px 10px; border-radius: 6px;
                        text-decoration: none; font-size: 14px;
                        color: {{ $code === $currentLocale ? 'var(--accent-color)' : 'var(--default-color)' }};
                        background: {{ $code === $currentLocale ? 'color-mix(in srgb, var(--accent-color), transparent 90%)' : 'transparent' }};
                        font-weight: {{ $code === $currentLocale ? '700' : '400' }};
                        transition: background 0.15s;">
                    <img src="{{ $lang['flag'] }}" alt="{{ $lang['label'] }}" width="24" height="18"
                        style="border-radius: 2px; object-fit: cover; flex-shrink: 0;" loading="lazy">
                    <span style="flex: 1;">{{ $lang['native'] }}</span>
                    @if ($code === $currentLocale)
                        <i class="bi bi-check2" style="color: var(--accent-color);"></i>
                    @endif
                </a>
            </li>
        @endforeach

    </ul>
</div>

<script>
    (function() {
        const toggle = document.getElementById('langToggle');
        const menu = document.getElementById('langMenu');
        const chevron = document.getElementById('langChevron');

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = menu.style.display === 'block';
            menu.style.display = isOpen ? 'none' : 'block';
            chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
            toggle.setAttribute('aria-expanded', String(!isOpen));
        });

        document.addEventListener('click', function() {
            menu.style.display = 'none';
            chevron.style.transform = '';
            toggle.setAttribute('aria-expanded', 'false');
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                menu.style.display = 'none';
                chevron.style.transform = '';
                toggle.setAttribute('aria-expanded', 'false');
                toggle.focus();
            }
        });
    })();
</script>
