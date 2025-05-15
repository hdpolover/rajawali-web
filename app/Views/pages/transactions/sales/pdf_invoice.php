<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>        body {
            font-family: Arial, sans-serif;
            font-size: 6.5pt;
            line-height: 1.2;
            color: #333;
            margin: 0;
            padding: 8px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1px;
        }

        table.bordered {
            border: 1px solid #ddd;
        }        table.bordered th,
        table.bordered td {
            border: 1px solid #ddd;
            padding: 2px 4px;
        }

        th {
            background-color: #f0f4f8;
            /* Lighter blue background */
            color: #2c3e50;
            font-weight: 600;
        }        .header {
            text-align: center;
            margin-bottom: 4px;
            padding-bottom: 3px;
            border-bottom: 1px solid #4e73df;
            background: linear-gradient(to right, #ffffff, #f0f4f8, #ffffff);
            padding: 4px;
            border-radius: 4px;
        }

        .header h1 {
            font-size: 12pt;
            margin: 0;
            color: #4e73df;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 0;
            color: #666;
            font-size: 6pt;
        }

        .header h2 {
            font-size: 10pt;
            margin: 3px 0 0 0;
            color: #2c3e50;
            background-color: #f0f4f8;
            display: inline-block;
            padding: 1px 10px;
            border-radius: 10px;
        }        .mb-4 {
            margin-bottom: 8px;
        }

        .mt-5 {
            margin-top: 3px;
        }        .footer {
            margin-top: 8px;
            padding-top: 4px;
            border-top: 1px solid #ddd;
        }

        .col-6 {
            width: 49%;
            float: left;
            margin-right: 1%;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }        /* Customer and Transaction Info Styling */
        .info-table td {
            padding: 2px 4px;
            vertical-align: top;
        }/* Info boxes with subtle background */
        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 3px;
            padding: 4px;
            margin-bottom: 3px;
        }        /* Items Table Styling */
        .bordered thead th {
            background-color: #4e73df;
            color: white;
            padding: 3px 4px;
            font-size: 6.5pt;
            text-align: center;
        }

        .bordered tbody td {
            font-size: 6.5pt;
            padding: 3px 4px;
        }

        .bordered tfoot th,
        .bordered tfoot td {
            background-color: #f0f4f8;
            font-weight: bold;
            font-size: 6.5pt;
            padding: 3px 4px;
        }        /* Payment Summary Styling */
        .payment-summary th {
            background-color: #f0f4f8;
            color: #2c3e50;
            padding: 3px 4px;
        }        .footer p {
            margin: 3px 0;
            color: #666;
            font-size: 6pt;
        }

        /* Signature box */
        .signature-box {
            border-top: 1px dashed #ddd;
            margin-top: 4px;
            padding-top: 4px;
        }

        /* Watermark styling */
        .watermark {
            position: fixed;
            top: 50%;
            left: 0;
            width: 100%;
            text-align: center;
            opacity: 0.05;
            transform: rotate(-35deg);
            transform-origin: 50% 50%;
            z-index: -1000;
            font-size: 60pt;
            color: #4e73df;
            font-weight: bold;
            letter-spacing: 3px;
        }        /* Section Headers */
        .section-header {
            background-color: #4e73df;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            display: inline-block;
            font-size: 7pt;
            margin-bottom: 4px;
            margin-top: 0;
            font-weight: bold;
        }
    </style>
</head>

<body>    <div class="header" style="margin-bottom: 5px;">
        <table style="width: 100%; border: none; margin-bottom: 0;">
            <tr>
                <td style="width: 55px; text-align: left; vertical-align: middle; padding: 4px;">
                    <!-- Logo image -->
                    <?php if (!empty($logoBase64)): ?>
                        <img src="<?= $logoBase64 ?>" alt="Rajawali Motor" style="width: 45px; height: auto; margin: 0;">
                    <?php else: ?>
                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #4e73df; margin: 0; display: flex; justify-content: center; align-items: center; color: white; font-weight: bold; font-size: 12pt;">RM</div>
                    <?php endif; ?>
                </td>
                <td style="text-align: left; vertical-align: middle; padding: 4px 8px;">
                    <h1 style="margin: 0; line-height: 1.2;">BENGKEL RAJAWALI MOTOR</h1>
                    <p style="margin: 2px 0; line-height: 1.2;">Jl. Mertojoyo Sel. No.4, Merjosari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144</p>
                    <p style="margin: 2px 0; line-height: 1.2;">Telp: 085645523234</p>
                </td>
            </tr>
        </table>        <div style="margin: 2px 0; border-top: 1px dashed #4e73df;"></div>
        <h2 style="margin: 3px 0 2px 0; font-size: 9pt; padding: 2px 10px; text-align: center;">STRUK PEMBAYARAN</h2>
    </div>
    <div class="row mb-4" style="margin-bottom: 6px;">        <div class="col-6 info-box">
            <table class="info-table">
                <tr>
                    <td width="40%"><strong>No. Transaksi</strong></td>
                    <td width="5%">:</td>
                    <td width="55%"><span style="color: #4e73df; font-weight: bold; font-size: 7pt;"><?= $sale->sale_number ?></span></td>
                </tr>
                <tr>
                    <td width="40%"><strong>Tanggal</strong></td>
                    <td width="5%">:</td>
                    <td width="55%"><?= date('d M Y H:i', strtotime($sale->sale_date)) ?></td>
                </tr>
                <tr>
                    <td width="40%"><strong>Status</strong></td>
                    <td width="5%">:</td>
                    <td width="55%">
                        <?php if ($sale->status == 'completed'): ?>
                            <span style="color: #1cc88a; font-weight: bold; font-size: 7pt;">LUNAS</span>
                        <?php elseif ($sale->status == 'process'): ?>
                            <span style="color: #f6c23e; font-weight: bold; font-size: 7pt;">PROSES</span>
                        <?php else: ?>
                            <span style="color: #e74a3b; font-weight: bold; font-size: 7pt;">PENDING</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>        <div class="col-6 info-box">
            <table class="info-table">
                <tr>
                    <td width="40%"><strong>Pelanggan</strong></td>
                    <td width="5%">:</td>
                    <td width="55%"><?= !empty($sale->customer->name) ? '<span style="font-size: 7pt;">'.$sale->customer->name.'</span>' : '<em>Pelanggan Umum</em>' ?></td>
                </tr>
                <tr>
                    <td width="40%"><strong>No. Telepon</strong></td>
                    <td width="5%">:</td>
                    <td width="55%"><?= !empty($sale->customer->phone) ? $sale->customer->phone : '-' ?></td>
                </tr>
                <tr>
                    <td width="40%"><strong>Alamat</strong></td>
                    <td width="5%">:</td>
                    <td width="55%"><?= !empty($sale->customer->address) ? $sale->customer->address : '-' ?></td>
                </tr>
            </table>
        </div>
    </div> <?php if (!empty($sale->motorcycle)): ?>
        <div class="mb-4">            <p class="section-header">
                <i>Informasi Kendaraan</i>
            </p>
            <table class="bordered">
                <tr>
                    <th width="33%" style="text-align: center;">Merk</th>
                    <th width="33%" style="text-align: center;">Model</th>
                    <th width="34%" style="text-align: center;">Plat Nomor</th>
                </tr>
                <tr>
                    <td width="33%" class="text-center"><?= $sale->motorcycle->brand ?></td>
                    <td width="33%" class="text-center"><?= $sale->motorcycle->model ?></td>
                    <td width="34%" class="text-center" style="font-weight: bold;"><?= $sale->motorcycle->license_number ?></td>
                </tr>
            </table>
        </div>
    <?php endif; ?> <?php if (!empty($sale->spare_part_sale->details)): ?>
        <div class="mb-4">            <p class="section-header">
                <i>Detail Spare Part</i>
            </p>
            <table class="bordered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Kode</th>
                        <th width="30%">Spare Part</th>
                        <th width="10%">Jumlah</th>
                        <th width="20%">Harga</th>
                        <th width="20%">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sparePartTotal = 0; ?>
                    <?php foreach ($sale->spare_part_sale->details as $index => $detail): ?>
                        <?php $sparePartTotal += $detail->sub_total; ?>
                        <tr>
                            <td width="5%" class="text-center"><?= $index + 1 ?></td>
                            <td width="15%"><?= $detail->spare_part->code_number ?></td>
                            <td width="30%"><?= $detail->spare_part->merk . ' ' . $detail->spare_part->name ?></td>
                            <td width="10%" class="text-center"><?= $detail->quantity ?></td>
                            <td width="20%" class="text-right">Rp <?= number_format($detail->price, 0, ',', '.') ?></td>
                            <td width="20%" class="text-right">Rp <?= number_format($detail->sub_total, 0, ',', '.') ?></td>
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
        <div class="mb-4">            <p class="section-header">
                <i>Detail Servis</i>
            </p>
            <table class="bordered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="45%">Nama Servis</th>
                        <th width="25%">Mekanik</th>
                        <th width="25%">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $serviceTotal = 0; ?>
                    <?php foreach ($sale->service_sales->details as $index => $detail): ?>
                        <?php $serviceTotal += $detail->price; ?>
                        <tr>
                            <td width="5%" class="text-center"><?= $index + 1 ?></td>
                            <td width="45%"><?= $detail->service->name ?></td>
                            <td width="25%"><?= $detail->mechanic->name ?></td>
                            <td width="25%" class="text-right">Rp <?= number_format($detail->price, 0, ',', '.') ?></td>
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
    <div class="mb-4">        <p class="section-header">
            <i>Ringkasan Pembayaran</i>
        </p>
        <table class="bordered payment-summary">
            <tr>
                <th width="80%" class="text-right">Total Belanja</th>
                <td width="20%" class="text-right">Rp <?= number_format($sale->total + $sale->discount, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th width="80%" class="text-right">Diskon</th>
                <td width="20%" class="text-right">Rp <?= number_format($sale->discount, 0, ',', '.') ?></td>
            </tr>
            <tr style="background-color: #e8f4fe;">
                <th width="80%" class="text-right" style="font-weight: bold; color: #4e73df;">Total Pembayaran</th>
                <td width="20%" class="text-right" style="font-weight: bold; color: #4e73df;">Rp <?= number_format($sale->total, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>
    <?php if (!empty($sale->payment) && !empty($sale->payment->details)): ?>
        <div class="mb-4">            <p class="section-header">
                <i>Detail Pembayaran</i>
            </p>
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
                            <td width="5%" class="text-center"><?= $index + 1 ?></td>
                            <td width="25%"><?= $detail->payment_method ?></td>
                            <td width="25%" class="text-right">Rp <?= number_format($detail->amount, 0, ',', '.') ?></td>
                            <td width="25%" class="text-center"><?= date('d M Y', strtotime($detail->payment_date)) ?></td>
                            <td width="20%" class="text-center">
                                <?php if ($detail->status === 'completed'): ?>
                                    <span style="color: #1cc88a; font-weight: bold;">Selesai</span>
                                <?php else: ?>
                                    <span style="color: #e74a3b;">Pending</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Total Dibayar</th>
                        <th class="text-right">Rp <?= number_format($paidTotal, 0, ',', '.') ?></th>
                    </tr>
                    <?php if ($sale->total - $paidTotal > 0): ?>
                        <tr style="background-color: #fff3cd; color: #856404;">
                            <th colspan="4" class="text-right">Sisa Pembayaran</th>
                            <th class="text-right">Rp <?= number_format(max(0, $sale->total - $paidTotal), 0, ',', '.') ?></th>
                        </tr>
                    <?php endif; ?>
                </tfoot>
            </table>
        </div>
    <?php endif; ?>    <div class="footer">
        <div class="row">
            <div style="width: 60%; float: left; padding-right: 10px;">
                <div style="background-color: #f8f9fa; border-radius: 3px; padding: 4px 6px; border-left: 2px solid #4e73df; font-size: 6pt;">
                    <p style="margin: 0;"><strong>Catatan:</strong>
                        <?= $sale->description ?: '<em>Tidak ada catatan</em>' ?></p>
                </div>
                <p style="margin-top: 4px; margin-bottom: 0; font-size: 6.5pt;">Terima kasih telah berbelanja di Rajawali Motor.<br>
                    <em style="font-size: 5.5pt;">Barang yang sudah dibeli tidak dapat ditukarkan kembali.</em>
                </p>
            </div>
            <div style="width: 40%; float: left; text-align: center;">
                <div class="signature-box" style="margin-top: 0px;">
                    <p style="margin: 0; font-size: 6.5pt;">Hormat Kami,</p>
                    <div style="height: 12px;"></div>
                    <p style="border-top: 1px solid #ddd; padding-top: 3px; margin: 0;">
                        <strong style="font-size: 7.5pt;"><?= !empty($sale->admin) ? $sale->admin->username : 'Admin' ?></strong><br>
                        <small style="font-size: 6pt;">Admin</small>
                    </p>                    <!-- Shop Stamp -->
                    <div style="position: relative; margin-top: 5px;">
                        <div style="position: absolute; top: -45px; right: 10px; width: 50px; height: 50px; border: 1.5px dashed #e74a3b; border-radius: 50%; display: flex; justify-content: center; align-items: center; transform: rotate(-15deg);">
                            <div style="text-align: center; line-height: 1.2;">
                                <div style="color: #e74a3b; font-weight: bold; font-size: 8pt;">LUNAS</div>
                                <div style="font-size: 5.5pt; color: #555;"><?= date('d/m/Y') ?></div>
                                <div style="font-size: 4.5pt; color: #777;">Bengkel Rajawali Motor</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>