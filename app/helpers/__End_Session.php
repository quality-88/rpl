<?php


    if ( isset( $_SESSION ) ) {

        @$_SESSION = array();
        session_unset();
        session_destroy();

    }