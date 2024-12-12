<script>
setTimeout(function() {
    window.location.replace('<?= url('/homedosen'); ?>');
}, 5000);
</script>

<div class="misc-wrapper text-center">
    <h2 class="mb-2 mx-2">
        Halaman Tidak Tersedia
    </h2>
    <p class="mb-4 mx-2">
        URL Yang Diminta Tidak Ditemukan Di Server Ini.
    </p>
    <a href="<?= url('/homedosen'); ?>" class="btn btn-primary">
        Beranda
    </a>
    <div class="mt-3">
        <img src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/img/illustrations/page-misc-error-light.png"
            alt="page-misc-error-light" width="500" class="img-fluid"
            data-app-dark-img="illustrations/page-misc-error-dark.png"
            data-app-light-img="illustrations/page-misc-error-light.png" />
    </div>
</div>