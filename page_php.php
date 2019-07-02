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

<script>
    $(document).ready(function () {

        //fonction simple qui permet d'afficher progressivement l"heure
        $('#bienvenue').fadeIn(4000);

        //fonction qui permet d'afficher une sous-table lors d'un clique sur une ligne
       /* function format(d) {

            return '<table  style="display:inline;" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td> OS :</td>' +
                '<td>' + '<?php // echo "coucou" ?>' + '</td>' +
                '</tr>' +
                '</table>';
        }*/
        // initialisation du datatable
        var table = $('#example').DataTable( {
            fixedHeader: true,

         } );
  
        table.destroy();

        $("#employee_data").DataTable({
            "order": [[ 5, "asc" ]],
            lengthMenu : [ 5,10, 25, 50, 75, 100 ],
            dom: "<'row'<'col'l><'col'B><'col'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
           //dom: 'Bfrtip',
           buttons:
            [
           
                {
                    //ajout d'un bouton d'export csv
                    extend: 'csvHtml5',
                    //ajout d'un icon
                    text: '<i class="fas fa-file-csv"></i>',
                    //ajout d'un titre lors du survolage
                    titleAttr: ' exporter CSV',

                    exportOptions: 
                    {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    //ajout d'un icon
                    text:'<i class="fas fa-filter"></i>',
                    //ajout d'un titre lors du survolage
                    titleAttr: ' filtrer les colonnes',

                },
        ], 

             // permet de mettre le tableau en responsive
            "responsive": true,

            rowCallback: function (row, data, index) {

                //condition si data[5]>60 donc si l'une des valeurs de la colonne 5 est superieur à 60
                if (data[5] >= 0 && data[5] < 10) {
                    // find ('td:eq(5)) permet de selectionner la 5ème colonne//
                    $(row).find('td:eq(5)').css('background-color', 'red');
                    $(row).find('td:eq(5)').css('color', 'white');
                }

                if (data[5] >= 10 && data[5] < 20) {
                    $(row).find('td:eq(5)').css('background-color', '#F8E71C');
                    $(row).find('td:eq(5)').css('color', 'black');

                }
                if (data[5] >= 20) {
                    $(row).find('td:eq(5)').css('background-color', 'green');
                    $(row).find('td:eq(5)').css('color', 'white');

                }

 

            }
        
        });
    }); //fin du script

   
    </script>
