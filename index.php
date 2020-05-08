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
	if($valid){		
}
}	
?>
<!DOCTYPE html>
<header>
<meta charset="utf-8">
<title>Accueil</title>
</header>
<body>
			
	<h2>Bienvenue veuillez vous inscrire ou connecter s'il vous plait </h2>	 				
<button type="button" onclick="self.location.href='inscription.php'">Inscription</button>	

	<br>
	<br>
	<button type="button" onclick="self.location.href='connexion.php'">Connexion</button>
	
</body>
</html>