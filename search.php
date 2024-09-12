<?php

    require_once('config.php');
    require_once('models/Auth.php');
    require_once('dao/UserDaoMySql.php');

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();
    $activeMenu = "search";

    $userDao = new UserDAOMySQL($pdo);

    $searchTerm = filter_input(INPUT_GET, 's', FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($searchTerm)){
        header('Location: index.php');
        exit;
    }

    $userList = $userDao->findByName($searchTerm);

    require("partials/header.php");
    require("partials/menu.php");

?>

<section class="feed mt-10">
    <div class="row search">
        <div class="column pr-5">

        <h2 style="margin: 15px;">Pesquisa por: <?=$searchTerm;?></h2>

        <div class="full-friend-list lista">

            <?php foreach($userList as $item): ?>

                <div class="friend-icon">
                    <a href="<?=$base;?>/perfil.php?id=<?=$item->id;?>">
                        <div class="friend-icon-avatar">
                            <img src="<?=$base;?>/media/avatars/<?=$item->avatar;?>" />
                        </div>
                        <div class="friend-icon-name nome2">  
                            <?=$item->name;?>
                        </div>
                    </a>
                </div>

            <?php endforeach; ?>

        </div>

        </div>
        <div class="column side pl-5">
            <div class="box banners">
                <div class="box-header">
                    <div class="box-header-text">Patrocinios</div>
                    <div class="box-header-buttons">
                                
                    </div>
                </div>
                <div class="box-body">
                            <a><img src="https://th.bing.com/th/id/R.9c75a483f3827a44467dea98ef26e242?rik=PrbC682XutfZWw&pid=ImgRaw&r=0" /></a>
                            <a><img src="https://th.bing.com/th/id/OIP.qF-5pDFdeBN8DhoN2tlBcQHaD3?rs=1&pid=ImgDetMain" /></a>
                            <a><img src="https://miro.medium.com/v2/resize:fit:1200/1*XcF6NnpKUV3J9EAgvvTx_g.jpeg" /></a>
                            <a><img src="https://codersfree.nyc3.cdn.digitaloceanspaces.com/posts/conoce-8-ventajas-de-usar-javascript.jpg"/></a>
                            <a><img src="https://th.bing.com/th/id/OIP.o_-8fVSjwzBvEP40Bz7evQHaDY?w=700&h=320&rs=1&pid=ImgDetMain" /></a>
                </div>
            </div>
                <div class="box">
                    <div class="box-body m-10">
                        Criado com ❤️ por Gui Silva
                    </div>
                </div>
        </div>
    </div>
</section>

<?php

    require("partials/footer.php");

?>