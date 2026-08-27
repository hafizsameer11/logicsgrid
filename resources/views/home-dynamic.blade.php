@extends('layouts.app')

@section('title', $settings['site_name'] ?? 'LogicsGrid — Build New Ventures. Scale Faster. Operate Smarter.')

@section('content')
    @include('partials.header')

    {{-- Hero --}}
    <section class="relative overflow-hidden pt-10" style="background:linear-gradient(180deg, #ffffff 0%, #F8FAFC 48%, #E8F4FC 100%)">
        <div class="lg-hero-glow" style="top:-8%; right:-8%"></div>
        <div class="lg-hero-glow" style="bottom:-18%; left:-12%; opacity:0.7"></div>
        <div class="relative mx-auto max-w-[1400px] px-5 sm:px-8 lg:pl-28 pt-16 pb-20 grid lg:grid-cols-12 gap-6 sm:gap-12 items-center">
            <div class="lg:col-span-7">
                @if($settings['badge'] ?? null)
                <div class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-[9px] sm:text-[11px] tracking-[0.18em] sm:tracking-[0.22em] uppercase whitespace-nowrap bg-white/70 backdrop-blur" style="border-color:rgba(74,105,189,0.22);color:#0F172A">
                    <span class="w-1.5 h-1.5 rounded-full" style="background:#4ECDC4"></span>{{ $settings['badge'] }}
                </div>
                @endif
                <h1 class="mt-6 text-[44px] sm:text-[60px] lg:text-[76px] leading-[0.95] tracking-tight font-semibold" style="font-family:'Inter Tight', sans-serif;color:#0F172A">
                    {{ $settings['title_line1'] ?? 'Build, scale,' }} <br/>
                    <span class="italic font-normal" style="color:#4A69BD;font-family:'Fraunces', serif">{{ $settings['title_highlight'] ?? 'operate' }}</span> — as one.
                </h1>
                <p class="mt-8 max-w-[560px] text-[17px] leading-[1.65]" style="color:#334155">{{ $settings['description'] ?? '' }}</p>
                @if($heroStats->count())
                <div class="mt-10 grid grid-cols-3 gap-6 max-w-[560px]">
                    @foreach($heroStats as $stat)
                    <div>
                        <div class="text-[28px] font-semibold leading-none tracking-tight" style="color:#0F172A">{{ $stat->value }}</div>
                        <div class="mt-2 text-[11px] tracking-[0.2em] uppercase" style="color:#64748B">{{ $stat->label }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="mt-10 flex flex-wrap gap-3">
                    <a href="{{ url('/strategy-session') }}" class="lg-btn rounded-full border px-7 py-4 text-[14px]">{{ $settings['cta_primary'] ?? 'Book A Strategy Session →' }}</a>
                    <a href="{{ url('/portfolio') }}" style="border-color:rgba(15,23,42,0.16);color:#0F172A" class="rounded-full border bg-white/70 px-7 py-4 text-[14px] hover:border-[rgba(74,105,189,0.45)] transition">{{ $settings['cta_secondary'] ?? 'See Our Work' }}</a>
                </div>
            </div>
            <div class="lg:col-span-5 relative">
                <div class="lg-media relative rounded-[28px] overflow-hidden border" style="border-color:rgba(15,23,42,0.08);box-shadow:0 40px 90px -40px rgba(15,23,42,0.55)">
                    <img src="{{ media_url($settings['hero_image'] ?? 'assets/hero-cinematic-Dn9NhNBB.webp') }}" alt="LogicsGrid" class="block w-full h-auto"/>
                </div>
            </div>
        </div>
    </section>

    {{-- Marquee --}}
    @if($marqueeItems->count())
    <section class="relative overflow-hidden border-t border-b py-10" style="background:#000;border-color:rgba(255,255,255,0.06)">
        <div class="mx-auto max-w-[1400px] px-5 sm:px-8 flex items-center gap-10">
            <div class="hidden md:block text-[11px] tracking-[0.32em] uppercase shrink-0" style="color:#4ECDC4">Trusted Across</div>
            <div class="relative flex-1 overflow-hidden">
                <div class="flex gap-12 whitespace-nowrap marquee-track" id="marquee-track">
                    @foreach($marqueeItems->merge($marqueeItems) as $item)
                    <div class="flex items-center gap-6 text-[16px] md:text-[20px] font-medium tracking-tight text-white">
                        <span>{{ $item->text }}</span>
                        <span class="inline-block w-1.5 h-1.5 rounded-full" style="background:#4ECDC4"></span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Problem cards --}}
    @if($problemCards->count())
    @include('partials.home-problem', ['problemCards' => $problemCards, 'sections' => $settings])
    @endif

    {{-- Services --}}
    @if($services->count())
    @include('partials.home-services', ['services' => $services, 'sections' => $settings])
    @endif

    {{-- Why LogicsGrid --}}
    @if($whyReasons->count())
    @include('partials.home-why', ['whyReasons' => $whyReasons, 'sections' => $settings])
    @endif

    {{-- Process --}}
    @if($processSteps->count())
    @include('partials.home-process', ['processSteps' => $processSteps, 'sections' => $settings])
    @endif

    {{-- Featured projects --}}
    @if($featuredProjects->count())
    @include('partials.home-featured-projects', ['featuredProjects' => $featuredProjects, 'sections' => $settings])
    @endif

    {{-- Industries --}}
    @if($industries->count())
    @include('partials.home-industries', ['industries' => $industries, 'sections' => $settings])
    @endif

    {{-- About snippet --}}
    @include('partials.home-about', ['aboutStats' => $aboutStats, 'sections' => $settings])

    {{-- Testimonials --}}
    @if($testimonials->count())
    @include('partials.home-testimonials', ['testimonials' => $testimonials, 'sections' => $settings])
    @endif

    {{-- Team --}}
    @if($teamMembers->count())
    @include('partials.home-team', ['teamMembers' => $teamMembers, 'sections' => $settings])
    @endif

    @include('partials.home-cta', ['sections' => $settings])
    @include('partials.footer')
@endsection
