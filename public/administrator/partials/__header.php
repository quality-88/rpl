<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>
        <?= @$__header ? @$__header : ''; ?><?= __Aplikasi()['Aplikasi']; ?>
    </title>

    <link rel="shortcut icon" href="<?= $__universitas->__Detail_Universitas()['Logo_Kampus']; ?>">

    <meta name="description" content="<?= __Aplikasi()['Aplikasi']; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= $__universitas->__Detail_Universitas()['Logo_Kampus']; ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/fonts/boxicons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/css/core.css"
        class="template-customizer-core-css">
    <link rel="stylesheet" href="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css">
    <link rel="stylesheet" href="<?= __Base_Url(); ?>resources/assets/dashboard/assets/css/demo.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">

    <link rel="stylesheet"
        href="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/apex-charts/apex-charts.css">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/js/config.js"></script>

    <link href="<?= __Base_Url(); ?>resources/assets/DataTables/datatables.min.css" rel="stylesheet">

    <link href="<?= __Base_Url(); ?>resources/assets/select2/select2-4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet">
    <link href="<?= __Base_Url(); ?>resources/assets/select2/select2-bootstrap-theme-master/dist/select2-bootstrap.css"
        rel="stylesheet">
    <link
        href="<?= __Base_Url(); ?>resources/assets/select2/select2-bootstrap-theme-master/dist/select2-bootstrap.min.css"
        rel="stylesheet">
</head>

<body>