
@extends('layouts.dental')

@section('title', 'من نحن - مصنع جينودينت')

@section('styles')
<link rel="stylesheet" href="{{ asset(path: 'assets/css/dental-css/about.css') }}?t={{ time() }}">

@endsection

@section('content')
<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <h1 class="hero-bg-title mb-4">من نحن</h1>
        <p class="hero-bg-desc mb-4">
            مصنع سعودي متخصص في إنتاج مواد طب الأسنان الأساسية، يقع في منطقة عسير ويستهدف تلبية الطلب المحلي المتزايد
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#about" class="hero-bg-btn main-btn">تعرف علينا</a>
            <a href="#story" class="hero-bg-btn ghost-btn">قصتنا</a>
        </div>
    </div>
</section>

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
                                <h6>خبرة متميزة</h6>
                                <p>جودة عالية</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="story-content-wrapper">
                    <h2 class="story-title gradient-text">قصتنا</h2>
                    <p class="story-lead">"جينودينت" هو مصنع سعودي متخصص في إنتاج مواد طب الأسنان الأساسية، يقع في منطقة عسير، ويستهدف تلبية الطلب المحلي المتزايد على منتجات الترميم، الوقاية، ومكافحة العدوى، بجودة عالية وأسعار تنافسية.</p>
                    <p class="story-text">يوفر المصنع تشكيلة واسعة تشمل الترميم المباشر وغير المباشر، ومنتجات الوقاية، المختبر، والانطباعات الرقمية. ينطلق المشروع من رؤية استراتيجية ترتكز على الابتكار والتطوير المستدام، ويستفيد من البيئة الاقتصادية والصناعية المستقرة في المملكة، حيث يشهد الناتج المحلي الإجمالي نمواً إيجابياً، ومعدلات التضخم والبطالة ضمن مستويات آمنة ومحفزة للاستثمار.</p>
                    <p class="story-text">كما يستند المشروع إلى مستهدفات الاستراتيجية الوطنية للصناعة التي تهدف إلى مضاعفة مساهمة الصناعة في الناتج المحلي، وزيادة عدد المصانع إلى 36 ألف مصنع بحلول 2035، واستحداث أكثر من 3.2 مليون وظيفة صناعية. ويأتي قطاع الصناعات الطبية في قلب هذه الاستراتيجية، حيث ارتفع عدد مصانع الأجهزة الطبية بنسبة 200% منذ 2018، مما يعزز من فرص نجاح "جينودينت" كمشروع صناعي طبي واعد في منطقة ذات إمكانات نمو كبيرة.</p>

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


<section class="vision-mission-section py-5">
    <div class="container">
        <div class="vm-wrapper position-relative">

            <div class="vm-shape-1"></div>
            <div class="vm-shape-2"></div>
            <div class="vm-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">فلسفتنا</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">رؤيتنا ورسالتنا</h2>
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
                        <p class="vision-desc">أن نكون الشريك الرائد في صناعة مواد طب الأسنان بالمملكة بحلول عام 2030، مع توسيع بصمتنا الإقليمية والعالمية عبر الابتكار التقني والتطوير المستدام.</p>
                        <div class="vision-features">
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>الابتكار التقني</span>
                            </div>
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>التطوير المستدام</span>
                            </div>
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>التوسع الإقليمي</span>
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
                        <p class="mission-desc">نسعى في "جينودينت" إلى تصنيع وتوفير مواد طب الأسنان بمعايير جودة عالمية وأسعار تنافسية، مساهمين في تعزيز الاكتفاء الذاتي للمملكة ودعم قطاع الرعاية الصحية محلياً وإقليمياً بما يواكب تطلعات رؤية السعودية 2030.</p>
                        <div class="mission-features">
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>الاكتفاء الذاتي</span>
                            </div>
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>رؤية السعودية 2030</span>
                            </div>
                            <div class="feature">
                                <div class="feature-dot"></div>
                                <span>الجودة العالمية</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="strategic-goals-section py-5">
    <div class="container">
        <div class="goals-wrapper position-relative">
            <div class="vm-shape-1"></div>
            <div class="vm-shape-2"></div>
            <div class="vm-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">استراتيجيتنا</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">الأهداف الاستراتيجية</h2>
                <p class="section-subtitle">أهدافنا الاستراتيجية التي نسعى لتحقيقها لضمان الريادة والنمو المستدام</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="goal-card h-100">
                        <div class="goal-icon">
                            <div class="icon-backdrop"></div>
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="goal-title">العوائد المالية المستدامة</h3>
                        <p class="goal-desc">ضمان عوائد مالية مستدامة تعزز استمرارية وتوسّع المصنع</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="goal-card h-100">
                        <div class="goal-icon">
                            <div class="icon-backdrop"></div>
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3 class="goal-title">تطوير تقنيات الإنتاج</h3>
                        <p class="goal-desc">تطوير تقنيات إنتاج حديثة لرفع الجودة والكفاءة</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="goal-card h-100">
                        <div class="goal-icon">
                            <div class="icon-backdrop"></div>
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="goal-title">دعم الاقتصاد المحلي</h3>
                        <p class="goal-desc">دعم الاقتصاد المحلي عبر خلق فرص عمل وتعزيز الإنتاجية</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="goal-card h-100">
                        <div class="goal-icon">
                            <div class="icon-backdrop"></div>
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="goal-title">الممارسات البيئية المسؤولة</h3>
                        <p class="goal-desc">الالتزام بممارسات بيئية مسؤولة تحقق الاستدامة</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="goal-card h-100">
                        <div class="goal-icon">
                            <div class="icon-backdrop"></div>
                            <i class="fas fa-expand-arrows-alt"></i>
                        </div>
                        <h3 class="goal-title">تحسين الكفاءة التشغيلية</h3>
                        <p class="goal-desc">تلبية الطلب المتنامي عبر تحسين الكفاءة التشغيلية وتوسيع الطاقة الإنتاجية</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="goal-card h-100">
                        <div class="goal-icon">
                            <div class="icon-backdrop"></div>
                            <i class="fas fa-star"></i>
                        </div>
                        <h3 class="goal-title">ترسيخ السمعة</h3>
                        <p class="goal-desc">ترسيخ سمعة "جينودينت" كعلامة تجارية موثوقة في السوق الطبي</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="company-values-section py-5">
    <div class="container">
        <div class="values-wrapper position-relative">
            <div class="cert-shape-1"></div>
            <div class="cert-shape-2"></div>
            <div class="cert-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">قيمنا الأساسية</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">القيم التي نؤمن بها</h2>
                <p class="section-subtitle">القيم الأساسية التي تحكم عملنا وتوجه قراراتنا الاستراتيجية</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="values-grid">
                        <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="value-icon">
                                <i class="fas fa-award"></i>
                                <div class="value-glow"></div>
                            </div>
                            <div class="value-content">
                                <h3 class="value-title">الجودة والاعتمادية</h3>
                                <p class="value-desc">نلتزم بأعلى معايير التصنيع والاعتماد</p>
                            </div>
                        </div>

                        <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="value-icon">
                                <i class="fas fa-lightbulb"></i>
                                <div class="value-glow"></div>
                            </div>
                            <div class="value-content">
                                <h3 class="value-title">الابتكار المستمر</h3>
                                <p class="value-desc">نطوّر تقنياتنا لتلبية احتياجات السوق المتغيرة</p>
                            </div>
                        </div>

                        <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="value-icon">
                                <i class="fas fa-recycle"></i>
                                <div class="value-glow"></div>
                            </div>
                            <div class="value-content">
                                <h3 class="value-title">الاستدامة البيئية</h3>
                                <p class="value-desc">نحرص على تقليل الأثر البيئي</p>
                            </div>
                        </div>

                        <div class="value-card" data-aos="fade-up" data-aos-delay="400">
                            <div class="value-icon">
                                <i class="fas fa-handshake"></i>
                                <div class="value-glow"></div>
                            </div>
                            <div class="value-content">
                                <h3 class="value-title">المسؤولية المجتمعية</h3>
                                <p class="value-desc">نوظف ونطوّر الكفاءات المحلية</p>
                            </div>
                        </div>

                        <div class="value-card" data-aos="fade-up" data-aos-delay="500">
                            <div class="value-icon">
                                <i class="fas fa-eye"></i>
                                <div class="value-glow"></div>
                            </div>
                            <div class="value-content">
                                <h3 class="value-title">الشفافية والأخلاق</h3>
                                <p class="value-desc">نعمل بنزاهة مع شركائنا وعملائنا</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="achievements-roadmap-section py-5">
    <div class="container">
        <div class="roadmap-wrapper position-relative">
            <div class="vm-shape-1"></div>
            <div class="vm-shape-2"></div>
            <div class="vm-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">خريطة الطريق</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">الإنجازات المتوقعة</h2>
                <p class="section-subtitle">رؤيتنا المستقبلية والإنجازات التي نسعى لتحقيقها على المدى القصير والمتوسط والطويل</p>
            </div>

            <!-- Timeline -->
            <div class="achievements-timeline">
                <!-- Short Term - السنة الأولى والثانية -->
                <div class="timeline-period short-term" data-aos="fade-up" data-aos-delay="100">
                    <div class="period-header">
                        <div class="period-icon short-term">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="period-title">على المدى القصير</h3>
                        <p class="period-subtitle">السنة الأولى – الثانية</p>
                    </div>
                    
                    <div class="achievements-list">
                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="200">
                            <div class="achievement-icon">
                                <i class="fas fa-industry"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>تشغيل المصنع بكامل طاقته الإنتاجية</h4>
                                <p>وفقاً للمعايير السعودية والدولية (SFDA، ISO، CE، FDA)</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="250">
                            <div class="achievement-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>الحصول على التراخيص والاعتمادات</h4>
                                <p>التراخيص التنظيمية اللازمة لتسويق المنتجات داخل المملكة</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="300">
                            <div class="achievement-icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>إطلاق أول مجموعة منتجات رسمية</h4>
                                <p>تشمل الترميم المباشر، الوقاية، ومكافحة العدوى</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="350">
                            <div class="achievement-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>توقيع عقود توريد استراتيجية</h4>
                                <p>مع مستشفيات وعيادات سعودية، بما في ذلك شراكة مع شركة نبكو</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="400">
                            <div class="achievement-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>توظيف وتدريب الكوادر المحلية</h4>
                                <p>بنسبة لا تقل عن 60% من إجمالي القوى العاملة</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="450">
                            <div class="achievement-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>المشاركة في المعارض الدولية</h4>
                                <p>معرض سعودي دولي للصناعات الطبية لعرض المنتجات وبناء شبكة علاقات</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medium Term - السنة الثالثة والرابعة -->
                <div class="timeline-period medium-term" data-aos="fade-up" data-aos-delay="500">
                    <div class="period-header">
                        <div class="period-icon medium-term">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="period-title">على المدى المتوسط</h3>
                        <p class="period-subtitle">السنة الثالثة – الرابعة</p>
                    </div>
                    
                    <div class="achievements-list">
                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="600">
                            <div class="achievement-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>الحصول على اعتماد دولي للمنتجات</h4>
                                <p>(مثل CE أو FDA) لفتح باب التصدير</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="650">
                            <div class="achievement-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>دخول الأسواق الخليجية والإقليمية</h4>
                                <p>عبر وكلاء توزيع أو فروع مباشرة</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="700">
                            <div class="achievement-icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>إضافة خطوط إنتاج رقمية ومختبرية</h4>
                                <p>تشمل مواد الانطباعات والكواشف المخبرية</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="750">
                            <div class="achievement-icon">
                                <i class="fas fa-trending-up"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>تحقيق نمو سنوي في الإيرادات</h4>
                                <p>بنسبة 15–20% مدفوعاً بتوسع السوق</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="800">
                            <div class="achievement-icon">
                                <i class="fas fa-expand"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>توسيع الطاقة الإنتاجية</h4>
                                <p>بنسبة 50% لتلبية الطلب المتزايد</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="850">
                            <div class="achievement-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>إطلاق مبادرة "جينودينت للابتكار"</h4>
                                <p>لدعم البحث والتطوير في المواد الطبية</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Long Term - السنة الخامسة وما بعدها -->
                <div class="timeline-period long-term" data-aos="fade-up" data-aos-delay="900">
                    <div class="period-header">
                        <div class="period-icon long-term">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h3 class="period-title">على المدى الطويل</h3>
                        <p class="period-subtitle">السنة الخامسة وما بعدها</p>
                    </div>
                    
                    <div class="achievements-list">
                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="1000">
                            <div class="achievement-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>تحقيق حصة سوقية تتجاوز 10%</h4>
                                <p>من سوق مواد طب الأسنان في المملكة</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="1050">
                            <div class="achievement-icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>تصدير المنتجات إلى أكثر من 10 دول</h4>
                                <p>في الشرق الأوسط وشمال إفريقيا</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="1100">
                            <div class="achievement-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>الحصول على جائزة وطنية أو دولية</h4>
                                <p>في الابتكار الصناعي أو التصنيع الطبي</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="1150">
                            <div class="achievement-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>المساهمة في توطين 80%</h4>
                                <p>من احتياجات القطاع الحكومي من مواد طب الأسنان</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="1200">
                            <div class="achievement-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>إنشاء مركز تدريب صناعي متخصص</h4>
                                <p>في عسير لتأهيل الكفاءات السعودية في التصنيع الطبي</p>
                            </div>
                        </div>

                        <div class="achievement-item" data-aos="fade-right" data-aos-delay="1250">
                            <div class="achievement-icon">
                                <i class="fas fa-flag"></i>
                            </div>
                            <div class="achievement-content">
                                <h4>إدراج جينودينت ضمن قائمة "صنع في السعودية"</h4>
                                <p>و"تقنية سعودية" كعلامة وطنية رائدة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="facility-section-2025 py-5">
    <div class="container">
        <div class="facility-wrapper position-relative">
            <div class="facility-shape-1"></div>
            <div class="facility-shape-2"></div>
            <div class="facility-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">البنية التحتية</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">مرافق التصنيع المتطورة</h2>
                <p class="section-subtitle">نمتلك أحدث المرافق التصنيعية المجهزة وفقًا لأعلى المعايير العالمية لضمان جودة المنتجات وسلامتها</p>
            </div>

            <div class="facility-cards">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="facility-card">
                            <div class="facility-card-image">
                                <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=600&q=80" alt="خطوط الإنتاج">
                                <div class="facility-overlay">
                                    <div class="facility-stats">
                                        <div class="stat">
                                            <div class="stat-value">100%</div>
                                            <div class="stat-label">أوتوماتيكية</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-value">GMP</div>
                                            <div class="stat-label">متوافق</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="facility-card-body">
                                <div class="facility-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <h3 class="facility-title">خطوط الإنتاج الأوتوماتيكية</h3>
                                <p class="facility-desc">خطوط إنتاج أوتوماتيكية دقيقة مصممة وفق أحدث التقنيات العالمية لضمان الكفاءة والجودة.</p>
                                <ul class="facility-features">
                                    <li><i class="fas fa-check-circle"></i> دقة عالية في التصنيع</li>
                                    <li><i class="fas fa-check-circle"></i> أنظمة مراقبة متكاملة</li>
                                    <li><i class="fas fa-check-circle"></i> كفاءة إنتاجية متميزة</li>
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



<section class="certifications-section py-5">
    <div class="container">
        <div class="certifications-wrapper position-relative">
            <div class="cert-shape-1"></div>
            <div class="cert-shape-2"></div>
            <div class="cert-pattern"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">الاعتماد الدولي</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">شهادات الجودة والاعتماد</h2>
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

<section class="cta-section-2025 py-5">
    <div class="container">
        <div class="cta-wrapper-2025 position-relative">
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
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cta-action-2025">
                                <div class="cta-icon">
                                    <img src="{{ asset('logo.png') }}" alt="جينودينت" style="width: 50px; height: 50px; object-fit: contain;">
                                </div>
                                <a href="{{ route('contact') }}" class="btn-cta-2025">
                                    <span class="btn-text">تواصل معنا</span>
                                    <div class="btn-icon">
                                        <i class="fas fa-arrow-left" style="color: white !important;"></i>
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
    const timelinePoints = document.querySelectorAll('.timeline-point');
    const timelineProgress = document.querySelector('.timeline-progress');

    timelinePoints.forEach((point, index) => {
        point.addEventListener('mouseenter', function() {
            timelinePoints.forEach(p => p.classList.remove('active'));
            this.classList.add('active');

            if (timelineProgress) {
                const progressWidth = ((index + 1) / timelinePoints.length) * 100;
                timelineProgress.style.setProperty('--progress-width', progressWidth + '%');
            }
        });
    });

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

        const floatingElements = document.querySelectorAll('.about-floating-element');
        floatingElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.animationPlayState = 'paused';
            });

            element.addEventListener('mouseleave', function() {
                this.style.animationPlayState = 'running';
            });
        });

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

