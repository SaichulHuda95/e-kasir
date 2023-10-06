<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Dashboard</h1>
</div>
<div class="row">
    <div class="col">
        <?php if ($saldo > 0) : ?>
            <h3 class="text-primary">Saldo : <span class="text-success">Rp <?= number_format($saldo, 0, ",", "."); ?></span></h3>
        <?php else : ?>
            <h3 class="text-primary">Saldo : <span class="text-danger">Rp <?= number_format($saldo, 0, ",", "."); ?></span></h3>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Info Jumlah User -->
    <div class="col-md-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Pengguna</h4>
                </div>
                <div class="card-body">
                    <?= $tot_user->id ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Info jumlah pemasukan -->
    <div class="col-md-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pemasukan</h4>
                </div>
                <div class="card-body text-success">
                    <?= number_format($tot_pemasukan->grand_total, 0, ",", "."); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- info jumlah pengeluaran -->
    <div class="col-md-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pengeluaran</h4>
                </div>
                <div class="card-body text-danger">
                    <?= number_format($tot_pengeluaran->jumlah_pengeluaran, 0, ",", "."); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <!-- info jumlah pendapatan hari ini -->
    <div class="col-md-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Pendapatan Hari Ini</h4>
                </div>
                <div class="card-body text-success">
                    <?= number_format($tot_pemasukan_today->grand_total, 0, ",", "."); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- info jumlah pendapatan bulan ini -->
    <div class="col-md-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Pendapatan Bulan Ini</h4>
                </div>
                <div class="card-body text-success">
                    <?= number_format($tot_pemasukan_month->grand_total, 0, ",", "."); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- info jumlah pendapatan tahun ini -->
    <div class="col-md-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Pendapatan Tahun Ini</h4>
                </div>
                <div class="card-body text-success">
                    <?= number_format($tot_pemasukan_year->grand_total, 0, ",", "."); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <!-- info produk terlaris -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>5 Produk Terlaris</h4>
            </div>
            <div class="card-body" id="top-5-scroll">
                <ul class="list-unstyled list-unstyled-border">
                    <?php foreach ($top_sales as $row) : ?>
                        <li class="media">
                            <div class="media-body">
                                <div class="float-right">
                                    <div class="font-weight-600 text-muted text-small"><?= $row->qty ?> Penjualan</div>
                                </div>
                                <div class="media-title"><?= $row->nama_produk ?></div>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Riwayat Transaksi Penjualan -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Riwayat Transaksi Terakhir</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Faktur</th>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th>Dibayar</th>
                                <th>Kembalian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($recent_transaction as $row) :
                            ?>
                                <tr>
                                    <th><?= $nomor++; ?></th>
                                    <td><?= $row->no_faktur; ?></td>
                                    <td><?= date_indo($row->tgl_jual); ?></td>
                                    <td><?= "Rp " . number_format($row->grand_total, 2, ",", "."); ?></td>
                                    <td><?= "Rp " . number_format($row->dibayar, 2, ",", "."); ?></td>
                                    <td><?= "Rp " . number_format($row->kembalian, 2, ",", "."); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" title="Detail Transaksi" onclick="detail_transaksi('<?= $row->no_faktur ?>')">
                                            Detail
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
<?= $this->endSection(); ?>