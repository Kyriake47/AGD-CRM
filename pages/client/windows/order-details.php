<?php 
    include("../../../config/connection.php");
    include("../../../classes/Order.php");

    $orderId = $_POST['id'];
    $order = new Order($conn);
    $orderInfo = $order->getOrderInfo($orderId);
?>

<div class="modal-body">
    <div class="button-close-group">
        <h5 class="modal-title">Szczegóły zamówienia</h5>
        <button type="button" class="button modal-close" data-dismiss="modal" aria-label="Close">x</button>
    </div>
    <div class="order-details">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="col">Imię i nazwisko zamawiającego</th>
                    <td><?php echo $orderInfo['name'] . ' ' . $orderInfo['surname']; ?></td> 
                </tr>
                <tr>
                    <th scope="col">Typ urządzenia</th>
                    <td><?php echo $orderInfo['type']; ?></td>
                </tr>
                <tr>
                    <th scope="col">Model</th>
                    <td><?php echo $orderInfo['model']; ?></td> 
                </tr>
                <tr>
                    <th scope="col">Informacja dla naprawiającego</th>
                    <td><?php echo $orderInfo['info']; ?></td>
                </tr>
                <tr>
                    <th scope="col">Data</th>
                    <td><?php echo $orderInfo['date']; ?></td> 
                </tr>
                <tr>
                    <th scope="col">Godzina</th>
                    <td><?php echo $orderInfo['time']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>