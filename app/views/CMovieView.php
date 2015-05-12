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

$jsonData = '{
  "AC": {
    "title": "the dark knight rises",
    "poster": "tdk.jpg",
    "trailer": "//titan.csit.rmit.edu.au/~e54061/wp/movie-service/FO.mp4",
    "rating": "m",
    "summary": "Every War is Personal",
    "description": [
      "Eight years after the Joker\'s reign of anarchy, the Dark Knight is forced to return from his imposed exile to save Gotham City from the brutal guerrilla terrorist Bane with the help of the enigmatic Catwoman.",
      "A teenage girl is kidnapped by the child trafficking mafia and smuggled outside the city. Shivani embarks on an obsessive hunt for the girl and what follows is a cat and mouse game between a fearless cop and a ruthless mafia kingpin.",
      "Starring Rani Mukerji in the lead, playing the role of a cop for the first time, this raw and gritty film will be a distinct departure from Pradeep Sarkar’s style of filmmaking."
    ],
    "sessions": {
      "Wednesday": "9pm",
      "Thursday": "9pm",
      "Friday": "9pm",
      "Saturday": "9pm",
      "Sunday": "9pm"
    }
  },
  "CH": {
    "title": "big hero 6",
    "poster": "big-hero-6.jpg",
    "trailer": "//titan.csit.rmit.edu.au/~e54061/wp/movie-service/CH.mp4",
    "rating": "pg",
    "summary": "Cars with Wings",
    "description": [
    "The special bond that develops between plus-sized inflatable robot Baymax, and prodigy Hiro Hamada, who team up with a group of friends to form a band of high-tech heroes.",
    "Dusty joins forces with veteran fire and rescue helicopter Blade Ranger and his courageous team, including spirited super scooper Dipper (voice of Julie Bowen), heavy-lift helicopter Windlifter, ex-military transport Cabbie and a lively bunch of brave all-terrain vehicles known as The Smokejumpers. Together, the fearless team battles a massive wildfire and Dusty learns what it takes to become a true hero."
],
    "sessions": {
    "Monday": "1pm",
      "Tuesday": "1pm",
      "Wednesday": "6pm",
      "Thursday": "6pm",
      "Friday": "6pm",
      "Saturday": "12pm",
      "Sunday": "12pm"
    }
  },
  "RC": {
    "title": "begin again",
    "poster": "begin-gain.jpg",
    "trailer": "//titan.csit.rmit.edu.au/~e54061/wp/movie-service/RC.mp4",
    "rating": "m",
    "summary": "Always a Princess",
    "description": [
        "A chance encounter between a disgraced music-business executive and a young singer-songwriter new to Manhattan turns into a promising collaboration between the two talents.",
        "Several years later, the one she thought would be right turns out to be a bad person (nooooo!). Quite by chance she meets the other guy who is now a successful mobile app developer and perhaps now worthy of her parents’ approval. Although it takes her the rest of the movie, the princess dumps the bad one, goes out with the good one and finds true happiness. Until the sequel due out next year (fingers crossed)."
    ],
    "sessions": {
        "Monday": "9pm",
      "Tuesday": "9pm",
      "Wednesday": "1pm",
      "Thursday": "1pm",
      "Friday": "1pm",
      "Saturday": "6pm",
      "Sunday": "6pm"
    }
  },
  "FO": {
    "title": "3 idiots",
    "poster": "3idiot.jpg",
    "trailer": "//titan.csit.rmit.edu.au/~e54061/wp/movie-service/AC.mp4",
    "rating": "m",
    "summary": "Not the Avengers",
    "description": [
        "Two friends are searching for their long lost companion. They revisit their college days and recall the memories of their friend who inspired them to think differently, even as the rest of the world called them \"idiots\"",
        "An action-packed, epic space adventure, where brash adventurer Peter Quill finds himself the object of an unrelenting bounty hunt after stealing a mysterious orb coveted by Ronan, a powerful villain with ambitions that threaten the entire universe, taking over from Loki whilst he is off on vacation too.",
        "To evade the ever-persistent Ronan, Quill is forced into an uneasy truce with a quartet of disparate misfits - Rocket, a gun-toting raccoon, Groot, a tree-like humanoid, the deadly and enigmatic Gamora and the revenge-driven Drax the Destroyer. But when Quill discovers the true power of the orb and the menace it poses to the cosmos, he must do his best to rally his ragtag rivals for a last, desperate stand with the galaxy’s fate in the balance whilst waiting for a postcard from his Avenger pals that never comes ..."
    ],
    "sessions": {
        "Monday": "6pm",
      "Tuesday": "6pm",
      "Saturday": "3pm",
      "Sunday": "3pm"
    }
  }
}';
$movies = json_decode($jsonData, true);

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
<h3><a class='book-button' href='booking.php' target='popup' onclick='window.open(this.href,'Online Booking','resizable=0, width=640, height=720'); return false;'>Go Online Booking Now</a></h3>
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
}