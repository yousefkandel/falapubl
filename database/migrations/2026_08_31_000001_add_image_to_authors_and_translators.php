<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            if (!Schema::hasColumn('authors', 'image')) {
                $table->string('image')->nullable()->after('bio_en');
            }
        });

        Schema::table('translators', function (Blueprint $table) {
            if (!Schema::hasColumn('translators', 'image')) {
                $table->string('image')->nullable()->after('bio_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            if (Schema::hasColumn('authors', 'image')) {
                $table->dropColumn('image');
            }
        });

        Schema::table('translators', function (Blueprint $table) {
            if (Schema::hasColumn('translators', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
