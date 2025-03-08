<!-- add modal -->
<div class="modal fade" id="addMotocycleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addMotorcycleForm">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Motor Pelanggan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="add_customer_id" name="customer_id">
                    </div>
                    <div class="mb-3">
                        <label for="add_brand" class="form-label">Brand Motor</label>
                        <input type="text" class="form-control" id="add_brand" name="brand">
                    </div>
                    <div class="mb-3">
                        <label for="add_model" class="form-label">Model Motor</label>
                        <input type="text" class="form-control" id="add_model" name="model">
                    </div>
                    <div class="mb-3">
                        <label for="add_license_number" class="form-label">Nomor Plat Motor</label>
                        <input type="text" class="form-control" id="add_license_number" name="license_number">
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
    $(document).ready(function() {
        // Handle the form submission
        $('#addMotorcycleForm').on('submit', function(e) {
            e.preventDefault();

            // get customer id from select customer
            var customer_id = $('#select_customer').val();

            // set customer id to hidden input
            $('#add_customer_id').val(customer_id);

            $.ajax({
                url: '<?= site_url('motorcycles/add-alt') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Berhasil menambahkan data motor pelanggan'
                        }).then((result) => {
                            // Close modal and reset form
                            $('#addMotorcycleModal').modal('hide');
                            $('#addMotorcycleForm')[0].reset();

                            // select the motorcycle
                            $('#select_motorcycle').append(`<option value="${response.data.id}">${response.data.brand} ${response.data.model} - ${response.data.license_number}</option>`);
                            $('#select_motorcycle').val(response.data.id).trigger('change');

                            // Reload the page or update customer list
                            window.location.reload();
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Galat saat menyimpan data'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Galat saat menyimpan data'
                    });
                }
            });
        });

        $('#addMotorcycleModal').on('hidden.bs.modal', function() {
            $('#add_brand').val('');
            $('#add_model').val('');
            $('#add_license_number').val('');
        });
    });
</script>