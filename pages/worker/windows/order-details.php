<?php 
    include("../../../config/connection.php");
    include("../../../classes/Order.php");
    session_start();

    $orderId = $_POST['id'];
    $windowType = $_POST['type'];
    $order = new Order($conn);
    $orderInfo = $order->getOrderInfo($orderId);

    if ($windowType == 1)
    {
        $formContent = '
            <div class="button-group">
                <button type="submit" class="button button2 ajax-submit">Przypisz zgłoszenie do mnie</button>
            </div>
        ';
    }
    else {
        $formContent = '
            <h5 class="modal-title mb-3">Czy chciałbyś dodać coś na temat zamówienia?</h5>
            <div class="input-group mb-3">
                <span class="input-group-text">Status zamówienia</span>
                <select name="orderStatus">
                    <option value="0">Oczekuje</option>
                    <option value="1">Ukończone</option>
                    <option value="2">Anulowane</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Moje notatki</span>
                <input class="form-control" name="myNotes" type="text" placeholder="Tutaj dodaj swoją notatkę dotyczącą zamówienia.">
            </div>

            <div class="button-group">
                <button type="submit" class="button button2 ajax-submit">Zapisz</button>
            </div>
        ';
    }
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

    <div>
        <form id="chose-order">
            <input class="form-control" name="windowType" type="hidden" value="<?php echo $windowType; ?>">
            <input class="form-control" name="orderId" type="hidden" value="<?php echo $orderId; ?>">
            <?php echo $formContent; ?>
        </form>
    </div>
</div>
