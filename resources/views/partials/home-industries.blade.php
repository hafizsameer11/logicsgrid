<section class="relative bg-white py-28 border-t" style="border-color:rgba(0,0,0,0.08)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div class="grid grid-cols-12 gap-6 sm:gap-12 items-end mb-14">
            <div class="col-span-12 lg:col-span-7">
                <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000">
                    <span class="h-px w-8" style="background:#000000"></span>{{ $sections['industries_eyebrow'] ?? 'Industries We Serve' }}
                </span>
                <h2 class="mt-6 text-[clamp(34px,4.2vw,64px)] font-bold leading-[1.0] tracking-[-0.03em]" style="color:#000000;font-family:'Inter Tight', sans-serif">
                    {{ $sections['industries_title'] ?? 'Cross-industry, never generic.' }}
                </h2>
            </div>
            <p class="col-span-12 lg:col-span-5 text-[16px] leading-relaxed" style="color:#333333">{{ $sections['industries_description'] ?? '' }}</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
            @foreach($industries as $industry)
            <a href="{{ url('/industries') }}" class="group relative aspect-[5/4] rounded-2xl border p-5 flex flex-col justify-between overflow-hidden hover:bg-black transition-colors cursor-default" style="border-color:rgba(0,0,0,0.15);color:#000000">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] tracking-[0.3em] uppercase opacity-60 group-hover:opacity-100 group-hover:text-[#4ECDC4] transition" style="color:inherit">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="w-2 h-2 rounded-full transition-colors" style="background:#4ECDC4"></span>
                </div>
                <div class="text-[17px] sm:text-[19px] font-bold tracking-[-0.01em] leading-tight group-hover:text-white transition-colors" style="font-family:'Inter Tight', sans-serif">{{ $industry->name }}</div>
                <div class="text-[10px] tracking-[0.25em] uppercase opacity-0 group-hover:opacity-100 transition" style="color:#4ECDC4">Explore →</div>
            </a>
            @endforeach
        </div>
    </div>
</section>
