<?php 
session_start();

include ("../Vol/ManageBDD.php");
include ("../Vol/Authentification.php");

$disableChamps = "";

if(isset($_POST['login']) && $_POST['login'] != NULL && isset($_POST['pass']) && $_POST['pass'] != NULL)
{
	// Si le formmulaire à été envoyé

	$managebdd = new ManageBDD();
    $managebdd->connection();

    $user = htmlentities($_POST['login']);
    $password = htmlentities($_POST['pass']);

	$connectionuser = $managebdd->userConnection($user,$password);

	if ($connectionuser) {
		$etatConnexion = "Vous etes connecté ".$_SESSION['login']."!";
		$disableChamps = "disabled";

	}
	else{
		$etatConnexion = "Veuillez vérifier vos identifiants, on ne vous trouve pas dans la base de données...";
	}

}


if (isset($_SESSION['login']) && $_SESSION['login'] != NULL){
	//header('Content-Type: application/json');
	header('location: index.php');


    $array_to_json = array('token' => $_SESSION['tokenUser']);
    echo json_encode($array_to_json);

	$etatConnexion = "Vous etes déjà connecté ".$_SESSION['login']." !";
	$disableChamps = "disabled";
}
else{
	$etatConnexion = "Veuillez vous connecter";

?>

<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Login to Air IIA</title>
	</head>
	<body>
		<h3>Etat de votre connexion au sercice : <?php echo $etatConnexion; if(isset($_GET['token']) && $_GET['token'] == "expire") {echo " Token expiré";} ?></h3>
		<form method="post" action="login.php">
			<p>
				<label for="login">Votre login :</label>
				<input type="text" name="login" id="login" <?php echo $disableChamps; ?> />

				<br />
				<label for="pass">Votre mot de passe :</label>
				<input type="password" name="pass" id="pass" <?php echo $disableChamps; ?> />

			</p>
			    <input type="submit" value="Connexion" />
		</form>
	</body>
</html>

<?php
	}
?>
