<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?></title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/logo.png">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome/css/all.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Jquery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/mycustom.css">

    <style>
        body {
            background-image: url(assets/img/bg_login.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div id="app">

        <?= $this->renderSection('login-page'); ?>

    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/stisla.js"></script>
    <!-- Template JS File -->
    <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
    <!-- SwweetAlert -->
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- custom js -->
    <script>
        // sweetalert gagal
        var flashfail = $('#flashfail').data('flash');
        if (flashfail) {
            Swal.fire({
                icon: 'error',
                // title: 'Gagal',
                showConfirmButton: false,
                timer: 1400,
                text: flashfail,
                customClass: {
                    container: 'position-absolute'
                },
                toast: true,
                position: 'top-right'
            })
        }
    </script>
</body>

</html>