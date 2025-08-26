@extends('layouts.admin')

@section('title', 'عرض الصفحة - ' . $page->title)
@section('page_title', 'عرض الصفحة')
@section('page_subtitle', $page->title)

@section('styles')
<link href="{{ asset('assets/css/admin/pages.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid pages-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-eye"></i> عرض الصفحة</h1>
                    <p>{{ $page->title }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-outline-info me-2">
                        <i class="fas fa-external-link-alt"></i> معاينة الصفحة
                    </a>
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit"></i> تعديل
                    </a>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-right"></i> العودة للقائمة
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Page Content -->
            <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #2E8B57 0%, #3CB371 50%, #20B2AA 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-alt"></i> محتوى الصفحة
                    </h5>
                </div>
                <div class="card-body" style="padding: 2rem;">
                    <h2 class="page-title">{{ $page->title }}</h2>
                    <hr>
                    <div class="page-content">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            @if($page->meta_title || $page->meta_description || $page->meta_keywords)
            <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FF6B9D 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-search"></i> معلومات SEO
                    </h5>
                </div>
                <div class="card-body" style="padding: 2rem;">
                    @if($page->meta_title)
                        <div class="seo-item mb-3">
                            <strong>عنوان SEO:</strong>
                            <p class="mb-1">{{ $page->meta_title }}</p>
                        </div>
                    @endif
                    
                    @if($page->meta_description)
                        <div class="seo-item mb-3">
                            <strong>وصف SEO:</strong>
                            <p class="mb-1">{{ $page->meta_description }}</p>
                        </div>
                    @endif
                    
                    @if($page->meta_keywords)
                        <div class="seo-item">
                            <strong>الكلمات المفتاحية:</strong>
                            <div class="keywords-list">
                                @foreach(explode(',', $page->meta_keywords) as $keyword)
                                    <span class="badge bg-secondary me-1 mb-1">{{ trim($keyword) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Page Information -->
            <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #4ECDC4 0%, #44A08D 50%, #093637 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> معلومات الصفحة
                    </h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <div class="info-item">
                        <strong>العنوان:</strong>
                        <span>{{ $page->title }}</span>
                    </div>
                    <div class="info-item">
                        <strong>الرابط المميز:</strong>
                        <code>/page/{{ $page->slug }}</code>
                    </div>
                    <div class="info-item">
                        <strong>الحالة:</strong>
                        <span class="badge bg-{{ $page->status == 'published' ? 'success' : 'warning' }}">
                            {{ $page->status == 'published' ? 'منشورة' : 'مسودة' }}
                        </span>
                    </div>
                    <div class="info-item">
                        <strong>ترتيب العرض:</strong>
                        <span class="badge bg-secondary">{{ $page->sort_order }}</span>
                    </div>
                    <div class="info-item">
                        <strong>تاريخ الإنشاء:</strong>
                        <span>{{ $page->created_at->format('Y/m/d - H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <strong>آخر تعديل:</strong>
                        <span>{{ $page->updated_at->format('Y/m/d - H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt"></i> إجراءات سريعة
                    </h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> تعديل الصفحة
                        </a>
                        
                        <form action="{{ route('admin.pages.toggle-status', $page) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $page->status == 'published' ? 'secondary' : 'success' }} w-100">
                                <i class="fas {{ $page->status == 'published' ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                {{ $page->status == 'published' ? 'إخفاء الصفحة' : 'نشر الصفحة' }}
                            </button>
                        </form>
                        
                        <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-outline-info">
                            <i class="fas fa-external-link-alt"></i> معاينة في الموقع
                        </a>
                        
                        <hr>
                        
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="fas fa-trash"></i> حذف الصفحة
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar"></i> إحصائيات
                    </h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <div class="stats-item">
                        <div class="stats-label">عدد الكلمات</div>
                        <div class="stats-value">{{ str_word_count(strip_tags($page->content)) }}</div>
                    </div>
                    <div class="stats-item">
                        <div class="stats-label">عدد الأحرف</div>
                        <div class="stats-value">{{ strlen(strip_tags($page->content)) }}</div>
                    </div>
                    <div class="stats-item">
                        <div class="stats-label">تقدير وقت القراءة</div>
                        <div class="stats-value">{{ ceil(str_word_count(strip_tags($page->content)) / 200) }} دقيقة</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelector('.delete-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        if (confirm('هل أنت متأكد من حذف هذه الصفحة؟ هذا الإجراء لا يمكن التراجع عنه.')) {
            this.submit();
        }
    });
});
</script>

<style>
.page-title {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.page-content {
    line-height: 1.8;
    font-size: 1.1em;
    color: #34495e;
}

.page-content h1, .page-content h2, .page-content h3,
.page-content h4, .page-content h5, .page-content h6 {
    color: #2c3e50;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.page-content p {
    margin-bottom: 1rem;
}

.page-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}

.page-content blockquote {
    border-left: 4px solid #3498db;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 4px;
}

.info-item {
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
}

.info-item strong {
    font-size: 0.9em;
    color: #495057;
    margin-bottom: 5px;
}

.info-item code {
    background-color: #f8f9fa;
    color: #e83e8c;
    padding: 2px 4px;
    border-radius: 3px;
    font-size: 0.9em;
}

.seo-item {
    margin-bottom: 1rem;
}

.seo-item strong {
    color: #495057;
    font-size: 0.95em;
}

.keywords-list .badge {
    font-size: 0.8em;
}

.stats-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.stats-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.stats-label {
    font-size: 0.9em;
    color: #6c757d;
}

.stats-value {
    font-weight: bold;
    color: #495057;
}
</style>
@endsection
