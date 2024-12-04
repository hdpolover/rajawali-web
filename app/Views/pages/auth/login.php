<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bengkel Rajawali Motor</title>
    
    <link rel="shortcut icon" href="<?= base_url('mazer/assets/compiled/svg/favicon.svg') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('mazer/assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('mazer/assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('mazer/assets/compiled/css/auth.css') ?>">
</head>

<body>
    <script src="<?= base_url('mazer/assets/static/js/initTheme.js') ?>"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo mb-4">
                        <a href="<?= site_url() ?>"><img src="<?= base_url('mazer/assets/compiled/svg/logo.svg') ?>" alt="Logo"></a>
                    </div>

                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-4">Welcome back! Please login to continue.</p>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <form action="<?= site_url('login') ?>" method="POST" id="loginForm">
                        <?= csrf_field() ?>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" 
                                   class="form-control form-control-xl <?= session()->getFlashdata('errors.username') ? 'is-invalid' : '' ?>" 
                                   name="username" 
                                   placeholder="Username"
                                   value="<?= old('username') ?>" 
                                   required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <?php if (session()->getFlashdata('errors.username')) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors.username') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" 
                                   class="form-control form-control-xl <?= session()->getFlashdata('errors.password') ? 'is-invalid' : '' ?>" 
                                   name="password" 
                                   placeholder="Password" 
                                   required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <?php if (session()->getFlashdata('errors.password')) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors.password') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-check form-check-lg d-flex align-items-end mb-4">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-gray-600" for="remember">
                                Keep me logged in
                            </label>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit" id="loginBtn">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            Sign In
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            const spinner = btn.querySelector('.spinner-border');
            btn.disabled = true;
            spinner.classList.remove('d-none');
        });
    </script>
</body>
</html>