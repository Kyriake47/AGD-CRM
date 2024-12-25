<?php 
    session_start();
    include("../../../config/connection.php");
   
    $windowType = $_POST['windowType'];
   
    if ($windowType == 1) {
        include("../../../classes/Worker.php");
        $worker = new Worker($conn);
        if (!isset($_SESSION['user_id']) || !isset($_POST['orderId'])) {
            echo json_encode(['type' => 'error', 'toast' => 'Niepełne dane: wymagane jest ID użytkownika i zamówienia.', 'refresh' => false]);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $result = $worker->addWorkerToOrder($_SESSION['user_id'], $_POST['orderId']);

            if ($result) {
                $toast = $worker->showToast('Sukces', 'Pracownik został pomyślnie przypisany do zamówienia.');
                $type = 'ok';
            } else {
                $toast = $worker->showToast('Błąd', $result);
                $type = 'error';
            }
    
        }
    }
    else {
        include("../../../classes/Order.php");
        $order = new Order($conn);
        if (!isset($_POST['orderStatus']) && !isset($_POST['myNotes'])) {
            echo json_encode(['type' => 'error', 'toast' => 'Uzupełnij status zamówienia lub notatkę.', 'refresh' => false]);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $fields = [
                'status' => $_POST['orderStatus']
            ];
            $result = $order->updateOrder($_POST['orderId'], $fields);

            if ($result) {
                $toast = $order->showToast('Sukces', 'Zapisano.');
                $type = 'ok';
            } else {
                $toast = $order->showToast('Błąd', $result);
                $type = 'error';
            }
    
        }
    }
    echo json_encode(['type' =>  $type, 'toast' => $toast, 'refresh' => 'chose-order']);
?>