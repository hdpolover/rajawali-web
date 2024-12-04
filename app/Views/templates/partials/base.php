<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkel Rajawali Admin</title>

    <link rel="shortcut icon" href="<?= base_url('mazer/assets/compiled/svg/favicon.svg') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('mazer/assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('mazer/assets/compiled/css/app-dark.css') ?>">
</head>

<body>
    <div id="app">
        <?= $this->include('templates/partials/sidebar') ?>

        <div id="main" class='layout-navbar navbar-fixed'>
            <?= $this->include('templates/partials/header') ?>

            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3><?= $title ?? 'Dashboard' ?></h3>
                            </div>
                        </div>
                    </div>
                    <?= $this->renderSection('content') ?>
                </div>

                <?= $this->include('templates/partials/footer') ?>
            </div>
        </div>
    </div>

    <script src="<?= base_url('mazer/assets/static/js/components/dark.js') ?>"></script>
    <script src="<?= base_url('mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('mazer/assets/compiled/js/app.js') ?>"></script>
    <?= $this->renderSection('js') ?>
</body>

</html>