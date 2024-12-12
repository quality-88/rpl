<?php


    require_once dirname(dirname(dirname(__DIR__))) . '/app/helpers/__Base_Url.php';

    header("Location: ". __Base_Url() . "");