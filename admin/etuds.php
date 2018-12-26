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
<form method="post" action="etudsl.php">
<h2 class="title"> Liste des etudiants :</h2><br>
<span class="label">Niveau : </span><br>
        <select class="in_to_chang" id="niv" name="niveau">
        <option value="">---------</option>
        <optgroup label="Classe Préparatoire">
            <option value="1ere Année CP">1ere Année CP</option>
            <option value="2ème Année CP">2ème Année CP</option>
          </optgroup>
          <optgroup label="Cycle Ingénierie">
          <option value="1ere Année CI">1ere Année CI</option>
          <option value="2ème Année CI">2ème Année CI</option>
          <option value="3ème Année CI">3ème Année CI</option>
          </optgroup>
        </select><br><br>

        <span class="label">Filiere : </span><br>
        <select class="in_to_chang" name="filiere">
        <option value="">---------</option>
        <option value="Cp">Cycle Préparatoire</option>
            <option value="Ge">GE</option>
            <option value="Ginfo">GInfo</option>
            <option value="Gindus">Gindus</option>
            <option value="Gc">GC(BTP)</option>
            <option value="Gp">GP</option>
            <option value="Gm">GM</option>
        </select>
        <br><br><br><br>
        <input class="etud__button" type="button" name="chg_infos" value="Lister" onclick="this.form.submit();">
</form>

<?php

?>
</div>
<?php
include('includes/bottom_a.php');
mysql_close();
?>
