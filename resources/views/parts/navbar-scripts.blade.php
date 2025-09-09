<script>
// Bootstrap 5 تهيئة صحيحة
document.addEventListener('DOMContentLoaded', function() {
    // إضافة كلاس navbar-scrolled
    const navbar = document.querySelector('.dental-navbar');
    if (navbar) {
        navbar.classList.add('navbar-scrolled');
    }
    
    console.log('Navbar initialized');
    
    // Bootstrap 5 بيهيئ الـ dropdowns تلقائياً من الـ data-bs-toggle
    // لكن عشان نتأكد، هنهيئها يدوياً
    setTimeout(function() {
        const dropdownElements = document.querySelectorAll('.dropdown-toggle');
        dropdownElements.forEach(function(element) {
            if (!bootstrap.Dropdown.getInstance(element)) {
                new bootstrap.Dropdown(element);
            }
        });
        console.log('Dropdowns force-initialized:', dropdownElements.length);
    }, 200);
});
</script>