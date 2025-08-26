@extends('layouts.admin')

@section('title', 'إضافة خبر جديد')

@section('styles')
    <!-- Quill.js CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Achievement Admin CSS -->
    <link href="{{ asset('assets/css/admin/achievements.css') }}" rel="stylesheet">
    <style>
    .news-dashboard .page-header h1 i {
        color: #fff;
    }
    </style>
@endsection

@section('content')
<div class="container-fluid achievement-dashboard news-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-plus-circle"></i> إضافة خبر جديد</h1>
                    <p>أضف خبراً جديداً لعرضه للعملاء والزوار</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-right"></i> العودة للقائمة
                    </a>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
                @csrf
                
                <!-- تفاصيل الخبر -->
                <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #2E8B57 0%, #3CB371 50%, #20B2AA 100%); color: white; border-radius: 15px 15px 0 0;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-newspaper"></i> تفاصيل الخبر
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
                                    <div id="quill-editor" style="height: 300px; direction: rtl;"></div>
                                    <textarea class="form-control @error('content') is-invalid @enderror d-none" 
                                              id="content" name="content" required>{{ old('content') }}</textarea>
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
                                                       id="published_at" name="published_at" value="{{ old('published_at') }}">
                                                <div class="form-text">اتركه فارغاً للنشر الآن</div>
                                                @error('published_at')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle"></i>
                                                سيتم تحديد الحالة عند الضغط على أزرار الحفظ
                                            </div>
                                        </div>

                                        <!-- الصورة الرئيسية -->
                                        <div class="mb-4">
                                            <h6 class="text-warning mb-3 border-bottom pb-2">
                                                <i class="fas fa-image"></i> الصورة الرئيسية
                                            </h6>
                                            
                                            <div class="mb-3">
                                                <label for="cover_image" class="form-label">رفع صورة</label>
                                                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                                       id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
                                                <div class="form-text">JPEG, PNG, JPG, GIF (أقصى: 2MB)</div>
                                                @error('cover_image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <!-- معاينة الصورة -->
                                            <div id="imagePreview" class="text-center" style="display: none;">
                                                <label class="form-label">معاينة الصورة</label>
                                                <div class="border rounded p-2">
                                                    <img id="preview" src="#" alt="معاينة الصورة" class="img-fluid rounded" style="max-height: 120px;">
                                                    <div class="mt-2">
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                                            <i class="fas fa-trash"></i> إزالة
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="noImageMessage" class="text-center">
                                                <div class="border rounded p-3 text-muted">
                                                    <i class="fas fa-image fa-2x mb-2"></i>
                                                    <p class="mb-0 small">لم يتم اختيار صورة</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- الإجراءات السريعة -->
                                        <div class="mb-4">
                                            <h6 class="text-info mb-3 border-bottom pb-2">
                                                <i class="fas fa-bolt"></i> إجراءات سريعة
                                            </h6>
                                            
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-outline-info btn-sm" onclick="fillSampleData()">
                                                    <i class="fas fa-magic"></i> بيانات تجريبية
                                                </button>
                                                <button type="button" class="btn btn-outline-warning btn-sm" onclick="previewNews()">
                                                    <i class="fas fa-eye"></i> معاينة سريعة
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearForm()">
                                                    <i class="fas fa-eraser"></i> مسح الموضوع
                                                </button>
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

// Update hidden textarea when quill content changes
quill.on('text-change', function() {
    document.getElementById('content').value = quill.root.innerHTML;
});

// Set initial content if exists
var initialContent = document.getElementById('content').value;
if (initialContent) {
    quill.root.innerHTML = initialContent;
}

// Image preview function
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('noImageMessage').style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
}

// Remove image function
function removeImage() {
    document.getElementById('cover_image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('noImageMessage').style.display = 'block';
}

// Fill sample data function
function fillSampleData() {
    document.getElementById('title').value = 'أحدث التطورات في طب الأسنان';
    document.getElementById('short_description').value = 'نظرة شاملة على أحدث التقنيات والعلاجات المتطورة في مجال طب الأسنان وتأثيرها على صحة المرضى.';
    quill.root.innerHTML = '<h3>مقدمة</h3><p>يشهد مجال طب الأسنان تطوراً مستمراً في التقنيات والأساليب العلاجية.</p><h3>التقنيات الحديثة</h3><p>تشمل هذه التطورات استخدام الليزر والتصوير ثلاثي الأبعاد.</p>';
    document.getElementById('content').value = quill.root.innerHTML;
}

// Clear form function
function clearForm() {
    if (confirm('هل أنت متأكد من مسح جميع البيانات؟')) {
        document.getElementById('newsForm').reset();
        quill.root.innerHTML = '';
        document.getElementById('content').value = '';
        removeImage();
    }
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

// Form submission handling with proper file support
document.getElementById('newsForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default submission
    
    // Update content from Quill
    document.getElementById('content').value = quill.root.innerHTML;
    
    // Basic validation
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('short_description').value.trim();
    const content = quill.root.innerHTML.trim();
    
    if (!title || !description || content === '<p><br></p>' || content === '') {
        alert('يرجى ملء جميع الحقول المطلوبة');
        return false;
    }
    
    // Get the clicked button to preserve status
    const clickedButton = document.activeElement;
    const status = clickedButton.getAttribute('value') || 'draft';
    
    // Create FormData manually to ensure file is included
    const formData = new FormData();
    
    // Add all form fields
    formData.append('_token', document.querySelector('input[name="_token"]').value);
    formData.append('title', document.getElementById('title').value);
    formData.append('short_description', document.getElementById('short_description').value);
    formData.append('content', document.getElementById('content').value);
    formData.append('status', status);
    
    // Add published_at if exists
    const publishedAt = document.getElementById('published_at').value;
    if (publishedAt) {
        formData.append('published_at', publishedAt);
    }
    
    // Add file if selected
    const fileInput = document.getElementById('cover_image');
    if (fileInput.files && fileInput.files.length > 0) {
        formData.append('cover_image', fileInput.files[0]);
        console.log('File added to FormData:', fileInput.files[0].name, fileInput.files[0].size + ' bytes');
    }
    
    // Log for debugging
    console.log('FormData contents:');
    for (let [key, value] of formData.entries()) {
        if (key === 'cover_image') {
            console.log(key + ':', value instanceof File ? `File: ${value.name} (${value.size} bytes)` : value);
        } else {
            console.log(key + ':', typeof value === 'string' ? value.substring(0, 50) + '...' : value);
        }
    }
    
    // Submit using fetch
    fetch(this.action, {
        method: 'POST',
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
            alert('حدث خطأ أثناء الحفظ');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء الحفظ');
    });
});
</script>
@endsection
