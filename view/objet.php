<?php namespace view;
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
      if ($user != 'guest') {
          echo '<a id="modify" class="lien" href="'.WWW.'?page=update&id='.$id.'">[modify ticket #'.$id.']</a>';
          echo '<a id="delete" class="lien" href="'.WWW.'?page=delete&id='.$id.'">[delete ticket #'.$id.']</a>';
      }
      //echo $ticket->getLove();
      echo '<a id="love" class="lien" href="'.WWW.'?page=love&id='.$id;
      if ($ticket->getLove() > 0) echo '">[stop love ticket #'.$id.']</a>';
      else echo '">[love ticket #'.$id.']</a>';
  } ?>
</article>
