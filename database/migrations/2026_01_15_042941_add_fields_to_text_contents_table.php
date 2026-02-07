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
        Schema::table('text_contents', function (Blueprint $table) {
            $table->string('type')->default('text')->after('sort_order'); // text, text_image
            $table->string('image')->nullable()->after('type');
            $table->string('image_position')->nullable()->after('image'); // left, right, top, bottom
            $table->text('footer')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('text_contents', function (Blueprint $table) {
            $table->dropColumn(['type', 'image', 'image_position', 'footer']);
        });
    }
};
