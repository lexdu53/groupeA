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

<<<<<<< HEAD

=======
use Firebase\JWT\JWT;
require_once './php-jwt-master/src/JWT.php';
$time =time();
$Key ="exemple key";
$token = array('ini'=>$time,
    'exp'=>$time+(60*60),
    'id'=>'1');
$jvt=JWT::encode($token,$Key);
$decode=JWT::decode($jvt,$Key,array('HS256'));
print_r($jvt);
echo '<br/><br/>';
print_r($decode);
>>>>>>> f8ec30839223b3b0e5fe1a9b25b413398db31d17


$engine = new Engine();

$engine->listerVols("","","","");


?>