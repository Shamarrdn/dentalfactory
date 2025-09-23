@extends('layouts.dental')

@section('title', 'الإنجازات')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/achievements.css') }}?t={{ time() }}">
@endsection

@section('content')
<!-- Hero Section -->
<section class="achievements-hero-section d-flex align-items-center justify-content-center text-center">
    <div class="achievements-hero-overlay"></div>
    <div class="container position-relative z-2">
        <div class="achievements-hero-content">
            <div class="achievements-hero-icon">
                <i class="fas fa-trophy"></i>
            </div>
            <h1 class="achievements-hero-title mb-4">إنجازات جينودينت</h1>
            <p class="achievements-hero-desc mb-4">
                نفخر بالإنجازات والشهادات والاعتمادات التي حققناها في مجال صناعة مواد طب الأسنان المتطورة
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="#achievements-gallery" class="achievements-hero-btn main-btn">مشاهدة الإنجازات</a>
                <a href="#achievements-categories" class="achievements-hero-btn ghost-btn">التصنيفات</a>
            </div>
        </div>
    </div>
</section>

<!-- Achievements Categories Section -->
<section id="achievements-categories" class="achievements-categories-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">تصنيفات الإنجازات</span>
            <h2 class="section-title gradient-text">تميزنا في كافة المجالات</h2>
            <p class="section-subtitle">إنجازاتنا وشهادات الجودة والاعتماد التي حصلنا عليها</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="achievement-category-card">
                    <div class="category-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="category-title">شهادات الجودة</h3>
                    <p class="category-desc">اعتمادات دولية ومحلية للجودة</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="achievement-category-card">
                    <div class="category-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="category-title">الجوائز والتكريم</h3>
                    <p class="category-desc">جوائز التميز والإبداع الصناعي</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="achievement-category-card">
                    <div class="category-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="category-title">الشراكات الاستراتيجية</h3>
                    <p class="category-desc">تعاوننا مع الجامعات والمؤسسات</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="achievement-category-card">
                    <div class="category-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="category-title">النمو والتطوير</h3>
                    <p class="category-desc">معالم النمو والتوسع التجاري</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="achievements-page">
    <section id="achievements-gallery" class="achievements-listing-section py-5">
        <div class="container">

    <!-- Achievements Content -->
    <section class="achievements-container">
        <div class="container">
            <!-- Search Bar -->
            <div class="row mb-4">
                <div class="col-md-6 mx-auto">
                    <form method="GET" action="{{ route('achievements.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="البحث في الإنجازات..."
                                   style="border-radius: 25px 0 0 25px; border: 2px solid #007bff; padding: 12px 20px;">
                            <button class="btn btn-primary" type="submit" 
                                    style="border-radius: 0 25px 25px 0; background: linear-gradient(135deg, #007bff, #0056b3); border: none; padding: 12px 20px;">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('achievements.index') }}" class="btn btn-outline-secondary" 
                                   style="border-radius: 25px; margin-right: 10px; padding: 12px 20px;">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Results Info -->
            @if(request('search'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-info" style="border-radius: 15px; border: none; background: linear-gradient(135deg, #e3f2fd, #bbdefb);">
                            <i class="fas fa-search me-2"></i>
                            نتائج البحث عن: <strong>"{{ request('search') }}"</strong>
                            ({{ $achievements->total() }} نتيجة)
                        </div>
                    </div>
                </div>
            @endif

            <!-- Achievements Grid -->
            @if($achievements->count() > 0)
                <div class="achievements-grid">
                    @foreach($achievements as $achievement)
                        <article class="achievement-card">
                            <div class="achievement-image-container">
                                <img src="{{ $achievement->cover_image_url }}" 
                                     alt="{{ $achievement->title }}" 
                                     class="achievement-image">
                                <div class="achievement-overlay">
                                    <a href="{{ route('achievements.show', $achievement->slug) }}" class="view-btn">
                                        <i class="fas fa-eye"></i> عرض التفاصيل
                                    </a>
                                </div>
                            </div>
                            
                            <div class="achievement-content">
                                <h3 class="achievement-title">
                                    {{ $achievement->title }}
                                </h3>
                                
                                <p class="achievement-description">
                                    {{ $achievement->short_description }}
                                </p>
                                
                                <div class="achievement-meta">
                                    <span class="achievement-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $achievement->published_at->format('Y-m-d') }}
                                    </span>
                                    <span class="achievement-views">
                                        <i class="fas fa-eye"></i>
                                        {{ $achievement->formatted_views }}
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($achievements->hasPages())
                <div class="pagination-wrapper">
                    {{ $achievements->withQueryString()->links() }}
                </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="achievements-empty">
                    <div class="achievements-empty-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    @if(request('search'))
                        <h3>لم نجد أي إنجازات</h3>
                        <p>لم نجد أي إنجازات تطابق بحثك عن "{{ request('search') }}"</p>
                        <a href="{{ route('achievements.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-right"></i> عرض جميع الإنجازات
                        </a>
                    @else
                        <h3>لا توجد إنجازات حالياً</h3>
                        <p>نعمل باستمرار على تحقيق إنجازات جديدة. تابعونا لمعرفة آخر التطورات.</p>
                    @endif
                </div>
            @endif
        </div>
    </section>
</div>

<!-- Loading Animation for AJAX Search -->
<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">جاري التحميل...</span>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for cards
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    // Apply animation to achievement cards
    document.querySelectorAll('.achievement-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
        
        // Disable all hover effects
        card.style.pointerEvents = 'auto';
        card.addEventListener('mouseenter', function(e) {
            e.preventDefault();
            return false;
        });
        card.addEventListener('mouseover', function(e) {
            e.preventDefault();
            return false;
        });
    });

    // Enhanced search functionality
    const searchForm = document.querySelector('form');
    const searchInput = document.querySelector('input[name="search"]');
    
    if (searchForm && searchInput) {
        // Auto-submit on Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchForm.submit();
            }
        });

        // Show loading on form submit
        searchForm.addEventListener('submit', function() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'block';
            }
        });
    }

    // Hover effects disabled for better UX

    // Lazy loading for images
    const images = document.querySelectorAll('.achievement-image');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.style.opacity = '1';
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => {
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.3s ease';
        imageObserver.observe(img);
        
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
    });

    // Add tooltips to view counts
    document.querySelectorAll('.achievement-views').forEach(element => {
        element.setAttribute('title', 'عدد مرات المشاهدة');
    });

    // Add tooltips to dates
    document.querySelectorAll('.achievement-date').forEach(element => {
        element.setAttribute('title', 'تاريخ النشر');
    });
});

// Function to animate numbers (for view counts)
function animateNumber(element, start, end, duration) {
    const range = end - start;
    const increment = range / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= end) {
            current = end;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 16);
}

// Apply number animation on scroll
const numberObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const element = entry.target;
            const finalNumber = parseInt(element.textContent);
            if (finalNumber > 0) {
                animateNumber(element, 0, finalNumber, 1000);
                numberObserver.unobserve(element);
            }
        }
    });
});

document.querySelectorAll('.achievement-views').forEach(element => {
    const textContent = element.textContent.trim();
    const numberMatch = textContent.match(/\d+/);
    if (numberMatch) {
        numberObserver.observe(element);
    }
});
</script>
@endsection
