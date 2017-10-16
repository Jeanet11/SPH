var adresse = $("#adresse"); 
var code_postal = $("#code_postal");
var ville = $("#ville"); 
var telephone = $("#telephone"); 
var email = $("#email"); 
var note = $("#note"); 

function verif_vide(aVerif){
    if(aVerif.text() == ""){
        return aVerif.html("<em>La saisie est imcomplete<em>");
    };

};

verif_vide(adresse);
verif_vide(code_postal);
verif_vide(ville); 
verif_vide(telephone); 
verif_vide(email); 
