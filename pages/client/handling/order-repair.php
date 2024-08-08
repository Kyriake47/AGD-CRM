<?php 
    include("../../../config/connection.php");
    include("../../../classes/Order.php");

    $order = new Order($conn);
    $type = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
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

            if (empty($name) || empty($email) || empty($type) || empty($model)) {
                $toast = $order->showToast('Błąd', 'Wszystkie pola muszą być wypełnione.');
                $type = 'error';
                //http_response_code(400);
            } else {
                $order->addOrder($name, $surname, $email, $type, $model, $info, $postcode, $city, $street, $homeNumber, $flatNumber, $phoneNumber, $orderDate, $orderTime, $datesToBookId);
                $toast = $order->showToast('Udało się!', 'Zamówienie zostało dodane pomyślnie.');
                $type = 'ok';
            }
        } catch (Exception $e) {
            $toast = $order->showToast('Błąd', 'Error:123 ' . $e->getMessage());
            $type = 'error';
            //http_response_code(500);
        }
    } else {
        $toast = $order->showToast('Błąd', 'Metoda niedozwolona.');
        $type = 'error';
        //http_response_code(405);
    }
    echo json_encode(['type' =>  $type, 'toast' => $toast, 'refresh' => 'repair-dates']);
?>