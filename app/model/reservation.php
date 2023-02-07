<?php
class Reservation extends DataBase {
    public function addReservation($userId, $roomId, $startingDate, $endingDate, $guest) {
        $sql = "INSERT INTO reservation(`user`,`room`, `guest`,`start_date`,`ending_date`)
                VALUES(?, ?, ?, ?, ?);";
        $result = $this->connect()->prepare($sql);
        $result->bindParam(1, $userId );
        $result->bindParam(2, $roomId );
        $result->bindParam(3, $guest );
        $result->bindParam(4, $startingDate );
        $result->bindParam(5, $endingDate );
        $result->execute();
    }
    public function getUserReservations($userId) {
        $sql = "SELECT * FROM reservation 
                LEFT JOIN  chamber 
                ON  chamber.ID = reservation.room
                WHERE `user` = :userId;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam('userId', $userId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll();
    }
    public function getUserReservation($userId, $roomId) {
        $sql = "SELECT * FROM reservation WHERE `user id` = :userId AND `room id` = :roomId ;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam('userId', $userId, PDO::PARAM_INT);
        $result->bindParam('roomId', $roomId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    public function deleteReservation($id) {
        $sql = "DELETE FROM reservation WHERE `Id` = :id ;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam('id', $id);
        $result->execute();
    }

}