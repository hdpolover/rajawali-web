<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <!-- <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Pengaturan Gaji Mekanik</h3>
                <p class="text-subtitle text-muted">Perbarui persentase komisi untuk layanan mekanik</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('master-data/mechanic-salary-settings') ?>">Pengaturan Gaji Mekanik</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div> -->

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Pengaturan Gaji</h4>
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

                <form action="<?= base_url('master-data/mechanic-salary-settings/update/' . $salarySetting->id) ?>" method="post" class="form form-horizontal">
                    <?= csrf_field() ?>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="mechanic_id">Mekanik</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select name="mechanic_id" id="mechanic_id" class="form-select" required>
                                    <option value="">Pilih Mekanik</option>
                                    <?php foreach ($mechanics as $mechanic) : ?>
                                        <option value="<?= $mechanic->id ?>" <?= old('mechanic_id', $salarySetting->mechanic_id) == $mechanic->id ? 'selected' : '' ?>>
                                            <?= $mechanic->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="percentage">Persentase Komisi (%)</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="percentage" class="form-control" name="percentage" 
                                       placeholder="Masukkan persentase" value="<?= old('percentage', $salarySetting->percentage) ?>" 
                                       step="0.01" min="0" max="100" required>
                                <small class="text-muted">Masukkan nilai antara 0 dan 100</small>
                            </div>

                            <div class="col-md-4">
                                <label for="status">Status</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select name="status" id="status" class="form-select" required>
                                    <option value="active" <?= old('status', $salarySetting->status) == 'active' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="inactive" <?= old('status', $salarySetting->status) == 'inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
                                </select>
                                <small class="text-muted">Hanya satu pengaturan per mekanik yang dapat aktif pada satu waktu</small>
                            </div>

                            <div class="col-md-4">
                                <label for="description">Deskripsi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea name="description" id="description" class="form-control" rows="3" 
                                          placeholder="Masukkan deskripsi opsional"><?= old('description', $salarySetting->description) ?></textarea>
                            </div>

                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-save"></i> Perbarui
                                </button>
                                <a href="<?= base_url('master-data/mechanic-salary-settings') ?>" class="btn btn-secondary">
                                    <i class="bi bi-x"></i> Batal
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