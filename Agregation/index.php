<?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:07
 */

function calc($fonction, $arg1, $arg2)
{
    $myURL = "http://arnaudride.fr/webservices/tp/index.php";
    $myResponse = simplexml_load_file($myURL);
    if (isset($myResponse->resultat)) {
        return $myResponse->resultat; }
}




echo calc("add", "2", "2");