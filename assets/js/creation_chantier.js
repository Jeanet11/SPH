
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