<p>Par <em><?= $news['auteur'] ?></em>, le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['titre'] ?></h2>
<p><?= nl2br($news['contenu']) ?></p>
 
<?php if ($news['dateAjout'] != $news['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>
 
<?php
if (empty($comments)) : ?>
    <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php endif ; ?>

<div id="commentsList">
    <?php foreach ($comments as $comment) : ?>
        <fieldset>
              <legend>
                Posté par <a href="/mail-<?= $comment['mail'] ?>.html"> <strong><?= htmlspecialchars($comment['auteur']) ?></strong> </a> le <?= $comment['date']->format('d/m/Y à H\hi') ?>
                <?php if ($user->getAttribute('user') != null) : ?>
                  <?php if ($user->getAttribute('user')->fucType() == 1) : ?>
                    <a href="admin/comment-update-<?= $comment['id']; ?>.html">Modifier</a>
                    <a href="admin/comment-delete-<?= $comment['id']; ?>.html">Supprimer</a>
                  <?php endif ;?>
              <?php endif ;?>
              </legend>
          <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
        </fieldset>
    <?php endforeach ; ?>

</div>
 
<p><h2>Ajouter un commentaire</h2>
<form action="/commenter-<?php echo $news['id'] ?>.html" method="post" name="addcomment">
  <p>
    <?= $form ?>
    
    <p><input type="submit" value="Commenter" /></p>
    <input type="reset" value="clear" />
  </p>
</form>
</p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $( "form" ).on( "submit", function( event ) {
            console.log('Submit event');
            event.preventDefault();

            var $this = $(this);

            $.ajax({
                    url: $this.attr('action'), 
                    type: $this.attr('method'),
                    data: $this.serialize(),
                    datatype : 'json',
                    success: function(data){
                      data = jQuery.parseJSON(data);
                      var v = $(displayComment(data)).hide().insertAfter($("#commentsList fieldset").last()).fadeIn("slow").effect("highlight", "slow");
                      //$('form')[0].reset();
                      $('form').trigger("reset");
                      /*console.log($this[0].reset());
                      console.log(this);*/
                      //$(this)[0].reset();
                    },
                });
        });
    });
</script>
<script type="text/javascript">
    function displayComment(data){
        var newComment = "<fieldset>" + 
                               "<legend> " + 
                                    "Posté par <a href=\"mail-" + data.mail +".html\"><strong>" + data.auteur + "</strong></a> le "+ data.date + 
                                "</legend>" + 
                                "<p>"+ data.contenu +"</p>" +
                          "</fieldset>";
        return newComment;
    }
</script>


