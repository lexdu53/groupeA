<?php
session_start();
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:07
 */
include ("Vol/Engine.php");

// Check si l'utilisateur est connecté : 
    if(!isset($_SESSION['login']) || $_SESSION['login'] == NULL){
            header('location: login.php');
        }

    if(!$engine->valideSession($_SESSION['id'])){
        header('location: Agregation/login.php?token=expire');
    }


<<<<<<< HEAD
function connexionWebservices($user, $password)
	{

		//CURL PHP POUR ENVOYER LES LOGINS


		$myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction;
		

		//HTTPS AVEC FILE_GET_CONTENTS, JE CROIS CA MARCHE PAS
		$jsonFromURL = file_get_contents($myURL);
		$objFromJson = json_decode($jsonFromURL);
		//echo $objFromJson->access_token;
		
		//echo $jsonFromURL;

		//$myResponse = json_decode($myURL);
		//echo "et ta mere ? ";
		//$objFromJson = "test";
		return $objFromJson; 
	}



=======
>>>>>>> cf50514c585fbd6493a032bbe25fe3ca7e8bc01b
	function affichertouslesvols($fonction)
	{
		$myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction;
		
		$jsonFromURL = file_get_contents($myURL);
		$objFromJson = json_decode($jsonFromURL);
		//echo $objFromJson->access_token;
		
		//$myResponse = json_decode($myURL);
		//echo "et ta mere ? ";
		//$objFromJson = "test";
		return $objFromJson; 

		//}
	}


	print_r(affichertouslesvols("listallvol"));



?>