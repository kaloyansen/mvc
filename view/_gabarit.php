<?php namespace view;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'guest';
$titre = $view_titre ? $view_titre : 'no title';
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title><?=$titre;?></title>
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <!--  link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous" -->
    <link rel="stylesheet" href="<?=MEDIA;?>/css/style.css"/>
    <meta name="application-name" content="<?=APPNAME;?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?=$view_description;?>"/>
    <meta name="keywords" content="<?=$view_keywords;?>"/>
    <meta name="author" content="Kaloyan KRASTEV"/>
  </head>
  <body id="top">
	<div id="main">
	  <header><h5><?=$titre;?></h5></header>
      <nav>
        <a class="loco" href="<?=WWW;?>">home</a>
        <a class="loco" href="<?=WWW;?>?page=objet">last</a>
        <a class="loco" href="<?=WWW;?>?page=liste">list</a>
        <a class="loco" href="<?=WWW;?>?page=insert">new</a>
        <a class="loco" href="<?=WWW;?>?page=deconnexion"><?=$user;?></a>
        <a class="loco" href="<?=WWW;?>?page=deconnexion"><?php
        if ($user == 'guest') { ?> login <?php
          } else { ?> logout <?php
          } ?></a>
      </nav>
      <?=$content;?>
      <footer>
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
        <address>
          code by Kaloyan KRASTEV, 32 quai Xavier JOUVIN Grenoble FRANCE
          <a class="loco" href="mailto:kaloyansen@gmail.com">kaloyansen@gmail.com</a>
          <a class="loco" href="tel:+33681244812">+33 6 812 44 812</a>
          <a href="https://kaloyansen.github.io/mvc"
             target="_blank"
             rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="22"
                 height="22"
                 viewBox="0 0 512 499.36"
                 role="img">
              <path fill="currentColor"
                    fill-rule="evenodd"
                    d="M256 0C114.64 0 0 114.61 0 256c0 113.09 73.34 209 175.08 242.9 12.8 2.35 17.47-5.56 17.47-12.34 0-6.08-.22-22.18-.35-43.54-71.2 15.49-86.2-34.34-86.2-34.34-11.64-29.57-28.42-37.45-28.42-37.45-23.27-15.84 1.73-15.55 1.73-15.55 25.69 1.81 39.21 26.38 39.21 26.38 22.84 39.12 59.92 27.82 74.5 21.27 2.33-16.54 8.94-27.82 16.25-34.22-56.84-6.43-116.6-28.43-116.6-126.49 0-27.95 10-50.8 26.35-68.69-2.63-6.48-11.42-32.5 2.51-67.75 0 0 21.49-6.88 70.4 26.24a242.65 242.65 0 0 1 128.18 0c48.87-33.13 70.33-26.24 70.33-26.24 14 35.25 5.18 61.27 2.55 67.75 16.41 17.9 26.31 40.75 26.31 68.69 0 98.35-59.85 120-116.88 126.32 9.19 7.9 17.38 23.53 17.38 47.41 0 34.22-.31 61.83-.31 70.23 0 6.85 4.61 14.81 17.6 12.31C438.72 464.97 512 369.08 512 256.02 512 114.62 397.37 0 256 0z"/></svg></a>
        </address>
      </footer>
	</div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <!----------------------------- jquery ---------------------->
    <script src="<?=MEDIA;?>/js/jquery-3.6.0.min.js"></script>
    <script src="<?=MEDIA;?>/js/control.js"></script>
  </body>
</html>

