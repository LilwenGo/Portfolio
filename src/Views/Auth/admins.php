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
      <?php foreach($admins as $admin) {?>
        <tr>
          <td><?= $admin->getId();?></td>
          <td><?= $admin->getUsername();?></td>
          <td class="actions">
            <a href="/lp-admin/admins/<?= $admin->getId();?>/edit" class="btn btn-update">Modifier</a>
            <a class="btn btn-error">Suprimmer</a>
          </td>
        </tr>
      <?php }?>
    </tbody>
  </table>

  <form action="/lp-admin/admins/create" method="post" class="form">
    <div class="heading">
      <h1 class="m-b-20">Ajouter</h1>
    </div>

    <hr class="hr" />

    <div class="fields">
      <div class="blockInput">
        <input class="input" type="text" name="username" value="<?php echo old("username");?>" placeholder="Nom" autocomplete="off">
        <span class="error"><?php echo error("username");?></span>
      </div>
  
      <div class="blockInput">
        <input class="input" type="password" name="password" value="<?php echo old("password");?>" placeholder="Mot de passe" autocomplete="off">
        <span class="error"><?php echo error("password");?></span>
      </div>

      <div class="blockInput">
        <input class="input" type="password" name="passwordConfirm" value="<?php echo old("passwordConfirm");?>" placeholder="Confirmer" autocomplete="off">
        <span class="error"><?php echo error("passwordConfirm");?></span>
      </div>
  
      <button type="submit" name="button" class="btn btn-filled">S'identifier</button>
    </div>
  </form>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';