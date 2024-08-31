var loadedPage = "";

// load page
function loadContent(page) {
    $.get(page + '.php', function(data) {
        $('#content').html(data);
        loadedPage = page;
    });
}

// load modal
$(document).on('click', '.modal-start', function(event) {
    var windowContent = $(this).data('modal-content');
    var id = $(this).data('id');
    $.post('windows/' + windowContent + '.php', { id: id }, function(data) {
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
           // alert(response);
            try {
                var result = JSON.parse(response);
                $(".toast-container").html(result.toast);
                if (result.type === 'ok') {
                    $('#modal').modal('hide');
                     $('.' + result.refresh).load('./' + loadedPage+'.php .' + result.refresh);
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

