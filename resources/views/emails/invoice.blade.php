<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة الطلب</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .order-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-right: 4px solid #667eea;
        }
        .order-info h3 {
            margin: 0 0 15px;
            color: #2c3e50;
            font-size: 16px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 5px 0;
        }
        .info-label {
            font-weight: 600;
            color: #666;
        }
        .info-value {
            color: #2c3e50;
            font-weight: 500;
        }
        .total-amount {
            background: linear-gradient(135deg, #e6fffa 0%, #f0fff4 100%);
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            border: 1px solid #c6f6d5;
        }
        .total-amount .label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        .total-amount .amount {
            font-size: 24px;
            font-weight: 700;
            color: #22543d;
        }
        .attachment-note {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }
        .attachment-note i {
            color: #856404;
            margin-left: 5px;
        }
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 25px;
        }
        .footer h4 {
            margin: 0 0 15px;
            font-size: 18px;
        }
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }
            .content {
                padding: 20px;
            }
            .contact-info {
                flex-direction: column;
                gap: 10px;
            }
            .info-row {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🦷 مصنع منتجات الأسنان</h1>
            <p>فاتورة الطلب الخاص بك</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                مرحباً {{ $customerName }},
            </div>
            
            <p>
                نشكرك على ثقتك بنا. نرسل إليك فاتورة طلبك المرفقة بهذا الإيميل.
            </p>

            <!-- Order Information -->
            <div class="order-info">
                <h3>📋 تفاصيل الطلب</h3>
                <div class="info-row">
                    <span class="info-label">رقم الطلب:</span>
                    <span class="info-value">#{{ $orderNumber }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">تاريخ الطلب:</span>
                    <span class="info-value">{{ $orderDate }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">حالة الطلب:</span>
                    <span class="info-value">
                        @switch($order->status)
                            @case('pending')
                                قيد الانتظار
                                @break
                            @case('confirmed')
                                مؤكد
                                @break
                            @case('processing')
                                قيد التجهيز
                                @break
                            @case('shipped')
                                تم الشحن
                                @break
                            @case('delivered')
                                تم التسليم
                                @break
                            @case('cancelled')
                                ملغي
                                @break
                            @default
                                {{ $order->status }}
                        @endswitch
                    </span>
                </div>
            </div>

            <!-- Total Amount -->
            <div class="total-amount">
                <div class="label">إجمالي المبلغ</div>
                <div class="amount">{{ $totalAmount }} ر.س</div>
            </div>

            <!-- Attachment Note -->
            <div class="attachment-note">
                📎 ستجد الفاتورة التفصيلية مرفقة مع هذا الإيميل بصيغة PDF
            </div>

            <p>
                إذا كان لديك أي استفسار حول طلبك، لا تتردد في التواصل معنا.
            </p>

            <p style="margin-top: 30px; color: #666; font-style: italic;">
                شكراً لاختيارك مصنع منتجات الأسنان
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <h4>تواصل معنا</h4>
            <div class="contact-info">
                <div class="contact-item">
                    📧 info@dentalfactory.com
                </div>
                <div class="contact-item">
                    📱 +966 50 123 4567
                </div>
                <div class="contact-item">
                    🌐 www.dentalfactory.com
                </div>
            </div>
        </div>
    </div>
</body>
</html>
