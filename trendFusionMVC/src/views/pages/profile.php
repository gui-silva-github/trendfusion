<?=$render('header', ['loggedUser'=>$loggedUser]);?>

<?php $profile = ($user->id != $loggedUser->id) ? '' : 'profile'; ?> 

<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>$profile]);?>

    <section class="feed">

        <?=$render('perfil-header', ['user'=>$user, 'loggedUser'=>$loggedUser, 'isFollowing'=>$isFollowing]);?>
        
        <div class="row">

            <div class="column side pr-5">
                
                <div class="box">
                    <div class="box-body">
                        
                        <div class="user-info-mini">
                            <img src="<?=$base;?>/assets/images/calendar.png" />
                            <?=date('d/m/Y', strtotime($user->birthdate));?> (<?=$user->ageYears;?> anos)
                        </div>

                        <?php if(!empty($user->city)): ?>
                        <div class="user-info-mini">
                            <img src="<?=$base;?>/assets/images/pin.png" />
                            <?=$user->city;?>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($user->work)): ?>
                        <div class="user-info-mini">
                            <img src="<?=$base;?>/assets/images/work.png" />
                            <?=$user->work;?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="box">
                    <div class="box-header m-10">
                        <div class="box-header-text">
                            Seguindo
                            <span>(<?=count($user->following);?>)</span>
                        </div>
                        <div class="box-header-buttons">
                            <a href="<?=$base;?>/perfil/<?=$user->id;?>/amigos">ver todos</a>
                        </div>
                    </div>
                    <div class="box-body friend-list">
                        
                        <?php for($q=0;$q<9;$q++): ?>
                            <?php if(isset($user->following[$q])): ?>
                                <div class="friend-icon">
                                    <a href="<?=$base;?>/perfil/<?=$user->following[$q]->id;?>">
                                        <div class="friend-icon-avatar">
                                            <img src="<?=$base;?>/media/avatars/<?=$user->following[$q]->avatar;?>" />
                                        </div>
                                        <div class="friend-icon-name">
                                            <?=$user->following[$q]->name;?>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>

                    </div>
                </div>

            </div>
            <div class="column pl-5">

                <div class="box">
                    <div class="box-header m-10">
                        <div class="box-header-text">
                            Fotos
                            <span>(<?=count($user->photos);?>)</span>
                        </div>
                        <div class="box-header-buttons">
                            <a href="<?=$base;?>/perfil/<?=$user->id;?>/fotos">ver todos</a>
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
                
                <?php if($user->id == $loggedUser->id): ?>
                    <?=$render('feed-editor', ['user'=>$loggedUser]);?>
                <?php endif; ?>

                <?php foreach($feed['posts'] as $feedItem): ?>
                    <?=$render('feed-item', [
                        'data' => $feedItem,
                        'loggedUser' => $loggedUser
                    ]);?>
                <?php endforeach; ?>

                <?php if(!(count($feed['posts'])>0)): ?>

                    <p style="color: white;">Não há postagens desse usuário.</p>

                <?php endif; ?>
                    
                <div class="feed-pagination">
                    <?php for($q=0;$q<$feed['pageCount'];$q++): ?>
                        <a class="<?=($q==$feed['currentPage']?'active':'')?>" href="<?=$base;?>/perfil/<?=$user->id;?>?page=<?=$q;?>"><?=$q+1;?></a>
                    <?php endfor; ?>
                </div>

            </div>
            
        </div>

    </section>

</section>
<?=$render('footer');?>