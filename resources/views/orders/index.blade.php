@extends('layouts.customer')

@section('title', 'طلباتي')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="/assets/css/customer/orders.css">
<link rel="stylesheet" href="/assets/css/customer/invoice-buttons.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<header class="header-container">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="page-title">طلباتي</h2>
                <p class="page-subtitle">إدارة وتتبع طلباتك</p>
            </div>
            <div class="col-md-6 text-start">
                <a href="/products" class="btn btn-outline-primary me-2">
                    <i class="bi bi-cart"></i>
                    متابعة التسوق
                </a>
                <button onclick="window.print()" class="btn btn-secondary">
                    <i class="bi bi-printer"></i>
                    طباعة الطلبات
                </button>
            </div>
        </div>
    </div>
</header>

<main class="container py-4">
    @forelse($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <div class="order-info">
                <div class="d-flex align-items-center">
                    <div class="order-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="order-number">طلب #{{ $order->order_number }}</h3>
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
                </div>
            </div>
            
            <div class="order-meta">
                <div class="order-date">
                    <i class="bi bi-calendar"></i>
                    {{ $order->created_at->format('Y/m/d') }}
                </div>
                @if($order->original_amount > $order->total_amount)
                <div class="order-discount">
                    <i class="bi bi-tag"></i>
                    <span>الخصم: {{ number_format($order->original_amount - $order->total_amount, 2) }} ريال</span>
                </div>
                @endif
                <div class="order-total">
                    <i class="bi bi-currency-dollar"></i>
                    {{ number_format($order->total_amount, 2) }} ريال
                </div>
            </div>
            
            <div class="order-actions">
                <a href="{{ route('orders.show', $order->uuid) }}" class="btn btn-primary">
                    <i class="bi bi-eye"></i>
                    عرض التفاصيل
                </a>
                <div class="dropdown invoice-dropdown">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="invoiceDropdown{{ $order->id }}">
                        <i class="bi bi-receipt"></i>
                        الفاتورة
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="invoiceDropdown{{ $order->id }}">
                        <li>
                            <a class="dropdown-item" href="{{ route('customer.orders.invoice.view', $order->uuid) }}" target="_blank">
                                <i class="bi bi-eye text-info me-2"></i>
                                عرض الفاتورة
                            </a>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item" onclick="printOrderInvoice('{{ $order->uuid }}')">
                                <i class="bi bi-printer text-primary me-2"></i>
                                طباعة الفاتورة
                            </button>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <button type="button" class="dropdown-item" onclick="requestInvoiceByEmail('{{ $order->uuid }}')">
                                <i class="bi bi-envelope text-success me-2"></i>
                                إرسال لإيميلي
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="order-details">
            <div class="row">
                @foreach($order->items->take(4) as $item)
                <div class="col-md-3 col-sm-6">
                    <div class="order-item">
                        @if($item->product->images->first())
                        <img src="{{ url('storage/' . $item->product->images->first()->image_path) }}"
                            alt="{{ $item->product->name }}"
                            class="item-image">
                        @endif
                        <div class="item-details">
                            <h4 class="item-name">{{ $item->product->name }}</h4>
                            <p class="item-price">
                                الكمية: {{ $item->quantity }}
                            </p>
                            @if($item->price > 0)
                            <div class="item-subtotal">
                                {{ number_format($item->price * $item->quantity, 2) }} ريال
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($order->items->count() > 4)
            <div class="text-center mt-3">
                <a href="{{ route('orders.show', $order->uuid) }}" class="btn btn-link">
                    عرض {{ $order->items->count() - 4 }} منتجات إضافية
                </a>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="bi bi-box"></i>
        </div>
        <h3>لا توجد طلبات حتى الآن</h3>
        <p>سجل طلباتك فارغ. ابدأ التسوق لاكتشاف منتجاتنا المميزة!</p>
        <a href="/products" class="btn btn-primary">
            ابدأ التسوق الآن
        </a>
    </div>
    @endforelse

    <div class="mt-4">
        @if($orders->hasPages())
            <nav aria-label="صفحات الطلبات">
                <div class="pagination">
                    {{-- Previous Page Link --}}
                    @if($orders->onFirstPage())
                        <span class="page-item disabled">
                            <span class="page-link" aria-hidden="true">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </span>
                    @else
                        <span class="page-item">
                            <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </span>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                        @if($page == $orders->currentPage())
                            <span class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </span>
                        @else
                            <span class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </span>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($orders->hasMorePages())
                        <span class="page-item">
                            <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </span>
                    @else
                        <span class="page-item disabled">
                            <span class="page-link" aria-hidden="true">
                                <i class="bi bi-chevron-left"></i>
                            </span>
                        </span>
                    @endif
                </div>
            </nav>
        @endif
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
                showNotification('تم إرسال الفاتورة إلى إيميلك بنجاح!', 'success');
            } else {
                showNotification('حدث خطأ أثناء إرسال الفاتورة', 'error');
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
    
    // Initialize Bootstrap dropdowns
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all dropdowns normally
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl, {
                autoClose: true,
                boundary: 'viewport'
            });
        });
        
        // Handle dropdown show/hide events for z-index management
        document.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
            toggle.addEventListener('show.bs.dropdown', function() {
                // Find the current order card and dropdown
                const orderCard = this.closest('.order-card');
                const dropdown = this.closest('.dropdown');
                const dropdownMenu = this.nextElementSibling;
                
                // Reset all cards z-index to lowest
                document.querySelectorAll('.order-card').forEach(function(card) {
                    card.style.zIndex = '5';
                });
                
                // Reset all dropdowns to lower z-index
                document.querySelectorAll('.dropdown').forEach(function(dd) {
                    dd.style.zIndex = '10';
                });
                
                // Set current card to highest z-index
                if (orderCard) {
                    orderCard.style.zIndex = '99999';
                }
                
                // Set current dropdown to even higher z-index
                if (dropdown) {
                    dropdown.style.zIndex = '100000';
                }
                
                // Set dropdown menu to highest possible z-index
                if (dropdownMenu) {
                    dropdownMenu.style.zIndex = '100001';
                    dropdownMenu.style.position = 'absolute';
                }
                
                // Add a class to identify the active dropdown
                document.querySelectorAll('.dropdown-active').forEach(function(el) {
                    el.classList.remove('dropdown-active');
                });
                if (dropdown) {
                    dropdown.classList.add('dropdown-active');
                }
            });
            
            toggle.addEventListener('hide.bs.dropdown', function() {
                // Reset z-index when dropdown closes
                const orderCard = this.closest('.order-card');
                const dropdown = this.closest('.dropdown');
                const dropdownMenu = this.nextElementSibling;
                
                if (orderCard) {
                    orderCard.style.zIndex = '10';
                }
                
                if (dropdown) {
                    dropdown.style.zIndex = '50';
                    dropdown.classList.remove('dropdown-active');
                }
                
                if (dropdownMenu) {
                    dropdownMenu.style.zIndex = '9999';
                }
            });
        });
        
        // Add click outside to close functionality
        document.addEventListener('click', function(e) {
            // Close all dropdowns when clicking outside
            if (!e.target.closest('.dropdown')) {
                dropdownList.forEach(function(dropdown) {
                    dropdown.hide();
                });
            }
        });
        
        // Prevent dropdown from staying open
        document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
            menu.addEventListener('click', function(e) {
                // Close dropdown after clicking menu item (except for buttons)
                if (e.target.tagName === 'A') {
                    const dropdown = bootstrap.Dropdown.getInstance(this.previousElementSibling);
                    if (dropdown) {
                        dropdown.hide();
                    }
                }
            });
        });
    });
    
    // Global error handler
    window.addEventListener('error', function(e) {
        console.error('JavaScript error:', e.error);
    });
</script>
@endsection
