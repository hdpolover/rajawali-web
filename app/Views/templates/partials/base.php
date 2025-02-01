<!-- app/Views/templates/partials/base.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkel Rajawali Admin - <?= esc($title) ?></title>

    <link rel="shortcut icon" href="<?= base_url('mazer/assets/compiled/svg/favicon.svg') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('mazer/assets/compiled/css/app.css') ?>">
    <!-- <link rel="stylesheet" href="<?= base_url('mazer/assets/compiled/css/app-dark.css') ?>"> -->

    <link rel="stylesheet"
        href="<?= base_url("mazer/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css") ?>" />

    <link rel="stylesheet" crossorigin href="<?= base_url("mazer/assets/compiled/css/table-datatable-jquery.css") ?>" />

    <!-- Select2 CSS -->
    <link rel="stylesheet" type="text/css" href="/select2/dist/css/select2.min.css" />

     <!-- Select2 JS -->
     <script type="text/javascript" src="/jquery-3.7.1.min.js"></script>

    <!-- Select2 JS -->
    <script type="text/javascript" src="/select2/dist/js/select2.min.js"></script>

    <!-- Include Quagga JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/decoder.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js.map"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/decoder.js.map"></script>

    <!-- Include Webcam.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    <!-- Include JsBarcode -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
</head>

<body>
    <div id="app">
        <?= $this->include('templates/partials/sidebar') ?>

        <div id="main" class="layout-navbar navbar-fixed">
            <?= $this->include('templates/partials/header') ?>

            <div id="main-content">

                <?= $this->include('templates/partials/alert') ?>

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3><?= esc($title) ?? 'Dashboard' ?></h3>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <?php if (!empty($breadcrumbs) && is_array($breadcrumbs)): ?>
                                            <?php foreach ($breadcrumbs as $breadcrumb): ?>
                                                <?php if (!empty($breadcrumb['url'])): ?>
                                                    <li class="breadcrumb-item">
                                                        <a
                                                            href="<?= esc($breadcrumb['url']) ?>"><?= esc($breadcrumb['title']) ?></a>
                                                    </li>
                                                <?php else: ?>
                                                    <li class="breadcrumb-item active" aria-current="page">
                                                        <?= esc($breadcrumb['title']) ?>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                                        <?php endif; ?>
                                    </ol>
                                </nav>
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

    <!-- datatable -->
    <script src="<?= base_url("mazer/assets/extensions/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("mazer/assets/extensions/datatables.net/js/jquery.dataTables.min.js") ?>"></script>
    <script src="<?= base_url("mazer/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js") ?>">
    </script>
    <script src="<?= base_url("mazer/assets/static/js/pages/datatables.js") ?>"></script>

    <script>
        // Get current URL for menu highlighting
        window.currentUrl = '<?= current_url() ?>';
    </script>

<?= $this->include('templates/js/helper_functions') ?>

    <?= $this->renderSection('js') ?>
</body>

</html>