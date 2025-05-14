<!-- View sale Modal -->
<div class="modal fade" id="viewSaleModal" tabindex="-1" aria-labelledby="viewSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewSaleModalLabel">
                    <i class="bi bi-clipboard-data me-2"></i>Detail Penjualan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Sale Header Information -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Informasi Transaksi</h6>
                            <span class="badge bg-primary" id="view_sale_number_badge"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted"><i class="bi bi-upc me-1"></i>Kode Transaksi</label>
                                    <p class="fw-bold fs-5" id="view_sale_number"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted"><i class="bi bi-calendar-date me-1"></i>Tanggal Penjualan</label>
                                    <p class="fs-6" id="view_sale_date"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted"><i class="bi bi-person me-1"></i>Admin</label>
                                    <p class="fs-6" id="view_admin"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted"><i class="bi bi-check-circle me-1"></i>Status Transaksi</label>
                                    <p id="view_status"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted"><i class="bi bi-chat-text me-1"></i>Catatan</label>
                                    <p class="text-muted fst-italic" id="view_description"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted"><i class="bi bi-percent me-1"></i>Diskon</label>
                                    <p id="view_discount"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Information Section -->
                <div id="customer_section">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light py-3">
                            <h6 class="mb-0">Informasi Pelanggan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="view_customer_name" class="form-label"><strong>Nama Pelanggan</strong></label>
                                        <p id="view_customer_name"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="view_customer_phone" class="form-label"><strong>Nomor Telepon</strong></label>
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
                        </div>
                    </div>
                </div>
                
                <!-- Spare Part Details Section (Always Visible) -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <h6 class="mb-0">Detail Spare Part</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                
                <!-- Service Section -->
                <div id="serviceSection" class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <h6 class="mb-0">Detail Service</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                
                <!-- Payment Section -->
                <div id="paymentSection" class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <h6 class="mb-0">Detail Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                
                <!-- Summary Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <h6 class="mb-0">Ringkasan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Total Spare Part:</p>
                                <h5 id="view_spare_part_total"></h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Total Keseluruhan:</p>
                                <h5 id="view_total"></h5>
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

            // Transaction information
            modal.find('#view_sale_number').text(sale.sale_number);
            modal.find('#view_sale_number_badge').text(sale.sale_number);
            modal.find('#view_sale_date').text(sale.sale_date);
            modal.find('#view_admin').text(sale.admin.username);
            
            // Set status with appropriate badge color
            let statusClass = 'bg-primary';
            if (sale.status === 'Lunas') {
                statusClass = 'bg-success';
            } else if (sale.status === 'Pending') {
                statusClass = 'bg-warning text-dark';
            } else if (sale.status === 'Dibatalkan') {
                statusClass = 'bg-danger';
            }
            modal.find('#view_status').html(`<span class="badge ${statusClass}">${sale.status}</span>`);
            
            modal.find('#view_description').text(sale.description || '-');
            modal.find('#view_discount').text(formatCurrencyID(sale.discount));
            modal.find('#view_total').text(formatCurrencyID(sale.total));

            // Customer information section
            if (sale.customer != null && sale.motorcycle != null) {
                modal.find('#customer_section').show();
                modal.find('#view_customer_name').text(sale.customer.name);
                modal.find('#view_customer_phone').text(sale.customer.phone);
                modal.find('#view_customer_address').text(sale.customer.address);
                modal.find('#view_motorcycle_brand').text(sale.motorcycle.brand);
                modal.find('#view_motorcycle_type').text(sale.motorcycle.model);
                modal.find('#view_motorcycle_license').text(sale.motorcycle.license_number);
            } else {
                // Only hide the customer information section
                modal.find('#customer_section').hide();
            }

            // Spare part details section - always process this regardless of customer type
            let sparePartTotal = 0;
            if (sale.spare_part_sale && sale.spare_part_sale.details && sale.spare_part_sale.details.length > 0) {
                modal.find('#view_spare_part_details').empty();
                sale.spare_part_sale.details.forEach((detail, index) => {
                    sparePartTotal += parseFloat(detail.sub_total);
                    modal.find('#view_spare_part_details').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${detail.spare_part.code_number}</td>
                            <td>${detail.spare_part.merk}</td>
                            <td>${detail.spare_part.name}</td>
                            <td>${detail.quantity}</td>
                            <td>${formatCurrencyID(detail.price)}</td>
                            <td>${formatCurrencyID(detail.sub_total)}</td>
                            <td>${detail.description || '-'}</td>
                        </tr>
                    `);
                });
                // Update the spare part total in summary section
                modal.find('#view_spare_part_total').text(formatCurrencyID(sparePartTotal));
            } else {
                modal.find('#view_spare_part_details').html('<tr><td colspan="8" class="text-center">Tidak ada data spare part</td></tr>');
                modal.find('#view_spare_part_total').text(formatCurrencyID(0));
            }

            // Service details section
            if (sale.service_sale != null && sale.service_sale.details && sale.service_sale.details.length > 0) {
                modal.find('#serviceSection').show();
                modal.find('#view_service_details').empty();
                sale.service_sale.details.forEach((detail, index) => {
                    modal.find('#view_service_details').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${detail.service.name}</td>
                            <td>${detail.mechanic.name}</td>
                            <td>${formatCurrencyID(detail.price)}</td>
                            <td>${detail.description || '-'}</td>
                        </tr>
                    `);
                });
            } else {
                modal.find('#serviceSection').hide();
            }

            // Payment details section
            if (sale.payment != null && sale.payment.details && sale.payment.details.length > 0) {
                modal.find('#paymentSection').show();
                modal.find('#view_payment_details').empty();
                sale.payment.details.forEach((detail, index) => {
                    // Status badge
                    let statusClass = 'bg-primary';
                    if (detail.status === 'Lunas') {
                        statusClass = 'bg-success';
                    } else if (detail.status === 'Pending') {
                        statusClass = 'bg-warning text-dark';
                    } else if (detail.status === 'Dibatalkan') {
                        statusClass = 'bg-danger';
                    }
                    
                    modal.find('#view_payment_details').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${detail.payment_method.name}</td>
                            <td>${formatCurrencyID(detail.amount)}</td>
                            <td>${detail.payment_date}</td>
                            <td><span class="badge ${statusClass}">${detail.status}</span></td>
                            <td>${detail.note || '-'}</td>
                        </tr>
                    `);
                });
            } else {
                modal.find('#paymentSection').hide();
            }
        });
    });
</script>