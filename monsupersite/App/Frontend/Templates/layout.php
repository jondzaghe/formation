<!DOCTYPE html>
<html>
  <head>
    <title>
      <?php if(isset($title)) : ?>
          <?php echo $title ?>
      <?php else : ?>
          Mon super site
      <?php endif; ?>
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
          <?php if (!$user->isAuthenticated()) : ?>
              <li><a href="/admin/">Connexion</a></li>
          <?php else : ?>
              <?php if ($user->getAttribute('user')->fucType() == 2) : ?>
                  <li><a href="/admin/writer-<?php echo $user->getAttribute('user')->fucId() ?>/news/">Vos news</a></li>
              <?php endif ; ?>
              <?php if ($user->getAttribute('user')->fucType() == 1) : ?>
                  <li><a href="/admin/">Admin</a></li>
                  <li><a href="/admin/usermanagment.html">Gestion des utilisateurs</a></li>
              <?php endif ; ?>
              <li><a href="/admin/logout/">Déconnexion</a></li>
              <li><a href="/admin/user-update-<?php echo $user->getAttribute('user')->fucId() ?>.html">Bonjour <?php echo $user->getAttribute('user')->fucLastname(); ?></a></li>
          <?php endif ; ?>
          <li><a href="/device.html">Your device</a></li>
        </ul>
      </nav>
      
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) : ?> 
              <?php echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
          <?php endif ; ?>
          <?php echo $content ?>
        </section>
      </div>
    
      <footer></footer>
    </div>
  </body>
</html>