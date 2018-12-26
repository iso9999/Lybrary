<?php
/*

Page singup.php


*/

function checkcne($cne)
{
    if($cne == '') return 'empty';
    else if(strlen($cne) < 3) return 'tooshort';
    else if(strlen($cne) > 32) return 'toolong';
    
    else
    {
        $result = sqlquery("SELECT COUNT(*) AS nbr FROM etudiant WHERE cne = '".mysql_real_escape_string($cne)."'", 1);
        global $queries;
        $queries++;
        
        if($result['nbr'] > 0) return 'exists';
        else return 'ok';
    }
}

function checkpassword($mdp)
{
    if($mdp == '') return 'empty';
    else if(strlen($mdp) < 4) return 'tooshort';
    else if(strlen($mdp) > 50) return 'toolong';
    
    else
    {
        if(!preg_match('#[0-9]{1,}#', $mdp)) return 'nofigure';
        else if(!preg_match('#[A-Z]{1,}#', $mdp)) return 'noupcap';
        else return 'ok';
    }
}

function checkpasswordS($mdp, $mdp2)
{
	if($mdp != $mdp2 && $mdp != '' && $mdp2 != '') return 'different';
	else return checkpassword($mdp);
}

function checkmail($email)
{
	if($email == '') return 'empty';
	else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) return 'isnt';
	
	else
	{
		$result = sqlquery("SELECT COUNT(*) AS nbr FROM etudiant WHERE email = '".mysql_real_escape_string($email)."'", 1);
		global $queries;
		$queries++;
		
		if($result['nbr'] > 0) return 'exists';
		else return 'ok';
	}
}

function vidersession()
{
	foreach($_SESSION as $cle => $element)
	{
		unset($_SESSION[$cle]);
	}
}
///

session_start();
header('Content-type: text/html; charset=utf-8');
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

////////////////////////

$_SESSION['erreurs'] = 0;

//cne
if(isset($_POST['cne']))
{
	$cne = trim($_POST['cne']);
	$cne_result = checkcne($cne);
	if($cne_result == 'tooshort')
	{
		$_SESSION['cne_info'] = '<span class="erreur">Le cne '.htmlspecialchars($cne, ENT_QUOTES).' est trop court, vous devez en choisir un plus long (minimum 3 caractères).</span><br/>';
		$_SESSION['form_cne'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($cne_result == 'toolong')
	{
		$_SESSION['cne_info'] = '<span class="erreur">Le cne '.htmlspecialchars($cne, ENT_QUOTES).' est trop long, vous devez en choisir un plus court (maximum 32 caractères).</span><br/>';
		$_SESSION['form_cne'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($cne_result == 'exists')
	{
		$_SESSION['cne_info'] = '<span class="erreur">Le cne '.htmlspecialchars($cne, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
		$_SESSION['form_cne'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($cne_result == 'ok')
	{
		$_SESSION['cne_info'] = '';
		$_SESSION['form_cne'] = $cne;
	}
	
	else if($cne_result == 'empty')
	{
		$_SESSION['cne_info'] = '<span class="erreur">Vous n\'avez pas entré de cne.</span><br/>';
		$_SESSION['form_cne'] = '';
		$_SESSION['erreurs']++;	
	}
}

else
{
	header('Location: ../index.php');
	exit();
}

//Mot de passe
if(isset($_POST['password']))
{
	$password = trim($_POST['password']);
	$password_result = checkpassword($password, '');
	if($password_result == 'tooshort')
	{
		$_SESSION['password_info'] = '<span class="erreur">Le mot de passe entré est trop court, changez-en pour un plus long (minimum 4 caractères).</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($password_result == 'toolong')
	{
		$_SESSION['password_info'] = '<span class="erreur">Le mot de passe entré est trop long, changez-en pour un plus court. (maximum 50 caractères)</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($password_result == 'nofigure')
	{
		$_SESSION['password_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins un chiffre.</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($password_result == 'noupcap')
	{
		$_SESSION['password_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins une majuscule.</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($password_result == 'ok')
	{
		$_SESSION['password_info'] = '';
		$_SESSION['form_password'] = $password;
	}
	
	else if($password_result == 'empty')
	{
		$_SESSION['password_info'] = '<span class="erreur">Vous n\'avez pas entré de mot de passe.</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;

	}
}

else
{
	header('Location: ../index.php');
	exit();
}

//Mot de passe suite
if(isset($_POST['Cpassword']))
{
	$Cpassword = trim($_POST['Cpassword']);
	$Cpassword_result = checkpasswordS($Cpassword, $password);
	if($Cpassword_result == 'different')
	{
		$_SESSION['Cpassword_info'] = '<span class="erreur">Le mot de passe de vérification diffère du mot de passe.</span><br/>';
		$_SESSION['form_Cpassword'] = '';
		$_SESSION['erreurs']++;
		if(isset($_SESSION['form_password'])) unset($_SESSION['form_password']);
	}
	
	else
	{
		if($Cpassword_result == 'ok')
		{
			$_SESSION['form_Cpassword'] = $Cpassword;
			$_SESSION['Cpassword_info'] = '';
		}
		
		else
		{
			$_SESSION['Cpassword_info'] = str_replace('passe', 'passe de vérification', $_SESSION['password_info']);
			$_SESSION['form_Cpassword'] = '';
			$_SESSION['erreurs']++;
		}
	}
}

else
{
	header('Location: ../index.php');
	exit();
}

//mail
if(isset($_POST['mail']))
{
	$mail = trim($_POST['mail']);
	$mail_result = checkmail($mail);
	if($mail_result == 'isnt')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' n\'est pas valide.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($mail_result == 'exists')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($mail_result == 'ok')
	{
		$_SESSION['mail_info'] = '';
		$_SESSION['form_mail'] = $mail;
	}
	
	else if($mail_result == 'empty')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Vous n\'avez pas entré de mail.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;	
	}
}

else
{
	header('Location: ../index.php');
	exit();
}


/*************Fin étude******************/

/////////////////////////
if($_SESSION['erreurs'] > 0) $titre = 'Erreur : Inscription 2/2';
else $titre = 'Sign Up Form 2/2';

include('../includes/top.php');
?>

        <div class="hero-text-box-form">
                <h1>

<?php
///////////////////////
			if($_SESSION['erreurs'] == 0)
			{
				$insertion = "INSERT INTO etudiant VALUES(NULL,
				'".mysql_real_escape_string($_POST['First_name'])."',
				'".mysql_real_escape_string($_POST['Last_name'])."',
				'".mysql_real_escape_string($_POST['cne'])."',
				'".mysql_real_escape_string($_POST['mail'])."',
				'".md5($password)."',
				CURDATE(),
				'e',
				'a',
				'".mysql_real_escape_string($_POST['level'])."',
				'".mysql_real_escape_string($_POST['option'])."'  );";
				
				if(mysql_query($insertion))
				{
					$requete="SELECT id FROM etudiant WHERE cne=".$cne.";";
					$result=sqlquery($requete,1);

					copy('avatar.jpg','src/images/users/'.$result['id'].'.jpg');
					$queries++;
					vidersession();
					$_SESSION['inscrit'] = $cne;
				?>
			Inscription validée !</h1>
			<p>Nous vous remercions de vous être inscrit sur notre site, votre inscription a été validée !<br/>
			Vous pouvez vous connecter avec vos identifiants <a href="signin.php">ici</a>.
			</p>
				<?php
				}
				
				else
				{
					if(stripos(mysql_error(), $_SESSION['form_cne']) !== FALSE) // recherche du cne
					{
						unset($_SESSION['form_cne']);
						$_SESSION['cne_info'] = '<span class="erreur">Le cne '.htmlspecialchars($cne, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
						$_SESSION['erreurs']++;
					}
					
					if(stripos(mysql_error(), $_SESSION['form_mail']) !== FALSE) //recherche du mail
					{
						unset($_SESSION['form_mail']);
						unset($_SESSION['form_mail_verif']);
						$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</span><br/>';
						$_SESSION['mail_verif_info'] = str_replace('mail', 'mail de vérification', $_SESSION['mail_info']);
						$_SESSION['erreurs']++;
						$_SESSION['erreurs']++;
					}
					
					if($_SESSION['erreurs'] == 0)
					{
						$sqlbug = true; //plantage SQL.
						$_SESSION['erreurs']++;
					}
				}
			}
			if(isset($_SESSION['erreurs']))
			if($_SESSION['erreurs'] > 0)
			{
				if($_SESSION['erreurs'] == 1) $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu 1 erreur.</span><br/>';
				else $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu '.$_SESSION['erreurs'].' erreurs.</span><br/>';
			?>
			<h1>Inscription non validée.</h1>
			<p>Vous avez rempli le formulaire d'inscription du site et nous vous en remercions, cependant, nous n'avons
			pas pu valider votre inscription, en voici les raisons :<br/><br/>
			<?php
				echo $_SESSION['nb_erreurs'];
				echo $_SESSION['cne_info'];
				echo $_SESSION['password_info'];
				echo $_SESSION['Cpassword_info'];
				echo $_SESSION['mail_info'];
				if(isset($sqlbug))
				if($sqlbug !== true)
				{
			?>
			Nous vous proposons donc de revenir à la page précédente pour corriger les erreurs.</p>
			<a href="signup.php">Retour</a>
			<?php
				}
				
				else
				{echo $insertion;
			?>

			Une erreur est survenue dans la base de données, votre formulaire semble ne pas contenir d'erreurs, donc
			il est possible que le problème vienne de notre côté, réessayez de vous inscrire ou contactez-nous.</p>
			<a href="signup.php">Retenter une inscription</a> - <a href="../contact.php">Contactez-nous</a></div>
			<?php
				}
			}
			?>
</div>
<?php
	include('includes/bottom.php');
?>