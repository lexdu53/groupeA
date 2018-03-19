<?php
session_start();
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:07
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!isset($_SESSION['tokenUser']) || $_SESSION['tokenUser'] == NULL || !isset($_SESSION['login']) || $_SESSION['login'] == NULL){

	header('location: login.php');
}

	function checkErreur($array_from_Json){
		if(isset($array_from_Json['error'])){
	        echo "Erreur: ".$array_from_Json['error'];
		}
		if(isset($array_from_Json['errortoken'])){
	        session_destroy(); // Si on détecte qu'il y a une erreur sur le token on detruit la session et on redirige sur la page de connexion
	        header('location: login.php?token=expire');
	    }

	}


	function affichertouslesvols($fonction)
	{
		$myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction."&login=".$_SESSION['login']."&token=".$_SESSION['tokenUser'];
		
		$jsonFromURL = file_get_contents($myURL);
		$objFromJson = json_decode($jsonFromURL, true);
		
		//print_r($myURL);
		checkErreur($objFromJson);

		return $objFromJson; 
	}

    function affichertouslesvolsByVille($fonction,$villeDepart,$villeArrive)
    {
        $myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction."&login=".$_SESSION['login']."&token=".$_SESSION['tokenUser']."&villeDepart=".$villeDepart."&villeArrive=".$villeArrive;

        $jsonFromURL = file_get_contents($myURL);
        $objFromJson = json_decode($jsonFromURL, true);

        //print_r($myURL);
        checkErreur($objFromJson);

        return $objFromJson;
    }

    function reservation_vol($fonction,$id,$NbPlaces)
    {
        $myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction."&login=".$_SESSION['login']."&token=".$_SESSION['tokenUser']."&id=".$id."&NbPlaces=".$NbPlaces;

        $jsonFromURL = file_get_contents($myURL);
        $objFromJson = json_decode($jsonFromURL, true);

        //print_r($myURL);
        checkErreur($objFromJson);

        return $objFromJson;
    }

	//print_r(affichertouslesvols("listallvol"));
	//print_r(affichertouslesvolsByVille("listallvol","Lyon","Paris"));
    print_r(reservation_vol("reserv_vol",1,11));

?>