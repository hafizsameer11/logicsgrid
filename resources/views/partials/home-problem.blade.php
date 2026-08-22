@php
    $problemTitle = $sections['problem_title'] ?? 'Building is one thing. Operating it is another.';
    $titleParts = explode('. ', $problemTitle, 2);
@endphp
<section class="relative bg-white py-28 border-t" style="border-color:rgba(0,0,0,0.08)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8 grid grid-cols-12 gap-6 sm:gap-12 items-start">
        <div class="col-span-12 lg:col-span-5 lg:sticky lg:top-28">
            <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000">
                <span class="h-px w-8" style="background:#000000"></span>{{ $sections['problem_eyebrow'] ?? 'The Problem We Solve' }}
            </span>
            <h2 class="mt-6 text-[clamp(34px,4.2vw,64px)] font-bold leading-[1.0] tracking-[-0.03em]" style="color:#000000;font-family:'Inter Tight', sans-serif">
                {{ $titleParts[0] }}.@if(!empty($titleParts[1])) <span style="font-family:'Fraunces', serif" class="italic font-normal">{{ $titleParts[1] }}</span>@endif
            </h2>
            <p class="mt-8 max-w-[460px] text-[17px] leading-relaxed" style="color:#333333">{{ $sections['problem_description'] ?? '' }}</p>
            <div class="mt-10 flex items-center gap-4">
                <a href="{{ url('/contact') }}" class="group relative inline-flex items-center gap-2 rounded-full px-7 py-4 text-[13px] tracking-wide overflow-hidden" style="background:#000;color:#4ECDC4">
                    <span class="relative z-10 inline-flex items-center gap-2">Talk To Us<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14M13 5l7 7-7 7"></path></svg></span>
                </a>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-7 flex flex-col gap-3">
            @foreach($problemCards as $card)
            <div class="group relative grid grid-cols-12 gap-x-4 gap-y-3 sm:gap-6 items-center rounded-2xl border bg-white px-5 py-6 sm:px-6 sm:py-7 hover:bg-[#fafafa] transition-colors" style="border-color:rgba(0,0,0,0.1)">
                <div class="col-span-3 sm:col-span-2 text-[36px] sm:text-[44px] font-bold tabular-nums leading-none" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ str_pad($card->number, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="col-span-9 sm:col-span-6 min-w-0">
                    <div class="flex items-center gap-3">
                        <span class="text-[#c34a4a] text-[18px] shrink-0">✕</span>
                        <h3 class="text-[18px] sm:text-[20px] font-bold tracking-[-0.01em]" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $card->title }}</h3>
                    </div>
                    <p class="mt-2 text-[14px] leading-relaxed" style="color:#555">{{ $card->description }}</p>
                </div>
                <div class="col-span-12 sm:col-span-4 flex items-center gap-2 sm:justify-end sm:text-right">
                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-[11px] tracking-[0.2em] uppercase lg-btn">✓ {{ $card->solution_tag }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
