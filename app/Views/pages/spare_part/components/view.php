<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="" id="view_photo" class="img-fluid" alt="Photo">
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view_code_number" class="form-label"><strong>Kode Barcode</strong></label>
                            <p id="view_code_number"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_name" class="form-label"><strong>Nama</strong></label>
                            <p id="view_name"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_merk" class="form-label"><strong>Merk</strong></label>
                            <p id="view_merk"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_description" class="form-label"><strong>Deskripsi</strong></label>
                            <p id="view_description"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_stock" class="form-label"><strong>Stok</strong></label>
                            <p id="view_stock"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_sell_price" class="form-label"><strong>Harga Jual Sekarang</strong></label>
                            <p id="view_sell_price"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_buy_price" class="form-label"><strong>Harga Beli Sekarang</strong></label>
                            <p id="view_buy_price"></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Riwayat Harga</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Harga Jual</th>
                                    <th>Harga Beli</th>
                                </tr>
                            </thead>
                            <tbody id="price_history">
                                <!-- Price history will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- End of View Modal -->

<script>
    // get price history by spare part id
    function getPriceHistory(id) {
        return fetch(`<?= base_url('master-data/spare-parts/price-history/') ?>${id}`)
            .then(response => response.json())
            .then(data => data);
    }

    document.addEventListener('DOMContentLoaded', function() {
        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            // get spare part data by id from spare part array in index.php
            var spare_part = <?= json_encode($spare_parts) ?>;
            spare_part = spare_part.find(spare_part => spare_part.id == id);

            var name = spare_part.name;
            var merk = spare_part.merk;
            var code_number = spare_part.code_number;
            var description = spare_part.description;
            var stock = spare_part.details.current_stock;
            var sell_price = spare_part.details.current_sell_price;
            var buy_price = spare_part.details.current_buy_price;

            var photo = '<?= STORAGE_URL .  'spare_parts/' ?>' + spare_part.photo;

            // conver prices to float
            sell_price = parseFloat(sell_price);
            buy_price = parseFloat(buy_price);

            // format prices to rupiah

            var modal = $(this);
            modal.find('.modal-body #view_name').text(name);
            modal.find('.modal-body #view_merk').text(merk);
            modal.find('.modal-body #view_code_number').text(code_number);
            modal.find('.modal-body #view_description').text(description);
            modal.find('.modal-body #view_stock').text(stock);
            modal.find('.modal-body #view_sell_price').text(formatCurrencyID(sell_price));
            modal.find('.modal-body #view_buy_price').text(formatCurrencyID(buy_price));
            modal.find('.modal-body #view_photo').attr('src', photo);

            // get price history by spare part id
            getPriceHistory(id).then(data => {
                var price_history = modal.find('.modal-body #price_history');
                price_history.empty();

                if (data.length > 0) {
                    data.forEach((price, index) => {
                        // convert prices to float
                        price.new_sell_price = parseFloat(price.new_sell_price);
                        price.new_buy_price = parseFloat(price.new_buy_price);

                        // format prices to rupiah
                        var formatted_sell_price = formatCurrencyID(price.new_sell_price);
                        var formatted_buy_price = formatCurrencyID(price.new_buy_price);

                        var row = '<tr>';
                        row += `<td>${index + 1}</td>`;
                        row += `<td>${formatDateTime(price.change_date)}</td>`;
                        row += `<td>${formatted_sell_price}</td>`;
                        row += `<td>${formatted_buy_price}</td>`;
                        row += '</tr>';

                        price_history.append(row);
                    });
                } else {
                    var row = '<tr>';
                    row += '<td colspan="4" class="text-center">Tidak ada data</td>';
                    row += '</tr>';

                    price_history.append(row);
                }
            });


        });
    });
</script>