<!-- app/Views/templates/partials/sidebar.php -->
<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <!-- <a href="<?= site_url() ?>" style="font-size: 1.5rem; font-weight: bold;">Rajawali Motor</a> -->
                    <img src="<?= base_url('images/logo_rajawali.png') ?>" alt="Rajawali Motor" style="width: 150px; height:auto;">
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <?php foreach ($menu_items as $index => $menu) : ?>
                    <?php
                    $hasSubmenu = count($menu->children) > 0;
                    ?>

                    <?php if ($hasSubmenu) : ?>
                        <li class="sidebar-item has-sub">
                            <a href="<?= site_url($menu->url) ?>" class="sidebar-link">
                                <i class="<?= $menu->icon ?>"></i>
                                <span><?= $menu->title ?></span>
                            </a>
                            <ul class="submenu">
                                <?php foreach ($menu->children as $child) : ?>
                                    <li class="submenu-item">
                                        <a href="<?= site_url($child->url) ?>" class="submenu-link"><?= $child->title ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="sidebar-item">
                            <a href="<?= site_url($menu->url) ?>" class="sidebar-link">
                                <i class="<?= $menu->icon ?>"></i>
                                <span><?= $menu->title ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // set active class to the current menu
        const currentUrl = '<?= current_url() ?>';
        const sidebarItems = document.querySelectorAll('.sidebar-item');

        // if sidebarItems does not have submenu and currentUrl is equal to the sidebar item URL, add active class
        sidebarItems.forEach(sidebarItem => {
            const sidebarLink = sidebarItem.querySelector('.sidebar-link');
            const sidebarLinkUrl = sidebarLink.getAttribute('href');

            // check if sidebar item has submenu
            const hasSubmenu = sidebarItem.classList.contains('has-sub');
            if (hasSubmenu) {
                const submenuItems = sidebarItem.querySelectorAll('.submenu-item .submenu-link');
                submenuItems.forEach(submenuItem => {
                    const submenuLinkUrl = submenuItem.getAttribute('href');
                    if (currentUrl === submenuLinkUrl) {
                        sidebarItem.classList.add('active');
                        submenuItem.parentElement.classList.add('active');
                    }
                });
            } else {
                if (currentUrl === sidebarLinkUrl) {
                    sidebarItem.classList.add('active');
                }
            }
        });

    });
</script>