<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-liste.php';
require_once __DIR__ . '/../inc/bdd.php';

$pdo = connexionBdd();
$series = listerSeries($pdo);

require __DIR__ . '/../inc/entete.php';
?>

<h1 class="collapse-title font-semibold">Bienvenue!</h1>
<p class="collapse-title font-semibold">Qu'avez-vous regardé aujourd'hui ?</p>

<div>
    <h2 class="collapse-title font-semibold" >Liste des séries</h2>
    <?php
    foreach ($series as $serie) {
        ?>
        <article>
            <p><?php echo htmlspecialchars($serie['nom']); ?></p>
            <p><?php echo htmlspecialchars($serie['resume']?? ''); ?></p>
            <p><?php echo htmlspecialchars($serie['vignette']?? ''); ?></p>
            <p><?php echo $serie['date_sortie']; ?></p>
            <a class="btn btn-dash btn-accent" href="detail-serie.php?serie=<?= (int) $serie['id'] ?>">
                Détails
            </a>
        </article>
        <?php
    }
    ?>
</div>
<?php require __DIR__ . '/../inc/pied.php'; ?>