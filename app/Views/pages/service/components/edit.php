<!-- edit service details modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editServiceForm" action="<?= base_url('master-data/services/edit') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="service_id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_name" name="service_name" required>
                        <div class="invalid-feedback" id="edit-error-service_name"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_description" name="description" required></textarea>
                        <div class="invalid-feedback" id="edit-error-description"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_difficulty" class="form-label">Tingkat Kesulitan</label>
                        <select class="form-select" id="edit_difficulty" name="difficulty" required>
                            <option value="1">Ringan</option>
                            <option value="2">Sedang</option>
                            <option value="3">Besar</option>
                        </select>
                        <div class="invalid-feedback" id="edit-error-difficulty"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Biaya Baru</label>
                        <input type="number" class="form-control" id="edit_price" name="price" required>
                        <small class="text-muted">Masukkan biaya baru jika ingin mengubah harga</small>
                        <div class="invalid-feedback" id="edit-error-price"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_prices" class="form-label">Riwayat Biaya</label>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal Efektif</th>
                                    <th scope="col">Biaya</th>
                                </tr>
                            </thead>
                            <tbody id="edit_prices">
                                <!-- Prices will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Populate the edit modal when shown
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var description = button.data('description');
            var difficulty = button.data('difficulty');
            var prices = button.data('prices');

            var modal = $(this);
            modal.find('.modal-body #edit_id').val(id);
            modal.find('.modal-body #edit_name').val(name);
            modal.find('.modal-body #edit_description').val(description);
            modal.find('.modal-body #edit_difficulty').val(difficulty);

            // Set the latest price in the price input for convenience
            if (prices && prices.length > 0) {
                var latestPrice = prices[prices.length - 1];
                modal.find('.modal-body #edit_price').val(latestPrice.price);
            } else {
                // Clear the price field for new input
                modal.find('.modal-body #edit_price').val('');
            }

            // Populate price history table
            var pricesTable = modal.find('.modal-body #edit_prices');
            pricesTable.empty();
            if (prices && prices.length > 0) {
                prices.forEach(function(price, index) {
                    pricesTable.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${formatDateTime(price.effective_date)}</td>
                            <td>${formatCurrencyID(price.price)}</td>
                        </tr>
                    `);
                });
            } else {
                pricesTable.append('<tr><td colspan="3" class="text-center">Tidak ada riwayat harga</td></tr>');
            }
            
            // Reset validation errors
            modal.find('.is-invalid').removeClass('is-invalid');
        });
        
        // Handle form submission via AJAX
        $('#editServiceForm').on('submit', function(e) {
            e.preventDefault();
            
            // Reset previous error messages
            document.querySelectorAll('.is-invalid').forEach(field => {
                field.classList.remove('is-invalid');
            });
            
            // Get form data
            const formData = new FormData(this);
            
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
            fetch($(this).attr('action'), {
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
                        // Close modal
                        $('#editModal').modal('hide');
                        
                        // Reload page to show the updated data
                        window.location.reload();
                    });
                } else {
                    // Show validation errors
                    Swal.close();
                    
                    if (data.errors) {
                        // Display validation errors on the form
                        Object.keys(data.errors).forEach(field => {
                            const inputField = document.querySelector(`#editServiceForm [name="${field}"]`);
                            const errorDisplay = document.getElementById(`edit-error-${field}`);
                            
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