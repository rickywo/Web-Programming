<?php
/*
<table class="price-table">
    <tr>
        <td>
            <h2>Type</h2>
        </td>
        <td>
            <h2>Mon - Tue (All Day)<br>
                Mon - Fri (1pm only)</h2>
        </td>
        <td>
            <h2>Wed - Fri (not 1pm)<br>
                Sat - Sun (All Day)</h2>
        </td>
    </tr>
    <tr>
        <td>
            <h2>Standard-Full</h2>
        </td>
        <td>
            <h3>$12</h3>
        </td>
        <td>
            <h3>$18</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h2>Standard-Conc</h2>
        </td>
        <td>
            <h3>$10</h3>
        </td>
        <td>
            <h3>$15</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h2>Standard-Child</h2>
        </td>
        <td>
            <h3>$8</h3>
        </td>
        <td>
            <h3>$12</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h2>FirstClass-Adult</h2>
        </td>
        <td>
            <h3>$25</h3>
        </td>
        <td>
            <h3>$30</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h2>FirstClass-Child</h2>
        </td>
        <td>
            <h3>$20</h3>
        </td>
        <td>
            <h3>$25</h3>
        </td>
    </tr>
    <tr>
        <td>
            <h2>Beanbag*</h2>
        </td>
        <td>
            <h3>$20</h3>
        </td>
        <td>
            <h3>$30</h3>
        </td>
    </tr>
</table>
*/
$prices = array(
    't1' => array('type'=>'Adult',
        'p1'=>'12',
        'p2'=>'18'),
    't2' => array('type'=>'Concession',
        'p1'=>'10',
        'p2'=>'15'),
    't3'=> array('type'=>'Child',
        'p1'=>'8',
        'p2'=>'12'),
    't4'=> array('type'=>'First Class Adult',
        'p1'=>'25',
        'p2'=>'30'),
    't5'=> array('type'=>'First Class Child',
        'p1'=>'20',
        'p2'=>'25'),
    't6'=> array('type'=>'Beanbag',
        'p1'=>'20',
        'p2'=>'30'),
);

class CPriceTable {
    public static function GeneratePriceTable($items) {
        $html = "<table class='price-table'><tr><td><h2>Ticket Type</h2></td><td><h2>Mon - Tue (All Day)<br> Mon - Fri (1pm only)</h2></td><td><h2>Wed - Fri (not 1pm)<br> Sat - Sun (All Day)</h2></td></tr>";
        foreach($items as $item) {
            $html .= "<tr><td><h2>{$item['type']}</h2></td><td><h3>{$item['p1']}</h3></td><td><h3>{$item['p2']}</h3></td>";
        }
        $html .= "</table>\n";
        return $html;
    }
}
?>