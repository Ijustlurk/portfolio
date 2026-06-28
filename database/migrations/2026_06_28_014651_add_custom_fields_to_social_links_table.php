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
        Schema::table('social_links', function (Blueprint $table) {
            $table->boolean('is_visible')->default(true)->after('url');
            $table->string('bg_color')->nullable()->after('is_visible');
            $table->string('text_color')->nullable()->after('bg_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->dropColumn(['is_visible', 'bg_color', 'text_color']);
        });
    }
};
