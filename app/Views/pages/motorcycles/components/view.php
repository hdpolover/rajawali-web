<!-- view customer details modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Motor Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="view_brand" class="form-label"><strong>Merek</strong></label>
                    <p id="view_brand"></p>
                </div>
                <div class="mb-3">
                    <label for="view_model" class="form-label"><strong>Model</strong></label>
                    <p id="view_model"></p>
                </div>
                <div class="mb-3">
                    <label for="view_license_number" class="form-label"><strong>Nomor Plat</strong></label>
                    <p id="view_license_number"></p>
                </div>
                <div class="mb-3">
                    <label for="view_customer" class="form-label"><strong>Pemilik</strong></label>
                    <p id="view_customer"></p>
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
            var id = button.data('id');
            var brand = button.data('brand');
            var model = button.data('model');
            var license_number = button.data('license_number');
            var customer_id = button.data('customer_id');

            var modal = $(this);            modal.find('.modal-body #view_brand').text(brand);
            modal.find('.modal-body #view_model').text(model);
            modal.find('.modal-body #view_license_number').text(license_number);
            
            // get customer name from customer array
            var customers = <?= json_encode($customers) ?>;
            var customer = customers.find(customer => Number(customer.id) === Number(customer_id));
            
            if (customer) {
                modal.find('.modal-body #view_customer').text(customer.name);
            } else {
                modal.find('.modal-body #view_customer').text('-');
            }

        });
    });
</script>