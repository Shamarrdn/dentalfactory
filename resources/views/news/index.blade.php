@extends('layouts.dental')

@section('title', 'الأخبار')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dental-css/news.css') }}?t={{ time() }}">
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-bg-image-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-2">
        <div class="news-hero-icon">
            <i class="fas fa-newspaper"></i>
        </div>
        <h1 class="hero-bg-title mb-4">أخبار جينودينت</h1>
        <p class="hero-bg-desc mb-4">
            تابع آخر الأخبار والمستجدات والابتكارات في مجال صناعة مواد طب الأسنان المتطورة
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#latest-news" class="hero-bg-btn main-btn">آخر الأخبار</a>
        </div>
    </div>
</section>

<section id="latest-news" class="news-listing-section py-5">
    <div class="container">
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
        <div class="row g-4 justify-content-center">
            @foreach($news as $index => $article)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <article class="news-card-modern h-100" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="news-image-wrapper">
                            <img src="{{ $article->cover_image_url }}"
                                 alt="{{ $article->title }}"
                                 class="news-image">
                            <div class="news-overlay-gradient"></div>
                            <div class="news-category-badge">
                                <i class="fas fa-bookmark"></i>
                                <span>جديد</span>
                            </div>
                        </div>

                        <div class="news-content-wrapper">
                            <div class="news-meta-info">
                                <span class="news-date-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $article->published_at->format('Y-m-d') }}
                                </span>
                                <span class="news-time-item">
                                    <i class="fas fa-clock"></i>
                                    {{ $article->reading_time }} دقائق
                                </span>
                            </div>

                            <h3 class="news-card-title">
                                <a href="{{ route('news.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="news-excerpt-text">
                                {{ Str::limit($article->short_description, 120) }}
                            </p>

                            <a href="{{ route('news.show', $article->slug) }}" class="btn-news-read">
                                <span>اقرأ المزيد</span>
                                <i class="fas fa-arrow-left"></i>
                            </a>
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
                <div class="no-news-container" data-aos="fade-up">
                    <div class="no-news-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h4 class="no-news-title">
                        @if(request('search'))
                            لا توجد نتائج للبحث
                        @else
                            لا توجد أخبار متاحة حالياً
                        @endif
                    </h4>
                    <p class="no-news-text">
                        @if(request('search'))
                            جرب البحث بكلمات أخرى أو تصفح جميع الأخبار
                        @else
                            ترقب الأخبار الجديدة قريباً
                        @endif
                    </p>
                    @if(request('search'))
                        <a href="{{ route('news.index') }}" class="btn-all-news mt-4">
                            <span>عرض جميع الأخبار</span>
                            <i class="fas fa-list"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Featured News Section -->
@if(!request('search') && $news->count() > 0)
    <section class="featured-news-section py-5">
        <div class="container">
            <div class="featured-news-wrapper position-relative">
                <!-- Decorative elements -->
                <div class="featured-blob-1"></div>
                <div class="featured-blob-2"></div>

                <div class="text-center mb-5">
                    <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">أهم الأخبار</span>
                    <h2 class="section-title gradient-text">أبرز الأخبار والمقالات</h2>
                    <div class="title-separator">
                        <div class="separator-line"></div>
                        <div class="separator-icon"><i class="fas fa-star"></i></div>
                        <div class="separator-line"></div>
                    </div>
                    <p class="section-subtitle">تابع أهم وأبرز الأخبار في عالم طب الأسنان</p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach($news->take(3) as $index => $featured)
                        <div class="col-lg-4 col-md-6">
                            <article class="featured-news-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <div class="featured-image-wrapper">
                                    <img src="{{ $featured->cover_image_url }}"
                                         alt="{{ $featured->title }}"
                                         class="featured-image">
                                    <div class="featured-overlay"></div>
                                    <div class="featured-badge">
                                        <i class="fas fa-star"></i>
                                        <span>مميز</span>
                                    </div>
                                </div>
                                <div class="featured-content-wrapper">
                                    <div class="featured-meta-info">
                                        <span class="featured-date-item">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $featured->published_at->format('Y-m-d') }}
                                        </span>
                                        <span class="featured-time-item">
                                            <i class="fas fa-clock"></i>
                                            {{ $featured->reading_time }} دقائق
                                        </span>
                                    </div>
                                    <h4 class="featured-card-title">
                                        <a href="{{ route('news.show', $featured->slug) }}">
                                            {{ Str::limit($featured->title, 60) }}
                                        </a>
                                    </h4>
                                    <p class="featured-excerpt-text">
                                        {{ Str::limit($featured->short_description, 100) }}
                                    </p>
                                    <a href="{{ route('news.show', $featured->slug) }}" class="btn-featured-read">
                                        <span>اقرأ المزيد</span>
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
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
