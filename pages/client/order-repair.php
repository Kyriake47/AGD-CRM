<?php
    include("../../config/connection.php");
    session_start();

    $userId = $_SESSION['user_id'];
    $userInfo = null;
    $errorMessage = null;

    try{
        $stmt = $conn->prepare(
            "SELECT *
            FROM users
            LEFT JOIN clients_data
            ON users.id = clients_data.user_id
            WHERE user_id = ?"
        );
        if ($stmt === false) {
            throw new Exception("'Prepare failed: '.htmlspecialchars($conn->error)");
        }
        $stmt->bind_param('s', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user_info = $result->fetch_assoc();
        } else {
            $error_message = "No user found.";
        }
        $stmt->close();
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }

    if(!$errorMessage){
        $name = $user_info['name'];
        $surname = $user_info['surname'];
        $street = $user_info['street'];
        $homeNumber = $user_info['home_number'];
        $flatNumber = $user_info['flat_number'];
        $postcode = $user_info['postcode'];
        $city = $user_info['city'];
        $info = "";
    }
    else{
        $name = "";
        $surname = "";
        $street = "";
        $homeNumber = "";
        $flatNumber = "";
        $postcode = "";
        $city = "";
        $info = '
            <div class="alert alert-info" role="alert">
            Uzupełnij informacje w "Moje dane" aby nie musieć każdorazowo uzupełniać ich tutaj.
            </div>
        ';
    }


?>

<div class="container">
    <form action="send-order.php" method="POST">
        <?php echo $info; ?>
        <div class="row order-repair-form">
            <div class="col-sm-5">
                <legend class="mb-3">Dane zamawiającego</legend>
                <div class="input-group mb-3">
                    <span class="input-group-text">Imię</span>
                    <input class="form-control" name="name" type="text" placeholder="Imię" value="<?php echo $name; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Nazwisko</span>
                    <input class="form-control" name="name" type="text" placeholder="Nazwisko" value="<?php echo $surname; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Miejscowość</span>
                    <input class="form-control" name="city" type="text" placeholder="Miejscowość" value="<?php echo $city; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Kod pocztowy</span>
                    <input class="form-control kod" name="postcode" type="text" placeholder="99-999" value="<?php echo $postcode; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Ulica</span>
                    <input class="form-control" name="street" type="text" placeholder="Ulica" value="<?php echo $street; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Numer</span>
                    <input class="form-control" name="homeNumber" type="text" placeholder="Nr domu" value="<?php echo $homeNumber; ?>">
                    <input class="form-control" name="flatNumber" type="text" placeholder="Nr mieszkania" value="<?php echo $flatNumber; ?>">
                </div>
            </div>
            
            <div class="col-sm-5">
                <legend>Informacje o zgłoszeniu</legend>
                <div class="input-group mb-3">
                    <span class="input-group-text">Przedmiot naprawy np. pralka, lodówka itp.</span>
                    <input class="form-control" name="type" type="text">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Model</span>
                    <input class="form-control" name="model" type="text" placeholder="Model">
                </div>
                <div class="mb-3">
                    <legend>Informacje o awarii</legend>
                    <textarea class="form-control" name="info" rows="3"></textarea>
                </div>
            </div>

        </div>
    </form>
</div>