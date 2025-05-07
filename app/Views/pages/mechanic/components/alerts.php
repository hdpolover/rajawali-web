<!-- Alert Messages -->
<?php if (session()->getFlashdata('alert')) : ?>
    <div class="alert alert-<?= session()->getFlashdata('alert')['type'] ?> alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('alert')['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Display Validation Errors -->
<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
