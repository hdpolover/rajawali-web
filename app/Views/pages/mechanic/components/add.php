<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('mechanics/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mekanik Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="add_name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="add_phone" class="form-label">Telepon</label>
                        <input type="tel" class="form-control" id="add_phone" name="phone">
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