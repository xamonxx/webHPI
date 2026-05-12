<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $this->addIndexIfMissing($table, 'portfolios', ['is_active', 'display_order'], 'idx_portfolios_active_order');
            $this->addIndexIfMissing($table, 'portfolios', ['is_active', 'is_featured', 'display_order'], 'idx_portfolios_active_featured');
            $this->addIndexIfMissing($table, 'portfolios', ['is_active', 'category'], 'idx_portfolios_active_category');
        });

        Schema::table('services', function (Blueprint $table) {
            $this->addIndexIfMissing($table, 'services', ['is_active', 'display_order'], 'idx_services_active_order');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $this->addIndexIfMissing($table, 'testimonials', ['is_active', 'display_order'], 'idx_testimonials_active_order');
        });

        Schema::table('statistics', function (Blueprint $table) {
            $this->addIndexIfMissing($table, 'statistics', ['is_active', 'display_order'], 'idx_statistics_active_order');
        });

        Schema::table('contact_submissions', function (Blueprint $table) {
            $this->addIndexIfMissing($table, 'contact_submissions', ['is_read', 'created_at'], 'idx_contact_submissions_read_created');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $this->addIndexIfMissing($table, 'site_settings', ['setting_group'], 'idx_site_settings_group');
        });

        Schema::table('hero_sections', function (Blueprint $table) {
            $this->addIndexIfMissing($table, 'hero_sections', ['is_active'], 'idx_hero_sections_active');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'portfolios', 'idx_portfolios_active_order');
            $this->dropIndexIfExists($table, 'portfolios', 'idx_portfolios_active_featured');
            $this->dropIndexIfExists($table, 'portfolios', 'idx_portfolios_active_category');
        });

        Schema::table('services', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'services', 'idx_services_active_order');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'testimonials', 'idx_testimonials_active_order');
        });

        Schema::table('statistics', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'statistics', 'idx_statistics_active_order');
        });

        Schema::table('contact_submissions', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'contact_submissions', 'idx_contact_submissions_read_created');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'site_settings', 'idx_site_settings_group');
        });

        Schema::table('hero_sections', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'hero_sections', 'idx_hero_sections_active');
        });
    }

    private function addIndexIfMissing(Blueprint $table, string $tableName, array $columns, string $indexName): void
    {
        if (! $this->indexExists($tableName, $indexName)) {
            $table->index($columns, $indexName);
        }
    }

    private function dropIndexIfExists(Blueprint $table, string $tableName, string $indexName): void
    {
        if ($this->indexExists($tableName, $indexName)) {
            $table->dropIndex($indexName);
        }
    }

    private function indexExists(string $tableName, string $indexName): bool
    {
        return collect(Schema::getIndexes($tableName))
            ->contains(fn (array $index) => ($index['name'] ?? null) === $indexName);
    }
};
