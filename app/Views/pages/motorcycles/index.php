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
                <i class="bi bi-plus"></i> Motor Baru
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
                            <th>Merek</th>
                            <th>Model</th>
                            <th>Nomor Plat</th>
                            <th>Pemilik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($motorcycles as $index => $motorcycle) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($motorcycle->brand) ?></td>
                                <td><?= esc($motorcycle->model) ?></td>
                                <td><?= esc($motorcycle->license_number) ?></td>
                                <?php foreach ($customers as $customer) : ?>
                                    <?php if ($customer->id == $motorcycle->customer_id) : ?>
                                        <td><?= esc($customer->name) ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $motorcycle->id ?>" data-brand="<?= esc($motorcycle->brand) ?>" data-model="<?= esc($motorcycle->model) ?>" data-license_number="<?= esc($motorcycle->license_number) ?>" data-customer_id="<?= esc($motorcycle->customer_id) ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $motorcycle->id ?>" data-brand="<?= esc($motorcycle->brand) ?>" data-model="<?= esc($motorcycle->model) ?>" data-license_number="<?= esc($motorcycle->license_number) ?>" data-customer_id="<?= esc($motorcycle->customer_id) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $motorcycle->id ?>">
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
<?= $this->include('pages/motorcycles/components/add'); ?>
<?= $this->include('pages/motorcycles/components/view'); ?>


<?= $this->endSection(); ?>