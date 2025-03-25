<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mb-4"></div>
    <div class="card">
        <div class="card-content">
            <div class="card-body cursor-default-hover">
                <form id="saveSaleForm" action="<?= base_url('transactions/sales/save')?>" class="form form-vertical" method="post">
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
<?= $this->include('pages/transactions/sales/components/add_motorcycle'); ?>


<script type="text/javascript">
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
        $('.select2-container').addClass('form-select');
    });

    // get all data on submit form
    $('#saveSaleForm').on('submit', function(e) {
        e.preventDefault();

        // get all data
        const saleType = document.querySelector('input[name="sale_type"]:checked').value;

        // Create form data
        const formData = new FormData();
        
        // Common data for both types of sales
        formData.append('sale_type', saleType);
        formData.append('sale_date', '<?= date('Y-m-d H:i:s') ?>');
        formData.append('sale_number', '<?= date('YmdHis') ?>');
        formData.append('admin_id', '<?= session()->get('admin_id') ?>');
        formData.append('discount', document.getElementById('discount').value);
        formData.append('description', document.getElementById('note').value);
        
        // Total price
        const totalPrice = document.getElementById('total').value;
        formData.append('total', revertCurrencyID(totalPrice));

        // If it's a complete sale, include customer and motorcycle data
        if (saleType === 'complete') {
            const customerId = document.getElementById('select_customer').value;
            const motorcycleId = document.getElementById('select_motocycle').value;
            
            formData.append('customer_id', customerId);
            formData.append('motorcycle_id', motorcycleId);
        }
        
        // Get spare parts data
        const sparePartsContainer = document.getElementById('sparePartsContainer');
        const sparePartData = <?= json_encode($spare_parts) ?>;

        // Make sure sparePartsContainer exists and has rows before processing
        const spareParts = [];
        if (sparePartsContainer && sparePartsContainer.rows.length > 0) {
            for (let i = 0; i < sparePartsContainer.rows.length; i++) {
                const row = sparePartsContainer.rows[i];
                const codeNumber = row.cells[1].textContent.trim();
                // Find the spare part by code number
                const matchedSparePart = sparePartData.find(sparePart => sparePart.code_number === codeNumber);
                
                if (matchedSparePart) {
                    const sparePartId = matchedSparePart.id;
                    const quantity = row.cells[3].textContent;
                    const price = revertCurrencyID(row.cells[4].textContent);
                    const subTotal = revertCurrencyID(row.cells[5].textContent);
                    const description = row.cells[6].textContent;
                    
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
        for (let i = 0; i < servicesContainer.rows.length; i++) {
            const row = servicesContainer.rows[i];
            // get service id from service name
            const serviceId =  serviceData.find(service => service.name == row.cells[1].textContent).id;
            // get mechanic id from mechanic name
            const mechanicId = mechanicData.find(mechanic => mechanic.name == row.cells[2].textContent).id;
            const description = row.cells[4].textContent;
            const price = revertCurrencyID(row.cells[3].textContent);
            services.push({
                service_id: serviceId,
                mechanic_id: mechanicId,
                description: description,
                price: price,
                sub_total: price,
            });
        }
        formData.append('services', JSON.stringify(services));

        // send ajax request
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?= base_url('transactions/sales') ?>';
                        }
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
                console.error(xhr, status, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat menyimpan data'
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // total
        const total = document.getElementById('total');
        // discount
        const discount = document.getElementById('discount');
        // note
        const note = document.getElementById('note');

        // radio button
        const saleTypeComplete = document.getElementById('sale_type_complete');
        const saleTypeWalkin = document.getElementById('sale_type_walkin');

        // radio button event
        saleTypeComplete.addEventListener('change', function() {
            document.getElementById('detailedCForm1').style.display = 'block';
            document.getElementById('detailedCForm2').style.display = 'block';
        });

        saleTypeWalkin.addEventListener('change', function() {
            document.getElementById('detailedCForm1').style.display = 'none';
            document.getElementById('detailedCForm2').style.display = 'none';

            // update total
            calculateTotal();
        });

        // total calculation
        discount.addEventListener('input', function() {
            calculateTotal();
        });


    });

    // calculate total
    function calculateTotal() {
        const sparePartsContainer = document.getElementById('sparePartsContainer');
        const servicesContainer = document.getElementById('servicesContainer');
        const discount = document.getElementById('discount');
        const total = document.getElementById('total');

        let subTotal = 0;
        for (let i = 0; i < sparePartsContainer.rows.length; i++) {
            const row = sparePartsContainer.rows[i];
            const subTotalValue = row.cells[5].textContent;
            subTotal += parseInt(subTotalValue.replace(/\D/g, ''));
        }

        for (let i = 0; i < servicesContainer.rows.length; i++) {
            const row = servicesContainer.rows[i];
            const subTotalValue = row.cells[3].textContent;
            subTotal += parseInt(subTotalValue.replace(/\D/g, ''));
        }

        const discountValue = parseInt(discount.value);
        const totalValue = subTotal - discountValue;

        total.value = formatCurrencyID(totalValue);
    }
</script>

<?= $this->endSection() ?>