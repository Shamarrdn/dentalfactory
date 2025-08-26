@extends('layouts.customer')

@section('title', $achievement->title)

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/customer/achievements.css') }}">
@endsection

@section('content')
<div class="achievements-page">
    <!-- Achievement Detail Hero -->
    <section class="achievement-detail-hero">
        <img src="{{ $achievement->cover_image_url }}" alt="{{ $achievement->title }}" class="achievement-detail-image">
        <div class="achievement-detail-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="achievement-detail-title">{{ $achievement->title }}</h1>
                        <div class="achievement-detail-meta">
                            <span>
                                <i class="fas fa-calendar-alt"></i>
                                {{ $achievement->published_at->format('Y-m-d') }}
                            </span>
                            <span>
                                <i class="fas fa-eye"></i>
                                {{ $achievement->formatted_views }} مشاهدة
                            </span>
                            <span>
                                <i class="fas fa-clock"></i>
                                {{ $achievement->reading_time }} 
                                {{ $achievement->reading_time == 1 ? 'دقيقة' : 'دقائق' }} قراءة
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievement Content -->
    <section class="achievement-detail-content">
        <div class="container">
            <div class="achievement-content-wrapper">
                <!-- Short Description -->
                <div class="achievement-detail-description">
                    <i class="fas fa-quote-right"></i>
                    {{ $achievement->short_description }}
                </div>

                <!-- Main Content -->
                <div class="achievement-detail-body">
                    {!! $achievement->content !!}
                </div>

                <!-- Share Section -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-share-alt text-primary"></i> شارك هذا الإنجاز
                                </h5>
                                <div class="d-flex justify-content-center gap-3 flex-wrap">
                                    <!-- Facebook Share -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                       target="_blank" class="btn btn-facebook" 
                                       style="background: #1877f2; color: white; border-radius: 10px; padding: 10px 20px;">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </a>
                                    
                                    <!-- Twitter Share -->
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($achievement->title) }}&url={{ urlencode(request()->url()) }}" 
                                       target="_blank" class="btn btn-twitter" 
                                       style="background: #1da1f2; color: white; border-radius: 10px; padding: 10px 20px;">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                    
                                    <!-- LinkedIn Share -->
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                                       target="_blank" class="btn btn-linkedin" 
                                       style="background: #0077b5; color: white; border-radius: 10px; padding: 10px 20px;">
                                        <i class="fab fa-linkedin-in"></i> LinkedIn
                                    </a>
                                    
                                    <!-- WhatsApp Share -->
                                    <a href="https://wa.me/?text={{ urlencode($achievement->title . ' ' . request()->url()) }}" 
                                       target="_blank" class="btn btn-whatsapp" 
                                       style="background: #25d366; color: white; border-radius: 10px; padding: 10px 20px;">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                    
                                    <!-- Copy Link -->
                                    <button type="button" class="btn btn-outline-secondary" onclick="copyToClipboard()" 
                                            style="border-radius: 10px; padding: 10px 20px;">
                                        <i class="fas fa-link"></i> نسخ الرابط
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('achievements.index') }}" class="btn btn-outline-primary" 
                               style="border-radius: 10px; padding: 12px 25px;">
                                <i class="fas fa-arrow-right"></i> العودة للإنجازات
                            </a>
                            
                            <div class="text-muted small">
                                <i class="fas fa-eye"></i> 
                                تم عرض هذا الإنجاز {{ $achievement->views_count }} مرة
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Achievements -->
    @if($relatedAchievements->count() > 0)
    <section class="related-achievements">
        <div class="container">
            <h2>إنجازات أخرى قد تهمك</h2>
            <div class="related-grid">
                @foreach($relatedAchievements as $related)
                    <a href="{{ route('achievements.show', $related->slug) }}" class="related-card">
                        <img src="{{ $related->cover_image_url }}" alt="{{ $related->title }}" class="related-image">
                        <div class="related-content">
                            <h4 class="related-title">{{ $related->title }}</h4>
                            <p class="related-description">{{ Str::limit($related->short_description, 100) }}</p>
                            <div class="text-muted small mt-2">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $related->published_at->format('Y-m-d') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>

<!-- Success Message Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                <h5>تم نسخ الرابط!</h5>
                <p class="text-muted">تم نسخ رابط الإنجاز إلى الحافظة</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll animations
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

    // Apply animation to content sections
    const animatedElements = [
        '.achievement-detail-description',
        '.achievement-detail-body',
        '.related-card'
    ];

    animatedElements.forEach(selector => {
        document.querySelectorAll(selector).forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(element);
        });
    });

    // Enhance images in content
    const contentImages = document.querySelectorAll('.achievement-detail-body img');
    contentImages.forEach(img => {
        img.addEventListener('click', function() {
            // Create modal for image zoom
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.9);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                cursor: pointer;
            `;
            
            const zoomedImg = document.createElement('img');
            zoomedImg.src = this.src;
            zoomedImg.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
                border-radius: 10px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.5);
            `;
            
            modal.appendChild(zoomedImg);
            document.body.appendChild(modal);
            
            modal.addEventListener('click', function() {
                document.body.removeChild(modal);
            });
        });
        
        // Add hover effect
        img.style.cursor = 'pointer';
        img.style.transition = 'transform 0.3s ease';
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Add reading progress indicator
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        z-index: 1000;
        transition: width 0.3s ease;
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.offsetHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        progressBar.style.width = scrollPercent + '%';
    });

    // Add smooth hover effects to share buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 8px 20px rgba(0,0,0,0.2)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
});

// Copy to clipboard function
function copyToClipboard() {
    const url = window.location.href;
    
    if (navigator.clipboard && window.isSecureContext) {
        // Modern approach
        navigator.clipboard.writeText(url).then(() => {
            showSuccessMessage();
        }).catch(err => {
            console.error('Failed to copy: ', err);
            fallbackCopyTextToClipboard(url);
        });
    } else {
        // Fallback
        fallbackCopyTextToClipboard(url);
    }
}

function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    
    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showSuccessMessage();
        } else {
            alert('فشل في نسخ الرابط');
        }
    } catch (err) {
        alert('فشل في نسخ الرابط');
    }

    document.body.removeChild(textArea);
}

function showSuccessMessage() {
    const modal = new bootstrap.Modal(document.getElementById('successModal'));
    modal.show();
    
    // Auto hide after 2 seconds
    setTimeout(() => {
        modal.hide();
    }, 2000);
}

// Track scroll depth for analytics
let maxScroll = 0;
window.addEventListener('scroll', function() {
    const scrollPercent = Math.round((window.pageYOffset / (document.body.offsetHeight - window.innerHeight)) * 100);
    if (scrollPercent > maxScroll) {
        maxScroll = scrollPercent;
        
        // Track milestones
        if (maxScroll >= 25 && !window.tracked25) {
            window.tracked25 = true;
            console.log('User scrolled 25% of achievement');
        }
        if (maxScroll >= 50 && !window.tracked50) {
            window.tracked50 = true;
            console.log('User scrolled 50% of achievement');
        }
        if (maxScroll >= 75 && !window.tracked75) {
            window.tracked75 = true;
            console.log('User scrolled 75% of achievement');
        }
        if (maxScroll >= 90 && !window.tracked90) {
            window.tracked90 = true;
            console.log('User completed reading achievement');
        }
    }
});
</script>
@endsection
