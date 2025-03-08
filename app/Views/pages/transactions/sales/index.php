<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#archiveModal">
                <i class="bi bi-archive"></i>
            </button>
            <a href="<?= base_url("/transactions/sales/add") ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Penjualan Baru
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales as $index => $sale): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $sale->sale_number ?></td>
                                <td><?= format_indonesian_date($sale->sale_date) ?></td>
                                <td><?= !empty($sale->customer->name) ? $sale->customer->name : '-' ?></td>
                                <td>
                                    <?php if ($sale->status == 'pending'): ?>
                                        <span class="badge bg-warning">Pending</span>
                                    <?php elseif ($sale->status == 'process'): ?>
                                        <span class="badge bg-success">Proses</span>
                                    <?php elseif ($sale->status == 'completed'): ?>
                                        <span class="badge bg-primary">Selesai</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Batal</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewSaleModal" data-id="<?= $sale->id ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-sale="<?= json_encode($sale) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $sale->id ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <?php if ($sale->status == 'completed'): ?>
                                        <a href="<?= base_url("/transactions/sales/print_invoice/" . $sale->id) ?>" class="btn btn-sm btn-info">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('pages/transactions/sales/components/add'); ?>
<?= $this->include('pages/transactions/sales/components/view'); ?>

<?= $this->endSection() ?>