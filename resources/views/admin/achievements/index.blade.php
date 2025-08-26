@extends('layouts.admin')

@section('title', 'إدارة الإنجازات')
@section('page_title', 'إدارة الإنجازات')
@section('page_subtitle', 'عرض وإدارة جميع الإنجازات')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/achievements.css') }}">
@endsection

@section('content')
<div class="container-fluid achievement-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-trophy"></i> إدارة الإنجازات</h1>
                    <p>عرض وإدارة جميع إنجازات الشركة والفعاليات المميزة</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.achievements.create') }}" class="btn btn-create">
                        <i class="fas fa-plus"></i> إضافة إنجاز جديد
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
                <div class="stats-number">{{ $achievements->where('status', 'published')->count() }}</div>
                <div class="stats-label">إنجازات منشورة</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon draft">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="stats-number">{{ $achievements->where('status', 'draft')->count() }}</div>
                <div class="stats-label">مسودات</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon total">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stats-number">{{ $achievements->total() }}</div>
                <div class="stats-label">إجمالي الإنجازات</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon views">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stats-number">{{ $achievements->sum('views_count') }}</div>
                <div class="stats-label">إجمالي المشاهدات</div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="search-filters">
        <form method="GET" action="{{ route('admin.achievements.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">البحث في الإنجازات</label>
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
                <a href="{{ route('admin.achievements.index') }}" class="btn btn-outline-secondary">
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

    <!-- Achievements Table -->
    <div class="achievements-table">
        @if($achievements->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>الإنجاز</th>
                            <th>الحالة</th>
                            <th>المشاهدات</th>
                            <th>تاريخ النشر</th>
                            <th>تاريخ الإنشاء</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($achievements as $achievement)
                            <tr>
                                <td>
                                    <div class="achievement-card">
                                        <img src="{{ $achievement->cover_image_url }}" 
                                             alt="{{ $achievement->title }}" 
                                             class="achievement-image">
                                        <div class="achievement-info">
                                            <h6>{{ $achievement->title }}</h6>
                                            <p class="achievement-description">{{ Str::limit($achievement->short_description, 100) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $achievement->status === 'published' ? 'status-published' : 'status-draft' }}">
                                        <i class="fas fa-{{ $achievement->status === 'published' ? 'check-circle' : 'edit' }}"></i>
                                        {{ $achievement->status === 'published' ? 'منشور' : 'مسودة' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="views-count">
                                        <i class="fas fa-eye"></i> {{ $achievement->formatted_views }}
                                    </span>
                                </td>
                                <td>
                                    @if($achievement->published_at)
                                        <div class="date-display">{{ $achievement->published_at->format('Y-m-d') }}</div>
                                        <small class="text-muted">{{ $achievement->published_at->format('H:i') }}</small>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-display">{{ $achievement->created_at->format('Y-m-d') }}</div>
                                    <small class="text-muted">{{ $achievement->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.achievements.show', $achievement) }}" 
                                           class="btn-action btn-view" title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.achievements.edit', $achievement) }}" 
                                           class="btn-action btn-edit" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn-action {{ $achievement->status === 'published' ? 'btn-edit' : 'btn-view' }}"
                                                onclick="toggleStatus({{ $achievement->id }}, '{{ $achievement->status }}')"
                                                title="{{ $achievement->status === 'published' ? 'إلغاء النشر' : 'نشر' }}">
                                            <i class="fas fa-{{ $achievement->status === 'published' ? 'eye-slash' : 'check' }}"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn-action btn-delete" 
                                                onclick="deleteAchievement({{ $achievement->id }}, '{{ $achievement->title }}')"
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
                {{ $achievements->withQueryString()->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>لا توجد إنجازات</h3>
                <p>ابدأ بإضافة أول إنجاز للشركة من خلال النقر على الزر أدناه</p>
                <a href="{{ route('admin.achievements.create') }}" class="btn btn-create">
                    <i class="fas fa-plus"></i> إضافة إنجاز جديد
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
                <h5 class="modal-title">تأكيد حذف الإنجاز</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف الإنجاز "<span id="achievementTitle"></span>"؟</p>
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
function deleteAchievement(id, title) {
    document.getElementById('achievementTitle').textContent = title;
    document.getElementById('deleteForm').action = `/admin/achievements/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function toggleStatus(id, currentStatus) {
    const action = currentStatus === 'published' ? 'إلغاء نشر' : 'نشر';
    const confirmMessage = `هل أنت متأكد من ${action} هذا الإنجاز؟`;
    
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
        
        fetch(`/admin/achievements/${id}/toggle-status`, {
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
            alert('حدث خطأ أثناء تغيير حالة الإنجاز: ' + error.message);
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
</script>
@endsection
