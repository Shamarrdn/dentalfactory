# Frequently Bought Together Feature

## نظرة عامة
ميزة "المنتجات التي يتم شراؤها مع بعض غالباً" تسمح للعملاء برؤية المنتجات ذات الصلة وإضافتها جميعاً للسلة بنقرة واحدة.

## المكونات

### 1. قاعدة البيانات
- **الجدول**: `related_products`
- **الحقول**:
  - `id`: المعرف الفريد
  - `product_id`: معرف المنتج الأساسي
  - `related_product_id`: معرف المنتج ذو الصلة
  - `type`: نوع العلاقة (frequently_bought_together, recommended, similar)
  - `timestamps`: تاريخ الإنشاء والتحديث

### 2. النماذج (Models)
- **RelatedProduct**: نموذج العلاقات بين المنتجات
- **Product**: تم تحديثه ليتضمن العلاقات مع المنتجات ذات الصلة

### 3. لوحة التحكم (Admin Panel)
#### إنشاء منتج جديد
- حقل متعدد الاختيارات لاختيار المنتجات ذات الصلة
- خيار تحديد نوع العلاقة لكل منتج
- إمكانية إضافة عدة منتجات

#### تعديل منتج موجود
- عرض المنتجات ذات الصلة الحالية
- إمكانية تعديل أو حذف العلاقات
- إضافة منتجات جديدة

### 4. الواجهة الأمامية (Frontend)
#### مكون Livewire
- `FrequentlyBoughtTogether`: مكون تفاعلي لعرض المنتجات ذات الصلة
- إمكانية تحديد/إلغاء تحديد المنتجات
- حساب السعر الإجمالي تلقائياً
- إضافة كل المنتجات المحددة للسلة

#### واجهة المستخدم
- تصميم بـ TailwindCSS
- عرض صور المنتجات والأسعار
- checkboxes لاختيار المنتجات
- زر "أضف الكل للسلة"

### 5. خدمة السلة (Cart Service)
- دالة `addMultipleToCart()`: لإضافة عدة منتجات في عملية واحدة
- معالجة الأخطاء والنجاح
- تحديث إجمالي السلة

## الاستخدام

### في لوحة التحكم
1. اذهب إلى "إضافة منتج جديد" أو "تعديل منتج"
2. في قسم "المنتجات ذات الصلة":
   - اختر منتج من القائمة المنسدلة
   - حدد نوع العلاقة
   - اضغط "أضف منتج آخر" لإضافة المزيد
3. احفظ المنتج

### في الواجهة الأمامية
1. اذهب إلى صفحة منتج معين
2. ستظهر قائمة "المنتجات التي يتم شراؤها مع بعض غالباً" إذا وُجدت
3. يمكن تحديد أو إلغاء تحديد المنتجات
4. يتم حساب السعر الإجمالي تلقائياً
5. اضغط "أضف الكل للسلة" لإضافة كل المنتجات المحددة

## البيانات التجريبية
استخدم الأمر التالي لإضافة بيانات تجريبية:
```bash
php artisan db:seed --class=RelatedProductsSeeder
```

## الاختبارات
تم إنشاء اختبارات شاملة في:
- `tests/Feature/FrequentlyBoughtTogetherTest.php`

تشغيل الاختبارات:
```bash
php artisan test --filter FrequentlyBoughtTogetherTest
```

## الملفات المضافة/المحدثة

### ملفات جديدة:
- `database/migrations/2025_08_23_140128_create_related_products_table.php`
- `app/Models/RelatedProduct.php`
- `app/Livewire/FrequentlyBoughtTogether.php`
- `resources/views/livewire/frequently-bought-together.blade.php`
- `database/seeders/RelatedProductsSeeder.php`
- `public/assets/js/admin/related-products.js`
- `public/assets/css/admin/related-products.css`
- `tests/Feature/FrequentlyBoughtTogetherTest.php`

### ملفات محدثة:
- `app/Models/Product.php`: إضافة العلاقات
- `app/Http/Controllers/Admin/ProductController.php`: معالجة المنتجات ذات الصلة
- `app/Services/Customer/Products/CartService.php`: دالة إضافة متعددة
- `resources/views/admin/products/create.blade.php`: واجهة إضافة
- `resources/views/admin/products/edit.blade.php`: واجهة تعديل
- `resources/views/products/show.blade.php`: عرض المكون

## المميزات
- ✅ إدارة كاملة من لوحة التحكم
- ✅ واجهة مستخدم تفاعلية
- ✅ إضافة متعددة للسلة
- ✅ دعم أنواع علاقات مختلفة
- ✅ تصميم متجاوب
- ✅ اختبارات شاملة
- ✅ بيانات تجريبية

## تحسينات مستقبلية محتملة
- إحصائيات المبيعات لتحديد المنتجات الأكثر شراءً معاً
- اقتراحات تلقائية بناءً على سلوك المستخدمين
- خصومات خاصة للمنتجات المترابطة
- API endpoints للتطبيقات المحمولة
