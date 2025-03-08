<!-- Edit sale Modal -->
<div class="modal fade" id="editSaleModal" tabindex="-1" aria-labelledby="editSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSaleModalLabel">Edit Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSaleForm">
                <input type="hidden" name="sale_id" id="edit_sale_id">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_sale_number" class="form-label">Kode Transaksi</label>
                                <input type="text" class="form-control" id="edit_sale_number" name="sale_number" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_sale_date" class="form-label">Tanggal Penjualan</label>
                                <input type="text" class="form-control" id="edit_sale_date" name="sale_date" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_customer" class="form-label">Pelanggan</label>
                                <input type="text" class="form-control" id="edit_customer" name="customer" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status Transaksi</label>
                                <select class="form-select" id="edit_status" name="status">
                                    <option value="pending">Pending</option>
                                    <option value="process">Proses</option>
                                    <option value="completed">Selesai</option>
                                    <option value="canceled">Batal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_discount" class="form-label">Diskon</label>
                                <input type="number" class="form-control" id="edit_discount" name="discount" min="0">
                            </div>
                            <div class="mb-3">
                                <label for="edit_total" class="form-label">Total</label>
                                <input type="text" class="form-control" id="edit_total" name="total" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_description" class="form-label">Catatan</label>
                                <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Management Section -->
                    <div class="row">
                        <div class="col-12">
                            <h5>Manajemen Pembayaran</h5>
                            <div class="mb-3">
                                <label for="payment_details" class="form-label">Riwayat Pembayaran</label>
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="edit_payment_details">
                                            <!-- Payment details will be populated here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add New Payment Section -->
                    <div class="row">
                        <div class="col-12">
                            <h5>Tambah Pembayaran Baru</h5>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="new_payment_method" class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" id="new_payment_method" name="payment_method">
                                        <option value="cash">Tunai</option>
                                        <option value="card">Kartu</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="new_payment_amount" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="new_payment_amount" name="amount" min="0">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="new_payment_date" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="new_payment_date" name="payment_date" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="new_payment_status" class="form-label">Status</label>
                                    <select class="form-select" id="new_payment_status" name="status">
                                        <option value="pending">Pending</option>
                                        <option value="completed" selected>Selesai</option>
                                        <option value="canceled">Batal</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="new_payment_description" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="new_payment_description" name="description" rows="2"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="button" id="add_payment_btn" class="btn btn-primary">Tambah Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#editSaleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var saleData = button.data('sale');
            var modal = $(this);
            
            // Set the sale data in the form
            modal.find('#edit_sale_id').val(saleData.id);
            modal.find('#edit_sale_number').val(saleData.sale_number);
            modal.find('#edit_sale_date').val(formatDateTime(saleData.sale_date));
            modal.find('#edit_customer').val(saleData.customer ? saleData.customer.name : '-');
            modal.find('#edit_status').val(saleData.status);
            modal.find('#edit_discount').val(saleData.discount);
            modal.find('#edit_total').val(formatCurrencyID(saleData.total));
            modal.find('#edit_description').val(saleData.description);
            
            // Load payment details if available
            var paymentDetailsContainer = modal.find('#edit_payment_details');
            paymentDetailsContainer.empty();
            
            if (saleData.payment && saleData.payment.details && saleData.payment.details.length > 0) {
                saleData.payment.details.forEach((detail, index) => {
                    paymentDetailsContainer.append(`
                        <tr data-payment-id="${detail.id}">
                            <td>${index + 1}</td>
                            <td>${getPaymentMethodName(detail.payment_method)}</td>
                            <td>${formatCurrencyID(detail.amount)}</td>
                            <td>${detail.payment_date}</td>
                            <td>
                                <select class="form-select form-select-sm payment-status-select" name="payment_status_${detail.id}">
                                    <option value="pending" ${detail.status === 'pending' ? 'selected' : ''}>Pending</option>
                                    <option value="completed" ${detail.status === 'completed' ? 'selected' : ''}>Selesai</option>
                                    <option value="canceled" ${detail.status === 'canceled' ? 'selected' : ''}>Batal</option>
                                </select>
                            </td>
                            <td>${detail.description || '-'}</td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-payment-btn" data-id="${detail.id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
            } else {
                paymentDetailsContainer.append(`
                    <tr>
                        <td colspan="7" class="text-center">Belum ada riwayat pembayaran</td>
                    </tr>
                `);
            }
            
            // Update remaining payment amount
            updateRemainingPayment();
        });
        
        // Handle adding new payment
        $('#add_payment_btn').on('click', function() {
            var paymentMethod = $('#new_payment_method').val();
            var paymentAmount = $('#new_payment_amount').val();
            var paymentDate = $('#new_payment_date').val();
            var paymentStatus = $('#new_payment_status').val();
            var paymentDescription = $('#new_payment_description').val();
            
            if (!paymentAmount || paymentAmount <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Jumlah pembayaran harus diisi dan lebih dari 0'
                });
                return;
            }
            
            $.ajax({
                url: '<?= base_url("transactions/sales/add_payment") ?>',
                type: 'POST',
                data: {
                    sale_id: $('#edit_sale_id').val(),
                    payment_method: paymentMethod,
                    amount: paymentAmount,
                    payment_date: paymentDate,
                    status: paymentStatus,
                    description: paymentDescription
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then((result) => {
                            // Refresh the payment details table
                            $.ajax({
                                url: '<?= base_url("transactions/sales/get_payments") ?>',
                                type: 'POST',
                                data: {
                                    sale_id: $('#edit_sale_id').val()
                                },
                                dataType: 'json',
                                success: function(paymentData) {
                                    refreshPaymentTable(paymentData);
                                    
                                    // Reset the form
                                    $('#new_payment_amount').val('');
                                    $('#new_payment_description').val('');
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi.'
                    });
                }
            });
        });
        
        // Handle form submission
        $('#editSaleForm').on('submit', function(e) {
            e.preventDefault();
            
            var formData = {
                id: $('#edit_sale_id').val(),
                status: $('#edit_status').val(),
                discount: $('#edit_discount').val(),
                description: $('#edit_description').val()
            };
            
            // Include payment status updates
            $('.payment-status-select').each(function() {
                var paymentId = $(this).closest('tr').data('payment-id');
                formData['payment_status_' + paymentId] = $(this).val();
            });
            
            $.ajax({
                url: '<?= base_url("transactions/sales/update") ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then((result) => {
                            $('#editSaleModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi.'
                    });
                }
            });
        });
        
        // Handle delete payment button
        $(document).on('click', '.delete-payment-btn', function() {
            var paymentId = $(this).data('id');
            
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menghapus pembayaran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("transactions/sales/delete_payment") ?>',
                        type: 'POST',
                        data: {
                            id: paymentId,
                            sale_id: $('#edit_sale_id').val()
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                }).then((result) => {
                                    // Refresh the payment details table
                                    $.ajax({
                                        url: '<?= base_url("transactions/sales/get_payments") ?>',
                                        type: 'POST',
                                        data: {
                                            sale_id: $('#edit_sale_id').val()
                                        },
                                        dataType: 'json',
                                        success: function(paymentData) {
                                            refreshPaymentTable(paymentData);
                                        }
                                    });
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message
                                });
                            }
                        }
                    });
                }
            });
        });
    });
    
    function refreshPaymentTable(paymentData) {
        var paymentDetailsContainer = $('#edit_payment_details');
        paymentDetailsContainer.empty();
        
        if (paymentData && paymentData.length > 0) {
            paymentData.forEach((detail, index) => {
                paymentDetailsContainer.append(`
                    <tr data-payment-id="${detail.id}">
                        <td>${index + 1}</td>
                        <td>${getPaymentMethodName(detail.payment_method)}</td>
                        <td>${formatCurrencyID(detail.amount)}</td>
                        <td>${detail.payment_date}</td>
                        <td>
                            <select class="form-select form-select-sm payment-status-select" name="payment_status_${detail.id}">
                                <option value="pending" ${detail.status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="completed" ${detail.status === 'completed' ? 'selected' : ''}>Selesai</option>
                                <option value="canceled" ${detail.status === 'canceled' ? 'selected' : ''}>Batal</option>
                            </select>
                        </td>
                        <td>${detail.description || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-payment-btn" data-id="${detail.id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `);
            });
        } else {
            paymentDetailsContainer.append(`
                <tr>
                    <td colspan="7" class="text-center">Belum ada riwayat pembayaran</td>
                </tr>
            `);
        }
        
        updateRemainingPayment();
    }
    
    function getPaymentMethodName(method) {
        switch (method) {
            case 'cash': return 'Tunai';
            case 'card': return 'Kartu';
            case 'transfer': return 'Transfer';
            default: return method || 'Tunai';
        }
    }
    
    function updateRemainingPayment() {
        // Calculate total paid amount
        var saleTotal = revertCurrencyID($('#edit_total').val());
        var totalPaid = 0;
        
        $('#edit_payment_details tr[data-payment-id]').each(function() {
            var paymentStatus = $(this).find('.payment-status-select').val();
            if (paymentStatus === 'completed') {
                var amount = $(this).find('td:nth-child(3)').text();
                totalPaid += revertCurrencyID(amount);
            }
        });
        
        // Update payment amount field with remaining amount
        var remaining = saleTotal - totalPaid;
        if (remaining > 0) {
            $('#new_payment_amount').val(remaining);
        } else {
            $('#new_payment_amount').val(0);
        }
    }
</script>