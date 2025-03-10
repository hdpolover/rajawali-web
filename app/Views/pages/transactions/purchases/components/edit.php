<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?= base_url('transactions/purchases/update') ?>" method="post" id="editPurchaseForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pembelian Spare Part</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="purchase_id" id="edit_purchase_id">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_supplier" class="form-label">Supplier</label>
                            <select id="edit_supplier" name="supplier_id" class="form-select" required>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_purchase_date" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="edit_purchase_date" name="purchase_date" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="0">Pending</option>
                                <option value="1">Selesai</option>
                                <option value="2">Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="2"></textarea>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="editSparePartTable">
                            <thead>
                                <tr class="table-light">
                                    <th style="width: 35%;">Spare Part</th>
                                    <th style="width: 10%;">Jumlah</th>
                                    <th style="width: 15%;">Harga Beli</th>
                                    <th style="width: 15%;">Harga Jual</th>
                                    <th style="width: 15%;">Sub Total</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="editSparePartsContainer">
                                <!-- spare part rows will be populated here -->
                            </tbody>
                            <tfoot>
                                <tr class="table-light">
                                    <th colspan="4" class="text-end">Total:</th>
                                    <th colspan="2">
                                        <input type="text" class="form-control" id="edit_display_total" readonly>
                                        <input type="hidden" id="edit_total" name="total" value="0">
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <hr>
                    <h5>Informasi Pembayaran</h5>
                    <input type="hidden" name="payment_id" id="edit_payment_id">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_payment_status" class="form-label">Status Pembayaran</label>
                            <select class="form-select" id="edit_payment_status" name="payment_status" required>
                                <option value="paid">Sudah Dibayar</option>
                                <option value="unpaid">Belum Dibayar</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_payment_description" class="form-label">Catatan Pembayaran</label>
                            <textarea class="form-control" id="edit_payment_description" name="payment_description" rows="2"></textarea>
                        </div>
                    </div>
                    
                    <div id="editPaymentsContainer">
                        <h6>Detail Pembayaran</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="paymentDetailsTable">
                                <thead>
                                    <tr class="table-light">
                                        <th>Tanggal</th>
                                        <th>Metode</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="paymentDetailsRows">
                                    <!-- payment details will be populated here -->
                                </tbody>
                            </table>
                        </div>
                        
                        <button type="button" class="btn btn-sm btn-primary" id="addPaymentDetailBtn">
                            <i class="bi bi-plus-circle"></i> Tambah Pembayaran
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Payment Detail Modal -->
<div class="modal fade" id="addPaymentDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Detail Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="parent_payment_id">
                <div class="mb-3">
                    <label for="payment_date" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" class="form-control" id="payment_date" value="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" id="payment_method" required>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="payment_amount" class="form-label">Jumlah Pembayaran</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" id="payment_amount" min="1" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="payment_status" class="form-label">Status Pembayaran</label>
                    <select class="form-select" id="payment_detail_status" required>
                        <option value="paid">Sudah Dibayar</option>
                        <option value="unpaid">Belum Dibayar</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="payment_note" class="form-label">Catatan</label>
                    <textarea class="form-control" id="payment_note" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="savePaymentDetail">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        // Initialize Select2 for supplier in edit modal
        $('#edit_supplier').select2({
            dropdownParent: $("#editModal"),
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Pilih Supplier',
            ajax: {
                url: '<?= site_url('suppliers/fetch') ?>',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        name: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response.data
                    };
                },
                cache: true
            }
        });
        
        // Format currency
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }
        
        // Calculate totals in edit form
        function calculateEditTotal() {
            let total = 0;
            $('#editSparePartsContainer tr').each(function() {
                const subTotal = parseInt($(this).find('input[name="edit_sub_totals[]"]').val()) || 0;
                total += subTotal;
            });
            $('#edit_total').val(total);
            $('#edit_display_total').val(formatRupiah(total));
        }
        
        // Handle quantity and price changes in edit form
        $(document).on('input', '.edit-quantity, .edit-buy-price', function() {
            const row = $(this).closest('tr');
            const qty = parseInt(row.find('.edit-quantity').val()) || 0;
            const price = parseInt(row.find('.edit-buy-price').val()) || 0;
            const subTotal = qty * price;
            
            row.find('input[name="edit_sub_totals[]"]').val(subTotal);
            calculateEditTotal();
        });
        
        // Remove spare part from edit form
        $(document).on('click', '.edit-remove-spare-part', function() {
            const detailId = $(this).data('id');
            
            if (detailId) {
                // This is an existing record, mark for deletion
                $('#editPurchaseForm').append(`<input type="hidden" name="delete_details[]" value="${detailId}">`);
            }
            
            $(this).closest('tr').remove();
            calculateEditTotal();
        });

        // Open edit modal with purchase data
        $('#editModal').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            const purchase = button.data('purchase');
            
            // Reset form
            $('#editPurchaseForm')[0].reset();
            $('#editSparePartsContainer').empty();
            $('#paymentDetailsRows').empty();
            
            // Populate base purchase data
            $('#edit_purchase_id').val(purchase.id);
            $('#edit_purchase_date').val(purchase.purchase_date);
            $('#edit_status').val(purchase.status);
            $('#edit_description').val(purchase.description);
            
            // Set supplier
            if (purchase.supplier) {
                const supplierOption = new Option(purchase.supplier.name, purchase.supplier.id, true, true);
                $('#edit_supplier').append(supplierOption).trigger('change');
            }
            
            // Populate spare parts
            if (purchase.details && purchase.details.length > 0) {
                purchase.details.forEach(function(detail) {
                    $('#editSparePartsContainer').append(`
                        <tr>
                            <td>
                                <input type="hidden" name="detail_ids[]" value="${detail.id}">
                                <input type="hidden" name="edit_spare_part_ids[]" value="${detail.spare_part_id}">
                                <input type="text" class="form-control" value="${detail.spare_part.name}" readonly>
                            </td>
                            <td>
                                <input type="number" class="form-control edit-quantity" name="edit_quantities[]" 
                                    min="1" value="${detail.quantity}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control edit-buy-price" name="edit_buy_prices[]" 
                                    min="1" value="${detail.buy_price}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control edit-sell-price" name="edit_sell_prices[]" 
                                    min="1" value="${detail.sell_price || 0}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="edit_sub_totals[]" 
                                    value="${detail.sub_total}" readonly>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger edit-remove-spare-part" data-id="${detail.id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                // Calculate initial total
                calculateEditTotal();
            }
            
            // Populate payment information
            if (purchase.payment) {
                $('#edit_payment_id').val(purchase.payment.id);
                $('#edit_payment_status').val(purchase.payment.status);
                $('#edit_payment_description').val(purchase.payment.description);
                
                // Populate payment details
                if (purchase.payment.details && purchase.payment.details.length > 0) {
                    purchase.payment.details.forEach(function(detail) {
                        $('#paymentDetailsRows').append(`
                            <tr>
                                <td>${formatDate(detail.payment_date)}</td>
                                <td>${detail.payment_type}</td>
                                <td>${formatRupiah(detail.sub_total)}</td>
                                <td>${detail.status === 'paid' ? 'Sudah Dibayar' : 'Belum Dibayar'}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger delete-payment-detail" 
                                        data-id="${detail.id}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                }
            }
        });
        
        // Format date helper
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }
        
        // Open add payment detail modal
        $('#addPaymentDetailBtn').on('click', function() {
            const paymentId = $('#edit_payment_id').val();
            if (!paymentId) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Data pembayaran tidak ditemukan.',
                    icon: 'error'
                });
                return;
            }
            
            $('#parent_payment_id').val(paymentId);
            $('#addPaymentDetailModal').modal('show');
        });
        
        // Save new payment detail
        $('#savePaymentDetail').on('click', function() {
            const paymentId = $('#parent_payment_id').val();
            const paymentDate = $('#payment_date').val();
            const paymentMethod = $('#payment_method').val();
            const paymentAmount = $('#payment_amount').val();
            const paymentStatus = $('#payment_detail_status').val();
            const paymentNote = $('#payment_note').val();
            
            // Validate inputs
            if (!paymentDate || !paymentMethod || !paymentAmount) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Harap isi semua field yang diperlukan.',
                    icon: 'error'
                });
                return;
            }
            
            // Save payment detail via AJAX
            $.ajax({
                url: '<?= site_url('transactions/purchases/add-payment-detail') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    payment_id: paymentId,
                    payment_date: paymentDate,
                    payment_method: paymentMethod,
                    amount: paymentAmount,
                    status: paymentStatus,
                    description: paymentNote
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Add row to payment details table
                        $('#paymentDetailsRows').append(`
                            <tr>
                                <td>${formatDate(paymentDate)}</td>
                                <td>${paymentMethod}</td>
                                <td>${formatRupiah(paymentAmount)}</td>
                                <td>${paymentStatus === 'paid' ? 'Sudah Dibayar' : 'Belum Dibayar'}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger delete-payment-detail" 
                                        data-id="${response.data.id}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                        
                        // Close modal and reset form
                        $('#addPaymentDetailModal').modal('hide');
                        $('#addPaymentDetailModal form')[0].reset();
                        
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Detail pembayaran berhasil ditambahkan.',
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message || 'Gagal menambahkan detail pembayaran.',
                            icon: 'error'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghubungi server.',
                        icon: 'error'
                    });
                }
            });
        });
        
        // Delete payment detail
        $(document).on('click', '.delete-payment-detail', function() {
            const detailId = $(this).data('id');
            const row = $(this).closest('tr');
            
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus detail pembayaran ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send delete request via AJAX
                    $.ajax({
                        url: '<?= site_url('transactions/purchases/delete-payment-detail') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: detailId
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                row.remove();
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Detail pembayaran berhasil dihapus.',
                                    icon: 'success'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message || 'Gagal menghapus detail pembayaran.',
                                    icon: 'error'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menghubungi server.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });
</script>