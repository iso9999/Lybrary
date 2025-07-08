<?php
/*
TODO !!!!!!!!!!!!!!!!!
*/
?>
<!DOCTYPE html>
<html>
	<head>
	<?php
	if(isset($titre) && trim($titre) != '')
	$titre = $titre.' : '.TITRESITE;
	
	else
	$titre = TITRESITE;
	
	?>
		<title><?php echo $titre; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="language" content="fr" />
		
		<link rel="stylesheet" title="Design" href="src/ionicons-2.0.1/css/ionicons.min.css" type="text/css"/>
		<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,600" rel="stylesheet">
		<link rel="stylesheet" title="Design" href="src/css/style_book.css" type="text/css"/>
		<link rel="stylesheet" title="Design" href="src/css/style_book2.css" type="text/css"/>
		<link rel="stylesheet" title="Design" href="src/css/style_etud.css" type="text/css"/>
		<link rel="stylesheet" title="Design" href="src/css/style_e.css" type="text/css"/>
	</head>


	<body>

		<header>
			<div class="logo">
				<img src="src/images/Library-logo-white.png" id="lg">
				<a href="#" >Lybrary</a>
			</div>
			<div class="header-content">
	            <div class="main-nav">
	                    <ul>
	                    	<li><a href="index.php">Accueil</a></li>
	                        <li><a href="livres.php">Tout les Livres</a></li>
	                        <li><a href="etuds.php">Liste étudiants</a></li>
	                    </ul>
	            </div>
	              <div class="account" id="account">
	                        <img src="src/images/users/avatar.jpg" alt="">
	                        <i class="ion-chevron-down" id='ico-account' ></i>
	            </div>
	            <div class="search-form">
	                    <form action="#" method="get">
	                        <input type="text" name="search" class="search-input" placeholder="Search">
	                        <button type="submit">
	                           <img src="src/images/search.png">
	                        </button>
	                    </form>
	            </div>
	            <div class="topmenu hide" id="topbar-menu">
	                    <a href="etuds.php"><i class="ion-person"></i> Gérer étudiants </a>
	                    <a href="livres_demandes.php"><i class="ion-briefcase"></i> Livres demandés </a>
	                    <a href="signout.php"><i class="ion-power"></i> se deconnecter </a>
	            </div>
	            
	        </div>
		</header>
