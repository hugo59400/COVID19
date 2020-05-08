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
	$Password = trim($Password);
		
	if(empty($Mail)){
		$valid = false;
		$_SESSION['flash']['warning'] = "Veuillez renseigner votre mail !";
	}
	
	if(empty($Password)){
		$valid = false;
		$error_password = "Veuillez renseigner un mot de passe !";
	}
$req = $DB->query('Select * from user where mail = :mail and password = :password', array('mail' => $Mail, 'password' => crypt($Password, 'lolTuMoraPa')));
$req = $req->fetch();
		
	if(!$req['mail']){
		$valid = false;
		$_SESSION['flash']['danger'] = "Votre mail ou mot de passe ne correspondent pas";
	}
	if($valid){
		//$_SESSION['id'] = $req['id'];
		$_SESSION['id'] = $req['idpublic'];
		$_SESSION['nomPrenom'] = $req['Prenom'];
		$_SESSION['mail'] = $req['mail'];
		$_SESSION['telephone'] = $req['telephone'];
		$_SESSION['adresse'] = $req['adresse'];
		$_SESSION['nbFoyer'] = $req['nbFoyer'];
		$_SESSION['password'] = $req['password'];
		
		$_SESSION['flash']['info'] = "Bonjour " . $_SESSION['nomPrenom'];
		header('Location: accueil.php');
		exit;
			
	}
	
}	
?>

<!DOCTYPE html>
<html lang="fr">
	<header>
	<title>Connexion</title>
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
          
        <h1>Connexion</h1>
		            
   <br/>
	                
  <form class="con-form" method="post" action="">
	                    
     <label>Mail</label>
<br>
  <input class="input" type="email" name="Mail" placeholder="Mail" value="<?php if (isset($Mail)) echo $Mail; ?>" required="required">	
<br>
	<br/>
						
<label>Mot de passe</label>
	                    	
         <br/>
		<?php
	if(isset($error_password)){
		echo $error_password."<br/>";
			}	
	?>
<input class="input" type="password" name="Password" placeholder="Mot de passe" value="<?php if (isset($Password)) echo $Password; ?>" required="required">
	<br>
	<br>                   
<button type="submit">Se connecter</button>                                                          
</body>
</html>
