<?php
// app/Views/pages/service/components/delete.php
?>
<!-- delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            <form id="deleteServiceForm" action="<?= base_url('master-data/services/delete') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="service_id" id="delete_service_id">
                    <p>Apakah Anda yakin ingin menghapus servis ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>    document.addEventListener('DOMContentLoaded', function() {
        // Set the service ID when the modal is shown
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            
            console.log('Delete modal opened for service ID:', id);
            $(this).find('#delete_service_id').val(id);
        });
        
        // Handle form submission via AJAX
        $('#deleteServiceForm').on('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // Debug: Log form data
            console.log('Service ID to delete:', formData.get('service_id'));
            
            // Show loading indicator
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
              // Send AJAX request
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(data) {
                    console.log('Server response:', data);
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
                            $('#deleteModal').modal('hide');
                            
                            // Reload page to show the updated table
                            window.location.reload();
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message || 'Gagal menghapus data servis.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log('XHR Response:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan pada server.'
                    });
                }
            });
        });
    });
</script>
