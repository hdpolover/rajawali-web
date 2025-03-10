<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <?php if(session()->getFlashdata('alert')): ?>
        <div class="alert alert-<?= session()->getFlashdata('alert')['type'] ?> alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('alert')['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#archiveModal">
                <i class="bi bi-archive"></i> Arsip
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
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-purchase="<?= htmlspecialchars(json_encode($purchase), ENT_QUOTES, 'UTF-8') ?>">
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

<!-- Include all modal components -->
<?= $this->include('pages/transactions/purchases/components/view') ?>
<?= $this->include('pages/transactions/purchases/components/add') ?>
<?= $this->include('pages/transactions/purchases/components/edit') ?>
<?= $this->include('pages/transactions/purchases/components/delete') ?>
<?= $this->include('pages/transactions/purchases/components/archive') ?>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#table1').DataTable({
            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });
</script>
<?= $this->endSection() ?>