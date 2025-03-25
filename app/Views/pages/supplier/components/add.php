
<!-- Add Supplier Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Supplier Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addSupplierForm" method="POST" action="<?= base_url('master-data/suppliers/add') ?>">
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
