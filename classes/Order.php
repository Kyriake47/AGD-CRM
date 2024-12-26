<?php
    include(__DIR__ . "/../traits/NotificationTrait.php");
    include("DatabaseHandler.php");

    class Order extends DatabaseHandler {
        use NotificationTrait;

        private $id;
        private $clientId;
        private $name;
        private $surname;
        private $street;
        private $homeNumber;
        private $flatNumber;
        private $city;
        private $postcode;
        private $phoneNumber;
        private $email;
        private $type;
        private $model;
        private $info;
        private $date;
        private $time;
        private $workerId;
        private $status;
        private $note = '';


        public function __construct($dbConnection, $order_id = null) {
            parent::__construct($dbConnection);
            if ($order_id != null) {
                $this->id = $order_id;
                $this->loadOrderFromDatabase();
            }
        }

        private function loadOrderFromDatabase() {
            $query = "SELECT * FROM orders WHERE id = ?";
            $result = $this->fetchResults($query, 'i', [$this->id]);
            if (count($result) > 0) {
                $order = $result[0];
                $this->clientId = $order['client_id'];
                $this->name = $order['name'];
                $this->surname = $order['surname'];
                $this->street = $order['street'];
                $this->homeNumber = $order['home_number'];
                $this->flatNumber = $order['flat_number'];
                $this->city = $order['city'];
                $this->postcode = $order['postcode'];
                $this->phoneNumber = $order['phone_number'];
                $this->email = $order['email'];
                $this->type = $order['type'];
                $this->model = $order['model'];
                $this->info = $order['info'];
                $this->date = $order['date'];
                $this->time = $order['time'];
                $this->workerId = $order['worker_id'];
                $this->status = $order['status'];
            }

            $queryNote = "SELECT content FROM orders_notes WHERE order_id = ?";
            $resultNote = $this->fetchResults($queryNote, 'i', [$this->id]);
            if (count($resultNote) > 0) {
                $noteContent = $resultNote[0];
                $this->note = $noteContent['content'];
            }
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

        public function updateOrder(array $fields)
        {
            $setClause = [];
            $params = [];
            $paramTypes = '';

            foreach ($fields as $column => $value) {
                $setClause[] = "$column = ?";
                $params[] = $value;
                $paramTypes .= is_int($value) ? 'i' : 's';
            }

            $params[] = $this->id;
            $paramTypes .= 'i';

            $query = "UPDATE orders SET " . implode(', ', $setClause) . " WHERE id = ?";

            return $this->executeQuery($query, $paramTypes, $params);
        }

        public function addNote($noteContent) {
            $queryCheckNote = "SELECT * FROM orders_notes WHERE order_id = ?";
            $resultCheckNote = $this->fetchResults($queryCheckNote, 'i', [$this->id]);

            if (count($resultCheckNote) == 0) {
                $query =  "INSERT INTO orders_notes (order_id, content) VALUES (?, ?)";
                $paramTypes = 'is';
                $params = [$this->id, $noteContent];
                $result = $this->executeQuery($query, $paramTypes, $params);
            }
            else {
                $query = "UPDATE orders_notes SET content = ? WHERE order_id = ?";
                $paramTypes = 'si';
                $params = [$noteContent, $this->id];
                $result = $this->executeQuery($query, $paramTypes, $params);
            }
            return $result;
        }

        // Gettery
        public function getClientId() { return $this->clientId; }
        public function getName() { return $this->name; }
        public function getSurname() { return $this->surname; }
        public function getStreet() { return $this->street; }
        public function getHomeNumber() { return $this->homeNumber; }
        public function getFlatNumber() { return $this->flatNumber; }
        public function getCity() { return $this->city; }
        public function getPostcode() { return $this->postcode; }
        public function getPhoneNumber() { return $this->phoneNumber; }
        public function getEmail() { return $this->email; }
        public function getType() { return $this->type; }
        public function getModel() { return $this->model; }
        public function getInfo() { return $this->info; }
        public function getDate() { return $this->date; }
        public function getTime() { return $this->time; }
        public function getWorkerId() { return $this->workerId; }
        public function getStatus() { return $this->status; }
        public function getNote() { return $this->note; }

    }
?>
