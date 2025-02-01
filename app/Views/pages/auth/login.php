<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Bengkel Rajawali Motor</title>

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
                    <div class="d-flex flex-column justify-content-center h-100 py-1">
                        <div class="auth-logo mb-3">
                            <a href="<?= site_url() ?>"><img src="<?= base_url('images/logo_rajawali.png') ?>" alt="logo" style="width: 150px; height: auto;"></a>
                        </div>

                        <!-- <p class="auth-title">Selamat Datang Kembali.</p> -->
                        <br>
                        <p class="auth-subtitle mb-5" style="font-weight:bold; color:black;">Selamat Datang.</p>

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
                                    class="form-control form-control-xl <?= session()->getFlashdata('errors.email') ? 'is-invalid' : '' ?>"
                                    name="email"
                                    placeholder="email"
                                    value="<?= old('email') ?>"
                                    required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                                <?php if (session()->getFlashdata('errors.email')) : ?>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('errors.email') ?>
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
                                    Ingat saya
                                </label>
                            </div>

                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2" type="submit" id="loginBtn">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                Masuk
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img src="<?= base_url('images/foto_depan.heic') ?>" alt="Foto Depan" class="img-fluid w-100 h-100" style="object-fit: cover;">
                </div>
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