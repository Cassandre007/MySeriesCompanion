<?php
function serieDetail($pdo, $id): array
{
    $requete = $pdo->prepare(
        'SELECT s.*
        FROM serie s
        WHERE s.id = :id'
    );
    $requete->execute(['id' => $id]);
    $serie = $requete->fetch();
    return $serie;
}

function saisonDetail($pdo, $id): array
{
    $requete = $pdo->prepare(
        'SELECT s.*
        FROM saison s
        WHERE s.id = :id'
    );
    $requete->execute(['id' => $id]);
    $saison = $requete->fetch();
    return $saison;
}


