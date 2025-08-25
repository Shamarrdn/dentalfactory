@extends('layouts.customer')

@section('title', 'تفاصيل الطلب #' . $order->order_number)

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="/assets/css/customer/orders.css">
<link rel="stylesheet" href="/assets/css/customer/invoice-buttons.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<header class="header-container">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="page-title">تفاصيل الطلب #{{ $order->order_number }}</h2>
            <div class="header-actions">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للطلبات
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Invoice and Order Number Section -->
<div class="invoice-section py-2" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-bottom: 1px solid #dee2e6;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Order Number on the Left -->
            <div class="order-number-display">
                <h4 class="mb-0" style="color: #007bff; font-weight: 600; font-size: 18px;">
                    <i class="bi bi-hash me-2"></i>
                    رقم الطلب: {{ $order->order_number }}
                </h4>
            </div>
            
            <!-- Invoice Dropdown on the Right -->
            <div class="custom-dropdown invoice-dropdown" style="position: relative; display: inline-block;">
                <button type="button" class="btn btn-outline-primary custom-dropdown-toggle" id="invoiceDropdownDetail" onclick="toggleCustomDropdown(this)" style="background: transparent; border: 2px solid #007bff; color: #007bff; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 16px;">
                    <i class="bi bi-receipt me-2"></i>
                    الفاتورة
                    <i class="bi bi-chevron-down ms-2"></i>
                </button>
                <div class="custom-dropdown-menu" id="customDropdownMenu" style="display: none; position: absolute; top: 100%; right: 0; min-width: 220px; background: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); z-index: 9999;">
                    <a class="custom-dropdown-item" href="{{ route('customer.orders.invoice.view', $order->uuid) }}" target="_blank">
                        <i class="bi bi-eye text-info me-2"></i>
                        عرض الفاتورة
                    </a>
                    <button type="button" class="custom-dropdown-item" onclick="printOrderInvoice('{{ $order->uuid }}')">
                        <i class="bi bi-printer text-primary me-2"></i>
                        طباعة الفاتورة
                    </button>
                    <hr class="custom-dropdown-divider">
                    <button type="button" class="custom-dropdown-item" onclick="requestInvoiceByEmail('{{ $order->uuid }}')">
                        <i class="bi bi-envelope text-success me-2"></i>
                        إرسال لإيميلي
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="container py-3">
    <div class="order-card">
        <div class="order-header">
            <div class="status-section">
                <h3 class="section-title">حالة الطلب</h3>
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
            </div>
            <div class="order-info mt-3">
                <p class="order-date">تاريخ الطلب: {{ $order->created_at->format('Y/m/d') }}</p>
            </div>
            @if($order->notes)
            <div class="order-notes mt-3">
                <h4>ملاحظات:</h4>
                <p>{{ $order->notes }}</p>
            </div>
            @endif
        </div>

        <div class="order-details">
            <div class="row">
                <!-- معلومات الشحن -->
                <div class="col-md-6">
                    <div class="info-group">
                        <h3 class="section-title">معلومات الشحن</h3>
                        <div class="shipping-info">
                            <div class="info-item">
                                <span class="info-label">العنوان:</span>
                                <span class="info-value">{{ $order->shipping_address }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">رقم الهاتف:</span>
                                <span class="info-value">{{ $order->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ملخص الطلب -->
                <div class="col-md-6">
                    <div class="info-group">
                        <h3 class="section-title">ملخص الطلب</h3>
                        <div class="order-items">
                            @foreach($order->items as $item)
                            <div class="order-item">
                                @if($item->product->images->first())
                                <img src="{{ url('storage/' . $item->product->images->first()->image_path) }}"
                                    alt="{{ $item->product->name }}"
                                    class="item-image">
                                @endif
                                <div class="item-details">
                                    <h4 class="item-name">{{ $item->product->name }}</h4>
                                    <p class="item-price">
                                        {{ $item->unit_price }} ريال × {{ $item->quantity }}
                                        @if($item->product->hasTax())
                                          <small class="text-muted">(شامل الضريبة)</small>
                                        @endif
                                    </p>
                                    @if($item->color || $item->size)
                                    <p class="item-options">
                                        @if($item->color)
                                        <span class="item-color">اللون: {{ $item->color }}</span>
                                        @endif
                                        @if($item->size)
                                        <span class="item-size">المقاس: {{ $item->size }}</span>
                                        @endif
                                    </p>
                                    @endif
                                    <p class="item-subtotal">
                                        الإجمالي: {{ $item->subtotal }} ريال
                                        @if($item->product->hasTax())
                                          <small class="text-muted">(شامل الضريبة)</small>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="order-summary mt-4">
                            <h5 class="mb-3 fw-bold">ملخص الطلب</h5>
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="summary-items">
                                        <div class="summary-item d-flex justify-content-between mb-3">
                                            <span>السعر الأصلي:</span>
                                            <span class="fw-bold">{{ number_format($order->original_amount, 2) }} ريال</span>
                                        </div>

                                        @if($order->quantity_discount > 0)
                                        <div class="summary-item d-flex justify-content-between mb-3 text-success">
                                            <span>خصم الكمية:</span>
                                            <span class="fw-bold">- {{ number_format($order->quantity_discount, 2) }} ريال</span>
                                        </div>
                                        @endif

                                        @if($order->coupon_discount > 0)
                                        <div class="summary-item d-flex justify-content-between mb-3 text-success">
                                            <span>خصم الكوبون:</span>
                                            <span class="fw-bold">- {{ number_format($order->coupon_discount, 2) }} ريال</span>
                                        </div>

                                        @if($order->coupon_code)
                                        <div class="summary-item d-flex justify-content-between mb-3">
                                            <span>كود الخصم:</span>
                                            <span class="badge badge-primary">{{ $order->coupon_code }}</span>
                                        </div>
                                        @endif
                                        @endif

                                        <div class="summary-item d-flex justify-content-between fw-bold total-row">
                                            <span>الإجمالي:</span>
                                            <span>{{ number_format($order->total_amount, 2) }} ريال</span>
                                        </div>
                                    </div>

                                    @if($order->quantity_discount > 0 || $order->coupon_discount > 0)
                                    <div class="alert alert-info mt-3 mb-0">
                                        <i class="bi bi-info-circle me-2"></i>
                                        @if($order->quantity_discount > $order->coupon_discount)
                                            <span>تم تطبيق خصم الكمية ({{ number_format($order->quantity_discount, 2) }} ريال) لأنه أكبر من خصم الكوبون.</span>
                                        @elseif($order->coupon_discount > $order->quantity_discount)
                                            <span>تم تطبيق خصم الكوبون ({{ number_format($order->coupon_discount, 2) }} ريال) لأنه أكبر من خصم الكمية.</span>
                                        @elseif($order->coupon_discount == $order->quantity_discount && $order->coupon_discount > 0)
                                            <span>تم تطبيق خصم متساوٍ ({{ number_format($order->coupon_discount, 2) }} ريال) من كلا النوعين.</span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- تتبع الطلب -->
        <div class="order-tracking mt-5 p-4">
            <h3 class="tracking-title text-center mb-4">تتبع الطلب</h3>

            <div class="tracking-stepper">
                <div class="tracking-step {{ $order->order_status != 'pending' ? 'completed' : '' }}">
                    <div class="step-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="step-line"></div>
                    <div class="step-content">
                        <h4>تم استلام الطلب</h4>
                        <p>تم استلام طلبك وهو قيد المراجعة</p>
                    </div>
                </div>

                <div class="tracking-step {{ in_array($order->order_status, ['processing', 'out_for_delivery', 'on_the_way', 'delivered', 'completed']) ? 'completed' : '' }}">
                    <div class="step-icon">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                    <div class="step-line"></div>
                    <div class="step-content">
                        <h4>قيد المعالجة</h4>
                        <p>جاري تجهيز طلبك</p>
                    </div>
                </div>

                <div class="tracking-step {{ in_array($order->order_status, ['out_for_delivery', 'on_the_way', 'delivered', 'completed']) ? 'completed' : '' }}">
                    <div class="step-icon">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <div class="step-line"></div>
                    <div class="step-content">
                        <h4>جاري التوصيل</h4>
                        <p>تم تجهيز طلبك للتوصيل</p>
                    </div>
                </div>

                <div class="tracking-step {{ in_array($order->order_status, ['on_the_way', 'delivered', 'completed']) ? 'completed' : '' }}">
                    <div class="step-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div class="step-line"></div>
                    <div class="step-content">
                        <h4>في الطريق</h4>
                        <p>المندوب في طريقه إليك</p>
                    </div>
                </div>

                <div class="tracking-step {{ in_array($order->order_status, ['delivered', 'completed']) ? 'completed' : '' }}">
                    <div class="step-icon">
                        <i class="bi bi-house-check-fill"></i>
                    </div>
                    <div class="step-content">
                        <h4>تم التوصيل</h4>
                        <p>تم توصيل طلبك بنجاح</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@section('scripts')
<script>
    // Print order invoice
    function printOrderInvoice(orderUuid) {
        const printUrl = `/customer/orders/${orderUuid}/invoice/view`;
        const printWindow = window.open(printUrl, '_blank', 'width=800,height=600');
        
        printWindow.onload = function() {
            setTimeout(() => {
                printWindow.print();
            }, 1000);
        };
    }
    
    // Request invoice by email
    async function requestInvoiceByEmail(orderUuid) {
        const button = event.target;
        const originalContent = button.innerHTML;
        
        try {
            // Show loading state
            button.innerHTML = '<i class="bi bi-spinner bi-spin me-2"></i>جاري الإرسال...';
            button.disabled = true;
            
            const response = await fetch(`/customer/orders/${orderUuid}/invoice/send`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                showNotification(data.message || 'تم إرسال الفاتورة إلى إيميلك بنجاح!', 'success');
            } else {
                showNotification(data.message || 'حدث خطأ أثناء إرسال الفاتورة', 'error');
            }
            
        } catch (error) {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء إرسال الفاتورة', 'error');
        } finally {
            // Restore button
            setTimeout(() => {
                button.innerHTML = originalContent;
                button.disabled = false;
            }, 1000);
        }
    }
    
    // Show notification
    function showNotification(message, type = 'success') {
        // Remove existing notifications
        const existing = document.querySelectorAll('.notification-toast');
        existing.forEach(n => n.remove());
        
        // Create notification
        const notification = document.createElement('div');
        notification.className = `notification-toast position-fixed top-0 start-50 translate-middle-x mt-3`;
        notification.style.cssText = `
            z-index: 9999;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-weight: 600;
            animation: slideDown 0.3s ease-out;
            background: ${type === 'success' ? 'linear-gradient(135deg, #28a745, #20c997)' : 'linear-gradient(135deg, #dc3545, #c82333)'};
            color: white;
            border: none;
        `;
        
        notification.innerHTML = `
            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            ${message}
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideUp 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Custom Dropdown Functions (Simple and reliable)
    function toggleCustomDropdown(button) {
        console.log('Custom dropdown clicked for button:', button.id);
        const menu = button.nextElementSibling;
        
        if (!menu || !menu.classList.contains('custom-dropdown-menu')) {
            console.error('Menu not found for button:', button.id);
            return;
        }
        
        const isVisible = menu.style.display === 'block';
        console.log('Menu visibility:', isVisible);
        
        // Close all dropdowns first
        document.querySelectorAll('.custom-dropdown-menu').forEach(m => {
            m.style.display = 'none';
            m.classList.remove('show');
        });
        
        // Toggle current dropdown
        if (!isVisible) {
            menu.style.display = 'block';
            menu.classList.add('show');
            console.log('Dropdown opened for:', button.id);
        } else {
            menu.style.display = 'none';
            menu.classList.remove('show');
            console.log('Dropdown closed for:', button.id);
        }
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.custom-dropdown')) {
            document.querySelectorAll('.custom-dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
                menu.classList.remove('show');
            });
        }
    });
    
    // Prevent dropdown from closing when clicking inside
    document.addEventListener('click', function(e) {
        if (e.target.closest('.custom-dropdown-menu')) {
            e.stopPropagation();
        }
    });
    
    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Custom dropdown system initialized');
    });
    
    // Global error handler
    window.addEventListener('error', function(e) {
        console.error('JavaScript error:', e.error);
    });
</script>
@endsection
