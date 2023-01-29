<?php
class Chamber extends DataBase {
    public $id;
    public $type;
    public $suitType;
    public $capacity;
    public $price;
    public $image;
    public function getChambers() {
        $sql = "SELECT * FROM chamber";
        $result = $this->connect()->prepare($sql);
        $result->execute();
        return  $result->fetchAll();
    }
    public function getChamber($id) {
        $sql = "SELECT * FROM chamber WHERE ID = :id ;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();
        $result = $result->fetch();
        $type = explode('/ ', $result['type']);
        $this->id = $result['ID'];
        $this->type = $type[0];
        $this->suitType = (isset($type[1])) ? $type[1] : '';
        $this->capacity = $result['capacity'];
        $this->price = $result['price'];
        $this->image = $result['image'];
    }
    public function updateChamber($id, $type, $capacity, $price, $image) {
        $sql = "UPDATE chamber SET `type` = ? , `capacity` = ? , `price` = ? , `image` = ? , WHERE `chamber`.`ID` = ? ;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam(1, $type);
        $result->bindParam(2, $capacity);
        $result->bindParam(3, $price);
        $result->bindParam(4, $image);
        $result->bindParam(5, $id);
        $result->execute();
    }
    public function updateChamber_no_image($id, $type, $capacity, $price) {
        $sql = "UPDATE chamber SET `type` = ? , `capacity` = ? , `price` = ?  WHERE ID = ? ;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam(1, $type);
        $result->bindParam(2, $capacity);
        $result->bindParam(3, $price);
        $result->bindParam(4, $id);
        $result->execute();
    }
    public function insertChamber($chamberType, $chamberCapacity, $chamberPrice, $chamberImage) {
        $sql = "INSERT INTO chamber(type, capacity, price, image)
                VALUES(? , ?, ?, ?);";
        $result = $this->connect()->prepare($sql);
        $result->bindParam(1, $chamberType);
        $result->bindParam(2, $chamberCapacity);
        $result->bindParam(3, $chamberPrice);
        $result->bindParam(4, $chamberImage);
        $result->execute();
    }
    public function deleteChamber($id) {
        $sql = "DELETE FROM chamber WHERE ID = :id ;";
        $result = $this->connect()->prepare($sql);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();
    }
    public function searchChamber($type, $startDate, $endDate) {
        $sql = "
        SELECT DISTINCT chamber.ID,
                        chamber.type,
                        chamber.capacity,
                        chamber.price,
                        chamber.image,
                        Res.starting,
                        Res.ending
        FROM chamber
        LEFT JOIN reservation Res 
        ON chamber.ID = Res.room 
        AND  (
                    ( Res.starting NOT BETWEEN $startDate AND $endDate )
                AND 
                    ( Res.ending NOT BETWEEN $startDate AND $endDate ) 
        ) 
        WHERE type = $type;
        ";
        $result = $this->connect()->prepare($sql);  
        $result->execute();
        $result = $result->fetchAll();
        return print_r($result);
    }
}
