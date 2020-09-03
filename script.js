
    $(document).ready(function () {

    // DataTable
 
   
        //fonction qui permet d'afficher une sous-table lors d'un clique sur une ligne
        function format(d) {

            return '<table  style="display:inline;" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td> OS :</td>' +
                '<td>' + '<?php echo $res;?>' + '</td>' +
                '</tr>' +
                '</table>';
                
               
        }
        // initialisation du datatable
        
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
       
    });
            
           
           
           /* table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );*/

         
  
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

   
