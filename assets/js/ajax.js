function loadContent(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', page + '.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('content').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}