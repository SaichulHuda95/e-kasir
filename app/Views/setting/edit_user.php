<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Edit User</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="flash" data-flash="<?= session()->getFlashdata('success'); ?>"></div>
        <div class="card shadow card-outline card-primary">
            <div class="card-header">
                <a class="btn btn-sm btn-warning" href="<?= base_url(); ?>/pengaturan">
                    <i class="fa fa-backward"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>/pengaturan/update_user" method="post">
                    <input type="hidden" class="form-control" name="id" value="<?= $id; ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= $user->username; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= $user->email; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="<?= $user->role_id; ?>"><?= $user->role; ?></option>
                            <?php
                            foreach ($role as $row) :
                            ?>
                                <option value="<?= $row->id; ?>"><?= $row->role; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="password1">Password</label>
                                <input type="password" class="form-control <?= ($validation->hasError('password1')) ? 'is-invalid' : ''; ?>" id="password1" name="password1">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password1'); ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="password2">Ulangi Password</label>
                                <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" id="password2" name="password2">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password2'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>