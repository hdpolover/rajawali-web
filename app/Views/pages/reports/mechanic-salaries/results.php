<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Mechanic Salary Report</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= base_url('reports') ?>">Reports</a></div>
            <div class="breadcrumb-item"><a href="<?= base_url('reports/mechanic-salaries') ?>">Mechanic Salary Reports</a></div>
            <div class="breadcrumb-item active">Results</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Salary Report for Period: <?= date('d M Y', strtotime($start_date)) ?> - <?= date('d M Y', strtotime($end_date)) ?></h4>
                        <div class="card-header-action">
                            <form action="<?= base_url('reports/mechanic-salaries/print') ?>" method="POST" target="_blank">
                                <input type="hidden" name="start_date" value="<?= $start_date ?>">
                                <input type="hidden" name="end_date" value="<?= $end_date ?>">
                                <?php if (isset($mechanic_id)): ?>
                                <input type="hidden" name="mechanic_id" value="<?= $mechanic_id ?>">
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
                                            <th>Period Start</th>
                                            <td><?= date('d M Y', strtotime($report['period_start'])) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Period End</th>
                                            <td><?= date('d M Y', strtotime($report['period_end'])) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Mechanics</th>
                                            <td><?= $report['total_mechanics'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Total Service Amount</th>
                                            <td><?= number_format($report['total_service_amount'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Commission</th>
                                            <td><?= number_format($report['total_commission'], 0, ',', '.') ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped" id="salaryTable">
                                <thead>
                                    <tr>
                                        <th>Mechanic Name</th>
                                        <th>Total Service Amount</th>
                                        <th>Commission Rate (%)</th>
                                        <th>Commission Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($report['details'])): ?>
                                        <?php foreach ($report['details'] as $detail): ?>
                                            <tr>
                                                <td><?= $detail['mechanic_name'] ?></td>
                                                <td><?= number_format($detail['total_service_amount'], 0, ',', '.') ?></td>
                                                <td><?= $detail['percentage'] ?>%</td>
                                                <td><?= number_format($detail['commission'], 0, ',', '.') ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" 
                                                            onclick="showServiceDetails(<?= htmlspecialchars(json_encode($detail['sales'])) ?>)">
                                                        <i class="fas fa-list"></i> Service Details
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No salary data found for this period</td>
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

<!-- Modal for service details -->
<div class="modal fade" id="serviceDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Service Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="serviceDetailsTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Service</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="serviceDetailsContent">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#salaryTable').DataTable({
            responsive: true
        });
    });

    function showServiceDetails(services) {
        let content = '';
        services.forEach(function(service) {
            content += `
                <tr>
                    <td>${formatDate(service.created_at)}</td>
                    <td>${service.service_name}</td>
                    <td>${formatNumber(service.service_price)}</td>
                </tr>
            `;
        });
        $('#serviceDetailsContent').html(content);
        $('#serviceDetailsModal').modal('show');
    }

    function formatDate(dateString) {
        return new Date(dateString).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>