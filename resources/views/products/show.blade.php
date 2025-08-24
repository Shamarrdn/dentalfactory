@extends('layouts.dental')

@section('title', $product->name . ' - مصنع منتجات الأسنان')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/customer/products-show.css') }}?t={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer/products.css') }}?t={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer/frequently-bought-together.css') }}?t={{ time() }}">

    <style>
        .quantity-discounts {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .quantity-discounts h5 {
            margin-bottom: 15px;
            color: #2d3748;
            font-weight: 600;
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
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .thumbnail-wrapper.active {
            border-color: #22543d;
            box-shadow: 0 4px 8px rgba(34, 84, 61, 0.2);
        }
        .thumbnail-wrapper:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .color-preview {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
        }

        /* Important Links Styles - Clean & Professional */
        .useful-links-section {
            animation: fadeInUp 0.5s ease-out;
        }
        
        .useful-links-section .link-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #17a2b8 !important;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(23, 162, 184, 0.1);
        }
        
        .useful-links-section .link-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(23, 162, 184, 0.2) !important;
            border-color: #138496 !important;
        }
        
        .useful-links-section .link-card .stretched-link:hover {
            text-decoration: none !important;
            color: #138496 !important;
        }
        
        .useful-links-section .link-icon {
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .useful-links-section .link-card:hover .link-icon {
            transform: scale(1.1);
            color: #138496 !important;
        }
        
        .useful-links-section .link-title {
            line-height: 1.4;
        }
        
        .useful-links-section .link-description {
            line-height: 1.5;
            max-height: 3.6em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        
        .useful-links-section .card-header {
            background: #f8f9fa !important;
            border-bottom: 2px solid #17a2b8;
        }
        
        .transition-all {
            transition: all 0.3s ease;
        }
        
        .hover-shadow:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        /* Subtle Info Alert */
        .alert-info {
            background-color: #e8f4f8;
            border-color: #bee5eb;
            color: #0c5460;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Enhanced Product Info Styles - Elegant Colors */
        .product-title {
            font-size: 1.8rem;
            line-height: 1.4;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .product-meta .badge {
            font-weight: 400;
            font-size: 0.85rem;
            border-radius: 8px;
            background: #f0f8ff;
            color: #2c5aa0;
            border: 1px solid #d1e7ff;
        }
        
        .product-meta .badge.border-success {
            background: #f0fff4;
            color: #22543d;
            border: 1px solid #c6f6d5;
        }
        
        /* Price Container - Elegant */
        .price-container .card {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
            background: linear-gradient(135deg, #fafcff 0%, #f7fafc 100%);
        }
        
        .tax-details {
            background: #ffffff;
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .final-price {
            background: linear-gradient(135deg, #e6fffa 0%, #f0fff4 100%);
            color: #22543d;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #c6f6d5;
        }
        
        .final-price span {
            color: #22543d !important;
            font-weight: 700;
        }
        
        /* Tax Info Alert - Elegant */
        .alert-info {
            background: linear-gradient(135deg, #f0f8ff 0%, #f7fafc 100%);
            border: 1px solid #d1e7ff;
            border-radius: 8px;
            color: #2c5aa0;
        }
        
        /* Horizontal Quantity Selector Styles */
        .quantity-controls {
            width: fit-content;
            margin: 0;
            padding: 0;
            background: transparent;
            border-radius: 0;
            box-shadow: none;
        }
        
        .quantity-controls .section-title {
            margin-right: 15px;
            color: #2d3748;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        /* Section Titles Enhancement */
        .section-title {
            color: #2d3748 !important;
            font-weight: 600 !important;
        }
        
        .section-title i {
            color: #4299e1 !important;
        }
        
        /* Stock Badge Enhancement */
        .stock-badge.in-stock {
            background: linear-gradient(135deg, #e6fffa 0%, #f0fff4 100%) !important;
            color: #22543d !important;
            border: 1px solid #c6f6d5 !important;
        }
        
        .stock-badge.out-of-stock {
            background: linear-gradient(135deg, #fed7e2 0%, #fbb6ce 100%) !important;
            color: #c53030 !important;
            border: 1px solid #feb2b2 !important;
        }
        
        .btn-quantity-horizontal {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #cbd5e0;
            color: #4a5568;
            width: 60px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(74, 85, 104, 0.1);
        }
        
        .btn-quantity-horizontal:hover {
            background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%);
            color: #2d3748;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 85, 104, 0.15);
            border-color: #a0aec0;
        }
        
        .btn-quantity-horizontal:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(74, 85, 104, 0.2);
        }
        
        .quantity-display {
            background: linear-gradient(135deg, #ffffff 0%, #fafcff 100%);
            border: 2px solid #cbd5e0;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(74, 85, 104, 0.1);
            padding: 6px;
        }
        
        .quantity-input-horizontal {
            border: none !important;
            width: 100px !important;
            height: 45px !important;
            font-size: 1.6rem !important;
            font-weight: 800 !important;
            color: #000000 !important;
            background: transparent !important;
            text-align: center !important;
            line-height: 1 !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .quantity-input-horizontal:focus {
            box-shadow: none !important;
            border: none !important;
            background: transparent !important;
            color: #000000 !important;
            outline: none !important;
        }
        
        .quantity-input-horizontal:disabled {
            background: transparent !important;
            color: #000000 !important;
            opacity: 1 !important;
        }
        
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .quantity-input[type=number] {
            -moz-appearance: textfield;
        }
        
        /* Force visibility */
        #productQuantity {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            color: #000000 !important;
            background-color: #ffffff !important;
            text-align: center !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .product-title {
                font-size: 1.8rem;
            }
            
            .final-price span {
                font-size: 1.3rem !important;
            }
            
            .quantity-controls {
                width: fit-content;
                padding: 0;
                gap: 12px !important;
                margin: 0;
            }
            
            .quantity-controls .section-title {
                margin-right: 10px;
                font-size: 1rem;
            }
            
            .btn-quantity-horizontal {
                width: 50px;
                height: 40px;
                font-size: 1rem;
            }
            
            .quantity-input-horizontal {
                width: 80px !important;
                height: 40px !important;
                font-size: 1.4rem !important;
                font-weight: 800 !important;
                color: #000000 !important;
            }
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
                    <div class="product-header mb-4">
                        <h1 class="product-title mb-3 fw-bold text-dark">{{ $product->name }}</h1>
                        
                        <div class="product-meta d-flex flex-wrap gap-2 align-items-center mb-3">
                            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-decoration-none">
                                <span class="badge rounded-pill bg-light text-dark border px-3 py-2">
                                    <i class="fas fa-tag me-1 text-muted"></i>
                                    {{ $product->category->name }}
                                </span>
                            </a>
                            
                            @if($product->categories->isNotEmpty())
                                @foreach($product->categories as $additionalCategory)
                                    @if($additionalCategory->id != $product->category_id)
                                        <a href="{{ route('products.index', ['category' => $additionalCategory->slug]) }}" class="text-decoration-none">
                                            <span class="badge rounded-pill bg-light text-dark border px-3 py-2">
                                                <i class="fas fa-bookmark me-1 text-muted"></i>
                                                {{ $additionalCategory->name }}
                                            </span>
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                            
                            @if($product->hasTax())
                                <span class="badge rounded-pill bg-light text-success border border-success px-3 py-2">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    منتج مدفوع الضريبة
                                </span>
                            @endif
                        </div>
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
                    <div class="price-container mb-4">
                        <div class="card border-0 bg-light p-3">
                            @if($product->hasTax())
                                <!-- Tax Details Section -->
                                <div class="tax-details mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">السعر الأساسي:</span>
                                        <span class="fw-bold">
                                            @if($product->min_price == $product->max_price)
                                                {{ number_format($product->min_price, 2) }} ر.س
                                            @else
                                                {{ number_format($product->min_price, 2) }} - {{ number_format($product->max_price, 2) }} ر.س
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">
                                            <i class="fas fa-plus-circle me-1 text-info"></i>
                                            ضريبة القيمة المضافة ({{ $product->tax_display }}):
                                        </span>
                                        <span class="text-info fw-bold">
                                            @if($product->tax_type === 'percentage')
                                                + {{ number_format($product->calculateTaxAmount($product->min_price), 2) }} ر.س
                                            @else
                                                + {{ $product->tax_value }} ر.س
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <hr class="my-2">
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fs-5 fw-bold text-success">
                                            <i class="fas fa-tag me-1"></i>
                                            السعر النهائي (شامل الضريبة):
                                        </span>
                                        <div class="final-price">
                                            <span class="fs-4 fw-bold text-success">
                                                @if($product->min_price == $product->max_price)
                                                    {{ number_format($product->getPriceWithTax($product->min_price), 2) }}
                                                @else
                                                    {{ number_format($product->getPriceWithTax($product->min_price), 2) }} - {{ number_format($product->getPriceWithTax($product->max_price), 2) }}
                                                @endif
                                                <span class="fs-5">ر.س</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info py-2 mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <small><strong>هذا المنتج مدفوع الضريبة</strong> - السعر المعروض يشمل ضريبة القيمة المضافة</small>
                                </div>
                            @else
                                <!-- No Tax Product -->
                                <div class="product-price text-center">
                                    <div class="fs-4 fw-bold text-primary mb-2">
                                        @if($product->min_price == $product->max_price)
                                            {{ number_format($product->min_price, 2) }} <span class="fs-5">ر.س</span>
                                        @else
                                            {{ number_format($product->min_price, 2) }} - {{ number_format($product->max_price, 2) }} <span class="fs-5">ر.س</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        السعر لا يشمل ضريبة القيمة المضافة
                                    </small>
                                </div>
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
                        <div class="quantity-controls d-flex align-items-center gap-4">
                            <h5 class="section-title mb-0">
                                <i class="fas fa-cubes me-2 text-muted"></i>
                                الكمية
                            </h5>
                            <button class="btn btn-quantity-horizontal btn-decrease" type="button" id="decreaseQuantity">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="quantity-display">
                                <input type="number" class="form-control quantity-input-horizontal text-center" id="productQuantity" value="1" min="1">
                            </div>
                            <button class="btn btn-quantity-horizontal btn-increase" type="button" id="increaseQuantity">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Important Links Info -->
                    @if($product->links->count() > 0)
                        <div class="alert alert-info mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2 text-info"></i>
                                <div>
                                    <strong>معلومات إضافية:</strong>
                                    <span class="d-block small">تتوفر روابط مفيدة أدناه للحصول على معلومات تفصيلية</span>
                                </div>
                            </div>
                        </div>
                    @endif

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

        <!-- Important Links Section (Priority - Appears First) -->
        @if($product->links->count() > 0)
            <div class="useful-links-section mt-5">
                <div class="container">
                    <div class="card shadow-sm border-info">
                        <div class="card-header bg-light text-dark border-bottom">
                            <h4 class="mb-0">
                                <i class="fas fa-link me-2 text-info"></i>
                                <strong>روابط مهمة</strong>
                            </h4>
                            <div class="mt-2">
                                <div class="alert alert-info mb-0 py-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>للاستفادة الكاملة:</strong> يمكنك مراجعة هذه الروابط للحصول على معلومات إضافية مفيدة حول المنتج
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                @foreach($product->links as $link)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="link-card h-100 p-3 border rounded-3 bg-white hover-shadow transition-all border-info">
                                            <div class="d-flex align-items-start">
                                                <div class="link-icon me-3 mt-1">
                                                    <i class="fas fa-external-link-alt text-info"></i>
                                                </div>
                                                <div class="link-content flex-grow-1">
                                                    <h6 class="link-title mb-2">
                                                        <a href="{{ $link->formatted_url }}" 
                                                           target="_blank" 
                                                           rel="noopener noreferrer"
                                                           class="text-decoration-none text-info fw-bold stretched-link">
                                                            {{ $link->caption }}
                                                        </a>
                                                    </h6>
                                                    @if($link->description)
                                                        <p class="link-description text-muted mb-0 small">
                                                            {{ $link->description }}
                                                        </p>
                                                    @endif
                                                    <small class="text-muted d-block mt-2">
                                                        <i class="fas fa-external-link-alt me-1"></i>
                                                        يفتح في نافذة جديدة
                                                    </small>
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
        @endif

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

