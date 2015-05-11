<?php
/**
 * Created by PhpStorm.
 * User: leeshihping
 * Date: 2015/4/28
 * Time: 下午3:17
 */
/*
    <div class="right">
        <img class="banner" src="app/views/img/dolbycinema-header.png">
        <!-- Original image below sourced for educational purposes: www.dolby.com -->
        <h1>Dolby Surrounding/h1>
        <p>You feel like you're inside the story as sound flows all around you with breathtaking realism to create a powerfully moving experience.</p>
        <p class="copyright">© 2015 Dolby Laboratories, Inc. All rights reserved.</p>
    </div>
 */

$ads = array(
    'a1' => array('title'=>'Dolby Surrounding',
        'org'=>'http://www.dolby.com',
        'src'=>'dolbycinema-header.png',
        'desc'=>'You feel like you are inside the story as sound flows all around you with breathtaking realism to create a powerfully moving experience.',
        'cr'=>'© 2015 Dolby Laboratories, Inc. All rights reserved.')
);

class CAdColumn {
    public static function GenerateAdColumn($items) {
        $html = "<div class='right'>";
        foreach($items as $item) {
            $html .= "
            <img class='banner' src='app/views/img/{$item['src']}'>
            <!-- Original image below sourced for educational purposes: {$item['org']} -->
            <h1>{$item['title']}</h1>
            <p>{$item['desc']}</p>
            <p class='copyright'>{$item['cr']}</p>
       ";
        }
        $html .= "</div>\n";
        return $html;
    }
}
?>