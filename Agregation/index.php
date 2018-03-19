<?php
session_start();
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:07
 */
include ("Vol/Engine.php");
include ("Vol/Login.php");
include ("Vol/Logout.php");

$login;
// Check si l'utilisateur est connecté :
    if(!isset($_SESSION['login']) || $_SESSION['login'] == NULL){
            header('location: Login.php');
        }

    if(!$engine->valideSession($_SESSION['id'])){
        header('location: Agregation/Login.php?token=expire');
    }

	function affichertouslesvols($fonction)
	{
	    echo "In afficher tous les vols";
		$myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction;
		
		//$jsonFromURL = file_get_contents($myURL);
		//$objFromJson = json_decode($jsonFromURL);
		//echo $objFromJson->access_token;
		
		//$myResponse = json_decode($myURL);
		//echo "et ta mere ? ";
		//$objFromJson = "test";
		return $objFromJson; 

		//}
	}


	print_r(affichertouslesvols("listallvol"));



?>