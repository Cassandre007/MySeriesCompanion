<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-ajout.php';
require_once __DIR__ . '/../inc/bdd.php';

$pdo = connexionBdd();


if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $saisie = $_POST;
    $nom = $saisie['nom'];
    $resume = $saisie['resume'] ;
    $vignette =  $saisie['vignette'];
    $date_sortie =  $saisie['date_sortie'];
    if ( $nom != null && $date_sortie != null){
        ajoutSerie($pdo, $nom, $resume, $vignette, $date_sortie);
        header('Location: index.php');
        exit;
    }
}

require __DIR__ . '/../inc/entete.php';
?>

<div>
    <h2 class="collapse-title font-semibold ">Ajouter une série</h2>
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
        <button type="submit" class="rounded-md bg-sky-700 px-4 py-2 font-semibold text-white hover:bg-sky-800">
            Ajouter une série
        </button>
    </form>


</div>
<?php require __DIR__ . '/../inc/pied.php'; ?>