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

function dateFr(string $dateIso): string
{
    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $dateIso);

    if (false === $date || $date->format('Y-m-d') !== $dateIso) {
        return '';
    }

    return $date->format('d/m/Y');
}

function e(?string $valeur): string
{
    return htmlspecialchars($valeur ?? '', ENT_QUOTES, 'UTF-8');
}

