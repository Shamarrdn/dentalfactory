@extends('layouts.dental')

@section('title', $page->meta_title ?: $page->title . ' - مصنع منتجات الأسنان')
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->content), 160))
@section('meta_keywords', $page->meta_keywords)

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/customer/pages.css') }}?t={{ time() }}">
@endsection

@section('content')
<div class="page-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fas fa-home"></i> الرئيسية
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $page->title }}
                            </li>
                        </ol>
                    </nav>
                    
                    <div class="page-title-section">
                        <h1 class="page-title">{{ $page->title }}</h1>
                        <div class="page-meta">
                            <span class="page-date">
                                <i class="fas fa-calendar-alt"></i>
                                آخر تحديث: {{ $page->updated_at->format('Y/m/d') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="page-content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="page-content-wrapper">
                        <article class="page-article">
                            <div class="article-content">
                                {!! $page->content !!}
                            </div>
                        </article>

                        <!-- Page Actions -->
                        <div class="page-actions">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="share-section">
                                        <span class="share-label">شارك الصفحة:</span>
                                        <div class="share-buttons">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                               target="_blank" class="share-btn facebook" title="شارك على فيسبوك">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($page->title) }}" 
                                               target="_blank" class="share-btn twitter" title="شارك على تويتر">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a href="https://wa.me/?text={{ urlencode($page->title . ' - ' . request()->fullUrl()) }}" 
                                               target="_blank" class="share-btn whatsapp" title="شارك على واتساب">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <button type="button" class="share-btn copy-link" title="نسخ الرابط" onclick="copyToClipboard('{{ request()->fullUrl() }}')">
                                                <i class="fas fa-link"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{ route('contact') }}" class="btn btn-contact">
                                        <i class="fas fa-phone"></i> اتصل بنا
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="page-navigation">
                            @php
                                $currentOrder = $page->sort_order;
                                $prevPage = \App\Models\Page::published()
                                    ->where('sort_order', '<', $currentOrder)
                                    ->orderBy('sort_order', 'desc')
                                    ->first();
                                $nextPage = \App\Models\Page::published()
                                    ->where('sort_order', '>', $currentOrder)
                                    ->orderBy('sort_order', 'asc')
                                    ->first();
                            @endphp
                            
                            <div class="row">
                                <div class="col-6">
                                    @if($prevPage)
                                        <a href="{{ route('page.show', $prevPage->slug) }}" class="nav-link prev">
                                            <i class="fas fa-arrow-right"></i>
                                            <div class="nav-text">
                                                <small>السابق</small>
                                                <span>{{ Str::limit($prevPage->title, 30) }}</span>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-6 text-end">
                                    @if($nextPage)
                                        <a href="{{ route('page.show', $nextPage->slug) }}" class="nav-link next">
                                            <div class="nav-text">
                                                <small>التالي</small>
                                                <span>{{ Str::limit($nextPage->title, 30) }}</span>
                                            </div>
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Pages -->
    @php
        $relatedPages = \App\Models\Page::published()
            ->where('id', '!=', $page->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
    @endphp
    
    @if($relatedPages->count() > 0)
    <div class="related-pages-section">
        <div class="container">
            <div class="section-header text-center">
                <h3>صفحات أخرى قد تهمك</h3>
            </div>
            <div class="row">
                @foreach($relatedPages as $relatedPage)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="related-page-card">
                            <div class="card-content">
                                <h5 class="card-title">
                                    <a href="{{ route('page.show', $relatedPage->slug) }}">
                                        {{ $relatedPage->title }}
                                    </a>
                                </h5>
                                <p class="card-excerpt">
                                    {{ Str::limit(strip_tags($relatedPage->content), 100) }}
                                </p>
                                <div class="card-meta">
                                    <span class="update-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $relatedPage->updated_at->format('Y/m/d') }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('page.show', $relatedPage->slug) }}" class="read-more-btn">
                                    اقرأ المزيد <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const btn = event.target.closest('.copy-link');
        const originalIcon = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.style.backgroundColor = '#28a745';
        
        setTimeout(() => {
            btn.innerHTML = originalIcon;
            btn.style.backgroundColor = '';
        }, 2000);
        
        // Optional: Show toast notification
        showToast('تم نسخ الرابط بنجاح!', 'success');
    }).catch(function(err) {
        console.error('فشل في نسخ النص: ', err);
        showToast('فشل في نسخ الرابط', 'error');
    });
}

function showToast(message, type) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add styles
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#28a745' : '#dc3545'};
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        z-index: 9999;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endsection
