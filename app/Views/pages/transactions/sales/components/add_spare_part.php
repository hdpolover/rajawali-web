<div class="modal fade" id="addSparePartModal" tabindex="-1" aria-labelledby="sparePartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sparePartModalLabel">Pilih Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="select_spare_part" class="form-label ">Spare Part</label>
                    <select id="select_spare_part" name="select_spare_part">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="quantity" min="1" value="1" step="1">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="addSparePart" data-bs-dismiss="modal">
                        Tambahkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // spare parts select 2
        $('#select_spare_part').select2({
            // parent is select spare part modal
            dropdownParent: $('#addSparePartModal'),
            // theme
            theme: 'bootstrap4',
            width: '100%',
            // placeholder
            placeholder: 'Pilih Spare Part',
            ajax: {
                url: '<?= site_url('spare-parts/fetch') ?>',
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

    // handle add spare part button
    $('#addSparePart').on('click', function() {
        var spare_part_id = $('#select_spare_part').val();
        var quantity = $('#quantity').val();

        // spare part container
        var spare_part_container = $('#sparePartsContainer');

        // check if spare part is selected and quantity is more than 0
        if (spare_part_id && quantity > 0) {
            // check if spare part already added
            var isExist = false;

            // check if spare part already added
            spare_part_container.find('tr').each(function() {
                var id = $(this).find('td').eq(1).data('id');
                if (id == spare_part_id) {
                    isExist = true;
                }
            });

            // if spare part not exist
            if (!isExist) {
                // get spare part data by id from spare part array in index.php
                var spare_part = <?= json_encode($spare_parts) ?>;
                spare_part = spare_part.find(spare_part => spare_part.id == spare_part_id);

                var sparePart = spare_part.merk + ' ' +  spare_part.name;
                var qty = quantity;
                var subTotal = parseFloat(spare_part.details.current_sell_price) * parseInt(qty);
                var price = parseFloat(spare_part.details.current_sell_price);
                var description = $('#description').val() ? $('#description').val() : '-';

                // check if spare part stock is enough
                if (parseInt(qty) > parseInt(spare_part.details.current_stock)) {
                    // show error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Stock spare part tidak cukup. Stock tersedia: ' + spare_part.details.current_stock
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#addSparePartModal').modal('show');
                        }
                    });
                    return;
                }

                // add row to spare part container
                spare_part_container.append(`
                    <tr>
                        <td>${spare_part_container.find('tr').length + 1}</td>
                        <td data-id="${spare_part.id}">${spare_part.code_number}</td>
                        <td name="sparePartNames[]">${sparePart}</td>
                        <td name="quantities[]">${qty}</td>
                        <td name="prices[]">${formatCurrencyID(price)}</td>
                        <td name="subTotals[]">${formatCurrencyID(subTotal)}</td>
                        <td name="descriptions[]">${description}</td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="removeSparePart(this)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `);

                // calculate total
                calculateTotal();

                // reset select 2 and quantity
                $('#select_spare_part').val(null).trigger('change');
                $('#quantity').val(1);
            } else {
                // show error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Spare part sudah ditambahkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#addSparePartModal').modal('show');
                    }
                });
            }
        } else {

            // show error
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Spare part harus dipilih dan jumlah harus lebih dari 0'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#addSparePartModal').modal('show');
                }
            });

        }
    });

    // remove spare part row
    window.removeSparePart = function(button) {
        // spare part container
        const spare_part_container = document.getElementById('sparePartsContainer');

        const row = button.closest('tr');
        row.remove();

        // update row number
        for (let i = 0; i < spare_part_container.rows.length; i++) {
            spare_part_container.rows[i].cells[0].textContent = i + 1;
        }

        // total calculation
        calculateTotal();
    };
</script>