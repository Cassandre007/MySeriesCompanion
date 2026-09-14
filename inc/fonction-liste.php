<?php
function listerSeries($pdo): array
{
    $requete = $pdo->query(
        'SELECT s.*
        FROM serie s'
    )->fetchAll();
    return $requete;
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

function listerEpisode(PDO $pdo, int $id): array
{
    $requete = $pdo->prepare(
        'SELECT e.*
        FROM episode e
        WHERE e.saison_id = :saison_id'
    );
    $requete->execute(['saison_id' => $id]);
    $saisons = $requete->fetchAll();
    return $saisons;
}