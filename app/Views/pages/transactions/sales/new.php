<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mb-4"></div>
    <div class="card">
        <div class="card-content">
            <div class="card-body cursor-default-hover">
                <form class="form form-vertical">
                    <div class="form-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="add_spare_parts" class="form-label fw-bold">Rincian Spare Part</label>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-primary" id="selectSparePart" data-bs-toggle="modal" data-bs-target="#sparePartModal">
                                        <i class="bi bi-plus-circle"></i> Pilih Spare Part
                                    </button>
                                </div>
                                <div id="sparePartTable" class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 40%;">Spare Part</th>
                                                <th>Jumlah</th>
                                                <th>Sub Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sparePartsContainer">
                                            <!-- spare rows -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mb-3">
                               
                            </div>
                            <div class="mb-3">
                                <label for="add_purchase_date" class="form-label">Tanggal Pembelian</label>
                                <input type="date" class="form-control" id="add_purchase_date" name="purchase_date">
                            </div>
                            <div class="col-12 d-flex justify-content-end cursor-default-hover">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                               </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sparePartModal" tabindex="-1" aria-labelledby="sparePartModalLabel" aria-hidden="true">
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
                <div class="mt-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="addSparePart" data-bs-dismiss="modal">
                        Tambahkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateSparePartModal" tabindex="-1" aria-labelledby="updateSparePartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateSparePartModalLabel">Update Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="update_spare_part" class="form-label">Spare Part</label>
                    <select id="update_spare_part" name="update_spare_part">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="update_quantity" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="update_quantity" min="1" value="1" step="1">
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="updateSparePartBtn" data-bs-dismiss="modal">
                        Update
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
            dropdownParent: $(".modal-body"),
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

    document.addEventListener('DOMContentLoaded', function() {
        const sparePartsContainer = document.getElementById('sparePartsContainer');
        const sparePartTable = document.getElementById('sparePartTable');
        const selectSparePart = document.getElementById('selectSparePart');
        const addSparePart = document.getElementById('addSparePart');
        const quantity = document.getElementById('quantity');
        const selectSparePartElement = document.getElementById('select_spare_part');

        selectSparePart.addEventListener('click', function() {
            selectSparePartElement.value = '';
            quantity.value = 1;
        });

        addSparePart.addEventListener('click', function() {
            // check if spare part already selected
            for (let i = 0; i < sparePartsContainer.rows.length; i++) {
                const row = sparePartsContainer.rows[i];
                const sparePart = row.cells[1].textContent;
                if (sparePart == selectSparePartElement.options[selectSparePartElement.selectedIndex].text) {
                    alert('Spare part sudah dipilih');
                    return;
                }
            }

            const sparePart = selectSparePartElement.options[selectSparePartElement.selectedIndex].text;
            const sparePartId = selectSparePartElement.value;
            const qty = quantity.value;

            const sparePartData = <?= json_encode($spare_parts) ?>;

            const spare_part = sparePartData.find(spare_part => spare_part.id == sparePartId);

            // get sub total from price and quantity
            const subTotal = spare_part.details.current_sell_price * qty;

            if (sparePartId) {
                const row = sparePartsContainer.insertRow();
                row.innerHTML = `
                    <td>${sparePartsContainer.rows.length}</td>
                    <td>${sparePart}</td>
                    <td>${qty}</td>
                    <td>${formatCurrencyID(subTotal)}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" onclick="updateSparePart(this)">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeSparePart(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;
            }

            selectSparePartElement.value = '';
            quantity.value = 1;
        });

        // remove spare part row
        window.removeSparePart = function(button) {
            const row = button.closest('tr');
            row.remove();

            // update row number
            for (let i = 0; i < sparePartsContainer.rows.length; i++) {
                sparePartsContainer.rows[i].cells[0].textContent = i + 1;
            }
        };

        // update spare part row
        window.updateSparePart = function(button) {
            const row = button.closest('tr');
            const sparePart = row.cells[1].textContent;
            const qty = row.cells[2].textContent;

            const sparePartId = <?= json_encode($spare_parts) ?>.find(spare_part => spare_part.name == sparePart).id;

            const updateSparePartElement = document.getElementById('update_spare_part');

            // set selected spare part
            updateSparePartElement.value = sparePartId;
            document.getElementById('update_quantity').value = qty;

            $('#updateSparePartModal').modal('show');

            // when update button clicked, update spare part row
            document.getElementById('updateSparePartBtn').addEventListener('click', function() {
                const updatedSparePart = updateSparePartElement.options[updateSparePartElement.selectedIndex].text;
                const updatedQty = document.getElementById('update_quantity').value;

                // get sub total from price and quantity
                const sparePartData = <?= json_encode($spare_parts) ?>;
                const spare_part = sparePartData.find(spare_part => spare_part.id == sparePartId);
                const subTotal = spare_part.details.current_sell_price * updatedQty;

                row.cells[1].textContent = updatedSparePart;
                row.cells[2].textContent = updatedQty;
                row.cells[3].textContent = formatCurrencyID(subTotal);

                $('#updateSparePartModal').modal('hide');
            });

        };
    });
</script>

<?= $this->endSection() ?>