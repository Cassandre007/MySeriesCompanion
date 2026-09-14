<?php
function listerSeries($pdo): array
{
    $requete = $pdo->query(
        'SELECT s.*
        FROM serie s'
    )->fetchAll();
    return $requete;
}


