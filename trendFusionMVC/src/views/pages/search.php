<?=$render('header', ['loggedUser'=>$loggedUser]);?>

<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'search']);?>

    <section class="feed mt-10 search">

        <div class="row">
            <div class="column pr-5">

                <h2 style="margin: 15px;">Pesquisa por: <?=$searchTerm;?></h2>

                <div class="full-friend-list lista">

                    <?php foreach($users as $user): ?>
                        <div class="friend-icon">
                            <a href="<?=$base;?>/perfil/<?=$user->id;?>">
                                <div class="friend-icon-avatar">
                                    <img src="<?=$base;?>/media/avatars/<?=$user->avatar;?>" />
                                </div>
                                <div class="friend-icon-name nome2">
                                    <?=$user->name;?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
            <div class="column side pl-5">
                <?=$render('right-side');?>
            </div>
        </div>

    </section>

</section>
<?=$render('footer');?>