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
            $bdd = new PDO('mysql:host=localhost:/run/mysqld/mysqld10.sock;dbname=tpvoyage;charset=utf8', 'tpvoyage', 'tpvoyage123');
        }
        catch (Exception $e)
        {
            die($e->getMessage() . 'Erreur : ');
        }

    }

    /**
     *
     */
    function select(){

    }


}