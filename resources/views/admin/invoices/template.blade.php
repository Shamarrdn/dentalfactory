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
            font-family: 'Noto Sans Arabic', 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: #ffffff;
            font-size: 14px;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
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
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
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
            font-size: 32px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
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
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-right: 4px solid #667eea;
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
            margin-bottom: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .products-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 12px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
        }
        
        .products-table td {
            padding: 15px 12px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }
        
        .products-table tbody tr:hover {
            background: #f8f9fa;
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
            width: 350px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #e9ecef;
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
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .footer-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
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
            gap: 8px;
            font-size: 14px;
            color: #666;
        }
        
        .footer-note {
            font-size: 12px;
            color: #999;
            font-style: italic;
            margin-top: 20px;
        }
        
        /* Print Controls Styles */
        .print-controls {
            animation: fadeInDown 0.5s ease-out;
        }
        
        .print-controls .btn-group {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .print-controls .btn {
            border: none;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .print-controls .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .print-controls .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .print-controls .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
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

        /* Print Styles */
        @media print {
            .no-print,
            .print-controls {
                display: none !important;
            }
            
            body {
                font-size: 12px;
            }
            
            .invoice-container {
                padding: 0;
                box-shadow: none;
                margin: 0;
            }
            
            .invoice-header {
                page-break-inside: avoid;
            }
            
            .products-table {
                page-break-inside: avoid;
            }
            
            .totals-section {
                page-break-inside: avoid;
            }
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d4edda; color: #155724; }
        .status-processing { background: #cce5ff; color: #004085; }
        .status-shipped { background: #e2e3e5; color: #383d41; }
        .status-delivered { background: #d1ecf1; color: #0c5460; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
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
                <div class="company-logo">🦷</div>
                <div class="company-name">مصنع منتجات الأسنان</div>
                <div class="company-tagline">جودة عالية - أسعار مناسبة</div>
                <div class="company-contact">
                    العنوان: المملكة العربية السعودية<br>
                    الهاتف: +966 50 123 4567<br>
                    البريد الإلكتروني: info@dentalfactory.com
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
            <div class="footer-note">
                شكراً لاختيارك مصنع منتجات الأسنان - جودة عالية وأسعار مناسبة
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
