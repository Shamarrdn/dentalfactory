<div>
    @if($this->hasAnyRelatedProducts())
        <!-- Frequently Bought Together Section -->
        @if(count($frequentlyBoughtProducts) > 0)
            <div class="frequently-bought-together mt-5">
                <div class="card shadow-sm">
                    <div class="card-header" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
                        <h4 class="mb-0">
                            <i class="fas fa-shopping-bag me-2"></i>
                            المنتجات التي يتم شراؤها مع بعض غالباً
                        </h4>
                    </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <!-- Desktop Layout for Main Product -->
                        <div class="d-none d-md-block col-md-6 col-lg-4">
                            <div class="product-card main-product">
                                <div class="product-image position-relative">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded w-100" style="height: 200px; object-fit: cover;">
                                    <div class="product-badge position-absolute top-0 start-0 m-2">
                                        <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">المنتج الأساسي</span>
                                    </div>
                                </div>
                                <div class="product-info mt-3">
                                    <h6 class="product-title">{{ $product->name }}</h6>
                                    <div class="product-price">
                                        <span class="price-amount">{{ number_format($mainProductPrice, 2) }}</span>
                                        <span class="currency">ر.س</span>
                                        @if($product->hasTax())
                                            <small class="text-muted d-block">شامل الضريبة</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Layout for Main Product -->
                        <div class="d-md-none col-12 mb-3">
                            <div class="main-product-mobile text-center bg-light p-3 rounded">
                                <h6 class="mb-2">المنتج الأساسي: <strong>{{ $product->name }}</strong></h6>
                                <div class="text-primary fw-bold">
                                    {{ number_format($mainProductPrice, 2) }} ر.س
                                    @if($product->hasTax())
                                        <small class="text-muted d-block">شامل الضريبة</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Plus Icon (Desktop Only) -->
                        <div class="d-none d-md-flex col-md-12 col-lg-1 align-items-center justify-content-center">
                            <div class="plus-icon">
                                <i class="fas fa-plus text-primary fs-3"></i>
                            </div>
                        </div>

                        <!-- Related Products -->
                        <div class="col-md-6 col-lg-7">
                            <div class="related-products-container">
                                <!-- Desktop Layout -->
                                <div class="d-none d-md-block">
                                    @foreach($frequentlyBoughtProducts as $index => $relatedProduct)
                                        <div class="related-product-item mb-3" wire:key="frequently-{{ $index }}">
                                            <div class="form-check d-flex align-items-center">
                                                <input 
                                                    class="form-check-input me-3" 
                                                    type="checkbox" 
                                                    id="frequently-product-{{ $index }}"
                                                    wire:model.live="frequentlyBoughtProducts.{{ $index }}.selected"
                                                    wire:click="toggleProduct('frequently_bought_together', {{ $index }})"
                                                >
                                                <label class="form-check-label flex-grow-1" for="frequently-product-{{ $index }}">
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
                                
                                <!-- Mobile Horizontal Layout -->
                                <div class="d-md-none">
                                    <div class="mobile-frequently-products-scroll" style="overflow-x: auto; white-space: nowrap; padding: 10px 0;">
                                        <div class="d-flex gap-3" style="min-width: fit-content;">
                                            @foreach($frequentlyBoughtProducts as $index => $relatedProduct)
                                                <div class="frequently-product-card-mobile" wire:key="frequently-mobile-{{ $index }}" style="display: inline-block; white-space: normal; min-width: 180px; max-width: 180px;">
                                                    <div class="card h-100 border-0 shadow-sm">
                                                        <div class="position-relative">
                                                            <img src="{{ $relatedProduct['image_url'] }}" 
                                                                 alt="{{ $relatedProduct['name'] }}" 
                                                                 class="card-img-top" 
                                                                 style="height: 120px; object-fit: cover;">
                                                            <div class="position-absolute top-2 start-2">
                                                                <input 
                                                                    class="form-check-input" 
                                                                    type="checkbox" 
                                                                    id="frequently-product-mobile-{{ $index }}"
                                                                    wire:model.live="frequentlyBoughtProducts.{{ $index }}.selected"
                                                                    wire:click="toggleProduct('frequently_bought_together', {{ $index }})"
                                                                    style="transform: scale(1.2);"
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-3">
                                                            <h6 class="card-title mb-2" style="font-size: 0.85rem; line-height: 1.2;">{{ Str::limit($relatedProduct['name'], 40) }}</h6>
                                                            <div class="product-price">
                                                                @if($relatedProduct['price'] == $relatedProduct['max_price'])
                                                                    <span class="price-amount fw-bold text-primary" style="font-size: 0.9rem;">{{ number_format($relatedProduct['price'], 2) }}</span>
                                                                @else
                                                                    <span class="price-amount fw-bold text-primary" style="font-size: 0.9rem;">{{ number_format($relatedProduct['price'], 2) }} - {{ number_format($relatedProduct['max_price'], 2) }}</span>
                                                                @endif
                                                                <span class="currency" style="font-size: 0.8rem;">ر.س</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
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
                                        @if($product->hasTax())
                                            <small class="text-success d-block">شامل الضريبة</small>
                                        @endif
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
        @endif

        <!-- Recommended Products Section -->
        @if(count($recommendedProducts) > 0)
            <div class="recommended-products mt-5">
                <div class="card shadow-sm">
                    <div class="card-header" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: #2d3748;">
                        <h4 class="mb-0">
                            <i class="fas fa-star me-2"></i>
                            منتجات مُوصى بها
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <!-- Desktop Layout for Main Product -->
                            <div class="d-none d-md-block col-md-6 col-lg-4">
                                <div class="product-card main-product">
                                    <div class="product-image position-relative">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded w-100" style="height: 200px; object-fit: cover;">
                                        <div class="product-badge position-absolute top-0 start-0 m-2">
                                            <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">المنتج الأساسي</span>
                                        </div>
                                    </div>
                                    <div class="product-info mt-3">
                                        <h6 class="product-title">{{ $product->name }}</h6>
                                        <div class="product-price">
                                            <span class="price-amount">{{ number_format($mainProductPrice, 2) }}</span>
                                            <span class="currency">ر.س</span>
                                            @if($product->hasTax())
                                                <small class="text-muted d-block">شامل الضريبة</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Layout for Main Product -->
                            <div class="d-md-none col-12 mb-3">
                                <div class="main-product-mobile text-center bg-light p-3 rounded">
                                    <h6 class="mb-2">المنتج الأساسي: <strong>{{ $product->name }}</strong></h6>
                                    <div class="text-success fw-bold">
                                        {{ number_format($mainProductPrice, 2) }} ر.س
                                        @if($product->hasTax())
                                            <small class="text-muted d-block">شامل الضريبة</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Plus Icon (Desktop Only) -->
                            <div class="d-none d-md-flex col-md-12 col-lg-1 align-items-center justify-content-center">
                                <div class="plus-icon">
                                    <i class="fas fa-plus text-success fs-3"></i>
                                </div>
                            </div>

                            <!-- Recommended Products -->
                            <div class="col-md-6 col-lg-7">
                                <div class="related-products-container">
                                    <!-- Desktop Layout -->
                                    <div class="d-none d-md-block">
                                        @foreach($recommendedProducts as $index => $relatedProduct)
                                            <div class="related-product-item mb-3" wire:key="recommended-{{ $index }}">
                                                <div class="form-check d-flex align-items-center">
                                                    <input 
                                                        class="form-check-input me-3" 
                                                        type="checkbox" 
                                                        id="recommended-product-{{ $index }}"
                                                        wire:model.live="recommendedProducts.{{ $index }}.selected"
                                                        wire:click="toggleProduct('recommended', {{ $index }})"
                                                    >
                                                    <label class="form-check-label flex-grow-1" for="recommended-product-{{ $index }}">
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
                                    
                                    <!-- Mobile Horizontal Layout -->
                                    <div class="d-md-none">
                                        <div class="mobile-recommended-products-scroll" style="overflow-x: auto; white-space: nowrap; padding: 10px 0;">
                                            <div class="d-flex gap-3" style="min-width: fit-content;">
                                                @foreach($recommendedProducts as $index => $relatedProduct)
                                                    <div class="recommended-product-card-mobile" wire:key="recommended-mobile-{{ $index }}" style="display: inline-block; white-space: normal; min-width: 180px; max-width: 180px;">
                                                        <div class="card h-100 border-0 shadow-sm">
                                                            <div class="position-relative">
                                                                <img src="{{ $relatedProduct['image_url'] }}" 
                                                                     alt="{{ $relatedProduct['name'] }}" 
                                                                     class="card-img-top" 
                                                                     style="height: 120px; object-fit: cover;">
                                                                <div class="position-absolute top-2 start-2">
                                                                    <input 
                                                                        class="form-check-input" 
                                                                        type="checkbox" 
                                                                        id="recommended-product-mobile-{{ $index }}"
                                                                        wire:model.live="recommendedProducts.{{ $index }}.selected"
                                                                        wire:click="toggleProduct('recommended', {{ $index }})"
                                                                        style="transform: scale(1.2);"
                                                                    >
                                                                </div>
                                                            </div>
                                                            <div class="card-body p-3">
                                                                <h6 class="card-title mb-2" style="font-size: 0.85rem; line-height: 1.2;">{{ Str::limit($relatedProduct['name'], 40) }}</h6>
                                                                <div class="product-price">
                                                                    @if($relatedProduct['price'] == $relatedProduct['max_price'])
                                                                        <span class="price-amount fw-bold text-success" style="font-size: 0.9rem;">{{ number_format($relatedProduct['price'], 2) }}</span>
                                                                    @else
                                                                        <span class="price-amount fw-bold text-success" style="font-size: 0.9rem;">{{ number_format($relatedProduct['price'], 2) }} - {{ number_format($relatedProduct['max_price'], 2) }}</span>
                                                                    @endif
                                                                    <span class="currency" style="font-size: 0.8rem;">ر.س</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
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
                                            <span class="total-amount fs-4 fw-bold text-success">{{ number_format($totalPrice, 2) }}</span>
                                            <span class="currency">ر.س</span>
                                            @if($product->hasTax())
                                                <small class="text-success d-block">شامل الضريبة</small>
                                            @endif
                                        </div>
                                        <small class="text-muted">
                                            ({{ count($selectedProducts) + 1 }} منتج محدد)
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @auth
                                        <button 
                                            class="btn btn-success btn-lg w-100"
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
                                            class="btn btn-success btn-lg w-100"
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

        <!-- Similar Products Section -->
        @if(count($similarProducts) > 0)
            <div class="similar-products mt-5">
                <div class="card shadow-sm">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <h4 class="mb-0">
                            <i class="fas fa-layer-group me-2"></i>
                            منتجات مشابهة
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <!-- Desktop Layout for Main Product -->
                            <div class="d-none d-md-block col-md-6 col-lg-4">
                                <div class="product-card main-product">
                                    <div class="product-image position-relative">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded w-100" style="height: 200px; object-fit: cover;">
                                        <div class="product-badge position-absolute top-0 start-0 m-2">
                                            <span class="badge bg-info">المنتج الأساسي</span>
                                        </div>
                                    </div>
                                    <div class="product-info mt-3">
                                        <h6 class="product-title">{{ $product->name }}</h6>
                                        <div class="product-price">
                                            <span class="price-amount">{{ number_format($mainProductPrice, 2) }}</span>
                                            <span class="currency">ر.س</span>
                                            @if($product->hasTax())
                                                <small class="text-muted d-block">شامل الضريبة</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Layout for Main Product -->
                            <div class="d-md-none col-12 mb-3">
                                <div class="main-product-mobile text-center bg-light p-3 rounded">
                                    <h6 class="mb-2">المنتج الأساسي: <strong>{{ $product->name }}</strong></h6>
                                    <div class="text-success fw-bold">
                                        {{ number_format($mainProductPrice, 2) }} ر.س
                                        @if($product->hasTax())
                                            <small class="text-muted d-block">شامل الضريبة</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Plus Icon (Desktop Only) -->
                            <div class="d-none d-md-flex col-md-12 col-lg-1 align-items-center justify-content-center">
                                <div class="plus-icon">
                                    <i class="fas fa-plus text-info fs-3"></i>
                                </div>
                            </div>

                            <!-- Similar Products -->
                            <div class="col-md-6 col-lg-7">
                                <div class="related-products-container">
                                    <!-- Desktop Layout -->
                                    <div class="d-none d-md-block">
                                        @foreach($similarProducts as $index => $relatedProduct)
                                            <div class="related-product-item mb-3" wire:key="similar-{{ $index }}">
                                                <div class="form-check d-flex align-items-center">
                                                    <input 
                                                        class="form-check-input me-3" 
                                                        type="checkbox" 
                                                        id="similar-product-{{ $index }}"
                                                        wire:model.live="similarProducts.{{ $index }}.selected"
                                                        wire:click="toggleProduct('similar', {{ $index }})"
                                                    >
                                                    <label class="form-check-label flex-grow-1" for="similar-product-{{ $index }}">
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
                                    
                                    <!-- Mobile Horizontal Layout -->
                                    <div class="d-md-none">
                                        <div class="mobile-similar-products-scroll" style="overflow-x: auto; white-space: nowrap; padding: 10px 0;">
                                            <div class="d-flex gap-3" style="min-width: fit-content;">
                                                @foreach($similarProducts as $index => $relatedProduct)
                                                    <div class="similar-product-card-mobile" wire:key="similar-mobile-{{ $index }}" style="display: inline-block; white-space: normal; min-width: 180px; max-width: 180px;">
                                                        <div class="card h-100 border-0 shadow-sm">
                                                            <div class="position-relative">
                                                                <img src="{{ $relatedProduct['image_url'] }}" 
                                                                     alt="{{ $relatedProduct['name'] }}" 
                                                                     class="card-img-top" 
                                                                     style="height: 120px; object-fit: cover;">
                                                                <div class="position-absolute top-2 start-2">
                                                                    <input 
                                                                        class="form-check-input" 
                                                                        type="checkbox" 
                                                                        id="similar-product-mobile-{{ $index }}"
                                                                        wire:model.live="similarProducts.{{ $index }}.selected"
                                                                        wire:click="toggleProduct('similar', {{ $index }})"
                                                                        style="transform: scale(1.2);"
                                                                    >
                                                                </div>
                                                            </div>
                                                            <div class="card-body p-3">
                                                                <h6 class="card-title mb-2" style="font-size: 0.85rem; line-height: 1.2;">{{ Str::limit($relatedProduct['name'], 40) }}</h6>
                                                                <div class="product-price">
                                                                    @if($relatedProduct['price'] == $relatedProduct['max_price'])
                                                                        <span class="price-amount fw-bold text-success" style="font-size: 0.9rem;">{{ number_format($relatedProduct['price'], 2) }}</span>
                                                                    @else
                                                                        <span class="price-amount fw-bold text-success" style="font-size: 0.9rem;">{{ number_format($relatedProduct['price'], 2) }} - {{ number_format($relatedProduct['max_price'], 2) }}</span>
                                                                    @endif
                                                                    <span class="currency" style="font-size: 0.8rem;">ر.س</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
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
                                            <span class="total-amount fs-4 fw-bold text-info">{{ number_format($totalPrice, 2) }}</span>
                                            <span class="currency">ر.س</span>
                                            @if($product->hasTax())
                                                <small class="text-info d-block">شامل الضريبة</small>
                                            @endif
                                        </div>
                                        <small class="text-muted">
                                            ({{ count($selectedProducts) + 1 }} منتج محدد)
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @auth
                                        <button 
                                            class="btn btn-info btn-lg w-100"
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
                                            class="btn btn-info btn-lg w-100"
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
    @else
        <div class="no-related-products mt-5">
            <div class="card shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="fas fa-info-circle text-muted fa-2x mb-3"></i>
                    <h5 class="text-muted">لا توجد منتجات مترابطة حالياً</h5>
                    <p class="text-muted mb-0">سيتم إضافة منتجات مترابطة مع هذا المنتج قريباً</p>

                </div>
            </div>
        </div>
    @endif

    <!-- Mobile Styles -->
    <style>
    .mobile-frequently-products-scroll, 
    .mobile-similar-products-scroll, 
    .mobile-recommended-products-scroll {
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: #ccc #f0f0f0;
    }
    
    .mobile-frequently-products-scroll::-webkit-scrollbar, 
    .mobile-similar-products-scroll::-webkit-scrollbar, 
    .mobile-recommended-products-scroll::-webkit-scrollbar {
        height: 4px;
    }
    
    .mobile-frequently-products-scroll::-webkit-scrollbar-track, 
    .mobile-similar-products-scroll::-webkit-scrollbar-track, 
    .mobile-recommended-products-scroll::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 2px;
    }
    
    .mobile-frequently-products-scroll::-webkit-scrollbar-thumb, 
    .mobile-similar-products-scroll::-webkit-scrollbar-thumb, 
    .mobile-recommended-products-scroll::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 2px;
    }
    
    .frequently-product-card-mobile .card, 
    .similar-product-card-mobile .card, 
    .recommended-product-card-mobile .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .frequently-product-card-mobile .card:hover, 
    .similar-product-card-mobile .card:hover, 
    .recommended-product-card-mobile .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    }
    </style>
</div>