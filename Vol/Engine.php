<?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:14
 */

//set_include_path('.:/Applications/MAMP/bin/php/php7.1.8/lib/php');
//include("ManageBDD.php");

///include_path ="/Vol/ManageBDD.php";


class Engine
{

    private $manageBdd;

    function __construct() {
        $this->manageBdd=new ManageBDD();
        $this->manageBdd->connection();
    }
    
    function listerVols($dateDepart, $dateArrive,$villeDepart,$villeArrive){

    //    else $dateDepart="";
		if($dateDepart == NULL && $dateArrive == NULL && $villeDepart == NULL && $villeArrive == NULL ){
			//Si on veut lister l'ensemble des vols de la base de données sauf ceux déjà effectué
			$return = json_encode($this->manageBdd->listerAllVols());
		}

        if($villeDepart != NULL && $villeArrive != NULL && $dateDepart == NULL && $dateArrive == NULL ){
            //Si on veut lister l'ensemble des vols de la base de données sauf ceux déjà effectué
            $return = json_encode($this->manageBdd->listerVolsByVille($villeDepart,$villeArrive));
        }

		echo $return;
    }

    /**
     * @param $id
     */
    function reserver($idVol,$nbPlaces,$login){
        switch ($this->manageBdd->selectVolById($idVol,$nbPlaces,$login)){
            case 1:
                return "Réservation OK";
                break;

            case 2:
                return "Le nombre de place n'est pas disponible";
                break;

            case 3:
                return "Erreur exec";
                break;
            default:
                return "Erreur";
        }
    }

    function valideSession($loginUser, $tokenUser){

        $authentificaton=new Authentification();
        $key = $this->manageBdd->selectKey($loginUser); //id de session utilisateur
        
        if($authentificaton->analyseToken($tokenUser,$key)){
        	// Si le token est expiré on kill la session
        	//session_destroy();
        	return true;
        }
        else{
        	session_destroy();
        	return false;
        }
    }

}