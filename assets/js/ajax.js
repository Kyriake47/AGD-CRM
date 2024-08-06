// load page
function loadContent(page) {
    $.get(page + '.php', function(data) {
        $('#content').html(data);
    });
}

// load modal
$(document).on('click', '.modal-start', function(event) {
    var windowContent = $(this).data('modal-content');
    $.get('windows/' + windowContent + '.php', function(data) {
        $('.modal-content').html(data);
        $('#modal').modal('show');
    });
})

// close modal
$(document).on('click', '.modal-close', function(event) {
    $('#modal').modal('hide');
});

// ajax form
$(document).on('click', 'button[type="submit"].ajax-submit', function(event) {
    event.preventDefault();
    //var disabled = $(this).find(':input:disabled').removeAttr('disabled');
    var form = $(this).closest('form'); 
    var formData = form.serialize();
    //disabled.attr('disabled','disabled');

    var formId = form.attr('id');
    var url = '../../pages/client/handling/' + formId + '.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function(response) {
            try {
                var result = JSON.parse(response);
                $(".toast-container").html(result.toast);
                if (result.type === 'ok') {
                    $('#modal').modal('hide');
                }
            } catch(error) {
                alert(error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Błąd: ' + textStatus + ' - ' + errorThrown);
        }
    });
    
});

/*
function loadContent(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', page + '.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('content').innerHTML = xhr.responseText;
            $(document).click("window-open", function(){
                $('#exampleModalCenter').modal('show');
            })
        }
    };
    xhr.send();
}
*/

