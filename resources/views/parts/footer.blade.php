<!-- Footer -->
<footer class="footer-2025">
    <div class="footer-content">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <div class="footer-logo-icon">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/tooth.png" alt="Logo">
                            </div>
                            <h4 class="footer-logo-text">مصنع منتجات الأسنان</h4>
                        </div>
                        <p class="footer-description">
                            نصنع أفضل منتجات طب الأسنان بأحدث التقنيات العالمية لضمان أعلى مستويات الجودة والكفاءة
                        </p>
                        <div class="footer-social">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-links">
                        <h5 class="footer-heading">روابط سريعة</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li><a href="{{ route('about') }}">من نحن</a></li>
                            <li><a href="{{ route('services') }}">منتجاتنا</a></li>
                            <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="footer-contact">
                        <h5 class="footer-heading">اتصل بنا</h5>
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="icon-container">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <p>123 شارع الصناعة، المنطقة الصناعية</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon-container">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <p>+1 234 567 890</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon-container">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    <p>info@dentalproducts.com</p>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright">
                <p>© {{ date('Y') }} مصنع منتجات الأسنان. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </div>
</footer>
