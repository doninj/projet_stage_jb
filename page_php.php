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

    /*
    $del = 'DELETE FROM `site_carrefour`';
$insertion_req=$bdd->query($del);

$sql_2 = 'LOAD DATA LOCAL INFILE \'Classeur1_1.csv\' REPLACE INTO TABLE `site_carrefour` FIELDS TERMINATED BY \';\' ENCLOSED BY \'\' ESCAPED BY \'\' LINES TERMINATED BY \'\\r\\n\' IGNORE 1 LINES';
 
$insertion_req=$bdd->query($sql_2);
*/

$Firstreq = $bdd->query('SELECT * FROM site_carrefour');
$table = "site_carrefour";
$sql = "SHOW TABLE STATUS LIKE '$table'";

$req = $bdd->query($sql);
$data = $req->fetch();
$last_modification = $data['Update_time'];

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js">
    <script type='text/javascript' src='js/jquery.particleground.js'></script>
    <script src='js/demo.js'></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <header>
        <nav id="nav" class="navbar navbar-expand-md navbar-dark bg-primary">
            <img src="image/carrefour.png">



            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <p id="bienvenue">Date de modification: <?php echo $last_modification ?></p>
                </li>
            </ul>


            </li>
            </ul>
            </div>
            </header>
<?php echo $last_modification ?>
            <div class="container">
                <div >
                    <table id="employee_data" class="table table-striped  nowrap" style="width:100%">
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
while ($row=$Firstreq->fetch())
{
  ?>   
    <tr>

    <td><?php echo $row["VILLE"];?></td>
    <td><?php echo $row["VM"];?></td>
    <td><?php echo $row["Disk"];?></td>

    <td><?php echo $row["Capacity MB"];?></td>
    <td><?php echo $row["Free MB"];?></td>
    <td><?php echo $row["Free %"];?></td>

    <td><?php echo $row["OS according to the configuration file"];?></td>
    
    </tr>
  <?php  
} //fin du tableau: toute les données de la bdd sont dans le tableau
?>
                    </table>
                </div>
            </div>






    <div id='table-container' class="" style="width:100%"></div>

    </div><!-- /.container -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/jquery.csv.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <script src='js/csv_to_html_table.js'></script>

    <script> 
    $(document).ready(function(){

        //fonction simple qui permet d'afficher progressivement l"heure
        $('#bienvenue').fadeIn(4000);
function format ( d ) {
        //boucle for qui permet de changer le row_id
      
      
        // `d` is the original data object for the row
        return '<table  style="display:inline;" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>OS :</td>'+
                '<td>'+'<?php echo $last_modification ?>'+'</td>'+
            '</tr>'
            +
        '</table>';
    }

var table=$("#employee_data").DataTable();

$('#employee_data tbody').on('click', 'tr', function () {
          var tr = $(this).closest('tr');
        var row = table.row( tr );
        
        if ( row.child.isShown() ) {
            // ferme les row si il est ouvert
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Ouvre les rows
            row.child( format(row.data()) ).show(); 
            tr.addClass('shown');

        }
        new $.fn.dataTable.FixedHeader( table );
        
    });
table.destroy();
$("#employee_data").DataTable({
    initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
    },
    
       rowCallback: function (row, data, index) {
            
            //condition si data[5]>60 donc si l'une des valeurs de la colonne 5 est superieur à 60
            if ( data[5]>20 && data[5]<60) {
                $(row).find('td:eq(5)').css('background-color',
                    'lightcoral'); // find ('td:eq(5)) permet de selectionner la 3ème colonne//
                $(row).find('td:eq(5)').css('color', 'white');


            }
            
            if (data[5] >= 60 && data[5]<80) {
                $(row).find('td:eq(5)').css('background-color','rgb(10, 93, 169,0.7');
                $(row).find('td:eq(5)').css('color', 'white');

            }
            if (data[5]>=80) {
                $(row).find('td:eq(5)').css('background-color','rgb(10, 93, 169,0.9');
                $(row).find('td:eq(5)').css('color', 'white');

            }
            
            if ( data[5]<=20) {
                $(row).find('td:eq(5)').css('background-color','red'); // find ('td:eq(3)) permet de selectionner la 3ème colonne//
                $(row).find('td:eq(5)').css('color', 'white');


            }
            
        }});


    });
    </script>