<!-- edit service details modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Servis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="edit_id">
                <div class="mb-3">
                    <label for="edit_name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="edit_name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="edit_description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="edit_description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="edit_difficulty" class="form-label">Tingkat Kesulitan</label>
                    <select class="form-select" id="edit_difficulty" name="difficulty" required>
                        <option value="1">Ringan</option>
                        <option value="2">Sedang</option>
                        <option value="3">Besar</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_prices" class="form-label">Riwayat Biaya</label>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal Efektif</th>
                                <th scope="col">Biaya</th>
                            </tr>
                        </thead>
                        <tbody id="edit_prices">
                            <!-- Prices will be populated here -->
                        </tbody>
                    </table>
                </div>
                <div class="mb-3 text-end">
                    <button type="button" class="btn btn-success" id="addPriceButton">
                        <i class="bi bi-plus"></i> Tambah Biaya Baru
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var description = button.data('description');
            var difficulty = button.data('difficulty');
            var prices = button.data('prices');

            console.log(name);

            var modal = $(this);
            modal.find('.modal-body #edit_id').val(id);
            modal.find('.modal-body #edit_name').val(name);
            modal.find('.modal-body #edit_description').val(description);
            modal.find('.modal-body #edit_difficulty').val(difficulty);

            var pricesTable = modal.find('.modal-body #edit_prices');
            pricesTable.empty();
            prices.forEach(function(price, index) {
                pricesTable.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${price.effective_date}</td>
                        <td>${price.price}</td>
                    </tr>
                `);
            });
        });

        $('#addPriceButton').on('click', function() {
            var pricesTable = $('#editModal').find('.modal-body #edit_prices');
            var index = pricesTable.find('tr').length + 1;
            pricesTable.append(`
                <tr>
                    <td>${index}</td>
                    <td><input type="date" class="form-control" name="prices[${index}][effective_date]" required></td>
                    <td><input type="number" class="form-control" name="prices[${index}][price]" required></td>
                </tr>
            `);
        });
    });

</script>