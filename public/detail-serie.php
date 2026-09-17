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
    $nom = $saisie['nom'];
    $resume = $saisie['resume'] ;
    $vignette =  $saisie['vignette'];
    $date_sortie =  $saisie['date_sortie'];
    $serie_id =  $saisie['serie_id'];
    var_dump($serie_id);
    if ( $nom != null && $date_sortie != null){
        ajoutSaison($pdo, $nom, $resume, $vignette, $date_sortie, $serie_id);
        header('Location: detail-serie.php?serie=' . $serie_id);
        exit;
    }
}

?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Detail de la série</li>
        <li class="list-row">
            <div><img class="size-10 rounded-box" alt="Tailwind CSS list item" src="<?php echo htmlspecialchars($serie['vignette']?? ''); ?>"/></div>
            <div>
                <div><?php echo htmlspecialchars($serie['nom']); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?php echo $serie['date_sortie']; ?></div>
            </div>
            <p class="list-col-wrap text-xs"> <?php echo htmlspecialchars($serie['resume']?? ''); ?></p>
        </li>
    </ul>
</div>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des saisons</li>
    <?php
    foreach ($saisons as $saison) {
    ?> 
        <li class="list-row">
            <div><img class="size-10 rounded-box" alt="Tailwind CSS list item" src="<?php echo htmlspecialchars($saison['vignette']?? ''); ?>"/></div>
            <div>
                <div><?php echo htmlspecialchars($saison['nom']); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?php echo $saison['date_sortie']; ?></div>
            </div>
            <p class="list-col-wrap text-xs"> <?php echo htmlspecialchars($saison['resume']?? ''); ?></p>
            <a class="btn btn-ghost" href="detail-saison.php?saison=<?= (int) $saison['id'] ?>">
            Détails
            </a>
        </li>
    <?php
    }
    ?>
    </ul>
</div>
<div class="w-3/4 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter une saison</h2>
    <form  method="post" action="">
        <label for="nom" class="floating-label">
            <span>Nom</span>
            <input id="nom" name="nom"  type="text" placeholder="Nom" class="input input-md" />
        </label>
        <label for="resume" class="floating-label">
            <span>Résumé</span>
            <input  id="resume" name="resume" type="text" placeholder="..." class="input input-md" />
        </label>
        <label for="vignette" class="floating-label">
            <span>Vignette</span>
            <input id="vignette" name="vignette" type="text" placeholder="..." class="input input-md" />
        </label>
        <label  for="date_sortie" class="input">
            <span class="label">Date de publication</span>
            <input id="date_sortie" name="date_sortie" type="date" />
        </label>
        <input type="hidden" value="<?= $serieChoisi ?>" name="serie_id">
        <button type="submit" class="rounded-md bg-sky-700 px-4 py-2 font-semibold text-white hover:bg-sky-800">
            Ajouter une saison
        </button>
    </form>
</div>