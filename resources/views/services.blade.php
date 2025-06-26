@extends('layouts.dental')

@section('title', 'خدماتنا - مصنع منتجات الأسنان')

@section('styles')
<link rel="stylesheet" href="{{ asset(path: 'assets/css/dental-css/services.css') }}?t={{ time() }}">

@endsection

@section('content')

<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <h1 class="hero-bg-title mb-4">خدمات طب الأسنان المتطورة</h1>
        <p class="hero-bg-desc mb-4">
            نقدم مجموعة شاملة من خدمات طب الأسنان بأحدث التقنيات وأعلى معايير الجودة لضمان راحة المرضى ونتائج مثالية
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#appointment" class="hero-bg-btn main-btn">احجز موعدك</a>
            <a href="#services" class="hero-bg-btn ghost-btn">تعرف على خدماتنا</a>
        </div>
    </div>
</section>

<section id="services" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">خدماتنا الرئيسية</span>
            <h2 class="gradient-text">خدمات متكاملة</h2>
            <p>مجموعة متكاملة من الخدمات الطبية المتخصصة في مجال طب الأسنان</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="product-card card h-100 floating-card">
                    <div class="position-relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=600&q=80"
                            alt="زراعة الأسنان" class="product-image">
                        <span class="badge-new">خدمة جديدة</span>
                    </div>
                    <div class="card-body text-center">
                        <div class="product-icon">
                            <i class="fas fa-teeth-open fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h4 class="mb-3">زراعة الأسنان</h4>
                        <p>خدمات زراعة الأسنان المتكاملة بأحدث التقنيات العالمية</p>
                        <ul class="list-unstyled text-start feature-list">
                            <li>زراعة الأسنان الفورية</li>
                            <li>زراعة الأسنان التقليدية</li>
                            <li>زراعة الأسنان المتقدمة</li>
                        </ul>
                        <div class="mt-4">
                            <a href="#appointment" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-calendar-check me-2" style="color: #ffffff;"></i>
                                احجز موعدك
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card card h-100 floating-card">
                    <div class="position-relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&w=600&q=80"
                            alt="تجميل الأسنان" class="product-image">
                    </div>
                    <div class="card-body text-center">
                        <div class="product-icon">
                            <i class="fas fa-smile-beam fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h4 class="mb-3">تجميل الأسنان</h4>
                        <p>خدمات تجميل الأسنان المتطورة للحصول على ابتسامة مثالية</p>
                        <ul class="list-unstyled text-start feature-list">
                            <li>تبييض الأسنان</li>
                            <li>قشور السيراميك</li>
                            <li>تقويم الأسنان</li>
                        </ul>
                        <div class="mt-4">
                            <a href="#appointment" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-calendar-check me-2" style="color: #ffffff;"></i>
                                احجز موعدك
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card card h-100 floating-card">
                    <div class="position-relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=600&q=80"
                            alt="علاج الأسنان" class="product-image">
                    </div>
                    <div class="card-body text-center">
                        <div class="product-icon">
                            <i class="fas fa-tooth fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h4 class="mb-3">علاج الأسنان</h4>
                        <p>خدمات علاج الأسنان الشاملة بأحدث التقنيات</p>
                        <ul class="list-unstyled text-start feature-list">
                            <li>علاج الجذور</li>
                            <li>حشو الأسنان</li>
                            <li>علاج اللثة</li>
                        </ul>
                        <div class="mt-4">
                            <a href="#appointment" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-calendar-check me-2" style="color: #ffffff;"></i>
                                احجز موعدك
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light curved-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">خدمات متخصصة</span>
            <h2 class="gradient-text">خدمات إضافية</h2>
            <p>خدمات متخصصة لتلبية كافة احتياجاتكم في مجال طب الأسنان</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="product-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="product-icon">
                            <i class="fas fa-x-ray fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h5 class="mt-3 mb-3">الأشعة السينية</h5>
                        <p>خدمات الأشعة السينية المتطورة للتشخيص الدقيق</p>
                        <a href="#appointment" class="btn btn-outline-primary rounded-pill px-3 mt-3">
                            <i class="fas fa-calendar-check me-2" style="color: #26e07f;"></i>
                            احجز موعدك
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="product-icon">
                            <i class="fas fa-tooth fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h5 class="mt-3 mb-3">طب أسنان الأطفال</h5>
                        <p>خدمات متخصصة لرعاية أسنان الأطفال</p>
                        <a href="#appointment" class="btn btn-outline-primary rounded-pill px-3 mt-3">
                            <i class="fas fa-calendar-check me-2" style="color: #26e07f;"></i>
                            احجز موعدك
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="product-icon">
                            <i class="fas fa-teeth fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h5 class="mt-3 mb-3">تقويم الأسنان</h5>
                        <p>خدمات تقويم الأسنان المتطورة للكبار والصغار</p>
                        <a href="#appointment" class="btn btn-outline-primary rounded-pill px-3 mt-3">
                            <i class="fas fa-calendar-check me-2" style="color: #26e07f;"></i>
                            احجز موعدك
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="product-icon">
                            <i class="fas fa-tooth fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h5 class="mt-3 mb-3">طب الأسنان التجميلي</h5>
                        <p>خدمات تجميل الأسنان المتطورة للحصول على ابتسامة مثالية</p>
                        <a href="#appointment" class="btn btn-outline-primary rounded-pill px-3 mt-3">
                            <i class="fas fa-calendar-check me-2" style="color: #26e07f;"></i>
                            احجز موعدك
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="appointment" class="order-section-2025 py-5">
    <div class="container">
        <div class="order-wrapper position-relative">
            <div class="order-blob-1"></div>
            <div class="order-blob-2"></div>
            <div class="order-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">حجز موعد</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">احجز موعدك الآن</h2>
                <div class="title-separator"><div class="separator-line"></div><div class="separator-icon"><i class="fas fa-calendar-check"></i></div><div class="separator-line"></div></div>
                <p class="section-subtitle">املأ النموذج التالي وسيتواصل معك فريقنا في أقرب وقت لتأكيد الموعد</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="order-card">
                        <div class="order-card-inner">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="order-form-container">
                                        <div class="order-card-header">
                                            <div class="order-card-icon">
                                                <div class="icon-pulse"></div>
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                            <h3 class="order-card-title">معلومات الحجز</h3>
                                        </div>

                                        <form class="order-form">
                                            <div class="row g-4">
                                                <div class="col-md-6">
                                                    <div class="form-floating custom-input">
                                                        <input type="text" class="form-control" id="name" placeholder="الاسم الكامل" required>
                                                        <label for="name">الاسم الكامل</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating custom-input">
                                                        <input type="email" class="form-control" id="email" placeholder="البريد الإلكتروني" required>
                                                        <label for="email">البريد الإلكتروني</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating custom-input">
                                                        <input type="tel" class="form-control" id="phone" placeholder="رقم الهاتف" required>
                                                        <label for="phone">رقم الهاتف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating custom-input">
                                                        <input type="date" class="form-control" id="date" required>
                                                        <label for="date">التاريخ المفضل</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating custom-input">
                                                        <select class="form-select" id="service" required>
                                                            <option value="" selected disabled>اختر الخدمة المطلوبة</option>
                                                            <option>زراعة الأسنان</option>
                                                            <option>تجميل الأسنان</option>
                                                            <option>علاج الأسنان</option>
                                                            <option>تقويم الأسنان</option>
                                                            <option>طب أسنان الأطفال</option>
                                                            <option>أخرى</option>
                                                        </select>
                                                        <label for="service">الخدمة المطلوبة</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating custom-input">
                                                        <textarea class="form-control" id="notes" style="height: 120px" placeholder="ملاحظات إضافية"></textarea>
                                                        <label for="notes">ملاحظات إضافية</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn-order-submit">
                                                    <span class="btn-text">تأكيد الحجز</span>
                                                    <span class="btn-icon"><i class="fas fa-calendar-check"></i></span>
                                                    <div class="btn-shine"></div>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6 d-none d-lg-block">
                                    <div class="order-benefits">
                                        <div class="order-illustration">
                                            <img src="https://img.icons8.com/ios-filled/250/26e07f/tooth.png" alt="خدمات طب الأسنان" class="main-illustration">
                                            <div class="illustration-shape"></div>
                                        </div>

                                        <div class="benefits-list">
                                            <h4 class="benefits-title">مميزات خدماتنا</h4>

                                            <div class="benefit-item">
                                                <div class="benefit-icon">
                                                    <i class="fas fa-user-md"></i>
                                                </div>
                                                <div class="benefit-content">
                                                    <h5>أطباء متخصصون</h5>
                                                    <p>فريق من الأطباء المتخصصين ذوي الخبرة</p>
                                                </div>
                                            </div>

                                            <div class="benefit-item">
                                                <div class="benefit-icon">
                                                    <i class="fas fa-medal"></i>
                                                </div>
                                                <div class="benefit-content">
                                                    <h5>جودة عالمية</h5>
                                                    <p>خدمات معتمدة بمعايير عالمية</p>
                                                </div>
                                            </div>

                                            <div class="benefit-item">
                                                <div class="benefit-icon">
                                                    <i class="fas fa-headset"></i>
                                                </div>
                                                <div class="benefit-content">
                                                    <h5>دعم فني</h5>
                                                    <p>فريق دعم فني متخصص على مدار الساعة</p>
                                                </div>
                                            </div>

                                            <div class="discount-badge">
                                                <div class="discount-content">
                                                    <span class="discount-label">خصم</span>
                                                    <span class="discount-value">20%</span>
                                                    <span class="discount-text">على أول زيارة</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">ميزاتنا</span>
            <h2 class="gradient-text">لماذا تختارنا؟</h2>
            <p>أسباب تجعل خدماتنا الخيار الأفضل لرعاية صحة أسنانك</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center feature-box">
                    <div class="product-icon mx-auto">
                        <i class="fas fa-user-md fa-2x" style="color: #26e07f;"></i>
                    </div>
                    <h5 class="mt-3 mb-3">أطباء متخصصون</h5>
                    <p>فريق من الأطباء المتخصصين ذوي الخبرة في مختلف مجالات طب الأسنان</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center feature-box">
                    <div class="product-icon mx-auto">
                        <i class="fas fa-flask fa-2x" style="color: #26e07f;"></i>
                    </div>
                    <h5 class="mt-3 mb-3">تقنيات متطورة</h5>
                    <p>أحدث التقنيات والمعدات الطبية التي تضمن أفضل النتائج</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center feature-box">
                    <div class="product-icon mx-auto">
                        <i class="fas fa-clock fa-2x" style="color: #26e07f;"></i>
                    </div>
                    <h5 class="mt-3 mb-3">مواعيد مرنة</h5>
                    <p>نقدم مواعيد مرنة تناسب جدولك مع إمكانية الحجز السريع</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section-2025 py-5">
    <div class="container">
        <div class="cta-wrapper position-relative">
            <!-- Decorative elements -->
            <div class="cta-blob-1"></div>
            <div class="cta-blob-2"></div>
            <div class="cta-particles"></div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="cta-card-2025">
                        <div class="cta-card-inner">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <div class="cta-content">
                                        <span class="cta-badge">عرض خاص</span>
                                        <h2 class="cta-title">جاهز لتحسين صحة أسنانك؟</h2>
                                        <p class="cta-desc">احجز موعدك الآن واستفد من عروضنا الحصرية وخدمة العملاء المتميزة</p>

                                        <div class="cta-features">
                                            <div class="feature-tag">
                                                <i class="fas fa-user-md"></i>
                                                <span>أطباء متخصصون</span>
                                            </div>
                                            <div class="feature-tag">
                                                <i class="fas fa-headset"></i>
                                                <span>دعم 24/7</span>
                                            </div>
                                            <div class="feature-tag">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>جودة عالية</span>
                                            </div>
                                        </div>

                                        <div class="cta-actions">
                                            <a href="#appointment" class="btn-cta-primary">
                                                <span class="btn-text">احجز موعدك</span>
                                                <span class="btn-icon"><i class="fas fa-calendar-check" style="color: #ffffff;"></i></span>
                                                <div class="btn-shine"></div>
                                            </a>
                                            <span class="or-divider">أو</span>
                                            <a href="#services" class="btn-cta-secondary">
                                                <span class="btn-text">تصفح الخدمات</span>
                                                <span class="btn-icon"><i class="fas fa-angle-left"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="cta-offer-card">
                                        <div class="offer-card-header">
                                            <div class="discount-icon">
                                                <i class="fas fa-percentage"></i>
                                            </div>
                                            <h3 class="offer-title">خصم خاص</h3>
                                        </div>

                                        <div class="offer-body">
                                            <div class="offer-value">
                                                <span class="value-number">20</span>
                                                <span class="value-symbol">%</span>
                                            </div>
                                            <p class="offer-desc">على أول زيارة مع رمز الخصم</p>
                                            <div class="promo-code">
                                                <span>DENT2025</span>
                                                <div class="promo-shine"></div>
                                            </div>
                                        </div>

                                        <div class="offer-footer">
                                            <div class="offer-timer">
                                                <div class="timer-icon">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <div class="timer-text">
                                                    <p>العرض ساري حتى نهاية الشهر</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements
        const animateCSS = (element, animation, speed = 'normal', delay = 0) => {
            return new Promise((resolve) => {
                const nodes = document.querySelectorAll(element);

                nodes.forEach(node => {
                    node.style.setProperty('--animate-duration', speed);
                    node.style.setProperty('--animate-delay', delay + 's');
                    node.classList.add('animate__animated', `animate__${animation}`);

                    node.addEventListener('animationend', function handler() {
                        node.classList.remove('animate__animated', `animate__${animation}`);
                        node.removeEventListener('animationend', handler);
                        resolve('Animation ended');
                    });
                });
            });
        };

        // Trigger animations when elements come into view
        const observerOptions = {
            threshold: 0.1
        };

        const animationObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('hero-badge')) {
                        animateCSS('.hero-badge', 'fadeIn', '0.8s');
                    } else if (entry.target.classList.contains('hero-title')) {
                        animateCSS('.hero-title', 'fadeInUp', '1s', 0.2);
                    } else if (entry.target.classList.contains('hero-description')) {
                        animateCSS('.hero-description', 'fadeInUp', '1s', 0.4);
                    } else if (entry.target.classList.contains('hero-buttons')) {
                        animateCSS('.hero-buttons', 'fadeInUp', '1s', 0.6);
                    } else if (entry.target.classList.contains('product-categories')) {
                        animateCSS('.product-categories', 'fadeInUp', '1s', 0.8);
                    } else if (entry.target.classList.contains('hero-image')) {
                        animateCSS('.hero-image', 'zoomIn', '1.2s', 0.3);
                    } else if (entry.target.classList.contains('floating-badge')) {
                        if (entry.target.classList.contains('badge-tech')) {
                            animateCSS('.badge-tech', 'fadeInRight', '1s', 0.5);
                        } else if (entry.target.classList.contains('badge-quality')) {
                            animateCSS('.badge-quality', 'fadeInLeft', '1s', 0.7);
                        }
                    }
                    animationObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements to animate
        const elementsToAnimate = document.querySelectorAll('.hero-badge, .hero-title, .hero-description, .hero-buttons, .product-categories, .hero-image, .floating-badge');
        elementsToAnimate.forEach(element => {
            animationObserver.observe(element);
        });

        // Category items hover effect
        const categoryItems = document.querySelectorAll('.category-item');
        categoryItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.category-icon');
                icon.classList.add('animate__animated', 'animate__rubberBand');

                icon.addEventListener('animationend', function handler() {
                    icon.classList.remove('animate__animated', 'animate__rubberBand');
                    icon.removeEventListener('animationend', handler);
                });
            });
        });
    });
</script>
@endsection
