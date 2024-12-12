<?php


    @require_once dirname(dirname(__DIR__)) . '/app/routes/__Base_Url.php';

    header("Location: ". __Base_Url() . "");