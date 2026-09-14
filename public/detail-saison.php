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
<div>
        <h2 class="collapse-title font-semibold" >Detail de la saison</h2>
    <article>
        <p><?php echo htmlspecialchars($saison['nom']); ?></p>
        <p><?php echo htmlspecialchars($saison['resume']?? ''); ?></p>
        <p><?php echo htmlspecialchars($saison['vignette']?? ''); ?></p>
        <p><?php echo $saison['date_sortie']; ?></p>
    </article>
</div>
<div>
    <h2 class="collapse-title font-semibold" >Liste des episodes</h2>
    <?php
    foreach ($episodes as $episode) {
        ?>
        <article>
            <p><?php echo htmlspecialchars($episode['nom']); ?></p>
            <p><?php echo htmlspecialchars($episode['resume']?? ''); ?></p>
            <p><?php echo htmlspecialchars($episode['vignette']?? ''); ?></p>
            <p><?php echo $episode['date_sortie']; ?></p>
            <p><?php echo htmlspecialchars($episode['duree']?? ''); ?></p>
        </article>
        <?php
    }
    ?>
</div>
<div>
    <h2 class="collapse-title font-semibold ">Ajouter un episode</h2>
    <form  method="post" action="">
        <label id="nom" name="nom" class="floating-label">
            <span>Nom</span>
            <input for ="nom" type="text" placeholder="Nom" class="input input-md" />
        </label>
        <label id="resume" name="resume" class="floating-label">
            <span>Résumé</span>
            <input  for="resume" type="text" placeholder="..." class="input input-md" />
        </label>
        <label id="vignette" name="vignette" class="floating-label">
            <span>Vignette</span>
            <input for="vignette" type="text" placeholder="..." class="input input-md" />
        </label>
        <label  id="date_sortie" name="date_sortie" class="input">
            <span class="label">Date de publication</span>
            <input for="date_sortie" type="date" />
        </label>
        <input type="hidden" value=" <?= $saisonChoisi ?>" name="saison_id">
        <label id="duree" name="duree" class="floating-label">
            <span>Duree</span>
            <input for="duree" type="number" placeholder="..." class="input input-md" />
        </label>
        <button type="submit" class="rounded-md bg-sky-700 px-4 py-2 font-semibold text-white hover:bg-sky-800">
            Ajouter un episode
        </button>
    </form>


</div>