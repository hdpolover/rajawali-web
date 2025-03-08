<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mb-4">
        <div class="col-12 text-end">
            <a href="<?= base_url("/transactions/sales") ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Penjualan Diarsipkan</h4>
        </div>
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
                            <th>Dihapus Pada</th>
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
                                <td><?= format_indonesian_date($sale->deleted_at) ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewSaleModal" data-id="<?= $sale->id ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <a href="<?= base_url('transactions/sales/restore/' . $sale->id) ?>" class="btn btn-sm btn-success restore-btn">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('pages/transactions/sales/components/view'); ?>

<script>
    $(document).ready(function() {
        // Initialize datatable
        $('#table1').DataTable();
        
        // Add confirmation for restore buttons
        $('.restore-btn').on('click', function(e) {
            e.preventDefault();
            var restoreUrl = $(this).attr('href');
            
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah anda yakin ingin memulihkan data penjualan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, pulihkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = restoreUrl;
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>