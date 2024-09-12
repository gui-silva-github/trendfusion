<?php

    $base = 'http://localhost/trendfusion';

    $db_name = 'devsbook';
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';

    $maxWidth = 700;
    $maxHeight = 700;

    try{

        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    } catch(PDOException $e){

        echo $e->getCode()."<br>".$e->getMessage();

    }

?>
