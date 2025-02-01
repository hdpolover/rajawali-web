<!-- view customer details modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="view_customer_name" class="form-label"><strong>Nama</strong></label>
                    <p id="view_customer_name"></p>
                </div>
                <div class="mb-3">
                    <label for="view_customer_phone" class="form-label"><strong>Telepon</strong></label>
                    <p id="view_customer_phone"></p>
                </div>
                <div class="mb-3">
                    <label for="view_customer_address" class="form-label"><strong>Alamat</strong></label>
                    <p id="view_customer_address"></p>
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
        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var phone = button.data('phone');
            var address = button.data('address');

            var modal = $(this);
            modal.find('.modal-body #view_customer_name').text(name);
            modal.find('.modal-body #view_customer_phone').text(phone);
            modal.find('.modal-body #view_customer_address').text(address);
        });
    });
</script>
