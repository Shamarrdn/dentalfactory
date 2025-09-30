@extends('layouts.dental')

@section('title', 'تفاصيل الطلب #' . $order->order_number)

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    .order-details-container {
        background-color: #f8fafc;
        padding-top: 120px;
        padding-bottom: 50px;
        min-height: 100vh;
    }
    
    .order-header {
        margin-bottom: 30px;
        text-align: center;
    }
    
    .order-title {
        color: #1e293b;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .order-subtitle {
        color: #64748b;
        font-size: 1.1rem;
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        color: #13c5c1;
        font-weight: 600;
        margin-bottom: 20px;
        text-decoration: none;
    }
    
    .back-link:hover {
        color: #0ea8a4;
    }
    
    .back-link i {
        margin-left: 8px;
    }
    
    .order-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        overflow: hidden;
    }
    
    .order-card-header {
        background: linear-gradient(135deg, #13c5c1 0%, #11b6b3 100%);
        color: white;
        padding: 20px;
        font-weight: 600;
        font-size: 1.2rem;
    }
    
    .order-card-header i {
        margin-left: 10px;
    }
    
    .order-card-body {
        padding: 25px;
    }
    
    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        background-color: rgba(19, 197, 193, 0.15);
        color: #13c5c1;
        margin-top: 10px;
    }
    
    .status-badge i {
        margin-left: 5px;
    }
    
    .status-badge.completed {
        background-color: rgba(34, 197, 94, 0.15);
        color: #22c55e;
    }
    
    .status-badge.cancelled {
        background-color: rgba(239, 68, 68, 0.15);
        color: #ef4444;
    }
    
    .status-badge.processing {
        background-color: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }
    
    .status-badge.pending {
        background-color: rgba(234, 179, 8, 0.15);
        color: #eab308;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .info-item {
        background-color: #f8fafc;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
    }
    
    .info-label {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }
    
    .info-value {
        color: #1e293b;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .product-list {
        margin-top: 15px;
    }
    
    .product-item {
        display: flex;
        align-items: center;
        background-color: #f8fafc;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .product-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        margin-left: 15px;
    }
    
    .product-image-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        background-color: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
    }
    
    .product-image-placeholder i {
        font-size: 1.5rem;
        color: #94a3b8;
    }
    
    .product-info {
        flex: 1;
    }
    
    .product-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
    
    .product-description {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    
    .product-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .product-meta-item {
        background-color: #fff;
        border-radius: 6px;
        padding: 5px 10px;
        font-size: 0.85rem;
    }
    
    .product-meta-label {
        color: #64748b;
        margin-left: 5px;
    }
    
    .product-meta-value {
        color: #1e293b;
        font-weight: 600;
    }
    
    .address-list {
        margin-top: 15px;
    }
    
    .address-item {
        display: flex;
        align-items: center;
        background-color: #f8fafc;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 10px;
    }
    
    .address-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(19, 197, 193, 0.15);
        color: #13c5c1;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
    }
    
    .address-content {
        flex: 1;
    }
    
    .address-label {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 3px;
    }
    
    .address-value {
        color: #1e293b;
        font-weight: 600;
    }
    
    .total-section {
        margin-top: 15px;
    }
    
    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .total-row:last-child {
        border-bottom: none;
    }
    
    .total-label {
        color: #64748b;
    }
    
    .total-value {
        color: #1e293b;
        font-weight: 600;
    }
    
    .grand-total {
        margin-top: 20px;
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        color: white;
        border-radius: 10px;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .grand-total-label {
        font-size: 1.1rem;
        font-weight: 600;
    }
    
    .grand-total-value {
        font-size: 1.3rem;
        font-weight: 700;
    }
    
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 30px;
        justify-content: center;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #13c5c1 0%, #11b6b3 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #11b6b3 0%, #0ea8a4 100%);
        color: white;
    }
    
    .btn-primary i {
        margin-left: 8px;
    }
    
    .btn-outline {
        background-color: transparent;
        color: #13c5c1;
        border: 2px solid #13c5c1;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-outline:hover {
        background-color: rgba(19, 197, 193, 0.1);
        color: #13c5c1;
    }
    
    .btn-outline i {
        margin-left: 8px;
    }
    
    @media (max-width: 768px) {
        .order-details-container {
            padding-top: 100px;
        }
        
        .order-title {
            font-size: 1.8rem;
        }
        
        .info-grid {
            grid-template-columns: 1fr 1fr;
        }
        
        .product-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .product-image, .product-image-placeholder {
            margin-left: 0;
            margin-bottom: 15px;
        }
        
        .action-buttons {
            flex-direction: column;
            width: 100%;
        }
        
        .btn-primary, .btn-outline {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 480px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media print {
        .back-link,
        .action-buttons {
            display: none !important;
        }
        
        .order-details-container {
            background: white !important;
            padding-top: 20px !important;
        }
        
        .order-card {
            box-shadow: none !important;
            border: 1px solid #e2e8f0 !important;
        }
    }
</style>
@endsection

@section('content')
<div class="order-details-container">
    <div class="container">
        <!-- Back Link -->
        <a href="/orders" class="back-link">
            <i class="bi bi-arrow-right"></i>
            العودة إلى الطلبات
        </a>
        
        <!-- Order Header -->
        <div class="order-header">
            <h1 class="order-title">طلب #{{ $order->order_number }}</h1>
            <p class="order-subtitle">تفاصيل كاملة لطلبك</p>
            
            <div class="status-badge {{ $order->order_status }}">
                <i class="bi bi-clock-history"></i>
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
            </div>
        </div>
        
        <!-- Order Info -->
        <div class="order-card">
            <div class="order-card-header">
                <i class="bi bi-info-circle"></i>
                معلومات الطلب
            </div>
            <div class="order-card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">تاريخ الطلب</div>
                        <div class="info-value">{{ $order->created_at->format('Y/m/d - H:i') }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">العميل</div>
                        <div class="info-value">{{ $order->user->name }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">رقم الهاتف</div>
                        <div class="info-value">{{ $order->phone_number ?? 'غير متوفر' }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">عدد المنتجات</div>
                        <div class="info-value">{{ $order->items->count() }} منتج</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products -->
        <div class="order-card">
            <div class="order-card-header">
                <i class="bi bi-bag-check"></i>
                المنتجات المطلوبة
            </div>
            <div class="order-card-body">
                <div class="product-list">
                    @foreach($order->items as $item)
                    <div class="product-item">
                        @if($item->product->images->first())
                        <img src="{{ url('storage/' . $item->product->images->first()->image_path) }}"
                            alt="{{ $item->product->name }}"
                            class="product-image">
                        @else
                        <div class="product-image-placeholder">
                            <i class="bi bi-image"></i>
                        </div>
                        @endif
                        
                        <div class="product-info">
                            <h4 class="product-name">{{ $item->product->name }}</h4>
                            
                            @if($item->product->description)
                            <p class="product-description">{{ Str::limit($item->product->description, 100) }}</p>
                            @endif
                            
                            <div class="product-meta">
                                <div class="product-meta-item">
                                    <span class="product-meta-label">الكمية:</span>
                                    <span class="product-meta-value">{{ $item->quantity }}</span>
                                </div>
                                
                                @if($item->price > 0)
                                <div class="product-meta-item">
                                    <span class="product-meta-label">السعر:</span>
                                    <span class="product-meta-value">{{ number_format($item->price, 2) }} ريال</span>
                                </div>
                                
                                <div class="product-meta-item">
                                    <span class="product-meta-label">المجموع:</span>
                                    <span class="product-meta-value">{{ number_format($item->price * $item->quantity, 2) }} ريال</span>
                                </div>
                                @endif
                                
                                @if($item->color)
                                <div class="product-meta-item">
                                    <span class="product-meta-label">اللون:</span>
                                    <span class="product-meta-value">{{ $item->color }}</span>
                                </div>
                                @endif
                                
                                @if($item->size)
                                <div class="product-meta-item">
                                    <span class="product-meta-label">المقاس:</span>
                                    <span class="product-meta-value">{{ $item->size }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Shipping Address -->
        @if($order->shipping_address)
        <div class="order-card">
            <div class="order-card-header">
                <i class="bi bi-truck"></i>
                عنوان التوصيل
            </div>
            <div class="order-card-body">
                <div class="address-list">
                    <div class="address-item">
                        <div class="address-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="address-content">
                            <div class="address-label">العنوان</div>
                            <div class="address-value">{{ $order->shipping_address }}</div>
                        </div>
                    </div>
                    
                    @if($order->city)
                    <div class="address-item">
                        <div class="address-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="address-content">
                            <div class="address-label">المدينة</div>
                            <div class="address-value">{{ $order->city }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($order->postal_code)
                    <div class="address-item">
                        <div class="address-icon">
                            <i class="bi bi-mailbox"></i>
                        </div>
                        <div class="address-content">
                            <div class="address-label">الرمز البريدي</div>
                            <div class="address-value">{{ $order->postal_code }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
        
        <!-- Order Total -->
        <div class="order-card">
            <div class="order-card-header">
                <i class="bi bi-calculator"></i>
                ملخص التكاليف
            </div>
            <div class="order-card-body">
                <div class="total-section">
                    <div class="total-row">
                        <div class="total-label">المجموع الجزئي</div>
                        <div class="total-value">{{ number_format($order->subtotal ?? $order->total_amount, 2) }} ريال</div>
                    </div>
                    
                    <div class="total-row">
                        <div class="total-label">الضرائب</div>
                        <div class="total-value">{{ number_format($order->tax_amount ?? 0, 2) }} ريال</div>
                    </div>
                    
                    @if($order->discount_amount > 0)
                    <div class="total-row">
                        <div class="total-label">الخصم</div>
                        <div class="total-value">- {{ number_format($order->discount_amount, 2) }} ريال</div>
                    </div>
                    @endif
                    
                    <div class="total-row">
                        <div class="total-label">رسوم التوصيل</div>
                        <div class="total-value">{{ number_format($order->shipping_cost ?? 0, 2) }} ريال</div>
                    </div>
                </div>
                
                <div class="grand-total">
                    <div class="grand-total-label">
                        <i class="bi bi-currency-dollar me-2"></i>
                        المجموع النهائي:
                    </div>
                    <div class="grand-total-value">
                        {{ number_format($order->total_amount, 2) }} ريال
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="/orders" class="btn-outline">
                <i class="bi bi-arrow-right"></i>
                العودة للطلبات
            </a>
            
            <a href="{{ route('customer.orders.invoice.view', $order->uuid) }}" 
               class="btn-primary" target="_blank">
                <i class="bi bi-file-earmark-text"></i>
                عرض الفاتورة
            </a>
            
            <a href="/products" class="btn-outline">
                <i class="bi bi-cart-plus"></i>
                طلب مرة أخرى
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Order details page loaded successfully');
    });
</script>
@endsection