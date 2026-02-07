<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$products = DB::table('products')->get();

foreach ($products as $product) {
    $slug = Str::slug($product->name);
    if (empty($slug)) {
        $slug = 'product-' . $product->id;
    }
    
    // Check if slug exists
    $existingCount = DB::table('products')
        ->where('slug', $slug)
        ->where('id', '!=', $product->id)
        ->count();
    
    if ($existingCount > 0) {
        $slug = $slug . '-' . $product->id;
    }
    
    DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
    echo "Updated product {$product->id}: {$product->name} -> {$slug}\n";
}

echo "\nAll products updated successfully!\n";
