<?php
function ajoutSerie($pdo, $nom, $resume, $vignette, $date_sortie)
{
    $requete = $pdo->prepare("
        INSERT INTO serie ( nom, resume, vignette, date_sortie)
        VALUES (:nom, :resume, :vignette, :date_sortie)
    ");
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':resume', $resume);
    $requete->bindParam(':vignette', $vignette);
    $requete->bindParam(':date_sortie', $date_sortie);
    $requete->execute();
}

?>