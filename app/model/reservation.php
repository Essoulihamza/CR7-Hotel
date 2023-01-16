<?php
class Reservation extends DataBase {
    public function addReservation($userId, $roomId, $startingDate, $endingDate) {
        $sql = "INSERT INTO reservation(`user id`,`room id`,`starting date`,`ending date`)
                VALUES(?, ?, ?, ?);";
        $result = $this->connect()->prepare($sql);
        $result->bindParam(1, $userId );
        $result->bindParam(2, $roomId );
        $result->bindParam(3, $startingDate );
        $result->bindParam(4, $endingDate );
        $result->execute();
    }
    public function getUserReservations($userId) {
        $sql = "SELECT * FROM reservation WHERE `user id` = :userId;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam('userId', $userId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll();
    }
    public function getUserReservation($userId, $roomId) {
        $sql = "SELECT * FROM reservation WHERE `user id` = :userId AND `room id` = :roomId;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam('userId', $userId, PDO::PARAM_INT);
        $result->bindParam('roomId', $roomId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

}