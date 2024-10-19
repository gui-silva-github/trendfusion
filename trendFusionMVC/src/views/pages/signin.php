<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login - TrendFusion</title>
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
        <form class="form" method="POST" action="<?=$base;?>/login">

            <?php if(!empty($flash)): ?>

                <?= $flash; ?>

            <?php endif; ?>

            <input required placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input required placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input class="button" type="submit" value="Acessar o sistema" />

            <a class="link" href="<?=$base;?>/cadastro">Ainda não tem conta? Cadastre-se</a>
        </form>
    </section>

    <section style="display: flex; justify-content: center; align-items: center;">
        <img class="img" src="<?=$base;?>/assets/images/social.jpg" style="border-radius: 50%; height: 320px; width: 450px; margin: 20px;"/>
    </section>

    <footer>
        <div class="container">
            <a href="<?=$base;?>"><h5 class="copyright">Por Guilherme Silva</h5></a>
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>

    <script src="<?=$base;?>/assets/js/scroll.js"></script>

</body>
</html>