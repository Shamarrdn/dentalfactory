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
                                      placeholder="+966 54 411 7002"
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
                            <label class="form-label">
                                <i class="fas fa-envelope text-info"></i>
                                عناوين البريد الإلكتروني للشركة
                            </label>
                            
                            <!-- Email Input -->
                            <div class="input-group mb-2">
                                <input type="email" id="email_input" class="form-control" placeholder="أدخل بريد إلكتروني صحيح">
                                <button type="button" id="add_email_btn" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> إضافة
                                </button>
                            </div>
                            
                            <!-- Email List -->
                            <div id="email_list" class="border rounded p-2 mb-2" style="min-height: 60px; max-height: 200px; overflow-y: auto;">
                                <div id="no_emails" class="text-muted text-center py-2" style="font-size: 0.9rem;">
                                    <i class="fas fa-info-circle"></i> لم يتم إضافة أي عنوان بريد إلكتروني بعد
                                </div>
                            </div>
                            
                            <!-- Hidden input to store emails -->
                            <input type="hidden" name="company_email" id="company_email" 
                                   value="{{ old('company_email', $settings->where('key', 'company_email')->first()->value ?? '') }}">
                            
                            <div class="form-text">
                                <i class="fas fa-info-circle text-info"></i>
                                أضف عناوين البريد الإلكتروني واحداً تلو الآخر. يمكنك حذف أي عنوان بالضغط على أيقونة الحذف.
                            </div>
                            
                            @error('company_email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
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

@push('styles')
<style>
    .email-tag {
        transition: all 0.2s ease;
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .email-tag:hover {
        background-color: rgba(var(--bs-primary-rgb), 0.9) !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .email-tag .btn:hover {
        background-color: rgba(255,255,255,0.2);
        border-radius: 50%;
    }
    
    #email_list:empty::before {
        content: '';
    }
    
    #add_email_btn:hover {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(var(--bs-primary-rgb), 0.3);
    }
    
    #email_input:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
    }
    
    .toast-notification {
        animation: slideInRight 0.3s ease-out;
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
@endpush

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
        phoneTextarea.placeholder = '+966 54 411 7002\nGenodent.1@gmail.com\nGenodent.2@gmail.com';
    }
    
    // Email management system
    const emailInput = document.getElementById('email_input');
    const addEmailBtn = document.getElementById('add_email_btn');
    const emailList = document.getElementById('email_list');
    const hiddenEmailInput = document.getElementById('company_email');
    const noEmailsMsg = document.getElementById('no_emails');
    
    let emails = [];
    
    // Email validation function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email.trim());
    }
    
    // Update hidden input with current emails
    function updateHiddenInput() {
        hiddenEmailInput.value = emails.join('\n');
    }
    
    // Create email tag element
    function createEmailTag(email, index) {
        return `
            <div class="email-tag d-inline-flex align-items-center bg-primary text-white rounded px-2 py-1 me-2 mb-2" 
                 style="font-size: 0.85rem;">
                <i class="fas fa-envelope me-1"></i>
                <span>${email}</span>
                <button type="button" class="btn btn-sm ms-1 p-0 text-white border-0" 
                        onclick="removeEmail(${index})" title="حذف البريد الإلكتروني">
                    <i class="fas fa-times" style="font-size: 0.8rem;"></i>
                </button>
            </div>
        `;
    }
    
    // Remove email function (global scope)
    window.removeEmail = function(index) {
        const emailToRemove = emails[index];
        if (confirm(`هل أنت متأكد من حذف البريد الإلكتروني: ${emailToRemove}؟`)) {
            emails.splice(index, 1);
            renderEmails();
            updateHiddenInput();
            showToast('تم حذف البريد الإلكتروني بنجاح', 'success');
        }
    };
    
    // Render emails list
    function renderEmails() {
        if (emails.length === 0) {
            noEmailsMsg.style.display = 'block';
            emailList.innerHTML = noEmailsMsg.outerHTML;
        } else {
            noEmailsMsg.style.display = 'none';
            emailList.innerHTML = emails.map((email, index) => 
                createEmailTag(email, index)
            ).join('');
        }
    }
    
    // Add email function
    function addEmail() {
        const email = emailInput.value.trim();
        
        if (!email) {
            emailInput.classList.add('is-invalid');
            showToast('يرجى إدخال بريد إلكتروني', 'error');
            return;
        }
        
        if (!isValidEmail(email)) {
            emailInput.classList.add('is-invalid');
            showToast('يرجى إدخال بريد إلكتروني صحيح', 'error');
            return;
        }
        
        if (emails.includes(email)) {
            emailInput.classList.add('is-invalid');
            showToast('هذا البريد الإلكتروني موجود بالفعل', 'warning');
            return;
        }
        
        emails.push(email);
        emailInput.value = '';
        emailInput.classList.remove('is-invalid');
        renderEmails();
        updateHiddenInput();
        showToast('تم إضافة البريد الإلكتروني بنجاح', 'success');
    }
    
    // Enhanced toast notification
    function showToast(message, type = 'info') {
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast-notification alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
        toast.style.cssText = 'top: 20px; left: 20px; z-index: 9999; min-width: 300px; max-width: 400px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="${icons[type === 'error' ? 'error' : type]} me-2"></i>
                <span class="flex-grow-1">${message}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 4 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }
        }, 4000);
    }
    
    // Event listeners
    addEmailBtn.addEventListener('click', addEmail);
    
    emailInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addEmail();
        }
    });
    
    emailInput.addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
    
    // Initialize emails from hidden input
    if (hiddenEmailInput.value) {
        emails = hiddenEmailInput.value.split('\n').filter(email => email.trim() !== '');
        renderEmails();
    }
});
</script>
@endsection
