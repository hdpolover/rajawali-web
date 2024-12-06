<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Spare Parts Management</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" id="btnAdd">
                            <i class="fas fa-plus"></i> Add New Spare Part
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tblSparePart" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('#tblSparePart').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?= base_url('spare-part/list') ?>',
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'category'},
            {data: 'stock'},
            {data: 'price'},
            {data: 'actions'}
        ]
    });
});
</script>
<?= $this->endSection() ?>