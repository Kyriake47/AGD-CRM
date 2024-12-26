<?php
    include("../../config/connection.php");
    include("../../classes/Order.php");
    session_start();

    $userId = $_SESSION['user_id'];

    $order = new Order($conn);
    $orders = $order->getOrdersGroup(0);

    $orderList = '';
    $i = 1;
    if (!empty($orders)) {
        foreach ($orders as $orderRow) {
            $orderList .= '
                <tr>
                    <th scope="row">' . $i .'</th>
                    <td>' . $orderRow['type'] . '</td>
                     <td>' . $orderRow['city'] . '</td>
                    <td>' . $orderRow['date'] . '</td>
                    <td><button class="button button3 modal-start" data-modal-content="chose-order-details" data-id="' . $orderRow['id'] .'">Szczegóły</button></td>
                </tr>
            ';
            $i++;
        }
    }

?>

<div class="chose-order">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Typ</th>
                <th scope="col">Miejscowość</th>
                <th scope="col">Data</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php echo $orderList; ?>
        </tbody>
    </table>
</div>