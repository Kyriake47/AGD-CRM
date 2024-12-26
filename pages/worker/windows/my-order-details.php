<?php 
    include("../../../config/connection.php");
    include("../../../classes/Order.php");
    session_start();

    $orderId = $_POST['id'];
    $order = new Order($conn, $orderId);
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
                    <td><?php echo $order->getName() . ' ' . $order->getSurname(); ?></td> 
                </tr>
                <tr>
                    <th scope="col">Typ urządzenia</th>
                    <td><?php echo $order->getType(); ?></td>
                </tr>
                <tr>
                    <th scope="col">Model</th>
                    <td><?php echo $order->getModel(); ?></td> 
                </tr>
                <tr>
                    <th scope="col">Informacja dla naprawiającego</th>
                    <td><?php echo $order->getInfo(); ?></td>
                </tr>
                <tr>
                    <th scope="col">Data</th>
                    <td><?php echo $order->getDate(); ?></td> 
                </tr>
                <tr>
                    <th scope="col">Godzina</th>
                    <td><?php echo $order->getTime(); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <form id="my-order-details">

            <h5 class="modal-title mb-3">Czy chciałbyś dodać coś na temat zamówienia?</h5>
            <input class="form-control" name="orderId" type="hidden" value="<?php echo $orderId; ?>">

            <div class="input-group mb-3">
                <span class="input-group-text">Status zamówienia</span>
                <select name="orderStatus">
                    <option value="0" <?php echo ($order->getStatus() == 0) ? 'selected' : ''; ?>>Oczekuje</option>
                    <option value="1" <?php echo ($order->getStatus() == 1) ? 'selected' : ''; ?>>Ukończone</option>
                    <option value="2" <?php echo ($order->getStatus() == 2) ? 'selected' : ''; ?>>Anulowane</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Moje notatki</span>
                <input class="form-control" name="noteContent" type="text" placeholder="Tutaj dodaj swoją notatkę dotyczącą zamówienia." value="<?php echo $order->getNote(); ?>">
            </div>

            <div class="button-group">
                <button type="submit" class="button button2 ajax-submit">Zapisz</button>
            </div>
        </form>
    </div>
</div>
