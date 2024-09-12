<?php

    require 'config.php';
    require 'models/Auth.php';

    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $birthdate = filter_input(INPUT_POST, 'birthdate');

    if($name && $email && $password && $birthdate){
        
        $auth = new Auth($pdo, $base);

        $birthdate = explode('/', $birthdate);

        if(count($birthdate) != 3){
            $_SESSION['flash'] = "Data de nascimento inválida";
            header("Location: $base/signup.php");
            exit;
        }

        $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];

        if(strtotime($birthdate) === false){
            $_SESSION['flash'] = "Data de nascimento inválida";
            header("Location: $base/signup.php");
            exit;
        }

        if($auth->emailExists($email) === false){

            $auth->registerUser($name, $email, $password, $birthdate);
            header("Location: $base");
            exit;

        } else {
            $_SESSION['flash'] = "E-mail já cadastrado";
            header("Location: $base/signup.php");
            exit;
        }

    }

    $_SESSION['flash'] = "Campos não enviados.";
    header("Location: $base/signup.php");
    exit;

?>