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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('seo_title')->nullable()->after('copyright_name');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->text('seo_keywords')->nullable()->after('seo_description');
            $table->string('seo_locality')->nullable()->after('seo_keywords');
            $table->string('seo_region')->nullable()->after('seo_locality');
            $table->string('seo_focus_keyword')->nullable()->after('seo_region');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'seo_title',
                'seo_description',
                'seo_keywords',
                'seo_locality',
                'seo_region',
                'seo_focus_keyword',
            ]);
        });
    }
};
