<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب جديد من الصفحة الرئيسية</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #26e07f 0%, #13c5c1 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
        }
        .form-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #495057;
            min-width: 120px;
        }
        .detail-value {
            color: #212529;
            text-align: left;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .highlight {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .category-badge {
            background: linear-gradient(135deg, #26e07f 0%, #13c5c1 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>طلب جديد من الصفحة الرئيسية</h1>
            <p>تم استلام طلب جديد من موقع مصنع جينودينت</p>
        </div>

        <div class="content">
            <div class="highlight">
                <strong>معلومات الطلب:</strong>
                <p>يرجى التواصل مع العميل في أقرب وقت ممكن لتلبية طلبه.</p>
            </div>

            <div class="form-details">
                <div class="detail-row">
                    <span class="detail-label">اسم الشركة/العيادة:</span>
                    <span class="detail-value">{{ $companyName }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">البريد الإلكتروني:</span>
                    <span class="detail-value">{{ $email }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">رقم الهاتف:</span>
                    <span class="detail-value">{{ $phone }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">فئة المنتج:</span>
                    <span class="detail-value">
                        <span class="category-badge">
                            @switch($productCategory)
                                @case('implants')
                                    منتجات زراعة الأسنان
                                    @break
                                @case('cosmetic')
                                    منتجات تجميلية
                                    @break
                                @case('tools')
                                    أدوات طب الأسنان
                                    @break
                                @case('all')
                                    جميع المنتجات
                                    @break
                                @default
                                    {{ $productCategory }}
                            @endswitch
                        </span>
                    </span>
                </div>

                @if($notes)
                <div class="detail-row">
                    <span class="detail-label">ملاحظات إضافية:</span>
                    <span class="detail-value">{{ $notes }}</span>
                </div>
                @endif
            </div>


        </div>

        <div class="footer">
            <p>هذا الطلب تم إرساله من الصفحة الرئيسية لموقع مصنع جينودينت</p>
            <p>تاريخ الطلب: {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
