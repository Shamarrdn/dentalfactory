@extends('layouts.dental')

@section('title', 'لوحة التحكم')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/customer/dashboard.css') }}">
@endsection

@section('content')
<div class="container-fluid py-4" style="margin-top: 80px;">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-8">
                    <div class="welcome-content">
                        <h1 class="dashboard-title">مرحباً، {{ Auth::user()->name }}</h1>
                        <p class="dashboard-subtitle">إدارة حسابك ومتابعة طلباتك</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="dashboard-header-actions d-flex align-items-center justify-content-md-end gap-3">
                        <!-- Notifications Button -->
                        <a href="/notifications" class="btn btn-outline-primary position-relative">
                            <i class="fas fa-bell"></i>
                            <span class="d-none d-sm-inline ms-2">الإشعارات</span>
                            @if($stats['unread_notifications'] > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $stats['unread_notifications'] }}
                                    <span class="visually-hidden">إشعارات غير مقروءة</span>
                                </span>
                            @endif
                        </a>
                        
                        <!-- User Badge -->
                        <div class="user-badge">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ Auth::user()->role === 'admin' ? 'مدير' : 'عميل' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="dashboard-content">
        <div class="container">
            <!-- Quick Stats -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card stat-orders">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">{{ $stats['orders_count'] }}</h3>
                            <p class="stat-label">إجمالي الطلبات</p>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card stat-cart">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">{{ $stats['cart_items_count'] }}</h3>
                            <p class="stat-label">منتجات في السلة</p>
                        </div>
                        <div class="stat-trend">
                            <a href="/cart" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="/notifications" class="text-decoration-none">
                        <div class="stat-card stat-notifications" style="cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='';">
                            <div class="stat-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="stat-info">
                                <h3 class="stat-number">{{ $stats['unread_notifications'] }}</h3>
                                <p class="stat-label">إشعارات جديدة</p>
                            </div>
                            <div class="stat-trend">
                                @if($stats['unread_notifications'] > 0)
                                    <span class="badge bg-danger">جديد</span>
                                @else
                                    <i class="fas fa-arrow-left text-muted" style="font-size: 14px;"></i>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card stat-profile">
                        <div class="stat-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">100%</h3>
                            <p class="stat-label">اكتمال الملف الشخصي</p>
                        </div>
                        <div class="stat-trend">
                            <a href="/user/profile" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="row g-4">
                <!-- Recent Orders -->
                <div class="col-12 col-lg-8">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-history me-2"></i>
                                آخر الطلبات
                            </h5>
                            <a href="/orders" class="btn btn-outline-primary btn-sm">
                                عرض الكل
                                <i class="fas fa-arrow-left ms-1"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            @if(count($recent_orders) > 0)
                                <div class="orders-list">
                                    @foreach($recent_orders as $order)
                                        <div class="order-item">
                                            <div class="order-info">
                                                <div class="order-number">
                                                    <strong>#{{ $order['order_number'] }}</strong>
                                                </div>
                                                <div class="order-date">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $order['created_at']->format('Y/m/d') }}
                                                </div>
                                            </div>
                                            <div class="order-status">
                                                <span class="badge bg-{{ $order['status_color'] }}">
                                                    {{ $order['status_text'] }}
                                                </span>
                                            </div>
                                            <div class="order-actions">
                                <a href="/orders/{{ $order['uuid'] }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <h6>لا توجد طلبات حتى الآن</h6>
                                    <p class="text-muted">ابدأ التسوق الآن واطلب منتجاتك المفضلة</p>
                                    <a href="/products" class="btn btn-primary">
                                        <i class="fas fa-shopping-cart me-1"></i>
                                        تصفح المنتجات
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-12 col-lg-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-bolt me-2"></i>
                                إجراءات سريعة
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="quick-actions">
                                <a href="/products" class="quick-action-btn">
                                    <div class="action-icon bg-primary">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>تصفح المنتجات</h6>
                                        <p>اكتشف منتجاتنا الجديدة</p>
                                    </div>
                                </a>
                                
                                <a href="/cart" class="quick-action-btn">
                                    <div class="action-icon bg-success">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>إتمام الطلب</h6>
                                        <p>أكمل طلبك الحالي</p>
                                    </div>
                                </a>
                                
                                <a href="/user/profile" class="quick-action-btn">
                                    <div class="action-icon bg-info">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>تحديث الملف الشخصي</h6>
                                        <p>إدارة بياناتك الشخصية</p>
                                    </div>
                                </a>
                                
                                <a href="/notifications" class="quick-action-btn">
                                    <div class="action-icon bg-danger">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>الإشعارات</h6>
                                        <p>تابع إشعاراتك الجديدة</p>
                                        @if($stats['unread_notifications'] > 0)
                                            <span class="badge bg-light text-dark">{{ $stats['unread_notifications'] }} جديد</span>
                                        @endif
                                    </div>
                                </a>
                                
                                <a href="/contact" class="quick-action-btn">
                                    <div class="action-icon bg-warning">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <div class="action-content">
                                        <h6>دعم العملاء</h6>
                                        <p>تواصل معنا للمساعدة</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Sections -->
            <div class="row g-4 mt-2">
                <!-- Account Summary -->
                <div class="col-12 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-user me-2"></i>
                                ملخص الحساب
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="account-summary">
                                <div class="summary-item">
                                    <div class="summary-label">
                                        <i class="fas fa-envelope me-2"></i>
                                        البريد الإلكتروني
                                    </div>
                                    <div class="summary-value">{{ Auth::user()->email }}</div>
                                </div>
                                
                                <div class="summary-item">
                                    <div class="summary-label">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        تاريخ التسجيل
                                    </div>
                                    <div class="summary-value">{{ Auth::user()->created_at->format('Y/m/d') }}</div>
                                </div>
                                
                                <div class="summary-item">
                                    <div class="summary-label">
                                        <i class="fas fa-shield-alt me-2"></i>
                                        حالة الحساب
                                    </div>
                                    <div class="summary-value">
                                        <span class="badge bg-success">نشط</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="col-12 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-clock me-2"></i>
                                النشاط الأخير
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(count($recent_notifications) > 0)
                                <div class="activity-list">
                                    @foreach($recent_notifications as $notification)
                                        <div class="activity-item">
                                            <div class="activity-icon">
                                                <i class="fas fa-bell"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p>{{ $notification->data['message'] ?? 'إشعار جديد' }}</p>
                                                <small class="text-muted">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state-small">
                                    <i class="fas fa-bell-slash"></i>
                                    <p>لا توجد إشعارات حديثة</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
