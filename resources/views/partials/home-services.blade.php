<section class="relative py-28 border-t overflow-hidden" style="background:linear-gradient(180deg, #fafafa 0%, #E8F4FC 100%);border-color:rgba(0,0,0,0.08)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div class="grid grid-cols-12 gap-6 sm:gap-12 items-end mb-16">
            <div class="col-span-12 lg:col-span-7">
                <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000">
                    <span class="h-px w-8" style="background:#000000"></span>{{ $sections['services_eyebrow'] ?? 'Six Ways We Partner' }}
                </span>
                <h2 class="mt-6 text-[clamp(36px,4.8vw,80px)] font-bold leading-[0.98] tracking-[-0.035em]" style="color:#000000;font-family:'Inter Tight', sans-serif">
                    {{ $sections['services_title'] ?? 'What we do, end to end.' }}
                </h2>
            </div>
            <p class="col-span-12 lg:col-span-5 text-[16px] leading-relaxed" style="color:#1a1a1a">{{ $sections['services_description'] ?? '' }}</p>
        </div>
        <div class="grid grid-cols-12 gap-5">
            @foreach($services->take(5) as $service)
            <article class="col-span-12 md:col-span-6 lg:col-span-4 group relative overflow-hidden rounded-3xl border bg-white flex flex-col" style="border-color:rgba(0,0,0,0.1)">
                <div class="relative overflow-hidden aspect-[4/3]">
                    @if($service->image)
                    <img src="{{ media_url($service->image) }}" alt="" loading="lazy" class="w-full h-full object-cover"/>
                    @endif
                    <div class="absolute top-4 left-4 text-[10px] tracking-[0.25em] uppercase px-3 py-1 rounded-full" style="background:#000;color:#4ECDC4">{{ str_pad($service->number, 2, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div class="p-7 flex-1 flex flex-col">
                    <div class="text-[11px] tracking-[0.3em] uppercase" style="color:#6b6b6b">{{ $service->category_label }}</div>
                    <h3 class="mt-4 text-[22px] font-bold leading-tight tracking-[-0.01em]" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $service->title }}</h3>
                    <p class="mt-3 text-[15px] leading-relaxed" style="color:#333333">{{ $service->description }}</p>
                    @if(is_array($service->tags) && count($service->tags))
                    <ul class="mt-5 flex flex-wrap gap-2">
                        @foreach($service->tags as $tag)
                        <li class="text-[11px] tracking-wide px-3 py-1 rounded-full border" style="border-color:rgba(0,0,0,0.12);color:#000000">{{ $tag }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <a href="{{ url('/'.$service->slug) }}" style="color:#000000" class="mt-6 inline-flex items-center gap-2 text-[12px] tracking-[0.22em] uppercase font-semibold group/link">Explore<span class="transition-transform duration-300 group-hover/link:translate-x-1">→</span></a>
                </div>
                <span class="pointer-events-none absolute inset-x-0 bottom-0 h-1 origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500" style="background:#000000"></span>
            </article>
            @endforeach
        </div>
    </div>
</section>
