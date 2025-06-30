<nav class="navbar-simple">
    <div class="container">
        <a class="navbar-brand-simple" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="logo-img">
        </a>

        <ul class="nav-list" id="navList">
            <li class="nav-item-simple">
                <a class="nav-link-simple {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">الرئيسية</a>
            </li>
            <li class="nav-item-simple">
                <a class="nav-link-simple {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">من نحن</a>
            </li>
            <li class="nav-item-simple">
                <a class="nav-link-simple {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">المنتجات</a>
            </li>
            <li class="nav-item-simple">
                <a class="nav-link-simple {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">خدماتنا</a>
            </li>
            <li class="nav-item-simple">
                <a class="nav-link-simple {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">اتصل بنا</a>
            </li>
            <li class="nav-item-simple">
                <a href="{{ route('cart.index') }}" class="nav-link-simple cart-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">{{ $cartCount }}</span>
                </a>
            </li>
            <li class="mobile-buttons" style="width:100%; display:none;">
                @auth
                    <a class="nav-link-simple" href="{{ route('dashboard') }}">لوحة التحكم</a>
                    <form method="POST" action="{{ route('logout') }}" style="width:100%;">
                        @csrf
                        <button class="nav-link-simple" type="submit" style="background:none;border:none;width:100%;text-align:right;">تسجيل الخروج</button>
                    </form>
                @else
                    <a class="nav-link-simple" href="{{ route('login') }}">تسجيل الدخول</a>
                    <a class="nav-link-simple" href="{{ route('register') }}">تسجيل جديد</a>
                @endauth
            </li>
        </ul>

        <div class="nav-buttons">
            @auth
                <div class="dropdown">
                    <a href="#" class="login-button dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>لوحة التحكم</span>
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">لوحة التحكم</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">تسجيل الخروج</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="dropdown">
                    <a href="#" class="login-button dropdown-toggle" id="guestDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>تسجيل الدخول</span>
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="guestDropdown">
                        <li><a class="dropdown-item" href="{{ route('login') }}">تسجيل الدخول</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">تسجيل جديد</a></li>
                    </ul>
                </div>
            @endauth
            <a href="{{ route('products.index') }}" class="cta-button">
                <span>اطلب الآن</span>
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <button class="mobile-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>
