
    // $('#modal').on('shown.bs.modal' , function(event){

    //     var button = $(event.relatedTarget) 
    //     var recipient = button.data('whatever')

    //     var modal = $(this)
    //     modal.find('.modal-title').text('alert + recipient')
    //     modal.find('.modal-body input').val(recipient)
    
    // }) 
console.log("coucou")
var changer;
$("input").change(function(){
    changer=true;
})
    window.onbeforeunload = function() { 
    if (changer) {
      return "You have made changes on this page that you have not yet confirmed. If you navigate away from this page you will lose your unsaved changes";
    }
  }
  
  $('form').submit(function() {
     window.onbeforeunload = null;
  });