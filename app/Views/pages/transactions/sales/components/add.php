<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Changed to modal-xl class for extra large width -->
        <div class="modal-content">
            <form action="<?= base_url('transactions/sales/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penjualan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_customer" class="form-label">Pelanggan</label>
                        <select id="select_customer" name="customer_id">
                            <option value=""></option>
                        </select>
                        <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Tambah Pelanggan Baru</button>
                    </div>
                    <div class="mb-3">
                        <label for="add_status" class="form-label">Status</label>
                        <select class="form-select" id="add_status" name="status">
                            <option selected disabled>Pilih Status</option>
                            <option value="0">Pending</option>
                            <option value="1">Selesai</option>
                            <option value="2">Gagal</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="add_description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="add_spare_parts" class="form-label">Rincian Spare Part</label>
                        <div class="mb-3 d-flex align-items-center">
                            <select id="select_spare_part" name="select_spare_part">
                                <option value=""></option>
                            </select>
                            <button type="button" class="btn btn-success" id="addSparePart">Tambah</button>
                        </div>
                        <div id="sparePartTable" class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">Spare Part</th>
                                        <th>Jumlah</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Beli</th>
                                        <th>Sub Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="noSparePart" style="display: none;">
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada spare part</td>
                                    </tr>
                                </tbody>
                                <tbody id="sparePartsContainer">
                                    <!-- spare rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="add_total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="add_total" name="total">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // use select 2 for select element
        $('#select_customer').select2({
            dropdownParent: $(".modal-body"),
            // set width
            width: '100%',
            // theme
            theme: 'bootstrap4',
            // placeholder
            placeholder: 'Pilih Pelanggan',
            ajax: {
                url: '<?= site_url('customers/fetch') ?>',
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

        // spare parts select 2
        $('#select_spare_part').select2({
            dropdownParent: $(".modal-body"),
            // theme
            theme: 'bootstrap4',
            // set width
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
        // if spare part names[] is empty, hide table
        if ($('input[name="spare_part_names[]"]').val() == '') {
            $('#sparePartTable').hide();
        }

        // add spare part
        $('#addSparePart').on('click', function() {
            // set id and name for spare part from select 2
            let sparePartId = $('#select_spare_part').val();
            let sparePartName = $('#select_spare_part option:selected').text();

            // check if spare part id is empty
            if (sparePartId == '') {
                alert('Pilih spare part terlebih dahulu');
                return;
            }

            // check if spare part name is empty
            if (sparePartName == '') {
                // show pop up dialog
                alert('Pilih spare part terlebih dahulu');
                return;
            }

            // check if spare part name is already exist
            if ($('input[name="spare_part_names[]"][value="' + sparePartName + '"]').length > 0) {
                alert('Spare part sudah ada');
                return;
            }

            // append spare part to table
            $('#sparePartsContainer').append(`
                <tr>
                    <td>
                        <input type="hidden" name="spare_part_ids[]" value="${sparePartId}">
                        <input type="text" class="form-control" name="spare_part_names[]" value="${sparePartName}" readonly>
                    </td>
                    <td><input type="number" class="form-control" name="quantities[]" placeholder="Jumlah" min="1"></td>
                    <td><input type="number" class="form-control" name="sell_prices[]" placeholder="Harga Jual" step="1"></td>
                    <td><input type="number" class="form-control" name="buy_prices[]" placeholder="Harga Beli" step="1"></td>
                    <td><input type="number" class="form-control" name="sub_totals[]" placeholder="Sub Total" readonly></td>
                    <td><button type="button" class="btn btn-danger remove-spare-part">Hapus</button></td>
                </tr>
            `);

            // calculate sub total
            $('#sparePartsContainer').on('input', 'input[name="quantities[]"], input[name="buy_prices[]"]', function() {
                let quantity = $(this).closest('tr').find('input[name="quantities[]"]').val();
                let buyPrice = $(this).closest('tr').find('input[name="buy_prices[]"]').val();

                let subTotal = quantity * buyPrice;

                $(this).closest('tr').find('input[name="sub_totals[]"]').val(subTotal);
            });

            // show table
            $('#sparePartTable').show();
        });

        // remove spare part
        $('#sparePartsContainer').on('click', '.remove-spare-part', function() {
            $(this).closest('tr').remove();

            // if spare part names[] is empty, hide table
            if ($('input[name="spare_part_names[]"]').val() == '') {
                $('#sparePartTable').hide();
            }
        });
    });
</script>