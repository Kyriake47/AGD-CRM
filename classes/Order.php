<?php
    include(__DIR__ . "/../traits/NotificationTrait.php");
    include("DatabaseHandler.php");

    class Order extends DatabaseHandler {
        use NotificationTrait;

        public function __construct($dbConnection) {
            parent::__construct($dbConnection);
        }

        public function addOrder($clientId, $name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $orderDate, $orderTime, $datesToBookId) {

            $this->executeQuery(
                "INSERT INTO orders (client_id, name, surname, email, type, model, info, postcode, city, street, home_number, flat_number, phone_number, date, time)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                'issssssissiiiss',
                [$clientId, $name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $orderDate, $orderTime]
            );

            $this->executeQuery(
                "DELETE FROM dates_to_book WHERE id = ?",
                'i',
                [$datesToBookId]
            );

        }

        public function getOrderInfo($orderId) {

            $query = "SELECT * FROM orders WHERE id = ? LIMIT 1";
            $result = $this->fetchResults($query, 'i', [$orderId]);

            // The result is always one line
            $row = $result[0];

            foreach ($row as $key => $value) {
                if (empty($value)) {
                    $row[$key] = '';
                }
            }

            return $row;
        
        }

        //status 0 waiting
        //status 1 fixed
        public function getOrdersGroup($status) {

            $query = "SELECT * FROM orders WHERE status = ? AND worker_id IS NULL ";
            $result = $this->fetchResults($query, 'i', [$status]);

            foreach ($result as &$row) {
                foreach ($row as $key => $value) {
                    if (empty($value)) {
                        $row[$key] = '';
                    }
                }
            }
            
            return $result;
        
        }

        public function updateOrder($orderId, array $fields)
        {
            $setClause = [];
            $params = [];
            $paramTypes = '';

            foreach ($fields as $column => $value) {
                $setClause[] = "$column = ?";
                $params[] = $value;
                $paramTypes .= is_int($value) ? 'i' : 's';
            }

            $params[] = $orderId;
            $paramTypes .= 'i';

            $query = "UPDATE orders SET " . implode(', ', $setClause) . " WHERE id = ?";

            return $this->executeQuery($query, $paramTypes, $params);
        }

    }
?>
