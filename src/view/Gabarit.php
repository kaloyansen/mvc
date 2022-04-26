<?php namespace view;
/**
 * @desc static part of the web page
 * @abstract static frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Gabarit {

    private $contenu;
    function __construct($contenu) {    $this->contenu = $contenu;    }
    function tourne(object $oo): void {

    	$moi = 'Kaloyan KRASTEV, 32 quai Xavier JOUVIN Grenoble FRANCE';
    	$favicon = IMG.'/favicon.ico';
    	$user = false;

    	if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $decotitle = 'sign out';
            $decoclass = 'fa fa-sign-out';
            $decontent = explode('@', $user)[0];
        } else {
        	$decotitle = 'sign in';
        	$decoclass = 'fa fa-sign-in';
        	$decontent = '';
        } ?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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

        <?php if (false) { ?>
        <a class="nav-item loco col" title="home" href="<?=WWW;?>?page=objet">
        <span class="fa fa-user"></span></a>
        <a class="nav-item loco col" title="list" href="<?=WWW;?>?page=all">
        <span class="fa fa-list"></span></a>
        <?php } ?>

        <a class="nav-item loco col" title="cuisiniers" href="<?=WWW;?>?page=author">
        <span class="fa fa-refresh"></span></a>

        <a class="nav-item loco col" title="new" href="<?=WWW;?>?page=admin">
        <span class="fa fa-plus"></span></a>

        <?php if ($user) { ?>
        <a class="nav-item loco col" title="<?=$decotitle;?>" href="<?=WWW;?>?page=deconnexion">
        <span class="<?=$decoclass;?>" title="<?=$decotitle;?>"><?=$decontent;?></span></a>

        <?php } else { ?>
        <a class="nav-item loco col" title="about" href="https://kaloyansen.github.io/mvc">
        <span class="fa fa-github"></span></a>
        <?php } ?>

      </nav>
      <?=$this->contenu;?>

      <footer>
        <address><?=$moi;?>

          <a class="loco fa fa-envelope-o" title="kaloyansen@gmail.com" href="mailto:kaloyansen@gmail.com" target="_blank"></a>
          <a class="loco fa fa-linkedin-square" title="linkedin" href="https://www.linkedin.com/in/kaloyan-k-krastev" target="_blank"></a>
          <a class="loco fa fa-github" title="github.io" href="https://kaloyansen.github.io/mvc" target="_blank"></a>
          <a class="loco fa fa-phone" title="+33 6 812 44 812" href="tel:+33681244812" target="_blank"></a>
          <a class="loco fa fa-flag fa-1x" title="font awesome" href="https://fontawesome.com" target="_blank"></a>
          <a class="roco fa fa-rotate-right" title="bootstrap" href="https://bootstrap.com" target="_blank"></a>
          <!-- a class="roco fa fa-rotate-left"
             style="fa-animation-direction: reverse;"
             title="bootstrap"
             href="https://bootstrap.com"
             target="_blank"></a -->
        </address>
      </footer>
      <?php if (DEBUG_LEVEL > 4) {
          echo '<!-- debug level: '.DEBUG_LEVEL;
          echo ', local: '.LOCO;
          echo ', host: '.WWW;
          echo ', page: '.PAGE;
          echo ', method: '.METHOD;
          echo ', session: '.SESTAT;
          echo ', remote: '.REMOTE;
          if (!$user) $user = 'guest';
          echo ', user: '.$user;
          echo " -->\n";
      } ?>
	</div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="<?=MEDIA;?>/js/jquery-3.6.0.min.js"></script>
    <!-- script src="<?=MEDIA;?>/js/spin.js"></script -->
  </body>
</html>
<?php
    }
} ?>

