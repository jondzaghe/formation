<?php
if($listItem == null){
	echo "Il n'y pas de news";
}

// echo "Chemin : " . ini_get( 'session.save_path');
//unlink('C:/Users/jondzaghe/Desktop/UwAmp/bin/apache/sessions/sess_'.session_id());

foreach ($listItem as $item)
{
?>
  <h2><a href="news-<?= $item['news']['id'] ?>.html"><?= $item['news']['titre'] ?></a></h2>
  <p><?= nl2br($item['news']['contenu']) ?><br> <a href="author-<?php echo $item['news']['auteur']?>/<?php echo $item['user']->getUrlName()?>.html"?> <?php echo $item['user']->fucLastname() . " " . $item['user']->fucFirstname()?></a></p>
<?php
}