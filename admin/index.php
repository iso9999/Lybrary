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

$titre = 'Principale_admin';

include('includes/top_a.php');
?>

<nav class="nav">

<?php
include('includes/nav_a.php');
?>
</nav>

<div class="content">
<h2 class="title">Confirmation des comptes : </h2><br>
<?php
$requete="SELECT * FROM etudiant WHERE isConfirmed='a';";
    $result=sqlquery($requete,2);
    if(count($result)==0)
    	echo "<p class=\"rep\">Pas des comptes a confirmé</p>";
    else
    for($i=0;$i<count($result);$i++)
    {
      echo '<div class="etude_line">
      <a class ="etudi" href="etud.php?id='.$result[$i]['id'].'"><img class="img_line" src="../etudiant/src/images/users/'.$result[$i]['id'].'.jpg">
      <span class="e_line">'.$result[$i]['nom'].' '.$result[$i]['prenom'].'</span></a>
      <div class="button_line">
      <input class="etud__button" type="button" name="chg_infos" value="Confirmer" onclick="window.location = \'confirm.php?id='.$result[$i]['id'].'&c=1\';">
      <input class="etud__button" type="button" name="chg_infos" value="Refuser" onclick="window.location = \'confirm.php?id='.$result[$i]['id'].'&c=0\';"></div></div>';
    }
//list_unconfirmed_acounts();
//list_levels();
?>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
