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
        if (! Schema::hasTable('hero_sections') || Schema::hasColumn('hero_sections', 'title_highlight')) {
            return;
        }

        Schema::table('hero_sections', function (Blueprint $table) {
            $table->text('title_highlight')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('hero_sections') || ! Schema::hasColumn('hero_sections', 'title_highlight')) {
            return;
        }

        Schema::table('hero_sections', function (Blueprint $table) {
            $table->dropColumn('title_highlight');
        });
    }
};
