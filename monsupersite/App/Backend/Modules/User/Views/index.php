<p><h1 style="text-align: center">LISTE DES UTILISATEURS</h1></p>
 

<h2>Liste des Administrateurs</h2>
<p>&nbsp;</p>
<table>
  <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Actions</th></tr>
<?php
foreach ($listAdmin as $liste)
{
  echo '<tr><td>', $liste->fucLastname(), '</td><td>', $liste->fucFirstname(), '</td><td>', $liste->fucMail(), '</td><td><a href="user-update-', $liste->fucId(), '.html"><img src="/images/update.png" alt="Supprimer" /></a>&nbsp;&nbsp;<a href="user-delete-', $liste->fucId(), '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}

?>
</table>

<p>&nbsp;</p>
<h2>Liste des Ecrivains</h2>
<p>&nbsp;</p>
<table>
  <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Actions</th></tr>
<?php
if ($listWriter != null){
	foreach ($listWriter as $liste){
	  echo '<tr><td>', $liste->fucLastname(), '</td><td>', $liste->fucFirstname(), '</td><td>', $liste->fucMail(), '</td><td><a href="user-update-', $liste->fucId(), '.html"><img src="/images/update.png" alt="Supprimer" /></a>&nbsp;&nbsp;<a href="user-delete-', $liste->fucId(), '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
	}
}

?>
</table>

<p>&nbsp;</p>
<h2>Liste des Ecrivains connectés</h2>
<p>&nbsp;</p>
<table>
  <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Derniere action</th><th>Actions</th></tr>
<?php
if ($listActiveWriter != null){
	foreach ($listActiveWriter as $liste){
	  echo '<tr><td>', $liste['writer']->fucLastname(), '</td><td>', $liste['writer']->fucFirstname(), '</td><td>', $liste['writer']->fucMail(), '</td><td>', $liste['date'], '</td><td>&nbsp;<a href="user-', $liste['writer']->fucid() ,'-deconnection.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
	}
}

?>
</table>

<p>&nbsp;</p>
<a href="adduser.html"><h1>Ajouter un utilisateur</h1></a>
