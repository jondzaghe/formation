<?php
foreach ($listItem as $item)
{
?>
  <h2><a href="news-<?= $item['news']['id'] ?>.html"><?= $item['news']['titre'] ?></a></h2>
  <p><?= nl2br($item['news']['contenu']) ?><br> <a href="author-<?php echo $item['news']['auteur']?>/<?php echo $item['user']->fucNom(). $item['user']->fucPrenom()?>.html"?> <?php echo $item['user']->fucNom() . " " . $item['user']->fucPrenom()?></a></p>
<?php
}