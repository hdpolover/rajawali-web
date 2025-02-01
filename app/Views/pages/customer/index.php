<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<!-- Basic Tables start -->
<section class="section">

    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#archiveModal">
                <i class="bi bi-archive"></i>
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus"></i> Pelanggan Baru
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $index => $customer) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $customer->name ?></td>
                                <td><?= $customer->phone ;?></td>
                                <td><?= $customer->address ;?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $customer->id ?>" data-name="<?= $customer->name ?>" data-phone="<?= $customer->phone ?>" data-address="<?= $customer->address ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $customer->id ?>" data-name="<?= $customer->name ?>" data-phone="<?= $customer->phone ?>" data-address="<?= $customer->address ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $customer->id ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<!-- Basic Tables end -->

<!-- include Spare Part Modal from the other folder-->
<?= $this->include('pages/customer/components/add'); ?>
<?= $this->include('pages/customer/components/view'); ?>


<?= $this->endSection(); ?>