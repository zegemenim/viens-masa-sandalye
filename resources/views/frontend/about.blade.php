@extends('layouts.app')
@section('title', 'Hakkımızda | Viens Masa Sandalye')
@section('content')
<!-- SECTION 1: Hero Banner -->
@php
    $heroImg = !empty($siteSettings['about_hero_image']) 
        ? asset('storage/' . $siteSettings['about_hero_image']) 
        : '';
@endphp
<section class="bg-brand-navy pt-36 pb-24 md:pt-48 md:pb-32 relative overflow-hidden">
    <!-- Some subtle background pattern if needed -->
    @if($heroImg)
        <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('{{ $heroImg }}')"></div>
    @else
        <div class="absolute inset-0 opacity-10 bg-[url('')] bg-cover bg-center"></div>
    @endif
    <div class="container mx-auto px-4 md:px-8 relative z-10 text-center">
        <span class="section-label" data-aos="fade-up">HAKKIMIZDA</span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-light text-white mb-6" data-aos="fade-up" data-aos-delay="200">Hikayemiz</h1>
        <p class="text-white/80 max-w-2xl mx-auto text-lg md:text-xl font-light" data-aos="fade-up" data-aos-delay="400">
            1994'ten bu yana yaşam alanlarınıza değer katıyoruz. Kalite ve zarafetin buluştuğu noktada, sizin için üretiyoruz.
        </p>
    </div>
</section>

<!-- SECTION 2: Story -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="relative" data-aos="fade-right">
                <div class="aspect-[4/3] bg-brand-cream-mid overflow-hidden rounded-sm relative z-10 shadow-xl">
                    @php
                        $storyImg = !empty($siteSettings['about_story_image']) 
                            ? asset('storage/' . $siteSettings['about_story_image']) 
                            : 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1000&auto=format&fit=crop&q=80';
                    @endphp
                    <img src="{{ $storyImg }}" alt="Viens Masa Sandalye Showroom" loading="lazy" class="w-full h-full object-cover">
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-6 -left-6 w-32 h-32 border-l-2 border-b-2 border-brand-gold z-0"></div>
                <div class="absolute -top-6 -right-6 w-32 h-32 border-r-2 border-t-2 border-brand-gold z-0 opacity-50"></div>
            </div>
            <div data-aos="fade-left">
                <h2 class="text-3xl md:text-4xl font-light text-brand-navy mb-6">
                    {!! $siteSettings['about_story_title'] ?? '30 Yıllık Deneyim, <br><span class="text-brand-gold">Sonsuz Tutku</span>' !!}
                </h2>
                <div class="w-16 h-0.5 bg-brand-gold mb-8"></div>
                <div class="space-y-6 text-brand-gray font-light">
                    <p>
                        {!! $siteSettings['about_story_desc_1'] ?? '1994 yılında başlayan serüvenimiz, bugün Modoko\'daki modern showroomumuzda aynı tutku ve heyecanla devam ediyor. Viens Masa Sandalye olarak, ahşabın sıcaklığını ve metalin gücünü modern tasarımlarla harmanlıyoruz.' !!}
                    </p>
                    <p>
                        {!! $siteSettings['about_story_desc_2'] ?? 'Yılların getirdiği ustalık ve deneyimle, sadece mobilya değil, yaşam alanlarınıza ruh katacak, nesilden nesile aktarılacak eserler üretiyoruz. Kaliteden asla ödün vermeyen anlayışımızla, her bir detayı özenle işliyoruz.' !!}
                    </p>
                </div>
                <div class="mt-10">
                    <a href="{{ route('contact') }}" class="btn-outline-gold inline-flex">İletişime Geçin</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: Mission & Vision -->
<section class="py-20 bg-brand-cream">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-light text-brand-navy mb-4">Değerlerimiz</h2>
            <div class="w-16 h-0.5 bg-brand-gold mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <!-- Misyon -->
            <div class="bg-white p-10 lg:p-12 border-l-4 border-brand-gold shadow-sm hover:shadow-md transition-shadow duration-300" data-aos="fade-up">
                <div class="w-14 h-14 bg-brand-cream rounded-full flex items-center justify-center mb-6 text-brand-gold">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-medium text-brand-navy mb-4">{{ $siteSettings['about_mission_title'] ?? 'Misyonumuz' }}</h3>
                <p class="text-brand-gray font-light leading-relaxed">
                    {{ $siteSettings['about_mission_desc'] ?? 'Müşterilerimizin yaşam alanlarını güzelleştirmek, onlara konforlu, estetik ve uzun ömürlü mobilyalar sunmak. Kalite standartlarımızı sürekli yükselterek, müşteri memnuniyetini en üst düzeyde tutmak ve sektörde öncü, yenilikçi çözümler üretmek.' }}
                </p>
            </div>
            
            <!-- Vizyon -->
            <div class="bg-white p-10 lg:p-12 border-l-4 border-brand-gold shadow-sm hover:shadow-md transition-shadow duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="w-14 h-14 bg-brand-cream rounded-full flex items-center justify-center mb-6 text-brand-gold">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-medium text-brand-navy mb-4">{{ $siteSettings['about_vision_title'] ?? 'Vizyonumuz' }}</h3>
                <p class="text-brand-gray font-light leading-relaxed">
                    {{ $siteSettings['about_vision_desc'] ?? 'Türkiye\'de ve uluslararası pazarda tasarım ve kalitesiyle aranan, güvenilir bir marka olmak. Sürdürülebilir üretim anlayışımızla, gelecek nesillere hem estetik hem de çevreye duyarlı bir miras bırakmak, trendleri belirleyen lider firma konumuna ulaşmak.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 4: Team/Values -->
<section class="py-20 bg-brand-navy">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-16">
            <span class="section-label text-brand-gold">ÇEKİRDEK</span>
            <h2 class="text-3xl md:text-4xl font-light text-white mb-4 mt-2">Temel İlkelerimiz</h2>
            <div class="w-16 h-0.5 bg-brand-gold mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center group" data-aos="fade-up">
                <div class="w-20 h-20 mx-auto border border-brand-gold/30 rounded-full flex items-center justify-center mb-6 group-hover:border-brand-gold transition-colors duration-300">
                    <svg class="w-8 h-8 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-white mb-3">Kalite</h3>
                <p class="text-white/60 font-light text-sm leading-relaxed">
                    {{ $siteSettings['about_values_quality'] ?? 'Kullandığımız malzemeden işçiliğe, tasarımdan teslimata kadar her aşamada en yüksek kalite standartlarını gözetiyoruz.' }}
                </p>
            </div>
            
            <div class="text-center group" data-aos="fade-up" data-aos-delay="150">
                <div class="w-20 h-20 mx-auto border border-brand-gold/30 rounded-full flex items-center justify-center mb-6 group-hover:border-brand-gold transition-colors duration-300">
                    <svg class="w-8 h-8 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-white mb-3">Güven</h3>
                <p class="text-white/60 font-light text-sm leading-relaxed">
                    {{ $siteSettings['about_values_trust'] ?? 'Verdiğimiz sözlerin arkasında duruyor, zamanında teslimat ve satış sonrası destekle müşterilerimizin güvenini hak ediyoruz.' }}
                </p>
            </div>
            
            <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-20 h-20 mx-auto border border-brand-gold/30 rounded-full flex items-center justify-center mb-6 group-hover:border-brand-gold transition-colors duration-300">
                    <svg class="w-8 h-8 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-white mb-3">Şeffaflık</h3>
                <p class="text-white/60 font-light text-sm leading-relaxed">
                    {{ $siteSettings['about_values_transparency'] ?? 'Tüm süreçlerimizde açık ve dürüst bir iletişim benimsiyor, müşterilerimizi her aşamada doğru bilgilendiriyoruz.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 5: Stats strip -->
<section class="py-12 border-t border-white/10 bg-brand-navy">
    <div class="container mx-auto px-4 md:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center stat-item">
                <div class="text-3xl md:text-4xl font-light text-brand-gold mb-2">30+</div>
                <div class="text-white/70 text-sm tracking-wider uppercase">Yıllık Deneyim</div>
            </div>
            <div class="text-center stat-item">
                <div class="text-3xl md:text-4xl font-light text-brand-gold mb-2">100+</div>
                <div class="text-white/70 text-sm tracking-wider uppercase">Özel Ürün</div>
            </div>
            <div class="text-center stat-item">
                <div class="text-3xl md:text-4xl font-light text-brand-gold mb-2">1000+</div>
                <div class="text-white/70 text-sm tracking-wider uppercase">Mutlu Müşteri</div>
            </div>
            <div class="text-center stat-item">
                <div class="text-3xl md:text-4xl font-light text-brand-gold mb-2">400m²</div>
                <div class="text-white/70 text-sm tracking-wider uppercase">Showroom</div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 6: Video showcase -->
<section class="relative h-[60vh] overflow-hidden bg-brand-charcoal">
    <video
        autoplay
        muted
        loop
        playsinline
        class="absolute inset-0 w-full h-full object-cover"
        aria-hidden="true"
    >
        @if(!empty($siteSettings['showroom_video_url']))
            @php
                $showVid = Str::startsWith($siteSettings['showroom_video_url'], 'http') ? $siteSettings['showroom_video_url'] : asset('storage/' . $siteSettings['showroom_video_url']);
            @endphp
            <source src="{{ $showVid }}" type="video/mp4">
        @endif
    </video>
    <!-- Fallback background just in case -->
    <div class="absolute inset-0 bg-brand-navy/60 z-10"></div>
    
    <div class="relative z-20 h-full flex flex-col items-center justify-center text-center px-4" data-aos="zoom-in">
        <h2 class="text-4xl md:text-5xl font-light text-white mb-8">Showroom Turumuz</h2>
        <a href="{{ route('contact') }}" class="px-8 py-3 border border-white text-white hover:bg-white hover:text-brand-navy transition-colors duration-300 font-medium tracking-wide uppercase text-sm">
            Showroom'u Keşfet
        </a>
    </div>
</section>

<!-- SECTION 7: Contact CTA band -->
<section class="py-20 bg-brand-gold">
    <div class="container mx-auto px-4 md:px-8 text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-light text-white mb-6">Bizi Ziyaret Edin</h2>
        <p class="text-white/90 max-w-2xl mx-auto text-lg mb-10 font-light">
            Modoko'daki mağazamızı ziyaret ederek koleksiyonlarımızı yakından inceleyebilir, kahvemizi içerken size özel çözümlerimizi konuşabiliriz.
        </p>
        <a href="{{ route('contact') }}" class="px-8 py-3 border border-white text-white hover:bg-white hover:text-brand-gold transition-colors duration-300 font-medium tracking-wide uppercase text-sm inline-block">
            İletişim
        </a>
    </div>
</section>
@endsection
