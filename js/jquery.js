$.fn.setCursorPosition = function(pos) {
    if ($(this).get(0).setSelectionRange) {
      $(this).get(0).setSelectionRange(pos, pos);
    } else if ($(this).get(0).createTextRange) {
      var range = $(this).get(0).createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  };
  
$('#phone_number').one('click', function(){
  $(this).setCursorPosition(2);  
  return false;
});

$(document).ready(function() { 
$("#phone_number").mask("8(999)999-99-99");
});

$(document).ready(function() { 
  $("#birth_date").mask("99/99/9999");
});