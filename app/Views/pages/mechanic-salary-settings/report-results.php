<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan Gaji Mekanik</h3>
                <p class="text-subtitle text-muted">Laporan gaji untuk periode: <?= date('d M Y', strtotime($start_date)) ?> - <?= date('d M Y', strtotime($end_date)) ?></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('master-data/mechanic-salary-settings') ?>">Pengaturan Gaji Mekanik</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('master-data/mechanic-salary-settings/reports') ?>">Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hasil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Ringkasan Laporan Gaji</h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <form action="<?= base_url('master-data/mechanic-salary-settings/print-report') ?>" method="post" target="_blank">
                            <?= csrf_field() ?>
                            <input type="hidden" name="start_date" value="<?= $start_date ?>">
                            <input type="hidden" name="end_date" value="<?= $end_date ?>">
                            <input type="hidden" name="mechanic_id" value="<?= isset($_POST['mechanic_id']) ? $_POST['mechanic_id'] : '' ?>">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-printer"></i> Cetak Laporan
                            </button>
                            <a href="<?= base_url('master-data/mechanic-salary-settings/reports') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Summary section -->
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-muted">Total Jumlah Layanan</h6>
                                    <h4>Rp <?= number_format($report['total_service_amount'], 0, ',', '.') ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-muted">Total Komisi</h6>
                                    <h4>Rp <?= number_format($report['total_commission'], 0, ',', '.') ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-muted">Total Mekanik</h6>
                                    <h4><?= $report['total_mechanics'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mechanic details -->
                <?php if (empty($report['details'])) : ?>
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">Data tidak ditemukan</h4>
                        <p>Tidak ada data penjualan layanan yang ditemukan untuk periode yang dipilih.</p>
                    </div>
                <?php else : ?>
                    <!-- Mechanics table -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="salaryReportTable">
                            <thead>
                                <tr>
                                    <th>Nama Mekanik</th>
                                    <th>Persentase Komisi</th>
                                    <th>Jumlah Layanan</th>
                                    <th>Jumlah Komisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($report['details'] as $detail) : ?>
                                    <tr>
                                        <td><?= $detail['mechanic_name'] ?></td>
                                        <td><?= $detail['percentage'] ?>%</td>
                                        <td>Rp <?= number_format($detail['total_service_amount'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($detail['commission'], 0, ',', '.') ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" 
                                                    data-bs-target="#detailModal<?= $detail['mechanic_id'] ?>">
                                                <i class="bi bi-eye"></i> Detail Layanan
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Detail modals for each mechanic -->
                    <?php foreach ($report['details'] as $detail) : ?>
                        <div class="modal fade" id="detailModal<?= $detail['mechanic_id'] ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel">Detail Layanan - <?= $detail['mechanic_name'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Layanan</th>
                                                        <th>ID Penjualan</th>
                                                        <th>Harga</th>
                                                        <th>Komisi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $totalCommission = 0; ?>
                                                    <?php foreach ($detail['sales'] as $sale) : ?>
                                                        <?php 
                                                            $commission = ($detail['percentage'] / 100) * $sale->service_price;
                                                            $totalCommission += $commission;
                                                        ?>
                                                        <tr>
                                                            <td><?= date('d M Y', strtotime($sale->created_at)) ?></td>
                                                            <td><?= $sale->service_name ?></td>
                                                            <td><?= $sale->sale_id ?></td>
                                                            <td>Rp <?= number_format($sale->service_price, 0, ',', '.') ?></td>
                                                            <td>Rp <?= number_format($commission, 0, ',', '.') ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4" class="text-end">Total:</th>
                                                        <th>Rp <?= number_format($totalCommission, 0, ',', '.') ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#salaryReportTable').DataTable({
            "order": [[2, "desc"]]
        });
    });
</script>
<?= $this->endSection(); ?>