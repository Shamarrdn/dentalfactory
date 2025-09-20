@extends('layouts.dental')

@section('title', 'الإنجازات')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/customer/achievements.css') }}">
<style>
    /* Hide scrollbars for achievements index page */
    body, html {
        -ms-overflow-style: none !important;
        scrollbar-width: none !important;
    }
    
    body::-webkit-scrollbar,
    html::-webkit-scrollbar {
        display: none !important;
    }
    
    .achievements-page,
    .achievements-grid,
    .achievement-card {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .achievements-page::-webkit-scrollbar,
    .achievements-grid::-webkit-scrollbar,
    .achievement-card::-webkit-scrollbar {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="achievements-page">
    <!-- Hero Section -->
    <section class="achievements-hero">
        <div class="achievements-hero-content">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1><i class="fas fa-trophy"></i> إنجازاتنا</h1>
                        <p>نفخر بالإنجازات التي حققناها والشهادات التي حصلنا عليها في مجال منتجات الأسنان والرعاية الصحية</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
