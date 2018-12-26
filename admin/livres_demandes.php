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
<h2 class="title">Livres demandés : </h2><br>
<?php
$requete="SELECT id_livre,libelle_livre,auteur,id,nom,prenom FROM livre,etudiant WHERE `livre`.`etudiant_dem`=`etudiant`.`id` AND etudiant_dem NOT LIKE 0;";
    $result=sqlquery($requete,2);
    if(count($result)==0)
      echo "<p class=\"rep\">Pas des livres demandé</p>";
    else
    for($i=0;$i<count($result);$i++)
    {
      echo '<div class="etude_line">
      <img class="img_line" src="../etudiant/src/images/users/'.$result[$i]['id'].'.jpg">
      <span class="e_line"><a class ="etudi" href="livre.php?id_livre='.$result[$i]['id_livre'].'">'.$result[$i]['libelle_livre'].' de '.$result[$i]['auteur'].'</a> demandé par : <a class ="etudi" href="etud.php?id='.$result[$i]['id'].'">'.$result[$i]['nom'].' '.$result[$i]['prenom'].'</a></span>

      <div class="button_line">
      <input class="etud__button" type="button" name="chg_infos" value="Accepter" onclick="window.location = \'accept.php?id='.$result[$i]['id'].'&c=1&id_livre='.$result[$i]['id_livre'].'\';">
      <input class="etud__button" type="button" name="chg_infos" value="Refuser" onclick="window.location = \'accept.php?id='.$result[$i]['id'].'&c=0&id_livre='.$result[$i]['id_livre'].'\';"></div></div>';
    }


//list_unconfirmed_acounts();
//list_levels();
?>
<h2 class="title">Livres prises : </h2><br>
<?php
$requete="SELECT id_livre,libelle_livre,auteur,id,nom,prenom FROM livre,etudiant WHERE `livre`.`etudiant`=`etudiant`.`id` AND `livre`.`etudiant` NOT LIKE 0;";
    $result=sqlquery($requete,2);
    if(count($result)==0)
      echo "<p class=\"rep\">Pas des livres prises</p>";
    else
    for($i=0;$i<count($result);$i++)
    {
      echo '<div class="etude_line">
      <img class="img_line" src="../etudiant/src/images/users/'.$result[$i]['id'].'.jpg">
      <span class="e_line"><a class ="etudi" href="livre.php?id_livre='.$result[$i]['id_livre'].'">'.$result[$i]['libelle_livre'].' de '.$result[$i]['auteur'].'</a> prise par : <a class ="etudi" href="etud.php?id='.$result[$i]['id'].'">'.$result[$i]['nom'].' '.$result[$i]['prenom'].'</a></span>

      <div class="button_line">
      <input class="etud__button" type="button" name="chg_infos" value="Rendre" onclick="window.location = \'accept.php?id='.$result[$i]['id'].'&c=2&id_livre='.$result[$i]['id_livre'].'\';"></div></div>';
    }


//list_unconfirmed_acounts();
//list_levels();
?>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
