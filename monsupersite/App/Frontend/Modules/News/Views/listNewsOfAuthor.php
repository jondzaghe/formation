<h1>Les news publiées par: <?= $writer->fucLastname() . " " . $writer->fucFirstname();  ?></h1>
<?php
foreach ($listNews as $news)
{
?>
	
  	<h2><a href="../news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
  	<p><?= nl2br($news['contenu']) ?></p>
<?php
}