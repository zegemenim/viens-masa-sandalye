@extends('layouts.app')

@section('meta_title', ($product->seoMeta->meta_title ?? $product->name) . ' | Viens Masa Sandalye')
@if($product->seoMeta)
    @section('meta_description', $product->seoMeta->meta_description)
    @section('meta_keywords', $product->seoMeta->meta_keywords)
@else
    @section('meta_description', 'Viens Masa Sandalye – ' . $product->name . ' ürününü inceleyin.')
@endif

@section('content')

{{-- BREADCRUMB BAR --}}
<div class="bg-white border-b border-brand-cream-mid pt-28 lg:pt-32">
    <div class="max-w-[1400px] mx-auto px-5 lg:px-10 py-4">
        <nav class="flex items-center gap-2 text-xs font-display text-brand-gray/60" aria-label="Breadcrumb">
            <a href="{{ route('index') }}" class="hover:text-brand-gold transition-colors">Ana Sayfa</a>
            <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            @if($product->category)
                <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-brand-gold transition-colors">{{ $product->category->name }}</a>
                <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            @endif
            <span class="text-brand-navy font-semibold truncate max-w-[200px]">{{ $product->name }}</span>
        </nav>
    </div>
</div>

{{-- PRODUCT DETAIL SECTION --}}
<section class="py-16 bg-white">
    <div class="max-w-[1400px] mx-auto px-5 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-start">

            {{-- Image Gallery --}}
            <div class="space-y-4">
                {{-- Main Image --}}
                <div class="aspect-square bg-brand-cream-mid flex items-center justify-center overflow-hidden border border-brand-cream-mid shadow-sm relative group">
                    @php
                        $imgSrc = $product->image_path 
                            ? (\Illuminate\Support\Str::startsWith($product->image_path, 'http') ? $product->image_path : asset('storage/' . $product->image_path)) 
                            : 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&auto=format&fit=crop&q=80';
                    @endphp
                    <img src="{{ $imgSrc }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500" 
                         loading="lazy">
                </div>
            </div>

            {{-- Product Info --}}
            <div class="flex flex-col">

                {{-- Category label --}}
                @if($product->category)
                    <a href="{{ route('category.show', $product->category->slug) }}"
                       class="text-[0.65rem] font-display font-semibold tracking-[0.2em] text-brand-gold uppercase mb-3 hover:opacity-75 transition-opacity">
                        {{ $product->category->name }}
                    </a>
                @endif

                {{-- Product Name --}}
                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-navy mb-4 leading-tight">
                    {{ $product->name }}
                </h1>

                {{-- Divider --}}
                <div class="w-16 h-0.5 bg-brand-gold mb-6"></div>

                {{-- Price --}}
                @if($product->price)
                    <div class="mb-6">
                        <p class="font-display text-3xl sm:text-4xl font-bold text-brand-navy">
                            ₺{{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-brand-gray/60 mt-1 font-display">KDV dahil</p>
                    </div>
                @else
                    <p class="font-display text-lg font-semibold text-brand-gold mb-6">Fiyat bilgisi için bize ulaşın</p>
                @endif

                {{-- Badges --}}
                <div class="flex flex-wrap gap-2 mb-7">
                    @if($product->sku)
                        <span class="inline-flex items-center gap-1.5 bg-brand-cream-mid text-brand-gray text-xs font-display font-semibold px-3 py-1.5 rounded-sm">
                            SKU: {{ $product->sku }}
                        </span>
                    @endif
                    @if($product->stock_status ?? true)
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-display font-semibold px-3 py-1.5 rounded-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Stokta Var
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 text-xs font-display font-semibold px-3 py-1.5 rounded-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                            Tükendi
                        </span>
                    @endif
                </div>

                {{-- Description --}}
                <div class="text-brand-gray text-base leading-relaxed mb-8 prose max-w-none font-serif">
                    @if($product->description)
                        {!! $product->description !!}
                    @else
                        <p class="text-brand-gray/60 italic">30 yılı aşkın tecrübemizle üretilen bu özel tasarım masa sandalye modeli, yaşam alanlarınıza şıklık ve konfor katmak için tasarlandı.</p>
                    @endif
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-brand-cream-mid mt-auto">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_whatsapp'] ?? '905522802929') }}?text={{ urlencode('Merhaba, ' . $product->name . ' ürünü hakkında bilgi almak istiyorum.') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="py-4 px-8 bg-brand-gold text-white font-display text-xs font-bold uppercase tracking-[0.15em] flex items-center justify-center gap-2 hover:bg-brand-navy transition-colors shadow-md">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512">
                            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                        </svg>
                        WhatsApp ile Sipariş
                    </a>
                    <a href="{{ route('contact') }}"
                       class="py-4 px-8 border border-brand-navy text-brand-navy font-display text-xs font-bold uppercase tracking-[0.15em] flex items-center justify-center hover:bg-brand-navy hover:text-white transition-colors">
                        İletişim Formu
                    </a>
                </div>

                {{-- Trust Badges --}}
                <div class="grid grid-cols-3 gap-4 mt-8 pt-6 border-t border-brand-cream-mid">
                    @foreach([
                        ['icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4', 'label' => 'Hızlı Teslimat'],
                        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'label' => 'Kalite Garantisi'],
                        ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => '7/24 Destek'],
                    ] as $badge)
                    <div class="flex flex-col items-center text-center gap-2">
                        <svg class="w-6 h-6 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $badge['icon'] }}"/>
                        </svg>
                        <span class="text-[0.65rem] font-display font-semibold text-brand-gray tracking-wide uppercase">{{ $badge['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- RELATED PRODUCTS --}}
@if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
<section class="py-20 bg-[#F9F7F3] border-t border-brand-cream-mid">
    <div class="max-w-[1400px] mx-auto px-5 lg:px-10">
        <div class="text-center mb-12">
            <span class="text-[0.65rem] font-display font-semibold tracking-[0.2em] text-brand-gold uppercase block mb-2">Benzer Ürünler</span>
            <h2 class="font-display text-3xl font-bold text-brand-navy">Beğenebilirsiniz</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            @php
                $relImg = $related->image_path 
                    ? (\Illuminate\Support\Str::startsWith($related->image_path, 'http') ? $related->image_path : asset('storage/' . $related->image_path)) 
                    : 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600&auto=format&fit=crop&q=80';
            @endphp
            <a href="{{ route('product.show', $related->slug) }}" class="group block bg-white border border-brand-cream-mid hover:shadow-lg transition-all duration-300">
                <div class="aspect-square bg-brand-cream-mid overflow-hidden">
                    <img src="{{ $relImg }}" alt="{{ $related->name }}" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
                <div class="p-5 border-t border-brand-cream-mid">
                    <h3 class="font-display font-semibold text-brand-navy text-sm line-clamp-2 mb-2 group-hover:text-brand-gold transition-colors">{{ $related->name }}</h3>
                    @if($related->price)
                        <p class="font-display font-bold text-brand-navy text-base">₺{{ number_format($related->price, 0, ',', '.') }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
