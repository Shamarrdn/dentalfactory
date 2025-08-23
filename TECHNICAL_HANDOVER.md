# 📋 دليل التسليم التقني - مصنع منتجات الأسنان

## 🎯 ملخص سريع للمشروع

**نوع المشروع**: متجر إلكتروني لمصنع منتجات الأسنان  
**التقنية**: Laravel 11 + MySQL + Bootstrap 5  
**حالة المشروع**: جاهز للإنتاج ✅  
**آخر تحديث**: أغسطس 2025  

---

## 🚀 ما يجب أن تعرفه فوراً

### أوامر أساسية
```bash
# تشغيل المشروع محلياً
php artisan serve

# مشاهدة الأخطاء المباشرة
tail -f storage/logs/laravel.log

# إعادة تحميل قاعدة البيانات
php artisan migrate:fresh --seed
```

### URLs مهمة
- **الموقع العام**: `http://localhost:8000`
- **لوحة تحكم الإدارة**: `http://localhost:8000/admin/dashboard`
- **إدارة المنتجات**: `http://localhost:8000/admin/products`
- **إدارة الطلبات**: `http://localhost:8000/admin/orders`

### بيانات دخول تجريبية
```
Admin:
Email: admin@dental-factory.com
Password: password

Customer:
Email: customer@test.com  
Password: password
```

---

## 📁 هيكل المشروع (ما تحتاج تعرفه)

```
dental-factory/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/           # كنترولرز الإدارة
│   │   ├── ProductController.php    # المنتجات (العام)
│   │   ├── CartController.php       # العربة
│   │   └── CheckoutController.php   # عملية الشراء
│   ├── Models/
│   │   ├── Product.php      # نموذج المنتج (مع الضرائب)
│   │   ├── Order.php        # نموذج الطلبات
│   │   ├── Cart.php         # نموذج العربة
│   │   └── User.php         # نموذج المستخدمين
│   └── Services/
│       ├── DiscountService.php      # خدمة التخفيضات
│       └── FirebaseNotificationService.php # الإشعارات
├── resources/views/
│   ├── admin/               # صفحات الإدارة
│   ├── products/            # صفحات المنتجات
│   ├── cart/                # صفحة العربة
│   └── checkout/            # صفحة الشراء
├── routes/
│   └── web.php              # جميع المسارات
└── database/migrations/     # تغييرات قاعدة البيانات
```

---

## 🛠️ المميزات الجديدة (مضافة مؤخراً)

### 1. نظام الضرائب ⭐ NEW
**الملفات المحدثة**:
- `app/Models/Product.php` - دوال حساب الضريبة
- `resources/views/admin/products/create.blade.php` - واجهة إضافة ضريبة
- `resources/views/admin/products/edit.blade.php` - واجهة تعديل ضريبة
- `database/migrations/*_add_tax_fields_to_products_table.php` - حقول الضريبة

**كيف تعمل**:
```php
// في Product Model
$product->calculateTaxAmount(100); // حساب الضريبة على مبلغ
$product->getPriceWithTax(100);    // السعر + الضريبة
$product->hasTax();                // هل المنتج عليه ضريبة؟
```

### 2. تحسينات UI/UX
- تصميم محسن للوحة التحكم
- animations للقوائم والتبديل
- عرض أفضل للضرائب في صفحات المنتجات

---

## 🔄 سير العمل الأساسي

### مسار العميل:
```
الموقع الرئيسي → تصفح المنتجات → تفاصيل المنتج → إضافة للعربة → Checkout → إتمام الطلب
```

### مسار الإدارة:
```
لوحة التحكم → إدارة المنتجات/الطلبات → تحديث البيانات → إرسال إشعارات
```

---

## 🐛 مشاكل شائعة وحلولها

### 1. الصور لا تظهر
```bash
php artisan storage:link
```

### 2. أخطاء في Permissions
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### 3. مشاكل قاعدة البيانات
- تحقق من `.env` file
- تأكد من وجود قاعدة البيانات
- شغل `php artisan migrate`

### 4. مشاكل Cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

---

## 📊 معلومات قاعدة البيانات

### جداول رئيسية:
- `users` - المستخدمين والمديرين
- `products` - المنتجات (مع الضرائب الجديدة)
- `categories` - تصنيفات المنتجات  
- `carts` & `cart_items` - عربة التسوق
- `orders` & `order_items` - الطلبات
- `coupons` - كوبونات التخفيض

### العلاقات المهمة:
```sql
User -> hasMany -> Orders
Product -> belongsTo -> Category  
Order -> hasMany -> OrderItems
Cart -> hasMany -> CartItems
```

---

## 🔧 مهام صيانة دورية

### يومياً:
- [ ] مراجعة `storage/logs/laravel.log`
- [ ] متابعة الطلبات الجديدة في لوحة التحكم
- [ ] تحقق من عمل الإشعارات

### أسبوعياً:
- [ ] تنظيف logs: `php artisan log:clear`
- [ ] backup قاعدة البيانات
- [ ] تحديث Dependencies إذا لزم الأمر

### شهرياً:
- [ ] مراجعة أداء الموقع
- [ ] تحديث Laravel إذا لزم الأمر
- [ ] مراجعة أمان التطبيق

---

## 📱 إعدادات Firebase (للإشعارات)

### الملفات المطلوبة:
- `public/admin/firebase-messaging-sw.js` - Service Worker
- `config/services.php` - إعدادات Firebase

### اختبار الإشعارات:
```php
// في Controller
use App\Services\FirebaseNotificationService;

$firebase = new FirebaseNotificationService();
$firebase->sendToUser($userId, 'عنوان', 'محتوى الرسالة');
```

---

## 💼 نصائح للعمل اليومي

### 1. إضافة منتج جديد:
```
admin/products/create → ملء البيانات → إضافة صور → تحديد ضريبة → حفظ
```

### 2. معالجة طلب:
```
admin/orders → اختيار الطلب → تحديث الحالة → حفظ (سيرسل إشعار تلقائياً)
```

### 3. إضافة كوبون تخفيض:
```
admin/coupons/create → تحديد نوع التخفيض → تحديد المنتجات → حفظ
```

---

## 🚨 أرقام الطوارئ والدعم

### ملفات logs مهمة:
- `storage/logs/laravel.log` - أخطاء التطبيق
- `storage/logs/laravel-*.log` - logs قديمة

### Commands للطوارئ:
```bash
# إعادة تشغيل التطبيق بسرعة
php artisan down           # إيقاف الموقع
php artisan optimize       # تحسين الأداء  
php artisan up             # تشغيل الموقع

# في حالة مشاكل database
php artisan migrate:status # حالة migrations
php artisan migrate:rollback # التراجع
```

---

## 📈 نقاط تطوير مستقبلية

### مقترحات للتحسين:
1. **API للموبايل**: إضافة Laravel Sanctum API
2. **تقارير متقدمة**: Excel exports للطلبات
3. **نظام المخزون**: تتبع كميات المنتجات
4. **دفع إلكتروني**: ربط مع معالج دفع
5. **تطبيق موبايل**: Flutter أو React Native

### ملفات للمراجعة عند التطوير:
- `routes/web.php` - لإضافة مسارات جديدة
- `app/Models/` - لتعديل النماذج
- `database/migrations/` - لتغييرات قاعدة البيانات

---

## ✅ Checklist قبل التسليم

### تم إنجازه:
- [x] نظام إدارة المنتجات كامل
- [x] نظام العربة والشراء
- [x] نظام الطلبات والتتبع  
- [x] نظام الكوبونات والتخفيضات
- [x] نظام الضرائب (جديد)
- [x] لوحة تحكم إدارية شاملة
- [x] نظام الإشعارات مع Firebase
- [x] تصميم responsive للهواتف

### للتطوير المستقبلي:
- [ ] API للتطبيقات الخارجية
- [ ] نظام المخزون المتقدم
- [ ] تقارير Excel
- [ ] دفع إلكتروني

---

## 📞 معلومات الاتصال

**في حالة الطوارئ أو المشاكل التقنية:**
- راجع `storage/logs/laravel.log` أولاً
- تحقق من إعدادات `.env`
- جرب الأوامر الأساسية في القسم أعلاه

**للتطوير الجديد:**
- اقرأ `PROJECT_WORKFLOW_GUIDE.md` للتفاصيل الكاملة
- راجع كود Laravel documentation
- اتبع نمط الكود الموجود في المشروع

---

**تذكر**: هذا المشروع جاهز للعمل وتم اختباره بعناية. معظم المشاكل تُحل بالأوامر الأساسية المذكورة أعلاه! 🚀

**حظاً موفقاً مع المشروع!** 💪
