<?php

try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost:3307;dbname=carrefour;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM site_carrefour');


?>


<!DOCTYPE html>
<html lang="en">

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
                    <p id="bienvenue">Bienvenue !</p>
                </li>
            </ul>


            </li>
            </ul>
            </div>
            </header>

            <div class="container">
                <div >
                    <table id="employee_data" class="table-striped table-bordered">
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
while ($row=$reponse->fetch())
{
    echo '
    <tr>

    <td>'.$row["VILLE"].'</td>
    <td>'.$row["VM"].'</td>
    <td>'.$row["Disk"].'</td>

    <td>'.$row["Capacity MB"].'</td>
    <td>'.$row["Free MB"].'</td>
    <td>'.$row["Free %"].'</td>
    
    <td>'.$row["OS according to the configuration file"].'</td>

    </tr>
    ';
}
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

    <script> $(document).ready(function(){

$("#employee_data").DataTable();




    });
    </script>