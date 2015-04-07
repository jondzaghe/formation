<p>Par <em><?= $news['auteur'] ?></em>, le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['titre'] ?></h2>
<p><?= nl2br($news['contenu']) ?></p>
 
<?php if ($news['dateAjout'] != $news['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>
 
<?php
if (empty($comments))
{
?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php
}
 
foreach ($comments as $comment)
{
?>
<fieldset>
  <legend>
    Posté par <a href="/mail-<?= $comment['mail'] ?>.html"> <strong><?= htmlspecialchars($comment['auteur']) ?></strong> </a> le <?= $comment['date']->format('d/m/Y à H\hi') ?>
    <?php if ($user->getAttribute('user') != null) : ?>
	    <?php if ($user->getAttribute('user')->fucType() == 1) : ?> -
	      <a href="admin/comment-update-<?= $comment['id']; ?>.html">Modifier</a> |
	      <a href="admin/comment-delete-<?= $comment['id']; ?>.html">Supprimer</a>
	    <?php endif ;?>
	<?php endif ;?>
  </legend>
  <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
</fieldset>
<?php
}
?>
 
<p><h2>Ajouter un commentaire</h2>
<form action="/commenter-<?php echo $news['id'] ?>.html" method="post">
  <p>
    <?= $form ?>
    
    <p><input type="submit" value="Commenter" /></p>
  </p>
</form>
</p>

<script type="text/javascript">
    $(document).ready(function() {
        $( "form" ).on( "submit", function( event ) {
            event.preventDefault();

            var $this = $(this);
   
            // Je récupère les valeurs
            var pseudo = $('#pseudo').val();
            var mail = $('#mail').val();

            $.ajax({
                    url: $this.attr('action'), 
                    type: $this.attr('method'),
                    data: $this.serialize(),
                    datatype : 'json',
                });
        });
    });
</script>



<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>