@extends('layouts.admin')

@section('title', 'الإعدادات العامة')
@section('page_title', 'الإعدادات العامة')
@section('page_subtitle', 'إدارة إعدادات الشركة والخرائط')

@section('styles')
<link href="{{ asset('assets/css/admin/settings.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid settings-dashboard">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-cogs"></i> الإعدادات العامة</h1>
                    <p>إدارة معلومات الشركة وإعدادات الخرائط والمواقع</p>
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn btn-info" id="previewMapBtn" disabled>
                        <i class="fas fa-eye"></i> معاينة الخريطة
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.settings.general.update') }}" method="POST" class="settings-form">
        @csrf
        <div class="row">
            <!-- Main Settings -->
            <div class="col-lg-8">
                <!-- Company Information -->
                <div class="card mb-3" style="border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.06); max-height: 680px; overflow-y: auto;">
                    <div class="card-header" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border-radius: 12px 12px 0 0; padding: 0.5rem 1rem; min-height: 45px;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-building"></i> معلومات الشركة
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 0.7rem;">
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

                        <!-- Company Address -->
                        <div class="form-group mb-1">
                            <label for="company_address" class="form-label">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                عنوان الشركة
                            </label>
                            <textarea name="company_address" id="company_address" 
                                      class="form-control @error('company_address') is-invalid @enderror" 
                                      rows="1" placeholder="أدخل عنوان الشركة الكامل">{{ old('company_address', $settings->where('key', 'company_address')->first()->value ?? '') }}</textarea>
                            @error('company_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Company Phone -->
                        <div class="form-group mb-2">
                            <label for="company_phone" class="form-label">
                                <i class="fas fa-phone text-success"></i>
                                أرقام هواتف الشركة
                            </label>
                            <textarea name="company_phone" id="company_phone" 
                                      class="form-control @error('company_phone') is-invalid @enderror" 
                                      rows="1" 
                                      placeholder="+966 123 456 789"
                                      style="resize: vertical;">{{ old('company_phone', $settings->where('key', 'company_phone')->first()->value ?? '') }}</textarea>
                            <div class="form-text">
                                <i class="fas fa-info-circle text-info"></i>
                                يمكنك إدخال أكثر من رقم هاتف، كل رقم في سطر منفصل
                            </div>
                            @error('company_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Company Email -->
                        <div class="form-group mb-2">
                            <label for="company_email" class="form-label">
                                <i class="fas fa-envelope text-info"></i>
                                البريد الإلكتروني للشركة
                            </label>
                            <input type="email" name="company_email" id="company_email" 
                                   class="form-control @error('company_email') is-invalid @enderror" 
                                   value="{{ old('company_email', $settings->where('key', 'company_email')->first()->value ?? '') }}" 
                                   placeholder="info@company.com">
                            @error('company_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Company Website -->
                        <div class="form-group mb-2">
                            <label for="company_website" class="form-label">
                                <i class="fas fa-globe text-primary"></i>
                                موقع الشركة الإلكتروني
                            </label>
                            <input type="url" name="company_website" id="company_website" 
                                   class="form-control @error('company_website') is-invalid @enderror" 
                                   value="{{ old('company_website', $settings->where('key', 'company_website')->first()->value ?? '') }}" 
                                   placeholder="https://www.company.com">
                            @error('company_website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Maps Settings -->
                <div class="card mb-3" style="border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.06); max-height: 650px; overflow-y: auto;">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px 12px 0 0; padding: 0.5rem 1rem; min-height: 45px;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-map"></i> إعدادات الخرائط
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 0.7rem;">
                        <!-- Google Maps URL -->
                        <div class="form-group mb-2">
                            <label for="google_maps_url" class="form-label">
                                <i class="fab fa-google text-danger"></i>
                                رابط Google Maps
                            </label>
                            <input type="url" name="google_maps_url" id="google_maps_url" 
                                   class="form-control @error('google_maps_url') is-invalid @enderror" 
                                   value="{{ old('google_maps_url', $settings->where('key', 'google_maps_url')->first()->value ?? '') }}" 
                                   placeholder="https://maps.google.com/...">
                            @error('google_maps_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">رابط الموقع على خرائط Google، سيظهر كأيقونة في الموقع</small>
                        </div>
                        <!-- Embedded Map Code -->
                        <div class="form-group mb-2">
                            <label for="embedded_map_code" class="form-label">
                                <i class="fas fa-code text-warning"></i>
                                كود الخريطة التفاعلية (iFrame)
                            </label>
                            <textarea name="embedded_map_code" id="embedded_map_code" 
                                      class="form-control @error('embedded_map_code') is-invalid @enderror" 
                                      rows="3" placeholder='<iframe src="https://www.google.com/maps/embed?..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'>{{ old('embedded_map_code', $settings->where('key', 'embedded_map_code')->first()->value ?? '') }}</textarea>
                            @error('embedded_map_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">كود HTML للخريطة التفاعلية من Google Maps، ستظهر في صفحة "تواصل معنا"</small>
                        </div>
                        <!-- Map Instructions -->
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> كيفية الحصول على كود الخريطة:</h6>
                            <ol class="mb-0">
                                <li>اذهب إلى <a href="https://maps.google.com" target="_blank">Google Maps</a></li>
                                <li>ابحث عن موقع شركتك</li>
                                <li>اضغط على "Share" أو "مشاركة"</li>
                                <li>اختر "Embed a map" أو "تضمين خريطة"</li>
                                <li>انسخ الكود والصقه في الحقل أعلاه</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Save Settings -->
                <div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.06); max-height: 180px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #4ECDC4 0%, #44A08D 50%, #093637 100%); color: white; border-radius: 12px 12px 0 0; padding: 0.5rem 1rem; min-height: 45px;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-save"></i> حفظ الإعدادات
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 0.7rem;">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save"></i> حفظ جميع الإعدادات
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo"></i> إعادة تعيين
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Map Preview -->
                <div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.06); max-height: 280px; overflow-y: auto;">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px 12px 0 0; padding: 0.5rem 1rem; min-height: 45px;">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-eye"></i> معاينة الخريطة
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 0.7rem;">
                        <div id="map-preview">
                            <p class="text-muted text-center">أدخل كود الخريطة لرؤية المعاينة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const embeddedMapCode = document.getElementById('embedded_map_code');
    const previewMapBtn = document.getElementById('previewMapBtn');
    const mapPreview = document.getElementById('map-preview');

    // Update map preview when code changes
    embeddedMapCode.addEventListener('input', function() {
        const code = this.value.trim();
        
        if (code && code.includes('<iframe')) {
            previewMapBtn.disabled = false;
            updateMapPreview(code);
        } else {
            previewMapBtn.disabled = true;
            mapPreview.innerHTML = '<p class="text-muted text-center">أدخل كود الخريطة لرؤية المعاينة</p>';
        }
    });

    // Preview button click
    previewMapBtn.addEventListener('click', function() {
        const code = embeddedMapCode.value.trim();
        if (code) {
            updateMapPreview(code);
        }
    });

    // Update map preview
    function updateMapPreview(code) {
        // Create a safe preview with smaller dimensions
        let previewCode = code.replace(/width=["']?\d+["']?/gi, 'width="100%"');
        previewCode = previewCode.replace(/height=["']?\d+["']?/gi, 'height="200"');
        
        mapPreview.innerHTML = '<div class="map-preview-container">' + previewCode + '</div>';
    }

    // Initial preview if code exists
    const initialCode = embeddedMapCode.value.trim();
    if (initialCode && initialCode.includes('<iframe')) {
        previewMapBtn.disabled = false;
        updateMapPreview(initialCode);
    }

    // Form validation
    document.querySelector('.settings-form').addEventListener('submit', function(e) {
        const googleMapsUrl = document.getElementById('google_maps_url').value;
        const embeddedMapCodeValue = embeddedMapCode.value.trim();
        
        // Validate Google Maps URL format
        if (googleMapsUrl && !googleMapsUrl.includes('maps.google')) {
            alert('رابط Google Maps يجب أن يكون من موقع maps.google.com');
            e.preventDefault();
            return false;
        }
        
        // Validate embedded map code
        if (embeddedMapCodeValue && !embeddedMapCodeValue.includes('<iframe')) {
            alert('كود الخريطة التفاعلية يجب أن يحتوي على عنصر iframe');
            e.preventDefault();
            return false;
        }
    });

    // Character counters
    const addressField = document.getElementById('company_address');
    const mapCodeField = document.getElementById('embedded_map_code');
    
    addCharacterCounter(addressField, 500);
    addCharacterCounter(mapCodeField, 5000);
    
    function addCharacterCounter(element, maxLength) {
        const counter = document.createElement('div');
        counter.className = 'character-counter text-end';
        element.parentNode.appendChild(counter);
        
        function updateCounter() {
            const length = element.value.length;
            let color = 'text-muted';
            
            if (length > maxLength * 0.8) color = 'text-warning';
            if (length > maxLength * 0.95) color = 'text-danger';
            
            counter.innerHTML = `<small class="${color}">${length}/${maxLength} حرف</small>`;
        }
        
        element.addEventListener('input', updateCounter);
        updateCounter();
    }
    
    // Phone numbers handling
    const phoneTextarea = document.getElementById('company_phone');
    
    // Auto-resize textarea based on content
    function autoResize() {
        phoneTextarea.style.height = 'auto';
        phoneTextarea.style.height = phoneTextarea.scrollHeight + 'px';
    }
    
    // Initial resize
    autoResize();
    
    // Resize on input
    phoneTextarea.addEventListener('input', autoResize);
    
    // Add phone number validation and formatting
    phoneTextarea.addEventListener('blur', function() {
        const lines = this.value.split('\n').filter(line => line.trim() !== '');
        const formattedLines = lines.map(line => {
            // Remove extra spaces and format phone number
            return line.trim().replace(/\s+/g, ' ');
        });
        
        this.value = formattedLines.join('\n');
        autoResize();
    });
    
    // Add placeholder text with line breaks
    if (!phoneTextarea.value) {
        phoneTextarea.placeholder = '+966 123 456 789\n+966 987 654 321\n+966 555 123 456';
    }
});
</script>
@endsection
