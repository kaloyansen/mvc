<?php namespace view;
/**
 * @desc static part of the web page
 * @abstract static frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.2
 */
class Gabarit {

    private $contenu;
    function __construct($contenu) {    $this->contenu = $contenu;    }
    function tourne(object $oo): void {
    	$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'guest';
    	$favicon = IMG.'/favicon.ico'; ?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title><?=$oo->title;?></title>
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=MEDIA;?>/css/style.css"/>
    <link rel = "icon" type = "image/x-icon" href = "<?=$favicon;?>" />
    <link rel = "SHORTCUT ICON" href = "<?=$favicon;?>" />
    <meta name="application-name" content="<?=APPNAME;?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?=$oo->description;?>"/>
    <meta name="keywords" content="<?=$oo->keywords;?>"/>
    <meta name="author" content="Kaloyan KRASTEV"/>
  </head>
  <body id="top">
	<div id="main">
	  <header><h1><?=$oo->title;?></h1></header>
	  <nav class="navbar fixed-top navbar-expand-lg navbar-info row">
        <a class="nav-item loco col" title="home" href="<?=WWW;?>"><span class="fa fa-refresh"></span></a>
        <a class="nav-item loco col" href="<?=WWW;?>?page=author"><span class="fa fa-euro"></span></a>
        <a class="nav-item loco col" title="last" href="<?=WWW;?>?page=objet"><span class="fa fa-gift"></span></a>
        <a class="nav-item loco col" title="list" href="<?=WWW;?>?page=all"><span class="fa fa-list"></span></a>
        <a class="nav-item loco col" title="new" href="<?=WWW;?>?page=insert"><span class="fa fa-plus"></span></a>
        <a class="nav-item loco col" href="<?=WWW;?>?page=deconnexion"><?php
        if ($user == 'guest') echo '<span class="fa fa-sign-in" title="log in">'.$user.'</span>';
        else echo '<span class="fa fa-sign-out" title="log out">'.$user.'</span>';?>
        </a>
      </nav>
      <?=$this->contenu;?>
      <footer>
        <address>
          Kaloyan KRASTEV, 32 quai Xavier JOUVIN Grenoble FRANCE
          <a class="loco fa fa-spin fa-envelope-o"
             title="kaloyansen@gmail.com"
             href="mailto:kaloyansen@gmail.com"
             target="_blank"></a>
          <a class="loco fa fa-spin fa-linkedin-square"
             title="linkedin"
             href="https://www.linkedin.com/in/kaloyan-k-krastev"
             target="_blank"></a>
          <a class="loco fa fa-spin fa-github"
             title="github.io"
             href="https://kaloyansen.github.io/mvc"
             target="_blank"></a>
          <a class="loco fa fa-spin fa-phone"
             title="+33 6 812 44 812"
             href="tel:+33681244812"
             target="_blank"></a>
          <a class="loco fa fa-spin fa-flag fa-1x"
             title="font awesome"
             href="https://fontawesome.com"
             target="_blank"></a>
          <a class="loco fa fa-spin fa-rotate-right"
             title="bootstrap"
             href="https://bootstrap.com"
             target="_blank"></a>
          <a class="loco fa fa-spin fa-rotate-left"
             style="fa-animation-direction: reverse;"
             title="bootstrap"
             href="https://bootstrap.com"
             target="_blank"></a>
        </address>
      </footer>
      <?php if (DEBUG_LEVEL > 4) {
          echo '<!--';
          echo ' debug level: '.DEBUG_LEVEL;
          echo ', local: '.LOCO;
          echo ', host: '.WWW;
          echo ', page: '.PAGE;
          echo ', method: '.METHOD;
          echo ', session: '.SESTAT;
          echo ', remote: '.REMOTE;
          echo ', user: '.$user;
          echo " -->\n";
      } ?>
	</div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <!----------------------------- jquery ---------------------->
    <script src="<?=MEDIA;?>/js/jquery-3.6.0.min.js"></script>
    <script src="<?=MEDIA;?>/js/control.js"></script>
  </body>
</html><?php
    }
} ?>

