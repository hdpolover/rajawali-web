<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#archiveModal">
                <i class="bi bi-archive"></i>
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus"></i> Pembelian Spare Part Baru
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
                            <th>Tanggal Pembelian</th>
                            <th>Supplier</th>
                            <th>Spare Part</th>
                            <th>Admin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($purchases as $index => $purchase): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= format_indonesian_date($purchase->purchase_date) ?></td>
                            <td><?= $purchase->supplier->name ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($purchase->details as $purchase_detail): ?>
                                        <li><?= $purchase_detail->spare_part->name ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td><?= $purchase->admin->username ?></td>
                            <td>
                                <?php if ($purchase->status == '0'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif ($purchase->status == '1'): ?>
                                    <span class="badge bg-success">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Gagal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $purchase->id ?>">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-purchase="<?= json_encode($purchase) ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $purchase->id ?>">
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
</div>

<?= $this->include('pages/transactions/purchases/components/view'); ?>
<?= $this->include('pages/transactions/purchases/components/add'); ?>

<?= $this->endSection() ?>