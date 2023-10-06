<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Edit Profil Saya</h1>
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
                <form action="<?= base_url(); ?>/profil/update_profil" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $session->id; ?>">
                    <input type="hidden" class="form-control" id="image_lama" name="image_lama" value="<?= $session->image; ?>">
                    <div class="form-group row">
                        <div class="col-sm-2">Foto Profil</div>
                        <div class="col">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?= base_url(); ?>/assets/img/profil/<?= $session->image; ?>" class="img-thumbnail img-preview">
                                </div>
                                <div class="col">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= ($validation->hasError('image')) ? 'is-invalid' : ''; ?>" id="image" name="image" onchange="previewImg()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('image'); ?>
                                        </div>
                                        <label class="custom-file-label" for="image">Pilih Foto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function previewImg() {
        const image = document.querySelector('#image');
        const imageLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        imageLabel.textContent = image.files[0].name;
        const fileImage = new FileReader();
        fileImage.readAsDataURL(image.files[0]);

        fileImage.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>