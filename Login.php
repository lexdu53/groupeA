<?php 
session_start();

include("../Vol/ManageBDD.php");
include("../Vol/Authentification.php");

$disableChamps = "";

function connexion()
{
    if (isset($_GET['login']) && $_GET['login'] != NULL && isset($_GET['pass']) && $_GET['pass'] != NULL) {
        // Si le formmulaire à été envoyé
        $managebdd = new ManageBDD();
        $managebdd->connection();

        $user = htmlentities($_GET['login']);
        $password = htmlentities($_GET['pass']);

        $connectionuser = $managebdd->userConnection($user, $password);

        if ($connectionuser) {
            $etatConnexion = "Vous etes connecté " . $_SESSION['login'] . "!";
            $disableChamps = "disabled";

        } else {
            $etatConnexion = "Veuillez vérifier vos identifiants, on ne vous trouve pas dans la base de données...";
        }

    }


    if (isset($_SESSION['login']) && $_SESSION['login'] != NULL) {
        //header('Content-Type: application/json');
        header('location: index.php');


        $array_to_json = array('token' => $_SESSION['tokenUser']);
        echo json_encode($array_to_json);

        $etatConnexion = "Vous etes déjà connecté " . $_SESSION['login'] . " !";
        $disableChamps = "disabled";
    } else {
        $etatConnexion = "Veuillez vous connecter";
    }
}

?>

