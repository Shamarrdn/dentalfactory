document.addEventListener('DOMContentLoaded', function() {
    const orderForm = document.querySelector('.order-form');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitIcon = document.getElementById('submitIcon');

    if (orderForm && submitBtn) {
        orderForm.addEventListener('submit', function() {
            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'جاري الإرسال...';
            submitIcon.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            submitBtn.classList.add('disabled');
        });
    }

    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(toast => {
        // Add fade-in animation
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';

        setTimeout(() => {
            toast.style.transition = 'all 0.3s ease-in-out';
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(0)';
        }, 100);

        // Auto-hide after 5 seconds
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 5000);
    });

    // Add click to dismiss functionality
    toasts.forEach(toast => {
        const closeBtn = toast.querySelector('.btn-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            });
        }
    });

    // Products Carousel - initialize only if jQuery and owl carousel are available
    if (typeof jQuery !== 'undefined') {
        // Use jQuery safely now
        jQuery(document).ready(function($) {
            if ($.fn.owlCarousel) {
                const $carousel = $('.products-carousel');
                if ($carousel.length) {
                    $carousel.owlCarousel({
                        rtl: true,
                        loop: true,
                        margin: 20,
                        nav: true,
                        dots: true,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        smartSpeed: 600,
                        fluidSpeed: 600,
                        autoplaySpeed: 600,
                        navSpeed: 600,
                        dotsSpeed: 600,
                        dragEndSpeed: 600,
                        responsive: {
                            0: {
                                items: 1,
                                margin: 10
                            },
                            576: {
                                items: 2,
                                margin: 15
                            },
                            992: {
                                items: 3,
                                margin: 20
                            },
                            1200: {
                                items: 4,
                                margin: 20
                            }
                        },
                        navText: [
                            "<i class='fas fa-chevron-right'></i>",
                            "<i class='fas fa-chevron-left'></i>"
                        ]
                    });

                    console.log('Owl Carousel initialized successfully');
                } else {
                    console.log('Carousel not found in the page');
                }
            } else {
                console.log('Owl Carousel plugin not available');
            }
        });
    } else {
        console.log('jQuery not available');
    }

    // Scroll Animations
    const fadeObserverOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const fadeObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, fadeObserverOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        fadeObserver.observe(el);
    });

    // Enhanced Counter Animation
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000;
        const startTime = performance.now();

        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function for smooth animation
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const current = Math.floor(target * easeOutQuart);

            element.textContent = current.toLocaleString();

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString();
            }
        }

        requestAnimationFrame(updateCounter);
    }

    // Enhanced Stats Section Observer
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('[data-count]');

                // Animate counters
                counters.forEach((counter, index) => {
                    setTimeout(() => {
                        animateCounter(counter);
                    }, index * 200);
                });

                // Add entrance animation to stat cards
                const statCards = entry.target.querySelectorAll('.stat-card');
                statCards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(50px)';

                    setTimeout(() => {
                        card.style.transition = 'all 0.8s cubic-bezier(0.23, 1, 0.32, 1)';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 150);
                });

                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Product Card Hover Effects
    document.querySelectorAll('.product-card-modern').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Mobile Menu Enhancement
    const navbarToggler = document.querySelector('.navbar-toggler');
    if (navbarToggler) {
        navbarToggler.addEventListener('click', function() {
            const navbar = document.querySelector('.navbar');
            setTimeout(() => {
                if (document.querySelector('.navbar-collapse').classList.contains('show')) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                } else {
                    navbar.style.background = '';
                }
            }, 100);
        });
    }

    // Parallax Effect for Hero Section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroBg = document.querySelector('.hero-bg');
        if (heroBg) {
            heroBg.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Product Image Hover Effect
    document.querySelectorAll('.product-icon-wrapper').forEach(image => {
        image.addEventListener('mouseenter', function() {
            const overlay = this.querySelector('.product-overlay');
            const actions = this.querySelectorAll('.action-btn');

            actions.forEach((btn, index) => {
                setTimeout(() => {
                    btn.style.transform = 'translateY(0) scale(1)';
                }, index * 100);
            });
        });

        image.addEventListener('mouseleave', function() {
            const actions = this.querySelectorAll('.action-btn');
            actions.forEach(btn => {
                btn.style.transform = 'translateY(20px) scale(0.8)';
            });
        });
    });

    // Add some interactive particles to hero section
    function createParticle() {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(38, 224, 127, 0.3);
            border-radius: 50%;
            pointer-events: none;
            animation: float 15s linear infinite;
        `;

        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 15 + 's';

        const heroSection = document.querySelector('.hero-bg-image-section');
        if (heroSection) {
            heroSection.appendChild(particle);

            setTimeout(() => {
                particle.remove();
            }, 15000);
        }
    }

    // Create particles periodically
    setInterval(createParticle, 3000);

    console.log('Dental Products Website Loaded Successfully! 🚀');
});

// Counter Animation
const counters = document.querySelectorAll('.counter');
counters.forEach(counter => {
    const targetValue = parseInt(counter.textContent);
    let currentValue = 0;
    const duration = 2000; // ms
    const interval = 50; // ms
    const increment = Math.ceil(targetValue / (duration / interval));

    const counterAnimation = setInterval(() => {
        currentValue += increment;
        if (currentValue >= targetValue) {
            currentValue = targetValue;
            clearInterval(counterAnimation);
        }
        counter.textContent = currentValue;
    }, interval);
});

// Hero Image Parallax Effect
const heroImage = document.querySelector('.hero-image');
if (heroImage) {
    window.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const { innerWidth, innerHeight } = window;

        const x = (clientX / innerWidth - 0.5) * 20;
        const y = (clientY / innerHeight - 0.5) * 20;

        heroImage.style.transform = `translate(${x}px, ${y}px)`;
    });
}

// Floating Badges Animation
const floatingBadges = document.querySelectorAll('.floating-badge');
floatingBadges.forEach(badge => {
    badge.addEventListener('mouseenter', function() {
        this.style.animationPlayState = 'paused';
    });

    badge.addEventListener('mouseleave', function() {
        this.style.animationPlayState = 'running';
    });
});
