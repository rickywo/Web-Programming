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
    <script>
        $(document).ready(function(){
            $("#check_voucher").html("<i class='fa fa-exclamation-triangle'> Invalid Format</i>");
            $("#name_pass").hide();
            $("#mail_pass").hide();
            $("#phone_pass").hide();
            $("#proceed").hide();
            $("#check_voucher").on("click",function(){
                var sn = $("#v_sn").val();
                var rg = /[0-9]{5}-[0-9]{5}-[A-Z]{2}/g;
                if(rg.test(sn)) {
                    $("#voucher_submit").submit();
                }
            })
            $("#proceed").on("click",function(){
                $("#details_submit").submit();
            })
            $("#v_sn").keyup(function(){
                var sn = $("#v_sn").val();
                var rg = /[0-9]{5}-[0-9]{5}-[A-Z]{2}/g;
                if(rg.test(sn)) {
                    $("#check_voucher").text("Check");
                    $("#check_voucher").removeClass("book-button");
                    $("#check_voucher").addClass("book-button");
                }
                else {
                    $("#check_voucher").html("<i class='fa fa-exclamation-triangle'> Invalid Format</i>");
                }
            })
            $("#cname").keyup(function(){
                var sn = $("#cname").val();
                var rg = /^[A-Za-z -]{2,20}( {1})[A-Za-z ]{2,20}$/g;
                if(rg.test(sn)) {
                    $("#name_pass").show();
                    $("#name_warning").hide();
                    validateform();
                }
                else {
                    $("#name_pass").hide();
                    $("#name_warning").show();
                    validateform();
                }
            })
            $("#mail").keyup(function(){
                var sn = $("#mail").val();
                var rg = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/g;
                if(rg.test(sn)) {
                    $("#mail_pass").show();
                    $("#mail_warning").hide();
                    validateform();
                }
                else {
                    $("#mail_pass").hide();
                    $("#mail_warning").show();
                    validateform();
                }
            })
            $("#phone").keyup(function(){
                var sn = $("#phone").val();
                var rg = /^\+614( ?)?([0-9]{3})( ?)([0-9]{3})$/g;
                if(rg.test(sn)) {
                    $("#phone_pass").show();
                    $("#phone_warning").hide();
                    validateform();
                }
                else {
                    $("#phone_pass").hide();
                    $("#phone_warning").show();
                    validateform();
                }
            })
        })

        function validateform(){
            if(($('#name_pass').is(':visible'))&&($('#mail_pass').is(':visible'))&&($('#phone_pass').is(':visible'))) {
                $("#proceed").show();
                $("#stop").hide();
            }
            else {
                $("#proceed").hide();
                $("#stop").show();
            }
        }
    </script>
    <?php
    include("CDbConnect.php");
    include("utility.php");
    // define variables and set to empty values
    $post_v = array();

    if(($_SERVER["REQUEST_METHOD"]!="POST")&&($_SERVER["REQUEST_METHOD"]!="GET")) {
        reset_session();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $write = 0; // Local variable refer to session need to be set or not.
        $tprice = 0; // Local variable refer to subtotal of a movie session.

        while(($temp = current($_POST))!=null) {
            $post_v[key($_POST)] = $temp;
            next($_POST);
        }
        $t = new CDbConnect('app/views/db/theatre.db');
        $sessions = json_decode($t->getSeesionTimeByTitle($post_v['film']), true)[0];
        unset($t);
        // get session time
        $index = 0;
        while ($index<7) {
            $d = current($sessions);
            if(key($sessions)==$post_v['day']) {
                $post_v['time'] = $d;
                break;
            }
            next($sessions);
            $index++;
        }
        writeSession($post_v /*refer to post array*/);
    }

    if(isset($_GET['v_sn'])) {
        $_SESSION['voucher'] = $_GET['v_sn'];
        if(checkVoucherCode($_SESSION['voucher'])) {
            $_SESSION['grand-total'] = 0.8 * $_SESSION['total'];
        }
        else {
            $_SESSION['grand-total'] = $_SESSION['total'];
        }
    }

    if(isset($_GET['reset'])) {
        $_SESSION['cart'] = array();
        $_SESSION['voucher'] = '';
        $_SESSION['total'] = $_SESSION['grand-total'] = 0;
    }

    if(isset($_GET['mvtitle'])) {
        removefromsession($_GET['mvtitle']);
    }

    function removefromsession($fn /*remove film booking from $_SESSION*/) {
        $i = 0;
        while ($te = current($_SESSION['cart']['screenings'])) { // check any movie session exists in session
            if($te['film']==$fn) {
                //remove an array element in session
                $_SESSION['total'] -= $_SESSION['cart']['screenings'][$i]['sub-total'];
                // replace an array element in session
                unset($_SESSION['cart']['screenings'][$i]);

                $_SESSION['cart']['screenings'] = array_values($_SESSION['cart']['screenings']);
                if(checkVoucherCode($_SESSION['voucher'])) {
                    $_SESSION['grand-total'] = 0.8 * $_SESSION['total'];
                }
                else {
                    $_SESSION['grand-total'] = $_SESSION['total'];
                }
                break;
            }
            $i++;
            next($_SESSION['cart']['screenings']);
        }
    }

    function writeSession($tempa /*refer to post array*/) {
        $af = 1; // adding flag 1: add new element into session, 0: replace exist element in array
        $i = 0;
        $a = array(
            'film'  => $tempa['film'],
            'day'   => $tempa['day'],
            'time'  => $tempa['time'],
            'tickets' => array(
                'SA' => array(
                    'price' => checkRate($tempa['day'], $tempa['time'], 'SA'),
                    'qty'   => $tempa['SA'],
                    'seats' => array()
                ),
                'SP' => array(
                    'price' => checkRate($tempa['day'], $tempa['time'], 'SP'),
                    'qty'   => $tempa['SP'],
                    'seats' => array()
                ),
                'SC' => array(
                    'price' => checkRate($tempa['day'], $tempa['time'], 'SC'),
                    'qty'   => $tempa['SC'],
                    'seats' => array()
                ),
                'FA' => array(
                    'price' => checkRate($tempa['day'], $tempa['time'], 'FA'),
                    'qty'   => $tempa['FA'],
                    'seats' => array()
                ),
                'FC' => array(
                    'price' => checkRate($tempa['day'], $tempa['time'], 'FC'),
                    'qty'   => $tempa['FC'],
                    'seats' => array()
                ),
                'B1' => array(
                    'price' => checkRate($tempa['day'], $tempa['time'], 'B1'),
                    'qty'   => $tempa['B1'],
                    'seats' => array()
                ),
                'B2' => array(
                    'price' => checkRate($tempa['day'], $tempa['time'], 'B2'),
                    'qty'   => $tempa['B2'],
                    'seats' => array()
                ),
                'B3' => array(
                    'price' => checkRate($tempa['day'], $tempa['time'], 'B3'),
                    'qty'   => $tempa['B3'],
                    'seats' => array()
                )
            ),
            'sub-total' => 0
        );
        while($st = current($a['tickets'])) {
            $a['sub-total'] += $st['price'] * $st['qty'];
            next($a['tickets']);
        }
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if(!isset($_SESSION['total'])){
            $_SESSION['total'] = 0;
        }
        if(!isset($_SESSION['voucher'])){
            $_SESSION['voucher'] = '';
        }
        if(!isset($_SESSION['grand-total'])){
            $_SESSION['grand-total'] = 0;
        }
        if(!isset($_SESSION['cart']['screenings'])) {
            $_SESSION['cart']['screenings'] = array();
        }
        if($a['sub-total']!=0){
            if(!is_null($_SESSION['cart']['screenings'])) {
                while ($te = current($_SESSION['cart']['screenings'])) { // check any movie session exists in session
                    if($te['film']==$a['film']) {
                        // count total price
                        $_SESSION['total'] -= $_SESSION['cart']['screenings'][$i]['sub-total'];
                        // replace an array element in session
                        $_SESSION['cart']['screenings'][$i] = $a;
                        $_SESSION['total'] += $_SESSION['cart']['screenings'][$i]['sub-total'];
                        $af = 0;
                        break;
                    }
                    $i++;
                    next($_SESSION['cart']['screenings']);
                }
            }
            if($af) {
                array_push($_SESSION['cart']['screenings'],$a);
                $_SESSION['total'] += $_SESSION['cart']['screenings'][$i]['sub-total'];
            }
            if(checkVoucherCode($_SESSION['voucher'])) {
                $_SESSION['grand-total'] = 0.8 * $_SESSION['total'];
            }
            else {
                $_SESSION['grand-total'] = $_SESSION['total'];
            }
        }
    }

    function checkRate($d, $t, $tp) { //return 0=flat 1=normal
        $flat = $price = 0;
        if($d=='Monday'||$d=='Tuesday'||($t = '1pm' && ($d == 'Wednesday' || $d == 'Thursday' || $d == 'Friday'))) {
            $flat = 0;
        }
        else {
            $flat = 1;
        }
        switch($tp){
            case 'SA':
                if($flat==0){
                    $price = 12;
                }
                else{
                    $price = 18;
                }
                break;
            case 'SP':
                if($flat==0){
                    $price = 10;
                }
                else{
                    $price = 15;
                }
                break;
            case 'SC':
                if($flat==0){
                    $price = 8;
                }
                else{
                    $price = 12;
                }
                break;
            case 'FA':
                if($flat==0){
                    $price = 25;
                }
                else{
                    $price = 30;
                }
                break;
            case 'FC':
                if($flat==0){
                    $price = 20;
                }
                else{
                    $price = 25;
                }
                break;
            case 'B1':
            case 'B2':
            case 'B3':
                if($flat==0){
                    $price = 20;
                }
                else{
                    $price = 30;
                }
                break;
        }
        return $price;
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
        <h1>Shopping Cart</h1>
        <?php
        // Generates Session Times
        $html = '';

        // Generates Tickets List

        if($_SESSION['total'] == 0) {
            $html .= '<div><h2>Dear customer</h2>
                    <h3>Your Shopping Cart is currently empty.</h3></div>';
        }
        else {
            reset($_SESSION['cart']['screenings']);
            while ($s = current($_SESSION['cart']['screenings'])) {

                $html .= '<div><h2>'.$s['film'].'</h2>
                    <h3>'.$s['day'].', '.$s['time'].'</h3></div>
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
                                AU '.sprintf("%01.2f",$d['price']).'
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
                                AU '.sprintf("%01.2f",$d['price']*$d['qty']).'
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
                                <h2>AU '.sprintf("%01.2f",$s['sub-total']).'</h2>
                            </td>
                    </tr>
                    <tr style="background-color: transparent;">
                        <td colspan="5" style="text-align:right;">
                        <a class="book-button" href="cart.php?mvtitle='.$s['film'].'">Delete From Cart</a>
                        </td>
                    </tr>
                </table>';
                next($_SESSION['cart']['screenings']);

            }
        }
        $html .= '<table class="movie-table" style="background-color:transparent; margin-top: 2em;">
            <form method="get" action="cart.php" id="voucher_submit">
            <tr>
            <td colspan="4">
            <h2>Total</h2>
            </td>
            <td>
            <h2 style="text-align: center;">AU '.sprintf("%01.2f",$_SESSION["total"]).'</h2>
            </td>
            </tr>
            ';
        if(checkVoucherCode($_SESSION['voucher'])) {
            $html .= '<tr>
            <td>
            <h2>Voucher Number</h2>
            </td>
            <td>
            <h2>'.$_SESSION['voucher'].'</h2>
            </td>
            <td>
            <h2><i class="fa fa-check"></i></h2>
            </td>';
        }
        else {
            $html .= '<tr>
            <td>
            <h2>Get Voucher discount</h2>
            </td>
            <td>
            <h2><input type="text" id="v_sn" name="v_sn" pattern="^[0-9]{5}-[0-9]{5}-[A-Z]{2}$" placeholder="12345-67890-ZI"></h2>
            </td>
            <td>
            <h2><a class="book-button-invalid" href="javascript:void(0)" id="check_voucher">Check</a></h2>
            </td>';
        }
        $html .= '
            <td>
            <h2>Grand Total</h2>
            </td>
            <td>
            <h2 style="text-align: center;">AU '.sprintf("%01.2f",$_SESSION["grand-total"]).'</h2>
            </td>
            </tr>
            </form>
            </table>';
        if($_SESSION['total'] != 0) {
            $html .= '<h2>
                <i class="fa fa-trash-o"><a class="book-button" href="cart.php?reset=true"> Empty Shopping Cart</a></i>
                <i class="fa fa-arrow-right" style="margin-left:5em;"><a class="book-button" href="#p_detail"> Checkout</a></i>
            </h2>';
        }

        echo $html;
        ?>
    </div>
    <div id="p_detail" class="modalDialog">
        <div>
            <h1 style="font-size: 1.5em; font-family: 'Jura', sans-serif; ">Customer Details</h1>
            <a href="#close" title="Close" class="close">X</a>
            <table class="movie-table" style="background-color:transparent; margin-top: 2em;">
                <form method="post" action="customer.php" id="details_submit">
                    <input type="hidden" name="checkout" value=true>
                    <tr>
                        <td>
                            <h2>Name</h2>
                        </td>
                        <td>
                            <h2>
                                <input type="text" id="cname" name="cname" placeholder="John Smith">
                            </h2>
                        </td>
                        <td>
                            <h2>
                                <i id="name_warning" class="fa fa-exclamation"></i>
                                <i id="name_pass" class="fa fa-check"></i>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2>EMail</h2>
                        </td>
                        <td>
                            <h2><input type="text" id="mail" name="mail" placeholder="john-smith@gmail.com" required></h2>
                        </td>
                        <td>
                            <h2>
                                <i id="mail_warning" class="fa fa-exclamation"></i>
                                <i id="mail_pass" class="fa fa-check"></i>
                            </h2>
                        </td>
                    </tr>
                        <td>
                            <h2>Phone</h2>
                        </td>
                        <td>
                            <h2><input type="text" id="phone" name="phone" placeholder="+614 345 678" required></h2>
                        </td>
                    <td>
                        <h2>
                            <i id="phone_warning" class="fa fa-exclamation"></i>
                            <i id="phone_pass" class="fa fa-check"></i>
                        </h2>
                    </td>
                    </tr>
                </form>
            </table>
            <h2>
                <i id="proceed" class="fa fa-arrow-right" style="margin-left:5em;"><a class="book-button" href="javascript:void(0)"> Proceed your order</a></i>
                <i id="stop" class="fa fa-times" style="margin-left:5em;"> Please fill all fields</i>
            </h2>
        </div>
    </div>
</main>
</body>
</html>