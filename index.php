<?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 12:06
 */

include ("Vol/ManageBDD.php");

$connection = new ManageBDD();
$bdd = $connection->connection();

$reponse = $bdd->query('SELECT * FROM vol');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>

    <strong>Vol</strong> : <?php echo $donnees['villedepart']." - ".$donnees['villearrive']; ?><br />

    Dates :  au depart <?php echo $donnees['datedepart']; ?> - a l'arrivé : <?php echo $donnees['datearrive']; ?>  !<br />


   </p>

<?php

}


$reponse->closeCursor(); // Termine le traitement de la requête
?>