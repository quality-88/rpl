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
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/js/dashboards-analytics.js"></script>
<script src="<?= __Base_Url(); ?>resources/assets/dashboard/assets/js/ui-toasts.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="<?= __Base_Url(); ?>resources/vendor/__libary.js"></script>

<script src="<?= __Base_Url(); ?>resources/assets/DataTables/datatables.min.js"></script>

<script src="<?= __Base_Url(); ?>resources/assets/sweetalert/sweetalert.min.js"></script>

<script src="<?= __Base_Url(); ?>resources/assets/ckeditor/ckeditor.js"></script>

<script src="<?= __Base_Url(); ?>resources/vendor/__request.js"></script>

<script src="<?= __Base_Url(); ?>resources/assets/select2/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>



<script>
$.fn.select2.defaults.set("theme", "bootstrap");
$(document).ready(function() {
    $('.select2-pertama').select2();
});
$(document).ready(function() {
    $('.select2-kedua').select2();
});
</script>


<?php
    if ( isset($__data_sk_rpl) AND @$__data_sk_rpl == TRUE ) {

        echo 
            "
                <script> 
                    $(document).ready(function() {
                        $('#__Modal_Bayar_Pumb__').modal('show');
                    });
                </script>
            ";

    }
?>



<?php if ( $__content == '__pumb_pmbregistrasi' ) { ?>
<script>
$("#selectProvinsiTinggal").change(function() {
    var id_selectProvinsiTinggal = $("#selectProvinsiTinggal").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectProvinsiTinggal=" + id_selectProvinsiTinggal,
        success: function(data) {
            $("#selectKabupatenTinggal").html(data);
        }
    });
});

$("#selectKabupatenTinggal").change(function() {
    var id_selectKabupatenTinggal = $("#selectKabupatenTinggal").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectKabupatenTinggal=" + id_selectKabupatenTinggal,
        success: function(data) {
            $("#selectKecamatanTinggal").html(data);
        }
    });
});

$("#selectKecamatanTinggal").change(function() {
    var id_selectKecamatanTinggal = $("#selectKecamatanTinggal").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectKecamatanTinggal=" + id_selectKecamatanTinggal,
        success: function(data) {
            $("#selectIdKecamatanTinggal").html(data);
        }
    });
});

$("#selectIdKecamatanTinggal").change(function() {
    var id_selectIdKecamatanTinggal = $("#selectIdKecamatanTinggal").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectIdKecamatanTinggal=" + id_selectIdKecamatanTinggal,
        success: function(data) {
            $("#tipe").html(data);
        }
    });
});


$("#selectProvinsiSekolah").change(function() {
    var id_selectProvinsiSekolah = $("#selectProvinsiSekolah").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectProvinsiSekolah=" + id_selectProvinsiSekolah,
        success: function(data) {
            $("#selectKabupatenSekolah").html(data);
        }
    });
});

$("#selectKabupatenSekolah").change(function() {
    var id_selectKabupatenSekolah = $("#selectKabupatenSekolah").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectKabupatenSekolah=" + id_selectKabupatenSekolah,
        success: function(data) {
            $("#selectKecamatanSekolah").html(data);
        }
    });
});

$("#selectKecamatanSekolah").change(function() {
    var id_selectKecamatanSekolah = $("#selectKecamatanSekolah").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectKecamatanSekolah=" + id_selectKecamatanSekolah,
        success: function(data) {
            $("#selectIdKecamatanSekolah").html(data);
        }
    });
});

$("#selectIdKecamatanSekolah").change(function() {
    var id_selectIdKecamatanSekolah = $("#selectIdKecamatanSekolah").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectIdKecamatanSekolah=" + id_selectIdKecamatanSekolah,
        success: function(data) {
            $("#tipe").html(data);
        }
    });
});


$("#selectProvinsiOrtu").change(function() {
    var id_selectProvinsiOrtu = $("#selectProvinsiOrtu").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectProvinsiOrtu=" + id_selectProvinsiOrtu,
        success: function(data) {
            $("#selectKabupatenOrtu").html(data);
        }
    });
});

$("#selectKabupatenOrtu").change(function() {
    var id_selectKabupatenOrtu = $("#selectKabupatenOrtu").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectKabupatenOrtu=" + id_selectKabupatenOrtu,
        success: function(data) {
            $("#selectKecamatanOrtu").html(data);
        }
    });
});

$("#selectKecamatanOrtu").change(function() {
    var id_selectKecamatanOrtu = $("#selectKecamatanOrtu").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectKecamatanOrtu=" + id_selectKecamatanOrtu,
        success: function(data) {
            $("#selectIdKecamatanOrtu").html(data);
        }
    });
});

$("#selectIdKecamatanOrtu").change(function() {
    var id_selectIdKecamatanOrtu = $("#selectIdKecamatanOrtu").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?= __Base_Url(); ?>public/rpl/build/__ajax.php",
        data: "selectIdKecamatanOrtu=" + id_selectIdKecamatanOrtu,
        success: function(data) {
            $("#tipe").html(data);
        }
    });
});
</script>
<?php } ?>


</body>

</html>