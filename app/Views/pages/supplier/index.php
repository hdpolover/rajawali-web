<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<!-- Basic Tables start -->
<section class="section">

    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus"></i> Supplier Baru
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
                            <th>Nama Supplier</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suppliers as $index => $supplier): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($supplier->name) ?></td>
                                <td><?= esc($supplier->phone_number) ?></td>
                                <td><?= esc($supplier->address) ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $supplier->id ?>" data-name="<?= esc($supplier->name) ?>" data-phone="<?= esc($supplier->phone_number) ?>" data-address="<?= esc($supplier->address) ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $supplier->id ?>" data-name="<?= esc($supplier->name) ?>" data-phone="<?= esc($supplier->phone_number) ?>" data-address="<?= esc($supplier->address) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $supplier->id ?>">
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

<!-- View Supplier Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <div class="mb-3">
                    <label for="view_name" class="form-label"><strong>Nama</strong></label>
                    <p id="view_name"></p>
                </div> -->
                <div class="mb-3">
                    <label for="view_name" class="form-label"><strong>Nama Supplier</strong></label>
                    <p id="view_name"></p>
                </div>
                <div class="mb-3">
                    <label for="view_phone" class="form-label"><strong>Nomor Telepon</strong></label>
                    <p id="view_phone"></p>
                </div>
                <div class="mb-3">
                    <label for="view_address" class="form-label"><strong>Alamat</strong></label>
                    <p id="view_address"></p>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Supplier Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addSupplierForm" method="POST" action="<?= base_url('suppliers/add') ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_name" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="add_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="add_phone" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="add_address" name="address" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSupplierForm" method="POST" action="<?= base_url('suppliers/edit') ?>">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="edit_phone" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_address" name="address" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Delete Supplier Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteSupplierForm" method="POST" action="<?= base_url('suppliers/delete') ?>">
                <input type="hidden" name="id" id="delete_id">
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus supplier ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Populate Edit and View Modals with Supplier Data
        $('#editModal, #viewModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const supplierId = button.data('id');
            const supplierName = button.data('name');
            const supplierPhone = button.data('phone');
            const supplierAddress = button.data('address');

            if (this.id === 'editModal') {
                document.getElementById('edit_id').value = supplierId;
                document.getElementById('edit_name').value = supplierName;
                document.getElementById('edit_phone').value = supplierPhone;
                document.getElementById('edit_address').value = supplierAddress;
            } else if (this.id === 'viewModal') {
                document.getElementById('view_name').textContent = supplierName;
                document.getElementById('view_phone').textContent = supplierPhone;
                document.getElementById('view_address').textContent = supplierAddress;
            }
        });

        // Populate Delete Modal with Supplier ID
        $('#deleteodal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const supplierId = button.data('id');
            document.getElementById('delete_id').value = supplierId;
        });
    });
</script>

<?= $this->endSection(); ?>