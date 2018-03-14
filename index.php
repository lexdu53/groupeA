<?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 12:06
 */
header('Content-Type: application/json');

include ("Vol/ManageBDD.php");
include ("Vol/Engine.php");

$engine = new Engine();

$engine->listerVols("","","","");


?>