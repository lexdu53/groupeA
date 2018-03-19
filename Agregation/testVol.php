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


//header('Content-Type: application/json');


include ("../Vol/Engine.php");

$engine= new Engine();

if(isset($_GET['function']) && $_GET['function'] == "listallvol")
{
    $myURL=$engine->listerVols("","","","");
    return $myURL;
}

if(isset($_GET['function']) && $_GET['function'] == "reserv_vol" && isset($_GET['id']) && isset($_GET['NbPlaces']))
{

    $myURL=$engine->reserver($_GET['id'],$_GET['NbPlaces']);
    return $myURL;
}


?>





