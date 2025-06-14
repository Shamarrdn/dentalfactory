<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('parts.head')
    <title>@yield('title', 'مصنع منتجات الأسنان')</title>
    @yield('styles')
</head>
<body>
    @include('parts.navbar')

    @yield('content')

    @include('parts.footer')

    @include('parts.scripts')
    @include('parts.navbar-scripts')

    @yield('scripts')
</body>
</html>
