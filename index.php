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

if(!$engine->valideSession($_SESSION['id'])){
    header('location: Agregation/login.php');
}

//$engine->valideSession();


if(isset($_GET['function']) && $_GET['function'] == "listallvol")
{
	$engine->listerVols("","","","");
}


?>