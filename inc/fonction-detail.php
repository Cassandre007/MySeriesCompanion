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
    return $serie ?: null;
}

function listerSaison(PDO $pdo, int $id): array
{
    $requete = $pdo->prepare(
        'SELECT s.*
        FROM saison s
        WHERE s.serie_id = :serie_id'
    );
    $requete->execute(['serie_id' => $id]);
    $saisons = $requete->fetchAll();
    return $saisons;
}