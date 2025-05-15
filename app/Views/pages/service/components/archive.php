<?php
// app/Views/pages/service/components/archive.php
?>
<!-- archive modal -->
<div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Servis Diarsipkan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" id="archivedTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Tingkat Kesulitan</th>
                                <th>Tanggal Arsip</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="archive_services">
                            <tr>
                                <td colspan="6" class="text-center">Memuat data...</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load archived services when modal is shown
        $('#archiveModal').on('show.bs.modal', function() {
            // Get archived services via AJAX
            $.ajax({
                url: '<?= base_url('master-data/services/archived') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        let html = '';
                        response.forEach(function(service, index) {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${service.name}</td>
                                    <td>${service.description}</td>
                                    <td>${get_service_difficulty_level(service.difficulty)}</td>
                                    <td>${formatDateTime(service.deleted_at)}</td>
                                    <td>
                                        <a href="<?= base_url('master-data/services/restore') ?>/${service.id}" class="btn btn-sm btn-success">
                                            <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#archive_services').html(html);
                    } else {
                        $('#archive_services').html('<tr><td colspan="6" class="text-center">Belum ada servis yang diarsipkan</td></tr>');
                    }
                },
                error: function() {
                    $('#archive_services').html('<tr><td colspan="6" class="text-center">Gagal memuat data</td></tr>');
                }
            });
        });
    });
</script>
