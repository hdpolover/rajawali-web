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
            <?php
            $roleId = session()->get('role_id');
            $menuModel = new \App\Models\MenuModel();
            $menuItems = $menuModel->getMenuByRole($roleId);
            echo renderMenu($menuItems);
            ?>
        </div>
    </div>
</div>

<script src="<?= base_url('templates/partials/sidebar.js') ?>"></script>