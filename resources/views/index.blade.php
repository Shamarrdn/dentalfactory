@extends('layouts.dental')

@section('title', 'مصنع منتجات الأسنان - الصفحة الرئيسية')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/index.css') }}?t={{ time() }}">

<style>
    .coupon-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
        height: 100%;
    }

    .coupon-card:hover {
        transform: translateY(-5px);
    }

    .coupon-content {
        padding: 20px;
    }

    .coupon-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .discount-badge {
        background: var(--primary-gradient);
        color: white;
        padding: 10px 15px;
        border-radius: 10px;
        text-align: center;
        min-width: 80px;
    }

    .discount-value {
        font-size: 24px;
        font-weight: bold;
        display: block;
        line-height: 1;
    }

    .discount-text {
        font-size: 14px;
    }

    .coupon-code {
        text-align: left;
    }

    .coupon-code span {
        color: #666;
        font-size: 14px;
    }

    .coupon-code strong {
        display: block;
        font-size: 18px;
        color: var(--primary-color);
        margin-top: 5px;
    }

    .coupon-body h4 {
        color: #333;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .coupon-body p {
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .coupon-details {
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        color: #666;
        font-size: 14px;
    }

    .detail-item i {
        color: var(--primary-color);
        margin-left: 8px;
        width: 20px;
    }

    .pagination-wrapper {
        margin-top: 30px;
    }

    .pagination .page-link {
        color: var(--primary-color);
        border: 1px solid #dee2e6;
        margin: 0 2px;
        border-radius: 5px;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary-gradient);
        border-color: var(--primary-color);
    }
</style>

@endsection

@section('content')
<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <h1 class="hero-bg-title mb-4">أفضل منتجات طب الأسنان بتقنيات حديثة</h1>
        <p class="hero-bg-desc mb-4">
            نصنع منتجات طب الأسنان بأعلى معايير الجودة وبأحدث التقنيات العالمية لنضمن لك أفضل النتائج.
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

<section class="coupons-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">العروض والخصومات</span>
            <h2 class="gradient-text">خصومات حصرية</h2>
            <p>استمتع بخصومات حصرية على منتجاتنا</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($coupons as $coupon)
            <div class="col-md-6 col-lg-4">
                <div class="coupon-card">
                    <div class="coupon-content">
                        <div class="coupon-header">
                            <div class="discount-badge">
                                <span class="discount-value">{{ $coupon->discount_percentage }}%</span>
                                <span class="discount-text">خصم</span>
                            </div>
                            <div class="coupon-code">
                                <span>كود الخصم:</span>
                                <strong>{{ $coupon->code }}</strong>
                            </div>
                        </div>
                        <div class="coupon-body">
                            <h4>{{ $coupon->title }}</h4>
                            <p>{{ $coupon->description }}</p>
                            <div class="coupon-details">
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>ينتهي في: {{ $coupon->expires_at->format('Y/m/d') }}</span>
                                </div>
                                @if($coupon->min_purchase_amount)
                                <div class="detail-item">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>الحد الأدنى للشراء: {{ $coupon->min_purchase_amount }} ريال</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">لا توجد خصومات متاحة حالياً</p>
            </div>
            @endforelse
        </div>

        @if($totalPages > 1)
        <div class="pagination-wrapper mt-4 text-center">
            <nav aria-label="Coupons pagination">
                <ul class="pagination justify-content-center">
                    @for($i = 1; $i <= $totalPages; $i++)
                    <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                    </li>
                    @endfor
                </ul>
            </nav>
        </div>
        @endif
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
                        <h3 class="about-subtitle">نحن رواد صناعة منتجات الأسنان</h3>
                        <p class="about-description">نحن مصنع رائد في إنتاج منتجات طب الأسنان عالية الجودة بأحدث التقنيات وأعلى معايير الجودة العالمية، نسعى دائماً للتطوير والابتكار لتقديم أفضل المنتجات لعملائنا حول العالم.</p>

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
            <div id="productsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-wrap="true">
                <!-- Carousel indicators -->
                <div class="carousel-indicators">
                    @php
                        $totalProducts = count($featuredProducts);
                        // عدد الشرائح = عدد المنتجات (لكل تحريك منتج واحد فقط)
                        $slideCount = $totalProducts > 0 ? $totalProducts : 1;
                    @endphp
                    @for($i = 0; $i < $slideCount; $i++)
                        <button type="button" data-bs-target="#productsCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $i + 1 }}"></button>
                    @endfor
                </div>

                <!-- Carousel slides -->
                <div class="carousel-inner">
                    @if(count($featuredProducts) > 0)
                        @for($i = 0; $i < $totalProducts; $i++)
                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}" data-bs-interval="{{ 3000 + ($i * 300) }}">
                                <div class="row g-4 justify-content-center">
                                    @for($j = 0; $j < 3; $j++)
                                        @php
                                            // الحصول على فهرس المنتج مع التدوير للعودة للبداية عند الانتهاء
                                            $productIndex = ($i + $j) % $totalProducts;
                                        @endphp
                                        <div class="col-lg-4 col-md-6">
                                            <div class="product-card-modern h-100">
                                                <div class="product-icon-wrapper">
                                                    <div class="product-icon-bg"></div>
                                                    <img src="{{ $featuredProducts[$productIndex]->image_url }}" alt="{{ $featuredProducts[$productIndex]->name }}" class="product-icon">
                                                </div>
                                                <div class="product-content">
                                                    <h3 class="gradient-text">{{ $featuredProducts[$productIndex]->name }}</h3>
                                                    <p class="mb-3">{{ $featuredProducts[$productIndex]->description }}</p>
                                                    <a href="{{ route('products.show', $featuredProducts[$productIndex]->slug) }}" class="btn-modern">
                                                        <span>شراء الآن</span>
                                                        <i class="fas fa-arrow-left"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endfor
                    @else
                        <div class="carousel-item active">
                            <div class="row g-4 justify-content-center">
                                <div class="col-12 text-center">
                                    <p class="text-muted">لا توجد منتجات متاحة حالياً</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">السابق</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">التالي</span>
                </button>
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
                            <form class="order-form">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control custom-input" id="companyName" required>
                                            <label for="companyName" class="form-label">اسم الشركة/العيادة</label>
                                            <div class="input-icon">
                                                <i class="fas fa-building"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group floating-label">
                                            <input type="email" class="form-control custom-input" id="email" required>
                                            <label for="email" class="form-label">البريد الإلكتروني</label>
                                            <div class="input-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group floating-label">
                                            <input type="tel" class="form-control custom-input" id="phone" required>
                                            <label for="phone" class="form-label">رقم الهاتف</label>
                                            <div class="input-icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group floating-label">
                                            <select class="form-control custom-input custom-select" id="productCategory" required>
                                                <option value="" selected disabled></option>
                                                <option value="implants">منتجات زراعة الأسنان</option>
                                                <option value="cosmetic">منتجات تجميلية</option>
                                                <option value="tools">أدوات طب الأسنان</option>
                                                <option value="all">جميع المنتجات</option>
                                            </select>
                                            <label for="productCategory" class="form-label">فئة المنتج</label>
                                            <div class="input-icon">
                                                <i class="fas fa-tag"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group floating-label">
                                            <textarea class="form-control custom-input custom-textarea" id="notes" rows="3"></textarea>
                                            <label for="notes" class="form-label">ملاحظات إضافية</label>
                                            <div class="input-icon">
                                                <i class="fas fa-comment-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn-order-submit">
                                            <span class="btn-text">إرسال الطلب</span>
                                            <div class="btn-icon">
                                                <i class="fas fa-paper-plane"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="promo-badge">
                            <div class="badge-inner">
                                <div class="discount">10<span class="percent">%</span></div>
                                <div class="badge-text">خصم<br>للطلب الأول</div>
                            </div>
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


<section class="cta-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="cta-card animate__animated animate__fadeIn">
                    <div class="cta-bg-elements">
                        <div class="cta-circle"></div>
                        <div class="cta-circle cta-circle-2"></div>
                        <div class="cta-dots"></div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="cta-content">
                                <h2 class="cta-title">جاهز لتجربة منتجاتنا عالية الجودة؟</h2>
                                <p class="cta-text">احصل على خصم <span class="highlight">10%</span> على أول طلب مع رمز الخصم</p>
                                <div class="discount-badge">
                                    <span>DENT2025</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end text-center mt-4 mt-lg-0">
                            <a href="#order" class="cta-btn">
                                <span>اطلب الآن</span>
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('scripts')
<script>
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const targetValue = parseInt(counter.textContent);
        let currentValue = 0;
        const duration = 2000; // ms
        const interval = 50; // ms
        const increment = Math.ceil(targetValue / (duration / interval));

        const counterAnimation = setInterval(() => {
            currentValue += increment;
            if (currentValue >= targetValue) {
                currentValue = targetValue;
                clearInterval(counterAnimation);
            }
            counter.textContent = currentValue;
        }, interval);
    });

    const heroImage = document.querySelector('.hero-image');
    if (heroImage) {
        window.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            const { innerWidth, innerHeight } = window;

            const x = (clientX / innerWidth - 0.5) * 20;
            const y = (clientY / innerHeight - 0.5) * 20;

            heroImage.style.transform = `translate(${x}px, ${y}px)`;
        });
    }

    const floatingBadges = document.querySelectorAll('.floating-badge');
    floatingBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.animationPlayState = 'paused';
        });

        badge.addEventListener('mouseleave', function() {
            this.style.animationPlayState = 'running';
        });
    });

    // تهيئة السلايدر
    document.addEventListener('DOMContentLoaded', function() {
        // تهيئة سلايدر المنتجات
        var productCarouselElement = document.getElementById('productsCarousel');
        if (productCarouselElement) {
            try {
                // محاولة تهيئة السلايدر باستخدام Bootstrap 5
                var productsCarousel = new bootstrap.Carousel(productCarouselElement, {
                    interval: 2000,  // تغيير السلايد كل 2 ثواني
                    wrap: true,      // تكرار من البداية بعد الوصول للنهاية
                    touch: true,     // دعم السحب على الأجهزة اللمسية
                    pause: false     // عدم التوقف عند تحويم الماوس
                });

                console.log('تم تهيئة السلايدر بنجاح');

                // التأكد من أن السلايدر يعمل دائما
                productsCarousel.cycle();

                // منع التوقف عند تحويم الماوس
                productCarouselElement.addEventListener('mouseenter', function() {
                    productsCarousel.cycle();
                });

                // إضافة تغيير السلايد كل عدة ثواني حتى مع سلايد واحد
                setInterval(function() {
                    productsCarousel.next();
                }, 4000);

            } catch (error) {
                console.error('خطأ في تهيئة السلايدر:', error);

                // محاولة تهيئة السلايدر بطريقة jQuery (للمتصفحات القديمة)
                if (typeof $ !== 'undefined') {
                    try {
                        $('#productsCarousel').carousel({
                            interval: 2000,
                            wrap: true,
                            pause: false
                        });

                        // التأكد من أن السلايدر يعمل دائما
                        $('#productsCarousel').carousel('cycle');

                        // إضافة تغيير السلايد كل عدة ثواني
                        setInterval(function() {
                            $('#productsCarousel').carousel('next');
                        }, 4000);

                        console.log('تم تهيئة السلايدر باستخدام jQuery');
                    } catch (jqError) {
                        console.error('خطأ في تهيئة السلايدر باستخدام jQuery:', jqError);
                    }
                }
            }
        } else {
            console.warn('لم يتم العثور على عنصر السلايدر');
        }
    });
</script>
@endsection
