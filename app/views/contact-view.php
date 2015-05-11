<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <title>SILVERADO CINEMA</title>
    <link href='http://fonts.googleapis.com/css?family=Jura:500' rel='stylesheet' type='text/css'>
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
    <style>
        <?php require_once('css/style.css'); ?>
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
    <div class="column" style="text-align: start;">
        <h1>Enquiry</h1>
        <p>We would greatly appreciate it if you kindly leave us some feedback</p>
        <form id="contact_form" action="http://titan.csit.rmit.edu.au/~e54061/wp/form-tester.php" method="post">
            <table class="movie-table">
                <tr>
                    <td>
                        <h2>Enquiry type:</h2>
                    </td>
                    <td>
                        <select name="subject">
                            <option>General Enquiry</option>
                            <option>Group and Corporate Bookings</option>
                            <option>Suggestions and Complains</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>E-mail:</h2>
                    </td>
                    <td>
                        <input type="email" name="email" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2></h2>
                    </td>
                    <td>
                        <textarea name="message" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Submit" style="float:right; margin: .5em">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    include("CAdColumn.php");
    echo CAdColumn::GenerateAdColumn($ads);
    ?>
</main>
<?php require_once("footer.php"); ?>

</html>