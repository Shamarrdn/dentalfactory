<!-- Navbar Start -->
<header class="dental-navbar">
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('logo.png') }}" alt="مصنع جينودينت" class="logo-img">
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
                        <a class="nav-link {{ request()->is('news*') ? 'active' : '' }}" href="{{ route('news.index') }}">الأخبار</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('achievements*') ? 'active' : '' }}" href="{{ route('achievements.index') }}">الإنجازات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ route('contact') }}">تواصل معنا</a>
                    </li>
                </ul>

                <div class="navbar-actions d-flex align-items-center">
                    <!-- User Dropdown -->
                    @auth
                        <div class="user-dropdown me-3" style="position: relative;">
                            <button class="btn btn-outline-primary btn-sm user-dropdown-toggle" type="button">
                                <i class="fas fa-user me-1"></i>حسابي
                                <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i>
                            </button>
                            <div class="user-dropdown-menu" style="
                                position: absolute;
                                top: 100%;
                                right: 0;
                                background: white;
                                border: 1px solid #ddd;
                                border-radius: 8px;
                                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                                min-width: 200px;
                                z-index: 1050;
                                display: none;
                                margin-top: 5px;
                            ">
                                <a href="/notifications" style="display: block; padding: 12px 16px; text-decoration: none; color: #333; border-bottom: 1px solid #f0f0f0;">
                                    <i class="fas fa-bell me-2" style="color: #007bff;"></i>الإشعارات
                                </a>
                                <a href="/user/profile" style="display: block; padding: 12px 16px; text-decoration: none; color: #333; border-bottom: 1px solid #f0f0f0;">
                                    <i class="fas fa-user me-2" style="color: #17a2b8;"></i>الملف الشخصي
                                </a>
                                @if(!auth()->user()->hasRole('admin'))
                                <a href="/orders" style="display: block; padding: 12px 16px; text-decoration: none; color: #333; border-bottom: 1px solid #f0f0f0;">
                                    <i class="fas fa-shopping-bag me-2" style="color: #28a745;"></i>طلباتي
                                </a>
                                @endif
                                <a href="{{ route('logout') }}" style="display: block; padding: 12px 16px; text-decoration: none; color: #dc3545; border-top: 1px solid #f0f0f0;"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endauth

                    <!-- Auth Buttons for Guests -->
                    @guest
                        <div class="nav-item d-flex align-items-center me-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">تسجيل الدخول</a>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">إنشاء حساب</a>
                        </div>
                    @endguest

                    <!-- Cart -->
                    <div class="nav-item d-flex align-items-center">
                        <a href="/cart" class="nav-icon position-relative" style="color: var(--primary);">
                            <i class="fas fa-shopping-cart"></i>
                            @php
                                // حساب العدد الكلي للمنتجات
                                $cart_total_quantity = 0;
                                
                                // أولاً جرب cartCount من ViewComposer
                                if(isset($cartCount)) {
                                    $cart_total_quantity = $cartCount;
                                }
                                // ثم جرب stats
                                elseif(isset($stats) && isset($stats['cart_items_details']) && is_array($stats['cart_items_details'])) {
                                    foreach($stats['cart_items_details'] as $item) {
                                        $cart_total_quantity += isset($item['quantity']) ? $item['quantity'] : 0;
                                    }
                                } elseif(isset($stats) && isset($stats['cart_items_count'])) {
                                    $cart_total_quantity = $stats['cart_items_count'];
                                }
                                
                                // Debug information
                                if(config('app.debug')) {
                                    \Log::info('Navbar cart count debug', [
                                        'cartCount' => $cartCount ?? 'not set',
                                        'stats' => $stats ?? 'not set',
                                        'cart_total_quantity' => $cart_total_quantity
                                    ]);
                                }
                            @endphp
                            <span class="cart-badge" style="
                                position: absolute;
                                top: -8px;
                                right: -8px;
                                background: #dc3545;
                                color: white;
                                border-radius: 50%;
                                width: 20px;
                                height: 20px;
                                font-size: 12px;
                                display: {{ $cart_total_quantity > 0 ? 'flex' : 'none' }};
                                align-items: center;
                                justify-content: center;
                                font-weight: bold;
                            " data-cart-count="{{ $cart_total_quantity }}">{{ $cart_total_quantity }}</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Navbar End -->
