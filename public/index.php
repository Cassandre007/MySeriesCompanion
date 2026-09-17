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

<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des séries</li>
    <?php
    foreach ($series as $serie) {
    ?> 
        <li class="list-row">
            <div><img class="size-10 rounded-box" alt="Tailwind CSS list item" src="<?php echo htmlspecialchars($serie['vignette']?? ''); ?>"/></div>
            <div>
                <div><?php echo htmlspecialchars($serie['nom']); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?php echo $serie['date_sortie']; ?></div>
            </div>
            <p class="list-col-wrap text-xs"> <?php echo htmlspecialchars($serie['resume']?? ''); ?></p>
            <a class="btn btn-ghost" href="detail-serie.php?serie=<?= (int) $serie['id'] ?>">
            Détails
            </a>
        </li>
    <?php
    }
    ?>
    </ul>
</div>
<?php require __DIR__ . '/../inc/pied.php'; ?>

