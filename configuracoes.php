<?php

    require_once('config.php');
    require_once('models/Auth.php');
    require_once('dao/UserDaoMySql.php');

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();
    $activeMenu = "config";

    $userDao = new UserDAOMySQL($pdo);
    
    require("partials/header.php");
    require("partials/menu.php");

?>

<section class="feed mt-10 configuracoes">

    <?php if(!empty($_SESSION['flash'])): ?>

        <?= $_SESSION['flash']; ?>
        <?= $_SESSION['flash'] = ''; ?>

    <?php endif; ?>

    <form action="configuracoes_action.php" method="POST" class="config-form" enctype="multipart/form-data">
        
        <div class="imagens">
            <label>Novo Avatar:<br/>
                <input type="file" name="avatar"><br/>

                <img src="<?=$base;?>/media/avatars/<?=$userInfo->avatar;?>" class="mini"/>
            </label>
            <label>
                Nova Capa:<br/>
                <input type="file" name="cover"><br/>

                <img src="<?=$base;?>/media/covers/<?=$userInfo->cover;?>" class="mini"/>
            </label>
        </div>

        <hr>

        <label>
            Nome Completo:<br/>
            <input type="text" name="name" value="<?=$userInfo->name;?>">
        </label>
        <label>
            E-mail:<br/>
            <input type="email" name="email"  value="<?=$userInfo->email;?>">
        </label>

        <label>
            Data de Nascimento:<br/>
            <input type="text" id="birthdate" name="birthdate" value="<?=date('d/m/Y', strtotime($userInfo->birthdate));?>">
        </label>
        <label>
            Cidade:<br/>
            <input type="text" name="city" value="<?=$userInfo->city;?>">
        </label>

        <label>
            Trabalho:<br/>
            <input type="text" name="work" value="<?=$userInfo->work;?>">
        </label>
        
        <hr>

        <label>
            Nova Senha: <br/>
            <input type="password" name="password">
        </label>
        <label>
            Confirmar Nova Senha: <br/>
            <input type="password" name="password_confirmation">
        </label>

        <button class="button">Salvar</button>
    </form>
   
</section>

<script src="https://unpkg.com/imask"></script>

<script>
        IMask(
            document.getElementById("birthdate"),
            {mask:'00/00/0000'}
        )
</script>


<?php

    require("partials/footer.php");

?>