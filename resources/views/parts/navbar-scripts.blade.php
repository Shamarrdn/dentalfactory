<script>
    document.addEventListener('DOMContentLoaded', function() {
                // جعل النافبار ثابت المظهر بغض النظر عن التمرير
        const navbar = document.querySelector('.dental-navbar');

        // جعل النافبار دائماً في وضع scrolled منذ البداية
        navbar.classList.add('navbar-scrolled');

        // 2. استخدام آلية Bootstrap الأصلية للقوائم المنسدلة والتوجيل
        // تهيئة كائن Collapse للقائمة المحمولة من Bootstrap
        const navbarCollapse = document.getElementById('dentalNavbar');
        if (navbarCollapse) {
            const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                toggle: false
            });

            // زر فتح/إغلاق القائمة
            const navbarToggler = document.querySelector('.navbar-toggler');
            if (navbarToggler) {
                navbarToggler.addEventListener('click', function(e) {
                    // تبديل حالة القائمة باستخدام API الخاص بـ Bootstrap
                    if (navbarCollapse.classList.contains('show')) {
                        bsCollapse.hide();
                    } else {
                        bsCollapse.show();
                    }
                });
            }

            // إغلاق القائمة عند النقر على أي رابط فيها
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (navbarCollapse.classList.contains('show')) {
                        bsCollapse.hide();
                    }
                });
            });

            // إغلاق القائمة عند النقر خارجها
            document.addEventListener('click', function(e) {
                if (navbarCollapse.classList.contains('show') &&
                    !navbarCollapse.contains(e.target) &&
                    !navbarToggler.contains(e.target)) {
                    bsCollapse.hide();
                }
            });
        }

        // 3. إعداد Dropdowns للموبايل بطريقة أبسط
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            // استخدام آلية Bootstrap الأصلية للقوائم المنسدلة
            const dropdown = new bootstrap.Dropdown(toggle);

            // منع النقر على القائمة المنسدلة من إغلاقها في الموبايل
            const menu = toggle.nextElementSibling;
            if (menu) {
                menu.addEventListener('click', function(e) {
                    if (window.innerWidth < 992 && e.target.classList.contains('dropdown-item')) {
                        e.stopPropagation();
                    }
                });
            }
        });
    });
</script>
