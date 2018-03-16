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

    function userConnection($user,$password){

        $reponse = $this->bdd->query("SELECT * FROM utilisateur WHERE login='$user'");
        $donnees = $reponse->fetch();

        if($donnees != NULL){
            if(sha1($password) == $donnees['password']){

                $_SESSION['prenom'] = $donnees['prenom'];
                $_SESSION['nom'] = $donnees['nom'];
                $_SESSION['login'] = $donnees['login'];
                $_SESSION['id'] = $donnees['id'];

                $authentification = new Authentification();
                $_SESSION['tokenUser'] = $authentification->generateToken($donnees['id'], $donnees['login']);

                return true;
            }
            else{
                return false;
            }
        }
        else {
            return false;
        }
    }

    /**
     *
     */
    function selectVolById($id,$nbPlaces){

        $reponse = $this->bdd->query('SELECT * FROM vol WHERE id=$id');

        if ($reponse['nbplace'] - $nbPlaces != 0) {
            $this->bdd->exec('INSERT INTO reservation (villedepart,villearrive,datedepart,datearrive) VALUES ($id,$nbPlaces)');

            return 1;
        } else {

            return 2;
        }
    }

    function getPlaceReserve($idVol){

        $reponse = $this->bdd->query("SELECT * FROM reservation WHERE vol_id = $idVol");
        $nbPlaceReserve = 0;

        $array_final = array();
        while ($donnees = $reponse->fetch())
        {
            $nbPlaceReserve = $nbPlaceReserve + $donnees['nbplace'];
        }

        return $nbPlaceReserve;

        $reponse->closeCursor(); // Termine le traitement de la requête
    }


    function listerAllVols(){

        $reponse = $this->bdd->query("SELECT * FROM vol WHERE datedepart > NOW()");

        $array_final = array();
        while ($donnees = $reponse->fetch())
        {
            $nbPlaceRestante = $donnees['nbplace'] - $this->getPlaceReserve($donnees['id']);
            $array_to_json = array(
                'ID' => $donnees['id'],
                'Ville départ' => $donnees['villedepart'],
                'Ville arrivé' => $donnees['villearrive'],
                'Date départ' => $donnees['datedepart'],
                'Date arrivé' => $donnees['datearrive'],
                'Places restante / Nombre de places total' => $nbPlaceRestante." / ".$donnees['nbplace'],
                'Prix' => $donnees['prix']
            );
            array_push($array_final, $array_to_json);
        }

        return $array_final;
        $reponse->closeCursor(); // Termine le traitement de la requête
    }

    function listerVols($dateDepart, $dateArrive,$villeDepart,$villeArrive){
        $reponse = $this->bdd->query("SELECT * FROM vol WHERE datedepart > NOW()");

        $array_final = array();
        while ($donnees = $reponse->fetch())
        {
            $nbPlaceRestante = $donnees['nbplace'] - $this->getPlaceReserve($donnees['id']);
            $array_to_json = array(
                'ID' => $donnees['id'],
                'Ville départ' => $donnees['villedepart'],
                'Ville arrivé' => $donnees['villearrive'],
                'Date départ' => $donnees['datedepart'],
                'Date arrivé' => $donnees['datearrive'],
                'Places restante / Nombre de places total' => $nbPlaceRestante." / ".$donnees['nbplace'],
                'Prix' => $donnees['prix']
            );
            array_push($array_final, $array_to_json);
        }

        return $array_final;
        $reponse->closeCursor(); // Termine le traitement de la requête
    }

    function updateKey($id,$key){
        $this->bdd->query("UPDATE utilisateur SET theKey='$key' WHERE id=$id");
    }

    function selectKey($id){
        return $this->bdd->query("SELECT theKey FROM utilisateur WHERE id=$id");
    }

    


}