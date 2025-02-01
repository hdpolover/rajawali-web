<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="mb-3">
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activity_logs as $index => $activity_log) : ?>
                            <?php $full_description = ""; ?>
                            <tr class="<?= $activity_log->is_read == 0 ? 'fw-bold' : '' ?>">
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php foreach ($admins as $admin) : ?>
                                        <?php if ($admin->id == $activity_log->admin_id) : ?>
                                            <?php $full_description = $admin->username . " " . $activity_log->description ?>
                                            <?= $full_description ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $activity_log->created_at ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $activity_log->id ?>" data-description="<?= $full_description ?>" data-created-at="<?= $activity_log->created_at ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <?php if ($activity_log->is_read == 0) : ?>
                                        <button type="button" class="btn btn-sm btn-success" onclick="markAsRead(<?= $activity_log->id ?>)">
                                            <i class="bi bi-check2"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<!-- Basic Tables end -->

<!-- view spare part type modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Aktivitas Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="mb-3">
                    <label for="view_description" class="form-label"><strong>Deskripsi</strong></label>
                    <p id="view_description"></p>
                </div>
                <div class="mb-3">
                    <label for="view_created_at" class="form-label
                    "><strong>Tanggal</strong></label>
                    <p id="view_created_at"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var table = $('#table1').DataTable();


        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var description = button.data('description');
            var created_at = button.data('created-at');

            var modal = $(this);

            modal.find('#view_description').text(description);
            modal.find('#view_created_at').text(created_at);
        });

    });
</script>

<?= $this->endSection(); ?>