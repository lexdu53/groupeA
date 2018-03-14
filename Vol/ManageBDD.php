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
        }
        catch (Exception $e)
        {
            die($e->getMessage() . 'Erreur : ');
        }

       return $bdd;

    }

    /**
     *
     */
    function select(){

    }


    function listerAllVols(){
        $bdd = $this->connection();

        $reponse = $bdd->query("SELECT * FROM vol");

        $array_final = array();
        while ($donnees = $reponse->fetch())
        {
            
            $array_to_json = array(
                'ID' => $donnees['id'],
                'Ville départ' => $donnees['villedepart'],
                'Ville arrivé' => $donnees['villearrive'],
                'Date départ' => $donnees['datedepart'],
                'Date arrivé' => $donnees['datearrive'],
                'Places restante / Nombre de places total' => "xx / ".$donnees['nbplace'],
                'Prix' => $donnees['prix']
            );
            array_push($array_final, $array_to_json);
        }

        return $array_final;
        $reponse->closeCursor(); // Termine le traitement de la requête
    }

}