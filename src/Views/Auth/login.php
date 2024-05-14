<?php
ob_start();
?>

<section class="screen">
  <form action="/login/" method="post" class="form">
    <div class="heading">
      <h1 class="m-b-20">S'identifier en tant qu'admin</h1>
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
  
      <button type="submit" name="button" class="btn btn-filled">S'identifier</button>
    </div>
  </form>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';