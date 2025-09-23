@extends('layouts.dental')

@section('title', 'الأخبار')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/news.css') }}?t={{ time() }}">
@endsection

@section('content')
<!-- Hero Section -->
<section class="news-hero-section d-flex align-items-center justify-content-center text-center">
    <div class="news-hero-overlay"></div>
    <div class="container position-relative z-2">
        <div class="news-hero-content">
            <div class="news-hero-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <h1 class="news-hero-title mb-4">أخبار جينودينت</h1>
            <p class="news-hero-desc mb-4">
                تابع آخر الأخبار والمستجدات والابتكارات في مجال صناعة مواد طب الأسنان المتطورة
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="#latest-news" class="news-hero-btn main-btn">آخر الأخبار</a>
                <a href="#news-categories" class="news-hero-btn ghost-btn">تصنيفات الأخبار</a>
            </div>
        </div>
    </div>
</section>

<!-- News Categories Section -->
<section id="news-categories" class="news-categories-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">تصنيفات الأخبار</span>
            <h2 class="section-title gradient-text">تابع أحدث التطورات</h2>
            <p class="section-subtitle">اكتشف آخر الأخبار والمستجدات في مختلف مجالات عملنا</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="news-category-card">
                    <div class="category-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3 class="category-title">البحث والابتكار</h3>
                    <p class="category-desc">آخر التطورات في مجال البحث والتطوير</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="news-category-card">
                    <div class="category-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="category-title">الإنجازات</h3>
                    <p class="category-desc">شهادات الجودة والاعتمادات الجديدة</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="news-category-card">
                    <div class="category-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="category-title">التطوير التقني</h3>
                    <p class="category-desc">تحديثات المعدات والتقنيات</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="news-category-card">
                    <div class="category-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="category-title">الشراكات</h3>
                    <p class="category-desc">التعاون مع الجامعات والمؤسسات</p>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <div class="news-search-wrapper">
                    <form method="GET" action="{{ route('news.index') }}">
                        <div class="news-search-group">
                            <div class="search-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <input type="text" class="news-search-input" name="search"
                                   value="{{ request('search') }}"
                                   placeholder="ابحث في الأخبار والمقالات...">
                            <button class="news-search-btn" type="submit">
                                بحث
                            </button>
                            @if(request('search'))
                                <a href="{{ route('news.index') }}" class="news-clear-btn">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="latest-news" class="news-listing-section py-5">
    <div class="container">

        @if(request('search'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="search-results-header">
                        <div class="search-results-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="search-results-content">
                            <h3>نتائج البحث</h3>
                            <p>نتائج البحث عن: <strong>"{{ request('search') }}"</strong> - {{ $news->total() }} نتيجة</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <!-- News Grid -->
    @if($news->count() > 0)
        <div class="row g-4">
            @foreach($news as $article)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <article class="news-card h-100">
                        <div class="news-image">
                            <img src="{{ $article->cover_image_url }}"
                                 alt="{{ $article->title }}"
                                 class="img-fluid">
                            <div class="news-badge">
                                <span class="badge bg-primary">جديد</span>
                            </div>
                        </div>

                        <div class="news-content">
                            <div class="news-meta">
                                <span class="news-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $article->published_at->format('Y-m-d') }}
                                </span>
                                <span class="reading-time">
                                    <i class="fas fa-clock"></i>
                                    {{ $article->reading_time }} دقيقة
                                </span>
                            </div>

                            <h3 class="news-title">
                                <a href="{{ route('news.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="news-excerpt">
                                {{ $article->short_description }}
                            </p>

                            <div class="news-footer">
                                <a href="{{ route('news.show', $article->slug) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    اقرأ المزيد
                                    <i class="fas fa-arrow-left ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>

        <!-- Pagination -->
        @if($news->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $news->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        @endif
    @else
        <!-- No News Found -->
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-newspaper fa-4x text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">
                            @if(request('search'))
                                لا توجد نتائج للبحث
                            @else
                                لا توجد أخبار متاحة حالياً
                            @endif
                        </h3>
                        <p class="text-muted mb-4">
                            @if(request('search'))
                                جرب البحث بكلمات أخرى أو تصفح جميع الأخبار
                            @else
                                ترقب الأخبار الجديدة قريباً
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('news.index') }}" class="btn btn-primary">
                                <i class="fas fa-list me-2"></i>
                                عرض جميع الأخبار
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Featured News Section -->
@if(!request('search') && $news->count() > 0)
    <section class="featured-news bg-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title">أهم الأخبار</h2>
                    <p class="section-subtitle">اطلع على أبرز الأخبار والمقالات</p>
                </div>
            </div>

            <div class="row">
                @foreach($news->take(3) as $featured)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="featured-card">
                            <div class="featured-image">
                                <img src="{{ $featured->cover_image_url }}"
                                     alt="{{ $featured->title }}"
                                     class="img-fluid">
                            </div>
                            <div class="featured-content">
                                <h4 class="featured-title">
                                    <a href="{{ route('news.show', $featured->slug) }}">
                                        {{ Str::limit($featured->title, 60) }}
                                    </a>
                                </h4>
                                <p class="featured-excerpt">
                                    {{ Str::limit($featured->short_description, 100) }}
                                </p>
                                <div class="featured-meta">
                                    <span class="featured-date">
                                        {{ $featured->published_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection

@section('scripts')
<script>
// Add smooth scroll animation for news cards
document.addEventListener('DOMContentLoaded', function() {
    const newsCards = document.querySelectorAll('.news-card');

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

    newsCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
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
});

// Hover effects disabled for better UX
</script>
@endsection
