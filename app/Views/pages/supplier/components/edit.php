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
    });
</script>
