<!-- Sale Detail Modal -->
<div class="modal fade" id="saleDetailModal" tabindex="-1" aria-labelledby="saleDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saleDetailModalLabel">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Transaction Info -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Invoice Number:</strong> <span id="invoiceNumber"></span></p>
                        <p><strong>Transaction Date:</strong> <span id="transactionDate"></span></p>
                        <p><strong>Customer:</strong> <span id="customerName"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong> <span id="transactionStatus"></span></p>
                        <p><strong>Payment Method:</strong> <span id="paymentMethod"></span></p>
                        <p><strong>Total Amount:</strong> <span id="totalAmount"></span></p>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="transactionItems">
                            <!-- Items will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printInvoice">Print Invoice</button>
            </div>
        </div>
    </div>
</div>