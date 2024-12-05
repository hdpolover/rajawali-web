<!-- app/Views/templates/partials/header.php -->
<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Notifications -->
                <ul class="navbar-nav ms-auto mb-lg-0">

                    <li class="nav-item dropdown me-3">
                        <a
                            class="nav-link active dropdown-toggle text-gray-600"
                            href="#"
                            data-bs-toggle="dropdown"
                            data-bs-display="static"
                            aria-expanded="false">
                            <i class="bi bi-bell bi-sub fs-4"></i>
                            <span class="badge badge-notification bg-danger">7</span>
                        </a>
                        <ul
                            class="dropdown-menu dropdown-center dropdown-menu-sm-end notification-dropdown"
                            aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-header">
                                <h6>Notifications</h6>
                            </li>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center" href="#">
                                    <div class="notification-icon bg-primary">
                                        <i class="bi bi-cart-check"></i>
                                    </div>
                                    <div class="notification-text ms-4">
                                        <p class="notification-title font-bold">
                                            Successfully check out
                                        </p>
                                        <p class="notification-subtitle font-thin text-sm">
                                            Order ID #256
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center" href="#">
                                    <div class="notification-icon bg-success">
                                        <i class="bi bi-file-earmark-check"></i>
                                    </div>
                                    <div class="notification-text ms-4">
                                        <p class="notification-title font-bold">
                                            Homework submitted
                                        </p>
                                        <p class="notification-subtitle font-thin text-sm">
                                            Algebra math homework
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <p class="text-center py-2 mb-0">
                                    <a href="#">See all notification</a>
                                </p>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- User Menu -->
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600"><?= session()->get('username') ?></h6>
                                <p class="mb-0 text-sm text-gray-600"><?= session()->get('role') ?></p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="<?= base_url('mazer/assets/compiled/jpg/1.jpg') ?>">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 11rem;">
                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    .notification-dropdown .notification-item {
        padding: .7rem 1rem;
        border-bottom: 1px solid #f8f9fa;
    }

    .notification-dropdown .notification-item:last-child {
        border-bottom: none;
    }

    .notification-dropdown .notification-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notification-dropdown .notification-icon i {
        color: #fff;
        font-size: 1.2rem;
    }

    .notification-dropdown .notification-title {
        font-size: .875rem;
        color: #333;
        margin-bottom: .25rem;
    }

    .notification-dropdown .notification-subtitle {
        font-size: .75rem;
        color: #6c757d;
        margin-bottom: .25rem;
    }

    .notification-dropdown .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-dropdown .notification-item a {
        text-decoration: none;
        color: inherit;
    }

    .nav-link .badge {
        font-size: .65rem;
        padding: 0.25em 0.6em;
        transform: translate(25%, -25%);
    }
</style>