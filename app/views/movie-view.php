<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <title>SILVERADO CINEMA</title>
    <link href='https://fonts.googleapis.com/css?family=Jura:500' rel='stylesheet' type='text/css'>
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
    <script src="app/views/cartjs.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <style>
        <?php require_once('css/style.css'); ?>
        <?php require_once('css/modaldialog.css'); ?>
    </style>
</head>

<body>

<header>
    <img class="head-logo" src="app/views/img/logo.png" alt="Logo" height="90" width="290"/>
</header>
<?php
include("CShare.php");
echo CShare::GenerateShareBtn($links);
require_once("navibar.php");
?>

<main class="movie-display">
    <?php
    include_once("CDbConnect.php");
    $t = new CDbConnect('app/views/db/theatre.db');
    $movies = json_decode($t->getAllMovieInfo(), true);
    include("CMovieView.php");
    echo CMovieView::GenerateMovieView($movies);
    unset($t);
    ?>
</main>

<?php require_once("footer.php"); ?>

</body>

</html>