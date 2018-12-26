<?php
session_start();
include('../includes/config.php');
include('../includes/fonctions.php');
connexiondb();
actualiser_session();
?>

<?php
if(isset($_SESSION['id']))
{
  $informations = Array(
          true,
          'Vous êtes déjà connecté',
          'Vous êtes déjà connecté avec le cne <span class="cne">'.htmlspecialchars($_SESSION['cne'], ENT_QUOTES).'</span>.',
          ' - <a href="'.ROOTPATH.'/etudiant/signout.php">Se déconnecter</a>',
          ROOTPATH.'/index.php',
          5
          );
  
  require_once('../informations.php');
  exit();
}

if(!isset($_POST['validate'] ))
{
  $_POST['validate']='nok';
}

if($_POST['validate'] != 'ok')
{
$titre = 'Connexion';
include('includes/top.php');
?>


    <div class="login-page">
  <div class="form">
    <form class="register-form" >
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="post" action="<?=$_SERVER['PHP_SELF'];?>">
      <input type="text" name="cne" placeholder="cne" value="<?php if(isset($_SESSION['connexion_cne'])) echo $_SESSION['connexion_cne']; ?>"/>
      <input type="password" name="password" placeholder="password"/>
      <button>login</button>
      <input type="hidden" name="validate" id="validate" value="ok"/>
           
      <p class="message"><label for="cookie"><input type="checkbox" name="cookie" id="cookie"/>Stay logged in</label></p>
      <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
    </form>
    <?php
}
else 
      {
        $_SESSION['connexion_cne']=$_POST['cne'];
        $result = sqlquery("SELECT COUNT(id) AS nbr, id, cne, password, isConfirmed FROM etudiant WHERE cne = '".mysql_real_escape_string($_POST['cne'])."' GROUP BY id", 1);
        /////////////
        if($result['nbr'] == 1)
        {
          if(md5($_POST['password']) == $result['password'])
          {
            if($result['isConfirmed'] =='r')
            {
                $informations = Array(/*connecté*/
                    true,
                    'Demande de confirmation refusé',
                    'Votre demande de confirmation a été refusé !',
                    '',
                    ROOTPATH.'/index.php',
                    3
                    );
                require_once('../informations.php');
                exit();
            }
            elseif($result['isConfirmed'] =='a')
            {
                $informations = Array(/*connecté*/
                    true,
                    'Demande de confirmation est en attente',
                    'Votre demande de confirmation est en attente !',
                    '',
                    ROOTPATH.'/index.php',
                    3
                    );
                require_once('../informations.php');
                exit();
            }
            $_SESSION['id'] = $result['id'];
            $_SESSION['cne'] = $result['cne'];
            $_SESSION['password'] = $result['password'];
            unset($_SESSION['connexion_cne']);
            
            if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
            {
              setcookie('id', $result['id'], time()+365*24*3600); // 3aam
              setcookie('password', $result['password'], time()+365*24*3600);
            }
            
            $informations = Array(/*connecté*/
                    false,
                    'Connexion réussie',
                    'Vous êtes désormais connecté avec le cne <span class="cne">'.htmlspecialchars($_SESSION['cne'], ENT_QUOTES).'</span>.',
                    '',
                    ROOTPATH.'/index.php',
                    3
                    );
            require_once('../informations.php');
            exit();
          }
          else
          {
            $_SESSION['connexion_cne'] = $_POST['cne'];
            $informations = Array(/*Erreur de mot de passe*/
                    true,
                    'Mauvais mot de passe',
                    'Vous avez fourni un mot de passe incorrect.',
                    ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                    ROOTPATH.'/etudiant/signin.php',
                    3
                    );
            require_once('../informations.php');
            exit();
          }
        }
        
        else if($result['nbr'] > 1)
        {
          $informations = Array(/*Erreur de cne doublon (normalement impossible)*/
                  true,
                  'Doublon',
                  'Deux membres ou plus ont le même cne, contactez un administrateur pour régler le problème.',
                  ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                  ROOTPATH.'/contact.php',
                  3
                  );
          require_once('../informations.php');
          exit();
        }
        
        else
        {
          $informations = Array(/*cne inconnu*/
                  true,
                  'cne inconnu',
                  'Le cne <span class="cne">'.htmlspecialchars($_POST['cne'], ENT_QUOTES).'</span> n\'existe pas dans notre base de données. Vous avez probablement fait une erreur.',
                  ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                  ROOTPATH.'/etudiant/signin.php',
                  5
                  );
          require_once('../informations.php');
          exit();
        }
      }
      ?>      
    </div>

    <?php
    include('includes/bottom.php');
    mysql_close();
    ?>