<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#archiveModal">
                <i class="bi bi-archive"></i>
            </button>
            <a href="<?= base_url("/transactions/sales/add")?>" class="btn btn-primary">
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
                            <td><?= $sale->transaction_number ?></td>
                            <td><?= format_indonesian_date($sale->transaction_date) ?></td>
                            <td><?= $sale->customer->name ?></td>
                            <td>
                                <?php if ($sale->status == '0'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif ($sale->status == '1'): ?>
                                    <span class="badge bg-success">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Gagal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $sale->id ?>">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-sale="<?= json_encode($sale) ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $sale->id ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('pages/transactions/sales/components/add'); ?>

<?= $this->endSection() ?>