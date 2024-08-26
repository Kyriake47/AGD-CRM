<?php
include(__DIR__ . "/../traits/NotificationTrait.php");
include("DatabaseHandler.php");

class Client extends DatabaseHandler {
    use NotificationTrait;

    public function __construct($dbConnection) {
        parent::__construct($dbConnection);
    }

    public function getInfo($userId) {
        $query = "SELECT * FROM users  LEFT JOIN clients_data  ON users.id = clients_data.user_id WHERE user_id = ?";
        $result = $this->fetchResults($query, 'i', [$userId]);

        // The result is always one line
        $row = $result[0];

        foreach ($row as $key => $value) {
            if (empty($value)) {
                $row[$key] = '';
            }
        }

        return $row;
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
