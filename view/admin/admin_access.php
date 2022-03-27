<?php namespace view\admin;
//deprecated
if (empty($_SESSION['user'])) header('location: '.WWW.'?page=admin');
$ta = $controbjet->ticket_array; ?>

<article>

  <h2><?=$controbjet->message ?></h2>

  <ul>
    <?php foreach (array_reverse($ta) as $ticket) {
    	$id = $ticket->getId();
    	echo '<li>'.$id.' '.$ticket->getTitle();
    	echo '<a href="'.WWW.'?page=update&id='.$id.'" class="lien">[modify ticket #'.$id.']</a><a href="'.WWW.'?page=delete&id='.$id.'" class="lien">[delete ticket #'.$id.']</a>';
    	echo '</li>';
    } ?>
  </ul>

</article>
