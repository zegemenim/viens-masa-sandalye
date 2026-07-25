<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User
        User::firstOrCreate(
            ['email' => 'admin@viens.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );

        // 2. Settings
        $settings = [
            'site_name' => 'Viens Masa Sandalye',
            'site_description' => 'Kaliteli ve şık masa sandalye modelleri. Modoko kalbiyle evlerinize şıklık taşıyoruz.',
            'contact_phone' => '+90 552 280 29 29',
            'contact_whatsapp' => '905522802929',
            'contact_email' => 'info@viens.com',
            'contact_address' => 'Modoko, Barbaros Hayrettin Paşa Cad. İstanbul',
            'social_instagram' => 'https://www.instagram.com/viensmasasandalye',
            'working_hours' => 'Pzt – Cmt: 09:00 – 18:30 | Pazar: 10:00 – 17:00',
            'hero_video_url' => '',
            'showroom_video_url' => '',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.642928509172!2d29.1557997!3d40.9892809!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cac8ff5bc9e735%3A0xb3e6a9f456c6c59b!2sMODOKO%20Mobilyac%C4%B1lar%20Sitesi!5e0!3m2!1str!2str!4v1700000000000!5m2!1str!2str',
            'logo_path' => '',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        $this->call(TextAndSeoSettingsSeeder::class);

        // 3. Categories
        $catMasalar = Category::firstOrCreate(['slug' => 'masalar'], ['name' => 'Masalar', 'description' => 'Ahşap, mermer ve cam detaylı modern yemek masası modelleri.']);
        $catSandalyeler = Category::firstOrCreate(['slug' => 'sandalyeler'], ['name' => 'Sandalyeler', 'description' => 'Konforlu, kumaş ve ahşap ayaklı şık sandalye koleksiyonları.']);

        // 4. Products
        $products = [
            [
                'name' => 'Umay Sandalye',
                'category_id' => $catSandalyeler->id,
                'price' => 1500,
                'stock_status' => true,
                'image_path' => 'https://images.unsplash.com/photo-1580481072645-022f9a6d8310?w=800&auto=format&fit=crop&q=80',
                'description' => '<p>Ergonomik sırt yapısı ve nubuk kumaş kaplamasıyla yemek odalarınıza konfor katar. Fırınlanmış gürgen ağacından imal edilmiştir.</p>',
            ],
            [
                'name' => 'Lara Ahşap Masa',
                'category_id' => $catMasalar->id,
                'price' => 4500,
                'stock_status' => true,
                'image_path' => 'https://images.unsplash.com/photo-1530018607912-eff2daa1bac4?w=800&auto=format&fit=crop&q=80',
                'description' => '<p>Doğal meşe kaplama ve metal siyah ayak detayıyla modern endüstriyel tasarımı yaşam alanınıza taşır. 6-8 kişilik kullanım içindir.</p>',
            ],
            [
                'name' => 'Nora Kumaş Sandalye',
                'category_id' => $catSandalyeler->id,
                'price' => 1250,
                'stock_status' => true,
                'image_path' => 'https://images.unsplash.com/photo-1503602642458-232111445657?w=800&auto=format&fit=crop&q=80',
                'description' => '<p>Leke tutmaz kadife kumaş seçeneği ve zarafetiyle salonunuzun yıldızı olmaya aday.</p>',
            ],
            [
                'name' => 'Vera Mermer Masa Takımı',
                'category_id' => $catMasalar->id,
                'price' => 8500,
                'stock_status' => true,
                'image_path' => 'https://images.unsplash.com/photo-1615066390971-03e4e1c36ddf?w=800&auto=format&fit=crop&q=80',
                'description' => '<p>Gerçek İtalyan mermer tabla ve pirinç detaylı ayaklarıyla lüksün simgesi. Takıma 6 adet sandalye dahildir.</p>',
            ],
            [
                'name' => 'Enzo Bar Sandalyesi',
                'category_id' => $catSandalyeler->id,
                'price' => 1800,
                'stock_status' => true,
                'image_path' => 'https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?w=800&auto=format&fit=crop&q=80',
                'description' => '<p>Ada mutfaklar ve bar alanları için özel yükseklikte tasarlanmış deri kaplama sandalye.</p>',
            ],
            [
                'name' => 'Roma Açılır Yemek Masası',
                'category_id' => $catMasalar->id,
                'price' => 5500,
                'stock_status' => true,
                'image_path' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=800&auto=format&fit=crop&q=80',
                'description' => '<p>Kolay açılır mekanizması sayesinde 6 kişilikten 10 kişiliğe pratik şekilde dönüştürülebilir.</p>',
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'category_id' => $p['category_id'],
                    'price' => $p['price'],
                    'stock_status' => $p['stock_status'],
                    'image_path' => $p['image_path'],
                    'description' => $p['description'],
                ]
            );
        }

        // 5. Blogs
        Blog::updateOrCreate(
            ['slug' => 'yemek-odasi-dekorasyon-fikirleri'],
            [
                'title' => 'Yemek Odası Dekorasyon Fikirleri',
                'image_path' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=800&auto=format&fit=crop&q=80',
                'content' => '<p>Evinizin kalbi yemek odanız için harika fikirler derledik. Masa ve sandalye uyumu nasıl olmalı, hangi renkleri tercih etmelisiniz? Detaylar yazımızda.</p>',
            ]
        );
        Blog::updateOrCreate(
            ['slug' => 'ahsap-masa-bakimi'],
            [
                'title' => 'Ahşap Masa Bakımı Nasıl Yapılır?',
                'image_path' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800&auto=format&fit=crop&q=80',
                'content' => '<p>Ahşap masalarınızın ömrünü uzatmak ve ilk günkü gibi parlak görünmesini sağlamak için doğal koruma ipuçları.</p>',
            ]
        );
    }
}
