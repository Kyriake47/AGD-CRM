<?php
include(__DIR__ . "/../traits/NotificationTrait.php");
include("DatabaseHandler.php");

class Client extends DatabaseHandler {
    use NotificationTrait;

    public function __construct($dbConnection) {
        parent::__construct($dbConnection);
    }

    public function getInfo($userId) {
        $query = "SELECT * FROM clients_data WHERE user_id = ?";
        $result = $this->fetchResults($query, 'i', [$userId]);
        return $result;
    }

    public function updateInfo($name, $surname, $email, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $user_id) {

        // Update users
        $this->executeQuery(
            "UPDATE users SET name = ?, surname = ? WHERE id = ?",
            'ssi',
            [$name, $surname, $user_id]
        );

        // Update clients_data
        $this->executeQuery(
            "UPDATE clients_data 
            SET street = ?, home_number = ?, flat_number = ?, postcode = ?, city = ?, phone_number = ?, email = ?
            WHERE user_id = ?",
            'siissssi',
            [$street, $homeNumber, $flatNumber, $postcode, $city, $phoneNumber, $email, $user_id]
        );
    }
}
?>
