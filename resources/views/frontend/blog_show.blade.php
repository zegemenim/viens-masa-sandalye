@extends('layouts.app')

@section('meta_title', ($blog->seoMeta->meta_title ?? $blog->title) . ' | Viens Masa Sandalye')
@if($blog->seoMeta)
    @section('meta_description', $blog->seoMeta->meta_description)
    @section('meta_keywords', $blog->seoMeta->meta_keywords)
@else
    @section('meta_description', Str::limit(strip_tags($blog->content), 160))
@endif

@section('content')

{{-- ══════════ HERO / TITLE ══════════ --}}
@php
    $heroImg = !empty($siteSettings['blog_hero_image']) 
        ? asset('storage/' . $siteSettings['blog_hero_image']) 
        : '';
@endphp
<section class="relative bg-brand-navy pt-36 pb-24 md:pt-48 overflow-hidden">
    <div class="absolute left-0 top-0 w-[3px] h-full bg-gradient-to-b from-transparent via-brand-gold to-transparent opacity-60"></div>
    @if($heroImg)
        <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('{{ $heroImg }}')"></div>
    @else
        <div class="absolute inset-0 opacity-5" aria-hidden="true">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, #DCA54A 0, #DCA54A 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>
        </div>
    @endif
    <div class="relative z-10 max-w-3xl mx-auto px-5 sm:px-8 lg:px-10 text-center">
        <p class="section-label mb-5" data-aos="fade-up">Blog</p>
        <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6" data-aos="fade-up" data-aos-delay="200">
            {{ $blog->title }}
        </h1>
        <div class="flex items-center justify-center gap-3 text-white/50 text-sm">
            <time class="font-display">{{ $blog->created_at->format('d M Y') }}</time>
            <span>•</span>
            <span class="font-display">{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} dk okuma</span>
        </div>
    </div>
</section>

{{-- FEATURED IMAGE --}}
@if($blog->image_path)
@php
    $bImg = \Illuminate\Support\Str::startsWith($blog->image_path, 'http') ? $blog->image_path : asset('storage/' . $blog->image_path);
@endphp
<div class="max-w-5xl mx-auto px-5 sm:px-8 -mt-10 relative z-10">
    <div class="overflow-hidden shadow-2xl">
        <img
            src="{{ $bImg }}"
            alt="{{ $blog->title }}"
            class="w-full max-h-[520px] object-cover"
        >
    </div>
</div>
@endif

{{-- ══════════ CONTENT ══════════ --}}
<div class="max-w-3xl mx-auto px-5 sm:px-8 lg:px-10 py-16">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs font-display text-brand-gray/50 mb-10" aria-label="Breadcrumb">
        <a href="{{ route('index') }}" class="hover:text-brand-gold transition-colors">Ana Sayfa</a>
        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('blog.index') }}" class="hover:text-brand-gold transition-colors">Yayınlar</a>
        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-brand-navy font-semibold truncate max-w-[180px]">{{ Str::limit($blog->title, 40) }}</span>
    </nav>

    {{-- Article --}}
    <article class="prose prose-lg max-w-none text-brand-gray
        prose-headings:font-display prose-headings:text-brand-navy prose-headings:font-bold
        prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
        prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
        prose-p:leading-relaxed prose-p:mb-5
        prose-a:text-brand-gold prose-a:no-underline hover:prose-a:opacity-70
        prose-strong:text-brand-navy
        prose-img:rounded-none prose-img:shadow-lg
        prose-blockquote:border-l-brand-gold prose-blockquote:bg-brand-cream prose-blockquote:px-6 prose-blockquote:py-4 prose-blockquote:not-italic prose-blockquote:text-brand-gray
    ">
        {!! $blog->content !!}
    </article>

    {{-- Share / Footer --}}
    <div class="mt-14 pt-8 border-t border-brand-cream-mid flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
        <a href="{{ route('blog.index') }}"
           class="inline-flex items-center gap-2 text-brand-gold font-display font-semibold text-sm tracking-wide uppercase hover:opacity-70 transition-opacity">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Tüm Yayınlar
        </a>
        <div class="flex items-center gap-4">
            <span class="text-brand-gray/50 text-xs font-display font-semibold tracking-wide uppercase">Paylaş:</span>
            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}"
               target="_blank" rel="noopener noreferrer"
               class="w-8 h-8 rounded-full bg-[#25D366] flex items-center justify-center hover:opacity-80 transition-opacity"
               aria-label="WhatsApp'ta paylaş">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
            </a>
        </div>
    </div>
</div>

{{-- ══════════ CTA BAND ══════════ --}}
<section class="bg-brand-navy py-16">
    <div class="max-w-[1240px] mx-auto px-5 sm:px-8 lg:px-10 flex flex-col sm:flex-row items-center justify-between gap-8">
        <div>
            <h3 class="font-display text-white text-2xl font-bold mb-2">Aklınıza takılan bir şey mi var?</h3>
            <p class="text-white/50 text-sm">Uzman ekibimiz sorularınızı yanıtlamaya hazır.</p>
        </div>
        <div class="flex gap-4 flex-shrink-0">
            <a href="https://wa.me/905522802929" target="_blank" rel="noopener noreferrer" class="btn-gold">WhatsApp ile Yazın</a>
            <a href="{{ route('contact') }}" class="btn-outline-white">İletişim</a>
        </div>
    </div>
</section>

@endsection
