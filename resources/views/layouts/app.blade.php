<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LogicsGrid — Build New Ventures. Scale Faster. Operate Smarter.')</title>
    <meta name="description" content="LogicsGrid helps entrepreneurs, investors, and businesses launch technology products, accelerate growth, and digitize operations — one integrated partner.">
    <meta property="og:title" content="LogicsGrid — Build New Ventures. Scale Faster. Operate Smarter.">
    <meta property="og:description" content="Software development, startup growth infrastructure, and business digitization — one integrated partner.">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" href="{{ asset('assets/logicsgrid-icon-transparent.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logicsgrid-icon-transparent.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&family=Inter+Tight:wght@300;400;500;600;700&family=Instrument+Serif:ital@0;1&family=Bebas+Neue&family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@500;700;800&family=Manrope:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&family=IBM+Plex+Mono:wght@400;500&family=Newsreader:ital,opsz,wght@0,6..72,300;0,6..72,400;1,6..72,400&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logicsgrid-extra.css') }}">
    @stack('styles')
</head>
<body>
    <main class="min-h-screen" style="background:white" id="scroll-progress-root">
        @yield('content')
    </main>
    <script src="{{ asset('js/logicsgrid.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
