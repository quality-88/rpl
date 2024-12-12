<?php

    @require_once dirname(dirname(dirname(__DIR__))) . '/app/helpers/__Session.php';
    @require_once dirname(dirname(dirname(__DIR__))) . '/base/__Base_Url.php';
    @require_once dirname(dirname(dirname(__DIR__))) . '/base/__QualityDb.php';


    $__db = new __Database();


    if ( isset( $_POST['selectProvinsiTinggal'] ) ) {

        @$selectProvinsiTinggal = @$_POST['selectProvinsiTinggal'];

        if ( isset( $_POST['__FormKabupatenTinggal'] ) ) {

            @$__kabupaten_sekolah_get = $__db->queryid(" SELECT IdKabupaten AS Id, Kabupaten AS P FROM Kabupaten WHERE IdPropinsi = '". @$_POST['__FormProvinsTinggal'] ."' AND IdKabupaten = '". @$_POST['__FormKabupatenTinggal'] ."' ORDER BY IdKabupaten ASC ");

            echo 
                "
                    <option value='". @$__kabupaten_sekolah_get->Id ."' selected>
                        ". @$__kabupaten_sekolah_get->P ."
                    </option>
                ";

        } else {

            echo "<option value='' selected disabled>--- Pilih Kabupaten ---</option>";
        
        }

        @$__kabupaten_tinggal = $__db->query(" SELECT IdKabupaten AS Id, Kabupaten AS K FROM Kabupaten WHERE IdPropinsi = '". @$selectProvinsiTinggal ."' ORDER BY IdKabupaten ASC ");
            
            foreach ( $__kabupaten_tinggal AS $data => $kabupaten ) :

                echo 
                    "
                        <option value='". @$kabupaten->Id ."'>
                            ". @$kabupaten->K ."
                        </option>
                    ";

            endforeach;

    }

    if ( isset( $_POST['selectKabupatenTinggal'] ) ) {

        @$selectKabupatenTinggal = @$_POST['selectKabupatenTinggal'];

        if ( isset( $_POST['__FormKabupatenTinggal'] ) ) {

            @$__kabupaten_sekolah_get = $__db->queryid(" SELECT IdKabupaten AS Id, Kabupaten AS P FROM Kabupaten WHERE IdPropinsi = '". @$_POST['__FormProvinsTinggal'] ."' AND IdKabupaten = '". @$_POST['__FormKabupatenTinggal'] ."' ORDER BY IdKabupaten ASC ");

            echo 
                "
                    <option value='". @$__kabupaten_sekolah_get->Id ."' selected>
                        ". @$__kabupaten_sekolah_get->P ."
                    </option>
                ";

        } else {

            echo "<option value='' selected disabled>--- Pilih Kecamatan ---</option>";
        
        }

        @$__kecamatan_tinggal = $__db->query(" SELECT IdKecamatan AS Id, Kecamatan AS K FROM Kecamatan WHERE IdKabupaten = '". @$selectKabupatenTinggal ."' ORDER BY IdKecamatan ASC ");
            
            foreach ( $__kecamatan_tinggal AS $data => $kecamatan ) :

                echo 
                    "
                        <option value='". @$kecamatan->Id ."'>
                            ". @$kecamatan->K ."
                        </option>
                    ";

            endforeach;

    }

    if ( isset( $_POST['selectKecamatanTinggal'] ) ) {

        @$selectKecamatanTinggal = @$_POST['selectKecamatanTinggal'];

        echo 
            "
                <option value='". @$selectKecamatanTinggal ."' selected>
                    ". @$selectKecamatanTinggal ."
                </option>
            ";

    }




    if ( isset( $_POST['selectProvinsiSekolah'] ) ) {

        @$selectProvinsiSekolah = @$_POST['selectProvinsiSekolah'];

        if ( isset( $_POST['__FormKabupatenSekolah'] ) ) {

            @$__kabupaten_sekolah_get = $__db->queryid(" SELECT IdKabupaten AS Id, Kabupaten AS P FROM Kabupaten WHERE IdPropinsi = '". @$_POST['__FormProvinsSekolah'] ."' AND IdKabupaten = '". @$_POST['__FormKabupatenSekolah'] ."' ORDER BY IdKabupaten ASC ");

            echo 
                "
                    <option value='". @$__kabupaten_sekolah_get->Id ."' selected>
                        ". @$__kabupaten_sekolah_get->P ."
                    </option>
                ";

        } else {

            echo "<option value='' selected disabled>--- Pilih Kabupaten ---</option>";
        
        }

        @$__kabupaten_sekolah = $__db->query(" SELECT IdKabupaten AS Id, Kabupaten AS K FROM Kabupaten WHERE IdPropinsi = '". @$selectProvinsiSekolah ."' ORDER BY IdKabupaten ASC ");
            
            foreach ( $__kabupaten_sekolah AS $data => $kabupaten ) :

                echo 
                    "
                        <option value='". @$kabupaten->Id ."'>
                            ". @$kabupaten->K ."
                        </option>
                    ";

            endforeach;

    }

    if ( isset( $_POST['selectKabupatenSekolah'] ) ) {

        @$selectKabupatenSekolah = @$_POST['selectKabupatenSekolah'];

        if ( isset( $_POST['__FormKabupatenSekolah'] ) ) {

            @$__kabupaten_sekolah_get = $__db->queryid(" SELECT IdKabupaten AS Id, Kabupaten AS P FROM Kabupaten WHERE IdPropinsi = '". @$_POST['__FormProvinsSekolah'] ."' AND IdKabupaten = '". @$_POST['__FormKabupatenSekolah'] ."' ORDER BY IdKabupaten ASC ");

            echo 
                "
                    <option value='". @$__kabupaten_sekolah_get->Id ."' selected>
                        ". @$__kabupaten_sekolah_get->P ."
                    </option>
                ";

        } else {

            echo "<option value='' selected disabled>--- Pilih Kecamatan ---</option>";
        
        }

        @$__kecamatan_sekolah = $__db->query(" SELECT IdKecamatan AS Id, Kecamatan AS K FROM Kecamatan WHERE IdKabupaten = '". @$selectKabupatenSekolah ."' ORDER BY IdKecamatan ASC ");
            
            foreach ( $__kecamatan_sekolah AS $data => $kecamatan ) :

                echo 
                    "
                        <option value='". @$kecamatan->Id ."'>
                            ". @$kecamatan->K ."
                        </option>
                    ";

            endforeach;

    }

    if ( isset( $_POST['selectKecamatanSekolah'] ) ) {

        @$selectKecamatanSekolah = @$_POST['selectKecamatanSekolah'];

        echo 
            "
                <option value='". @$selectKecamatanSekolah ."' selected>
                    ". @$selectKecamatanSekolah ."
                </option>
            ";

    }




    if ( isset( $_POST['selectProvinsiOrtu'] ) ) {

        @$selectProvinsiOrtu = @$_POST['selectProvinsiOrtu'];

        if ( isset( $_POST['__FormKabupatenOrtu'] ) ) {

            @$__kabupaten_ortu_get = $__db->queryid(" SELECT IdKabupaten AS Id, Kabupaten AS P FROM Kabupaten WHERE IdPropinsi = '". @$_POST['__FormProvinsOrtu'] ."' AND IdKabupaten = '". @$_POST['__FormKabupatenOrtu'] ."' ORDER BY IdKabupaten ASC ");

            echo 
                "
                    <option value='". @$__kabupaten_ortu_get->Id ."' selected>
                        ". @$__kabupaten_ortu_get->P ."
                    </option>
                ";

        } else {

            echo "<option value='' selected disabled>--- Pilih Kabupaten ---</option>";
        
        }

        @$__kabupaten_ortu = $__db->query(" SELECT IdKabupaten AS Id, Kabupaten AS K FROM Kabupaten WHERE IdPropinsi = '". @$selectProvinsiOrtu ."' ORDER BY IdKabupaten ASC ");
            
            foreach ( $__kabupaten_ortu AS $data => $kabupaten ) :

                echo 
                    "
                        <option value='". @$kabupaten->Id ."'>
                            ". @$kabupaten->K ."
                        </option>
                    ";

            endforeach;

    }

    if ( isset( $_POST['selectKabupatenOrtu'] ) ) {

        @$selectKabupatenOrtu = @$_POST['selectKabupatenOrtu'];

        if ( isset( $_POST['__FormKabupatenOrtu'] ) ) {

            @$__kabupaten_ortu_get = $__db->queryid(" SELECT IdKabupaten AS Id, Kabupaten AS P FROM Kabupaten WHERE IdPropinsi = '". @$_POST['__FormProvinsOrtu'] ."' AND IdKabupaten = '". @$_POST['__FormKabupatenOrtu'] ."' ORDER BY IdKabupaten ASC ");

            echo 
                "
                    <option value='". @$__kabupaten_ortu_get->Id ."' selected>
                        ". @$__kabupaten_ortu_get->P ."
                    </option>
                ";

        } else {

            echo "<option value='' selected disabled>--- Pilih Kecamatan ---</option>";
        
        }

        @$__kecamatan_ortu = $__db->query(" SELECT IdKecamatan AS Id, Kecamatan AS K FROM Kecamatan WHERE IdKabupaten = '". @$selectKabupatenOrtu ."' ORDER BY IdKecamatan ASC ");
            
            foreach ( $__kecamatan_ortu AS $data => $kecamatan ) :

                echo 
                    "
                        <option value='". @$kecamatan->Id ."'>
                            ". @$kecamatan->K ."
                        </option>
                    ";

            endforeach;

    }

    if ( isset( $_POST['selectKecamatanOrtu'] ) ) {

        @$selectKecamatanOrtu = @$_POST['selectKecamatanOrtu'];

        echo 
            "
                <option value='". @$selectKecamatanOrtu ."' selected>
                    ". @$selectKecamatanOrtu ."
                </option>
            ";

    }