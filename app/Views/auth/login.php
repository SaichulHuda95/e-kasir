<?= $this->extend('auth/layout-login'); ?>

<?= $this->section('login-page'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="<?= base_url() ?>/assets/img/logo.png" alt="logo" width="150">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Login<b> E-KASIR</b></h4>
                </div>

                <div id="flashfail" data-flash="<?= session()->getFlashdata('fail'); ?>"></div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('auth/login'); ?>">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username'); ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                            </div>
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Masuk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="simple-footer">
                Copyright &copy; Stisla 2018
            </div> -->
        </div>
    </div>
</div>
<?= $this->endSection(); ?>