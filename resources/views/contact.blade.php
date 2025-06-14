@extends('layouts.dental')

@section('title', 'مصنع منتجات الأسنان - اتصل بنا')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/contact.css') }}?t={{ time() }}">

@endsection

@section('content')
<!-- Hero Section -->
<section class="contact-hero-section">
    <!-- Modern 3D Shapes Animation -->
    <div class="contact-hero-shapes">
        <div class="contact-shape contact-shape-1"></div>
        <div class="contact-shape contact-shape-2"></div>
        <div class="contact-shape contact-shape-3"></div>
        <div class="contact-shape contact-shape-4"></div>
        <div class="contact-shape contact-shape-5"></div>
        <div class="contact-shape contact-shape-6"></div>
    </div>

    <div class="container">
        <div class="row align-items-center contact-hero-row">
            <div class="col-lg-6 contact-hero-content-wrapper">
                <div class="contact-hero-content" data-aos="fade-right">
                    <span class="contact-hero-badge">تواصل معنا بسهولة</span>
                    <h1 class="contact-hero-title">
                        نحن نهتم <span class="gradient-text">بآرائكم</span>
                        <br>
                        ونلبي <span class="gradient-text">احتياجاتكم</span>
                    </h1>
                    <p class="contact-hero-description">فريقنا المتخصص جاهز للإجابة على استفساراتكم وتقديم حلول متكاملة لجميع منتجات طب الأسنان بجودة عالية ودقة متناهية</p>

                    <div class="contact-action-buttons">
                        <a href="#contact-form" class="contact-primary-btn">
                            <span>أرسل رسالة</span>
                            <i class="fas fa-paper-plane"></i>
                        </a>
                        <a href="tel:+966112345678" class="contact-secondary-btn">
                            <span>اتصل بنا</span>
                            <i class="fas fa-phone-alt"></i>
                        </a>
                    </div>

                    <div class="contact-hero-stats">
                        <div class="contact-stat-item">
                            <div class="contact-stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-stat-content">
                                <div class="contact-stat-number">24/7</div>
                                <div class="contact-stat-label">دعم فني متواصل</div>
                            </div>
                        </div>
                        <div class="contact-stat-item">
                            <div class="contact-stat-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="contact-stat-content">
                                <div class="contact-stat-number">24</div>
                                <div class="contact-stat-label">ساعة للرد</div>
                            </div>
                        </div>
                        <div class="contact-stat-item">
                            <div class="contact-stat-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="contact-stat-content">
                                <div class="contact-stat-number">45+</div>
                                <div class="contact-stat-label">دولة نخدمها</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 contact-hero-image-wrapper">
                <div class="contact-hero-image-container">
                    <div class="contact-hero-image">
                        <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&q=80" alt="اتصل بنا" class="contact-main-image">

                        <div class="contact-floating-badge contact-badge-phone">
                            <div class="contact-badge-icon">
                                <i class="fas fa-phone-alt" style="color: #26e07f; font-size: 24px;"></i>
                            </div>
                            <span>اتصل بنا مباشرة</span>
                        </div>

                        <div class="contact-floating-badge contact-badge-email">
                            <div class="contact-badge-icon">
                                <i class="fas fa-envelope" style="color: #26e07f; font-size: 24px;"></i>
                            </div>
                            <span>راسلنا الآن</span>
                        </div>

                        <div class="contact-floating-badge contact-badge-chat">
                            <div class="contact-badge-icon">
                                <i class="fas fa-comments" style="color: #26e07f; font-size: 24px;"></i>
                            </div>
                            <span>محادثة فورية</span>
                        </div>
                    </div>
                    <div class="contact-image-blob"></div>
                    <div class="contact-image-circle"></div>
                    <div class="contact-image-dots"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information Section -->
<section class="contact-info-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">معلومات الاتصال</span>
            <h2 class="gradient-text">طرق التواصل معنا</h2>
            <p>تواصل معنا عبر أي من الطرق التالية وسنكون سعداء لخدمتك</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card h-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>عنواننا</h4>
                    <p>123 شارع الصناعة، المنطقة الصناعية<br>الرياض، المملكة العربية السعودية</p>
                    <a href="#" class="contact-info-link">
                        <span>عرض على الخريطة</span>
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card h-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4>اتصل بنا</h4>
                    <p>+966 11 234 5678<br>+966 50 123 4567</p>
                    <a href="tel:+966112345678" class="contact-info-link">
                        <span>اتصل الآن</span>
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card h-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4>راسلنا</h4>
                    <p>info@dentalproducts.com<br>sales@dentalproducts.com</p>
                    <a href="mailto:info@dentalproducts.com" class="contact-info-link">
                        <span>أرسل رسالة</span>
                        <i class="fas fa-paper-plane"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section id="contact-form" class="contact-form-section py-5">
    <div class="container">
        <div class="contact-form-wrapper position-relative">
            <!-- Decorative elements -->
            <div class="contact-form-blob"></div>
            <div class="contact-form-shape"></div>
            <div class="contact-form-dots"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">نموذج التواصل</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">أرسل لنا رسالة</h2>
                <div class="title-separator"><div class="separator-line"></div><div class="separator-icon"><i class="fas fa-comment-dots"></i></div><div class="separator-line"></div></div>
                <p class="section-subtitle">املأ النموذج أدناه وسيتواصل معك فريقنا في أقرب وقت ممكن</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-form-card" data-aos="fade-up">
                        <div class="contact-form-card-shape"></div>
                        <div class="contact-form-container">
                            <form id="contactForm" class="contact-form">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">الاسم الكامل</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">رقم الجوال</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject">الموضوع</label>
                                            <input type="text" class="form-control" id="subject" name="subject" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message">الرسالة</label>
                                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <span>إرسال الرسالة</span>
                                            <i class="fas fa-paper-plane ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
    // Contact form validation and submission
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic form validation
            const formData = new FormData(this);
            let isValid = true;

            formData.forEach((value, key) => {
                if (!value.trim()) {
                    isValid = false;
                    const input = this.querySelector(`[name="${key}"]`);
                    input.classList.add('is-invalid');
                }
            });

            if (isValid) {
                // Here you would typically send the form data to your server
                // For now, we'll just show a success message
                alert('تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.');
                this.reset();
            }
        });

        // Remove invalid class on input
        contactForm.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
    }

    // Floating badges animation
    const floatingBadges = document.querySelectorAll('.contact-floating-badge');
    floatingBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.animationPlayState = 'paused';
        });

        badge.addEventListener('mouseleave', function() {
            this.style.animationPlayState = 'running';
        });
    });
</script>
@endsection
