<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url() ?>asset/image/favicon/favicon.png" type="image/x-icon">
    <title><?= $titlePage ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>assets_lib/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_lib/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_lib/css/docs.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_lib/css/highlighter.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets_lib/css/adminlte.min.css">

<body class="hold-transition sidebar-mini layout-fixed">
    <main class="main" id="app">
        <?= @$content; ?>
    </main>

    <!-- Bootstrap Js -->
    <script src="<?= base_url() ?>assets\js\bootstrap.bundle.min.js"></script>
    <!-- Iconfy -->
    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>

    <!-- jQuery -->
    <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url() ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>dist/js/demo.js"></script>
</body>

</html>