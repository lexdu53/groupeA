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

    function reservation_vol($fonction,$idVol,$NbPlaces)
    {
        $myURL = "https://www.arnaudride.fr/webservices/tp/index.php?function=".$fonction."&login=".$_SESSION['login']."&token=".$_SESSION['tokenUser']."&id=".$idVol."&NbPlaces=".$NbPlaces;

        $jsonFromURL = file_get_contents($myURL);
        $objFromJson = json_decode($jsonFromURL, true);

        print_r($myURL);
        checkErreur($objFromJson);

        return $objFromJson;
    }

	//print_r(affichertouslesvols("listallvol"));
	//print_r(affichertouslesvolsByVille("listallvol","Lyon","Paris"));
    //print_r(reservation_vol("reserv_vol",1,11));

	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Lister les vols - Formoid online form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body class="blurBg-false" style="background-color:#EBEBEB">

		<link rel="stylesheet" href="formoid_files/formoid1/formoid-flat-green.css" type="text/css" />
		<script type="text/javascript" src="formoid_files/formoid1/jquery.min.js"></script>
		
		<form class="formoid-flat-green" style="background-color:#FFFFFF;font-size:14px;font-family:'Lato', sans-serif;color:#666666;max-width:480px;min-width:150px" method="get">
			<div class="title"><h2>Lister les vols</h2></div>
			<div class="element-input"><label class="title">Ville de départ</label>
				<input class="large" type="text" name="villeDepart" value="<?php if (isset($_GET['villeDepart']) && $_GET['villeDepart'] != NULL) {echo $_GET['villeDepart'];} ?>" />
			</div>
			<div class="element-input"><label class="title">Ville d'arrivé</label>
				<input class="large" type="text" name="villeArrive" value="<?php if(isset($_GET['villeArrive']) && $_GET['villeArrive'] != NULL) {echo $_GET['villeArrive'];} ?>" />
			</div>
			<div class="submit"><input type="submit" value="Rechercher"/></div>
		</form>

		<script type="text/javascript" src="formoid_files/formoid1/formoid-flat-green.js"></script>



<?php
if (isset($_GET['villeDepart']) && $_GET['villeDepart'] != NULL && isset($_GET['villeArrive']) && $_GET['villeArrive'] != NULL) {
    // Si on a envoyer le formulaire pour rechercher des vols 
    $villeDepart = $_GET['villeDepart'];
    $villeArrive = $_GET['villeArrive'];

    $arrayVols = affichertouslesvolsByVille("listallvol","$villeDepart","$villeArrive");
	?>
	<style>
		table{
		    border-collapse: collapse;
		}
		td, th{
		    border: 1px solid black;
		}
	</style>
	<table>
	   <caption>Resultats : </caption>
	   <tr>
	       <th>ID</th>
	       <th>Ville départ</th>
	       <th>Ville arrivé</th>
	       <th>Date départ</th>
	       <th>Date arrivé</th>
	       <th>Places restante / Nombre de places total</th>
	       <th>Prix</th>
	       <th>Réservation</th>
	   </tr>
	<?php
	foreach ($arrayVols as $value){
	?> 
	  	<tr>
			<td><?php echo $value["ID"]; ?></td>
			<td><?php echo $value["Ville départ"]; ?></td>
			<td><?php echo $value["Ville arrivé"]; ?></td>
			<td><?php echo $value["Date départ"]; ?></td>
			<td><?php echo $value["Date arrivé"]; ?></td>
			<td><?php echo $value["Places restante / Nombre de places total"]; ?></td>
			<td><?php echo $value["Prix"]; ?></td>
			<td><?php if($value["Places restante / Nombre de places total"] != "Complet"){ echo '<a href="index.php?function=reserveVol&idVol='.$value["ID"].'">Réserver ce vol </a></td>';} else {echo '<b style="color:red;">COMPLET<b>';} ?>
		</tr>
	<?php
	}
	echo "</table>";
}

if (isset($_GET['function']) && $_GET['function'] != NULL && isset($_GET['idVol']) && $_GET['idVol'] != NULL) {

	?>
		<form class="formoid-flat-green" style="background-color:#FFFFFF;font-size:14px;font-family:'Lato', sans-serif;color:#666666;max-width:480px;min-width:150px" method="post">
			<div class="title"><h2>Reserver le vol : </h2></div>
			<div class="element-number"><label class="title">Nombre de billet</label><input class="large" type="number"" min="1" max="100" name="nbPlace" /></div>
			<div class="submit"><input type="submit" value="Réserver"/></div>
		</form>

	<?php
	if (isset($_GET['nbPlace']) && $_GET['nbPlace'] != NULL) {
		//Si on a le nombre de place : 
		$resultat = reservation_vol("reserv_vol", $_GET['idVol'], $_GET['nbPlace']);

		echo "<h3>$resultat</h3>";
	}


}
	?>

	</body>
</html>