<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detail Pembelian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view_purchase_date" class="form-label"><strong>Tanggal Pembelian</strong></label>
                            <p id="view_purchase_date"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_supplier" class="form-label"><strong>Supplier</strong></label>
                            <p id="view_supplier"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_admin" class="form-label"><strong>Admin</strong></label>
                            <p id="view_admin"></p>
                        </div>
                        <div class="mb-3">
                            <label for="view_status" class="form-label"><strong>Status</strong></label>
                            <p id="view_status"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view_total" class="form-label"><strong>Total</strong></label>
                            <p id="view_total"></p>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class=" col-12">
                        <div class="mb-3">
                            <label for="view_details" class="form-label"><strong>Detail Spare Part</strong></label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Merk</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="view_details">
                                    <!-- Purchase details will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label"><strong>Detail Pembayaran</strong></label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Metode</th>
                                        <th>Total</th>
                                        <th>Keterangan</th>
                                        <th>Bukti Bayar</th>
                                    </tr>
                                </thead>
                                <tbody id="view_payments">
                                </tbody>
                            </table>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var purchases = <?= json_encode($purchases) ?>;

            var purchase = purchases.find(purchase => purchase.id == id);

            console.log(purchase);

            var purchase_date = formatDateTime(purchase.purchase_date);
            var supplier = purchase.supplier.name;
            var admin = purchase.admin.username;
            var status = purchase.status;
            var details = purchase.details;
            var total = purchase.total;

            var modal = $(this);
            modal.find('.modal-body #view_purchase_date').text(purchase_date);
            modal.find('.modal-body #view_supplier').text(supplier);
            modal.find('.modal-body #view_admin').text(admin);
            modal.find('.modal-body #view_status').text(get_purchase_status(status));
            modal.find('.modal-body #view_total').text(formatCurrencyID(total));

            var detailsTable = modal.find('.modal-body #view_details');
            detailsTable.empty();
            details.forEach((detail, index) => {
                detailsTable.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${detail.spare_part.code_number}</td>
                        <td>${detail.spare_part.merk}</td>
                        <td>${detail.spare_part.name}</td>
                        <td>${detail.quantity}</td>
                        <td>${formatCurrencyID(detail.buy_price)}</td>
                        <td>${formatCurrencyID(detail.sell_price)}</td>
                        <td>${formatCurrencyID(detail.sub_total)}</td>
                    </tr>
                `);
            });

            var paymentsTable = modal.find('.modal-body #view_payments');
            paymentsTable.empty();

            var paymentDetails = purchase.payment.details;

            paymentDetails.forEach((payment, index) => {
                var payment_date = formatDateTime(payment.payment_date);
                var payment_method = payment.payment_type;
                var sub_total = payment.sub_total;
                var description = payment.description;
                var proof_of_payment = payment.proof_of_payment;

                paymentsTable.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${payment_date}</td>
                        <td>${payment_method}</td>
                        <td>${formatCurrencyID(sub_total)}</td>
                        <td>${description}</td>
                        <td>
                            <a href="<?= STORAGE_URL . 'payments/' ?>${proof_of_payment}" target="_blank">
                                <img src="<?= STORAGE_URL . 'payments/' ?>${proof_of_payment}" alt="Bukti Pembayaran" class="img-fluid" style="max-width: 100px;">
                            </a>
                        </td>
                    </tr>
                `);
            });
        });
    });

    function get_purchase_status(status) {
        if (status == '0') {
            return '<span class="badge bg-warning">Pending</span>';
        } else if (status == '1') {
            return '<span class="badge bg-success">Selesai</span>';
        } else {
            return '<span class="badge bg-danger">Gagal</span>';
        }
    }
</script>