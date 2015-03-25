SYNTAXE DE BASE

CREATION D'UNE CLASSE
******************************************

<?php 

	class Nom_de_la_classe{

		public function __construct(){

		}
	}

?>

******************************************





CREATION D'UNE METHODE
******************************************

<?php 

	public function nom_fonction(){	
	}

?>

******************************************





MANIPULATION D'UN OBJET
******************************************

- CREATION D'UN OBJET

	<?php 

		$objet = new Nom_de_la_classe ;

	?>


- APPELER LES METHODES/ATTRIBUTS DE L'OBJET

	<?php 

		$objet->nom_fonction();

	?>

- ACCEDER AU ELEMENT DEPUIS LA CLASSE

	<?php 

		$this->nom_elepent;

	?>

******************************************





DECLARATION DES CONSTANTES
******************************************
<?php 
	const NOM_CONSTANTE = valeur; 

	//ACCEDER A UNE CONSTANTE
	Nom_class::NOM_CONSTANTE;
?>
******************************************




ATTRIBUTS ET METHODES STATIQUES
*****************************************
<?php 

	//ATTRIBUT
	private static $variable = 0;

	//METHODE ( !!!! PAS DE $THIS DANS UNE METHODE STATIQUE)
	public static function(){
	}

	//SELF
	self::$elementclass ; 

?>
*****************************************




HERITAGE
*****************************************
<?php 
	class ClassA extends ClassB{
	}
?>
*****************************************





ELEMENT ABSTRAIT
*****************************************

- CLASS ABSTRAITE
	<?php 
		// IMPOSSIBLE D'INSTANCIER UNE CLASSE ABSTRAITE
		abstract class Nom_class{
		}
	?>


- METHODE ABSTRAITE
	<?php 
		// A REECRIRE DANS LA CLASS FILLE
		abstract function Nom_class{
		}
	?>


*****************************************





ELEMENT FINAL
*****************************************

- CLASS FINALE
	<?php 
		final class Nom_class{
		}
	?>


- METHODE FINALE
	<?php 
		final function Nom_class{
		}
	?>


*****************************************





INTERFACE
*****************************************
<?php 
	interface Nom_interface {
	}

	class Nom_classe implements Nom_interface{
		//METHODE PUBLIQUE
	}
?>
*****************************************





EXCEPTION
*****************************************
- LANCER UNE EXCEPTION
	<?php 
		throw new Exception("Message d'erreur") ;
	?>

- 	ATTRAPER UNE EXCEPTION
	<?php 
		try{

		} catch (Exception $e){

		}
	?>
*****************************************




LES TRAITS
*****************************************
<?php 

	trait Nom_trait{
		public function nom_function(){
			//QUELQUE CHOSE
		}
	}

	class A{
		use MonTrait;
	}

	$a = new A;
	$a->hello();

?>
*****************************************





CLOSURE
*****************************************
<?php 

	function(){
	};

	// OU 
	
	$maFonction = function(){
	};
?>
*****************************************