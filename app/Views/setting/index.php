<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Pengaturan</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Pengaturan Aplikasi</code></h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills" id="myTab3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="kategori-tab3" data-toggle="tab" href="#kategori" role="tab" aria-controls="kategori" aria-selected="true">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="satuan-tab3" data-toggle="tab" href="#satuan" role="tab" aria-controls="satuan" aria-selected="false">Satuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="user-tab3" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="role-tab3" data-toggle="tab" href="#role" role="tab" aria-controls="role" aria-selected="false">Hak Akses User</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="kategori" role="tabpanel" aria-labelledby="kategori-tab3">
                        <div class="row mb-3">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_kategori()">Tambah</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="display table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($kategori as $row) :
                                            ?>
                                                <tr>
                                                    <th><?= $nomor++; ?></th>
                                                    <td><?= $row->nama_kategori; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" title="Edit Data" onclick="edit_kategori('<?= $row->id_kategori ?>')">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus_kategori('<?= $row->id_kategori ?>', '<?= $row->nama_kategori ?>')">
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
                    <div class="tab-pane fade" id="satuan" role="tabpanel" aria-labelledby="satuan-tab3">
                        <div class="row mb-3">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_satuan()">Tambah</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="display table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($satuan as $row) :
                                            ?>
                                                <tr>
                                                    <th><?= $nomor++; ?></th>
                                                    <td><?= $row->nama_satuan; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" title="Edit Data" onclick="edit_satuan('<?= $row->id_satuan ?>')">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus_satuan('<?= $row->id_satuan ?>', '<?= $row->nama_satuan ?>')">
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
                    <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab3">
                        <div class="row mb-3">
                            <div class="col">
                                <a class="btn btn-sm btn-primary" href="<?= base_url(); ?>/pengaturan/add_user">
                                    Tambah User
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="display table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Role Id</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($user as $row) :
                                            ?>
                                                <tr>
                                                    <th><?= $nomor++; ?></th>
                                                    <td>
                                                        <img id="img" width="30" class="rounded-circle mr-2" src="<?= base_url(); ?>/assets/img/profil/<?= $row->image; ?>" alt="" />
                                                        <?= $row->username; ?>
                                                    </td>
                                                    <td><?= $row->email; ?></td>
                                                    <td><span class="badge badge-dark"><?= $row->role; ?></span></td>
                                                    <?php
                                                    if ($row->is_active == 1) {
                                                        echo "<td class='text-center'><span class='badge badge-success'>Aktif</span></td>";
                                                    } else {
                                                        echo "<td class='text-center'><span class='badge badge-danger'>Tidak Aktif</span></td>";
                                                    }
                                                    ?>
                                                    <td>
                                                        <a class="btn btn-sm btn-info" title="Edit Data" href="<?= base_url(); ?>/pengaturan/edit_user/<?= $row->id ?>">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus_user('<?= $row->id ?>', '<?= $row->username ?>')">
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
                    <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab3">
                        <div class="row mb-3">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_role()">Tambah</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="display table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Hak Akses</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($role as $row) :
                                            ?>
                                                <tr>
                                                    <th><?= $nomor++; ?></th>
                                                    <td><?= $row->role; ?></td>
                                                    <td>
                                                        <a href="<?= base_url(); ?>/pengaturan/roleaccess/<?= $row->id; ?>" class="btn btn-sm btn-warning">Akses</a>
                                                        <button type="button" class="btn btn-sm btn-info" title="Edit Data" onclick="edit_role('<?= $row->id ?>')">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus_role('<?= $row->id ?>', '<?= $row->role ?>')">
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
            </div>
        </div>
    </div>
</div>
<script>
    // edit kategori
    function edit_kategori(id_kategori) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengaturan/edit_kategori') ?>",
            data: {
                id_kategori: id_kategori
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditkategori').on('shown.bs.modal', function(event) {
                        $('#nama_objek').focus();
                    });
                    $('#modaleditkategori').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // hapus kategori
    function hapus_kategori(id_kategori, nama) {
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
                    url: "<?= base_url('pengaturan/hapus_kategori') ?>",
                    data: {
                        id_kategori: id_kategori
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

    // edit satuan
    function edit_satuan(id_satuan) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengaturan/edit_satuan') ?>",
            data: {
                id_satuan: id_satuan
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditsatuan').on('shown.bs.modal', function(event) {
                        $('#nama_objek').focus();
                    });
                    $('#modaleditsatuan').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // hapus satuan
    function hapus_satuan(id_satuan, nama) {
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
                    url: "<?= base_url('pengaturan/hapus_satuan') ?>",
                    data: {
                        id_satuan: id_satuan
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

    // hapus user
    function hapus_user(id, nama) {
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
                    url: "<?= base_url('pengaturan/hapus_user') ?>",
                    data: {
                        id: id
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

    // edit role
    function edit_role(id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengaturan/edit_role') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditrole').on('shown.bs.modal', function(event) {
                        $('#nama_objek').focus();
                    });
                    $('#modaleditrole').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // hapus role
    function hapus_role(id, nama) {
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
                    url: "<?= base_url('pengaturan/hapus_role') ?>",
                    data: {
                        id: id
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