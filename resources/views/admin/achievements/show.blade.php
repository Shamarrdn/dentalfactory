@extends('layouts.admin')

@section('title', 'عرض الإنجاز')
@section('page_title', 'عرض الإنجاز')
@section('page_subtitle', $achievement->title)

@section('styles')
<link href="{{ asset('assets/css/admin/achievements.css') }}" rel="stylesheet">
<style>
.achievement-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.achievement-content img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 1rem 0;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.meta-card {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.action-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}
</style>
@endsection

@section('content')
<div class="container-fluid achievement-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-trophy"></i> {{ $achievement->title }}</h1>
                    <p>{{ $achievement->short_description }}</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('admin.achievements.index') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-arrow-right"></i> العودة للقائمة
                    </a>
                    <a href="{{ route('admin.achievements.edit', $achievement) }}" class="btn btn-outline-light">
                        <i class="fas fa-edit"></i> تعديل
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Achievement Image -->
            @if($achievement->cover_image)
            <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden;">
                <img src="{{ $achievement->cover_image_url }}" alt="{{ $achievement->title }}" 
                     style="width: 100%; height: 400px; object-fit: cover;">
            </div>
            @endif

            <!-- Achievement Content -->
            <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #2E8B57 0%, #3CB371 50%, #20B2AA 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-alt"></i> تفاصيل الإنجاز
                    </h5>
                </div>
                <div class="card-body" style="padding: 2rem;">
                    <div class="achievement-content">
                        {!! $achievement->content !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status and Meta Information -->
            <div class="card meta-card mb-4">
                <div class="card-body" style="padding: 1.5rem;">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-info-circle text-primary"></i> معلومات الإنجاز
                    </h6>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label small text-muted">الحالة:</label>
                        <div>
                            <span class="status-badge {{ $achievement->status === 'published' ? 'status-published' : 'status-draft' }}">
                                <i class="fas fa-{{ $achievement->status === 'published' ? 'check-circle' : 'edit' }}"></i>
                                {{ $achievement->status === 'published' ? 'منشور' : 'مسودة' }}
                            </span>
                        </div>
                    </div>

                    <!-- Publication Date -->
                    <div class="mb-3">
                        <label class="form-label small text-muted">تاريخ النشر:</label>
                        <div class="fw-bold">
                            @if($achievement->published_at)
                                {{ $achievement->published_at->format('Y-m-d H:i') }}
                                <br><small class="text-muted">{{ $achievement->arabic_published_date }}</small>
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </div>
                    </div>

                    <!-- Views -->
                    <div class="mb-3">
                        <label class="form-label small text-muted">عدد المشاهدات:</label>
                        <div class="views-count">
                            <i class="fas fa-eye"></i> {{ $achievement->formatted_views }}
                        </div>
                    </div>

                    <!-- Creation Date -->
                    <div class="mb-3">
                        <label class="form-label small text-muted">تاريخ الإنشاء:</label>
                        <div class="fw-bold">{{ $achievement->created_at->format('Y-m-d H:i') }}</div>
                    </div>

                    <!-- Last Update -->
                    <div class="mb-3">
                        <label class="form-label small text-muted">آخر تحديث:</label>
                        <div class="fw-bold">{{ $achievement->updated_at->format('Y-m-d H:i') }}</div>
                    </div>

                    <!-- Reading Time -->
                    <div class="mb-0">
                        <label class="form-label small text-muted">مدة القراءة المقدرة:</label>
                        <div class="fw-bold">
                            <i class="fas fa-clock text-primary"></i> {{ $achievement->reading_time }} 
                            {{ $achievement->reading_time == 1 ? 'دقيقة' : 'دقائق' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card action-card mb-4">
                <div class="card-body" style="padding: 1.5rem;">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-bolt text-warning"></i> إجراءات سريعة
                    </h6>

                    <div class="d-grid gap-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.achievements.edit', $achievement) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit"></i> تعديل الإنجاز
                        </a>

                        <!-- Toggle Status Button -->
                        <button type="button" class="btn btn-outline-{{ $achievement->status === 'published' ? 'warning' : 'success' }}"
                                onclick="toggleStatus({{ $achievement->id }}, '{{ $achievement->status }}')">
                            <i class="fas fa-{{ $achievement->status === 'published' ? 'eye-slash' : 'check' }}"></i>
                            {{ $achievement->status === 'published' ? 'إلغاء النشر' : 'نشر الإنجاز' }}
                        </button>

                        <!-- View Public Page Button -->
                        @if($achievement->status === 'published')
                        <a href="{{ route('achievements.show', $achievement->slug) }}" target="_blank" class="btn btn-outline-info">
                            <i class="fas fa-external-link-alt"></i> عرض في الموقع
                        </a>
                        @endif

                        <!-- Delete Button -->
                        <button type="button" class="btn btn-outline-danger" 
                                onclick="deleteAchievement({{ $achievement->id }}, '{{ $achievement->title }}')">
                            <i class="fas fa-trash"></i> حذف الإنجاز
                        </button>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <div class="card action-card">
                <div class="card-body" style="padding: 1.5rem;">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-search text-success"></i> معلومات SEO
                    </h6>

                    <div class="mb-3">
                        <label class="form-label small text-muted">الرابط الدائم:</label>
                        <div class="small">
                            <code>{{ url('/achievements/' . $achievement->slug) }}</code>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">عدد الكلمات:</label>
                        <div class="fw-bold">{{ str_word_count(strip_tags($achievement->content)) }} كلمة</div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small text-muted">عدد الأحرف:</label>
                        <div class="fw-bold">{{ strlen(strip_tags($achievement->content)) }} حرف</div>
                    </div>
                </div>
            </div>
        </div>
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
        // Show loading state
        const button = event.target;
        const originalHtml = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحديث...';
        button.disabled = true;
        
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
            if (data.success) {
                // Show success message and reload
                alert(data.message);
                location.reload();
            } else {
                throw new Error(data.message || 'حدث خطأ غير متوقع');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء تغيير حالة الإنجاز: ' + error.message);
            
            // Restore button state
            button.innerHTML = originalHtml;
            button.disabled = false;
        });
    }
}

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
            window.location.href = "{{ route('admin.achievements.index') }}";
        } else {
            throw new Error('Network response was not ok');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء حذف الإنجاز. يرجى المحاولة مرة أخرى.');
        
        // Restore button state
        button.innerHTML = originalHtml;
        button.disabled = false;
        
        // Close modal
        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
    });
});
</script>
@endsection
