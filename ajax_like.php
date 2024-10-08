<?php

    require_once('config.php');
    require_once('models/Auth.php');
    require_once('dao/PostLikeDaoMySql.php');

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();

    $id = filter_input(INPUT_GET, 'id');

    if(!empty($id)){

        $postLikeDao = new PostLikeDaoMySql($pdo);
        $postLikeDao->likeToggle($id, $userInfo->id);

    }

?>