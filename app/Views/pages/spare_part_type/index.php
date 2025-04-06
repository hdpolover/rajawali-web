<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<!-- Basic Tables start -->
<section class="section">

    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#archiveModal">
                <i class="bi bi-archive"></i>
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus"></i> Tipe Spare Part Baru
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($spare_part_types as $index => $spare_part_type) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $spare_part_type->name ?></td>
                                <td><?= $spare_part_type->description ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $spare_part_type->id ?>" data-name="<?= $spare_part_type->name ?>" data-description="<?= $spare_part_type->description ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $spare_part_type->id ?>" data-name="<?= $spare_part_type->name ?>" data-description="<?= $spare_part_type->description ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $spare_part_type->id ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<!-- Basic Tables end -->

<!-- view spare part type modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Tipe Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="mb-3">
                    <label for="view_name" class="form-label"><strong>Nama</strong></label>
                    <p id="view_name"></p>
                </div>
                <div class="mb-3">
                    <label for="view_description" class="form-label"><strong>Deskripsi</strong></label>
                    <p id="view_description"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('master-data/spare-part-types/edit') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tipe Spare Part</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('master-data/spare-part-types/delete') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Tipe Spare Part</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body
                ">
                    <input type="hidden" name="id" id="delete_id">
                    <p>Apakah Anda yakin ingin menghapus tipe spare part ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('master-data/spare-part-types/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tipe Spare Part Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="add_name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="add_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="add_description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var table = $('#table1').DataTable();

        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var description = button.data('description');

            var modal = $(this);
            modal.find('.modal-body #edit_id').val(id);
            modal.find('.modal-body #edit_name').val(name);
            modal.find('.modal-body #edit_description').val(description);
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var modal = $(this);
            modal.find('.modal-body #delete_id').val(id);
        });

        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var description = button.data('description');

            var modal = $(this);
            // modal.find('.modal-body #view_id').text(id);
            modal.find('.modal-body #view_name').text(name);
            modal.find('.modal-body #view_description').text(description);
        });

    });
</script>

<?= $this->endSection(); ?>