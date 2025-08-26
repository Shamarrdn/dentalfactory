@extends('layouts.admin')

@section('title', 'إدارة الأخبار')
@section('page_title', 'إدارة الأخبار')
@section('page_subtitle', 'عرض وإدارة جميع الأخبار')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/achievements.css') }}">
<style>
/* Custom styles for news to differentiate from achievements */
.news-dashboard .page-header h1 i {
    color: #fff;
}
.news-icon {
    background: linear-gradient(135deg, #17a2b8, #138496) !important;
}
</style>
@endsection

@section('content')
<div class="container-fluid achievement-dashboard news-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-newspaper"></i> إدارة الأخبار</h1>
                    <p>عرض وإدارة جميع الأخبار والمستجدات المنشورة على الموقع</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('admin.news.create') }}" class="btn btn-create">
                        <i class="fas fa-plus"></i> إضافة خبر جديد
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon published">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-number">{{ $news->where('status', 'published')->count() }}</div>
                <div class="stats-label">أخبار منشورة</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon draft">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="stats-number">{{ $news->where('status', 'draft')->count() }}</div>
                <div class="stats-label">مسودات</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon total news-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stats-number">{{ $news->total() }}</div>
                <div class="stats-label">إجمالي الأخبار</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon views">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stats-number">{{ $news->sum('views_count') }}</div>
                <div class="stats-label">إجمالي المشاهدات</div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="search-filters">
        <form method="GET" action="{{ route('admin.news.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">البحث في الأخبار</label>
                <input type="text" class="form-control search-input" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="البحث في العنوان أو الوصف أو المحتوى">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">حالة النشر</label>
                <select class="form-select filter-select" id="status" name="status">
                    <option value="">جميع الحالات</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>منشور</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>مسودة</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-search">
                    <i class="fas fa-search"></i> بحث
                </button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> مسح
                </a>
            </div>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- News Table -->
    <div class="achievements-table">
        @if($news->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>الخبر</th>
                            <th>الحالة</th>
                            <th>المشاهدات</th>
                            <th>تاريخ النشر</th>
                            <th>تاريخ الإنشاء</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $article)
                            <tr>
                                <td>
                                    <div class="achievement-card">
                                        <img src="{{ $article->cover_image_url }}" 
                                             alt="{{ $article->title }}" 
                                             class="achievement-image">
                                        <div class="achievement-info">
                                            <h6>{{ $article->title }}</h6>
                                            <p class="achievement-description">{{ Str::limit($article->short_description, 100) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $article->status === 'published' ? 'status-published' : 'status-draft' }}">
                                        <i class="fas fa-{{ $article->status === 'published' ? 'check-circle' : 'edit' }}"></i>
                                        {{ $article->status === 'published' ? 'منشور' : 'مسودة' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="views-count">
                                        <i class="fas fa-eye"></i> {{ $article->formatted_views }}
                                    </span>
                                </td>
                                <td>
                                    @if($article->published_at)
                                        <div class="date-display">{{ $article->published_at->format('Y-m-d') }}</div>
                                        <small class="text-muted">{{ $article->published_at->format('H:i') }}</small>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-display">{{ $article->created_at->format('Y-m-d') }}</div>
                                    <small class="text-muted">{{ $article->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.news.show', $article) }}" 
                                           class="btn-action btn-view" title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $article) }}" 
                                           class="btn-action btn-edit" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn-action {{ $article->status === 'published' ? 'btn-edit' : 'btn-view' }}"
                                                onclick="toggleStatus({{ $article->id }}, '{{ $article->status }}')"
                                                title="{{ $article->status === 'published' ? 'إلغاء النشر' : 'نشر' }}">
                                            <i class="fas fa-{{ $article->status === 'published' ? 'eye-slash' : 'check' }}"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn-action btn-delete" 
                                                onclick="deleteNews({{ $article->id }}, '{{ $article->title }}')"
                                                title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $news->withQueryString()->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3>لا توجد أخبار</h3>
                <p>ابدأ بإضافة أول خبر للموقع من خلال النقر على الزر أدناه</p>
                <a href="{{ route('admin.news.create') }}" class="btn btn-create">
                    <i class="fas fa-plus"></i> إضافة خبر جديد
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد حذف الخبر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف الخبر "<span id="newsTitle"></span>"؟</p>
                <p class="text-danger"><small><i class="fas fa-exclamation-triangle"></i> لا يمكن التراجع عن هذا الإجراء</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> حذف نهائياً
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function deleteNews(id, title) {
    document.getElementById('newsTitle').textContent = title;
    document.getElementById('deleteForm').action = `/admin/news/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function toggleStatus(id, currentStatus) {
    const action = currentStatus === 'published' ? 'إلغاء نشر' : 'نشر';
    const confirmMessage = `هل أنت متأكد من ${action} هذا الخبر؟`;
    
    if (confirm(confirmMessage)) {
        // Show loading overlay
        const loadingOverlay = document.createElement('div');
        loadingOverlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        `;
        loadingOverlay.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">جاري التحديث...</span></div>';
        document.body.appendChild(loadingOverlay);
        
        fetch(`/admin/news/${id}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Remove loading overlay
            if (loadingOverlay.parentNode) {
                loadingOverlay.parentNode.removeChild(loadingOverlay);
            }
            
            if (data.success) {
                // Show success message and reload
                alert(data.message);
                location.reload();
            } else {
                throw new Error(data.message || 'حدث خطأ غير متوقع');
            }
        })
        .catch(error => {
            // Remove loading overlay
            if (loadingOverlay.parentNode) {
                loadingOverlay.parentNode.removeChild(loadingOverlay);
            }
            
            console.error('Error:', error);
            alert('حدث خطأ أثناء تغيير حالة الخبر: ' + error.message);
        });
    }
}

// Auto dismiss alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(alert => {
            if (alert && typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                try {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                } catch (e) {
                    // Fallback: just hide the alert
                    alert.style.display = 'none';
                }
            }
        });
    }, 5000);
});

// Handle delete form submission
document.getElementById('deleteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const button = this.querySelector('button[type="submit"]');
    const originalHtml = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحذف...';
    button.disabled = true;
    
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: '_method=DELETE&_token=' + document.querySelector('meta[name="csrf-token"]').content
    })
    .then(response => {
        if (response.ok) {
            window.location.href = "{{ route('admin.news.index') }}";
        } else {
            throw new Error('Network response was not ok');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء حذف الخبر. يرجى المحاولة مرة أخرى.');
        
        // Restore button state
        button.innerHTML = originalHtml;
        button.disabled = false;
        
        // Close modal
        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
    });
});
</script>
@endsection
