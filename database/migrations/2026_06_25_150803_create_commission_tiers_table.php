<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commission_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('render_quality'); // sketch, flat_color, fully_rendered
            $table->string('coverage_type'); // headshot, bust, full_body
            $table->integer('price');
            $table->string('delivery_time');
            $table->string('resolution');
            $table->integer('dpi');
            $table->string('tools');
            $table->string('image_path')->nullable();
            $table->boolean('feature_high_res')->default(true);
            $table->boolean('feature_revisions')->default(true);
            $table->boolean('feature_background')->default(false);
            $table->boolean('feature_commercial')->default(false);
            $table->boolean('feature_source_file')->default(false);
            $table->boolean('feature_urgent')->default(false);
            $table->timestamps();
        });

        // Seed default 9 tiers
        $tiers = [
            // Sketch
            [
                'render_quality' => 'sketch',
                'coverage_type' => 'headshot',
                'price' => 20,
                'delivery_time' => '1 Week',
                'resolution' => '3000 x 4000 px',
                'dpi' => 300,
                'tools' => 'Clip Studio Paint',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => false,
                'feature_commercial' => false,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'render_quality' => 'sketch',
                'coverage_type' => 'bust',
                'price' => 35,
                'delivery_time' => '1 Week',
                'resolution' => '3000 x 4000 px',
                'dpi' => 300,
                'tools' => 'Clip Studio Paint',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => false,
                'feature_commercial' => false,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'render_quality' => 'sketch',
                'coverage_type' => 'full_body',
                'price' => 60,
                'delivery_time' => '1-2 Weeks',
                'resolution' => '3000 x 4000 px',
                'dpi' => 300,
                'tools' => 'Clip Studio Paint',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => false,
                'feature_commercial' => false,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Flat Color
            [
                'render_quality' => 'flat_color',
                'coverage_type' => 'headshot',
                'price' => 30,
                'delivery_time' => '1-2 Weeks',
                'resolution' => '3000 x 4000 px',
                'dpi' => 300,
                'tools' => 'Clip Studio Paint',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => false,
                'feature_commercial' => false,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'render_quality' => 'flat_color',
                'coverage_type' => 'bust',
                'price' => 50,
                'delivery_time' => '1-2 Weeks',
                'resolution' => '3000 x 4000 px',
                'dpi' => 300,
                'tools' => 'Clip Studio Paint',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => false,
                'feature_commercial' => false,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'render_quality' => 'flat_color',
                'coverage_type' => 'full_body',
                'price' => 95,
                'delivery_time' => '1-2 Weeks',
                'resolution' => '3000 x 4000 px',
                'dpi' => 300,
                'tools' => 'Clip Studio Paint, Photoshop',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => false,
                'feature_commercial' => false,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Fully Rendered
            [
                'render_quality' => 'fully_rendered',
                'coverage_type' => 'headshot',
                'price' => 45,
                'delivery_time' => '2-3 Weeks',
                'resolution' => '4000 x 6000 px',
                'dpi' => 350,
                'tools' => 'Clip Studio Paint, Photoshop',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => true,
                'feature_commercial' => true,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'render_quality' => 'fully_rendered',
                'coverage_type' => 'bust',
                'price' => 80,
                'delivery_time' => '2-3 Weeks',
                'resolution' => '4000 x 6000 px',
                'dpi' => 350,
                'tools' => 'Clip Studio Paint, Photoshop',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => true,
                'feature_commercial' => true,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'render_quality' => 'fully_rendered',
                'coverage_type' => 'full_body',
                'price' => 150,
                'delivery_time' => '2-3 Weeks',
                'resolution' => '4000 x 6000 px',
                'dpi' => 350,
                'tools' => 'Clip Studio Paint, Photoshop',
                'feature_high_res' => true,
                'feature_revisions' => true,
                'feature_background' => true,
                'feature_commercial' => true,
                'feature_source_file' => false,
                'feature_urgent' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('commission_tiers')->insert($tiers);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_tiers');
    }
};
