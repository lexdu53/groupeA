<?php 

include("Vol/ManageBDD.php");
include("Vol/Authentification.php");
include("Vol/Engine.php");

header('Content-Type: application/json');

$disableChamps = "";


    if (isset($_GET['login']) && $_GET['login'] != NULL && isset($_GET['pass']) && $_GET['pass'] != NULL) {
        // Si les données de connexion sont envoyé
        $managebdd = new ManageBDD();
        $managebdd->connection();

        $user = htmlentities($_GET['login']);
        $password = htmlentities($_GET['pass']);

        $connectionuser = $managebdd->userConnection($user, $password);

        if ($connectionuser) {

            $array_to_json = array('token' => $connectionuser);
            echo json_encode($array_to_json);


            $etatConnexion = "Vous etes connecté " . $_SESSION['login'] . "!";
            $disableChamps = "disabled";

        } else {
            $etatConnexion = "Veuillez vérifier vos identifiants, on ne vous trouve pas dans la base de données...";
            $array_to_json = array('error' => $etatConnexion);
            echo json_encode($array_to_json);
        }

    }


// Verifier la validité du token :
    if (isset($_GET['login']) && $_GET['login'] != NULL && isset($_GET['token']) && $_GET['token'] != NULL) {
        
        $engine = new Engine();

        if(!$engine->valideSession(htmlentities($_GET['login']), htmlentities($_GET['token']))){
            $etatConnexion = "Token expiré";
            $array_to_json = array('errortoken' => $etatConnexion);
            echo json_encode($array_to_json);
        }
        else{
            $array_to_json = array('token' => $_GET['token']);
            echo json_encode($array_to_json);
        }


    }



?>

