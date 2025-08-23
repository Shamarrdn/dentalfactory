# دليل Workflow مصنع منتجات الأسنان 🦷

## نظرة عامة على المشروع

هذا التطبيق مبني بـ **Laravel 11** ويهدف لإدارة مصنع منتجات الأسنان مع نظام بيع إلكتروني شامل.

---

## 🏗️ البنية التقنية

### التقنيات المستخدمة
- **Backend**: Laravel 11.31
- **Frontend**: Blade Templates + Bootstrap 5
- **Database**: MySQL
- **Authentication**: Laravel Jetstream + Fortify
- **Notifications**: Firebase Cloud Messaging
- **File Storage**: Laravel Storage
- **PDF Generation**: DomPDF
- **Image Processing**: Intervention Image
- **Permissions**: Spatie Laravel Permission

### المكتبات الرئيسية
```json
{
  "laravel/jetstream": "إدارة المصادقة والملفات الشخصية",
  "spatie/laravel-permission": "إدارة الأدوار والصلاحيات",
  "barryvdh/laravel-dompdf": "توليد ملفات PDF",
  "intervention/image": "معالجة الصور",
  "google/apiclient": "Firebase Notifications",
  "cviebrock/eloquent-sluggable": "إنشاء Slugs تلقائياً"
}
```

---

## 👥 أنواع المستخدمين والأدوار

### 1. العملاء (Customers)
- **Role**: `customer`
- **الصلاحيات**:
  - تصفح المنتجات
  - إضافة منتجات للعربة
  - إتمام عمليات الشراء
  - تتبع الطلبات
  - إدارة الملف الشخصي

### 2. المديرين (Admins)
- **Role**: `admin`
- **الصلاحيات**:
  - `manage products`: إدارة المنتجات والتصنيفات
  - `manage orders`: إدارة الطلبات
  - `manage reports`: عرض التقارير

---

## 🗂️ هيكل قاعدة البيانات

### الجداول الرئيسية

#### 👤 Users
```sql
users: id, name, email, password, phone, address, role, fcm_token
```

#### 🛍️ Products
```sql
products: id, name, slug, description, details, base_price, 
         is_available, category_id, has_tax, tax_type, tax_value,
         enable_custom_color, enable_custom_size, 
         enable_color_selection, enable_size_selection
```

#### 🏷️ Categories
```sql
categories: id, name, slug, description, image
```

#### 🛒 Cart & Cart Items
```sql
carts: id, user_id
cart_items: id, cart_id, product_id, quantity, unit_price, 
           subtotal, color, size, custom_color, custom_size
```

#### 📦 Orders & Order Items
```sql
orders: id, uuid, order_number, user_id, total_amount, 
       original_amount, coupon_discount, quantity_discount,
       shipping_address, phone, payment_method, payment_status,
       order_status, notes, policy_agreement, amount_paid

order_items: id, order_id, product_id, quantity, unit_price,
            subtotal, color, size
```

#### 🎫 Coupons
```sql
coupons: id, code, type, value, minimum_order_amount, 
        usage_limit, used_count, starts_at, expires_at, is_active
```

---

## 🔄 Workflow تفصيلي

### 1. مسار العميل (Customer Journey)

#### أ) تصفح المنتجات
```
الصفحة الرئيسية → عرض المنتجات → تفاصيل المنتج
```

**المسارات**:
- `GET /` - الصفحة الرئيسية
- `GET /products` - عرض المنتجات
- `GET /products/{slug}` - تفاصيل المنتج
- `POST /products/filter` - فلترة المنتجات

**Controllers المسؤولة**:
- `HomeController@index`
- `ProductController@index, show, filter`

#### ب) إضافة للعربة
```
اختيار المنتج → تحديد المواصفات → إضافة للعربة
```

**العملية**:
1. العميل يختار المنتج والمواصفات (لون، مقاس، كمية)
2. النظام يتحقق من توفر المنتج
3. يضاف المنتج لعربة العميل في قاعدة البيانات

**المسارات**:
- `POST /cart/add` - إضافة للعربة
- `GET /cart` - عرض العربة
- `PATCH /cart/items/{item}` - تحديث الكمية
- `DELETE /cart/items/{item}` - حذف من العربة

#### ج) عملية الـ Checkout
```
مراجعة العربة → تطبيق كوبون → إدخال بيانات الشحن → تأكيد الطلب
```

**العملية التفصيلية**:

1. **مراجعة العربة** (`CheckoutController@index`)
   ```php
   // التحقق من وجود منتجات في العربة
   $cart = Cart::with(['items.product'])->where('user_id', Auth::id())->first();
   
   // حساب التخفيضات
   $discountResult = $this->calculateDiscounts($cart, $couponCode);
   ```

2. **تطبيق الكوبون** (`CheckoutController@applyCoupon`)
   ```php
   // التحقق من صحة الكوبون
   $coupon = Coupon::where('code', $request->coupon_code)
                  ->where('is_active', true)
                  ->first();
   
   // تطبيق التخفيض
   $discountAmount = $this->discountService->calculateCouponDiscount($coupon, $cartTotal);
   ```

3. **إنشاء الطلب** (`CheckoutController@store`)
   ```php
   DB::transaction(function () {
       // إنشاء الطلب
       $order = Order::create($orderData);
       
       // إنشاء عناصر الطلب
       foreach ($cart->items as $item) {
           $order->items()->create($orderItemData);
       }
       
       // تسجيل استخدام الكوبون
       $coupon->incrementUsage();
       
       // حذف العربة
       $cart->delete();
       
       // إرسال الإشعارات
       $order->user->notify(new OrderCreated($order));
   });
   ```

### 2. مسار الإدارة (Admin Journey)

#### أ) إدارة المنتجات
```
لوحة التحكم → المنتجات → إضافة/تعديل منتج
```

**العمليات الرئيسية**:

1. **إنشاء منتج جديد** (`Admin\ProductController@store`)
   ```php
   // Validation للبيانات الأساسية
   $rules = [
       'name' => 'required|string|max:255',
       'description' => 'required|string',
       'category_id' => 'required|exists:categories,id',
       'base_price' => 'nullable|numeric|min:0',
       'has_tax' => 'boolean',
       'tax_type' => 'nullable|in:percentage,fixed',
       'tax_value' => 'nullable|numeric|min:0',
   ];
   
   // معالجة الصور
   if ($request->hasFile('images')) {
       foreach ($request->file('images') as $image) {
           $path = $image->store('products', 'public');
           $product->images()->create(['image_path' => $path]);
       }
   }
   
   // معالجة الألوان والمقاسات
   if ($request->has('colors')) {
       foreach ($request->colors as $color) {
           $product->colors()->create(['color' => $color]);
       }
   }
   ```

2. **إدارة الضرائب** (ميزة جديدة)
   ```php
   // حساب الضريبة
   public function calculateTaxAmount($price) {
       if (!$this->has_tax || !$this->tax_value) return 0;
       
       if ($this->tax_type === 'percentage') {
           return ($price * $this->tax_value) / 100;
       }
       
       return $this->tax_value; // مبلغ ثابت
   }
   ```

#### ب) إدارة الطلبات
```
عرض الطلبات → تفاصيل الطلب → تحديث الحالة
```

**حالات الطلب**:
- `pending` - في الانتظار
- `processing` - قيد المعالجة  
- `out_for_delivery` - خارج للتوصيل
- `on_the_way` - في الطريق
- `delivered` - تم التوصيل
- `completed` - مكتمل
- `cancelled` - ملغي
- `returned` - مُرتجع

**حالات الدفع**:
- `pending` - في الانتظار
- `paid` - مدفوع
- `failed` - فشل

---

## 🔧 الخدمات (Services)

### 1. DiscountService
```php
class DiscountService {
    // حساب تخفيض الكوبون
    public function calculateCouponDiscount(Coupon $coupon, $amount);
    
    // حساب تخفيض الكمية
    public function calculateQuantityDiscount($product, $quantity);
    
    // تطبيق أفضل تخفيض متاح
    public function getBestDiscount($coupons, $quantityDiscounts, $amount);
}
```

### 2. FirebaseNotificationService
```php
class FirebaseNotificationService {
    // إرسال إشعار لمستخدم واحد
    public function sendToUser($userId, $title, $body, $data = []);
    
    // إرسال إشعار لمجموعة
    public function sendToTopic($topic, $title, $body, $data = []);
}
```

### 3. Customer Services
- `CartService`: إدارة عربة التسوق
- `OrderService`: إدارة عمليات الطلبات

---

## 📱 نظام الإشعارات

### Firebase Setup
```javascript
// public/admin/firebase-messaging-sw.js
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "...",
    authDomain: "...",
    projectId: "...",
    storageBucket: "...",
    messagingSenderId: "...",
    appId: "..."
});
```

### أنواع الإشعارات
1. **OrderCreated**: عند إنشاء طلب جديد
2. **OrderStatusUpdated**: عند تغيير حالة الطلب

---

## 🛡️ الأمان والحماية

### Middleware المستخدمة
1. **AdminPopupAuthMiddleware**: التحقق من هوية المدير
2. **Role Middleware**: التحقق من الأدوار
3. **Permission Middleware**: التحقق من الصلاحيات

### Validation Rules
```php
// مثال على validation المنتجات
$rules = [
    'name' => 'required|string|max:255',
    'description' => 'required|string',
    'category_id' => 'required|exists:categories,id',
    'base_price' => 'nullable|numeric|min:0',
    'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    'has_tax' => 'boolean',
    'tax_type' => 'nullable|in:percentage,fixed',
    'tax_value' => 'nullable|numeric|min:0|max:100',
];
```

---

## 📊 التقارير والإحصائيات

### Dashboard Statistics
```php
class AdminDashboardController {
    public function index() {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('order_status', 'pending')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'total_products' => Product::count(),
            'active_customers' => User::where('role', 'customer')->count(),
        ];
    }
}
```

---

## 🚀 عمليات النشر والصيانة

### البيئة المطلوبة
- PHP 8.2+
- MySQL 5.7+
- Composer
- Node.js & NPM

### خطوات التثبيت
```bash
# 1. استنساخ المشروع
git clone [repository-url]

# 2. تثبيت Dependencies
composer install
npm install

# 3. إعداد البيئة
cp .env.example .env
php artisan key:generate

# 4. إعداد قاعدة البيانات
php artisan migrate
php artisan db:seed

# 5. ربط Storage
php artisan storage:link

# 6. تشغيل التطبيق
php artisan serve
```

### أوامر مفيدة
```bash
# تنظيف Cache
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# إعادة تحسين التطبيق
php artisan optimize
php artisan view:cache

# تشغيل Migrations جديدة
php artisan migrate

# تشغيل Seeders
php artisan db:seed --class=RoleSeeder
```

---

## 🔍 نصائح للمطورين الجدد

### 1. فهم بنية Laravel
- تعلم MVC Pattern
- فهم Eloquent ORM
- إتقان Blade Templates
- فهم Middleware وال Routing

### 2. كود مهم للمراجعة
- `app/Models/Product.php` - نموذج المنتج مع حسابات الضريبة
- `app/Http/Controllers/CheckoutController.php` - عملية الشراء
- `app/Services/DiscountService.php` - منطق التخفيضات
- `routes/web.php` - جميع المسارات

### 3. نمط التطوير المُتبع
- استخدام Service Classes للمنطق المعقد
- Repository Pattern للعمليات المعقدة
- Form Request Classes للـ Validation
- Resource Classes لتنسيق API responses

### 4. اختبار الوظائف
```bash
# تشغيل الاختبارات
php artisan test

# اختبار وظائف محددة
php artisan test --filter=ProductTest
```

---

## 📞 نقاط الاتصال والدعم

### ملفات مهمة للمراجعة اليومية
1. `storage/logs/laravel.log` - سجل الأخطاء
2. `database/migrations/` - تغييرات قاعدة البيانات
3. `config/` - إعدادات التطبيق

### أخطاء شائعة وحلولها
1. **خطأ Storage Link**: `php artisan storage:link`
2. **خطأ Permissions**: تحقق من أذونات مجلدات `storage/` و `bootstrap/cache/`
3. **خطأ Database**: تحقق من إعدادات `.env`

---

## 🎯 المميزات الحديثة المضافة

### نظام الضرائب
- إمكانية تفعيل/إلغاء الضريبة لكل منتج
- دعم الضريبة النسبية والثابتة
- حساب تلقائي للضريبة مع الأسعار
- عرض واضح للضريبة في جميع الصفحات

### تحسينات UI/UX
- واجهة إدارية محسنة
- تأثيرات بصرية متقدمة
- دعم الهواتف المحمولة
- تجربة مستخدم سلسة

---

هذا الدليل يغطي الجوانب الرئيسية للمشروع. لأي استفسارات إضافية، راجع الكود المصدري أو اتصل بفريق التطوير.

**آخر تحديث**: أغسطس 2025
**إصدار Laravel**: 11.31
**حالة المشروع**: Production Ready ✅
