@extends('layouts.dental')

@section('title', 'خدماتنا - مصنع جينودينت')

@section('styles')
<link rel="stylesheet" href="{{ asset(path: 'assets/css/dental-css/services.css') }}?t={{ time() }}">

@endsection

@section('content')

<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <h1 class="hero-bg-title mb-4">جينودينت - منتجات طب الأسنان المتطورة</h1>
        <p class="hero-bg-desc mb-4">
            نوفر تشكيلة واسعة من مواد طب الأسنان تشمل الترميم المباشر وغير المباشر، ومنتجات الوقاية، المختبر، والانطباعات الرقمية بجودة عالية وأسعار تنافسية
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#products" class="hero-bg-btn main-btn">تصفح منتجاتنا</a>
            <a href="{{ route('contact') }}" class="hero-bg-btn ghost-btn">تواصل معنا</a>
        </div>
    </div>
</section>

<!-- قسم المنتجات الرئيسية -->
<section id="products" class="py-5 section-spacing">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">منتجاتنا الرئيسية</span>
            <h2 class="gradient-text">منتجات متكاملة</h2>
            <p class="section-subtitle">مجموعة متكاملة من المنتجات الطبية المتخصصة في مجال طب الأسنان</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="product-card card h-100 floating-card">
                    <div class="position-relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=600&q=80"
                            alt="منتجات الترميم المباشرة" class="product-image">
                        <span class="badge-new">منتج جديد</span>
                    </div>
                    <div class="card-body text-center">
                        <div class="product-icon">
                            <i class="fas fa-teeth-open fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h4 class="mb-3">منتجات الترميم المباشرة</h4>
                        <p>منتجات عالية الجودة للترميم المباشر للأسنان</p>
                        <ul class="list-unstyled text-start feature-list">
                            <li>مركبات الكومبومرز</li>
                            <li>مواد ترميم أيونومر زجاجي</li>
                            <li>منتجات ترميمية أخرى</li>
                        </ul>
                        <div class="mt-4">
                            <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-shopping-cart me-2" style="color: #ffffff;"></i>
                                اطلب الآن
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card card h-100 floating-card">
                    <div class="position-relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&w=600&q=80"
                            alt="منتجات الترميم غير المباشر" class="product-image">
                    </div>
                    <div class="card-body text-center">
                        <div class="product-icon">
                            <i class="fas fa-smile-beam fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h4 class="mb-3">منتجات الترميم غير المباشر</h4>
                        <p>منتجات متطورة للترميم غير المباشر للأسنان</p>
                        <ul class="list-unstyled text-start feature-list">
                            <li>تيجان وأدوات التيجان</li>
                            <li>الأسمنت</li>
                            <li>مادة مانعة للتسريب</li>
                        </ul>
                        <div class="mt-4">
                            <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-shopping-cart me-2" style="color: #ffffff;"></i>
                                اطلب الآن
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card card h-100 floating-card">
                    <div class="position-relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=600&q=80"
                            alt="منتجات الوقاية" class="product-image">
                    </div>
                    <div class="card-body text-center">
                        <div class="product-icon">
                            <i class="fas fa-tooth fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h4 class="mb-3">منتجات الوقاية</h4>
                        <p>منتجات متخصصة للوقاية وصحة الفم والأسنان</p>
                        <ul class="list-unstyled text-start feature-list">
                            <li>الورنيش</li>
                            <li>معجون الأسنان</li>
                            <li>خيط الأسنان</li>
                        </ul>
                        <div class="mt-4">
                            <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-shopping-cart me-2" style="color: #ffffff;"></i>
                                اطلب الآن
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- قسم المنتجات الإضافية -->
<section class="py-5 additional-services-section section-spacing">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">منتجات متخصصة</span>
            <h2 class="gradient-text">منتجات إضافية</h2>
            <p class="section-subtitle">منتجات متخصصة لتلبية كافة احتياجاتكم في مجال طب الأسنان</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="product-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="product-icon">
                            <i class="fas fa-shield-virus fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h5 class="mt-3 mb-3">منتجات مكافحة العدوى</h5>
                        <p>منتجات متطورة لمكافحة العدوى وضمان بيئة آمنة</p>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill px-3 mt-3">
                            <i class="fas fa-shopping-cart me-2" style="color: #26e07f;"></i>
                            اطلب الآن
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="product-icon">
                            <i class="fas fa-hand-sparkles fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h5 class="mt-3 mb-3">منتجات التعقيم</h5>
                        <p>جل مطهر لليدين ومنتجات مراقبة التعقيم</p>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill px-3 mt-3">
                            <i class="fas fa-shopping-cart me-2" style="color: #26e07f;"></i>
                            اطلب الآن
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
                        <h5 class="mt-3 mb-3">لاصقات الأسنان</h5>
                        <p>لاصقات أسنان عالية الجودة للاستخدامات المختلفة</p>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill px-3 mt-3">
                            <i class="fas fa-shopping-cart me-2" style="color: #26e07f;"></i>
                            اطلب الآن
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="product-icon">
                            <i class="fas fa-pump-medical fa-2x" style="color: #26e07f;"></i>
                        </div>
                        <h5 class="mt-3 mb-3">غسولات الفم</h5>
                        <p>جل وغسولات الفم المطهرة للعناية بصحة الفم</p>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill px-3 mt-3">
                            <i class="fas fa-shopping-cart me-2" style="color: #26e07f;"></i>
                            اطلب الآن
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- قسم لماذا تختارنا -->
<section class="py-5 why-choose-us-section section-spacing">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">ميزاتنا</span>
            <h2 class="gradient-text">لماذا تختار منتجاتنا؟</h2>
            <p class="section-subtitle">أسباب تجعل منتجاتنا الخيار الأفضل لعيادتك ومرضاك</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center feature-box">
                    <div class="product-icon mx-auto">
                        <i class="fas fa-certificate fa-2x" style="color: #26e07f;"></i>
                    </div>
                    <h5 class="mt-3 mb-3">جودة عالمية</h5>
                    <p>منتجات مصنعة وفق أعلى معايير الجودة العالمية ومعتمدة من الهيئات الرقابية</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center feature-box">
                    <div class="product-icon mx-auto">
                        <i class="fas fa-flask fa-2x" style="color: #26e07f;"></i>
                    </div>
                    <h5 class="mt-3 mb-3">تقنيات متطورة</h5>
                    <p>منتجات مصنعة باستخدام أحدث التقنيات والمعدات التي تضمن أفضل النتائج</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center feature-box">
                    <div class="product-icon mx-auto">
                        <i class="fas fa-truck-fast fa-2x" style="color: #26e07f;"></i>
                    </div>
                    <h5 class="mt-3 mb-3">توصيل سريع</h5>
                    <p>نوفر خدمة توصيل سريعة وموثوقة لجميع منتجاتنا مع دعم فني متكامل</p>
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
                    } else if (entry.target.classList.contains('cta-card-2025')) {
                        animateCSS('.cta-card-2025', 'fadeInUp', '1s', 0.3);
                    } else if (entry.target.classList.contains('cta-contact-card')) {
                        animateCSS('.cta-contact-card', 'fadeInUp', '1s', 0.5);
                    } else if (entry.target.classList.contains('cta-title')) {
                        animateCSS('.cta-title', 'fadeInUp', '1s', 0.2);
                    } else if (entry.target.classList.contains('cta-pulse-badge')) {
                        animateCSS('.cta-pulse-badge', 'fadeIn', '0.8s');
                    } else if (entry.target.classList.contains('cta-features')) {
                        animateCSS('.cta-features', 'fadeInUp', '1s', 0.4);
                    } else if (entry.target.classList.contains('cta-actions')) {
                        animateCSS('.cta-actions', 'fadeInUp', '1s', 0.6);
                    }
                    animationObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements to animate
        const elementsToAnimate = document.querySelectorAll('.hero-badge, .hero-title, .hero-description, .hero-buttons, .product-categories, .hero-image, .floating-badge, .cta-card-2025, .cta-contact-card, .cta-title, .cta-pulse-badge, .cta-features, .cta-actions');
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

        // Animate contact items on hover
        const contactItems = document.querySelectorAll('.contact-item');
        contactItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.contact-item-icon i');
                icon.classList.add('animate__animated', 'animate__heartBeat');

                icon.addEventListener('animationend', function handler() {
                    icon.classList.remove('animate__animated', 'animate__heartBeat');
                    icon.removeEventListener('animationend', handler);
                });
            });
        });

        // Add parallax effect to blobs
        window.addEventListener('mousemove', function(e) {
            const blob1 = document.querySelector('.cta-blob-1');
            const blob2 = document.querySelector('.cta-blob-2');

            if (blob1 && blob2) {
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;

                blob1.style.transform = `translate(${x * 30}px, ${y * 30}px)`;
                blob2.style.transform = `translate(${-x * 30}px, ${-y * 30}px)`;
            }
        });

        // فلترة البطاقات عند التمرير - تظهر تأثير مدهش
        const productCards = document.querySelectorAll('.product-card');

        const productCardsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    productCardsObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15
        });

        productCards.forEach(card => {
            productCardsObserver.observe(card);
        });
    });
</script>
@endsection
