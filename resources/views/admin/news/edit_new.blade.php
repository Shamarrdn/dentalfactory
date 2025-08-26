@extends('layouts.admin')

@section('title', 'إضافة خبر جديد')

@section('styles')
    <!-- Quill.js CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- News Admin CSS -->
    <link href="{{ asset('assets/css/admin/news.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="news-page">
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="fas fa-plus-circle text-primary"></i>
            إضافة خبر جديد
        </h1>
    </div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
                @csrf
                
                <!-- القسم الأول: تفاصيل الخبر -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit text-primary"></i> تفاصيل الخبر
                        </h5>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>

                <!-- القسم الثاني: خيارات النشر -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-calendar-alt text-success"></i> خيارات النشر
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- تاريخ النشر -->
                        <div class="mb-3">
                            <label for="published_at" class="form-label">تاريخ النشر</label>
                            <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                                   id="published_at" name="published_at" value="{{ old('published_at') }}">
                            <div class="form-text">اتركه فارغاً للنشر الآن</div>
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- معلومات الحالة -->
                        <div class="mb-3">
                            <label class="form-label">الحالة الحالية</label>
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-info-circle"></i>
                                سيتم تحديد الحالة عند الضغط على أزرار الحفظ أدناه
                            </div>
                        </div>
                    </div>
                </div>

                <!-- القسم الثالث: الصورة الرئيسية -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-image text-warning"></i> الصورة الرئيسية
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- رفع الصورة -->
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">رفع صورة</label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                   id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
                            <div class="form-text">الصيغ المدعومة: JPEG, PNG, JPG, GIF (الحد الأقصى: 2MB)</div>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- معاينة الصورة -->
                        <div class="mb-3">
                            <div id="imagePreview" class="text-center" style="display: none;">
                                <label class="form-label">معاينة الصورة</label>
                                <div class="border rounded p-3">
                                    <img id="preview" src="#" alt="معاينة الصورة" class="img-fluid rounded" style="max-height: 200px;">
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                            <i class="fas fa-trash"></i> إزالة الصورة
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="noImageMessage" class="text-center">
                                <label class="form-label">معاينة الصورة</label>
                                <div class="border rounded p-3 text-muted">
                                    <i class="fas fa-image fa-3x mb-2"></i>
                                    <p class="mb-0">لم يتم اختيار صورة</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- أزرار الإجراءات السريعة -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-bolt text-info"></i> إجراءات سريعة
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- بيانات تجريبية -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-info w-100" onclick="fillSampleData()">
                                <i class="fas fa-magic"></i> بيانات تجريبية
                            </button>
                        </div>
                        
                        <!-- عرض في الموضوع -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-warning w-100" onclick="previewNews()">
                                <i class="fas fa-eye"></i> معاينة سريعة
                            </button>
                        </div>
                        
                        <!-- مسح الموضوع -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-secondary w-100" onclick="clearForm()">
                                <i class="fas fa-eraser"></i> مسح الموضوع
                            </button>
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

// Form submission validation
document.getElementById('newsForm').addEventListener('submit', function(e) {
    // Update content before submit
    document.getElementById('content').value = quill.root.innerHTML;
    
    // Check file upload
    const fileInput = document.getElementById('cover_image');
    const hasFile = fileInput.files && fileInput.files.length > 0;
    console.log('Form submission - File info:', {
        hasFile: hasFile,
        fileName: hasFile ? fileInput.files[0].name : 'No file',
        fileSize: hasFile ? fileInput.files[0].size : 0,
        formEnctype: this.getAttribute('enctype')
    });
    
    // Basic validation
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('short_description').value.trim();
    const content = quill.root.innerHTML.trim();
    
    if (!title || !description || content === '<p><br></p>' || content === '') {
        e.preventDefault();
        alert('يرجى ملء جميع الحقول المطلوبة');
        return false;
    }
    
    // Log form data for debugging
    const formData = new FormData(this);
    console.log('Form data entries:');
    for (let [key, value] of formData.entries()) {
        if (key === 'cover_image') {
            console.log(key + ':', value instanceof File ? `File: ${value.name} (${value.size} bytes)` : value);
        } else {
            console.log(key + ':', typeof value === 'string' ? value.substring(0, 100) + '...' : value);
        }
    }
});
</script>
@endsection
