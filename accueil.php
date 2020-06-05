<?php
session_start();
// on ouvre une session 
include_once('includes.php');
// le include permet de inclure le code du fichier include.php dans ce fichier actuel
?>
<!DOCTYPE html>
<header>
<title>Accueil</title>
</header>
<body>
<?php
if (isset($_SESSION['flash'])) {
foreach ($_SESSION['flash'] as $type => $message) : ?>
<div id="alert" class="alert alert-<?= $type; ?> infoMessage"><a ></span></a>
<?= $message; ?>

		</div>
<?php
// isset renverra false lors de la vérification d'une variable de valeur NULL
endforeach;
unset($_SESSION['flash']);
	}
	?>

<h1 >Accueil</h1>

<br />
<a href="deconnexion.php">Deconnexion</a>
<!-- le bouton deconnexion  va permettre de rediriger l'utilisateur a la page d'accueil il sera donc déconnecter
-->
</body>

</html>