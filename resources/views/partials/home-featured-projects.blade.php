<section class="relative bg-white py-28 border-t" style="border-color:rgba(0,0,0,0.08)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div class="grid grid-cols-12 gap-6 sm:gap-12 items-end mb-16">
            <div class="col-span-12 lg:col-span-8">
                <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000">
                    <span class="h-px w-8" style="background:#000000"></span>{{ $sections['featured_eyebrow'] ?? 'Featured Work' }}
                </span>
                <h2 class="mt-6 text-[clamp(36px,4.6vw,72px)] font-bold leading-[1.0] tracking-[-0.03em]" style="color:#000000;font-family:'Inter Tight', sans-serif">
                    {{ $sections['featured_title'] ?? "Recent things we've shipped." }}
                </h2>
            </div>
            <a href="{{ url('/portfolio') }}" style="color:#000000" class="col-span-12 lg:col-span-4 lg:justify-self-end inline-flex items-center gap-3 text-[12px] tracking-[0.22em] uppercase font-semibold group">See full portfolio<span class="transition-transform duration-300 group-hover:translate-x-1">→</span></a>
        </div>
        <div class="flex flex-col">
            @foreach($featuredProjects as $index => $project)
            @php
                $isAlt = $index % 2 === 1;
                $numClass = $isAlt ? 'lg:order-3' : '';
                $imgClass = $isAlt ? 'lg:order-2' : '';
                $contentClass = $isAlt ? 'lg:order-1' : '';
            @endphp
            <article class="group grid grid-cols-12 gap-4 sm:gap-8 items-stretch py-10 border-t" style="border-color:rgba(0,0,0,0.1)">
                <div class="col-span-12 lg:col-span-2 flex lg:flex-col justify-between lg:justify-start {{ $numClass }}">
                    <div class="text-[64px] lg:text-[88px] font-bold leading-none tracking-[-0.04em]" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="lg:mt-6 text-[10px] tracking-[0.3em] uppercase" style="color:#6b6b6b">
                        @if($project->year)<div>{{ $project->year }}</div>@endif
                        @if($project->engagement_type)<div class="mt-1">{{ $project->engagement_type }}</div>@endif
                    </div>
                </div>
                <a href="{{ url('/portfolio/'.$project->slug) }}" class="lg-media col-span-12 lg:col-span-6 relative aspect-[16/10] lg:aspect-auto overflow-hidden rounded-2xl {{ $imgClass }}" style="box-shadow:0 28px 60px -36px rgba(15,23,42,0.4)">
                    @if($project->cover_image)
                    <img src="{{ media_url($project->cover_image) }}" alt="{{ $project->title }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover"/>
                    @endif
                    <div class="absolute inset-0 ring-1 ring-inset ring-black/5 rounded-2xl"></div>
                </a>
                <div class="col-span-12 lg:col-span-4 flex flex-col justify-between {{ $contentClass }}">
                    <div>
                        @if($project->category)
                        <span class="inline-flex items-center gap-2 text-[10px] tracking-[0.28em] uppercase px-3 py-1 rounded-full border" style="border-color:rgba(0,0,0,0.15);color:#000000">
                            <span class="w-1.5 h-1.5 rounded-full" style="background:#4ECDC4"></span> {{ $project->category }}
                        </span>
                        @endif
                        <h3 class="mt-5 text-[28px] sm:text-[34px] font-bold leading-[1.05] tracking-[-0.02em]" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $project->title }}</h3>
                    </div>
                    @if($project->featured_stat_value)
                    <div class="mt-8">
                        <div class="flex items-baseline gap-4">
                            <div class="text-[44px] font-bold leading-none tracking-[-0.03em]" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $project->featured_stat_value }}</div>
                            @if($project->featured_stat_label)
                            <div class="text-[12px] uppercase tracking-[0.2em] max-w-[160px]" style="color:#555">{{ $project->featured_stat_label }}</div>
                            @endif
                        </div>
                        <a href="{{ url('/portfolio/'.$project->slug) }}" style="color:#000000" class="mt-6 inline-flex items-center gap-2 text-[12px] tracking-[0.22em] uppercase font-semibold group/link">Read case study<span class="transition-transform duration-300 group-hover/link:translate-x-1">→</span></a>
                    </div>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
