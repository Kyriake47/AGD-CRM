// load page
function loadContent(page) {
    $.get(page + '.php', function(data) {
        $('#content').html(data);
    });
}

// load modal
$(document).on('click', '.modal-open', function(event) {
    var windowContent = $(this).data('modal-content');
    $.get('windows/' + windowContent + '.php', function(data) {
        $('.modal-content').html(data);
    });
    $('#modal').modal('show');
})
