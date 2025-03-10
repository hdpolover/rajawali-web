<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Changed to modal-xl class for extra large width -->
        <div class="modal-content">
            <form action="<?= base_url('transactions/purchases/add') ?>" method="post" id="purchaseForm">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pembelian Spare Part Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="select_supplier" class="form-label">Supplier</label>
                            <select id="select_supplier" name="select_supplier" class="form-select" required>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="add_purchase_date" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="add_purchase_date" name="purchase_date" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="add_status" class="form-label">Status</label>
                            <select class="form-select" id="add_status" name="status" required>
                                <option value="" disabled>Pilih Status</option>
                                <option value="0" selected>Pending</option>
                                <option value="1">Selesai</option>
                                <option value="2">Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="add_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="add_description" name="description" rows="2"></textarea>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="add_spare_parts" class="form-label">Rincian Spare Part</label>
                        <div class="mb-3 d-flex gap-2 align-items-center">
                            <div style="flex: 1;">
                                <select id="select_spare_part" name="select_spare_part" class="form-select">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-success" id="addSparePart">
                                    <i class="bi bi-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div id="sparePartTable" class="table-responsive">
                            <table class="table table-bordered">
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
                                <tbody id="sparePartsContainer">
                                   <!-- spare part rows will be added here -->
                                </tbody>
                                <tfoot>
                                    <tr class="table-light">
                                        <th colspan="4" class="text-end">Total:</th>
                                        <th colspan="2">
                                            <input type="text" class="form-control" id="display_total" readonly>
                                            <input type="hidden" id="add_total" name="total" value="0">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div id="noSparePartMessage" class="alert alert-warning mt-2">
                            <i class="bi bi-exclamation-triangle"></i> Belum ada spare part yang ditambahkan
                        </div>
                    </div>
                    
                    <hr>
                    <h5>Informasi Pembayaran</h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="add_payment_method" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="add_payment_method" name="payment_method" required>
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="add_payment_date" class="form-label">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" id="add_payment_date" name="payment_date" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="add_payment_amount" class="form-label">Jumlah Pembayaran</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="add_payment_amount" name="payment_amount" step="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="add_payment_status" class="form-label">Status Pembayaran</label>
                            <select class="form-select" id="add_payment_status" name="payment_status" required>
                                <option value="" disabled selected>Pilih Status Pembayaran</option>
                                <option value="paid">Sudah Dibayar</option>
                                <option value="unpaid">Belum Dibayar</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="add_payment_description" class="form-label">Catatan Pembayaran</label>
                        <textarea class="form-control" id="add_payment_description" name="payment_description" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveButton">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Initialize Select2 for supplier
        $('#select_supplier').select2({
            dropdownParent: $("#addModal"),
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Pilih Supplier',
            ajax: {
                url: '<?= base_url('suppliers/fetch') ?>',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        name: params.term, // search term
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

        // Initialize Select2 for spare parts
        $('#select_spare_part').select2({
            dropdownParent: $("#addModal"),
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Pilih Spare Part',
            ajax: {
                url: '<?= site_url('spare-parts/fetch') ?>',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        name: params.term, // search term
                    };
                },
                processResults: function(response) {
                    console.log(response);
                    return {
                        results: response.data
                    };
                },
                cache: true
            }
        });

         // add class for select 2 to form-select
         $('.select2-container').addClass('form-select');

        // Format currency
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        // Calculate grand total
        function calculateTotal() {
            let total = 0;
            $('input[name="sub_totals[]"]').each(function() {
                total += parseInt($(this).val()) || 0;
            });
            $('#add_total').val(total);
            $('#display_total').val(formatRupiah(total));
            $('#add_payment_amount').val(total);
        }

        // Initially hide spare part table until items are added
        $('#sparePartTable').hide();
        
        // Add spare part button handler
        $('#addSparePart').on('click', function() {
            const sparePartId = $('#select_spare_part').val();
            const sparePartName = $('#select_spare_part option:selected').text();

            // Validate selection
            if (!sparePartId) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Silakan pilih spare part terlebih dahulu',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Check for duplicate entries
            if ($(`input[name="spare_part_ids[]"][value="${sparePartId}"]`).length > 0) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Spare part ini sudah ditambahkan',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Add row to the table
            $('#sparePartsContainer').append(`
                <tr data-spare-part-id="${sparePartId}">
                    <td>
                        <input type="hidden" name="spare_part_ids[]" value="${sparePartId}">
                        <input type="text" class="form-control" name="spare_part_names[]" value="${sparePartName}" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control quantity-input" name="quantities[]" min="1" value="1" required>
                    </td>
                    <td>
                        <input type="number" class="form-control buy-price-input" name="buy_prices[]" min="1" step="1" required>
                    </td>
                    <td>
                        <input type="number" class="form-control sell-price-input" name="sell_prices[]" min="1" step="1" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="sub_totals[]" readonly>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-danger remove-spare-part">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `);

            // Reset select2
            $('#select_spare_part').val(null).trigger('change');
            
            // Show the table and hide the no items message
            $('#sparePartTable').show();
            $('#noSparePartMessage').hide();
            
            // Fetch spare part details for the selected item
            $.ajax({
                url: '<?= site_url('spare_parts/get-details') ?>/' + sparePartId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const data = response.data;
                        const row = $(`tr[data-spare-part-id="${sparePartId}"]`);
                        
                        // Set the default values
                        row.find('.buy-price-input').val(data.details.current_buy_price);
                        row.find('.sell-price-input').val(data.details.current_sell_price);
                        
                        // Calculate subtotal
                        const qty = parseInt(row.find('.quantity-input').val()) || 0;
                        const price = parseInt(row.find('.buy-price-input').val()) || 0;
                        row.find('input[name="sub_totals[]"]').val(qty * price);
                        
                        // Update grand total
                        calculateTotal();
                    }
                },
                error: function() {
                    console.error('Failed to fetch spare part details');
                }
            });
        });

        // Handle quantity and price changes to calculate subtotal
        $(document).on('input', '.quantity-input, .buy-price-input', function() {
            const row = $(this).closest('tr');
            const qty = parseInt(row.find('.quantity-input').val()) || 0;
            const price = parseInt(row.find('.buy-price-input').val()) || 0;
            
            // Update subtotal
            row.find('input[name="sub_totals[]"]').val(qty * price);
            
            // Update grand total
            calculateTotal();
        });

        // Remove spare part handler
        $(document).on('click', '.remove-spare-part', function() {
            $(this).closest('tr').remove();
            
            // Check if table is empty
            if ($('#sparePartsContainer tr').length === 0) {
                $('#sparePartTable').hide();
                $('#noSparePartMessage').show();
                $('#add_total').val(0);
                $('#display_total').val(formatRupiah(0));
            }
            
            // Update grand total
            calculateTotal();
        });

        // Form validation before submit
        $('#purchaseForm').on('submit', function(e) {
            // Check if there are spare parts
            if ($('#sparePartsContainer tr').length === 0) {
                e.preventDefault();
                Swal.fire({
                    title: 'Error!',
                    text: 'Silakan tambahkan minimal satu spare part',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            
            // Check if all required fields are filled
            let isValid = true;
            $('#sparePartsContainer tr').each(function() {
                const quantity = $(this).find('.quantity-input').val();
                const buyPrice = $(this).find('.buy-price-input').val();
                const sellPrice = $(this).find('.sell-price-input').val();
                
                if (!quantity || !buyPrice || !sellPrice) {
                    isValid = false;
                    return false; // Break the loop
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    title: 'Error!',
                    text: 'Silakan isi semua detail spare part (jumlah, harga beli, harga jual)',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            
            // Set payment subtotal to match the total
            const total = parseInt($('#add_total').val()) || 0;
            $('input[name="payment_sub_total"]').val(total);
            
            return true;
        });
        
        // Auto-update payment amount when total changes
        $('#add_total').on('change', function() {
            $('#add_payment_amount').val($(this).val());
        });
        
        // Initialize modal with default state when opened
        $('#addModal').on('show.bs.modal', function() {
            $('#purchaseForm')[0].reset();
            $('#sparePartsContainer').empty();
            $('#sparePartTable').hide();
            $('#noSparePartMessage').show();
            $('#add_total').val(0);
            $('#display_total').val(formatRupiah(0));
            $('#select_supplier').val(null).trigger('change');
            $('#select_spare_part').val(null).trigger('change');
        });
    });
</script>