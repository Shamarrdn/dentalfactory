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
            <li class="mobile-buttons" style="width:100%; display:none;">
                @auth
                    <div class="dropdown" style="width:100%;">
                        <a href="#" class="mobile-login-button dropdown-toggle" id="userDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false">
                            لوحة التحكم <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdownMobile">
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
                    <div class="d-flex flex-column gap-2" style="width:100%;">
                        <a href="{{ route('login') }}" class="login-button"><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</a>
                        <a href="{{ route('register') }}" class="cta-button"><i class="fas fa-user-plus"></i> تسجيل جديد</a>
                    </div>
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
