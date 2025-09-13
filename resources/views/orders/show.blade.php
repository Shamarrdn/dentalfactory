@extends('layouts.dental')

@section('title', 'تفاصيل الطلب #' . $order->order_number)

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    .order-details-container {
        background: #f8fafc;
        min-height: 100vh;
        padding-top: 100px;
        padding-bottom: 50px;
    }
    
    .back-button {
        background: #6b7280;
        color: white;
        border: 1px solid #6b7280;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        margin-bottom: 2rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-weight: 600;
    }
    
    .back-button:hover {
        background: #4b5563;
        color: white;
        transform: translateX(3px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }
    
    .order-header-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
    }
    
    .order-title {
        color: #1e293b;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-align: center;
    }
    
    .order-subtitle {
        color: #6b7280;
        text-align: center;
        margin-top: 0.5rem;
    }
    
    .status-section {
        background: #6b7280;
        color: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        text-align: center;
    }
    
    .status-badge-large {
        display: inline-block;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-size: 1.2rem;
        font-weight: 700;
        margin-top: 1rem;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .order-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }
    
    .info-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }
    
    .info-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #6b7280;
    }
    
    .info-label {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .info-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
    }
    
    .section-card {
        background: white;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    
    .section-header {
        background: #6b7280;
        color: white;
        padding: 1.5rem 2rem;
        font-size: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .section-body {
        padding: 2rem;
    }
    
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .product-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        background: #f3f4f6;
        border-color: #6b7280;
    }
    
    .product-image {
        width: 100px;
        height: 100px;
        border-radius: 15px;
        object-fit: cover;
        margin-bottom: 1rem;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .product-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    .product-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .product-detail {
        text-align: center;
        padding: 0.75rem;
        background: rgba(107, 114, 128, 0.08);
        border-radius: 8px;
    }
    
    .product-detail-label {
        font-size: 0.8rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }
    
    .product-detail-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
    }
    
    .address-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 2rem;
        border: 1px solid #e2e8f0;
    }
    
    .address-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 0.75rem;
        background: white;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }
    
    .address-icon {
        font-size: 1.5rem;
        color: #6b7280;
        width: 30px;
        text-align: center;
    }
    
    .address-content {
        flex: 1;
    }
    
    .address-label {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }
    
    .address-value {
        font-weight: 600;
        color: #1e293b;
    }
    
    .total-card {
        background: #6b7280;
        color: white;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
    }
    
    .total-breakdown {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .total-item {
        background: rgba(255,255,255,0.15);
        border-radius: 8px;
        padding: 1rem;
        border: 1px solid rgba(255,255,255,0.2);
    }
    
    .total-label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
    }
    
    .total-value {
        font-size: 1.3rem;
        font-weight: 700;
    }
    
    .grand-total {
        font-size: 2rem;
        font-weight: 800;
        padding: 1rem;
        background: rgba(255,255,255,0.2);
        border-radius: 8px;
        margin-top: 1rem;
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }
    
    .btn {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: #6b7280;
        color: white;
    }
    
    .btn-primary:hover {
        background: #4b5563;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        color: white;
    }
    
    .btn-outline-primary {
        border: 1px solid #6b7280;
        color: #6b7280;
        background: transparent;
    }
    
    .btn-outline-primary:hover {
        background: #6b7280;
        color: white;
        transform: translateY(-1px);
    }
    
    .btn-success {
        background: #6b7280;
        color: white;
    }
    
    .btn-success:hover {
        background: #4b5563;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        color: white;
    }
    
    @media (max-width: 768px) {
        .order-details-container {
            padding-top: 80px;
        }
        
        .order-title {
            font-size: 1.8rem;
        }
        
        .order-info-grid {
            grid-template-columns: 1fr;
        }
        
        .product-grid {
            grid-template-columns: 1fr;
        }
        
        .total-breakdown {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .product-details {
            grid-template-columns: 1fr;
        }
    }
    
    @media print {
        .back-button,
        .action-buttons {
            display: none !important;
        }
        
        .order-details-container {
            background: white !important;
            padding-top: 0 !important;
        }
        
        .section-card,
        .order-header-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    }
</style>
@endsection

@section('content')
<div class="order-details-container">
    <div class="container">
        <!-- Back Button -->
        <a href="/orders" class="back-button">
                <i class="bi bi-arrow-right"></i>
            العودة إلى الطلبات
        </a>

        <!-- Order Header -->
        <div class="order-header-card">
            <h1 class="order-title">
                <i class="bi bi-receipt me-3"></i>
                طلب #{{ $order->order_number }}
            </h1>
            <p class="order-subtitle">تفاصيل كاملة لطلبك</p>
            
            <!-- Status Section -->
            <div class="status-section">
                <h3>حالة الطلب</h3>
                <div class="status-badge-large">
                    <i class="bi bi-clock-history me-2"></i>
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
            
            <!-- Order Info Grid -->
            <div class="order-info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-calendar3"></i>
                    </div>
                    <div class="info-label">تاريخ الطلب</div>
                    <div class="info-value">{{ $order->created_at->format('Y/m/d - H:i') }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-person-circle"></i>
            </div>
                    <div class="info-label">العميل</div>
                    <div class="info-value">{{ $order->user->name }}</div>
            </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-telephone"></i>
            </div>
                    <div class="info-label">رقم الهاتف</div>
                    <div class="info-value">{{ $order->phone_number ?? 'غير متوفر' }}</div>
        </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-box-seam"></i>
                            </div>
                    <div class="info-label">عدد المنتجات</div>
                    <div class="info-value">{{ $order->items->count() }} منتج</div>
                        </div>
                    </div>
                </div>

        <!-- Products Section -->
        <div class="section-card">
            <div class="section-header">
                <i class="bi bi-bag-check"></i>
                المنتجات المطلوبة
            </div>
            <div class="section-body">
                <div class="product-grid">
                            @foreach($order->items as $item)
                        <div class="product-card">
                                @if($item->product->images->first())
                                <img src="{{ url('storage/' . $item->product->images->first()->image_path) }}"
                                    alt="{{ $item->product->name }}"
                                     class="product-image">
                            @else
                                <div class="product-image" style="background: linear-gradient(135deg, #ddd, #f8f9fa); display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-image" style="font-size: 2.5rem; color: #999;"></i>
                                </div>
                                @endif
                            
                            <h4 class="product-name">{{ $item->product->name }}</h4>
                            
                            @if($item->product->description)
                                <p class="text-muted mb-3">{{ Str::limit($item->product->description, 100) }}</p>
                                        @endif

                            <div class="product-details">
                                <div class="product-detail">
                                    <div class="product-detail-label">الكمية</div>
                                    <div class="product-detail-value">{{ $item->quantity }}</div>
                        </div>

                                @if($item->price > 0)
                                    <div class="product-detail">
                                        <div class="product-detail-label">السعر</div>
                                        <div class="product-detail-value">{{ number_format($item->price, 2) }} ريال</div>
                                        </div>

                                    <div class="product-detail" style="grid-column: 1/-1;">
                                        <div class="product-detail-label">المجموع</div>
                                        <div class="product-detail-value" style="color: #6b7280; font-size: 1.3rem;">
                                            {{ number_format($item->price * $item->quantity, 2) }} ريال
                                        </div>
                                        </div>
                                        @endif

                                @if($item->color)
                                    <div class="product-detail">
                                        <div class="product-detail-label">اللون</div>
                                        <div class="product-detail-value">{{ $item->color }}</div>
                                        </div>
                                        @endif
                                
                                @if($item->size)
                                    <div class="product-detail">
                                        <div class="product-detail-label">المقاس</div>
                                        <div class="product-detail-value">{{ $item->size }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        @if($order->shipping_address)
            <div class="section-card">
                <div class="section-header">
                    <i class="bi bi-truck"></i>
                    عنوان التوصيل
                </div>
                <div class="section-body">
                    <div class="address-card">
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
        <div class="section-card">
            <div class="section-header">
                <i class="bi bi-calculator"></i>
                ملخص التكاليف
            </div>
            <div class="section-body">
                <div class="total-card">
                    <div class="total-breakdown">
                        <div class="total-item">
                            <div class="total-label">المجموع الجزئي</div>
                            <div class="total-value">{{ number_format($order->subtotal ?? $order->total_amount, 2) }} ريال</div>
                        </div>
                        
                        <div class="total-item">
                            <div class="total-label">الضرائب</div>
                            <div class="total-value">{{ number_format($order->tax_amount ?? 0, 2) }} ريال</div>
                </div>

                        @if($order->discount_amount > 0)
                            <div class="total-item">
                                <div class="total-label">الخصم</div>
                                <div class="total-value">- {{ number_format($order->discount_amount, 2) }} ريال</div>
                    </div>
                        @endif
                        
                        <div class="total-item">
                            <div class="total-label">رسوم التوصيل</div>
                            <div class="total-value">{{ number_format($order->shipping_cost ?? 0, 2) }} ريال</div>
                    </div>
                </div>
                    
                    <div class="grand-total">
                        <i class="bi bi-currency-dollar me-2"></i>
                        المجموع النهائي: {{ number_format($order->total_amount, 2) }} ريال
            </div>
        </div>
    </div>
</div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="/orders" class="btn btn-outline-primary">
                <i class="bi bi-arrow-right"></i>
                العودة للطلبات
            </a>
            
            <a href="{{ route('customer.orders.invoice.view', $order->uuid) }}" 
               class="btn btn-primary" target="_blank">
                <i class="bi bi-file-earmark-text"></i>
                عرض الفاتورة
            </a>
            
            <button onclick="window.print()" class="btn btn-success">
                <i class="bi bi-printer"></i>
                طباعة التفاصيل
            </button>
            
            <a href="/products" class="btn btn-outline-primary">
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
        // Animate product cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.product-card').forEach(card => {
            card.style.transform = 'translateY(30px)';
            card.style.opacity = '0';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
        
        // Add hover effects
        document.querySelectorAll('.info-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-3px) scale(1)';
            });
        });
    });
</script>
@endsection
