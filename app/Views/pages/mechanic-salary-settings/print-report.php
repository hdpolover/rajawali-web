<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Salary Report</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
        .report-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .report-period {
            font-size: 14px;
            color: #666;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .summary {
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
        }
        .summary-box {
            border: 1px solid #ddd;
            padding: 15px;
            width: 30%;
            text-align: center;
            border-radius: 5px;
        }
        .summary-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f5f5f5;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .page-break {
            page-break-before: always;
        }
        .details {
            margin-top: 30px;
        }
        .mechanic-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        @media print {
            body {
                padding: 0;
                margin: 10mm;
            }
            button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">RAJAWALI MOTOR</div>
        <div class="report-title">Mechanic Salary Report</div>
        <div class="report-period">Period: <?= date('d M Y', strtotime($start_date)) ?> - <?= date('d M Y', strtotime($end_date)) ?></div>
    </div>
    
    <div class="summary">
        <div class="summary-box">
            <div class="summary-title">Total Service Amount</div>
            <div class="summary-value">Rp <?= number_format($report['total_service_amount'], 0, ',', '.') ?></div>
        </div>
        <div class="summary-box">
            <div class="summary-title">Total Commission</div>
            <div class="summary-value">Rp <?= number_format($report['total_commission'], 0, ',', '.') ?></div>
        </div>
        <div class="summary-box">
            <div class="summary-title">Total Mechanics</div>
            <div class="summary-value"><?= $report['total_mechanics'] ?></div>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mechanic Name</th>
                <th>Commission</th>
                <th>Service Amount</th>
                <th>Commission Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($report['details'])) : ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No data found for the selected period</td>
                </tr>
            <?php else : ?>
                <?php $i = 1; foreach ($report['details'] as $detail) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $detail['mechanic_name'] ?></td>
                        <td><?= $detail['percentage'] ?>%</td>
                        <td>Rp <?= number_format($detail['total_service_amount'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($detail['commission'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <?php if (!empty($report['details'])) : ?>
        <?php foreach ($report['details'] as $detail) : ?>
            <div class="page-break"></div>
            <div class="details">
                <div class="mechanic-name"><?= $detail['mechanic_name'] ?> - Service Details</div>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Service</th>
                            <th>Sale ID</th>
                            <th>Price</th>
                            <th>Commission (<?= $detail['percentage'] ?>%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalCommission = 0; ?>
                        <?php foreach ($detail['sales'] as $sale) : ?>
                            <?php 
                                $commission = ($detail['percentage'] / 100) * $sale->service_price;
                                $totalCommission += $commission;
                            ?>
                            <tr>
                                <td><?= date('d M Y', strtotime($sale->created_at)) ?></td>
                                <td><?= $sale->service_name ?></td>
                                <td><?= $sale->sale_id ?></td>
                                <td>Rp <?= number_format($sale->service_price, 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($commission, 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" style="text-align: right; font-weight: bold;">Total:</td>
                            <td style="font-weight: bold;">Rp <?= number_format($totalCommission, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <div class="footer">
        <p>Generated on <?= date('d M Y H:i:s') ?></p>
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 20px;">Print Report</button>
    </div>
    
    <script>
        window.onload = function() {
            // Auto print when the page loads
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>