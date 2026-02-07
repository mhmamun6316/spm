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
        // Check if slug column already exists
        if (!Schema::hasColumn('products', 'slug')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('slug')->nullable();
            });
        }

        // Generate slugs for existing products that don't have one
        $products = \App\Models\Product::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($products as $product) {
            $product->slug = \Illuminate\Support\Str::slug($product->title);
            $product->save();
        }

        // Add unique index if not already present
        $indexes = \DB::select("SHOW INDEXES FROM products WHERE Key_name = 'products_slug_unique'");
        if (empty($indexes)) {
            Schema::table('products', function (Blueprint $table) {
                $table->unique('slug');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
