<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Daftar Pengeluaran</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-primary" onclick="pengeluaran()">Tambah Pengeluaran</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Produk</th>
                                <th>Harga Produk</th>
                                <th>Jumlah Pengeluaran</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($pengeluaran as $row) :
                            ?>
                                <tr>
                                    <th><?= $nomor++; ?></th>
                                    <td><?= $row->nama_produk; ?></td>
                                    <td><?= $row->jumlah_produk; ?></td>
                                    <td><?= "Rp " . number_format($row->harga_produk, 2, ",", "."); ?></td>
                                    <td><?= "Rp " . number_format($row->jumlah_pengeluaran, 2, ",", "."); ?></td>
                                    <td><?= date_indo($row->created_at); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" title="Edit Data" onclick="edit('<?= $row->id_pengeluaran ?>')">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus('<?= $row->id_pengeluaran ?>', '<?= $row->nama_produk ?>')">
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
    function edit(id_pengeluaran) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengeluaran/edit') ?>",
            data: {
                id_pengeluaran: id_pengeluaran
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditpengeluaran').on('shown.bs.modal', function(event) {
                        $('#nama_objek').focus();
                    });
                    $('#modaleditpengeluaran').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id_pengeluaran, nama) {
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
                    url: "<?= base_url('pengeluaran/hapus_pengeluaran') ?>",
                    data: {
                        id_pengeluaran: id_pengeluaran
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