<!-- view service details modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Servis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="view_name" class="form-label"><strong>Nama</strong></label>
                    <p id="view_name"></p>
                </div>
                <div class="mb-3">
                    <label for="view_description" class="form-label"><strong>Deskripsi</strong></label>
                    <p id="view_description"></p>
                </div>
                <div class="mb-3">
                    <label for="view_difficulty" class="form-label"><strong>Kesulitan</strong></label>
                    <p id="view_difficulty"></p>
                </div>
                <div class="mb-3">
                    <label for="view_prices" class="form-label"><strong>Riwayat Biaya</strong></label>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal Efektif</th>
                                <th scope="col">Biaya</th>
                            </tr>
                        </thead>
                        <tbody id="view_prices">
                            <!-- Prices will be populated here -->
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
        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var description = button.data('description');
            var difficulty = button.data('difficulty');
            var prices = button.data('prices');

            var modal = $(this);
            modal.find('.modal-body #view_name').text(name);
            modal.find('.modal-body #view_description').text(description);
            modal.find('.modal-body #view_difficulty').text(get_service_difficulty_level(difficulty));

            var pricesTable = modal.find('.modal-body #view_prices');
            pricesTable.empty();

            if (prices.length > 0) {
                prices.forEach(function(price, index) {
                    // convert price to number
                    price.price = parseFloat(price.price);

                    var currentPrice = formatCurrencyID(price.price);

                    var row = '<tr>';
                    row += '<td>' + (index + 1) + '</td>';
                    row += '<td>' + formatDateTime(price.effective_date) + '</td>';
                    row += '<td>' + currentPrice + '</td>';
                    row += '</tr>';

                    pricesTable.append(row);
                });
            } else {
                var row = '<tr>';
                row += '<td colspan="3">Tidak ada data</td>';
                row += '</tr>';

                pricesTable.append(row);
            }
        });
    });
</script>