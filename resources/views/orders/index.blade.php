@extends('layouts.dental')

@section('title', 'طلباتي')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    .orders-container {
ك        background: linear-gradient(135deg, #f8fafc 0%, #e6f7f1 100%);
        min-height: 100vh;
        padding-top: 100px;
    }
    
    .page-header {
        background: linear-gradient(135deg, #1a9d5a 0%, #2db870 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(0, 146, 69, 0.25);
        border: none;
    }
    
    .page-title {
        color: #ffffff;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-align: center;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    
    .page-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 1.2rem;
        text-align: center;
        margin: 0.5rem 0 0 0;
    }
    
    .order-card {
        position: relative !important;
        background: white !important;
        border-radius: 16px !important;
        margin-bottom: 2rem !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06) !important;
        border: 1px solid #e2e8f0 !important;
        overflow: visible !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }
    
    .order-card:hover,
    .order-card:focus,
    .order-card:active {
        background: white !important;
        border-radius: 16px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06) !important;
        border: 1px solid #e2e8f0 !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }
    
    
    
    .order-header {
        background: linear-gradient(135deg, #13c5c1 0%, #11b6b3 100%);
        color: white;
        padding: 1.5rem 2rem;
        position: relative;
    }
    
    .order-number {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
    }
    
    .order-status {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-pending {
        background: #fef3c7;
        color: #d97706;
    }
    
    .status-processing {
        background: #f3f4f6;
        color: #6b7280;
    }
    
    .status-completed {
        background: #f3f4f6;
        color: #6b7280;
    }
    
    .status-cancelled {
        background: #fecaca;
        color: #dc2626;
    }
    
    .status-delivered {
        background: #f3f4f6;
        color: #6b7280;
    }
    
    .order-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .order-date, .order-total {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
    }
    
    .order-total {
        font-size: 1.3rem;
        color: white;
        font-weight: 700;
    }
    
    .order-body {
        padding: 2rem;
        background: white !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }
    
    .order-body:hover {
        background: white !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }
    
    /* حماية شاملة من تأثيرات hover مع حماية البوردر */
    .order-card, 
    .order-card:hover,
    .order-card *,
    .order-card *:hover,
    .order-body,
    .order-body:hover,
    .order-body *,
    .order-body *:hover {
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
        filter: none !important;
        transition: none !important;
        border-collapse: separate !important;
        box-sizing: border-box !important;
    }
    
    /* حماية إضافية للكارد والمحتوى */
    .order-card .order-header,
    .order-card .order-body,
    .order-card .order-items,
    .order-card .order-actions {
        border: none !important;
        overflow: visible !important;
        z-index: 1 !important;
        position: relative !important;
    }
    
    /* استثناء للأزرار للحفاظ على ألوانها */
    .btn-primary,
    .btn-outline-primary {
        pointer-events: auto !important;
    }
    
    /* قاعدة نهائية لضمان عدم اoتفاء أي شيء */
    * {
        will-change: auto !important;
    }
    
    *:hover {
        will-change: auto !important;
    }
    
    .order-items {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .order-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        border: 1px solid #e2e8f0;
    }
    
    
    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .item-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    .item-quantity {
        color: #6b7280;
        margin-bottom: 0.5rem;
    }
    
    .item-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #6b7280;
    }
    
    .order-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
    }
    
    .btn {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #009245 0%, #00b854 100%);
        color: white;
        border: none;
    }
    
    
    .btn-outline-primary {
        border: 2px solid #13c5c1;
        color: #13c5c1;
        background: transparent;
    }
    
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        margin-top: 2rem;
        border: 1px solid #e2e8f0;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        color: #94a3b8;
        margin-bottom: 1.5rem;
    }
    
    .empty-state h3 {
        color: #1e293b;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }
    
    .empty-state p {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }
    
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
        gap: 0.5rem;
    }
    
    .page-item {
        display: inline-block;
    }
    
    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 8px !important;
        background: white !important;
        color: #6b7280 !important;
        text-decoration: none;
        font-weight: 600;
        border: 1px solid #e2e8f0 !important;
    }
    
    
    .page-item.active .page-link {
        background: #6b7280 !important;
        color: white !important;
        border-color: #6b7280 !important;
    }
    
    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    @media (max-width: 768px) {
        .orders-container {
            padding-top: 80px;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .order-meta {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .order-actions {
            flex-direction: column;
        }
        
        .action-buttons {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="orders-container">
    <div class="container">
    <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-bag-check me-3"></i>
                طلباتي
            </h1>
            <p class="page-subtitle">تتبع وإدارة جميع طلباتك في مكان واحد</p>
            
            <div class="action-buttons">
                <a href="/products" class="btn btn-primary">
                    <i class="bi bi-cart-plus"></i>
                متابعة التسوق
            </a>
            </div>
        </div>

        <!-- Orders List -->
    @forelse($orders as $order)
    <div class="order-card">
                <!-- Order Header -->
        <div class="order-header">
                    <div class="order-number">
                        <i class="bi bi-receipt me-2"></i>
                        طلب #{{ $order->order_number }}
                </div>
                    
                        @if(Auth::user()->hasRole('admin') && $order->user)
                        <div class="customer-info mt-2">
                            <i class="bi bi-person-circle me-2"></i>
                            {{ $order->user->name }}
                        </div>
                        @endif
                    
                    <div class="order-status">
                    <span class="status-badge status-{{ $order->order_status }}">
                            <i class="bi bi-clock-history me-1"></i>
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
            
            <div class="order-meta">
                <div class="order-date">
                            <i class="bi bi-calendar3"></i>
                            {{ $order->created_at->format('Y/m/d - H:i') }}
                </div>
                        
                @if($order->original_amount > $order->total_amount)
                <div class="order-discount">
                                <i class="bi bi-tag-fill"></i>
                                خصم: {{ number_format($order->original_amount - $order->total_amount, 2) }} ريال
                </div>
                @endif
                        
                <div class="order-total">
                    <i class="bi bi-currency-dollar"></i>
                    {{ number_format($order->total_amount, 2) }} ريال
                        </div>
                </div>
            </div>
            
                <!-- Order Body -->
                <div class="order-body">
                    <div class="order-items">
                        @foreach($order->items->take(6) as $item)
                    <div class="order-item">
                        @if($item->product->images->first())
                        <img src="{{ url('storage/' . $item->product->images->first()->image_path) }}"
                            alt="{{ $item->product->name }}"
                            class="item-image">
                                @else
                                    <div class="item-image" style="background: linear-gradient(135deg, #ddd, #f8f9fa); display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-image" style="font-size: 2rem; color: #999;"></i>
                                    </div>
                        @endif
                                
                            <h4 class="item-name">{{ $item->product->name }}</h4>
                                <p class="item-quantity">
                                    <i class="bi bi-box"></i>
                                الكمية: {{ $item->quantity }}
                            </p>
                            @if($item->price > 0)
                                    <div class="item-price">
                                {{ number_format($item->price * $item->quantity, 2) }} ريال
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    
                    @if($order->items->count() > 6)
                        <div class="text-center mb-3">
                            <p class="text-muted">
                                <i class="bi bi-three-dots"></i>
                                و {{ $order->items->count() - 6 }} منتجات إضافية
                            </p>
                </div>
                    @endif
                    
                    <!-- Order Actions -->
                    <div class="order-actions">
                        <a href="{{ route('orders.show', $order->uuid) }}" class="btn btn-primary">
                            <i class="bi bi-eye-fill"></i>
                            عرض التفاصيل
                        </a>
                        <a href="{{ route('customer.orders.invoice.view', $order->uuid) }}" 
                           class="btn btn-outline-primary" target="_blank">
                            <i class="bi bi-file-earmark-text"></i>
                            عرض الفاتورة
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-state-icon">
                    <i class="bi bi-bag-x"></i>
        </div>
        <h3>لا توجد طلبات حتى الآن</h3>
                <p>ابدأ رحلة التسوق واكتشف منتجاتنا المميزة</p>
                <a href="/products" class="btn btn-primary btn-lg">
                    <i class="bi bi-cart-plus"></i>
            ابدأ التسوق الآن
        </a>
    </div>
    @endforelse

        <!-- Pagination -->
        @if($orders->hasPages())
            <nav aria-label="صفحات الطلبات">
                <div class="pagination">
                    {{-- Previous Page Link --}}
                    @if($orders->onFirstPage())
                        <span class="page-item disabled">
                            <span class="page-link">
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
                            <span class="page-link">
                                <i class="bi bi-chevron-left"></i>
                            </span>
                        </span>
                    @endif
                </div>
            </nav>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Print functionality
    function printOrders() {
        window.print();
    }

    // Order status updates (if needed)
    document.addEventListener('DOMContentLoaded', function() {
        // Hover effects removed
        
        // حماية قوية جداً للبوردر
        function protectBorders() {
            const orderCards = document.querySelectorAll('.order-card');
            
            orderCards.forEach(function(card) {
                // إجبار البوردر على البقاء
                function forceBorder() {
                    card.style.setProperty('border', '1px solid #e2e8f0', 'important');
                    card.style.setProperty('border-radius', '16px', 'important');
                    card.style.setProperty('box-shadow', '0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06)', 'important');
                    card.style.setProperty('background', 'white', 'important');
                    card.style.setProperty('opacity', '1', 'important');
                    card.style.setProperty('visibility', 'visible', 'important');
                    card.style.setProperty('transform', 'none', 'important');
                    card.style.setProperty('overflow', 'visible', 'important');
                }
                
                // تطبيق البوردر فوراً
                forceBorder();
                
                // مراقبة جميع الأحداث
                ['mouseenter', 'mouseleave', 'mouseover', 'mouseout', 'focus', 'blur', 'click', 'touchstart', 'touchend'].forEach(event => {
                    card.addEventListener(event, forceBorder, true);
                });
                
                // مراقبة تغييرات الـ CSS
                const observer = new MutationObserver(function() {
                    forceBorder();
                });
                
                observer.observe(card, {
                    attributes: true,
                    attributeFilter: ['style', 'class'],
                    childList: false,
                    subtree: false
                });
                
                // مراقبة كل ثانية للتأكد
                setInterval(forceBorder, 1000);
            });
        }
        
        // تشغيل الحماية
        protectBorders();
        
        // إعادة تشغيل الحماية عند تحميل المحتوى
        setTimeout(protectBorders, 100);
        setTimeout(protectBorders, 500);
        setTimeout(protectBorders, 1000);
    });
  </script>
  @endsection