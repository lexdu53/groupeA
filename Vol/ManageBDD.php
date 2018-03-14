<?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 11:58
 */

class ManageBDD
{

    function connection(){

        try
        {
            $bdd = new PDO('mysql:host=localhost:3307;dbname=tpvoyage;charset=utf8', 'tpvoyage', 'tpvoyage123');
            echo "ok";
        }
        catch (Exception $e)
        {
            die($e->getMessage() . 'Erreur : ');
            echo "erreur";
        }

    }

    /**
     *
     */
    function select(){

    }


}