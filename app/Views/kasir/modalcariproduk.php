<div class="modal fade" id="modalcariproduk" tabindex="-1" aria-labelledby="modalcariprodukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalcariprodukLabel">Pencarian Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Kode Produk</th>
                                <th class="text-center" scope="col">Nama Produk</th>
                                <th class="text-center" scope="col">Harga Jual</th>
                                <th class="text-center" scope="col">Stok</th>
                                <th class="text-center" scope="col" style="text-align:center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($produk as $row) :
                            ?>
                                <tr>
                                    <th class="text-center" scope="row"><?= $nomor++; ?></th>
                                    <td class="text-center"><?= $row->kode_produk; ?></td>
                                    <td><?= $row->nama_produk; ?></td>
                                    <td class="text-right"><?= "Rp " . number_format($row->harga_jual, 2, ",", "."); ?></td>
                                    <td class="text-center"><?= $row->stok; ?></td>
                                    <td style="text-align:center">
                                        <button type="button" class="btn btn-sm btn-success" onclick="pilih('<?= $row->kode_produk ?>', '<?= $row->stok ?>')">
                                            Pilih
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
    $(document).ready(function() {
        // DataTables
        $('.display').DataTable();
    });

    // pilih kode produk
    function pilih(kode_produk, stok) {
        // $('#kode_produk').val(kode_produk)
        // $('#modalcariproduk').modal('hide');
        if (stok == 0) {
            alert("Stok sudah habis")
        } else {
            $.ajax({
                type: "post",
                url: "<?= base_url() ?>/kasir/CekProduk",
                data: {
                    kode_produk: kode_produk
                },
                dataType: "json",
                success: function(response) {
                    $('#kode_produk').val(response.kode_produk)
                    $('[name="nama_produk"]').val(response.nama_produk)
                    $('[name="kategori"]').val(response.nama_kategori)
                    $('[name="satuan"]').val(response.nama_satuan)
                    $('[name="harga_jual"]').val(response.harga_jual)
                    $('#qty').focus()
                    $('#modalcariproduk').modal('hide');
                }
            })
        }
    }
</script>