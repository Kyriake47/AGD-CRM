<?php 
    session_start();
    include("../../../config/connection.php");
    include("../../../classes/Worker.php");

    if (!isset($_SESSION['user_id']) || !isset($_POST['orderId'])) {
        echo json_encode(['type' => 'error', 'toast' => 'Niepełne dane: wymagane jest ID użytkownika i zamówienia.', 'refresh' => false]);
        exit;
    }

    $worker = new Worker($conn);

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
    echo json_encode(['type' =>  $type, 'toast' => $toast, 'refresh' => 'chose-order']);
?>