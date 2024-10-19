<?=$render('header', ['loggedUser'=>$loggedUser]);?>

<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'photos']);?>

    <section class="feed">

        <?=$render('perfil-header', ['user'=>$user, 'loggedUser'=>$loggedUser, 'isFollowing'=>$isFollowing]);?>
        
        <div class="row">

            <div class="column">
                        
                <div class="box">
                    <div class="box-body">

                        <div class="full-user-photos">

                        <?php foreach($user->photos as $key => $item): ?>

                            <div class="user-photo-item">
                                <a href="<?=$base;?>/media/uploads/<?=$item->body;?>" target="_blank">
                                    <img src="<?=$base;?>/media/uploads/<?=$item->body;?>" />
                                </a>
                            </div>

                        <?php endforeach; ?>

                        <?php if(count($user->photos) === 0): ?>

                            Não há fotos deste usuário.

                        <?php endif; ?>

                        </div>
                        

                    </div>
                </div>

            </div>
            
        </div>

    </section>

</section>
<?=$render('footer');?>