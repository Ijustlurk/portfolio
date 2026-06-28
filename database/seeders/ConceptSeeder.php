<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioItem;

class ConceptSeeder extends Seeder
{
    public function run(): void
    {
        // Delete existing concepts first to prevent duplicates
        PortfolioItem::where('section', 'concept')->delete();

        $concepts = [
            [
                'title' => 'Neon Synth Landscape',
                'category' => 'Environment Art',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Abstract Flow Concept',
                'category' => 'Fluid Dynamics',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=600',
            ],
            [
                'title' => 'Botanical Guardian',
                'category' => 'Character Design',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&q=80&w=500',
            ],
            [
                'title' => 'Cosmic Nexus Gateway',
                'category' => 'Keyframe Art',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Ethereal Mountain Valley',
                'category' => 'Matte Painting',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=900',
            ],
            [
                'title' => 'Dark Horizon Nebula',
                'category' => 'Skybox Texture',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1478760329108-5c3ed9d495a0?auto=format&fit=crop&q=80&w=700',
            ],
            [
                'title' => 'Geometric Dichotomy',
                'category' => 'Composition Study',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?auto=format&fit=crop&q=80&w=600',
            ],
            [
                'title' => 'Ancient Gilded Sanctuary',
                'category' => 'Level Design',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Cyber Grid Interface',
                'category' => 'UI/UX Concept',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&q=80&w=950',
            ],
            [
                'title' => 'Celestial Cleric',
                'category' => 'Costume Design',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&q=80&w=600',
            ],
            [
                'title' => 'Retro Sunset Horizon',
                'category' => 'Vibe Art',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Digital Prism Array',
                'category' => 'VFX Concept',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1563089145-599997674d42?auto=format&fit=crop&q=80&w=700',
            ],
            [
                'title' => 'Vibrant Neon Circle',
                'category' => 'VFX Study',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1515462277126-270d878326e5?auto=format&fit=crop&q=80&w=700',
            ],
            [
                'title' => 'Space Fantasy Nebula',
                'category' => 'Matte Painting',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1561736778-92e52a7769ef?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Warm Sunset Horizon',
                'category' => 'Concept Study',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1501183007986-d0d080b147f9?auto=format&fit=crop&q=80&w=750',
            ],
            [
                'title' => 'Aesthetic Botanical Leaf',
                'category' => 'Texture Design',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1525498128493-380d1990a112?auto=format&fit=crop&q=80&w=700',
            ],
            [
                'title' => 'Landscape Brush Strokes',
                'category' => 'Stylized Matte',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1536924940846-227afb31e2a5?auto=format&fit=crop&q=80&w=850',
            ],
            [
                'title' => 'Aesthetic Flower Portrait',
                'category' => 'Color Study',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1520690216874-32cedc35f68c?auto=format&fit=crop&q=80&w=650',
            ],
            [
                'title' => 'Anime Pastel Sky',
                'category' => 'Environment Sketch',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1518156677180-95a2893f3e9f?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Abstract Paint Texture',
                'category' => 'Asset Concept',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1549490349-8643362247b5?auto=format&fit=crop&q=80&w=600',
            ],
            [
                'title' => 'Vibrant Abstract Gradient',
                'category' => 'Lighting Key',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Modern Colorful Splash',
                'category' => 'Concept FX',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1547891654-e66ed7edd96c?auto=format&fit=crop&q=80&w=700',
            ],
            [
                'title' => 'Scenic Mountains Art',
                'category' => 'Matte Painting',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1501472312651-726afd116ff1?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Colorful Abstract Portrait',
                'category' => 'Stylization Key',
                'section' => 'concept',
                'type' => null,
                'image_path' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=750',
            ],
        ];

        foreach ($concepts as $item) {
            PortfolioItem::create($item);
        }
    }
}
