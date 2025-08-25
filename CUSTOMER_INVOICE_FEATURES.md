# ميزات الفاتورة للعملاء - Customer Invoice Features

## نظرة عامة
تم إضافة ميزات شاملة للفواتير في صفحات العملاء، تتيح للعملاء عرض وطباعة وإرسال فواتيرهم بسهولة.

## الميزات المضافة

### 1. صفحة قائمة الطلبات (`/orders`)
- **دروب داون فاتورة** لكل طلب يحتوي على:
  - 👁️ **عرض الفاتورة** - فتح الفاتورة في نافذة جديدة
  - 🖨️ **طباعة الفاتورة** - طباعة الفاتورة مباشرة
  - 📧 **إرسال لإيميلي** - إرسال نسخة PDF للإيميل

### 2. صفحة تفاصيل الطلب (`/orders/{uuid}`)
- **زر طباعة الفاتورة** في أعلى الصفحة
- نفس خيارات الدروب داون (عرض، طباعة، إرسال)

### 3. صفحة عرض الفاتورة (`/customer/orders/{uuid}/invoice/view`)
- **تصميم احترافي** مطابق لفاتورة الإدارة
- **أزرار عائمة** للطباعة والإغلاق
- **تحسين للطباعة** - إخفاء الأزرار عند الطباعة
- **اختصارات لوحة المفاتيح**:
  - `Ctrl+P` للطباعة
  - `Esc` للإغلاق

## الملفات المضافة/المعدلة

### Controllers
- `app/Http/Controllers/Customer/InvoiceController.php` - **جديد**
  - `view()` - عرض الفاتورة
  - `sendByEmail()` - إرسال بالإيميل
  - `getData()` - بيانات JSON

### Routes
```php
// في routes/web.php
Route::prefix('customer/orders')->name('customer.orders.')->group(function () {
    Route::prefix('{uuid}/invoice')->name('invoice.')->group(function () {
        Route::get('/view', [Customer\InvoiceController::class, 'view'])->name('view');
        Route::post('/send', [Customer\InvoiceController::class, 'sendByEmail'])->name('send');
        Route::get('/data', [Customer\InvoiceController::class, 'getData'])->name('data');
    });
});
```

### Views
- `resources/views/customer/invoices/template.blade.php` - **جديد**
- `resources/views/orders/index.blade.php` - **معدل**
- `resources/views/orders/show.blade.php` - **معدل**

### CSS
- `public/assets/css/customer/invoice-buttons.css` - **جديد**

## كيفية الاستخدام

### للعميل:
1. **في قائمة الطلبات:**
   - اضغط على "الفاتورة" بجانب أي طلب
   - اختر الإجراء المطلوب

2. **في تفاصيل الطلب:**
   - اضغط على "طباعة الفاتورة" في أعلى الصفحة
   - اختر الإجراء المطلوب

3. **في صفحة الفاتورة:**
   - استخدم أزرار الطباعة والإغلاق
   - أو استخدم اختصارات لوحة المفاتيح

### للمطور:
```javascript
// إرسال فاتورة بالإيميل
async function requestInvoiceByEmail(orderUuid) {
    const response = await fetch(`/customer/orders/${orderUuid}/invoice/send`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
    
    const data = await response.json();
    // معالجة الاستجابة
}
```

## الأمان والصلاحيات
- ✅ **التحقق من الهوية** - يجب تسجيل الدخول
- ✅ **التحقق من الملكية** - العميل يرى طلباته فقط
- ✅ **CSRF Protection** - حماية من هجمات CSRF
- ✅ **UUID Routing** - استخدام UUID بدلاً من ID للأمان

## التصميم المتجاوب
- 📱 **الجوال** - تصميم متجاوب للهواتف الذكية
- 💻 **سطح المكتب** - تصميم محسن للشاشات الكبيرة
- 🖨️ **الطباعة** - تحسين خاص للطباعة

## الإشعارات
- ✅ **نجاح الإرسال** - إشعار أخضر
- ❌ **فشل الإرسال** - إشعار أحمر
- ⏳ **حالة التحميل** - مؤشر تحميل أثناء العملية

## التوافق
- ✅ **جميع المتصفحات الحديثة**
- ✅ **RTL Support** - دعم كامل للعربية
- ✅ **Bootstrap 5** - متوافق مع التصميم الحالي
- ✅ **Font Awesome & Bootstrap Icons**

## ملاحظات فنية
- استخدام **AJAX** للإرسال بالإيميل
- **PDF generation** باستخدام DomPDF
- **Email templates** مخصصة
- **CSS animations** للتفاعلات
- **Error handling** شامل
