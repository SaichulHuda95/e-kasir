<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header" id="corner">
    <h1>Edit Produk</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card" id="corner">
            <div class="card-header">
                <a href="<?= base_url(); ?>/produk" class="btn btn-sm btn-warning">
                    <i class="fa fa-backward"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>/produk/update_produk" method="post" class="needs-validation" novalidate="">
                    <input type="hidden" name="id_produk" value="<?= $data_produk->id_produk ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nama_produk" class="col-sm-3 col-form-label col-form-label-sm">Nama Produk</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="nama_produk" name="nama_produk" value="<?= $data_produk->nama_produk ?>" required>
                                    <div class="invalid-feedback">
                                        Nama produk tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_kategori" class="col-sm-3 col-form-label col-form-label-sm">Kategori Produk</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" id="id_kategori" name="id_kategori" required>
                                        <?php
                                        foreach ($kategori as $kategori) :
                                        ?>
                                            <option value="<?= $kategori->id_kategori; ?>"><?= $kategori->nama_kategori; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Kategori produk tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga_jual" class="col-sm-3 col-form-label col-form-label-sm">Harga Jual</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="harga_jual" name="harga_jual" value="<?= $data_produk->harga_jual ?>" required>
                                    <div class="invalid-feedback">
                                        Harga jual tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="stok" class="col-sm-3 col-form-label col-form-label-sm">Stok Produk</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="stok" name="stok" value="<?= $data_produk->stok ?>" required>
                                    <div class="invalid-feedback">
                                        Stok produk tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_satuan" class="col-sm-3 col-form-label col-form-label-sm">Satuan Produk</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" id="id_satuan" name="id_satuan" required>
                                        <?php
                                        foreach ($satuan as $satuan) :
                                        ?>
                                            <option value="<?= $satuan->id_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Satuan produk tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga_beli" class="col-sm-3 col-form-label col-form-label-sm">Harga Beli</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="harga_beli" name="harga_beli" value="<?= $data_produk->harga_beli ?>" required>
                                    <div class="invalid-feedback">
                                        Harga beli tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>