<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan Gaji Mekanik</h3>
                <p class="text-subtitle text-muted">Generate laporan gaji berdasarkan penjualan layanan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('master-data/mechanic-salary-settings') ?>">Pengaturan Gaji Mekanik</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Generate Laporan Gaji</h4>
            </div>
            <div class="card-body">
                <?php if (session()->has('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            <?php foreach (session('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('master-data/mechanic-salary-settings/generate-report') ?>" method="post" class="form form-horizontal">
                    <?= csrf_field() ?>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Tanggal Mulai</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="start_date" class="form-control" name="start_date" 
                                       value="<?= old('start_date', date('Y-m-01')) ?>" required>
                            </div>

                            <div class="col-md-4">
                                <label for="end_date">Tanggal Akhir</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="end_date" class="form-control" name="end_date" 
                                       value="<?= old('end_date', date('Y-m-t')) ?>" required>
                            </div>

                            <div class="col-md-4">
                                <label for="mechanic_id">Mekanik (Opsional)</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select name="mechanic_id" id="mechanic_id" class="form-select">
                                    <option value="">Semua Mekanik</option>
                                    <?php foreach ($mechanics as $mechanic) : ?>
                                        <option value="<?= $mechanic->id ?>" <?= old('mechanic_id') == $mechanic->id ? 'selected' : '' ?>>
                                            <?= $mechanic->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-bar-chart"></i> Generate Laporan
                                </button>
                                <a href="<?= base_url('master-data/mechanic-salary-settings') ?>" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali ke Pengaturan
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>