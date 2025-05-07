<?php
// delete modal
?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('master-data/motorcycles/delete') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete_id">
                    <p>Apakah Anda yakin ingin menghapus data motor ini?</p>
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
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            
            var modal = $(this);
            modal.find('.modal-body #delete_id').val(Number(id));
        });
    });
</script>
