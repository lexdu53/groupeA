<?php
session_start();
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:07
 */


// Check si l'utilisateur est connecté : 


function connexionWebservices($user, $password)
	{

		//CURL PHP POUR ENVOYER LES LOGINS


		$myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction;
		

		//HTTPS AVEC FILE_GET_CONTENTS, JE CROIS CA MARCHE PAS
		$jsonFromURL = file_get_contents($myURL);
		$objFromJson = json_decode($jsonFromURL);
		//echo $objFromJson->access_token;
		
echo $jsonFromURL;

		//$myResponse = json_decode($myURL);
		//echo "et ta mere ? ";
		//$objFromJson = "test";
		return $objFromJson; 
	}



	function affichertouslesvols($fonction)
	{

		//CURL PHP POUR ENVOYER LES LOGINS


		$myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction;
		

		//HTTPS AVEC FILE_GET_CONTENTS, JE CROIS CA MARCHE PAS
		$jsonFromURL = file_get_contents($myURL);
		$objFromJson = json_decode($jsonFromURL);
		//echo $objFromJson->access_token;
		
echo $jsonFromURL;

		//$myResponse = json_decode($myURL);
		//echo "et ta mere ? ";
		//$objFromJson = "test";
		return $objFromJson; 
	}


	print_r(affichertouslesvols("listallvol"));



?>