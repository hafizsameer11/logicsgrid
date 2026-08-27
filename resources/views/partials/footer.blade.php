@php
    $settings = $settings ?? array_merge(
        \App\Models\SiteSetting::group('site'),
        \App\Models\SiteSetting::group('hero'),
        \App\Models\SiteSetting::group('sections')
    );
    $socialLinks = $socialLinks ?? \App\Models\SocialLink::orderBy('sort_order')->get();
    $email = $settings['email'] ?? 'hi@logicsgrid.com';
    $phone = $settings['phone'] ?? '+234 906 393 9859';
    $phoneHref = 'tel:'.preg_replace('/\s+/', '', $phone);
@endphp
<footer class="relative overflow-hidden" style="background:linear-gradient(180deg,#0B1220 0%,#0F172A 55%,#152238 100%);color:#ffffff">
    <div class="border-b" style="border-color:rgba(255,255,255,0.08)">
        <div class="mx-auto max-w-[1400px] px-5 sm:px-8 py-16 md:py-20 flex flex-col md:flex-row md:items-end md:justify-between gap-10">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-medium" style="color:#4ECDC4">
                    <span class="h-px w-8 origin-left" style="background:#4ECDC4"></span>Let's build something
                </span>
                <h2 class="mt-5 text-[40px] md:text-[64px] leading-[0.95] tracking-tight font-medium" style="font-family:'Fraunces', serif">{{ $settings['footer_tagline'] ?? 'Have an idea worth shipping?' }}</h2>
                <p class="mt-5 text-[14px] md:text-[15px] leading-relaxed max-w-lg" style="color:rgba(255,255,255,0.65);font-family:'Inter Tight', sans-serif">{{ $settings['footer_description'] ?? 'We partner with founders and leaders to design, build and scale digital products that move the needle — not the slide deck.' }}</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ url('/strategy-session') }}" style="display:inline-block">
                    <span class="group relative inline-flex items-center gap-2 rounded-full px-7 py-4 text-[13px] tracking-wide overflow-hidden lg-btn">
                        <span class="relative z-10 inline-flex items-center gap-2">Book a strategy session<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14M13 5l7 7-7 7"></path></svg></span>
                    </span>
                </a>
                <a href="{{ url('/contact') }}" style="display:inline-block">
                    <span class="group relative inline-flex items-center gap-2 rounded-full px-7 py-4 text-[13px] tracking-wide overflow-hidden border" style="border-color:#ffffff;color:#ffffff">
                        <span class="relative z-10 inline-flex items-center gap-2">Get in touch<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14M13 5l7 7-7 7"></path></svg></span>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8 py-16 grid grid-cols-2 md:grid-cols-12 gap-10 md:gap-8">
        <div class="col-span-2 md:col-span-4">
            <a aria-label="LogicsGrid — Home" href="{{ url('/') }}" style="color:#ffffff" class="inline-flex items-center">
                <img src="{{ media_url($settings['logo_light'] ?? 'assets/logicsgrid-logo-horizontal.png') }}" alt="LogicsGrid" class="h-10 w-auto lg-logo-footer"/>
            </a>
            <p class="mt-6 text-[13px] leading-relaxed max-w-sm" style="color:rgba(255,255,255,0.6);font-family:'Inter Tight', sans-serif">A venture studio and product team for ambitious founders. We design, engineer, and scale software — with skin in the game.</p>
            <div class="mt-6 flex flex-col gap-2 text-[13px]" style="color:rgba(255,255,255,0.7);font-family:'Inter Tight', sans-serif">
                <a href="mailto:{{ $email }}" class="hover:text-white transition">{{ $email }}</a>
                <a href="{{ $phoneHref }}" class="hover:text-white transition">{{ $phone }}</a>
                <span style="color:rgba(255,255,255,0.5)">{!! nl2br(e($settings['address'] ?? '')) !!}</span>
            </div>
        </div>
        <div class="md:col-span-3">
            <div class="text-[10px] tracking-[0.3em] uppercase mb-5" style="color:#4ECDC4">Services</div>
            <ul class="flex flex-col gap-3 text-[13px]" style="color:rgba(255,255,255,0.75)">
                <li><a href="{{ url('/venture-building') }}" class="hover:text-white transition">Venture Building</a></li>
                <li><a href="{{ url('/ai-solutions') }}" class="hover:text-white transition">AI Solutions</a></li>
                <li><a href="{{ url('/software-development') }}" class="hover:text-white transition">Software Development</a></li>
                <li><a href="{{ url('/startup-growth') }}" class="hover:text-white transition">Startup Growth</a></li>
                <li><a href="{{ url('/business-digitization') }}" class="hover:text-white transition">Business Digitization</a></li>
            </ul>
        </div>
        <div class="md:col-span-2">
            <div class="text-[10px] tracking-[0.3em] uppercase mb-5" style="color:#4ECDC4">Company</div>
            <ul class="flex flex-col gap-3 text-[13px]" style="color:rgba(255,255,255,0.75)">
                <li><a href="{{ url('/about') }}" class="hover:text-white transition">About</a></li>
                <li><a href="{{ url('/team') }}" class="hover:text-white transition">Team</a></li>
                <li><a href="{{ url('/industries') }}" class="hover:text-white transition">Industries</a></li>
                <li><a href="{{ url('/why-logicsgrid') }}" class="hover:text-white transition">Why LogicsGrid</a></li>
                <li><a href="{{ url('/portfolio') }}" class="hover:text-white transition">Portfolio</a></li>
            </ul>
        </div>
        <div class="col-span-2 md:col-span-3">
            <div class="text-[10px] tracking-[0.3em] uppercase mb-5" style="color:#4ECDC4">Field notes</div>
            <p class="text-[13px] leading-relaxed mb-4" style="color:rgba(255,255,255,0.65);font-family:'Inter Tight', sans-serif">Occasional dispatches on building, shipping and scaling. No fluff.</p>
            <form class="flex items-center gap-0 rounded-full border overflow-hidden" style="border-color:rgba(255,255,255,0.18);background:rgba(255,255,255,0.04)">
                <input type="email" required placeholder="you@company.com" class="flex-1 bg-transparent px-5 py-3 text-[13px] outline-none placeholder:text-white/40" style="color:#ffffff;font-family:'Inter Tight', sans-serif"/>
                <button type="submit" class="lg-btn px-5 py-3 text-[12px] tracking-wide hover:opacity-90 transition" aria-label="Subscribe">→</button>
            </form>
            @if($socialLinks->count())
            <div class="mt-6 flex items-center gap-3">
                @foreach($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" rel="noreferrer" aria-label="{{ $link->label ?? $link->platform }}" class="w-9 h-9 rounded-full border flex items-center justify-center text-[11px] hover:bg-white hover:text-black transition" style="border-color:rgba(255,255,255,0.2);color:rgba(255,255,255,0.85)">{{ $link->label ?? strtoupper(substr($link->platform, 0, 2)) }}</a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <div class="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div class="border-t pt-10 pb-6" style="border-color:rgba(255,255,255,0.1)">
            <div class="text-[18vw] md:text-[14vw] leading-[0.85] tracking-tight font-medium select-none" style="font-family:'Fraunces', serif;color:rgba(255,255,255,0.07)">LOGICSGRID<span style="color:#4ECDC4;opacity:0.5">.</span></div>
        </div>
    </div>
    <div class="border-t" style="border-color:rgba(255,255,255,0.1)">
        <div class="mx-auto max-w-[1400px] px-5 sm:px-8 py-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 text-[11px] tracking-[0.2em] uppercase" style="color:rgba(255,255,255,0.55)">
            <div>{{ $settings['copyright'] ?? '© '.date('Y').' LogicsGrid Technologies Ltd — All rights reserved.' }}</div>
            <div class="flex items-center gap-6 flex-wrap">
                <a href="{{ url('/privacy') }}" class="hover:text-white transition">Privacy</a>
                <a href="{{ url('/terms') }}" class="hover:text-white transition">Terms</a>
                <a href="{{ url('/contact') }}" class="hover:text-white transition">Contact</a>
                <span class="inline-flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full" style="background:#4ECDC4"></span>Available for new work</span>
            </div>
        </div>
    </div>
</footer>
