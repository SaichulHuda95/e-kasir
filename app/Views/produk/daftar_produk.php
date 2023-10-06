<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Daftar Produk</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="<?= base_url(); ?>/produk/tambah_produk" class="btn btn-sm btn-primary">
                    Tambah Produk
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($produk as $row) :
                            ?>
                                <tr>
                                    <th><?= $nomor++; ?></th>
                                    <td><?= $row->kode_produk; ?></td>
                                    <td><?= $row->nama_produk; ?></td>
                                    <td><?= $row->nama_kategori; ?></td>
                                    <td><?= $row->nama_satuan; ?></td>
                                    <td><?= "Rp " . number_format($row->harga_beli, 2, ",", "."); ?></td>
                                    <td><?= "Rp " . number_format($row->harga_jual, 2, ",", "."); ?></td>
                                    <?php
                                    if ($row->stok >= 1 && $row->stok <= 10) {
                                        echo "<td class='text-warning'>" . $row->stok . "</td>";
                                    } else if ($row->stok == 0) {
                                        echo "<td class='text-danger'>" . $row->stok . "</td>";
                                    } else {
                                        echo "<td>" . $row->stok . "</td>";
                                    }
                                    ?>
                                    <td>
                                        <a href="<?= base_url(); ?>/produk/edit_produk/<?= $row->id_produk ?>" class="btn btn-sm btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus('<?= $row->id_produk ?>', '<?= $row->nama_produk ?>')">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
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
<script>
    function hapus(id_produk, nama) {
        Swal.fire({
            title: 'Hapus Data',
            html: `Yakin ingin menghapus data <strong>${nama}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('produk/hapus') ?>",
                    data: {
                        id_produk: id_produk
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire(
                                'Berhasil',
                                response.sukses,
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    }
</script>
<?= $this->endSection(); ?>