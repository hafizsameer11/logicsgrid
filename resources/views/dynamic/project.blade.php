@extends('layouts.app')

@section('title', $title ?? html_entity_decode($project->meta_title ?? $project->title.' — LogicsGrid'))

@section('content')
    @include('partials.header')

    {{-- Hero --}}
    <section class="relative overflow-hidden" style="background:linear-gradient(180deg, #ffffff 0%, #E8F4FC 100%)">
        <div class="mx-auto max-w-[1400px] px-5 sm:px-8 lg:pl-28 pt-10 sm:pt-16 pb-8 sm:pb-12">
            <div class="flex items-center gap-3 text-[11px] tracking-[0.28em] uppercase" style="color:#6b6b6b">
                <a class="hover:text-black transition" href="{{ url('/portfolio') }}">Portfolio</a>
                <span>/</span>
                <span style="color:#000000">{{ $project->category }}</span>
            </div>
            <div class="grid grid-cols-12 gap-6 sm:gap-10 mt-8 sm:mt-10 items-end">
                <div class="col-span-12 lg:col-span-8">
                    <div class="flex items-center gap-3 flex-wrap mb-6">
                        @if($project->category)
                        <span class="text-[10px] tracking-[0.3em] uppercase px-3 py-1.5 rounded-full" style="background:#000000;color:#4ECDC4">{{ $project->category }}</span>
                        @endif
                        @if($project->year)
                        <span class="text-[10px] tracking-[0.3em] uppercase px-3 py-1.5 rounded-full border" style="border-color:rgba(0,0,0,0.15);color:#000000">{{ $project->year }}</span>
                        @endif
                        @if($project->client_name)
                        <span class="text-[11px] tracking-[0.28em] uppercase" style="color:#6b6b6b">{{ $project->client_name }}@if($project->location) ({{ $project->location }})@endif</span>
                        @endif
                    </div>
                    <h1 class="text-[clamp(30px,5.4vw,88px)] font-bold leading-[0.98] tracking-[-0.035em]" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $project->title }}</h1>
                    @if($project->excerpt)
                    <p class="mt-8 max-w-[640px] text-[15px] sm:text-[18px] md:text-[20px] leading-relaxed" style="color:#1a1a1a">{{ $project->excerpt }}</p>
                    @endif
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <div class="rounded-2xl bg-black/[0.03] border p-6" style="border-color:rgba(0,0,0,0.1)">
                        @if($project->client_name)
                        <div class="flex items-baseline justify-between gap-4 py-3 border-b last:border-b-0" style="border-color:rgba(0,0,0,0.08)">
                            <div class="text-[10px] tracking-[0.28em] uppercase" style="color:#6b6b6b">Client</div>
                            <div class="text-[13px] text-right" style="color:#000000">{{ $project->client_name }}@if($project->location) ({{ $project->location }})@endif</div>
                        </div>
                        @endif
                        @if($project->year)
                        <div class="flex items-baseline justify-between gap-4 py-3 border-b last:border-b-0" style="border-color:rgba(0,0,0,0.08)">
                            <div class="text-[10px] tracking-[0.28em] uppercase" style="color:#6b6b6b">Year</div>
                            <div class="text-[13px] text-right" style="color:#000000">{{ $project->year }}</div>
                        </div>
                        @endif
                        @if($project->duration)
                        <div class="flex items-baseline justify-between gap-4 py-3 border-b last:border-b-0" style="border-color:rgba(0,0,0,0.08)">
                            <div class="text-[10px] tracking-[0.28em] uppercase" style="color:#6b6b6b">Duration</div>
                            <div class="text-[13px] text-right" style="color:#000000">{{ $project->duration }}</div>
                        </div>
                        @endif
                        @if($project->team_info)
                        <div class="flex items-baseline justify-between gap-4 py-3 border-b last:border-b-0" style="border-color:rgba(0,0,0,0.08)">
                            <div class="text-[10px] tracking-[0.28em] uppercase" style="color:#6b6b6b">Team</div>
                            <div class="text-[13px] text-right" style="color:#000000">{{ $project->team_info }}</div>
                        </div>
                        @endif
                        @if($project->live_url)
                        <div class="flex items-baseline justify-between gap-4 py-3 border-b last:border-b-0" style="border-color:rgba(0,0,0,0.08)">
                            <div class="text-[10px] tracking-[0.28em] uppercase" style="color:#6b6b6b">Live</div>
                            <div class="text-[13px] text-right" style="color:#000000">
                                <a href="{{ $project->live_url }}" target="_blank" rel="noreferrer" class="hover:underline">{{ $project->live_label ?? parse_url($project->live_url, PHP_URL_HOST) }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if($project->app_store_url || $project->play_store_url)
                    <div class="mt-4 flex flex-col gap-3">
                        @if($project->app_store_url)
                        <a href="{{ $project->app_store_url }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-3 rounded-2xl bg-black px-5 py-3 text-white hover:bg-black/85 transition">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.05 12.04c-.02-2.05 1.67-3.04 1.75-3.09-.95-1.39-2.43-1.58-2.96-1.6-1.26-.13-2.46.74-3.1.74-.64 0-1.63-.72-2.68-.7-1.38.02-2.65.8-3.36 2.03-1.43 2.48-.37 6.16 1.03 8.18.68.99 1.5 2.1 2.55 2.06 1.02-.04 1.41-.66 2.65-.66 1.23 0 1.58.66 2.66.64 1.1-.02 1.8-1 2.47-2 .78-1.15 1.1-2.26 1.12-2.32-.02-.01-2.15-.83-2.13-3.28zM15.04 5.7c.56-.68.94-1.62.84-2.55-.81.03-1.79.54-2.37 1.21-.52.6-.98 1.57-.86 2.48.9.07 1.83-.46 2.39-1.14z"></path></svg>
                            <span class="leading-tight text-left"><span class="block text-[9px] tracking-[0.18em] uppercase opacity-70">Download on the</span><span class="block text-[15px] font-semibold">App Store</span></span>
                        </a>
                        @endif
                        @if($project->play_store_url)
                        <a href="{{ $project->play_store_url }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-3 rounded-2xl bg-black px-5 py-3 text-white hover:bg-black/85 transition">
                            <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><path fill="#34A853" d="M3.6 20.5l10.2-10.2 2.9 2.9-9.7 5.6c-1.3.7-2.7.3-3.4-.8-.1-.2 0-1.5 0-1.5z"></path><path fill="#FBBC04" d="M16.7 13.2L13.8 10.3l5.7-3.3c1.2-.7 2.4 0 2.4 1.3 0 .4-.1.8-.3 1.1L16.7 13.2z"></path><path fill="#4285F4" d="M3.6 3.5c-.1.2-.2.5-.2.8v15.4c0 .3.1.6.2.8L13.8 10.3 3.6 3.5z"></path><path fill="#EA4335" d="M13.8 10.3L3.6 3.5c.7-1.1 2.1-1.5 3.4-.8l9.7 5.6-2.9 2z"></path></svg>
                            <span class="leading-tight text-left"><span class="block text-[9px] tracking-[0.18em] uppercase opacity-70">Get it on</span><span class="block text-[15px] font-semibold">Google Play</span></span>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @if($project->cover_image)
        <div class="mx-auto max-w-[1400px] px-5 sm:px-8 pb-12 sm:pb-20">
            <div class="relative rounded-[28px] overflow-hidden shadow-[0_50px_120px_-30px_rgba(0,0,0,0.5)] aspect-[16/9]">
                <img src="{{ media_url($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover"/>
            </div>
        </div>
        @endif
    </section>

    {{-- Stats --}}
    @if($project->stats->count())
    <section class="bg-white border-y" style="border-color:rgba(0,0,0,0.08)">
        <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3">
                @foreach($project->stats as $stat)
                <div class="py-8 sm:py-12 md:py-16 px-5 sm:px-10 text-center border-b md:border-b-0 md:border-r last:border-r-0" style="border-color:rgba(0,0,0,0.08)">
                    <div class="text-[clamp(32px,5vw,72px)] font-bold tabular-nums leading-none" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $stat->value }}</div>
                    <div class="text-[10px] tracking-[0.3em] uppercase mt-4" style="color:#6b6b6b">{{ $stat->label }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Challenge / Approach / Outcome --}}
    @if($project->challenge || $project->approach || $project->outcome)
    <section class="bg-white py-20 sm:py-28">
        <div class="mx-auto max-w-[1200px] px-5 sm:px-8 space-y-24">
            @if($project->challenge)
            <div class="grid grid-cols-12 gap-6 sm:gap-10 md:gap-16">
                <div class="col-span-12 md:col-span-4">
                    <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000"><span class="h-px w-8" style="background:#000000"></span>The Challenge</span>
                    <div class="mt-4 text-[clamp(18px,2.4vw,32px)] font-bold leading-tight tracking-[-0.02em]" style="color:#000000;font-family:'Inter Tight', sans-serif">Where they <span style="font-family:'Fraunces', serif" class="italic font-normal">started.</span></div>
                </div>
                <p class="col-span-12 md:col-span-8 text-[15px] sm:text-[17px] md:text-[19px] leading-relaxed" style="color:#1a1a1a">{{ $project->challenge }}</p>
            </div>
            @endif
            @if($project->approach)
            <div class="grid grid-cols-12 gap-6 sm:gap-10 md:gap-16">
                <div class="col-span-12 md:col-span-4">
                    <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000"><span class="h-px w-8" style="background:#000000"></span>Our Approach</span>
                    <div class="mt-4 text-[clamp(18px,2.4vw,32px)] font-bold leading-tight tracking-[-0.02em]" style="color:#000000;font-family:'Inter Tight', sans-serif">How we <span style="font-family:'Fraunces', serif" class="italic font-normal">built it.</span></div>
                </div>
                <p class="col-span-12 md:col-span-8 text-[15px] sm:text-[17px] md:text-[19px] leading-relaxed" style="color:#1a1a1a">{{ $project->approach }}</p>
            </div>
            @endif
            @if($project->outcome)
            <div class="grid grid-cols-12 gap-6 sm:gap-10 md:gap-16">
                <div class="col-span-12 md:col-span-4">
                    <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000"><span class="h-px w-8" style="background:#000000"></span>The Outcome</span>
                    <div class="mt-4 text-[clamp(18px,2.4vw,32px)] font-bold leading-tight tracking-[-0.02em]" style="color:#000000;font-family:'Inter Tight', sans-serif">What <span style="font-family:'Fraunces', serif" class="italic font-normal">shipped.</span></div>
                </div>
                <p class="col-span-12 md:col-span-8 text-[15px] sm:text-[17px] md:text-[19px] leading-relaxed" style="color:#1a1a1a">{{ $project->outcome }}</p>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- Screens gallery --}}
    @if($project->screens->count())
    <section class="relative py-20 sm:py-28 border-y overflow-hidden" style="background:linear-gradient(180deg, #06311c 0%, #0a4a2a 100%);border-color:rgba(0,0,0,0.2)">
        <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
            <div class="mb-14 max-w-[700px]">
                <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium text-white/80"><span class="h-px w-8 bg-white/50"></span>Inside the app</span>
                <h2 class="mt-4 text-[clamp(28px,3.8vw,56px)] font-bold tracking-[-0.025em] text-white" style="font-family:'Inter Tight', sans-serif">Every screen, <span style="font-family:'Fraunces', serif" class="italic font-normal text-[#7EE8E0]">crafted.</span></h2>
                <p class="mt-5 text-[15px] sm:text-[17px] leading-relaxed text-white/70">{{ $project->screens->count() }} core surfaces of {{ $project->client_name ?? $project->title }}.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-14 sm:gap-x-10 sm:gap-y-20">
                @foreach($project->screens as $screen)
                <div class="flex flex-col items-center">
                    <div class="relative mx-auto w-full max-w-[280px]" style="aspect-ratio:9 / 19.5">
                        <div class="absolute inset-0 rounded-[44px] bg-[#0a0a0a] shadow-[0_30px_80px_-20px_rgba(0,0,0,0.5),0_10px_30px_-10px_rgba(0,0,0,0.4)] p-[6px]">
                            <div class="relative w-full h-full rounded-[38px] overflow-hidden bg-black">
                                @if($screen->image)
                                <img src="{{ media_url($screen->image) }}" alt="{{ $screen->title }}" loading="lazy" class="w-full h-full object-cover"/>
                                @endif
                                <div class="pointer-events-none absolute top-2 left-1/2 -translate-x-1/2 h-[22px] w-[90px] rounded-full bg-black/95"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 text-center max-w-[260px]">
                        <div class="text-[10px] tracking-[0.3em] uppercase text-[#7EE8E0]">{{ str_pad($screen->number, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="mt-2 text-[16px] font-semibold text-white" style="font-family:'Inter Tight', sans-serif">{{ $screen->title }}</div>
                        @if($screen->description)
                        <div class="mt-2 text-[13px] leading-relaxed text-white/65">{{ $screen->description }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Features --}}
    @if($project->features->count())
    <section class="bg-white py-20 sm:py-28">
        <div class="mx-auto max-w-[1200px] px-5 sm:px-8">
            <div class="mb-12 max-w-[700px]">
                <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000"><span class="h-px w-8" style="background:#000000"></span>What it does</span>
                <h2 class="mt-4 text-[clamp(24px,3.4vw,48px)] font-bold tracking-[-0.025em]" style="color:#000000;font-family:'Inter Tight', sans-serif">The whole stack of <span style="font-family:'Fraunces', serif" class="italic font-normal">features.</span></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($project->features as $feature)
                <div class="rounded-3xl border p-6 sm:p-7 bg-[#fafafa]" style="border-color:rgba(0,0,0,0.08)">
                    <div class="text-[10px] tracking-[0.3em] uppercase" style="color:#4ECDC4">{{ str_pad($feature->number, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="mt-3 text-[19px] font-semibold leading-tight" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $feature->title }}</div>
                    @if($feature->description)
                    <p class="mt-3 text-[14px] leading-relaxed" style="color:#3a3a3a">{{ $feature->description }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @if($project->app_store_url || $project->play_store_url)
            <div class="mt-14 flex flex-col items-center gap-6">
                <div class="flex flex-wrap items-center justify-center gap-4">
                    @if($project->app_store_url)
                    <a href="{{ $project->app_store_url }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-3 rounded-2xl bg-black px-5 py-3 text-white hover:bg-black/85 transition">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.05 12.04c-.02-2.05 1.67-3.04 1.75-3.09-.95-1.39-2.43-1.58-2.96-1.6-1.26-.13-2.46.74-3.1.74-.64 0-1.63-.72-2.68-.7-1.38.02-2.65.8-3.36 2.03-1.43 2.48-.37 6.16 1.03 8.18.68.99 1.5 2.1 2.55 2.06 1.02-.04 1.41-.66 2.65-.66 1.23 0 1.58.66 2.66.64 1.1-.02 1.8-1 2.47-2 .78-1.15 1.1-2.26 1.12-2.32-.02-.01-2.15-.83-2.13-3.28zM15.04 5.7c.56-.68.94-1.62.84-2.55-.81.03-1.79.54-2.37 1.21-.52.6-.98 1.57-.86 2.48.9.07 1.83-.46 2.39-1.14z"></path></svg>
                        <span class="leading-tight text-left"><span class="block text-[9px] tracking-[0.18em] uppercase opacity-70">Download on the</span><span class="block text-[15px] font-semibold">App Store</span></span>
                    </a>
                    @endif
                    @if($project->play_store_url)
                    <a href="{{ $project->play_store_url }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-3 rounded-2xl bg-black px-5 py-3 text-white hover:bg-black/85 transition">
                        <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><path fill="#34A853" d="M3.6 20.5l10.2-10.2 2.9 2.9-9.7 5.6c-1.3.7-2.7.3-3.4-.8-.1-.2 0-1.5 0-1.5z"></path><path fill="#FBBC04" d="M16.7 13.2L13.8 10.3l5.7-3.3c1.2-.7 2.4 0 2.4 1.3 0 .4-.1.8-.3 1.1L16.7 13.2z"></path><path fill="#4285F4" d="M3.6 3.5c-.1.2-.2.5-.2.8v15.4c0 .3.1.6.2.8L13.8 10.3 3.6 3.5z"></path><path fill="#EA4335" d="M13.8 10.3L3.6 3.5c.7-1.1 2.1-1.5 3.4-.8l9.7 5.6-2.9 2z"></path></svg>
                        <span class="leading-tight text-left"><span class="block text-[9px] tracking-[0.18em] uppercase opacity-70">Get it on</span><span class="block text-[15px] font-semibold">Google Play</span></span>
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- Technologies & deliverables --}}
    @if((is_array($project->technologies) && count($project->technologies)) || (is_array($project->deliverables) && count($project->deliverables)))
    <section class="bg-white py-20 sm:py-28">
        <div class="mx-auto max-w-[1200px] px-5 sm:px-8 grid grid-cols-12 gap-6 sm:gap-12">
            @if(is_array($project->technologies) && count($project->technologies))
            <div class="col-span-12 md:col-span-6">
                <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000"><span class="h-px w-8" style="background:#000000"></span>Technologies</span>
                <div class="mt-8 flex flex-wrap gap-2">
                    @foreach($project->technologies as $tech)
                    <span class="inline-flex items-center px-4 py-2 rounded-full border text-[12px] tracking-wide" style="border-color:rgba(0,0,0,0.15);color:#000000;background:#fafafa">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
            @endif
            @if(is_array($project->deliverables) && count($project->deliverables))
            <div class="col-span-12 md:col-span-6">
                <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000"><span class="h-px w-8" style="background:#000000"></span>What we delivered</span>
                <ul class="mt-8 space-y-3">
                    @foreach($project->deliverables as $item)
                    <li class="flex items-start gap-3 text-[16px]" style="color:#000000">
                        <span class="mt-2 w-1.5 h-1.5 rounded-full flex-shrink-0" class="lg-btn"></span>{{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- Prev / Next --}}
    @if($prevProject || $nextProject)
    <section class="bg-white border-t" style="border-color:rgba(0,0,0,0.08)">
        <div class="mx-auto max-w-[1400px] grid grid-cols-1 md:grid-cols-2">
            @if($prevProject)
            <a href="{{ url('/portfolio/'.$prevProject->slug) }}" style="border-color:rgba(0,0,0,0.08)" class="group block p-6 sm:p-10 md:p-14 border-b md:border-b-0 md:border-r">
                <div class="text-[10px] tracking-[0.3em] uppercase" style="color:#6b6b6b">← Previous Project</div>
                <div class="mt-4 text-[clamp(18px,2.4vw,32px)] font-bold tracking-[-0.02em] group-hover:translate-x-[-4px] transition-transform" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $prevProject->client_name ?? $prevProject->title }}</div>
                @if($prevProject->subtitle)
                <div class="mt-2 text-[14px]" style="color:#6b6b6b">{{ $prevProject->subtitle }}</div>
                @endif
            </a>
            @else
            <div></div>
            @endif
            @if($nextProject)
            <a href="{{ url('/portfolio/'.$nextProject->slug) }}" class="group block p-6 sm:p-10 md:p-14 text-right {{ $prevProject ? '' : 'md:col-start-2' }}">
                <div class="text-[10px] tracking-[0.3em] uppercase" style="color:#6b6b6b">Next Project →</div>
                <div class="mt-4 text-[clamp(18px,2.4vw,32px)] font-bold tracking-[-0.02em] group-hover:translate-x-[4px] transition-transform" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $nextProject->client_name ?? $nextProject->title }}</div>
                @if($nextProject->subtitle)
                <div class="mt-2 text-[14px]" style="color:#6b6b6b">{{ $nextProject->subtitle }}</div>
                @endif
            </a>
            @endif
        </div>
    </section>
    @endif

    {{-- Related projects --}}
    @if($relatedProjects->count())
    <section class="bg-[#fafafa] py-20 sm:py-28 border-t" style="border-color:rgba(0,0,0,0.08)">
        <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
            <div class="mb-12">
                <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000"><span class="h-px w-8" style="background:#000000"></span>More work</span>
                <h2 class="mt-4 text-[clamp(24px,3.4vw,48px)] font-bold tracking-[-0.025em]" style="color:#000000;font-family:'Inter Tight', sans-serif">Other things we've <span style="font-family:'Fraunces', serif" class="italic font-normal">shipped.</span></h2>
            </div>
            <div class="grid grid-cols-12 gap-4 sm:gap-5">
                @foreach($relatedProjects as $related)
                <a href="{{ url('/portfolio/'.$related->slug) }}" style="border-color:rgba(0,0,0,0.1)" class="col-span-12 md:col-span-4 group rounded-3xl overflow-hidden border bg-white">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        @if($related->cover_image)
                        <img src="{{ media_url($related->cover_image) }}" alt="{{ $related->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                        @endif
                        @if($related->category)
                        <div class="absolute top-4 left-4 text-[10px] tracking-[0.25em] uppercase px-3 py-1 rounded-full bg-white/90" style="color:#000000">{{ $related->category }}</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="text-[11px] tracking-[0.3em] uppercase" style="color:#6b6b6b">{{ $related->client_name ?? $related->title }}</div>
                        <div class="mt-3 text-[18px] font-semibold leading-snug" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $related->subtitle ?? $related->title }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="relative py-20 sm:py-28 border-t" style="background:linear-gradient(180deg, #E8F4FC 0%, #ffffff 100%);border-color:rgba(0,0,0,0.08)">
        <div class="mx-auto max-w-[1100px] px-5 sm:px-8 text-center">
            <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000"><span class="h-px w-8" style="background:#000000"></span>Got something like this?</span>
            <h2 class="mt-8 font-bold leading-[1.02] tracking-[-0.03em] text-[clamp(28px,4.8vw,72px)]" style="color:#000000;font-family:'Inter Tight', sans-serif">Let's put your project <span style="font-family:'Fraunces', serif" class="italic font-normal">on this page.</span></h2>
            <div class="mt-10 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                <a href="{{ url('/contact') }}" class="lg-btn" class="inline-flex items-center gap-2 rounded-full px-7 py-4 text-[13px] tracking-wide text-black">Start a project →</a>
                <a href="{{ url('/portfolio') }}" class="inline-flex items-center gap-2 rounded-full border px-7 py-4 text-[13px] tracking-wide" style="border-color:#000000;color:#000000">← All work</a>
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection
