<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] != NULL){
	$login = $_SESSION['login'];

	session_destroy();


}

?>

<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Deconnexion Air IIA</title>
	</head>
	<body>
		<h3>A plus tard <?php if(isset($login) != NULL) echo $login; ?> :)</h3>
		
	</body>
</html>
