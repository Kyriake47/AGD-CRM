<?php
    include("../../config/connection.php");
    include("../../classes/Worker.php");
    session_start();

    $userId = $_SESSION['user_id'];

    $worker = new Worker($conn, $_SESSION['user_id']);
    $orders = $worker->getWorkerOrders();

    $orderList = '';
    $i = 1;
    if (!empty($orders)) {
        foreach ($orders as $orderRow) {
            if ($orderRow['status'] == 0) 
            {
                $style = 'style="background-color:red;"';
            }
            elseif ($orderRow['status'] == 1) 
            {
                $style = 'style="background-color:green;"';
            }
            elseif ($orderRow['status'] == 2) 
            {
                $style = 'style="background-color:orange;"';
            }
            $orderList .= '
                <tr>
                    <th scope="row">' . $i .'</th>
                    <td>' . $orderRow['type'] . '</td>
                    <td>' . $orderRow['city'] . '</td>
                    <td>' . $orderRow['date'] . '</td>
                    <td><button class="button button3 modal-start" data-modal-content="my-order-details" data-id="' . $orderRow['id'] .'">Szczegóły</button></td>
                    <td><div class="status" ' . $style . '></div></td>
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
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $orderList; ?>
        </tbody>
    </table>
</div>