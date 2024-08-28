<?php
    include("../../config/connection.php");
    session_start();

    $userId = $_SESSION['user_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE client_id = ?");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . htmlspecialchars($conn->error));
        }
    
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $orderHistory = [];
        if ($result->num_rows > 0) {
            $orderHistory = $result->fetch_all(MYSQLI_ASSOC);
        }

        $stmt->close();
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }

    $orderHistoryList = '';
    if (!empty($orderHistory)) {
        foreach ($orderHistory as $order) {
            $orderHistoryList .= '
                <tr>
                    <th scope="row">1</th>
                    <td>' . $order['date'] . '</td>
                    <td>' . $order['type'] . '</td>
                </tr>
            ';
        }
    }

?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Data</th>
            <th scope="col">Typ</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $orderHistoryList; ?>
    </tbody>
</table>