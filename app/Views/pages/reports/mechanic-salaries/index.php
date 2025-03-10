<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Mechanic Salary Reports</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= base_url('reports') ?>">Reports</a></div>
            <div class="breadcrumb-item active">Mechanic Salary Reports</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Generate Mechanic Salary Report</h4>
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

                <form action="<?= base_url('reports/mechanic-salaries/generate') ?>" method="POST">
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
                        <label for="mechanic_id" class="col-sm-2 col-form-label">Mechanic (Optional)</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" id="mechanic_id" name="mechanic_id">
                                <option value="">All Mechanics</option>
                                <?php foreach ($mechanics as $mechanic): ?>
                                    <option value="<?= $mechanic->id ?>"><?= $mechanic->name ?></option>
                                <?php endforeach; ?>
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
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>