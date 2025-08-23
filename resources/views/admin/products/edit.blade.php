@extends('layouts.admin')

@section('title', 'تعديل المنتج - ' . $product->name)
@section('page_title', 'تعديل المنتج: ' . $product->name)

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid px-0">
            <div class="row mx-0">
                <div class="col-12 px-0">
                    <div class="products-container">
                        <!-- Header Actions -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-edit text-primary me-2"></i>
                                            تعديل المنتج
                                        </h5>
                                        <div class="actions">
                                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-light-info me-2">
                                                <i class="fas fa-eye me-1"></i>
                                                عرض المنتج
                                            </a>
                                            <a href="{{ route('admin.products.index') }}" class="btn btn-light-secondary">
                                                <i class="fas fa-arrow-right me-1"></i>
                                                عودة للمنتجات
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add this after the form opening tag -->
                        @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            <h5 class="alert-heading mb-2">يوجد أخطاء في النموذج:</h5>
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Debug information -->
                        @if(config('app.debug'))
                        <div class="alert alert-info mb-4">
                            <h6>Debug Information:</h6>
                            <pre>{{ print_r($errors->toArray(), true) }}</pre>
                            <h6>Request Data:</h6>
                            <pre>{{ print_r(request()->all(), true) }}</pre>
                        </div>
                        @endif
                        @endif

                        <!-- Form -->
                        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row g-4">
                                <!-- Basic Information -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">
                                                <i class="fas fa-info-circle text-primary me-2"></i>
                                                معلومات أساسية
                                            </h5>
                                            <div class="mb-3">
                                                <label class="form-label">اسم المنتج</label>
                                                <input type="text" name="name"
                                                    class="form-control shadow-sm @error('name') is-invalid @enderror"
                                                    value="{{ old('name', $product->name) }}">
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="category_id" class="form-label required">التصنيف الرئيسي</label>
                                                <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                                    <option value="">اختر التصنيف الرئيسي</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">التصنيفات الإضافية (اختياري)</label>
                                                <div class="card border shadow-sm p-3">
                                                    <div class="row g-2">
                                                        @foreach($categories as $category)
                                                        <div class="col-md-4 col-sm-6">
                                                            <div class="form-check">
                                                                <input type="checkbox"
                                                                    class="form-check-input"
                                                                    id="category-{{ $category->id }}"
                                                                    name="categories[]"
                                                                    value="{{ $category->id }}"
                                                                    {{ in_array($category->id, old('categories', $selectedCategories)) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="category-{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">اختر التصنيفات الإضافية التي تريد إضافة المنتج إليها</small>
                                                @error('categories')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="isAvailable"
                                                        name="is_available" value="1" {{ old('is_available', $product->is_available) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="isAvailable">متاح للبيع</label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">الرابط المختصر (Slug)</label>
                                                <input type="text" name="slug"
                                                    class="form-control shadow-sm @error('slug') is-invalid @enderror"
                                                    value="{{ old('slug', $product->slug) }}" readonly disabled>
                                                @error('slug')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">يتم إنشاء الرابط المختصر تلقائياً من اسم المنتج</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description and Images -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">
                                                <i class="fas fa-image text-primary me-2"></i>
                                                الوصف والصور
                                            </h5>
                                            <div class="mb-3">
                                                <label class="form-label">الوصف</label>
                                                <textarea name="description" class="form-control shadow-sm"
                                                    rows="4">{{ old('description', $product->description) }}</textarea>
                                                @error('description')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-tag text-primary me-2"></i>
                                                    السعر الأساسي
                                                </label>
                                                <div class="input-group shadow-sm">
                                                    <input type="number" name="base_price" class="form-control @error('base_price') is-invalid @enderror"
                                                        placeholder="السعر الأساسي" step="0.01" min="0"
                                                        value="{{ old('base_price', $product->base_price) }}">
                                                    <span class="input-group-text">ر.س</span>
                                                </div>
                                                <small class="text-muted">سيتم استخدام هذا السعر إذا لم تكن هناك مقاسات بأسعار محددة</small>
                                                @error('base_price')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Product Details -->
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-list-ul text-primary me-2"></i>
                                                    تفاصيل المنتج
                                                </label>
                                                <div class="alert alert-light border">
                                                    <small class="text-muted">أضف تفاصيل إضافية للمنتج مثل الأبعاد، البراند، بلد المنشأ، إلخ...</small>
                                                </div>
                                                <div id="detailsContainer">
                                                    @if(old('detail_keys'))
                                                        @foreach(old('detail_keys') as $index => $key)
                                                            <div class="input-group mb-2 shadow-sm">
                                                                <input type="text" name="detail_keys[]" class="form-control" placeholder="الخاصية" value="{{ $key }}">
                                                                <input type="text" name="detail_values[]" class="form-control" placeholder="القيمة" value="{{ old('detail_values')[$index] ?? '' }}">
                                                                <button type="button" class="btn btn-light-danger" onclick="this.closest('.input-group').remove()">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @elseif($product->details)
                                                        @foreach($product->details as $key => $value)
                                                            <div class="input-group mb-2 shadow-sm">
                                                                <input type="text" name="detail_keys[]" class="form-control" placeholder="الخاصية" value="{{ $key }}">
                                                                <input type="text" name="detail_values[]" class="form-control" placeholder="القيمة" value="{{ $value }}">
                                                                <button type="button" class="btn btn-light-danger" onclick="this.closest('.input-group').remove()">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-light-secondary btn-sm mt-2" onclick="addDetailInput()">
                                                    <i class="fas fa-plus"></i>
                                                    إضافة تفاصيل
                                                </button>
                                            </div>

                                            <!-- Current Images -->
                                            <div class="mb-3">
                                                <label class="form-label">الصور الحالية</label>
                                                <div class="row g-2 mb-2">
                                                    @foreach($product->images as $image)
                                                    <div class="col-auto">
                                                        <div class="position-relative">
                                                            <img src="{{ url('storage/' . $image->image_path) }}"
                                                                alt="صورة المنتج"
                                                                class="rounded"
                                                                style="width: 80px; height: 80px; object-fit: cover;">
                                                            <div class="position-absolute top-0 end-0 p-1">
                                                                <div class="form-check">
                                                                    <input type="radio" name="is_primary" value="{{ $image->id }}"
                                                                        class="form-check-input" @checked($image->is_primary)>
                                                                </div>
                                                            </div>
                                                            <div class="position-absolute bottom-0 start-0 p-1">
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"
                                                                        class="form-check-input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <div class="small text-muted">
                                                    * حدد الصور للحذف
                                                    <br>
                                                    * اختر الصورة الرئيسية
                                                </div>
                                            </div>

                                            <!-- New Images -->
                                            <div class="mb-3">
                                                <label class="form-label">إضافة صور جديدة</label>
                                                @error('new_images.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                @error('is_primary.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div id="newImagesContainer">
                                                    <div class="mb-2">
                                                        <div class="input-group shadow-sm">
                                                            <input type="file" name="new_images[]" class="form-control" accept="image/*">
                                                            <div class="input-group-text">
                                                                <label class="mb-0">
                                                                    <input type="radio" name="is_primary_new[0]" value="1" class="me-1">
                                                                    صورة رئيسية
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-light-secondary btn-sm mt-2" onclick="addNewImageInput()">
                                                    <i class="fas fa-plus"></i>
                                                    إضافة صورة
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Colors -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="card-title mb-0">
                                                    <i class="fas fa-palette text-primary me-2"></i>
                                                    الألوان المتاحة
                                                </h5>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        id="hasColors"
                                                        name="has_colors"
                                                        value="1"
                                                        {{ $product->colors->count() > 0 || old('has_colors') ? 'checked' : '' }}
                                                        onchange="toggleColorsSection(this)">
                                                    <label class="form-check-label" for="hasColors">تفعيل الألوان</label>
                                                </div>
                                            </div>
                                            <div id="colorsSection" class="{{ $product->colors->count() > 0 ? 'section-expanded' : 'section-collapsed' }}">
                                                @error('colors.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                @error('color_ids.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                @error('color_available.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div id="colorsContainer">
                                                    @foreach($product->colors as $color)
                                                    <div class="input-group mb-2 shadow-sm">
                                                        <input type="hidden" name="color_ids[]" value="{{ $color->id }}">
                                                        <input type="text" name="colors[]" class="form-control" placeholder="اسم اللون" value="{{ $color->color }}">
                                                        <div class="input-group-text">
                                                            <label class="mb-0">
                                                                <input type="checkbox" name="color_available[]" value="1" {{ $color->is_available ? 'checked' : '' }} class="me-1">
                                                                متوفر
                                                            </label>
                                                        </div>
                                                        <button type="button" class="btn btn-light-danger" onclick="this.closest('.input-group').remove()">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-light-secondary btn-sm" onclick="addColorInput()">
                                                    <i class="fas fa-plus"></i>
                                                    إضافة لون
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sizes -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="card-title mb-0">
                                                    <i class="fas fa-ruler text-primary me-2"></i>
                                                    المقاسات المتاحة
                                                </h5>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        id="hasSizes"
                                                        name="has_sizes"
                                                        value="1"
                                                        {{ $product->sizes->count() > 0 || old('has_sizes') ? 'checked' : '' }}
                                                        onchange="toggleSizesSection(this)">
                                                    <label class="form-check-label" for="hasSizes">تفعيل المقاسات</label>
                                                </div>
                                            </div>
                                            <div id="sizesSection" class="{{ $product->sizes->count() > 0 ? 'section-expanded' : 'section-collapsed' }}">
                                                @error('sizes.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                @error('size_ids.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                @error('size_available.*')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div id="sizesContainer">
                                                    @foreach($product->sizes as $size)
                                                    <div class="input-group mb-2 shadow-sm">
                                                        <input type="hidden" name="size_ids[]" value="{{ $size->id }}">
                                                        <input type="text" name="sizes[]" class="form-control" placeholder="المقاس" value="{{ $size->size }}">
                                                        <input type="number" name="size_prices[]" class="form-control" placeholder="السعر" step="0.01" value="{{ $size->price }}">
                                                        <div class="input-group-text">
                                                            <label class="mb-0">
                                                                <input type="checkbox" name="size_available[]" value="1" {{ $size->is_available ? 'checked' : '' }} class="me-1">
                                                                متوفر
                                                            </label>
                                                        </div>
                                                        <button type="button" class="btn btn-light-danger" onclick="this.closest('.input-group').remove()">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-light-secondary btn-sm" onclick="addSizeInput()">
                                                    <i class="fas fa-plus"></i>
                                                    إضافة مقاس
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Options -->
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">
                                                <i class="fas fa-cog text-primary me-2"></i>
                                                خيارات المنتج
                                            </h5>
                                            <div class="row g-3">
                                                <!-- Color Selection Option -->
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="enable_color_selection" name="enable_color_selection"
                                                            value="1" {{ old('enable_color_selection', $product->enable_color_selection) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="enable_color_selection">
                                                            <i class="fas fa-palette me-2"></i>
                                                            السماح باختيار اللون
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Custom Color Option -->
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="enable_custom_color" name="enable_custom_color"
                                                            value="1" {{ $product->enable_custom_color ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="enable_custom_color">
                                                            <i class="fas fa-paint-brush me-2"></i>
                                                            السماح بإضافة لون مخصص
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Size Selection Option -->
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="enable_size_selection" name="enable_size_selection"
                                                            value="1" {{ old('enable_size_selection', $product->enable_size_selection) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="enable_size_selection">
                                                            <i class="fas fa-ruler me-2"></i>
                                                            السماح باختيار المقاسات المحددة
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Custom Size Option -->
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="enable_custom_size" name="enable_custom_size"
                                                            value="1" {{ $product->enable_custom_size ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="enable_custom_size">
                                                            <i class="fas fa-ruler-combined me-2"></i>
                                                            السماح بإضافة مقاس مخصص
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="alert alert-info mt-3">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <strong>ملاحظة:</strong> هذه الإعدادات تتحكم في الخيارات المتاحة للعملاء عند طلب هذا المنتج.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tax Settings -->
                                <div class="col-12 mt-4">
                                    <div class="card card-body shadow-sm border-0">
                                        <div class="card-title d-flex align-items-center justify-content-between">
                                            <h5>
                                                <i class="fas fa-percentage text-primary me-2"></i>
                                                إعدادات الضريبة
                                            </h5>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="hasTax" name="has_tax"
                                                    value="1" {{ old('has_tax', $product->has_tax) ? 'checked' : '' }}
                                                    onchange="toggleTaxSection(this)">
                                                <label class="form-check-label" for="hasTax">تفعيل الضريبة</label>
                                            </div>
                                        </div>
                                        
                                        <div id="taxSection" class="{{ old('has_tax', $product->has_tax) ? 'section-expanded' : 'section-collapsed' }}">
                                            <div class="row g-3 mt-2">
                                                <!-- Tax Type -->
                                                <div class="col-md-6">
                                                    <label class="form-label">
                                                        <i class="fas fa-tag me-1"></i>
                                                        نوع الضريبة
                                                    </label>
                                                    <select name="tax_type" class="form-select @error('tax_type') is-invalid @enderror" id="taxType">
                                                        <option value="">اختر نوع الضريبة</option>
                                                        <option value="percentage" {{ old('tax_type', $product->tax_type) === 'percentage' ? 'selected' : '' }}>نسبة مئوية (%)</option>
                                                        <option value="fixed" {{ old('tax_type', $product->tax_type) === 'fixed' ? 'selected' : '' }}>مبلغ ثابت (ر.س)</option>
                                                    </select>
                                                    @error('tax_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Tax Value -->
                                                <div class="col-md-6">
                                                    <label class="form-label">
                                                        <i class="fas fa-calculator me-1"></i>
                                                        قيمة الضريبة
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" name="tax_value" 
                                                            class="form-control @error('tax_value') is-invalid @enderror"
                                                            placeholder="أدخل قيمة الضريبة" 
                                                            step="0.01" min="0" max="100"
                                                            value="{{ old('tax_value', $product->tax_value) }}"
                                                            id="taxValue">
                                                        <span class="input-group-text" id="taxUnit">
                                                            {{ old('tax_type', $product->tax_type) === 'fixed' ? 'ر.س' : '%' }}
                                                        </span>
                                                    </div>
                                                    @error('tax_value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <small class="form-text text-muted" id="taxHint">
                                                        @if(old('tax_type', $product->tax_type) === 'fixed')
                                                            أدخل قيمة الضريبة الثابتة بالريال السعودي
                                                        @else
                                                            أدخل نسبة الضريبة المئوية (مثال: 15 لـ 15%)
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>

                                            @if($product->has_tax && $product->tax_value)
                                            <div class="alert alert-success mt-3">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <strong>الضريبة الحالية:</strong>
                                                {{ $product->tax_display }}
                                                @if($product->base_price)
                                                    - قيمة الضريبة على السعر الأساسي: {{ number_format($product->calculateTaxAmount($product->base_price), 2) }} ر.س
                                                @endif
                                            </div>
                                            @endif

                                            <div class="alert alert-info mt-3">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <strong>ملاحظة:</strong> 
                                                <span id="taxNote">
                                                    سيتم إضافة الضريبة إلى سعر المنتج وعرضها للعميل بوضوح.
                                                    النسبة المئوية تطبق على السعر الأساسي، بينما المبلغ الثابت يضاف كما هو.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Related Products -->
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h6 class="card-title mb-0">
                                                <i class="fas fa-link text-primary me-2"></i>
                                                المنتجات ذات الصلة
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="related-products-container">
                                                        @if($product->relatedProducts->count() > 0)
                                                            @foreach($product->relatedProducts as $index => $relatedProductRelation)
                                                                <div class="related-product-row mb-3">
                                                                    <div class="row align-items-end">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">اختر منتج ذو صلة</label>
                                                                            <select name="related_products[]" class="form-select">
                                                                                <option value="">-- اختر منتج --</option>
                                                                                @foreach($allProducts as $availableProduct)
                                                                                    <option value="{{ $availableProduct->id }}" 
                                                                                        {{ $availableProduct->id == $relatedProductRelation->related_product_id ? 'selected' : '' }}>
                                                                                        {{ $availableProduct->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label">نوع العلاقة</label>
                                                                            <select name="related_product_types[]" class="form-select">
                                                                                <option value="frequently_bought_together" {{ $relatedProductRelation->type == 'frequently_bought_together' ? 'selected' : '' }}>يُشترى مع بعض غالباً</option>
                                                                                <option value="recommended" {{ $relatedProductRelation->type == 'recommended' ? 'selected' : '' }}>منتجات مُوصى بها</option>
                                                                                <option value="similar" {{ $relatedProductRelation->type == 'similar' ? 'selected' : '' }}>منتجات مشابهة</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <button type="button" class="btn btn-danger btn-sm remove-related-product" style="{{ $loop->first && $product->relatedProducts->count() == 1 ? 'display: none;' : '' }}">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="related-product-row mb-3">
                                                                <div class="row align-items-end">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">اختر منتج ذو صلة</label>
                                                                        <select name="related_products[]" class="form-select">
                                                                            <option value="">-- اختر منتج --</option>
                                                                            @foreach($allProducts as $availableProduct)
                                                                                <option value="{{ $availableProduct->id }}">{{ $availableProduct->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">نوع العلاقة</label>
                                                                        <select name="related_product_types[]" class="form-select">
                                                                            <option value="frequently_bought_together">يُشترى مع بعض غالباً</option>
                                                                            <option value="recommended">منتجات مُوصى بها</option>
                                                                            <option value="similar">منتجات مشابهة</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button type="button" class="btn btn-danger btn-sm remove-related-product" style="display: none;">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-related-product">
                                                        <i class="fas fa-plus me-1"></i>
                                                        أضف منتج آخر
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>
                                                حفظ التغييرات
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="/assets/css/admin/products.css">
@endsection

@section('scripts')
<script>
    let newImageCount = 1;

    // Function to generate slug from product name
    function generateSlug(name) {
        // Convert to lowercase and replace spaces with hyphens
        let slug = name.toLowerCase().trim().replace(/\s+/g, '-');
        // Remove special characters
        slug = slug.replace(/[^\u0621-\u064A\u0660-\u0669a-z0-9-]/g, '');
        // Replace multiple hyphens with a single one
        slug = slug.replace(/-+/g, '-');
        return slug;
    }

    // Add event listener to name field to auto-generate slug
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.querySelector('input[name="name"]');
        const slugInput = document.querySelector('input[name="slug"]');

        if (nameInput && slugInput) {
            nameInput.addEventListener('input', function() {
                slugInput.value = generateSlug(this.value);
            });
        }
    });

    function toggleColorsSection(checkbox) {
        const colorsSection = document.getElementById('colorsSection');
        const enableColorSelectionCheckbox = document.getElementById('enable_color_selection');
        if (checkbox.checked) {
            colorsSection.classList.remove('section-collapsed');
            colorsSection.classList.add('section-expanded');
            if (enableColorSelectionCheckbox) {
                enableColorSelectionCheckbox.checked = true;
            }
            if (!document.querySelector('#colorsContainer .input-group')) {
                addColorInput();
            }
        } else {
            if (document.querySelectorAll('#colorsContainer .input-group').length > 0) {
                if (!confirm('هل أنت متأكد من إلغاء تفعيل الألوان؟ سيتم حذف جميع الألوان المدخلة عند الحفظ.')) {
                    checkbox.checked = true;
                    return;
                }
            }
            colorsSection.classList.remove('section-expanded');
            colorsSection.classList.add('section-collapsed');
            if (enableColorSelectionCheckbox) {
                enableColorSelectionCheckbox.checked = false;
            }
        }
    }

    function toggleSizesSection(checkbox) {
        const sizesSection = document.getElementById('sizesSection');
        const enableSizeSelectionCheckbox = document.getElementById('enable_size_selection');
        if (checkbox.checked) {
            sizesSection.classList.remove('section-collapsed');
            sizesSection.classList.add('section-expanded');
            if (enableSizeSelectionCheckbox) {
                enableSizeSelectionCheckbox.checked = true;
            }
            if (!document.querySelector('#sizesContainer .input-group')) {
                addSizeInput();
            }
        } else {
            if (document.querySelectorAll('#sizesContainer .input-group').length > 0) {
                if (!confirm('هل أنت متأكد من إلغاء تفعيل المقاسات؟ سيتم حذف جميع المقاسات المدخلة عند الحفظ.')) {
                    checkbox.checked = true;
                    return;
                }
            }
            sizesSection.classList.remove('section-expanded');
            sizesSection.classList.add('section-collapsed');
            if (enableSizeSelectionCheckbox) {
                enableSizeSelectionCheckbox.checked = false;
            }
        }
    }

    function addNewImageInput() {
        const container = document.getElementById('newImagesContainer');
        const div = document.createElement('div');
        div.className = 'mb-2';
        div.innerHTML = `
        <div class="input-group shadow-sm">
            <input type="file" name="new_images[]" class="form-control" accept="image/*">
            <div class="input-group-text">
                <label class="mb-0">
                    <input type="radio" name="is_primary_new[${newImageCount}]" value="1" class="me-1">
                    صورة رئيسية
                </label>
            </div>
            <button type="button" class="btn btn-light-danger" onclick="this.closest('.mb-2').remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
        container.appendChild(div);
        newImageCount++;
    }

    function addColorInput() {
        const container = document.getElementById('colorsContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2 shadow-sm';
        div.innerHTML = `
        <input type="hidden" name="color_ids[]" value="">
        <input type="text" name="colors[]" class="form-control" placeholder="اسم اللون">
        <div class="input-group-text">
            <label class="mb-0">
                <input type="checkbox" name="color_available[]" value="1" checked class="me-1">
                متوفر
            </label>
        </div>
        <button type="button" class="btn btn-light-danger" onclick="this.closest('.input-group').remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
        container.appendChild(div);
    }

    function addSizeInput() {
        const container = document.getElementById('sizesContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2 shadow-sm';
        div.innerHTML = `
        <input type="hidden" name="size_ids[]" value="">
        <input type="text" name="sizes[]" class="form-control" placeholder="المقاس">
        <input type="number" name="size_prices[]" class="form-control" placeholder="السعر" step="0.01">
        <div class="input-group-text">
            <label class="mb-0">
                <input type="checkbox" name="size_available[]" value="1" checked class="me-1">
                متوفر
            </label>
        </div>
        <button type="button" class="btn btn-light-danger" onclick="this.closest('.input-group').remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
        container.appendChild(div);
    }

    function addDetailInput() {
        const container = document.getElementById('detailsContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2 shadow-sm';
        div.innerHTML = `
        <input type="text" name="detail_keys[]" class="form-control" placeholder="الخاصية">
        <input type="text" name="detail_values[]" class="form-control" placeholder="القيمة">
        <button type="button" class="btn btn-light-danger" onclick="this.closest('.input-group').remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
        container.appendChild(div);
    }

    // Initialize the page when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Check if details container is empty and add one input if needed
        if (document.querySelectorAll('#detailsContainer .input-group').length === 0) {
            addDetailInput();
        }

        // Setup tax type change handler
        const taxTypeSelect = document.getElementById('taxType');
        const taxUnit = document.getElementById('taxUnit');
        const taxHint = document.getElementById('taxHint');
        const taxValue = document.getElementById('taxValue');

        if (taxTypeSelect) {
            taxTypeSelect.addEventListener('change', function() {
                updateTaxUI(this.value);
            });

            // Initialize UI based on current value
            updateTaxUI(taxTypeSelect.value);
        }
    });

    function toggleTaxSection(checkbox) {
        const section = document.getElementById('taxSection');

        if (checkbox.checked) {
            section.classList.remove('section-collapsed');
            section.classList.add('section-expanded');
        } else {
            if (document.querySelector('#taxSection input[name="tax_value"]').value) {
                if (!confirm('هل أنت متأكد من إلغاء تفعيل الضريبة؟ سيتم حذف جميع إعدادات الضريبة المدخلة.')) {
                    checkbox.checked = true;
                    return;
                }
            }
            section.classList.remove('section-expanded');
            section.classList.add('section-collapsed');
            
            // Reset tax fields
            document.getElementById('taxType').value = '';
            document.getElementById('taxValue').value = '';
            updateTaxUI('');
        }
    }

    function updateTaxUI(taxType) {
        const taxUnit = document.getElementById('taxUnit');
        const taxHint = document.getElementById('taxHint');
        const taxValue = document.getElementById('taxValue');

        if (taxType === 'percentage') {
            taxUnit.textContent = '%';
            taxHint.textContent = 'أدخل نسبة الضريبة المئوية (مثال: 15 لـ 15%)';
            taxValue.setAttribute('max', '100');
            taxValue.setAttribute('placeholder', 'أدخل نسبة الضريبة');
        } else if (taxType === 'fixed') {
            taxUnit.textContent = 'ر.س';
            taxHint.textContent = 'أدخل قيمة الضريبة الثابتة بالريال السعودي';
            taxValue.removeAttribute('max');
            taxValue.setAttribute('placeholder', 'أدخل قيمة الضريبة');
        } else {
            taxUnit.textContent = '%';
            taxHint.textContent = 'أدخل قيمة الضريبة';
            taxValue.setAttribute('placeholder', 'أدخل قيمة الضريبة');
        }
    }

    // Related Products functionality
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add-related-product');
        const container = document.getElementById('related-products-container');
        
        // Add new related product row
        addButton.addEventListener('click', function() {
            const newRow = createRelatedProductRow();
            container.appendChild(newRow);
            updateRemoveButtons();
        });
        
        // Handle remove button clicks
        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-related-product') || e.target.closest('.remove-related-product')) {
                const row = e.target.closest('.related-product-row');
                row.remove();
                updateRemoveButtons();
            }
        });
        
        function createRelatedProductRow() {
            const row = document.createElement('div');
            row.className = 'related-product-row mb-3';
            row.innerHTML = `
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label class="form-label">اختر منتج ذو صلة</label>
                        <select name="related_products[]" class="form-select">
                            <option value="">-- اختر منتج --</option>
                            @foreach($allProducts as $availableProduct)
                                <option value="{{ $availableProduct->id }}">{{ $availableProduct->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">نوع العلاقة</label>
                        <select name="related_product_types[]" class="form-select">
                            <option value="frequently_bought_together">يُشترى مع بعض غالباً</option>
                            <option value="recommended">منتجات مُوصى بها</option>
                            <option value="similar">منتجات مشابهة</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-related-product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            return row;
        }
        
        function updateRemoveButtons() {
            const rows = container.children;
            const removeButtons = container.querySelectorAll('.remove-related-product');
            
            removeButtons.forEach(button => {
                button.style.display = rows.length > 1 ? 'block' : 'none';
            });
        }
        
        // Initial update
        updateRemoveButtons();
    });
</script>
@endsection
