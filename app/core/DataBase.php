<?php
class DataBase {
    private $host = "localhost";
    private $user = "root";
    private $password = "password";
    private $dataBaseName = "hotel";

    protected function connect() {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dataBaseName;
        $pdo = new PDO($dsn, $this->user, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}