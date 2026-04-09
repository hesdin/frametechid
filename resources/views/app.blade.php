<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ $seo['title'] ?? ($siteSettings['siteName'] ?? config('app.name', 'Laravel')) }}</title>

        <meta name="description" content="{{ $seo['description'] ?? '' }}">
        <meta name="keywords" content="{{ implode(', ', $seo['keywords'] ?? []) }}">
        <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $seo['title'] ?? ($siteSettings['siteName'] ?? config('app.name', 'Laravel')) }}">
        <meta property="og:description" content="{{ $seo['description'] ?? '' }}">
        <meta property="og:url" content="{{ $seo['canonical'] ?? url()->current() }}">
        <meta property="og:image" content="{{ $seo['ogImage'] ?? ($siteSettings['logoUrl'] ?? '') }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seo['title'] ?? ($siteSettings['siteName'] ?? config('app.name', 'Laravel')) }}">
        <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}">
        <meta name="twitter:image" content="{{ $seo['ogImage'] ?? ($siteSettings['logoUrl'] ?? '') }}">

        <link rel="icon" href="{{ $siteSettings['faviconUrl'] ?? asset('favicon.ico') }}" sizes="any">
        <link rel="icon" href="{{ $siteSettings['faviconUrl'] ?? asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="apple-touch-icon" href="{{ $siteSettings['faviconUrl'] ?? asset('apple-touch-icon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @foreach (($seo['schema'] ?? []) as $schema)
            <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        @endforeach

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
