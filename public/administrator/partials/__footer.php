<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/popper/popper.js"></script>
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/js/bootstrap.js"></script>
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js">
</script>

<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/js/main.js"></script>

<!-- Page JS -->
<!-- <script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/js/dashboards-analytics.js"></script> -->
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/js/ui-toasts.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="<?= __Base_Url(); ?>resources/vendor/__libary.js"></script>

<script src="<?= __Base_Url(); ?>resources/assets/DataTables/datatables.min.js"></script>

<script src="<?= __Base_Url(); ?>resources/assets/sweetalert/sweetalert.min.js"></script>

<script src="<?= __Base_Url(); ?>resources/assets/ckeditor/ckeditor.js"></script>

<script src="<?= __Base_Url(); ?>resources/vendor/__request.js"></script>

<script src="<?= __Base_Url(); ?>resources/assets/select2/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>


<?php 

    if ( $__content == '__home' ) {

        @require_once dirname(dirname(dirname(__DIR__))) . '/resources/vendor/__chart.php';

    }

?>



<script>
$.fn.select2.defaults.set("theme", "bootstrap");
$(document).ready(function() {
    $('.select2-pertama').select2();
});
$(document).ready(function() {
    $('.select2-kedua').select2();
});
</script>


</body>

</html>