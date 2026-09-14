<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/fonction-ajout.php';
require_once __DIR__ . '/../inc/bdd.php';

$pdo = connexionBdd();


require __DIR__ . '/../inc/entete.php';
?>

<div>
    <h2 class="collapse-title font-semibold ">Ajouter une série</h2>
    <form action="post">
        <label class="floating-label">
            <span>Nom</span>
            <input type="text" placeholder="Nom" class="input input-md" />
        </label>
        <label class="floating-label">
            <span>Résumé</span>
            <input type="text" placeholder="..." class="input input-md" />
        </label>
        <label class="floating-label">
            <span>Vignette</span>
            <input type="text" placeholder="..." class="input input-md" />
        </label>
        <label class="input">
            <span class="label">Date de publication</span>
            <input type="date" />
        </label>
    </form>


</div>
<?php require __DIR__ . '/../inc/pied.php'; ?>