<?php
    class Order {
        private $conn;

        public function __construct($dbConnection) {
            $this->conn = $dbConnection;
        }

        public function updateInfo($name, $surname, $email, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $user_id = false) {

        if ($user_id == false) $user_id = $_SESSION['user_id'];
        $stmt = $this->conn->prepare(
            "UPDATE users 
            SET name = ?, surname = ?
            WHERE id = ?"
        );

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . htmlspecialchars($this->conn->error));
        }

        $stmt->bind_param('ssi', $name, $surname, $user_id);

        if (!$stmt->execute()) {
            throw new Exception("Insert failed: " . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        }
    }
?>