<?php 
session_start();

$disableChamps = "";
$etatConnexion = "Veuillez vous connecter";


if(isset($_POST['login']) && $_POST['login'] != NULL && isset($_POST['pass']) && $_POST['pass'] != NULL)
{
    // Si le formmulaire à été envoyé

    $myURL = "https://www.arnaudride.fr/webservices/tp/Login.php?login=".$_POST['login']."&pass=".$_POST['pass'];
    $result = file_get_contents($myURL);
    $objFromJson = json_decode($result, true);

    //print_r($objFromJson);
    
    if(isset($objFromJson['token'])){
        echo "Token Info  : ".$objFromJson['token'];
        $_SESSION['tokenUser'] = $objFromJson['token'];
        $_SESSION['login'] = htmlspecialchars($_POST['login']);

        $etatConnexion = "Vous etes connecté ".$_SESSION['login']."!";
    }
}


if (isset($_SESSION['login']) && $_SESSION['login'] != NULL){
    //Si on est déjà connecté : 
    header('location: index.php');
}
else{

    if(isset($objFromJson['error'])){
        $etatConnexion = $objFromJson['error'];
    }
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
