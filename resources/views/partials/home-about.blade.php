@php
    $aboutTitle = $sections['about_title'] ?? 'Artistry meeting technical precision.';
@endphp
<section class="relative py-32 md:py-40 border-t overflow-hidden" style="background:#000;border-color:rgba(255,255,255,0.06)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div class="grid grid-cols-12 gap-6 sm:gap-12 lg:gap-20 items-center">
            <div class="col-span-12 lg:col-span-7 order-2 lg:order-1 space-y-8">
                <span class="inline-flex items-center gap-3 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#4ECDC4">
                    <span class="h-px w-8" style="background:#4ECDC4"></span>{{ $sections['about_eyebrow'] ?? 'About LogicsGrid' }}
                </span>
                <h2 class="text-white text-[clamp(40px,5.4vw,76px)] leading-[1.05] font-light tracking-[-0.02em]" style="font-family:'Fraunces', serif;font-style:italic">
                    {{ $aboutTitle }}
                </h2>
                <div class="max-w-xl space-y-6 text-[17px] leading-relaxed text-white/65">
                    @if($sections['about_p1'] ?? null)<p>{{ $sections['about_p1'] }}</p>@endif
                    @if($sections['about_p2'] ?? null)<p>{{ $sections['about_p2'] }}</p>@endif
                </div>
                @if($aboutStats->count())
                <div class="grid grid-cols-3 gap-6 max-w-[520px] pt-2">
                    @foreach($aboutStats as $stat)
                    <div>
                        <div class="text-[clamp(28px,3.5vw,44px)] font-bold tabular-nums leading-none text-white" style="font-family:'Inter Tight', sans-serif"><span>{{ $stat->value }}</span></div>
                        <div class="text-[10px] tracking-[0.25em] uppercase mt-2" style="color:rgba(255,255,255,0.55)">{{ $stat->label }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="pt-2">
                    <a href="{{ url('/about') }}" class="inline-flex items-center gap-4 group">
                        <span class="h-px w-12 transition-all duration-300 group-hover:w-20" style="background:#4ECDC4"></span>
                        <span class="text-white text-[12px] uppercase tracking-[0.28em] font-semibold transition-colors group-hover:text-[color:var(--mint)]" style="--mint:#4ECDC4">Read the full story</span>
                    </a>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-5 order-1 lg:order-2 relative">
                <div class="relative aspect-[4/5] w-full max-w-[520px] mx-auto">
                    <div class="absolute -top-6 -right-6 w-full h-full z-0 border" style="border-color:rgba(74,105,189,0.25)"></div>
                    <div class="relative z-10 w-full h-full overflow-hidden bg-zinc-900 group">
                        <img src="{{ media_url($sections['about_image'] ?? 'assets/about-boardroom-Di1UV2w5.webp') }}" alt="LogicsGrid leadership" loading="lazy" class="h-full w-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700"/>
                    </div>
                    <div class="absolute -bottom-8 -left-8 z-20 px-6 py-5 hidden lg:block lg-btn">
                        <p class="text-white text-[26px] leading-[0.95] font-semibold" style="font-family:'Fraunces', serif">Since<br/>2016</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
