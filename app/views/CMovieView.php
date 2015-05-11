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
$movies = array(
    'm1' => array('title' => 'the dark knight rises',
        'org' => 'http://www.thedarkknightrises.com/',
        'src' => 'tdk.jpg',
        'cls' => 'm',
        'drt' => 'Christopher Nolan',
        'cast' => 'Christian Bale, Tom Hardy',
        'desc' => 'Eight years after the Joker\'s reign of anarchy, the Dark Knight is forced to return from his imposed exile to save Gotham City from the brutal guerrilla terrorist Bane with the help of the enigmatic Catwoman.'),
    'm2' => array('title' => 'big hero 6',
        'org' => 'http://movies.disney.com.au/big-hero-6',
        'src' => 'big-hero-6.jpg',
        'cls' => 'pg',
        'drt' => 'Don Hall, Chris Williams',
        'cast' => 'Ryan Potter, Scott Adsit, Jamie Chung',
        'desc' => 'The special bond that develops between plus-sized inflatable robot Baymax, and prodigy Hiro Hamada, who team up with a group of friends to form a band of high-tech heroes.'),
    'm3' => array('title' => '3 idiots',
        'org' => 'https://www.facebook.com/3idiotsthefilm',
        'src' => '3idiot.jpg',
        'cls' => 'm',
        'drt' => 'Rajkumar Hirani',
        'cast' => 'Aamir Khan, Madhavan, Mona Singh',
        'desc' => 'Two friends are searching for their long lost companion. They revisit their college days and recall the memories of their friend who inspired them to think differently, even as the rest of the world called them "idiots"'),
    'm4' => array('title' => 'begin again',
        'org' => 'http://beginagainfilm.com/',
        'src' => 'begin-gain.jpg',
        'cls' => 'm',
        'drt' => 'John Carney',
        'cast' => 'Keira Knightley, Mark Ruffalo',
        'desc' => 'A chance encounter between a disgraced music-business executive and a young singer-songwriter new to Manhattan turns into a promising collaboration between the two talents.')
);

class CMovieView
{
    public static function GenerateMovieView($items)
    {
        $html = "";
        foreach ($items as $item) {
            $html .=
                "<div class='inline-column'><img class='banner' src='app/views/img/{$item['src']}'>
            <!-- Original image below sourced for educational purposes: {$item['org']} -->
<h1>{$item['title']}</h1>
<table class='movie-table'>
<tr>
<td>
<h2>Classification</h2>
</td>
<td>
<img class='classify' src='app/views/img/classification/{$item['cls']}.png'>
<!-- Original image below sourced for educational purposes: http://www.classification.gov.au/ -->
</td>
</tr>
<tr>
<td>
<h2>Director</h2>
</td>
<td>
<h3>{$item['drt']}</h3>
</td>
</tr>
<tr>
<td>
<h2>Cast</h2>
</td>
<td>
<h3>{$item['cast']}</h3>
</td>
</tr>
<tr>
<td>
<h2>Booking</h2>
</td>
<td>
<h3><a class='book-button' href='booking.php' target='popup' onclick='window.open(this.href,'Online Booking','resizable=0, width=640, height=720'); return false;'>Go Online Booking Now</a></h3>
</td>
</tr>
<tr class='story'>
<td>
<h2>Story</h2>
</td>
<td>
<h3>{$item['desc']}</h3>
</td>
</tr>
</table>
</div>";
        }
        return $html;
    }
}