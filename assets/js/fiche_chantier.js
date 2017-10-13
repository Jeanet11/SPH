var titre = $("#titre");
var description = $("#description");
var prix = $("#prix");
var date = $("#date");
var paiement = $("#paiement");

function verif_vide(aVerif){
    if (aVerif.text() == ""){
        return aVerif.html("<em>Aucune donnée saisie<em>");
    };
};
verif_vide(titre);
verif_vide(description);
verif_vide(prix);
verif_vide(date);
verif_vide(paiement);