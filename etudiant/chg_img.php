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
<form class="etud_form" method="post" action="chg_img_t.php" enctype="multipart/form-data">
	<h2 class="title">Choisir une image :</h2><br>
	<input class="etud__button2" type="file" name="img_etud" accept="image/jpeg" required="required"><br>
	<input class="etud__button3" type="submit" name="button" value="Confirmer">
</form>
<?php
///
?>
</div>
<?php
include('includes/bottom_e.php');
mysql_close();
?>
s
