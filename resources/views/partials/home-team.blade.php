<section class="relative py-28 border-t overflow-hidden" style="background:#E8F4FC;border-color:rgba(0,0,0,0.08)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div class="grid grid-cols-12 gap-6 sm:gap-12 items-end mb-16">
            <div class="col-span-12 lg:col-span-7">
                <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000">
                    <span class="h-px w-8" style="background:#000000"></span>{{ $sections['team_eyebrow'] ?? 'The Team' }}
                </span>
                <h2 class="mt-6 text-[clamp(36px,4.6vw,72px)] font-bold leading-[1.0] tracking-[-0.03em]" style="color:#000000;font-family:'Inter Tight', sans-serif">
                    {{ $sections['team_title'] ?? 'Leaders, not just advisors.' }}
                </h2>
            </div>
            <p class="col-span-12 lg:col-span-5 text-[16px] leading-relaxed" style="color:#333">{{ $sections['team_description'] ?? '' }}</p>
        </div>
        <div class="grid grid-cols-12 gap-5">
            @foreach($teamMembers as $member)
            <div class="lg-card col-span-12 sm:col-span-6 lg:col-span-3 group relative rounded-3xl overflow-hidden bg-white flex flex-col">
                <div class="lg-media relative aspect-[4/5] overflow-hidden" style="background:linear-gradient(160deg, #0F172A 0%, #1E293B 100%)">
                    @if($member->photo)
                    <img src="{{ media_url($member->photo) }}" alt="{{ $member->name }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover grayscale-[20%] group-hover:grayscale-0 transition-all duration-700 group-hover:scale-[1.04]"/>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent"></div>
                    @if($member->role_badge)
                    <div class="absolute top-4 left-4 text-[10px] tracking-[0.28em] uppercase px-3 py-1 rounded-full" style="background:rgba(0,0,0,0.65);color:#4ECDC4;backdrop-filter:blur(6px)">{{ $member->role_badge }}</div>
                    @endif
                    <div class="absolute bottom-4 right-4 w-9 h-9 rounded-full flex items-center justify-center transition-transform duration-500 group-hover:rotate-45 lg-btn">↗</div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-[20px] font-bold tracking-[-0.01em]" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $member->name }}</h3>
                    @if($member->title)
                    <div class="mt-1 text-[12px] tracking-[0.2em] uppercase" style="color:#6b6b6b">{{ $member->title }}</div>
                    @endif
                    @if($member->bio)
                    <p class="mt-4 text-[14px] leading-relaxed" style="color:#444">{{ $member->bio }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-14 flex flex-wrap items-center justify-between gap-6">
            @if($sections['team_footer'] ?? null)
            <div class="text-[14px]" style="color:#333">{{ $sections['team_footer'] }}</div>
            @endif
            <a href="{{ url('/team') }}" style="color:#000000" class="inline-flex items-center gap-3 text-[12px] tracking-[0.22em] uppercase font-semibold group">Meet the full team<span class="transition-transform duration-300 group-hover:translate-x-1">→</span></a>
        </div>
    </div>
</section>
