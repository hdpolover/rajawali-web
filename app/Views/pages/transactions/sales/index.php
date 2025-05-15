<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<!-- Custom CSS for Sales Page -->
<style>
    .stats-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stats-icon i {
        color: white;
        font-size: 1.5rem;
    }

    .stats-icon.purple {
        background-color: #9694ff;
    }

    .stats-icon.blue {
        background-color: #57caeb;
    }

    .stats-icon.green {
        background-color: #5ddab4;
    }

    .stats-icon.yellow {
        background-color: #ffc107;
    }

    .card {
        border: none;
        border-radius: 0.7rem;
    }

    .card-header {
        border-top-left-radius: 0.7rem !important;
        border-top-right-radius: 0.7rem !important;
    }

    /* Hover effect for table rows */
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.03);
        transition: all 0.2s ease;
    }

    /* Style for buttons in action column */
    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.2s;
    }

    /* Custom badge styles */
    .badge.rounded-pill {
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    /* WhatsApp button styling */
    .btn-outline-success.whatsapp-btn:hover {
        background-color: #25D366;
        border-color: #25D366;
        color: white;
    }

    /* Animation for the WhatsApp button */
    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .whatsapp-btn:hover i {
        animation: pulse 1s infinite;
    }
</style>

<div class="page-content">
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6">
            </div>
            <div class="col-12 col-md-6 text-end d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#archiveModal">
                    <i class="bi bi-archive"></i> Arsip
                </button>
                <a href="<?= base_url("/transactions/sales/add") ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Penjualan Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Sales Statistics -->
    <div class="row mb-4">
        <!-- Total Sales -->
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon purple">
                                <i class="bi bi-cart-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Total Penjualan</h6>
                            <h6 class="font-extrabold mb-0"><?= count($sales) ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Completed Sales -->
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon blue">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Selesai</h6>
                            <h6 class="font-extrabold mb-0">
                                <?php
                                $completed = array_filter($sales, function ($sale) {
                                    return $sale->status == 'completed';
                                });
                                echo count($completed);
                                ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Sales -->
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon yellow">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Pending</h6>
                            <h6 class="font-extrabold mb-0">
                                <?php
                                $pending = array_filter($sales, function ($sale) {
                                    return $sale->status == 'pending';
                                });
                                echo count($pending);
                                ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- In Process Sales -->
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                                <i class="bi bi-gear-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Proses</h6>
                            <h6 class="font-extrabold mb-0">
                                <?php
                                $process = array_filter($sales, function ($sale) {
                                    return $sale->status == 'process';
                                });
                                echo count($process);
                                ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="salesTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th width="18%">Kode Transaksi</th>
                            <th width="15%">Tanggal</th>
                            <th width="20%">Pelanggan</th>
                            <th width="12%">Status</th>
                            <th class="text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales as $index => $sale): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td><span class="fw-bold"><?= $sale->sale_number ?></span></td>
                                <td><?= format_indonesian_date($sale->sale_date) ?></td>
                                <td>
                                    <?php if (!empty($sale->customer) && !empty($sale->customer->name)): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2 bg-light-primary">
                                                <span class="avatar-content"><?= substr($sale->customer->name, 0, 1) ?></span>
                                            </div>
                                            <span><?= $sale->customer->name ?></span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">Pelanggan Umum</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($sale->status == 'pending'): ?>
                                        <span class="badge bg-warning text-dark rounded-pill px-3">
                                            <i class="bi bi-clock me-1"></i> Pending
                                        </span>
                                    <?php elseif ($sale->status == 'process'): ?>
                                        <span class="badge bg-success rounded-pill px-3">
                                            <i class="bi bi-gear-fill me-1"></i> Proses
                                        </span>
                                    <?php elseif ($sale->status == 'completed'): ?>
                                        <span class="badge bg-primary rounded-pill px-3">
                                            <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger rounded-pill px-3">
                                            <i class="bi bi-x-circle-fill me-1"></i> Batal
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewSaleModal" data-id="<?= $sale->id ?>" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSaleModal" data-sale='<?= json_encode($sale) ?>' title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $sale->id ?>" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button> <?php if ($sale->status == 'completed'): ?>
                                            <a href="<?= base_url("/transactions/sales/print_invoice/" . $sale->id) ?>" class="btn btn-sm btn-outline-info" title="Cetak Struk" target="_blank">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                            <?php if (!empty($sale->customer) && !empty($sale->customer->phone)): ?>
                                                <button type="button" class="btn btn-sm btn-outline-success whatsapp-btn"
                                                    data-sale-id="<?= $sale->id ?>"
                                                    data-customer-name="<?= !empty($sale->customer->name) ? $sale->customer->name : 'Pelanggan' ?>"
                                                    data-customer-phone="<?= $sale->customer->phone ?>"
                                                    data-invoice-number="<?= $sale->sale_number ?>"
                                                    title="Kirim via WhatsApp">
                                                    <i class="bi bi-whatsapp"></i>
                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('pages/transactions/sales/components/add'); ?>
<?= $this->include('pages/transactions/sales/components/view'); ?>
<?= $this->include('pages/transactions/sales/components/edit'); ?>
<?= $this->include('pages/transactions/sales/components/delete'); ?>
<?= $this->include('pages/transactions/sales/components/archive'); ?>
<?= $this->include('pages/transactions/sales/components/whatsapp'); ?>

<!-- DataTable Initialization Script -->
<script>
    $(document).ready(function() {
        // Initialize the sales table with custom settings
        let salesTable = $('#salesTable').DataTable({
            "order": [
                [2, "desc"]
            ], // Sort by date (column 2) in descending order
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Semua"]
            ],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
            }
        });
        // Add print invoice loading indicator
        $('a.btn-outline-info[title="Cetak Struk"]').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            // Show loading indicator
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang membuat struk, mohon tunggu...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    // Open in new tab after a short delay
                    setTimeout(() => {
                        window.open(href, '_blank');
                        Swal.close();
                    }, 1000);
                }
            });

            return false;
        });

        // WhatsApp button click handler
        $('.whatsapp-btn').on('click', function() {
            const saleId = $(this).data('sale-id');
            const customerName = $(this).data('customer-name');
            const customerPhone = $(this).data('customer-phone');
            const invoiceNumber = $(this).data('invoice-number');

            // Format phone number (remove leading zero if present)
            let formattedPhone = customerPhone;
            if (formattedPhone.startsWith('0')) {
                formattedPhone = formattedPhone.substring(1);
            }            // Set form values
            $('#whatsapp_sale_id').val(saleId);
            $('#whatsapp_invoice_number').val(invoiceNumber);
            $('#whatsapp_customer_name').val(customerName);
            $('#whatsapp_customer_phone').val(customerPhone);
            $('#whatsapp_phone').val(formattedPhone);

            // Replace placeholders in message template
            let messageTemplate = $('#whatsapp_message').val();
            messageTemplate = messageTemplate.replace(/{customer_name}/g, customerName);
            messageTemplate = messageTemplate.replace(/{invoice_number}/g, invoiceNumber);
            $('#whatsapp_message').val(messageTemplate);

            // Show the WhatsApp modal
            $('#whatsappModal').modal('show');
        });        // Send WhatsApp message button handler
        $('#sendWhatsappBtn').on('click', function() {
            const saleId = $('#whatsapp_sale_id').val();
            const phone = $('#whatsapp_phone').val();
            const message = encodeURIComponent($('#whatsapp_message').val());
            const shouldDownloadInvoice = $('#attachInvoice').is(':checked');
            // Get invoice number from hidden field
            const invoiceNumber = $('#whatsapp_invoice_number').val();

            // Show loading indicator before PDF generation
            if (shouldDownloadInvoice) {
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Sedang mengunduh struk, mohon tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }

            // WhatsApp API URL
            const whatsappUrl = `https://wa.me/62${phone}?text=${message}`; // If download invoice is checked, first download the invoice
            if (shouldDownloadInvoice) {
                // Create a hidden anchor to specifically download the file (not open in tab)
                const downloadLink = document.createElement('a');
                downloadLink.href = `<?= base_url('/transactions/sales/print_invoice/') ?>${saleId}`;
                downloadLink.setAttribute('download', `invoice_${invoiceNumber}.pdf`);
                downloadLink.style.display = 'none';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                // Clean up the download link after a short delay
                setTimeout(function() {
                    document.body.removeChild(downloadLink);
                    Swal.close(); // Close loading indicator
                }, 1000);                // Wait a moment to ensure the download starts, then open WhatsApp
                setTimeout(function() {
                    window.open(whatsappUrl, '_blank');
                    $('#whatsappModal').modal('hide');
                }, 1500);
            } else {
                // Just open WhatsApp without downloading invoice
                window.open(whatsappUrl, '_blank');
                $('#whatsappModal').modal('hide');
            }
        });
    });
</script>

<?= $this->endSection() ?>