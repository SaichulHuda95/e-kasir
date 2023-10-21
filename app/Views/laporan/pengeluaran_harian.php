<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Laporan Pengeluaran Harian</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url() ?>/laporan">Home</a></div>
        <div class="breadcrumb-item">Laporan Pengeluaran Harian</div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-body">
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
                        <button class="btn btn-sm btn-primary" id="btn_cari">Cari</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-sm table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
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
<script>
    //datatable
    $(document).ready(function() {
        // tabel pengeluaran
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
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var tot_harga = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                // Update footer by showing the total with the reference of the column index 
                $(api.column(2).footer()).html('Total');
                var numFormat = $.fn.dataTable.render.number('.', '.', 0, '').display;
                $(api.column(3).footer()).html(numFormat(tot_stok));
                $(api.column(4).footer()).html(numFormat(tot_harga));
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
                url: '<?= base_url(); ?>/laporan/get_laporan_pengeluaran_harian',
                type: 'post',
                data: function(d) {
                    d.tgl_laporan = $('#tgl_laporan').val();
                },
                "dataSrc": "",
            },
            "columns": [{
                    "data": "tgl_pengeluaran"
                },
                {
                    "data": "nama_produk"
                },
                {
                    "data": "harga_produk"
                },
                {
                    "data": "jumlah_produk"
                },
                {
                    "data": "jumlah_pengeluaran"
                }
            ],
            columnDefs: [{
                    targets: 2,
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    targets: 4,
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                }
            ],
        });

        // fungsi klik cari
        $('#btn_cari').click(function(event) {
            dataTable.ajax.reload();
        });
    });
</script>
<?= $this->endSection(); ?>