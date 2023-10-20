<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Laporan Harian</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <ul class="nav nav-pills" id="myTab3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pemasukan-tab3" data-toggle="tab" href="#pemasukan" role="tab" aria-controls="pemasukan" aria-selected="true">Pemasukan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pengeluaran-tab3" data-toggle="tab" href="#pengeluaran" role="tab" aria-controls="pengeluaran" aria-selected="false">Pengeluaran</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="pemasukan" role="tabpanel" aria-labelledby="pemasukan-tab3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="tgl_laporan" class="col-sm-5 col-form-label col-form-label-sm">Tanggal</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control form-control-sm" name="tgl_laporan" id="tgl_laporan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-primary" id="btn_cari" onclick="get_laporan_harian()">Cari</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-sm table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Qty</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pengeluaran" role="tabpanel" aria-labelledby="pengeluaran-tab3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="tgl_laporan" class="col-sm-5 col-form-label col-form-label-sm">Tanggal</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control form-control-sm" name="tgl_laporan" id="tgl_laporan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-primary" id="btn_cari" onclick="get_laporan_harian()">Cari</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-sm table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Qty</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    //datatable
    $(document).ready(function() {
        var dataTable = $('#datatable').DataTable({
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // converting to interger to find total
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // computing column Total of the complete result 
                var tot_stok = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var tot_harga = api
                    .column(5)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                // Update footer by showing the total with the reference of the column index 
                $(api.column(3).footer()).html('Total');
                var numFormat = $.fn.dataTable.render.number('.', '.', 0, '').display;
                $(api.column(4).footer()).html(numFormat(tot_stok));
                $(api.column(5).footer()).html(numFormat(tot_harga));
            },
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            body: function(data, row, column, node) {
                                return column >= 6 && column <= 9 ? data.replace(/[.]/g, '') : data;

                            }
                        }
                    }

                },
                {
                    extend: 'print',
                    footer: true,
                }
            ],
            "language": {
                "emptyTable": "Data Kosong"
            },
            "processing": true,
            "serverside": true,
            "order": [],
            "ajax": {
                url: '<?= base_url(); ?>/laporan/get_laporan_harian',
                type: 'post',
                data: function(d) {
                    d.tgl_laporan = $('#tgl_laporan').val();
                },
                "dataSrc": "",
            },
            "columns": [{
                    "data": "tgl_jual"
                },
                {
                    "data": "kode_produk"
                },
                {
                    "data": "nama_produk"
                },
                {
                    "data": "harga_jual"
                },
                {
                    "data": "qty"
                },
                {
                    "data": "total_harga"
                }
            ],
            columnDefs: [{
                    targets: 3,
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    targets: 5,
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                }
            ],
        });
        $('#btn_cari').click(function(event) {
            dataTable.ajax.reload();
        });
    });

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