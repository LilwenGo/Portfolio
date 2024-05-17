<?php
ob_start();
?>

<section class="screen">
  <form action="/lp-admin/technos/<?= $techno->getId();?>/update" method="post" class="form">
    <div class="heading">
      <h1>Éditer</h1>
    </div>

    <hr class="hr" />

    <div class="fields">
      <div class="blockInput">
        <input class="input" type="text" name="name" value="<?= old("name") ?: $techno->getLibelle();?>" placeholder="Nom" autocomplete="off">
        <span class="error"><?php echo error("name");?></span>
      </div>
  
      <button type="submit" name="button" class="btn btn-filled">Modifier</button>
    </div>
  </form>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';