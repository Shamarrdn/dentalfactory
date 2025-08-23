@extends('layouts.dental')

@section('title', $product->name . ' - مصنع منتجات الأسنان')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/customer/products-show.css') }}?t={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer/products.css') }}?t={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer/frequently-bought-together.css') }}?t={{ time() }}">

    <style>
        .quantity-discounts {
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 16px;
            background-color: #f9f9f9;
        }
        .quantity-discounts h5 {
            margin-bottom: 15px;
            color: #333;
        }
        .quantity-discounts table {
            border-radius: 4px;
            overflow: hidden;
        }
        .quantity-discounts th, .quantity-discounts td {
            text-align: center;
            vertical-align: middle;
        }
        .quantity-discounts .badge {
            font-size: 0.9rem;
            padding: 5px 8px;
        }
        .table-success {
            background-color: rgba(25, 135, 84, 0.1) !important;
        }
        .thumbnail-wrapper {
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 4px;
            overflow: hidden;
            transition: all 0.2s ease;
        }
        .thumbnail-wrapper.active {
            border-color: #198754;
        }
        .color-preview {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <!-- Fixed Buttons Group -->
    <div class="fixed-buttons-group">
        <button class="fixed-cart-btn" id="fixedCartBtn">
            <i class="fas fa-shopping-cart fa-lg"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">
                0
            </span>
        </button>
        @auth
        <a href="/dashboard" class="fixed-dashboard-btn">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
        </a>
        @endauth
    </div>

    <!-- Cart Overlay -->
    <div class="cart-overlay"></div>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>سلة التسوق</h3>
            <button class="close-cart" id="closeCart">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="cart-items" id="cartItems">
            <!-- Cart items will be dynamically added here -->
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>الإجمالي:</span>
                <span id="cartTotal">0 ر.س</span>
            </div>
            <a href="{{ route('checkout.index') }}" class="checkout-btn">
                <i class="fas fa-shopping-cart ml-2"></i>
                إتمام الشراء
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5" style="margin-top: 60px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="/products">المنتجات</a></li>
                <li class="breadcrumb-item"><a href="/products?category={{ $product->category->slug }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Product Images -->
            <div class="col-md-6">
                <div class="product-gallery card">
                    <div class="card-body">
                        @if($product->images->count() > 0)
                            <div class="main-image-wrapper mb-3">
                                <img src="{{ url('storage/' . $product->primary_image->image_path) }}"
                                    alt="{{ $product->name }}"
                                    class="main-product-image"
                                    id="mainImage">
                            </div>
                            @if($product->images->count() > 1)
                                <div class="image-thumbnails">
                                    @foreach($product->images as $image)
                                        <div class="thumbnail-wrapper {{ $image->is_primary ? 'active' : '' }}"
                                            onclick="updateMainImage('{{ url('storage/' . $image->image_path) }}', this)">
                                            <img src="{{ url('storage/' . $image->image_path) }}"
                                                alt="Product thumbnail"
                                                class="thumbnail-image">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="no-image-placeholder">
                                <i class="fas fa-image"></i>
                                <p>لا توجد صور متاحة</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1 class="product-title">{{ $product->name }}</h1>

                    <div class="product-category d-flex flex-wrap gap-1 align-items-center mb-3">
                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-decoration-none">
                            <span class="badge rounded-pill bg-primary">{{ $product->category->name }}</span>
                        </a>
                        @if($product->categories->isNotEmpty())
                            @foreach($product->categories as $additionalCategory)
                                @if($additionalCategory->id != $product->category_id)
                                    <a href="{{ route('products.index', ['category' => $additionalCategory->slug]) }}" class="text-decoration-none">
                                        <span class="badge rounded-pill bg-light text-dark border">{{ $additionalCategory->name }}</span>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <!-- Available Coupons Section -->
                    @php
                        $availableCoupons = $product->getAvailableCoupons();
                    @endphp

                    @if($availableCoupons->isNotEmpty())
                        <div class="available-coupons mb-4">
                            <h5><i class="fas fa-tags"></i> كوبونات خصم متاحة</h5>
                            <div class="coupon-list">
                                @foreach($availableCoupons as $coupon)
                                    <div class="coupon-item">
                                        <div class="coupon-content">
                                            <div class="coupon-code">{{ $coupon->code }}</div>
                                            <div class="coupon-value">
                                                @if($coupon->type === 'percentage')
                                                    <span class="badge">خصم {{ $coupon->value }}%</span>
                                                @else
                                                    <span class="badge">خصم {{ $coupon->value }} ر.س</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="copy-btn-wrapper">
                                            <button class="copy-btn" data-code="{{ $coupon->code }}">
                                                <i class="fas fa-copy"></i> نسخ
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <small>
                                <i class="fas fa-info-circle"></i>
                                يمكنك استخدام هذه الكوبونات عند إتمام الطلب
                            </small>
                        </div>
                    @endif

                    <!-- Quantity Discounts Section -->
                    @if(isset($quantityDiscounts) && $quantityDiscounts->isNotEmpty())
                        <div class="quantity-discounts mb-4">
                            <h5><i class="fas fa-percent"></i> خصومات الكميات</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>الكمية</th>
                                            <th>الخصم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quantityDiscounts as $discount)
                                            <tr>
                                                <td>
                                                    @if($discount->max_quantity)
                                                        {{ $discount->min_quantity }} - {{ $discount->max_quantity }}
                                                    @else
                                                        {{ $discount->min_quantity }}+
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($discount->type === 'percentage')
                                                        <span class="badge bg-success">{{ $discount->value }}%</span>
                                                    @else
                                                        <span class="badge bg-success">{{ $discount->value }} ر.س</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <small>
                                <i class="fas fa-info-circle"></i>
                                يتم تطبيق خصم الكمية تلقائياً عند إضافة الكمية المطلوبة للسلة
                            </small>
                        </div>
                    @endif

                    <!-- Product Price -->
                    <div class="price-container">
                        <div class="product-price">
                            @if($product->min_price == $product->max_price)
                                <span class="amount">{{ number_format($product->min_price, 2) }}</span>
                                <span class="currency">ر.س</span>
                            @else
                                <span class="amount">{{ number_format($product->min_price, 2) }} - {{ number_format($product->max_price, 2) }}</span>
                                <span class="currency">ر.س</span>
                            @endif
                        </div>
                    </div>

                    <div class="stock-info mb-4">
                        <span class="stock-badge {{ $product->is_available ? 'in-stock' : 'out-of-stock' }}">
                            <i class="fas {{ $product->is_available ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                            {{ $product->is_available ? 'متوفر' : 'غير متوفر' }}
                        </span>
                    </div>

                    <div class="product-description mb-4">
                        <h5 class="section-title">

                            وصف المنتج
                        </h5>
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Product Details Section -->
                    @if($product->details && count($product->details) > 0)
                    <div class="product-details-section mb-4">
                        <h5 class="section-title">
                            <i class="fas fa-list-ul me-2"></i>
                            تفاصيل المنتج
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    @foreach($product->details as $key => $value)
                                    <tr>
                                        <th class="bg-light" style="width: 40%">{{ $key }}</th>
                                        <td>{{ $value }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif



                    <!-- Colors Section -->
                    @if($product->allow_color_selection && $product->colors->isNotEmpty())
                        <div class="colors-section mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-palette me-2"></i>
                                الألوان المتاحة
                            </h5>
                            <div class="colors-grid mb-3">
                                @foreach($product->colors as $color)
                                    <div class="color-item {{ $color->is_available ? 'available' : 'unavailable' }}"
                                        data-color="{{ $color->color }}"
                                        onclick="selectColor(this)">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="color-preview" style="background-color: {{ $color->color }};"></span>
                                            <span class="color-name">{{ $color->color }}</span>
                                        </div>
                                        <span class="color-status">
                                            @if($color->is_available)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Custom Color Input -->
                    @if($product->allow_custom_color)
                        <div class="custom-color-section mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-palette me-2"></i>
                                اللون المطلوب
                            </h5>
                            <div class="input-group">
                                <input type="text" class="form-control" id="customColor" placeholder="اكتب اللون المطلوب">
                            </div>
                        </div>
                    @endif

                    <!-- Available Sizes Section -->
                    @if($product->allow_size_selection && $product->sizes->isNotEmpty())
                        <div class="available-sizes mb-4">
                            <h5 class="fw-bold mb-3">المقاسات المتاحة</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->sizes as $size)
                                    @if($size->is_available)
                                    <button type="button"
                                        class="size-option btn"
                                        data-size="{{ $size->size }}"
                                        data-price="{{ $size->price }}"
                                        onclick="selectSize(this)">
                                        {{ $size->size }}
                                        @if($size->price != null)
                                            <span class="ms-2 badge bg-primary">{{ number_format($size->price, 2) }} ر.س</span>
                                        @endif
                                    </button>
                                    @else
                                    <button type="button" class="size-option btn disabled">
                                        {{ $size->size }} (غير متوفر)
                                    </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Custom Size Input -->
                    @if($product->allow_custom_size)
                        <div class="custom-size-input mb-4">
                            <h5 class="section-title">
                                <i class="fas fa-ruler me-2"></i>
                                المقاس المطلوب
                            </h5>
                            <div class="input-group">
                                <input type="text" class="form-control" id="customSize" placeholder="اكتب المقاس المطلوب">
                            </div>
                        </div>
                    @endif

                    <!-- Quantity Selector -->
                    <div class="quantity-selector mb-4">
                        <h5 class="section-title">
                            <i class="fas fa-cubes me-2"></i>
                            الكمية
                        </h5>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="decreaseQuantity">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="form-control text-center" id="productQuantity" value="1" min="1">
                            <button class="btn btn-outline-secondary" type="button" id="increaseQuantity">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    @auth
                    <!-- Add to Cart Button -->
                    <button class="btn btn-primary btn-lg w-100 mb-4" onclick="addToCart()">
                        <i class="fas fa-shopping-cart me-2"></i>
                        أضف إلى السلة
                    </button>
                    @else
                        <!-- Login to Order Button -->
                        <button class="btn btn-primary btn-lg w-100 mb-4"
                                onclick="showLoginPrompt('{{ route('login') }}')"
                                type="button">
                            <i class="fas fa-shopping-cart me-2"></i>
                            تسجيل الدخول للطلب
                        </button>
                    @endauth

                    <!-- Error Messages -->
                    <div class="alert alert-danger d-none" id="errorMessage"></div>

                </div>
            </div>
        </div>

        <!-- Frequently Bought Together Section -->
        @livewire('frequently-bought-together', ['product' => $product])
    </div>

    <!-- Footer -->


    <!-- Login Prompt Modal -->
    <div class="modal fade" id="loginPromptModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تسجيل الدخول مطلوب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-user-lock fa-3x mb-3 text-primary"></i>
                    <p>يجب عليك تسجيل الدخول أولاً لتتمكن من طلب المنتج</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>
                        إلغاء
                    </button>
                    <a href="" class="btn btn-primary" id="loginButton">
                        تسجيل الدخول
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this hidden input for product ID -->
    <input type="hidden" id="product-id" value="{{ $product->id }}">

    <!-- Add this hidden input for original product price -->
    <input type="hidden" id="original-price" value="{{ $product->price }}">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/customer/products-show.js') }}?t={{ time() }}"></script>
    <script src="{{ asset('assets/js/customer/green-theme.js') }}?t={{ time() }}"></script>
    
    <script>
        // Livewire event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for Livewire events
            Livewire.on('show-success', message => {
                alert('✅ ' + message);
                updateCartDisplay(); // Update cart count if function exists
            });
            
            Livewire.on('show-error', message => {
                alert('❌ ' + message);
            });
            
            Livewire.on('show-login-prompt', () => {
                showLoginPrompt('{{ route('login') }}');
            });
            
            Livewire.on('cart-updated', () => {
                // Refresh cart if needed
                if (typeof updateCartDisplay === 'function') {
                    updateCartDisplay();
                }
            });
        });
    </script>
@endsection

