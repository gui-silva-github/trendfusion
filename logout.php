<?php

    require("config.php");

    session_start();

    $_SESSION['token'] = '';
    header('Location: '.$base);
    exit;

?>