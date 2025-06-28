<script>
    // تم تعطيل تغيير كلاس scrolled للنافبار
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menuToggle');
        const navList = document.getElementById('navList');

        if (menuToggle && navList) {
            menuToggle.addEventListener('click', function() {
                navList.classList.toggle('show');
                this.querySelector('i').classList.toggle('fa-bars');
                this.querySelector('i').classList.toggle('fa-times');
            });

            const navLinks = document.querySelectorAll('.nav-link-simple');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        navList.classList.remove('show');
                        menuToggle.querySelector('i').classList.add('fa-bars');
                        menuToggle.querySelector('i').classList.remove('fa-times');
                    }
                });
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    navList.classList.remove('show');
                    menuToggle.querySelector('i').classList.add('fa-bars');
                    menuToggle.querySelector('i').classList.remove('fa-times');
                }
            });
        }
    });
</script>
