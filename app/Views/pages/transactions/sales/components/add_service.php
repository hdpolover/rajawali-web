<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Pilih Servis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="select_service" class="form-label">Servis</label>
                    <select id="select_service" name="select_service" class="form-select">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mechanic" class="form-label">Mekanik</label>
                    <select id="select_mechanic" name="mechanic" class="form-select">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="service_description" class="form-label">Catatan</label>
                    <textarea id="service_description" name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="addService" data-bs-dismiss="modal">
                        Tambahkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // service select 2
        $('#select_service').select2({
            // parent is select service modal
            dropdownParent: $('#addServiceModal'),
            // theme
            theme: 'bootstrap4',
            width: '100%',
            // placeholder
            placeholder: 'Pilih Servis',
            ajax: {
                url: '<?= site_url('services/fetch') ?>',
                // post
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

        // mechanic select 2
        $('#select_mechanic').select2({
            // dropdown paren is the modal body of service modal dialog
            dropdownParent: $('#addServiceModal'),
            // theme
            theme: 'bootstrap4',
            width: '100%',
            // placeholder
            placeholder: 'Pilih Mekanik',
            ajax: {
                url: '<?= site_url('mechanics/fetch') ?>',
                // post
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

        // add class for select 2 to form-select
        $('.select2-container').addClass('form-select');
    });

    // on submit add service button, when the button is clicked and one of the select is empty, show alert
    $('#addService').on('click', function(e) {
        var serviceId = $('#select_service').val();
        var mechanicId = $('#select_mechanic').val();
        var description = $('#service_description').val();

        if (serviceId == '' || mechanicId == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Servis dan mekanik harus diisi',
            }).then((result) => {
                // show add service modal
                $('#addServiceModal').modal('show');
            });
        }

        // if description is empty, set it to '-'
        if (description == '') {
            description = '-';
        }

        // add service to the table
        var service_name = $('#select_service option:selected').text();
        var mechanic_name = $('#select_mechanic option:selected').text();

        var servicesContainer = document.getElementById('servicesContainer');

        $services = <?= json_encode($services) ?>;

        console.log($services);

        var selectedService = $services.find(service => service.id == serviceId);

        console.log(serviceId);
        console.log(selectedService);

        // get latest price from effective date
        $latestPrice = selectedService.prices[selectedService.prices.length - 1].price;

        // get sub total from price and quantity
        var subTotal = $latestPrice;

        var row = '<tr>';
        // number
        row += '<td>' + (servicesContainer.rows.length + 1) + '</td>';
        row += '<td>' + service_name + '</td>';
        row += '<td>' + mechanic_name + '</td>';
        row += '<td>' + formatCurrencyID($latestPrice) + '</td>';
        row += '<td>' + description + '</td>';
        row += '<td>';
        row += '<button type="button" class="btn btn-danger btn-sm remove-service">Hapus</button>';
        row += '</td>';
        row += '</tr>';

        servicesContainer.innerHTML += row;

        // clear select service and select mechanic
        $('#select_service').val('');
        $('#select_mechanic').val('');
        $('#service_description').val('');

        // calculate total
        calculateTotal();
    });
</script>