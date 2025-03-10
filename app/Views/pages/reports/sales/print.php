<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
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
        <p>Sales Report</p>
        <p>Period: <?= date('d M Y', strtotime($start_date)) ?> - <?= date('d M Y', strtotime($end_date)) ?></p>
    </div>

    <button onclick="window.print()" style="margin-bottom: 20px; padding: 5px 10px; background: #007bff; color: white; border: none; cursor: pointer;">Print Report</button>

    <div class="summary">
        <table class="summary-table">
            <tr>
                <th>Total Sales</th>
                <td><?= $report['summary']['total_sales'] ?></td>
            </tr>
            <tr>
                <th>Total Amount</th>
                <td><?= number_format($report['summary']['total_amount'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Total Discount</th>
                <td><?= number_format($report['summary']['total_discount'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Total Tax</th>
                <td><?= number_format($report['summary']['total_tax'], 0, ',', '.') ?></td>
            </tr>
        </table>

        <table class="summary-table">
            <tr>
                <th>Grand Total</th>
                <td><?= number_format($report['summary']['total_grand_total'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Paid Sales</th>
                <td><?= $report['summary']['paid_sales'] ?></td>
            </tr>
            <tr>
                <th>Unpaid Sales</th>
                <td><?= $report['summary']['unpaid_sales'] ?></td>
            </tr>
            <tr>
                <th>Partial Sales</th>
                <td><?= $report['summary']['partial_sales'] ?></td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>Grand Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($report['sales'])): ?>
                <?php foreach ($report['sales'] as $sale): ?>
                    <tr>
                        <td><?= $sale->invoice_number ?></td>
                        <td><?= date('d M Y', strtotime($sale->date)) ?></td>
                        <td><?= $sale->customer_name ?></td>
                        <td><?= number_format($sale->total_amount, 0, ',', '.') ?></td>
                        <td><?= number_format($sale->discount, 0, ',', '.') ?></td>
                        <td><?= number_format($sale->tax, 0, ',', '.') ?></td>
                        <td><?= number_format($sale->grand_total, 0, ',', '.') ?></td>
                        <td><?= $sale->payment_status ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center;">No sales data found for this period</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

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