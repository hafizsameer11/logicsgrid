<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? $page->title }}</title>
    @if($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif
    <link rel="icon" type="image/png" href="{{ public_asset('assets/logicsgrid-logo-horizontal.png') }}">
    <link rel="stylesheet" href="{{ public_asset('assets/styles.css') }}">
    <link rel="stylesheet" href="{{ public_asset('css/logicsgrid-extra.css') }}">
</head>
<body>
    <main class="min-h-screen" style="background:white" id="scroll-progress-root">
        {!! render_cms_html($page->body_html) !!}
    </main>
    <script src="{{ public_asset('js/logicsgrid.js') }}" defer></script>
</body>
</html>
