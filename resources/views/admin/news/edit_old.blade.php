@extends('layouts.admin')

@section('title', 'تعديل خبر')
@section('page_title', 'تعديل خبر')
@section('page_subtitle', 'تعديل تفاصيل الخبر')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/news.css') }}">
<!-- Quill.js - Free WYSIWYG Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endsection

@section('content')
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
                            <i class="fas fa-edit text-primary"></i> تعديل الخبر: {{ $news->title }}
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
                            <div id="quill-editor" style="height: 400px; direction: rtl;"></div>
                            <textarea class="form-control @error('content') is-invalid @enderror d-none" 
                                      id="content" name="content" required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-right"></i> العودة
                            </a>
                            <div>
                                <button type="submit" name="status" value="draft" class="btn btn-outline-primary me-2">
                                    <i class="fas fa-save"></i> حفظ كمسودة
                                </button>
                                <button type="submit" name="status" value="published" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> نشر
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Publishing Options -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">خيارات النشر</h6>
                </div>
                <div class="card-body">
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

                    <!-- Current Status -->
                    <div class="mb-3">
                        <label class="form-label">الحالة الحالية</label>
                        <div>
                            <span class="badge bg-{{ $news->status === 'published' ? 'success' : 'warning' }} fs-6">
                                {{ $news->status === 'published' ? 'منشور' : 'مسودة' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cover Image -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">الصورة الرئيسية</h6>
                </div>
                <div class="card-body">
                    <!-- Current Image -->
                    @if($news->cover_image)
                        <div class="mb-3">
                            <label class="form-label">الصورة الحالية</label>
                            <div class="text-center">
                                <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" 
                                     class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">
                            {{ $news->cover_image ? 'تغيير الصورة' : 'رفع صورة' }}
                        </label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                               id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
                        <div class="form-text">الصيغ المدعومة: JPEG, PNG, JPG, GIF (الحد الأقصى: 2MB)</div>
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="text-center" style="display: none;">
                        <img id="preview" src="#" alt="معاينة الصورة" class="img-fluid rounded" style="max-height: 200px;">
                        <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeImage()">
                            <i class="fas fa-trash"></i> إزالة الصورة الجديدة
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">إجراءات سريعة</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.news.show', $news) }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-eye"></i> معاينة الخبر
                        </a>
                        <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-external-link-alt"></i> عرض في الموقع
                        </a>
                        <button type="button" class="btn btn-outline-{{ $news->status === 'published' ? 'warning' : 'success' }} btn-sm"
                                onclick="toggleStatus()">
                            <i class="fas fa-{{ $news->status === 'published' ? 'eye-slash' : 'check' }}"></i>
                            {{ $news->status === 'published' ? 'إلغاء النشر' : 'نشر الخبر' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Initialize Quill.js
var quill = new Quill('#quill-editor', {
    theme: 'snow',
    direction: 'rtl',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            ['blockquote', 'code-block'],
            ['link', 'image', 'video'],
            ['clean']
        ]
    },
    placeholder: 'اكتب محتوى الخبر هنا...'
});

// Set initial content if available
var initialContent = document.getElementById('content').value;
if (initialContent) {
    quill.root.innerHTML = initialContent;
}

// Update hidden textarea when content changes
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
        };
        reader.readAsDataURL(file);
    }
}

// Remove image function
function removeImage() {
    document.getElementById('cover_image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
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

// Character counter for short description
document.getElementById('short_description').addEventListener('input', function() {
    const maxLength = 500;
    const currentLength = this.value.length;
    const remaining = maxLength - currentLength;
    
    // Update counter display
    let counter = this.parentNode.querySelector('.char-counter');
    if (!counter) {
        counter = document.createElement('div');
        counter.className = 'char-counter form-text';
        this.parentNode.appendChild(counter);
    }
    
    counter.textContent = `الأحرف المتبقية: ${remaining}`;
    counter.className = `char-counter form-text ${remaining < 0 ? 'text-danger' : remaining < 50 ? 'text-warning' : 'text-muted'}`;
});

// Initialize character counter
document.getElementById('short_description').dispatchEvent(new Event('input'));
</script>
@endsection
