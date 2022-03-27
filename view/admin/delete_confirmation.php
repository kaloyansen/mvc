<?php namespace view\admin;
//if (empty($_SESSION['user'])) header('location: '.WWW.'?page=admin');
$ta = $controbjet->ticket_array; ?>

<article>

  <?php echo $ta[0]; ?>

  <div class="box">

    <h2><?= $controbjet->message; ?></h2>

    <form method="post" action="">
      <p><input type="submit" name="delete_ticket_form_fill" value="yes"/></p><span class="submitErr"></span>
      <p><input type="submit" name="delete_ticket_form_fill" value="no"/></p><span class="submitErr"></span>
    </form>
  </div>

</article>
