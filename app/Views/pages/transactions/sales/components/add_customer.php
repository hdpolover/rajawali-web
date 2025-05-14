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
                        <textarea class="form-control" id="add_address" name="address" rows="3"></textarea>                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveCustomerBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {        
        // Reset form fields when modal is closed
        $('#addCustomerModal').on('hidden.bs.modal', function() {
            $('#add_name').val('');
            $('#add_phone').val('');
            $('#add_address').val('');
        });
        
        // Direct submit button handler - for debugging
        $('#saveCustomerBtn').on('click', function(e) {
            e.preventDefault();
            console.log('Save customer button clicked directly');
            
            // Validate form before submitting
            const name = $('#add_name').val();
            if (!name || name.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Nama pelanggan tidak boleh kosong'
                });
                return;
            }
            
            // We need to do this manually since we've removed the form's action/method
            const formData = new FormData();
            formData.append('name', $('#add_name').val());
            formData.append('phone', $('#add_phone').val());
            formData.append('address', $('#add_address').val());
            
            $.ajax({
                url: '<?= site_url('master-data/customers/add-alt') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Customer form direct submission response:', response);
                    if (response.success) {
                        // Close the modal
                        $('#addCustomerModal').modal('hide');
                        
                        // Create a new option for the select
                        const newCustomer = {
                            id: response.data.id,
                            text: response.data.name
                        };
                        
                        // Add the new customer to the select and select it
                        if (!$('#select_customer').find("option[value='" + newCustomer.id + "']").length) {
                            const newOption = new Option(newCustomer.text, newCustomer.id, true, true);
                            $('#select_customer').append(newOption).trigger('change');
                        }
                        
                        // Show motorcycle div
                        document.getElementById('motorcycle_div').classList.remove('d-none');
                        
                        // Reset the form
                        $('#addCustomerForm')[0].reset();
                        
                        // Display success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pelanggan berhasil ditambahkan'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Gagal menambahkan pelanggan'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr, status, error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data pelanggan'
                    });
                }
            });
        });
    });
</script>
        