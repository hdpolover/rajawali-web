<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('master-data/services/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_service_name" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="add_service_name" name="service_name">
                    </div>
                    <div class="mb-3">
                        <label for="add_difficulty" class="form-label">Tingkat Kesulitan</label>
                        <select class="form-select" id="add_difficulty" name="difficulty">
                            <option value="1">Ringan</option>
                            <option value="2">Sedang</option>
                            <option value="3">Besar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add_price" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="add_price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="add_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="add_description" name="description" rows="3"></textarea>
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