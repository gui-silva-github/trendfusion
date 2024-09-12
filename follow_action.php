<?php

    require_once('config.php');
    require_once('models/Auth.php');
    require_once('dao/UserRelationDaoMySql.php');
    require_once('dao/UserDaoMySql.php');

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();

    $id = filter_input(INPUT_GET, 'id');

    if($id){
        $userRelationDao = new UserRelationDaoMySql($pdo);
        $userDao = new UserDAOMySQL($pdo);

        if($userDao->findById($id)){
            $relation = new UserRelation();
            $relation->user_from = $userInfo->id;
            $relation->user_to = $id;

            if($userRelationDao->isFollowing($userInfo->id, $id)){
                $userRelationDao->delete($relation);
            } else {
                $userRelationDao->insert($relation);
            }

            header('Location: perfil.php?id='.$id);
            exit;
        }

    }

    header("Location: " . $base);
    exit;

?>