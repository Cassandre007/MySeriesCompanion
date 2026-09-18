<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-detail.php';
require_once __DIR__ . '/../inc/fonction-liste.php';
require_once __DIR__ . '/../inc/fonction-ajout.php';
require_once __DIR__ . '/../inc/bdd.php';
$pdo = connexionBdd();

$saisonChoisi = (int) ($_GET['saison'] ?? 1);
$saison = saisonDetail($pdo, $saisonChoisi);
$episodes = listerEpisode($pdo, $saisonChoisi);

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $saisie = $_POST;
    $nom = $saisie['nom'] ?? null;
    $resume = $saisie['resume'] ?? null;
    $vignette =  $saisie['vignette'] ?? null;
    $date_sortie =  $saisie['date_sortie'] ?? null;
    $duree =  $saisie['duree'] ?? null;
    $saison_id =  $saisie['saison_id'] ?? null;
    if ( $nom != null && $date_sortie != null && $saison_id != null){
        ajoutEpisode($pdo, $nom, $resume, $vignette, $date_sortie, $duree, $saison_id);
    }
    header('Location: detail-saison.php?saison=' . (int) $saison_id);
    exit;
}

require __DIR__ . '/../inc/entete.php';

?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Detail de la saison</li>
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
        </li>
    </ul>
</div>
<?php
if($episodes!= null) {
?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des episodes</li>
    <?php
    foreach ($episodes as $episode) {
    ?> 
        <li class="list-row">
            <div class = "w-32">
            <?php
                if($episode['vignette']!= null) {
            ?>
                <img class="rounded-xl" alt="Tailwind CSS list item" src="<?= e($episode['vignette']); ?>"/>
            <?php
                }
            ?>
            </div>
            <div class= "space-y-2">
                <div><?= e($episode['nom']); ?></div>
                <?php
                if($episode['duree']!= 0) {
                ?>
                <div class="text-xs uppercase font-semibold opacity-60"><?= $episode['duree'] . ' minutes'; ?></div>
                <?php
                    }
                ?>
                <div class="text-xs uppercase font-semibold opacity-60"><?= dateFr($episode['date_sortie']); ?></div>
                <p class="list-col-wrap text-xs"> <?= e($episode['resume']); ?></p>
            </div>
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
    <p class="collapse-title font-semibold">Il n'y a pas d'episodes pour l'instant</p>
</div>
<?php
}
?>
<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter un episode</h2>
    <form  method="post" action="" class ="space-y-4">
        <label for="nom" class="floating-label">
            <span>Nom</span>
            <input id="nom" name="nom"  type="text" placeholder="Nom" class="input input-md" />
        </label>
        <label for="resume" class="floating-label">
            <span>Résumé</span>
            <input  id="resume" name="resume" type="text" placeholder="Résumé...(facultatif)" class="input input-md" />
        </label>
        <label for="vignette" class="floating-label">
            <span>Vignette</span>
            <input id="vignette" name="vignette" type="text" placeholder="Vignette...(facultatif)" class="input input-md" />
        </label>
        <label  for="date_sortie" class="input">
            <span class="label">Date de publication</span>
            <input id="date_sortie" name="date_sortie" type="date" />
        </label>
        <input type="hidden" value="<?= $saisonChoisi ?>" name="saison_id">
        <label for="duree" class="floating-label">
            <span>Duree</span>
            <input id="duree" name="duree" type="number" placeholder="Durée...(facultatif) " class="input input-md" />
        </label>
        <button type="submit" class="btn btn-block  btn-neutral">
            Ajouter un episode
        </button>
    </form>
</div>
<?php require __DIR__ . '/../inc/pied.php'; ?>
