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
if(!isset($_GET['id']) || !isset($_GET['c']) || !isset($_GET['id_livre']))
{
  header('Location: '.ROOTPATH.'/index.php');
  exit();
}

/* les fcts */
if($_GET['c']==1)
$requete="UPDATE `livre` SET `date_debut` = CURRENT_DATE(), `etudiant` = '".$_GET['id']."', `etudiant_dem` =0 WHERE `livre`.`id_livre` =".$_GET['id_livre'].";";
elseif($_GET['c']==0)
$requete="UPDATE `livre` SET `etudiant_dem` = 0 WHERE `livre`.`id_livre` =".$_GET['id_livre'].";";
else
$requete="UPDATE `livre` SET `etudiant` = 0 WHERE `livre`.`id_livre` =".$_GET['id_livre'].";";
if(sqlquery($requete,0))
{
  header('Location: '.ROOTPATH.'/admin/livres_demandes.php');
  exit();
}



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
<h2 class="title"> Confirmation echouer !</h2>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
