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
        if (! Schema::hasColumn('site_settings', 'business_types_slides')) {
            Schema::table('site_settings', function (Blueprint $table): void {
                $table->json('business_types_slides')->nullable()->after('favicon_path');
            });
        }

        if (Schema::hasColumn('site_settings', 'business_types_image_path')) {
            Schema::table('site_settings', function (Blueprint $table): void {
                $table->dropColumn('business_types_image_path');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('site_settings', 'business_types_slides')) {
            Schema::table('site_settings', function (Blueprint $table): void {
                $table->dropColumn('business_types_slides');
            });
        }
    }
};
