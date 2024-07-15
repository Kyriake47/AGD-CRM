<div class="modal-body">
    <div class="button-close-group">
        <h5 class="modal-title">Sprawdź poprawność danych</h5>
        <button type="button" class="button modal-close" data-dismiss="modal" aria-label="Close">x</button>
    </div>
    <form id="order-repair">
        <input class="form-control" name="name" type="hidden" value="">
        <input class="form-control" name="surname" type="hidden" value="">
        <input class="form-control" name="email" type="hidden" value="">
        <input class="form-control" name="type" type="hidden" value="">
        <input class="form-control" name="model" type="hidden" value="">
        <input class="form-control" name="info" type="hidden" value="">
        <input class="form-control" name="postcode" type="hidden" value="">
        <div class="input-group mb-3">
            <span class="input-group-text">Miejscowość</span>
            <input class="form-control" name="city" type="text" placeholder="Miejscowość" value="" disabled>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Ulica</span>
            <input class="form-control" name="street" type="text" placeholder="Ulica" value="" disabled>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Numer</span>
            <input class="form-control" name="homeNumber" type="text" placeholder="Nr domu" value="" disabled>
            <input class="form-control" name="flatNumber" type="text" placeholder="Nr mieszkania" value="" disabled>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Numer telefonu</span>
            <input class="form-control" name="phoneNumber" type="text" placeholder="Numer telefonu" value="" disabled>
        </div>
        <div class="button-group">
            <button type="submit" class="button button2">Wyślij zgłoszenie</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#order-repair').find('input').each(function() {
            var name = $(this).attr('name');
            var inputValue = $('[name="' + name + '"]').not(this).val();
            $(this).val(inputValue);
        });
        $('#order-repair').find('textarea').each(function() {
            var textareaValue = $('textarea[name="info"]').val();
            $('input[name="info"]').val(textareaValue);
        });
    });
</script>