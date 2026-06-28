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
        DB::table('portfolio_items')
            ->where('type', 'regular')
            ->update(['type' => 'original']);

        DB::table('portfolio_items')
            ->where('type', 'chibi')
            ->update(['type' => 'fanart']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('portfolio_items')
            ->where('type', 'original')
            ->update(['type' => 'regular']);

        DB::table('portfolio_items')
            ->where('type', 'fanart')
            ->update(['type' => 'chibi']);
    }
};
