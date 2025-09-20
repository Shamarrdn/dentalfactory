<script>
$(document).ready(function() {
    // CSRF token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Simple dropdown toggle
    $('.user-dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const menu = $('.user-dropdown-menu');
        const isVisible = menu.is(':visible');
        
        if (isVisible) {
            menu.hide();
            $(this).find('.fa-chevron-down').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        } else {
            menu.show();
            $(this).find('.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        }
        
        console.log('User dropdown toggled:', !isVisible);
    });

    // Close dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.user-dropdown').length) {
            $('.user-dropdown-menu').hide();
            $('.user-dropdown-toggle .fa-chevron-up').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
    });

    // Add hover effects
    $('.user-dropdown-menu a').hover(
        function() {
            $(this).css('background-color', '#f8f9fa');
        },
        function() {
            $(this).css('background-color', 'white');
        }
    );

    // Function to update cart count in navbar
    window.updateCartCount = function(count) {
        console.log('Updating cart count to:', count);
        const cartBadge = document.querySelector('.cart-badge');
        if (cartBadge) {
            cartBadge.textContent = count;
            if (count > 0) {
                cartBadge.style.display = 'flex';
                console.log('Cart badge shown with count:', count);
            } else {
                cartBadge.style.display = 'none';
                console.log('Cart badge hidden');
            }
        } else {
            console.log('Cart badge element not found');
        }
        
        // Update all cart count elements
        document.querySelectorAll('.cart-count').forEach(element => {
            element.textContent = count;
        });
    };

    // Function to load cart count on page load
    window.loadCartCount = function() {
        fetch('/cart/count', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Cart count data:', data);
            if (data.success) {
                updateCartCount(data.count);
            }
        })
        .catch(error => {
            console.error('Error loading cart count:', error);
        });
    };

    // Load cart count on page load
    loadCartCount();
    
    // Also try to get initial count from data attribute
    const initialCartBadge = document.querySelector('.cart-badge');
    if (initialCartBadge) {
        const initialCount = parseInt(initialCartBadge.getAttribute('data-cart-count')) || 0;
        if (initialCount > 0) {
            updateCartCount(initialCount);
        }
    }
    
    // Listen for any button clicks to refresh cart count
    $(document).on('click', 'button, .btn, input[type="submit"], .add-to-cart, .update-cart, .remove-from-cart', function() {
        // Small delay to allow the action to complete
        setTimeout(function() {
            loadCartCount();
        }, 500);
    });
    
    // Listen for form submissions
    $(document).on('submit', 'form', function() {
        setTimeout(function() {
            loadCartCount();
        }, 1000);
    });
    
    // Listen for Livewire events
    document.addEventListener('livewire:updated', function() {
        setTimeout(function() {
            loadCartCount();
        }, 300);
    });
    
    // Listen for AJAX requests completion
    $(document).ajaxComplete(function() {
        setTimeout(function() {
            loadCartCount();
        }, 200);
    });
    
    // Listen for fetch requests (modern AJAX)
    const originalFetch = window.fetch;
    window.fetch = function(...args) {
        return originalFetch.apply(this, args).then(response => {
            // Check if it's a cart-related request
            if (args[0] && (args[0].includes('/cart/') || args[0].includes('/add-to-cart'))) {
                setTimeout(function() {
                    loadCartCount();
                }, 300);
            }
            return response;
        });
    };
    
    // Listen for page navigation (Turbo/Livewire navigation)
    document.addEventListener('turbo:load', function() {
        loadCartCount();
    });
    
    // Listen for page visibility change (when user comes back to tab)
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            loadCartCount();
        }
    });
    
    // Periodic refresh every 30 seconds (as backup)
    setInterval(function() {
        loadCartCount();
    }, 30000);
    
    // Listen for custom cart events
    document.addEventListener('cartUpdated', function() {
        loadCartCount();
    });
    
    document.addEventListener('cartItemAdded', function() {
        loadCartCount();
    });
    
    document.addEventListener('cartItemRemoved', function() {
        loadCartCount();
    });
    
    // Listen for any click on cart-related elements
    $(document).on('click', '[data-cart-action], .cart-action, [href*="cart"], [href*="add-to-cart"]', function() {
        setTimeout(function() {
            loadCartCount();
        }, 500);
    });
    
    // Listen specifically for cart quantity buttons (+ and -)
    $(document).on('click', '.quantity-btn, .btn-quantity, .quantity-increase, .quantity-decrease, .cart-quantity-btn', function() {
        console.log('Cart quantity button clicked');
        setTimeout(function() {
            loadCartCount();
        }, 300);
    });
    
    // Listen for "Add all to cart" buttons
    $(document).on('click', '.add-all-to-cart, [wire\\:click*="addAllToCart"], .btn-add-all', function() {
        console.log('Add all to cart button clicked');
        setTimeout(function() {
            loadCartCount();
        }, 800);
    });
    
    // Listen for Livewire wire:click events
    $(document).on('click', '[wire\\:click]', function() {
        const wireClick = $(this).attr('wire:click');
        if (wireClick && (wireClick.includes('addToCart') || wireClick.includes('addAllToCart') || wireClick.includes('updateQuantity'))) {
            console.log('Livewire cart action clicked:', wireClick);
            setTimeout(function() {
                loadCartCount();
            }, 600);
        }
    });
});
</script>