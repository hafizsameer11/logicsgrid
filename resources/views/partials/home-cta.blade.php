@php
    $settings = $settings ?? $sections ?? [];
    $email = $settings['email'] ?? 'hi@logicsgrid.com';
@endphp
<section class="relative overflow-hidden py-32 border-t" style="background:linear-gradient(180deg, #E8F4FC 0%, #ffffff 100%);border-color:rgba(0,0,0,0.08)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8 text-center">
        <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000">
            <span class="h-px w-8" style="background:#000000"></span>{{ $sections['cta_eyebrow'] ?? 'Start The Conversation' }}
        </span>
        <h2 class="mt-8 mx-auto max-w-4xl font-bold leading-[1.02] tracking-[-0.03em] text-[clamp(40px,5.6vw,92px)]" style="color:#000000;font-family:'Inter Tight', sans-serif">
            {{ $sections['cta_title'] ?? 'Build it. Scale it. Operate it.' }}
        </h2>
        <p class="mt-8 mx-auto max-w-2xl text-[17px] leading-relaxed" style="color:#333333">{{ $sections['cta_description'] ?? '' }}</p>
        <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ url('/strategy-session') }}" class="group relative inline-flex items-center gap-2 rounded-full px-7 py-4 text-[13px] tracking-wide overflow-hidden lg-btn">
                <span class="relative z-10 inline-flex items-center gap-2">Book A Strategy Session<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14M13 5l7 7-7 7"></path></svg></span>
            </a>
            <a href="mailto:{{ $email }}" class="group relative inline-flex items-center gap-2 rounded-full px-7 py-4 text-[13px] tracking-wide overflow-hidden border" style="border-color:#000000;color:#000000">
                <span class="relative z-10 inline-flex items-center gap-2">Email The Team<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14M13 5l7 7-7 7"></path></svg></span>
            </a>
        </div>
        @if($sections['cta_tagline'] ?? null)
        <div class="mt-10 text-[12px] tracking-[0.3em] uppercase" style="color:#6b6b6b">{{ $sections['cta_tagline'] }}</div>
        @endif
    </div>
</section>
