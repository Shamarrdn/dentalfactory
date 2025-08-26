@extends('layouts.admin')

@section('title', 'إدارة الصفحات')
@section('page_title', 'إدارة الصفحات')
@section('page_subtitle', 'عرض وإدارة جميع الصفحات الثابتة')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/pages.css') }}">
@endsection

@section('content')
<div class="container-fluid pages-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-file-alt"></i> إدارة الصفحات</h1>
                    <p>عرض وإدارة جميع الصفحات الثابتة في الموقع</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-create">
                        <i class="fas fa-plus"></i> إضافة صفحة جديدة
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
                <div class="stats-number">{{ $pages->where('status', 'published')->count() }}</div>
                <div class="stats-label">صفحات منشورة</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon draft">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="stats-number">{{ $pages->where('status', 'draft')->count() }}</div>
                <div class="stats-label">مسودات</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon total">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stats-number">{{ $pages->total() }}</div>
                <div class="stats-label">إجمالي الصفحات</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon recent">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-number">{{ $pages->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                <div class="stats-label">صفحات هذا الأسبوع</div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="filters-section">
        <form method="GET" action="{{ route('admin.pages.index') }}" class="filters-form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="search">البحث</label>
                        <input type="text" id="search" name="search" class="form-control" 
                               placeholder="البحث في العنوان أو المحتوى..."
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status">الحالة</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">جميع الحالات</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشورة</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-filter">
                                <i class="fas fa-search"></i> بحث
                            </button>
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-reset">
                                <i class="fas fa-undo"></i> إعادة تعيين
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-reorder w-100" id="enableSortBtn">
                            <i class="fas fa-sort"></i> ترتيب الصفحات
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Pages Table -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-table"></i> قائمة الصفحات</h3>
        </div>
        
        @if($pages->count() > 0)
            <div class="table-responsive">
                <table class="table" id="pagesTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-grip-vertical"></i></th>
                            <th>العنوان</th>
                            <th>الرابط</th>
                            <th>الحالة</th>
                            <th>الترتيب</th>
                            <th>آخر تعديل</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-pages">
                        @foreach($pages as $page)
                            <tr data-id="{{ $page->id }}">
                                <td class="drag-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </td>
                                <td>
                                    <div class="page-title">
                                        <strong>{{ $page->title }}</strong>
                                        @if($page->meta_title)
                                            <small class="text-muted d-block">SEO: {{ Str::limit($page->meta_title, 50) }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <code class="page-slug">/page/{{ $page->slug }}</code>
                                    <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $page->status }}">
                                        @if($page->status == 'published')
                                            <i class="fas fa-check-circle"></i> منشورة
                                        @else
                                            <i class="fas fa-edit"></i> مسودة
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $page->sort_order }}</span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <span class="date">{{ $page->updated_at->format('Y/m/d') }}</span>
                                        <small class="time text-muted">{{ $page->updated_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.pages.show', $page) }}" class="btn btn-sm btn-info" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-warning" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pages.toggle-status', $page) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $page->status == 'published' ? 'btn-secondary' : 'btn-success' }}" 
                                                    title="{{ $page->status == 'published' ? 'إخفاء' : 'نشر' }}">
                                                <i class="fas {{ $page->status == 'published' ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" 
                                              class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $pages->links() }}
            </div>
        @else
            <div class="no-data">
                <div class="no-data-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>لا توجد صفحات</h3>
                <p>لم يتم العثور على أي صفحات. ابدأ بإنشاء صفحة جديدة.</p>
                <a href="{{ route('admin.pages.create') }}" class="btn btn-create">
                    <i class="fas fa-plus"></i> إضافة صفحة جديدة
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('هل أنت متأكد من حذف هذه الصفحة؟ هذا الإجراء لا يمكن التراجع عنه.')) {
                this.submit();
            }
        });
    });

    // Sortable functionality
    let sortable;
    const enableSortBtn = document.getElementById('enableSortBtn');
    const table = document.getElementById('pagesTable');
    const tbody = document.getElementById('sortable-pages');

    if (enableSortBtn && tbody) {
        enableSortBtn.addEventListener('click', function() {
            if (!sortable) {
                // Enable sorting
                sortable = Sortable.create(tbody, {
                    handle: '.drag-handle',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    onStart: function() {
                        table.classList.add('sorting-active');
                    },
                    onEnd: function() {
                        table.classList.remove('sorting-active');
                        updateSortOrder();
                    }
                });
                enableSortBtn.innerHTML = '<i class="fas fa-save"></i> حفظ الترتيب';
                enableSortBtn.className = 'btn btn-success w-100';
                table.classList.add('sortable-enabled');
            } else {
                // Disable sorting and save
                saveSortOrder();
            }
        });
    }

    function updateSortOrder() {
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            const orderBadge = row.querySelector('.badge');
            if (orderBadge) {
                orderBadge.textContent = index + 1;
            }
        });
    }

    function saveSortOrder() {
        const rows = tbody.querySelectorAll('tr');
        const pages = [];
        
        rows.forEach((row, index) => {
            pages.push({
                id: row.dataset.id,
                sort_order: index + 1
            });
        });

        fetch('{{ route("admin.pages.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ pages: pages })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reset sorting
                sortable.destroy();
                sortable = null;
                enableSortBtn.innerHTML = '<i class="fas fa-sort"></i> ترتيب الصفحات';
                enableSortBtn.className = 'btn btn-secondary w-100';
                table.classList.remove('sortable-enabled');
                
                // Show success message
                showNotification('تم حفظ الترتيب بنجاح', 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء حفظ الترتيب', 'error');
        });
    }

    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} notification-toast`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            ${message}
        `;
        
        // Add to page
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
</script>
@endsection
