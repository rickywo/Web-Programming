<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <title>SILVERADO CINEMA</title>
    <link href='http://fonts.googleapis.com/css?family=Jura:500' rel='stylesheet' type='text/css'>
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
    <script src="app/views/myextjs.js"></script>
    <style>
        <?php require_once('css/style.css'); ?>
    </style>
    <?php
    // Initialize required variables
    // define variables and set to empty values
    $film = $day = $time = "";
    $tb = array();
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $film = $_POST["film"];
        $day = $_POST["day"];
        $tb[0] = $_POST["sa"];
        $tb[1] = $_POST["sp"];
        $tb[2] = $_POST["sc"];
        $tb[3] = $_POST["fa"];
        $tb[4] = $_POST["fc"];
        $tb[5] = $_POST["b1"];
        $tb[6] = $_POST["b2"];
        $tb[7] = $_POST["b3"];
        include_once("CDbConnect.php");
        $t = new CDbConnect('app/views/db/theatre.db');
        $session = json_decode($t->getSeesionTimeByTitle($film), true)[0];
        unset($t);
        // get session time
        $index = 0;
        while ($index<7) {
            $d = current($sessions[0]);
            if(key($sessions[0])==$day) {
                $time = $d;
                break;
            }
            next($sessions[0]);
            $index++;
        }
    }



    ?>
</head>
<body>
<header>
    <img class="head-logo" src="app/views/img/logo.png" alt="Logo" height="90" width="290"/>
</header>
<main class="booking">
    <div class="column-booking" style="text-align: center;">
            <h1>Shopping Cart</h1>
            <?php

            // Generates Session Times
            $html = '<input type="hidden" name="film" value="'.$movies[0]['title'].'"></input>';
            $html .= '<table class="movie-table">
                        <tr>
                            <td>
                                <h2>Ticket Type</h2>
                            </td>
                            <td>
                                <h2>Cost</h2>
                            </td>
                            <td>
                                <h2>Quantity</h2>
                            </td>
                            <td>
                                <h2>Seats</h2>
                            </td>
                            <td>
                                <h2>Subtotal</h2>
                            </td>
                        </tr>';
            // Generates Tickets List

            $index = 0;
            while ($index<7) {
                $d = current($ticketArray[0]);
                if(!is_null($d)){$html .= '
                    <tr>
                        <td>
                            <h3>
                                '.key($ticketArray[0]).'
                            </h3>
                        </td>
                        <td>
                            <h3>
                                '.key($ticketArray[0]).'
                            </h3>
                        </td>
                        <td>
                            <h3>
                                '.key($tb[0]).'
                            </h3>
                        </td>
                        <td>
                            <h3>
                                '.key($ticketArray[0]).'
                            </h3>
                        </td>
                        <td>
                            <h3>
                                '.key($ticketArray[0]).'
                            </h3>
                        </td>
                    </tr>';}
                next($sessions[0]);
                $index++;
            }
            $html .= '<tr>
                        <td colspan="9" style="overflow: hidden; text-align: center;">

                        </td>
                        </tr>
                    </table>';
            echo $html;
            ?>
    </div>
</main>
</body>
</html>