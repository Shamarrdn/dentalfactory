@extends('layouts.dental')

@section('title', 'من نحن - مصنع منتجات الأسنان')

@section('styles')
<link rel="stylesheet" href="{{ asset(path: 'assets/css/dental-css/about.css') }}?t={{ time() }}">

@endsection

@section('content')
<!-- Hero Section -->
<section class="about-hero-section">
    <!-- 3D Geometric Elements -->
    <div class="about-hero-shapes">
        <div class="about-shape about-shape-1"></div>
        <div class="about-shape about-shape-2"></div>
        <div class="about-shape about-shape-3"></div>
        <div class="about-shape about-shape-4"></div>
    </div>

    <div class="container">
        <div class="row align-items-center about-hero-row">
            <div class="col-lg-6 order-lg-1 about-hero-content-wrapper">
                <div class="about-hero-content" data-aos="fade-right">
                    <span class="about-hero-badge">قصة نجاحنا</span>
                    <h1 class="about-hero-title">
                        <span class="gradient-text">رحلتنا</span> في صناعة
                        <br>
                        أفضل منتجات <span class="gradient-text">الأسنان</span>
                    </h1>
                    <p class="about-hero-description">منذ عام 2000، ونحن نبتكر ونطور في عالم منتجات طب الأسنان، لنقدم أفضل المنتجات بأعلى معايير الجودة العالمية</p>

                    <div class="about-hero-buttons">
                        <a href="#team" class="btn-about-primary">
                            <span>تعرف على فريقنا</span>
                            <i class="fas fa-users"></i>
                        </a>
                        <a href="#achievements" class="btn-about-secondary">
                            <span>إنجازاتنا</span>
                            <i class="fas fa-trophy"></i>
                        </a>
                    </div>

                    <div class="about-hero-timeline">
                        <div class="timeline-point active" data-year="2000">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year">2000</span>
                                <p>تأسيس المصنع</p>
                            </div>
                        </div>
                        <div class="timeline-point" data-year="2010">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year">2010</span>
                                <p>توسع عالمي</p>
                            </div>
                        </div>
                        <div class="timeline-point" data-year="2020">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year">2020</span>
                                <p>تقنيات حديثة</p>
                            </div>
                        </div>
                        <div class="timeline-point" data-year="2025">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year">2025</span>
                                <p>ابتكارات جديدة</p>
                            </div>
                        </div>
                        <div class="timeline-progress"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 order-lg-2 about-hero-visual-wrapper">
                <div class="about-hero-visual">
                    <div class="about-hero-main-image">
                        <img src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&w=600&q=80" alt="مصنع منتجات الأسنان" class="main-about-image">
                    </div>

                    <div class="about-floating-element about-element-1">
                        <div class="about-element-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="about-element-content">
                            <h5>حائز على شهادة ISO</h5>
                            <div class="certification-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="about-floating-element about-element-2">
                        <div class="about-element-icon">
                            <i class="fas fa-globe-americas"></i>
                        </div>
                        <div class="about-element-content">
                            <h5>تصدير لـ 45+ دولة</h5>
                            <div class="about-element-progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>

                    <div class="about-floating-element about-element-3">
                        <div class="about-element-icon rotate-element">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <span>تقنيات متطورة</span>
                    </div>

                    <div class="about-floating-element about-element-4">
                        <div class="about-element-digits">
                            <span class="digit-counter">25</span>
                            <span class="digit-label">سنة خبرة</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story -->
<section class="our-story-section">
    <div class="our-story-shapes">
        <div class="our-story-shape our-story-shape-1"></div>
        <div class="our-story-shape our-story-shape-2"></div>
    </div>

    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <div class="story-image-wrapper">
                    <div class="story-image-container">
                        <img src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&w=600&q=80"
                             alt="Dental Factory" class="img-fluid">
                    </div>

                    <div class="story-badge">
                        <div class="story-badge-inner">
                            <i class="fas fa-certificate text-white"></i>
                        </div>
                    </div>

                    <div class="story-image-decorations">
                        <div class="story-decoration story-decoration-1">
                            <div class="decoration-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="decoration-content">
                                <h6>منتجات متميزة</h6>
                                <p>جودة عالمية</p>
                            </div>
                        </div>

                        <div class="story-decoration story-decoration-2">
                            <div class="decoration-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="decoration-content">
                                <h6>خبرة +25 عام</h6>
                                <p>منذ عام 2000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="story-content-wrapper">
                    <h2 class="story-title gradient-text">قصتنا</h2>
                    <p class="story-lead">تأسس مصنعنا عام 2000 بهدف تصنيع أفضل منتجات طب الأسنان في المنطقة</p>
                    <p class="story-text">نؤمن بأن جودة المنتجات الطبية هي حق لكل مريض، لذلك نسعى دائماً لتصنيع منتجات عالية الجودة بأحدث التقنيات وأعلى معايير الجودة العالمية. فريقنا من المهندسين والخبراء المتخصصين يمتلك خبرة واسعة في مختلف مجالات تصنيع منتجات طب الأسنان.</p>

                    <div class="story-feature-item">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h5>الشغف بالجودة</h5>
                            <p>نصنع منتجاتنا بشغف وتركيز على أدق التفاصيل</p>
                        </div>
                    </div>

                    <div class="story-feature-item">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h5>الابتكار المستمر</h5>
                            <p>نبتكر حلولاً جديدة تلبي احتياجات السوق المتغيرة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="vision-mission-section py-5">
    <div class="container">
        <div class="vm-wrapper position-relative">
            <!-- Decorative elements -->
            <div class="vm-shape-1"></div>
            <div class="vm-shape-2"></div>
            <div class="vm-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">فلسفتنا</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">رؤيتنا ورسالتنا</h2>
                <div class="title-separator"><div class="separator-line"></div><div class="separator-icon"><i class="fas fa-compass"></i></div><div class="separator-line"></div></div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="vision-card h-100">
                        <div class="vision-icon">
                            <div class="icon-backdrop"></div>
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="vision-title">رؤيتنا</h3>
                        <div class="vision-decoration"></div>
                        <p class="vision-desc">نسعى لأن نكون الشركة المصنعة الرائدة عالمياً في مجال منتجات طب الأسنان، من خلال تقديم منتجات متميزة بأحدث التقنيات العالمية وأعلى معايير الجودة.</p>
                        <div class="vision-features">
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>منتجات مبتكرة</span>
                            </div>
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>معايير عالمية</span>
                            </div>
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>جودة متميزة</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="mission-card h-100">
                        <div class="mission-icon">
                            <div class="icon-backdrop"></div>
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="mission-title">رسالتنا</h3>
                        <div class="mission-decoration"></div>
                        <p class="mission-desc">تصنيع منتجات طب أسنان عالية الجودة باستخدام أحدث التقنيات، مع التركيز على الابتكار والتطوير المستمر لتلبية احتياجات السوق العالمية.</p>
                        <div class="mission-features">
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>تقنيات متطورة</span>
                            </div>
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>تطوير مستمر</span>
                            </div>
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>تلبية احتياجات السوق</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Manufacturing Facility -->
<section class="facility-section-2025 py-5">
    <div class="container">
        <div class="facility-wrapper position-relative">
            <!-- Decorative elements -->
            <div class="facility-shape-1"></div>
            <div class="facility-shape-2"></div>
            <div class="facility-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">البنية التحتية</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">مرافق التصنيع المتطورة</h2>
                <div class="title-separator"><div class="separator-line"></div><div class="separator-icon"><i class="fas fa-industry"></i></div><div class="separator-line"></div></div>
                <p class="section-subtitle">نمتلك أحدث المرافق التصنيعية المجهزة بأفضل التقنيات العالمية</p>
            </div>

            <div class="facility-cards">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="facility-card">
                            <div class="facility-card-image">
                                <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=600&q=80" alt="مصنع الإنتاج">
                                <div class="facility-overlay">
                                    <div class="facility-stats">
                                        <div class="stat">
                                            <div class="stat-value">5000</div>
                                            <div class="stat-label">متر مربع</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-value">24/7</div>
                                            <div class="stat-label">تشغيل</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="facility-card-body">
                                <div class="facility-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <h3 class="facility-title">مصنع الإنتاج</h3>
                                <p class="facility-desc">مساحة 5000 متر مربع مجهزة بأحدث تقنيات التصنيع لإنتاج منتجات عالية الجودة.</p>
                                <ul class="facility-features">
                                    <li><i class="fas fa-check-circle"></i> خطوط إنتاج آلية</li>
                                    <li><i class="fas fa-check-circle"></i> معدات متطورة</li>
                                    <li><i class="fas fa-check-circle"></i> آلات حديثة</li>
                                </ul>
                            </div>
                            <div class="facility-card-shine"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="facility-card">
                            <div class="facility-card-image">
                                <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=600&q=80" alt="معامل البحث والتطوير">
                                <div class="facility-overlay">
                                    <div class="facility-stats">
                                        <div class="stat">
                                            <div class="stat-value">15</div>
                                            <div class="stat-label">مختبر</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-value">20+</div>
                                            <div class="stat-label">باحث</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="facility-card-body">
                                <div class="facility-icon">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <h3 class="facility-title">معامل البحث والتطوير</h3>
                                <p class="facility-desc">معامل مجهزة بأحدث التقنيات لتطوير منتجات مبتكرة تلبي احتياجات السوق المتغيرة.</p>
                                <ul class="facility-features">
                                    <li><i class="fas fa-check-circle"></i> أجهزة اختبار متطورة</li>
                                    <li><i class="fas fa-check-circle"></i> فريق بحثي مؤهل</li>
                                    <li><i class="fas fa-check-circle"></i> تطوير مستمر</li>
                                </ul>
                            </div>
                            <div class="facility-card-shine"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mx-auto" data-aos="fade-up" data-aos-delay="300">
                        <div class="facility-card">
                            <div class="facility-card-image">
                                <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=600&q=80" alt="ضمان الجودة">
                                <div class="facility-overlay">
                                    <div class="facility-stats">
                                        <div class="stat">
                                            <div class="stat-value">100%</div>
                                            <div class="stat-label">فحص</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-value">ISO</div>
                                            <div class="stat-label">معتمد</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="facility-card-body">
                                <div class="facility-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <h3 class="facility-title">ضمان الجودة</h3>
                                <p class="facility-desc">معامل متطورة لفحص واختبار جودة المنتجات للتأكد من مطابقتها لأعلى المعايير العالمية.</p>
                                <ul class="facility-features">
                                    <li><i class="fas fa-check-circle"></i> فحص دقيق</li>
                                    <li><i class="fas fa-check-circle"></i> مراقبة مستمرة</li>
                                    <li><i class="fas fa-check-circle"></i> ضمان الجودة</li>
                                </ul>
                            </div>
                            <div class="facility-card-shine"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Team -->
<section id="team" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 gradient-text">فريق الخبراء</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="team-member text-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Expert"
                         class="rounded-circle mb-4" width="180">
                    <h5>م. أحمد محمد</h5>
                    <p class="text-muted mb-3">مدير عام المصنع</p>
                    <div class="social-icons d-flex justify-content-center gap-3 mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team-member text-center">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Expert"
                         class="rounded-circle mb-4" width="180">
                    <h5>د. سارة أحمد</h5>
                    <p class="text-muted mb-3">مديرة البحث والتطوير</p>
                    <div class="social-icons d-flex justify-content-center gap-3 mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team-member text-center">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Expert"
                         class="rounded-circle mb-4" width="180">
                    <h5>م. محمد علي</h5>
                    <p class="text-muted mb-3">مدير الإنتاج</p>
                    <div class="social-icons d-flex justify-content-center gap-3 mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="team-member text-center">
                    <img src="https://randomuser.me/api/portraits/women/67.jpg" alt="Expert"
                         class="rounded-circle mb-4" width="180">
                    <h5>د. نورا محمود</h5>
                    <p class="text-muted mb-3">مديرة ضمان الجودة</p>
                    <div class="social-icons d-flex justify-content-center gap-3 mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Achievements -->
<section id="achievements" class="achievements-section py-5">
    <div class="container">
        <div class="achievements-wrapper position-relative">
            <!-- Decorative elements -->
            <div class="achievement-blob"></div>
            <div class="achievement-blob-2"></div>
            <div class="achievement-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">إنجازاتنا</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">مسيرة نجاح متواصلة</h2>
                <div class="title-separator"><div class="separator-line"></div><div class="separator-icon"><i class="fas fa-trophy"></i></div><div class="separator-line"></div></div>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="achievement-card-2025 h-100">
                        <div class="achievement-card-inner">
                            <div class="achievement-icon">
                                <div class="icon-backdrop"></div>
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="achievement-content">
                                <div class="achievement-value">
                                    <span class="counter">25</span><span class="plus">+</span>
                                </div>
                                <h3 class="achievement-title">سنوات الخبرة</h3>
                                <p class="achievement-desc">نصنع منتجات طب الأسنان منذ أكثر من 25 عاماً بتميز وإتقان</p>
                            </div>
                            <div class="achievement-decoration"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="achievement-card-2025 h-100">
                        <div class="achievement-card-inner">
                            <div class="achievement-icon">
                                <div class="icon-backdrop"></div>
                                <i class="fas fa-globe-americas"></i>
                            </div>
                            <div class="achievement-content">
                                <div class="achievement-value">
                                    <span class="counter">45</span><span class="plus">+</span>
                                </div>
                                <h3 class="achievement-title">دولة حول العالم</h3>
                                <p class="achievement-desc">نصدر منتجاتنا لأكثر من 45 دولة حول العالم بجودة عالية</p>
                            </div>
                            <div class="achievement-decoration"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="achievement-card-2025 h-100">
                        <div class="achievement-card-inner">
                            <div class="achievement-icon">
                                <div class="icon-backdrop"></div>
                                <i class="fas fa-teeth"></i>
                            </div>
                            <div class="achievement-content">
                                <div class="achievement-value">
                                    <span class="counter">150</span><span class="plus">+</span>
                                </div>
                                <h3 class="achievement-title">منتج مختلف</h3>
                                <p class="achievement-desc">تشكيلة واسعة من منتجات طب الأسنان المتطورة والمبتكرة</p>
                            </div>
                            <div class="achievement-decoration"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certifications -->
<section class="certifications-section py-5">
    <div class="container">
        <div class="certifications-wrapper position-relative">
            <!-- Decorative elements -->
            <div class="cert-shape-1"></div>
            <div class="cert-shape-2"></div>
            <div class="cert-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">الاعتماد الدولي</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">شهادات الجودة والاعتماد</h2>
                <div class="title-separator"><div class="separator-line"></div><div class="separator-icon"><i class="fas fa-certificate"></i></div><div class="separator-line"></div></div>
                <p class="section-subtitle">منتجاتنا معتمدة من أكبر الهيئات العالمية للجودة</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="certifications-grid">
                        <div class="certification-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="certification-icon">
                                <img src="https://img.icons8.com/ios-filled/100/26e07f/certificate.png" alt="ISO" width="70">
                                <div class="certification-glow"></div>
                            </div>
                            <div class="certification-content">
                                <h3 class="certification-title">ISO 13485</h3>
                                <p class="certification-desc">معيار دولي لأنظمة إدارة الجودة في الأجهزة الطبية</p>
                            </div>
                        </div>
                        <div class="certification-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="certification-icon">
                                <img src="https://img.icons8.com/ios-filled/100/26e07f/certificate.png" alt="CE" width="70">
                                <div class="certification-glow"></div>
                            </div>
                            <div class="certification-content">
                                <h3 class="certification-title">CE Mark</h3>
                                <p class="certification-desc">اعتماد أوروبي يؤكد التزامنا بمعايير السلامة والجودة</p>
                            </div>
                        </div>
                        <div class="certification-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="certification-icon">
                                <img src="https://img.icons8.com/ios-filled/100/26e07f/certificate.png" alt="FDA" width="70">
                                <div class="certification-glow"></div>
                            </div>
                            <div class="certification-content">
                                <h3 class="certification-title">FDA Approved</h3>
                                <p class="certification-desc">معتمد من هيئة الغذاء والدواء الأمريكية</p>
                            </div>
                        </div>
                        <div class="certification-card" data-aos="fade-up" data-aos-delay="400">
                            <div class="certification-icon">
                                <img src="https://img.icons8.com/ios-filled/100/26e07f/certificate.png" alt="GMP" width="70">
                                <div class="certification-glow"></div>
                            </div>
                            <div class="certification-content">
                                <h3 class="certification-title">GMP Certified</h3>
                                <p class="certification-desc">معتمد وفقاً لممارسات التصنيع الجيدة العالمية</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section-2025 py-5">
    <div class="container">
        <div class="cta-wrapper-2025 position-relative">
            <!-- Decorative elements -->
            <div class="cta-blob-1"></div>
            <div class="cta-blob-2"></div>
            <div class="cta-dots"></div>

            <div class="cta-card-2025" data-aos="fade-up">
                <div class="cta-card-inner">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="cta-content-2025">
                                <span class="cta-badge">هل لديك استفسار؟</span>
                                <h2 class="cta-title-2025">هل تبحث عن منتجات طب أسنان عالية الجودة؟</h2>
                                <p class="cta-desc">فريقنا من الخبراء جاهز لمساعدتك على اختيار المنتجات المناسبة لاحتياجات عيادتك</p>
                                <ul class="cta-features">
                                    <li><i class="fas fa-check-circle"></i> منتجات حاصلة على شهادات الجودة العالمية</li>
                                    <li><i class="fas fa-check-circle"></i> دعم فني متكامل</li>
                                    <li><i class="fas fa-check-circle"></i> شحن لجميع أنحاء العالم</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cta-action-2025">
                                <div class="cta-icon">
                                    <div class="cta-icon-pulse"></div>
                                    <i class="fas fa-headset"></i>
                                </div>
                                <a href="{{ route('contact') }}" class="btn-cta-2025">
                                    <span class="btn-text">تواصل معنا</span>
                                    <div class="btn-icon">
                                        <i class="fas fa-arrow-left" ></i>
                                    </div>
                                    <div class="btn-shine"></div>
                                </a>
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
    // Timeline interaction
    const timelinePoints = document.querySelectorAll('.timeline-point');
    const timelineProgress = document.querySelector('.timeline-progress');

    timelinePoints.forEach((point, index) => {
        point.addEventListener('mouseenter', function() {
            // Update active state
            timelinePoints.forEach(p => p.classList.remove('active'));
            this.classList.add('active');

            // Update progress bar
            if (timelineProgress) {
                const progressWidth = ((index + 1) / timelinePoints.length) * 100;
                timelineProgress.style.setProperty('--progress-width', progressWidth + '%');
            }
        });
    });

    // Animate counting for digit counters
    const digitCounter = document.querySelector('.digit-counter');
    if (digitCounter) {
        const targetValue = parseInt(digitCounter.textContent);
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
            digitCounter.textContent = currentValue;
        }, interval);
    }

    // Apply entry animations with slight delays
    setTimeout(() => {
        const animateCSS = (element, animation, prefix = 'animate__') =>
            new Promise((resolve, reject) => {
                const node = document.querySelector(element);
                if (!node) {
                    reject('Element not found');
                    return;
                }

                node.classList.add(`${prefix}animated`, `${prefix}${animation}`);

                function handleAnimationEnd(event) {
                    event.stopPropagation();
                    node.classList.remove(`${prefix}animated`, `${prefix}${animation}`);
                    resolve('Animation ended');
                }

                node.addEventListener('animationend', handleAnimationEnd, {once: true});
            });

        // Floating elements hover effects
        const floatingElements = document.querySelectorAll('.about-floating-element');
        floatingElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.animationPlayState = 'paused';
            });

            element.addEventListener('mouseleave', function() {
                this.style.animationPlayState = 'running';
            });
        });

        // Story image container 3D effect
        const storyImageContainer = document.querySelector('.story-image-container');
        if (storyImageContainer) {
            storyImageContainer.addEventListener('mousemove', function(e) {
                const { left, top, width, height } = this.getBoundingClientRect();
                const x = (e.clientX - left) / width;
                const y = (e.clientY - top) / height;

                const rotateY = 10 * (0.5 - x);
                const rotateX = 10 * (y - 0.5);

                this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });

            storyImageContainer.addEventListener('mouseleave', function() {
                this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
            });
        }

        // Feature item interaction
        const featureItems = document.querySelectorAll('.story-feature-item');
        featureItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }, 300);
</script>
@endsection
