// Mega Menu JavaScript - Pure Vanilla JS

document.addEventListener('DOMContentLoaded', function() {
    // Get all mega menu items
    const megaMenuItems = document.querySelectorAll('.nav-item.mega-menu-item');
    
    // Only apply hover behavior on desktop (screen width > 991px)
    let isDesktop = window.innerWidth > 991;
    
    window.addEventListener('resize', function() {
        isDesktop = window.innerWidth > 991;
    });
    
    megaMenuItems.forEach(function(menuItem) {
        const menuPanel = menuItem.querySelector('.mega-menu-panel');
        let hideTimeout;
        
        if (isDesktop) {
            // Desktop: Hover behavior
            menuItem.addEventListener('mouseenter', function() {
                clearTimeout(hideTimeout);
                menuItem.classList.add('active');
                
                // Adjust panel position to prevent overflow
                if (menuPanel) {
                    adjustPanelPosition(menuItem, menuPanel);
                }
            });
            
            menuItem.addEventListener('mouseleave', function() {
                hideTimeout = setTimeout(function() {
                    menuItem.classList.remove('active');
                }, 150);
            });
        } else {
            // Mobile: Click behavior (optional, can be removed if hover only)
            const menuLink = menuItem.querySelector('.nav-link');
            menuLink.addEventListener('click', function(e) {
                e.preventDefault();
                // Close other menus
                megaMenuItems.forEach(function(item) {
                    if (item !== menuItem) {
                        item.classList.remove('active');
                    }
                });
                // Toggle current menu
                menuItem.classList.toggle('active');
            });
        }
    });
    
    // Handle accordion submenu expansion
    const expandableItems = document.querySelectorAll('.mega-menu-expandable');
    
    expandableItems.forEach(function(expandable) {
        expandable.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const submenuItem = this.closest('.mega-menu-submenu-item');
            
            // Close other submenus in the same panel (optional - remove if you want multiple open)
            const parentPanel = submenuItem.closest('.mega-menu-panel');
            if (parentPanel) {
                const siblings = parentPanel.querySelectorAll('.mega-menu-submenu-item');
                siblings.forEach(function(sibling) {
                    if (sibling !== submenuItem) {
                        sibling.classList.remove('open');
                    }
                });
            }
            
            // Toggle current submenu
            submenuItem.classList.toggle('open');
        });
    });
    
    // Close mega menus when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.mega-menu-item')) {
            megaMenuItems.forEach(function(item) {
                item.classList.remove('active');
            });
        }
    });
    
    // Function to adjust panel position to prevent overflow
    function adjustPanelPosition(menuItem, panel) {
        if (!isDesktop) return;
        
        // Reset positioning first
        panel.style.left = '';
        panel.style.right = '';
        
        // Use requestAnimationFrame to ensure DOM is updated
        requestAnimationFrame(function() {
            const rect = menuItem.getBoundingClientRect();
            const panelWidth = 280; // Fixed width from CSS
            const viewportWidth = window.innerWidth;
            const spaceOnRight = viewportWidth - rect.left;
            const spaceOnLeft = rect.left;
            
            // If panel would overflow on the right, align it to the right edge
            if (spaceOnRight < panelWidth && spaceOnLeft > spaceOnRight) {
                panel.style.right = '0';
                panel.style.left = 'auto';
            } else {
                panel.style.left = '0';
                panel.style.right = 'auto';
            }
            
            // Double-check after positioning
            requestAnimationFrame(function() {
                const panelRect = panel.getBoundingClientRect();
                if (panelRect.right > viewportWidth) {
                    const overflow = panelRect.right - viewportWidth;
                    panel.style.left = (panelRect.left - overflow) + 'px';
                    panel.style.right = 'auto';
                }
                if (panelRect.left < 0) {
                    panel.style.left = '0';
                    panel.style.right = 'auto';
                }
            });
        });
    }
    
    // Adjust on window resize
    window.addEventListener('resize', function() {
        if (isDesktop) {
            megaMenuItems.forEach(function(menuItem) {
                const menuPanel = menuItem.querySelector('.mega-menu-panel');
                if (menuItem.classList.contains('active') && menuPanel) {
                    adjustPanelPosition(menuItem, menuPanel);
                }
            });
        }
    });
});

