<?php
    require_once('app/templater.php');
    $view = new templater('views/index-view.php');
    $view->render();
?>