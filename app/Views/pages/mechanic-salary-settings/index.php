<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
   

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Pengaturan Gaji Mekanik</h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="<?= base_url('settings/mechanic-salaries/create') ?>" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Pengaturan Gaji Baru
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('message')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('message') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-hover" id="salarySettingsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mekanik</th>
                                <th>Persentase (%)</th>
                                <th>Status</th>
                                <th>Deskripsi</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($salarySettings) && is_array($salarySettings)) : ?>
                                <?php foreach ($salarySettings as $setting) : ?>
                                    <tr>
                                        <td><?= $setting->id ?></td>
                                        <td><?= $setting->mechanic_name ?></td>
                                        <td><?= $setting->percentage ?>%</td>
                                        <td>
                                            <?php if ($setting->status == 'active') : ?>
                                                <span class="badge bg-success">Aktif</span>
                                            <?php else : ?>
                                                <span class="badge bg-secondary">Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $setting->description ?? '-' ?></td>
                                        <td><?= date('d M Y H:i', strtotime($setting->created_at)) ?></td>
                                        <td>
                                            <a href="<?= base_url('master-data/mechanic-salary-settings/edit/' . $setting->id) ?>" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <a href="<?= base_url('master-data/mechanic-salary-settings/delete/' . $setting->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaturan gaji ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#salarySettingsTable').DataTable({
            "order": [[0, "desc"]]
        });
    });
</script>
<?= $this->endSection(); ?>