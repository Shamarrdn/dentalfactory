@extends('layouts.dental')

@section('title', 'البحث والتطوير والابتكار - مصنع جينودينت')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/research-development.css') }}?t={{ time() }}">
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <h1 class="hero-bg-title mb-4">البحث والتطوير والابتكار</h1>
        <p class="hero-bg-desc mb-4">
            R&D & Innovation - نحو مستقبل أكثر إشراقاً في مجال صناعة مواد طب الأسنان
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#innovation-vision" class="hero-bg-btn main-btn">رؤيتنا في الابتكار</a>
            <a href="#research-areas" class="hero-bg-btn ghost-btn">مجالات البحث</a>
        </div>
    </div>
</section>

<!-- Innovation Vision Section -->
<section id="innovation-vision" class="rd-vision-section py-5">
    <div class="container">
        <div class="rd-section-wrapper position-relative">
            <div class="rd-shape-1"></div>
            <div class="rd-shape-2"></div>
            <div class="rd-pattern"></div>

            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="rd-vision-image-container">
                        <img src="{{ asset('assets/images/research-innovation-vision.jpg') }}" 
                             alt="رؤية الابتكار في جينودينت" class="rd-vision-image"
                             onerror="this.src='https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?auto=format&fit=crop&w=600&q=80'">
                        <div class="rd-vision-badge">
                            <div class="rd-badge-inner">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="rd-vision-content">
                        <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">رؤيتنا في الابتكار</span>
                        <h2 class="section-title gradient-text mb-4">الابتكار جوهر التميز الصناعي</h2>
                        <p class="rd-vision-text">
                            في "جينودينت"، نؤمن أن الابتكار هو جوهر التميز الصناعي والطبي. نعمل على تطوير مواد طب الأسنان التي تجمع بين الأداء العالي، الأمان، والتوافق مع أحدث التقنيات العالمية، بما يواكب تطلعات السوق السعودي والإقليمي.
                        </p>
                        <div class="rd-vision-stats">
                            <div class="rd-stat-item">
                                <div class="rd-stat-number">30%</div>
                                <div class="rd-stat-label">تقليل زمن المعالجة</div>
                            </div>
                            <div class="rd-stat-item">
                                <div class="rd-stat-number">25%</div>
                                <div class="rd-stat-label">تحسين خصائص الالتصاق</div>
                            </div>
                            <div class="rd-stat-item">
                                <div class="rd-stat-number">90%</div>
                                <div class="rd-stat-label">رضا العملاء</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Research Areas Section -->
<section id="research-areas" class="rd-areas-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title gradient-text">مجالات البحث والتطوير</h2>
            <p class="section-subtitle">نركز جهودنا البحثية على المجالات الأكثر تأثيراً في تطوير صناعة مواد طب الأسنان</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="rd-area-card">
                    <div class="rd-area-icon">
                        <i class="fas fa-tooth"></i>
                    </div>
                    <h3 class="rd-area-title">مواد الترميم المتقدمة</h3>
                    <p class="rd-area-desc">تحسين تركيبات مواد الترميم المباشر وغير المباشر لرفع الكفاءة السريرية</p>
                    <div class="rd-area-features">
                        <span class="rd-feature-tag">الكفاءة السريرية</span>
                        <span class="rd-feature-tag">المتانة</span>
                        <span class="rd-feature-tag">الجماليات</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="rd-area-card">
                    <div class="rd-area-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="rd-area-title">المواد الوقائية والمضادة للعدوى</h3>
                    <p class="rd-area-desc">تطوير مواد وقائية ومضادة للعدوى تتماشى مع المعايير البيئية والصحية</p>
                    <div class="rd-area-features">
                        <span class="rd-feature-tag">مضاد للبكتيريا</span>
                        <span class="rd-feature-tag">صديق للبيئة</span>
                        <span class="rd-feature-tag">آمن صحياً</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="rd-area-card">
                    <div class="rd-area-icon">
                        <i class="fas fa-digital-tachograph"></i>
                    </div>
                    <h3 class="rd-area-title">الحلول الرقمية والمخبرية</h3>
                    <p class="rd-area-desc">تصميم حلول رقمية ومخبرية مبتكرة تشمل مواد الانطباعات والكواشف الحيوية</p>
                    <div class="rd-area-features">
                        <span class="rd-feature-tag">التقنيات الرقمية</span>
                        <span class="rd-feature-tag">الكواشف الحيوية</span>
                        <span class="rd-feature-tag">الدقة العالية</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                <div class="rd-area-card">
                    <div class="rd-area-icon">
                        <i class="fas fa-cube"></i>
                    </div>
                    <h3 class="rd-area-title">التقنيات المتقدمة</h3>
                    <p class="rd-area-desc">توطين تقنيات التصنيع المتقدمة مثل الطباعة ثلاثية الأبعاد والذكاء الاصطناعي</p>
                    <div class="rd-area-features">
                        <span class="rd-feature-tag">الطباعة 3D</span>
                        <span class="rd-feature-tag">الذكاء الاصطناعي</span>
                        <span class="rd-feature-tag">مراقبة الجودة</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Current Projects Section -->
<section class="rd-projects-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">مشاريعنا الحالية</span>
            <h2 class="section-title gradient-text">مشاريعنا البحثية الحالية</h2>
            <p class="section-subtitle">نعمل حالياً على عدة مشاريع بحثية طموحة ستحدث نقلة نوعية في صناعة مواد طب الأسنان</p>
        </div>

        <div class="rd-projects-timeline">
            <div class="rd-project-item" data-aos="fade-right" data-aos-delay="100">
                <div class="rd-project-number">01</div>
                <div class="rd-project-content">
                    <h3 class="rd-project-title">مادة الترميم الهجينة</h3>
                    <p class="rd-project-desc">
                        مشروع تطوير مادة ترميم هجينة عالية الالتصاق بالتعاون مع مختبرات جامعية سعودية.
                    </p>
                    <div class="rd-project-status">
                        <span class="status-badge in-progress">قيد التطوير</span>
                        <span class="status-progress">75%</span>
                    </div>
                </div>
            </div>

            <div class="rd-project-item" data-aos="fade-left" data-aos-delay="200">
                <div class="rd-project-number">02</div>
                <div class="rd-project-content">
                    <h3 class="rd-project-title">دراسة سريرية للمواد الوقائية</h3>
                    <p class="rd-project-desc">
                        دراسة سريرية لتقييم فعالية مادة وقائية مضادة للبكتيريا في بيئات متعددة.
                    </p>
                    <div class="rd-project-status">
                        <span class="status-badge testing">مرحلة الاختبار</span>
                        <span class="status-progress">60%</span>
                    </div>
                </div>
            </div>

            <div class="rd-project-item" data-aos="fade-right" data-aos-delay="300">
                <div class="rd-project-number">03</div>
                <div class="rd-project-content">
                    <h3 class="rd-project-title">كاشف مخبري سريع</h3>
                    <p class="rd-project-desc">
                        تطوير نموذج أولي لكاشف مخبري سريع لقياس خصائص اللعاب الحيوية.
                    </p>
                    <div class="rd-project-status">
                        <span class="status-badge planning">مرحلة التخطيط</span>
                        <span class="status-progress">35%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partnerships Section -->
<section class="rd-partnerships-section py-5">
    <div class="container">
        <div class="rd-partnerships-wrapper position-relative">
            <div class="rd-shape-1"></div>
            <div class="rd-shape-2"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">شراكاتنا الاستراتيجية</span>
                <h2 class="section-title gradient-text">شراكاتنا البحثية</h2>
                <p class="section-subtitle">نتعاون مع أفضل المؤسسات الأكاديمية والبحثية لضمان التميز والابتكار</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="rd-partnership-card">
                        <div class="rd-partnership-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <h3 class="rd-partnership-title">الجامعات السعودية</h3>
                        <p class="rd-partnership-desc">
                            تعاون مع جامعات سعودية رائدة في مجالات علوم المواد وطب الأسنان
                        </p>
                        <ul class="rd-partnership-list">
                            <li>جامعة الملك سعود</li>
                            <li>جامعة الملك عبدالعزيز</li>
                            <li>جامعة الإمام عبدالرحمن</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="rd-partnership-card">
                        <div class="rd-partnership-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="rd-partnership-title">المراكز البحثية الدولية</h3>
                        <p class="rd-partnership-desc">
                            شراكات مع مراكز بحثية دولية لنقل التقنية وتبادل المعرفة
                        </p>
                        <ul class="rd-partnership-list">
                            <li>نقل التقنية المتقدمة</li>
                            <li>تبادل الخبرات العالمية</li>
                            <li>برامج التدريب المشتركة</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="rd-partnership-card">
                        <div class="rd-partnership-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="rd-partnership-title">الشركات الناشئة</h3>
                        <p class="rd-partnership-desc">
                            تعاون مع شركات ناشئة في مجال التكنولوجيا الحيوية والذكاء الاصطناعي
                        </p>
                        <ul class="rd-partnership-list">
                            <li>التكنولوجيا الحيوية</li>
                            <li>الذكاء الاصطناعي</li>
                            <li>الحلول المبتكرة</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Innovation Platform Section -->
<section class="rd-innovation-platform-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="rd-platform-content">
                    <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">منصة الابتكار الداخلي</span>
                    <h2 class="section-title gradient-text mb-4">مبادرة "جينودينت للابتكار"</h2>
                    <p class="rd-platform-text">
                        أطلقنا مبادرة "جينودينت للابتكار" لتشجيع موظفينا على تقديم أفكار تطويرية، وتحويلها إلى نماذج قابلة للتطبيق، مع تخصيص جوائز سنوية لأفضل الابتكارات الصناعية.
                    </p>
                    <div class="rd-platform-features">
                        <div class="rd-platform-feature">
                            <i class="fas fa-lightbulb"></i>
                            <span>تشجيع الأفكار المبتكرة</span>
                        </div>
                        <div class="rd-platform-feature">
                            <i class="fas fa-cogs"></i>
                            <span>تحويل الأفكار إلى نماذج</span>
                        </div>
                        <div class="rd-platform-feature">
                            <i class="fas fa-trophy"></i>
                            <span>جوائز سنوية للابتكار</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="rd-platform-visual">
                    <div class="rd-innovation-circle">
                        <div class="rd-circle-center">
                            <i class="fas fa-atom"></i>
                        </div>
                        <div class="rd-orbit rd-orbit-1">
                            <div class="rd-orbit-item">
                                <i class="fas fa-brain"></i>
                            </div>
                        </div>
                        <div class="rd-orbit rd-orbit-2">
                            <div class="rd-orbit-item">
                                <i class="fas fa-flask"></i>
                            </div>
                        </div>
                        <div class="rd-orbit rd-orbit-3">
                            <div class="rd-orbit-item">
                                <i class="fas fa-microscope"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Innovation Section -->
<section class="rd-contact-section py-5">
    <div class="container">
        <div class="rd-contact-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="rd-contact-content">
                        <h2 class="rd-contact-title">هل لديك فكرة مبتكرة؟</h2>
                        <p class="rd-contact-desc">
                            نرحب بالأفكار والمقترحات من الباحثين، الأطباء، والمهندسين. 
                            شاركنا أفكارك وكن جزءاً من مستقبل صناعة مواد طب الأسنان.
                        </p>
                        <div class="rd-contact-info">
                            <div class="rd-contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>innovation@genodent.sa</span>
                            </div>
                            <div class="rd-contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+966 17 XXX XXXX</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="rd-contact-cta">
                        <a href="{{ route('contact') }}" class="rd-contact-btn">
                            <span>تواصل معنا</span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
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
    // Animate statistics counters
    const statNumbers = document.querySelectorAll('.rd-stat-number');
    statNumbers.forEach(stat => {
        const target = parseInt(stat.textContent);
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.round(current) + '%';
        }, 20);
    });

    // Project progress animation
    const progressBars = document.querySelectorAll('.status-progress');
    progressBars.forEach(bar => {
        const progress = parseInt(bar.textContent);
        bar.style.setProperty('--progress', progress + '%');
    });

    // Innovation orbit animation
    const orbits = document.querySelectorAll('.rd-orbit');
    orbits.forEach((orbit, index) => {
        orbit.style.animationDelay = (index * 0.5) + 's';
    });
});
</script>
@endsection
