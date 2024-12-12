<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>
        Error | <?= __Aplikasi()['Aplikasi']; ?>
    </title>

    <link rel="shortcut icon" href="<?= __Aplikasi()['__Logo']; ?>">

    <meta name="description" content="<?= __Aplikasi()['Aplikasi']; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/favicon/favicon.ico">

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
</head>

<body>

    <div class="misc-wrapper text-center mt-lg-4 mb-lg-4">
        <h2 class="mb-2 mx-2">
            <strong>
                Halaman Tidak Tersedia
            </strong>
        </h2>
        <p class="mb-4 mx-2">
            URL Yang Diminta Tidak Ditemukan Di Server Ini.
        </p>
        <div class="mt-3">
            <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/illustrations/page-misc-error-light.png"
                alt="page-misc-error-light" width="500" class="img-fluid"
                data-app-dark-img="illustrations/page-misc-error-dark.png"
                data-app-light-img="illustrations/page-misc-error-light.png" />
        </div>
        <br>
        <a href="<?= $__universitas->__Url_Universitas()['Website']; ?>" class="btn btn-primary mt-lg-4">
            <?= $__universitas->__Detail_Universitas()['Nama']; ?>
        </a>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/js/bootstrap.js"></script>
    <script
        src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js">
    </script>

    <script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/js/main.js"></script>

</body>

</html>