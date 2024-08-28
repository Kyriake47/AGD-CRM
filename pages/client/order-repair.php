<?php
    include("../../config/connection.php");
    include("../../classes/Client.php");
    session_start();

    $userId = $_SESSION['user_id'];

    $client = new Client($conn);
    $clientData = $client->getInfo($userId);
    $info = "";

    if (empty($clientData['city']) || empty($clientData['street']) || empty($clientData['phone_number']) || empty($clientData['home_number'])) {
        $info = '
            <div class="alert alert-info" role="alert">
            Uzupełnij informacje w "Moje dane" aby nie musieć każdorazowo uzupełniać ich tutaj.
            </div>
        ';
    }
 
    // Dates to book
    try {
        $stmt = $conn->prepare("SELECT * FROM dates_to_book");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . htmlspecialchars($conn->error));
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        $datesToBook = [];
        if ($result->num_rows > 0) {
            $datesToBook = $result->fetch_all(MYSQLI_ASSOC);
        }
        $stmt->close();
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }

    $datesToBookToChose='';
    if (!empty($datesToBook)) {
        foreach ($datesToBook as $date) {
            $dateObject = DateTime::createFromFormat('Y-m-d', $date['date']);
            $timeObject = DateTime::createFromFormat('H:i:s', $date['time']);
            $datesToBookToChose .= '<div class="repair-date-to-choose" data-date-id="'.$date['id'].'" data-date="' . $dateObject->format('Y-m-d') . '" data-time="' . $timeObject->format('H:i:s') . '">
                <span>' . $dateObject->format('d.m.Y') . 'r.</span>
                <span>' . $timeObject->format('H:i') . '</span>
            </div>';
        }
    }
?>

<div class="data-to-order">
    <?php echo $info; ?>
    <div class="row order-repair-inputs">
        <input name="orderDate" type="hidden" value="">
        <input name="orderTime" type="hidden" value="">
        <input name="datesToBookId" type="hidden" value="">
        <div class="col-sm-5">
            <legend class="mb-3">Dane zamawiającego</legend>
            <div class="input-group mb-3">
                <span class="input-group-text">Imię</span>
                <input class="form-control" name="name" type="text" placeholder="Imię" value="<?php echo $clientData['name'];; ?>">
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
            <div class="mb-3">
                <legend>Wybierz termin naprawy</legend>
                <div class="repair-dates">
                    <?php echo $datesToBookToChose; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="button-group">
        <button type="button" class="button button2 modal-start" data-modal-content="order-repair">Wyślij zgłoszenie</button>
    </div>
</div>

<script>
    // tzw. delegacja zdarzeń
    $(document).on('click', '.repair-date-to-choose', function() {
        $('.repair-date-to-choose').removeClass('date-checked');
        $(this).addClass('date-checked');
        $('input[name="orderDate"]').val($(this).data('date'));
        $('input[name="orderTime"]').val($(this).data('time'));
        $('input[name="datesToBookId"]').val($(this).data('date-id'));
    });
</script>
