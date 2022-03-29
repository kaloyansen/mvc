<?php namespace view;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
$ta = $controbjet->ticket_array;
?>

<article>

  <div class="box">

  <h2><?=$controbjet->message;?></h2>
  <ul>
    <?php foreach (array_reverse($ta) as $ticket) {
        $id = $ticket->getId();

        echo '<li>';
        echo '<a class="lien" style="background-color: '.$ticket->getColor().';" href="'.WWW.'?page=objet&id='.$id.'">';
        echo $id.' '.$ticket->getTitle().' '.$ticket->getDescription().' '.$ticket->getColor();
        echo '</a>';
        if ($user) {
        	echo '<a id="modify" class="lien" href="'.WWW.'?page=update&id='.$id;
        	echo '">[modify ticket #'.$id.']</a>';
        	echo '<a id="delete" class="lien" href="'.WWW.'?page=delete&id='.$id;
        	echo '">[delete ticket #'.$id.']</a>';
        }
        echo '<a id="love" class="lien" href="'.WWW.'?page=love&id='.$id;
        if ($ticket->getLove() > 0) echo '">[hate ticket #'.$id.']</a>';
        else echo '">[love ticket #'.$id.']</a>';
        echo '</li><br />';



    } ?>
  </ul>
  </div>

</article>
