@extends('layouts.admin')

@section('title', 'تعديل الصفحة - ' . $page->title)
@section('page_title', 'تعديل الصفحة')
@section('page_subtitle', 'تعديل صفحة: ' . $page->title)

@section('styles')
    <!-- Pages Admin CSS -->
    <link href="{{ asset('assets/css/admin/pages.css') }}" rel="stylesheet">
    <!-- CKEditor 5 Custom CSS -->
    <style>
        .ck-editor__editable {
            min-height: 400px;
        }
        .ck.ck-editor {
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .ck.ck-editor__top {
            border-radius: 8px 8px 0 0;
        }
        .ck.ck-editor__main {
            border-radius: 0 0 8px 8px;
        }
        .ck-content {
            font-family: inherit;
            font-size: 1rem;
            line-height: 1.6;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid pages-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-edit"></i> تعديل الصفحة</h1>
                    <p>تعديل: {{ $page->title }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-outline-info me-2">
                        <i class="fas fa-external-link-alt"></i> معاينة الصفحة
                    </a>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-right"></i> العودة للقائمة
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" class="page-form">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Page Details Section -->
                <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #2E8B57 0%, #3CB371 50%, #20B2AA 100%); color: white; border-radius: 15px 15px 0 0;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-file-alt"></i> تفاصيل الصفحة
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

                        <!-- Title Field -->
                        <div class="form-group mb-4">
                            <label for="title" class="form-label">عنوان الصفحة <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $page->title) }}" placeholder="أدخل عنوان الصفحة" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">العنوان الذي سيظهر في أعلى الصفحة وفي قوائم التنقل</small>
                        </div>

                        <!-- Slug Field -->
                        <div class="form-group mb-4">
                            <label for="slug" class="form-label">الرابط المميز (Slug) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">/page/</span>
                                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                       value="{{ old('slug', $page->slug) }}" placeholder="company-profile" required>
                            </div>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">يجب أن يحتوي على أحرف إنجليزية وأرقام وشرطات فقط</small>
                        </div>

                        <!-- Content Field -->
                        <div class="form-group mb-4">
                            <label for="content" class="form-label">محتوى الصفحة <span class="text-danger">*</span></label>
                            <div id="content-editor-wrapper">
                                <textarea name="content" id="content" required>{!! old('content', $page->content) !!}</textarea>
                            </div>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">المحتوى الرئيسي للصفحة مع دعم التنسيق والصور والفيديو والروابط</small>
                        </div>
                    </div>
                </div>

                <!-- SEO Section -->
                <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FF6B9D 100%); color: white; border-radius: 15px 15px 0 0;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-search"></i> إعدادات SEO
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 2rem;">
                        
                        <!-- Meta Title -->
                        <div class="form-group mb-4">
                            <label for="meta_title" class="form-label">عنوان SEO</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" 
                                   value="{{ old('meta_title', $page->meta_title) }}" placeholder="عنوان محسن لمحركات البحث" maxlength="255">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">العنوان الذي سيظهر في نتائج البحث (يُنصح بـ 50-60 حرف)</small>
                        </div>

                        <!-- Meta Description -->
                        <div class="form-group mb-4">
                            <label for="meta_description" class="form-label">وصف SEO</label>
                            <textarea name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" 
                                      rows="3" placeholder="وصف موجز للصفحة لمحركات البحث" maxlength="500">{{ old('meta_description', $page->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">الوصف الذي سيظهر في نتائج البحث (يُنصح بـ 150-160 حرف)</small>
                        </div>

                        <!-- Meta Keywords -->
                        <div class="form-group mb-4">
                            <label for="meta_keywords" class="form-label">كلمات مفتاحية</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                   value="{{ old('meta_keywords', $page->meta_keywords) }}" placeholder="كلمة1, كلمة2, كلمة3" maxlength="500">
                            @error('meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">الكلمات المفتاحية مفصولة بفواصل</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Publish Settings -->
                <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #4ECDC4 0%, #44A08D 50%, #093637 100%); color: white; border-radius: 15px 15px 0 0;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-cogs"></i> إعدادات النشر
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 1.5rem;">
                        
                        <!-- Status -->
                        <div class="form-group mb-4">
                            <label for="status" class="form-label">حالة النشر <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status', $page->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                                <option value="published" {{ old('status', $page->status) == 'published' ? 'selected' : '' }}>منشورة</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div class="form-group mb-4">
                            <label for="sort_order" class="form-label">ترتيب العرض</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                                   value="{{ old('sort_order', $page->sort_order) }}" min="0" placeholder="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">رقم الترتيب في قوائم التنقل</small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save"></i> حفظ التغييرات
                            </button>
                            <a href="{{ route('admin.pages.show', $page) }}" class="btn btn-outline-info">
                                <i class="fas fa-eye"></i> عرض الصفحة
                            </a>
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Page Info -->
                <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-info-circle"></i> معلومات الصفحة
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 1.5rem;">
                        <div class="info-item">
                            <strong>تاريخ الإنشاء:</strong>
                            <span>{{ $page->created_at->format('Y/m/d - H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <strong>آخر تعديل:</strong>
                            <span>{{ $page->updated_at->format('Y/m/d - H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <strong>الحالة الحالية:</strong>
                            <span class="badge bg-{{ $page->status == 'published' ? 'success' : 'warning' }}">
                                {{ $page->status == 'published' ? 'منشورة' : 'مسودة' }}
                            </span>
                        </div>
                        <div class="info-item">
                            <strong>الرابط:</strong>
                            <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="text-primary">
                                /page/{{ $page->slug }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border-radius: 15px 15px 0 0;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-eye"></i> معاينة سريعة
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 1.5rem;">
                        <div id="page-preview">
                            <h6 class="preview-title">{{ $page->title }}</h6>
                            <small class="text-muted">/page/{{ $page->slug }}</small>
                            <hr>
                            <div class="preview-content">
                                {!! Str::limit(strip_tags($page->content), 200) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- CKEditor 5 JavaScript -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
let editor;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor 5
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                    'alignment', '|',
                    'numberedList', 'bulletedList', '|',
                    'outdent', 'indent', '|',
                    'link', 'imageUpload', 'mediaEmbed', 'insertTable', '|',
                    'blockQuote', 'codeBlock', '|',
                    'horizontalLine', '|',
                    'undo', 'redo', '|',
                    'sourceEditing'
                ]
            },
            language: 'ar',
            image: {
                toolbar: [
                    'imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side',
                    '|', 'toggleImageCaption', 'imageResize'
                ],
                upload: {
                    types: ['jpeg', 'png', 'gif', 'bmp', 'webp', 'tiff', 'svg+xml']
                }
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            },
            mediaEmbed: {
                previewsInData: true,
                providers: [
                    {
                        name: 'youtube',
                        url: /^(?:m\.)?youtube\.com\/watch\?v=([\w-]+)/,
                        html: match => {
                            const id = match[1];
                            return (
                                '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">' +
                                `<iframe src="https://www.youtube.com/embed/${id}" ` +
                                'style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" ' +
                                'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>' +
                                '</iframe>' +
                                '</div>'
                            );
                        }
                    },
                    {
                        name: 'vimeo',
                        url: /^vimeo\.com\/(\d+)/,
                        html: match => {
                            const id = match[1];
                            return (
                                '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">' +
                                `<iframe src="https://player.vimeo.com/video/${id}" ` +
                                'style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" ' +
                                'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>' +
                                '</iframe>' +
                                '</div>'
                            );
                        }
                    }
                ]
            },
            fontSize: {
                options: [
                    9, 11, 13, 'default', 17, 19, 21, 24, 28, 32, 36
                ]
            },
            placeholder: 'اكتب محتوى الصفحة هنا...',
        })
        .then(newEditor => {
            editor = newEditor;
            
            // Add custom image upload adapter
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new ImageUploadAdapter(loader);
            };
            
            // Update preview when content changes
            editor.model.document.on('change:data', () => {
                updatePreview();
            });
            
            console.log('CKEditor 5 تم تحميله بنجاح');
        })
        .catch(error => {
            console.error('خطأ في تحميل CKEditor 5:', error);
        });

    // Custom Image Upload Adapter
    class ImageUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append('image', file);

                    fetch('{{ route("admin.pages.upload-image") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            resolve({
                                default: result.url
                            });
                        } else {
                            reject(result.message);
                        }
                    })
                    .catch(error => {
                        reject('فشل في رفع الصورة: ' + error.message);
                    });
                }));
        }

        abort() {
            // Reject the promise returned from the upload() method
        }
    }

    // Update preview functions
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    
    titleInput.addEventListener('input', updatePreview);
    slugInput.addEventListener('input', updatePreview);

    // Update preview
    function updatePreview() {
        const title = titleInput.value || 'عنوان الصفحة';
        const slug = slugInput.value || 'page-slug';
        let content = '';
        
        if (editor) {
            content = editor.getData();
        }
        
        document.querySelector('.preview-title').textContent = title;
        document.querySelector('.preview-content').innerHTML = content || '<p class="text-muted">معاينة المحتوى ستظهر هنا...</p>';
        
        // Update slug display in preview
        const slugDisplay = document.querySelector('#page-preview small.text-muted');
        if (slugDisplay) {
            slugDisplay.textContent = `/page/${slug}`;
        }
    }

    // Form submission
    document.querySelector('.page-form').addEventListener('submit', function(e) {
        // Validate content
        if (editor && !editor.getData().trim()) {
            e.preventDefault();
            alert('يرجى إدخال محتوى للصفحة');
            return false;
        }
    });

    // Character counter for meta fields
    const metaTitle = document.getElementById('meta_title');
    const metaDescription = document.getElementById('meta_description');
    
    addCharacterCounter(metaTitle, 60, 'recommended');
    addCharacterCounter(metaDescription, 160, 'recommended');
    
    function addCharacterCounter(element, recommendedLength, type) {
        const counter = document.createElement('div');
        counter.className = 'character-counter';
        element.parentNode.appendChild(counter);
        
        function updateCounter() {
            const length = element.value.length;
            const maxLength = element.getAttribute('maxlength');
            
            let color = 'text-muted';
            if (type === 'recommended') {
                if (length > recommendedLength) color = 'text-warning';
                if (length > maxLength * 0.9) color = 'text-danger';
            }
            
            counter.innerHTML = `<small class="${color}">${length}/${maxLength} حرف</small>`;
        }
        
        element.addEventListener('input', updateCounter);
        updateCounter();
    }
});
</script>

<style>
.info-item {
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.info-item strong {
    font-size: 0.9em;
    color: #495057;
}

.character-counter {
    margin-top: 5px;
}
</style>
@endsection
