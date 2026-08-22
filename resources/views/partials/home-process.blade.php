<section class="relative bg-white py-28 border-t" style="border-color:rgba(0,0,0,0.08)">
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8 grid grid-cols-12 gap-6 sm:gap-12">
        <div class="col-span-12 lg:col-span-4 lg:sticky lg:top-28 self-start">
            <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#000000">
                <span class="h-px w-8" style="background:#000000"></span>{{ $sections['process_eyebrow'] ?? 'Process' }}
            </span>
            <h2 class="mt-6 text-[clamp(32px,3.8vw,56px)] font-bold leading-[1.02] tracking-[-0.025em]" style="color:#000000;font-family:'Inter Tight', sans-serif">
                {{ $sections['process_title'] ?? 'Six steps from idea to compounding outcome.' }}
            </h2>
            <p class="mt-6 text-[16px] leading-relaxed max-w-[340px]" style="color:#333333">{{ $sections['process_description'] ?? '' }}</p>
            @if($sections['process_badge'] ?? null)
            <div class="mt-8 inline-flex items-center gap-3 rounded-full border px-4 py-2 text-[11px] tracking-[0.22em] uppercase" style="border-color:rgba(0,0,0,0.18);color:#000000">
                <span class="w-1.5 h-1.5 rounded-full" style="background:#4ECDC4"></span> {{ $sections['process_badge'] }}
            </div>
            @endif
        </div>
        <div class="col-span-12 lg:col-span-8 relative">
            <div class="absolute left-[27px] top-2 bottom-2 w-px" style="background:rgba(0,0,0,0.12)"></div>
            <ol class="space-y-6">
                @foreach($processSteps as $index => $step)
                <li class="relative pl-[72px] rounded-2xl border bg-white px-6 py-6 hover:border-black transition-colors" style="border-color:rgba(0,0,0,0.08)">
                    <div class="absolute left-[7px] top-6 w-10 h-10 rounded-full flex items-center justify-center text-[11px] tracking-[0.18em] font-semibold" style="background:{{ $index === 0 ? '#000000' : 'white' }};color:{{ $index === 0 ? '#4ECDC4' : '#000000' }};border:1.5px solid #000">{{ str_pad($step->number, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="flex flex-wrap items-baseline justify-between gap-3">
                        <div class="flex items-baseline gap-4">
                            <span class="text-[10px] tracking-[0.3em] uppercase" style="color:#6b6b6b">{{ $step->phase }}</span>
                            <h3 class="text-[22px] font-bold tracking-[-0.01em]" style="color:#000000;font-family:'Inter Tight', sans-serif">{{ $step->title }}</h3>
                        </div>
                        @if($step->outcome_label)
                        <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.2em] uppercase px-3 py-1 rounded-full" style="background:#000;color:#4ECDC4">→ {{ $step->outcome_label }}</span>
                        @endif
                    </div>
                    <p class="mt-3 text-[15px] leading-relaxed max-w-[560px]" style="color:#444">{{ $step->description }}</p>
                </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
