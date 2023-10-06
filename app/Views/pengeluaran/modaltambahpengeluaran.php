<div class="modal fade" id="modalpengeluaran" tabindex="-1" aria-labelledby="modalpengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalpengeluaranLabel">Tambah Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pengeluaran/simpan_pengeluaran') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Produk</label>
                    <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk" required>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Jumlah Produk</label>
                    <input type="text" class="form-control" name="jumlah_produk" id="jumlah_produk" placeholder="Jumlah Produk" required>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Harga Produk</label>
                    <input type="text" class="form-control numeric" name="harga_produk" id="harga_produk" value="0" required>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Jumlah Pengeluaran</label>
                    <input type="text" class="form-control numeric" name="jumlah_pengeluaran" id="jumlah_pengeluaran" value="0" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombolSimpan"><i class="fas fa-save"></i> Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // numeric
        jQuery(function($) {
            $('input.numeric').autoNumeric('init', {
                mDec: '0',
                aSep: '.',
                aDec: ','
            });
        });

        // jumlah pengeluaran
        $(document).on('keyup', "#harga_produk", function() {
            let jumlah_produk = $('#jumlah_produk').val();
            let harga_produk = $('#harga_produk').autoNumeric('get');
            let jumlah_pengeluaran = harga_produk * jumlah_produk;
            $('#jumlah_pengeluaran').val(parseInt(jumlah_pengeluaran));
            $('#jumlah_pengeluaran').autoNumeric('set', $('#jumlah_pengeluaran').val());
        });

        $('.tombolSimpan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(e) {
                    $('.tombolBayar').prop('disabled', true);
                    $('.tombolBayar').html('<i class="fa fa-spin fa-spinner"></i>')
                },
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
            return false;
        });
    });
</script>