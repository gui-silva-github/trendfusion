<?php

    require_once('config.php');
    require_once('models/Auth.php');
    require_once('dao/PostDaoMySql.php');
    require_once('dao/UserRelationDaoMySql.php');

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();
    $activeMenu = "profile";
    $user = [];
    $feed = [];

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if(!$id){
        $id = $userInfo->id;
    }

    if($id != $userInfo->id){
        $activeMenu = "";
    }

    $page = intval(filter_input(INPUT_GET, 'p'));
    if($page < 1){
        $page = 1;
    }

    $postDao = new PostDaoMySql($pdo);
    $userDao = new UserDAOMySQL($pdo);  
    $userRelationDao = new UserRelationDaoMySql($pdo);

    $user = $userDao->findById($id, true);
    if(!$user){
        header("Location: ".$base);
        exit;
    }

    $dateFrom = new DateTime($user->birthdate);
    $dateTo = new DateTime();
    $user->ageYears = $dateFrom->diff($dateTo)->y;

    $info = $postDao->getUserFeed($id, $page);
    $feed = $info['feed'];
    $pages = $info['pages'];
    $currentPage = $info['currentPage'];

    $isFollowing = $userRelationDao->isFollowing($userInfo->id, $id);

    require("partials/header.php");
    require("partials/menu.php");

?>

<section class="feed">

            <div class="row perfil">
                <div class="box flex-1 border-top-flat">
                    <div class="box-body">
                        <div class="profile-cover" style="background-image: url('<?=$base;?>/media/covers/<?=$user->cover;?>');"></div>
                        <div class="profile-info m-20 row">
                            <div class="profile-info-avatar">
                                <img src="<?=$base;?>/media/avatars/<?=$user->avatar;?>" />
                            </div>
                            <div class="profile-info-name">
                                <div class="profile-info-name-text"><?=$user->name;?></div>
                                
                                <?php if(!empty($user->city)): ?>
                                    <div class="profile-info-location"><?=$user->city?></div>
                                <?php endif; ?>

                            </div>
                            <div class="profile-info-data row">
                                <div class="profile-info-item m-width-20">
                                    <?php if($id != $userInfo->id): ?>
                                        <a href="follow_action.php?id=<?=$id;?>" class="button">
                                            <?=(!$isFollowing) ? 'Seguir' : 'Deixar de seguir' ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="profile-info-item m-width-20">
                                    <a href="<?=$base;?>/amigos.php?id=<?=$user->id;?>"><div class="profile-info-item-n"><?=count($user->followers);?></div></a>
                                    <div class="profile-info-item-s">Seguidores</div>
                                </div>
                                <div class="profile-info-item m-width-20">
                                    <a href="<?=$base;?>/amigos.php?id=<?=$user->id;?>"><div class="profile-info-item-n"><?=count($user->following);?></div></a>
                                    <div class="profile-info-item-s">Seguindo</div>
                                </div>
                                <div class="profile-info-item m-width-20">
                                    <a href="<?=$base;?>/fotos.php?id=<?=$user->id;?>"><div class="profile-info-item-n"><?=count($user->photos);?></div></a>
                                    <div class="profile-info-item-s">Fotos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">

                <div class="column side pr-5 info">
                    
                    <div class="box">
                        <div class="box-body">
                            
                            <div class="user-info-mini">
                                <img src="<?=$base;?>/assets/images/calendar.png" />
                                <?=date('d/m/Y', strtotime($user->birthdate));?> (<?=$user->ageYears?> anos)
                            </div>
                            
                            <?php if(!empty($user->city)): ?>
                                <div class="user-info-mini">
                                    <img src="<?=$base;?>/assets/images/pin.png" />
                                    <?=$user->city?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(!empty($user->work)): ?>
                                <div class="user-info-mini">
                                    <img src="<?=$base;?>/assets/images/work.png" />
                                    <?=$user->work?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header m-10">
                            <div class="box-header-text">
                                Seguindo
                                <a href="<?=$base;?>/amigos.php?id=<?=$user->id;?>"><span>(<?=count($user->following);?>)</span></a>
                            </div>
                            <div class="box-header-buttons">
                                <a href="<?=$base;?>/amigos.php?id=<?=$user->id;?>">Ver todos</a>
                            </div>
                        </div>
                        <div class="box-body friend-list">

                            <?php if(count($user->following) > 0): ?>

                                <?php foreach($user->following as $item): ?>

                                    <div class="friend-icon">
                                        <a href="<?=$base;?>/perfil.php?id=<?=$item->id;?>">
                                            <div class="friend-icon-avatar">
                                                <img src="<?=$base;?>/media/avatars/<?=$item->avatar;?>" />
                                            </div>
                                            <div class="friend-icon-name">
                                                <?=$item->name;?>
                                            </div>
                                        </a>
                                    </div>
                                    
                                <?php endforeach; ?>
                            
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
                <div class="column pl-5">

                    <div class="box fotos">
                        <div class="box-header m-10">
                            <div class="box-header-text">
                                Fotos
                                <span>(<?=count($user->photos);?>)</span>
                            </div>
                            <div class="box-header-buttons">
                                <a href="<?=$base;?>/fotos.php?id=<?=$user->id;?>">Ver todos</a>
                            </div>
                        </div>
                        <div class="box-body row m-20">
                            
                            <?php if(count($user->photos) > 0): ?>

                                <?php foreach($user->photos as $key => $item): ?>

                                    <?php if($key < 4): ?>

                                        <div class="user-photo-item">
                                            <a href="<?=$base;?>/media/uploads/<?=$item->body;?>" target="_blank">
                                                <img src="<?=$base;?>/media/uploads/<?=$item->body;?>" />
                                            </a>
                                        </div>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            <?php endif; ?>
                            
                        </div>
                    </div>

                    <?php if($id == $userInfo->id): ?>
                        <?php require("partials/feed-editor.php"); ?>   
                    <?php endif; ?>

                    <?php if(count($feed) > 0): ?>

                        <?php foreach($feed as $item): ?>
                    
                            <?php require("partials/feed-item.php"); ?>

                        <?php endforeach; ?>

                        <div class="feed-pagination">
                            <?php for($q=0;$q<$pages;$q++): ?>
                                <a class="<?=($q+1==$currentPage)?'active':''?>" href="<?=$base;?>/perfil.php?id=<?=$id;?>&p=<?=$q+1;?>"><?=$q+1?></a>
                            <?php endfor; ?>
                        </div>

                    <?php else: ?>

                        <p style="color: white;">Não há postagens desse usuário.</p>

                    <?php endif; ?>

                </div>
                
            </div>

</section>

<?php

    require("partials/footer.php");

?>