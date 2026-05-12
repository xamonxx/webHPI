<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('contact_submissions')
            ->whereNull('message')
            ->update(['message' => '']);

        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->text('message')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->text('message')->nullable()->change();
        });
    }
};
