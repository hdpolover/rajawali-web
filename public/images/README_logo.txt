This is a placeholder for the Rajawali Motor logo.

To use a real logo:
1. Replace the logo placeholder in 'pdf_invoice.php' with an actual logo image.
2. Use an image format supported by TCPDF (PNG with transparency recommended).
3. Size the logo appropriately (approximately 60x60 pixels).
4. Place the logo in the public/images/ directory.

Update the code in pdf_invoice.php from:
```html
<div style="width: 60px; height: 60px; border-radius: 50%; background-color: #4e73df; margin: 0 auto; display: flex; justify-content: center; align-items: center; color: white; font-weight: bold; font-size: 12pt;">RM</div>
```

To:
```html
<img src="<?= base_url('images/logo.png') ?>" alt="Rajawali Motor" style="width: 60px; height: auto;">
```

Note: For PDF generation, you might need to use an absolute file path rather than base_url. 
The TCPDF library would need the server file path to the image.

Example for direct file path:
```php
// In the Sales controller's print_invoice_pdf method
$imagePath = FCPATH . 'images/logo.png';
$imageData = file_get_contents($imagePath);
$base64 = 'data:image/png;base64,' . base64_encode($imageData);

// Then pass $base64 to the view and use it in the img tag:
<img src="<?= $base64 ?>" alt="Rajawali Motor" style="width: 60px; height: auto;">
```

This would ensure the logo is embedded directly in the PDF.
