<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data penjualan ini?</p>
                <p class="text-warning"><small>Data yang dihapus akan dipindahkan ke arsip.</small></p>
                <input type="hidden" id="delete_sale_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="confirm_delete" class="btn btn-danger">Hapus</button>
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