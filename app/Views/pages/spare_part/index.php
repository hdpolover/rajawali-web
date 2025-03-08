<?= $this->extend('templates/partials/base'); ?>

<?= $this->section('content'); ?>
<!-- Basic Tables start -->
<section class="section">

    <div class="row mb-4">
        <div class="col-12 text-end">
        <a href="<?= base_url("master-data/spare-parts/new") ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Spare Part Baru
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barcode</th>
                            <!-- <th>Foto</th> -->
                            <th>Nama</th>
                            <th>Merk</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($spare_parts as $index => $spare_part) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($spare_part->code_number) ?></td>
                                <!-- <td>
                                     <?php
                                        $sparePartImage = STORAGE_URL . DIRECTORY_SEPARATOR . 'spare_parts' . DIRECTORY_SEPARATOR . $spare_part->photo;
                                        ?>
                                        <img src="<?= $sparePartImage ?>" alt="<?= esc($spare_part->name) ?>" class="img-fluid" style="max-width: 100px;">
                                     </td> -->
                                <td><?= esc($spare_part->name) ?></td>
                                <td><?= esc($spare_part->merk) ?></td>
                                <td class="<?= $spare_part->details->current_stock < 5 ? 'table-danger' : '' ?>"><?= esc($spare_part->details->current_stock) ?></td>
                                <td><?= format_rupiah(esc($spare_part->details->current_sell_price)) ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $spare_part->id ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $spare_part->id ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $spare_part->id ?>">
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

<!-- include Spare Part Modal from the other folder-->
<?= $this->include('pages/spare_part/components/add'); ?>
<?= $this->include('pages/spare_part/components/view'); ?>
<?= $this->include('pages/spare_part/components/edit'); ?>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('master-data/spare-parts/delete') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <p>Apakah Anda yakin ingin menghapus spare part ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#delete_id').val(id);
        });
    });
</script>

<?= $this->endSection(); ?>