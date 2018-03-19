<?php
session_start();
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:07
 */
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


header('Content-Type: application/json');


include ("../Vol/Engine.php");

$engine= new Engine();

if(isset($_GET['function']) && $_GET['function'] == "listallvol" && !isset($_GET['villeDepart']) && !isset($_GET['villeArrive']) )
{
    $myURL=$engine->listerVols("","","","");
    return $myURL;
}

if(isset($_GET['function']) && $_GET['function'] == "listallvol" && isset($_GET['villeDepart']) && isset($_GET['villeArrive']))
{
    //    $myURL=$engine->listerVols($dateDepart,$dateArrive,$villeDepart,$villeArrive);
    $myURL=$engine->listerVols("","",$_GET['villeDepart'],$_GET['villeArrive']);

    return $myURL;
}

if(isset($_GET['function']) && $_GET['function'] == "reserv_vol" && isset($_GET['id']) && isset($_GET['NbPlaces']))
{
    $utilisateur_id=1;
    $myURL=$engine->reserver($_GET['id'],$_GET['NbPlaces'], $utilisateur_id);
    return $myURL;
}



?>





