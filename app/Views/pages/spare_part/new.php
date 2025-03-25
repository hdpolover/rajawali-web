<?= $this->extend('templates/partials/base') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="row mb-4"></div>
    <div class="card">
        <div class="card-content">
            <div class="card-body cursor-default-hover">
                <form id="saveSaleForm" enctype="multipart/form-data" action="<?= site_url('master-data/spare-parts/add') ?>" class="form form-vertical" method="post">
                    <div class="form-body">
                        <div class="mb-3">
                            <label for="sparePartCode" class="form-label fw-bold">Kode Spare Part</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="sparePartCode" name="sparePartCode" required>
                                <button class="btn btn-primary" type="button" id="scanCodeButton">Scan (Kamera)</button>
                            </div>
                            <div id="noBarcode" class="d-flex align-items-center">
                                <p class="text-danger mb-0 me-2">Tidak ada Barcode?</p>
                                <a href="#" class="text-primary text-decoration-underline" id="generateCodeLink">Generate Kode</a>
                            </div>
                        </div>
                        <hr>

                        <div id="restOfForm">
                            <div class="mb-3">
                                <label for="type" class="form-label fw-bold">Tipe Spare Part</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="" disabled selected>Pilih Tipe Spare Part</option>
                                    <?php foreach ($spare_part_types as $type) : ?>
                                        <option value="<?= esc($type->id) ?>"><?= esc($type->name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Nama Spare Part</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="brand" class="form-label fw-bold">Merek</label>
                                <input type="text" class="form-control" id="brand" name="brand" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label fw-bold">Foto Spare Part</label>
                                <img id="photoPreview" src="<?= STORAGE_URL . 'spare_parts/default.jpg' ?>" alt="Preview Foto" style="max-height: 500px; max-width: 100%; margin: 10px 0; display: block; padding: 10px; border: 1px dashed #ccc;">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    <button type="button" class="btn btn-secondary" id="takeFromCameraButton">Ambil dari Kamera</button>
                                </div>
                                <small class="form-text text-muted">Foto akan diunggah ke server FTP</small>
                            </div>
                            <div class="mb-3">
                                <label for="initialStock" class="form-label fw-bold">Stok Awal</label>
                                <input type="number" class="form-control" id="initialStock" name="initialStock" required>
                            </div>
                            <div class="mb-3">
                                <label for="initialSellingPrice" class="form-label fw-bold">Harga Jual Awal</label>
                                <input type="number" class="form-control" id="initialSellingPrice" name="initialSellingPrice" required>
                            </div>
                            <div class="mb-3">
                                <label for="initialPurchasePrice" class="form-label fw-bold">Harga Beli Awal</label>
                                <input type="number" class="form-control" id="initialPurchasePrice" name="initialPurchasePrice" required>
                            </div>
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

<!-- Modal for QuaggaJS -->
<div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scanModalLabel">Scan Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="scanner-container" style="width: 500px; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- include Modals from the other folder-->

<script type="text/javascript">
    function initQuagga() {
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector("#scanner-container"),
                constraints: {
                    width: 480,
                    height: 480,
                    facingMode: "environment" // Use back camera on mobile
                },
                canvas: {
                    willReadFrequently: true,
                }
            },
            decoder: {
                readers: [
                    "code_128_reader",
                    "ean_reader",
                    "ean_8_reader",
                    "code_39_reader",
                    "upc_reader",
                    "upc_e_reader"
                ]
            },
            locate: true,
            frequency: 10,
        }, function(err) {
            if (err) {
                console.error(err);
                return;
            }
            console.log("QuaggaJS initialization succeeded");
            Quagga.start();
        });

        // Handle successful scans
        Quagga.onDetected(function(result) {
            if (!result || !result.codeResult) {
                console.error("Invalid scan result");
                return;
            }
            var code = result.codeResult.code;
            console.log("Barcode detected:", code);

            // Stop scanning and clean up
            Quagga.stop();

            // Update input field
            document.getElementById('sparePartCode').value = code;

            // show the rest of the form
            document.getElementById('restOfForm').style.display = 'block';

            // Close modal if using Bootstrap modal
            $('#scanModal').modal('hide');
        });

        // Add error handling for processing errors
        Quagga.onProcessed(function(result) {
            if (result && result.error) {
                console.warn("Processing error:", result.error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // auto focus code number input
        focusCodeNumber();

        // hide the rest of the form
        document.getElementById('restOfForm').style.display = 'none';

        // generate code
        document.getElementById('generateCodeLink').addEventListener('click', function(e) {
            e.preventDefault();

            // generate code
            const codeNumber = generateCode();

            // set the generated code to the input
            document.getElementById('sparePartCode').value = codeNumber;

            // show the rest of the form
            document.getElementById('restOfForm').style.display = 'block';
        });

        document.getElementById('scanCodeButton').addEventListener('click', function() {
            var scanModal = new bootstrap.Modal(document.getElementById('scanModal'), {
                keyboard: false
            });
            scanModal.show();

        });

        // if the input code number is not empty, show the rest of the form
        document.getElementById('sparePartCode').addEventListener('input', function() {
            if (this.value.trim() !== '') {
                document.getElementById('restOfForm').style.display = 'block';
            } else {
                document.getElementById('restOfForm').style.display = 'none';
            }
        });


        // Initialize scanner when modal opens
        $('#scanModal').on('shown.bs.modal', function() {
            initQuagga();
        });

        // Stop scanner when modal closes
        $('#scanModal').on('hidden.bs.modal', function() {
            Quagga.stop();
        });

        document.getElementById('photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photoPreview').src = e.target.result;
                document.getElementById('photoPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('takeFromCameraButton').addEventListener('click', function() {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    const video = document.createElement('video');
                    video.id = 'cameraVideo';
                    video.autoplay = true;
                    video.playsInline = true;
                    video.srcObject = stream;

                    const modalDialog = document.createElement('div');
                    modalDialog.classList.add('modal-dialog');
                    modalDialog.innerHTML = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ambil Foto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <video id="cameraVideo" style="width: 500px; height: 500px;"></video>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" id="captureButton">Ambil Foto</button>
                        </div>
                    </div>
                `;

                    const modal = document.createElement('div');
                    modal.classList.add('modal', 'fade');
                    modal.id = 'cameraModal';
                    modal.tabIndex = -1;
                    modal.appendChild(modalDialog);

                    document.body.appendChild(modal);

                    const cameraModal = new bootstrap.Modal(modal, {
                        keyboard: false
                    });
                    cameraModal.show();

                    // Append the video element to the modal body
                    document.querySelector('#cameraModal .modal-body').appendChild(video);

                    document.getElementById('captureButton').addEventListener('click', function() {
                        const canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        const context = canvas.getContext('2d');
                        // Adjust canvas size to match the video aspect ratio
                        const aspectRatio = video.videoWidth / video.videoHeight;
                        if (canvas.width / canvas.height > aspectRatio) {
                            canvas.width = canvas.height * aspectRatio;
                        } else {
                            canvas.height = canvas.width / aspectRatio;
                        }
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        const dataUrl = canvas.toDataURL('image/png');
                        document.getElementById('photoPreview').src = dataUrl;
                        document.getElementById('photoPreview').style.display = 'block';

                        // Create a hidden input field for the base64 image data
                        let hiddenInput = document.getElementById('hiddenPhotoData');
                        if (!hiddenInput) {
                            hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.id = 'hiddenPhotoData';
                            hiddenInput.name = 'photo';
                            document.getElementById('saveSaleForm').appendChild(hiddenInput);
                        }
                        hiddenInput.value = dataUrl;

                        // Disable the file input to avoid conflicts
                        document.getElementById('photo').value = '';
                        document.getElementById('photo').disabled = true;

                        stream.getTracks().forEach(track => track.stop());
                        cameraModal.hide();
                    });

                    modal.addEventListener('hidden.bs.modal', function() {
                        stream.getTracks().forEach(track => track.stop());
                        modal.remove();
                    });
                })
                .catch(function(err) {
                    console.error('Error accessing camera: ', err);
                    alert('Gagal mengakses kamera. Silakan coba lagi.');
                });
        });

    });

    // function to convert data URI to Blob
    function dataURItoBlob(dataURI) {
        var byteString = atob(dataURI.split(',')[1]);
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], {
            type: mimeString
        });
    }

    // function to auto focus code number input
    function focusCodeNumber() {
        document.getElementById('sparePartCode').focus();

        // select all text in the input
        document.getElementById('sparePartCode').select();
    }

    // function to generate code
    function generateCode() {
        // generate random code
        const codeNumber = Math.random().toString(36).substring(2, 12).toUpperCase();

        return codeNumber;
    }
</script>

<?= $this->endSection() ?>