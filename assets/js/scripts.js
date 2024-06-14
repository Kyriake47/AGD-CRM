/* STRONA GŁÓWNA */ 
// Tekst  
           
var words = ['Szukasz szybkiego i wygodnego sposobu na naprawę sprzętu AGD?', 
            'Nasza strona internetowa jest dla Ciebie idealnym rozwiązaniem.', 
            'Z naszą inteligentną rezerwacją naprawy online możesz zamówić usługę w kilku prostych krokach.', 
            'Wystarczy, że podasz model i markę urządzenia, opiszesz problem i wybierzesz dogodny termin.', 
            'Nie musisz martwić się o koszty ani jakość naprawy, ponieważ oferujemy konkurencyjne ceny i gwarancję na wykonaną usługę.',
            'Nie zwlekaj i zarezerwuj naprawę sprzętu AGD online już dziś!'],
    part,
    i = 0,
    offset = 0,
    len = words.length,
    forwards = true,
    skip_count = 0,
    skip_delay = 30,
    speed = 100;
var wordflick = function () {
  setInterval(function () {
    if (forwards) {
      if (offset >= words[i].length) {
        ++skip_count;
        if (skip_count == skip_delay) {
          forwards = false;
          skip_count = 0;
        }
      }
    }
    else {
      if (offset == 0) {
        forwards = true;
        i++;
        offset = 0;
        if (i >= len) {
          i = 0;
        }
      }
    }
    part = words[i].substr(0, offset);
    if (skip_count == 0) {
      if (forwards) {
        offset++;
      }
      else {
        offset--;
      }
    }
    $('.word').text(part);
  },speed);
};

$(document).ready(function () {
  wordflick();
});

$(".reply-first").click(function() {
  $(this).css("display", "none");
  $(this).parent().find(".comment-reply").css("display", "block");
});

	/*
<div class="reply-form-item form-item">
<button type="button" class="btn btn-1 reply-first">Odpowiedz</button>

<form method="post" id="add-comment-reply" class="comment-reply comment-reply-form">

  <input type="hidden" id="comment_parent_key" class="comment-reply" name="comment_parent_key" value="'.$post['comment_key'].'" />
  <input type="hidden" name="comment_post_slug" id="author" value="'.$blog_post_slug.'"/>
  
  <div class="form-space comment-reply">
  <textarea name="comment_content" rows="3" placeholder="Wpisz treść..."></textarea>
  </div>
  
  <button type="submit" class="btn btn-1 comment-reply">Wyślij</button>
</form>
</div>
*/