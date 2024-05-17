<?php
ob_start();
?>

<section class="screen">
  <table class="tbl">
    <thead>
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($technos as $techno) {?>
        <tr>
          <td><?= $techno->getId();?></td>
          <td><?= $techno->getLibelle();?></td>
          <td class="actions">
            <a href="/lp-admin/technos/<?= $techno->getId();?>/edit" class="btn btn-update">Modifier</a>
            <a href="/lp-admin/technos/<?= $techno->getId();?>/delete" class="btn btn-error">Suprimmer</a>
          </td>
        </tr>
      <?php }?>
    </tbody>
  </table>

  <form action="/lp-admin/technos/create" method="post" class="form">
    <div class="heading">
      <h1 class="m-b-20">Ajouter</h1>
    </div>

    <hr class="hr" />

    <div class="fields">
      <div class="blockInput">
        <input class="input" type="text" name="name" value="<?php echo old("name");?>" placeholder="Nom" autocomplete="off">
        <span class="error"><?php echo error("name");?></span>
      </div>
      
      <button type="submit" name="button" class="btn btn-filled">Valider</button>
    </div>
    </div>
  </form>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';