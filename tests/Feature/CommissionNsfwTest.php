<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommissionNsfwTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_see_default_nsfw_pricing_on_commission_page()
    {
        $response = $this->get(route('commission'));
        
        $response->assertStatus(200);
        // Verify the setting is passed down in the multipliers object in JS
        $response->assertSee('"nsfw":50', false);
        $response->assertSee('id="toggle-nsfw"', false);
    }

    public function test_admin_can_update_nsfw_pricing_setting()
    {
        $admin = User::factory()->create();

        // Initially NSFW flat rate is default 50
        $this->assertEquals('50', Setting::get('commission_price_nsfw', '50'));

        $response = $this->actingAs($admin)->post(route('cms.commissions.settings.update'), [
            'multiplier_detailed_bg' => '50',
            'multiplier_source_file' => '20',
            'multiplier_urgent' => '30',
            'multiplier_commercial' => '30',
            'multiplier_additional_character' => '70',
            'multiplier_with_graphic' => '20',
            'price_char_sheet_sketch' => '80',
            'price_char_sheet_flat_color' => '140',
            'price_char_sheet_fully_rendered' => '220',
            'price_nsfw' => '75', // New NSFW flat price
        ]);

        $response->assertRedirect(route('cms.dashboard'));
        $this->assertEquals('75', Setting::get('commission_price_nsfw'));

        // Visit the commission page and check if it reflects the new setting
        $response = $this->get(route('commission'));
        $response->assertSee('"nsfw":75', false);
    }
}
