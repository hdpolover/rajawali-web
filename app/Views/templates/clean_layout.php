<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Rajawali Motor' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }
        .invoice-container {
            max-width: 1024px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 5px;
        }
        .table-borderless td, .table-borderless th {
            border: none;
        }
        .text-right {
            text-align: right;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .mt-5 {
            margin-top: 3rem;
        }
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            .no-print {
                display: none;
            }
            .invoice-container {
                width: 100%;
                max-width: 100%;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <?= $this->renderSection('content') ?>

    <div class="no-print text-center mt-4 mb-4">
        <button onclick="window.print()" class="btn btn-primary">Cetak Invoice</button>
        <button onclick="window.history.back()" class="btn btn-secondary">Kembali</button>
    </div>

    <script>
        // Auto print if in PDF mode
        if (window.location.search.includes('pdf=true')) {
            window.print();
        }
    </script>
</body>
</html>