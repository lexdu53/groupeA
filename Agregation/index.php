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

	//print_r(affichertouslesvols("listallvol"));
	print_r(affichertouslesvolsByVille("listallvol","Lyon","Paris"));

	if (isset($_POST['villeDepart']) && $_POST['villeDepart'] != NULL && isset($_POST['villeArrive']) && $_POST['villeArrive'] != NULL) {
        // Si on a envoyer le formulaire pour rechercher des vols 
        echo "test";
		$arrayVols = affichertouslesvolsByVille("listallvol", $_POST['villeDepart'], $_POST['villeArrive']);
		foreach ($arrayVols as $value){
		?> 
		<p>coucou</p>
			<p><?php echo "ID :".$value["ID"]."   Ville départ: ".$value["Ville départ"]."   Ville arrivé: ".$value["Ville arrivé"]."   Date départ: ".$value["Date départ"]."   Date arrivé : ".$value["Date arrivé"]."   Places restante / Nombre de places total :".$value["Places restante / Nombre de places total"]."   Prix :".$value["Prix"];?><p>
		<?php
		}
	}
?>

<link rel="stylesheet" href="formoid_files/formoid1/formoid-flat-green.css" type="text/css" />
<script type="text/javascript" src="formoid_files/formoid1/jquery.min.js"></script>
<form class="formoid-flat-green" style="background-color:#FFFFFF;font-size:14px;font-family:'Lato', sans-serif;color:#666666;max-width:480px;min-width:150px" method="post"><div class="title"><h2>Lister les vols</h2></div>
	<div class="element-input"><label class="title">Ville de départ</label><input class="large" type="text" name="villeDepart" /></div>
	<div class="element-input"><label class="title">Ville d'arrivé</label><input class="large" type="text" name="villeArrive" /></div>
<div class="submit"><input type="submit" value="Rechercher"/></div></form><script type="text/javascript" src="formoid_files/formoid1/formoid-flat-green.js"></script>