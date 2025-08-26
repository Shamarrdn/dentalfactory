@extends('layouts.admin')

@section('title', 'تعديل خبر')

@section('styles')
    <!-- News Admin CSS -->
    <link href="{{ asset('assets/css/admin/news.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="news-page">
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="fas fa-edit text-primary"></i>
            تعديل الخبر
        </h1>
    </div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" id="newsForm">
                @csrf
                @method('PUT')
                
                <!-- القسم الموحد: تفاصيل الخبر وجميع الخيارات -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit text-primary"></i> تعديل: {{ Str::limit($news->title, 50) }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- العمود الأيسر: تفاصيل الخبر -->
                            <div class="col-lg-8">
                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">العنوان <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $news->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Short Description -->
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">الوصف القصير <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                              id="short_description" name="short_description" rows="3" 
                                              placeholder="وصف قصير يظهر في كارت العرض (الحد الأقصى 500 حرف)" required>{{ old('short_description', $news->short_description) }}</textarea>
                                    <div class="form-text">الحد الأقصى: 500 حرف</div>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Content -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">المحتوى <span class="text-danger">*</span></label>
                                    <div id="quill-editor" style="height: 300px; direction: rtl;"></div>
                                    <textarea class="form-control @error('content') is-invalid @enderror d-none" 
                                              id="content" name="content" required>{{ old('content', $news->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                                                         <!-- العمود الأيمن: خيارات متكاملة -->
                             <div class="col-lg-4">
                                 <div class="card h-100">
                                     <div class="card-body">
                                         <!-- خيارات النشر -->
                                         <div class="mb-4">
                                             <h6 class="text-primary mb-3 border-bottom pb-2">
                                                 <i class="fas fa-calendar-alt"></i> خيارات النشر
                                             </h6>
                                             
                                             <div class="mb-3">
                                                 <label for="published_at" class="form-label">تاريخ النشر</label>
                                                 <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                                                        id="published_at" name="published_at" 
                                                        value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
                                                 <div class="form-text">اتركه فارغاً للنشر الآن</div>
                                                 @error('published_at')
                                                     <div class="invalid-feedback">{{ $message }}</div>
                                                 @enderror
                                             </div>
                                             
                                             <div class="mb-3">
                                                 <label class="form-label">الحالة الحالية</label>
                                                 <div>
                                                     <span class="badge bg-{{ $news->status === 'published' ? 'success' : 'warning' }} fs-6">
                                                         <i class="fas fa-{{ $news->status === 'published' ? 'check-circle' : 'clock' }}"></i>
                                                         {{ $news->status === 'published' ? 'منشور' : 'مسودة' }}
                                                     </span>
                                                 </div>
                                             </div>
                                             
                                             <div class="mb-3">
                                                 <label class="form-label">إحصائيات</label>
                                                 <div class="small text-muted">
                                                     <div><i class="fas fa-eye"></i> {{ $news->formatted_views }} مشاهدة</div>
                                                     <div><i class="fas fa-calendar"></i> {{ $news->created_at->diffForHumans() }}</div>
                                                 </div>
                                             </div>
                                         </div>

                                         <!-- الصورة الرئيسية -->
                                         <div class="mb-4">
                                             <h6 class="text-warning mb-3 border-bottom pb-2">
                                                 <i class="fas fa-image"></i> الصورة الرئيسية
                                             </h6>
                                             
                                             @if($news->cover_image)
                                                 <div class="mb-3">
                                                     <label class="form-label">الصورة الحالية</label>
                                                     <div class="text-center">
                                                         <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" 
                                                              class="img-fluid rounded border" style="max-height: 120px;">
                                                     </div>
                                                 </div>
                                             @endif
                                             
                                             <div class="mb-3">
                                                 <label for="cover_image" class="form-label">{{ $news->cover_image ? 'تغيير الصورة' : 'رفع صورة' }}</label>
                                                 <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                                        id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
                                                 <div class="form-text">JPEG, PNG, JPG, GIF (أقصى: 2MB)</div>
                                                 @error('cover_image')
                                                     <div class="invalid-feedback">{{ $message }}</div>
                                                 @enderror
                                             </div>
                                             
                                             <!-- معاينة الصورة الجديدة -->
                                             <div id="imagePreview" class="text-center" style="display: none;">
                                                 <label class="form-label">معاينة الصورة الجديدة</label>
                                                 <div class="border rounded p-2">
                                                     <img id="preview" src="#" alt="معاينة الصورة" class="img-fluid rounded" style="max-height: 120px;">
                                                     <div class="mt-2">
                                                         <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                                             <i class="fas fa-trash"></i> إلغاء
                                                         </button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>

                                         <!-- الإجراءات السريعة -->
                                         <div class="mb-4">
                                             <h6 class="text-info mb-3 border-bottom pb-2">
                                                 <i class="fas fa-bolt"></i> إجراءات سريعة
                                             </h6>
                                             
                                             <div class="d-grid gap-2">
                                                 <button type="button" class="btn btn-outline-success btn-sm" onclick="toggleStatus()">
                                                     <i class="fas fa-{{ $news->status === 'published' ? 'eye-slash' : 'eye' }}"></i> 
                                                     {{ $news->status === 'published' ? 'إلغاء النشر' : 'نشر فوري' }}
                                                 </button>
                                                 <button type="button" class="btn btn-outline-warning btn-sm" onclick="previewNews()">
                                                     <i class="fas fa-eye"></i> معاينة سريعة
                                                 </button>
                                                 <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                                     <i class="fas fa-external-link-alt"></i> عرض في الموقع
                                                 </a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>

                <!-- أزرار الحفظ -->
                <div class="text-center mt-4 mb-4">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-right"></i> العودة
                        </a>
                        <button type="submit" name="status" value="draft" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-save"></i> حفظ كمسودة
                        </button>
                        <button type="submit" name="status" value="published" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i> نشر الآن
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<!-- Quill.js JavaScript -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script>
// Initialize Quill editor
var quill = new Quill('#quill-editor', {
    theme: 'snow',
    direction: 'rtl',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['blockquote', 'code-block'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            ['link', 'image', 'video'],
            ['clean']
        ]
    }
});

// Set initial content
var initialContent = `{!! addslashes($news->content) !!}`;
if (initialContent) {
    quill.root.innerHTML = initialContent;
}

// Update hidden textarea when quill content changes
quill.on('text-change', function() {
    document.getElementById('content').value = quill.root.innerHTML;
});

// Image preview function
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

// Remove image function
function removeImage() {
    document.getElementById('cover_image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
}

// Preview news function
function previewNews() {
    const title = document.getElementById('title').value;
    const description = document.getElementById('short_description').value;
    const content = quill.root.innerHTML;
    
    if (!title || !description || !content) {
        alert('يرجى ملء البيانات الأساسية قبل المعاينة');
        return;
    }
    
    const previewWindow = window.open('', '_blank', 'width=800,height=600');
    previewWindow.document.write(`
        <html dir="rtl">
        <head>
            <title>معاينة: ${title}</title>
            <style>
                body { font-family: Tahoma, Arial, sans-serif; margin: 20px; }
                .title { color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
                .description { color: #666; font-style: italic; margin: 20px 0; }
                .content { line-height: 1.8; }
            </style>
        </head>
        <body>
            <h1 class="title">${title}</h1>
            <p class="description">${description}</p>
            <div class="content">${content}</div>
        </body>
        </html>
    `);
}

// Toggle status function
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

// Form submission handling with proper file support for edit
document.getElementById('newsForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default submission
    
    // Update content from Quill
    document.getElementById('content').value = quill.root.innerHTML;
    
    // Basic validation
    const title = document.getElementById('title').value.trim();
    const shortDescription = document.getElementById('short_description').value.trim();
    const content = quill.getText().trim();
    
    if (!title || !shortDescription || !content) {
        alert('يرجى ملء جميع الحقول المطلوبة');
        return false;
    }
    
    if (shortDescription.length > 500) {
        alert('الوصف القصير يجب أن يكون أقل من 500 حرف');
        return false;
    }
    
    // Get the clicked button to preserve status
    const clickedButton = document.activeElement;
    const status = clickedButton.getAttribute('value') || 'draft';
    
    // Create FormData manually to ensure file is included
    const formData = new FormData();
    
    // Add all form fields
    formData.append('_token', document.querySelector('input[name="_token"]').value);
    formData.append('_method', 'PUT'); // Important for Laravel update
    formData.append('title', document.getElementById('title').value);
    formData.append('short_description', document.getElementById('short_description').value);
    formData.append('content', document.getElementById('content').value);
    formData.append('status', status);
    
    // Add published_at if exists
    const publishedAt = document.getElementById('published_at').value;
    if (publishedAt) {
        formData.append('published_at', publishedAt);
    }
    
    // Add file if selected (for update, file is optional)
    const fileInput = document.getElementById('cover_image');
    if (fileInput.files && fileInput.files.length > 0) {
        formData.append('cover_image', fileInput.files[0]);
        console.log('File added to FormData (edit):', fileInput.files[0].name, fileInput.files[0].size + ' bytes');
    }
    
    // Log for debugging
    console.log('Edit FormData contents:');
    for (let [key, value] of formData.entries()) {
        if (key === 'cover_image') {
            console.log(key + ':', value instanceof File ? `File: ${value.name} (${value.size} bytes)` : value);
        } else {
            console.log(key + ':', typeof value === 'string' ? value.substring(0, 50) + '...' : value);
        }
    }
    
    // Submit using fetch
    fetch(this.action, {
        method: 'POST', // Laravel will handle _method=PUT
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (response.ok) {
            // Redirect to news index on success
            window.location.href = '/admin/news';
        } else {
            alert('حدث خطأ أثناء التحديث');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء التحديث');
    });
});
</script>
@endsection
