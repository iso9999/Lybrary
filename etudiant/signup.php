<?php
/*

Page singup.php

*/

session_start();
include('../includes/config.php');

/********Actualisation de la session...**********/

include('../includes/fonctions.php');
connexiondb();
actualiser_session();

/********Fin actualisation de session...**********/

if(isset($_SESSION['id']))
{
  header('Location: '.ROOTPATH.'/index.php');
  exit();
}

$titre = 'Sign Up Form 1/2';
include('includes/top.php');
?>

      <form action="singup_t.php" method="post">
      
        <h1>Sign Up</h1>
        
        <fieldset>
          <legend><span class="number">1</span>Your basic info</legend>
          <label for="name">First name :</label>
          <input type="text" id="First_name" name="First_name">
          
           <label for="name">Last name :</label>
          <input type="text" id="Last_name" name="Last_name">
          
           <label for="name">CNE :</label>
          <input type="text" id="cne" name="cne">
          
          <label for="mail">Email:</label>
          <input type="email" id="mail" name="mail">
          
          <label for="password">Password:</label>
          <input type="password" id="password" name="password">

          <label for="Cpassword">Confirm password:</label>
          <input type="password" id="Cpassword" name="Cpassword">
        </fieldset> 

        <fieldset>
          <legend><span class="number">2</span>More info</legend>
        <label for="level">Niveau:</label>
        <select id="level" name="level">
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
        </select>
        <label for="option">Filière:</label>
        <select id="option" name="option">
        <option value="">---------</option>
        <option value="Cp">Cycle Préparatoire</option>
            <option value="Ge">GE</option>
            <option value="Ginfo">GInfo</option>
            <option value="Gindus">Gindus</option>
            <option value="Gc">GC(BTP)</option>
            <option value="Gp">GP</option>
            <option value="Gm">GM</option>
        </select>
          <label>Interests:</label>
          <?php 
          //list_themes();
          ?>
          <input type="checkbox" id="Theme1" value="Theme 1" name="Theme1"><label class="light" for="Theme1">Theme1</label><br>
          <input type="checkbox" id="Theme3" value="Theme 2" name="Theme2"><label class="light" for="Theme2">Theme2</label><br>
          <input type="checkbox" id="Theme3" value="Theme 3" name="Theme3"><label class="light" for="Theme3">Theme3</label>
        </fieldset>
        <input type="button" value="Sign Up" class="button" onclick="valider(this.form);" >
      </form>
<?php 
    include('includes/bottom.php');
    mysql_close();
?>