<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-liste.php';
require_once __DIR__ . '/../inc/bdd.php';

$pdo = connexionBdd();
$series = listerSeries($pdo);

require __DIR__ . '/../inc/entete.php';

?>

<div class="w-3/4 mx-auto">
    <h1 class="collapse-title font-semibold">Bienvenue!</h1>
    <p class="collapse-title font-semibold">Qu'avez-vous regardé aujourd'hui ?</p>
</div>
<?php
if($series!= null) {
?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des séries</li>
    <?php
    foreach ($series as $serie) {
    ?> 
        <li class="list-row">
            <div class = "w-32">
            <?php
                if($serie['vignette']!= null) {
            ?>
                <img class="rounded-xl" alt="Tailwind CSS list item" src="<?= e($serie['vignette']); ?>"/>
            <?php
                }
            ?>
            </div>
            <div class= "space-y-2">
                <div><?= e($serie['nom']); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?= dateFr($serie['date_sortie']); ?></div>
                <p class="list-col-wrap text-xs"> <?= e($serie['resume']); ?></p>
            </div>
            <a class="btn btn-ghost" href="detail-serie.php?serie=<?= (int) $serie['id'] ?>">
            Détails
            </a>
        </li>
    <?php
    }
    ?>
    </ul>
</div>
<?php
} 
else{
?>
<div class="w-3/4 mx-auto">
    <p class="collapse-title font-semibold">Il n'y a pas de série enregistrée</p>
</div>
<?php
}
?>
<?php require __DIR__ . '/../inc/pied.php'; ?>

