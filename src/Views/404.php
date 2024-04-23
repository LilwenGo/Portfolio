<?php
ob_start();

?>
<section class="error">
    <h1 class="error">Erreur 404</h1>
    <p>La page recherchée n'existe pas ! <a href="/">Retourner à l'accueil !</a></p>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
