@extends('layouts.app')
@section('title', 'Gizlilik Politikası | Viens Masa Sandalye')
@section('content')

<!-- Hero Banner -->
<section class="bg-brand-navy py-16 md:py-24">
    <div class="container mx-auto px-4 md:px-8 text-center">
        <span class="section-label mb-4 inline-block">YASAL</span>
        <h1 class="text-3xl md:text-5xl font-light text-white">Gizlilik Politikası</h1>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 md:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-right mb-8">
                <span class="text-sm text-brand-gray/70">Son Güncelleme: {{ date('d.m.Y') }}</span>
            </div>
            
            <article class="prose prose-lg max-w-none text-brand-gray prose-headings:text-brand-navy prose-headings:font-light prose-p:font-light prose-a:text-brand-gold hover:prose-a:text-brand-navy transition-colors">
                
                <h2 class="text-2xl mt-12 mb-6 border-l-4 border-brand-gold pl-4 font-medium text-brand-navy">1. Giriş</h2>
                <p class="mb-6 leading-relaxed font-light">
                    Viens Masa Sandalye ("Şirket", "biz", "bize" veya "bizim") olarak gizliliğinize saygı duyuyoruz ve kişisel verilerinizin korunmasına büyük önem veriyoruz. Bu Gizlilik Politikası, web sitemizi ziyaret ettiğinizde, hizmetlerimizi kullandığınızda veya bizimle iletişime geçtiğinizde kişisel verilerinizi nasıl topladığımızı, kullandığımızı ve koruduğumuzu açıklamaktadır.
                </p>

                <h2 class="text-2xl mt-12 mb-6 border-l-4 border-brand-gold pl-4 font-medium text-brand-navy">2. Toplanan Bilgiler</h2>
                <p class="mb-4 leading-relaxed font-light">
                    Hizmetlerimizi kullanırken sizden çeşitli şekillerde kişisel veriler toplayabiliriz:
                </p>
                <ul class="list-disc pl-6 mb-6 space-y-2 font-light">
                    <li><strong>İletişim Bilgileri:</strong> İletişim formunu doldurduğunuzda veya bize e-posta gönderdiğinizde adınız, soyadınız, e-posta adresiniz, telefon numaranız gibi bilgiler.</li>
                    <li><strong>Otomatik Toplanan Bilgiler:</strong> Web sitemizi ziyaret ettiğinizde IP adresiniz, tarayıcı türünüz, ziyaret ettiğiniz sayfalar, ziyaret tarih ve saatiniz gibi bilgiler çerezler ve benzeri teknolojiler aracılığıyla otomatik olarak toplanabilir.</li>
                </ul>

                <h2 class="text-2xl mt-12 mb-6 border-l-4 border-brand-gold pl-4 font-medium text-brand-navy">3. Bilgilerin Kullanımı</h2>
                <p class="mb-4 leading-relaxed font-light">
                    Topladığımız bilgileri aşağıdaki amaçlar için kullanabiliriz:
                </p>
                <ul class="list-disc pl-6 mb-6 space-y-2 font-light">
                    <li>Size hizmet sunmak ve hizmetlerimizi sürdürmek.</li>
                    <li>Sorularınıza yanıt vermek ve müşteri desteği sağlamak.</li>
                    <li>Size web sitemizle ilgili değişiklikler, kampanyalar veya önemli bildirimler hakkında bilgi göndermek.</li>
                    <li>Web sitemizi ve hizmetlerimizi geliştirmek için analizler yapmak.</li>
                    <li>Yasal yükümlülüklerimizi yerine getirmek.</li>
                </ul>

                <h2 class="text-2xl mt-12 mb-6 border-l-4 border-brand-gold pl-4 font-medium text-brand-navy">4. Çerezler (Cookies)</h2>
                <p class="mb-6 leading-relaxed font-light">
                    Web sitemiz deneyiminizi geliştirmek için "çerezler" kullanmaktadır. Çerezler, web sitesinin cihazınıza yerleştirdiği küçük metin dosyalarıdır. Çerezleri, trafiği analiz etmek, kullanıcı tercihlerini hatırlamak ve sitemizin düzgün çalışmasını sağlamak için kullanıyoruz. Tarayıcı ayarlarınızı değiştirerek çerezleri reddedebilir veya çerez gönderildiğinde uyarı alabilirsiniz, ancak bu durumda sitemizin bazı bölümleri düzgün çalışmayabilir.
                </p>

                <h2 class="text-2xl mt-12 mb-6 border-l-4 border-brand-gold pl-4 font-medium text-brand-navy">5. Üçüncü Taraf Hizmetler</h2>
                <p class="mb-6 leading-relaxed font-light">
                    Kişisel verilerinizi üçüncü şahıslara satmıyoruz, takas etmiyoruz veya başka bir şekilde kiralamıyoruz. Ancak, sitemizin işletilmesinde, işimizin yürütülmesinde veya size hizmet verilmesinde bize yardımcı olan güvenilir üçüncü taraflarla (örneğin analitik sağlayıcılar) bu bilgileri, bu taraflar bilgileri gizli tutmayı kabul ettiği sürece paylaşabiliriz. Yasalara uymak, site politikalarımızı uygulamak veya kendi haklarımızı veya başkalarının haklarını, mülkiyetini veya güvenliğini korumak için gerekli olduğuna inandığımızda bilgilerinizi ifşa edebiliriz.
                </p>

                <h2 class="text-2xl mt-12 mb-6 border-l-4 border-brand-gold pl-4 font-medium text-brand-navy">6. İletişim</h2>
                <p class="mb-6 leading-relaxed font-light">
                    Bu Gizlilik Politikası ile ilgili herhangi bir sorunuz, endişeniz veya talebiniz varsa, lütfen bizimle iletişime geçin:
                </p>
                <div class="bg-brand-cream-mid/30 p-6 rounded-sm border border-brand-cream-mid">
                    <p class="mb-2 font-medium text-brand-navy">Viens Masa Sandalye</p>
                    <p class="mb-1 font-light"><strong>Adres:</strong> Modoko Mobilyacılar Sitesi, Ümraniye / İstanbul</p>
                    <p class="mb-1 font-light"><strong>Telefon:</strong> 0216 123 45 67</p>
                    <p class="mb-0 font-light"><strong>E-posta:</strong> info@viens.com.tr</p>
                </div>
            </article>
        </div>
    </div>
</section>

@endsection
