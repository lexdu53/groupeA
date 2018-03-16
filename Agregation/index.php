<?php
session_start();
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:07
 */

// Check si l'utilisateur est connecté : 
    if(!isset($_SESSION['login']) || $_SESSION['login'] == NULL){
            header('location: login.php');
        }


	function affichertouslesvols($fonction, $arg1, $arg2)
	{
		$myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction."&arg1=".$arg1."&arg2=".$arg2;
		
		$jsonFromURL = file_get_contents($myURL);
		$objFromJson = json_decode($jsonFromURL);
		//echo $objFromJson->access_token;
		
		//$myResponse = json_decode($myURL);
		
		$objFromJson = "test";
		return $objFromJson; 
		//}
	}


	print_r(affichertouslesvols("listallvol", "2", "2"));



?>