<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            // ── ARABICA ─────────────────────────────────────
            [
                'name'              => 'Java Slamet Arabica — Full Wash',
                'slug'              => 'java-slamet-arabica-full-wash',
                'thumbnail'         => 'assets/img/products/arabica-full-wash.jpg',
                'short_description' => 'Bright, clean Arabica from Mount Slamet processed with full wet/washed method. Ideal for specialty filter, pour-over, and cold brew.',
                'description'       => '<p>Sourced from the fertile volcanic slopes of <strong>Mount Slamet</strong> and <strong>Mount Sindoro-Sumbing</strong> in Central Java at altitudes of 800–1,500 MASL, our Java Slamet Arabica Full Wash delivers a clean, bright cup with complex flavor layering.</p>
<p>Processed using the traditional wet/washed method, the beans undergo careful fermentation and washing stages to highlight the natural acidity and clarity of the origin. The result is a specialty-grade coffee with outstanding uniformity, sweetness, and a clean finish.</p>
<p>Best suited for <em>specialty filter brewing</em>, pour-over, AeroPress, and cold brew applications.</p>',
                'is_featured'       => true,
                'specifications'    => [
                    'category'      => 'Arabica',
                    'origin'        => 'Banyumas Raya (Mt. Slamet) & Temanggung (Mt. Sindoro-Sumbing)',
                    'altitude'      => '800 – 1,500 MASL',
                    'process'       => 'Full Wash (Wet Process)',
                    'screen_size'   => 'Medium to Large (Grade 15–18)',
                    'moisture'      => '10–12%',
                    'defect_rate'   => 'Max 5 defects / 300g (SCAA Grade 1)',
                    'annual_capacity' => '40 MT / year',
                    'min_order'     => '5 kg (sample) · 100 kg (trial)',
                    'packaging'     => 'Jute Bags (60 kg), Vacuum-Sealed (1/5/10 kg), GrainPro Liners',
                    'certifications'=> ['Halal', 'Certificate of Origin (COO)', 'SKA Form ICO', 'Phytosanitary'],
                    'taste_notes'   => ['Brown Sugar', 'Orange', 'Raisin', 'Black Tea'],
                    'cupping_score' => 84.25,
                    'flavor_profile' => [
                        'Fragrance'  => 8.0,
                        'Flavor'     => 7.75,
                        'Aftertaste' => 7.75,
                        'Acidity'    => 7.50,
                        'Body'       => 7.75,
                        'Uniformity' => 10.0,
                        'Balance'    => 7.75,
                        'Clean Cup'  => 10.0,
                        'Sweetness'  => 10.0,
                        'Overall'    => 7.75,
                    ],
                ],
            ],

            // ── ARABICA NATURAL ─────────────────────────────
            [
                'name'              => 'Java Slamet Arabica — Wine/Natural',
                'slug'              => 'java-slamet-arabica-natural',
                'thumbnail'         => 'assets/img/products/arabica-natural.jpg',
                'short_description' => 'Natural-processed Arabica with rich fruit-forward sweetness. Sun-dried on raised beds for deep, complex cup character.',
                'description'       => '<p>Our Natural process Arabica undergoes extended sun-drying with the full cherry intact, allowing the fruit sugars to deeply penetrate the bean. This results in a heavier body and more pronounced fruit-forward sweetness compared to the washed variety.</p>
<p>Grown at 800–1,500 MASL on the slopes of Mount Slamet, each batch is carefully sorted and dried on raised beds under controlled conditions to achieve optimal moisture content of 10–12%.</p>
<p>Best suited for <em>espresso blends</em>, moka pot, and specialty pourover for those who enjoy a sweet, wine-like cup.</p>',
                'is_featured'       => true,
                'specifications'    => [
                    'category'      => 'Arabica',
                    'origin'        => 'Banyumas Raya (Mt. Slamet)',
                    'altitude'      => '800 – 1,500 MASL',
                    'process'       => 'Natural (Sun-Dried)',
                    'screen_size'   => 'Medium to Large (Grade 15–18)',
                    'moisture'      => '10–12%',
                    'defect_rate'   => 'Max 5 defects / 300g (SCAA Grade 1)',
                    'annual_capacity' => '40 MT / year (shared with washed)',
                    'min_order'     => '5 kg (sample) · 100 kg (trial)',
                    'packaging'     => 'Jute Bags (60 kg), Vacuum-Sealed (1/5/10 kg), GrainPro Liners',
                    'certifications'=> ['Halal', 'Certificate of Origin (COO)', 'SKA Form ICO', 'Phytosanitary'],
                    'taste_notes'   => ['Dark Berry', 'Brown Sugar', 'Stone Fruit', 'Wine'],
                    'cupping_score' => 83.50,
                    'flavor_profile' => [
                        'Fragrance'  => 8.0,
                        'Flavor'     => 7.75,
                        'Aftertaste' => 7.50,
                        'Acidity'    => 7.25,
                        'Body'       => 8.0,
                        'Uniformity' => 10.0,
                        'Balance'    => 7.50,
                        'Clean Cup'  => 10.0,
                        'Sweetness'  => 10.0,
                        'Overall'    => 7.50,
                    ],
                ],
            ],

            // ── ROBUSTA ─────────────────────────────────────
            [
                'name'              => 'Banyumas Robusta — Grade 1',
                'slug'              => 'banyumas-robusta-grade-1',
                'thumbnail'         => 'assets/img/products/robusta-grade1.jpg',
                'short_description' => 'Full-bodied premium Robusta from Banyumas Raya. Rich dark chocolate, almond, and brown sugar notes. Excellent for espresso blends.',
                'description'       => '<p>Our <strong>Banyumas Robusta Grade 1</strong> comes from the lower slopes of Mount Slamet at 500–1,200 MASL in the Banyumas Raya region, Central Java. Processed using the natural sun-drying method, the beans develop a distinctively full body, low acidity, and rich earthy-chocolate character.</p>
<p>With a defect rate of maximum 5 beans per sample, this is our premium Robusta offering — consistent in quality, competitive in pricing, and ideal for commercial espresso blending and instant coffee production.</p>
<p>We maintain stable supply year-round through our network of over 770,000 coffee plants in the region.</p>',
                'is_featured'       => true,
                'specifications'    => [
                    'category'      => 'Robusta',
                    'origin'        => 'Banyumas Raya (Mt. Slamet), Central Java',
                    'altitude'      => '500 – 1,200 MASL',
                    'process'       => 'Natural (Sun-Dried)',
                    'screen_size'   => 'Medium (Grade 15–16)',
                    'moisture'      => '10–12%',
                    'defect_rate'   => 'Maximum 5 defect beans (Grade 1)',
                    'annual_capacity' => '700 MT / year',
                    'min_order'     => '5 kg (sample) · 100 kg (trial)',
                    'packaging'     => 'Jute Bags (60 kg), Vacuum-Sealed (1/5/10 kg), GrainPro Liners',
                    'certifications'=> ['Halal', 'Certificate of Origin (COO)', 'SKA Form ICO', 'Phytosanitary'],
                    'taste_notes'   => ['Dark Chocolate', 'Brown Sugar', 'Almond', 'Earthy'],
                    'cupping_score' => 81.75,
                    'flavor_profile' => [
                        'Fragrance'    => 8.0,
                        'Flavor'       => 7.75,
                        'Aftertaste'   => 7.75,
                        'Salt/Acid'    => 7.50,
                        'Bitter/Sweet' => 7.50,
                        'Mouthfeel'    => 7.75,
                        'Uniformity'   => 10.0,
                        'Balance'      => 7.75,
                        'Clean Cup'    => 10.0,
                        'Overall'      => 7.75,
                    ],
                ],
            ],

            // ── ROBUSTA GRADE 2 ─────────────────────────────
            [
                'name'              => 'Banyumas Robusta — Grade 2',
                'slug'              => 'banyumas-robusta-grade-2',
                'thumbnail'         => 'assets/img/products/robusta-grade2.jpg',
                'short_description' => 'Standard export-quality Robusta from Banyumas Raya. Consistent supply, competitive pricing — ideal for commercial blending.',
                'description'       => '<p>Our <strong>Robusta Grade 2</strong> offers reliable quality at a competitive price point. Sourced from the same farming networks as our Grade 1, this variety allows a defect rate of up to 10 beans per sample, making it ideal for high-volume commercial buyers who require consistent supply at scale.</p>
<p>The flavor profile retains the characteristic Robusta boldness — strong body, earthy tones, and a robust caffeine content — suitable for instant coffee, commercial espresso blends, and RTD (ready-to-drink) coffee production.</p>',
                'is_featured'       => false,
                'specifications'    => [
                    'category'      => 'Robusta',
                    'origin'        => 'Banyumas Raya (Mt. Slamet), Central Java',
                    'altitude'      => '500 – 1,200 MASL',
                    'process'       => 'Natural (Sun-Dried)',
                    'screen_size'   => 'Medium (Grade 15–16)',
                    'moisture'      => '10–12%',
                    'defect_rate'   => 'Maximum 10 defect beans (Grade 2)',
                    'annual_capacity' => '700 MT / year (shared with Grade 1)',
                    'min_order'     => '5 kg (sample) · 100 kg (trial)',
                    'packaging'     => 'Jute Bags (60 kg), GrainPro Liners',
                    'certifications'=> ['Halal', 'Certificate of Origin (COO)', 'Phytosanitary'],
                    'taste_notes'   => ['Earthy', 'Dark Chocolate', 'Tobacco', 'Nutty'],
                    'cupping_score' => 79.50,
                    'flavor_profile' => [
                        'Fragrance'    => 7.75,
                        'Flavor'       => 7.50,
                        'Aftertaste'   => 7.50,
                        'Salt/Acid'    => 7.25,
                        'Bitter/Sweet' => 7.50,
                        'Mouthfeel'    => 7.75,
                        'Uniformity'   => 10.0,
                        'Balance'      => 7.25,
                        'Clean Cup'    => 10.0,
                        'Overall'      => 7.00,
                    ],
                ],
            ],

        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $this->command->info('✅ ProductSeeder: ' . count($products) . ' products seeded.');
    }
}
