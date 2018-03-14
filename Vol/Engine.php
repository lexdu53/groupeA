<?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 14:14
 */

class Engine
{

    function listerVols($dateDepart, $dateArrive,$villeDepart,$villeArrive){

		$bdd = new ManageBDD();

		if($dateDepart == NULL && $dateArrive == NULL && $villeDepart == NULL && $villeArrive == NULL ){
			//Si on veut lister l'ensemble des vols de la base de données 
			$return = json_encode($bdd->listerAllVols());

		}

		echo $return;
    }

    /**
     * @param $id
     */
    function reserver($id){

    }




}