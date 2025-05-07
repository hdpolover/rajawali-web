<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<!-- Basic Tables start -->
<section class="section">

    <div class="row mb-4">
        <div class="col-12 text-end">
            <a href="<?= base_url('master-data/customers') ?>" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Pelanggan yang Diarsipkan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Tanggal Diarsipkan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $index => $customer) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($customer->name) ?></td>
                                <td><?= esc($customer->phone) ?></td>
                                <td><?= esc($customer->address) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($customer->deleted_at)) ?></td>
                                <td>
                                    <a href="<?= base_url('master-data/customers/restore/' . $customer->id) ?>" class="btn btn-sm btn-success">
                                        <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection(); ?>
