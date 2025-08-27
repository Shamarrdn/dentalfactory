@extends('layouts.dental')

@section('title', $news->title)

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/customer/news.css') }}">
<style>
.article-content {
    font-size: 18px;
    line-height: 1.8;
    color: #333;
}
.article-content img {
    max-width: 100%;
    height: auto;
    margin: 20px 0;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.article-content p {
    margin-bottom: 20px;
}
.article-content h1, .article-content h2, .article-content h3 {
    margin-top: 30px;
    margin-bottom: 20px;
    color: #2c3e50;
}
.article-content blockquote {
    border-right: 4px solid #007bff;
    background: #f8f9fa;
    margin: 20px 0;
    padding: 20px;
    border-radius: 8px;
}
.article-content ul, .article-content ol {
    margin: 20px 0;
    padding-right: 20px;
}
.article-content li {
    margin-bottom: 8px;
}
</style>
@endsection

@section('content')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">الأخبار</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($news->title, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8">
            <!-- Article -->
            <article class="news-article">
                <!-- Article Header -->
                <header class="article-header mb-4">
                    <h1 class="article-title display-5 fw-bold mb-3">{{ $news->title }}</h1>
                    
                    <div class="article-meta d-flex flex-wrap align-items-center gap-3 mb-4">
                        <span class="meta-item">
                            <i class="fas fa-calendar-alt text-primary"></i>
                            {{ $news->arabic_published_date }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-clock text-primary"></i>
                            {{ $news->reading_time }} دقيقة قراءة
                        </span>

                    </div>

                    <p class="article-excerpt lead text-muted mb-4">{{ $news->short_description }}</p>
                </header>

                <!-- Featured Image -->
                @if($news->cover_image)
                    <div class="article-image mb-5">
                        <img src="{{ $news->cover_image_url }}" 
                             alt="{{ $news->title }}" 
                             class="img-fluid rounded shadow">
                    </div>
                @endif

                <!-- Article Content -->
                <div class="article-content">
                    {!! $news->content !!}
                </div>

                <!-- Article Footer -->
                <footer class="article-footer mt-5 pt-4 border-top">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="share-buttons">
                                <span class="fw-bold me-3">شارك هذا الخبر:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                   target="_blank" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fab fa-facebook-f"></i> فيسبوك
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                                   target="_blank" class="btn btn-outline-info btn-sm me-2">
                                    <i class="fab fa-twitter"></i> تويتر
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" 
                                   target="_blank" class="btn btn-outline-success btn-sm me-2">
                                    <i class="fab fa-whatsapp"></i> واتساب
                                </a>
                                <button onclick="copyLink()" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-link"></i> نسخ الرابط
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <small class="text-muted">
                                آخر تحديث: {{ $news->updated_at->format('Y-m-d H:i') }}
                            </small>
                        </div>
                    </div>
                </footer>
            </article>

            <!-- Navigation Between Articles -->
            <nav class="article-navigation mt-5">
                <div class="row">
                    <div class="col-md-6">
                        @if($relatedNews->first())
                            <a href="{{ route('news.show', $relatedNews->first()->slug) }}" 
                               class="nav-link-prev d-block p-3 border rounded">
                                <small class="text-muted">الخبر السابق</small>
                                <div class="fw-bold">{{ Str::limit($relatedNews->first()->title, 60) }}</div>
                            </a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($relatedNews->count() > 1)
                            <a href="{{ route('news.show', $relatedNews->skip(1)->first()->slug) }}" 
                               class="nav-link-next d-block p-3 border rounded text-end">
                                <small class="text-muted">الخبر التالي</small>
                                <div class="fw-bold">{{ Str::limit($relatedNews->skip(1)->first()->title, 60) }}</div>
                            </a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related News -->
            @if($relatedNews->count() > 0)
                <div class="sidebar-widget mb-4">
                    <h3 class="widget-title">أخبار ذات صلة</h3>
                    <div class="related-news">
                        @foreach($relatedNews as $related)
                            <article class="related-item">
                                <div class="row g-3">
                                    <div class="col-4">
                                        <img src="{{ $related->cover_image_url }}" 
                                             alt="{{ $related->title }}" 
                                             class="img-fluid rounded">
                                    </div>
                                    <div class="col-8">
                                        <h4 class="related-title">
                                            <a href="{{ route('news.show', $related->slug) }}">
                                                {{ Str::limit($related->title, 80) }}
                                            </a>
                                        </h4>
                                        <div class="related-meta">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ $related->published_at->format('Y-m-d') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Back to News -->
            <div class="sidebar-widget">
                <div class="d-grid">
                    <a href="{{ route('news.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-right me-2"></i>
                        العودة لجميع الأخبار
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="sidebar-widget mt-4">
                <h3 class="widget-title">إجراءات سريعة</h3>
                <div class="d-grid gap-2">
                    <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-print me-2"></i>
                        طباعة المقال
                    </button>
                    <button onclick="copyLink()" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-share me-2"></i>
                        مشاركة المقال
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Message for Copy Link -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="copyToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">تم بنجاح</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            تم نسخ رابط المقال إلى الحافظة
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Copy link function
function copyLink() {
    const url = window.location.href;
    
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(function() {
            showCopyToast();
        });
    } else {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showCopyToast();
    }
}

function showCopyToast() {
    const toast = new bootstrap.Toast(document.getElementById('copyToast'));
    toast.show();
}

// Smooth scroll for internal links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add reading progress indicator
window.addEventListener('scroll', function() {
    const article = document.querySelector('.article-content');
    if (!article) return;
    
    const articleTop = article.offsetTop;
    const articleHeight = article.offsetHeight;
    const windowHeight = window.innerHeight;
    const scrollTop = window.pageYOffset;
    
    const progress = Math.min(
        Math.max((scrollTop - articleTop + windowHeight * 0.3) / articleHeight, 0),
        1
    );
    
    // You can add a progress bar here if needed
});

// Lazy load images in content
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.article-content img');
    
    if ('loading' in HTMLImageElement.prototype) {
        images.forEach(img => img.loading = 'lazy');
    } else {
        // Fallback for browsers that don't support loading="lazy"
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
});
</script>
@endsection
