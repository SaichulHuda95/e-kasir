<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Profil Saya</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= base_url(); ?>/assets/img/profil/<?= $session->image; ?>" class="img-fluid rounded-start" alt="<?= $session->image; ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-text"><?= $session->username; ?></h5>
                        <p class="card-text"><?= $session->email; ?></p>
                        <p class="card-text"><?= $session->npwpd; ?></p>
                        <p class="card-text"><small class="text-muted">Bergabung pada: <?= date_indo($session->created_at); ?></small></p>
                        <div class="row">
                            <div class="col">
                                <a href="<?= base_url(); ?>/profil/edit_profil">Edit Foto Profil</a>
                            </div>
                            <div class="col-ms">
                                <a href="<?= base_url(); ?>/profil/change_password">Ganti Password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>