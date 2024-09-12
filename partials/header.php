<?php

    $firstName = current(explode(' ', $userInfo->name));

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/style.css" />
    <link rel="shortcut icon" href="<?=$base;?>/assets/images/logo.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="<?=$base;?>/assets/images/logo.png" alt="logo" style="width: 30px; margin-right: 10px;">
                <a href="<?=$base;?>"><h3>TrendFusion</h3></a>
            </div>
            <div class="head-side">
                <div class="head-side-left pesquisa">
                    <div class="search-area">
                        <form method="GET" action="<?=$base;?>/search.php">
                            <input type="search" placeholder="Pesquisar" name="s" />
                        </form>
                    </div>
                </div>
                <div class="head-side-right">
                    <a href="<?=$base;?>/perfil.php" class="user-area">
                        <div class="user-area-text"><?= $firstName; ?></div>
                        <div class="user-area-icon">
                            <img src="<?=$base;?>/media/avatars/<?= $userInfo->avatar; ?>" />
                        </div>
                    </a>
                    <a href="<?=$base;?>/logout.php" class="user-logout">
                        <img src="<?=$base;?>/assets/images/power_white.png" />
                    </a>
                </div>
            </div>
        </div>
    </header>
    <section class="container main">