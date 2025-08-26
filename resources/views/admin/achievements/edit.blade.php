@extends('layouts.admin')

@section('title', 'تعديل الإنجاز')
@section('page_title', 'تعديل الإنجاز')
@section('page_subtitle', 'تعديل تفاصيل الإنجاز')

@section('styles')
    <!-- Quill.js CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Achievement Admin CSS -->
    <link href="{{ asset('assets/css/admin/achievements.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid achievement-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-edit"></i> تعديل الإنجاز</h1>
                    <p>تعديل تفاصيل الإنجاز: {{ $achievement->title }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.achievements.index') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-arrow-right"></i> العودة للقائمة
                    </a>
                    <a href="{{ route('admin.achievements.show', $achievement) }}" class="btn btn-outline-light">
                        <i class="fas fa-eye"></i> عرض الإنجاز
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Achievement Details Section -->
            <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #2E8B57 0%, #3CB371 50%, #20B2AA 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-trophy"></i> تفاصيل الإنجاز
                    </h5>
                </div>
                <div class="card-body" style="padding: 2rem;">
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data" id="achievementForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Right Column: Achievement Details -->
                            <div class="col-lg-8">
                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">عنوان الإنجاز <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $achievement->title) }}" 
                                           placeholder="مثال: حصولنا على شهادة الجودة الدولية ISO 9001"
                                           style="border-radius: 10px; padding: 12px; border: 2px solid #e9ecef;"
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Short Description -->
                                <div class="mb-3">
                                    <label for="short_description" class="form-label fw-bold">الوصف القصير <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                              id="short_description" name="short_description" rows="3" 
                                              placeholder="وصف موجز للإنجاز يظهر في كارت العرض (الحد الأقصى 500 حرف)" 
                                              style="border-radius: 10px; padding: 12px; border: 2px solid #e9ecef;"
                                              required>{{ old('short_description', $achievement->short_description) }}</textarea>
                                    <div class="form-text">الحد الأقصى: 500 حرف</div>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Content -->
                                <div class="mb-3">
                                    <label for="content" class="form-label fw-bold">تفاصيل الإنجاز <span class="text-danger">*</span></label>
                                    <div class="editor-container" style="border: 2px solid #e9ecef; border-radius: 10px; overflow: hidden;">
                                        <div id="quill-editor" style="height: 300px; direction: rtl; background: white;"></div>
                                    </div>
                                    <textarea class="form-control @error('content') is-invalid @enderror d-none" 
                                              id="content" name="content" required>{{ old('content', $achievement->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Left Column: Publishing Options -->
                            <div class="col-lg-4">
                                <div class="card h-100" style="border-radius: 10px; border: 1px solid #e9ecef;">
                                    <div class="card-body">
                                        <!-- Current Status -->
                                        <div class="mb-4">
                                            <h6 class="text-info mb-3 border-bottom pb-2">
                                                <i class="fas fa-info-circle"></i> الحالة الحالية
                                            </h6>
                                            <div class="alert alert-{{ $achievement->status === 'published' ? 'success' : 'warning' }}" style="border-radius: 8px;">
                                                <i class="fas fa-{{ $achievement->status === 'published' ? 'check-circle' : 'edit' }}"></i>
                                                <strong>{{ $achievement->status === 'published' ? 'منشور' : 'مسودة' }}</strong>
                                                @if($achievement->published_at)
                                                    <br><small>تاريخ النشر: {{ $achievement->published_at->format('Y-m-d H:i') }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Publishing Options -->
                                        <div class="mb-4">
                                            <h6 class="text-primary mb-3 border-bottom pb-2">
                                                <i class="fas fa-calendar-alt"></i> خيارات النشر
                                            </h6>
                                            
                                            <div class="mb-3">
                                                <label for="published_at" class="form-label">تاريخ النشر</label>
                                                <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                                                       id="published_at" name="published_at" 
                                                       value="{{ old('published_at', $achievement->published_at ? $achievement->published_at->format('Y-m-d\TH:i') : '') }}"
                                                       style="border-radius: 8px;">
                                                <div class="form-text">اتركه فارغاً للنشر الآن</div>
                                                @error('published_at')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Current Cover Image -->
                                        @if($achievement->cover_image)
                                        <div class="mb-4">
                                            <h6 class="text-success mb-3 border-bottom pb-2">
                                                <i class="fas fa-image"></i> الصورة الحالية
                                            </h6>
                                            <img src="{{ $achievement->cover_image_url }}" alt="{{ $achievement->title }}" 
                                                 style="max-width: 100%; height: 150px; object-fit: cover; border-radius: 8px; border: 2px solid #e9ecef;">
                                        </div>
                                        @endif

                                        <!-- Cover Image Upload -->
                                        <div class="mb-4">
                                            <h6 class="text-warning mb-3 border-bottom pb-2">
                                                <i class="fas fa-upload"></i> {{ $achievement->cover_image ? 'تغيير صورة الغلاف' : 'إضافة صورة الغلاف' }}
                                            </h6>
                                            
                                            <div class="mb-3">
                                                <label for="cover_image" class="form-label">اختر صورة جديدة</label>
                                                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                                       id="cover_image" name="cover_image" accept="image/*"
                                                       style="border-radius: 8px;">
                                                <div class="form-text">JPG, PNG, GIF - الحد الأقصى: 2MB</div>
                                                @error('cover_image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <!-- Image Preview -->
                                            <div id="imagePreview" style="display: none;">
                                                <label class="form-label">معاينة الصورة الجديدة:</label>
                                                <img id="previewImg" src="" alt="معاينة الصورة" 
                                                     style="max-width: 100%; height: 150px; object-fit: cover; border-radius: 8px; border: 2px solid #e9ecef;">
                                            </div>
                                        </div>

                                        <!-- Statistics -->
                                        <div class="mb-4">
                                            <h6 class="text-secondary mb-3 border-bottom pb-2">
                                                <i class="fas fa-chart-bar"></i> إحصائيات
                                            </h6>
                                            <div class="small">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>عدد المشاهدات:</span>
                                                    <span class="fw-bold text-primary">{{ $achievement->formatted_views }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>تاريخ الإنشاء:</span>
                                                    <span class="fw-bold">{{ $achievement->created_at->format('Y-m-d') }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>آخر تحديث:</span>
                                                    <span class="fw-bold">{{ $achievement->updated_at->format('Y-m-d') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden status field -->
                        <input type="hidden" name="status" id="status_field" value="{{ $achievement->status }}">

                        <!-- Action Buttons -->
                        <div class="text-center mt-4">
                            <button type="button" onclick="submitForm('draft')" class="btn btn-outline-warning btn-lg me-3" 
                                    style="border-radius: 10px; padding: 12px 30px; font-weight: 600;" id="draftBtn">
                                <i class="fas fa-save"></i> حفظ كمسودة
                            </button>
                            <button type="button" onclick="submitForm('published')" class="btn btn-success btn-lg me-3"
                                    style="border-radius: 10px; padding: 12px 30px; font-weight: 600;" id="publishBtn">
                                <i class="fas fa-check-circle"></i> نشر الإنجاز
                            </button>
                            <a href="{{ route('admin.achievements.index') }}" class="btn btn-secondary btn-lg"
                               style="border-radius: 10px; padding: 12px 30px; font-weight: 600;">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
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
    let quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                ['clean']
            ]
        },
        placeholder: 'اكتب تفاصيل الإنجاز هنا...'
    });

    // Set existing content
    quill.root.innerHTML = document.getElementById('content').value;

    // Set direction to RTL
    quill.format('direction', 'rtl');
    quill.format('align', 'right');

    // Handle image preview
    document.getElementById('cover_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').style.display = 'none';
        }
    });

    // Function to submit form with specified status
    function submitForm(status) {
        // Update content from Quill
        document.getElementById('content').value = quill.root.innerHTML;
        
        // Set status
        document.getElementById('status_field').value = status;
        
        // Basic validation
        const title = document.getElementById('title').value.trim();
        const description = document.getElementById('short_description').value.trim();
        const content = quill.root.innerHTML.trim();
        
        if (!title || !description || content === '<p><br></p>' || content === '') {
            alert('يرجى ملء جميع الحقول المطلوبة');
            return false;
        }
        
        // Show loading state
        const button = status === 'draft' ? document.getElementById('draftBtn') : document.getElementById('publishBtn');
        const originalHtml = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
        button.disabled = true;
        
        // Submit form
        document.getElementById('achievementForm').submit();
    }

    // Character counter for short description
    document.getElementById('short_description').addEventListener('input', function() {
        const current = this.value.length;
        const max = 500;
        const remaining = max - current;
        
        let helpText = this.parentNode.querySelector('.form-text');
        if (remaining < 50) {
            helpText.style.color = remaining < 0 ? '#dc3545' : '#fd7e14';
        } else {
            helpText.style.color = '#6c757d';
        }
        helpText.textContent = `الحد الأقصى: ${max} حرف (متبقي: ${remaining})`;
    });

    // Trigger character counter on page load
    document.getElementById('short_description').dispatchEvent(new Event('input'));
    </script>
@endsection
