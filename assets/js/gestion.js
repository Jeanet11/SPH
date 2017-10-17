
$(function(){
    $('#ajout').click(function(){
        $('#affiche_uti').hide()
        $('#ajout_uti').toggle() // AFFICHE ET CACHE A CHAQUE CLIQUE SUR LE BOUTTON
    });
    $('#affiche').click(function(){
        $('#ajout_uti').hide()
        $('#affiche_uti').toggle() // AFFICHE ET CACHE A CHAQUE CLIQUE SUR LE BOUTTON
    });

});
