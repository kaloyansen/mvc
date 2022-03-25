<?php namespace view\admin; ?>
<article>

  <div class="box">

    <h2><?=$controbjet->message;?></h2>

    <form method="post"
          action="<?=$controbjet->action;?>">
      <p><input id="pseudo"
                type="text"
                name="pseudo"
                placeholder="pseudo"/></p>
      <span class="pseudoErr"></span>
      <p><input id="password"
                type="password"
                name="password"
                placeholder="password"/></p>
      <span class="passwordErr"></span>
	  <p><input id="submit"
	            type="submit"
	            value="entrer"/></p>
      <span class="submitErr"></span>
    </form>
  </div>
</article>
