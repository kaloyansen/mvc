<?php namespace view\admin; ?>


<article>
  <h2><?=$controbjet->message;?></h2>
  <div id="result"></div>
  <div class="row" id="connection">

    <form id="form"
          action="<?=$controbjet->action;?>"
          method="post"
          enctype="application/x-www-form-urlencoded"
          class="col-md-6 col-lg-5 ml-auto mb-4 pt-3 pb-4 px-4">
      <div class="form-group">
        <label for="login">identifiant</label>
        <input type="email"
               class="form-control"
               id="login"
               name="pseudo"
               maxlength="255"
               value=""
               placeholder="identifiant" required />
        <span class="pseudoErr"></span>
      </div>
      <div class="form-group">
        <label for="password">mot de passe</label>
        <input type="password"
               class="form-control"
               id="password"
               name="password"
               maxlength="6"
               value=""
               placeholder="mot de passe" disabled required />
        <span class="passwordErr"></span>
      </div>
      <div id="pad" class="form-group mx-auto my-4"></div>
      <div class="mt-3 text-center">
        <button type="button" class="btn btn-secondary" id="reset">Effacer</button>
        <button type="submit" class="btn btn-primary" id="validate">Valider</button>
      </div>
    </form>
  </div>
</article>

<script src="<?=MEDIA ?>/js/keypad.js"></script>

