<?php


    if ( isset( $_SESSION['__Notifikasi'] ) ) 
    {

        if ( @$_SESSION['__Notifikasi']['Error'] == '01' ) {

            @$__color_notifikasi = 'primary';

        } elseif ( @$_SESSION['__Notifikasi']['Error']  == '02' ) {

            @$__color_notifikasi = 'success';

        } elseif ( @$_SESSION['__Notifikasi']['Error']  == '03' ) {

            @$__color_notifikasi = 'danger';

        }

            echo 
                "
                    <div class='alert alert-". @$__color_notifikasi ." shadow text-center my-lg-4' role='alert'>
                        <h5 class='alert-heading'>
                            Information !
                        </h5>
                        <p>
                            <strong>
                                ". @$_SESSION['__Notifikasi']['Message']  ."
                            </strong>
                        </p>
                    </div>
                ";


        unset( $_SESSION['__Notifikasi'] );

    }