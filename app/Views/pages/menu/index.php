<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<!-- Basic Tables start -->
<section class="section">

    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus"></i> Menu Baru
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
                            <th>ID</th>
                            <th>Parent ID</th>
                            <th>Judul Menu</th>
                            <th>Icon</th>
                            <th>URL</th>
                            <th>Urutan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menus as $index => $menu) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($menu->id) ?></td>
                                <td><?= is_null($menu->parent_id) ? '-' : esc($menu->parent_id) ?></td>
                                <td><?= esc($menu->title) ?></td>
                                <td><?= esc($menu->icon) ?></td>
                                <td><?= esc($menu->url) ?></td>
                                <td><?= esc($menu->order_position) ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewAdminModal" data-id="<?= $menu->id ?>" data-parent_id="<?= $menu->parent_id ?>" data-title="<?= esc($menu->title) ?>" data-icon="<?= esc($menu->icon) ?>" data-url="<?= esc($menu->url) ?>" data-order_position="<?= esc($menu->order_position) ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAdminModal" data-id="<?= $menu->id ?>" data-parent_id="<?= $menu->parent_id ?>" data-title="<?= esc($menu->title) ?>" data-icon="<?= esc($menu->icon) ?>" data-url="<?= esc($menu->url) ?>" data-order_position="<?= esc($menu->order_position) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAdminModal" data-id="<?= $menu->id ?>">
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

<!-- view menu modal -->
<div class="modal fade" id="viewAdminModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body
            ">
                <div class="mb-3">
                    <label for="view_id" class="form-label"><strong>ID</strong></label>
                    <p id="view_id"></p>
                </div>
                <div class="mb-3">
                    <label for="view_parent_id" class="form-label
                "><strong>Parent ID</strong></label>
                    <p id="view_parent_id"></p>
                </div>
                <div class="mb-3">
                    <label for="view_title" class="form-label"><strong>Judul Menu</strong></label>
                    <p id="view_title"></p>
                </div>
                <div class="mb-3">
                    <label for="view_icon" class="form-label"><strong>Icon</strong></label>
                    <p id="view_icon"></p>
                </div>
                <div class="mb-3">
                    <label for="view_url" class="form-label"><strong>URL</strong></label>
                    <p id="view_url"></p>
                </div>
                <div class="mb-3">
                    <label for="view_order_position" class="form-label"><strong>Urutan</strong></label>
                    <p id="view_order_position"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var viewModal = document.getElementById('viewAdminModal')
    viewModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var parent_id = button.getAttribute('data-parent_id')
        var title = button.getAttribute('data-title')
        var icon = button.getAttribute('data-icon')
        var url = button.getAttribute('data-url')
        var order_position = button.getAttribute('data-order_position')

        viewModal.querySelector('#view_id').textContent = id
        viewModal.querySelector('#view_parent_id').textContent = parent_id
        viewModal.querySelector('#view_title').textContent = title
        viewModal.querySelector('#view_icon').textContent = icon
        viewModal.querySelector('#view_url').textContent = url
        viewModal.querySelector('#view_order_position').textContent = order_position
    })
</script>

<?= $this->endSection(); ?>