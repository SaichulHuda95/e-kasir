<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Ganti Password</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-sm btn-warning" href="<?= base_url(); ?>/profil">
                    <i class="fa fa-backward"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>/profil/update_password" method="post">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $session->id; ?>">
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control <?= ($validation->hasError('current_password')) ? 'is-invalid' : ''; ?>" id="current_password" name="current_password">
                        <div class="invalid-feedback">
                            <?= $validation->getError('current_password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password1">Password Baru</label>
                        <input type="password" class="form-control <?= ($validation->hasError('new_password1')) ? 'is-invalid' : ''; ?>" id="new_password1" name="new_password1">
                        <div class="invalid-feedback">
                            <?= $validation->getError('new_password1'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password2">Ulangi Password Baru</label>
                        <input type="password" class="form-control <?= ($validation->hasError('new_password2')) ? 'is-invalid' : ''; ?>" id="new_password2" name="new_password2">
                        <div class="invalid-feedback">
                            <?= $validation->getError('new_password2'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">Ganti Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>