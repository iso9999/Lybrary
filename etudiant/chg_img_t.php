<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

/********Actualisation de la session...**********/

include('../includes/fonctions.php');
connexiondb();
actualiser_session();

/********Fin actualisation de session...**********/
if(!isset($_SESSION['id']))
{
  header('Location: '.ROOTPATH.'/index.php');
  exit();
}
/* les fcts */



/* fin dec*/

$titre = 'Changer photo';

include('includes/top_e.php');
?>

<nav class="nav">

<?php
include('includes/nav_e.php');
?>
</nav>

<div class="content">
<h2 class="title">Changement d'image :</h2>
<?php
if(isset($_FILES['img_etud']))
{
	$uploads_dir = 'src/images/users';
	$name = $_SESSION['id'].".jpg";
	move_uploaded_file($_FILES['img_etud']['tmp_name'],"$name");
	rename("$name", "$uploads_dir/$name");
	echo "Le Changement d'image a bien été effectuer !";
}
else {echo "Vous n'avez pas bien entré l'image. Vous pouvez réessayer <a href=\"chg_img.php\">ici</a>.";}

?>
</div>
<?php
include('includes/bottom_e.php');
mysql_close();
?>
s