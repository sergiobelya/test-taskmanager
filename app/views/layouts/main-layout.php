<!DOCTYPE html>
<html>
    <?= $this->render('partials/head') ?>
    <body>
        <?= $this->render('partials/header-nav') ?>

        <div class="container" id="main">
            <?= $content ?>
        </div> <!-- /container -->
<?php

?>
    </body>
</html>