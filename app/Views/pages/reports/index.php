<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Reports Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sales Reports</h4>
                        </div>
                        <div class="card-body">
                            <a href="<?= base_url('reports/sales') ?>" class="btn btn-primary btn-lg btn-block">
                                <i class="fas fa-file-alt"></i> Generate Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Mechanic Salary Reports</h4>
                        </div>
                        <div class="card-body">
                            <a href="<?= base_url('reports/mechanic-salaries') ?>" class="btn btn-success btn-lg btn-block">
                                <i class="fas fa-file-alt"></i> Generate Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>