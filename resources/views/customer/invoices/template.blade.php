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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans Arabic', 'Tajawal', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
            direction: rtl;
        }

        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            padding: 40px;
        }

        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 3px solid #e2e8f0;
        }

        .company-info {
            flex: 1;
        }

        .company-logo {
            font-size: 48px;
            margin-bottom: 10px;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.2));
        }

        .company-name {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .company-tagline {
            font-size: 14px;
            color: #718096;
            margin-bottom: 15px;
        }

        .company-contact {
            font-size: 12px;
            color: #4a5568;
            line-height: 1.4;
        }

        .invoice-info {
            text-align: left;
            direction: ltr;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 15px;
        }

        .invoice-details {
            background: #f7fafc;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
        }

        .invoice-details p {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .invoice-number {
            font-weight: 600;
            color: #3182ce;
        }

        /* Customer Info */
        .customer-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
            padding: 10px 0;
            border-bottom: 2px solid #e2e8f0;
        }

        .customer-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            background: #f7fafc;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .info-group h4 {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 15px;
        }

        .info-item {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
        }

        .info-label {
            font-weight: 600;
            color: #4a5568;
            margin-left: 10px;
            min-width: 80px;
        }

        .info-value {
            color: #2d3748;
            word-break: break-word;
        }

        /* Products Table */
        .products-section {
            margin-bottom: 40px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .products-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .products-table th {
            padding: 15px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
        }

        .products-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .products-table tbody tr:hover {
            background: #f7fafc;
        }

        .product-name {
            font-weight: 600;
            color: #2d3748;
            text-align: right;
        }

        .product-options {
            font-size: 12px;
            color: #718096;
            margin-top: 5px;
        }

        /* Totals Section - محمي من hover وثابت بصرياً */
        .totals-section {
            margin-bottom: 40px !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .totals-container {
            max-width: 400px !important;
            margin-right: auto !important;
            background: linear-gradient(135deg, #009245 0%, #4F4F4F 100%) !important;
            padding: 25px !important;
            border-radius: 10px !important;
            border: 2px solid #009245 !important;
            box-shadow: 0 8px 25px rgba(0, 146, 69, 0.3) !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
            transition: none !important;
        }

        .totals-container:hover,
        .totals-container:focus,
        .totals-container:active {
            background: linear-gradient(135deg, #009245 0%, #4F4F4F 100%) !important;
            border: 2px solid #009245 !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .total-row {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            margin-bottom: 15px !important;
            font-size: 16px !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
            transition: none !important;
            background: transparent !important;
        }

        .total-row:hover,
        .total-row:focus,
        .total-row:active {
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
            background: transparent !important;
        }

        .total-row:last-child {
            margin-bottom: 0 !important;
            padding-top: 15px !important;
            border-top: 2px solid rgba(255,255,255,0.3) !important;
            font-weight: 700 !important;
            font-size: 18px !important;
            color: white !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .total-row:last-child:hover,
        .total-row:last-child:focus,
        .total-row:last-child:active {
            color: white !important;
            border-top: 2px solid rgba(255,255,255,0.3) !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .total-label {
            color: rgba(255,255,255,0.9) !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .total-label:hover,
        .total-label:focus,
        .total-label:active {
            color: rgba(255,255,255,0.9) !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .total-value {
            font-weight: 600 !important;
            color: white !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .total-value:hover,
        .total-value:focus,
        .total-value:active {
            color: white !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .discount-value {
            color: #90EE90 !important;
            font-weight: 600 !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .discount-value:hover,
        .discount-value:focus,
        .discount-value:active {
            color: #90EE90 !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .tax-value {
            color: #FFD700 !important;
            font-weight: 600 !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .tax-value:hover,
        .tax-value:focus,
        .tax-value:active {
            color: #FFD700 !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        /* حماية شاملة لقسم ملخص التكاليف */
        .totals-section *,
        .totals-section *:hover,
        .totals-section *:focus,
        .totals-section *:active,
        .totals-container *,
        .totals-container *:hover,
        .totals-container *:focus,
        .totals-container *:active {
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
            transition: none !important;
            filter: none !important;
        }

        /* Footer */
        .invoice-footer {
            text-align: center;
            padding-top: 30px;
            border-top: 2px solid #e2e8f0;
            color: #718096;
            font-size: 12px;
        }

        .footer-note {
            color: #999;
            font-style: italic;
            margin-top: 20px;
        }
        
        /* Print Controls Styles */
        .print-controls {
            animation: fadeInDown 0.5s ease-out;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .print-controls .btn-group {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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
                background: white;
            }
            
            .invoice-container {
                padding: 0;
                box-shadow: none;
                margin: 0;
                border-radius: 0;
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
            font-weight: 600;
            text-align: center;
        }
        
        .status-pending { background: #fef2e0; color: #d69e2e; }
        .status-processing { background: #e6fffa; color: #38b2ac; }
        .status-completed { background: #f0fff4; color: #38a169; }
        .status-delivered { background: #d1ecf1; color: #0c5460; }
        .status-cancelled { background: #f8d7da; color: #721c24; }

        /* Responsive Design */
        @media (max-width: 768px) {
            .invoice-container {
                margin: 10px;
                padding: 20px;
            }
            
            .invoice-header {
                flex-direction: column;
                gap: 20px;
            }
            
            .invoice-info {
                text-align: right;
                direction: rtl;
            }
            
            .customer-info {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .products-table {
                font-size: 12px;
            }
            
            .products-table th,
            .products-table td {
                padding: 8px;
            }
            
            .print-controls {
                position: relative;
                top: auto;
                right: auto;
                margin-bottom: 20px;
                display: flex;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Print Controls (Hidden during print) -->
    <div class="print-controls no-print">
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
                <div class="company-logo">{!! $storeInfo['logo'] !!}</div>
                <div class="company-name">{{ $storeInfo['name'] }}</div>
                <div class="company-tagline">جودة عالية - أسعار مناسبة</div>
                <div class="company-contact">
                    <div>📍 {{ $storeInfo['address'] }}</div>
                    <div>📞 هاتف: {{ $storeInfo['phone'] }}</div>
                    <div>📱 واتساب: {{ $storeInfo['whatsapp'] }}</div>
                    <div>✉️ إيميل 1: {{ $storeInfo['email'] }}</div>
                    <div>✉️ إيميل 2: {{ $storeInfo['email2'] }}</div>
                    <div>🌐 موقع: {{ $storeInfo['website'] }}</div>
                </div>
            </div>
            <div class="invoice-info">
                <h2 class="invoice-title">فاتورة</h2>
                <div class="invoice-details">
                    <p><strong>رقم الطلب:</strong> <span class="invoice-number">#{{ $order->order_number }}</span></p>
                    <p><strong>تاريخ الطلب:</strong> {{ $order->created_at->format('Y/m/d') }}</p>
                    <p><strong>حالة الطلب:</strong> 
                        <span class="status-badge status-{{ $order->order_status }}">
                            {{ match($order->order_status) {
                                'completed' => 'مكتمل',
                                'cancelled' => 'ملغي',
                                'processing' => 'قيد المعالجة',
                                'pending' => 'قيد الانتظار',
                                'out_for_delivery' => 'جاري التوصيل',
                                'on_the_way' => 'في الطريق',
                                'delivered' => 'تم التوصيل',
                                'returned' => 'مرتجع',
                                default => 'غير معروف'
                            } }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="customer-section">
            <h3 class="section-title">معلومات العميل</h3>
            <div class="customer-info">
                <div class="info-group">
                    <h4>معلومات شخصية</h4>
                    <div class="info-item">
                        <span class="info-label">الاسم:</span>
                        <span class="info-value">{{ $customer->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">الإيميل:</span>
                        <span class="info-value">{{ $customer->email }}</span>
                    </div>
                </div>
                <div class="info-group">
                    <h4>معلومات التوصيل</h4>
                    <div class="info-item">
                        <span class="info-label">العنوان:</span>
                        <span class="info-value">{{ $order->shipping_address }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">الهاتف:</span>
                        <span class="info-value">{{ $order->phone }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="products-section">
            <h3 class="section-title">تفاصيل المنتجات</h3>
            <table class="products-table">
                <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td class="product-name">
                            {{ $item->product->name }}
                            @if($item->color || $item->size)
                            <div class="product-options">
                                @if($item->color)
                                    اللون: {{ $item->color }}
                                @endif
                                @if($item->size)
                                    @if($item->color) | @endif
                                    المقاس: {{ $item->size }}
                                @endif
                            </div>
                            @endif
                            @if($item->product->hasTax())
                            <div class="product-options">
                                <small class="text-muted">شامل ضريبة {{ $item->product->tax_rate }}%</small>
                            </div>
                            @endif
                        </td>
                        <td>{{ number_format($item->unit_price, 2) }} ريال</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->subtotal, 2) }} ريال</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="totals-section">
            <h3 class="section-title">ملخص الفاتورة</h3>
            <div class="totals-container">
                <div class="total-row">
                    <span class="total-label">المجموع الفرعي:</span>
                    <span class="total-value">{{ number_format($subtotal, 2) }} ريال</span>
                </div>
                
                @if($order->quantity_discount > 0)
                <div class="total-row">
                    <span class="total-label">خصم الكمية:</span>
                    <span class="discount-value">- {{ number_format($order->quantity_discount, 2) }} ريال</span>
                </div>
                @endif
                
                @if($order->coupon_discount > 0)
                <div class="total-row">
                    <span class="total-label">خصم الكوبون 
                        @if($order->coupon_code)
                            ({{ $order->coupon_code }})
                        @endif:
                    </span>
                    <span class="discount-value">- {{ number_format($order->coupon_discount, 2) }} ريال</span>
                </div>
                @endif
                
                @if($totalTax > 0)
                <div class="total-row">
                    <span class="total-label">ضريبة القيمة المضافة:</span>
                    <span class="tax-value">{{ number_format($totalTax, 2) }} ريال</span>
                </div>
                @endif
                
                <div class="total-row">
                    <span class="total-label">الإجمالي النهائي:</span>
                    <span class="total-value">{{ number_format($finalTotal, 2) }} ريال</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div class="company-contact">
                <p><strong>{{ $storeInfo['name'] }}</strong></p>
                <div class="d-flex justify-content-center gap-4 mt-2">
                    <span>📞 {{ $storeInfo['phone'] }}</span>
                    <span>📱 {{ $storeInfo['whatsapp'] }}</span>
                    <span>✉️ {{ $storeInfo['email'] }}</span>
                    <span>🌐 {{ $storeInfo['website'] }}</span>
                </div>
                <div class="d-flex justify-content-center gap-4 mt-1">
                    <span>✉️ {{ $storeInfo['email2'] }}</span>
                </div>
            </div>
            <div class="footer-note">
                شكراً لاختيارك {{ $storeInfo['name'] }} - جودة عالية وأسعار مناسبة
            </div>
        </div>
    </div>

    <!-- JavaScript for Print functionality -->
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
        
        // حماية إضافية لقسم ملخص التكاليف من الاختفاء
        function protectTotalsSection() {
            const totalsSection = document.querySelector('.totals-section');
            const totalsContainer = document.querySelector('.totals-container');
            const totalRows = document.querySelectorAll('.total-row');
            
            function forceVisibility(element) {
                if (element) {
                    element.style.setProperty('opacity', '1', 'important');
                    element.style.setProperty('visibility', 'visible', 'important');
                    element.style.setProperty('transform', 'none', 'important');
                    element.style.setProperty('transition', 'none', 'important');
                    element.style.setProperty('filter', 'none', 'important');
                }
            }
            
            // حماية العناصر الرئيسية
            [totalsSection, totalsContainer, ...totalRows].forEach(element => {
                if (element) {
                    forceVisibility(element);
                    
                    // مراقبة جميع الأحداث
                    ['mouseenter', 'mouseleave', 'mouseover', 'mouseout', 'focus', 'blur', 'click'].forEach(event => {
                        element.addEventListener(event, () => forceVisibility(element), true);
                    });
                    
                    // حماية العناصر الفرعية
                    const children = element.querySelectorAll('*');
                    children.forEach(child => {
                        forceVisibility(child);
                        ['mouseenter', 'mouseleave', 'mouseover', 'mouseout'].forEach(event => {
                            child.addEventListener(event, () => {
                                forceVisibility(child);
                                forceVisibility(element);
                            }, true);
                        });
                    });
                }
            });
        }
        
        // تشغيل الحماية
        protectTotalsSection();
        
        // إعادة تشغيل الحماية بشكل دوري
        setInterval(protectTotalsSection, 1000);
        
        console.log('Customer invoice viewer loaded successfully');
        console.log('Keyboard shortcuts: Ctrl+P (Print), Esc (Close)');
    </script>
</body>
</html>
