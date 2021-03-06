$(document).ready(function() {
    $('#table').DataTable(
      {
        "pagingType": "full_numbers",
        "ordering": false,
        "searching": true,
        language: {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     ">",
              "sPrevious": "<"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          },
            "buttons": {
                "copyTitle": 'Informacion copiada',
                "copyKeys": 'Use your keyboard or menu to select the copy command',
                "copySuccess": {
                    "_": '%d filas copiadas al portapapeles',
                    "1": '1 fila copiada al portapapeles'
                },

                "pageLength": {
                    "_": "Mostrar %d filas",
                    "-1": "Mostrar Todo"
                }
            }
        },
        responsive:'true',
        "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "Mostrar Todo"]],
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>> <'row'<'col-sm-12'tr>> <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: {
          dom: {
            container: {
                tag: 'div',
                className: 'flexcontent'
            },
            buttonLiner: {
                tag: null
            }
          },
          buttons:[
      			{
      				extend:    'excelHtml5',
      				text:      '<i class="fa fa-file-excel-o"></i> ',
      				titleAttr: 'Exportar a Excel',
      				className: 'btn btn-success'
      			},
      			{
      				extend:    'pdfHtml5',
      				text:      '<i class="fa fa-file-pdf-o"></i> ',
      				titleAttr: 'Exportar a PDF',
      				className: 'btn btn-danger',
              customize:function(doc) {
                doc.styles.title = {
                    color: '#004fff',
                    fontSize: '15',
                    alignment: 'center'
                }
                doc.styles['td:nth-child(2)'] = {
                    width: '100px',
                    'max-width': '100px'
                },
                doc.styles.tableHeader = {
                    fillColor:'#0094ff',
                    color:'white',
                    alignment:'center'
                },
                doc.content[1].margin = [ 100, 0, 100, 0 ]
              }
      			},
            {
              extend:    'csvHtml5',
              text:      '<i class="fa fa-print"></i> ',
              titleAttr: 'CSV',
              className: 'btn btn-primary'
            },
            {
              extend: 'pageLength',
              titleAttr: 'Registros a mostrar',
              className: 'selectTable'
            }
    		]
      }
    });
});
