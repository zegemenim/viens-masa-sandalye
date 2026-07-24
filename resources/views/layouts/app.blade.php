<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', ($siteSettings['seo_title_home'] ?? 'Viens Masa Sandalye'))</title>
    <meta name="description" content="@yield('meta_description', ($siteSettings['seo_description_home'] ?? 'Kaliteli ve şık masa sandalye modelleri'))">
    <meta name="keywords" content="@yield('meta_keywords', ($siteSettings['seo_keywords'] ?? 'viens, masa, sandalye, modoko, mobilya'))">

    {{-- Favicon --}}
    @if(!empty($siteSettings['logo_path']))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $siteSettings['logo_path']) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🪑</text></svg>">
    @endif

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Nunito+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans text-brand-gray bg-[#F9F7F3] antialiased selection:bg-brand-gold selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- HEADER --}}
    <header id="main-header" class="fixed top-0 left-0 w-full z-[100] transition-all duration-500 {{ request()->routeIs('index') ? 'bg-transparent border-b border-white/5' : 'bg-brand-navy shadow-md border-b border-white/10' }}">
        {{-- Top Utility Bar --}}
        <div id="top-bar" class="hidden lg:flex justify-between items-center px-10 py-2 bg-brand-dark/50 text-[0.65rem] text-white/70 tracking-widest font-display transition-all duration-500 border-b border-white/5">
            <div class="flex gap-6">
                <span>📍 {{ $siteSettings['contact_address'] ?? 'Modoko, İstanbul' }}</span>
                <span>⏱ {{ $siteSettings['working_hours'] ?? 'Hergün: 09:00 - 18:30' }}</span>
            </div>
            <div class="flex gap-4">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_phone'] ?? '+905522802929') }}" class="hover:text-brand-gold transition-colors">{{ $siteSettings['contact_phone'] ?? '+90 552 280 29 29' }}</a>
                @if(!empty($siteSettings['social_instagram']))
                    <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" class="hover:text-brand-gold transition-colors">INSTAGRAM</a>
                @endif
            </div>
        </div>

        <div class="max-w-[1600px] mx-auto px-5 lg:px-10 h-20 flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('index') }}" class="flex-shrink-0 group flex items-center gap-3">
                @if(!empty($siteSettings['logo_path']))
                    <img src="{{ asset('storage/' . $siteSettings['logo_path']) }}" alt="{{ $siteSettings['site_name'] ?? 'Viens' }}" class="h-10 w-auto object-contain transition-transform group-hover:opacity-80">
                @else
                    <div class="flex flex-col justify-center">
                        <span class="font-display font-semibold text-white text-2xl tracking-[0.15em] uppercase leading-none">{{ explode(' ', $siteSettings['site_name'] ?? 'VIENS')[0] }}</span>
                        <span class="font-display font-light text-brand-gold text-[0.55rem] tracking-[0.3em] uppercase leading-tight mt-1">{{ str_replace(explode(' ', $siteSettings['site_name'] ?? 'VIENS')[0].' ', '', $siteSettings['site_name'] ?? 'MASA SANDALYE') }}</span>
                    </div>
                @endif
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-8 h-full">
                <a href="{{ route('index') }}" class="text-[0.75rem] font-display font-semibold tracking-[0.15em] uppercase transition-colors {{ request()->routeIs('index') ? 'text-brand-gold' : 'text-white/80 hover:text-white' }}">Ana Sayfa</a>
                
                @if(isset($navCategories) && $navCategories->count() > 0)
                    @foreach($navCategories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}" class="text-[0.75rem] font-display font-semibold tracking-[0.15em] uppercase transition-colors {{ request()->url() == route('category.show', $cat->slug) ? 'text-brand-gold' : 'text-white/80 hover:text-white' }}">{{ $cat->name }}</a>
                    @endforeach
                @else
                    <a href="{{ route('category.show', 'masalar') }}" class="text-[0.75rem] font-display font-semibold tracking-[0.15em] uppercase transition-colors {{ request()->is('kategori/masalar') ? 'text-brand-gold' : 'text-white/80 hover:text-white' }}">Masalar</a>
                    <a href="{{ route('category.show', 'sandalyeler') }}" class="text-[0.75rem] font-display font-semibold tracking-[0.15em] uppercase transition-colors {{ request()->is('kategori/sandalyeler') ? 'text-brand-gold' : 'text-white/80 hover:text-white' }}">Sandalyeler</a>
                @endif
                
                <a href="{{ route('about') }}" class="text-[0.75rem] font-display font-semibold tracking-[0.15em] uppercase transition-colors {{ request()->routeIs('about') ? 'text-brand-gold' : 'text-white/80 hover:text-white' }}">Kurumsal</a>
                <a href="{{ route('blog.index') }}" class="text-[0.75rem] font-display font-semibold tracking-[0.15em] uppercase transition-colors {{ request()->routeIs('blog.*') ? 'text-brand-gold' : 'text-white/80 hover:text-white' }}">Yayınlar</a>
                <a href="{{ route('contact') }}" class="text-[0.75rem] font-display font-semibold tracking-[0.15em] uppercase transition-colors {{ request()->routeIs('contact') ? 'text-brand-gold' : 'text-white/80 hover:text-white' }}">İletişim</a>
            </nav>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="lg:hidden w-10 h-10 flex flex-col justify-center items-end gap-1.5 focus:outline-none z-50">
                <span class="w-6 h-[1px] bg-white transition-all duration-300 origin-right" id="line-1"></span>
                <span class="w-4 h-[1px] bg-brand-gold transition-all duration-300" id="line-2"></span>
                <span class="w-6 h-[1px] bg-white transition-all duration-300 origin-right" id="line-3"></span>
            </button>
        </div>

        {{-- Mobile Fullscreen Menu --}}
        <div id="mobile-menu" class="fixed inset-0 bg-brand-navy z-40 transform translate-x-full transition-transform duration-500 ease-in-out flex flex-col pt-24 px-8 pb-10 overflow-y-auto">
            <nav class="flex flex-col gap-6 mt-10">
                <a href="{{ route('index') }}" class="text-2xl text-white font-display font-light tracking-widest uppercase">Ana Sayfa</a>
                
                @if(isset($navCategories) && $navCategories->count() > 0)
                    @foreach($navCategories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}" class="text-2xl text-white font-display font-light tracking-widest uppercase">{{ $cat->name }}</a>
                    @endforeach
                @else
                    <a href="{{ route('category.show', 'masalar') }}" class="text-2xl text-white font-display font-light tracking-widest uppercase">Masalar</a>
                    <a href="{{ route('category.show', 'sandalyeler') }}" class="text-2xl text-white font-display font-light tracking-widest uppercase">Sandalyeler</a>
                @endif
                
                <a href="{{ route('about') }}" class="text-2xl text-white font-display font-light tracking-widest uppercase">Kurumsal</a>
                <a href="{{ route('blog.index') }}" class="text-2xl text-white font-display font-light tracking-widest uppercase">Yayınlar</a>
                <a href="{{ route('contact') }}" class="text-2xl text-white font-display font-light tracking-widest uppercase">İletişim</a>
            </nav>
            <div class="mt-auto pt-10 border-t border-white/10">
                <p class="text-white/50 text-xs font-display tracking-widest uppercase mb-4">Bize Ulaşın</p>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_phone'] ?? '+905522802929') }}" class="text-white text-xl font-display block mb-2">{{ $siteSettings['contact_phone'] ?? '+90 552 280 29 29' }}</a>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-1 w-full flex flex-col relative">
        @yield('content')
    </main>

    {{-- Premium Footer --}}
    <footer class="bg-brand-dark pt-24 pb-12 border-t border-brand-gold/20 relative z-20">
        <div class="max-w-[1400px] mx-auto px-5 lg:px-10 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-20">
                
                {{-- Brand Column --}}
                <div class="lg:pr-8">
                    <a href="{{ route('index') }}" class="inline-block mb-8">
                        @if(!empty($siteSettings['logo_path']))
                            <img src="{{ asset('storage/' . $siteSettings['logo_path']) }}" alt="{{ $siteSettings['site_name'] ?? 'Viens' }}" class="h-8 w-auto object-contain grayscale opacity-70">
                        @else
                            <div class="flex flex-col">
                                <span class="font-display font-semibold text-white text-2xl tracking-[0.15em] uppercase leading-none">{{ explode(' ', $siteSettings['site_name'] ?? 'VIENS')[0] }}</span>
                                <span class="font-display font-light text-brand-gold text-[0.55rem] tracking-[0.3em] uppercase leading-tight mt-1">{{ str_replace(explode(' ', $siteSettings['site_name'] ?? 'VIENS')[0].' ', '', $siteSettings['site_name'] ?? 'MASA SANDALYE') }}</span>
                            </div>
                        @endif
                    </a>
                    <p class="text-white/40 text-[0.8rem] leading-loose font-serif mb-8">
                        {{ $siteSettings['site_description'] ?? "Kalite ve zarafeti yaşam alanlarınıza taşıyoruz. Zamanın ötesinde tasarımlarla, evinizin en güzel köşesi için buradayız." }}
                    </p>
                    <div class="flex items-center gap-4">
                        @if(!empty($siteSettings['social_instagram']))
                        <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:border-brand-gold hover:text-brand-gold transition-colors text-white/50">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.2C8.9 95.6.7 127.4-.9 163.3c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-display font-semibold text-white text-xs tracking-[0.2em] uppercase mb-8">
                        Sayfalar
                    </h4>
                    <ul class="space-y-4 font-display text-[0.7rem] tracking-[0.1em] uppercase">
                        <li><a href="{{ route('index') }}" class="text-white/50 hover:text-brand-gold transition-colors">Ana Sayfa</a></li>
                        <li><a href="{{ route('about') }}" class="text-white/50 hover:text-brand-gold transition-colors">Kurumsal</a></li>
                        <li><a href="{{ route('category.show', 'masalar') }}" class="text-white/50 hover:text-brand-gold transition-colors">Masalar</a></li>
                        <li><a href="{{ route('category.show', 'sandalyeler') }}" class="text-white/50 hover:text-brand-gold transition-colors">Sandalyeler</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-white/50 hover:text-brand-gold transition-colors">Blog</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="font-display font-semibold text-white text-xs tracking-[0.2em] uppercase mb-8">
                        İletişim
                    </h4>
                    <ul class="space-y-5">
                        <li class="flex flex-col gap-1.5">
                            <span class="text-brand-gold text-[0.65rem] font-display tracking-[0.15em] uppercase">Adres</span>
                            <span class="text-white/50 text-sm leading-relaxed font-serif">{{ $siteSettings['contact_address'] ?? 'Modoko, Barbaros Hayrettin Paşa Cad. İstanbul' }}</span>
                        </li>
                        <li class="flex flex-col gap-1.5">
                            <span class="text-brand-gold text-[0.65rem] font-display tracking-[0.15em] uppercase">Telefon</span>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_phone'] ?? '+905522802929') }}" class="text-white/80 hover:text-brand-gold transition-colors font-display tracking-wider">
                                {{ $siteSettings['contact_phone'] ?? '+90 552 280 29 29' }}
                            </a>
                        </li>
                        <li class="flex flex-col gap-1.5">
                            <span class="text-brand-gold text-[0.65rem] font-display tracking-[0.15em] uppercase">Saatler</span>
                            <span class="text-white/50 text-sm font-serif">{{ $siteSettings['working_hours'] ?? 'Hergün: 09:00 - 18:30' }}</span>
                        </li>
                    </ul>
                </div>

                {{-- Showroom --}}
                <div>
                    <h4 class="font-display font-semibold text-white text-xs tracking-[0.2em] uppercase mb-8">
                        Showroom
                    </h4>
                    <div class="border border-white/10 p-6">
                        <p class="text-white/50 text-xs font-serif leading-relaxed mb-6">Koleksiyonlarımızı yakından incelemek, kahvemizi içmek ve detaylı bilgi almak için sizi mağazamıza bekliyoruz.</p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center w-full py-3 border border-brand-gold text-brand-gold text-[0.65rem] font-display tracking-[0.2em] uppercase hover:bg-brand-gold hover:text-brand-navy transition-colors">
                            Yol Tarifi Al
                        </a>
                    </div>
                </div>

            </div>

            {{-- Bottom Bar --}}
            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-white/30 text-[0.7rem] font-display tracking-wide uppercase">&copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'Viens' }}. Tüm hakları saklıdır.</p>
                <div class="flex items-center gap-6 text-[0.7rem] font-display text-white/30 tracking-wide uppercase">
                    <a href="{{ route('privacyPolicy') }}" class="hover:text-brand-gold transition-colors">Gizlilik Politikası</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- FIXED CONTACT BUTTONS --}}
    <div class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-3">
        <a href="https://wa.me/{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_whatsapp'] ?? '905522802929') }}"
           target="_blank"
           class="w-14 h-14 bg-[#25D366] text-white rounded-full flex items-center justify-center shadow-[0_8px_30px_rgb(0,0,0,0.3)] hover:scale-110 hover:-translate-y-1 transition-all duration-300 group"
           aria-label="WhatsApp İletişim">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
            <span class="absolute right-[4.5rem] bg-brand-navy text-white text-[0.65rem] font-display tracking-widest uppercase px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Bize Yazın</span>
        </a>
    </div>

    @stack('scripts')

    <script>
        // Header Scroll Effect (only for index page)
        const isHomePage = {{ request()->routeIs('index') ? 'true' : 'false' }};
        const header = document.getElementById('main-header');
        const topBar = document.getElementById('top-bar');

        if (isHomePage) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.remove('bg-transparent', 'border-white/5');
                    header.classList.add('bg-brand-navy/95', 'backdrop-blur-md', 'shadow-sm');
                    if(topBar) {
                        topBar.classList.add('h-0', 'py-0', 'overflow-hidden', 'opacity-0');
                        topBar.classList.remove('py-2');
                    }
                } else {
                    header.classList.add('bg-transparent', 'border-white/5');
                    header.classList.remove('bg-brand-navy/95', 'backdrop-blur-md', 'shadow-sm');
                    if(topBar) {
                        topBar.classList.remove('h-0', 'py-0', 'overflow-hidden', 'opacity-0');
                        topBar.classList.add('py-2');
                    }
                }
            });
        }

        // Mobile Menu Logic
        const menuBtn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const line1 = document.getElementById('line-1');
        const line2 = document.getElementById('line-2');
        const line3 = document.getElementById('line-3');

        if(menuBtn && menu) {
            menuBtn.addEventListener('click', () => {
                const isOpen = !menu.classList.contains('translate-x-full');
                
                if (isOpen) {
                    menu.classList.add('translate-x-full');
                    document.body.style.overflow = 'auto';
                    line1.style.transform = 'rotate(0) translateY(0)';
                    line2.style.opacity = '1';
                    line3.style.transform = 'rotate(0) translateY(0)';
                } else {
                    menu.classList.remove('translate-x-full');
                    document.body.style.overflow = 'hidden';
                    line1.style.transform = 'rotate(45deg) translate(2px, -2px)';
                    line2.style.opacity = '0';
                    line3.style.transform = 'rotate(-45deg) translate(2px, 2px)';
                }
            });
        }
    </script>

    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 900,
            once: true,
            offset: 50,
            easing: 'ease-out-quart'
        });
    </script>
</body>
</html>
