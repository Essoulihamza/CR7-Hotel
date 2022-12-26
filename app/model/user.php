<?php
class user extends DataBase {
    public function getUser($userName) {
        $sql = "SELECT * FROM user WHERE user_name = '$userName' ;";
        $result = $this->connect()->query($sql);
        return $result->fetch();
    }
}