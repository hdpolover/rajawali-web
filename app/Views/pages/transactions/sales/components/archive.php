<!-- Archive Modal -->
<div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveModalLabel">Data Penjualan Diarsipkan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Lihat daftar penjualan yang telah diarsipkan?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="<?= base_url('transactions/sales/archived') ?>" class="btn btn-primary">Lihat Arsip</a>
            </div>
        </div>
    </div>
</div>