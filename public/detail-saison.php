<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-detail.php';
require_once __DIR__ . '/../inc/fonction-liste.php';
require_once __DIR__ . '/../inc/fonction-ajout.php';
require_once __DIR__ . '/../inc/bdd.php';
$pdo = connexionBdd();
require __DIR__ . '/../inc/entete.php';

$saisonChoisi = (int) ($_GET['saison'] ?? 1);
$saison = saisonDetail($pdo, $saisonChoisi);
$episodes = listerEpisode($pdo, $saisonChoisi);


if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $saisie = $_POST;
    $nom = $saisie['nom'];
    $resume = $saisie['resume'] ;
    $vignette =  $saisie['vignette'];
    $date_sortie =  $saisie['date_sortie'];
    $duree =  $saisie['duree'];
    $saison_id =  $saisie['saison_id'];
    if ( $nom != null && $date_sortie != null){
        ajoutEpisode($pdo, $nom, $resume, $vignette, $date_sortie, $duree, $saison_id);
        header('Location: detail-saison.php');
        exit;
    }
}

?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Detail de la saison</li>
        <li class="list-row">
            <div><img class="size-10 rounded-box" alt="Tailwind CSS list item" src="<?php echo htmlspecialchars($saison['vignette']?? ''); ?>"/></div>
            <div>
                <div><?php echo htmlspecialchars($saison['nom']); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?php echo $saison['date_sortie']; ?></div>
            </div>
            <p class="list-col-wrap text-xs"> <?php echo htmlspecialchars($saison['resume']?? ''); ?></p>
        </li>
    </ul>
</div>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des episodes</li>
    <?php
    foreach ($episodes as $episode) {
    ?> 
        <li class="list-row">
            <div><img class="size-10 rounded-box" alt="Tailwind CSS list item" src="<?php echo htmlspecialchars($episode['vignette']?? ''); ?>"/></div>
            <div>
                <div><?php echo htmlspecialchars($episode['nom']); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?php echo $episode['duree']?? ''; ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?php echo $episode['date_sortie']; ?></div>
            </div>
            <p class="list-col-wrap text-xs"> <?php echo htmlspecialchars($episode['resume']?? ''); ?></p>
        </li>
    <?php
    }
    ?>
    </ul>
</div>
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