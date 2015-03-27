<p style="text-align: center">Liste des ecrivains enregistrés</p>
 
<table>
  <tr><th>Nom</th><th>Prenom</th></tr>
<?php
foreach ($listeEcrivain as $liste)
{
  echo '<tr><td>', $liste->fucNom(), '</td><td>', $liste->fucPrenom(), '</td></tr>', "\n";
}

?>
</table>