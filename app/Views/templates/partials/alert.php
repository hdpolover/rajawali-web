<!-- this is div example for an alert: <div class="alert alert-success">This is success alert.</div> 
 show this based on the alert session data-->
<?php if (session()->getFlashdata('alert')) : ?>
    <div class="alert alert-<?= session()->getFlashdata('alert')['type'] ?>">
        <?= session()->getFlashdata('alert')['message'] ?>
    </div>  
<?php endif; ?>