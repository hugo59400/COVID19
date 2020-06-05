<?php
include_once('includes.php');
//tentative de création automatique de rendez-vous
function NouveauRdv() {
    
        $livraison = strtotime(date("Y-m-d H:i").'+ 2 hours');
        $valid = false;
        while ($valid == false) {
            $jour = date('w', $livraison);
            $heure = date('H', $livraison);
//si le rdv est dans les horaire de mairie du lundi au vendredi
            if(($jour >= 1 && $jour <= 5) && (($heure >=9 && $heure < 12) || ($heure >= 14 && $heure < 17))) {
                $date = date("Y-m-d H:i", $livraison);
                $reqrdv = $DB->prepare("SELECT dateLivraison FROM rdv WHERE dateLivraison = ?");
                $reqrdv->execute(array($date));
                $rdvexist = $reqrdv -> rowCount();
                if(rdvexist == 0) {
                    $valid = true;
                    return $date;
                } else{
                    $livraison = strtotime(date("Y-m-d H:i", $livraison).'+ 5 minutes');
                }
            }
//si le rdv est dans les horaires de mairie le samedi
            elseif($jour == 6 && ($heure>=9 && $heure <12)) {
                $date = date("Y-m-d H:i", $livraison);
                $reqrdv = $DB->prepare("SELECT dateLivraison FROM rdv WHERE dateLivraison = ?");
                $reqrdv->execute(array($date));
                $rdvexist = $reqrdv -> rowCount();
                if(rdvexist == 0) {
                    $valid = true;
                    return $date;
                } else{
                    $livraison = strtotime(date("Y-m-d H:i", $livraison).'+ 5 minutes');
                }
//si le rdv n'est pas dans dans les horaires de la mairie
            }else {
                $livraison = strtotime(date("Y-m-d H:i", $livraison).'+ 5 minutes');
            }
        }
}

$insertrdv = $DB->prepare("INSERT INTO rdv(mail, dateLivraison) VALUES (:mail, :dateLivraison)");
$insertrdv->bindParam(':mail', $_SESSION['mail']);
$insertrdv->bindParam(':dateLivraison', NouveauRdv());
$insertrdv->execute();
// requetes préparées
?>