<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-detail.php';
require_once __DIR__ . '/../inc/bdd.php';
$pdo = connexionBdd();
require __DIR__ . '/../inc/entete.php';

$serieChoisi = (int) ($_GET['serie'] ?? 1);
$serie = serieDetail($pdo, $serieChoisi);
$saisons = listerSaison($pdo, $serieChoisi);

?>
<div>
        <h2 class="collapse-title font-semibold" >Detail de la série</h2>
    <article>
        <p><?php echo htmlspecialchars($serie['nom']); ?></p>
        <p><?php echo htmlspecialchars($serie['resume']?? ''); ?></p>
        <p><?php echo htmlspecialchars($serie['vignette']?? ''); ?></p>
        <p><?php echo $serie['date_sortie']; ?></p>
    </article>
</div>
<div>
    <h2 class="collapse-title font-semibold" >Liste des saisons</h2>
    <?php
    foreach ($saisons as $saison) {
        ?>
        <article>
            <p><?php echo htmlspecialchars($saison['nom']); ?></p>
            <p><?php echo htmlspecialchars($saison['resume']?? ''); ?></p>
            <p><?php echo htmlspecialchars($saison['vignette']?? ''); ?></p>
            <p><?php echo $saison['date_sortie']; ?></p>
            <a class="btn btn-dash btn-accent" href="detail-saison.php?serie=<?= (int) $saison['id'] ?>">
                Détails de la saison
            </a>
        </article>
        <?php
    }
    ?>
</div>