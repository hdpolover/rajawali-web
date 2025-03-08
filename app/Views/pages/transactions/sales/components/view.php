<!-- View sale Modal -->
<div class="modal fade" id="viewSaleModal" tabindex="-1" aria-labelledby="viewSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSaleModalLabel">Detail Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view_sale_number" class="form-label"><strong>Kode Transaksi</strong></label>
                            <p id="view_sale_number"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_sale_date" class="form-label"><strong>Tanggal Penjualan</strong></label>
                            <p id="view_sale_date"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_admin" class="form-label"><strong>Admin</strong></label>
                            <p id="view_admin"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_status" class="form-label"><strong>Status Transaksi</strong></label>
                            <p id="view_status"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view_description" class="form-label"><strong>Catatan</strong></label>
                            <p id="view_description"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_discount" class="form-label"><strong>Diskon</strong></label>
                            <p id="view_discount"></p>
                        </div>

                        <div class="mb-3">
                            <label for="view_total" class="form-label"><strong>Total</strong></label>
                            <p id="view_total"></p>
                        </div>
                    </div>
                </div>
                <div id="customer_section">
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="view_customer_name" class="form-label"><strong>Nama Pelanggan</strong></label>
                                <p id="view_customer_name"></p>
                            </div>
                            <div class="mb-3">
                                <label for="view_customer_phone" class="form-label
                                "><strong>Nomor Telepon</strong></label>
                                <p id="view_customer_phone"></p>
                            </div>
                            <div class="mb-3">
                                <label for="view_customer_address" class="form-label"><strong>Alamat</strong></label>
                                <p id="view_customer_address"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="view_motorcycle_brand" class="form-label"><strong>Merk Motor</strong></label>
                                <p id="view_motorcycle_brand"></p>
                            </div>
                            <div class="mb-3">
                                <label for="view_motorcycle_type" class="form-label"><strong>Tipe Motor</strong></label>
                                <p id="view_motorcycle_type"></p>
                            </div>
                            <div class="mb-3">
                                <label for="view_motorcycle_license" class="form-label"><strong>Nomor Polisi</strong></label>
                                <p id="view_motorcycle_license"></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class=" col-12">
                            <div class="mb-3">
                                <label for="view_spare_part_details" class="form-label"><strong>Detail Spare Part</strong></label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Merk</th>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="view_spare_part_details">
                                        <!-- Sale details will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="serviceSection">
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="view_service_details" class="form-label"><strong>Detail Service</strong></label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Service</th>
                                                <th>Mekanik</th>
                                                <th>Harga</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="view_service_details">
                                            <!-- Sale service details will be populated here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="paymentSection">
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="view_payment_details" class="form-label"><strong>Detail Pembayaran</strong></label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="view_payment_details">
                                            <!-- Payment details will be populated here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /View sale Modal -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // set view sale modal content
        $('#viewSaleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var saleId = button.data('id');
            var modal = $(this);

            $saleData = <?= json_encode($sales) ?>;

            var sale = $saleData.find(sale => sale.id == saleId);

            console.log(sale);

            modal.find('#view_sale_number').text(sale.sale_number);
            modal.find('#view_sale_date').text(sale.sale_date);
            modal.find('#view_admin').text(sale.admin.username);
            modal.find('#view_status').text(sale.status);
            modal.find('#view_description').text(sale.description);
            modal.find('#view_discount').text(formatCurrencyID(sale.discount));
            modal.find('#view_total').text(formatCurrencyID(sale.total));

            if (sale.customer != null && sale.motorcycle != null) {
                modal.find('#customer_section').show();
                modal.find('#view_customer_name').text(sale.customer.name);
                modal.find('#view_customer_phone').text(sale.customer.phone);
                modal.find('#view_customer_address').text(sale.customer.address);
                modal.find('#view_motorcycle_brand').text(sale.motorcycle.brand);
                modal.find('#view_motorcycle_type').text(sale.motorcycle.model);
                modal.find('#view_motorcycle_license').text(sale.motorcycle.license_number);
            } else {
                modal.find('#customer_section').hide();
            }

            if (sale.spare_part_sale.details.length > 0) {
                modal.find('#view_spare_part_details').empty();
                sale.spare_part_sale.details.forEach((detail, index) => {
                    modal.find('#view_spare_part_details').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${detail.spare_part.code_number}</td>
                            <td>${detail.spare_part.merk}</td>
                            <td>${detail.spare_part.name}</td>
                            <td>${detail.quantity}</td>
                            <td>${formatCurrencyID(detail.price)}</td>
                            <td>${formatCurrencyID(detail.sub_total)}</td>
                            <td>${detail.description}</td>
                        </tr>
                    `);
                });
            }

            if (sale.service_sale != null && sale.service_sale.details.length > 0) {
                modal.find('#serviceSection').show();
                modal.find('#view_service_details').empty();
                sale.service_sale.details.forEach((detail, index) => {
                    modal.find('#view_service_details').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${detail.service.name}</td>
                            <td>${detail.mechanic.name}</td>
                            <td>${formatCurrencyID(detail.price)}</td>
                            <td>${detail.description}</td>
                        </tr>
                    `);
                });
            } else {
                modal.find('#serviceSection').hide();
            }

            if (sale.payment != null && sale.payment.details.length > 0) {
                modal.find('#paymentSection').show();
                modal.find('#view_payment_details').empty();
                sale.payment.details.forEach((detail, index) => {
                    modal.find('#view_payment_details').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${detail.payment_method.name}</td>
                            <td>${formatCurrencyID(detail.amount)}</td>
                            <td>${detail.payment_date}</td>
                            <td>${detail.status}</td>
                            <td>${detail.note}</td>
                        </tr>
                    `);
                });
            } 


        });
    });
</script>