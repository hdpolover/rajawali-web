<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mb-4"></div>
    <div class="card">
        <div class="card-content">
            <div class="card-body cursor-default-hover">
                <form id="saveSaleForm" action="<?= base_url('transactions/sales/save') ?>" class="form form-vertical" method="post">
                    <div class="form-body">
                        <div class="mb-3">
                            <label for="customer" class="form-label fw-bold">Tipe Penjualan</label>
                            <div class="input-group">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="sale_type" id="sale_type_complete" value="complete" checked>
                                    <label class="form-check-label" for="sale_type_complete">
                                        Penjualan Lengkap
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sale_type" id="sale_type_walkin" value="walkin">
                                    <label class="form-check-label" for="sale_type_walkin">
                                        Walk-in (Tanpa detail pelanggan dan servis)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="detailedCForm1">
                            <div class="mb-3">
                                <label for="customer" class="form-label fw-bold">Pelanggan</label>
                                <div class="input-group">
                                    <select id="select_customer" name="customer" class="form-select">
                                        <option value="">Pilih Pelanggan</option>
                                    </select>
                                    <button type="button" class="btn btn-primary" id="addCustomer" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                        <i class="bi bi-plus-circle"></i> Tambah Pelanggan
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 d-none" id="motorcycle_div">
                                <label for="motorbike" class="form-label fw-bold">Motor Pelanggan</label>
                                <div class="input-group">
                                    <select id="select_motocycle" name="motorcycle" class="form-select">
                                        <option value="">Pilih Motor Pelanggan</option>
                                    </select>
                                    <button type="button" class="btn btn-primary" id="addMotorbike" data-bs-toggle="modal" data-bs-target="#addMotocycleModal">
                                        <i class="bi bi-plus-circle"></i> Tambah Motor Pelanggan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="add_spare_parts" class="form-label fw-bold">Rincian Spare Part</label>
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary" id="selectSparePart" data-bs-toggle="modal" data-bs-target="#addSparePartModal">
                                    <i class="bi bi-plus-circle"></i> Pilih Spare Part
                                </button>
                            </div>
                            <div id="sparePartTable" class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Spare Part</th>
                                            <th style="width: 40%;">Nama</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Sub Total</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sparePartsContainer">
                                        <!-- spare rows -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="detailedCForm2">
                            <div class="mb-3">
                                <label for="add_service" class="form-label fw-bold">Rincian Servis</label>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-primary" id="selectService" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                        <i class="bi bi-plus-circle"></i> Pilih Servis
                                    </button>
                                </div>
                                <div id="serviceTable" class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 40%;">Servis</th>
                                                <th>Mekanik</th>
                                                <th>Sub Total</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="servicesContainer">
                                            <!-- service rows -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label fw-bold">Diskon</label>
                            <input type="numeric" class="form-control" id="discount" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label fw-bold">Total</label>
                            <input type="text" class="form-control" id="total" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label fw-bold">Catatan</label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                        </div>

                        <div class="col-12 d-flex justify-content-end cursor-default-hover">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- include Modals from the other folder-->
<?= $this->include('pages/transactions/sales/components/add_customer'); ?>
<?= $this->include('pages/transactions/sales/components/add_spare_part'); ?>
<?= $this->include('pages/transactions/sales/components/add_service'); ?>
<?= $this->include('pages/transactions/sales/components/add_motorcycle'); ?> <script type="text/javascript">
    // Debug any global form submit attempts
    $(document).on('submit', 'form', function() {
        console.log('Form submitted:', this.id);
    });

    jQuery(document).ready(function($) {
        // Initialize Select2 for customer select
        var $customerSelect = $('#select_customer').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Pelanggan',
            ajax: {
                url: '<?= site_url('customers/fetch') ?>',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        name: params.term,
                    };
                },
                processResults: function(response) {
                    console.log('Customer Select2 Results:', response.data);
                    return {
                        results: response.data
                    };
                },
                cache: true
            }
        });

        // Initialize Select2 for motorcycle select
        $('#select_motocycle').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Motor Pelanggan'
        });

        // when customer select has value, show motorcycle select
        $customerSelect.on('select2:select', function(e) {
            const data = e.params.data;
            console.log('Selected Customer:', data);

            // show motorcycle select
            document.getElementById('motorcycle_div').classList.remove('d-none');

            // motorcycle data
            const motorcycles = <?= json_encode($motorcycles) ?>;

            // filter motorcycle by customer id
            const customerMotorcycles = motorcycles.filter(motorcycle => motorcycle.customer_id == data.id);

            // select motorcycle element
            const selectMotorcycle = document.getElementById('select_motocycle');

            // clear select motorcycle
            selectMotorcycle.innerHTML = '<option value="">Pilih Motor Pelanggan</option>';

            // add motorcycle to select motorcycle
            customerMotorcycles.forEach(motorcycle => {
                const option = document.createElement('option');
                option.value = motorcycle.id;
                option.textContent = `${motorcycle.brand} ${motorcycle.model} (${motorcycle.license_number})`;
                selectMotorcycle.appendChild(option);
            });
        });

        // add class for select 2 to form-select
        $('.select2-container').addClass('form-select'); // Handle new customer form submission
        $(document).on('submit', '#addCustomerForm', function(e) {
            e.preventDefault();
            console.log('Customer form submitted via delegated handler');

            // Get form data
            const customerFormData = new FormData(this);

            // Send AJAX request to save new customer            
            $.ajax({
                url: '<?= site_url('master-data/customers/add-alt') ?>',
                type: 'POST',
                data: customerFormData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Customer form submission response:', response);
                    if (response.success) {
                        // Close the modal
                        $('#addCustomerModal').modal('hide');

                        // Create a new option for the select
                        const newCustomer = {
                            id: response.data.id,
                            text: response.data.name
                        };

                        // Add the new customer to the select and select it
                        if (!$('#select_customer').find("option[value='" + newCustomer.id + "']").length) {
                            const newOption = new Option(newCustomer.text, newCustomer.id, true, true);
                            $('#select_customer').append(newOption).trigger('change');
                        }

                        // Show motorcycle div
                        document.getElementById('motorcycle_div').classList.remove('d-none');

                        // Reset the form
                        $('#addCustomerForm')[0].reset();

                        // Display success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pelanggan berhasil ditambahkan'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Gagal menambahkan pelanggan'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr, status, error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data pelanggan'
                    });
                }
            });
        }); // Handle new motorcycle form submission
        $(document).on('submit', '#addMotocycleForm', function(e) {
            e.preventDefault();
            console.log('Motorcycle form submitted via delegated handler');

            // Get form data
            const motorcycleFormData = new FormData(this);

            // Set the customer ID from the selected customer
            const customerId = $('#select_customer').val();
            motorcycleFormData.append('customer_id', customerId);

            // Send AJAX request to save new motorcycle           
            $.ajax({
                url: '<?= site_url('master-data/motorcycles/add-alt') ?>',
                type: 'POST',
                data: motorcycleFormData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Motorcycle form submission response:', response);
                    if (response.success) {
                        // Close the modal
                        $('#addMotocycleModal').modal('hide');

                        // Create a new motorcycle option
                        const newMotorcycle = {
                            id: response.data.id,
                            text: `${response.data.brand} ${response.data.model} (${response.data.license_number})`
                        };

                        // Add the new motorcycle to the select and select it
                        if (!$('#select_motocycle').find("option[value='" + newMotorcycle.id + "']").length) {
                            const newOption = new Option(newMotorcycle.text, newMotorcycle.id, true, true);
                            $('#select_motocycle').append(newOption).trigger('change');
                        }

                        // Reset the form
                        $('#addMotocycleForm')[0].reset();

                        // Display success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Motor berhasil ditambahkan'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Gagal menambahkan motor'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr, status, error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data motor'
                    });
                }
            });
        }); // radio button
        const saleTypeComplete = document.getElementById('sale_type_complete');
        const saleTypeWalkin = document.getElementById('sale_type_walkin');

        // radio button event
        saleTypeComplete.addEventListener('change', function() {
            document.getElementById('detailedCForm1').style.display = 'block';
            document.getElementById('detailedCForm2').style.display = 'block';
            // Recalculate total to include any services
            calculateTotal();
        });

        saleTypeWalkin.addEventListener('change', function() {
            document.getElementById('detailedCForm1').style.display = 'none';
            document.getElementById('detailedCForm2').style.display = 'none';

            // Clear any selected customer and motorcycle
            if ($('#select_customer').data('select2')) {
                $('#select_customer').val(null).trigger('change');
            }
            if ($('#select_motocycle').data('select2')) {
                $('#select_motocycle').val(null).trigger('change');
            }

            // Hide motorcycle div
            document.getElementById('motorcycle_div').classList.add('d-none');

            // Clear services table
            const servicesContainer = document.getElementById('servicesContainer');
            if (servicesContainer) {
                servicesContainer.innerHTML = '';
            }

            // update total to only include spare parts
            calculateTotal();
        });

        // total calculation
        const discount = document.getElementById('discount');
        discount.addEventListener('input', function() {
            calculateTotal();
        });


    });

    // get all data on submit form
    $('#saveSaleForm').on('submit', function(e) {
        e.preventDefault();

        // Show loading indicator
        Swal.fire({
            title: 'Menyimpan...',
            html: 'Mohon tunggu, transaksi sedang diproses',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // get all data
        const saleType = document.querySelector('input[name="sale_type"]:checked').value;

        // Create form data
        const formData = new FormData();

        // Common data for both types of sales
        formData.append('sale_type', saleType);
        formData.append('sale_date', '<?= date('Y-m-d H:i:s') ?>');
        formData.append('sale_number', '<?= date('YmdHis') ?>');
        formData.append('admin_id', '<?= session()->get('admin_id') ?>');
        formData.append('discount', document.getElementById('discount').value || 0);
        formData.append('description', document.getElementById('note').value || '');        // Total price - recalculate to ensure accuracy
        const totalPrice = calculateTotal();
        formData.append('total', totalPrice);

        // If it's a complete sale, include customer and motorcycle data
        if (saleType === 'complete') {
            const customerId = document.getElementById('select_customer').value;
            const motorcycleId = document.getElementById('select_motocycle').value;

            // Validate required fields for complete sales
            if (!customerId) {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Pilih pelanggan terlebih dahulu'
                });
                return;
            }

            formData.append('customer_id', customerId);
            formData.append('motorcycle_id', motorcycleId || '');
        }

        // Get spare parts data
        const sparePartsContainer = document.getElementById('sparePartsContainer');
        const sparePartData = <?= json_encode($spare_parts) ?>;

        // Make sure sparePartsContainer exists and has rows before processing
        const spareParts = [];
        if (sparePartsContainer && sparePartsContainer.rows.length > 0) {
            for (let i = 0; i < sparePartsContainer.rows.length; i++) {
                const row = sparePartsContainer.rows[i];
                const codeNumber = row.cells[1] ? row.cells[1].textContent.trim() : '';

                // Find the spare part by code number
                const matchedSparePart = sparePartData.find(sparePart => sparePart.code_number === codeNumber);

                if (matchedSparePart) {
                    const sparePartId = matchedSparePart.id;
                    const quantity = row.cells[3] ? row.cells[3].textContent : '0';
                    const price = row.cells[4] ? revertCurrencyID(row.cells[4].textContent) : '0';
                    const subTotal = row.cells[5] ? revertCurrencyID(row.cells[5].textContent) : '0';
                    const description = row.cells[6] ? row.cells[6].textContent : '';

                    spareParts.push({
                        spare_part_id: sparePartId,
                        quantity: quantity,
                        price: price,
                        sub_total: subTotal,
                        description: description,
                    });
                }
            }
        }
        formData.append('spare_parts', JSON.stringify(spareParts));

        // Get services data
        const servicesContainer = document.getElementById('servicesContainer');
        const serviceData = <?= json_encode($services) ?>;
        const mechanicData = <?= json_encode($mechanics) ?>;
        const services = [];

        if (servicesContainer && servicesContainer.rows.length > 0) {
            for (let i = 0; i < servicesContainer.rows.length; i++) {
                const row = servicesContainer.rows[i];

                // Safely get service name and find ID
                const serviceName = row.cells[1] ? row.cells[1].textContent.trim() : '';
                const matchedService = serviceData.find(service => service.name === serviceName);

                // Safely get mechanic name and find ID
                const mechanicName = row.cells[2] ? row.cells[2].textContent.trim() : '';
                const matchedMechanic = mechanicData.find(mechanic => mechanic.name === mechanicName);

                // Only proceed if we have both service and mechanic
                if (matchedService && matchedMechanic) {
                    const serviceId = matchedService.id;
                    const mechanicId = matchedMechanic.id;
                    const description = row.cells[4] ? row.cells[4].textContent : '';
                    const price = row.cells[3] ? revertCurrencyID(row.cells[3].textContent) : '0';

                    services.push({
                        service_id: serviceId,
                        mechanic_id: mechanicId,
                        description: description,
                        price: price,
                        sub_total: price,
                    });
                }
            }
        }
        formData.append('services', JSON.stringify(services));

        // Validate if there are any items
        if (spareParts.length === 0 && services.length === 0) {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Tambahkan minimal satu spare part atau servis'
            });
            return;
        }        // send ajax request
        console.log('Sending form data:', {
            url: $(this).attr('action'),
            saleType,
            totalPrice,
            spareParts: spareParts.length,
            services: services.length
        });
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Response received:', response);
                // Close loading indicator
                Swal.close();
                
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message || 'Transaksi berhasil disimpan'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?= base_url('transactions/sales') ?>';
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Gagal menyimpan transaksi'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Close loading indicator
                Swal.close();
                
                console.error('Error details:', xhr, status, error);
                let errorMessage = 'Terjadi kesalahan saat menyimpan data';
                
                // Try to extract more specific error if available
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage
                });
            }
        });
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize total calculation when the page loads
        calculateTotal();
    });
    function calculateTotal() {
        const sparePartsContainer = document.getElementById('sparePartsContainer');
        const servicesContainer = document.getElementById('servicesContainer');
        const discount = document.getElementById('discount');
        const total = document.getElementById('total');

        let subTotal = 0;

        // Calculate total from spare parts if container exists
        if (sparePartsContainer && sparePartsContainer.rows) {
            for (let i = 0; i < sparePartsContainer.rows.length; i++) {
                const row = sparePartsContainer.rows[i];
                if (row && row.cells && row.cells[5]) {
                    const subTotalValue = row.cells[5].textContent || '0';
                    subTotal += parseInt(subTotalValue.replace(/\D/g, '') || 0);
                }
            }
        }

        // Calculate total from services if container exists
        if (servicesContainer && servicesContainer.rows) {
            for (let i = 0; i < servicesContainer.rows.length; i++) {
                const row = servicesContainer.rows[i];
                if (row && row.cells && row.cells[3]) {
                    const subTotalValue = row.cells[3].textContent || '0';
                    subTotal += parseInt(subTotalValue.replace(/\D/g, '') || 0);
                }
            }
        }

        // Get discount value, defaulting to 0 if empty or not a number
        const discountValue = parseInt(discount.value || 0) || 0;
        const totalValue = Math.max(0, subTotal - discountValue); // Ensure total is not negative

        total.value = formatCurrencyID(totalValue);
        
        console.log('Total calculation:', { subTotal, discountValue, totalValue });
        return totalValue; // Return the numeric value for other functions to use
    }

    // Ensure formatCurrencyID and revertCurrencyID functions are available
    if (typeof formatCurrencyID !== 'function') {
        function formatCurrencyID(amount) {
            // Format a number into Indonesian currency format
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount).replace('Rp', 'Rp ');
        }
    }

    if (typeof revertCurrencyID !== 'function') {
        function revertCurrencyID(amount) {
            // Convert currency string back to number
            if (!amount) return 0;
            if (typeof amount === 'number') return amount;
            return parseInt(amount.replace(/[^\d]/g, '')) || 0;
        }
    }

    // When motorcycle modal is opened, set the customer ID
    $('#addMotorbike').on('click', function() {
        // Get the selected customer ID
        const customerId = $('#select_customer').val();

        if (!customerId) {
            // Stop the modal from opening
            event.preventDefault();
            event.stopPropagation();

            // Show an error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih pelanggan terlebih dahulu sebelum menambahkan motor'
            });
            return;
        }

        // Set the customer ID in the motorcycle form
        $('#add_customer_id').val(customerId);
    });
</script>

<?= $this->endSection() ?>