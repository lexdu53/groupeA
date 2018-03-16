<?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:14
 */

session_start();

class Engine
{

    private $manageBdd;

    function __construct() {
        $this->manageBdd=new ManageBDD();
        $this->manageBdd->connection();
    }
    
    function listerVols($dateDepart, $dateArrive,$villeDepart,$villeArrive){

		$bdd = new ManageBDD();

		if($dateDepart == NULL && $dateArrive == NULL && $villeDepart == NULL && $villeArrive == NULL ){
			//Si on veut lister l'ensemble des vols de la base de données sauf ceux déjà effectué 
			$return = json_encode($bdd->listerAllVols());

		}

		echo $return;
    }

    /**
     * @param $id
     */
    function reserver($id,$nbPlaces){


        switch ($this->manageBdd->select($id,$nbPlaces)){

            case 1:
                echo "Avion réservé";
                break;

            case 2:
                echo "Il ne reste plus accès de place";
                break;

            default:
                break;
        }
    }

    function valideSession($idUser){

        $authentificaton=new Authentification();
        $key = $this->manageBdd->selectKey($idUser); //id de session utilisateur
        
        return $authentificaton->analyseToken($_SESSION['token'],$key);
    }

}