<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('transactions/purchases/delete') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <p>Apakah Anda yakin ingin menghapus data pembelian spare part ini?</p>
                    <p class="text-danger fw-bold">Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait pembelian ini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Set purchase ID when delete modal is opened
        $('#deleteModal').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            const id = button.data('id');
            $('#delete_id').val(id);
        });
    });
</script>