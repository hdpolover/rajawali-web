<!-- Archive Modal -->
<div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveModalLabel">Arsip Pembelian Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="archiveTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Pembelian</th>
                                <th>Supplier</th>
                                <th>Spare Part</th>
                                <th>Admin</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="archivePurchasesList">
                            <!-- Archived purchases will be loaded here -->
                            <tr id="archiveLoadingRow">
                                <td colspan="7" class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <p class="mt-2">Memuat data arsip...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Restore Confirmation Modal -->
<div class="modal fade" id="restoreModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('transactions/purchases/restore') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pemulihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="restore_id" id="restore_id">
                    <p>Apakah Anda yakin ingin memulihkan data pembelian spare part ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Pulihkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Format date helper
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }
        
        // Get purchase status display text
        function getPurchaseStatusText(status) {
            switch(status) {
                case '0': return '<span class="badge bg-warning">Pending</span>';
                case '1': return '<span class="badge bg-success">Selesai</span>';
                case '2': return '<span class="badge bg-danger">Gagal</span>';
                default: return '<span class="badge bg-secondary">Tidak Diketahui</span>';
            }
        }
        
        // Load archived purchases when archive modal is opened
        $('#archiveModal').on('show.bs.modal', function() {
            // Show loading indicator
            $('#archivePurchasesList').html(`
                <tr>
                    <td colspan="7" class="text-center">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <p class="mt-2">Memuat data arsip...</p>
                    </td>
                </tr>
            `);
            
            // Fetch archived purchases via AJAX
            $.ajax({
                url: '<?= site_url('transactions/purchases/archived') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const purchases = response.data;
                        
                        if (purchases.length === 0) {
                            $('#archivePurchasesList').html(`
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <p>Tidak ada data arsip pembelian.</p>
                                    </td>
                                </tr>
                            `);
                            return;
                        }
                        
                        let html = '';
                        purchases.forEach((purchase, index) => {
                            const sparePartNames = purchase.details.map(detail => detail.spare_part.name).join(', ');
                            
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${formatDate(purchase.purchase_date)}</td>
                                    <td>${purchase.supplier ? purchase.supplier.name : '-'}</td>
                                    <td>
                                        <ul class="mb-0 ps-3">
                                            ${purchase.details.map(detail => `<li>${detail.spare_part.name}</li>`).join('')}
                                        </ul>
                                    </td>
                                    <td>${purchase.admin.username}</td>
                                    <td>${getPurchaseStatusText(purchase.status)}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="${purchase.id}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#restoreModal" data-id="${purchase.id}">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        });
                        
                        $('#archivePurchasesList').html(html);
                    } else {
                        $('#archivePurchasesList').html(`
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="text-danger">Gagal memuat data arsip: ${response.message}</p>
                                </td>
                            </tr>
                        `);
                    }
                },
                error: function() {
                    $('#archivePurchasesList').html(`
                        <tr>
                            <td colspan="7" class="text-center">
                                <p class="text-danger">Terjadi kesalahan saat memuat data arsip. Silakan coba lagi.</p>
                            </td>
                        </tr>
                    `);
                }
            });
        });
        
        // Set purchase ID when restore modal is opened
        $('#restoreModal').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            const id = button.data('id');
            $('#restore_id').val(id);
            
            // Close the archive modal to prevent having multiple modals open
            $('#archiveModal').modal('hide');
        });
        
        // Re-open archive modal when restore modal is closed
        $('#restoreModal').on('hidden.bs.modal', function() {
            $('#archiveModal').modal('show');
        });
    });
</script>