@extends('layouts.app')

@section('meta_title', 'Viens Masa Sandalye | Ana Sayfa')
@section('meta_description', 'Viens Masa Sandalye – 30 yıllık deneyimle modern ve şık masa sandalye koleksiyonları. Modoko\'daki geniş showroom\'umuzda sizi bekliyoruz.')
@section('meta_keywords', 'masa sandalye, yemek odası mobilyası, viens, modoko, istanbul mobilya')

@section('content')

{{-- ══════════════════════════════════════════════════════════
     1. HERO — FULL-SCREEN VIDEO / IMAGE
     ══════════════════════════════════════════════════════════ --}}
<section id="hero" class="relative h-screen flex flex-col justify-center overflow-hidden bg-brand-dark pt-20">

    {{-- Background Video --}}
    <div class="absolute inset-0 z-0">
        {{-- ► Buraya showroom videonuzun URL'sini src="" içine yapıştırın --}}
        <video
            id="hero-video"
            autoplay
            muted
            loop
            playsinline
            preload="metadata"
            poster=""
            class="w-full h-full object-cover"
            aria-hidden="true"
        >
            @if(!empty($siteSettings['hero_video_url']))
                @php
                    $heroVid = Str::startsWith($siteSettings['hero_video_url'], 'http') ? $siteSettings['hero_video_url'] : asset('storage/' . $siteSettings['hero_video_url']);
                @endphp
                <source src="{{ $heroVid }}" type="video/mp4">
            @endif
            {{-- Fallback image if video doesn't load --}}
            <img src="" alt="Viens Showroom" class="w-full h-full object-cover">
        </video>

        {{-- Multi-layer gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-brand-dark/90 via-brand-dark/60 to-brand-dark/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/70 via-transparent to-brand-dark/20"></div>
    </div>

    {{-- Decorative vertical gold line --}}
    <div class="absolute left-0 top-0 h-full w-[3px] bg-gradient-to-b from-transparent via-brand-gold to-transparent z-10 opacity-60" aria-hidden="true"></div>

    {{-- Hero Content --}}
    <div class="relative z-10 w-full max-w-[1400px] mx-auto px-5 lg:px-10 flex-1 flex flex-col justify-center">
        <div class="max-w-3xl">
            {{-- Label --}}
            <div class="flex items-center gap-4 mb-8" data-aos="fade-right">
                <div class="w-12 h-[1px] bg-brand-gold"></div>
                <span class="text-white/60 text-[0.65rem] font-display tracking-[0.3em] uppercase">Premium Mobilya</span>
            </div>

            {{-- Heading --}}
            <h1 class="font-display font-light text-white leading-[1.1] mb-8 text-5xl sm:text-7xl lg:text-[5.5rem] tracking-tight" data-aos="fade-up" data-aos-delay="200">
                {!! $siteSettings['home_hero_title'] ?? 'Estetik ve Konforun<br><span class="text-brand-gold font-serif italic pr-4">Mükemmel</span> Uyumu' !!}
            </h1>

            {{-- Sub --}}
            <p class="text-white/70 text-sm sm:text-base leading-loose font-serif mb-12 max-w-lg" data-aos="fade-up" data-aos-delay="400">
                {{ $siteSettings['home_hero_subtitle'] ?? '30 yılı aşkın tecrübemizle İstanbul Modoko\'da, zamanın ötesinde tasarımları ve eşsiz konforu sizlerle buluşturuyoruz.' }}
            </p>

            {{-- CTAs --}}
            <div class="flex flex-wrap gap-6 items-center" data-aos="fade-up" data-aos-delay="500">
                <a href="{{ route('category.show', 'masalar') }}" class="group flex items-center gap-3 border border-brand-gold px-8 py-4 text-brand-gold hover:bg-brand-gold hover:text-white transition-all duration-500">
                    <span class="font-display text-[0.7rem] tracking-[0.2em] uppercase">Koleksiyonu Keşfet</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- Trust badges --}}
            <div class="flex flex-wrap gap-6 mt-14 pt-8 border-t border-white/15" data-aos="fade-up" data-aos-delay="600">
                @foreach(['30+ Yıllık Deneyim', '1.000+ Mutlu Müşteri', '400m² Showroom'] as $badge)
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-brand-gold"></div>
                    <span class="text-white/60 text-xs font-display font-semibold tracking-wider uppercase">{{ $badge }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-10 lg:left-10 z-20 flex flex-col items-center gap-3" aria-hidden="true">
        <span class="text-white/40 text-[0.55rem] font-display tracking-[0.3em] uppercase" style="writing-mode: vertical-rl;">Aşağı Kaydır</span>
        <div class="w-[1px] h-12 bg-white/20 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1/2 bg-brand-gold animate-[bounce_2s_infinite]"></div>
        </div>
    </div>

    {{-- Video mute/unmute toggle --}}
    <button
        id="video-toggle"
        class="absolute bottom-10 right-6 z-20 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white transition-all"
        title="Sesi aç/kapat"
        aria-label="Video sesini aç/kapat"
    >
        <svg id="icon-mute" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
        </svg>
        <svg id="icon-unmute" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072M12 6v12m-3.536-9.536a5 5 0 000 7.072M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
        </svg>
    </button>
</section>

{{-- ══════════════════════════════════════════════════════════
     2. CATEGORY STRIP
     ══════════════════════════════════════════════════════════ --}}
<section class="bg-white border-b border-brand-cream-mid">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">
        <div class="flex items-stretch divide-x divide-brand-cream-mid overflow-x-auto">
            @forelse($categories ?? [] as $cat)
            <a href="{{ route('category.show', $cat->slug) }}"
               class="flex-shrink-0 flex flex-col items-center justify-center gap-1.5 px-10 py-6 hover:bg-brand-cream transition-colors group">
                <span class="font-display font-bold text-brand-navy text-sm group-hover:text-brand-gold transition-colors">{{ $cat->name }}</span>
                <span class="text-brand-gray/50 text-[0.65rem] font-display">{{ $cat->products_count }} ürün</span>
            </a>
            @empty
            @foreach(['Masalar', 'Sandalyeler', 'Yemek Odası', 'Bar Sandalyeleri'] as $n)
            <a href="#" class="flex-shrink-0 flex flex-col items-center justify-center gap-1.5 px-10 py-6 hover:bg-brand-cream transition-colors group">
                <span class="font-display font-bold text-brand-navy text-sm group-hover:text-brand-gold transition-colors">{{ $n }}</span>
            </a>
            @endforeach
            @endforelse
            <a href="{{ route('category.show', 'masalar') }}"
               class="flex-shrink-0 flex items-center justify-center gap-2 px-10 py-6 bg-brand-gold hover:bg-brand-gold-dark transition-colors group">
                <span class="font-display font-bold text-white text-sm">Tümü</span>
                <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     3. ABOUT / SPLIT INFO
     ══════════════════════════════════════════════════════════ --}}
<section id="hakkimizda" class="py-28 bg-white">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Image --}}
            <div class="relative order-1" data-aos="fade-right">
                <div class="aspect-[4/3] bg-brand-cream-mid overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1000&auto=format&fit=crop&q=80" alt="Viens Showroom İç Görünüm" class="w-full h-full object-cover" loading="lazy">
                </div>
                {{-- Decorative elements --}}
                <div class="absolute -bottom-6 -left-6 w-32 h-32 border-2 border-brand-gold/20 -z-10"></div>
                <div class="absolute -top-6 -right-6 w-20 h-20 bg-brand-gold/10 -z-10"></div>
                {{-- Experience badge --}}
                <div class="absolute bottom-6 right-6 bg-brand-gold p-5 shadow-xl" data-aos="zoom-in" data-aos-delay="200">
                    <p class="font-display text-white text-3xl font-bold leading-none">30+</p>
                    <p class="font-display text-white/80 text-[0.6rem] font-semibold tracking-widest uppercase mt-1">Yıllık Deneyim</p>
                </div>
            </div>

            {{-- Text --}}
            <div class="order-2" data-aos="fade-left">
                <p class="section-label mb-4">Hakkımızda</p>
                <h2 class="font-display text-4xl font-bold text-brand-navy mb-6 leading-tight">
                    {!! $siteSettings['home_about_title'] ?? 'Mekanın Ruhu, Mobilyanın Kusursuzluğunda Gizlidir' !!}
                </h2>
                <div class="section-divider mb-8"></div>
                <div class="text-brand-gray leading-relaxed mb-10 space-y-5">
                    {!! nl2br(e($siteSettings['home_about_desc'] ?? 'Viens Masa Sandalye olarak, 1994\'ten beri ustalığı estetikle harmanlıyoruz. Modoko\'daki showroomumuzda, her detayında özen olan koleksiyonlarımızı keşfedin.')) !!}
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('category.show', 'sandalyeler') }}" class="btn-gold">
                        Sandalyeleri İncele
                    </a>
                    <a href="{{ route('about') }}" class="btn-outline-gold">
                        Biz Kimiz?
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     4. STATS
     ══════════════════════════════════════════════════════════ --}}
<section id="rakamlarda" class="bg-brand-navy py-0">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-y divide-white/10 border border-white/10">
            @foreach([
                ['number' => '30+',    'label' => 'Yıllık Tecrübe'],
                ['number' => '100+',   'label' => 'Ürün Seçeneği'],
                ['number' => '1.000+', 'label' => 'Mutlu Müşteri'],
                ['number' => '400m²',  'label' => 'Showroom Alanı'],
            ] as $stat)
            <div class="stat-item py-12">
                <div class="stat-item__number">{{ $stat['number'] }}</div>
                <div class="stat-item__label text-white/40">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     5. FEATURED PRODUCTS
     ══════════════════════════════════════════════════════════ --}}
<section id="urun-katalogu" class="py-28 bg-brand-cream">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-14">
            <div data-aos="fade-up">
                <p class="section-label mb-3">Öne Çıkanlar</p>
                <h2 class="font-display text-4xl font-bold text-brand-navy">{{ $siteSettings['home_catalog_title'] ?? 'Ürün Kataloğu' }}</h2>
            </div>
            <a href="{{ route('category.show', 'masalar') }}"
               class="inline-flex items-center gap-2 text-brand-gold font-display font-semibold text-sm tracking-wide uppercase border-b-2 border-brand-gold pb-1 hover:opacity-70 transition-opacity flex-shrink-0">
                Tümünü Gör
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($featuredProducts ?? [] as $product)
            @php
                $featImg = $product->image_path 
                    ? (\Illuminate\Support\Str::startsWith($product->image_path, 'http') ? $product->image_path : asset('storage/' . $product->image_path)) 
                    : 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600&auto=format&fit=crop&q=80';
            @endphp
            <a href="{{ route('product.show', $product->slug) }}"
               class="product-card group block bg-white border border-brand-cream-mid hover:shadow-lg transition-all duration-300"
               id="product-{{ $product->id }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="aspect-square bg-brand-cream-mid overflow-hidden">
                    <img src="{{ $featImg }}"
                         alt="{{ $product->name }}"
                         class="product-card__img w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                </div>
                <div class="p-4 border-t border-brand-cream-mid">
                    @if($product->category)
                        <p class="text-[0.6rem] font-display font-semibold tracking-[0.14em] text-brand-gold uppercase mb-1">{{ $product->category->name }}</p>
                    @endif
                    <h3 class="font-display font-semibold text-brand-navy text-sm leading-snug mb-2 line-clamp-2 group-hover:text-brand-gold transition-colors">{{ $product->name }}</h3>
                    <p class="font-display font-bold text-brand-gray text-base">
                        {{ $product->price ? '₺' . number_format($product->price, 0, ',', '.') : 'Fiyat için arayın' }}
                    </p>
                </div>
            </a>
            @empty
            @foreach(['Umay Sandalye', 'Lara Masa', 'Nora Sandalye', 'Vera Masa Takımı', 'Enzo Bar Sandalyesi', 'Roma Yemek Masası', 'Sena Sandalye', 'Kyra Masa'] as $name)
            <div class="product-card">
                <div class="aspect-square bg-brand-cream-mid flex items-center justify-center">
                    <svg class="w-10 h-10 text-brand-gold/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="p-4 border-t border-brand-cream-mid">
                    <h3 class="font-display font-semibold text-brand-navy text-sm">{{ $name }}</h3>
                    <p class="font-display font-bold text-brand-gray text-base mt-1">Fiyat için arayın</p>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     6. SHOWROOM VIDEO BANNER
     ══════════════════════════════════════════════════════════ --}}
<section id="showroom-video" class="relative h-[70vh] overflow-hidden bg-brand-dark">
    {{-- ► Buraya showroom tanıtım videonuzu ekleyin --}}
    <video
        autoplay
        muted
        loop
        playsinline
        preload="none"
        poster=""
        class="absolute inset-0 w-full h-full object-cover"
        aria-hidden="true"
    >
        @if(!empty($siteSettings['showroom_video_url']))
            @php
                $showVid = Str::startsWith($siteSettings['showroom_video_url'], 'http') ? $siteSettings['showroom_video_url'] : asset('storage/' . $siteSettings['showroom_video_url']);
            @endphp
            <source src="{{ $showVid }}" type="video/mp4">
        @endif
        <img src="" alt="Viens Showroom" class="w-full h-full object-cover">
    </video>

    {{-- Gradient overlay --}}
    <div class="absolute inset-0 bg-brand-dark/70 flex items-center justify-center">
        <div class="text-center px-5" data-aos="zoom-in">
            <p class="section-label mb-5">Showroom Turumuz</p>
            <h2 class="font-display text-white text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 max-w-2xl mx-auto leading-tight">
                {!! $siteSettings['home_showroom_title'] ?? '400 m² Showroom\'u<br><span class="text-brand-gold">Keşfedin</span>' !!}
            </h2>
            <p class="text-white/60 mb-10 max-w-md mx-auto text-sm leading-relaxed">
                {{ $siteSettings['home_showroom_desc'] ?? 'Modoko\'daki geniş showroom\'umuzda 100\'den fazla model ürünü bizzat görüp deneyimleyebilirsiniz.' }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('about') }}" class="btn-gold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Showroom'u Keşfet
                </a>
                <a href="{{ route('contact') }}" class="btn-outline-white">
                    Randevu Al
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     7. WHY US
     ══════════════════════════════════════════════════════════ --}}
<section id="neden-viens" class="py-28 bg-white">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <p class="section-label mb-3">Neden Biz?</p>
            <h2 class="font-display text-4xl font-bold text-brand-navy heading-line">{{ $siteSettings['home_whyus_title'] ?? 'Farkımız Ne?' }}</h2>
            @if(!empty($siteSettings['home_whyus_desc']))
                <p class="text-brand-gray mt-5 max-w-2xl mx-auto">{{ $siteSettings['home_whyus_desc'] }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['path' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Kalite Garantisi', 'desc' => 'Tüm ürünlerimiz uzun soluklu kullanım için en yüksek kalite standartlarında üretilmektedir.'],
                ['path' => 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z', 'title' => 'Geniş Koleksiyon', 'desc' => '100\'den fazla ürün seçeneğiyle her zevke ve bütçeye uygun masa ve sandalye modelleri.'],
                ['path' => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z', 'title' => 'Uzman Danışmanlık', 'desc' => '30 yıllık tecrübemizle size özel dekorasyon ve ürün seçimi konusunda uzman destek sağlıyoruz.'],
                ['path' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'title' => 'Hızlı Teslimat', 'desc' => 'İstanbul ve çevresi için hızlı teslimat seçenekleri ile yeni mobilyanıza kısa sürede kavuşun.'],
                ['path' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'title' => 'Müşteri Memnuniyeti', 'desc' => '1.000\'den fazla mutlu müşterimizle güçlenen deneyimimiz, sizin için en iyiyi sunma taahhüdümüzdür.'],
                ['path' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'title' => '400 m² Showroom', 'desc' => 'Modoko\'nun kalbindeki geniş showroom\'umuzda ürünleri bizzat görüp deneyimleyebilirsiniz.'],
            ] as $f)
            <div class="group p-8 border border-brand-cream-mid hover:border-brand-gold hover:shadow-xl transition-all duration-300 bg-white" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="w-12 h-12 bg-brand-cream-mid group-hover:bg-brand-gold flex items-center justify-center mb-6 transition-colors duration-300">
                    <svg class="w-6 h-6 text-brand-gold group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['path'] }}"/>
                    </svg>
                </div>
                <h3 class="font-display font-bold text-brand-navy text-xl mb-3">{{ $f['title'] }}</h3>
                <p class="text-brand-gray text-sm leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     8. PARALLAX IMAGE BANNER
     ══════════════════════════════════════════════════════════ --}}
<section id="galeri" class="relative py-32 lg:py-48 overflow-hidden flex items-center justify-center bg-brand-charcoal">
    @php
        $parallaxImg = !empty($siteSettings['home_parallax_image']) 
            ? asset('storage/' . $siteSettings['home_parallax_image']) 
            : 'https://images.unsplash.com/photo-1615066390971-03e4e1c36ddf?w=1600&auto=format&fit=crop&q=80';
    @endphp
    <div class="absolute inset-0 bg-fixed bg-center bg-cover bg-no-repeat transition-transform duration-[1.5s]" style="background-image: url('{{ $parallaxImg }}');"></div>
    <div class="absolute inset-0 bg-brand-navy/60"></div>
    <div class="relative z-10 text-center px-5 max-w-2xl" data-aos="fade-up">
        <p class="section-label mb-4 text-brand-gold">Modoko, İstanbul</p>
        <h2 class="font-display text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">Yıllarca Sürecek<br>Kalite ve Zarafet</h2>
        <a href="{{ route('about') }}" class="btn-outline-white inline-block">Hakkımızda Daha Fazlası</a>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     9. CONTACT / MAP BAND
     ══════════════════════════════════════════════════════════ --}}
<section id="iletisim-bant" class="bg-brand-navy">
    <div class="grid grid-cols-1 lg:grid-cols-2">

        {{-- Map --}}
        <div class="relative h-72 lg:h-auto min-h-[380px] bg-brand-charcoal overflow-hidden" data-aos="fade-right">
            @if(!empty($siteSettings['map_embed_url']))
                <iframe
                    src="{{ $siteSettings['map_embed_url'] }}"
                    title="Viens Masa Sandalye Konum"
                    class="w-full h-full border-0 grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-500"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            @else
                <div class="absolute inset-0 flex flex-col items-center justify-center gap-3 text-white/15 pointer-events-none">
                    <svg class="w-14 h-14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="font-display text-sm tracking-wide">Modoko, İstanbul</span>
                </div>
            @endif
        </div>

        {{-- Text --}}
        <div class="flex flex-col justify-center px-8 sm:px-14 lg:px-16 py-16 lg:py-20" data-aos="fade-left">
            <p class="section-label mb-4">Ziyaret Edin</p>
            <h2 class="font-display text-white text-3xl sm:text-4xl font-bold leading-tight mb-5">
                {!! $siteSettings['contact_visit_title'] ?? 'En İyi Masa Sandalye İçin<br><span class="text-brand-gold">Görüşmeleriniz</span> Bekliyoruz' !!}
            </h2>
            <p class="text-white/55 leading-relaxed mb-8 text-sm max-w-sm">
                {{ $siteSettings['contact_visit_desc'] ?? 'Modoko\'nun kalbinde, geniş showroom\'umuzda sizi ağırlamaktan memnuniyet duyarız.' }}
            </p>
            <ul class="space-y-3 mb-10 text-white/60 text-sm">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-brand-gold flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Modoko, Barbaros Hayrettin Paşa Cad. İstanbul
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-brand-gold flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <a href="tel:+905522802929" class="hover:text-brand-gold transition-colors">+90 552 280 29 29</a>
                </li>
            </ul>
            <a href="{{ route('contact') }}" class="btn-outline-gold self-start">Bize Ulaşın</a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     10. INSTAGRAM FEED
     ══════════════════════════════════════════════════════════ --}}
<section id="instagram" class="py-28 bg-brand-cream">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">
        <div class="text-center mb-14" data-aos="fade-up">
            <p class="section-label mb-3">Sosyal Medya</p>
            <h2 class="font-display text-4xl font-bold text-brand-navy heading-line">
                Instagram'da Keşfedin
            </h2>
            <a href="https://www.instagram.com/viensmasasandalye"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-block mt-5 text-brand-gold font-display text-sm font-semibold tracking-wide hover:opacity-70 transition-opacity">
                @viensmasasandalye &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($instagramPosts ?? [[], [], []] as $post)
            <div class="bg-white border border-brand-cream-mid hover:shadow-lg transition-shadow overflow-hidden group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}">
                {{-- Header --}}
                <div class="flex items-center gap-3 px-4 py-3 border-b border-brand-cream-mid">
                    <div class="w-8 h-8 rounded-full bg-brand-gold flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.2C8.9 95.6.7 127.4-.9 163.3c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                    </div>
                    <span class="font-display font-semibold text-brand-navy text-sm">viensmasasandalye</span>
                </div>
                {{-- Media --}}
                <a href="{{ $post['url'] ?? 'https://www.instagram.com/viensmasasandalye' }}"
                   target="_blank" rel="noopener noreferrer"
                   class="block relative aspect-square bg-brand-cream-mid overflow-hidden">
                    @if(!empty($post['image']))
                        <img src="{{ $post['image'] }}" alt="{{ $post['caption'] ?? 'Instagram Gönderi' }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center text-brand-gold/20">
                            <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.2C8.9 95.6.7 127.4-.9 163.3c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-brand-navy/0 group-hover:bg-brand-navy/20 transition-colors duration-300 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </div>
                </a>
                {{-- Caption --}}
                <div class="px-4 py-3">
                    <p class="text-brand-gray text-sm leading-relaxed line-clamp-2">
                        {{ $post['caption'] ?? 'Modern tasarım ve dayanıklılığın buluştuğu nokta. Yeni koleksiyonumuzu keşfedin...' }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="https://www.instagram.com/viensmasasandalye" target="_blank" rel="noopener noreferrer"
               class="btn-gold inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.2C8.9 95.6.7 127.4-.9 163.3c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                Instagram'da Takip Et
            </a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     11. BLOG STRIP (Recent Posts)
     ══════════════════════════════════════════════════════════ --}}
@if(isset($recentBlogs) && $recentBlogs->isNotEmpty())
<section id="blog" class="py-28 bg-white border-t border-brand-cream-mid">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-14">
            <div data-aos="fade-up">
                <p class="section-label mb-3">Blog</p>
                <h2 class="font-display text-4xl font-bold text-brand-navy">Son Yayınlar</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-brand-gold font-display font-semibold text-sm tracking-wide uppercase border-b-2 border-brand-gold pb-1 hover:opacity-70 transition-opacity flex-shrink-0">
                Tüm Yazılar
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach($recentBlogs as $blog)
            <a href="{{ route('blog.show', $blog->slug) }}" class="group block bg-brand-cream border border-brand-cream-mid hover:shadow-lg transition-shadow overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}">
                <div class="aspect-[4/3] bg-brand-cream-mid overflow-hidden">
                    @if($blog->image_path)
                        <img src="{{ Str::startsWith($blog->image_path, 'http') ? $blog->image_path : asset('storage/' . $blog->image_path) }}" alt="{{ $blog->title }}" class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-brand-gold/20">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="section-label mb-2 text-[0.6rem]">{{ $blog->created_at->format('d M Y') }}</p>
                    <h3 class="font-display font-bold text-brand-navy text-lg leading-snug line-clamp-2 group-hover:text-brand-gold transition-colors">{{ $blog->title }}</h3>
                    <p class="text-brand-gray text-sm leading-relaxed mt-3 line-clamp-2">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
    // ── Video mute toggle ──────────────────────────────────────
    const video      = document.getElementById('hero-video');
    const toggleBtn  = document.getElementById('video-toggle');
    const iconMute   = document.getElementById('icon-mute');
    const iconUnmute = document.getElementById('icon-unmute');

    if (video && toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            video.muted = !video.muted;
            iconMute.classList.toggle('hidden', !video.muted);
            iconUnmute.classList.toggle('hidden', video.muted);
        });
    }
</script>
@endpush
