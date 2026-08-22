<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? $service->title.' — LogicsGrid' }}</title>
    <link rel="icon" type="image/webp" href="{{ asset('assets/logicsgrid-logo-horizontal.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logicsgrid-extra.css') }}">
</head>
<body>
    <main class="min-h-screen" style="background:white" id="scroll-progress-root">
        {!! render_cms_html($service->body_html) !!}
    </main>
    <script src="{{ asset('js/logicsgrid.js') }}" defer></script>
</body>
</html>
