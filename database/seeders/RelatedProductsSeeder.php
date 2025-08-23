<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\RelatedProduct;

class RelatedProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample related products data
        $relatedProductsData = [
            // Dental tools that are frequently bought together
            [
                'main_product_name' => 'فرشاة أسنان', // Toothbrush
                'related_products' => [
                    'معجون أسنان', // Toothpaste
                    'خيط أسنان', // Dental floss
                    'غسول فم' // Mouthwash
                ],
                'type' => 'frequently_bought_together'
            ],
            [
                'main_product_name' => 'معجون أسنان', // Toothpaste
                'related_products' => [
                    'فرشاة أسنان', // Toothbrush
                    'غسول فم' // Mouthwash
                ],
                'type' => 'frequently_bought_together'
            ],
            [
                'main_product_name' => 'حشوة أسنان', // Dental filling
                'related_products' => [
                    'أدوات حشو', // Filling tools
                    'مخدر موضعي', // Local anesthetic
                    'مواد تجميل الأسنان' // Dental bonding materials
                ],
                'type' => 'frequently_bought_together'
            ],
            [
                'main_product_name' => 'تقويم أسنان', // Braces
                'related_products' => [
                    'واقي أسنان', // Mouth guard
                    'فرشاة تقويم', // Orthodontic brush
                    'منظف تقويم' // Orthodontic cleaner
                ],
                'type' => 'frequently_bought_together'
            ],
            [
                'main_product_name' => 'زراعة أسنان', // Dental implant
                'related_products' => [
                    'أدوات جراحة', // Surgical tools
                    'مواد زراعة', // Implant materials
                    'مضاد حيوي' // Antibiotics
                ],
                'type' => 'frequently_bought_together'
            ]
        ];

        foreach ($relatedProductsData as $data) {
            // Find the main product by name (partial match)
            $mainProduct = Product::where('name', 'like', '%' . $data['main_product_name'] . '%')->first();
            
            if ($mainProduct) {
                foreach ($data['related_products'] as $relatedProductName) {
                    // Find related product by name (partial match)
                    $relatedProduct = Product::where('name', 'like', '%' . $relatedProductName . '%')
                                            ->where('id', '!=', $mainProduct->id)
                                            ->first();
                    
                    if ($relatedProduct) {
                        // Check if relationship already exists
                        $existingRelation = RelatedProduct::where('product_id', $mainProduct->id)
                                                         ->where('related_product_id', $relatedProduct->id)
                                                         ->where('type', $data['type'])
                                                         ->first();
                        
                        if (!$existingRelation) {
                            RelatedProduct::create([
                                'product_id' => $mainProduct->id,
                                'related_product_id' => $relatedProduct->id,
                                'type' => $data['type']
                            ]);
                        }
                    }
                }
            }
        }

        // Create some general relationships for existing products
        $this->createGeneralRelationships();
    }

    /**
     * Create general relationships for existing products
     */
    private function createGeneralRelationships()
    {
        $products = Product::where('is_available', true)->take(10)->get();

        foreach ($products as $product) {
            // Get random related products from the same category
            $relatedProducts = Product::where('category_id', $product->category_id)
                                     ->where('id', '!=', $product->id)
                                     ->where('is_available', true)
                                     ->inRandomOrder()
                                     ->take(3)
                                     ->get();

            foreach ($relatedProducts as $relatedProduct) {
                // Check if relationship already exists
                $existingRelation = RelatedProduct::where('product_id', $product->id)
                                                 ->where('related_product_id', $relatedProduct->id)
                                                 ->where('type', 'frequently_bought_together')
                                                 ->first();

                if (!$existingRelation) {
                    RelatedProduct::create([
                        'product_id' => $product->id,
                        'related_product_id' => $relatedProduct->id,
                        'type' => 'frequently_bought_together'
                    ]);
                }
            }

            // Also create some recommended and similar product relationships
            $recommendedProducts = Product::where('category_id', '!=', $product->category_id)
                                         ->where('id', '!=', $product->id)
                                         ->where('is_available', true)
                                         ->inRandomOrder()
                                         ->take(2)
                                         ->get();

            foreach ($recommendedProducts as $recommendedProduct) {
                $existingRelation = RelatedProduct::where('product_id', $product->id)
                                                 ->where('related_product_id', $recommendedProduct->id)
                                                 ->where('type', 'recommended')
                                                 ->first();

                if (!$existingRelation) {
                    RelatedProduct::create([
                        'product_id' => $product->id,
                        'related_product_id' => $recommendedProduct->id,
                        'type' => 'recommended'
                    ]);
                }
            }
        }

        $this->command->info('Related products relationships created successfully!');
    }
}