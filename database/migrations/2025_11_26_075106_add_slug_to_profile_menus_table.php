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
        Schema::table('profile_menus', function (Blueprint $table) {
            if (! Schema::hasColumn('profile_menus', 'slug')) {
                $table->string('slug')->after('title');
            }
        });

        // Add unique constraint separately
        Schema::table('profile_menus', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_menus', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
