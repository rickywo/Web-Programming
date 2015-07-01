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
    <?php
    $mvtitle = $_GET['mvtitle'];
    include_once("CDbConnect.php");
    include("CMovieView.php");
    $t = new CDbConnect('app/views/db/theatre.db');
    $movies = json_decode($t->getMovieInfoByTitle($mvtitle), true);
    $sessions = json_decode($t->getSeesionTimeByTitle($mvtitle), true);
    $movies[0]['sessions'] = $sessions[0];
    unset($t);
    ?>
</head>
<body>
<header>
    <img class="head-logo" src="app/views/img/logo.png" alt="Logo" height="90" width="290"/>
</header>
<main class="booking">
    <div class="column-booking" style="text-align: center;">
        <form id="booking_form" action="cart.php" method="post">

            <h1>Online Booking</h1>
            <?php
                echo CMovieView::GenerateSingleMovieView($movies[0]);
            // Generates hidden input for holding title

            // Generates Session Times
            $html = '<input type="hidden" name="film" value="'.$movies[0]['title'].'"></input>';
            $html .= '<table class="booking-info-table">
                        <tr>
                            <td>
                                <h2>Session Times</h2>
                            </td>
                            <td colspan="7">
                                <select name="day">';
            $index = 0;
            while ($index<7) {
                $d = current($sessions[0]);
                if(!is_null($d)){$html .= '<option value='.key($sessions[0]).'>'.key($sessions[0]).', '.$d.'</option>';}
                next($sessions[0]);
                $index++;
            }
            $html.= '</select>
                    </td>
                </tr>';

            // Generates Tickets List
            $ticketArray = array(
                array('Adult', 'SA'),
                array('Concession', 'SP'),
                array('Child', 'SC'),
                array('First Class Adult', 'FA'),
                array('First Class Child', 'FC'),
                array('Beanbag','B1'),
                array('Beanbag (Couple)', 'B2'),
                array('Child x3', 'B3')
            );

            $html .= '</table>
                        <table class="ticket-table">
                            <tr>
                                <td>
                                    <h2>Ticket Type</h2>
                                </td>
                                <td colspan="7">
                                    <h2>Quantity</h2>
                                </td>
                            </tr>';
            while($d=current($ticketArray)) {
                $html .= '<tr>
                            <td>
                                <h2>'.$d[0].'</h2>
                            </td>
                            <td colspan="8">
                                <select name='.$d[1].'>
                                    <option value=0>0</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                    <option value=6>6</option>
                                </select>
                            </td>
                        </tr>';
                next($ticketArray);
            }
            $html .= '<tr>
                        <td colspan="9" style="overflow: hidden; text-align: center;">
                            <input type="submit" value="Add to cart" style="margin: .7em .2em .5em .1em;">
                        </td>
                        </tr>
                    </table>';
            echo $html;
            ?>
        </form>
    </div>
</main>
<!--<script>
    $(document).ready(function() {
        $('select[name=SA]').change(function(){
            var amount;
            var sub;
            amount = $('select[name=SA] option:selected').val();
            sub = amount * 12;
            $("#adult-t-st").append("$"+sub);
        });
    });
</script>-->
</body>
</html>