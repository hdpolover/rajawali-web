<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row">
        <div class="card">
            <div class="card-body px-4 py-4-5 cursor-default-hover">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start cursor-default-hover">
                        <div class="stats-icon blue mb-2 cursor-default-hover">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 cursor-default-hover">
                        <h6 class="text-muted font-semibold cursor-default-hover">Progres</h6>
                        <h6 class="font-extrabold mb-0 cursor-default-hover">183.000</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Welcome back, <?= $username ?>!</h4>
                    <p class="text-subtitle text-muted">Your role is: <?= $role ?></p>
                </div>
                <div class="card-body">
                    <!-- Dashboard Stats Section -->
                    <div class="row">
                        <!-- Stats cards here -->
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon purple mb-2">
                                                <i class="bi bi-cart-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Total Sales</h6>
                                            <h6 class="font-extrabold mb-0">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>