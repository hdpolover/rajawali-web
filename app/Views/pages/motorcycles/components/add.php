<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">        <div class="modal-content">
            <form action="<?= base_url('master-data/motorcycles/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Motor Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_brand" class="form-label">Merek</label>
                        <input type="text" class="form-control" id="add_brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="add_model" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_license_number" class="form-label">Nomor Plat</label>
                        <input type="text" class="form-control" id="add_license_number" name="license_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_customer_id" class="form-label">Pemilik</label>
                        <select class="form-select" id="add_customer_id" name="customer_id" required>
                            <option value="">Pilih Pemilik</option>
                            <?php foreach ($customers as $customer) : ?>
                                <option value="<?= $customer->id ?>"><?= esc($customer->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>