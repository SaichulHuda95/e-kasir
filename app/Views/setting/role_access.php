<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Tambah User</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="flash" data-flash="<?= session()->getFlashdata('success'); ?>"></div>
        <div class="card shadow card-outline card-primary">
            <div class="card-header">
                <a class="btn btn-sm btn-warning" href="<?= base_url(); ?>/pengaturan">
                    <i class="fa fa-backward"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <h5>Role: <?= $role->role; ?></h5>
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($menu as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row->menu; ?></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input access" type="checkbox" <?= check_access($role->id, $row->id); ?> data-role="<?= $role->id; ?>" data-menu="<?= $row->id; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Akses Role
    $('.access').on('click', function() {
        let menuId = $(this).data('menu');
        let roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url(); ?>/pengaturan/change_access",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url(); ?>/pengaturan/roleaccess/" + roleId;
            }
        })
    });
</script>
<?= $this->endSection(); ?>