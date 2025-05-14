<!-- add modal -->
<div class="modal fade" id="addMotocycleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addMotocycleForm">
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
                    </div>                    <div class="mb-3">
                        <label for="add_license_number" class="form-label">Nomor Plat Motor</label>
                        <input type="text" class="form-control" id="add_license_number" name="license_number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveMotorcycleBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Reset form fields when modal is closed
        $('#addMotocycleModal').on('hidden.bs.modal', function() {
            $('#add_brand').val('');
            $('#add_model').val('');
            $('#add_license_number').val('');
        });
        
        // Direct submit button handler - for debugging
        $('#saveMotorcycleBtn').on('click', function(e) {
            e.preventDefault();
            console.log('Save motorcycle button clicked directly');
            
            // Validate form before submitting
            const brand = $('#add_brand').val();
            const model = $('#add_model').val();
            const license = $('#add_license_number').val();
            
            if (!brand || brand.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Brand motor tidak boleh kosong'
                });
                return;
            }
            
            if (!model || model.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Model motor tidak boleh kosong'
                });
                return;
            }
            
            if (!license || license.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Nomor plat motor tidak boleh kosong'
                });
                return;
            }
            
            // Get the customer ID
            const customerId = $('#select_customer').val();
            
            // We need to do this manually since we've removed the form's action/method
            const formData = new FormData();
            formData.append('brand', $('#add_brand').val());
            formData.append('model', $('#add_model').val());
            formData.append('license_number', $('#add_license_number').val());
            formData.append('customer_id', customerId);
            
            $.ajax({
                url: '<?= site_url('master-data/motorcycles/add-alt') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Motorcycle form direct submission response:', response);
                    if (response.success) {
                        // Close the modal
                        $('#addMotocycleModal').modal('hide');
                        
                        // Create a new motorcycle option
                        const newMotorcycle = {
                            id: response.data.id,
                            text: `${response.data.brand} ${response.data.model} (${response.data.license_number})`
                        };
                        
                        // Add the new motorcycle to the select and select it
                        if (!$('#select_motocycle').find("option[value='" + newMotorcycle.id + "']").length) {
                            const newOption = new Option(newMotorcycle.text, newMotorcycle.id, true, true);
                            $('#select_motocycle').append(newOption).trigger('change');
                        }
                        
                        // Reset the form
                        $('#addMotocycleForm')[0].reset();
                        
                        // Display success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Motor berhasil ditambahkan'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Gagal menambahkan motor'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr, status, error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data motor'
                    });
                }
            });
        });
    });
</script>
        