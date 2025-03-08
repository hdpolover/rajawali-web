<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<!-- Basic Tables start -->
<section class="section">

    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                <i class="bi bi-plus"></i> Admin Baru
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $current_admin_role ?>
                        <?php foreach ($admins as $index => $admin) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($admin->username) ?></td>
                                <td><?= esc($admin->email) ?></td>
                                <td>
                                    <?php foreach ($roles as $role) : ?>
                                        <?php if ($role->id == $admin->role_id) : ?>
                                            <?php $current_admin_role = $role->name ?>
                                            <?= esc($role->name) ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php if ($admin->active) : ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    <?php endif; ?>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewAdminModal" data-id="<?= $admin->id ?>" data-username="<?= esc($admin->username) ?>" data-email="<?= esc($admin->email) ?>" data-role="<?= $current_admin_role ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAdminModal" data-id="<?= $admin->id ?>" data-username="<?= esc($admin->username) ?>" data-email="<?= esc($admin->email) ?>" data-role="<?= esc($admin->role_id) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAdminModal" data-id="<?= $admin->id ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
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

<!-- view admin modal -->
<div class="modal fade" id="viewAdminModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="view_username" class="form-label"><strong>Username</strong></label>
                    <p id="view_username"></p>
                </div>
                <div class="mb-3">
                    <label for="view_email" class="form-label"><strong>Email</strong></label>
                    <p id="view_email"></p>
                </div>
                <div class="mb-3">
                    <label for="view_role" class="form-label"><strong>Role</strong></label>
                    <p id="view_role"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- edit admin modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admins/edit') ?>" method="post">
                <input type="hidden" name="edit_id" id="edit_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit_username" name="edit_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="edit_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select class="form-select" id="edit_role" name="edit_role" required>
                            <option value="">Pilih Role</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role->id ?>"><?= esc($role->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete admin modal -->
<div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admins/delete" method="post">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <p>Apakah Anda yakin ingin menghapus admin ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- add admin modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addAdminForm" action="<?= base_url('admins/add') ?>" method="post">
                <div class="modal-body ">
                    <div class="mb-3">
                        <label for="add_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="add_username" name="add_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="add_email" name="add_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="add_password" name="add_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_role" class="form-label">Role</label>
                        <select class="form-select" id="add_role" name="add_role" required>
                            <option value="">Pilih Role</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role->id ?>"><?= esc($role->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // view admin modal
        var viewAdminModal = document.getElementById('viewAdminModal');
        viewAdminModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var username = button.getAttribute('data-username');
            var email = button.getAttribute('data-email');
            var role = button.getAttribute('data-role');

            viewAdminModal.querySelector('#view_id').textContent = id;
            viewAdminModal.querySelector('#view_username').textContent = username;
            viewAdminModal.querySelector('#view_email').textContent = email;
            viewAdminModal.querySelector('#view_role').textContent = role;
        });

        // edit admin modal
        var editAdminModal = document.getElementById('editAdminModal');
        editAdminModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var username = button.getAttribute('data-username');
            var email = button.getAttribute('data-email');
            var role = button.getAttribute('data-role');

            editAdminModal.querySelector('#edit_id').value = id;
            editAdminModal.querySelector('#edit_username').value = username;
            editAdminModal.querySelector('#edit_email').value = email;
            editAdminModal.querySelector('#edit_role').value = role;
        });

        var deleteAdminModal = document.getElementById('deleteAdminModal');
        deleteAdminModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');

            deleteAdminModal.querySelector('#delete_id').value = id;
        });

    });
</script>

<?= $this->endSection(); ?>