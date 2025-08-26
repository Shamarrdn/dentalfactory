@extends('layouts.admin')

@section('title', $news->title)
@section('page_title', 'عرض الخبر')
@section('page_subtitle', $news->title)

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/news.css') }}">
<style>
.news-content {
    font-size: 16px;
    line-height: 1.8;
    color: #333;
}
.news-content img {
    max-width: 100%;
    height: auto;
    margin: 15px 0;
    border-radius: 8px;
}
.news-content p {
    margin-bottom: 15px;
}
.news-content h1, .news-content h2, .news-content h3 {
    margin-top: 25px;
    margin-bottom: 15px;
    color: #2c3e50;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- News Header -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-{{ $news->status === 'published' ? 'success' : 'warning' }} fs-6">
                                {{ $news->status === 'published' ? 'منشور' : 'مسودة' }}
                            </span>
                            <div class="text-muted">
                                @if($news->published_at)
                                    <small>تاريخ النشر: {{ $news->arabic_published_date }}</small>
                                @endif
                            </div>
                        </div>
                        
                        <h1 class="display-6 mb-3">{{ $news->title }}</h1>
                        
                        <p class="lead text-muted">{{ $news->short_description }}</p>
                        
                        @if($news->cover_image)
                            <div class="text-center mb-4">
                                <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" 
                                     class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                            </div>
                        @endif
                    </div>

                    <!-- News Content -->
                    <div class="news-content">
                        {!! $news->content !!}
                    </div>

                    <!-- News Meta -->
                    <div class="border-top pt-4 mt-4">
                        <div class="row text-muted">
                            <div class="col-md-6">
                                <small>
                                    <i class="fas fa-calendar"></i>
                                    تاريخ الإنشاء: {{ $news->created_at->format('Y-m-d H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6 text-end">
                                <small>
                                    <i class="fas fa-clock"></i>
                                    وقت القراءة المتوقع: {{ $news->reading_time }} دقيقة
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Actions -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">الإجراءات</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> تعديل الخبر
                        </a>
                        
                        @if($news->status === 'published')
                            <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="btn btn-outline-success">
                                <i class="fas fa-external-link-alt"></i> عرض في الموقع
                            </a>
                        @endif
                        
                        <button type="button" class="btn btn-outline-{{ $news->status === 'published' ? 'warning' : 'success' }}"
                                onclick="toggleStatus()">
                            <i class="fas fa-{{ $news->status === 'published' ? 'eye-slash' : 'check' }}"></i>
                            {{ $news->status === 'published' ? 'إلغاء النشر' : 'نشر الخبر' }}
                        </button>
                        
                        <hr>
                        
                        <button type="button" class="btn btn-outline-danger" onclick="deleteNews()">
                            <i class="fas fa-trash"></i> حذف الخبر
                        </button>
                        
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-right"></i> العودة للقائمة
                        </a>
                    </div>
                </div>
            </div>

            <!-- News Information -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">معلومات الخبر</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>الحالة:</strong></td>
                            <td>
                                <span class="badge bg-{{ $news->status === 'published' ? 'success' : 'warning' }}">
                                    {{ $news->status === 'published' ? 'منشور' : 'مسودة' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>تاريخ الإنشاء:</strong></td>
                            <td>{{ $news->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @if($news->published_at)
                        <tr>
                            <td><strong>تاريخ النشر:</strong></td>
                            <td>{{ $news->published_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>آخر تحديث:</strong></td>
                            <td>{{ $news->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>الرابط:</strong></td>
                            <td><small class="text-muted">{{ $news->slug }}</small></td>
                        </tr>
                        <tr>
                            <td><strong>وقت القراءة:</strong></td>
                            <td>{{ $news->reading_time }} دقيقة</td>
                        </tr>
                        <tr>
                            <td><strong>عدد الكلمات:</strong></td>
                            <td>{{ str_word_count(strip_tags($news->content)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- SEO Preview -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">معاينة SEO</h6>
                </div>
                <div class="card-body">
                    <div class="seo-preview">
                        <div class="seo-title text-primary fw-bold">{{ $news->title }}</div>
                        <div class="seo-url text-success small">{{ url('news/' . $news->slug) }}</div>
                        <div class="seo-description text-muted small">{{ $news->short_description }}</div>
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
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف الخبر "<strong>{{ $news->title }}</strong>"؟</p>
                <p class="text-danger"><small>لا يمكن التراجع عن هذا الإجراء</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form action="{{ route('admin.news.destroy', $news) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleStatus() {
    const currentStatus = '{{ $news->status }}';
    const action = currentStatus === 'published' ? 'إلغاء نشر' : 'نشر';
    
    if (confirm(`هل أنت متأكد من ${action} هذا الخبر؟`)) {
        fetch(`{{ route('admin.news.toggle-status', $news) }}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('حدث خطأ أثناء تغيير حالة الخبر');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء تغيير حالة الخبر');
        });
    }
}

function deleteNews() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection
