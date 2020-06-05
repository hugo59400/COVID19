<?php
session_start();
// on ouvre la session
session_destroy();
// on detruit la session
header('Location: index.php');
// on redirige vers index.php
exit;	
?>