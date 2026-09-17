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
    return $pdo->lastInsertId();
}

function ajoutSaison($pdo, $nom, $resume, $vignette, $date_sortie, $serie_id)
{
    $requete = $pdo->prepare("
        INSERT INTO saison ( nom, resume, vignette, date_sortie, serie_id)
        VALUES (:nom, :resume, :vignette, :date_sortie, :serie_id)
    ");
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':resume', $resume);
    $requete->bindParam(':vignette', $vignette);
    $requete->bindParam(':date_sortie', $date_sortie);
    $requete->bindParam(':serie_id', $serie_id);
    $requete->execute();
}

function ajoutEpisode($pdo, $nom, $resume, $vignette, $date_sortie, $duree, $saison_id)
{
    $requete = $pdo->prepare("
        INSERT INTO episode ( nom, resume, vignette, date_sortie, duree, saison_id)
        VALUES (:nom, :resume, :vignette, :date_sortie, :duree, :saison_id)
    ");
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':resume', $resume);
    $requete->bindParam(':vignette', $vignette);
    $requete->bindParam(':date_sortie', $date_sortie);
    $requete->bindParam(':duree', $duree);
    $requete->bindParam(':saison_id', $saison_id);
    $requete->execute();
}

?>