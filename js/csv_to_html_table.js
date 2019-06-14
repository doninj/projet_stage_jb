

function init_table(options) {

  options = options || {};
  var csv_path = options.csv_path || ""; //chemin d'accès du csv
  var el = options.element || "table-container";
  var allow_download = options.allow_download || false; //permet de telecharger le csv
  var csv_options = options.csv_options || {}; //variable de création des otpion csv
  var datatables_options = options.datatables_options || {};

  $("#" + el).html("<table class='table table-striped table-bordered dt-responsive nowrap' id='my-table'></table>");

  $.when($.get(csv_path)).then(
    function (data) {
      var csv_data = $.csv.toArrays(data, csv_options); // permet de separer dans un tableau les data du csv
      var table_head = "<thead><tr>";

      console.log(csv_data[0].length);
      for (head_id = 0; head_id < csv_data[0].length; head_id++) //csv_data[0]=taille de nombre de titr
      {
        table_head += "<th>" + csv_data[0][head_id] + "</th>";//csv-data[0][head_id] permet de recuperer les données dans le tableau avec les titres
        //console.log(table_head);

        //boucle qui permet de créer le tr en ajoutant par rapport à la taille du csv_data du premier array.
        /*<thead><tr><th>VM</th> 
          <thead><tr><th>VM</th><th>Disk</th>
          <thead><tr><th>VM</th><th>Disk</th><th>Capacity MB</th>*/
      }

      table_head += "</tr></thead>";
      $('#my-table').append(table_head);
      $('#my-table').append("<tbody></tbody>");



      for (row_id = 1; row_id < csv_data.length; row_id++) {
        var row_html = "<tr>";

        for (col_id = 0; col_id < csv_data[row_id].length; col_id++) {
          if (csv_data[row_id][col_id] === "FR0002FS1") {
            row_html += "<td data-search='Lyon'>" + csv_data[row_id][col_id] + "</td>";
          } else {
            row_html += "<td>" + csv_data[row_id][col_id] + "</td>";
          }

        }
        // boucle qui permet de créer les td avec les data des array
        row_html += "</tr>";
        $('#my-table tbody').append(row_html);
      }
      //fonction format qui permet de créer le sous tableau
      //sortie: sous tableau
      //
      function format ( d ) {
        //boucle for qui permet de changer le row_id
        for (row_id = 1; row_id < csv_data.length; row_id++) {
      
        // `d` is the original data object for the row
        return '<table  style="display:inline;" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>OS :</td>'+
                '<td>'+csv_data[row_id][6]+'</td>'+
            '</tr>'
            +
        '</table>';
    }}
     var table= $("#my-table").DataTable(datatables_options);

      if (allow_download)
        $("#" + el).append("<p><a class='btn btn-info' href='" + csv_path + "'><i class='glyphicon glyphicon-download'></i> Download as CSV</a></p>");
        $('#my-table tbody').on('click', 'tr', function () {
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
  } );
}