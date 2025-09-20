<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Services\Customer\Products\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrequentlyBoughtTogether extends Component
{
    public $product;
    public $frequentlyBoughtProducts = [];
    public $recommendedProducts = [];
    public $similarProducts = [];
    public $selectedProducts = [];
    public $totalPrice = 0;
    public $mainProductPrice = 0;

    protected $cartService;

    public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->loadRelatedProducts();
        $this->calculateMainProductPrice();
        $this->updateSelectedProducts();
    }

    public function loadRelatedProducts()
    {
        // Load frequently bought together products
        $this->frequentlyBoughtProducts = $this->loadProductsByType('frequently_bought_together');
        
        // Load recommended products
        $this->recommendedProducts = $this->loadProductsByType('recommended');
        
        // Load similar products
        $this->similarProducts = $this->loadProductsByType('similar');
    }

    private function loadProductsByType($type)
    {
        return $this->product
            ->belongsToMany(Product::class, 'related_products', 'product_id', 'related_product_id')
            ->wherePivot('type', $type)
            ->with(['images', 'sizes'])
            ->where('is_available', true)
            ->get()
            ->map(function ($relatedProduct) use ($type) {
                $baseMinPrice = $relatedProduct->min_price ?? 0;
                $baseMaxPrice = $relatedProduct->max_price ?? 0;
                
                // إضافة الضريبة إلى الأسعار إذا كانت موجودة
                $minPriceWithTax = $relatedProduct->hasTax() ? $relatedProduct->getPriceWithTax($baseMinPrice) : $baseMinPrice;
                $maxPriceWithTax = $relatedProduct->hasTax() ? $relatedProduct->getPriceWithTax($baseMaxPrice) : $baseMaxPrice;
                
                return [
                    'id' => $relatedProduct->id,
                    'name' => $relatedProduct->name,
                    'price' => $minPriceWithTax,
                    'max_price' => $maxPriceWithTax,
                    'image_url' => $relatedProduct->image_url,
                    'selected' => true, // Default to selected
                    'type' => $type,
                ];
            })->toArray();
    }

    public function calculateMainProductPrice()
    {
        $basePrice = $this->product->min_price ?? 0;
        // إضافة الضريبة إلى السعر الأساسي إذا كانت موجودة
        $this->mainProductPrice = $this->product->hasTax() ? $this->product->getPriceWithTax($basePrice) : $basePrice;
    }

    public function toggleProduct($type, $index)
    {
        if ($type === 'frequently_bought_together') {
            $this->frequentlyBoughtProducts[$index]['selected'] = !$this->frequentlyBoughtProducts[$index]['selected'];
        } elseif ($type === 'recommended') {
            $this->recommendedProducts[$index]['selected'] = !$this->recommendedProducts[$index]['selected'];
        } elseif ($type === 'similar') {
            $this->similarProducts[$index]['selected'] = !$this->similarProducts[$index]['selected'];
        }
        
        $this->updateSelectedProducts();
    }

    public function updateSelectedProducts()
    {
        $allProducts = collect()
            ->merge(collect($this->frequentlyBoughtProducts))
            ->merge(collect($this->recommendedProducts))
            ->merge(collect($this->similarProducts));
            
        $this->selectedProducts = $allProducts
            ->where('selected', true)
            ->values()
            ->toArray();

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $relatedTotal = collect($this->selectedProducts)->sum('price');
        $this->totalPrice = $this->mainProductPrice + $relatedTotal;
    }

    public function hasAnyRelatedProducts()
    {
        return count($this->frequentlyBoughtProducts) > 0 || 
               count($this->recommendedProducts) > 0 || 
               count($this->similarProducts) > 0;
    }

    public function addAllToCart()
    {
        if (!Auth::check()) {
            $this->dispatch('show-login-prompt');
            return;
        }

        if (empty($this->selectedProducts)) {
            // $this->dispatch('show-error', 'يرجى اختيار منتج واحد على الأقل'); // Disabled alert
            return;
        }

        try {
            $request = new Request();
            $request->setMethod('POST');

            // Add main product to cart
            $request->merge([
                'product_id' => $this->product->id,
                'quantity' => 1,
                'color' => null,
                'size' => null
            ]);

            $mainResult = $this->cartService->addToCart($request);

            if (!$mainResult['success']) {
                // $this->dispatch('show-error', $mainResult['message']); // Disabled alert
                return;
            }

            // Add selected related products to cart
            $successCount = 1; // Main product already added
            $errorMessages = [];

            foreach ($this->selectedProducts as $selectedProduct) {
                $request->merge([
                    'product_id' => $selectedProduct['id'],
                    'quantity' => 1,
                    'color' => null,
                    'size' => null
                ]);

                $result = $this->cartService->addToCart($request);

                if ($result['success']) {
                    $successCount++;
                } else {
                    $errorMessages[] = $selectedProduct['name'] . ': ' . $result['message'];
                }
            }

            if ($successCount > 1) {
                $this->dispatch('cart-updated');
                // $this->dispatch('show-success', "تم إضافة {$successCount} منتج إلى السلة بنجاح"); // Disabled alert
            }

            if (!empty($errorMessages)) {
                // $this->dispatch('show-error', 'بعض المنتجات لم يتم إضافتها: ' . implode(', ', $errorMessages)); // Disabled alert
            }

        } catch (\Exception $e) {
            // $this->dispatch('show-error', 'حدث خطأ أثناء إضافة المنتجات للسلة'); // Disabled alert
        }
    }

    public function render()
    {
        return view('livewire.frequently-bought-together');
    }
}