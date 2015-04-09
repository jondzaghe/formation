<p ><h1 style="text-align: center">Voici la liste de vos news</h1></p>
 
<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listNews as $news)
{
  echo '<tr><td>', $news['auteur'], '</td><td>', $news['titre'], '</td><td>le ', $news['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le '.$news['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="../../news-update-', $news['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="../../news-delete-', $news['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}

?>
</table>

<a id="addnews" href=""><h1><img src="/images/update.png" alt="Modifier" /> &nbsp; Ajouter une news</h1></a>

<div id="dialog-form"></div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


<script type="text/javascript">
    $(document).ready(function() {
        $( "#addnews" ).on( "click", function( event ) {
            event.preventDefault();

            var $this = $(this);

            $.ajax({
                    url: '/admin/getInsertForm.html', 
                    type: 'get',
                    datatype : 'html',
                    success: function(data, statut){
 						console.log(statut);
 						form(data);

                    },
                });
        });
    });
</script>

<script type="text/javascript">
	function form(data){
		$("#dialog-form").dialog({
        resizable: false,
        modal: true,
        title: "Modal",
        height: 250,
        width: 400,
    });
	}
</script>

