<?php

function list_themes($max)
{
    if(gettype($max)=='integer')
    {
        
    }
    else
    {
        $requete="SELECT libelle_theme,id_theme FROM theme;";
        $result=sqlquery($requete,2);
        for($i=0;$i<count($result);$i++)
        echo '<a href="theme.php?id_theme='.$result[$i]['id_theme'].'">'.$result[$i]['libelle_theme'].'</a>';
    }
}

function mois_en_lettres($mois)
{
    switch($mois)
    {
        case 1: $mois = 'Janvier'; break;
        case 2: $mois = 'Février'; break;
        case 3: $mois = 'Mars'; break;
        case 4: $mois = 'Avril'; break;
        case 5: $mois = 'Mai'; break;
        case 6: $mois = 'Juin'; break;
        case 7: $mois = 'Juillet'; break;
        case 8: $mois = 'Août'; break;
        case 9: $mois = 'Septembre'; break;
        case 10: $mois = 'Octobre'; break;
        case 11: $mois = 'Novembre'; break;
        case 12: $mois = 'Decembre'; break;
        default: $mois =''; break;
    }
    return $mois;
}
function list_borrowed_books()
{
        $requete="SELECT libelle_livre,id_livre FROM livre WHERE etudiant=".intval($_SESSION['id']).";";
        $result=sqlquery($requete,2);
        for($i=0;$i<count($result);$i++)
        echo "<a href=livre.php?id_livre=".$result[$i]['id_livre'].">".$result[$i]['libelle_livre'].'</a>';
}

function list_borrowed_books_infos()
{
    $requete="SELECT `id_livre` FROM livre WHERE etudiant=".intval($_SESSION['id']).";";
        $result=sqlquery($requete,2);
        for($i=0;$i<count($result);$i++)
        {
            show_book_b($result[$i]['id_livre']);
        }
}

function list_books_by_themes($id)
{
    if(!isset($id))
    {
        $requete="SELECT id_theme,libelle_theme FROM theme;";
        $result=sqlquery($requete,2);
        for($i=0;$i<count($result);$i++)
        {
        $requete="SELECT id_livre FROM livre WHERE theme=".intval($result[$i]['id_theme']).";";
        $result1=sqlquery($requete,2);
        if(count($result1)>0)
        echo '<h2 class="title2">'.$result[$i]['libelle_theme'].'</h2><br>';
        for($j=0;$j<count($result1);$j++)
        {
            show_book($result1[$j]['id_livre']);
        }
        }
    }

    else
    {       
        $requete="SELECT libelle_theme FROM theme WHERE id_theme=".$id.";";
        $result1=sqlquery($requete,1);
        $requete="SELECT id_livre FROM livre WHERE theme=".intval($id).";";
        $result=sqlquery($requete,2);
        if(count($result)>0)
        echo '<h2 class="title2">Liste des livres de theme : '.$result1['libelle_theme'].'</h2><br>';
        else
        echo '<h2 class="title2">Le theme : '.$result1['libelle_theme'].' est vide !</h2><br>';
        for($j=0;$j<count($result);$j++)
        {
            show_book($result[$j]['id_livre']);
        }
    }
}

function list_d_books()
{
    $requete="SELECT `id_livre` FROM livre WHERE etudiant_dem=".intval($_SESSION['id']).";";
        $result=sqlquery($requete,2);
        if(count($result)==0)
           echo '<h2 class="title2">pas des livres demandées !</h2><br>'; 
        for($i=0;$i<count($result);$i++)
        {
            show_book($result[$i]['id_livre']);
        }
}
function show_book_b($id)
{
    $requete="SELECT `id_livre`, `libelle_livre`, `auteur`, `description`, DAY(date_debut) AS day,MONTH(date_debut) AS month, YEAR(date_debut) AS year, `theme`, etudiant, etudiant_dem FROM livre WHERE id_livre=".intval($id).";";
    $result=sqlquery($requete,1);
    $requete_theme="SELECT libelle_theme FROM theme WHERE id_theme=".intval($result['theme']).";";
            $theme_t=sqlquery($requete_theme,1);
            $theme=$theme_t['libelle_theme'];
    ?>
        <article class="card card1">
            <a href="<?php echo 'livre.php?id_livre='.$result['id_livre']; ?>">
            <div class="card__image">
            <img src="<?php echo ROOTPATH.'/'; ?>src/images/books_covers/<?php echo $result['id_livre']; ?>.jpg" alt="book_<?php echo $result['id_livre']; ?>" />
            </div>
            <div class="card__date">
            <span class="card__date__day"><?php echo $result['day']; ?></span><br>
            <span class="card__date__month"><?php echo mois_en_lettres($result['month']); ?></span><br>
            <span class="card__date__month"><?php echo mois_en_lettres($result['year']); ?></span>
            </div>
            <div class="card__body">
            <div class="card__category"><a href="#"><?php echo $theme; ?></a></div>
            <h2 class="card__title"><a href="<?php echo 'livre.php?id_livre='.$result['id_livre']; ?>"><?php echo $result['libelle_livre']; ?></a></h2>
            <div class="card__subtitle"><?php echo $result['auteur']; ?></div>
            <p class="card__par">
            <?php echo $result['description']; ?>
            </p>
            </div>
            <div class="card__footer">
            <a href="<?php echo 'livre.php?id_livre='.$result['id_livre']; ?>">Plus d'infomations</a>
            </div>
            </a>
            </article>
    <?php
}
function show_book($id)
{
    $requete="SELECT `id_livre`, `libelle_livre`, `auteur`, `description`, DAY(date_debut) AS day,MONTH(date_debut) AS month, YEAR(date_debut) AS year, `theme`, etudiant, etudiant_dem FROM livre WHERE id_livre=".intval($id).";";
    $result=sqlquery($requete,1);
    $requete_theme="SELECT libelle_theme FROM theme WHERE id_theme=".intval($result['theme']).";";
            $theme_t=sqlquery($requete_theme,1);
            $theme=$theme_t['libelle_theme'];
    ?>
        <article class="card card1">
            <a href="<?php echo 'livre.php?id_livre='.$result['id_livre']; ?>">
            <div class="card__image">
            <img src="<?php echo ROOTPATH.'/'; ?>src/images/books_covers/<?php echo $result['id_livre']; ?>.jpg" alt="book_<?php echo $result['id_livre']; ?>" />
            </div>
            <div class="card__body">
            <div class="card__category"><a href="#"><?php echo $theme; ?></a></div>
            <h2 class="card__title"><a href="<?php echo 'livre.php?id_livre='.$result['id_livre']; ?>"><?php echo $result['libelle_livre']; ?></a></h2>
            <div class="card__subtitle"><?php echo $result['auteur']; ?></div>
            <p class="card__par">
            <?php echo $result['description']; ?>
            </p>
            </div>
            <div class="card__footer">
            <a href="<?php echo 'livre.php?id_livre='.$result['id_livre']; ?>">Plus d'infomations</a>
            </div>
            </a>
            </article>
    <?php
}

function dateDiff($date1, $date2){
    $diff = $date1 - $date2;
    $retour = array();
 
    $tmp = $diff;
    $retour['second'] = $tmp % 60;
 
    $tmp = floor( ($tmp - $retour['second']) /60 );
    $retour['minute'] = $tmp % 60;
 
    $tmp = floor( ($tmp - $retour['minute'])/60 );
    $retour['hour'] = $tmp % 24;
 
    $tmp = floor( ($tmp - $retour['hour'])  /24 );
    $retour['day'] = $tmp;
 
    return $retour;
}

function list_book_infos($id)
{

    $requete="SELECT `id_livre`, `libelle_livre`, `auteur`, `description`, DAY(date_debut) AS day,MONTH(date_debut) AS month, YEAR(date_debut) AS year,date_debut, `theme`, etudiant, etudiant_dem FROM livre WHERE id_livre=".intval($id).";";
    $result=sqlquery($requete,1);
    $requete_theme="SELECT libelle_theme FROM theme WHERE id_theme=".intval($result['theme']).";";
            $theme_t=sqlquery($requete_theme,1);
            $theme=$theme_t['libelle_theme'];
    
            $d1=date("y-m-d");
            $d1=strtotime($d1);
            $d2=strtotime($result['date_debut']);
            $diff=dateDiff($d2,$d1);
            $diff['day']+=NBRJOURS-1;
    ?>
    <div class="book">
    <div class="book__image">
        <img src="<?php echo ROOTPATH.'/'; ?>src/images/books_covers/<?php echo $result['id_livre']; ?>.jpg" class="imageb" alt="book_3" />
     </div>
     <div class="book__content">
     <div class="book__info">
      <h2 class="title"><a href="#"><?php echo $result['libelle_livre']; ?></a></h2>
      <div class="auteur"><?php echo $result['auteur']; ?></div>
      <br><br>
        <?php if($result['etudiant'] == $_SESSION['id']){ ?>
        <span class="label">Date de prise :</span><br>
        <span class="rep"><?php echo $result['day']; ?> <?php echo mois_en_lettres($result['month']); ?></span>
        <br><br>
        <?php } ?>
        <span class="label">Theme :</span><br>
        <a href="theme.php?id_theme=<?php echo $result['theme']; ?>"><span class="rep"><?php echo $theme; ?></span></a>

        <br><br>
        <span class="label">Description :</span><br>
        <span class="rep"><?php echo $result['description']; ?></span>
        <br><br>
        <?php
        if($result['etudiant']==$_SESSION['id'])
        {
            ?>
            <span class="label">Durée restante :</span><br>
            <span class="rep"><?php if($diff['day']>0){echo $diff['day']." Jours";}else{echo "tu doit rendre le livre a la bibliothèque";} ?></span>
            <?php

        }
        else
        {
            ?>
            <span class="label">Etat :</span><br>
            <?php
            if($result['etudiant_dem']==0 && $result['etudiant']==0)
            {
                ?>
                <span class="rep">Disponible</span>
                <?php
            }
            else if($result['etudiant_dem']==$_SESSION['id'])
            {
                ?>
                <span class="rep">Demandé par toi</span>
                <?php
            }
        
        elseif($result['etudiant_dem']!=$_SESSION['id'] || $result['etudiant_dem']!=$_SESSION['id'])
        {
            ?>
            <span class="rep">Indisponible</span>
            <?php
        }
        }
        ?>
     </div>
     <div class="book__buttons">
        <form method="POST" action="#">
            <?php if($result['etudiant_dem']==0 && $result['etudiant']==0){ ?>
            <input class="book__button" type="button" name="prendre" onclick="window.location = '<?php echo 'dem_livre.php?id_livre='.$result['id_livre']; ?>';" value="Demander">
            <?php }
            else if($result['etudiant_dem']==$_SESSION['id']){ ?>
            <input class="book__button" type="button" name="prendre" onclick="window.location = '<?php echo 'ann_dem_livre.php?id_livre='.$result['id_livre']; ?>';" value="Annuler la demande">
            <?php } ?>
        </form>
     </div>
     </div>
    </div>
    <?php
}

function dem_livre($id)
{
    $requete="SELECT libelle_livre, etudiant, etudiant_dem FROM livre WHERE id_livre=".intval($id).";";
    $result=sqlquery($requete,1);
    if($result['etudiant']==$_SESSION['id'])
    echo "<h2 class=\"title\">T'as déjà ce livre !</h2>";
    else if($result['etudiant_dem']==$_SESSION['id'])
    echo "<h2 class=\"title\">T'as déjà demander ce livre !</h2>";
    else if($result['etudiant_dem']!=0 || $result['etudiant']!=0)
    echo "<h2 class=\"title\">Le livre n'est pas disponible !</h2>";
    else
    {
        $requete="SELECT COUNT(id_livre) AS nbr FROM livre WHERE etudiant=".$_SESSION['id'].";";
        $result=sqlquery($requete,1);
        $nbr=$result['nbr'];
        $requete="SELECT COUNT(id_livre) AS nbr FROM livre WHERE etudiant_dem=".$_SESSION['id'].";";
        $result=sqlquery($requete,1);
        $nbr+=$result['nbr'];
        if($nbr>MAXLIVRE)
            echo "<h2 class=\"title\">T'a déjà dépasser le max (".MAXLIVRE.")!</h2>";
        else
        {
            $requete="UPDATE `livre` SET `etudiant_dem` = ".$_SESSION['id']." WHERE `id_livre` = ".$id.";";
            if(sqlquery($requete,0))
            echo "<h2 class=\"title\">Le Livre est bien demandé ,veuillez se presenter à la bibliothèque pour le prendre !</h2>";
            else
            echo "<h2 class=\"title\">Probleme dans la base de données !</h2>";
        }
    }
    
}

function ann_dem_livre($id)
{
    $requete="SELECT etudiant_dem FROM livre WHERE id_livre=".intval($id).";";
    $result=sqlquery($requete,1);
    if($result['etudiant_dem']==$_SESSION['id'])
    {
            $requete="UPDATE `livre` SET `etudiant_dem` = 0 WHERE `id_livre` = ".$id.";";
            if(sqlquery($requete,0))
            echo "<h2 class=\"title\">La demande a été annuler !</h2>";
            else
            echo "<h2 class=\"title\">Probleme dans la base de données !</h2>";
    }
    else
    echo "<h2 class=\"title\">Impossible d'annuler cette demande !</h2>";
    
}

//etud_info



function list_etud_infos($id)
{
    $requete="SELECT * FROM etudiant WHERE id=".intval($id).";";
    $result=sqlquery($requete,1);
    $date = strtotime($result['date_inscription']);
    $date = date("d/m/y",$date);
    ?>

    <div class="etud">
    <div class="etud__image">
        <img src="src/images/users/<?php echo $_SESSION['id']; ?>.jpg?filemtime(src/images/users/<?php echo $_SESSION['id']; ?>.jpg)" class="imagee" alt="etud_<?php echo $id; ?>" />
        <input class="etud__button1" type="button" name="Modifier" value="Modifier" onclick="window.location = 'chg_img.php'">

    </div>
    <div class="etud__content">
    <div class="etud__info">
      <h2 class="title"><a href="my_info.php"><?php echo  $result['prenom']." ".$result['nom']; ?></a></h2>
      <div class="auteur"><?php echo  $result['niveau'].", ".$result['filiere']; ?></div>
      <br><br>
        <span class="label">cne :</span><br>
        <span class="rep"><?php echo  $result['cne']; ?></span>
        <br><br>
        <span class="label">Email</span><br>
        <span class="rep"><?php echo  $result['email']; ?></span>
        <br><br>
        <span class="label">Date d'inscription :</span><br>
        <span class="rep"><?php echo  $date; ?></span>
    </div>
    <div class="etud__buttons">
        <form method="POST" action="#">
            <input class="etud__button" type="button" name="chg_infos" value="Changer les informations" onclick="window.location = 'chg_info.php'">
            <input class="etud__button" type="button" name="chg_pass" value="Changer le mot de passe" onclick="window.location = 'chg_pass.php'">
        </form>
    </div>
    </div>
    </div>
    <?php
}

function list_etud_infos_to_chang($id)
{
    $requete="SELECT * FROM etudiant WHERE id=".intval($id).";";
    $result=sqlquery($requete,1);
    ?>

    <div class="etud">
    <form action="chg_info_t.php" method="post">
    <div class="etud__content">
    <div class="etud__info">

      <h2 class="title">
      <span class="label">Nom Prénom :</span><br>
      <input class="in_to_chang" spellcheck="false" type="text" name="prenom" value="<?php echo  $result['prenom']; ?>" placeholder="Votre prenom">
      <input class="in_to_chang" spellcheck="false"  type="text" name="nom" value="<?php echo  $result['nom']; ?>" placeholder="Votre nom">
      </h2>
      <div class="auteur">
      <span class="label">Niveau, filière :</span><br>
        <select class="in_to_chang" id="niveau" name="niveau">
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
        <select class="in_to_chang" id="filiere" name="filiere">
        <option value="">---------</option>
        <option value="Cp">Cycle Préparatoire</option>
            <option value="Ge">GE</option>
            <option value="Ginfo">GInfo</option>
            <option value="Gindus">Gindus</option>
            <option value="Gc">GC(BTP)</option>
            <option value="Gp">GP</option>
            <option value="Gm">GM</option>
        </select></div>
        <br><br>
        <span class="label">Email</span><br>
        <span class="in_to_chang"><input  class="in_to_chang" spellcheck="false"  type="text" name="email" value="<?php echo  $result['email']; ?>" placeholder="Votre email"></span>
    </div>
    <div class="etud__buttons">
        <form method="POST" action="#">
            <input class="etud__button" type="button" name="chg_infos" value="Confirmer le changement" onclick="valider2(this.form);">
        </form>
    </div>
    </div>
    </form>
    </div>
    <?php
}
function list_etud_pass_to_chang($id)
{
    ?>
    <h2 class="title">Changement de mot de passe :</h2>
    <form class="etud_form_pass" method="post" action="chg_pass_t.php">
    <span class="label">Votre mot de passe :</span><br>
    <input class="in_to_chang" spellcheck="false"  type="password" name="nom" ><br><br>
    <span class="label">Votre nouveau mot de passe :</span><br>
    <input class="in_to_chang" spellcheck="false"  type="password" name="nom" ><br><br>
    <span class="label">Repeter votre nouveau mot de passe :</span><br>
    <input class="in_to_chang" spellcheck="false"  type="password" name="nom" ><br>
        <input class="etud__button3" type="submit" name="button" value="Confirmer">
    </form>

    <?php
}
//GLOBAL
function connexiondb()
{
    $bd_nom_serveur='localhost';
    $bd_login='root';
    $bd_password='';//////////////// passssssss
    $bd_nom_bd='library_demo';

    @mysql_connect($bd_nom_serveur,$bd_login,$bd_password);
    mysql_select_db($bd_nom_bd);
    mysql_query("set names 'utf8'");
}

function sqlquery($requete, $number)
{
    $query = mysql_query($requete) or exit('Erreur SQL : '.mysql_error().' Ligne : '. __LINE__ .'.'); //requête
    queries();
    
    /*
    Deux cas possibles ici :
    Soit on sait qu'on a qu'une seule entrée qui sera
    retournée par SQL, donc on met $number à 1
    Soit on ne sait pas combien seront retournées,
    on met alors $number à 2.
    */
    
    if($number == 1)
    {
        $query1 = mysql_fetch_assoc($query);
        mysql_free_result($query);
        /*mysql_free_result($query) libère le contenu de $query, je
        le fais par principe, mais c'est pas indispensable.*/
        return $query1;
    }
    else if($number == 0)
    {
        return $query;
    }
    else if($number == 2)
    {
        while($query1 = mysql_fetch_assoc($query))
        {
            $query2[] = $query1;
            /*On met $query1 qui est un array dans $query2 qui
            est un array. Ca fait un array d'arrays */
        }
        mysql_free_result($query);
        if(isset($query2))
        return $query2;
    }
    
    else //Erreur
    {
        exit('Argument de sqlquery non renseigné ou incorrect.');
    }
}

function queries($num = 1)
{
    global $queries;
    $queries = $queries + intval($num);
}

function actualiser_session()
{

    if(isset($_SESSION['id']) && isset($_SESSION['id_admin']))
    {
                
                $informations = Array(/*Mot de passe de session incorrect*/
                                    true,
                                    'Session invalide',
                                    'Vous etez connecté à la fois avec un compte etudiant et un compte admin.',
                                    '',
                                    'index.php',
                                    5
                                    );
                require_once(ROOTPATH.'/informations.php');
                vider_cookie();
                session_destroy();
                exit();
    }
    if(isset($_SESSION['id']) && intval($_SESSION['id']) != 0) 
    {
        $retour = sqlquery("SELECT id, cne, password FROM etudiant WHERE id = ".intval($_SESSION['id']), 1);
        
        //Si la requête a un résultat (c'est-à-dire si l'id existe dans la table etudiant)
        if(isset($retour['cne']) && $retour['cne'] != '')
        {
            if($_SESSION['password'] != $retour['password'])
            {
                //Dehors vilain pas beau !
                $informations = Array(/*Mot de passe de session incorrect*/
                                    true,
                                    'Session invalide',
                                    'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.',
                                    '',
                                    'etudiant/connexion.php',
                                    3
                                    );
                require_once('../informations.php');
                vider_cookie();
                session_destroy();
                exit();
            }
            
            else
            {
                //Validation de la session.
                    $_SESSION['id'] = $retour['id'];
                    $_SESSION['cne'] = $retour['cne'];
                    $_SESSION['password'] = $retour['password'];
            }
        }
    }
    
    else //On vérifie les cookies et sinon pas de session
    {
        if(isset($_COOKIE['id']) && isset($_COOKIE['password'])) //S'il en manque un, pas de session.
        {
            if(intval($_COOKIE['id']) != 0)
            {
                //idem qu'avec les $_SESSION
                $retour = sqlquery("SELECT id, cne, password FROM etudiant WHERE id = ".intval($_COOKIE['id']), 1);
                
                if(isset($retour['cne']) && $retour['cne'] != '')
                {
                    if($_COOKIE['password'] != $retour['password'])
                    {
                        //Dehors vilain tout moche !
                        $informations = Array(/*Mot de passe de cookie incorrect*/
                                            true,
                                            'Mot de passe cookie erroné',
                                            'Le mot de passe conservé sur votre cookie est incorrect vous devez vous reconnecter.',
                                            '',
                                            'etudiant/connexion.php',
                                            3
                                            );
                        require_once('../informations.php');
                        vider_cookie();
                        session_destroy();
                        exit();
                    }
                    
                    else
                    {
                        //Bienvenue :D
                        $_SESSION['id'] = $retour['id'];
                        $_SESSION['cne'] = $retour['cne'];
                        $_SESSION['password'] = $retour['password'];
                    }
                }
            }
            
            else //cookie invalide, erreur plus suppression des cookies.
            {
                $informations = Array(/*L'id de cookie est incorrect*/
                                    true,
                                    'Cookie invalide',
                                    'Le cookie conservant votre id est corrompu, il va donc être détruit vous devez vous reconnecter.',
                                    '',
                                    'etudiant/signin.php',
                                    3
                                    );
                require_once('../informations.php');
                vider_cookie();
                session_destroy();
                exit();
            }
        }
        
        else
        {
            //Fonction de suppression de toutes les variables de cookie.
            if(isset($_SESSION['id'])) unset($_SESSION['id']);
            vider_cookie();
        }
    }


    ///// SESSION ADMIN

    if(isset($_SESSION['id_admin']) && intval($_SESSION['id_admin']) != 0) //Vérification id
    {
        //utilisation de la fonction sqlquery, on sait qu'on aura qu'un résultat car l'id d'un membre est unique.
        $retour = sqlquery("SELECT id_admin, login_admin, password_admin FROM admin WHERE id_admin = ".intval($_SESSION['id_admin']), 1);
        
        //Si la requête a un résultat (c'est-à-dire si l'id existe dans la table etudiant)
        if(isset($retour['login_admin']) && $retour['login_admin'] != '')
        {
            if($_SESSION['password_admin'] != $retour['password_admin'])
            {
                //Dehors vilain pas beau !
                $informations = Array(/*Mot de passe de session incorrect*/
                                    true,
                                    'Session invalide',
                                    'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.',
                                    '',
                                    'etudiant/connexion.php',
                                    3
                                    );
                require_once('../informations.php');
                vider_cookie();
                session_destroy();
                exit();
            }
            
            else
            {
                //Validation de la session.
                    $_SESSION['id_admin'] = $retour['id_admin'];
                    $_SESSION['login_admin'] = $retour['login_admin'];
                    $_SESSION['password_admin'] = $retour['password_admin'];
            }
        }
    }
    
    else //On vérifie les cookies et sinon pas de session
    {
        if(isset($_COOKIE['id_admin']) && isset($_COOKIE['password_admin'])) //S'il en manque un, pas de session.
        {
            if(intval($_COOKIE['id_admin']) != 0)
            {
                //idem qu'avec les $_SESSION
                $retour = sqlquery("SELECT id_admin, login_admin, password_admin FROM admin WHERE id_admin = ".intval($_COOKIE['id_admin']), 1);
                
                if(isset($retour['login_admin']) && $retour['login_admin'] != '')
                {
                    if($_COOKIE['password_admin'] != $retour['password_admin'])
                    {
                        //Dehors vilain tout moche !
                        $informations = Array(/*Mot de passe de cookie incorrect*/
                                            true,
                                            'Mot de passe cookie erroné',
                                            'Le mot de passe conservé sur votre cookie est incorrect vous devez vous reconnecter.',
                                            '',
                                            'etudiant/connexion.php',
                                            3
                                            );
                        require_once('../informations.php');
                        vider_cookie();
                        session_destroy();
                        exit();
                    }
                    
                    else
                    {
                        //Bienvenue :D
                        $_SESSION['id_admin'] = $retour['id_admin'];
                        $_SESSION['login_admin'] = $retour['login_admin'];
                        $_SESSION['password_admin'] = $retour['password_admin'];
                    }
                }
            }
            
            else //cookie invalide, erreur plus suppression des cookies.
            {
                $informations = Array(/*L'id de cookie est incorrect*/
                                    true,
                                    'Cookie invalide',
                                    'Le cookie conservant votre id est corrompu, il va donc être détruit vous devez vous reconnecter.',
                                    '',
                                    'etudiant/signin.php',
                                    3
                                    );
                require_once('../informations.php');
                vider_cookie();
                session_destroy();
                exit();
            }
        }
        
        else
        {
            //Fonction de suppression de toutes les variables de cookie.
            if(isset($_SESSION['id_admin'])) unset($_SESSION['id_admin']);
            vider_cookie();
        }
    }
}

function vider_cookie()
{
    foreach($_COOKIE as $cle => $element)
    {
        setcookie($cle, '', time()-3600);
    }
}

//FORADMIN
function list_etud_infos_foradmin($id)
{
    $requete="SELECT * FROM etudiant WHERE id=".intval($id).";";
    $result=sqlquery($requete,1);
    $date = strtotime($result['date_inscription']);
    $date = date("d/m/y",$date);
    ?>

    <div class="etud">
    <div class="etud__image">
        <img src="<?php echo ROOTPATH ?>/etudiant/src/images/users/<?php echo $id; ?>.jpg" class="imagee" alt="etud_<?php echo $id; ?>" />

    </div>
    <div class="etud__content">
    <div class="etud__info">
      <h2 class="title"><a href="#"><?php echo  $result['prenom']." ".$result['nom']; ?></a></h2>
      <div class="auteur"><?php echo  $result['niveau'].", ".$result['filiere']; ?></div>
      <br><br>
        <span class="label">cne :</span><br>
        <span class="rep"><?php echo  $result['cne']; ?></span>
        <br><br>
        <span class="label">Email</span><br>
        <span class="rep"><?php echo  $result['email']; ?></span>
        <br><br>
        <span class="label">Date d'inscription :</span><br>
        <span class="rep"><?php echo  $date; ?></span>
    </div>
    </div>
    </div>
    <?php
}
function list_book_infos_foradmin($id)
{

    $requete="SELECT `id_livre`, `libelle_livre`, `auteur`, `description`, DAY(date_debut) AS day,MONTH(date_debut) AS month, YEAR(date_debut) AS year,date_debut, `theme`, etudiant, etudiant_dem FROM livre WHERE id_livre=".intval($id).";";
    $result=sqlquery($requete,1);
    $requete_theme="SELECT libelle_theme FROM theme WHERE id_theme=".intval($result['theme']).";";
            $theme_t=sqlquery($requete_theme,1);
            $theme=$theme_t['libelle_theme'];
    
            $d1=date("y-m-d");
            $d1=strtotime($d1);
            $d2=strtotime($result['date_debut']);
            $diff=dateDiff($d2,$d1);
            $diff['day']+=NBRJOURS-1;
    ?>
    <div class="book">
    <div class="book__image">
        <img src="<?php echo ROOTPATH.'/'; ?>src/images/books_covers/<?php echo $result['id_livre']; ?>.jpg" class="imageb" alt="book_3" />
     </div>
     <div class="book__content">
     <div class="book__info">
      <h2 class="title"><a href="#"><?php echo $result['libelle_livre']; ?></a></h2>
      <div class="auteur"><?php echo $result['auteur']; ?></div>
      <br><br>
      <?php if($result['etudiant'] !=0){ ?>
        <span class="label">Date de prise :</span><br>
        <span class="rep"><?php echo $result['day']; ?> <?php echo mois_en_lettres($result['month']); ?></span>
        <br><br>
        <?php } ?>
        <span class="label">Theme :</span><br>
        <a href="theme.php?id_theme=<?php echo $result['theme']; ?>"><span class="rep"><?php echo $theme; ?></span></a>

        <br><br>
        <span class="label">Description :</span><br>
        <span class="rep"><?php echo $result['description']; ?></span>
        <br><br>
            <span class="label">Etat :</span><br>
            <?php
            if($result['etudiant_dem']==0 && $result['etudiant']==0)
            {
                ?>
                <span class="rep">Disponible</span>
                <?php
            }
            else if($result['etudiant_dem']!=0)
            {
                $requete2="SELECT nom,prenom FROM etudiant WHERE id=".intval($result['etudiant_dem']).";";
                $result2=sqlquery($requete2,1);
                ?>
                <span class="label">Demandé par : </span>
                <a href="etud.php?id=<?php echo $result['etudiant_dem']; ?>"><span class="rep"><?php echo $result2['nom'].' '.$result2['prenom']; ?></span></a>
                <?php
            }
            
            elseif($result['etudiant']!=0)
            {
                $requete2="SELECT nom,prenom FROM etudiant WHERE id=".intval($result['etudiant']).";";
                $result2=sqlquery($requete2,1);
            ?>
            <span class="label">Prise par : </span>
            <a href="etud.php?id=<?php echo $result['etudiant']; ?>"><span class="rep"><?php echo $result2['nom'].' '.$result2['prenom']; ?></span></a>
            <br><br>
            <span class="label">Durée restante :</span><br>
            <span class="rep"><?php if($diff['day']>0){echo $diff['day']." Jours";}else{echo "Durée depassée par : ";echo -$diff['day']." Jours !";} ?></span>
            <?php

            }
        
        ?>
     </div>
     <div class="book__buttons">
        <form method="POST" action="#">
            <input class="book__button" type="button" name="prendre" onclick="window.location = '<?php echo 'chg_info.php?id='.$id; ?>';" value="Modifier info">
            <input class="book__button" type="button" name="prendre" onclick="window.location = '<?php echo 'chg_img.php?id='.$id; ?>';" value="Modifier image">
            <input class="book__button" type="button" name="prendre" onclick="window.location = '<?php echo 'delete.php?id='.$id; ?>';" value="Supprimer (!)">
        </form>
     </div>
     </div>
    </div>
    <?php
}

function list_book_infos_to_chang($id)
{
    $requete="SELECT * FROM livre WHERE id_livre=".intval($id).";";
    $result=sqlquery($requete,1);
    $requete1="SELECT * FROM theme ORDER BY id_theme;";
    $result1=sqlquery($requete1,2);

    ?>

    <div class="book">
        <div class="book__image">
        <img src="<?php echo ROOTPATH.'/'; ?>src/images/books_covers/<?php echo $result['id_livre']; ?>.jpg" class="imageb" alt="book_3" />
        </div>
        <div class="book__content">
    <form action="chg_info_t.php?id=<?php echo $id ?>" method="post">
    <div class="etud__content">
    <div class="etud__info">

      <h2 class="title">
      <span class="label">libellé :</span><br>
      <input class="in_to_chang" spellcheck="false" type="text" name="libelle" value="<?php echo  $result['libelle_livre']; ?>" placeholder="libellé livre">
      <br><span class="label">Auteur :</span><br>
      <input class="in_to_chang" spellcheck="false" type="text" name="auteur" value="<?php echo  $result['auteur']; ?>" placeholder="auteur livre">
      </h2>
      <div class="auteur">
      <span class="label">Theme :</span><br>
        <select class="in_to_chang" id="theme" name="theme">
        <option value="">---------</option>
        <?php
        for($i=0;$i<count($result1);$i++)
        echo '<option value="'.$result1[$i]['id_theme'].'">'.$result1[$i]['libelle_theme'].'</option>'; 
        ?>
        </select>
        <br><br>
        <span class="label">Description : </span><br>
        <textarea cols = "80" rows="4" name="description"><?php echo  $result['description']; ?>
        </textarea>
    </div>
    <div class="etud__buttons">
        <form method="POST" action="chg_info_t.php?id=<?php echo $id ?>">
            <input class="etud__button" type="button" name="chg_infos" value="Confirmer" onclick="this.form.submit();">
        </form>
    </div>
    </div>
    </form>
    </div>
    </div>
    <?php
}
function list_book_infos_to_create()
{
    $requete1="SELECT * FROM theme ORDER BY id_theme;";
    $result1=sqlquery($requete1,2);
    ?>

    <div class="book">
        <div class="book__image">
        <img src="<?php echo ROOTPATH.'/'; ?>src/images/books_covers/default.jpg" class="imageb" alt="book_3" />
        </div>
        <div class="book__content">
    <form action="add_book_t.php" method="post">
    <div class="etud__content">
    <div class="etud__info">

      <input class="in_to_chang" spellcheck="false" type="text" name="libelle" placeholder="libellé livre">
      <br><br><br>
      <input class="in_to_chang" spellcheck="false" type="text" name="auteur" placeholder="auteur livre">
      <br><br><span class="label">Theme</span><br>
        <select class="in_to_chang" id="theme" name="theme">
        <option value="">---------</option>
        <?php
        for($i=0;$i<count($result1);$i++)
        echo '<option value="'.$result1[$i]['id_theme'].'">'.$result1[$i]['libelle_theme'].'</option>'; 
        ?>
        </select>
        <br><br>

        <span class="label">Description : </span><br>
        <textarea cols = "80" rows="3" name="description"></textarea>
        <br>
    
    <div class="etud__buttons">
            <input class="etud__button" type="button" name="chg_infos" value="Creer" onclick="this.form.submit();">
    </div>
    </div>
    </form>
    </div>
    </div>
    <?php
}



?>
