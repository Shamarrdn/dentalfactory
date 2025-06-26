@extends('layouts.dental')

@section('title', 'مصنع منتجات الأسنان - اتصل بنا')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/contact.css') }}?t={{ time() }}">

@endsection

@section('content')

<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <h1 class="hero-bg-title mb-4">تواصل معنا</h1>
        <p class="hero-bg-desc mb-4">
            نحن هنا لمساعدتك في كل ما تحتاجه من منتجات طب الأسنان عالية الجودة
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#contact-form" class="hero-bg-btn main-btn">تواصل الآن</a>
            <a href="#contact-info" class="hero-bg-btn ghost-btn">معلومات الاتصال</a>
        </div>
    </div>
</section>

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

<section id="contact-form" class="contact-form-section py-5">
    <div class="container">
        <div class="contact-form-wrapper position-relative">
            <div class="contact-form-blob"></div>
            <div class="contact-form-shape"></div>
            <div class="contact-form-dots"></div>

            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeIn">نموذج التواصل</span>
                <h2 class="section-title gradient-text animate__animated animate__fadeInUp">أرسل لنا رسالة</h2>
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
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

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
                alert('تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.');
                this.reset();
            }
        });

        contactForm.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
    }

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
