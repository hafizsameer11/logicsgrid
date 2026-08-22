<section class="relative py-28 border-t overflow-hidden" style="background:#0a0a0a;border-color:rgba(255,255,255,0.06);color:white">
    <div aria-hidden="true" class="pointer-events-none absolute -top-40 -right-40 w-[640px] h-[640px] rounded-full opacity-[0.18] blur-3xl" style="background:#4ECDC4"></div>
    <div aria-hidden="true" class="pointer-events-none absolute bottom-0 left-1/4 w-[420px] h-[420px] rounded-full opacity-[0.10] blur-3xl" style="background:#4ECDC4"></div>
    <div class="relative mx-auto max-w-[1400px] px-5 sm:px-8">
        <div class="grid grid-cols-12 gap-6 sm:gap-12 items-end mb-20">
            <div class="col-span-12 lg:col-span-8">
                <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#4ECDC4">
                    <span class="h-px w-8" style="background:#4ECDC4"></span>{{ $sections['why_eyebrow'] ?? 'Why LogicsGrid' }}
                </span>
                <h2 class="mt-6 text-[clamp(40px,5.4vw,84px)] font-bold leading-[0.98] tracking-[-0.035em]" style="font-family:'Inter Tight', sans-serif">
                    {{ $sections['why_title'] ?? 'Six reasons they stay.' }}
                </h2>
            </div>
            <p class="col-span-12 lg:col-span-4 text-[15px] leading-relaxed text-white/60">{{ $sections['why_description'] ?? '' }}</p>
        </div>
        <ul class="divide-y" style="border-color:rgba(255,255,255,0.08);border-top-width:1px">
            @foreach($whyReasons as $reason)
            <li class="group relative grid grid-cols-12 gap-3 sm:gap-8 items-baseline py-8 border-b cursor-default" style="border-color:rgba(255,255,255,0.08)">
                <div class="absolute inset-x-0 inset-y-0 -z-0 origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-[600ms]" style="background:linear-gradient(90deg, rgba(74,105,189,0.12), transparent);transform-origin:left"></div>
                <div class="relative col-span-2 lg:col-span-1 text-[12px] tracking-[0.3em] font-semibold" style="color:#4ECDC4">/ {{ str_pad($reason->number, 2, '0', STR_PAD_LEFT) }}</div>
                <h3 class="relative col-span-10 lg:col-span-5 text-[26px] sm:text-[34px] font-semibold tracking-[-0.02em] leading-[1.05] transition-transform duration-500 group-hover:translate-x-2" style="font-family:'Inter Tight', sans-serif">{{ $reason->title }}</h3>
                <p class="relative col-span-12 lg:col-span-5 text-[15px] leading-relaxed text-white/65">{{ $reason->description }}</p>
                <div class="relative col-span-12 lg:col-span-1 lg:justify-self-end opacity-0 group-hover:opacity-100 transition-opacity duration-500 text-[20px]" style="color:#4ECDC4">→</div>
            </li>
            @endforeach
        </ul>
        <div class="mt-14 flex flex-wrap items-center gap-6 text-[12px] tracking-[0.22em] uppercase text-white/50">
            <span class="inline-flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full" style="background:#4ECDC4"></span> Founder-led teams</span>
            <span class="inline-flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full" style="background:#4ECDC4"></span> Outcome guaranteed</span>
            <span class="inline-flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full" style="background:#4ECDC4"></span> Quarterly business reviews</span>
        </div>
    </div>
</section>
