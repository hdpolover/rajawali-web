<?= $this->extend('templates/clean_layout') ?>

<?= $this->section('content') ?>
<div class="invoice-container">
    <div class="header">
        <h1 class="text-center">RAJAWALI MOTOR</h1>
        <p class="text-center">Jl. Raya Motor No. 123, Bandung</p>
        <p class="text-center">Telp: 022-1234567</p>
        <hr>
        <h2 class="text-center">INVOICE</h2>
    </div>

    <div class="invoice-details mb-4">
        <div class="row">
            <div class="col-6">
                <table class="table table-borderless">
                    <tr>
                        <td>No. Transaksi</td>
                        <td>:</td>
                        <td><?= $sale->sale_number ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><?= date('d M Y H:i', strtotime($sale->sale_date)) ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <?php if ($sale->status == 'completed'): ?>
                                LUNAS
                            <?php elseif ($sale->status == 'process'): ?>
                                PROSES
                            <?php else: ?>
                                PENDING
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-borderless">
                    <tr>
                        <td>Pelanggan</td>
                        <td>:</td>
                        <td><?= !empty($sale->customer->name) ? $sale->customer->name : '-' ?></td>
                    </tr>
                    <tr>
                        <td>No. Telepon</td>
                        <td>:</td>
                        <td><?= !empty($sale->customer->phone) ? $sale->customer->phone : '-' ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= !empty($sale->customer->address) ? $sale->customer->address : '-' ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <?php if (!empty($sale->motorcycle)): ?>
    <div class="vehicle-details mb-4">
        <h5>Informasi Kendaraan</h5>
        <table class="table table-bordered">
            <tr>
                <th>Merk</th>
                <th>Model</th>
                <th>Plat Nomor</th>
            </tr>
            <tr>
                <td><?= $sale->motorcycle->brand ?></td>
                <td><?= $sale->motorcycle->model ?></td>
                <td><?= $sale->motorcycle->license_number ?></td>
            </tr>
        </table>
    </div>
    <?php endif; ?>

    <?php if (!empty($sale->spare_part_sale->details)): ?>
    <div class="spare-parts-details mb-4">
        <h5>Detail Spare Part</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Spare Part</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $sparePartTotal = 0; ?>
                <?php foreach ($sale->spare_part_sale->details as $index => $detail): ?>
                    <?php $sparePartTotal += $detail->sub_total; ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $detail->spare_part->code_number ?></td>
                        <td><?= $detail->spare_part->merk . ' ' . $detail->spare_part->name ?></td>
                        <td><?= $detail->quantity ?></td>
                        <td>Rp <?= number_format($detail->price, 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($detail->sub_total, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total Spare Part</th>
                    <th>Rp <?= number_format($sparePartTotal, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <?php if (!empty($sale->service_sales) && !empty($sale->service_sales->details)): ?>
    <div class="services-details mb-4">
        <h5>Detail Servis</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Servis</th>
                    <th>Mekanik</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $serviceTotal = 0; ?>
                <?php foreach ($sale->service_sales->details as $index => $detail): ?>
                    <?php $serviceTotal += $detail->price; ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $detail->service->name ?></td>
                        <td><?= $detail->mechanic->name ?></td>
                        <td>Rp <?= number_format($detail->price, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total Servis</th>
                    <th>Rp <?= number_format($serviceTotal, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <div class="payment-summary mb-4">
        <table class="table table-bordered">
            <tr>
                <th>Total Belanja</th>
                <td>Rp <?= number_format($sale->total + $sale->discount, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Diskon</th>
                <td>Rp <?= number_format($sale->discount, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Total Pembayaran</th>
                <td>Rp <?= number_format($sale->total, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <?php if (!empty($sale->payment) && !empty($sale->payment->details)): ?>
    <div class="payment-details mb-4">
        <h5>Detail Pembayaran</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Metode Pembayaran</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $paidTotal = 0; ?>
                <?php foreach ($sale->payment->details as $index => $detail): ?>
                    <?php if ($detail->status === 'completed') $paidTotal += $detail->amount; ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $detail->payment_method ?></td>
                        <td>Rp <?= number_format($detail->amount, 0, ',', '.') ?></td>
                        <td><?= date('d M Y', strtotime($detail->payment_date)) ?></td>
                        <td><?= $detail->status === 'completed' ? 'Selesai' : 'Pending' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total Dibayar</th>
                    <th>Rp <?= number_format($paidTotal, 0, ',', '.') ?></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Sisa Pembayaran</th>
                    <th>Rp <?= number_format(max(0, $sale->total - $paidTotal), 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <div class="footer mt-5">
        <div class="row">
            <div class="col-8">
                <p><strong>Catatan:</strong></p>
                <p><?= $sale->description ?: '-' ?></p>
                <p>Terima kasih telah berbelanja di Rajawali Motor. Barang yang sudah dibeli tidak dapat ditukarkan kembali.</p>
            </div>
            <div class="col-4 text-center">
                <p>Hormat Kami,</p>
                <br><br><br>
                <p><u><?= !empty($sale->admin) ? $sale->admin->username : 'Admin' ?></u></p>
                <p>Admin</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>