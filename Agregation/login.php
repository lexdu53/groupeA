<?php 
session_start();

include("../Vol/ManageBDD.php");

$etatConnexion = "Veuillez vous connecter";

if(isset($_POST['login']) && $_POST['login'] != NULL && isset($_POST['pass']) && $_POST['pass'] != NULL)
{
	// Si le formmulaire à été envoyé

	$managebdd = new ManageBDD();
    $managebdd -> connection();

    $user = htmlentities($_POST['login']);
    $password = htmlentities($_POST['pass']);

	$connectionuser = $managebdd->userConnection($user,$password);

if ($connectionuser) {
	$etatConnexion = "Vous etes connecté !";
}

}

?>


<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Login to Air IIA</title>
	</head>
	<body>
		<h3><?php echo $etatConnexion; ?></h3>
		<form method="post" action="login.php">
			<p>
				<label for="login">Votre login :</label>
				<input type="text" name="login" id="login" />

				<br />
				<label for="pass">Votre mot de passe :</label>
				<input type="password" name="pass" id="pass" />

			</p>
		</form>
	</body>
</html>

