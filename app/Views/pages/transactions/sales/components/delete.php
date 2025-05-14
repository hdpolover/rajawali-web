<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 4rem;"></i>
                </div>
                <h5 class="text-center mb-3">Apakah Anda yakin?</h5>
                <p class="text-center">Data penjualan ini akan dihapus dan dipindahkan ke arsip.</p>
                <p class="text-center text-warning small">Tindakan ini dapat dibatalkan dengan mengembalikan data dari arsip.</p>
                <input type="hidden" id="delete_sale_id">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <button type="button" id="confirm_delete" class="btn btn-danger px-4">
                    <i class="bi bi-trash me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // When delete button is clicked, set the sale id
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#delete_sale_id').val(id);
        });
        
        // Handle confirm delete button click
        $('#confirm_delete').on('click', function() {
            var saleId = $('#delete_sale_id').val();
            
            $.ajax({
                url: '<?= base_url("transactions/sales/delete") ?>',
                type: 'POST',
                data: {
                    id: saleId
                },
                dataType: 'json',
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    $('#deleteModal').modal('hide');
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menghapus data'
                    });
                }
            });
        });
    });
</script>