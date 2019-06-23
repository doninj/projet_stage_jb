<?php

try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost:3307;dbname=carrefour;charset=utf8', 'root', '',array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true,
    ));
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
    //supression de la table

    $del = 'DELETE FROM `site_carrefour`';
$insertion_req=$bdd->query($del);

$sql_2 = 'LOAD DATA LOCAL INFILE \'Classeur1_1.csv\' REPLACE INTO TABLE `site_carrefour` FIELDS TERMINATED BY \';\' ENCLOSED BY \'\' ESCAPED BY \'\' LINES TERMINATED BY \'\\r\\n\' IGNORE 1 LINES';
 
$insertion_req=$bdd->query($sql_2);
?>
