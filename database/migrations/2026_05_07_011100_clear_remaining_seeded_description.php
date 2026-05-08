<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('site_settings')) {
            return;
        }

        DB::table('site_settings')
            ->where('setting_key', 'site_description')
            ->where('setting_value', 'like', 'Kami menciptakan ruang hangat dan mewah%')
            ->update(['setting_value' => '']);
    }

    public function down(): void
    {
        // No rollback. Seeded copy should not be restored automatically.
    }
};
