<?php
    require_once('app/templater.php');
    $view = new templater('views/movie-view.php');
    $view->render();
?>