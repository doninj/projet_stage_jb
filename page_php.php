<?php

try
{
    /*pour du postgres
    //variable pour changer les paramètres de la base de données.
    $hostname="pgsql:host=localhost;dbname=postgres";
    $username="postgres";
    $password="root";
    */
    
    //connexion avec mysql

    $hostname="mysql:host=127.0.0.1;dbname=carrefour_siite";
    $username="root";
    $password="";

    // On se connecte à la base de donnée
    
	$bdd = new PDO($hostname,$username,$password);
}
catch(Exception $e)
{
	//* En cas d'erreur, on affiche un message et on arrête tout
     die('Erreur : '.$e->getMessage());
}

$querySelect=$bdd->query('SELECT VILLE,VM,disque,cast(Capacity as decimal)as Capacity,cast(Free2 as decimal)as Free2,FreeP,OS from carrefour_site');
//$querySelect = $bdd->query('SELECT ville,vm,disque,freepourcent,capacity,freemb,os FROM carrefour_sitte');
$res=$querySelect->fetch();
$res=$res['OS'];
/* /!\ cela ne marche qu'avec phpmydamin /!\

requête pour recuperer les informations de la base de donnée 
$requêteInformation = "SHOW TABLE STATUS LIKE 'carrefour_sitte'";

requête pour lancer la requête des informations
$requêteInformation = $bdd->query($requêteInformation);

reqûete pour avoir les informations de la table
$dataInformation = $requêteInformation->fetch();

de mettre dans une variable la date de modification de la base de donnée
last_modification = $dataInformation['Update_time'];

*/
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VM décentralisé: informations</title>
    <script src="https://kit.fontawesome.com/f3d01edde9.js"></script>

    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
                            <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css>
                            <!-- style css de remplacement des paramètres bootstrap et style de base-->
    <link rel="stylesheet" href="css/style.css">
                            <!-- style css pour introduire la datatable avec bootstrap-->
    <link rel="stylesheet" href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
                            <!-- style css pour les boutons de la datatable en bootstrap-->
    <link ref="stylesheet" href='https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css'>
                            <!-- style css pour le fixedheader de la datatable-->
    <link ref="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <header>


        <nav id="nav" class="navbar navbar-expand-sm navbar-dark bg-primary">
            <img src="image/carrefour.png">



            
            <!--  /!\ marche qu'avec phpmydamin /!\ 
            affiche la date de modification 
            <ul class="navbar-nav mx-auto sm-12">
                <li class="nav-item">
                <p id="bienvenue">informations du: <?php // echo $last_modification ?></p>
                </li>
            </ul>    -->

            </div>
    </header>

    <div class="container">
        <div class="table-responsive">
            <!-- creation de la table -->
            <table id="employee_data" class="table table-striped table-bordered nowrap" width="100%">
                <thead>
                    <tr>
                        <td >Ville</td>
                        <td >disk</td>
                        <td >VM</td>
                        <td >capacité <br>Total Go</td>
                        <td >capaicté <br>libre Go  </td>
                        <td >capacité en % libre </td>
                        <td >OS </td>
                    </tr>
                </thead>

<tbody>
<?php
//affiche les ligne de la base de donnée une à une dans un tableau
while ($row=$querySelect->fetch())
{
?>
                <tr>
                    <!-- attention! Mettre dans $row le nom indiqué dans la base de donnée.-->
                    <td><?php echo $row["VILLE"];?></td>
                    <td><?php echo $row["VM"];?></td>
                    <td><?php echo $row["disque"];?></td>

                    <td><?php echo $row["Capacity"];?></td>
                    <td><?php echo $row["Free2"];?></td>
                    <td><?php echo $row["FreeP"];?></td>

                    <td><?php echo $row["OS"];?></td>

                </tr>
<?php  
} //fin du tableau: toute les données de la bdd sont dans le tableau
?>
</tbody>
<tfoot>
                        <tr>
                        <th>Ville</th>
                        <th>disk</th>
                        <th>VM</th>
                        <th>capacité <br>Total Go</th>
                        <th>capaicté <br>libre Go</th>
                        <th>capacité en % libre </th>
                        <th>OS </th>
                    </tr>
</tfoot>

            </table>
        </div>
    </div>
</div>
</html>

            <!-- script pour jquery/bootstrap et datatable-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>  
    <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
                        <!-- Script pour bouton -->
<script src='https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js'></script>
                        <!-- script pour fixer l'entête -->
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
                        <!-- script pour responsive-->
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" src="script.js"></script>