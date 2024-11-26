<?php

namespace Database\Seeders;

use App\Models\Mug;
use Illuminate\Database\Seeder;

class MugSeeder extends Seeder
{
    public function run(): void
    {
        $mugs = [
            [
                'name' => 'Classic White Mug',
                'description' => 'Simple and elegant white ceramic mug, perfect for everyday use. Made from high-quality porcelain with a glossy finish. Dishwasher and microwave safe. Capacity: 350ml.',
                'price' => 9.99,
                'image' => 'storage/mugs/classic-white.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Black Coffee Lover Mug',
                'description' => 'Sleek matte black mug designed for coffee enthusiasts. Features double-wall insulation to keep your coffee hot longer. Ergonomic handle and wide mouth design. Capacity: 400ml.',
                'price' => 12.99,
                'image' => 'storage/mugs/black-coffee.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Colorful Rainbow Mug',
                'description' => 'Vibrant rainbow-colored ceramic mug that brings joy to your morning routine. Hand-painted with food-safe colors. Each piece is unique with slight variations in pattern. Capacity: 300ml.',
                'price' => 14.99,
                'image' => 'storage/mugs/rainbow.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Travel Thermos Mug',
                'description' => 'Premium stainless steel travel mug with vacuum insulation. Keeps drinks hot for 12 hours or cold for 24 hours. Leak-proof lid with easy-sip opening. Perfect for commuters. Capacity: 475ml.',
                'price' => 19.99,
                'image' => 'storage/mugs/thermos.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vintage Design Mug',
                'description' => 'Retro-styled mug featuring classic 1950s patterns. Made from durable stoneware with a distressed finish for authentic vintage look. Hand-painted details and gold rim accent. Capacity: 325ml.',
                'price' => 11.99,
                'image' => 'storage/mugs/vintage.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Custom Photo Mug',
                'description' => 'Personalized ceramic mug with high-quality photo printing. Upload your favorite memory and we\'ll create a lasting keepsake. Scratch-resistant coating ensures image longevity. Capacity: 350ml.',
                'price' => 16.99,
                'image' => 'storage/mugs/custom-photo.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Large Capacity Mug',
                'description' => 'Oversized ceramic mug for those who need their extra-large coffee fix. Wide base for stability, extra-large handle for comfort. Perfect for soup or cereal too. Capacity: 650ml.',
                'price' => 15.99,
                'image' => 'storage/mugs/large-capacity.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Couples Mug Set',
                'description' => 'Adorable matching pair of mugs with complementary designs. Features "His" and "Hers" or customizable text. Makes a perfect wedding or anniversary gift. Comes in a premium gift box. Capacity: 300ml each.',
                'price' => 24.99,
                'image' => 'storage/mugs/couples.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kids Cartoon Mug',
                'description' => 'Child-friendly mug featuring playful cartoon characters. Made from break-resistant ceramic material. BPA-free with easy-grip handle sized for small hands. Dishwasher safe. Capacity: 250ml.',
                'price' => 8.99,
                'image' => 'storage/mugs/kids.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Premium Ceramic Mug',
                'description' => 'Luxury ceramic mug crafted from fine bone china. Features an elegant design with platinum accents. Ultra-smooth glazed finish and perfectly balanced weight. Ideal for gift-giving. Capacity: 375ml.',
                'price' => 21.99,
                'image' => 'storage/mugs/premium-ceramic.webp',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($mugs as $mug) {
            Mug::create($mug);
        }
    }
} 