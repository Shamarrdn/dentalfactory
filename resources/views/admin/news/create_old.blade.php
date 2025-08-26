@extends('layouts.admin')

@section('title', 'إضافة خبر جديد')
@section('page_title', 'إضافة خبر جديد')
@section('page_subtitle', 'إنشاء خبر جديد ونشره')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/news.css') }}">
<!-- Quill.js - Free WYSIWYG Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">تفاصيل الخبر</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">العنوان <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label for="short_description" class="form-label">الوصف القصير <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                      id="short_description" name="short_description" rows="3" 
                                      placeholder="وصف قصير يظهر في كارت العرض (الحد الأقصى 500 حرف)" required>{{ old('short_description') }}</textarea>
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
                                      id="content" name="content" required>{{ old('content') }}</textarea>
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
                               id="published_at" name="published_at" value="{{ old('published_at') }}">
                        <div class="form-text">اتركه فارغاً للنشر الآن</div>
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Cover Image -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">الصورة الرئيسية</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="cover_image" class="form-label">رفع صورة</label>
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
                            <i class="fas fa-trash"></i> إزالة الصورة
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

// Form validation
document.getElementById('newsForm').addEventListener('submit', function(e) {
    // Update content from Quill to textarea
    document.getElementById('content').value = quill.root.innerHTML;
    
    // Basic validation
    const title = document.getElementById('title').value.trim();
    const shortDescription = document.getElementById('short_description').value.trim();
    const content = quill.getText().trim();
    
    if (!title || !shortDescription || !content) {
        e.preventDefault();
        alert('يرجى ملء جميع الحقول المطلوبة');
        return false;
    }
    
    if (shortDescription.length > 500) {
        e.preventDefault();
        alert('الوصف القصير يجب أن يكون أقل من 500 حرف');
        return false;
    }
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
</script>
@endsection
