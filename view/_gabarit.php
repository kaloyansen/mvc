<?php namespace view;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'guest';
$titre = $view_titre ? $view_titre : 'no title';
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title><?=$titre;?></title>
    <link rel="stylesheet" href="./media/css/style.css"/>
    <meta name="application-name" content="<?=APPNAME;?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?=$view_description;?>"/>
    <meta name="keywords" content="<?=$view_keywords;?>"/>
    <meta name="author" content="Kaloyan KRASTEV"/>
  </head>
  <body>
	<div id="main">
	  <header><h5><?=$titre;?></h5></header>
      <nav>
        <h4><?=$user;?></h4>
        <ul>
          <!-- administrator menu -->
          <li><a class="lien" href="<?=WWW ?>?page=objet">last</a></li>
          <li><a class="lien" href="<?=WWW ?>?page=liste">list</a></li>
          <li><a class="lien" href="<?=WWW ?>?page=insert">new</a></li>
          <li><a class="lien" href="<?=WWW ?>?page=deconnexion">
          <?php if ($user == 'guest') { echo 'log in'; } else { echo 'log out'; } ?>
          </a></li>
        </ul>
      </nav>
      <?=$content;?>
      <footer>
         <?php echo "<h6>php code by Kaloyan KRASTEV, kaloyansen@gmail.com</h6>\n";
         if (DEBUG_LEVEL > 4) {
         	echo '<!--';
         	echo ' debug level: '.DEBUG_LEVEL;
         	echo ', local: '.LOCO;
         	echo ', host: '.WWW;
         	echo ', page: '.PAGE;
         	echo ', method: '.METHOD;
         	echo ', session: '.SESTAT;
         	echo ', user: '.$user;
         	echo " -->\n";
         } ?>
        <address>
          <a href="mailto:kaloyansen@gmail.com">kaloyansen@gmail.com</a>
          <a href="tel:+33681244812">+33 6 812 44 812</a>
        </address>

      </footer>
	</div>
    <!----------------------------- jquery ---------------------->
    <script src="<?=WWW_MEDIA;?>/js/jquery-3.6.0.min.js"></script>
    <script src="<?=WWW_MEDIA;?>/js/control.js"></script>
  </body>
</html>

