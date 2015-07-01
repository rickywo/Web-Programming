<?php
/**
 * Created by PhpStorm.
 * User: Chang-Yi Wu
 * Date: 2015/5/18
 * Time: 下午3:37
 */
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
    include("CDbConnect.php");
    include("utility.php");
    // define variables and set to empty values
    $post_v = array();
    $booking_code = null;

    if(isset($_POST['checkout'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            while(($temp = current($_POST))!=null) {
                $post_v[key($_POST)] = $temp;
                next($_POST);
            }

            writeCustomerDetails($post_v /*refer to post array*/);
            // Generate random string
            $booking_code = generateRandomString();
            $jstring = json_encode($_SESSION);
            $t = new CDbConnect('app/views/db/theatre.db');
            $t->saveReservation($_SESSION['mail'], $booking_code, $jstring);
        }
    }

    if(isset($_POST['login'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            while(($temp = current($_POST))!=null) {
                $post_v[key($_POST)] = $temp;
                next($_POST);
            }
            $t = new CDbConnect('app/views/db/theatre.db');
            //$t->saveReservation($_SESSION['mail'], $rstring, $jstring);
            $sessions = (array)json_decode($t->getReservation($_POST['mail'], $_POST['code']), true);
            array_walk_recursive($sessions, 'objectify');
            $_SESSION = $sessions[0]['info'];
        }
    }




    /**
     * Created by Chang-Yi Wu on 2015/3/19.
     */
    function writeCustomerDetails($tempa /*refer to post array*/) {
        $_SESSION['name'] = $tempa['cname'];
        $_SESSION['mail'] = $tempa['mail'];
        $_SESSION['phone'] = $tempa['phone'];
    }

    ?>
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
<main class="booking">
    <div class="column-booking" style="text-align: center;">
        <?php
        // Generates Session Times
        $html = '';

        // Generates Tickets List

        $html .= '<div><h2 style="font-size:1.5em;">Dear '.strtoupper($_SESSION['name']);
        if(is_null($booking_code)){
            $html .= ', your reservations are listed as follows</h2></div>';
        }
        else {
            $html .= ', your reservation code is: '.$booking_code.', please remember it for login and check your reservation.</h2></div>';
        }
        reset($_SESSION['cart']['screenings']);
        while ($s = current($_SESSION['cart']['screenings'])) {

                $html .= '<div><h3 style="color:#FFFFFF;">'.strtoupper($s['film']).' '.$s['day'].', '.$s['time'].'</h3></div>
                    <table class="movie-table">
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
                $index = 0;
                while ($d = current($s['tickets'])) {
                    if($d['qty']!=0){$html .= '
                    <tr>
                        <td>
                            <h3>
                                '.key($s['tickets']).'
                            </h3>
                        </td>
                        <td>
                            <h3>
                                AU '.$d['price'].'
                            </h3>
                        </td>
                        <td>
                            <h3>
                                '.$d['qty'].'
                            </h3>
                        </td>
                        <td>
                            <h3>
                                '.'
                            </h3>
                        </td>
                        <td>
                            <h3>
                                AU '.$d['price']*$d['qty'].'
                            </h3>
                        </td>
                    </tr>';}
                    next($s['tickets']);
                }
                $html .= '<tr>
                            <td colspan="4">
                                <h2>Sub Total</h2>
                            </td>
                            <td>
                                <h2>
                                AU '.$s['sub-total'].'
                                </h2>
                            </td>
                    </tr>
                </table>';
                next($_SESSION['cart']['screenings']);

            }
        $html .= '<table class="movie-table" style="background-color:transparent; margin-top: 2em;">
            <tr>
            <td colspan="4">
            <h2>Total</h2>
            </td>
            <td>
            <h2 style="text-align: center;">AU '.$_SESSION["grand-total"].'</h2>
            </td>
            </tr>
            </table>';
        echo $html;
        reset_session();
        ?>
    </div>
</main>
</body>
</html>