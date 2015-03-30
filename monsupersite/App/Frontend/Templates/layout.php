<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Mon super site' ?>
    </title>
    
    <meta charset="utf-8" />
    
    <link rel="stylesheet" href="/css/Envision.css" type="text/css" />
  </head>
  
  <body>
    <div id="wrap">
      <header>
        <h1><a href="/">Mon super site</a></h1>
        <p>Comment ça, il n'y a presque rien ?</p>
      </header>
      
      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>
          <?php if (!$user->isAuthenticated()) { ?>
          <li><a href="/admin/">Connexion</a></li>
          <li><a href="/signin/">Sign in</a></li>
          <?php } ?>
          <?php if ($user->isAuthenticated()) { ?>
              <?php if ($user->getUser()->fucType() == 1) { ?>
                  <li><a href="/admin/">Admin</a></li>
                  <li><a href="/admin/gestionecrivain/">Gestion Ecrivain</a></li>
              <?php } ?>
              <li><a href="/admin/news-insert.html">Ajouter une news</a></li>
              <li><a href="/admin/logout/">Déconnexion</a></li>
              <li><a href="">Bonjour <?php echo $user->getUser()->fucNom(); ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
          
          <?= $content ?>
        </section>
      </div>
    
      <footer></footer>
    </div>
  </body>
</html>