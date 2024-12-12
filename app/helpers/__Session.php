<?php


    if (session_status() === PHP_SESSION_NONE) {
        
        ob_start();
        session_start();

    }
    