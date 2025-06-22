<nav class="navbar-simple">
    <div class="container">
        <a class="navbar-brand-simple" href="{{ route('home') }}">
            <div class="brand-logo">
                <img src="https://img.icons8.com/ios-filled/50/tooth.png" alt="Logo">
            </div>

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
        </ul>

        <div class="nav-buttons">
            <a href="{{ route('login') }}" class="login-button">
                <span>تسجيل الدخول</span>
                <i class="fas fa-user"></i>
            </a>
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

