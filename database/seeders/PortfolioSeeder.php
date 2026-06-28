<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed the default admin user
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Seed Default Illustrations
        $illustrations = [
            // Original
            [
                'title' => 'Cyber Bloom',
                'category' => 'Vibrant Character',
                'section' => 'illustration',
                'type' => 'original',
                'image_path' => 'https://images.unsplash.com/photo-1578632767115-351597cf2477?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Retro City Grid',
                'category' => 'Environment',
                'section' => 'illustration',
                'type' => 'original',
                'image_path' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Astral Drift',
                'category' => 'Sci-Fi Concept',
                'section' => 'illustration',
                'type' => 'original',
                'image_path' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Neon Synthesis',
                'category' => 'Portrait Art',
                'section' => 'illustration',
                'type' => 'original',
                'image_path' => 'https://images.unsplash.com/photo-1563089145-599997674d42?auto=format&fit=crop&q=80&w=800',
            ],
            // Fanart
            [
                'title' => 'Little Dreamer',
                'category' => 'Cute Mascot',
                'section' => 'illustration',
                'type' => 'fanart',
                'image_path' => 'https://images.unsplash.com/photo-1601987177651-8edfe6c20009?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Cyber Toy',
                'category' => '3D Figurine',
                'section' => 'illustration',
                'type' => 'fanart',
                'image_path' => 'https://images.unsplash.com/photo-1599481238640-4c1288750d7a?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Pocket Arcade',
                'category' => 'Gaming Vector',
                'section' => 'illustration',
                'type' => 'fanart',
                'image_path' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Magical Wish',
                'category' => 'Pastel Whimsy',
                'section' => 'illustration',
                'type' => 'fanart',
                'image_path' => 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?auto=format&fit=crop&q=80&w=800',
            ],
            // Spicy
            [
                'title' => 'Crimson Eclipse',
                'category' => 'Stylized Noir',
                'section' => 'illustration',
                'type' => 'spicy',
                'image_path' => 'https://images.unsplash.com/photo-1508739773434-c26b3d09e071?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Scarlet Shadow',
                'category' => 'Dynamic Cyber',
                'section' => 'illustration',
                'type' => 'spicy',
                'image_path' => 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Neon Firestorm',
                'category' => 'Abstract Glow',
                'section' => 'illustration',
                'type' => 'spicy',
                'image_path' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Velvet Annihilation',
                'category' => 'Fluid Flow',
                'section' => 'illustration',
                'type' => 'spicy',
                'image_path' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=800',
            ],
        ];

        foreach ($illustrations as $item) {
            PortfolioItem::create($item);
        }

        // 3. Seed Default Comics
        $comics = [
            [
                'title' => 'Neon Samurai Chronicles',
                'category' => 'Manga Series',
                'section' => 'comic',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'City of Sparks',
                'category' => 'Webtoon',
                'section' => 'comic',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Chronicles of the Void',
                'category' => 'Graphic Novel',
                'section' => 'comic',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&q=80&w=800',
            ],
        ];

        foreach ($comics as $item) {
            PortfolioItem::create($item);
        }

        // 4. Seed Default Concepts
        $concepts = [
            [
                'title' => 'The Floating Sanctuary',
                'category' => 'Environment Design',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Ember Knight Armor',
                'category' => 'Character Design',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Quantum Skiff V2',
                'category' => 'Sci-Fi Prop Design',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&q=80&w=800',
            ],
        ];

        foreach ($concepts as $item) {
            PortfolioItem::create($item);
        }
    }
}
