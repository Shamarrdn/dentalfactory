<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>فاتورة الطلب #{{ $order->order_number }}</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap (for button styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Noto Sans Arabic', 'Tajawal', 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-size: 14px;
            min-height: 100vh;
        }
        
        .invoice-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.8s ease-out;
            transform-origin: center bottom;
        }
        
        .invoice-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }
        
        .company-info {
            flex: 1;
        }
        
        .company-logo {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            transform: perspective(1000px) rotateY(-5deg);
        }
        
        .company-name {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .company-tagline {
            color: #667eea;
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .company-contact {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }
        
        .invoice-meta {
            text-align: left;
            flex-shrink: 0;
        }
        
        .invoice-title {
            font-size: 42px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .invoice-number {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .invoice-date {
            color: #666;
            font-size: 14px;
        }
        
        /* Customer & Order Info */
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            gap: 40px;
        }
        
        .customer-info, .order-info {
            flex: 1;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            border-radius: 15px;
            border-right: 4px solid #667eea;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .customer-info:hover, .order-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .info-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 3px 0;
        }
        
        .info-label {
            font-weight: 500;
            color: #666;
        }
        
        .info-value {
            font-weight: 600;
            color: #2c3e50;
        }
        
        /* Products Table */
        .products-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }
        
        .products-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 18px 15px;
            text-align: center;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .products-table td {
            padding: 15px 12px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }
        
        .products-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .products-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .product-name {
            font-weight: 500;
            color: #2c3e50;
        }
        
        .product-category {
            font-size: 12px;
            color: #666;
            font-style: italic;
        }
        
        /* Totals Section */
        .totals-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
        }
        
        .totals-table {
            width: 400px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .total-row:last-child {
            border-bottom: none;
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #667eea;
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .total-label {
            font-weight: 500;
            color: #666;
        }
        
        .total-value {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .discount-value {
            color: #28a745;
        }
        
        /* Footer */
        .invoice-footer {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid #e9ecef;
            text-align: center;
        }
        
        .footer-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 20px;
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .footer-title {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin-bottom: 20px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .contact-grid {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: white;
            font-weight: 500;
            opacity: 0.95;
        }
        
        .footer-note {
            font-size: 14px;
            color: #666;
            font-style: italic;
            margin-top: 25px;
            padding: 15px;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 10px;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }
        
        /* Print Controls Styles */
        .print-controls {
            animation: fadeInDown 0.8s ease-out;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .print-controls .btn-group {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .print-controls .btn {
            border: none;
            padding: 15px 25px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.5px;
        }
        
        .print-controls .btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .print-controls .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: 2px solid transparent;
        }
        
        .print-controls .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
        
        .print-controls .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            border: 2px solid transparent;
        }
        
        .print-controls .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #495057 100%);
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Print Styles */
        @media print {
            .no-print,
            .print-controls {
                display: none !important;
            }
            
            body {
                font-size: 12px;
                background: white !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            .invoice-container {
                padding: 20px;
                box-shadow: none;
                margin: 0;
                border-radius: 0;
                animation: none;
                max-width: 100%;
            }
            
            .invoice-container::before {
                display: block;
            }
            
            .invoice-header {
                page-break-inside: avoid;
                margin-bottom: 30px;
            }
            
            .company-logo {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            .products-table {
                page-break-inside: avoid;
                font-size: 11px;
            }
            
            .products-table th {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            .totals-section {
                page-break-inside: avoid;
            }
            
            .footer-content {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            .status-badge {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 2px solid transparent;
        }
        
        .status-pending { 
            background: linear-gradient(135deg, #ffeaa7, #fdcb6e); 
            color: #6c5ce7; 
            border-color: rgba(108, 92, 231, 0.2);
        }
        .status-confirmed { 
            background: linear-gradient(135deg, #a8e6cf, #7fdbda); 
            color: #00b894; 
            border-color: rgba(0, 184, 148, 0.2);
        }
        .status-processing { 
            background: linear-gradient(135deg, #74b9ff, #0984e3); 
            color: white; 
            border-color: rgba(9, 132, 227, 0.2);
        }
        .status-shipped { 
            background: linear-gradient(135deg, #ddd6fe, #c4b5fd); 
            color: #6d28d9; 
            border-color: rgba(109, 40, 217, 0.2);
        }
        .status-delivered { 
            background: linear-gradient(135deg, #10ac84, #00d2d3); 
            color: white; 
            border-color: rgba(16, 172, 132, 0.2);
        }
        .status-cancelled { 
            background: linear-gradient(135deg, #ff6b6b, #ee5a52); 
            color: white; 
            border-color: rgba(255, 107, 107, 0.2);
        }
    </style>
</head>
<body>
    <!-- Print Controls (Hidden during print) -->
    <div class="print-controls no-print" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
        <div class="btn-group shadow-lg" role="group">
            <button type="button" class="btn btn-primary" onclick="printInvoice()" title="طباعة الفاتورة">
                <i class="fas fa-print me-2"></i>
                طباعة
            </button>
            <button type="button" class="btn btn-secondary" onclick="window.close()" title="إغلاق النافذة">
                <i class="fas fa-times me-2"></i>
                إغلاق
            </button>
        </div>
    </div>

    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <div class="company-logo">
                    <img src="{{ url('logo.png') }}" alt="Genodent" style="height: 60px; width: auto;">
                </div>
                <div class="company-name">Genodent</div>
                <div class="company-tagline">جودة عالية - أسعار مناسبة</div>
                <div class="company-contact">
                    📍 المملكة العربية السعودية<br>
                    📞 هاتف: +966 54 411 7002<br>
                    📱 واتساب: +966 54 411 7002<br>
                    ✉️ إيميل 1: Genodent.1@gmail.com<br>
                    ✉️ إيميل 2: Genodent.2@gmail.com<br>
                    🌐 موقع: www.genodent.com
                </div>
            </div>
            <div class="invoice-meta">
                <div class="invoice-title">فـاتـورة</div>
                <div class="invoice-number">#{{ $order->order_number }}</div>
                <div class="invoice-date">{{ $order->created_at->format('Y/m/d') }}</div>
            </div>
        </div>

        <!-- Customer & Order Information -->
        <div class="info-section">
            <div class="customer-info">
                <div class="info-title">👤 بيانات العميل</div>
                @if($order->user)
                    <div class="info-row">
                        <span class="info-label">الاسم:</span>
                        <span class="info-value">{{ $order->user->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">البريد الإلكتروني:</span>
                        <span class="info-value">{{ $order->user->email }}</span>
                    </div>
                @endif
                @if($order->phoneNumber)
                    <div class="info-row">
                        <span class="info-label">رقم الهاتف:</span>
                        <span class="info-value">{{ $order->phoneNumber->number }}</span>
                    </div>
                @endif
                @if($order->address)
                    <div class="info-row">
                        <span class="info-label">العنوان:</span>
                        <span class="info-value">{{ $order->address->full_address }}</span>
                    </div>
                @endif
            </div>

            <div class="order-info">
                <div class="info-title">📦 معلومات الطلب</div>
                <div class="info-row">
                    <span class="info-label">رقم الطلب:</span>
                    <span class="info-value">#{{ $order->order_number }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">تاريخ الطلب:</span>
                    <span class="info-value">{{ $order->created_at->format('Y/m/d H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">حالة الطلب:</span>
                    <span class="info-value">
                        <span class="status-badge status-{{ $order->status }}">
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
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">طريقة الدفع:</span>
                    <span class="info-value">
                        @switch($order->payment_method)
                            @case('cash')
                                نقداً عند الاستلام
                                @break
                            @case('bank_transfer')
                                تحويل بنكي
                                @break
                            @case('credit_card')
                                بطاقة ائتمان
                                @break
                            @default
                                {{ $order->payment_method }}
                        @endswitch
                    </span>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="products-section">
            <div class="section-title">🛒 تفاصيل المنتجات</div>
            <table class="products-table">
                <thead>
                    <tr>
                        <th style="width: 40%">المنتج</th>
                        <th style="width: 15%">السعر</th>
                        <th style="width: 15%">الكمية</th>
                        <th style="width: 15%">الخصم</th>
                        <th style="width: 15%">الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td style="text-align: right;">
                                <div class="product-name">{{ $item->product->name }}</div>
                                @if($item->product->category)
                                    <div class="product-category">{{ $item->product->category->name }}</div>
                                @endif
                                @if($item->selected_color)
                                    <div class="product-category">اللون: {{ $item->selected_color }}</div>
                                @endif
                                @if($item->selected_size)
                                    <div class="product-category">المقاس: {{ $item->selected_size }}</div>
                                @endif
                            </td>
                            <td>{{ number_format($item->price, 2) }} ر.س</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                @if($item->discount_amount > 0)
                                    <span class="discount-value">-{{ number_format($item->discount_amount, 2) }} ر.س</span>
                                @else
                                    --
                                @endif
                            </td>
                            <td><strong>{{ number_format($item->total_price, 2) }} ر.س</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="totals-section">
            <div class="totals-table">
                <div class="total-row">
                    <span class="total-label">المجموع الفرعي:</span>
                    <span class="total-value">{{ number_format($order->original_amount, 2) }} ر.س</span>
                </div>
                
                @if($order->quantity_discount > 0)
                    <div class="total-row">
                        <span class="total-label">خصم الكمية:</span>
                        <span class="total-value discount-value">-{{ number_format($order->quantity_discount, 2) }} ر.س</span>
                    </div>
                @endif
                
                @if($order->coupon_discount > 0)
                    <div class="total-row">
                        <span class="total-label">خصم الكوبون:</span>
                        <span class="total-value discount-value">-{{ number_format($order->coupon_discount, 2) }} ر.س</span>
                    </div>
                @endif
                
                @if($order->tax_amount > 0)
                    <div class="total-row">
                        <span class="total-label">ضريبة القيمة المضافة:</span>
                        <span class="total-value">+{{ number_format($order->tax_amount, 2) }} ر.س</span>
                    </div>
                @endif
                
                @if($order->shipping_cost > 0)
                    <div class="total-row">
                        <span class="total-label">رسوم الشحن:</span>
                        <span class="total-value">+{{ number_format($order->shipping_cost, 2) }} ر.س</span>
                    </div>
                @endif
                
                <div class="total-row">
                    <span class="total-label">المجموع النهائي:</span>
                    <span class="total-value">{{ number_format($order->total_amount, 2) }} ر.س</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div class="footer-content">
                <div class="footer-title">معلومات التواصل</div>
                <div class="contact-grid">
                    <div class="contact-item">
                        📧 Genodent.1@gmail.com
                    </div>
                    <div class="contact-item">
                        📱 +966 54 411 7002
                    </div>
                    <div class="contact-item">
                        🌐 www.genodent.com
                    </div>
                </div>
            </div>
            <div class="footer-note">
                شكراً لاختيارك مصنع جينودينت - الشريك الرائد في مواد طب الأسنان
            </div>
        </div>
    </div>

    <!-- JavaScript for PDF Download and Print functionality -->
    <script>
        // Print function with preview
        function printInvoice() {
            // Add print-specific styles
            const printStyles = `
                <style>
                    @media print {
                        body { font-size: 11px; margin: 0; }
                        .invoice-container { padding: 10px; }
                        .company-logo { print-color-adjust: exact; }
                    }
                </style>
            `;
            
            document.head.insertAdjacentHTML('beforeend', printStyles);
            
            // Show print dialog
            window.print();
        }
        
        // Notification function
        function showNotification(message, type = 'success') {
            // Remove existing notifications
            const existing = document.querySelectorAll('.notification-toast');
            existing.forEach(n => n.remove());
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = `notification-toast alert alert-${type === 'success' ? 'success' : 'danger'}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 9999;
                padding: 12px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                font-weight: 600;
                animation: slideDown 0.3s ease-out;
            `;
            
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                ${message}
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideUp 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
        
        // Add CSS animations
        const animationStyles = `
            <style>
                @keyframes slideDown {
                    from { opacity: 0; transform: translateX(-50%) translateY(-20px); }
                    to { opacity: 1; transform: translateX(-50%) translateY(0); }
                }
                @keyframes slideUp {
                    from { opacity: 1; transform: translateX(-50%) translateY(0); }
                    to { opacity: 0; transform: translateX(-50%) translateY(-20px); }
                }
                .notification-toast {
                    color: white;
                }
                .alert-success {
                    background: linear-gradient(135deg, #28a745, #20c997);
                    border: none;
                }
                .alert-danger {
                    background: linear-gradient(135deg, #dc3545, #c82333);
                    border: none;
                }
            </style>
        `;
        document.head.insertAdjacentHTML('beforeend', animationStyles);
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+P for print
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                printInvoice();
            }
            
            // Escape to close
            if (e.key === 'Escape') {
                window.close();
            }
        });
        
        // Add tooltips on hover
        document.querySelectorAll('.print-controls .btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.02)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
        
        console.log('Invoice viewer loaded successfully');
        console.log('Keyboard shortcuts: Ctrl+P (Print), Esc (Close)');
    </script>
</body>
</html>
