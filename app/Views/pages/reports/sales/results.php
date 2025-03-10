<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Sales Report</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= base_url('reports') ?>">Reports</a></div>
            <div class="breadcrumb-item"><a href="<?= base_url('reports/sales') ?>">Sales Reports</a></div>
            <div class="breadcrumb-item active">Results</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Sales Report for Period: <?= date('d M Y', strtotime($start_date)) ?> - <?= date('d M Y', strtotime($end_date)) ?></h4>
                        <div class="card-header-action">
                            <form action="<?= base_url('reports/sales/print') ?>" method="POST" target="_blank">
                                <input type="hidden" name="start_date" value="<?= $start_date ?>">
                                <input type="hidden" name="end_date" value="<?= $end_date ?>">
                                <?php if (!empty($report['customer_id'])): ?>
                                <input type="hidden" name="customer_id" value="<?= $report['customer_id'] ?>">
                                <?php endif; ?>
                                <button type="submit" class="btn btn-icon btn-primary"><i class="fas fa-print"></i> Print Report</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Total Sales</th>
                                            <td><?= $report['summary']['total_sales'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount</th>
                                            <td><?= number_format($report['summary']['total_amount'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Discount</th>
                                            <td><?= number_format($report['summary']['total_discount'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Tax</th>
                                            <td><?= number_format($report['summary']['total_tax'], 0, ',', '.') ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Grand Total</th>
                                            <td><?= number_format($report['summary']['total_grand_total'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Paid Sales</th>
                                            <td><?= $report['summary']['paid_sales'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Unpaid Sales</th>
                                            <td><?= $report['summary']['unpaid_sales'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Partial Sales</th>
                                            <td><?= $report['summary']['partial_sales'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped" id="salesTable">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th>Grand Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($report['sales'])): ?>
                                        <?php foreach ($report['sales'] as $sale): ?>
                                            <tr>
                                                <td><?= $sale->invoice_number ?></td>
                                                <td><?= date('d M Y', strtotime($sale->date)) ?></td>
                                                <td><?= $sale->customer_name ?></td>
                                                <td><?= number_format($sale->total_amount, 0, ',', '.') ?></td>
                                                <td><?= number_format($sale->discount, 0, ',', '.') ?></td>
                                                <td><?= number_format($sale->tax, 0, ',', '.') ?></td>
                                                <td><?= number_format($sale->grand_total, 0, ',', '.') ?></td>
                                                <td>
                                                    <?php if ($sale->payment_status === 'paid'): ?>
                                                        <span class="badge badge-success">Paid</span>
                                                    <?php elseif ($sale->payment_status === 'unpaid'): ?>
                                                        <span class="badge badge-danger">Unpaid</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-warning">Partial</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No sales data found for this period</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#salesTable').DataTable({
            responsive: true
        });
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>