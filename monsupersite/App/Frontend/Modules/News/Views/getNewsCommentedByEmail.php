<?php
foreach ($listNews as $news)
{
?>
	<p><h1>Liste des news commentées par: <?php echo $mail ?></h1></p>
  	<h2><a href="../news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
  	<p><?= nl2br($news['contenu']) ?></p>
<?php
}