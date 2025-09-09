// Dashboard JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize dashboard animations
    initializeAnimations();
    
    // Initialize tooltips
    initializeTooltips();
    
    // Initialize stat cards animations
    initializeStatCards();
    
    // Initialize responsive behavior
    initializeResponsive();
    
    // Initialize auto-refresh for stats
    initializeAutoRefresh();
});

// Initialize animations for dashboard elements
function initializeAnimations() {
    // Add fade-in animation to stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });
    
    // Add slide-in animations to dashboard cards
    const dashboardCards = document.querySelectorAll('.dashboard-card');
    dashboardCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
        if (index % 2 === 0) {
            card.classList.add('slide-in-left');
        } else {
            card.classList.add('slide-in-right');
        }
    });
    
    // Add hover effects to interactive elements
    const interactiveElements = document.querySelectorAll('.order-item, .quick-action-btn');
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(-4px)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            });
    });
}

// Initialize tooltips for better UX
function initializeTooltips() {
    // Initialize Bootstrap tooltips if available
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
}

// Initialize stat cards with counter animations
function initializeStatCards() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    // Intersection Observer for counter animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });
    
    statNumbers.forEach(number => {
        observer.observe(number);
    });
}

// Animate counter numbers
function animateCounter(element) {
    const target = parseInt(element.textContent);
    const duration = 2000; // 2 seconds
    const step = target / (duration / 16); // 60 FPS
    let current = 0;
    
    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

// Initialize responsive behavior
function initializeResponsive() {
    // Handle mobile navigation for dashboard
    const mobileBreakpoint = 768;
    
    function handleResize() {
        const isMobile = window.innerWidth < mobileBreakpoint;
        
        // Adjust dashboard layout for mobile
        const dashboardCards = document.querySelectorAll('.dashboard-card');
        dashboardCards.forEach(card => {
            if (isMobile) {
                card.classList.add('mobile-layout');
            } else {
                card.classList.remove('mobile-layout');
            }
        });
        
        // Adjust stat cards layout
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            if (isMobile) {
                card.classList.add('mobile-stat');
            } else {
                card.classList.remove('mobile-stat');
            }
        });
    }
    
    // Initial check
    handleResize();
    
    // Listen for resize events
    window.addEventListener('resize', handleResize);
}

// Initialize auto-refresh for dashboard stats
function initializeAutoRefresh() {
    // Refresh stats every 5 minutes
    const refreshInterval = 5 * 60 * 1000; // 5 minutes
    
    setInterval(() => {
        refreshDashboardStats();
    }, refreshInterval);
}

// Refresh dashboard statistics
function refreshDashboardStats() {
    // Only refresh if page is visible
    if (document.hidden) return;
    
    fetch('/dashboard/stats', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        updateStatCards(data);
    })
    .catch(error => {
        console.log('Stats refresh failed:', error);
    });
}

// Update stat cards with new data
function updateStatCards(data) {
    // Update orders count
    const ordersCount = document.querySelector('.stat-orders .stat-number');
    if (ordersCount && data.orders_count !== undefined) {
        animateCounterUpdate(ordersCount, data.orders_count);
    }
    
    // Update cart items count
    const cartCount = document.querySelector('.stat-cart .stat-number');
    if (cartCount && data.cart_items_count !== undefined) {
        animateCounterUpdate(cartCount, data.cart_items_count);
    }
    
    // Update notifications count
    const notificationsCount = document.querySelector('.stat-notifications .stat-number');
    if (notificationsCount && data.unread_notifications !== undefined) {
        animateCounterUpdate(notificationsCount, data.unread_notifications);
    }
}

// Animate counter update
function animateCounterUpdate(element, newValue) {
    const currentValue = parseInt(element.textContent);
    if (currentValue === newValue) return;
    
    const duration = 1000;
    const step = (newValue - currentValue) / (duration / 16);
    let current = currentValue;
    
    const timer = setInterval(() => {
        current += step;
        if ((step > 0 && current >= newValue) || (step < 0 && current <= newValue)) {
            element.textContent = newValue;
            clearInterval(timer);
            
            // Add highlight effect
            element.parentElement.parentElement.classList.add('updated');
            setTimeout(() => {
                element.parentElement.parentElement.classList.remove('updated');
            }, 2000);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

// Handle quick action clicks
document.addEventListener('click', function(e) {
    // Handle quick action buttons
    if (e.target.closest('.quick-action-btn')) {
        const button = e.target.closest('.quick-action-btn');
        
        // Add click animation
        button.style.transform = 'scale(0.95)';
        setTimeout(() => {
            button.style.transform = '';
        }, 150);
    }
    
    // Handle stat card clicks
    if (e.target.closest('.stat-card')) {
        const card = e.target.closest('.stat-card');
        
        // Add click animation
        card.style.transform = 'scale(0.98)';
        setTimeout(() => {
            card.style.transform = '';
        }, 150);
    }
});

// Handle page visibility change
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        // Page became visible, refresh stats
        setTimeout(refreshDashboardStats, 1000);
    }
});

// Utility functions
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Error handling
window.addEventListener('error', function(e) {
    console.error('Dashboard error:', e.error);
});

// Performance monitoring
if ('performance' in window) {
    window.addEventListener('load', function() {
        setTimeout(() => {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            console.log('Dashboard load time:', loadTime + 'ms');
        }, 0);
    });
}