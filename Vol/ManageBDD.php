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

                $authentification = new Authentification();
                $key = uniqid();//mémoriser la clé
                $tokenUser = $authentification->generateToken($donnees['id'], $donnees['login'], $key);
                $this->updateKey($donnees['login'], $key);
                
                return $tokenUser;
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
    function getUserId($login){
        $reponse = $this->bdd->query("SELECT * FROM utilisateur WHERE login = '$login'");
        $donnees = $reponse->fetch();
        return $donnees['id'];
        $reponse->closeCursor(); // Termine le traitement de la requête

    }

    function selectVolById($idVol,$nbPlaces,$login){
        $utilisateur_id = $this->getUserId($login);

        if (($this->getPlaceLibre($idVol)-$nbPlaces) >= 0) {

            $requete = $this->bdd->prepare("INSERT INTO reservation (nbplace, vol_id,utilisateur_id) VALUES (:nbplace, :vol_id, :utilisateur_id)");
            $requete->bindParam(':nbplace',$nbPlaces);
            $requete->bindParam(':vol_id',$idVol);
            $requete->bindParam(':utilisateur_id',$utilisateur_id);
            if(($requete->execute())==0){
                return 3;
            }else return 1;
        } else {
            return 2;
        }
        $requete->closeCursor();
    }

    function getPlaceReserve($idVol){

        $reponse = $this->bdd->query("SELECT * FROM reservation WHERE vol_id = $idVol");
        $nbPlaceReserve = 0;
        while ($donnees = $reponse->fetch())
        {
            $nbPlaceReserve = $nbPlaceReserve + $donnees['nbplace'];
        }

        return $nbPlaceReserve;
        $reponse->closeCursor(); // Termine le traitement de la requête
    }

    function getPlaceLibre($idVol){

        $reponse = $this->bdd->query("SELECT * FROM vol WHERE id = $idVol");
        $donnees = $reponse->fetch();
        return ($donnees['nbplace']-$this->getPlaceReserve($idVol));
        $reponse->closeCursor(); // Termine le traitement de la requête


    }


    function listerAllVols(){

        $reponse = $this->bdd->query("SELECT * FROM vol WHERE datedepart > NOW()");

        $array_final = array();
        while ($donnees = $reponse->fetch())
        {
            $nbPlaceRestante = $donnees['nbplace'] - $this->getPlaceReserve($donnees['id']);
            if($nbPlaceRestante == 0){$reservationDispo = "Complet";}
            else{$reservationDispo = $nbPlaceRestante." / ".$donnees['nbplace'];}
            $array_to_json = array(
                'ID' => $donnees['id'],
                'Ville départ' => $donnees['villedepart'],
                'Ville arrivé' => $donnees['villearrive'],
                'Date départ' => $donnees['datedepart'],
                'Date arrivé' => $donnees['datearrive'],
                'Places restante / Nombre de places total' => $reservationDispo,
                'Prix' => $donnees['prix']
            );
            array_push($array_final, $array_to_json);
        }

        return $array_final;
        $reponse->closeCursor(); // Termine le traitement de la requête
    }

    function listerVolsByVille($villeDepart,$villeArrive){
        $reponse = $this->bdd->prepare("SELECT * FROM vol WHERE datedepart > NOW() AND villedepart= :villedepart AND villearrive= :villearrive");
        $reponse->bindValue(':villedepart',$villeDepart);
        $reponse->bindValue(':villearrive',$villeArrive);
        $reponse->execute();
        $array_final = array();
        while ($donnees = $reponse->fetch())
        {
            $nbPlaceRestante = $donnees['nbplace'] - $this->getPlaceReserve($donnees['id']);
            if($nbPlaceRestante == 0){$reservationDispo = "Complet";}
            else{$reservationDispo = $nbPlaceRestante." / ".$donnees['nbplace'];}
            $array_to_json = array(
                'ID' => $donnees['id'],
                'Ville départ' => $donnees['villedepart'],
                'Ville arrivé' => $donnees['villearrive'],
                'Date départ' => $donnees['datedepart'],
                'Date arrivé' => $donnees['datearrive'],
                'Places restante / Nombre de places total' => $reservationDispo,
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
            if($nbPlaceRestante == 0){$reservationDispo = "Complet";}
            else{$reservationDispo = $nbPlaceRestante." / ".$donnees['nbplace'];}
            $array_to_json = array(
                'ID' => $donnees['id'],
                'Ville départ' => $donnees['villedepart'],
                'Ville arrivé' => $donnees['villearrive'],
                'Date départ' => $donnees['datedepart'],
                'Date arrivé' => $donnees['datearrive'],
                'Places restante / Nombre de places total' => $reservationDispo,
                'Prix' => $donnees['prix']
            );
            array_push($array_final, $array_to_json);
        }

        return $array_final;
        $reponse->closeCursor(); // Termine le traitement de la requête
    }

    function updateKey($loginUser,$key){
        $this->bdd->exec("UPDATE utilisateur SET theKey='$key' WHERE login='$loginUser'");
    }

    function selectKey($loginUser){
        $reponse = $this->bdd->query("SELECT * FROM utilisateur WHERE login='$loginUser'");
        $donnees = $reponse->fetch();

        return $donnees['theKey'];
    }


}