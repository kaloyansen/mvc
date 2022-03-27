<?php namespace view\site;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'guest';
$ta = $controbjet->ticket_array;
?>

<article>

  <h2><?=$controbjet->message;?></h2>

  <?php foreach (array_reverse($ta) as $ticket) {
      $id = $ticket->getId();
      //echo '<a href="'.WWW.'?page=objet&id='.$id.'">';
      echo $ticket;
      //echo '</a>';
      if ($user != 'guest') echo '<a id="modify" class="lien" href="'.WWW.'?page=update&id='.$id.'">[modify ticket #'.$id.']</a><a id = "delete" class="lien" href="'.WWW.'?page=delete&id='.$id.'">[delete ticket #'.$id.']</a>';
  } ?>
</article>
