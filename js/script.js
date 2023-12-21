/*
v0.1.0	first commit
v0.1.1  evita adicionar enter antes de enviar o form
v0.1.2  sem copiar o value
*/
$(document).ready(function() {
  const textarea=$("textarea");
  textarea.focus();
  textarea.on("keydown",function(event) {
    if(event.keyCode===13){
      if(!event.shiftKey){
        event.preventDefault();
        $(this).closest("form").submit();
      }
    }
  });
});
