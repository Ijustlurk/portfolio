<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('social_links')->insert([
            ['name' => 'VGen', 'url' => 'https://vgen.co/yanillust', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Instagram', 'url' => 'https://instagram.com/yanillust', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Twitter', 'url' => 'https://twitter.com/yanillust', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TikTok', 'url' => 'https://tiktok.com/@yanillust', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Facebook', 'url' => 'https://facebook.com/yanillust', 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Commission Calculator', 'url' => '/commission', 'sort_order' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};
