<?php
    include("../../config/connection.php");
    include("../../classes/Client.php");
    session_start();

    $userId = $_SESSION['user_id'];

    $client = new Client($conn);
    $orderHistory = $client->getClientOrders($userId);

    
    $orderHistoryList = '';
    $i = 1;
    if (!empty($orderHistory)) {
        foreach ($orderHistory as $order) {
            $orderHistoryList .= '
                <tr>
                    <th scope="row">' . $i .'</th>
                    <td>' . $order['type'] . '</td>
                    <td>' . $order['date'] . '</td>
                    <td><button class="button button3 modal-start" data-modal-content="order-details" data-id="' . $order['id'] .'">Szczegóły</button></td>
                    <td>' . $order['status'] . '</td>
                </tr>
            ';
            $i++;
        }
    }

?>

<div class="order-history">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Typ</th>
                <th scope="col">Data</th>
                <th scope="col"></th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $orderHistoryList; ?>
        </tbody>
    </table>
</div>