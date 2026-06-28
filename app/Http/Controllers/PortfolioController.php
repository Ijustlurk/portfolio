<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\AboutContent;
use App\Models\Setting;
use App\Models\CommissionTier;
use App\Models\SocialLink;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    /**
     * Display the public portfolio landing page.
     */
    public function index()
    {
        // Fetch and format illustrations for the JavaScript slider
        $illustrationsRaw = PortfolioItem::where('section', 'illustration')->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get();
        
        $illustrations = [
            'original' => $illustrationsRaw->where('type', 'original')->map(fn($item) => [
                'img' => str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path),
                'title' => $item->title,
                'description' => $item->description,
                'category' => $item->category,
                'image_scale' => $item->image_scale,
                'image_offset_x' => $item->image_offset_x,
                'image_offset_y' => $item->image_offset_y,
                'timelapse_url' => $item->timelapse_path ? (str_starts_with($item->timelapse_path, 'http') ? $item->timelapse_path : asset('storage/' . $item->timelapse_path)) : null,
            ])->values()->toArray(),
            
            'fanart' => $illustrationsRaw->where('type', 'fanart')->map(fn($item) => [
                'img' => str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path),
                'title' => $item->title,
                'description' => $item->description,
                'category' => $item->category,
                'image_scale' => $item->image_scale,
                'image_offset_x' => $item->image_offset_x,
                'image_offset_y' => $item->image_offset_y,
                'timelapse_url' => $item->timelapse_path ? (str_starts_with($item->timelapse_path, 'http') ? $item->timelapse_path : asset('storage/' . $item->timelapse_path)) : null,
            ])->values()->toArray(),
            
            'spicy' => $illustrationsRaw->where('type', 'spicy')->map(fn($item) => [
                'img' => str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path),
                'title' => $item->title,
                'description' => $item->description,
                'category' => $item->category,
                'image_scale' => $item->image_scale,
                'image_offset_x' => $item->image_offset_x,
                'image_offset_y' => $item->image_offset_y,
                'timelapse_url' => $item->timelapse_path ? (str_starts_with($item->timelapse_path, 'http') ? $item->timelapse_path : asset('storage/' . $item->timelapse_path)) : null,
            ])->values()->toArray(),
        ];

        // Fetch comics and concepts
        $comics = PortfolioItem::where('section', 'comic')->orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->image_url = str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path);
            return $item;
        });

        $concepts = PortfolioItem::where('section', 'concept')->orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->image_url = str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path);
            return $item;
        });

        $about = AboutContent::firstOrCreate([], [
            'image_path' => 'images/IMG_4171 2.png',
            'image_scale' => 1.0,
            'image_offset_x' => 0,
            'image_offset_y' => 0,
            'text_content' => '<p>This is <strong>Elian Benjamin</strong>, or Yan, or [yanillust].</p>' .
                             '<p>I am a <strong>Digital Artist</strong> in the Philippines mainly specializing in <strong>2D stylized Japanese style illustrations</strong>.</p>' .
                             '<p>I\'ve been on the art industry for <strong>6 years</strong>, polishing my techniques in capturing the anime aesthetic by working as a commission artist for a multitude of individuals.</p>' .
                             '<p>While I embrace modern technology to build, optimize, and assist with the technical layout of this portfolio website, rest assured: all of my artworks and illustrations are, and will always be, <strong>100% human-made</strong>.</p>'
        ]);

        $settings = [
            'maintenance_illustration' => Setting::get('maintenance_illustration', '0') === '1',
            'maintenance_comic' => Setting::get('maintenance_comic', '0') === '1',
            'maintenance_concept' => Setting::get('maintenance_concept', '0') === '1',
        ];

        $socialLinks = SocialLink::orderBy('sort_order', 'asc')->get();

        return view('welcome', compact('illustrations', 'comics', 'concepts', 'about', 'settings', 'socialLinks'));
    }

    /**
     * Display the public commission pricing page.
     */
    public function commission()
    {
        $tiers = CommissionTier::all();
        $multipliers = [
            'detailed_bg' => (int) \App\Models\Setting::get('commission_multiplier_detailed_bg', '50'),
            'source_file' => (int) \App\Models\Setting::get('commission_multiplier_source_file', '20'),
            'urgent' => (int) \App\Models\Setting::get('commission_multiplier_urgent', '30'),
            'commercial' => (int) \App\Models\Setting::get('commission_multiplier_commercial', '30'),
            'additional_char' => (int) \App\Models\Setting::get('commission_multiplier_additional_character', '70'),
            'with_graphic' => (int) \App\Models\Setting::get('commission_multiplier_with_graphic', '20'),
            'char_sheet_sketch' => (int) \App\Models\Setting::get('commission_price_char_sheet_sketch', '80'),
            'char_sheet_flat_color' => (int) \App\Models\Setting::get('commission_price_char_sheet_flat_color', '140'),
            'char_sheet_fully_rendered' => (int) \App\Models\Setting::get('commission_price_char_sheet_fully_rendered', '220'),
            'nsfw' => (int) \App\Models\Setting::get('commission_price_nsfw', '50'),
        ];
        return view('commission', compact('tiers', 'multipliers'));
    }
}
