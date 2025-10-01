@extends('layouts.dental')

@section('title', 'الإنجازات')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/achievements.css') }}?t={{ time() }}">
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <div class="achievements-hero-icon">
            <i class="fas fa-trophy"></i>
        </div>
        <h1 class="hero-bg-title mb-4">إنجازات جينودينت</h1>
        <p class="hero-bg-desc mb-4">
            نفخر بالإنجازات والشهادات والاعتمادات التي حققناها في مجال صناعة مواد طب الأسنان المتطورة
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#achievements-gallery" class="hero-bg-btn main-btn">مشاهدة الإنجازات</a>
        </div>
    </div>
</section>


<div class="achievements-page">
    <section id="achievements-gallery" class="achievements-listing-section py-5" >
        <div class="container">

        <!-- Section Title -->
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">معرض الإنجازات</span>
            <h2 class="section-title gradient-text">فخورون بإنجازاتنا</h2>
            <p class="section-subtitle">شهادات الجودة والاعتمادات والجوائز التي حققناها في مجال طب الأسنان</p>
        </div>

            <!-- Search Bar -->
            <div class="row mb-4">
                <div class="col-md-8 mx-auto">
                    <div class="achievements-search-wrapper">
                        <form method="GET" action="{{ route('achievements.index') }}">
                            <div class="achievements-search-group">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" class="achievements-search-input" name="search"
                                       value="{{ request('search') }}"
                                       placeholder="البحث في الإنجازات...">
                                <button class="achievements-search-btn" type="submit">
                                    <i class="fas fa-search me-1"></i> بحث
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('achievements.index') }}" class="achievements-clear-btn">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Search Results Info -->
            @if(request('search'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="search-results-header">
                            <div class="search-results-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="search-results-content">
                                <h3>نتائج البحث عن: "{{ request('search') }}"</h3>
                                <p>تم العثور على {{ $achievements->total() }} إنجاز</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Achievements Grid -->
            @if($achievements->count() > 0)
                <div class="achievements-grid">
                    @foreach($achievements as $achievement)
                        <article class="achievement-article-card">
                            <div class="achievement-article-image-container">
                                <img src="{{ $achievement->cover_image_url ?? asset('assets/images/achievements-default.jpg') }}"
                                     alt="{{ $achievement->title }}"
                                     class="achievement-article-image"
                                     onerror="this.src='https://images.unsplash.com/photo-1583195764036-6dc248ac07d9?auto=format&fit=crop&w=400&q=80'">

                                <div class="achievement-category-badge">
                                    <i class="fas fa-trophy"></i>
                                    إنجاز
                                </div>

                                <div class="achievement-article-overlay">
                                    <a href="{{ route('achievements.show', $achievement->slug) }}" class="achievement-read-btn">
                                        <i class="fas fa-eye"></i> عرض التفاصيل
                                    </a>
                                </div>
                            </div>

                            <div class="achievement-article-content">
                                <div class="achievement-article-meta">
                                    <span class="achievement-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $achievement->published_at->format('Y-m-d') }}
                                    </span>
                                    <span class="achievement-views">
                                        <i class="fas fa-eye"></i>
                                        {{ $achievement->formatted_views }}
                                    </span>
                                </div>

                                <h3 class="achievement-article-title">
                                    <a href="{{ route('achievements.show', $achievement->slug) }}">
                                        {{ $achievement->title }}
                                    </a>
                                </h3>

                                <p class="achievement-article-excerpt">
                                    {{ $achievement->short_description }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($achievements->hasPages())
                <div class="achievements-pagination-wrapper">
                    {{ $achievements->withQueryString()->links('custom.pagination') }}
                </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="achievements-empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    @if(request('search'))
                        <h3>لم نجد أي إنجازات</h3>
                        <p>لم نجد أي إنجازات تطابق بحثك عن "{{ request('search') }}"</p>
                        <a href="{{ route('achievements.index') }}" class="btn btn-primary"
                           style="background: var(--genodent-gradient-primary); border: none; border-radius: 50px; padding: 12px 25px;">
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
