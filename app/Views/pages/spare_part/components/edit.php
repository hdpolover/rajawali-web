<!-- Edit Spare Part Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSparePartForm" method="POST" action="<?= base_url('master-data/spare-parts/edit') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_code_number" class="form-label">Kode Barcode</label>
                        <input type="text" class="form-control" id="edit_code_number" name="code_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Spare Part</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_merk" class="form-label">Merk</label>
                        <input type="text" class="form-control" id="edit_merk" name="merk">
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Tipe Spare Part</label>
                        <select class="form-select" id="edit_type" name="type" required>
                            <option value="">Pilih Tipe Spare Part</option>
                            <?php foreach ($spare_part_types as $type) : ?>
                                <option value="<?= esc($type->id) ?>"><?= esc($type->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_stock" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="edit_stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_sell_price" class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" id="edit_sell_price" name="sell_price" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_buy_price" class="form-label">Harga Beli</label>
                        <input type="number" class="form-control" id="edit_buy_price" name="buy_price" required>
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

            // get spare part data by id from spare part array in index.php
            var spare_part = <?= json_encode($spare_parts) ?>;
            spare_part = spare_part.find(spare_part => spare_part.id == id);

            var modal = $(this);
            modal.find('#edit_id').val(spare_part.id);
            modal.find('#edit_code_number').val(spare_part.code_number);
            modal.find('#edit_name').val(spare_part.name);
            modal.find('#edit_merk').val(spare_part.merk);
            modal.find('#edit_description').val(spare_part.description);
            modal.find('#edit_type').val(spare_part.spare_part_type_id);
            modal.find('#edit_stock').val(spare_part.details.current_stock);
            modal.find('#edit_sell_price').val(spare_part.details.current_sell_price);
            modal.find('#edit_buy_price').val(spare_part.details.current_buy_price);
        });
    });
</script>