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
        $phoneNumber = $user_info['phone_number'];
        $email = $user_info['email'];
    }
    else{
        $name = "";
        $surname = "";
        $street = "";
        $homeNumber = "";
        $flatNumber = "";
        $postcode = "";
        $city = "";
        $phoneNumber = "";
        $email = "";
    }

?>

<div class="my-data">
    <form id="my-data">
        <div class="row my-data-inputs">
            <div class="col-sm-5">
                <legend class="mb-3">Moje dane</legend>
                <div class="input-group mb-3">
                    <span class="input-group-text">Imię</span>
                    <input class="form-control" name="name" type="text" placeholder="Imię" value="<?php echo $name; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Nazwisko</span>
                    <input class="form-control" name="surname" type="text" placeholder="Nazwisko" value="<?php echo $surname; ?>">
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

                <legend class="mb-3">Dane kontaktowe</legend>
                <div class="input-group mb-3">
                    <span class="input-group-text">Numer telefonu</span>
                    <input class="form-control" name="phoneNumber" type="text" placeholder="Numer telefonu" value="<?php echo $phoneNumber; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Adres e-mail</span>
                    <input class="form-control" name="email" type="text" placeholder="Adres e-mail" value="<?php echo $email; ?>">
                </div>
            </div>
        
            <div class="button-group">
                <button type="submit" class="button button2 ajax-submit">Zapisz</button>
            </div>
        </div>   
    </form>
</div>