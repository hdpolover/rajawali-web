<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Transaksi hari ini (<?= format_indonesian_date(date('Y-m-d')) ?>)</h4>
                </div>
                <div class="card-body">
                    <!-- Dashboard Stats Section -->
                    <div class="row">
                        <!-- Stats cards here -->
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon purple mb-2">
                                                <i class="bi bi-cart-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Pending</h6>
                                            <h6 class="font-extrabold mb-0"><?= $salesData['pending'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2">
                                                <i class="bi bi-gear-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Process</h6>
                                            <h6 class="font-extrabold mb-0"><?= $salesData['process'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon green mb-2">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Completed</h6>
                                            <h6 class="font-extrabold mb-0"><?= $salesData['completed'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon red mb-2">
                                                <i class="bi bi-bar-chart-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Total</h6>
                                            <h6 class="font-extrabold mb-0"><?= $salesData['total'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Revenue Card -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Total Pendapatan Hari Ini</h5>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-success">Rp <?= number_format($salesData['total_revenue'], 0, ',', '.') ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Customer Retention and Service Distribution -->
    <div class="row mt-3">
        <div class="col-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4>Retensi Pelanggan <?= date('Y') ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <div class="text-center">
                                    <h5 class="text-muted">Total Pelanggan</h5>
                                    <h3><?= $customerRetention['total'] ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <div class="text-center">
                                    <h5 class="text-muted">Pelanggan Berulang</h5>
                                    <h3><?= $customerRetention['returning'] ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-center">Tingkat Retensi: <?= $customerRetention['rate'] ?>%</h5>
                        <div class="progress progress-primary mb-4">
                            <div class="progress-bar" role="progressbar" style="width: <?= $customerRetention['rate'] ?>%" aria-valuenow="<?= $customerRetention['rate'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4>Distribusi Tingkat Layanan (<?= date('F Y') ?>)</h4>
                </div>
                <div class="card-body">
                    <div id="service-distribution-chart"></div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="d-flex flex-column align-items-center">
                                <div class="text-center">
                                    <h5 class="text-success">Mudah</h5>
                                    <h4><?= $serviceDistribution['easy'] ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-column align-items-center">
                                <div class="text-center">
                                    <h5 class="text-warning">Sedang</h5>
                                    <h4><?= $serviceDistribution['medium'] ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-column align-items-center">
                                <div class="text-center">
                                    <h5 class="text-danger">Sulit</h5>
                                    <h4><?= $serviceDistribution['hard'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Low Stock Alert Section -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Peringatan Stok Rendah</h4>
                    <span class="badge bg-danger"><?= count($lowStockSpareParts) ?> item</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Stok</th>
                                    <th>Harga Beli</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($lowStockSpareParts)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada spare part dengan stok rendah</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($lowStockSpareParts as $index => $part): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($part->name) ?></td>
                                            <td><?= esc($part->code_number) ?></td>
                                            <td><span class="badge bg-danger"><?= $part->current_stock ?></span></td>
                                            <td>Rp <?= number_format($part->current_buy_price, 0, ',', '.') ?></td>
                                            <td>
                                                <a href="<?= base_url('transactions/purchases/new') ?>" class="btn btn-sm btn-primary">Beli Stok</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Top selling spare parts and popular services -->
    <div class="row mt-3">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4>Spare Part Terlaris Hari Ini</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Total Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($topSparePartSales)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data penjualan hari ini</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($topSparePartSales as $index => $sparePart): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($sparePart->name) ?></td>
                                            <td><?= esc($sparePart->code_number) ?></td>
                                            <td><?= $sparePart->total_quantity ?> unit</td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4>Layanan Service Terpopuler Hari Ini</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Service</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($popularServices)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data service hari ini</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($popularServices as $index => $service): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($service->name) ?></td>
                                            <td><?= $service->service_count ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Top Mechanics Performance -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Kinerja Mekanik Hari Ini</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mekanik</th>
                                    <th>Jumlah Service</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($topMechanics)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data kinerja mekanik hari ini</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($topMechanics as $index => $mechanic): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($mechanic->name) ?></td>
                                            <td><?= $mechanic->service_count ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Monthly Sales Chart -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tren Penjualan Bulanan <?= date('Y') ?></h4>
                </div>
                <div class="card-body">
                    <div id="monthly-sales-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add ApexCharts JS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Sales Chart
        const monthlySalesData = <?= json_encode($monthlySalesTrend) ?>;
        
        const options = {
            series: [{
                name: 'Total Penjualan',
                data: monthlySalesData.map(item => item.total)
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: false,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: monthlySalesData.map(item => item.month),
            },
            yaxis: {
                title: {
                    text: 'Total (Rp)'
                },
                labels: {
                    formatter: function(val) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
                    }
                }
            },
            title: {
                text: 'Total Penjualan per Bulan',
                align: 'center'
            },
            colors: ['#435ebe']
        };

        if (document.getElementById('monthly-sales-chart')) {
            const chart = new ApexCharts(document.getElementById('monthly-sales-chart'), options);
            chart.render();
        }
        
        // Service Distribution Chart
        const serviceData = [
            <?= $serviceDistribution['easy'] ?>, 
            <?= $serviceDistribution['medium'] ?>, 
            <?= $serviceDistribution['hard'] ?>
        ];
        
        const serviceOptions = {
            series: serviceData,
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Mudah', 'Sedang', 'Sulit'],
            colors: ['#4FD1C5', '#F59E0B', '#E53E3E'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        if (document.getElementById('service-distribution-chart')) {
            const serviceChart = new ApexCharts(document.getElementById('service-distribution-chart'), serviceOptions);
            serviceChart.render();
        }
    });
</script>
<?= $this->endSection() ?>