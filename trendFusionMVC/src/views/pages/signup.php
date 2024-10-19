<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro - TrendFusion</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href="<?=$base;?>"><h3 class="name">TrendFusion</h3></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?=$base;?>/cadastro">
            <?php if(!empty($flash)): ?>
                <div class="flash"><?php echo $flash; ?></div>
            <?php endif; ?>

            <input placeholder="Digite seu Nome Completo" class="input" type="text" name="name" />

            <input placeholder="Digite seu E-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua Senha" class="input" type="password" name="password" />

            <input placeholder="Digite sua Data de Nascimento" class="input" type="text" name="birthdate" id="birthdate" />

            <input class="button" type="submit" value="Fazer cadastro" />

            <a href="<?=$base;?>/login">Já tem conta? Faça o login</a>
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
    document.getElementById('birthdate'),
    {
        mask:'00/00/0000'
    }
);
</script>

<script src="https://unpkg.com/scrollreveal"></script>

<script src="<?=$base;?>/assets/js/scroll.js"></script>

</body>
</html>