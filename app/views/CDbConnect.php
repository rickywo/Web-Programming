<?php
/**
 * Created by PhpStorm.
 * User: leeshihping
 * Date: 2015/5/12
 * Time: 下午9:42
 */

class CDbConnect {
    private $connection;
    public function __construct($dbpath) {
        // create a connection to the SQLite DB file using PDO
        $this->connection = new PDO('sqlite:' . $dbpath);
        // throw exceptions when there is an error
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // return db rows as objects
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function getMovieInfoByType($type) {
        $query = 'SELECT title, poster, trailer, rating, summary FROM movie WHERE id=(SELECT id FROM movie_session WHERE type = "'.$type.'")';
        $sth = $this->connection->prepare($query);
        $sth->execute();
        return json_encode((array)$sth->fetchAll());
    }

    public function getMovieInfoByTitle($title) {
        $query = 'SELECT title, poster, trailer, rating, summary FROM movie WHERE title = "'.$title.'"';
        $sth = $this->connection->prepare($query);
        $sth->execute();
        return json_encode((array)$sth->fetchAll());
    }

    public function getSeesionTimeByTitle($title) {
        $query = 'SELECT Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday FROM sessions WHERE id=(SELECT id FROM movie WHERE title = "'.$title.'")';
        $sth = $this->connection->prepare($query);
        $sth->execute();
        return json_encode((array)$sth->fetchAll());
    }

    public function getAllMovieInfo() {
        $query = 'SELECT title, poster, trailer, rating, summary FROM movie';
        $sth = $this->connection->prepare($query);
        $sth->execute();
        return json_encode((array)$sth->fetchAll());
    }

    public function saveReservation($mail, $code, $data) {
        $query = 'INSERT INTO reservation(email, code, info) values(\''.$mail.'\', \''.$code.'\', \''.$data.'\')';
        $sth = $this->connection->prepare($query);
        return $sth->execute();
    }

    public function getReservation($mail, $code) {
        $query = 'SELECT info FROM reservation WHERE email="'.$mail.'" AND code="'.$code.'"';
        $sth = $this->connection->prepare($query);
        $sth->execute();
        return json_encode((array)$sth->fetchAll());
    }

    function __destruct() {
        // close db
        $connection = null;
    }
}