<?php

class User {
    private $conn, $sqlData;
    public function __construct($conn, $username) {
        $this->conn = $conn;


        $query = $conn->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindValue(":username", $username);

        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getFirstName() {
        return $this->sqlData['firstname'];
    }

    public function getLastName() {
        return $this->sqlData['lastname'];
    }

    public function getEmail() {
        return $this->sqlData['email'];
    }

    public function getIsSubscribed() {
        return $this->sqlData['isSubscribed'];

    }
}

?>