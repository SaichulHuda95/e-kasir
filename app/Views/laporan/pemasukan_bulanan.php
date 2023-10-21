<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Laporan Pemasukan Bulanan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url() ?>/laporan">Home</a></div>
        <div class="breadcrumb-item">Laporan Pemasukan Bulanan</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="bln_laporan" class="col-sm-5 col-form-label col-form-label-sm">Bulan</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" name="bln_laporan" id="bln_laporan">
                                    <option value="all">-Semua-</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="thn_laporan" class="col-sm-5 col-form-label col-form-label-sm">Tahun</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="thn_laporan" id="thn_laporan" value="<?= date('Y') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" id="btn_cari">Cari</button>
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
                url: '<?= base_url(); ?>/laporan/get_laporan_pemasukan_bulanan',
                type: 'post',
                data: function(d) {
                    d.bln_laporan = $('#bln_laporan').val()
                    d.thn_laporan = $('#thn_laporan').val()
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
</script>
<?= $this->endSection(); ?>