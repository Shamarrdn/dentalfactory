@extends('layouts.dental')

@section('title', 'الأخبار')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/customer/news.css') }}">
@endsection

@section('content')
<!-- Hero Section -->
<section class="news-hero">
    <div class="news-hero-content">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1><i class="fas fa-newspaper"></i> الأخبار</h1>
                    <p>تابع آخر الأخبار والمستجدات في عالم منتجات الأسنان</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">

    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <form method="GET" action="{{ route('news.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" 
                           value="{{ request('search') }}" 
                           placeholder="البحث في الأخبار...">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('news.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if(request('search'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-search me-2"></i>
                    نتائج البحث عن: <strong>"{{ request('search') }}"</strong>
                    ({{ $news->total() }} نتيجة)
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
                        {{ $news->withQueryString()->simplePaginate() }}
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
    });
});

// Add hover effects
document.querySelectorAll('.news-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px)';
        this.style.boxShadow = '0 15px 35px rgba(0,0,0,0.1)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.08)';
    });
});
</script>
@endsection
