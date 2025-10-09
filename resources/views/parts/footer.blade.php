<!-- Footer -->
<footer class="footer-2025">
    <div class="footer-content">
        <div class="container">
            <div class="row g-4">
                <!-- Company Brand -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <div class="footer-logo-icon">
                                <img src="{{ asset('logo.png') }}" alt="Logo" width="600" height="600">
                            </div>
                            <h4 class="">مصنع جينودينت</h4>
                        </div>
                        <p class="footer-description">
                            مصنع سعودي متخصص في إنتاج مواد طب الأسنان الأساسية في منطقة عسير، نوفر منتجات الترميم والوقاية بجودة عالية وأسعار تنافسية
                        </p>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/profile.php?id=61581506953386&mibextid=ZbWKwL" target="_blank" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://x.com/genodents?s=09" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/genodents?igsh=MXNsY3M3NjRiMjFwbA==" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@genodents" target="_blank" class="social-link"><i class="fab fa-youtube"></i></a>
                            <a href="https://wa.me/message/CVTU4PJKKZSSN1" target="_blank" class="social-link"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-5 col-md-6">
                    <div class="footer-links">
                        <h5 class="footer-heading">روابط سريعة</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li><a href="{{ route('about') }}">من نحن</a></li>
                            <li><a href="{{ route('services') }}">منتجاتنا</a></li>
                            <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
                        </ul>
                    </div>

                    <!-- Policies -->
                    <div class="footer-links mt-4">
                        <h5 class="footer-heading">السياسات</h5>
                        <ul class="list-unstyled">
                            @php
                                $policyPages = \App\Models\Page::published()
                                    ->whereIn('slug', ['refund-policy', 'cancellation-policy', 'privacy-policy'])
                                    ->get();
                            @endphp
                            @foreach($policyPages as $page)
                                <li><a href="{{ route('page.show', $page->slug) }}">{{ $page->title }}</a></li>
                            @endforeach
                            <li><a href="{{ route('policy') }}">شروط الاستخدام</a></li>
                        </ul>
                    </div>
                </div>


                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-contact">
                        <h5 class="footer-heading">اتصل بنا</h5>
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="icon-container">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-text">
                                    @php
                                        $companyAddress = \App\Models\Setting::get('company_address', 'مصر الجديدة، شارع حسن حسين');
                                        $googleMapsUrl = \App\Models\Setting::get('google_maps_url', '');
                                    @endphp
                                    <p>{{ $companyAddress }}</p>
                                    @if($googleMapsUrl)
                                        <a href="{{ $googleMapsUrl }}" target="_blank" class="maps-link">
                                            <i class="fas fa-external-link-alt"></i> عرض على الخريطة
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon-container">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-text">
                                    @php
                                        $companyPhone = \App\Models\Setting::get('company_phone', '+966 54 411 7002');
                                    @endphp
                                    <p>{!! format_phone_numbers($companyPhone, '<br>') ?: $companyPhone !!}</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon-container">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    @php
                                        $companyEmail = \App\Models\Setting::get('company_email', 'Genodent.1@gmail.com');
                                        $displayEmails = format_email_addresses($companyEmail, '<br>') ?: $companyEmail;
                                    @endphp
                                    <p>{!! $displayEmails !!}</p>
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
                <p>© {{ date('Y') }} مصنع جينودينت. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </div>
</footer>
