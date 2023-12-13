/*
v0.1.0	first commit
*/
$(document).ready(function() {
  // enviar form ao pressionar enter no textarea
  const textarea = $("textarea");
  textarea.on("keypress", function(event) {
    if (event.keyCode === 13) {
      if (event.shiftKey) {
        textarea.val(textarea.val() + "\n");
      } else {
        $(this).closest("form").submit();
      }
    }
  });
});
