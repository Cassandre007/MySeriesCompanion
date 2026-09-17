<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-ajout.php';
require_once __DIR__ . '/../inc/bdd.php';

$pdo = connexionBdd();


if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $saisie = $_POST;
    $nom = $saisie['nom'] ?? null;
    $resume = $saisie['resume'] ?? null;
    $vignette =  $saisie['vignette'] ?? null;
    $date_sortie =  $saisie['date_sortie'] ?? null;
    if ( $nom != null && $date_sortie != null){
        $id = ajoutSerie($pdo, $nom, $resume, $vignette, $date_sortie);
        header("Location: detail-serie.php?serie=" . (int) $id);
        exit;
    }
    header("Location: ajout-serie.php");
    exit;
}

require __DIR__ . '/../inc/entete.php';
?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter une série</h2>
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
        <button type="submit" class="btn btn-block  btn-neutral">
            Ajouter une série
        </button>
    </form>
</div>
<?php require __DIR__ . '/../inc/pied.php'; ?>

