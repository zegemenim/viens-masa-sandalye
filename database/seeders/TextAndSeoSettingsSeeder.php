<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TextAndSeoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // SEO Ayarları
            ['key' => 'seo_title_home', 'value' => 'Viens Masa Sandalye | Modoko\'da Kaliteli Mobilyalar', 'group' => 'SEO'],
            ['key' => 'seo_description_home', 'value' => '1994\'ten bu yana yaşam alanlarınıza değer katıyoruz. Modoko\'daki modern showroomumuzda ahşabın sıcaklığını ve metalin gücünü modern tasarımlarla harmanlıyoruz.', 'group' => 'SEO'],
            ['key' => 'seo_keywords', 'value' => 'masa, sandalye, yemek odası, modoko mobilya, ahşap masa, mermer masa, viens', 'group' => 'SEO'],
            
            // Ana Sayfa - Hero
            ['key' => 'home_hero_title', 'value' => 'Estetik ve Konforun<br>Mükemmel Uyumu', 'group' => 'Ana Sayfa'],
            ['key' => 'home_hero_subtitle', 'value' => 'Yemek odalarınızı sadece bir mekan olmaktan çıkarıp, anıların paylaşıldığı özel bir deneyime dönüştürüyoruz. Özel tasarım masa ve sandalye koleksiyonlarımızla tanışın.', 'group' => 'Ana Sayfa'],
            
            // Ana Sayfa - About
            ['key' => 'home_about_title', 'value' => 'Mekanın Ruhu, Mobilyanın Kusursuzluğunda Gizlidir', 'group' => 'Ana Sayfa'],
            ['key' => 'home_about_desc', 'value' => 'Viens Masa Sandalye olarak, 1994\'ten beri ustalığı estetikle harmanlıyoruz. Modoko\'daki showroomumuzda, her detayında özen olan koleksiyonlarımızı keşfedin.', 'group' => 'Ana Sayfa'],
            
            // Ana Sayfa - Catalog
            ['key' => 'home_catalog_title', 'value' => 'Ürün Kataloğu', 'group' => 'Ana Sayfa'],
            ['key' => 'home_showroom_title', 'value' => '400 m² Showroom\'u<br><span class="text-brand-gold">Keşfedin</span>', 'group' => 'Ana Sayfa'],
            ['key' => 'home_showroom_desc', 'value' => 'Modoko\'daki geniş showroom\'umuzda 100\'den fazla model ürünü bizzat görüp deneyimleyebilirsiniz.', 'group' => 'Ana Sayfa'],
            
            // Ana Sayfa - Why Us
            ['key' => 'home_whyus_title', 'value' => 'Farkımız Ne?', 'group' => 'Ana Sayfa'],
            ['key' => 'home_whyus_desc', 'value' => 'Tasarım, kalite ve konforu bir arada sunuyoruz. Her bir ürünümüz, yaşam alanlarınıza değer katmak için özel olarak tasarlanır.', 'group' => 'Ana Sayfa'],
            
            // Hakkımızda Sayfası
            ['key' => 'about_story_title', 'value' => '30 Yıllık Deneyim, <br><span class="text-brand-gold">Sonsuz Tutku</span>', 'group' => 'Hakkımızda'],
            ['key' => 'about_story_desc_1', 'value' => '1994 yılında başlayan serüvenimiz, bugün Modoko\'daki modern showroomumuzda aynı tutku ve heyecanla devam ediyor. Viens Masa Sandalye olarak, ahşabın sıcaklığını ve metalin gücünü modern tasarımlarla harmanlıyoruz.', 'group' => 'Hakkımızda'],
            ['key' => 'about_story_desc_2', 'value' => 'Yılların getirdiği ustalık ve deneyimle, sadece mobilya değil, yaşam alanlarınıza ruh katacak, nesilden nesile aktarılacak eserler üretiyoruz. Kaliteden asla ödün vermeyen anlayışımızla, her bir detayı özenle işliyoruz.', 'group' => 'Hakkımızda'],
            
            ['key' => 'about_mission_title', 'value' => 'Misyonumuz', 'group' => 'Hakkımızda'],
            ['key' => 'about_mission_desc', 'value' => 'Müşterilerimizin yaşam alanlarını güzelleştirmek, onlara konforlu, estetik ve uzun ömürlü mobilyalar sunmak. Kalite standartlarımızı sürekli yükselterek, müşteri memnuniyetini en üst düzeyde tutmak ve sektörde öncü, yenilikçi çözümler üretmek.', 'group' => 'Hakkımızda'],
            
            ['key' => 'about_vision_title', 'value' => 'Vizyonumuz', 'group' => 'Hakkımızda'],
            ['key' => 'about_vision_desc', 'value' => 'Türkiye\'de ve uluslararası pazarda tasarım ve kalitesiyle aranan, güvenilir bir marka olmak. Sürdürülebilir üretim anlayışımızla, gelecek nesillere hem estetik hem de çevreye duyarlı bir miras bırakmak, trendleri belirleyen lider firma konumuna ulaşmak.', 'group' => 'Hakkımızda'],
            
            ['key' => 'about_values_quality', 'value' => 'Kullandığımız malzemeden işçiliğe, tasarımdan teslimata kadar her aşamada en yüksek kalite standartlarını gözetiyoruz.', 'group' => 'Hakkımızda'],
            ['key' => 'about_values_trust', 'value' => 'Verdiğimiz sözlerin arkasında duruyor, zamanında teslimat ve satış sonrası destekle müşterilerimizin güvenini hak ediyoruz.', 'group' => 'Hakkımızda'],
            ['key' => 'about_values_transparency', 'value' => 'Tüm süreçlerimizde açık ve dürüst bir iletişim benimsiyor, müşterilerimizi her aşamada doğru bilgilendiriyoruz.', 'group' => 'Hakkımızda'],
            
            // İletişim Sayfası
            ['key' => 'contact_title', 'value' => 'Bize Ulaşın', 'group' => 'İletişim'],
            ['key' => 'contact_desc', 'value' => 'Sorularınız, önerileriniz veya özel sipariş talepleriniz için bizimle iletişime geçebilirsiniz. Size yardımcı olmaktan mutluluk duyarız.', 'group' => 'İletişim'],
            ['key' => 'contact_visit_title', 'value' => 'Mağazamıza Bekliyoruz', 'group' => 'İletişim'],
            ['key' => 'contact_visit_desc', 'value' => 'Modoko\'daki mağazamızı ziyaret ederek koleksiyonlarımızı yakından inceleyebilir, kahvemizi içerken size özel çözümlerimizi konuşabiliriz.', 'group' => 'İletişim'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
        
        // Update existing settings to have a group
        \App\Models\SiteSetting::whereIn('key', ['site_name', 'site_description', 'logo_path', 'working_hours'])->update(['group' => 'Genel']);
        \App\Models\SiteSetting::whereIn('key', ['contact_phone', 'contact_whatsapp', 'contact_email', 'contact_address', 'social_instagram', 'map_embed_url'])->update(['group' => 'İletişim']);
        \App\Models\SiteSetting::whereIn('key', ['hero_video_url', 'showroom_video_url', 'home_parallax_image'])->update(['group' => 'Görsel/Video (Ana Sayfa)']);
        \App\Models\SiteSetting::whereIn('key', ['about_hero_image', 'about_story_image'])->update(['group' => 'Görsel/Video (Hakkımızda)']);
        \App\Models\SiteSetting::whereIn('key', ['contact_hero_image', 'category_hero_image', 'blog_hero_image'])->update(['group' => 'Görsel/Video (Diğer)']);
    }
}
