@extends('layouts.app')

@section('meta_title', 'Yayınlar | Viens Masa Sandalye')
@section('meta_description', 'Viens Masa Sandalye yayınları – masa sandalye seçimi rehberleri, dekorasyon fikirleri ve en yeni trendler.')

@section('content')

{{-- ══════════ HERO ══════════ --}}
@php
    $heroImg = !empty($siteSettings['blog_hero_image']) 
        ? asset('storage/' . $siteSettings['blog_hero_image']) 
        : '';
@endphp
<section class="relative bg-brand-navy pt-36 pb-20 md:pt-48 overflow-hidden">
    <div class="absolute left-0 top-0 w-[3px] h-full bg-gradient-to-b from-transparent via-brand-gold to-transparent opacity-60"></div>
    @if($heroImg)
        <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('{{ $heroImg }}')"></div>
    @else
        <div class="absolute inset-0 opacity-5" aria-hidden="true">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, #DCA54A 0, #DCA54A 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>
        </div>
    @endif
    <div class="relative z-10 max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10 text-center">
        <p class="section-label mb-4" data-aos="fade-up">Uzman Rehberleri</p>
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4" data-aos="fade-up" data-aos-delay="200">Yayınlar</h1>
        <div class="w-16 h-0.5 bg-brand-gold mx-auto mb-5"></div>
        <p class="text-white/60 max-w-xl mx-auto text-sm leading-relaxed">
            Masa, sandalye ve dekorasyon hakkında uzman tavsiyeleri, rehberler ve en yeni trendler.
        </p>
    </div>
</section>

{{-- ══════════ BLOG GRID ══════════ --}}
<section class="py-20 bg-brand-cream">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10">

        @if($blogs && $blogs->count() > 0)

            <p class="text-sm text-brand-gray/60 font-display mb-10">
                <span class="font-semibold text-brand-navy">{{ $blogs->count() }}</span> yayın bulundu
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($blogs as $blog)
                <article class="group bg-white border border-brand-cream-mid hover:shadow-xl transition-shadow overflow-hidden flex flex-col" id="blog-{{ $blog->id }}">

                    {{-- Thumbnail --}}
                    @php
                        $bListImg = $blog->image_path 
                            ? (\Illuminate\Support\Str::startsWith($blog->image_path, 'http') ? $blog->image_path : asset('storage/' . $blog->image_path)) 
                            : 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=600&auto=format&fit=crop&q=80';
                    @endphp
                    <a href="{{ route('blog.show', $blog->slug) }}" class="block aspect-[4/3] bg-brand-cream-mid overflow-hidden flex-shrink-0">
                        <img
                            src="{{ $bListImg }}"
                            alt="{{ $blog->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        >
                    </a>

                    {{-- Content --}}
                    <div class="p-7 flex flex-col flex-1">
                        {{-- Meta --}}
                        <div class="flex items-center gap-3 mb-4">
                            <span class="section-label text-[0.6rem]">Blog</span>
                            <span class="text-brand-gray/40 text-xs">•</span>
                            <time class="text-brand-gray/50 text-xs font-display">{{ $blog->created_at->format('d M Y') }}</time>
                        </div>

                        {{-- Title --}}
                        <a href="{{ route('blog.show', $blog->slug) }}">
                            <h2 class="font-display font-bold text-brand-navy text-lg leading-snug mb-3 line-clamp-2 group-hover:text-brand-gold transition-colors duration-200">
                                {{ $blog->title }}
                            </h2>
                        </a>

                        {{-- Excerpt --}}
                        <p class="text-brand-gray text-sm leading-relaxed line-clamp-3 flex-1 mb-6">
                            {{ Str::limit(strip_tags($blog->content), 130) }}
                        </p>

                        {{-- CTA --}}
                        <a href="{{ route('blog.show', $blog->slug) }}"
                           class="inline-flex items-center gap-2 text-brand-gold font-display font-semibold text-xs tracking-wide uppercase border-b border-brand-gold pb-0.5 self-start hover:opacity-70 transition-opacity">
                            Devamını Oku
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

        @else
            {{-- Empty State --}}
            <div class="text-center py-28 flex flex-col items-center gap-5">
                <svg class="w-16 h-16 text-brand-gold/25" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <h2 class="font-display text-xl font-bold text-brand-navy">Henüz bir yayın bulunmamaktadır</h2>
                <p class="text-brand-gray/60 text-sm max-w-xs">Yakında faydalı içerikler paylaşılacak. Ana sayfaya dönebilirsiniz.</p>
                <a href="{{ route('index') }}" class="btn-outline-gold mt-2">Ana Sayfaya Dön</a>
            </div>
        @endif
    </div>
</section>

{{-- ══════════ NEWSLETTER / CTA BAND ══════════ --}}
<section class="py-16 bg-brand-navy">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10 flex flex-col sm:flex-row items-center justify-between gap-8">
        <div>
            <h3 class="font-display text-white text-2xl font-bold mb-2">Yeni ürünleri kaçırmayın</h3>
            <p class="text-white/50 text-sm">Instagram'da takip ederek güncel kalın.</p>
        </div>
        <a href="https://www.instagram.com/viensmasasandalye" target="_blank" rel="noopener noreferrer" class="btn-gold flex-shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.2C8.9 95.6.7 127.4-.9 163.3c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
            Instagram'da Takip Et
        </a>
    </div>
</section>

@endsection
