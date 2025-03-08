<!-- View Supplier Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                <div class="mb-3">
                    <label for="view_status" class="form-label"><strong>Status</strong></label>
                    <p id="view_status"></p>
                </div>
                <div class="mb-3">
                    <label for="view_created_at" class="form-label"><strong>Ditambahkan Pada</strong></label>
                    <p id="view_created_at"></p>
                </div>
                <div class="mb-3">
                    <label for="view_updated_at" class="form-label"><strong>Diperbarui Pada</strong></label>
                    <p id="view_updated_at"></p>
                </div>
                <div id="deleted_at_section" class="mb-3">
                    <label for="view_deleted_at" class="form-label"><strong>Dihapus Pada</strong></label>
                    <p id="view_deleted_at"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Populate View Modal with Supplier Data
        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');


            const suppliers = <?= json_encode($suppliers) ?>;

            const supplier = suppliers.find(supplier => supplier.id == id);

            console.log(supplier);

            const modal = $(this);
            modal.find('.modal-body #view_name').text(supplier.name);
            modal.find('.modal-body #view_phone').text(supplier.phone_number);
            modal.find('.modal-body #view_address').text(supplier.address);

            // convert created_at and updated_at to human readable format
            modal.find('.modal-body #view_created_at').text(formatDateTime(supplier.created_at.date));
            modal.find('.modal-body #view_updated_at').text(formatDateTime(supplier.updated_at.date));

            if (supplier.deleted_at) {
                modal.find('#view_deleted_at').text(formatDateTime(supplier.deleted_at));
                modal.find('#deleted_at_section').show();

                // set status
                modal.find('.modal-body #view_status').text('Non aktif');
            } else {
                modal.find('#deleted_at_section').hide();

                // set status
                modal.find('.modal-body #view_status').text('Aktif');
            }
        });
    });
</script>