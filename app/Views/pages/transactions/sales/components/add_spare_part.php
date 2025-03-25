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
                    <small class="form-text text-muted">Cari berdasarkan kode atau nama spare part atau scan barcode</small>
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
        let lastInputTime = 0;
        let inputBuffer = '';
        const SCANNER_CHARACTER_DELAY = 50; // Typical barcode scanners send characters very quickly
        
        // spare parts select 2
        const $selectSparePart = $('#select_spare_part');
        
        $selectSparePart.select2({
            dropdownParent: $('#addSparePartModal'),
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Pilih Spare Part (Ketik kode atau nama)',
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
                    return {
                        results: response.data
                    };
                },
                cache: true
            },
            templateResult: formatSparePartResult,
            templateSelection: formatSparePartSelection
        });
        
        // Detect barcode scanner input (characterized by rapid keystrokes)
        $(document).on('keypress', function(e) {
            if ($('#addSparePartModal').is(':visible')) {
                const currentTime = new Date().getTime();
                
                // If this keystroke came quickly after the previous one, it might be from a scanner
                if (currentTime - lastInputTime < SCANNER_CHARACTER_DELAY) {
                    // Likely a barcode scanner input - append to buffer
                    inputBuffer += String.fromCharCode(e.which);
                } else {
                    // Too slow for scanner, reset buffer
                    inputBuffer = String.fromCharCode(e.which);
                }
                
                lastInputTime = currentTime;
                
                // If Enter key is pressed, process the barcode
                if (e.which === 13 && inputBuffer.length > 3) {
                    e.preventDefault(); // Prevent form submission
                    processBarcodeInput(inputBuffer);
                    inputBuffer = ''; // Clear the buffer
                }
                
                // Auto process after a slight delay if it seems like the barcode input has ended
                clearTimeout(window.barcodeTimeout);
                window.barcodeTimeout = setTimeout(function() {
                    if (inputBuffer.length > 3) {
                        processBarcodeInput(inputBuffer);
                        inputBuffer = '';
                    }
                }, 100);
            }
        });
        
        // Process barcode input and select the matching spare part
        function processBarcodeInput(barcode) {
            barcode = barcode.trim();
            if (!barcode) return;
            
            // Focus on the select2 to ensure it's ready to receive our search
            $selectSparePart.select2('open');
            
            // Make an AJAX call to search for the exact barcode match
            $.ajax({
                url: '<?= site_url('spare-parts/fetch') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    name: barcode
                },
                success: function(response) {
                    if (response.data && response.data.length > 0) {
                        // Find exact match (code_number matches barcode exactly)
                        const exactMatch = response.data.find(item => 
                            item.code_number === barcode
                        );
                        
                        if (exactMatch) {
                            // Create the option element if it doesn't exist
                            if (!$selectSparePart.find("option[value='" + exactMatch.id + "']").length) {
                                const newOption = new Option(exactMatch.text, exactMatch.id, true, true);
                                $selectSparePart.append(newOption);
                            }
                            
                            // Select the matching option and trigger change
                            $selectSparePart.val(exactMatch.id).trigger('change');
                            $selectSparePart.select2('close');
                        }
                    }
                }
            });
        }

        // Format spare part in dropdown results
        function formatSparePartResult(data) {
            if (data.loading) {
                return data.text;
            }
            
            if (!data.id) {
                return data.text;
            }
            
            var $container = $(
                "<div class='select2-result-spare-part'>" +
                    "<div class='select2-result-spare-part__code'><strong>Kode:</strong> " + data.code_number + "</div>" +
                    "<div class='select2-result-spare-part__name'><strong>Nama:</strong> " + data.merk + " " + data.name + "</div>" +
                "</div>"
            );
            
            return $container;
        }
        
        // Format selected spare part
        function formatSparePartSelection(data) {
            return data.text || data.code_number + " - " + data.merk + " " + data.name;
        }

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