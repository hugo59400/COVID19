<?php
session_start();
include_once('includes.php');
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
endforeach;
unset($_SESSION['flash']);
	}
	?>

<h1 >Accueil</h1>

<br />
<a href="deconnexion.php">Deconnexion</a>
</body>
</html>