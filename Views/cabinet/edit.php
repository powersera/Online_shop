<?php

require_once ROOT.'/Views/layout/header.php';
?>


<section>
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if($result):?>
                    <h3>Данные отредактированы</h3>
                    <?php else:?>

                    <?php if (isset($errors) and is_array($errors)):?>

                     <ul>
                        <?php   foreach ($errors as $error):?>

                            <li>- <?=$error?></li>

                        <?php endforeach;?>
                    </ul>
                    <?php endif;?>


<div class="signup-form"><!--sign up form-->
    <h2>Редактирование данных</h2>
    <form action="" method="post">
        Имя:
        <input type="text" name="name" placeholder="E-mail" value = "<?= $name?>" />
        Пароль:
        <input type="password" name="password" placeholder="Пароль" value = "<?= $password?>" />
        <input type="submit" name="submit" class="btn btn-default" value="Поменять" />
    </form>
</div><!--/sign up form-->
                <?php endif;?>
<br/>
<br/>
</div>
</div>
</div>
</section>

<?php
require_once ROOT.'/Views/layout/footer.php';?>