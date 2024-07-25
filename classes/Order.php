<?php
class Order {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function addOrder($name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber) {
        $stmt = $this->conn->prepare(
            "INSERT INTO orders (name, surname, email, type, model, info, postcode, city, street, home_number, flat_number, phone_number)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . htmlspecialchars($this->conn->error));
        }

        $stmt->bind_param('ssssssissiii', $name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            throw new Exception("Insert failed: " . htmlspecialchars($stmt->error));
        }
    }
}
?>