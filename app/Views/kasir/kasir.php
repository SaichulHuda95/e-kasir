<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Kasir</h1>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>No. Faktur</label>
                        <label class="form-control form-control-sm text-danger no_faktur"><?= $no_faktur ?></label>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Tanggal</label>
                        <label class="form-control form-control-sm"><?= date_indo(date('Y-m-d')) ?></label>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Jam</label>
                        <label class="form-control form-control-sm"><?= date('H:i:s') ?></label>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Kasir</label>
                        <label class="form-control form-control-sm text-primary"><?= $session->username ?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card bg-dark">
            <div class="card-body">
                <h1 class="text-right text-success"><?= "Rp " . number_format($total, 0, ",", "."); ?></h1>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="kasir/addCart" method="post">
                            <input type="hidden" id="no_faktur" value="<?= $no_faktur ?>">
                            <input type="hidden" id="grand_total" value="<?= $total ?>">
                            <div class="row">
                                <div class="col-2 input-group">
                                    <input class="form-control form-control-sm" id="kode_produk" name="kode_produk" placeholder="Kode Produk" autocomplete="off">
                                    <span class="input-group-append">
                                        <button class="btn btn-primary btn-sm searchProduk">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="col-2">
                                    <input class="form-control form-control-sm" id="nama_produk" name="nama_produk" placeholder="Nama Produk" readonly>
                                </div>
                                <div class="col-2">
                                    <input class="form-control form-control-sm" id="kategori" name="kategori" placeholder="Kategori" readonly>
                                </div>
                                <div class="col-1">
                                    <input class="form-control form-control-sm" id="satuan" name="satuan" placeholder="Satuan" readonly>
                                </div>
                                <div class="col-1">
                                    <input class="form-control form-control-sm" id="harga_jual" name="harga_jual" placeholder="Harga" readonly>
                                </div>
                                <div class="col-1">
                                    <input type="number" min="1" class="form-control form-control-sm text-center" id="qty" name="qty" placeholder="QTY" value="1">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-cart-plus"></i></button>
                                    <a href="<?= base_url() ?>/kasir/clearCart" class="btn btn-warning btn-sm"><i class="fas fa-sync"></i></a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="pembayaran()"><i class="fas fa-cash-register"></i> Pembayaran</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga Jual</th>
                                        <th width="100px">QTY</th>
                                        <th>Total Harga</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($isi_cart as $row) : ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $row['name']; ?></td>
                                            <td><?= $row['options']['kategori']; ?></td>
                                            <td class="text-right"><?= "Rp " . number_format($row['price'], 0, ",", "."); ?></td>
                                            <td class="text-center"><?= $row['qty']; ?> <?= $row['options']['satuan'] ?></td>
                                            <td class="text-right"><?= "Rp " . number_format($row['subtotal'], 0, ",", "."); ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url() ?>/kasir/deleteCart/<?= $row['rowid']; ?>" class="btn btn-sm text-danger"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card bg-dark">
            <div class="card-body text-center">
                <?php
                if ($total == 0) {
                    echo '<h1 class="text-warning">belum ada produk di dalam keranjang</h1>';
                } else {
                    echo '<h1 class="text-warning">' . terbilang($total) . ' rupiah</h1>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#kode_produk').focus()

        // cek kode produk
        $('#kode_produk').keydown(function(e) {
            let kode_produk = $('#kode_produk').val()
            if (e.keyCode == 13) {
                e.preventDefault()
                if (kode_produk == '') {
                    alert('Kode Produk Kosong')
                } else {
                    CekProduk()
                }
            }
        })
    })

    // cek produk
    function CekProduk() {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>/kasir/CekProduk",
            data: {
                kode_produk: $('#kode_produk').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.nama_produk == '') {
                    alert('Kode barang tidak terdaftar')
                }
                if (response.stok == 0) {
                    alert('Stok barang sudah habis')
                } else {
                    $('[name="nama_produk"]').val(response.nama_produk)
                    $('[name="kategori"]').val(response.nama_kategori)
                    $('[name="satuan"]').val(response.nama_satuan)
                    $('[name="harga_jual"]').val(response.harga_jual)
                    $('#qty').focus()
                }
            }
        })
    }
</script>
<?= $this->endSection(); ?>