<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Salary Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            padding: 0;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .summary-table {
            width: 48%;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .service-details {
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .service-details h3 {
            margin: 10px 0;
            font-size: 14px;
        }
        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
            button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RAJAWALI MOTOR</h1>
        <p>Mechanic Salary Report</p>
        <p>Period: <?= date('d M Y', strtotime($start_date)) ?> - <?= date('d M Y', strtotime($end_date)) ?></p>
    </div>

    <button onclick="window.print()" style="margin-bottom: 20px; padding: 5px 10px; background: #007bff; color: white; border: none; cursor: pointer;">Print Report</button>

    <div class="summary">
        <table class="summary-table">
            <tr>
                <th>Period Start</th>
                <td><?= date('d M Y', strtotime($report['period_start'])) ?></td>
            </tr>
            <tr>
                <th>Period End</th>
                <td><?= date('d M Y', strtotime($report['period_end'])) ?></td>
            </tr>
            <tr>
                <th>Total Mechanics</th>
                <td><?= $report['total_mechanics'] ?></td>
            </tr>
        </table>

        <table class="summary-table">
            <tr>
                <th>Total Service Amount</th>
                <td><?= number_format($report['total_service_amount'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Total Commission</th>
                <td><?= number_format($report['total_commission'], 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mechanic Name</th>
                <th>Total Service Amount</th>
                <th>Commission Rate (%)</th>
                <th>Commission Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($report['details'])): ?>
                <?php foreach ($report['details'] as $detail): ?>
                    <tr>
                        <td><?= $detail['mechanic_name'] ?></td>
                        <td><?= number_format($detail['total_service_amount'], 0, ',', '.') ?></td>
                        <td><?= $detail['percentage'] ?>%</td>
                        <td><?= number_format($detail['commission'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">No salary data found for this period</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (!empty($report['details'])): ?>
        <?php foreach ($report['details'] as $detail): ?>
            <div class="service-details">
                <h3>Service Details - <?= $detail['mechanic_name'] ?></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Service</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail['sales'] as $service): ?>
                            <tr>
                                <td><?= date('d M Y', strtotime($service->created_at)) ?></td>
                                <td><?= $service->service_name ?></td>
                                <td><?= number_format($service->service_price, 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th colspan="2">Total</th>
                            <td><?= number_format($detail['total_service_amount'], 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="footer">
        <p>Generated on: <?= date('Y-m-d H:i:s') ?></p>
    </div>
    
    <script>
        // Auto print when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>