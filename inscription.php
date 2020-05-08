<?php
session_start();
include_once('includes.php');

if(isset($_SESSION['nomPrenom'])){
	header('Location: accueil.php');
	exit;
}

if(!empty($_POST)){
	extract($_POST);
	$valid = true;
	
	$Mail = htmlspecialchars(trim($Mail));
	$NomPrenom = htmlspecialchars(ucfirst(trim($NomPrenom)));
	$Password = trim($Password);
	$PasswordConfirmation = trim($PasswordConfirmation);
		
	if(empty($NomPrenom)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre votre nom et votre prénom !";
	}
	
	if(empty($Mail)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre un mail !";
	}
	
	$req = $DB->query('Select mail from user where mail = :mail', array('mail' => $Mail));
	$req = $req->fetch();
	
	if(!empty($Mail) && $req['mail']){
		$valid = false;
		$_SESSION['flash']['danger'] = "Ce mail existe déjà";
		
	}
	if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $Mail)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre un mail conforme !";
	}
	
	if(empty($Password)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez renseigner votre mot de passe !";

	}elseif($Password && empty($PasswordConfirmation)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez confirmer votre mot de passe !";
	
	}elseif(!empty($Password) && !empty($PasswordConfirmation)){
		if($Password != $PasswordConfirmation){
			
			$valid = false;
			$_SESSION['flash']['danger'] = "La confirmation est différente !";
		}
	}
		
	if($valid){	
$id_public = uniqid();		
$DB->insert('Insert into user (nomPrenom, mail, telephone, adresse, nbFoyer, password, idpublic) values (:nomPrenom, :mail, :telephone, :adresse, :nbFoyer, :password, :idpublic)', array('nomPrenom' => $NomPrenom, 'mail' => $Mail, 'telephone' => $telephone, 'adresse' => $adresse, 'nbFoyer' =>$nbFoyer, 'password' => crypt($Password, 'lolTuMoraPa'), 'idpublic' => $id_public));
$_SESSION['flash']['success'] = "Votre inscription a bien été prise en compte, connectez-vous !";
header('Location: connexion.php');
exit;
		
}	
}	
?>

<!DOCTYPE html>

	<header>
	<title>Inscription</title>
	</header>
	<body>
		
		<?php 
		    if(isset($_SESSION['flash'])){ 
		        foreach($_SESSION['flash'] as $type => $message): ?>
				<div id="alert" class="alert alert-<?= $type; ?> infoMessage"><a class="close">X</span></a>
					<?= $message; ?>
				</div>	
		    
			<?php
			    endforeach;
			    unset($_SESSION['flash']);
			}
	?>           
	<h1>Inscription</h1>
		            
	 <br/>
	                
	 <form method="post" action="inscription.php">
	<label>Nom et Pénom</label>
        <br/>
		<?php
	if(isset($error_nomPrenom)){
								echo $error_Prenom."<br/>";
							}	
						?>
<input type="text" name="NomPrenom"  value="<?php if (isset($NomPrenom)) echo $NomPrenom; ?>" required="required">	
					<br>
	<label>Mail</label>
	<br>
<input  name="Mail"  value="<?php if (isset($Mail)) echo $Mail; ?>" required="required">	
	
	<br>
	<label>Téléhone</label>
	<br>
<input  type="tel" name="telephone"  value="<?php if (isset($telephone)) echo $telephone; ?>" required="required">	
	
	<br>
	<label>Adresse</label>
	<br>
<input  type="text" name="adresse"  value="<?php if (isset($Mail)) echo $Mail; ?>" required="required">	
	
	<br>
	<label>Nombre de personne dans le foyer</label>
	<br>
<input  type="text" name="nbFoyer"  value="<?php if (isset($nbFoyer)) echo $nbFoyer; ?>" required="required">	
	
	<br>
 <label for="Password">Mot de passe</label>
	                    	
	<br/>
<?php
if(isset($error_password)){
	echo $error_password."<br/>";
		}	
?>
 <input type="password" name="Password"  value="<?php if (isset($Password)) echo $Password; ?>" required="required">
	<br>
	
<label>Confirmez votre mot de passe</label>
    </br>
	<?php
if(isset($error_passwordConf)){
	echo $error_passwordConf."<br/>";
			}	
		?>

   <input class="input" type="password" name="PasswordConfirmation"  required="required">
	<br>
<button type="submit">S'inscrire</button>                        
 </form>
	                             
 <br/>
	<br/>
<a href="index.php">Retour accueil</a>                
</div>
</body>
</html>
