<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addServiceForm" action="<?= base_url('master-data/services/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_service_name" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="add_service_name" name="service_name" required>
                        <div class="invalid-feedback" id="error-service_name"></div>
                    </div>
                    <div class="mb-3">
                        <label for="add_difficulty" class="form-label">Tingkat Kesulitan</label>
                        <select class="form-select" id="add_difficulty" name="difficulty" required>
                            <option value="1">Ringan</option>
                            <option value="2">Sedang</option>
                            <option value="3">Besar</option>
                        </select>
                        <div class="invalid-feedback" id="error-difficulty"></div>
                    </div>
                    <div class="mb-3">
                        <label for="add_price" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="add_price" name="price" required>
                        <div class="invalid-feedback" id="error-price"></div>
                    </div>
                    <div class="mb-3">
                        <label for="add_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="add_description" name="description" rows="3" required></textarea>
                        <div class="invalid-feedback" id="error-description"></div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const addServiceForm = document.getElementById('addServiceForm');
        
        addServiceForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset previous error messages
            document.querySelectorAll('.is-invalid').forEach(field => {
                field.classList.remove('is-invalid');
            });
            
            // Get form data
            const formData = new FormData(addServiceForm);
            
            // Show loading indicator
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Send AJAX request
            fetch(addServiceForm.getAttribute('action'), {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        // Reset form and close modal
                        addServiceForm.reset();
                        $('#addModal').modal('hide');
                        
                        // Reload page to show the new data
                        window.location.reload();
                    });
                } else {
                    // Show validation errors
                    Swal.close();
                    
                    if (data.errors) {
                        // Display validation errors on the form
                        Object.keys(data.errors).forEach(field => {
                            const inputField = document.querySelector(`[name="${field}"]`);
                            const errorDisplay = document.getElementById(`error-${field}`);
                            
                            if (inputField && errorDisplay) {
                                inputField.classList.add('is-invalid');
                                errorDisplay.textContent = data.errors[field];
                            }
                        });
                    } else {
                        // Show general error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message || 'Terjadi kesalahan saat menyimpan data.'
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan pada server.'
                });
            });
        });
    });
</script>