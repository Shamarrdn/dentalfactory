<div>
    @if(count($relatedProducts) > 0)
        <div class="frequently-bought-together mt-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-shopping-bag me-2"></i>
                        المنتجات التي يتم شراؤها مع بعض غالباً
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <!-- Main Product -->
                        <div class="col-md-6 col-lg-4">
                            <div class="product-card main-product">
                                <div class="product-image">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded">
                                    <div class="product-badge">
                                        <span class="badge bg-success">المنتج الأساسي</span>
                                    </div>
                                </div>
                                <div class="product-info mt-3">
                                    <h6 class="product-title">{{ $product->name }}</h6>
                                    <div class="product-price">
                                        <span class="price-amount">{{ number_format($mainProductPrice, 2) }}</span>
                                        <span class="currency">ر.س</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Plus Icon -->
                        <div class="col-12 col-md-12 col-lg-1 d-flex align-items-center justify-content-center">
                            <div class="plus-icon">
                                <i class="fas fa-plus text-primary fs-3"></i>
                            </div>
                        </div>

                        <!-- Related Products -->
                        <div class="col-md-6 col-lg-7">
                            <div class="related-products-container">
                                @foreach($relatedProducts as $index => $relatedProduct)
                                    <div class="related-product-item mb-3" wire:key="related-{{ $index }}">
                                        <div class="form-check d-flex align-items-center">
                                            <input 
                                                class="form-check-input me-3" 
                                                type="checkbox" 
                                                id="product-{{ $index }}"
                                                wire:model.live="relatedProducts.{{ $index }}.selected"
                                                wire:click="toggleProduct({{ $index }})"
                                            >
                                            <label class="form-check-label flex-grow-1" for="product-{{ $index }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="product-image-small me-3">
                                                        <img src="{{ $relatedProduct['image_url'] }}" 
                                                             alt="{{ $relatedProduct['name'] }}" 
                                                             class="img-fluid rounded" 
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    </div>
                                                    <div class="product-details flex-grow-1">
                                                        <h6 class="product-name mb-1">{{ $relatedProduct['name'] }}</h6>
                                                        <div class="product-price">
                                                            @if($relatedProduct['price'] == $relatedProduct['max_price'])
                                                                <span class="price-amount">{{ number_format($relatedProduct['price'], 2) }}</span>
                                                            @else
                                                                <span class="price-amount">{{ number_format($relatedProduct['price'], 2) }} - {{ number_format($relatedProduct['max_price'], 2) }}</span>
                                                            @endif
                                                            <span class="currency">ر.س</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Total and Add to Cart Section -->
                    <div class="total-section mt-4 pt-3 border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="total-info">
                                    <h5 class="mb-1">
                                        <i class="fas fa-calculator me-2"></i>
                                        الإجمالي:
                                    </h5>
                                    <div class="total-price">
                                        <span class="total-amount fs-4 fw-bold text-primary">{{ number_format($totalPrice, 2) }}</span>
                                        <span class="currency">ر.س</span>
                                    </div>
                                    <small class="text-muted">
                                        ({{ count($selectedProducts) + 1 }} منتج محدد)
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @auth
                                    <button 
                                        class="btn btn-primary btn-lg w-100"
                                        wire:click="addAllToCart"
                                        wire:loading.attr="disabled"
                                        wire:target="addAllToCart"
                                        {{ count($selectedProducts) == 0 ? 'disabled' : '' }}
                                    >
                                        <span wire:loading.remove wire:target="addAllToCart">
                                            <i class="fas fa-shopping-cart me-2"></i>
                                            أضف الكل للسلة
                                        </span>
                                        <span wire:loading wire:target="addAllToCart">
                                            <i class="fas fa-spinner fa-spin me-2"></i>
                                            جاري الإضافة...
                                        </span>
                                    </button>
                                @else
                                    <button 
                                        class="btn btn-primary btn-lg w-100"
                                        onclick="showLoginPrompt('{{ route('login') }}')"
                                    >
                                        <i class="fas fa-user-lock me-2"></i>
                                        تسجيل الدخول للشراء
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>