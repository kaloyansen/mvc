<?php namespace view\site;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'guest';
$ta = $controbjet->ticket_array;
?>

<article>

  <div class="box">

  <h2><?=$controbjet->message;?></h2>
  <ul>
    <?php foreach (array_reverse($ta) as $ticket) {
        $id = $ticket->getId();

        echo '<li>';
        echo '<a class="lien" style="background-color: '.$ticket->getColor().';" href="'.WWW.'/?page=objet&id='.$id.'">';
        echo $id.' '.$ticket->getTitle().' '.$ticket->getDescription().' '.$ticket->getColor();
        echo '</a>';
        if ($user != 'guest') echo '<a id="modify" class="lien" href="'.WWW.'/?page=update&id='.$id.'">[modify ticket #'.$id.']</a><a id="delete" class="lien" href="'.WWW.'/?page=delete&id='.$id.'">[delete ticket #'.$id.']</a>';
        echo '</li><br />';
    } ?>
  </ul>
  </div>

</article>
