<?php

try
{
	// On se connecte à MySQL
	$bdd = new PDO("pgsql:host=localhost;dbname=postgres","postgres","root");
}
catch(Exception $e)
{
	//* En cas d'erreur, on affiche un message et on arrête tout
     die('Erreur : '.$e->getMessage());
}

$querySelect = $bdd->query('SELECT ville,vm,disque,freepourcent,capacity,freemb,os FROM carrefour_sitte');

/*
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
    <title>CSV to HTML Table Example</title>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css>

    <link rel="stylesheet" href="css/style.css">

   <link rel="stylesheet" href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>

<link ref="stylesheet" href='https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    //*header pour la barre de présentation
    <header>

        <nav id="nav" class="navbar navbar-expand-md navbar-dark bg-primary">
            <img src="image/carrefour.png">



            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <p id="bienvenue">Date de modification: <?php // echo $last_modification ?></p>
                </li>
            </ul>

            </li>
            </ul>
            </div>
    </header>
    <?php
    /*test d'affichage pour la date de modification 
     echo $last_modification 
     */
    ?>

    <div class="container">
        <div class="table-responsive">
            <!-- creation de la table -->
            <table id="employee_data" class="table table-striped table-hover dt-responsive display nowrap" width="100%">>
                <thead>
                    <tr>
                        <td>Ville</td>
                        <td>VM</td>
                        <td> DISK</td>
                        <td>capa MB</td>
                        <td>Free MB </td>
                        <td> free % </td>
                        <td> OS </td>
                    </tr>
                </thead>


<?php
//affiche les ligne de la base de donnée une à une dans un tableau
while ($row=$querySelect->fetch())
{
?>
                <tr>
                    <!-- attention! Mettre dans $row le nom indiqué dans la base de donnée.-->
                    <td><?php echo $row["ville"];?></td>
                    <td><?php echo $row["vm"];?></td>
                    <td><?php echo $row["disque"];?></td>

                    <td><?php echo $row["capacity"];?></td>
                    <td><?php echo $row["freemb"];?></td>
                    <td><?php echo $row["freepourcent"];?></td>

                    <td><?php echo $row["os"];?></td>

                </tr>
<?php  
} //fin du tableau: toute les données de la bdd sont dans le tableau
?>
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
<script>
    $(document).ready(function () {

        //fonction simple qui permet d'afficher progressivement l"heure
        $('#bienvenue').fadeIn(4000);

        //fonction qui permet d'afficher une sous-table lors d'un clique sur une ligne
        function format(d) {

            return '<table  style="display:inline;" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td> OS :</td>' +
                '<td>' + '<?php echo "coucou" ?>' + '</td>' +
                '</tr>' +
                '</table>';
        }

        //permet d'initali
        var table = $("#employee_data").DataTable();

        $('#employee_data tbody').on('click', 'tr', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // ferme les row si il est ouvert
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Ouvre les rows
                row.child(format(row.data())).show();
                tr.addClass('shown');

            }

        });
        table.destroy();

        $("#employee_data").DataTable({
            "responsive": true,

            rowCallback: function (row, data, index) {

                //condition si data[5]>60 donc si l'une des valeurs de la colonne 5 est superieur à 60
                if (data[5] > 20 && data[5] < 60) {
                    // find ('td:eq(5)) permet de selectionner la 5ème colonne//
                    $(row).find('td:eq(5)').css('background-color', 'lightcoral');
                    $(row).find('td:eq(5)').css('color', 'white');
                }

                if (data[5] >= 60 && data[5] < 80) {
                    $(row).find('td:eq(5)').css('background-color', 'rgb(10, 93, 169,0.7');
                    $(row).find('td:eq(5)').css('color', 'white');

                }
                if (data[5] >= 80) {
                    $(row).find('td:eq(5)').css('background-color', 'rgb(10, 93, 169,0.9');
                    $(row).find('td:eq(5)').css('color', 'white');

                }

                if (data[5] <= 20) {
                    // find ('td:eq(5)) permet de selectionner la 5ème colonne//
                    $(row).find('td:eq(5)').css('background-color', 'red');
                    $(row).find('td:eq(5)').css('color', 'white');
                }

            }
        }); //fin de 
    }); //fin du script

   
    </script>
