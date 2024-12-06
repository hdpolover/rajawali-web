<?php $this->extend('templates/partials/base'); ?>

<?php $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Customer Motor</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" onclick="addCustomerMotor()">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="customerMotorTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Customer</th>
                                <th>No. Polisi</th>
                                <th>Merk Motor</th>
                                <th>Type Motor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="customerMotorModal" tabindex="-1" role="dialog" aria-labelledby="customerMotorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerMotorModalLabel">Form Customer Motor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="customerMotorForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Customer</label>
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
                    </div>
                    <div class="form-group">
                        <label>No. Polisi</label>
                        <input type="text" class="form-control" id="no_polisi" name="no_polisi" required>
                    </div>
                    <div class="form-group">
                        <label>Merk Motor</label>
                        <input type="text" class="form-control" id="merk_motor" name="merk_motor" required>
                    </div>
                    <div class="form-group">
                        <label>Type Motor</label>
                        <input type="text" class="form-control" id="type_motor" name="type_motor" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>