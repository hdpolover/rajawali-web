<?php
// edit modal
?>
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('master-data/motorcycles/update') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Motor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_brand" class="form-label">Merek</label>
                        <input type="text" class="form-control" id="edit_brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="edit_model" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_license_number" class="form-label">Nomor Plat</label>
                        <input type="text" class="form-control" id="edit_license_number" name="license_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_customer_id" class="form-label">Pemilik</label>
                        <select class="form-select" id="edit_customer_id" name="customer_id" required>
                            <option value="">Pilih Pemilik</option>
                            <?php foreach ($customers as $customer) : ?>
                                <option value="<?= $customer->id ?>"><?= esc($customer->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var brand = button.data('brand');
            var model = button.data('model');
            var license_number = button.data('license_number');
            var customer_id = button.data('customer_id');

            var modal = $(this);
            modal.find('.modal-body #edit_id').val(id);
            modal.find('.modal-body #edit_brand').val(brand);
            modal.find('.modal-body #edit_model').val(model);
            modal.find('.modal-body #edit_license_number').val(license_number);
            modal.find('.modal-body #edit_customer_id').val(Number(customer_id));
        });
    });
</script>