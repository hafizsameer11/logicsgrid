@php
    $settings = $settings ?? array_merge(
        \App\Models\SiteSetting::group('site'),
        \App\Models\SiteSetting::group('hero'),
        \App\Models\SiteSetting::group('sections')
    );
@endphp
<div class="fixed top-0 left-0 right-0 h-[3px] z-50" id="scroll-progress-bar" style="transform-origin:0% 50%;transform:scaleX(0)"></div>
<header class="sticky top-4 z-40 px-4" style="opacity:1;transform:none">
    <div class="lg-header-shell mx-auto max-w-[1400px] flex items-center justify-between gap-6 rounded-full border bg-white/90 backdrop-blur-xl px-6 md:px-8 py-3" style="border-color:rgba(0,0,0,0.08)">
        <a aria-label="LogicsGrid — Home" href="{{ url('/') }}" class="flex items-center shrink-0">
            <img src="{{ media_url($settings['logo_dark'] ?? 'assets/logicsgrid-logo-horizontal.png') }}" alt="LogicsGrid" class="h-9 md:h-10 w-auto"/>
        </a>
        <nav class="hidden lg:flex items-center gap-7 text-[11px] tracking-[0.18em] uppercase font-medium" style="color:#0F172A">
            <a href="{{ url('/') }}" class="relative group">Home<span class="absolute -bottom-1 left-0 h-px w-full origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100" style="background:#4A69BD"></span></a>
            <div class="relative">
                <a href="{{ url('/software-development') }}" class="relative group inline-flex items-center gap-1.5">Services<svg width="9" height="9" viewBox="0 0 12 12" class="transition-transform duration-200"><path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></svg><span class="absolute -bottom-1 left-0 h-px w-full origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100" style="background:#4A69BD"></span></a>
            </div>
            <div class="relative">
                <a href="{{ url('/about') }}" class="relative group inline-flex items-center gap-1.5">Company<svg width="9" height="9" viewBox="0 0 12 12" class="transition-transform duration-200"><path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></svg><span class="absolute -bottom-1 left-0 h-px w-full origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100" style="background:#4A69BD"></span></a>
            </div>
            <div class="relative">
                <a href="{{ url('/portfolio') }}" class="relative group inline-flex items-center gap-1.5">Work<svg width="9" height="9" viewBox="0 0 12 12" class="transition-transform duration-200"><path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></svg><span class="absolute -bottom-1 left-0 h-px w-full origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100" style="background:#4A69BD"></span></a>
            </div>
            <a href="{{ url('/contact') }}" class="relative group">Contact<span class="absolute -bottom-1 left-0 h-px w-full origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100" style="background:#4A69BD"></span></a>
        </nav>
        <div class="flex items-center gap-3">
            <a href="{{ url('/strategy-session') }}" class="lg-btn hidden sm:inline-flex rounded-full px-6 py-3 text-[13px] tracking-wide">{{ $settings['nav_cta'] ?? 'Book A Strategy Session' }}</a>
            <button aria-label="Toggle menu" class="lg:hidden rounded-full border w-11 h-11 flex flex-col items-center justify-center gap-1" style="border-color:rgba(15,23,42,0.16)">
                <span class="h-[2px] w-5 transition-transform" style="background:#0F172A"></span>
                <span class="h-[2px] w-5 transition-transform" style="background:#0F172A"></span>
            </button>
        </div>
    </div>
</header>
