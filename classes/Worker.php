<?php
    include(__DIR__ . "/../traits/NotificationTrait.php");
    include("DatabaseHandler.php");

    class Worker extends DatabaseHandler {
        use NotificationTrait;

        private $id;
        private $name;
        private $surname;
        private $login;
        private $email;
        private const DEFAULT_PERMISSION = 2;

        public function __construct($dbConnection, $id)
        {
            parent::__construct($dbConnection);

            $query = "SELECT name, surname, login, email FROM users WHERE id = ?";
            $result = $this->fetchResults($query, 'i', [$id]);
            $this->id = $id;
            if (count($result) > 0) {
                $worker = $result[0];
                $this->name = $worker['name'];
                $this->surname = $worker['surname'];
                $this->login = $worker['login'];
                $this->email = $worker['email'];
            }
        }

        private function validateFields($fields = [], $workerId = null, $orderId = null) {
            $errors = [];

            if (in_array('worker_id', $fields)) {
                if (!is_numeric($workerId) || (int)$workerId <= 0) {
                    $errors[] = "Nieprawidłowe ID pracownika.";
                }
            }
        
            if (in_array('order_id', $fields)) {
                if (!is_numeric($orderId) || (int)$orderId <= 0) {
                    $errors[] = "Nieprawidłowe ID zamówienia.";
                }
            }

            if (in_array('name', $fields)) {
                if (empty($this->name) || strlen($this->name) < 2) {
                    $errors[] = "Imię musi mieć co najmniej 2 znaki.";
                }
            }

            if (in_array('surname', $fields)) {
                if (empty($this->surname) || strlen($this->surname) < 2) {
                    $errors[] = "Nazwisko musi mieć co najmniej 2 znaki.";
                }
            }

            if (in_array('login', $fields)) {
                if (empty($this->login) || strlen($this->login) < 3) {
                    $errors[] = "Login musi mieć co najmniej 3 znaki.";
                }
            }

            if (in_array('email', $fields)) {
                if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Nieprawidłowy format adresu e-mail.";
                }
            }

            if (in_array('password', $fields)) {
                if (empty($this->password)) {
                    $errors[] = "Hasło nie może być puste.";
                } elseif (strlen($this->password) < 8) {
                    $errors[] = "Hasło musi mieć co najmniej 8 znaków.";
                } elseif (!preg_match('/[A-Z]/', $this->password)) {
                    $errors[] = "Hasło musi zawierać przynajmniej jedną dużą literę.";
                } elseif (!preg_match('/[a-z]/', $this->password)) {
                    $errors[] = "Hasło musi zawierać przynajmniej jedną małą literę.";
                } elseif (!preg_match('/[0-9]/', $this->password)) {
                    $errors[] = "Hasło musi zawierać przynajmniej jedną cyfrę.";
                } elseif (!preg_match('/[\W]/', $this->password)) {
                    $errors[] = "Hasło musi zawierać przynajmniej jeden znak specjalny.";
                }
            }

            return $errors;
        }

        public function addWorkerToOrder($orderId)
        {

            $validationErrors = $this->validateFields(['worker_id', 'order_id'], $this->id, $orderId);
    
            if (!empty($validationErrors)) {
                return implode(' ', $validationErrors);
            }

            $query = "UPDATE orders SET worker_id = ? WHERE id = ?";
            $params = [$this->id, $orderId];
            $result = $this->executeQuery($query, 'ii', $params);
        
            return $result ? true : false;
        }

        public function getWorkerOrders() 
        {
            $query = "SELECT * FROM orders WHERE worker_id = ?";
            $result = $this->fetchResults($query, 'i', [$this->id]);
            return $result;
        }

    }
?>