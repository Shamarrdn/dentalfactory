<?php
require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Get product with links
$product = App\Models\Product::where('slug', 'frshah')->with('links')->first();

if ($product) {
    echo "المنتج: " . $product->name . "\n";
    echo "عدد الروابط: " . $product->links->count() . "\n";
    
    if ($product->links->count() > 0) {
        echo "الروابط:\n";
        foreach ($product->links as $link) {
            echo "- " . $link->caption . ": " . $link->url . "\n";
            echo "  الوصف: " . ($link->description ?? 'بدون وصف') . "\n";
        }
    } else {
        echo "لا توجد روابط مضافة للمنتج\n";
    }
} else {
    echo "المنتج غير موجود\n";
}
?>
