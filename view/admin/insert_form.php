<?php namespace view\admin;
//if (empty($_SESSION['user'])) header('location: '.WWW.'?page=admin');
$color = \Colors\RandomColor::one(array('luminosity'=>'light'));?>
<article>

  <div class="box">

    <h2><?= $controbjet->message; ?></h2>

    <form method="post" action="">
      <p><input type="hidden" name="new_ticket_form_fill" value="true" /></p>
      <p><input id="title" type="text" name="title" placeholder="title" /></p>
      <span class="titleErr"></span>
      <p><textarea id="body" name="body" placeholder="body"></textarea></p>
      <span class="bodyErr"></span>
      <p><input id="position" type="text" name="position" placeholder="position" /></p>
      <span class="positionErr"></span>
      <p><input id="status" type="text" name="status" placeholder="status" /></p>
      <span class="statusErr"></span>
      <p><input id="color" type="text" name="color" value="<?=$color;?>" style="background-color: <?=$color;?>;"></p>
      <span class="colorErr"></span>
      <p><input id="description" type="text" name="description" placeholder="description" /></p>
      <span class="descriptionErr"></span>
      <p><input id="keywords" type="text" name="keywords" placeholder="keywords" /></p>
      <span class="keywordsErr"></span>
	  <p><input id="submit" type="submit" value="create ticket" /></p>
	  <span class="submitErr"></span>
    </form>
  </div>
</article>