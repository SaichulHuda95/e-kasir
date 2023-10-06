<div class="modal fade" id="modalpembayaran" tabindex="-1" aria-labelledby="modalpembayaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalpembayaranLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('kasir/prosesBayar') ?>
            <input type="hidden" id="no_faktur" name="no_faktur" value="<?= $no_faktur ?>">
            <input type="hidden" id="tgl_jual" name="tgl_jual" value="<?= date('Y-m-d') ?>">
            <input type="hidden" id="jam" name="jam" value="<?= date('h:i:s') ?>">
            <input type="hidden" id="grand_total" name="grand_total" value="<?= $grand_total ?>">
            <input type="hidden" id="id_kasir" name="id_kasir" value="<?= $session->username ?>">
            <div class="modal-body">
                <center>
                    <table style='width:400px; font-size:16pt; border-collapse: collapse;' border='0'>
                        <td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
                                <b>WARUNG BAROKAH</b></br>PONDOK MARITIM INDAH</span></br>


                            <span style='font-size:12pt'>Blok. : P / 3, <?= date_indo(date('Y-m-d')) ?> (user: <?= $session->username ?>), <?= date('H:i:s') ?></span></br>
                        </td>
                    </table>
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
                            <?php foreach ($isi_cart as $row) : ?>
                                <tr>
                                    <td style='vertical-align:top'><?= $row['name']; ?></td>
                                    <td style='vertical-align:top; text-align:right; padding-right:10px'><?= number_format($row['price'], 0, ",", "."); ?></td>
                                    <td style='vertical-align:top; text-align:right; padding-right:10px'><?= $row['qty']; ?></td>
                                    <td style='text-align:right; vertical-align:top'><?= number_format($row['subtotal'], 0, ",", "."); ?></td>
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
                                <td style='text-align:right; font-size:16pt; color:green'><?= number_format($grand_total, 0, ",", "."); ?></td>
                            </tr>
                            <tr>
                                <td colspan='3'>
                                    <div style='text-align:right; color:black'>Bayar : </div>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm text-right numeric" id="dibayar" name="dibayar" placeholder="Bayar">
                                </td>
                            </tr>
                            <tr>
                                <td colspan='3'>
                                    <div style='text-align:right; color:black'>Kembalian : </div>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm text-right text-danger numeric" id="kembalian" name="kembalian" placeholder="Kembalian" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style='width:400; font-size:12pt;' cellspacing='2'>
                        <tr></br>
                            <td align='center'>****** TERIMAKASIH ******</br></td>
                        </tr>
                    </table>
                </center>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success tombolBayar"><i class="fas fa-cash-register"></i> Bayar</button>
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