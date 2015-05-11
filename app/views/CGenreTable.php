<?php
/*
<table class="schedule-table">
    <tr>
        <td>
            <h2>Genre</h2>
        </td>
        <td>
            <h2>Mon/Tue</h2>
        </td>
        <td>
            <h2>Wed/Thu/Fri</h2>
        </td>
        <td>
            <h2>Sat/Sun</h2>
        </td>
    </tr>
    <tr>
        <td>
            <img class="thumbnail" src="images/genres/Children.png"><br>
            <!-- Original image below sourced for educational purposes: http://sirubico.deviantart.com -->
            <h2>Children's</h2>
        </td>
        <td>
            <h3>1pm</h3>
        </td>
        <td>
            <h3>6pm</h3>
        </td>
        <td>
            <h3>12pm</h3>
        </td>
    </tr>
    <tr>
        <td>
            <img class="thumbnail" src="images/genres/Art.png">
            <!-- Original image below sourced for educational purposes: http://sirubico.deviantart.com -->
            <br>
            <h2>Art / Foreign</h2>
        </td>
        <td>
            <h3>6pm</h3>
        </td>
        <td>
            <h3>-</h3>
        </td>
        <td>
            <h3>3pm</h3>
        </td>
    </tr>
    <tr>
        <td>
            <img class="thumbnail" src="images/genres/Comedy 2.png">
            <!-- Original image below sourced for educational purposes: http://sirubico.deviantart.com -->
            <br>
            <h2>Romantic Comedy</h2>
        </td>
        <td>
            <h3>9pm</h3>
        </td>
        <td>
            <h3>1pm</h3>
        </td>
        <td>
            <h3>6pm</h3>
        </td>
    </tr>
    <tr>
        <td>
            <img class="thumbnail" src="images/genres/Action 2.png">
            <!-- Original image below sourced for educational purposes: http://sirubico.deviantart.com -->
            <br>
            <h2>Action</h2>
        </td>
        <td>
            <h3>-</h3>
        </td>
        <td>
            <h3>9pm</h3>
        </td>
        <td>
            <h3>9pm</h3>
        </td>
    </tr>
</table>
*/
$sessions = array(
    'g1' => array('type'=>'Children\'s',
        'org'=>'http://sirubico.deviantart.com',
        'src'=>'Children.png',
        's1'=>'1PM',
        's2'=>'6PM',
        's3'=>'12PM'),
    'g2' => array('type'=>'Art/Foreign',
        'org'=>'http://sirubico.deviantart.com',
        'src'=>'Art.png',
        's1'=>'6PM',
        's2'=>'-',
        's3'=>'3PM'),
    'g3'=> array('type'=>'Romantic Comedy',
        'org'=>'http://sirubico.deviantart.com',
        'src'=>'Comedy 2.png',
        's1'=>'9PM',
        's2'=>'1PM',
        's3'=>'6PM'),
    'g4'=> array('type'=>'Action',
        'org'=>'http://sirubico.deviantart.com',
        'src'=>'Action 2.png',
        's1'=>'-',
        's2'=>'9PM',
        's3'=>'9PM')
);

class CGenreTable {
    public static function GenerateGenreTable($items) {
        $html = "<table class='schedule-table'><tr><td><h2>Genre</h2></td><td><h2>Mon/Tue</h2></td><td><h2>Wed/Thu/Fri</h2></td><td><h2>Sat/Sun</h2></td></tr>";
        foreach($items as $item) {
            $html .= "<tr>
        <td>
            <img class='thumbnail' src='app/views/img/genres/{$item['src']}'><br>
            <!-- Original image below sourced for educational purposes: {$item['org']} -->
            <h2>{$item['type']}</h2>
        </td>
        <td>
            <h3>{$item['s1']}</h3>
        </td>
        <td>
            <h3>{$item['s2']}</h3>
        </td>
        <td>
            <h3>{$item['s3']}</h3>
        </td>
    </tr>";
        }
        $html .= "</table>\n";
        return $html;
    }
}
?>