<?php

    require_once('config.php');
    require_once('models/Auth.php');
    require_once('dao/PostDaoMySql.php');

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();
    $activeMenu = "home";

    $page = intval(filter_input(INPUT_GET, 'p'));

    if($page < 1){
        $page = 1;
    }

    $postDao = new PostDaoMySql($pdo);
    $info = $postDao->getHomeFeed($userInfo->id, $page);
    $feed = $info['feed'];
    $pages = $info['pages'];
    $currentPage = $info['currentPage'];

    require("partials/header.php");
    require("partials/menu.php");

?>

<section class="feed mt-10">
    <div class="row">
        <div class="column pr-5">
            
        <?php require("partials/feed-editor.php"); ?>

        <?php foreach($feed as $item): ?>
            <?php require("partials/feed-item.php"); ?>
        <?php endforeach; ?>

        <div class="feed-pagination">
            <?php for($q=0;$q<$pages;$q++): ?>
                <a class="<?=($q+1==$currentPage)?'active':''?>" href="<?=$base;?>/?p=<?=$q+1;?>"><?=$q+1?></a>
            <?php endfor; ?>
        </div>

        </div>
        <div class="column side pl-5">
            <div class="box banners">
                <div class="box-header">
                    <div class="box-header-text">Tecnologias</div>
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
                        Criado por Gui Silva 🚀
                    </div>
                </div>
        </div>
    </div>
</section>

<?php

    require("partials/footer.php");

?>