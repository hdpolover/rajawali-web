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

<?= $this->endSection(); ?>