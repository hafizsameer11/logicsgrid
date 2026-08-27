<section class="relative py-28 border-t" style="background:#fafafa;border-color:rgba(0,0,0,0.08)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div class="flex items-end justify-between flex-wrap gap-6 mb-14">
            <div>
                <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000">
                    <span class="h-px w-8" style="background:#000000"></span>{{ $sections['testimonials_eyebrow'] ?? 'What clients say' }}
                </span>
                <h2 class="mt-6 text-[clamp(34px,4.2vw,60px)] font-bold leading-[1.02] tracking-[-0.03em]" style="color:#000000;font-family:'Inter Tight', sans-serif">
                    {{ $sections['testimonials_title'] ?? 'Quiet partners. Loud results.' }}
                </h2>
            </div>
            @if($sections['testimonials_count'] ?? null)
            <div class="text-[12px] tracking-[0.22em] uppercase" style="color:#6b6b6b">{{ $sections['testimonials_count'] }}</div>
            @endif
        </div>
        <div class="grid grid-cols-12 gap-5">
            @foreach($testimonials as $testimonial)
            <figure class="col-span-12 md:col-span-6 lg:col-span-4 rounded-3xl p-8 flex flex-col justify-between border {{ $testimonial->is_dark ? '' : 'bg-white' }}" style="{{ $testimonial->is_dark ? 'background:#000;color:white;border-color:#000' : 'border-color:rgba(0,0,0,0.1)' }}">
                <div class="text-[40px] leading-none" style="color:#4ECDC4;font-family:'Fraunces', serif">&quot;</div>
                <blockquote class="mt-2 text-[18px] leading-[1.45] font-medium" style="font-family:'Inter Tight', sans-serif">{{ $testimonial->quote }}</blockquote>
                <figcaption class="mt-8 pt-6 border-t flex items-center justify-between" style="border-color:{{ $testimonial->is_dark ? 'rgba(255,255,255,0.15)' : 'rgba(0,0,0,0.1)' }}">
                    <div>
                        <div class="text-[13px] font-semibold">{{ $testimonial->author }}</div>
                        @if($testimonial->role)
                        <div class="text-[11px] tracking-[0.18em] uppercase mt-1" style="color:{{ $testimonial->is_dark ? 'rgba(255,255,255,0.6)' : '#6b6b6b' }}">{{ $testimonial->role }}</div>
                        @endif
                    </div>
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-[10px] tracking-[0.18em]" style="background:#4ECDC4;color:#000">★</div>
                </figcaption>
            </figure>
            @endforeach
        </div>
    </div>
</section>
