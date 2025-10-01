@extends('layouts.dental')

@section('title', 'مصنع جينودينت - الصفحة الرئيسية')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/index.css') }}?t={{ time() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<style>
    /* إصلاح مظهر القائمة المنسدلة - إزالة الخلفية الخضراء والمثلثات */
    .custom-select option {
        background: #ffffff !important;
        color: #333333 !important;
        border: none !important;
        background-image: none !important;
        padding: 8px 15px !important;
    }

    .custom-select option:hover,
    .custom-select option:focus,
    .custom-select option:active {
        background: #f8f9fa !important;
        color: #333333 !important;
        background-image: none !important;
    }

    .custom-select option:checked {
        background: #e9ecef !important;
        color: #333333 !important;
        background-image: none !important;
    }

    /* إزالة أي أنماط إضافية */
    select.custom-select option,
    select option {
        background: #ffffff !important;
        color: #333 !important;
        background-image: none !important;
        background-repeat: no-repeat !important;
        background-size: 0 !important;
    }
</style>
@endsection

@section('content')

<!-- Toast Notifications -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    @if(session('success'))
    <div class="toast show border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white border-0">
            <i class="fas fa-check-circle me-2"></i>
            <strong class="me-auto">نجح الإرسال</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle text-success me-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="toast show border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white border-0">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong class="me-auto">خطأ في الإرسال</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle text-danger me-2"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    </div>
    @endif
</div>

<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <h1 class="hero-bg-title mb-4">جينودينت - مواد طب الأسنان المتطورة</h1>
        <p class="hero-bg-desc mb-4">
            مصنع سعودي متخصص في إنتاج مواد طب الأسنان بجودة عالية وأسعار تنافسية، يقع في منطقة عسير ويخدم السوق المحلي والإقليمي.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#order" class="hero-bg-btn main-btn">اطلب الآن</a>
            <a href="#services" class="hero-bg-btn ghost-btn">استكشف المنتجات</a>
        </div>
    </div>
</section>

<section class="features-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">مميزاتنا</span>
            <h2 class="gradient-text">لماذا تختار منتجاتنا؟</h2>
            <p>نقدم أفضل المنتجات بأعلى معايير الجودة العالمية</p>
        </div>
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="feature-box floating-card">
                    <img src="https://img.icons8.com/ios-filled/50/26e07f/dental-crown.png" alt="Crown"/>
                    <h5 class="mt-3">جودة عالمية</h5>
                    <p>منتجات مصنعة وفق أعلى معايير الجودة</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box floating-card">
                    <i class="fas fa-procedures fa-3x" style="color: #26e07f;"></i>
                    <h5 class="mt-3">تقنيات متطورة</h5>
                    <p>نستخدم أحدث التقنيات في التصنيع</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box floating-card">
                    <i class="fas fa-tooth fa-3x" style="color: #26e07f;"></i>
                    <h5 class="mt-3">تنوع المنتجات</h5>
                    <p>مجموعة واسعة من منتجات طب الأسنان</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box floating-card">
                    <img src="https://img.icons8.com/ios-filled/50/26e07f/doctor-male.png" alt="Doctor"/>
                    <h5 class="mt-3">خبراء متخصصون</h5>
                    <p>فريق من الخبراء في صناعة منتجات الأسنان</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="discounted-products-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">منتجات عليها خصم</span>
            <h2 class="gradient-text">عروض المنتجات</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($discountedProducts as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="product-card-modern text-center">
                        <img src="{{ $product->image_url }}" class="img-fluid mb-3" alt="{{ $product->name }}" style="max-height:220px;object-fit:contain;">
                        <h4 class="mb-2">{{ $product->name }}</h4>
                        @php
                            $coupon = $product->discounts->firstWhere('is_active', 1);
                            $discount = $coupon ? $coupon->discount_percentage : null;
                            $price = $product->base_price;
                            $discountedPrice = $discount ? round($price * (1 - $discount/100), 2) : $price;
                        @endphp
                        @if($discount)
                            <p>
                                <span class="text-muted text-decoration-line-through">{{ number_format($price, 2) }} ريال</span>
                                <span class="text-success fw-bold ms-2">{{ number_format($discountedPrice, 2) }} ريال</span>
                                <span class="badge bg-success ms-2">خصم {{ $discount }}%</span>
                            </p>
                        @else
                            <p class="fw-bold">{{ number_format($price, 2) }} ريال</p>
                        @endif
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-modern mt-2">
                            شراء الآن <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">لا توجد منتجات عليها خصم حالياً</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="emergency-section py-4" style="background: var(--primary-gradient);">
    <div class="container text-center text-white">
        <h5>هل تحتاج مساعدة في اختيار المنتجات؟</h5>
        <p class="mb-0">اتصل بنا: <strong>+1 234 567 890</strong> أو عبر البريد الإلكتروني <strong>sales@dentalproducts.com</strong></p>
    </div>
</section>

<section id="about" class="about-section py-5">
    <div class="container">
        <div class="about-wrapper position-relative">
            <div class="about-blob-1"></div>
            <div class="about-blob-2"></div>
            <div class="about-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">من نحن</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">نبذة عن مصنعنا</h2>
                <div class="title-separator"><div class="separator-line"></div><div class="separator-icon"><i class="fas fa-tooth"></i></div><div class="separator-line"></div></div>
            </div>

            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="about-image-container">
                        <div class="about-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&w=600&q=80" alt="Dental Factory" class="about-image">
                            <div class="image-card-1" data-aos="fade-left" data-aos-delay="300">
                                <div class="card-icon"><i class="fas fa-award"></i></div>
                                <div class="card-content">
                                    <h5>جودة عالمية</h5>
                                    <p>معتمدة من هيئات الجودة العالمية</p>
                                </div>
                            </div>
                            <div class="image-card-2" data-aos="fade-up" data-aos-delay="400">
                                <div class="card-icon"><i class="fas fa-flask"></i></div>
                                <div class="card-content">
                                    <h5>تقنيات متطورة</h5>
                                    <p>بأحدث التقنيات العالمية</p>
                                </div>
                            </div>
                            <div class="about-image-shape"></div>
                        </div>
                        <div class="experience-badge">
                            <div class="badge-content">
                                <span class="badge-number">25</span>
                                <span class="badge-text">سنوات<br>الخبرة</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content" data-aos="fade-up">
                        <h3 class="about-subtitle">جينودينت - الشريك الرائد في منطقة عسير</h3>
                        <p class="about-description">مصنع سعودي متخصص في إنتاج مواد طب الأسنان الأساسية، نوفر تشكيلة واسعة تشمل الترميم المباشر وغير المباشر، ومنتجات الوقاية، المختبر، والانطباعات الرقمية. نسعى لتحقيق الاكتفاء الذاتي ودعم رؤية السعودية 2030.</p>

                        <div class="stats-grid">
                            <div class="stat-card" data-aos="zoom-in" data-aos-delay="100">
                                <div class="stat-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="stat-number"><span class="counter">25</span>+</div>
                                <div class="stat-title">سنوات الخبرة</div>
                            </div>
                            <div class="stat-card" data-aos="zoom-in" data-aos-delay="200">
                                <div class="stat-icon">
                                    <i class="fas fa-cubes"></i>
                                </div>
                                <div class="stat-number"><span class="counter">150</span>+</div>
                                <div class="stat-title">منتج مختلف</div>
                            </div>
                            <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                                <div class="stat-icon">
                                    <i class="fas fa-globe-asia"></i>
                                </div>
                                <div class="stat-number"><span class="counter">45</span>+</div>
                                <div class="stat-title">دولة نصدر لها</div>
                            </div>
                            <div class="stat-card" data-aos="zoom-in" data-aos-delay="400">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-number"><span class="counter">500</span>+</div>
                                <div class="stat-title">عميل راضٍ</div>
                            </div>
                        </div>

                        <div class="about-cta">
                            <a href="about.html" class="btn-about-more">
                                <span>اقرأ المزيد عنا</span>
                                <i class="fas fa-long-arrow-alt-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section id="services" class="products-section py-5">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">منتجاتنا</span>
            <h2 class="gradient-text">منتجاتنا الرئيسية</h2>
            <p>مجموعة متكاملة من منتجات طب الأسنان عالية الجودة</p>
        </div>

        <div class="products-wrapper position-relative">
            <div class="blob-shape"></div>
            <div class="blob-shape-2"></div>

            <!-- Products Carousel -->
            <div>
                <div class="products-carousel owl-carousel owl-theme">
                    @foreach($featuredProducts as $product)
                    <div class="item">
                        <div class="product-card-modern">
                            <div class="product-icon-wrapper">
                                <div class="product-icon-bg"></div>
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-icon">
                            </div>
                            <div class="product-content">
                                <h3 >{{ $product->name }}</h3>
                                <p class="mb-3 text-black">{{ $product->description }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="btn-modern">
                                    <span>شراء الآن</span>
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End Products Carousel -->
        </div>
    </div>
</section>

<section id="order" class="order-section py-5">
    <div class="container">
        <div class="order-wrapper position-relative">
            <!-- Decorative elements -->
            <div class="order-blob"></div>
            <div class="order-shape"></div>
            <div class="order-dots"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">طلب المنتجات</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">اطلب منتجاتنا</h2>
                <div class="title-separator"><div class="separator-line"></div><div class="separator-icon"><i class="fas fa-paper-plane"></i></div><div class="separator-line"></div></div>
                <p class="section-subtitle">املأ النموذج وسيتواصل معك فريق المبيعات قريباً</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="order-card" data-aos="fade-up">
                        <div class="order-card-shape"></div>
                        <div class="order-form-container">
                            <form method="POST" action="{{ route('home-form.submit') }}" class="order-form">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control custom-input @error('companyName') is-invalid @enderror"
                                                   id="companyName" name="companyName" value="{{ old('companyName') }}" required>
                                            <label for="companyName" class="form-label">اسم الشركة/العيادة</label>
                                            <div class="input-icon">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            @error('companyName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group floating-label">
                                            <input type="email" class="form-control custom-input @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email') }}" required>
                                            <label for="email" class="form-label">البريد الإلكتروني</label>
                                            <div class="input-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group floating-label">
                                            <input type="tel" class="form-control custom-input @error('phone') is-invalid @enderror"
                                                   id="phone" name="phone" value="{{ old('phone') }}" required>
                                            <label for="phone" class="form-label">رقم الهاتف</label>
                                            <div class="input-icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </div>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group floating-label">
                                            <select class="form-control custom-input custom-select @error('productCategory') is-invalid @enderror"
                                                    id="productCategory" name="productCategory" required>
                                                <option value="" selected disabled></option>
                                                <option value="implants" {{ old('productCategory') == 'implants' ? 'selected' : '' }}>منتجات زراعة الأسنان</option>
                                                <option value="cosmetic" {{ old('productCategory') == 'cosmetic' ? 'selected' : '' }}>منتجات تجميلية</option>
                                                <option value="tools" {{ old('productCategory') == 'tools' ? 'selected' : '' }}>أدوات طب الأسنان</option>
                                                <option value="all" {{ old('productCategory') == 'all' ? 'selected' : '' }}>جميع المنتجات</option>
                                            </select>
                                            <label for="productCategory" class="form-label">فئة المنتج</label>
                                            <div class="input-icon">
                                                <i class="fas fa-tag"></i>
                                            </div>
                                            @error('productCategory')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-top: 15px;">
                                        <div class="form-group floating-label">
                                            <textarea class="form-control custom-input custom-textarea @error('notes') is-invalid @enderror"
                                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                            <label for="notes" class="form-label">ملاحظات إضافية</label>
                                            <div class="input-icon">
                                                <i class="fas fa-comment-alt"></i>
                                            </div>
                                            @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn-order-submit" id="submitBtn">
                                            <span class="btn-text" id="submitText">إرسال الطلب</span>
                                            <div class="btn-icon" id="submitIcon">
                                                <i class="fas fa-paper-plane"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <!-- Features -->
                    <div class="order-features">
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="feature-icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="feature-text">شحن سريع لجميع الدول</div>
                        </div>
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="feature-text">منتجات معتمدة عالمياً</div>
                        </div>
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="feature-text">دعم فني على مدار الساعة</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="testimonials-section py-5">
    <div class="container">
        <div class="section-heading text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">آراء العملاء</span>
            <h2 class="gradient-text">آراء عملائنا</h2>
            <p>ماذا يقول عملاؤنا عن منتجاتنا</p>
        </div>

        <div class="testimonials-wrapper position-relative">
            <div class="testimonial-blob"></div>
            <div class="testimonial-blob-2"></div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="testimonial-card h-100 animate__animated animate__fadeInUp">
                        <div class="testimonial-pattern"></div>
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <p class="testimonial-text">"منتجات ممتازة وجودة عالية. أنصح بها بشدة لجميع العيادات!"</p>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client">
                            </div>
                            <div class="author-info">
                                <h5>د. أحمد محمد</h5>
                                <span>مركز طب أسنان</span>
                            </div>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial-card h-100 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <div class="testimonial-pattern"></div>
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <p class="testimonial-text">"منتجات عالية الجودة وخدمة عملاء ممتازة"</p>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client">
                            </div>
                            <div class="author-info">
                                <h5>د. سارة أحمد</h5>
                                <span>عيادة أسنان خاصة</span>
                            </div>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial-card h-100 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                        <div class="testimonial-pattern"></div>
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <p class="testimonial-text">"نستخدم منتجاتهم منذ سنوات. جودة ممتازة وأسعار منافسة!"</p>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Client">
                            </div>
                            <div class="author-info">
                                <h5>د. محمود علي</h5>
                                <span>مستشفى الأسنان التخصصي</span>
                            </div>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section -->
<section class="latest-news-section py-5">
    <div class="container">
        <div class="news-wrapper position-relative">
            <!-- Decorative elements -->
            <div class="news-blob-1"></div>
            <div class="news-blob-2"></div>
            <div class="news-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">الأخبار</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">آخر الأخبار</h2>
                <div class="title-separator">
                    <div class="separator-line"></div>
                    <div class="separator-icon"><i class="fas fa-newspaper"></i></div>
                    <div class="separator-line"></div>
                </div>
                <p class="section-subtitle">تابع أحدث الأخبار والمستجدات في عالم طب الأسنان</p>
            </div>

            @php
                $latestNews = \App\Models\News::published()->latest()->limit(3)->get();
            @endphp

            @if($latestNews->count() > 0)
                <div class="row g-4 justify-content-center">
                    @foreach($latestNews as $index => $article)
                    <div class="col-lg-4 col-md-6">
                        <article class="news-card-modern" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <div class="news-image-wrapper">
                                <img src="{{ $article->cover_image_url }}" alt="{{ $article->title }}" class="news-image">
                                <div class="news-overlay-gradient"></div>
                                <div class="news-category-badge">
                                    <i class="fas fa-bookmark"></i>
                                    <span>أخبار</span>
                                </div>
                            </div>
                            <div class="news-content-wrapper">
                                <div class="news-meta-info">
                                    <span class="news-date-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $article->published_at->format('Y-m-d') }}
                                    </span>
                                    <span class="news-time-item">
                                        <i class="fas fa-clock"></i>
                                        {{ $article->reading_time }} دقائق
                                    </span>
                                </div>
                                <h3 class="news-card-title">
                                    <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                                <p class="news-excerpt-text">{{ Str::limit($article->short_description, 100) }}</p>
                                <a href="{{ route('news.show', $article->slug) }}" class="btn-news-read">
                                    <span>اقرأ المزيد</span>
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>

                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('news.index') }}" class="btn-all-news">
                        <span>جميع الأخبار</span>
                        <i class="fas fa-newspaper"></i>
                    </a>
                </div>
            @else
                <div class="no-news-container" data-aos="fade-up">
                    <div class="no-news-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h4 class="no-news-title">لا توجد أخبار متاحة حالياً</h4>
                    <p class="no-news-text">ترقب الأخبار الجديدة قريباً!</p>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('assets/js/index.js') }}?t={{ time() }}"></script>
@endsection
