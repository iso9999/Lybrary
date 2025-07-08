<?php
session_start();
include('../includes/config.php');
include('../includes/fonctions.php');
connexiondb();
actualiser_session();
?>

<?php
if(isset($_SESSION['id_admin']))
{
  $informations = Array(
          true,
          'Vous êtes déjà connecté',
          'Vous êtes déjà connecté avec le login_admin <span class="login_admin">'.htmlspecialchars($_SESSION['login_admin'], ENT_QUOTES).'</span>.',
          ' - <a href="'.ROOTPATH.'/admin/logout.php">Se déconnecter</a>',
          ROOTPATH.'/admin/index.php',
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
$titre = 'Connexion_admin';
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
      <input type="text" name="login_admin" placeholder="login_admin" value="<?php if(isset($_SESSION['connexion_admin'])) echo $_SESSION['connexion_admin']; ?>"/>
      <input type="password" name="password_admin" placeholder="password"/>
      <button>login</button>
      <input type="hidden" name="validate" id="validate" value="ok"/>
           
      <p class="message"><label for="cookie"><input type="checkbox" name="cookie" id="cookie"/>Stay logged in</label></p>
      <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
    </form>
    <?php
}
else 
      {
        $_SESSION['connexion_admin']=$_POST['login_admin'];
        $result = sqlquery("SELECT COUNT(id_admin) AS nbr, id_admin, login_admin, password_admin FROM admin WHERE login_admin = '".mysql_real_escape_string($_POST['login_admin'])."' GROUP BY id_admin", 1);
        /////////////
        if($result['nbr'] == 1)
        {
          if(md5($_POST['password_admin']) == $result['password_admin'])
          {
            $_SESSION['id_admin'] = $result['id_admin'];
            $_SESSION['login_admin'] = $result['login_admin'];
            $_SESSION['password_admin'] = $result['password_admin'];
            unset($_SESSION['connexion_admin']);
            
            if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
            {
              setcookie('id_admin', $result['id_admin'], time()+365*24*3600); // 3aam
              setcookie('password_admin', $result['password_admin'], time()+365*24*3600);
            }
            
            $informations = Array(/*connecté*/
                    false,
                    'Connexion réussie',
                    'Vous êtes désormais connecté avec le login_admin <span class="login_admin">'.htmlspecialchars($_SESSION['login_admin'], ENT_QUOTES).'</span>.',
                    '',
                    ROOTPATH.'/admin/index.php',
                    3
                    );   
            require_once('../informations.php');
            exit();
          }
          
          else
          {
            $_SESSION['connexion_admin'] = $_POST['login_admin'];
            $informations = Array(/*Erreur de mot de passe*/
                    true,
                    'Mauvais mot de passe',
                    'Vous avez fourni un mot de passe incorrect.',
                    ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                    ROOTPATH.'/admin/ad_connexion951.php',
                    3
                    );
            require_once('../informations.php');
            exit();
          }
        }
        
        else if($result['nbr'] > 1)
        {
          $informations = Array(/*Erreur de login_admin doublon (normalement impossible)*/
                  true,
                  'Doublon',
                  'Deux membres ou plus ont le même login_admin, contactez un administrateur pour régler le problème.',
                  ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                  ROOTPATH.'/contact.php',
                  3
                  );
          require_once('../informations.php');
          exit();
        }
        
        else
        {
          $informations = Array(/*login_admin inconnu*/
                  true,
                  'login_admin inconnu',
                  'Le login_admin <span class="login_admin">'.htmlspecialchars($_POST['login_admin'], ENT_QUOTES).'</span> n\'existe pas dans notre base de données. Vous avez probablement fait une erreur.',
                  ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                  ROOTPATH.'/admin/ad_connexion951.php',
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
