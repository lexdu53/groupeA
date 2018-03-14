<?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 11:58
 */



class ManageBDD
{
    private $bdd;
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

        $this->bdd = $bdd;

    }

    /**
     *
     */
    function selectVolById($id,$nbPlaces){

        $reponse = $this->bdd->query('SELECT * FROM vol WHERE id=$id');

        if($reponse['nbplace']-$nbPlaces != 0){
            $this->bdd->exec('INSERT INTO reservation (villedepart,villearrive,datedepart,datearrive) VALUES ($id,$nbPlaces)');

            return 1;
        }else{

            return 2;
        }


    }


}