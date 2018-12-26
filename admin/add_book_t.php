<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

/********Actualisation de la session...**********/

include('../includes/fonctions.php');
connexiondb();
actualiser_session();

/********Fin actualisation de session...**********/
if(!isset($_SESSION['id_admin']))
{
  header('Location: '.ROOTPATH.'/index.php');
  exit();
}
/* les fcts */

/* fin dec*/

$titre = 'Principale';

include('includes/top_a.php');
?>

<nav class="nav">

<?php
include('includes/nav_a.php');
?>
</nav>

<div class="content">

<?php 

if(isset($_POST['libelle']) && isset($_POST['theme']) && isset($_POST['description']) && isset($_POST['auteur']))
{


$create="INSERT INTO `livre`(`id_livre`, `libelle_livre`, `auteur`, `description`, `date_debut`, `etudiant`, `theme`, `etudiant_dem`)
VALUES
(NULL,
	'".mysql_real_escape_string($_POST['libelle'])."',
	'".mysql_real_escape_string($_POST['auteur'])."',
	'".mysql_real_escape_string($_POST['description'])."',
	CURRENT_DATE,
	0,
	'".mysql_real_escape_string($_POST['theme'])."',
	0)";
if(mysql_query($create))
{

	echo '<h2 class="title">l\'ajout de livre a bien été passé !</h2>';
		$requete="SELECT id_livre FROM `livre` WHERE id_livre >= ALL (SELECT id_livre FROM livre);";
		$result=sqlquery($requete,1);
		$id=$result['id_livre'];
		$uploads_dir = "../src/images/books_covers/";
		$name = $id.".jpg";
		copy('default.jpg','../src/images/books_covers/'.$id.'.jpg');

}

else
echo '<h2 class="title">Vous avez rempli le formulaire d\'inscription du site et nous vous en remercions, cependant, nous n\'avons
			pas pu valider votre inscription,</h2>';
}
else
echo '<h2 class="title">Vous avez rempli le formulaire d\'inscription du site et nous vous en remercions, cependant, nous n\'avons
			pas pu valider votre inscription,</h2>';
?>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
