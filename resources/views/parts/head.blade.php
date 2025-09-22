<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="مصنع جينودينت - منتجات عالية الجودة بأحدث التقنيات">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Animate CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<!-- AOS Animation -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset(path: 'assets/css/dental-css/style.css') }}?t={{ time() }}">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Cairo', sans-serif;
        background-color: #ffffff !important;
        background: #ffffff !important;
        /* Hide scrollbars but keep functionality */
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    body::-webkit-scrollbar {
        display: none;
    }
    
    html {
        background-color: #ffffff !important;
        background: #ffffff !important;
        /* Hide scrollbars */
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    html::-webkit-scrollbar {
        display: none;
    }
    
    .container, .container-fluid {
        background: transparent !important;
    }
    
    /* Navbar Styles */
    .glass-navbar {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }
    
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
    
    .nav-buttons .btn {
        color: #666;
        text-decoration: none;
    }
    
    .nav-buttons .btn:hover {
        color: #007bff;
    }
    
    .navbar-nav .nav-link {
        font-weight: 500;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        color: #333;
    }
    
    .dropdown-item:hover,
    .dropdown-item.active {
        background-color: #f8f9fa;
        color: #007bff;
    }
</style>
