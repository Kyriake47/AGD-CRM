<?php
include(__DIR__ . "/../traits/NotificationTrait.php");
include("DatabaseHandler.php");

class Order extends DatabaseHandler {
    use NotificationTrait;

    public function __construct($dbConnection) {
        parent::__construct($dbConnection);
    }

    public function addOrder($name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $orderDate, $orderTime, $datesToBookId) {

        $this->executeQuery(
            "INSERT INTO orders (name, surname, email, type, model, info, postcode, city, street, home_number, flat_number, phone_number, date, time)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            'ssssssissiiiss',
            [$name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $orderDate, $orderTime]
        );

        $this->executeQuery(
           "DELETE FROM dates_to_book WHERE id = ?",
           'i',
           [$datesToBookId]
        );
    }
}
?>
