<!-- Navbar Start -->
<header class="dental-navbar">
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('logo.png') }}" alt="مصنع منتجات الأسنان" class="logo-img">
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dentalNavbar"
                    aria-controls="dentalNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>


            <div class="collapse navbar-collapse" id="dentalNavbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ route('about') }}">من نحن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('services*') ? 'active' : '' }}" href="{{ route('services') }}">خدماتنا</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="/products">المنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ route('contact') }}">تواصل معنا</a>
                    </li>
                </ul>

                <div class="navbar-actions">
                    <!-- Cart -->
                    <div class="nav-item d-flex align-items-center">
                        <a href="/cart" class="nav-icon position-relative" style="color: var(--primary);">
                            <i class="fas fa-shopping-cart"></i>
                            @php
                                // حساب العدد الكلي للمنتجات (وليس فقط عدد العناصر المختلفة)
                                $cart_total_quantity = 0;
                                if(isset($stats) && isset($stats['cart_items_details']) && is_array($stats['cart_items_details'])) {
                                    foreach($stats['cart_items_details'] as $item) {
                                        $cart_total_quantity += isset($item['quantity']) ? $item['quantity'] : 0;
                                    }
                                } elseif(isset($stats) && isset($stats['cart_items_count'])) {
                                    // fallback للعدد القديم
                                    $cart_total_quantity = $stats['cart_items_count'];
                                }
                            @endphp
                            @if($cart_total_quantity > 0)
                                <span class="cart-badge">{{ $cart_total_quantity }}</span>
                            @endif
                        </a>
                    </div>

                    <!-- User Menu -->
                    <div class="nav-item dropdown user-dropdown" >
                        @auth
                            <a class="btn btn-outline-primary btn-sm dropdown-toggle user-toggle-btn" href="#" id="userDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false" >
                                <i class="fas fa-user-circle me-1"></i>
                                <span class="account-text">حسابي</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/dashboard"><i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم</a></li>
                                <li><a class="dropdown-item" href="/user/profile"><i class="fas fa-user me-2"></i>الملف الشخصي</a></li>
                                <li><a class="dropdown-item" href="/orders"><i class="fas fa-shopping-bag me-2"></i>طلباتي</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @else
                            <div class="auth-buttons">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">تسجيل الدخول</a>
                                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">إنشاء حساب</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Navbar End -->
