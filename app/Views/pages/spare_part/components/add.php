<!-- Add Spare Part Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Spare Part Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addSparePartForm" method="POST" action="<?= base_url('spare-parts/add') ?>" enctype="multipart/form-data">
                <div class="modal-body" class="mb-3">
                    <label for="add_code_number" class="form-label">Kode Barcode</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control me-3" id="add_code_number" name="code_number" required autofocus>
                        <button type="button" class="btn btn-outline-primary" id="scan_code_with_camera">Scan Barcode</button>
                    </div>
                    <div id="generate_code_container" class="input-group mb-3">
                        <p class="me-2">Spare part tidak ada barcode?</p>
                        <a id="generate_code" href="" style="text-decoration: underline;">Buat Kode</a>
                    </div>
                    <!-- web camera scanner preview -->
                    <div id="web_camera_scanner_preview" class="d-none">
                        <div id="webcam-container" style="width: 100%; height: 240px; border: 2px solid #000;"></div>
                        <button type="button" class="btn btn-danger mt-2" id="stop_camera">Stop Kamera</button>
                    </div>
                    <!-- rest of the form -->
                    <div id="rest_of_form" class="d-none">
                        <div class="mb-3">
                            <label for="add_name" class="form-label">Nama Spare Part</label>
                            <input type="text" class="form-control" id="add_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_merk" class="form-label">Merk</label>
                            <input type="text" class="form-control" id="add_merk" name="merk">
                        </div>
                        <div class="mb-3">
                            <label for="add_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="add_description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="add_type" class="form-label">Tipe Spare Part</label>
                            <select class="form-select" id="add_type" name="type" required>
                                <option value="">Pilih Tipe Spare Part</option>
                                <?php foreach ($spare_part_types as $type) : ?>
                                    <option value="<?= esc($type->id) ?>"><?= esc($type->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="add_photo" class="form-label">Foto</label>
                            <div id="photo_preview" style="width: 100%; height: 200px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                <span class="text-muted">Belum ada foto</span>
                            </div>
                            <button type="button" class="btn btn-secondary mb-2" id="select_photo">Pilih dari Folder</button>
                            <button type="button" class="btn btn-primary mb-2" id="capture_photo">Ambil Foto</button>
                            <input type="file" class="form-control" id="add_photo" name="photo" accept="image/*">
                        </div> -->
                        <div class="mb-3">
                            <label for="add_stock" class="form-label">Stok Awal</label>
                            <input type="number" class="form-control" id="add_stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_sell_price" class="form-label">Harga Jual Awal</label>
                            <input type="number" class="form-control" id="add_sell_price" name="sell_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_buy_price" class="form-label">Harga Beli Awal</label>
                            <input type="number" class="form-control" id="add_buy_price" name="buy_price" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button id="submitButton" type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // capture photo function with webcamjs
    // function capturePhoto() {
    //     // init webcam
    //     Webcam.set({
    //         width: 640,
    //         height: 480,
    //         image_format: 'jpeg',
    //         jpeg_quality: 90
    //     });

    //     Webcam.attach('#photo_preview');
    // }

    document.addEventListener('DOMContentLoaded', function() {
        // Webcam.js
        // const photoPreview = document.getElementById('photo_preview');
        // const addPhotoInput = document.getElementById('add_photo');
        // const selectPhotoButton = document.getElementById('select_photo');
        // const takeSnapshotButton = document.getElementById('take_snapshot');
        // const stopCameraButton = document.getElementById('stop_camera');

        const codeNumberInput = document.getElementById('add_code_number');

        const generateCodeLink = document.getElementById('generate_code');
        const generateCodeContainer = document.getElementById('generate_code_container');
        const restOfForm = document.getElementById('rest_of_form');
        // const webcamContainer = document.getElementById('webcam-container');

        // const webCameraScannerPreview = document.getElementById('web_camera_scanner_preview');
        // const scanCodeWithCameraButton = document.getElementById('scan_code_with_camera');
        // const stopScannerButton = document.getElementById('stop_camera');

        // const capturePhotoButton = document.getElementById('capture_photo');

        // // capture photo button click event
        // capturePhotoButton.addEventListener('click', (e) => {
        //     e.preventDefault();
        //     capturePhoto();
        // });

        // when add modal is shown, focus on the code number input
        $('#addModal').on('shown.bs.modal', function() {
            codeNumberInput.focus();
        });

        // when code number input value changes, show the rest of the form
        codeNumberInput.addEventListener('input', (e) => {
            if (e.target.value) {
                restOfForm.classList.remove('d-none');
            } else {
                restOfForm.classList.add('d-none');
            }
        });

        // capturePhotoButton.addEventListener('click', () => {
        //     Webcam.attach(webcamContainer);

        //     // hide select photo button
        //     selectPhotoButton.classList.add('d-none');
        //     capturePhotoButton.classList.add('d-none');
        //     takeSnapshotButton.classList.remove('d-none');
        //     stopCameraButton.classList.remove('d-none');
        // });

        // // Handle file input change
        // addPhotoInput.addEventListener('change', (e) => {
        //     const file = e.target.files[0];
        //     const reader = new FileReader();

        //     reader.onload = function(e) {
        //         photoPreview.innerHTML = `<img src="${e.target.result}" alt="photo" class="img-fluid" style="max-width: 100%;">`;
        //     }

        //     reader.readAsDataURL(file);


        //     // add file to the input
        //     addPhotoInput.files = e.target.files;
        // });

        // // Handle select photo button click
        // selectPhotoButton.addEventListener('click', () => {
        //     addPhotoInput.click();
        // });

        codeNumberInput.addEventListener('focus', (e) => {
            e.target.select();
        });

        generateCodeLink.addEventListener('click', (e) => {
            e.preventDefault();
            const codeNumber = Math.random().toString(36).substring(2, 12).toUpperCase();
            codeNumberInput.value = codeNumber;
            restOfForm.classList.remove('d-none');
        });


        // when close or dismiss the modal, reset all fields and stop the scanner
        $('#addModal').on('hidden.bs.modal', function() {
            codeNumberInput.value = '';
            restOfForm.classList.add('d-none');
            //generateCodeContainer.classList.remove('d-none');
            //webCameraScannerPreview.classList.add('d-none');
            //stopScanner();
        });


    });
</script>