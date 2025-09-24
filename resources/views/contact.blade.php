@extends('layouts.dental')

@section('title', 'مصنع جينودينت - اتصل بنا')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/contact.css') }}?t={{ time() }}">

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
        <h1 class="hero-bg-title mb-4">تواصل معنا</h1>
        <p class="hero-bg-desc mb-4">
            نحن هنا لمساعدتك في الحصول على أفضل مواد طب الأسنان من مصنع جينودينت في منطقة عسير
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
                    @php
                        $companyAddress = \App\Models\Setting::get('company_address', '123 شارع الصناعة، المنطقة الصناعية، الرياض، المملكة العربية السعودية');
                        $googleMapsUrl = \App\Models\Setting::get('google_maps_url', '');
                    @endphp
                    <p>{{ $companyAddress }}</p>
                    @if($googleMapsUrl)
                        <a href="{{ $googleMapsUrl }}" target="_blank" class="contact-info-link">
                            <span>عرض على الخريطة</span>
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card h-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4>اتصل بنا</h4>
                    @php
                        $companyPhone = \App\Models\Setting::get('company_phone', '');
                        $phoneNumbers = get_phone_numbers_array($companyPhone);
                        $firstPhone = !empty($phoneNumbers) ? $phoneNumbers[0] : '+966 54 411 7002';
                    @endphp
                    <p>{!! format_phone_numbers($companyPhone, '<br>') ?: '+966 54 411 7002' !!}</p>
                    <a href="tel:{{ str_replace([' ', '+'], '', $firstPhone) }}" class="contact-info-link">
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
                    @php
                        $companyEmail = \App\Models\Setting::get('company_email', '');
                        $companyWebsite = \App\Models\Setting::get('company_website', '');
                        $displayEmails = format_email_addresses($companyEmail, '<br>') ?: 'Genodent.1@gmail.com<br>Genodent.2@gmail.com';
                        $primaryEmail = get_primary_email($companyEmail) ?: 'Genodent.1@gmail.com';
                    @endphp
                    <p>{!! $displayEmails !!}@if($companyWebsite)<br>{{ $companyWebsite }}@endif</p>
                    <a href="mailto:{{ $primaryEmail }}" class="contact-info-link">
                        <span>أرسل رسالة</span>
                        <i class="fas fa-paper-plane"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@php
    $embeddedMapCode = \App\Models\Setting::get('embedded_map_code', '');
    $googleMapsUrl = \App\Models\Setting::get('google_maps_url', '');
@endphp

@if($embeddedMapCode)
<!-- Interactive Map Section -->
<section class="interactive-map-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">موقعنا</span>
            <h2 class="gradient-text">خريطة تفاعلية</h2>
            <p>تفضل بزيارتنا في موقعنا أو تواصل معنا للحصول على الاتجاهات</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="map-container" data-aos="fade-up">
                    <div class="map-wrapper">
                        {!! $embeddedMapCode !!}
                    </div>
                    @if($googleMapsUrl)
                        <div class="map-actions text-center mt-3">
                            <a href="{{ $googleMapsUrl }}" target="_blank" class="btn btn-primary btn-lg">
                                <i class="fas fa-directions"></i> احصل على الاتجاهات
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

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
                            <form method="POST" action="{{ route('contact.submit') }}" class="contact-form">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">الاسم الكامل</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">البريد الإلكتروني</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">رقم الجوال</label>
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                   id="phone" name="phone" value="{{ old('phone') }}" required>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject">الموضوع</label>
                                            <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                                   id="subject" name="subject" value="{{ old('subject') }}" required>
                                            @error('subject')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message">الرسالة</label>
                                            <textarea class="form-control @error('message') is-invalid @enderror"
                                                      id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn submit btn-lg" id="submitBtn">
                                            <span id="submitText">إرسال الرسالة</span>
                                            <i class="fas fa-paper-plane ms-2" id="submitIcon"></i>
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
    // Form submission handling with loading state
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.querySelector('.contact-form');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitIcon = document.getElementById('submitIcon');

        if (contactForm && submitBtn) {
            contactForm.addEventListener('submit', function() {
                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = 'جاري الإرسال...';
                submitIcon.className = 'fas fa-spinner fa-spin ms-2';
                submitBtn.classList.add('disabled');
            });
        }

        // Auto-hide toasts after 5 seconds with smooth animation
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(toast => {
            // Add fade-in animation
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';

            setTimeout(() => {
                toast.style.transition = 'all 0.3s ease-in-out';
                toast.style.opacity = '1';
                toast.style.transform = 'translateX(0)';
            }, 100);

            // Auto-hide after 5 seconds
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 5000);
        });

        // Add click to dismiss functionality
        toasts.forEach(toast => {
            const closeBtn = toast.querySelector('.btn-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                });
            }
        });
    });

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
