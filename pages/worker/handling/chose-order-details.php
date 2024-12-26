<?php 
    session_start();
    include("../../../config/connection.php");
    include("../../../classes/Worker.php");

    $worker = new Worker($conn, $_SESSION['user_id']);

    if (!isset($_SESSION['user_id']) || !isset($_POST['orderId'])) {
        echo json_encode(['type' => 'error', 'toast' => 'Niepełne dane: wymagane jest ID użytkownika i zamówienia.', 'refresh' => false]);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $result = $worker->addWorkerToOrder($_POST['orderId']);

        if ($result) {
            $toast = $worker->showToast('Sukces', 'Zostałeś pomyślnie przypisany do zamówienia.');
            $type = 'ok';
        } else {
            $toast = $worker->showToast('Błąd', $result);
            $type = 'error';
        }

    }
  
    echo json_encode(['type' =>  $type, 'toast' => $toast, 'refresh' => 'chose-order']);
?>