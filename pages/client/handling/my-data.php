<?php 
    session_start();
    include("../../../config/connection.php");
    include("../../../classes/Client.php");

    $client = new Client($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $client->updateInfo($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['postcode'], $_POST['city'], $_POST['street'],  $_POST['homeNumber'], $_POST['flatNumber'], $_POST['phoneNumber'], $_SESSION['user_id']);
        
        $toast = $client->showToast('Udało się!', 'Dane zostały zmienione.');
        $type = 'ok';
  
    }
    echo json_encode(['type' =>  $type, 'toast' => $toast, 'refresh' => 'my-data']);
?>