<!-- this is div example for an alert: <div class="alert alert-success">This is success alert.</div> 
 show this based on the alert session data-->
<?php if (session()->getFlashdata('alert')) : ?>
    <div class="alert alert-<?= session()->getFlashdata('alert')['type'] ?> alert-dismissible fade show">
        <?= session()->getFlashdata('alert')['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
<?php endif; ?>

<!-- Display Validation Errors -->
<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>