<div class="modal fade" id="modaldetailtransaksi" tabindex="-1" aria-labelledby="modaldetailtransaksiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modaldetailtransaksiLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <table cellspacing='0' cellpadding='0' style='width:400px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
                        <thead>
                            <tr align='center'>
                                <td width='14%'>Item</td>
                                <td width='14%'>Price</td>
                                <td width='4%'>Qty</td>
                                <td width='15%'>Total</td>
                            <tr>
                                <td colspan='5'>
                                    <hr>
                                </td>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_transaksi as $row) : ?>
                                <tr>
                                    <td style='vertical-align:top'><?= $row->nama_produk; ?></td>
                                    <td style='vertical-align:top; text-align:right; padding-right:10px'><?= number_format($row->harga_jual, 0, ",", "."); ?></td>
                                    <td style='vertical-align:top; text-align:right; padding-right:10px'><?= $row->qty; ?></td>
                                    <td style='text-align:right; vertical-align:top'><?= number_format($row->total_harga, 0, ",", "."); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan='4'>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='3'>
                                    <div style='text-align:right; color:black'>Total : </div>
                                </td>
                                <td style='text-align:right;'><b><?= number_format($row->grand_total, 0, ",", "."); ?></b></td>
                            </tr>
                            <tr>
                                <td colspan='3'>
                                    <div style='text-align:right; color:black'>Bayar : </div>
                                </td>
                                <td style='text-align:right;'><b><?= number_format($row->dibayar, 0, ",", "."); ?></b></td>
                            </tr>
                            <tr>
                                <td colspan='3'>
                                    <div style='text-align:right; color:black'>Kembalian : </div>
                                </td>
                                <td style='text-align:right;'><b><?= number_format($row->kembalian, 0, ",", "."); ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
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

        // kembalian
        $(document).on('keyup', "#dibayar", function() {
            let grand_total = $('#grand_total').val();
            let dibayar = $('#dibayar').autoNumeric('get');
            let kembalian = dibayar - grand_total;
            $('#kembalian').val(parseInt(kembalian));
            $('#kembalian').autoNumeric('set', $('#kembalian').val());
        });

        $('.tombolBayar').submit(function(e) {
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