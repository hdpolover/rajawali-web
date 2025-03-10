<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Sales Reports</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= base_url('reports') ?>">Reports</a></div>
            <div class="breadcrumb-item active">Sales Reports</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Generate Sales Report</h4>
            </div>
            <div class="card-body">
                <?php if (session()->has('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <form action="<?= base_url('reports/sales/generate') ?>" method="POST">
                    <div class="form-group row">
                        <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_id" class="col-sm-2 col-form-label">Customer (Optional)</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" id="customer_id" name="customer_id">
                                <option value="">All Customers</option>
                                <!-- This will be populated via AJAX -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Generate Report</button>
                            <a href="<?= base_url('reports') ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();

        // Load customers
        $.ajax({
            url: '<?= base_url('customers/fetch') ?>',
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                var customerSelect = $('#customer_id');
                $.each(response.data, function(index, customer) {
                    customerSelect.append('<option value="' + customer.id + '">' + customer.name + '</option>');
                });
            },
            error: function() {
                console.error('Failed to load customers');
            }
        });
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>