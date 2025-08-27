<!-- Footer -->
<link rel="stylesheet" href="{{ asset('assets/css/customer/news.css') }}">
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
                            <h4 class="">مصنع منتجات الأسنان</h4>
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

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
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

                <!-- Latest News -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-news">
                        <h5 class="footer-heading">أحدث الأخبار</h5>
                        <div class="latest-news">
                            @php
                                $latestNews = \App\Models\News::published()->latest()->limit(3)->get();
                            @endphp
                            @if($latestNews->count() > 0)
                                @foreach($latestNews as $article)
                                <div class="news-item">
                                    <a href="{{ route('news.show', $article->slug) }}" class="news-link">
                                        <h6 class="news-title">{{ Str::limit($article->title, 40) }}</h6>
                                        <small class="news-date">{{ $article->published_at->format('Y-m-d') }}</small>
                                    </a>
                                </div>
                                @endforeach
                                <div class="mt-2">
                                    <a href="{{ route('news.index') }}" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-newspaper ms-1"></i>جميع الأخبار
                                    </a>
                                </div>
                            @else
                                <p class="text-muted">لا توجد أخبار حالياً</p>
                            @endif
                        </div>
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
                                        $companyPhone = \App\Models\Setting::get('company_phone', '+20 567 234 890');
                                    @endphp
                                    <p>{{ $companyPhone }}</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="icon-container">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    @php
                                        $companyEmail = \App\Models\Setting::get('company_email', 'info@dentalproducts.com');
                                    @endphp
                                    <p>{{ $companyEmail }}</p>
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
