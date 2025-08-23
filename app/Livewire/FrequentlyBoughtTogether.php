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
    public $relatedProducts = [];
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
        $this->relatedProducts = $this->product
            ->frequentlyBoughtTogether()
            ->with(['images', 'sizes'])
            ->where('is_available', true)
            ->get()
            ->map(function ($relatedProduct) {
                return [
                    'id' => $relatedProduct->id,
                    'name' => $relatedProduct->name,
                    'price' => $relatedProduct->min_price ?? 0,
                    'max_price' => $relatedProduct->max_price ?? 0,
                    'image_url' => $relatedProduct->image_url,
                    'selected' => true, // Default to selected
                ];
            })->toArray();
    }

    public function calculateMainProductPrice()
    {
        $this->mainProductPrice = $this->product->min_price ?? 0;
    }

    public function toggleProduct($index)
    {
        $this->relatedProducts[$index]['selected'] = !$this->relatedProducts[$index]['selected'];
        $this->updateSelectedProducts();
    }

    public function updateSelectedProducts()
    {
        $this->selectedProducts = collect($this->relatedProducts)
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

    public function addAllToCart()
    {
        if (!Auth::check()) {
            $this->dispatch('show-login-prompt');
            return;
        }

        if (empty($this->selectedProducts)) {
            $this->dispatch('show-error', 'يرجى اختيار منتج واحد على الأقل');
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
                $this->dispatch('show-error', $mainResult['message']);
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
                $this->dispatch('show-success', "تم إضافة {$successCount} منتج إلى السلة بنجاح");
            }

            if (!empty($errorMessages)) {
                $this->dispatch('show-error', 'بعض المنتجات لم يتم إضافتها: ' . implode(', ', $errorMessages));
            }

        } catch (\Exception $e) {
            $this->dispatch('show-error', 'حدث خطأ أثناء إضافة المنتجات للسلة');
        }
    }

    public function render()
    {
        return view('livewire.frequently-bought-together');
    }
}