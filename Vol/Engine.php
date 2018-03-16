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
        $this->managebdd=new ManageBDD();
        $this->managebdd->connection();
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

    function valideSession($token,$id){

        $authentificaton=new Authentification();
        $key = $this->manageBdd->selectKey($_SESSION['id']);//id de session utilisateur
        return $authentificaton->analyseToken(token,$key);


    }




}