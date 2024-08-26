<?php
    include("../../config/connection.php");
    include("../../classes/Client.php");
    session_start();

    $userId = $_SESSION['user_id'];
    $userInfo = null;
    $errorMessage = null;

    $client = new Client($conn);
    $clientData = $client->getInfo($userId);
?>

<div class="my-data">
    <form id="my-data">
        <div class="row my-data-inputs">
            <div class="col-sm-5">
                <legend class="mb-3">Moje dane</legend>
                <div class="input-group mb-3">
                    <span class="input-group-text">Imię</span>
                    <input class="form-control" name="name" type="text" placeholder="Imię" value="<?php echo $clientData['name']; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Nazwisko</span>
                    <input class="form-control" name="surname" type="text" placeholder="Nazwisko" value="<?php echo $clientData['surname']; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Miejscowość</span>
                    <input class="form-control" name="city" type="text" placeholder="Miejscowość" value="<?php echo $clientData['city']; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Kod pocztowy</span>
                    <input class="form-control kod" name="postcode" type="text" placeholder="99-999" value="<?php echo $clientData['postcode']; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Ulica</span>
                    <input class="form-control" name="street" type="text" placeholder="Ulica" value="<?php echo $clientData['street']; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Numer</span>
                    <input class="form-control" name="homeNumber" type="text" placeholder="Nr domu" value="<?php echo $clientData['home_number']; ?>">
                    <input class="form-control" name="flatNumber" type="text" placeholder="Nr mieszkania" value="<?php echo $clientData['flat_number']; ?>">
                </div>

                <legend class="mb-3">Dane kontaktowe</legend>
                <div class="input-group mb-3">
                    <span class="input-group-text">Numer telefonu</span>
                    <input class="form-control" name="phoneNumber" type="text" placeholder="Numer telefonu" value="<?php echo $clientData['phone_number']; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Adres e-mail</span>
                    <input class="form-control" name="email" type="text" placeholder="Adres e-mail" value="<?php echo $clientData['email']; ?>">
                </div>
            </div>
        
            <div class="button-group">
                <button type="submit" class="button button2 ajax-submit">Zapisz</button>
            </div>
        </div>   
    </form>
</div>