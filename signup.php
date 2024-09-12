<?php

    require 'config.php';

    session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css" />
    <link rel="shortcut icon" href="<?=$base;?>/assets/images/logo.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="container">
            <a href="<?=$base;?>"><h3 class="name">TrendFusion</h3></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?=$base;?>/signup_action.php">

            <?php if(!empty($_SESSION['flash'])): ?>

                <?= $_SESSION['flash']; ?>
                <?= $_SESSION['flash'] = ''; ?>

            <?php endif; ?>

            <input required placeholder="Digite seu nome completo ou de usuário" class="input" type="text" name="name" />

            <input required placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input required placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input required placeholder="Digite sua data de nascimento" class="input" type="text" name="birthdate" id="birthdate" />

            <input class="button" type="submit" value="Acessar o sistema" />

            <a href="<?=$base;?>/login.php">Já tem conta? Faça o login</a>
        </form>
    </section>

    <section style="display: flex; justify-content: center; align-items: center;">
        <img class="img" src="<?=$base;?>/assets/images/logo.jpg" style="border-radius: 50%; height: 320px; width: 450px; margin: 20px;"/>
    </section>

    <footer>
        <div class="container">
            <a href="<?=$base;?>"><h5 class="author">Por Guilherme Silva</h5></a>
        </div>
    </footer>

    <script src="https://unpkg.com/imask"></script>

    <script>
        IMask(
            document.getElementById("birthdate"),
            {mask:'00/00/0000'}
        )
    </script>

    <script src="https://unpkg.com/scrollreveal"></script>

    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <script src="<?=$base;?>/assets/js/scroll.js"></script>

</body>
</html>