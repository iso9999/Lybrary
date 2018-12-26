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
if(isset($_GET['id_livre']))
{
 $requete="SELECT `libelle_livre` FROM livre WHERE id_livre=".intval($_GET['id_livre']).";";
    $result=sqlquery($requete,1);
$titre = 'Livre : '.$result['libelle_livre'];
}
else
{
	header('Location: '.ROOTPATH.'/index.php');
  exit();
}
include('includes/top_a.php');
?>

<nav class="nav">

<?php
include('includes/nav_a.php');
?>
</nav>

<div class="content">
<?php
if(isset($_GET['id_livre']))
list_book_infos_foradmin($_GET['id_livre']);
?>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
