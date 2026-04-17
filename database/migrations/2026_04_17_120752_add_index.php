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
        Schema::table('blogs', static function (Blueprint $table): void {
            $table->unique(['resource_id', 'external_id']);
        });

        Schema::table('posts', static function (Blueprint $table): void {
            $table->unique(['blog_id', 'external_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', static function (Blueprint $table): void {
            $table->dropIndex('blogs_resource_id_external_id_unique');
        });

        Schema::table('posts', static function (Blueprint $table): void {
            $table->dropIndex('posts_blog_id_external_id_unique');
        });
    }
};
