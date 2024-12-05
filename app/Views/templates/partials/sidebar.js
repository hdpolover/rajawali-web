// public/js/templates/partials/sidebar.js
document.addEventListener('DOMContentLoaded', function() {
    const submenus = document.querySelectorAll('.sidebar-item.has-sub');
    const currentPath = window.location.pathname;

    // Function to collapse all submenus except the one to keep open
    const collapseOtherSubmenus = (exception) => {
        submenus.forEach(item => {
            if (item !== exception) {
                item.classList.remove('active');
                const submenu = item.querySelector('.submenu');
                if (submenu) {
                    submenu.classList.remove('active');
                }
            }
        });
    };

    // Function to set active menu based on current URL
    const setActiveMenu = () => {
        const menuLinks = document.querySelectorAll('.sidebar-link, .submenu-link');
        menuLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPath) {
                link.classList.add('active');
                
                // If in submenu, expand the parent
                const submenuParent = link.closest('.sidebar-item.has-sub');
                if (submenuParent) {
                    submenuParent.classList.add('active');
                    const submenu = submenuParent.querySelector('.submenu');
                    if (submenu) {
                        submenu.classList.add('active');
                    }
                }
            }
        });
    };

    // Handle click events
    submenus.forEach(item => {
        const submenu = item.querySelector('.submenu');
        const link = item.querySelector('.sidebar-link');

        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Collapse all other submenus
            collapseOtherSubmenus(item);
            
            // Toggle the clicked menu
            item.classList.toggle('active');
            if (submenu) {
                submenu.classList.toggle('active');
            }
        });
    });

    // Set active menu on load
    setActiveMenu();
});