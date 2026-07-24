@extends('layouts.app')

@section('meta_title', $category->name . ' Koleksiyonu | Viens Masa Sandalye')
@if($category->seoMeta)
    @section('meta_description', $category->seoMeta->meta_description)
    @section('meta_keywords', $category->seoMeta->meta_keywords)
@else
    @section('meta_description', 'Viens Masa Sandalye – ' . $category->name . ' koleksiyonunu inceleyin. En şık ve dayanıklı modeller burada.')
@endif

@section('content')

{{-- CATEGORY HERO BANNER --}}
@php
    $heroImg = !empty($siteSettings['category_hero_image']) 
        ? asset('storage/' . $siteSettings['category_hero_image']) 
        : '';
@endphp
<section class="relative bg-brand-navy pt-36 pb-20 md:pt-48 overflow-hidden">
    @if($heroImg)
        <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('{{ $heroImg }}')"></div>
    @else
        <div class="absolute inset-0 opacity-5" aria-hidden="true">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, #DCA54A 0, #DCA54A 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>
        </div>
    @endif
    <div class="absolute left-0 top-0 w-1 h-full bg-brand-gold opacity-40"></div>

    <div class="relative z-10 max-w-[1400px] mx-auto px-5 lg:px-10 text-center">
        <span class="text-[0.65rem] font-display font-semibold tracking-[0.2em] text-brand-gold uppercase block mb-3" data-aos="fade-up">Koleksiyon</span>
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4" data-aos="fade-up" data-aos-delay="150">
            {{ $category->name }}
        </h1>
        <div class="w-16 h-0.5 bg-brand-gold mx-auto mb-5" data-aos="zoom-in" data-aos-delay="250"></div>
        @if($category->description)
            <p class="text-white/70 max-w-xl mx-auto text-sm font-serif leading-relaxed" data-aos="fade-up" data-aos-delay="350">{{ $category->description }}</p>
        @else
            <p class="text-white/70 max-w-xl mx-auto text-sm font-serif leading-relaxed" data-aos="fade-up" data-aos-delay="350">
                En şık ve dayanıklı {{ strtolower($category->name) }} modellerimizi keşfedin.
            </p>
        @endif
    </div>
</section>

{{-- BREADCRUMB --}}
<div class="bg-white border-b border-brand-cream-mid">
    <div class="max-w-[1400px] mx-auto px-5 lg:px-10 py-3">
        <nav class="flex items-center gap-2 text-xs font-display text-brand-gray/60" aria-label="Breadcrumb">
            <a href="{{ route('index') }}" class="hover:text-brand-gold transition-colors">Ana Sayfa</a>
            <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-brand-navy font-semibold">{{ $category->name }}</span>
        </nav>
    </div>
</div>

{{-- PRODUCT GRID --}}
<section class="py-16 bg-[#F9F7F3]">
    <div class="max-w-[1400px] mx-auto px-5 lg:px-10">

        @if($category->products && $category->products->count() > 0)

            <p class="text-sm text-brand-gray/60 font-display mb-8">
                <span class="font-semibold text-brand-navy">{{ $category->products->count() }}</span> ürün listeleniyor
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($category->products as $product)
                @php
                    $pImg = $product->image_path 
                        ? (\Illuminate\Support\Str::startsWith($product->image_path, 'http') ? $product->image_path : asset('storage/' . $product->image_path)) 
                        : 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600&auto=format&fit=crop&q=80';
                @endphp
                <a href="{{ route('product.show', $product->slug) }}"
                   class="group block bg-white border border-brand-cream-mid hover:shadow-lg transition-all duration-300"
                   data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="aspect-square bg-brand-cream-mid overflow-hidden">
                        <img
                            src="{{ $pImg }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        >
                    </div>

                    <div class="p-5 border-t border-brand-cream-mid">
                        <p class="text-[0.6rem] font-display font-semibold tracking-[0.14em] text-brand-gold uppercase mb-1">
                            {{ $category->name }}
                        </p>
                        <h2 class="font-display font-semibold text-brand-navy text-sm leading-snug mb-2 line-clamp-2 group-hover:text-brand-gold transition-colors">
                            {{ $product->name }}
                        </h2>
                        <p class="font-display font-bold text-brand-navy text-base">
                            @if($product->price)
                                ₺{{ number_format($product->price, 0, ',', '.') }}
                            @else
                                Fiyat için arayın
                            @endif
                        </p>
                    </div>
                </a>
                @endforeach
            </div>

        @else
            <div class="text-center py-28 flex flex-col items-center gap-5">
                <svg class="w-16 h-16 text-brand-gold/25" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h2 class="font-display text-xl font-bold text-brand-navy">Bu kategoride henüz ürün yok</h2>
                <p class="text-brand-gray/60 text-sm max-w-xs font-serif">Yakında yeni ürünler eklenecek. Diğer kategorilere göz atabilirsiniz.</p>
                <a href="{{ route('index') }}" class="py-3 px-6 border border-brand-navy text-brand-navy font-display text-xs font-bold uppercase tracking-wider hover:bg-brand-navy hover:text-white transition-colors mt-2">Ana Sayfaya Dön</a>
            </div>
        @endif
    </div>
</section>

{{-- CONTACT CTA --}}
<section class="py-16 bg-brand-navy">
    <div class="max-w-[1400px] mx-auto px-5 lg:px-10 flex flex-col sm:flex-row items-center justify-between gap-8">
        <div>
            <h3 class="font-display text-white text-2xl font-bold mb-2">Aradığınızı bulamadınız mı?</h3>
            <p class="text-white/60 text-sm font-serif">Uzman ekibimiz size özel çözümler üretmek için hazır.</p>
        </div>
        <div class="flex gap-4 flex-shrink-0">
            <a href="https://wa.me/{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_whatsapp'] ?? '905522802929') }}" target="_blank" rel="noopener noreferrer" class="py-3 px-6 bg-brand-gold text-white font-display text-xs font-bold uppercase tracking-wider hover:bg-white hover:text-brand-navy transition-colors">
                WhatsApp ile Yazın
            </a>
            <a href="{{ route('contact') }}" class="py-3 px-6 border border-white text-white font-display text-xs font-bold uppercase tracking-wider hover:bg-white hover:text-brand-navy transition-colors">
                İletişim
            </a>
        </div>
    </div>
</section>

@endsection
