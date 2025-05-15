<?php
/**
 * WhatsApp modal component for sending invoices to customers
 */
?>
<!-- WhatsApp Modal -->
<div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="whatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">                <h5 class="modal-title" id="whatsappModalLabel">
                    <i class="bi bi-whatsapp text-success me-2"></i>
                    Kirim Struk via WhatsApp
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="whatsappForm">                    <!-- Hidden fields to store data -->
                    <input type="hidden" id="whatsapp_sale_id" name="sale_id">
                    <input type="hidden" id="whatsapp_customer_phone" name="customer_phone">
                    <input type="hidden" id="whatsapp_invoice_number" name="invoice_number">
                    <div class="mb-3">
                        <label for="whatsapp_customer_name" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="whatsapp_customer_name" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="whatsapp_phone" class="form-label">Nomor WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text">+62</span>
                            <input type="text" class="form-control" id="whatsapp_phone" name="phone">
                        </div>
                        <small class="text-muted">Format: 8123456789 (tanpa awalan 0)</small>
                    </div>
                      <div class="mb-3">
                        <label for="whatsapp_message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="whatsapp_message" name="message" rows="4">Yth. {customer_name},

Terima kasih telah berbelanja di Rajawali Motor. Berikut kami lampirkan struk untuk transaksi Anda dengan nomor {invoice_number}.

Hormat kami,
Rajawali Motor</textarea>
                    </div>                      <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="attachInvoice" name="attachInvoice" checked>
                        <label class="form-check-label" for="attachInvoice">
                            Download struk terlebih dahulu
                        </label>                        <small class="form-text text-muted d-block">
                            Centang ini untuk mengunduh struk sebelum mengirim pesan WhatsApp
                        </small>
                    </div>
                </form>
                
                <div class="alert alert-info">
                    <small>
                        <i class="bi bi-info-circle me-1"></i> Catatan:
                        <ul class="mb-0 ps-3">
                            <li>Pastikan format nomor WhatsApp benar</li>
                            <li>Struk akan diunduh ke komputer Anda dengan nama <code>invoice_[nomor_invoice].pdf</code></li>
                            <li>Setelah WhatsApp terbuka, Anda perlu melampirkan struk tersebut secara manual</li>
                            <li>Jika hanya ingin melihat struk tanpa mengirim pesan, gunakan tombol <i class="bi bi-printer text-info"></i> di menu Aksi</li>
                        </ul>
                    </small>
                        </ul>
                    </small>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="sendWhatsappBtn">
                    <i class="bi bi-whatsapp me-1"></i> Kirim Pesan
                </button>
            </div>
        </div>
    </div>
</div>
