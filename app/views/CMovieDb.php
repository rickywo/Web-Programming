<?php
/**
 * Created by PhpStorm.
 * User: leeshihping
 * Date: 2015/5/12
 * Time: 下午9:44
 */
include("CDbConnect.php");
class CMovieDb {
    protected $db;
    public function _construct() {
        $db = new CDbConnect('app/views/db/theatre.db');
    }
    public function getMovieInfoByType($type) {
        $query = 'SELECT title, poster, trailer, rating, summary FROM movie WHERE id=(SELECT id FROM movie_session WHERE type = {$type})';
        $sth = $this->db->connection->prepare($query);
        $sth->execute();
        return $sth->fetchAll();
    }
}