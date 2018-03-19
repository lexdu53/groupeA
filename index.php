<?php
session_start();
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 12:06
 */
header('Content-Type: application/json');


include ("Vol/ManageBDD.php");
include ("Vol/Engine.php");
include ("Vol/Authentification.php");

$engine = new Engine();

if(isset($_GET['token']) && $_GET['token'] != NULL && isset($_GET['login']) && $_GET['login'] != NULL){


	$login = htmlspecialchars($_GET['login']);
	$token = htmlspecialchars($_GET['token']);

	if($engine->valideSession($login, $token)){

		// Code de l'api

		if(isset($_GET['function']) && $_GET['function'] == "listallvol")
		{
			$engine->listerVols("","","","");
		}

	}
	else{

		$etatConnexion = "Token expiré";
	    $array_to_json = array('errortoken' => $etatConnexion);
	    echo json_encode($array_to_json);

	}

}
else{

	$etatConnexion = "Veuillez envoyer votre token et votre nom d'utilisateur";
    $array_to_json = array('error' => $etatConnexion);
    echo json_encode($array_to_json);
}


?>