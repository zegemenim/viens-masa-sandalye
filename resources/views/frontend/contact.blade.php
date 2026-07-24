@extends('layouts.app')

@section('meta_title', 'İletişim | Viens Masa Sandalye')
@section('meta_description', 'Viens Masa Sandalye ile iletişime geçin. Modoko showroom\'umuzu ziyaret edin veya bize ulaşın.')

@section('content')

{{-- ══════════ HERO ══════════ --}}
@php
    $heroImg = !empty($siteSettings['contact_hero_image']) 
        ? asset('storage/' . $siteSettings['contact_hero_image']) 
        : '';
@endphp
<section class="relative bg-brand-navy pt-36 pb-20 md:pt-48 overflow-hidden">
    <div class="absolute left-0 top-0 w-1 h-full bg-brand-gold opacity-40"></div>
    @if($heroImg)
        <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('{{ $heroImg }}')"></div>
    @else
        <div class="absolute inset-0 opacity-5" aria-hidden="true">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, #DCA54A 0, #DCA54A 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>
        </div>
    @endif
    <div class="relative z-10 max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10 text-center">
        <p class="section-label mb-4" data-aos="fade-up">İletişim</p>
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4" data-aos="fade-up" data-aos-delay="200">
            {{ $siteSettings['contact_title'] ?? 'Bize Ulaşın' }}
        </h1>
        <div class="w-16 h-0.5 bg-brand-gold mx-auto mb-5" data-aos="zoom-in" data-aos-delay="300"></div>
        <p class="text-white/60 max-w-xl mx-auto text-sm leading-relaxed" data-aos="fade-up" data-aos-delay="400">
            {{ $siteSettings['contact_desc'] ?? 'Sorularınız, önerileriniz veya özel sipariş talepleriniz için bizimle iletişime geçebilirsiniz. Size yardımcı olmaktan mutluluk duyarız.' }}
        </p>
    </div>
</section>

{{-- ══════════ CONTACT MAIN ══════════ --}}
<section class="py-20 bg-brand-cream">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14">

            {{-- Info Column --}}
            <div data-aos="fade-right">
                <p class="section-label mb-4">Bizi Bulun</p>
                <h2 class="font-display text-3xl font-bold text-brand-navy mb-6 leading-tight">
                    Showroom'umuzu<br>Ziyaret Edin
                </h2>
                <div class="section-divider mb-8"></div>

                <div class="space-y-7">
                    {{-- Address --}}
                    <div class="flex gap-5">
                        <div class="w-12 h-12 bg-brand-navy flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-brand-navy mb-1">Adres</h3>
                            <p class="text-brand-gray text-sm leading-relaxed">
                                Modoko, Barbaros Hayrettin Paşa Cad.<br>
                                İstanbul, Türkiye
                            </p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="flex gap-5">
                        <div class="w-12 h-12 bg-brand-navy flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-brand-navy mb-1">Telefon</h3>
                            <a href="tel:+905522802929" class="text-brand-gray text-sm hover:text-brand-gold transition-colors">+90 552 280 29 29</a>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="flex gap-5">
                        <div class="w-12 h-12 bg-[#25D366] flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 448 512">
                                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-brand-navy mb-1">WhatsApp</h3>
                            <a href="https://wa.me/905522802929" target="_blank" rel="noopener noreferrer" class="text-brand-gray text-sm hover:text-brand-gold transition-colors">+90 552 280 29 29 ile mesaj gönderin</a>
                        </div>
                    </div>

                    {{-- Instagram --}}
                    <div class="flex gap-5">
                        <div class="w-12 h-12 bg-[#E4405F] flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 448 512">
                                <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.2C8.9 95.6.7 127.4-.9 163.3c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-brand-navy mb-1">Instagram</h3>
                            <a href="https://www.instagram.com/viensmasasandalye" target="_blank" rel="noopener noreferrer" class="text-brand-gray text-sm hover:text-brand-gold transition-colors">@viensmasasandalye</a>
                        </div>
                    </div>

                    {{-- Hours --}}
                    <div class="flex gap-5">
                        <div class="w-12 h-12 bg-brand-navy flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-brand-navy mb-1">Çalışma Saatleri</h3>
                            <p class="text-brand-gray text-sm leading-relaxed">
                                Pzt – Cmt: 09:00 – 18:30<br>
                                Pazar: 10:00 – 17:00
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-wrap gap-4 mt-10">
                    <a href="https://wa.me/905522802929" target="_blank" rel="noopener noreferrer" class="btn-gold">
                        WhatsApp ile Yaz
                    </a>
                    <a href="tel:+905522802929" class="btn-outline-gold">
                        Ara
                    </a>
                </div>
            </div>

            {{-- Map Column --}}
            <div class="flex flex-col gap-6" data-aos="fade-left">
                {{-- Map Embed --}}
                <div class="relative overflow-hidden bg-brand-navy aspect-[4/3] lg:aspect-auto lg:flex-1">
                    @if(!empty($siteSettings['map_embed_url']))
                        <iframe
                            src="{{ $siteSettings['map_embed_url'] }}"
                            title="Viens Masa Sandalye Konum"
                            class="w-full h-full min-h-[350px] border-0 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-500"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @else
                        {{-- Placeholder when no src --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-3 text-white/20 pointer-events-none">
                            <svg class="w-14 h-14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="font-display text-sm tracking-wider">Modoko, İstanbul</span>
                            <span class="text-xs opacity-60">Harita görüntülemek için Google Maps API ekleyin</span>
                        </div>
                    @endif
                </div>

                {{-- Quick Contact Card --}}
                <div class="bg-brand-navy p-8" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="font-display font-bold text-white text-xl mb-2">Hızlı İletişim</h3>
                    <p class="text-white/50 text-sm mb-6">Aşağıdaki kanallardan bize anında ulaşabilirsiniz.</p>
                    <div class="space-y-3">
                        <a href="https://wa.me/905522802929?text=Merhaba, bilgi almak istiyorum."
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center gap-3 bg-white/5 hover:bg-white/10 border border-white/10 px-5 py-4 transition-colors group">
                            <svg class="w-5 h-5 text-[#25D366]" fill="currentColor" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                            <div>
                                <p class="font-display font-semibold text-white text-sm">WhatsApp</p>
                                <p class="text-white/50 text-xs">+90 552 280 29 29</p>
                            </div>
                            <svg class="w-4 h-4 text-white/30 ml-auto group-hover:text-brand-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="https://www.instagram.com/viensmasasandalye"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center gap-3 bg-white/5 hover:bg-white/10 border border-white/10 px-5 py-4 transition-colors group">
                            <svg class="w-5 h-5 text-[#E4405F]" fill="currentColor" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.2C8.9 95.6.7 127.4-.9 163.3c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                            <div>
                                <p class="font-display font-semibold text-white text-sm">Instagram</p>
                                <p class="text-white/50 text-xs">@viensmasasandalye</p>
                            </div>
                            <svg class="w-4 h-4 text-white/30 ml-auto group-hover:text-brand-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
