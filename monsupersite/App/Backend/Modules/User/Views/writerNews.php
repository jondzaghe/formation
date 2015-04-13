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

<a id="addnews" href="/admin/getInsertForm.html"><h1><img src="/images/update.png" alt="Modifier" /> &nbsp; Ajouter une news</h1></a>

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
                    datatype : 'json',
                    success: function(data, statut){
                        //data = jQuery.parseJSON(data);
                        //console.log(data.data);
                        form(data);

                    },
                });
            $("#dialog-form").empty();

        });
    });
</script>





<script type="text/javascript">
	function form(data){
		$("#dialog-form").append("<form>" + data.data + "</form>").dialog({
        resizable: false,
        modal: true,
        title: "Ajouter une news",
        height: 300,
        width: 500,
        buttons: {
              "Enregistrer": function() {
                    addNews($( this ));
              },
              Annuler: function() {
                  $( this ).dialog( "close" );
                }
        },
        position: {
              my: "center",
              at: "center"
        }
    });
	}
</script>





<script type="text/javascript">
    function addNews(modal){
      var $this = $('form');

      $.ajax({
              url: '/admin/news-insert.html', 
              type: 'POST',
              data: $this.serialize(),
              datatype : 'json',
              success: function(data){

                $('form').find('div').empty();
                $('form').find('[name]').css("background-color", '#ffffff');

                //console.log(data.code);
                if(data != null){
                  switch(data.code){
                    case 200:
                          //console.log(data);
                          modal.dialog("close");
                          var v = $(displayNews(data.data)).hide().insertAfter($("table tr").last()).fadeIn("slow").effect("highlight", "slow");
                    break;

                    case 500:
                        //console.log(data.data);
                        $.each( data.data, function( index, value ){
                            //console.log(data.data.titre);
                            $('form').find('div[id="'+index+'"]').html(value);
                            $('form').find('[name="'+index+'"]').css("background-color", '#ffbbbb');
                        });
                    break;
                  }
                }
                else{
                }
              },
          });
    }
</script>




<script type="text/javascript">
    function displayNews(data){
        var news = "<tr>" +
                    "<td>" +data.auteur+ "</td>" +
                    "<td>" +data.titre+ "</td>" +
                    "<td>" + data.dateAjout + "</td>" +
                    "<td>-</td>" +
                    "<td><a href=\"\"><img src=\"/images/update.png\" alt=\"Modifier\" /></a> <a href=\"\"><img src=\"/images/delete.png\" alt=\"Supprimer\" /></a></td>" + 
                    "</tr>";
        return news;
    }
</script>



