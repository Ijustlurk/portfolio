<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\AboutContent;
use App\Models\PageView;
use App\Models\Setting;
use App\Models\CommissionTier;
use App\Models\SocialLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('cms.dashboard');
        }
        return view('cms.login');
    }

    /**
     * Handle authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('cms.dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    /**
     * Log out the administrator.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Display the CMS Dashboard.
     */
    public function index()
    {
        $illustrations = PortfolioItem::where('section', 'illustration')->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get();
        $comics = PortfolioItem::where('section', 'comic')->orderBy('created_at', 'desc')->get();
        $concepts = PortfolioItem::where('section', 'concept')->orderBy('created_at', 'desc')->get();

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

        // 1. Core Summary Metrics
        $totalViews = PageView::count();
        $uniqueVisitors = PageView::distinct('ip_address')->count('ip_address');
        $viewsToday = PageView::where('created_at', '>=', now()->startOfDay())->count();
        $uniqueToday = PageView::where('created_at', '>=', now()->startOfDay())->distinct('ip_address')->count('ip_address');

        // 2. 14 Days Historical Traffic (for Chart.js Line Graph)
        $chartLabels = [];
        $chartViews = [];
        $chartUniques = [];
        
        // Loop back 14 days
        for ($i = 13; $i >= 0; $i--) {
            $start = now()->subDays($i)->startOfDay();
            $end = now()->subDays($i)->endOfDay();
            
            $chartLabels[] = now()->subDays($i)->format('M d');
            $chartViews[] = PageView::whereBetween('created_at', [$start, $end])->count();
            $chartUniques[] = PageView::whereBetween('created_at', [$start, $end])->distinct('ip_address')->count('ip_address');
        }

        // 3. Device Distribution (Mobile vs Desktop)
        $userAgents = PageView::select('user_agent')->get();
        $mobileCount = 0;
        $desktopCount = 0;
        foreach ($userAgents as $ua) {
            if (!$ua->user_agent) {
                $desktopCount++;
                continue;
            }
            $userAgentStr = strtolower($ua->user_agent);
            if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $userAgentStr)) {
                $mobileCount++;
            } else {
                $desktopCount++;
            }
        }

        // 4. Top Visited Paths
        $topPages = PageView::select('path')
            ->selectRaw('count(*) as hits')
            ->groupBy('path')
            ->orderBy('hits', 'desc')
            ->limit(8)
            ->get()
            ->map(function ($page) use ($totalViews) {
                $page->percentage = $totalViews > 0 ? round(($page->hits / $totalViews) * 100, 1) : 0;
                return $page;
            });

        // 5. Recent Visits
        $recentVisits = PageView::orderBy('created_at', 'desc')->limit(15)->get();

        $analytics = [
            'total_views' => $totalViews,
            'unique_visitors' => $uniqueVisitors,
            'views_today' => $viewsToday,
            'unique_today' => $uniqueToday,
            'chart_labels' => $chartLabels,
            'chart_views' => $chartViews,
            'chart_uniques' => $chartUniques,
            'mobile_count' => $mobileCount,
            'desktop_count' => $desktopCount,
            'top_pages' => $topPages,
            'recent_visits' => $recentVisits,
        ];

        $settings = [
            'maintenance_illustration' => Setting::get('maintenance_illustration', '0'),
            'maintenance_comic' => Setting::get('maintenance_comic', '0'),
            'maintenance_concept' => Setting::get('maintenance_concept', '0'),
        ];

        $commissions = CommissionTier::all();
        $commissionSettings = [
            'multiplier_detailed_bg' => Setting::get('commission_multiplier_detailed_bg', '50'),
            'multiplier_source_file' => Setting::get('commission_multiplier_source_file', '20'),
            'multiplier_urgent' => Setting::get('commission_multiplier_urgent', '30'),
            'multiplier_commercial' => Setting::get('commission_multiplier_commercial', '30'),
            'multiplier_additional_character' => Setting::get('commission_multiplier_additional_character', '70'),
            'multiplier_with_graphic' => Setting::get('commission_multiplier_with_graphic', '20'),
            'price_char_sheet_sketch' => Setting::get('commission_price_char_sheet_sketch', '80'),
            'price_char_sheet_flat_color' => Setting::get('commission_price_char_sheet_flat_color', '140'),
            'price_char_sheet_fully_rendered' => Setting::get('commission_price_char_sheet_fully_rendered', '220'),
            'price_nsfw' => Setting::get('commission_price_nsfw', '50'),
        ];

        $socialLinks = SocialLink::orderBy('sort_order', 'asc')->get();

        return view('cms.dashboard', compact('illustrations', 'comics', 'concepts', 'about', 'analytics', 'settings', 'commissions', 'commissionSettings', 'socialLinks'));
    }

    /**
     * Store a newly created portfolio item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string|max:255',
            'section' => 'required|string|in:illustration,comic,concept',
            'type' => 'nullable|string|in:original,fanart,spicy',
            'image' => 'required_without:image_url|nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Max 5MB
            'image_url' => 'nullable|url',
            'pages' => 'nullable|string',
            'reading_direction' => 'nullable|string|in:ltr,rtl',
            'image_scale' => 'nullable|numeric|min:0.5|max:10.0',
            'image_offset_x' => 'nullable|integer',
            'image_offset_y' => 'nullable|integer',
            'has_timelapse' => 'nullable|string|in:1,0',
            'timelapse_video' => 'nullable|file|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime|max:30720', // Max 30MB
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolio', 'public');
        } elseif ($request->filled('image_url')) {
            $imagePath = $this->cleanImageUrl($request->image_url);
        }

        $timelapsePath = null;
        if ($request->input('has_timelapse') === '1' && $request->hasFile('timelapse_video')) {
            $timelapsePath = $request->file('timelapse_video')->store('timelapse', 'public');
        }

        $pages = null;
        if ($request->filled('pages')) {
            $pages = json_decode($request->pages, true);
        }

        PortfolioItem::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'section' => $request->section,
            'type' => $request->section === 'illustration' ? $request->type : null,
            'image_path' => $imagePath,
            'pages' => $pages,
            'reading_direction' => $request->section === 'comic' ? ($request->reading_direction ?? 'ltr') : 'ltr',
            'image_scale' => $request->input('image_scale', 1.0),
            'image_offset_x' => $request->input('image_offset_x', 0),
            'image_offset_y' => $request->input('image_offset_y', 0),
            'timelapse_path' => $timelapsePath,
        ]);

        return redirect()->route('cms.dashboard')->with('success', 'Item created successfully!');
    }

    /**
     * Update the specified portfolio item in storage.
     */
    public function update(Request $request, $id)
    {
        $item = PortfolioItem::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string|max:255',
            'section' => 'required|string|in:illustration,comic,concept',
            'type' => 'nullable|string|in:original,fanart,spicy',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|url',
            'pages' => 'nullable|string',
            'reading_direction' => 'nullable|string|in:ltr,rtl',
            'image_scale' => 'nullable|numeric|min:0.5|max:10.0',
            'image_offset_x' => 'nullable|integer',
            'image_offset_y' => 'nullable|integer',
            'has_timelapse' => 'nullable|string|in:1,0',
            'timelapse_video' => 'nullable|file|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime|max:30720',
        ]);

        $imagePath = $item->image_path;

        if ($request->hasFile('image')) {
            // Delete old image if it is stored locally
            if (!str_starts_with($item->image_path, 'http')) {
                Storage::disk('public')->delete($item->image_path);
            }
            // Store new image
            $imagePath = $request->file('image')->store('portfolio', 'public');
        } elseif ($request->filled('image_url')) {
            $newUrl = $this->cleanImageUrl($request->image_url);
            if ($newUrl !== $item->image_path) {
                // Delete old image if it was stored locally
                if (!str_starts_with($item->image_path, 'http')) {
                    Storage::disk('public')->delete($item->image_path);
                }
                $imagePath = $newUrl;
            }
        }

        $timelapsePath = $item->timelapse_path;

        if ($request->input('has_timelapse') === '1') {
            if ($request->hasFile('timelapse_video')) {
                // Delete old video if it is stored locally
                if ($item->timelapse_path && !str_starts_with($item->timelapse_path, 'http')) {
                    Storage::disk('public')->delete($item->timelapse_path);
                }
                // Store new video
                $timelapsePath = $request->file('timelapse_video')->store('timelapse', 'public');
            }
        } else {
            // User unchecked or didn't include timelapse - delete old video if it exists
            if ($item->timelapse_path) {
                if (!str_starts_with($item->timelapse_path, 'http')) {
                    Storage::disk('public')->delete($item->timelapse_path);
                }
                $timelapsePath = null;
            }
        }

        $pages = $item->pages; // default to old pages
        if ($request->has('pages')) {
            $pages = $request->filled('pages') ? json_decode($request->pages, true) : null;
        }

        $item->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'section' => $request->section,
            'type' => $request->section === 'illustration' ? $request->type : null,
            'image_path' => $imagePath,
            'pages' => $pages,
            'reading_direction' => $request->section === 'comic' ? ($request->reading_direction ?? $item->reading_direction ?? 'ltr') : 'ltr',
            'image_scale' => $request->input('image_scale', 1.0),
            'image_offset_x' => $request->input('image_offset_x', 0),
            'image_offset_y' => $request->input('image_offset_y', 0),
            'timelapse_path' => $timelapsePath,
        ]);

        return redirect()->route('cms.dashboard')->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified portfolio item from storage.
     */
    public function destroy($id)
    {
        $item = PortfolioItem::findOrFail($id);

        // Delete local image file
        if (!str_starts_with($item->image_path, 'http')) {
            Storage::disk('public')->delete($item->image_path);
        }

        // Delete local timelapse video file
        if ($item->timelapse_path && !str_starts_with($item->timelapse_path, 'http')) {
            Storage::disk('public')->delete($item->timelapse_path);
        }

        // Delete generated flipbook folder if it exists
        if ($item->pages && is_array($item->pages) && !empty($item->pages)) {
            $firstPage = $item->pages[0];
            $parts = explode('/', $firstPage);
            if (count($parts) >= 3 && $parts[0] === 'uploads' && $parts[1] === 'flipbooks') {
                $folderName = basename($parts[2]); // Strip any path traversal
                if (preg_match('/^[a-zA-Z0-9_-]+$/', $folderName)) {
                    $dirPath = public_path('uploads/flipbooks/' . $folderName);
                    if (file_exists($dirPath) && is_dir($dirPath)) {
                        self::deleteDir($dirPath);
                    }
                }
            }
        }

        $item->delete();

        return redirect()->route('cms.dashboard')->with('success', 'Item deleted successfully!');
    }

    /**
     * Toggle the reading direction of a comic item.
     */
    public function toggleDirection($id)
    {
        $item = PortfolioItem::findOrFail($id);
        $newDir = ($item->reading_direction === 'rtl') ? 'ltr' : 'rtl';
        $item->update(['reading_direction' => $newDir]);

        return response()->json([
            'success' => true,
            'direction' => $newDir
        ]);
    }

    /**
     * Reorder the illustrations sort_order.
     */
    public function reorderIllustrations(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:portfolio_items,id',
        ]);

        $order = $request->input('order');

        foreach ($order as $position => $id) {
            PortfolioItem::where('id', $id)->update(['sort_order' => $position]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Illustrations reordered successfully.'
        ]);
    }

    /**
     * Recursively delete directory.
     */
    private static function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) return;
        $files = array_diff(scandir($dirPath), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dirPath/$file")) ? self::deleteDir("$dirPath/$file") : unlink("$dirPath/$file");
        }
        return rmdir($dirPath);
    }

    /**
     * Update the About section content.
     */
    public function updateAbout(Request $request)
    {
        $about = AboutContent::firstOrCreate([]);

        $request->validate([
            'image_scale' => 'required|numeric|min:0.5|max:10.0',
            'image_offset_x' => 'required|integer',
            'image_offset_y' => 'required|integer',
            'text_content' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'about_image_url' => 'nullable|url',
        ]);

        $imagePath = $about->image_path;

        if ($request->hasFile('about_image')) {
            // Delete old image if it is stored locally and is not the default template image
            if ($about->image_path && !str_starts_with($about->image_path, 'http') && !str_starts_with($about->image_path, 'images/')) {
                Storage::disk('public')->delete($about->image_path);
            }
            // Store new image
            $imagePath = $request->file('about_image')->store('about', 'public');
        } elseif ($request->filled('about_image_url')) {
            $newUrl = $this->cleanImageUrl($request->about_image_url);
            if ($newUrl !== $about->image_path) {
                // Delete old image if stored locally
                if ($about->image_path && !str_starts_with($about->image_path, 'http') && !str_starts_with($about->image_path, 'images/')) {
                    Storage::disk('public')->delete($about->image_path);
                }
                $imagePath = $newUrl;
            }
        }

        $about->update([
            'image_path' => $imagePath,
            'image_scale' => $request->image_scale,
            'image_offset_x' => $request->image_offset_x,
            'image_offset_y' => $request->image_offset_y,
            'text_content' => $request->text_content,
        ]);

        return redirect()->route('cms.dashboard')->with('success', 'About section updated successfully!');
    }

    /**
     * Reset the About section content to default settings.
     */
    public function resetAbout()
    {
        $about = AboutContent::firstOrCreate([]);

        // Delete custom image if stored locally
        if ($about->image_path && !str_starts_with($about->image_path, 'http') && !str_starts_with($about->image_path, 'images/')) {
            Storage::disk('public')->delete($about->image_path);
        }

        $about->update([
            'image_path' => 'images/IMG_4171 2.png',
            'image_scale' => 1.0,
            'image_offset_x' => 0,
            'image_offset_y' => 0,
            'text_content' => '<p>This is <strong>Elian Benjamin</strong>, or Yan, or [yanillust].</p>' .
                             '<p>I am a <strong>Digital Artist</strong> in the Philippines mainly specializing in <strong>2D stylized Japanese style illustrations</strong>.</p>' .
                             '<p>I\'ve been on the art industry for <strong>6 years</strong>, polishing my techniques in capturing the anime aesthetic by working as a commission artist for a multitude of individuals.</p>' .
                             '<p>While I embrace modern technology to build, optimize, and assist with the technical layout of this portfolio website, rest assured: all of my artworks and illustrations are, and will always be, <strong>100% human-made</strong>.</p>'
        ]);

        return redirect()->route('cms.dashboard')->with('success', 'About section reset to default successfully!');
    }

    /**
     * Update the maintenance settings.
     */
    public function updateSettings(Request $request)
    {
        Setting::set('maintenance_illustration', $request->has('maintenance_illustration') ? '1' : '0');
        Setting::set('maintenance_comic', $request->has('maintenance_comic') ? '1' : '0');
        Setting::set('maintenance_concept', $request->has('maintenance_concept') ? '1' : '0');

        return redirect()->route('cms.dashboard')->with('success', 'Settings updated successfully!');
    }

    /**
     * Clean Google Drive links and other remote image URLs.
     */
    private function cleanImageUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        $url = trim($url);

        // Convert standard drive share links to direct cookie-less CDN links
        if (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://lh3.googleusercontent.com/d/' . $matches[1];
        }
        if (preg_match('/drive\.google\.com\/open\?id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://lh3.googleusercontent.com/d/' . $matches[1];
        }
        if (preg_match('/docs\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://lh3.googleusercontent.com/d/' . $matches[1];
        }

        return $url;
    }

    /**
     * Update the specified commission tier in storage.
     */
    public function updateCommission(Request $request, $id)
    {
        $tier = CommissionTier::findOrFail($id);

        $request->validate([
            'price' => 'required|integer|min:0',
            'delivery_time' => 'required|string|max:255',
            'resolution' => 'required|string|max:255',
            'dpi' => 'required|integer|min:1',
            'tools' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|url',
        ]);

        $imagePath = $tier->image_path;

        if ($request->hasFile('image')) {
            // Delete old image if it is stored locally
            if ($tier->image_path && !str_starts_with($tier->image_path, 'http')) {
                Storage::disk('public')->delete($tier->image_path);
            }
            // Store new image
            $imagePath = $request->file('image')->store('commissions', 'public');
        } elseif ($request->filled('image_url')) {
            $newUrl = $this->cleanImageUrl($request->image_url);
            if ($newUrl !== $tier->image_path) {
                // Delete old image if it was stored locally
                if ($tier->image_path && !str_starts_with($tier->image_path, 'http')) {
                    Storage::disk('public')->delete($tier->image_path);
                }
                $imagePath = $newUrl;
            }
        }

        $tier->update([
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'resolution' => $request->resolution,
            'dpi' => $request->dpi,
            'tools' => $request->tools,
            'image_path' => $imagePath,
            'feature_high_res' => $request->has('feature_high_res'),
            'feature_revisions' => $request->has('feature_revisions'),
            'feature_background' => $request->has('feature_background'),
            'feature_commercial' => $request->has('feature_commercial'),
            'feature_source_file' => $request->has('feature_source_file'),
            'feature_urgent' => $request->has('feature_urgent'),
        ]);

        return redirect()->route('cms.dashboard')->with('success', 'Commission tier updated successfully!');
    }

    public function updateCommissionSettings(Request $request)
    {
        $request->validate([
            'multiplier_detailed_bg' => 'required|integer|min:0',
            'multiplier_source_file' => 'required|integer|min:0',
            'multiplier_urgent' => 'required|integer|min:0',
            'multiplier_commercial' => 'required|integer|min:0',
            'multiplier_additional_character' => 'required|integer|min:0',
            'multiplier_with_graphic' => 'required|integer|min:0',
            'price_char_sheet_sketch' => 'required|integer|min:0',
            'price_char_sheet_flat_color' => 'required|integer|min:0',
            'price_char_sheet_fully_rendered' => 'required|integer|min:0',
            'price_nsfw' => 'required|integer|min:0',
        ]);

        Setting::set('commission_multiplier_detailed_bg', $request->multiplier_detailed_bg);
        Setting::set('commission_multiplier_source_file', $request->multiplier_source_file);
        Setting::set('commission_multiplier_urgent', $request->multiplier_urgent);
        Setting::set('commission_multiplier_commercial', $request->multiplier_commercial);
        Setting::set('commission_multiplier_additional_character', $request->multiplier_additional_character);
        Setting::set('commission_multiplier_with_graphic', $request->multiplier_with_graphic);
        Setting::set('commission_price_char_sheet_sketch', $request->price_char_sheet_sketch);
        Setting::set('commission_price_char_sheet_flat_color', $request->price_char_sheet_flat_color);
        Setting::set('commission_price_char_sheet_fully_rendered', $request->price_char_sheet_fully_rendered);
        Setting::set('commission_price_nsfw', $request->price_nsfw);

        return redirect()->route('cms.dashboard')->with('success', 'Commission multipliers and base rates updated successfully!');
    }

    /**
     * Update available slots inline for all commission tiers.
     */
    public function updateCommissionSlots(Request $request)
    {
        $request->validate([
            'slots' => 'required|array',
            'slots.*' => 'required|integer|min:0',
        ]);

        foreach ($request->slots as $id => $slots) {
            CommissionTier::where('id', $id)->update(['slots_available' => $slots]);
        }

        return redirect()->route('cms.dashboard')->with('success', 'Slot availabilities updated successfully!');
    }

    /**
     * Update a social link URL and name.
     */
    public function updateSocialLink(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        $link = SocialLink::findOrFail($id);
        $link->update([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
        ]);

        return redirect()->route('cms.dashboard')->with('success', 'Social link updated successfully!');
    }

    /**
     * Reorder the social links sort_order.
     */
    public function reorderSocialLinks(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:social_links,id',
        ]);

        $order = $request->input('order');

        foreach ($order as $position => $id) {
            SocialLink::where('id', $id)->update(['sort_order' => $position]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Social links reordered successfully.'
        ]);
    }
}
