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
                <i class="bi bi-plus"></i> Servis Baru
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
                            <th>Deskripsi</th>
                            <th>Tingkat Kesulitan</th>
                            <th>Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $index => $service) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($service->name) ?></td>
                                <td><?= esc($service->description) ?></td>
                                <td><?= get_service_difficulty_level(esc($service->difficulty)) ?></td>
                                <td>
                                    <?php if (!empty($service->prices)) : ?>
                                        <?php
                                        usort($service->prices, function ($a, $b) {
                                            return strtotime($b->effective_date) - strtotime($a->effective_date);
                                        });
                                        $latest_price = $service->prices[0];
                                        ?>
                                        <?= format_rupiah(esc($latest_price->price)) ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $service->id ?>" data-name="<?= esc($service->name) ?>" data-description="<?= esc($service->description) ?>" data-difficulty="<?= esc($service->difficulty) ?>" data-prices='<?= json_encode($service->prices) ?>'>
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $service->id ?>" data-name="<?= esc($service->name) ?>" data-description="<?= esc($service->description) ?>" data-difficulty="<?= esc($service->difficulty) ?>" data-prices='<?= json_encode($service->prices) ?>'>
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $service->id ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<!-- Basic Tables end -->

<?= $this->include('pages/service/components/add'); ?>
<?= $this->include('pages/service/components/view'); ?>
<?= $this->include('pages/service/components/edit'); ?>

<?= $this->endSection(); ?>