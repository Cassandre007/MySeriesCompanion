<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-detail.php';
require_once __DIR__ . '/../inc/fonction-liste.php';
require_once __DIR__ . '/../inc/fonction-ajout.php';
require_once __DIR__ . '/../inc/bdd.php';
$pdo = connexionBdd();
require __DIR__ . '/../inc/entete.php';

$serieChoisi = (int) ($_GET['serie'] ?? 1);
$serie = serieDetail($pdo, $serieChoisi);
$saisons = listerSaison($pdo, $serieChoisi);

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $saisie = $_POST;
    $nom = $saisie['nom'] ?? null;
    $resume = $saisie['resume'] ?? null;
    $vignette =  $saisie['vignette'] ?? null;
    $date_sortie =  $saisie['date_sortie'] ?? null;
    $serie_id =  $saisie['serie_id'] ?? null;
    if ( $nom != null && $date_sortie != null && $serie_id != null){
        ajoutSaison($pdo, $nom, $resume, $vignette, $date_sortie, $serie_id);
    }
    header('Location: detail-serie.php?serie=' . $serie_id);
    exit;
}

?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Detail de la série</li>
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
        </li>
    </ul>
</div>
<?php
if($saisons!= null) {
?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des saisons</li>
    <?php
    foreach ($saisons as $saison) {
    ?> 
        <li class="list-row">
            <div class = "w-32">
            <?php
                if($saison['vignette']!= null) {
            ?>
                <img class="rounded-xl" alt="Tailwind CSS list item" src="<?= e($saison['vignette']); ?>"/>
            <?php
                }
            ?>
            </div>
            <div class= "space-y-2">
                <div><?= e($saison['nom']); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?= dateFr($saison['date_sortie']); ?></div>
                <p class="list-col-wrap text-xs"> <?= e($saison['resume']); ?></p>
            </div>
            <a class="btn btn-ghost" href="detail-saison.php?saison=<?= (int) $saison['id'] ?>">
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
    <p class="collapse-title font-semibold">Il n'y a pas de saison pour l'instant</p>
</div>
<?php
}
?>
<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter une saison</h2>
    <form  method="post" action="" class= "space-y-4">
        <label for="nom" class="floating-label ">
            <span>Nom</span>
            <input id="nom" name="nom"  type="text" placeholder="Nom" class="input input-md" />
        </label>
        <label for="resume" class="floating-label">
            <span>Résumé</span>
            <input  id="resume" name="resume" type="text" placeholder="Résumé...(facultatif)" class="input input-md" />
        </label>
        <label for="vignette" class="floating-label">
            <span>Vignette</span>
            <input id="vignette" name="vignette" type="text" placeholder="Vignette... (facultatif)" class="input input-md" />
        </label>
        <label  for="date_sortie" class="input">
            <span class="label">Date de publication</span>
            <input id="date_sortie" name="date_sortie" type="date" />
        </label>
        <input type="hidden" value="<?= $serieChoisi ?>" name="serie_id">
        <button type="submit" class="btn btn-block  btn-neutral">
            Ajouter une saison
        </button>
    </form>
</div>
<?php require __DIR__ . '/../inc/pied.php'; ?>
