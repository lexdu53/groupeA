<?php
session_start();
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 12:06
 */
//header('Content-Type: application/json');

include ("Vol/ManageBDD.php");
include ("Vol/Engine.php");
use Firebase\JWT\JWT;
require_once './php-jwt-master/src/JWT.php';






$engine = new Engine();

$engine->listerVols("","","","");


?>