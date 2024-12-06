<!-- Add/Edit Sale Transaction Modal -->
<div class="modal fade" id="saleTransactionModal" tabindex="-1" role="dialog" aria-labelledby="saleTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saleTransactionModalLabel">Add New Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saleTransactionForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="customer">Pelanggan</label>
                        <div class="input-group">
                            <select class="form-control select2" id="customer" name="customer_id" required>
                                <option value="">Select Customer</option>
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">
                                    <i class="fas fa-plus"></i> New Customer
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mechanic">Mekanik</label>
                        <select class="form-control select2" id="mechanic" name="mechanic_id" required>
                            <option value="">Select Mechanic</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">Tanggal Transaksi</label>
                        <input type="date" class="form-control" id="date" name="transaction_date" required>
                    </div>

                    <!-- Add more fields as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2 for customer dropdown with search
        $('#customer').select2({
            ajax: {
                url: '<?= base_url('customers/search') ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 2
        });

        // Initialize Select2 for mechanic dropdown with search
        $('#mechanic').select2({
            ajax: {
                url: '<?= base_url('mechanics/search') ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 2
        });

        // Form submission handling
        $('#saleTransactionForm').on('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
        });
    });
</script>