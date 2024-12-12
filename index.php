<?php

    date_default_timezone_set('Asia/Jakarta');

    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    
    @require_once __DIR__ . '/app/helpers/__Session.php';
    @require_once __DIR__ . '/base/__Base_Url.php';
    @require_once __DIR__ . '/app/helpers/__Secret.php';
    @require_once __DIR__ . '/base/__QualityDb.php';
    @require_once __DIR__ . '/app/helpers/__Universitas.php';
    @require_once __DIR__ . '/routes/web.php';

    