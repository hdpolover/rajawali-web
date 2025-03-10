<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.bordered {
            border: 1px solid #ddd;
        }
        table.bordered th, table.bordered td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #2c3e50;
        }
        .header h1 {
            font-size: 24pt;
            margin: 0;
            color: #2c3e50;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .header h2 {
            font-size: 18pt;
            margin: 15px 0 0 0;
            color: #2c3e50;
        }
        
        .mb-4 { margin-bottom: 25px; }
        .mt-5 { margin-top: 35px; }
        
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        
        .col-6 {
            width: 48%;
            float: left;
            margin-right: 2%;
        }
        
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        
        /* Customer and Transaction Info Styling */
        .info-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        
        /* Items Table Styling */
        .bordered thead th {
            background-color: #2c3e50;
            color: white;
            padding: 10px 8px;
        }
        
        .bordered tfoot th, .bordered tfoot td {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        /* Payment Summary Styling */
        .payment-summary th {
            background-color: #f8f9fa;
            color: #2c3e50;
        }
        
        .footer p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RAJAWALI MOTOR</h1>
        <p>Jl. Raya Motor No. 123, Bandung</p>
        <p>Telp: 022-1234567</p>
        <hr>
        <h2>INVOICE</h2>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            <table class="info-table">
                <tr>
                    <td width="40%">No. Transaksi</td>
                    <td width="5%">:</td>
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
            <table class="info-table">
                <tr>
                    <td width="40%">Pelanggan</td>
                    <td width="5%">:</td>
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

    <?php if (!empty($sale->motorcycle)): ?>
    <div class="mb-4">
        <p><strong>Informasi Kendaraan</strong></p>
        <table class="bordered">
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
    <div class="mb-4">
        <p><strong>Detail Spare Part</strong></p>
        <table class="bordered">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="15%">Kode</th>
                    <th width="35%">Spare Part</th>
                    <th width="10%">Jumlah</th>
                    <th width="15%">Harga</th>
                    <th width="20%">Subtotal</th>
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
                        <td class="text-right">Rp <?= number_format($detail->price, 0, ',', '.') ?></td>
                        <td class="text-right">Rp <?= number_format($detail->sub_total, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total Spare Part</th>
                    <th class="text-right">Rp <?= number_format($sparePartTotal, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <?php if (!empty($sale->service_sales) && !empty($sale->service_sales->details)): ?>
    <div class="mb-4">
        <p><strong>Detail Servis</strong></p>
        <table class="bordered">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="50%">Nama Servis</th>
                    <th width="25%">Mekanik</th>
                    <th width="20%">Harga</th>
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
                        <td class="text-right">Rp <?= number_format($detail->price, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total Servis</th>
                    <th class="text-right">Rp <?= number_format($serviceTotal, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <div class="mb-4">
        <p><strong>Ringkasan Pembayaran</strong></p>
        <table class="bordered payment-summary">
            <tr>
                <th width="80%" class="text-right">Total Belanja</th>
                <td width="20%" class="text-right">Rp <?= number_format($sale->total + $sale->discount, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th class="text-right">Diskon</th>
                <td class="text-right">Rp <?= number_format($sale->discount, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th class="text-right">Total Pembayaran</th>
                <td class="text-right">Rp <?= number_format($sale->total, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <?php if (!empty($sale->payment) && !empty($sale->payment->details)): ?>
    <div class="mb-4">
        <p><strong>Detail Pembayaran</strong></p>
        <table class="bordered">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="25%">Metode Pembayaran</th>
                    <th width="25%">Jumlah</th>
                    <th width="25%">Tanggal</th>
                    <th width="20%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $paidTotal = 0; ?>
                <?php foreach ($sale->payment->details as $index => $detail): ?>
                    <?php if ($detail->status === 'completed') $paidTotal += $detail->amount; ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $detail->payment_method ?></td>
                        <td class="text-right">Rp <?= number_format($detail->amount, 0, ',', '.') ?></td>
                        <td><?= date('d M Y', strtotime($detail->payment_date)) ?></td>
                        <td><?= $detail->status === 'completed' ? 'Selesai' : 'Pending' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total Dibayar</th>
                    <th class="text-right">Rp <?= number_format($paidTotal, 0, ',', '.') ?></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Sisa Pembayaran</th>
                    <th class="text-right">Rp <?= number_format(max(0, $sale->total - $paidTotal), 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <div class="footer">
        <div class="row">
            <div style="width: 60%; float: left;">
                <p><strong>Catatan:</strong><br>
                <?= $sale->description ?: '-' ?></p>
                <p>Terima kasih telah berbelanja di Rajawali Motor.<br>
                Barang yang sudah dibeli tidak dapat ditukarkan kembali.</p>
            </div>
            <div style="width: 40%; float: left; text-align: center;">
                <p>Hormat Kami,</p>
                <br><br><br>
                <p><u><?= !empty($sale->admin) ? $sale->admin->username : 'Admin' ?></u><br>
                Admin</p>
            </div>
        </div>
    </div>
</body>
</html>