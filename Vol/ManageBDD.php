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

    function __construct()
    {
        $this->connection();

    }

    function connection(){

        try
        {
            $this->bdd = new PDO('mysql:host=localhost:3307;dbname=tpvoyage;charset=utf8', 'tpvoyage', 'tpvoyage123');
        }
        catch (Exception $e)
        {
            die($e->getMessage() . 'Erreur : ');
        }


    }

    /**
     *
     */
    function selectVolById($id,$nbPlaces)
    {

        $reponse = $this->bdd->query('SELECT * FROM vol WHERE id=$id');

        if ($reponse['nbplace'] - $nbPlaces != 0) {
            $this->bdd->exec('INSERT INTO reservation (villedepart,villearrive,datedepart,datearrive) VALUES ($id,$nbPlaces)');

            return 1;
        } else {

            return 2;
        }
    }


    function listerAllVols(){

        $reponse = $this->bdd->query("SELECT * FROM vol");

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