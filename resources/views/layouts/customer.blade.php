<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'مصنع منتجات الأسنان | منتجات أسنان عالية الجودة')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/customer/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer/layout.css') }}">
    @yield('styles')
    <style>
        .navbar-brand img {
            max-height: 85px;
            width: auto;
        }
        
        /* Force dropdown visibility */
        .dropdown {
            position: relative;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
            display: none;
            min-width: 200px;
            padding: 0.5rem 0;
            margin: 0;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
        }
        
        .dropdown-menu.show {
            display: block !important;
        }
        
        .dropdown-toggle::after {
            display: inline-block;
            margin-right: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-left: 0.3em solid transparent;
            border-bottom: 0;
            border-right: 0.3em solid transparent;
        }
        
        /* Prevent dropdown from being hidden by overflow */
        .navbar-collapse {
            overflow: visible !important;
        }
        
        .nav-item.dropdown {
            position: static;
        }
        
        @media (min-width: 992px) {
            .nav-item.dropdown {
                position: relative;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" type="button" aria-label="Toggle Sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg glass-navbar sticky-top">
        <div class="container-fluid">
            <!-- Logo positioned at the beginning -->
            <a class="navbar-brand logo-container" href="/">
                <img src="{{ asset('logo.png') }}" alt="مصنع منتجات الأسنان" class="img-fluid">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light btn-sm" href="#" id="mainMenuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-th-large ms-1"></i>القائمة الرئيسية
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="mainMenuDropdown">
                            <li><a class="dropdown-item {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="fas fa-home ms-1"></i>الرئيسية
                            </a></li>
                            <li><a class="dropdown-item {{ request()->is('services*') ? 'active' : '' }}" href="/services">
                                <i class="fas fa-cogs ms-1"></i>خدماتنا
                            </a></li>
                            <li><a class="dropdown-item {{ request()->is('products*') ? 'active' : '' }}" href="/products">
                                <i class="fas fa-tshirt ms-1"></i>المنتجات
                            </a></li>
                            <li><a class="dropdown-item {{ request()->is('news*') ? 'active' : '' }}" href="{{ route('news.index') }}">
                                <i class="fas fa-newspaper ms-1"></i>الأخبار
                            </a></li>
                            <li><a class="dropdown-item {{ request()->is('achievements*') ? 'active' : '' }}" href="{{ route('achievements.index') }}">
                                <i class="fas fa-trophy ms-1"></i>الإنجازات
                            </a></li>
                            @php
                                $companyProfilePage = \App\Models\Page::where('slug', 'company-profile')->published()->first();
                            @endphp
                            @if($companyProfilePage)
                            <li><a class="dropdown-item {{ request()->is('page/company-profile') ? 'active' : '' }}" href="{{ route('page.show', 'company-profile') }}">
                                <i class="fas fa-building ms-1"></i>الملف التعريفي للشركة
                            </a></li>
                            @endif
                            <li><a class="dropdown-item {{ request()->is('about*') ? 'active' : '' }}" href="/about">
                                <i class="fas fa-info-circle ms-1"></i>من نحن
                            </a></li>
                            <li><a class="dropdown-item {{ request()->is('contact*') ? 'active' : '' }}" href="/contact">
                                <i class="fas fa-envelope ms-1"></i>تواصل معنا
                            </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light btn-sm" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user ms-1"></i>حسابي
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item {{ request()->is('dashboard*') ? 'active' : '' }}" href="/dashboard">
                                <i class="fas fa-tachometer-alt ms-1"></i>لوحة التحكم
                            </a></li>
                            <li><a class="dropdown-item {{ request()->is('profile*') ? 'active' : '' }}" href="/user/profile">
                                <i class="fas fa-user-circle ms-1"></i>الملف الشخصي
                            </a></li>
                            <li><a class="dropdown-item {{ request()->is('orders*') ? 'active' : '' }}" href="/orders">
                                <i class="fas fa-clipboard-list ms-1"></i>طلباتي
                            </a></li>
                        </ul>
                    </li>
                </ul>
                <div class="nav-buttons d-flex align-items-center">
                    <a href="{{ route('news.index') }}" class="btn btn-link ms-2" title="الأخبار">
                        <i class="fas fa-newspaper"></i>
                        <span class="d-none d-md-inline">الأخبار</span>
                    </a>
                    <a href="{{ route('achievements.index') }}" class="btn btn-link ms-2" title="الإنجازات">
                        <i class="fas fa-trophy"></i>
                        <span class="d-none d-md-inline">الإنجازات</span>
                    </a>
                    <a href="/cart" class="btn btn-link position-relative ms-2">
                        <i class="fas fa-shopping-cart"></i>
                        @if($stats['cart_items_count'] > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $stats['cart_items_count'] }}
                        </span>
                        @endif
                    </a>
                    <a href="/notifications" class="btn btn-link position-relative ms-2">
                        <i class="fas fa-bell"></i>
                        @if($stats['unread_notifications'] > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $stats['unread_notifications'] }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-outline-primary ms-3"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt ms-1"></i>تسجيل الخروج
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-user-info">
            <h5 class="mb-2">{{ Auth::user()->name }}</h5>
            <span class="badge bg-primary">{{ Auth::user()->role === 'admin' ? 'مدير' : 'عميل' }}</span>
        </div>
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <i class="fas fa-home"></i>
                        لوحة التحكم
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="/products">
                        <i class="fas fa-shopping-bag"></i>
                        المنتجات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('news*') ? 'active' : '' }}" href="{{ route('news.index') }}">
                        <i class="fas fa-newspaper"></i>
                        الأخبار
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('achievements*') ? 'active' : '' }}" href="{{ route('achievements.index') }}">
                        <i class="fas fa-trophy"></i>
                        الإنجازات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" href="/orders">
                        <i class="fas fa-clipboard-list"></i>
                        الطلبات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cart*') ? 'active' : '' }}" href="/cart">
                        <i class="fas fa-shopping-cart"></i>
                        السلة
                        @if($stats['cart_items_count'] > 0)
                        <span class="badge bg-danger ms-auto">{{ $stats['cart_items_count'] }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('notifications*') ? 'active' : '' }}" href="/notifications">
                        <i class="fas fa-bell"></i>
                        الإشعارات
                        @if($stats['unread_notifications'] > 0)
                        <span class="badge bg-danger ms-auto">{{ $stats['unread_notifications'] }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="/user/profile">
                        <i class="fas fa-user"></i>
                        الملف الشخصي
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        تسجيل الخروج
                    </a>
                    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Then load Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Simple and effective dropdown fix
        $(document).ready(function() {
            // CSRF token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log('Initializing Bootstrap dropdowns...');

            // Simple Bootstrap dropdown initialization
            setTimeout(function() {
                // Remove any existing instances first
                document.querySelectorAll('.dropdown-toggle').forEach(function(element) {
                    const instance = bootstrap.Dropdown.getInstance(element);
                    if (instance) {
                        instance.dispose();
                    }
                });

                // Initialize all dropdowns
                const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
                const dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                    return new bootstrap.Dropdown(dropdownToggleEl);
                });

                console.log('Dropdowns initialized:', dropdownList.length);
            }, 100);

            // Backup: Manual click handling for stubborn dropdowns
            $(document).on('click', '.dropdown-toggle', function(e) {
                const $this = $(this);
                const $menu = $this.next('.dropdown-menu');
                
                // Toggle the dropdown menu manually
                if ($menu.hasClass('show')) {
                    $menu.removeClass('show');
                    $this.attr('aria-expanded', 'false');
                } else {
                    // Close other dropdowns first
                    $('.dropdown-menu.show').removeClass('show');
                    $('.dropdown-toggle[aria-expanded="true"]').attr('aria-expanded', 'false');
                    
                    // Open this dropdown
                    $menu.addClass('show');
                    $this.attr('aria-expanded', 'true');
                }
                
                e.preventDefault();
                e.stopPropagation();
            });

            // Close dropdowns when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu.show').removeClass('show');
                    $('.dropdown-toggle[aria-expanded="true"]').attr('aria-expanded', 'false');
                }
            });

            // Sidebar functionality
            const sidebar = $('.sidebar');
            const sidebarToggle = $('.sidebar-toggle');
            const mainContent = $('.main-content');
            const navbarHeight = $('.glass-navbar').outerHeight();

            // Set initial sidebar position
            sidebar.css('top', navbarHeight + 'px');
            sidebar.css('height', 'calc(100vh - ' + navbarHeight + 'px)');

            // Toggle sidebar
            sidebarToggle.on('click', function(e) {
                e.stopPropagation();
                sidebar.toggleClass('show');

                // Adjust main content margin for desktop
                if ($(window).width() >= 992) {
                    if (sidebar.hasClass('show')) {
                        mainContent.addClass('sidebar-open');
                    } else {
                        mainContent.removeClass('sidebar-open');
                    }
                }
            });

            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() < 992) {
                    if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('.sidebar-toggle').length) {
                        sidebar.removeClass('show');
                    }
                }
            });

            // Handle window resize
            $(window).resize(function() {
                const newNavbarHeight = $('.glass-navbar').outerHeight();
                sidebar.css('top', newNavbarHeight + 'px');
                sidebar.css('height', 'calc(100vh - ' + newNavbarHeight + 'px)');

                if ($(window).width() >= 992) {
                    sidebar.removeClass('show');
                    mainContent.removeClass('sidebar-open');
                } else {
                    mainContent.removeClass('sidebar-open');
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
