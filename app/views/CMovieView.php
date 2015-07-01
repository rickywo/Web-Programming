<?php
/**
 * Created by PhpStorm.
 * User: leeshihping
 * Date: 2015/4/28
 * Time: 下午2:09
 *
 *
 *
 * <div class="inline-column">
 * <img class="banner" src="img/tdk.jpg">
 * <!-- Original image below sourced for educational purposes: http://www.thedarkknightrises.com/ -->
 * <h1>the dark knight rises</h1>
 * <table class="movie-table">
 * <tr>
 * <td>
 * <h2>Classification</h2>
 * </td>
 * <td>
 * <img class="classify"src="img/classification/m.png">
 * <!-- Original image below sourced for educational purposes: http://www.classification.gov.au/ -->
 * </td>
 * </tr>
 * <tr>
 * <td>
 * <h2>Director</h2>
 * </td>
 * <td>
 * <h3>Christopher Nolan</h3>
 * </td>
 * </tr>
 * <tr>
 * <td>
 * <h2>Cast</h2>
 * </td>
 * <td>
 * <h3>Christian Bale, Tom Hardy</h3>
 * </td>
 * </tr>
 * <tr>
 * <td>
 * <h2>Session times</h2>
 * </td>
 * <td>
 * <h3>Mon/Tue, -</h3>
 * <h3>Wed/Thu/Fri, 9pm</h3>
 * <h3>Sat/Sun, 9pm</h3>
 * <h3><a class="book-button" href="booking.html" target="popup" onclick="window.open(this.href,'Online Booking','resizable=0, width=640, height=720'); return false;">Go Online Booking Now</a></h3>
 * </td>
 * </tr>
 * <tr class="story">
 * <td>
 * <h2>Story</h2>
 * </td>
 * <td>
 * <h3>Eight years after the Joker's reign of anarchy, the Dark Knight is forced to return from his imposed exile to save Gotham City from the brutal guerrilla terrorist Bane with the help of the enigmatic Catwoman.</h3>
 * </td>
 * </tr>
 * </table>
 * </div>
 *
 */
//$movies = json_decode($jsonData, true);


class CMovieView
{
    public static function GenerateMovieView($items)
    {
        $html = "";
        foreach ($items as $item) {
            $html .=
                "<div class='inline-column'><img class='banner' src='app/views/img/{$item['poster']}'>
            <!-- Original image below sourced for educational purposes: -->
<h1>{$item['title']}</h1>
<table class='movie-table'>
<tr>
<td>
<h2>Classification</h2>
</td>
<td>
<img class='classify' src='app/views/img/classification/{$item['rating']}.png'>
<!-- Original image below sourced for educational purposes: http://www.classification.gov.au/ -->
</td>
</tr>
<tr>
<td>
<h2>Booking</h2>
</td>
<td>
<h3><a class='book-button' href='booking.php?mvtitle={$item['title']}'>Go Online Booking Now</a></h3>
</td>
</tr>
<tr class='story'>
<td>
<h2>Story</h2>
</td>
<td>
<h3>{$item['summary']}</h3>
</td>
</tr>
</table>
</div>";
        }
        return $html;
    }
    public static function GenerateSingleMovieView($mvobj)
    {
        $html = "";

        $html .=
            "<div class='inline-column'><img class='banner' src='app/views/img/{$mvobj['poster']}'>
        <!-- Original image below sourced for educational purposes: -->
            <h1>{$mvobj['title']}</h1>
            </div>";

        return $html;
    }
}