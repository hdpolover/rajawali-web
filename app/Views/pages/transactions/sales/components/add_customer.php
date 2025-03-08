<!-- add modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addCustomerForm">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelanggan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="add_name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="add_phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="add_phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="add_address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="add_address" name="address" rows="3"></textarea>
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
        $('#addCustomerForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?= site_url('customers/add-alt') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Berhasil menambahkan data pelanggan'
                        }).then((result) => {
                            // Close modal and reset form
                            $('#addCustomerModal').modal('hide');
                            $('#addCustomerForm')[0].reset();

                            // select the customer
                            $('#select_customer').append(`<option value="${response.data.id}">${response.data.name}</option>`);
                            $('#select_customer').val(response.data.id).trigger('change');

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

        $('#addCustomerModal').on('hidden.bs.modal', function() {
            $('#add_name').val('');
            $('#add_phone').val('');
            $('#add_address').val('');
        });
    });
</script>