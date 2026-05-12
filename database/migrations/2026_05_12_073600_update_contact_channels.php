<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        $now = now();
        $settings = [
            ['contact_email', 'cs@homeputrainterior.com', 'text', 'contact'],
            ['contact_phone', '+62 818-0993-9681', 'text', 'contact'],
            ['whatsapp_number', '6281809939681', 'text', 'contact'],
            ['contact_whatsapp', '6281809939681', 'text', 'contact'],
        ];

        foreach ($settings as [$key, $value, $type, $group]) {
            DB::table('site_settings')->updateOrInsert(
                ['setting_key' => $key],
                [
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'setting_group' => $group,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        DB::table('site_settings')
            ->whereIn('setting_key', [
                'contact_email',
                'contact_phone',
                'whatsapp_number',
                'contact_whatsapp',
            ])
            ->update(['updated_at' => now()]);
    }
};
