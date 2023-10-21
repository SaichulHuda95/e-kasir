<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Rekap Laporan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">Home</div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <a href="<?= base_url() ?>/laporan/pemasukan_harian">
            <div class="card">
                <div class="card-body">
                    <img src="<?= base_url() ?>/assets/img/logo_report.jpg" class="mx-auto d-block" alt="logo_report" height="200px" width="200px">
                    <h3 class="text-center">Laporan Pemasukan Harian</h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6">
        <a href="<?= base_url() ?>/laporan/pengeluaran_harian">
            <div class="card">
                <div class="card-body">
                    <img src="<?= base_url() ?>/assets/img/logo_report.jpg" class="mx-auto d-block" alt="logo_report" height="200px" width="200px">
                    <h3 class="text-center">Laporan Pengeluaran Harian</h3>
                </div>
            </div>
        </a>
    </div>


    <div class="col-sm-6">
        <a href="<?= base_url() ?>/laporan/pemasukan_bulanan">
            <div class="card">
                <div class="card-body">
                    <img src="<?= base_url() ?>/assets/img/logo_report.jpg" class="mx-auto d-block" alt="logo_report" height="200px" width="200px">
                    <h3 class="text-center">Laporan Pemasukan Bulanan</h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6">
        <a href="<?= base_url() ?>/laporan/pengeluaran_bulanan">
            <div class="card">
                <div class="card-body">
                    <img src="<?= base_url() ?>/assets/img/logo_report.jpg" class="mx-auto d-block" alt="logo_report" height="200px" width="200px">
                    <h3 class="text-center">Laporan Pengeluaran Bulanan</h3>
                </div>
            </div>
        </a>
    </div>
</div>
<?= $this->endSection(); ?>