<?php 
    include("../../../config/connection.php");
    include("../../../classes/Order.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Odczytaj dane z formularza
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $type = $_POST['type'];
            $model = $_POST['model'];
            $info = $_POST['info'];
            $postcode = $_POST['postcode'];
            $city = $_POST['city'];
            $street = $_POST['street'];
            $homeNumber = $_POST['homeNumber'];
            $flatNumber = $_POST['flatNumber'];
            $phoneNumber = $_POST['phoneNumber'];
            $orderDate =  $_POST['orderDate'];
            $orderTime =  $_POST['orderTime'];
            $datesToBookId =  $_POST['datesToBookId'];
    
            // Walidacja danych (opcjonalnie)
            if (empty($name) || empty($email) || empty($type) || empty($model)) {
                
                echo 'Wszystkie pola muszą być wypełnione.';
                //http_response_code(400);
                exit;
            }
    
            // Stwórz obiekt Order
            $order = new Order($conn);
    
            // Dodaj zamówienie
            if ($order->addOrder($name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $orderDate, $orderTime, $datesToBookId)) {
                //http_response_code(200);
                echo 'Zgłoszenie zostało pomyślnie wysłane.';
            }
        } catch (Exception $e) {
            //http_response_code(500);
            echo "Error:123 " . $e->getMessage();
        }
    } else {
        //http_response_code(405); // Metoda niedozwolona
        echo 'Metoda niedozwolona.';
    }
    ?>