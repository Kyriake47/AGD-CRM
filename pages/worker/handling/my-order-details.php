<?php 
    session_start();
    include("../../../config/connection.php");
    include("../../../classes/Order.php");

    if (!isset($_POST['orderStatus']) && !isset($_POST['noteContent'])) {
        echo json_encode(['type' => 'error', 'toast' => 'Uzupełnij status zamówienia lub notatkę.', 'refresh' => false]);
        exit;
    }

    $order = new Order($conn, $_POST['orderId']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $fields = [
            'status' => $_POST['orderStatus']
        ];
        $result1 = $order->updateOrder($fields);

        $result2 = $order->addNote($_POST['noteContent']);

        if ($result1 && $result2) {
            $toast = $order->showToast('Sukces', 'Zapisano.');
            $type = 'ok';
        } else {
            if (!$result1) {
                $error = 'Błąd podczas aktualizacji statusu.';
            } elseif (!$result2) {
                $error = 'Błąd podczas dodawania notatki.';
            }
            $toast = $order->showToast('Błąd', $error);
            $type = 'error';
        }

    }
    
    echo json_encode(['type' =>  $type, 'toast' => $toast, 'refresh' => 'chose-order']);
?>