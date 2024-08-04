<?php
class Order {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function addOrder($name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $orderDate, $orderTime, $datesToBookId) {

        // Add order to database
        $stmt = $this->conn->prepare(
            "INSERT INTO orders (name, surname, email, type, model, info, postcode, city, street, home_number, flat_number, phone_number, date, time)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . htmlspecialchars($this->conn->error));
        }

        $stmt->bind_param('ssssssissiiiss', $name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $orderDate, $orderTime);

        if (!$stmt->execute()) {
            throw new Exception("Insert failed: " . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        // Delete an order date from available dates
        $stmt = $this->conn->prepare("DELETE FROM dates_to_book WHERE id = ?");

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . htmlspecialchars($this->conn->error));
        }

        $stmt->bind_param('i', $datesToBookId);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        return true;
    }
}
// if ($stmt->affected_rows > 0) {
?>