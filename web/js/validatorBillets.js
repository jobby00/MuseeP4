$(document).ready(function () {
    var $nom            = $('#jd_louvrebundle_billets_nom'),
        $prenom         = $('#jd_louvrebundle_billets_prenom'),
        $pays           = $('#jd_louvrebundle_billets_pays'),
        $dateDeNaiss    = $('#jd_louvrebundle_billets_dateNaissance'),
        $tarifResduit   = $('#jd_louvrebundle_billets_tarifResduit'),
        $dateResa       = $('#jd_louvrebundle_billets_dateresa'),
        $demiJournee    = $('#jd_louvrebundle_billets_demijournee'),
        $submit         = $('#jd_louvrebundle_billets_Suivant');

    $submit.click(function () {
        valide = true;
        if ($nom.val() == ""){
            $nom.next(".error-message").fadeIn().text(" Veuillez remplir ce champs");
            valide = false;
        }else  if(!$nom.val().match(/^[A-Za-z]+$/i)){
            $nom.next(".error-message").fadeIn().text(" Veuillez retrer un nom valide");
            valide = false;
        }else {
            $nom.next(".error-message").fadeOut()
        }

        if ($prenom.val() == ""){
            $prenom.next(".error-message").fadeIn().text(" Veuillez remplir ce champs");
            valide = false;
        }else  if(!prenom.val().match(/^[A-Za-z]+$/i)){
            $prenom.next(".error-message").fadeIn().text(" Veuillez retrer un nom valide");
            valide = false;
        }else {
            $prenom.next(".error-message").fadeOut()
        }
    })
    return valide;
})