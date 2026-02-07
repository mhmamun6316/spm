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
        Schema::table('products', function (Blueprint $table) {
            // Rename name to title
            $table->renameColumn('name', 'title');
            
            // Drop unnecessary columns
            $table->dropColumn(['price', 'quantity', 'description']);
            
            // Add new description fields
            $table->text('short_desc')->nullable()->after('product_category_id');
            $table->text('long_desc')->nullable()->after('short_desc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Reverse: rename title back to name
            $table->renameColumn('title', 'name');
            
            // Restore dropped columns
            $table->decimal('price', 10, 2)->after('title');
            $table->integer('quantity')->default(0)->after('price');
            $table->text('description')->nullable()->after('quantity');
            
            // Drop new description fields
            $table->dropColumn(['short_desc', 'long_desc']);
        });
    }
};
