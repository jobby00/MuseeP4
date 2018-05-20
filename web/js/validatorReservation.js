$(document).ready(function () {
    var $email     = $('#jd_louvrebundle_reservation_email'),
        $nbBillets = $('#jd_louvrebundle_reservation_nbBillets'),
        $submit    = $('#jd_louvrebundle_reservation_Suivant');

    $submit.click(function () {
        valide = true;
        if ($email.val() == ""){
            $email.next(".error-message").fadeIn().text(" Veuillez remplir ce champs");
            valide = false;
        }else if(!$email.val().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/)){
            $email.next(".error-message").fadeIn().text(" Veuillez entrer un adresse email valide, exemple: dupont@gmail.com");
            valide = false;
        }else {
            $email.next(".error-message").fadeOut();
        }
        if($nbBillets.val() == ""){
            $nbBillets.next(".error-message").fadeIn().text(" Veuillez remplir ce champs");
            valide = false;
        }else if (!$nbBillets.val().match(/^[01-20]$/)){
            $nbBillets.next(".error-message").fadeIn().text(" Veuillez choisire un nombre entre 1 à 20");
        }else {
            $nbBillets.next(".error-message").fadeOut();
        }
        return valide;
    })
})